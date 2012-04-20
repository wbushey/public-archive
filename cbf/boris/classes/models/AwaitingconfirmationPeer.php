<?php

require 'models/om/BaseAwaitingconfirmationPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'awaitingConfirmation' table.
 *
 * New users who have not yet confirmed their accounts
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    models
 */
class AwaitingconfirmationPeer extends BaseAwaitingconfirmationPeer {

	public static function send_confirmation_email(Awaitingconfirmation $conf){
	$link = boris_View::get_controller_url()."/login/addUser?id={$conf->getId()}&cn={$conf->getConfirmnum()}";
	$emailBody = <<< END_OF_EMAIL
Hello from Celebrity Bar Fight<br/>
<br/>
    This email has been sent because you have registered at {$_SERVER['HTTP_HOST']}. To confirm your registration please click on the following link:<br/>
    <a href="$link">Confirm Registration</a><br/>
<br/>
    If the above link does not work, please copy and paste the following address into your browser's address bar:<br/>
    $link<br/>
<br/>
-www.celebritybarfight.com<br/>
END_OF_EMAIL;


	// Send the email
	$headers = 'From: confirm@celebritybarfight.com' . "\r\n" .
			'Content-Type: text/html; charset=iso-8859-1';
	mail($conf->getAwaitingprofiles()->getEmailaddress(), "Celebrity Bar Fight Registration", $emailBody, $headers);
	}
	
} // AwaitingconfirmationPeer
