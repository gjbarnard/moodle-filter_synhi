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

// phpcs:disable moodle.Files.LangFilesOrdering

$string['filtername'] = 'SynHi';
$string['pluginname'] = 'SynHi';

// Settings.
$string['engine'] = 'Engine';
$string['enginedesc'] = 'Engine to use.  Either \'<a href="https://github.com/EnlighterJS/EnlighterJS" target="_blank">EnlighterJS</a> - Mozilla Public License 2.0 (MPL-2.0)\' or \'<a href="https://github.com/syntaxhighlighter/syntaxhighlighter" target="_blank">SyntaxHighlighter</a> - MIT licensed\'.';
$string['enlighterjs'] = 'EnlighterJS';
$string['syntaxhighlighter'] = 'SyntaxHighlighter';

$string['enlighterjsstyle'] = 'EnlighterJS style';
$string['syntaxhighlighterstyle'] = 'SyntaxHighlighter style';
$string['styledesc'] = 'Choose the sytle you wish to use.';

$string['codeexample'] = 'Code';
$string['codeexampledesc'] = 'Code to use in the example.  Note: Save to use in the example.';

$string['syntaxhighlighterexample'] = 'Example';
$string['syntaxhighlighterexampledesc'] = 'From the \'codeexample\' setting...';

// Information.
$string['brokenmarkup'] = 'The markup is broken, highlighting will be wrong.';
$string['enlighterinformation'] = 'Surround your code with the \'code\' tag for inline code, for multiline, then encompase within a \'pre\' tag.  Enlighter will attempt to workout the language.  But you can specify it by adding the \'data-enlighter-language\' attribute to the \'code\' tag with the value of the language, such as \'data-enlighter-language="java"\'.  So the desired text in the brackets for:<br><ul><li>ABAP (abap)</li><li>Apache HTTPD (apache)</li><li>Assembly (assembly, asm)</li><li>AVR Assembly (avrassembly, avrasm)</li><li>Windows Batch/Bat (bat,batch,cmd)</li><li>C/C++ (c,cpp, c++)</li><li>C# (csharp)</li><li>CSS(css)</li><li>Cython (cython)</li><li>CordPro (cordpro)</li><li>diff (diff)</li><li>Dockerfile (docker, dockerfile)</li><li>Generic (generic, standard) - default highlighting scheme</li><li>Groovy (groovy)</li><li>Go (go, golang)</li><li>HTML (html)</li><li>Ini (ini, conf)</li><li>Java (java)</li><li>Javascript (js, javascript, jquery, mootools, ext.js)</li><li>JSON (json)</li><li>JSX (jsx)</li><li>Kotlin (kotlin)</li><li>LATEX (latex)</li><li>LESS (less)</li><li>lighttpd (lighttpd)</li><li>LUA (lua)</li><li>MariaDB (mariadb)</li><li>Markdown (gfm, md, markdown)</li><li>Matlab/Octave (octave, matlab)</li><li>MSSQL (mssql)</li><li>NGINX (nginx)</li><li>NSIS (nsis)</li><li>Oracle Database (oracledb)</li><li>PHP (php)</li><li>Powerhsell (powershell)</li><li>Prolog (prolog)</li><li>Python (py, python)</li><li>PureBasic (purebasic, pb)</li><li>QML (qml)</li><li>R (r)</li><li>RAW (raw) - raw code without highlighting with EnlighterJS container styles!</li><li>RouterOS/SwitchOS (routeros)</li><li>Ruby (ruby)</li><li>Rust (rust)</li><li>Scala (scala)</li><li>SCSS (scss, sass)</li><li>Shellscript (shell, bash)</li><li>Generic SQL (sql)</li><li>Squirrel (squirrel)</li><li>Swift (swift)</li><li>Typescript (typescript)</li><li>VHDL (vhdl)</li><li>VisualBasic (visualbasic,vb)</li><li>Verilog (verilog)</li><li>XML (xml, html)</li><li>YAML (yaml)</li></ul>';
$string['generalinformation'] = 'Use of the \'pre\' tag only for highlighting code has been removed, please use the \'code\' tag instead and surround with a \'pre\' tag for multiple line code.  The \'<\' and \'>\' symbols seem to be problematic within in a \'code\' tag when they resemble a tag, change them to \'<i>(amphersand)</i>lt;\' and \'<i>(amphersand)</i>gt;\' respectively for your code - here <i>(amphersand)</i> means \'&\'.';
$string['informationheading'] = 'Information';
$string['informationheadingdesc'] = 'Information about the filter.';
$string['syntaxhighlighterinformation'] = 'For SyntaxHighlighter, surround your code with a \'code\' tag and add the class="brush: alias" where \'alias\' (in brackets) is one of the following:<br><ul><li>ActionScript3 (as3, actionscript3)</li><li>Bash/shell (bash, shell)</li><li>ColdFusion (cf, coldfusion)</li><li>C# (c-sharp, csharp)</li><li>C++ (cpp, c)</li><li>CSS (css)</li><li>Delphi (delphi, pas, pascal)</li><li>Diff (diff, patch)</li><li>Erlang (erl, erlang)</li><li>Groovy (groovy)</li><li>JavaScript (js, jscript, javascript)</li><li>Java (java)</li><li>JavaFX (jfx, javafx)</li><li>Perl (perl, pl)</li><li>PHP (php)</li><li>Plain Text (plain, text)</li><li>PowerShell (ps, powershell)</li><li>Python (py, python)</li><li>Ruby (rails, ror, ruby)</li><li>Scala (scala)</li><li>SQL (sql)</li><li>Visual Basic (vb, vbnet)</li><li>XML (xml, xhtml, xslt, html, xhtml)</li></ul>';

// Information settings.
$string['information'] = 'Information';
$string['informationsettings'] = 'Information settings';
$string['informationsettingsdesc'] = 'SynHi filter information';
$string['informationchanges'] = 'Changes';
$string['settings'] = 'Settings';
$string['settingssettings'] = 'Settings settings';
$string['settingssettingsdesc'] = 'SynHi filter settings';
$string['love'] = 'love';
$string['versioninfo'] = 'Release {$a->release}, version {$a->version} on Moodle {$a->moodle}.  Made with {$a->love} in Great Britain.';
$string['versionalpha'] = 'Alpha version - Almost certainly contains bugs.  This is a development version for developers \'only\'!  Don\'t even think of installing on a production server!';
$string['versionbeta'] = 'Beta version - Likely to contain bugs.  Ready for testing by administrators on a test server only.';
$string['versionrc'] = 'Release candidate version - May contain bugs.  Check completely on a test server before considering on a production server.';
$string['versionstable'] = 'Stable version - Could contain bugs.  Check on a test server before installing on your production server.';

// Privacy.
$string['privacy:nop'] = 'The SynHi filter stores settings that pertain to its configuration.  None of the settings are related to a specific user.  It is your responsibilty to ensure that no user data is entered in any free text fields.  Setting a setting will result in that action being logged within the core Moodle logging system against the user whom changed it, this is outside of the filters control, please see the core logging system for privacy compliance for this.  Please examine the code carefully to be sure that it complies with your interpretation of your privacy laws.  I am not a lawyer and my analysis is based on my interpretation.  If you have any doubt then remove the filter forthwith.';
