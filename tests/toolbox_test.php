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

namespace filter_synhi;

use moodle_url;
use stdClass;

/**
 * Toolbox unit tests for the SynHi filter.
 *
 * @group filter_synhi
 * @copyright  &copy; 2020-onwards G J Barnard.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
final class toolbox_test extends \advanced_testcase {
    /**
     * @var string EnlighterJS JS file.
     */
    private const ENLIGHTERJSJS = '/filter/synhi/javascript/EnlighterJS_3_6_0/scripts/enlighterjs.min.js';

    /**
     * @var string EnlighterJS CSS file start.
     */
    private const ENLIGHTERJSCSSPRE = '/filter/synhi/javascript/EnlighterJS_3_6_0/styles/enlighterjs.';

    /**
     * @var string EnlighterJS CSS file end.
     */
    private const ENLIGHTERJSCSSPOST = '.min.css';

    /**
     * @var string Syntax Highlighter JS file.
     */
    private const SYNTAXHIGHLIGHTERJS = '/filter/synhi/javascript/syntaxhighlighter_4_0_1_synhi1/scripts/syntaxhighlighter.min.js';

    /**
     * @var string Syntax Highlighter CSS file start.
     */
    private const SYNTAXHIGHLIGHTERCSSPRE = '/filter/synhi/javascript/syntaxhighlighter_4_0_1_synhi1/styles/';

    /**
     * @var string Syntax Highlighter CSS file end.
     */
    private const SYNTAXHIGHLIGHTERCSSPOST = '.css';

    /**
     * @var string SynHi styles CSS.
     */
    private const SYNHISTYLES = '/filter/synhi/styles.css';

    /**
     * Toolbox instance.
     *
     * @var toolbox $instance The instance.
     */
    private $instance = null;

    /**
     * Call protected and private methods for the purpose of testing.
     *
     * @param stdClass $obj The object.
     * @param string $name Name of the method.
     * @param array $args Array of arguments if any, like Monty Python could be no minutes, ten, or even thirty.
     * @return any What the method returns if anything, go, go on, look at the specification, you know you want to.
     */
    protected static function call_method($obj, $name, array $args) {
        // Ref: http://stackoverflow.com/questions/249664/best-practices-to-test-protected-methods-with-phpunit.
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }

    /**
     * Own set up to avoid use of setUp() as it has a different specification depending on version of PHPUnit.
     */
    protected function set_up() {
        $this->resetAfterTest(true);

        $this->instance = \filter_synhi\toolbox::get_instance();
    }

    /**
     * Test the setting highlight.
     */
    public function test_setting_highlight(): void {
        $this->set_up();
        set_config('engine', 'enlighterjs', 'filter_synhi');
        set_config('enlighterjsstyle', 'default', 'filter_synhi');
        set_config('codeexample', '<code>echo \'This is a test not a drill\';</code>', 'filter_synhi');

        $thereturneddata = $this->instance->setting_highlight();

        $synhicssurl = new moodle_url(self::SYNHISTYLES);
        $csstarget = self::ENLIGHTERJSCSSPRE . 'default' . self::ENLIGHTERJSCSSPOST;
        $thecssurl = new moodle_url($csstarget);
        $thejsurl = new moodle_url(self::ENLIGHTERJSJS);
        $thecode = "&lt;code&gt;echo 'This is a test not a drill';&lt;/code&gt;";

        $this->assertEquals($synhicssurl, $thereturneddata->synhicss);
        $this->assertEquals($thecssurl, $thereturneddata->thecss);
        $this->assertEquals($thejsurl, $thereturneddata->thejs);
        $this->assertEquals($thecode, $thereturneddata->code);
    }

    /**
     * Test the setting highlight.
     */
    public function test_setting_highlight_example(): void {
        global $CFG;

        $this->set_up();
        $engine = 'enlighterjs';
        $style = 'godzilla';
        set_config('codeexample', \filter_synhi\toolbox::EXAMPLECODE, 'filter_synhi');

        $thereturneddata = $this->instance->setting_highlight_example($engine, $style);
        $theexpectedoutput = file_get_contents(
            $CFG->dirroot . '/filter/synhi/tests/phpu_data/test_setting_highlight_example_enlighterjs_top.txt'
        );
        $theexpectedoutput .= '                &lt;pre&gt;&lt;code data-enlighter-language=&quot;java&quot; ' .
            'class=&quot;brush: java&quot;&gt;' . PHP_EOL;
        $theexpectedoutput .= 'package test;' . PHP_EOL . PHP_EOL;
        $theexpectedoutput .= 'public class Test {' . PHP_EOL;
        $theexpectedoutput .= '    private final String name = &amp;quot;Java program&amp;quot;;' . PHP_EOL . PHP_EOL;
        $theexpectedoutput .= '    public static void main (String args[]) {' . PHP_EOL;
        $theexpectedoutput .= '        Test us = new Test();' . PHP_EOL;
        $theexpectedoutput .= '        System.out.println(us.getName());' . PHP_EOL;
        $theexpectedoutput .= '    }' . PHP_EOL . PHP_EOL;
        $theexpectedoutput .= '    public String getName() {' . PHP_EOL;
        $theexpectedoutput .= '        return name;' . PHP_EOL;
        $theexpectedoutput .= '    }' . PHP_EOL;
        $theexpectedoutput .= '}' . PHP_EOL . '&lt;/code&gt;&lt;/pre&gt;';
        $theexpectedoutput .= file_get_contents(
            $CFG->dirroot . '/filter/synhi/tests/phpu_data/test_setting_highlight_example_enlighterjs_bottom.txt'
        );
        $this->assertEquals($theexpectedoutput, $thereturneddata);

        $engine = 'valenta';
        $style = 'class43';
        $thereturneddata = $this->instance->setting_highlight_example($engine, $style);
        $theexpectedoutput = '<p id="setting_highlight_example_frame">Invalid parameters passed to ';
        $theexpectedoutput .= '\'setting_highlight_example(\'valenta\', \'class43\')\'</p>';
        $this->assertEquals($theexpectedoutput, $thereturneddata);

        $engine = 'syntaxhighlighter';
        $style = 'fadetogrey';
        set_config('codeexample', '<code class="brush: php">echo \'This is a test not a drill\';</code>', 'filter_synhi');
        $thereturneddata = $this->instance->setting_highlight_example($engine, $style);
        $theexpectedoutput = file_get_contents(
            $CFG->dirroot . '/filter/synhi/tests/phpu_data/test_setting_highlight_example_syntaxhighlighter.txt'
        );
        $this->assertEquals($theexpectedoutput, $thereturneddata);
    }

    /**
     * Test the enlighterjs init.
     */
    public function test_enlighterjs_init(): void {
        $this->set_up();
        $thedata = new stdClass();
        $thedata->enlighterjsstyle = 'default';
        $thereturneddata = self::call_method(
            $this->instance,
            'enlighterjs_init',
            [$thedata]
        );

        $csstarget = self::ENLIGHTERJSCSSPRE . $thedata->enlighterjsstyle . self::ENLIGHTERJSCSSPOST;
        $thecssurl = new moodle_url($csstarget);
        $thejsurl = new moodle_url(self::ENLIGHTERJSJS);

        $this->assertEquals($thecssurl, $thereturneddata->thecss);
        $this->assertEquals($thejsurl, $thereturneddata->thejs);
    }

    /**
     * Test the syntaxhighlighter init.
     */
    public function test_syntaxhighlighter_init(): void {
        $this->set_up();
        $thedata = new stdClass();
        $thedata->syntaxhighlighterstyle = 'default';
        $thereturneddata = self::call_method(
            $this->instance,
            'syntaxhighlighter_init',
            [$thedata]
        );

        $csstarget = self::SYNTAXHIGHLIGHTERCSSPRE . $thedata->syntaxhighlighterstyle . self::SYNTAXHIGHLIGHTERCSSPOST;
        $thecssurl = new moodle_url($csstarget);
        $thejsurl = new moodle_url(self::SYNTAXHIGHLIGHTERJS);

        $this->assertEquals($thecssurl, $thereturneddata->thecss);
        $this->assertEquals($thejsurl, $thereturneddata->thejs);
    }
}
