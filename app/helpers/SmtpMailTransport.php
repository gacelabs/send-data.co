<?php

namespace App\Helpers;

use SilverStripe\Dev\Debug;
use Swift_SmtpTransport;

class SmtpMailTransport extends Swift_SmtpTransport {

	function __construct() {
		parent::__construct('smtp.gmail.com', 587, 'tls');
		
		$this->setUsername('gacelabs.inc@gmail.com')
			 ->setPassword('fqeiuaonuvjdwpzh')
			 ->setTimeout(5)
			 ->setStreamOptions(['ssl' => ['allow_self_signed' => true, 'verify_peer' => false]])
			 ->setAuthMode('login')
		;
	}

}