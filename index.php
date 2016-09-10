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
	<link href="<?=$faviconUrl?>" rel="shortcut icon" type="image/ico">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?=URL?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=URL?>js/facebook.js"></script>
	<style>
		#nameInput, #emailInput, #phoneInput, #formSubmit {padding:10px;margin:3px}
		#formError {margin-left:-3px;list-style:none;display:none}
		#submitForm {padding-top:15px}
		#formResponse {padding-top:15px}
		#youtube {position: relative;padding-bottom: 56.25%;padding-top: 30px; height: 0; overflow: hidden; max-width:853px;max-height:480px}
 		#youtube iframe,#youtube object,#youtube embed {position: absolute;top: 0;left: 0;width: 100%;height: 100%}
 		#footer {padding:15px}
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
			<h2 class="h1">Interested in buying a home in Virginia Beach?</h2>
			<h6 class="small">Contact <?=$adminName?> to get started today!</h6>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h3>Call: <a href="tel:<?=$adminPhone?>"><?=$adminPhone?></a></h3>
				<div id="youtube">
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
		<div id="footer">
			<hr />
			<p style="margin-left:-30px"><small>Copyright &copy; <?=$adminName?> - <?=$year?></small></p>
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