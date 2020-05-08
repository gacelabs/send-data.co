<?php

use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
use SilverStripe\i18n\i18n;

// remove PasswordValidator for SilverStripe 5.0
$validator = PasswordValidator::create();
// Settings are registered via Injector configuration - see passwords.yml in framework
Member::set_password_validator($validator);

define('SITE_DEFAULT_THEME', 'senddata');

HTMLEditorConfig::get('cms')->setOption('extended_valid_elements',  
	'address[class|name|id],
	i[class|name|id],
	article[class|name|id],
	aside[class|name|id],
	audio[class|name|id],
	bdi[class|name|id],
	caption[class|name|id],
	canvas[class|name|id],
	datalist[class|name|id],
	details[class|name|id],
	dialog[class|name|id],
	embed[class|name|id],
	figure[class|name|id],
	figcaption[class|name|id],
	footer[class|name|id],
	header[class|name|id],
	keygen[class|name|id],
	mark[class|name|id],
	menuitem[class|name|id],
	meter[class|name|id],
	nav[class|name|id],
	output[class|name|id],
	progress[class|name|id],
	rp[class|name|id],
	rt[class|name|id],
	ruby[class|name|id],
	section[class|name|id],
	source[class|name|id],
	summary[class|name|id],
	time[class|name|id],
	track[class|name|id],
	video[class|name|id],
	wbr[class|name|id]'
);

HTMLEditorConfig::get('cms')->setThemes(['theme-name']);

// Set the site locale
i18n::set_locale('en_US');
