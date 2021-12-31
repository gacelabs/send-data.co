<?php

namespace App\Helpers;

use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use SilverStripe\Control\Director;
use Swift_SmtpTransport;

class SMTPEMailerTransport extends Swift_SmtpTransport {

	public function __construct() {
		parent::__construct('smtp.gmail.com', 465, 'ssl');
		$this->setUsername('gacelabs.inc@gmail.com')
			 ->setPassword('jpmmkjexgngkuktt')
			 ->setTimeout(5)
			 ->setStreamOptions(['ssl' => ['allow_self_signed' => true, 'verify_peer' => false]])
			 ->setAuthMode('login');
		// debug::endshow($this);
	}
}