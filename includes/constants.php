<?php
	if ((bool)strstr($_SERVER['HTTP_HOST'], 'local.')) {
		defined('PROD') OR define('PROD', 0);
		defined('PRODSITE') OR define('PRODSITE', 'http://local.app.send.data/');
	} else {
		defined('PROD') OR define('PROD', 1);
		defined('PRODSITE') OR define('PRODSITE', 'https://app.send-data.co/');
	}
?>