<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="$ContentLocale">
<!--<![endif]-->
<!--[if IE 6 ]><html lang="$ContentLocale" class="ie ie6"><![endif]-->
<!--[if IE 7 ]><html lang="$ContentLocale" class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="$ContentLocale" class="ie ie8"><![endif]-->
<head>
	<% if $IsNotLocal %>
		<script data-ad-client="ca-pub-3716182521515143" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<% end_if %>
	<% base_tag %>
	<title><% if $Title %>$Title<% else %>Main<% end_if %> &raquo; Send-Data</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	$MetaTags(false)
	<meta name="theme-color" content="#FFC107">
	<meta name="title" content="<% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %>">
	<% if $PackageTypeMetas %>
		<meta name="description" content="$PackageTypeMetas.MetaDescription" />
		<meta property="og:description" content="$PackageTypeMetas.MetaDescription">
		<meta property="twitter:description" content="$PackageTypeMetas.MetaDescription">
	<% else %>
		<% if $MetaDescription %>
			<meta name="description" content="$MetaDescription" />
			<meta property="og:description" content="$MetaDescription">
			<meta property="twitter:description" content="$MetaDescription">
		<% end_if %>
	<% end_if %>
	<% if $PackageTypeMetas %>
		<meta property="og:title" content="$PackageTypeMetas.MetaTitle">
		<meta property="twitter:title" content="$PackageTypeMetas.MetaTitle">
	<% else %>
		<meta property="og:title" content="<% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %>">
		<meta property="twitter:title" content="<% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %>">
	<% end_if %>
	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="$BaseHref">
	<meta property="og:image" content="{$BaseHref}assets/images/header-bg3.jpg">
	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="$BaseHref">
	<meta property="twitter:image" content="{$BaseHref}assets/images/header-bg3.jpg">

	<link rel="canonical" href="$BaseHref">
	<link rel="icon" type="image/png" sizes="256x256" href="assets/images/icon.png">

	<% if $IsNotLocal %>
<!-- Facebook Pixel Code -->
<script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init', '1520941091422245');fbq('track', 'PageView');</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1520941091422245&ev=PageView&noscript=1"/></noscript>
<!-- End Facebook Pixel Code -->
	<% end_if %>
<script type="text/javascript" id="license-json">var license = $PayloadLicenses.RAW;</script>
</head>

<body data-page-id="$ID" data-page-class="$ClassName.ShortName">
	<% if $IsNotLocal %>
		<!-- Messenger Chat Plugin Code -->
		<div id="fb-root"></div>

		<!-- Your Chat Plugin code -->
		<div id="fb-customer-chat" class="fb-customerchat"></div>

<script>
	var chatbox = document.getElementById('fb-customer-chat');
	chatbox.setAttribute("page_id", "307503806518656");
	chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
	window.fbAsyncInit = function() {
		FB.init({
			xfbml            : true,
			version          : 'v12.0'
		});
	};
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
	<% end_if %>

	<% include Nav %>
