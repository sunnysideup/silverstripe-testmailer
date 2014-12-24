Test Mailer
================================================================================

Developer
-----------------------------------------------
Nicolaas Francken [at] sunnysideup.co.nz

Requirements
-----------------------------------------------
SilverStripe 2.3.2 or greater.

Documentation
-----------------------------------------------

Adds a test mailer for your localhost environment.

This can be useful in case your localhost SMTP server
is not available.

It also contains a class to test if your emails are working.
This class can be used like this:

http://www.mysite.co.nz/testifemailsareworking/?email=a@b.c

Installation Instructions
-----------------------------------------------
1. Find out how to add modules to SS and add module as per usual.

2. to turn on the test mailer, add the following to your _ss_environment.php file:

   define('use_testmailer', true);
