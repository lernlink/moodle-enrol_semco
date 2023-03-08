moodle-enrol_semco
==================

[![Moodle Plugin CI](https://github.com/lernlink/moodle-enrol_semco/workflows/Moodle%20Plugin%20CI/badge.svg?branch=master)](https://github.com/lernlink/moodle-enrol_semco/actions?query=workflow%3A%22Moodle+Plugin+CI%22+branch%3Amaster)

Moodle enrolment plugin which allows the SEMCO seminar management system to enrol and manage users in Moodle courses


Requirements
------------

This plugin requires Moodle 4.0+


Motivation for this plugin
--------------------------

[The motivation to write this plugin]


Installation
------------

Install the plugin like any other plugin to folder
/enrol/semco

See http://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins


Usage & Settings
----------------

During the installation, several steps to enable the webservice communication from SEMCO to Moodle are done automatically to save you time and headaches:

* The webservice subsystem is enabled if it is not enabled yet.\
  You can verify this on /admin/settings.php?section=externalservices.
* The webservice REST protocol is enabled if it is not enabled yet.\
  You can verify this on /admin/settings.php?section=webserviceprotocols.
* The 'Webservice' authentication method is enabled automatically.\
  You can verify this on /admin/settings.php?section=manageauths.
* A 'SEMCO webservice' system role is created automatically.\
  You can verify this on /admin/roles/manage.php.
* The following capabilities are automatically added as allowed to the 'SEMCO webservice' role.\
  You can verify them on /admin/roles/manage.php:
  * enrol/semco:usewebservice
  * enrol/semco:enrol
  * enrol/semco:unenrol
  * enrol/semco:editenrolment
  * enrol/semco:getenrolments
  * moodle/role:assign
  * moodle/course:useremail
  * moodle/course:view
  * moodle/user:create
  * moodle/user:delete
  * moodle/user:update
  * moodle/user:viewdetails
  * moodle/user:viewhiddendetails
  * webservice/rest:use
* The 'SEMCO webservice' is automatically allowed to assign the 'student' role.\
  You can verify this on /admin/roles/allow.php?mode=assign.
* A 'SEMCO webservice' user is created automatically.\
  You can verify this on /admin/user.php.
* The 'SEMCO webservice' user is added automatically to the 'SEMCO webservice' system role.\
  You can verify this on /admin/roles/assign.php?contextid=1
* A webservice token is created automatically for the 'SEMCO webservice' user.\
  You can verify this on /admin/webservice/tokens.php.
  It is correct that you will not see the token there, you will just see _that_ a token exists.
* A 'SEMCO' user profile field category is created automatically and a 'SEMCO User ID' field is added to this category.\
  You can verify this on /user/profile/index.php.
* The enrol_semco plugin is activated automatically.\
  You can verify this on /admin/settings.php?section=manageenrols.

Each step is monitored with a clear success message in the installation wizard (in the web GUI as well as in the CLI). Watch out for any error messages during the installation of the plugin. If you see any error messages, please try to uninstall the plugin and re-install it again. If the erorr messages continue to be posted, please step through the list above and check if you can spot any asset which could block the automatic installation.

After installing the plugin and after the automatic configurtion, it is ready to use with SEMCO.

To configure the plugin and its behaviour, please visit:
Site administration -> Plugins -> Enrolments -> Semco

There, you find two sections:

### 1. Connection information

In this section, you will find the Moodle base URL and the webservice token which was automatically created during the plugin installation. Please use this data to configure the Moodle connection in SEMCO.

### 2. Enrolment process

In this section, you control with which role SEMCO enrols users into courses. The configured role is mandatory for all users who are enrolled from SEMCO and cannot be overridden with the SEMCO enrolment webservice endpoint.


Capabilities
------------

This plugin also introduces these additional capabilities:

### enrol/semco:usewebservice

This capability controls the ability to control Moodle enrolments via the SEMCO enrolment webservice.

### enrol/semco:enrol

This capability controls the ability to enrol a SEMCO user into a course.

### enrol/semco:unenrol

This capability controls the ability to unenrol a SEMCO user from a course.

### enrol/semco:editenrolment

This capability controls the ability to edit an existing SEMCO user enrolment in a course.

### enrol/semco:getenrolments

This capability controls the ability to get the existing SEMCO user enrolments in a course.

### Please note

By default, these capabilities are not allowed to any role archetype as they should just be used by a webservice.
They will be automatically assigned to the 'SEMCO webservice' role during the plugin installation.


How this plugin works [ / Pitfalls]
-----------------------------------

[How it works]


Backup & Restore
----------------

This enrolment plugin does not support backup & restore of courses.
This is done by purpose as each particular course enrolment is mapped to a particular SEMCO booking ID which is a unique 1:1 mapping. If we would backup & restore course enrolments to duplicated / restored / imported courses, this constraint could not be guaranteed.


Theme support
-------------

This plugin is developed and tested on Moodle Core's Boost theme.
It should also work with Boost child themes, including Moodle Core's Classic theme. However, we can't support any other theme than Boost.


Plugin repositories
-------------------

This plugin is published and regularly updated in the Moodle plugins repository:
http://moodle.org/plugins/view/enrol_semco

The latest development version can be found on Github:
https://github.com/lernlink/moodle-enrol_semco


Bug and problem reports
-----------------------

This plugin is carefully developed and thoroughly tested, but bugs and problems can always appear.

Please report bugs and problems on Github:
https://github.com/lernlink/moodle-enrol_semco/issues


Community feature proposals
---------------------------

The functionality of this plugin is primarily implemented for the needs of our clients and published as-is to the community. We are aware that members of the community will have other needs and would love to see them solved by this plugin.

Please issue feature proposals on Github:
https://github.com/lernlink/moodle-enrol_semco/issues

Please create pull requests on Github:
https://github.com/lernlink/moodle-enrol_semco/pulls


Paid support
------------

We are always interested to read about your issues and feature proposals or even get a pull request from you on Github. However, please note that our time for working on community Github issues is limited.

As certified Moodle Partner, we also offer paid support for this plugin. If you are interested, please have a look at our services on https://lern.link or get in touch with us directly via team@lernlink.de.


Moodle release support
----------------------

This plugin is only maintained for the most recent major release of Moodle as well as the most recent LTS release of Moodle. Bugfixes are backported to the LTS release. However, new features and improvements are not necessarily backported to the LTS release.

Apart from these maintained releases, previous versions of this plugin which work in legacy major releases of Moodle are still available as-is without any further updates in the Moodle Plugins repository.

There may be several weeks after a new major release of Moodle has been published until we can do a compatibility check and fix problems if necessary. If you encounter problems with a new major release of Moodle - or can confirm that this plugin still works with a new major release - please let us know on Github.

If you are running a legacy version of Moodle, but want or need to run the latest version of this plugin, you can get the latest version of the plugin, remove the line starting with $plugin->requires from version.php and use this latest plugin version then on your legacy Moodle. However, please note that you will run this setup completely at your own risk. We can't support this approach in any way and there is an undeniable risk for erratic behavior.


Translating this plugin
-----------------------

This Moodle plugin is shipped with an english language pack only. All translations into other languages must be managed through AMOS (https://lang.moodle.org) by what they will become part of Moodle's official language pack.

As the plugin creator, we manage the translation into german for our own local needs on AMOS. Please contribute your translation into all other languages in AMOS where they will be reviewed by the official language pack maintainers for Moodle.


Right-to-left support
---------------------

This plugin has not been tested with Moodle's support for right-to-left (RTL) languages.
If you want to use this plugin with a RTL language and it doesn't work as-is, you are free to send us a pull request on Github with modifications.


Maintainers
-----------

lern.link GmbH\
Alexander Bias


Copyright
---------

lern.link GmbH\
Alexander Bias
