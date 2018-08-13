<?php

	// load in mailchimp library
	include('./MailChimp.php');
	
	// namespace defined in MailChimp.php
	use \DrewM\MailChimp\MailChimp;
	
	// connect to mailchimp
	$MailChimp = new MailChimp('288d0de53366129c478570b0ee9c861e-us19'); // put your API key here
	$list = '27e8e26b5e'; // put your list ID here
	$email = $_GET['EMAIL']; // Get email address from form
	$id = md5(strtolower($email)); // Encrypt the email address
	// setup th merge fields
	$mergeFields = array(
        'FNAME'=>$_GET['FNAME'],
        'MMERGE6' => $_GET['MMERGE6'],
        'MMERGE7' => $_GET['MMERGE7'],
		);

	// remove empty merge fields
	$mergeFields = array_filter($mergeFields);

	$result = $MailChimp->put("lists/$list/members/$id", array(
									'email_address'     => $email,
									'status'            => 'subscribed',
									'merge_fields'      => $mergeFields,
									'update_existing'   => true, // YES, update old subscribers!
							));
	echo json_encode($result);