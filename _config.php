<?php
/**
 * @author nicolaas [at] www.sunnysideup.co.nz
 **/


if (defined("use_testmailer")) {
    Email::set_mailer(new TestMailerToFile);
}
