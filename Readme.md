Introduction
============

A syntax highlighter filter for Moodle with the choice of either EnlighterJS or SyntaxHighlighter
as the 'engine'.  The administrator has 'preview' settings to see what the look will be on example
code before the saving.

When active, content with a 'code' tag or 'pre code' tags within a course, module or block will be highlighted.
Specifically between the [Course and Block contexts](https://docs.moodle.org/39/en/Context).

Features
========
* Syntax Highlighting.

Screenshots
-----------

![Example](/pix/synhi_example.png "Example of code being highlighted")

![System administration](/pix/synhi_admin.png "The system admininstration screen")

![Highlight preview](/pix/synhi_admin_anim.gif "Previewing the engine and style before setting on the systems administration screen")

Usage
=====

Prior to version 39.1.0, the 'pre' tag was accepted on its own for code to be highlighted.  This proved problematic with the need
to have non-code preformatted but not highlighted.  To highlight code now, please use the 'code' tag, and surround with a 'pre' tag
to indicate a block of code.  With 'EnlighterJS', using a 'code' tag on its own indicates 'inline' code.  'SyntaxHighlighter' will
highlight the code in a block regardless of if there is an enclosing 'pre' tag.

Please add any configuration attributes to the 'code' tag.  Such as '[EnlighterJS - HTML Attribute Options (local)](https://github.com/EnlighterJS/documentation/blob/master/development/Options.md#html-attribute-options-local)' or for SyntaxHighlighter, please look at the information on the settings page.

For example
-----------

### Single line

`<code data-enlighter-language="java" class="brush: java">System.out.println("SynHi");</code>`

### Muiltiple lines

```
<pre><code data-enlighter-language="java" class="brush: java">
   package test;

   public class Test {
      private final String name = "Java program";

      public static void main (String args[]) {
         Test us = new Test();
         System.out.println(us.getName());
      }

      public String getName() {
         return name;
      }
   }
</code></pre>
```

Free Software
=============
The SynHi filter is 'free' software under the terms of the GNU GPLv3 License, please see 'COPYING.txt'.  It
contains third party 'highlighers' which are licensed differenty, see 'Highlighters'.

It can be obtained for free from:

- https://moodle.org/plugins/filter_synhi?lang=pl
- https://github.com/gjbarnard/moodle-filter_synhi/releases

You have all the rights granted to you by the GPLv3 license.  If you are unsure about anything, then the
FAQ - www.gnu.org/licenses/gpl-faq.html - is a good place to look.

If you reuse any of the code then I kindly ask that you make reference to the filter.

If you make improvements or bug fixes then I would appreciate if you would send them back to me by forking from
https://github.com/gjbarnard/moodle-filter_synhi and doing a 'Pull Request' so that the rest of the Moodle community
benefits.

Highlighters
------------
- EnlighterJS - https://github.com/EnlighterJS/EnlighterJS - Mozilla Public License 2.0 (MPL-2.0).
- SyntaxHighlighter - https://github.com/syntaxhighlighter/syntaxhighlighter - MIT licensed.

Support
=======
As SynHi is licensed under the GNU GPLv3 License it comes with NO support.  If you would like support from
me then I'm happy to provide it for a fee (please see my contact details above).  Otherwise, the
'[General plugins](https://moodle.org/mod/forum/view.php?id=44)' forum is an excellent place to ask questions.

Sponsorships
============
If you'd like to sponsor, get support or fund improvements, then please do get in touch via:

- gjbarnard | Gmail dt com address.
- My website eMail | contact at gjbarnard dt co dt uk.
- GitHub | Please outline your issue / improvement on '[GitHub](https://github.com/gjbarnard/moodle-filter_synhi/issues)'.

Required version of Moodle
==========================
This version works with:

 - Moodle 5.0 version 2025041400.00 (Build: 20250414) and above within the MOODLE_500_STABLE branch.

Installing Moodle links
-----------------------
Please ensure that your hardware and software complies with 'Requirements' in 'Installing Moodle' on:
 - [Moodle 5.0](https://docs.moodle.org/500/en/Installing_Moodle)

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
that you are operating the required version of Moodle as stated at the top - this is because the filter relies on core
functionality that is out of its control.

I operate a policy that I will fix all genuine issues for free.  Improvements are at my discretion.  I am happy to make bespoke
customisations / improvements for a negotiated fee.

It is essential that you provide as much information as possible, the critical information being the contents of the filter's
version.php file.  Other version information such as specific Moodle version, theme name and version also helps.  A screen shot
can be really useful in visualising the issue along with any files you consider to be relevant.

Report issues on: https://github.com/gjbarnard/moodle-filter_synhi/issues

Version Information
===================
See Changes.md

Refs
====

iframe resize: https://stackoverflow.com/questions/9975810/make-iframe-automatically-adjust-height-according-to-the-contents-without-using

Developed and maintained by
===========================
G J Barnard MSc. BSc(Hons)(Sndw). MBCS. CEng. CITP. PGCE.

- Moodle profile | [Moodle.org](https://moodle.org/user/profile.php?id=442195)
- Web profile    | [About.me](https://about.me/gjbarnard)
- Website        | [Website](https://gjbarnard.co.uk)
