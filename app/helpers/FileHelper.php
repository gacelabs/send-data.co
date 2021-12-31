<?php
namespace App\Helpers;

use SilverStripe\View\SSViewer;
use SilverStripe\Control\Director;
use SilverStripe\Dev\Debug;

class FileHelper{

    public static function check($filepath = false){
        if(file_exists(Director::baseFolder() . '/' . $filepath)){
            return  true;
        }
        return false;
    }

    public static function checkTemplate($template = false){
        $ss_themes = SSViewer::get_themes();
    	// debug::endshow($ss_themes);
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

	public static function deleteFilesAndFolders($dirname) {
		if (is_dir($dirname)) {
			$dir_handle = opendir($dirname);
		}
		if (!$dir_handle) {
			return false;
		}
		while($file = readdir($dir_handle)) {
			if ($file != "." && $file != "..") {
				if (!is_dir($dirname."/".$file)) {
					unlink($dirname."/".$file);
				} else {
					self::deleteFilesAndFolders($dirname.'/'.$file);
				}
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}

}
