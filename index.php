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
		body {margin:0px} 
		#nameInput, #emailInput, #phoneInput, #formSubmit {padding:10px;margin:3px}
		#formError {margin-left:-3px;list-style:none;display:none;max-width:400px}
		#submitForm {padding-top:15px}
		#formResponse {padding-top:15px;max-width:400px}
		#youtube {position: relative;padding-bottom: 56.25%;padding-top: 30px; height: 0; overflow: hidden; max-width:853px;max-height:480px}
 		#youtube iframe,#youtube object,#youtube embed {position: absolute;top: 0;left: 0;width: 100%;height: 100%}
 		#footer {padding:15px}
 		.footerMessage {margin-left:-10px;color:#fff}
 		.footerImages {list-style:none;width:410px}
 		.footerImages li {display:inline;float: left;padding-left:25px}
 		#bg {position:fixed;top:0;left:0;min-width:100%;min-height:100%}
 		#opacity {filter:alpha(opacity=99);opacity:0.99}
 		.phone {color:#fff}
	</style>
</head>
<body>
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
    <img id="bg" src="img/house-background.jpg" alt=""/>
	<div align="center" class="container" id="opacity">
		<div class="page-header">
			<h2 class="h1">Interested in buying a home in <?=$location?>?</h2>
			<h6 class="small">Contact <?=$adminName?> to get started today!</h6>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h3 class="phone">Call: <a class="phone" href="tel:<?=$adminPhone?>"><?=$adminPhone?></a></h3>
				<div id="youtube">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$youtubeUrl?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
				</div>

				<fb:login-button scope="public_profile,email" style="padding-top:20px" onlogin="checkLoginState();" data-auto-logout-link="true"></fb:login-button>
				<div id="status"></div>

				<div id="formResponse"></div>
				<form class="form-horizontal" action="<?=URL?>submit.php" method="post" id="submitForm" accept-charset="utf-8">
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
				</form>
			</div>
		</div>
		<div id="footer">
			<hr />
			<ul class="footerImages">
				<li><img src="img/REALTOR.jpg" width="50px" height="50px" /></li>
				<li><img src="img/Redefy Logo 3.jpg" width="50px" height="50px" /></li>
				<li><img src="img/brand.gif" width="50px" height="50px" /></li>
				<li><img src="img/Home.jpg" width="75px" height="75px" /></li>
			</ul>
			<br />
			<p class="footerMessage"><small>Copyright &copy; <?=$adminName?> - <?=$year?></small></p>
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