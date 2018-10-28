<?php

	$products = array(
		'Free' => array(
			'reg-link' => 'free-register',
			'price' => 'Free',
			'billed' => 'Monthly',
			'desc' => array(
				'2 Months Max',
				'1K Max Payload per month',
				'Limited Support'
			)
		),
		'Business' => array(
			'reg-link' => 'business-register',
			'price' => '7,000',
			'billed' => 'Monthly',
			'desc' => array(
				'Monthly',
				'20K Upfront Payload per Month',
				'Metered Succeeding Payload',
				'24/7 Email Support'
			)
		),
		'Customed' => array(
			'reg-link' => 'customed-register',
			'price' => '1,000',
			'billed' => 'Monthly',
			'desc' => array(
				'Monthly',
				'Metered Payload',
				'1K Payload for Php 1K',
				'24/7 Email Support'
			)
		)
	);


	$projects = array(
		'Chat App' => array(
			'icon' => 'fa fa-commenting-o',
			'desc' => 'Create a messenger app for personal or for your business.'
		),
		'Notifications' => array(
			'icon' => 'fa fa-bullhorn',
			'desc' => 'Send notifications across all your users, fast and reliable.'
		),
		'Instant Update' => array(
			'icon' => 'fa fa-history',
			'desc' => 'Never have to press the F5 key again to get the latest data.'
		),
		'A lot more ...' => array(
			'icon' => 'fa fa-bell-o',
			'desc' => 'Also best for Inventory Systems, Real-time Sales Reporting, CRM Records, Order Tracking System and more!'
		)
	);


	$js = array(
		'Declare' => array(
			'desc' => 'Declaring the javascript and getting your backend php file library for your website.',
			'docs' => array(
				'<li>- Login to https://datapushthru.com/login and input your Account credentials.</li>',
				'<li>- Goto https://datapushthru.com/generate_files/<YOUR APP KEY></li>',
				'<li>- In there your php file library (for backend transmitting) and javascript tag will be generated.</li>',
				'<li>a. In the script panel, copy the script tag and patse it at the bottom before the body end tag.</li>',
				'<li>b. After your page have been loaded it also loads the Pushthru object class and dependencies.</li>',
				'<li>c. For the backend php file library, include it to autoload file or anywhere you wanted to be. (click this to learn its use)</li>'
			)
		),
		'Initialize' => array(
			'desc' => 'Initializing the Pushthru object class.',
			'docs' => array(
				'<li>- Place this anywhere you want it to call the Pushthru object class.</li>',
				'<li class="script-block">Example:<br/><script type="text/javascript" id="push-thru-scripts" src="http://datapushthru.com/api/jsfile/<YOUR APP KEY>"></script><br/>a. var pushthru = new Pushthru(<YOUR APP KEY>).<br/><span class="text-indent">i. Parameter -> a string value of your APP KEY.</span></li>'
			)
		),
		'Subscribe' => array(
			'desc' => 'Subscribing channels for connection.',
			'docs' => array(
				'<li>- There are two ways to declare a subscribe method.</li>',
				'<li>a. pushthru.subscribe(\'name_of_channel\');</li>',
				'<li>- In this method, you initially subscribe the \'name_of_channel\' for a connection</li>',
				'<li class="info-block text-indent">i. Parameter -> a string value of your channel name</li>',
				'<li></li>',
				'<li></li>'
			)
		)
	);

	$sampleSystems = array(
		'chat.jpg',
		'chart.jpg',
		'mobile.jpg',
		'crm.jpg',
		'ecommerce.jpg',
		'cloud.jpg'
	);

?>