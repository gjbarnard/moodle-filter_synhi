Version Information
===================

Version 500.1.0 - 21/04/2025
----------------------------
1. M5.0 compatibility.

Version 402.1.1 - 24/10/2024
----------------------------
1. M4.5 compatibility - https://moodledev.io/docs/4.5/devupdate#filter-plugins
2. M4.4 compatibility in M4.5 - MDL-82427 core: Update namespace of core_filters classes.
3. Fix example not showing.

Version 402.1.0 - 22/04/24
--------------------------
1. Improve settings UI.
2. Minimal version is now M4.2 - due to changes in core external API and to make use of tabs for settings.

Version 39.1.2 - 08/10/23
--------------------------
1. Add missing 'pluginname' from language file.

Version 39.1.1 - 09/04/23
--------------------------
1. Fix 'non latin characters before the code block break highlighting' - #12.
2. Fix 'Less than and greater than symbols not rendering correctly'.

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
