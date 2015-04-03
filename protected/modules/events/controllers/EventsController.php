<?php

/**
 * Events controller
 * @package modules.events
 */
class EventsController extends Controller
{

	/**
	 * Filter events by category
	 */
	public function actionList()
	{
		$criteria = Event::model()->getDbCriteria();

		$count = Event::model()->count($criteria);

		$pagination = new CPagination($count);
		$pagination->pageSize = 10;
		$pagination->applyLimit($criteria);

		$events = Event::model()->findAll($criteria);

		$this->render('list', array(
			'events'=>$events,
			'pagination'=>$pagination
		));
	}

	/**
	 * Display page by url.
	 * Example url: /page/some-page-url
	 * @param string $url page url
	 */
	public function actionView($url)
	{
		$model = Event::model()
			->withUrl($url)
			->find(array(
				'limit'=>1
			));

		if (!$model) throw new CHttpException(404, Yii::t('EventsModule.core', 'Страница не найдена.'));


		$this->render('view', array(
			'model'=>$model,
		));
	}

}