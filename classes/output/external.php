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
 * @copyright  © 2020-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

namespace filter_synhi\output;

use dml_exception;
use external_function_parameters;
use external_single_structure;
use external_value;
use filter_synhi\toolbox;
use invalid_parameter_exception;

/**
 * SynHi filter.
 *
 * @package    filter_synhi
 * @copyright  © 2020-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class external extends \core\output\external {

    /**
     * Return generated markup.
     *
     * @param string $engine Highlighter engine.
     * @param string $style  Highlighter style.
     *
     * @return array the markup.
     * @throws dml_exception
     * @throws invalid_parameter_exception
     */
    public static function setting_highlight_example(string $engine, string $style): array {
        // Parameter validation.
        self::validate_parameters(
            self::setting_highlight_example_parameters(),
            [
                'engine' => $engine,
                'style' => $style
            ]
        );

        $toolbox = toolbox::get_instance();
        $markup = $toolbox->setting_highlight_example($engine, $style);

        return ['markup' => $markup];
    }

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function setting_highlight_example_parameters(): external_function_parameters {
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
     * @return external_single_structure
     */
    public static function setting_highlight_example_returns(): external_single_structure {
        return new external_single_structure(
            [
                'markup' => new external_value(PARAM_RAW, 'Markup'),
            ], 'Mustache template');
    }
}
