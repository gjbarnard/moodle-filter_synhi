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

// @codeCoverageIgnoreStart

/**
 * SynHi filter.
 *
 * @package    filter_synhi
 * @copyright  &copy; 2020-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

namespace filter_synhi;
use filter_synhi\privacy\provider;

/**
 * Privacy unit tests for the SynHi filter.
 *
 * @group filter_synhi
 * @copyright  &copy; 2020-onwards G J Barnard.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
final class privacy_provider_test extends \core_privacy\tests\provider_testcase {
    /**
     * Set up.
     */
    protected function set_up() {
        $this->resetAfterTest(true);
    }

    /**
     * Ensure that get_reason gives a reason.
     */
    public function test_get_reason(): void {
        $this->set_up();
        $result = provider::get_reason();
        $this->assertSame('privacy:nop', $result);
    }
}
// @codeCoverageIgnoreEnd
