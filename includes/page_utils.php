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
				$activePage = 'free-reg';
				break;
			case 'business-register': // business register page
				$pageTitle = 'Bueiness - Register';
				$pageContent = 'contents/register.php';
				$activePage = 'business-reg';
				break;
			case 'customed-register': // customed register page
				$pageTitle = 'Customed - Register';
				$pageContent = 'contents/register.php';
				$activePage = 'customed-reg';
				break;
		}
	} else {
		$pageTitle = 'Data Push Thru';
		$pageContent = 'contents/home.php';
		$activePage = 'home';
	}
?>
