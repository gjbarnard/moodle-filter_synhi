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

use core_plugin_manager;

/**
 * Setting that displays information.  Based on admin_setting_description in adminlib.php.
 *
 * @copyright  &copy; 2022-onwards G J Barnard.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class admin_setting_information extends \admin_setting {
    /**
     * @var int The minimum branch this is for.
     */
    protected $minbranch;

    /**
     * @var int The maximum branch this is for.
     */
    protected $maxbranch;

    /**
     * Not a setting, just information.
     *
     * @param string $name Setting name.
     * @param string $visiblename Setting name on the device.
     * @param string $description Setting description on the device.
     * @param string $minbranch The miniumum branch this is for.
     * @param string $maxbranch The maxmium branch this is for.
     */
    public function __construct($name, $visiblename, $description, $minbranch, $maxbranch) {
        $this->nosave = true;
        $this->minbranch = $minbranch;
        $this->maxbranch = $maxbranch;
        return parent::__construct($name, $visiblename, $description, '');
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

        $filter = core_plugin_manager::instance()->get_present_plugins('filter');
        if (!empty($filter['synhi'])) {
            $plugininfo = $filter['synhi'];
        } else {
            $plugininfo = core_plugin_manager::instance()->get_plugin_info('filter_synhi');
            $plugininfo->version = $plugininfo->versiondisk;
        }

        $classes[] = 'fa fa-heart';
        $attributes = [];
        $attributes['aria-hidden'] = 'true';
        $attributes['class'] = 'fa fa-heart';
        $attributes['title'] = get_string('love', 'filter_synhi');
        $content = \html_writer::tag('span', $attributes['title'], ['class' => 'sr-only']);
        $content = \html_writer::tag('span', $content, $attributes);
        $context['versioninfo'] = get_string(
            'versioninfo',
            'filter_synhi',
            [
                'moodle' => $CFG->release,
                'release' => $plugininfo->release,
                'version' => $plugininfo->version,
                'love' => $content,
            ]
        );

        if (!empty($plugininfo->maturity)) {
            switch ($plugininfo->maturity) {
                case MATURITY_ALPHA:
                    $context['maturity'] = get_string('versionalpha', 'filter_synhi');
                    $context['maturityalert'] = 'danger';
                    break;
                case MATURITY_BETA:
                    $context['maturity'] = get_string('versionbeta', 'filter_synhi');
                    $context['maturityalert'] = 'danger';
                    break;
                case MATURITY_RC:
                    $context['maturity'] = get_string('versionrc', 'filter_synhi');
                    $context['maturityalert'] = 'warning';
                    break;
                case MATURITY_STABLE:
                    $context['maturity'] = get_string('versionstable', 'filter_synhi');
                    $context['maturityalert'] = 'info';
                    break;
            }
        }

        if (($CFG->branch < $this->minbranch) || ($CFG->branch > $this->maxbranch)) {
            $context['versioncheck'] = 'Release ' . $plugininfo->release . ', version ' . $plugininfo->version;
            $context['versioncheck'] .= ' is incompatible with Moodle ' . $CFG->release;
            $context['versioncheck'] .= ', please get the correct version from ';
            $context['versioncheck'] .= '<a href="https://moodle.org/plugins/filter_synhi" target="_blank">Moodle.org</a>.  ';
            $context['versioncheck'] .= 'If none is available, then please consider supporting the format by funding it.  ';
            $context['versioncheck'] .= 'Please contact me via \'gjbarnard at gmail dot com\' or my ';
            $context['versioncheck'] .= '<a href="https://moodle.org/user/profile.php?id=442195">Moodle dot org profile</a>.  ';
            $context['versioncheck'] .= 'This is my <a href="http://about.me/gjbarnard">\'Web profile\'</a> if you want ';
            $context['versioncheck'] .= 'to know more about me.';
        }

        return $OUTPUT->render_from_template('filter_synhi/synhi_admin_setting_information', $context);
    }
}
