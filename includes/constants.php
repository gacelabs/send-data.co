<?php
	if ((bool)strstr($_SERVER['HTTP_HOST'], 'local.')) {
		defined('PROD') OR define('PROD', 0);
	} else {
		defined('PROD') OR define('PROD', 1);
	}
?>