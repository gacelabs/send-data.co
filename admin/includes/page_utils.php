<?php
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		switch ($page) {
			case 'domaingoeshere': // domain content within the admin page
				$pageTitle = 'domaingoeshere';
				$pageContent = 'admin/contents/domain_content.php';
				$activePage = 'domaingoeshere';
				break;
			case 'anotherdomain': // domain content within the admin page
				$pageTitle = 'anotherdomain';
				$pageContent = 'admin/contents/domain_content.php';
				$activePage = 'anotherdomain';
				break;
			default:
				$pageTitle = 'Page Not Found';
				$pageContent = 'contents/404.php';
				$activePage = '404';
				break;
		}
	} else {
		$pageTitle = 'Data Push Thru';
		$pageContent = 'admin/contents/admin_default.php';
		$activePage = 'home';
	}
?>
