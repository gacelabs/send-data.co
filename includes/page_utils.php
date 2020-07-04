<?php
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		switch ($page) {
			case 'documentation': // documentation page
				$pageTitle = 'Documentation';
				$pageContent = 'contents/docs.php';
				$activePage = 'docs';
				break;
			case 'login': // login page
				$pageTitle = 'Login';
				$pageContent = 'contents/login.php';
				$activePage = 'login';
				break;
			case 'free-register': // free register page
				$pageTitle = 'Free - Register';
				$pageContent = 'contents/register.php';
				$activePage = 'Free';
				break;
			case 'business-register': // business register page
				$pageTitle = 'Business - Register';
				$pageContent = 'contents/register.php';
				$activePage = 'Business';
				break;
			case 'customed-register': // customed register page
				$pageTitle = 'Customed - Register';
				$pageContent = 'contents/register.php';
				$activePage = 'Customed';
				break;
			case 'thank-you': // customed register page
				$pageTitle = 'Successful - Thank You!';
				$pageContent = 'contents/thankyou.php';
				$activePage = 'thankyou';
				break;
			default:
				$pageTitle = 'Page Not Found';
				$pageContent = 'contents/404.php';
				$activePage = '404';
				break;
		}
	} else {
		$pageTitle = 'Send-Data';
		$pageContent = 'contents/home.php';
		$activePage = 'home';
	}
?>
