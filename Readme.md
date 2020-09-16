Introduction
============
SynHi Filter.

A syntax highlighter filter for Moodle with the choice of either EnlighterJS or SyntaxHighlighter
as the 'engine'.  The administrator has 'preview' settings to see what the look will be on example
code before the saving.

When active, content with a 'pre' or 'code' tag within a course, module or block will be highlighted.
Specifically between the Course and Block contexts - https://docs.moodle.org/39/en/Context.

Features
========
* Syntax Highlighting.

Screenshots
-----------

![Example](/pix/synhi_example.png "Example of code being highlighted")

![System administration](/pix/synhi_admin.png "The system admininstration screen")

![Highlight preview](/pix/synhi_admin_anim.gif "Previewing the engine and style before setting on the systems administration screen")

About
=====
Copyright  &copy; 2020-onwards G J Barnard.
Author     G J Barnard - http://about.me/gjbarnard and http://moodle.org/user/profile.php?id=442195
License    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.  For Moodle plugin code only.

Developed and maintained by
===========================
G J Barnard MSc. BSc(Hons)(Sndw). MBCS. CEng. CITP. PGCE.
Moodle profile | http://moodle.org/user/profile.php?id=442195
Web profile | http://about.me/gjbarnard

Free Software
=============
The SynHi filter is 'free' software under the terms of the GNU GPLv3 License, please see 'LICENSE'.  It
contains third party 'highlighers' which are licensed differenty, see 'Highlighters'.

It can be obtained for free from:
https://github.com/gjb2048/moodle-filter_synhi/releases

You have all the rights granted to you by the GPLv3 license.  If you are unsure about anything, then the
FAQ - www.gnu.org/licenses/gpl-faq.html - is a good place to look.

If you reuse any of the code then I kindly ask that you make reference to the filter.

If you make improvements or bug fixes then I would appreciate if you would send them back to me by forking from
https://github.com/gjb2048/moodle-filter_synhi and doing a 'Pull Request' so that the rest of the Moodle community
benefits.

Highlighters
------------
EnlighterJS - https://github.com/EnlighterJS/EnlighterJS - Mozilla Public License 2.0 (MPL-2.0).
SyntaxHighlighter - https://github.com/syntaxhighlighter/syntaxhighlighter - MIT licensed.

Support
=======
As SynHi is licensed under the GNU GPLv3 License it comes with NO support.  If you would like support from
me then I'm happy to provide it for a fee (please see my contact details above).  Otherwise, the 'General plugins'
forum: moodle.org/mod/forum/view.php?id=44 is an excellent place to ask questions.

Sponsorships
============
This filter is provided to you for free, and if you want to express your gratitude for using this filter, please consider sponsoring
by:

PayPal - Please contact me via my 'Moodle profile' (above) for details as I am an individual and therefore am unable to have
'buy me now' buttons under their terms.

Sponsorships may allow me to provide you with more or better features in less time.

Required version of Moodle
==========================
This version works with:
 - Moodle 3.7 version 2019052000.00 (Build: 20190520) and above within the 3.7 branch.
 - Moodle 3.8 version 2019111800.00 (Build: 20191118) and above within the 3.8 branch.
 - Moodle 3.9 version 2020061500.00 (Build: 20200615) and above within the 3.9 branch.

Please ensure that your hardware and software complies with 'Requirements' in 'Installing Moodle' on
'docs.moodle.org/37/en/Installing_Moodle', 'docs.moodle.org/38/en/Installing_Moodle' or
'docs.moodle.org/39/en/Installing_Moodle' respectively.

Installation
============
 1. Ensure you have the version of Moodle as stated above in 'Required version of Moodle'.  This is essential as the
    filter relies on underlying core code that is out of my control.
 2. Login as an administrator and put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 3. Copy the extracted 'synhi' folder to the '/filter/' folder.
 4. Go to 'Site administration' -> 'Notifications' and follow standard the 'plugin' update notification.
 5. Put Moodle out of Maintenance Mode.

Upgrading
=========
 1. Ensure you have the version of Moodle as stated above in 'Required version of Moodle'.  This is essential as the
    filter relies on underlying core code that is out of my control.
 2. Login as an administrator and put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 3. Make a backup of your old 'synhi' folder in '/filter/' and then delete the folder.
 4. Copy the replacement extracted 'synhi' folder to the '/filter/' folder.
 5. Go to 'Site administration' -> 'Notifications' and follow standard the 'plugin' update notification.
 6. If automatic 'Purge all caches' appears not to work by lack of display etc. then perform a manual 'Purge all caches'
   under 'Home -> Site administration -> Development -> Purge all caches'.
 7. Put Moodle out of Maintenance Mode.

Uninstallation
==============
 1. Put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 2. Go to Site administration -> Plugins -> Filters -> Manage filters.
 3. Click on 'Uninstall' and follow the on screen instructions.
 4. Put Moodle out of Maintenance Mode.

Reporting Issues
================
Before reporting an issue, please ensure that you are running the current version for your release of Moodle.  It is essential
that you are operating the required version of Moodle as stated at the top - this is because the theme relies on core
functionality that is out of its control.

I operate a policy that I will fix all genuine issues for free.  Improvements are at my discretion.  I am happy to make bespoke
customisations / improvements for a negotiated fee.

It is essential that you provide as much information as possible, the critical information being the contents of the theme's
version.php file.  Other version information such as specific Moodle version, theme name and version also helps.  A screen shot
can be really useful in visualising the issue along with any files you consider to be relevant.

Report issues on: https://github.com/gjb2048/moodle-filter_synhi/issues

Version Information
===================
See Changes.md

Refs
====

iframe resize: https://stackoverflow.com/questions/9975810/make-iframe-automatically-adjust-height-according-to-the-contents-without-using

Me
==
G J Barnard MSc. BSc(Hons)(Sndw). MBCS. CEng. CITP. PGCE.
Moodle profile: http://moodle.org/user/profile.php?id=442195
Web profile   : http://about.me/gjbarnard
