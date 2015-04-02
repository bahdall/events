<?php
Yii::import('application.modules.events.models.*');

class LastEvents extends CWidget
{
	public $section_id;
	public $htmlOptions=array();
	public $count=3;
	public $countImages=6;
	public $view = 'index';

	
    public function run()
    {
		$events = Event::model()->findAll(array('limit'=>$this->count));

		$this->render($this->view,array(
			'events' => $events,
		));
	}
	

}
