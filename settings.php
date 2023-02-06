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
    $default = 'enlighter';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        \filter_synhi\toolbox::ENLIGHTERJSSTYLES
    );
    $settings->add($setting);

    // Syntax Highlighter style.
    $name = 'filter_synhi/syntaxhighlighterstyle';
    $title = get_string('syntaxhighlighterstyle', 'filter_synhi');
    $description = get_string('styledesc', 'filter_synhi');
    $default = 'default';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        \filter_synhi\toolbox::SYNTAXHIGHLIGHTERSTYLES
    );
    $settings->add($setting);

    // EnlighterJS selector one.
    $name = 'filter_synhi/enlighterjsselectorone';
    $title = new lang_string('enlighterjsselectorone', 'filter_synhi');
    $description = new lang_string('enlighterjsselectoronedesc', 'filter_synhi');
    $default = 'synhi pre';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        \filter_synhi\toolbox::ENLIGHTERSELECTORS
    );
    $settings->add($setting);
    // EnlighterJS selector two.
    $name = 'filter_synhi/enlighterjsselectortwo';
    $title = new lang_string('enlighterjsselectortwo', 'filter_synhi');
    $description = new lang_string('enlighterjsselectortwodesc', 'filter_synhi');
    $default = 'synhi code';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        \filter_synhi\toolbox::ENLIGHTERSELECTORS
    );
    $settings->add($setting);

    // Syntax Highlighter example.
    $name = 'filter_synhi/syntaxhighlighterexample';
    $title = get_string('syntaxhighlighterexample', 'filter_synhi');
    $description = get_string('syntaxhighlighterexampledesc', 'filter_synhi');
    $setting = new \filter_synhi\admin_setting_highlight($name, $title, $description);
    $settings->add($setting);

    // Code for the example.
    $name = 'filter_synhi/codeexample';
    $title = get_string('codeexample', 'filter_synhi');
    $description = get_string('codeexampledesc', 'filter_synhi');
    $default = '<pre class="brush: java">'.PHP_EOL;
    $default .= 'package test;'.PHP_EOL.PHP_EOL;
    $default .= 'public class Test {'.PHP_EOL;
    $default .= '    private final String name = "Java program";'.PHP_EOL.PHP_EOL;
    $default .= '    public static void main (String args[]) {'.PHP_EOL;
    $default .= '        Test us = new Test();'.PHP_EOL;
    $default .= '        System.out.println(us.getName());'.PHP_EOL;
    $default .= '    }'.PHP_EOL.PHP_EOL;
    $default .= '    public String getName() {'.PHP_EOL;
    $default .= '        return name;'.PHP_EOL;
    $default .= '    }'.PHP_EOL;
    $default .= '}</pre>';
    $setting = new \admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);

    // Information.
    $settings->add(new admin_setting_heading('filter_synhi_information_heading',
        get_string('informationheading', 'filter_synhi'),
        format_text(get_string('informationheadingdesc', 'filter_synhi'), FORMAT_PLAIN)));

    $settings->add(new admin_setting_description('filter_synhi_general_information',
        'generalinformation',
        '<p>'.get_string('generalinformation', 'filter_synhi').'</p>'));

    $settings->add(new admin_setting_description('filter_synhi_enlighter_information',
        'enlighterinformation',
        '<p>'.get_string('enlighterinformation', 'filter_synhi').'</p>'));

    $settings->add(new admin_setting_description('filter_synhi_syntaxhighlighter_information',
        'syntaxhighlighterinformation',
        '<p>'.get_string('syntaxhighlighterinformation', 'filter_synhi').'</p>'));
}
