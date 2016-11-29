<?php

/**
 *@author nicolaas [at] sunnysideup .co .nz
 *
 *
 **/


class TestIfEmailsAreWorking extends Controller
{
    public function index($request)
    {
        if (!Permission::check("ADMIN")) {
            return Security::permissionFailure($this);
        }
        $email = $request->requestVar($name = "email");
        if ($email && Email::validEmailAddress($email)) {
            $number = rand(0, 10000);
            $from = Email::getAdminEmail();
            $to = $email;
            $subject = "test mail ID".$number;
            $body = "test mail ID".$number;
            $htmlBody = "<h1>test mail ID".$number.'</h1>';
            $basicMailOk = @mail($email, $subject, $body);
            if ($basicMailOk) {
                DB::alteration_message("basic mail (using the PHP mail function)  has been sent with ID: ".$number, "created");
            } else {
                DB::alteration_message("basic mail (using the PHP mail function) has * NOT * been sent with ID:".$number, "deleted");
            }
            $e = new Email($from, $to, $subject, $body);
            if ($e->send()) {
                DB::alteration_message("standard Silverstripe email has been sent with ID: ".$number, "created");
            } else {
                DB::alteration_message("standard Silverstripe email ***NOT*** has been sent with ID: ".$number, "deleted");
            }
            //OR
            $e = new Email($from, $to, $subject, $body);
            if ($e->sendPlain()) {
                DB::alteration_message("plain text Silverstripe  email has been sent with ID: ".$number, "created");
            } else {
                DB::alteration_message("plain text Silverstripe email has ***NOT*** been sent with ID: ".$number, "deleted");
            }
        } else {
            user_error("make sure to add a valid email - current one is '".$email."' (you can add the email like this: ".$request->getURL()."?email=myemail@test.com", E_USER_WARNING);
        }
    }
}
