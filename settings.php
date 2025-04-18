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
    $settings = new theme_boost_admin_settingspage_tabs('filtersettingsynhi', get_string('filtername', 'filter_synhi'));

    // Information.
    $page = new admin_settingpage(
        'filter_synhi_information',
        get_string('information', 'filter_synhi')
    );
    $page->add(new admin_setting_heading(
        'filter_synhi_information',
        '',
        format_text(get_string('informationsettingsdesc', 'filter_synhi'), FORMAT_MARKDOWN)
    ));

    // Information.
    $page->add(new \filter_synhi\admin_setting_information('filter_synhi/formatinformation', '', '', 500, 500));

    // Readme.md.
    $page->add(new \filter_synhi\admin_setting_markdown('filter_synhi/filterreadme', '', '', 'Readme.md', 'filter/synhi'));

    // Changes.md.
    $page->add(new \filter_synhi\admin_setting_markdown(
        'filter_synhi/filterchanges',
        get_string('informationchanges', 'filter_synhi'),
        '',
        'Changes.md',
        'filter/synhi'
    ));

    $settings->add($page);

    // Settings.
    $page = new admin_settingpage('filter_synhi_settings', get_string('settings', 'filter_synhi'));
    // Engine.
    $name = 'filter_synhi/engine';
    $title = get_string('engine', 'filter_synhi');
    $description = get_string('enginedesc', 'filter_synhi');
    $default = 'enlighterjs';
    $setting = new admin_setting_configselect(
        $name,
        $title,
        $description,
        $default,
        [
            'enlighterjs' => get_string('enlighterjs', 'filter_synhi'),
            'syntaxhighlighter' => get_string('syntaxhighlighter', 'filter_synhi'),
        ]
    );
    $page->add($setting);

    // EnlighterJS style.
    $name = 'filter_synhi/enlighterjsstyle';
    $title = get_string('enlighterjsstyle', 'filter_synhi');
    $description = get_string('styledesc', 'filter_synhi');
    $default = 'enlighter';
    $setting = new admin_setting_configselect(
        $name,
        $title,
        $description,
        $default,
        \filter_synhi\toolbox::ENLIGHTERJSSTYLES
    );
    $page->add($setting);

    // Syntax Highlighter style.
    $name = 'filter_synhi/syntaxhighlighterstyle';
    $title = get_string('syntaxhighlighterstyle', 'filter_synhi');
    $description = get_string('styledesc', 'filter_synhi');
    $default = 'default';
    $setting = new admin_setting_configselect(
        $name,
        $title,
        $description,
        $default,
        \filter_synhi\toolbox::SYNTAXHIGHLIGHTERSTYLES
    );
    $page->add($setting);

    // Syntax Highlighter example.
    $name = 'filter_synhi/syntaxhighlighterexample';
    $title = get_string('syntaxhighlighterexample', 'filter_synhi');
    $description = get_string('syntaxhighlighterexampledesc', 'filter_synhi');
    $setting = new \filter_synhi\admin_setting_highlight($name, $title, $description);
    $page->add($setting);

    // Code for the example.
    $name = 'filter_synhi/codeexample';
    $title = get_string('codeexample', 'filter_synhi');
    $description = get_string('codeexampledesc', 'filter_synhi');
    $default = \filter_synhi\toolbox::EXAMPLECODE;
    $setting = new \admin_setting_configtextarea($name, $title, $description, $default);
    $page->add($setting);

    // Information.
    $page->add(new admin_setting_heading(
        'filter_synhi_information_heading',
        get_string('informationheading', 'filter_synhi'),
        format_text(get_string('informationheadingdesc', 'filter_synhi'), FORMAT_PLAIN)
    ));

    $page->add(new admin_setting_description(
        'filter_synhi_general_information',
        'generalinformation',
        '<p>' . get_string('generalinformation', 'filter_synhi') . '</p>'
    ));

    $page->add(new admin_setting_description(
        'filter_synhi_enlighter_information',
        'enlighterinformation',
        '<p>' . get_string('enlighterinformation', 'filter_synhi') . '</p>'
    ));

    $page->add(new admin_setting_description(
        'filter_synhi_syntaxhighlighter_information',
        'syntaxhighlighterinformation',
        '<p>' . get_string('syntaxhighlighterinformation', 'filter_synhi') . '</p>'
    ));

    $settings->add($page);
}
