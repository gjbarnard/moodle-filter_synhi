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

use stdClass;
use moodle_url;

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
     * @var string Enlighter JS styles.
     */
    public const ENLIGHTERJSSTYLES = [
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
        'rowhammer' => 'Row Hammer',
    ];

    /**
     * @var string Syntax Highlighter styles.
     */
    public const SYNTAXHIGHLIGHTERSTYLES = [
        'default' => 'Default',
        'django' => 'Django',
        'eclipse' => 'Eclipse',
        'emacs' => 'Emacs',
        'fadetogrey' => 'Fade To Grey',
        'mdultra' => 'MD ultra',
        'midnight' => 'Midnight',
        'rdark' => 'R Dark',
        'swift' => 'Swift',
    ];

    /**
     * @var string SynHi styles CSS.
     */
    private const SYNHISTYLES = '/filter/synhi/styles.css';

    /**
     * @var string Default example code.
     */
    public const EXAMPLECODE = '<pre><code data-enlighter-language="java" class="brush: java">' . PHP_EOL .
    'package test;' . PHP_EOL . PHP_EOL .
    'public class Test {' . PHP_EOL .
    '    private final String name = "Java program";' . PHP_EOL . PHP_EOL .
    '    public static void main (String args[]) {' . PHP_EOL .
    '        Test us = new Test();' . PHP_EOL .
    '        System.out.println(us.getName());' . PHP_EOL .
    '    }' . PHP_EOL . PHP_EOL .
    '    public String getName() {' . PHP_EOL .
    '        return name;' . PHP_EOL .
    '    }' . PHP_EOL .
    '}' . PHP_EOL .
    '</code></pre>';

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
     * Processes the text containing the 'code' and makes it ready for the highlighter.
     * @param $text The text to process.
     * @param $codepos The position of the first 'code' tag.
     *
     * @return string|false The processed text or false if broken.
     */
    public function processtext(&$text, $codepos) {
        $currentpos = $codepos;
        $forwardpos = 0;
        $temppos = 0;
        $output = [];
        $broken = false;

        if ($codepos > 0) {
            $output[] = mb_substr($text, 0, $codepos); // The markup up to the first 'code' tag.
        }
        while ($codepos !== false) {
            $forwardpos = mb_strpos($text, '>', $currentpos);
            $temppos = mb_strpos($text, '<', $currentpos + 1);
            if (($forwardpos === false) || ($temppos == false) || ($forwardpos > $temppos)) {
                /* If the forward position is greater than the temporary position then that
                   means that the closing greater than sign is missing from the code tag =
                   Broken markup. */
                $broken = true;
                break;
            }
            $forwardpos++; // Past the greater than of the start code tag.
            $output[] = mb_substr($text, $currentpos, $forwardpos - $currentpos); // The start 'code' tag.
            $currentpos = $forwardpos;
            $forwardpos = mb_strpos($text, '</code>', $currentpos);
            if ($forwardpos === false) {
                // Broken markup.
                $broken = true;
                break;
            }
            // HTML entities looks strange but the editor appears to convert some but not all, so convert back then convert all.
            $output[] = htmlentities(
                html_entity_decode(mb_substr($text, $currentpos, $forwardpos - $currentpos), ENT_COMPAT),
                ENT_COMPAT
            ); // The contained code.
            $output[] = '</code>'; // The end code tag.
            $currentpos = $forwardpos + 7; // End of the contained code plus the end code tag length.

            // Is there another bit of code?
            $codepos = mb_strpos($text, '<code', $currentpos);
            if ($codepos !== false) {
                // Yes.
                $output[] = mb_substr($text, $currentpos, $codepos - $currentpos); // The markup to the next 'code' tag.
                $currentpos = $codepos;
            } else {
                // No.
                $rest = mb_substr($text, $currentpos); // The rest of the markup.
                if (!empty($rest)) {
                    $output[] = $rest;
                }
            }
        }

        if ($broken) {
            return false;
        }
        return implode($output);
    }

    /**
     * Highlights the page using the current values.
     * @param array $config Highlighter config.
     */
    public function highlight_page($config) {
        if (!empty($config->engine)) {
            global $PAGE;

            $enginemethod = $config->engine . '_init';
            $init = $this->$enginemethod($config);

            $data = ['data' => []];
            $data['data']['thecss'] = $init->thecss->out();
            $data['data']['thejs'] = $init->thejs->out();
            if (!empty($init->theinit)) {
                $data['data']['theinit'] = $init->theinit;
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
        $data = new stdClass();

        $config = get_config('filter_synhi');
        if (!empty($config->engine)) {
            $enginemethod = $config->engine . '_init';

            // Note: To allow the iframe in the setting_highlight_example template to work, htmlentities is used.
            $data = $this->$enginemethod($config);
            $synpos = strpos($config->codeexample, '<code');
            $broken = false;
            if ($synpos !== false) {
                $markup = $this->processtext($config->codeexample, $synpos);
                if ($markup !== false) {
                    $data->code = htmlentities($markup, ENT_COMPAT);
                    $data->synhicss = new moodle_url(self::SYNHISTYLES);
                } else {
                    $broken = true;
                }
            } else {
                $broken = true;
            }
            if ($broken) {
                global $OUTPUT;
                $context = new stdClass();
                $context->text = htmlentities($config->codeexample, ENT_COMPAT);
                $data->broken = $OUTPUT->render_from_template('filter_synhi/broken_markup', $context);
            }
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

            $enginemethod = $engine . '_init';
            $config = new stdClass();
            $config->enlighterjsstyle = $style;
            $config->syntaxhighlighterstyle = $style;
            $config->codeexample = get_config('filter_synhi', 'codeexample');

            $context = $this->$enginemethod($config);
            $synpos = strpos($config->codeexample, '<code');
            if ($synpos !== false) {
                $context->code = htmlentities($this->processtext($config->codeexample, $synpos), ENT_COMPAT);
                $context->synhicss = new moodle_url(self::SYNHISTYLES);
            } else {
                global $OUTPUT;
                $context = new stdClass();
                $context->text = htmlentities($config->codeexample, ENT_COMPAT);
                $context->code = $OUTPUT->render_from_template('filter_synhi/broken_markup', $context);
            }

            $PAGE->set_context(\context_system::instance());
            $markup = $OUTPUT->render_from_template('filter_synhi/setting_highlight_example', $context);
        } else {
            $markup = '<p id="setting_highlight_example_frame">';
            $markup .= 'Invalid parameters passed to \'setting_highlight_example(\'' . $engine . '\', \'' . $style . '\')\'</p>';
        }

        return $markup;
    }

    /**
     * EnlighterJS files.
     *
     * @param stdClass $config Filter config
     *
     * @return stdClass CSS & JS file moodle_url's, and any initialisation JS in a string.
     */
    private function enlighterjs_init($config) {
        $data = new stdClass();
        $data->thejs = new moodle_url(self::ENLIGHTERJSJS);
        $data->thecss = new moodle_url(self::ENLIGHTERJSCSSPRE . $config->enlighterjsstyle . self::ENLIGHTERJSCSSPOST);
        $data->theinit = "EnlighterJS.init('pre code', 'code', {theme: '" .
            $config->enlighterjsstyle . "', indent : 4, collapse: true});";

        return $data;
    }

    /**
     * Syntax Highlighter files.
     *
     * @param stdClass $config Filter config
     *
     * @return stdClass CSS & JS file moodle_url's, and any initialisation JS in a string.
     */
    private function syntaxhighlighter_init($config) {
        $data = new stdClass();
        $data->thejs = new moodle_url(self::SYNTAXHIGHLIGHTERJS);
        $data->thecss = new moodle_url(self::SYNTAXHIGHLIGHTERCSSPRE .
            $config->syntaxhighlighterstyle . self::SYNTAXHIGHLIGHTERCSSPOST);

        return $data;
    }
}
