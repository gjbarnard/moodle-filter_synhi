Version Information
===================
Version 39.1.0 - 01/04/23
--------------------------
1. Changed to semantic versioning 2.0.0 (https://semver.org/) for the release value, whereby the 'major' number is the minimum Moodle
   core branch number.  The 'version' property still needs to follow the Moodle way in order for the plugin to operate within the core
   API.
2. Update EnlighterJS from 3.4.0 to 3.6.0.
3. Minify Syntaxhighlighter with 'uglifyjs syntaxhighlighter.js -c -o syntaxhighlighter.min.js'.

Version 3.7.1.2 - 22/05/21
--------------------------
1. Fix 'The EnlighterJS engine turns inline elements to block elements', thanks to
   Tyson Whitehead (https://github.com/twhitehead) for the patch - #2 & #3.

Version 3.7.1.1 - 23/01/21
--------------------------
1. Don't highlight MathJax / Tex -> https://docs.moodle.org/310/en/MathJax_filter.

Version 3.7.1   - 08/11/20
--------------------------
1. Stable release.
2. Add screenshots to Readme.md.
3. Tidy code.
4. Add information settings.
5. Tested on M3.10.

Version 3.7.0.3 - 15/09/20
--------------------------
1. Fix 'missing thirdpartylibs.xml' - #1.

Version 3.7.0.2 - 03/09/20
--------------------------
1. EnlighterJS has no 'default' style.

Version 3.7.0.1 - 02/09/20
--------------------------
1. Initial version.
