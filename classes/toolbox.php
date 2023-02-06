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

use \moodle_url;

/**
 * SynHi filter.
 *
 * @package    filter_synhi
 * @copyright  &copy; 2020-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class toolbox {
    /**
     * @var toolbox Singleton instance of us.
     */
    protected static $instance = null;

    /**
     * @var string EnlighterJS JS file.
     */
    private const ENLIGHTERJSJS = '/filter/synhi/javascript/EnlighterJS_3_4_0/scripts/enlighterjs.min.js';

    /**
     * @var string EnlighterJS CSS file start.
     */
    private const ENLIGHTERJSCSSPRE = '/filter/synhi/javascript/EnlighterJS_3_4_0/styles/enlighterjs.';

    /**
     * @var string EnlighterJS CSS file end.
     */
    private const ENLIGHTERJSCSSPOST = '.min.css';

    /**
     * @var string Syntax Highlighter JS file.
     */
    private const SYNTAXHIGHLIGHTERJS = '/filter/synhi/javascript/syntaxhighlighter_4_0_1/scripts/syntaxhighlighter.js';

    /**
     * @var string Syntax Highlighter CSS file start.
     */
    private const SYNTAXHIGHLIGHTERCSSPRE = '/filter/synhi/javascript/syntaxhighlighter_4_0_1/styles/';

    /**
     * @var string Syntax Highlighter CSS file end.
     */
    private const SYNTAXHIGHLIGHTERCSSPOST = '.css';

    /**
     * @var string Enlighter JS styles.
     */
    public const ENLIGHTERJSSTYLES = array(
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
    );

    /**
     * @var string Syntax Highlighter styles.
     */
    public const SYNTAXHIGHLIGHTERSTYLES = array(
        'default' => 'Default',
        'django' => 'Django',
        'eclipse' => 'Eclipse',
        'emacs' => 'Emacs',
        'fadetogrey' => 'Fade To Grey',
        'mdultra' => 'MD ultra',
        'midnight' => 'Midnight',
        'rdark' => 'R Dark',
        'swift' => 'Swift'
    );

    public const ENLIGHTERSELECTORS = array(
        'synhi pre' => 'synhi pre',
        'synhi code' => 'synhi code',
        'none' => 'none'
    );

    /**
     * @var string Default example code.
     */
    public const EXAMPLECODE = '
    <pre class="brush: java">package test;<br>

    public class Test {
        private final String name = "Java program";

        public static void main (String args[]) {
            Test us = new Test();
            System.out.println(us.getName());
        }

        public String getName() {
            return name;
        }
    }
    </pre>';

    /**
     * This is a lonely object.
     */
    private function __construct() {
    }

    /**
     * Gets the toolbox singleton.
     *
     * @return toolbox The toolbox instance.
     */
    public static function get_instance() {
        if (!is_object(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Highlights the page using the current values.
     * @param array $config Highlighter config.
     */
    public function highlight_page($config) {
        if (!empty($config->engine)) {
            global $PAGE;

            $enginemethod = $config->engine.'_init';
            $init = $this->$enginemethod($config);

            $data = array('data' => array());
            $data['data']['thecss'] = $init['thecss']->out();
            $data['data']['thejs'] = $init['thejs']->out();
            if (!empty($init['theinit'])) {
                $data['data']['theinit'] = $init['theinit'];
            }
            $PAGE->requires->js_call_amd('filter_synhi/synhi', 'init', $data);
        }
    }

    /**
     * Gets the admin_setting_highlight data for its template.
     *
     * @return array The data.
     */
    public function setting_highlight() {
        $data = array();

        $config = get_config('filter_synhi');
        if (!empty($config->engine)) {
            $enginemethod = $config->engine.'_init';

            $data['highlightdata'] = $this->$enginemethod($config);
            $data['code'] = htmlentities($config->codeexample);
        }

        return $data;
    }

    /**
     * Renders the example code in an template that has an iframe with given highlighter engine and style.
     *
     * @param string $engine Highlighter engine.
     * @param string $style Highlighter style.
     *
     * @return string The markup.
     */
    public function setting_highlight_example($engine, $style) {
        $markup = '';
        $proceed = false;

        if (($engine == 'enlighterjs') && (array_key_exists($style, self::ENLIGHTERJSSTYLES))) {
            $proceed = true;
        } else if (($engine == 'syntaxhighlighter') && (array_key_exists($style, self::SYNTAXHIGHLIGHTERSTYLES))) {
            $proceed = true;
        }

        if ($proceed) {
            global $OUTPUT, $PAGE;

            $enginemethod = $engine.'_init';
            $config = new \stdClass;
            $config->enlighterjsstyle = $style;
            $config->syntaxhighlighterstyle = $style;

            $context = new \stdClass;
            $context->highlightdata = $this->$enginemethod($config);
            $context->code = htmlentities(get_config('filter_synhi', 'codeexample'));

            $PAGE->set_context(\context_system::instance());
            $markup = $OUTPUT->render_from_template('filter_synhi/setting_highlight_example', $context);
        } else {
            $markup = '<p id="setting_highlight_example_frame">';
            $markup .= 'Invalid parameters passed to \'setting_highlight_example(\''.$engine.'\', \''.$style.'\')\'</p>';
        }

        return $markup;
    }

    /**
     * EnlighterJS files.
     *
     * @param stdClass $config Filter config
     *
     * @return array CSS & JS file moodle_url's, and any initialisation JS in a string.
     */
    private function enlighterjs_init($config) {
        $js = new moodle_url(self::ENLIGHTERJSJS);
        $css = new moodle_url(self::ENLIGHTERJSCSSPRE.$config->enlighterjsstyle.self::ENLIGHTERJSCSSPOST);
        $selector1 = $config->enlighterjsselectorone ?? 'none';
        $selector1 = $selector1 === 'none' ? 'null' : "'$selector1'";
        $selector2 = $config->enlighterjsselectortwo ?? 'none';
        $selector2 = $selector2 === 'none' ? 'null' : "'$selector2'";

        return array(
            'thejs' => $js,
            'thecss' => $css,
            'theinit' => "EnlighterJS.init($selector1, $selector2, {theme: '".$config->enlighterjsstyle."', indent : 4});"
        );
    }

    /**
     * Syntax Highlighter files.
     *
     * @param stdClass $config Filter config
     *
     * @return array CSS & JS file moodle_url's, and any initialisation JS in a string.
     */
    private function syntaxhighlighter_init($config) {
        $js = new moodle_url(self::SYNTAXHIGHLIGHTERJS);
        $css = new moodle_url(self::SYNTAXHIGHLIGHTERCSSPRE.$config->syntaxhighlighterstyle.self::SYNTAXHIGHLIGHTERCSSPOST);

        return array(
            'thejs' => $js,
            'thecss' => $css
        );
    }
}
