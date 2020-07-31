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

    /**
     *
     *
     *
     * @param string $text to be processed by the text
     * @param array $options filter options
     * @return string text after processing
     */
    function filter($text, array $options = array()) {
        // Basic test to avoid work.
        if (!is_string($text)) {
            // non string content can not be filtered anyway.
            return $text;
        }
        // Do a quick check to see if we have a tag
        if (strpos($text, '<pre') !== false) {
            global $PAGE;

            $PAGE->requires->js('/filter/synhi/javascript/syntaxhighlighter_4_0_1/scripts/syntaxhighlighter.js');
            //$PAGE->requires->css('/filter/synhi/javascript/syntaxhighlighter_4_0_1/styles/default.css');

            return $text;
        }

        return $text;
    }
}
