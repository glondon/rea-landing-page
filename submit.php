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

	if(!is_null($errors['name']) || !is_null($errors['email']) || !is_null($errors['phone'])){

		$response['success'] = false;
		$response['nameError'] = $errors['name'];
		$response['emailError'] = $errors['email'];
		$response['phoneError'] = $errors['phone'];

		echo json_encode($response);
	}
	else {

		$response['success'] = true;
		$response['message'] = '<div class="alert alert-success">' .$adminName .' will be in contact with you shortly '
			.$name.'!</div><script>
								$("#submitForm").hide(2000);
								window.setTimeout(function() {
				                    window.location.href = "'.$adminWebsite.'";
				                }, 5000);
						   </script>';

		echo json_encode($response);

		$data = array('name' => $name, 'email' => $email, 'phone' => $phone);

		//sendAdminEmail($data);
		//sendUserEmail($data);
	}
}

function sendAdminEmail($data)
{
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Admin <'.$adminEmail.'>' . "\r\n";
	$toEmail = $adminEmail;
	$subject = 'You have a new lead processed on: ' . date('Y/m/d');
	$body = '
			<p>Lead details are below:</p>
			<ul>
				<li>Name: '.$data['name'].'</li>
				<li>Email: '.$data['email'].'</li>
				<li>Phone: '.$data['phone'].'</li>
			</ul>
			<p>Contact them ASAP!!!</p>';

	mail($toEmail, $subject, $body, $headers);
}

function sendUserEmail($data)
{
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Admin <'.$adminEmail.'>' . "\r\n";
	$toEmail = $data['email'];
	$subject = 'Thankyou for contacting '.$adminName.' '.$data['name'].'!';
	$body = '
			<p>'.$adminName.' will be in contact with you shortly!</p>
			<p>In the meantime, please search for homes at: '.$adminWebsite.'</p>';

	mail($toEmail, $subject, $body, $headers);
}

?>