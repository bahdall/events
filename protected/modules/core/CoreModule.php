<?php

class CoreModule extends BaseModule {
	
	public $moduleName = 'core';

	public function init()
	{

		$this->setImport(array(
			'application.modules.core.models.*',
			'application.modules.core.helpers.*',
			'application.modules.core.widgets.IncludeFile.*',
		));
	}

}