<?php

use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;

// remove PasswordValidator for SilverStripe 5.0
$validator = PasswordValidator::create();
// Settings are registered via Injector configuration - see passwords.yml in framework
Member::set_password_validator($validator);

define('SITE_DEFAULT_THEME', 'orange');
define('PAYLOAD_RANGE', serialize([1,2,3,4,5,6,7,8,9,10]));

use SilverStripe\Control\Director;
if ((bool)strstr($_SERVER['HTTP_HOST'], 'local') == TRUE) {
	define('APP_SITE', 'http://local.app.send.data/');
} else {
	define('APP_SITE', 'https://app.send-data/');
}

/*HTMLEditor additional tools*/
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
HtmlEditorConfig::get('cms')->setOption('valid_elements', 'i[*],span[*],p[*],strong[*],b[*],h1[*],h2[*],h3[*],h4[*],h5[*],h6[*],ul[*],li[*],pre[*],code[*],div[*],br,a[*]');