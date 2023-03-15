<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * SynHi filter.
 *
 * @package    filter_synhi
 * @copyright  &copy; 2020-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

/**
 * SynHi filter.
 *
 * @package    filter_synhi
 * @copyright  &copy; 2020-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class filter_synhi extends moodle_text_filter {

    /**
     * @var bool $done - true if the engine has been initialised already.
     */
    private static $done = false;

    /**
     * Filter the text.
     *
     * @param string $text to be processed by the text
     * @param array $options filter options
     *
     * @return string text after processing.
     */
    public function filter($text, array $options = array()) {
        // Basic test to avoid work.
        if (is_string($text)) {
            global $PAGE;
            if (($PAGE->pagelayout != 'admin') &&
                ($this->context->contextlevel >= CONTEXT_COURSE) &&
                ($this->context->contextlevel <= CONTEXT_BLOCK)
                ) {
                // Do a quick check to see if we have a tag.
                $synpos = strpos($text, '<code');
                if ($synpos !== false) {
                    $config = get_config('filter_synhi');
                    if (!empty($config->engine)) {
                        //if ($config->engine == 'enlighterjs') {
                        //$text = '<synhi>'.$text.'</synhi>';
                        //}
                        $text = $this->processtext($text, $synpos);
                        if (!self::$done) {
                            $toolbox = \filter_synhi\toolbox::get_instance();
                            $toolbox->highlight_page($config);
                            self::$done = true;
                        }
                    }
                }
            }
        }

        return $text;
    }

    protected function processtext(&$text, $codepos) {
        //while ($codestartpos !== false) {
            //$codeendpos = strpos($text, '</code>');
            //if ($codeendpos !== false) {
                // Valid block.
                /*$test = mb_ereg_replace_callback(
                    '<code.*<\/code>',
                    function ($matches) {
                       return '<synhi>'.$matches[1].'</synhi>';
                    },
                    $text);*/
                /*$test = array();
                preg_match_all (
                    '/(<code(.*?)>)(.|\n|\r)*?(<\/code>)/',
                    $text,
                    $test,PREG_SET_ORDER, 0
                );
                echo $test;*/
            //}
        //}

        $currentpos = $codepos;
        $forwardpos = 0;
        $temppos = 0;
        $output = array();
        $broken = false;

        $output[] = mb_substr($text, 0, $codepos); // The markup up to the first 'code' tag.
        while ($codepos !== false) {
            $forwardpos = strpos($text, '>', $currentpos);
            $temppos = strpos($text, '<', $currentpos + 1);
            if (($forwardpos === false) || ($temppos == false) || ($forwardpos > $temppos)) {
                /* If the forward position is greater than the temporary position then that
                   means that the closing greater than sign is missing from the code tag =
                   Broken markup. */
                $broken = true;
                break;
            }
            $forwardpos++; // Past the greater than of the start code tag.
            $output[] = mb_substr($text, $currentpos, $forwardpos - $currentpos); // The start 'code' tag.
            $currentpos = $forwardpos;
            $forwardpos = strpos($text, '</code>', $currentpos);
            if ($forwardpos === false) {
                // Broken markup.
                $broken = true;
                break;
            }
            $output[] = htmlentities(mb_substr($text, $currentpos, $forwardpos - $currentpos)); // The contained code.
            $output[] = '</code>'; // The end code tag.
            $currentpos = $forwardpos + 7; // End of the contained code plus the end code tag length.

            // Is there another bit of code?
            $codepos = strpos($text, '<code', $currentpos);
            if ($codepos !== false) {
                // Yes.
                $output[] = mb_substr($text, $currentpos, $codepos - $currentpos); // The markup to the next 'code' tag.
                $currentpos = $codepos;
            } else {
                // No.
                $output[] = mb_substr($text, $currentpos); // The rest of the markup.
            }
        }

        if ($broken) {
            global $OUTPUT;
            $context = new stdClass;
            $context->text = $text;
            return $OUTPUT->render_from_template('filter_synhi/broken_markup', $context);
        }
        return implode($output);
    }
}
