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
            if (($this->context->contextlevel >= CONTEXT_COURSE) && ($this->context->contextlevel <= CONTEXT_BLOCK)) {
                // Do a quick check to see if we have a tag.
                $prepos = strpos($text, '<pre');
                $synpos = false;
                if ($prepos !== false) {
                    $synpos = $prepos + 4; // Number of characters in '<pre'.
                } else {
                    $codepos = strpos($text, '<code');
                    if ($codepos !== false) {
                        $synpos = $codepos + 5; // Number of characters in '<code'.
                    }
                }
                if ($synpos !== false) {
                    // Don't alter MathJax -> https://docs.moodle.org/310/en/MathJax_filter.
                    if ((strpos($text, '$$') === false) &&
                        (strpos($text, '[tex]') === false) &&
                        (strpos($text, '<tex>') === false) &&
                        // Above when SynHi filter is before MathJax / TeX fiters in admin list and below for below.
                        (strpos($text, 'MathJax') === false)) {

                        $config = get_config('filter_synhi');
                        if (!empty($config->engine)) {
                            if ($config->engine == 'enlighterjs') {
                                $text = substr($text, 0, $synpos).' class="synhi"'.substr($text, $synpos);
                            }
                            if (!self::$done) {
                                $toolbox = \filter_synhi\toolbox::get_instance();
                                $toolbox->highlight_page($config);
                                self::$done = true;
                            }
                        }
                    }
                }
            }
        }

        return $text;
    }
}
