<?php
namespace App\Helpers;

use SilverStripe\View\SSViewer;
use SilverStripe\Control\Director;

class FileHelper{
	
	public static function check($filepath = false){
		if(file_exists(Director::baseFolder() . '/' . $filepath)){
			return  true;
		}
		return false;
	}

	public static function checkTemplate($template = false){
		$ss_themes = SSViewer::get_themes();
		if(!empty($ss_themes)){
			foreach($ss_themes as $theme){
				$filepath = "themes/" . $theme . '/templates/' . str_replace('\\','/', $template) . '.ss';
				if(self::check($filepath)){
					return $filepath;
				}
			}
		}
		return false;
	}

}