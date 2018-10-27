<?php
namespace App\Helpers;

use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use SilverStripe\Control\Email\Email;

class SMTPEMailer extends Email{
	
	public function __construct($to=null, $subject=null, $body=null, $cc=null, $bcc=null, $returnPath=null) {
		parent::__construct(null, $to, $subject, $body, $cc, $bcc, $returnPath);
		$this->setFrom('mail@datapushthru.com', 'Data Push Thru');
	}
	
	public function send_email($Type=''){
		if (strtolower($Type) == 'plain') {
			return $this->sendPlain();
		} else {
			return $this->send();
		}
	}

}