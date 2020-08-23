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

defined('MOODLE_INTERNAL') || die();
/**
 * This filter looks for content tags in Moodle text and
 * replaces them with specified user-defined content.
 * @see filter_manager::apply_filter_chain()
 */
class filter_synhi extends moodle_text_filter {

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
            // Do a quick check to see if we have a tag.
            if ((strpos($text, '<pre') !== false) || (strpos($text, '<code') !== false)) {
                global $PAGE;

                if (!self::$done) {
                    $config = get_config('filter_synhi');

                    if (!empty($config->engine)) {
                        $enginemethod = $config->engine.'_init';
                        $init = $this->$enginemethod($config);

                        $data = array('data' => array());
                        $data['data']['css'] = $init['css']->out();
                        $data['data']['js'] = $init['js']->out();
                        if (!empty($init['init'])) {
                            $data['data']['init'] = $init['init'];
                        }

                        $PAGE->requires->js_call_amd('filter_synhi/synhi', 'init', $data);

                        self::$done = true;
                    }
                }
            }
        }

        return $text;
    }

    /**
     * EnlighterJS files.
     *
     * @param stdClass $config Filter config
     *
     * @return array CSS & JS file moodle_url's, and any initialisation JS in a string.
     */
    private function enlighterjs_init($config) {
        $js = new moodle_url('/filter/synhi/javascript/EnlighterJS_3_4_0/scripts/enlighterjs.min.js');
        $css = new moodle_url(
            '/filter/synhi/javascript/EnlighterJS_3_4_0/styles/enlighterjs.'.$config->enlighterjsstyle.'.min.css');

        return array(
            'js' => $js,
            'css' => $css,
            'init' => "EnlighterJS.init('pre', 'code', {
                theme: '".$config->enlighterjsstyle."',
                indent : 4
            });"
        );
    }

    /**
     * Syntax Highlighter files.
     *
     * @param stdClass $config Filter config
     *
     * @return array CSS & JS file moodle_url's, and any initialisation JS in a string.
     */
    private function syntaxhighlighter_init($config) {
        $js = new moodle_url('/filter/synhi/javascript/syntaxhighlighter_4_0_1/scripts/syntaxhighlighter.js');
        $css = new moodle_url('/filter/synhi/javascript/syntaxhighlighter_4_0_1/styles/'.$config->syntaxhighlighterstyle.'.css');

        return array(
            'js' => $js,
            'css' => $css
        );
    }


}
