<?php
/*
* Author: Greg London
* http://greglondon.info
*/
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Greg London">
	<title><?=$title?></title>
	<meta name="description" content="<?=$description?>">
	<meta name="keywords" content="<?=$keywords?>" />
	<link rel="canonical" href="<?=URL?>" />
	<link href="<?=URL?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=URL?>css/bootstrap-responsive.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="><?=URL?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=URL?>js/facebook.js"></script>

	<style>
		.container {padding:50px}
		#nameInput, #emailInput, #phoneInput, #formSubmit {padding:10px;margin:3px}
	</style>
</head>
<body>

	<!-- Facebook -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?=$fbAppId?>',
          xfbml      : true,
          version    : 'v2.6'
        });
      };
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
    <!--
    <fb:login-button scope="public_profile,email" style="margin:15px" onlogin="checkLoginState();" data-auto-logout-link="true"></fb:login-button>
	<div id="status" style="margin-bottom:10px"></div>
	-->
	<!-- Facebook  End -->

	<div align="center" class="container">
		<h1>Buy it now!</h1>

		<div id="formResponse"></div>
		<form class="form-horizontal" action="<?=URL?>submit.php" method="post" id="submitForm" accept-charset="utf-8">
			<fieldset>
				<div class="col-xs-10">
					<ul id="formError"></ul>
					<input type="text" name="name" id="nameInput" class="form-control" /><br />
					<input type="text" name="email" id="emailInput" class="form-control" /><br />
					<input type="text" name="phone" id="phoneInput" class="form-control" /><br />
					<button type="submit" id="formSubmit" class="btn btn-default btn-sm">Sign Up</button>
				</div>
			</fieldset>
		</form>

	</div>
	<script type="text/javascript">

	</script>
</body>
</html>