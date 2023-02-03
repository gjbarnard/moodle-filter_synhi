/**
 * Gruntfile for the SynHi filter.
 *
 * This file configures tasks to be run by Grunt
 * http://gruntjs.com/ for the current theme.
 *
 *
 * Requirements:
 * -------------
 * nodejs, npm, grunt-cli.
 *
 * Installation:
 * -------------
 * node and npm: instructions at http://nodejs.org/
 *
 * grunt-cli: `[sudo] npm install -g grunt-cli`
 *
 * node dependencies: run `npm install` in the root directory.
 *
 *
 * Usage:
 * ------
 * Call tasks from the theme root directory. Default behaviour
 * (calling only `grunt`) is to run the watch task detailed below.
 *
 *
 * Porcelain tasks:
 * ----------------
 * The nice user interface intended for everyday use. Provide a
 * high level of automation and convenience for specific use-cases.
 *
 * grunt amd     Create the Asynchronous Module Definition JavaScript files.  See: MDL-49046.
 *               Done here as core Gruntfile.js currently *nix only.
 *
 * @package filter_synhi.
 * @copyright  © 2020-onwards G J Barnard.
 * @author G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @author Based on code originally written by Andrew Nicols, Joby Harding, Bas Brands, David Scotson and many other contributors.
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

module.exports = function(grunt) { // jshint ignore:line
    var path = require('path'),
        cwd = process.env.PWD || process.cwd(), // jshint ignore:line
        semver = require('semver');

    // Verify the node version is new enough.
    var expected = semver.validRange(grunt.file.readJSON('package.json').engines.node);
    var actual = semver.valid(process.version); // jshint ignore:line
    if (!semver.satisfies(actual, expected)) {
        grunt.fail.fatal('Node version too old. Require ' + expected + ', version installed: ' + actual);
    }

    // PHP strings for exec task.
    var moodleroot = path.dirname(path.dirname(__dirname)), // jshint ignore:line
        dirrootopt = grunt.option('dirroot') || process.env.MOODLE_DIR || ''; // jshint ignore:line

    // Allow user to explicitly define Moodle root dir.
    if ('' !== dirrootopt) {
        moodleroot = path.resolve(dirrootopt);
    }

    var configfile = path.join(moodleroot, 'config.php');

    var decachephp = 'define(\'CLI_SCRIPT\', true);';
    decachephp += 'require(\'' + configfile + '\');';
    decachephp += 'purge_all_caches();';

    // Project configuration.
    grunt.initConfig({
        exec: {
            decache: {
                cmd: 'php -r "' + decachephp + '"',
                callback: function(error) {
                    // The 'exec' process will output error messages, just add one to confirm success.
                    if (!error) {
                        grunt.log.writeln("Moodle cache reset.");
                    }
                }
            }
        },
        jshint: {
            options: {jshintrc: moodleroot + '/.jshintrc'},
            files: ['**/amd/src/*.js']
        },
        uglify: {
            dynamic_mappings: {
                files: grunt.file.expandMapping(
                    ['**/src/*.js', '!**/node_modules/**'],
                    '',
                    {
                        cwd: cwd,
                        rename: function(destBase, destPath) {
                            destPath = destPath.replace('src', 'build');
                            destPath = destPath.replace('.js', '.min.js');
                            destPath = path.resolve(cwd, destPath);
                            return destPath;
                        }
                    }
                )
            }
        }
    });

    // Register tasks.
    grunt.loadNpmTasks("grunt-exec");
    grunt.registerTask("decache", ["exec:decache"]);

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.registerTask("amd", ["jshint", "uglify", "decache"]);

    // Register the default task.
    grunt.registerTask('default', ['amd']);
};
