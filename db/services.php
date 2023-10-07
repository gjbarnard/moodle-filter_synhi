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

defined('MOODLE_INTERNAL') || die;

$functions = [
    'filter_synhi_setting_highlight_example' => [
        'classname' => 'filter_synhi\output\external',
        'methodname' => 'setting_highlight_example',
        'description' => 'Generate the admin setting example highlighted code',
        'type' => 'read',
        'loginrequired' => true,
        'ajax' => true,
    ],
];

$services = [
    'SynHi Filter admin setting example' => [
            'functions' => ['filter_synhi_setting_highlight_example'],
            'restrictedusers' => 0,
            'enabled' => 1,
    ],
];
