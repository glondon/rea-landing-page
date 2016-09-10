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

	<div align="center">
		<h1>Buy it now!</h1>

		<form>
			<fieldset>

			</fieldset>
		</form>

	</div>
	<script type="text/javascript">

	</script>
</body>
</html>