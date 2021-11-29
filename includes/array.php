<?php
	$products = array(
		'Free' => array(
			'reg-link' => 'free-register',
			'price' => 'Free in 2 Months',
			'billed' => 'Monthly',
			'payload' => '100000',
			'desc' => array(
				'2 Months Max',
				'100K Max Messages per month',
				'Limited Support'
			)
		),
		'Business' => array(
			'reg-link' => 'business-register',
			'price' => '199',
			'billed' => 'Monthly',
			'payload' => '50000000',
			'desc' => array(
				'Monthly',
				'50M Upfront Messages for USD 199',
				'Metered Succeeding Messages',
				'24/7 Email Support'
			)
		),
		'Customed' => array(
			'reg-link' => 'customed-register',
			'price' => 33,
			'billed' => 'Monthly',
			'payload' => '5000000',
			'desc' => array(
				'Metered Messages per Month',
				'<strong class="payloadLimit">0</strong> Messages for <b>USD </b><strong class="clientPrice">0</strong>',
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