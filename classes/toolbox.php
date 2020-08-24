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

defined('MOODLE_INTERNAL') || die();

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

    public function highlight_page() {
        global $PAGE;
        $config = get_config('filter_synhi');

        if (!empty($config->engine)) {
            $enginemethod = $config->engine.'_init';
            $init = $this->$enginemethod($config);

            $data = array('data' => array());
            $data['data']['thecss'] = $init['thecss']->out();
            $data['data']['thejs'] = $init['thejs']->out();
            if (!empty($init['theinit'])) {
                $data['data']['theinit'] = $init['theinit'];
            }
error_log(print_r($data, true));
            $PAGE->requires->js_call_amd('filter_synhi/synhi', 'init', $data);
        }
    }

    public function setting_highlight_example() {
        $initdata = array();

        $config = get_config('filter_synhi');
        if (!empty($config->engine)) {
            $enginemethod = $config->engine.'_init';
            $initdata = $this->$enginemethod($config);
        }

        return $initdata;
    }

    /**
     * EnlighterJS files.
     *
     * @param stdClass $config Filter config
     *
     * @return array CSS & JS file moodle_url's, and any initialisation JS in a string.
     */
    private function enlighterjs_init($config) {
        $js = new moodle_url('/filter/synhi/javascript/EnlighterJS_3_4_0/scripts/enlighterjs.min.js');
        $css = new moodle_url(
            '/filter/synhi/javascript/EnlighterJS_3_4_0/styles/enlighterjs.'.$config->enlighterjsstyle.'.min.css');

        return array(
            'thejs' => $js,
            'thecss' => $css,
            'theinit' => "EnlighterJS.init('pre', 'code', {
                theme: '".$config->enlighterjsstyle."',
                indent : 4
            });"
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
        $js = new moodle_url('/filter/synhi/javascript/syntaxhighlighter_4_0_1/scripts/syntaxhighlighter.js');
        $css = new moodle_url('/filter/synhi/javascript/syntaxhighlighter_4_0_1/styles/'.$config->syntaxhighlighterstyle.'.css');

        return array(
            'thejs' => $js,
            'thecss' => $css
        );
    }
}
