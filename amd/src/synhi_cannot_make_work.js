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

//import $ from 'jquery';
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
        const body = document.getElementsByTagName('body').item(0);
        let thejs = document.createElement("script");
        thejs.src = data.thejs;
        thejs.type = 'text/javascript';
        thejs.charset = 'utf-8';
        thejs.defer = false;
        body.appendChild(thejs);
        //$body.append('<script type="text/javascript" charset="utf-8" src="' + data.thejs + '"></script>');
        if (data.theinit) {
            let theinit = document.createElement("script");
            theinit.text = data.theinit;
            theinit.type = 'text/javascript';
            theinit.charset = 'utf-8';
            theinit.defer = true;
            if (document.readyState !== 'loading') {
                log.debug("SynHi ES6 init DOM content already loaded");
                body.appendChild(theinit);
            } else {
                log.debug("SynHi ES6 init JS DOM content not loaded");
                document.addEventListener('DOMContentLoaded', function () {
                    log.debug("SynHi ES6 init JS DOM content loaded");
                    body.appendChild(theinit);  // E.g. Enlighter not found, so code runs before JS file is known about.
                });
            }
            //$body.append('<script type="text/javascript" charset="utf-8">' + data.theinit + '</script>');
        }
        let thecss = document.createElement("link");
        thecss.href = data.thecss;
        thecss.type = 'text/css';
        thecss.rel = 'stylesheet';
        document.getElementsByTagName('head').item(0).appendChild(thecss);
        //$('head').append('<link rel="stylesheet" type="text/css" href="' + data.thecss + '">');

        done = true;
    }
};
