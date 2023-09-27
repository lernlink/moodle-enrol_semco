moodle-enrol_semco
==================

Changes
-------

### Unreleased

* 2023-09-27 - Improvement: Add a scheduled task which cleans up orphaned SEMCO enrolment instances which were not removed when a user was deleted (as SEMCO enrolment instances are only properly removed when a user is unenrolled via webservice).
* 2023-09-26 - Feature: The new webservice enrol_semco_get_course_completions will return the course completions for given SEMCO user enrolments.
* 2023-09-26 - Bugfix: The webservice enrol_semco_edit_enrolment didn't process enrolment period changes with given timeend dates but without given timestart dates.
* 2023-09-26 - Improvement: The webservices enrol_semco_enrol_user and enrol_semco_edit_enrolment won't accept timeend values which are smaller than the timestart value anymore.
* 2023-09-26 - Improvement: The webservices enrol_semco_enrol_user and enrol_semco_edit_enrolment will now return an error if a user should get enrolled into the same course multiple times with overlapping enrolment periods.
* 2023-09-26 - Improvement: The Webservice enrol_semco_get_enrolments will only return SEMCO enrolment instances from now on (instead of all enrolments).
* 2023-09-26 - Make codechecker happy again
* 2023-09-26 - Updated Moodle Plugin CI to latest upstream recommendations

### v4.1-r1

* 2023-08-02 - Tests: Updated Moodle Plugin CI to use PHP 8.1 and Postgres 13 from Moodle 4.1 on.
* 2023-08-02 - Prepare compatibility for Moodle 4.1.

### v4.0-r1

* 2022-12-01 - Initial version.
