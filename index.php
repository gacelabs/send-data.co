<?php

include('includes/constants.php');
include('includes/page_head.php');

?>
<body>
	<?php if ((bool)strstr($_SERVER['HTTP_HOST'], 'local.') == false): ?>
		<!-- Google Tag Manager (noscript) -->
		<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T2LRXWG"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
		<!-- End Google Tag Manager (noscript) -->

		<!-- Load Facebook SDK for JavaScript -->
		<!-- Messenger Chat Plugin Code -->
		<div id="fb-root"></div>
		<!-- Your Chat Plugin code -->
		<div id="fb-customer-chat" class="fb-customerchat"></div>
		<script>
			var chatbox = document.getElementById('fb-customer-chat');
			chatbox.setAttribute("page_id", "307503806518656");
			chatbox.setAttribute("attribution", "biz_inbox");
			window.fbAsyncInit = function() {
				FB.init({
					xfbml : true,
					version : 'v12.0'
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
	<?php endif ?>

	<!-- Navigation -->
	<?php

	include('includes/page_nav.php');

	?>

	<!-- Page Content -->
	<?php

	include($pageContent);

	?>

	<!-- Footer -->
	<?php

	include('includes/page_footer.php');

	?>

</body>
</html>