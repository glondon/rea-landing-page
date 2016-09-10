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
	<script src="<?=URL?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=URL?>js/facebook.js"></script>

	<style>
		.container {padding:50px}
		#nameInput, #emailInput, #phoneInput, #formSubmit {padding:10px;margin:3px}
		#formError {width:400px;list-style:none;display:none}
		#formResponse {width:400px}
		.youtube {padding:30px}
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
		<div class="page-header">
			<h1>Interested in buying a home in Virginia Beach?</h1>
		</div>
		<div class="row">
			<h2>Call: <a href="tel:<?=$adminPhone?>"><?=$adminPhone?></a></h2>
			<div class="youtube">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/7U8yqRGP7ak" frameborder="0" allowfullscreen></iframe>
			</div>

			<div id="formResponse"></div>
			<form class="form-horizontal" action="<?=URL?>submit.php" method="post" id="submitForm" accept-charset="utf-8">
				<fieldset>
					<div class="col-xs-10">
						<ul id="formError" class="alert alert-danger"></ul>
						<input type="text" name="name" id="nameInput" class="form-control" value="Name" onfocus="if (this.value == 'Name') this.value = '';" 
							onblur="if (this.value == '') this.value = 'Name';" /><br />
						<input type="text" name="email" id="emailInput" class="form-control" value="Email" onfocus="if (this.value == 'Email') this.value = '';" 
							onblur="if (this.value == '') this.value = 'Email';" /><br />
						<input type="text" name="phone" id="phoneInput" class="form-control" value="Phone" onfocus="if (this.value == 'Phone') this.value = '';" 
							onblur="if (this.value == '') this.value = 'Phone';" /><br />
						<button type="submit" id="formSubmit" class="btn btn-default btn-sm">Sign Up</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		$('form#submitForm #formSubmit').click(function(form){
			form.preventDefault();
			$('#formError').hide();
			$('#formError').empty();
			var baseUrl = document.location.origin;

			$.post(baseUrl + '/submit.php', $('form#submitForm').serialize(), function(data){
				if(data.success)
					$('#formResponse').html(data.message);
				else
				{
					$('#formError').fadeIn('slow');

					if(data.nameError != null)
						$('#formError').append('<li>'+data.nameError+'</li>');

					if(data.emailError != null)
						$('#formError').append('<li>'+data.emailError+'</li>');

					if(data.phoneError != null)
						$('#formError').append('<li>'+data.phoneError+'</li>');
				}
			}, 'json');
		});
	</script>
</body>
</html>