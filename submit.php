<?php
/*
* Author: Greg London
* http://greglondon.info
*/

include 'config.php';

if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')
	exit(header('Location: '.URL.''));

session_start();

if(!empty($_POST)){

	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);

	$errors = array();

	if($name == '' || $name == 'Name')
		$errors['name'] = 'The name field is required!';
	else
		$errors['name'] = null;

	if($email == '' || $email == 'Email')
		$errors['email'] = 'The email field is required!';
	elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
		$errors['email'] = $email . ' is not a valid email address!';
	else
		$errors['email'] = null;

	if($phone == '' || $phone == 'Phone')
		$errors['phone'] = 'The phone field is required!';
	elseif(!preg_match('/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/', $phone))
		$errors['phone'] = $phone . ' is not a correctly formatted phone value!';
	else
		$errors['phone'] = null;

	
}

?>