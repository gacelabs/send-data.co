<?php
	if (isset($_GET['page'])) {
		/*echo "<pre>";
		print_r($_SERVER);
		exit();*/
		$page = $_GET['page'];
		switch ($page) {
			case 'documentation': // documentation page
				$metas = '<meta property="og:title" content="Send-data API Documentation">
				<meta property="og:description" content="How to simply implement Send-data API to front-end and back-end integration.">
				<meta property="og:image" content="https://send-data.co/assets/images/header-bg3.jpg">
				<meta name="description" content="How to simply implement Send-data API to front-end and back-end integration.">
				<link rel="canonical" href="https://send-data.co'.$_SERVER['REQUEST_URI'].'">';
				$pageTitle = 'Documentation';
				$pageContent = 'contents/docs.php';
				$activePage = 'docs';
				break;
			case 'login': // login page
				$metas = '<meta property="og:title" content="Login to your Send-data profile">
				<meta property="og:description" content="Secured, and Instant Login form to your Send-data projects.">
				<meta property="og:image" content="https://send-data.co/assets/images/header-bg3.jpg">
				<meta name="description" content="Secured, and Instant Login form to your Send-data projects.">
				<link rel="canonical" href="https://send-data.co'.$_SERVER['REQUEST_URI'].'">';
				$pageTitle = 'Login';
				$pageContent = 'contents/login.php';
				$activePage = 'login';
				break;
			case 'free-register': // free register page
				$metas = '<meta property="og:title" content="Register a free profile and get that project up and running.">
				<meta property="og:description" content="Register securly and easy, get a full 20K Payload data in 2 Months MAX!">
				<meta property="og:image" content="https://send-data.co/assets/images/header-bg3.jpg">
				<meta name="description" content="Register securly and easy, get a full 20K Payload data in 2 Months MAX!">
				<link rel="canonical" href="https://send-data.co'.$_SERVER['REQUEST_URI'].'">';
				$pageTitle = 'Free - Register';
				$pageContent = 'contents/register.php';
				$activePage = 'Free';
				break;
			case 'business-register': // business register page
				$metas = '<meta property="og:title" content="Register a business profile and get that project up and running.">
				<meta property="og:description" content="Register securly and easy, get that 500K Upfront Payload data and full help/email support everyday.">
				<meta property="og:image" content="https://send-data.co/assets/images/header-bg3.jpg">
				<meta name="description" content="Register securly and easy, get that 500K Upfront Payload data and full help/email support everyday.">
				<link rel="canonical" href="https://send-data.co'.$_SERVER['REQUEST_URI'].'">';
				$pageTitle = 'Business - Register';
				$pageContent = 'contents/register.php';
				$activePage = 'Business';
				break;
			case 'customed-register': // customed register page
				$metas = '<meta property="og:title" content="Register a customed profile and get that project up and running.">
				<meta property="og:description" content="Register securly and easy, enjoy customized/auto calculated Payload data to meet your desired budget.">
				<meta property="og:image" content="https://send-data.co/assets/images/header-bg3.jpg">
				<meta name="description" content="Register securly and easy, enjoy customized/auto calculated Payload data to meet your desired budget.">
				<link rel="canonical" href="https://send-data.co'.$_SERVER['REQUEST_URI'].'">';
				$pageTitle = 'Customed - Register';
				$pageContent = 'contents/register.php';
				$activePage = 'Customed';
				break;
			case 'thank-you': // customed register page
				$metas = '';
				$pageTitle = 'Successful - Thank You!';
				$pageContent = 'contents/thankyou.php';
				$activePage = 'thankyou';
				break;
			default:
				$metas = '';
				$pageTitle = 'Page Not Found';
				$pageContent = 'contents/404.php';
				$activePage = '404';
				break;
		}
	} else {
		$metas = '<meta property="og:title" content="Simple send-data API written in php & javascript.">
		<meta property="og:description" content="Push data across your app Fast. Secured. Affordable. Create a messenger app for personal or for your business. Send notifications across all your users, fast and reliable, best for Inventory Systems, Real-time Sales Reporting, CRM Records, Order Tracking System and more!">
		<meta property="og:image" content="https://send-data.co/assets/images/header-bg3.jpg">
		<meta name="description" content="Push data across your app Fast. Secured. Affordable. Create a messenger app for personal or for your business. Send notifications across all your users, fast and reliable, best for Inventory Systems, Real-time Sales Reporting, CRM Records, Order Tracking System and more!">
		<link rel="canonical" href="https://send-data.co'.$_SERVER['REQUEST_URI'].'">';
		$pageTitle = 'Send-Data';
		$pageContent = 'contents/home.php';
		$activePage = 'home';
	}
?>
