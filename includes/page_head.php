<!DOCTYPE html>
<html>
<head>
	<?php if ((bool)strstr($_SERVER['HTTP_HOST'], 'local.') == false): ?>
		<script data-ad-client="ca-pub-3716182521515143" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<?php endif ?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php
		include('includes/page_utils.php');
	?>
	<title><?php echo $pageTitle; ?></title>
	<?php echo $metas;?>
	<link rel="icon" type="image/png" sizes="256x256" href="assets/images/icon.png">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-slider.css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/default.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<?php if ((bool)strstr($_SERVER['HTTP_HOST'], 'local.') == false): ?>
		<!-- Facebook Pixel Code -->
		<script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init', '1520941091422245');fbq('track', 'PageView');</script>
		<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1520941091422245&ev=PageView&noscript=1"/></noscript>
		<!-- End Facebook Pixel Code -->
	<?php endif ?>
</head>

<?php include('includes/array.php'); ?>