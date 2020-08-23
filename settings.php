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

if ($ADMIN->fulltree) {
    // Engine.
    $name = 'filter_synhi/engine';
    $title = get_string('engine', 'filter_synhi');
    $description = get_string('enginedesc', 'filter_synhi');
    $default = 'enlighterjs';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        array(
            'enlighterjs' => get_string('enlighterjs', 'filter_synhi'),
            'syntaxhighlighter' => get_string('syntaxhighlighter', 'filter_synhi')
        )
    );
    $settings->add($setting);

    // EnlighterJS style.
    $name = 'filter_synhi/enlighterjsstyle';
    $title = get_string('enlighterjsstyle', 'filter_synhi');
    $description = get_string('styledesc', 'filter_synhi');
    $default = 'default';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        array(
            'default' => 'Default',
            'atomic' => 'Atomic',
            'beyond' => 'Beyond',
            'bootstrap4' => 'Bootstrap 4',
            'classic' => 'Classic',
            'dracula' => 'Dracula',
            'droide' => 'Droide',
            'eclipse' => 'Eclipse',
            'enlighter' => 'Enlighter',
            'godzilla' => 'Godzilla',
            'minimal' => 'Minimal',
            'monokai' => 'Monokai',
            'mowtwo' => 'Mow Two',
            'rowhammer' => 'Row Hammer'
        )
    );
    $settings->add($setting);

    // Syntax Highlighter style.
    $name = 'filter_synhi/syntaxhighlighterstyle';
    $title = get_string('syntaxhighlighterstyle', 'filter_synhi');
    $description = get_string('styledesc', 'filter_synhi');
    $default = 'default';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        array(
            'default' => 'Default',
            'django' => 'Django',
            'eclipse' => 'Eclipse',
            'emacs' => 'Emacs',
            'fadetogrey' => 'Fade To Grey',
            'mdultra' => 'MD ultra',
            'midnight' => 'Midnight',
            'rdark' => 'R Dark',
            'swift' => 'Swift'
        )
    );
    $settings->add($setting);

}
