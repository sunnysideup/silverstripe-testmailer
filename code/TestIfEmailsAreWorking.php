<?php

/**
 *@author nicolaas [at] sunnysideup .co .nz
 *
 *
 **/


class TestIfEmailsAreWorking extends Controller {

	function index($request) {
		if(!Permission::check("ADMIN")) {
			return Security::permissionFailure($this);
		}
		$email = $request->requestVar($name = "email");
		if(!$email && !Email::validEmailAddress($email)) {
			user_error("make sure to add a valid email - current one is '".$email."' (you can add the email like this: ".$request->getURL()."?email=myemail@test.com", E_USER_WARNING);
		}
		else {
			$number = rand(0, 10000);
			$from = Email::getAdminEmail();
			$to = $email;
			$subject = "test mail ID".$number;
			$body = "test mail ID".$number;
			$htmlBody = "<h1>test mail ID".$number.'</h1>';
			$basicMailOk = @mail($email, $subject, $body);
			if($basicMailOk) {
				debug::show("basic mail has been sent with ID".$number);
			}
			else {
				debug::show("basic mail has * NOT * been sent with ID".$number);
			}
			$e = new Email($from, $to, $subject, $body);
			$e->send();
			debug::show("standard email has been sent with ID".$number);
			//OR
			$e->sendPlain();
			debug::show("plain text email has been sent with ID".$number);
		}
	}

}
