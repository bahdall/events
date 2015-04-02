<?php
Yii::import('application.modules.pages.models.*');

class LastNews extends CWidget
{
	public $section_id;
	public $htmlOptions=array();
	public $count=3;

	
    public function run()
    {
		$news = Page::model()->published()->filterByCategory($this->section_id)->findAll(array('limit'=>$this->count));

		$this->render('index',array(
			'news' => $news,
		));
	}
	

}
