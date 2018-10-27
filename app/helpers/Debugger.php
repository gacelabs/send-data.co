<?php

namespace App\Helpers;

use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\Director;

class Debugger {

	public static function show($data, $showHeader=true, HTTPRequest $request=null)
	{
		if (Director::isDev() OR Director::isTest()) {
			Debug::show($data);
		}
	}

	public static function caller()
	{
		if (Director::isDev() OR Director::isTest()) {
			Debug::caller();
		}
	}

	public static function endshow($val, $showHeader=true, HTTPRequest $request=null)
	{
		if (Director::isDev() OR Director::isTest()) {
			Debug::endshow($val, $showHeader, $request);
		}
	}

	public static function dump($val, HTTPRequest $request=null)
	{
		if (Director::isDev() OR Director::isTest()) {
			Debug::dump($val, $request);
		}
	}

	public static function text($val, HTTPRequest $request=null)
	{
		if (Director::isDev() OR Director::isTest()) {
			Debug::text($val, $request);
		}
	}

	public static function message($message, $showHeader=true, HTTPRequest $request=null)
	{
		if (Director::isDev() OR Director::isTest()) {
			Debug::message($message, $showHeader, $request);
		}
	}

	public static function create_debug_view(HTTPRequest $request=null)
	{
		if (Director::isDev() OR Director::isTest()) {
			Debug::create_debug_view($request);
		}
	}

	public static function require_developer_login()
	{
		if (Director::isDev() OR Director::isTest()) {
			Debug::require_developer_login();
		}
	}

}