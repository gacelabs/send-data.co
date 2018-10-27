<?php

use SilverStripe\ORM\DataExtension;
use SilverStripe\View\SSViewer;
use SilverStripe\Control\Director;

use App\Helpers\FileHelper;
use App\Helpers\CacheHelper;
use App\Helpers\GeneralHelper;

class PageCacheExtension extends DataExtension{

	private static $db = [
        //'EnableMobileTemplate' => 'Boolean'
    ];

	public $use_template = false;

	/*
	public function isAgentType($type = 'desktop') {
		return ($type != '' ? $type.'_' : '') === GeneralHelper::checkDeviceAgent();
	}
	*/

	public function ThemeTemplate(){
		if($this->use_template && FileHelper::checkTemplate($this->use_template)){
			return $this->use_template;
		}
		else if(FileHelper::checkTemplate($this->owner->ClassName) && $this->owner->ClassName != 'Page'){
			return $this->owner->ClassName;
		}
		else if(FileHelper::checkTemplate('Layout/' . $this->owner->ClassName)){
			return 'Layout/' . $this->owner->ClassName;
		}
	}

	/*
	public function MobileThemeTemplate(){
		return $this->ThemeTemplate() . '_mobile';
	}
	*/

	public function writeCache(){

		if($template = $this->ThemeTemplate()){
			$html = $this->owner->renderWith($template);
			CacheHelper::write_data($this->CacheKey(), $html);
			return $html;
		}
		return false;

	}

	public function RenderLayout(){
		
		if(CacheHelper::checkExist($this->CacheKey()) && !Director::isDev()){
			$html = CacheHelper::load_data($this->CacheKey());
		}
		else{
			$html = $this->writeCache();
		}

		return $html;

	}

	public function CacheKey(){
		/*
		if($_SERVER['QUERY_STRING']){
			parse_str($_SERVER['QUERY_STRING'], $qs);
			unset($qs['flush']);
			unset($qs['flushtoken']);
			$qs = http_build_query($qs);
		}
		
		if(!$link){
			$link = strtok($_SERVER["REQUEST_URI"], '?');
		}
		*/

		$link = '';
        return md5($this->owner->ClassName . '.' . $this->owner->ID . '.' . $link . (@$qs ?: 0)) . '.key';
    }

    public function isCachedOn(){
    	return CacheHelper::checkExist($this->CacheKey());
    }

    public function onAfterWrite(){
    	CacheHelper::delete($this->CacheKey());
    }


}

class PageCacheControllerExtenstion extends DataExtension{

	public function onAfterInit(){
    	if($this->owner->request->getVar('flush')){
    		CacheHelper::clear();
    	}
	}
}


