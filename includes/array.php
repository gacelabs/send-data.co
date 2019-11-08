<?php
	
	$customed_price = '1,000';
	if (date('Y-m-d') != '2018-12-31') {
		if (isset($_GET['code']) AND $_GET['code'] == 'CustomedOFF') {
			$customed_price = '500';
		}
	}

	$products = array(
		'Free' => array(
			'reg-link' => 'free-register',
			'price' => 'Free',
			'billed' => 'Monthly',
			'payload' => '1000',
			'desc' => array(
				'2 Months Max',
				'2K Max Payload per month',
				'Limited Support'
			)
		),
		'Business' => array(
			'reg-link' => 'business-register',
			'price' => '145',
			'billed' => 'Monthly',
			'payload' => '50000',
			'desc' => array(
				'Monthly',
				'50K Upfront Payload for USD 145',
				'Metered Succeeding Payload',
				'24/7 Email Support'
			)
		),
		'Customed' => array(
			'reg-link' => 'customed-register',
			'price' => $customed_price,
			'billed' => 'Monthly',
			'payload' => '1000',
			'desc' => array(
				'Metered Payload',
				'<strong class="payloadLimit">0</strong> Payload for <b>USD </b><strong class="clientPrice">0</strong>',
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


	$sampleSystems = array(
		'chat.jpg',
		'chart.jpg',
		'mobile.jpg',
		'crm.jpg',
		'ecommerce.jpg',
		'cloud.jpg'
	);

?>