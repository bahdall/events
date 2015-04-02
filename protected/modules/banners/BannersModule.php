<?php

class BannersModule extends BaseModule
{
	public $moduleName = 'banners';

	public function init()
	{
		$this->setImport(array(
			'application.modules.banners.models.*',
			'application.modules.core.models.*',
			'application.modules.core.CoreModule',
		));
	}
}