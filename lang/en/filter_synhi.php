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

$string['filtername'] = 'SynHi filter';

// Settings.
$string['engine'] = 'Engine';
$string['enginedesc'] = 'Engine to use.  Either \'<a href="https://github.com/EnlighterJS/EnlighterJS" target="_blank">EnlighterJS</a> - Mozilla Public License 2.0 (MPL-2.0)\' or \'<a href="https://github.com/syntaxhighlighter/syntaxhighlighter" target="_blank">SyntaxHighlighter</a> - MIT licensed\'.';
$string['enlighterjs'] = 'EnlighterJS';
$string['syntaxhighlighter'] = 'SyntaxHighlighter';

$string['enlighterjsstyle'] = 'EnlighterJS style';
$string['syntaxhighlighterstyle'] = 'SyntaxHighlighter style';
$string['styledesc'] = 'Choose the sytle you wish to use.';

$string['codeexample'] = 'Code';
$string['codeexampledesc'] = 'Code to use in the example.';

$string['syntaxhighlighterexample'] = 'Example';
$string['syntaxhighlighterexampledesc'] = 'from the \'codeexample\' setting...';

// Privacy.
$string['privacy:nop'] = 'The SynHi filter stores settings that pertain to its configuration.  None of the settings are related to a specific user.  It is your responsibilty to ensure that no user data is entered in any free text fields.  Setting a setting will result in that action being logged within the core Moodle logging system against the user whom changed it, this is outside of the filters control, please see the core logging system for privacy compliance for this.  Please examine the code carefully to be sure that it complies with your interpretation of your privacy laws.  I am not a lawyer and my analysis is based on my interpretation.  If you have any doubt then remove the filter forthwith.';
