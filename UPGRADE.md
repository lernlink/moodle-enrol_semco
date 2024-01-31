Upgrading this plugin
=====================

This is an internal documentation for plugin developers with some notes what has to be considered when updating this plugin to a new Moodle major version.

General
-------

* Generally, this is a quite simple plugin with just one purpose.
* It does not rely on any fluctuating library functions and should remain quite stable between Moodle major versions.
* Thus, the upgrading effort is low.


Upstream changes
----------------

* This plugin does not inherit or copy anything from upstream sources.


Automated tests
---------------

* Due to the fact that the plugin mainly offers webservice endpoints to an external application, there aren't any automated test (yet).

Manual tests
------------

* Manual tests are carried out by SEMCO staff.
