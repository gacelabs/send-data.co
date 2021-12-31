<?php

namespace App\Helpers;

use Psr\SimpleCache\CacheInterface;
use SilverStripe\Core\Injector\Injector;

use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

class CacheHelper {

	public $cache;

	public function __construct(){
		$this->cache = Injector::inst()->get(CacheInterface::class . '.DataCache');
	}

	public static function Injector(){
		return Injector::inst()->get(CacheInterface::class . '.DataCache');
	}

	public static function write_data($key = false, $data){
		self::Injector()->delete($key);
		self::Injector()->set($key, $data);
	}

	public static function load_data($key){
		return self::Injector()->get($key);
	}

	public static function checkExist($key){
		return self::Injector()->has($key);
	}

	public static function delete($key){
		self::Injector()->delete($key);
	}

	public static function clear(){
		return self::Injector()->clear();
	}

}