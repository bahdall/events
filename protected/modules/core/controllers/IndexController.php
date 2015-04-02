<?php

Yii::import('application.modules.pages.models.Page');

/**
 * Store start page controller
 */
class IndexController extends Controller
{

	/**
	 * Display start page
	 */
	public function actionIndex()
	{
		$this->render('index');
	}


}
