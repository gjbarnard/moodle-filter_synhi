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
 * @copyright  &copy; 2023-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

namespace filter_synhi;

use moodle_url;

/**
 * Setting that displays markdown files.  Based on admin_setting_description in adminlib.php.
 *
 * @copyright  &copy; 2022-onwards G J Barnard.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class admin_setting_markdown extends \admin_setting {
    /**
     * Filename.
     *
     * @var string
     */
    private $filename;

    /**
     * Plugin path.
     *
     * @var string
     */
    private $pluginpath;

    /**
     * Not a setting, just markup.
     *
     * @param string $name Setting name.
     * @param string $visiblename Setting name on the device.
     * @param string $description Setting description on the device.
     * @param string $filename The file to show.
     * @param string $pluginpath The plugin's path, without opening or closing slashes.
     */
    public function __construct($name, $visiblename, $description, $filename, $pluginpath) {
        $this->nosave = true;
        $this->filename = $filename;
        $this->pluginpath = $pluginpath;
        parent::__construct($name, $visiblename, $description, '');
    }

    /**
     * Always returns true.
     *
     * @return bool Always returns true.
     */
    public function get_setting() {
        return true;
    }

    /**
     * Always returns true.
     *
     * @return bool Always returns true.
     */
    public function get_defaultsetting() {
        return true;
    }

    /**
     * Never write settings
     *
     * @param mixed $data Gets converted to str for comparison against yes value.
     * @return string Always returns an empty string.
     */
    public function write_setting($data) {
        // Do not write any setting.
        return '';
    }

    /**
     * Returns an HTML string
     *
     * @param string $data
     * @param string $query
     * @return string Returns an HTML string
     */
    public function output_html($data, $query = '') {
        global $CFG, $OUTPUT;

        $context = new \stdClass();
        $context->title = $this->visiblename;
        $context->description = $this->description;

        if (file_exists("{$CFG->dirroot}/{$this->pluginpath}/{$this->filename}")) {
            $filecontents = file_get_contents($CFG->dirroot . '/' . $this->pluginpath . '/' . $this->filename);
        } else {
            $filecontents = 'SynHi filter admin_setting_markdown -> file not found: ' . $this->filename;
        }

        if ($filecontents === '' || $filecontents === null) {
            $context->markdown = '';
        } else {
            $context->markdown = $this->markdown_to_html($filecontents);
        }

        return $OUTPUT->render_from_template('filter_synhi/synhi_admin_setting_markdown', $context);
    }

    /**
     * Returns an HTML string from the supplied markdown.
     * Replaces 'format_text($text, FORMAT_MARKDOWN)' call in order to process relative url's.
     * Ref: https://michelf.ca/projects/php-markdown/configuration/
     *
     * @param string $markdown The markdown.
     * @return string Returns an HTML string
     */
    private function markdown_to_html($markdown) {
        global $CFG;

        require_once($CFG->libdir . '/markdown/Michelf/MarkdownInterface.php');
        require_once($CFG->libdir . '/markdown/Michelf/Markdown.php');
        require_once($CFG->libdir . '/markdown/Michelf/MarkdownExtra.php');

        $parser = new \Michelf\MarkdownExtra();
        $parser->url_filter_func = function ($url) {
            if (strpos($url, '://') == false) {
                // Relative url.
                $hasslash = '/';
                if ($url[0] == '/') {
                    $hasslash = '';
                }
                $murl = new moodle_url('/' . $this->pluginpath . $hasslash . $url);
                $url = $murl->out(true);
            }
            return $url;
        };

        return format_text($parser->transform($markdown), FORMAT_HTML);
    }
}
