<?php

class DefaultController extends Controller
{

	/**
	 * @return array
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
			),
		);
	}

	/**
	 * Display feedback form
	 */
	public function actionIndex()
	{
		Yii::import('feedback.models.FeedbackForm');

		$model = new FeedbackForm;



		if(isset($_POST['FeedbackForm']))
			$model->attributes = $_POST['FeedbackForm'];

		if(Yii::app()->request->isPostRequest && $model->validate())
		{
			$model->sendMessage();
			Yii::app()->request->redirect($this->createUrl('index'));
		}

		$this->render('index', array(
			'model'=>$model
		));
	}


	/**
	 * Display feedback form
	 */
	public function actionEvent()
	{
		Yii::import('feedback.models.FutureEventForm');

		$model = new FutureEventForm;

		if(isset($_POST['FutureEventForm']))
			$model->attributes = $_POST['FutureEventForm'];

		if(Yii::app()->request->isPostRequest && $model->validate())
		{
			$model->sendMessage();
			$this->addFlashMessage(Yii::t('main','Your message has been sent.'));
			$model = new FutureEventForm;
		}

		$this->render('event', array(
			'model'=>$model
		));
	}

}
