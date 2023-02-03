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
defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // Engine.
    $name = 'filter_synhi/engine';
    $title = new lang_string('engine', 'filter_synhi');
    $description = new lang_string('enginedesc', 'filter_synhi');
    $default = 'enlighterjs';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        [
            'enlighterjs' => new lang_string('enlighterjs', 'filter_synhi'),
            'syntaxhighlighter' => new lang_string('syntaxhighlighter', 'filter_synhi')
        ]
    );
    $settings->add($setting);

    // EnlighterJS style.
    $name = 'filter_synhi/enlighterjsstyle';
    $title = new lang_string('enlighterjsstyle', 'filter_synhi');
    $description = new lang_string('styledesc', 'filter_synhi');
    $default = 'enlighter';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        \filter_synhi\toolbox::ENLIGHTERJSSTYLES
    );
    $settings->add($setting);


    // EnlighterJS selector 1.
    $name = 'filter_synhi/enlighterjsselector1';
    $title = new lang_string('enlighterjsselector1', 'filter_synhi');
    $description = new lang_string('enlighterjsselector1desc', 'filter_synhi');
    $default = 'synhi pre';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        \filter_synhi\toolbox::ENLIGHTERSELECTORS
    );
    $settings->add($setting);

    // EnlighterJS selector 2.
    $name = 'filter_synhi/enlighterjsselector2';
    $title = new lang_string('enlighterjsselector2', 'filter_synhi');
    $description = new lang_string('enlighterjsselector2desc', 'filter_synhi');
    $default = 'synhi code';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        \filter_synhi\toolbox::ENLIGHTERSELECTORS
    );
    $settings->add($setting);


    // Syntax Highlighter style.
    $name = 'filter_synhi/syntaxhighlighterstyle';
    $title = new lang_string('syntaxhighlighterstyle', 'filter_synhi');
    $description = new lang_string('styledesc', 'filter_synhi');
    $default = 'default';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        \filter_synhi\toolbox::SYNTAXHIGHLIGHTERSTYLES
    );
    $settings->add($setting);

    // Syntax Highlighter example.
    $name = 'filter_synhi/syntaxhighlighterexample';
    $title = new lang_string('syntaxhighlighterexample', 'filter_synhi');
    $description = new lang_string('syntaxhighlighterexampledesc', 'filter_synhi');
    $setting = new \filter_synhi\admin_setting_highlight($name, $title, $description);
    $settings->add($setting);

    // Code for the example.
    $name = 'filter_synhi/codeexample';
    $title = new lang_string('codeexample', 'filter_synhi');
    $description = new lang_string('codeexampledesc', 'filter_synhi');
    $setting = new \admin_setting_configtextarea($name, $title, $description, \filter_synhi\toolbox::EXAMPLECODE);
    $settings->add($setting);

    // Information.
    $settings->add(new admin_setting_heading('filter_synhi_information_heading',
        new lang_string('informationheading', 'filter_synhi'),
        format_text(get_string('informationheadingdesc', 'filter_synhi'), FORMAT_PLAIN)));

    $settings->add(new admin_setting_description('filter_synhi_general_information',
        'generalinformation',
        '<p>' . get_string('generalinformation', 'filter_synhi') . '</p>'));

    $settings->add(new admin_setting_description('filter_synhi_enlighter_information',
        'enlighterinformation',
        '<p>' . get_string('enlighterinformation', 'filter_synhi') . '</p>'));

    $settings->add(new admin_setting_description('filter_synhi_syntaxhighlighter_information',
        'syntaxhighlighterinformation',
        '<p>' . get_string('syntaxhighlighterinformation', 'filter_synhi') . '</p>'));
}
