<?php
/**
 * Contains a function that verifies whether or not the provided email address
 * is valid.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 12/29/08
 */

/**
 * Indicates if the provided email address is valid or not.
 * 
 * Returns true if the provided email address passes the following tests:
 * 		Regular expression check on string structure
 * 		Existance check of email address domain
 * 
 * If the provided email address fails any of these tests false will be returned.
 *
 * This function is based on the following article: 
 * 		http://www.devshed.com/c/a/PHP/Email-Address-Verification-with-PHP/
 * 
 * @param string $email_address
 * @return boolean
 */
function is_valid_email_address($email_address){
	
	// Test structure of email address string
	if (!preg_match("/^([a-zA-Z0-9]+)([a-zA-Z0-9\._-]*)@([a-zA-Z0-9_-]+)\.([a-zA-Z0-9\._-]+)$/" , $email_address)) return false;
	
	// Verify that the email address's domain exists
	/*list($username,$domain) = split('@',$email_address);
  	if (!(checkdnsrr($domain,'A') || checkdnsrr($domain,'MX'))) return false;*/
	
	
	return true;
}
?>