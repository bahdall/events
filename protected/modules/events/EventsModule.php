<?php

class EventsModule extends BaseModule
{
	public $moduleName = 'events';

	public function init()
	{
		$this->setImport(array(
			'application.modules.events.models.*'
		));
	}
}