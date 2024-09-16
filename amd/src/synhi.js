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
 * @module     filter_synhi/synhi
 * @copyright  &copy; 2020-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

import $ from 'jquery';
import log from 'core/log';

var done = false;

/**
 * Init.
 *
 * @param {array} data The urls to use.
 */
export const init = (data) => {
    log.debug('SynHi ES6 init');
    if (!done) {
        var $body = $('body');
        $body.append('<script type="text/javascript" charset="utf-8" src="' + data.thejs + '"></script>');
        if (data.theinit) {
            $body.append('<script type="text/javascript" charset="utf-8">' + data.theinit + '</script>');
        }
        $('head').append('<link rel="stylesheet" type="text/css" href="' + data.thecss + '">');

        done = true;
    }
};
