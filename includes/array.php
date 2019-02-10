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
				'20K Upfront Payload for Php 7K',
				'Metered Succeeding Payload',
				'24/7 Email Support'
			)
		),
		'Customed' => array(
			'reg-link' => 'customed-register',
			'price' => $customed_price,
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


	$sampleSystems = array(
		'chat.jpg',
		'chart.jpg',
		'mobile.jpg',
		'crm.jpg',
		'ecommerce.jpg',
		'cloud.jpg'
	);

?>