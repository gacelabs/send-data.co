<?php
	if (isset($_GET['page'])) {
		/*echo "<pre>";
		print_r($_SERVER);
		exit();*/
		$page = $_GET['page'];
		switch ($page) {
			case 'documentation': // documentation page
				$description = 'How to simply implement Send-data API to front-end and back-end integration.';

				$pageTitle = 'Send-Data - Documentation';
				$metaTitle = 'Simple API ~ Documentation / Implemention';
				$pageContent = 'contents/docs.php';
				$activePage = 'docs';
				break;
			case 'login': // login page
				$description = 'Secured, and Instant Login form to your Send-data projects.';
				
				$pageTitle = 'Send-Data - Login';
				$metaTitle = 'Login thru our Secured admin panel and manage your projects.';
				$pageContent = 'contents/login.php';
				$activePage = 'login';
				break;
			case 'free-register': // free register page
				$description = 'Register securly and easy, get a full 20K Payload data in 2 Months MAX!';
				
				$pageTitle = 'Send-Data - Free - Register';
				$metaTitle = 'Register NOW for a free trial!';
				$pageContent = 'contents/register.php';
				$activePage = 'Free';
				break;
			case 'business-register': // business register page
				$description = 'Register securly and easy, get that 500K Upfront Payload data and full help/email support everyday.';
				
				$pageTitle = 'Send-Data - Business - Register';
				$metaTitle = 'For enterprise and business firm, Register NOW!';
				$pageContent = 'contents/register.php';
				$activePage = 'Business';
				break;
			case 'customed-register': // customed register page
				$description = 'Register securly and easy, enjoy customized/auto calculated Payload data to meet your desired budget.';
				
				$pageTitle = 'Send-Data - Customed - Register';
				$metaTitle = 'Register for a your desired Payload based on your business processing needs.';
				$pageContent = 'contents/register.php';
				$activePage = 'Customed';
				break;
			case 'contact-us':
				$description = 'Hello! Tell us what you want, we are happy to serve you!';
				
				$pageTitle = 'Send-Data - Contact Us';
				$metaTitle = 'Ask us what you want to know.';
				$pageContent = 'contents/contact_us.php';
				$activePage = 'Contact Us';
				break;
			/*case 'thank-you':
				$metas = '';
				$pageTitle = 'Send-Data - Successful ~ Thank You!';
				$metaTitle = 'Simple API written in PHP Programming Language & JavaScript.';
				$pageContent = 'contents/thankyou.php';
				$activePage = 'Thank You';
				break;*/
			case 'enquiry-sent':
				$description = '';
				
				$pageTitle = 'Send-Data - Successful ~ Enquiry!';
				$metaTitle = 'Successful Enquiry.';
				$pageContent = 'contents/enquiry.php';
				$activePage = 'Enquiry Sent';
				break;
			default:
				$description = '';
				
				$pageTitle = 'Send-Data - Page Not Found';
				$metaTitle = 'Cannot find page you requested?';
				$pageContent = 'contents/404.php';
				$activePage = '404';
				break;
		}
	} else {
		$description = 'Push data across your app Fast. Secured. Affordable. Create a messenger app for personal or for your business. Send notifications across all your users, fast and reliable, best for Inventory Systems, Real-time Sales Reporting, CRM Records, Order Tracking System and more!';
		$metaTitle = 'Simple API written in PHP Programming Language & JavaScript.';

		$pageTitle = 'Send-Data - Home';
		$pageContent = 'contents/home.php';
		$activePage = 'home';
	}
	$url = 'https://send-data.co'.$_SERVER['REQUEST_URI'];
	$image = 'https://send-data.co/assets/images/header-bg3.jpg';

	$metas = '<!-- Primary Meta Tags -->
	<meta name="title" content="'.$metaTitle.'">
	<meta name="description" content="'.$description.'">
	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="'.$url.'">
	<meta property="og:title" content="'.$metaTitle.'">
	<meta property="og:description" content="'.$description.'">
	<meta property="og:image" content="'.$image.'">
	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="'.$url.'">
	<meta property="twitter:title" content="'.$metaTitle.'">
	<meta property="twitter:description" content="'.$description.'">
	<meta property="twitter:image" content="'.$image.'">
	<link rel="canonical" href="https://send-data.co">';
?>