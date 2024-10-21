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

namespace filter_synhi\output;

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;
use filter_synhi\toolbox;

/**
 * SynHi filter.
 *
 * @package    filter_synhi
 * @copyright  &copy; 2020-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class external extends external_api {
    /**
     * Return generated markup.
     *
     * @param string $engine Highlighter engine.
     * @param string $style Highlighter style.
     *
     * @return string the markup.
     */
    public static function setting_highlight_example($engine, $style) {
        // Parameter validation.
        self::validate_parameters(
            self::setting_highlight_example_parameters(),
            [
                'engine' => $engine,
                'style' => $style,
            ]
        );

        $toolbox = toolbox::get_instance();
        $markup = $toolbox->setting_highlight_example($engine, $style);

        $result = ['markup' => $markup];

        return $result;
    }

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function setting_highlight_example_parameters() {
        return new external_function_parameters(
            [
                'engine' => new external_value(PARAM_TEXT, 'Engine', VALUE_REQUIRED, null, NULL_NOT_ALLOWED),
                'style' => new external_value(PARAM_TEXT, 'Style', VALUE_REQUIRED, null, NULL_NOT_ALLOWED),
            ]
        );
    }

    /**
     * Returns description of method result value.
     *
     * @return external_description
     */
    public static function setting_highlight_example_returns() {
        return new external_single_structure(
            [
                'markup' => new external_value(PARAM_RAW, 'Markup'),
            ],
            'Mustache template'
        );
    }
}
