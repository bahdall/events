<?php
Yii::import('application.modules.events.components.EventsUploadedImage');

class DefaultController extends SAdminController {

	/**
	 * Display pages list.
	 */
	public function actionIndex()
	{
		$model = new Event('search');

		if (!empty($_GET['Event']))
			$model->attributes = $_GET['Event'];

		$dataProvider = $model->search();
		$dataProvider->pagination->pageSize = Yii::app()->settings->get('core', 'productsPerPageAdmin');

		$this->render('index', array(
			'model'=>$model,
			'dataProvider'=>$dataProvider
		));
	}

	public function actionCreate()
	{
		$this->actionUpdate(true);
	}

	/**
	 * Create or update new page
	 * @param boolean $new
	 */
	public function actionUpdate($new = false)
	{
		if ($new === true)
		{
			$model = new Event;
			$model->event_date = date('Y-m-d H:i:s');
		}
		else
		{
			$model = Event::model()
				->findByPk($_GET['id']);
		}

		if (!$model)
			throw new CHttpException(404, Yii::t('EventsModule.core', 'Страница не найдена.'));

		$form = new STabbedForm('application.modules.events.views.admin.default.eventForm', $model);

		// Set additional tabs
		$form->additionalTabs = array(
			Yii::t('EventsModule.admin','Изображения')    => $this->renderPartial('_images', array('model'=>$model), true),
			Yii::t('EventsModule.admin','Видео')    => $this->renderPartial('_video', array(
				'model'=>$model
			), true),
		);

		if (Yii::app()->request->isPostRequest)
		{
			$model->attributes = $_POST['Event'];


			if ($model->validate())
			{
				$model->save();

				// Handle images
				$this->handleUploadedImages($model);
				$this->handleUploadedVideos($model);

				$this->setFlashMessage(Yii::t('EventsModule.core', 'Изменения успешно сохранены'));

				if (isset($_POST['REDIRECT']))
					$this->smartRedirect($model);
				else
					$this->redirect(array('index'));
			}
		}

		$this->render('update', array(
			'model'=>$model,
			'form'=>$form,
		));
	}

	/**
	 * Delete event by Pk
	 */
	public function actionDelete()
	{
		if (Yii::app()->request->isPostRequest)
		{
			$model = Event::model()->findAllByPk($_REQUEST['id']);

			if (!empty($model))
			{
				foreach($model as $event)
					$event->delete();
			}

			if (!Yii::app()->request->isAjaxRequest)
				$this->redirect('index');
		}
	}

	/**
	 * @param $id EventImage id
	 */
	public function actionDeleteImage($id)
	{
		if (Yii::app()->request->getIsPostRequest())
		{
			$model = EventImage::model()->findByPk($id);
			if ($model)
				$model->delete();
		}
	}


	/**
	 * @param Event $model
	 */
	public function handleUploadedImages(Event $model)
	{
		$images = CUploadedFile::getInstancesByName('EventImage');

		if($images && sizeof($images) > 0)
		{
			/** var $image CUploadedFile */
			foreach($images as $image)
			{
				if(!EventsUploadedImage::hasErrors($image))
					$model->addImage($image);
				else
					$this->setFlashMessage(Yii::t('EventsModule.admin', 'Ошибка загрузки изображения {name}', array('{name}'=>$image->getName())));
			}
		}
	}


	/**
	 * @param Event $model
	 */
	public function handleUploadedVideos(Event $model)
	{

		$videos = isset($_POST['video']) ? $_POST['video'] : false;
		if($videos)
		{
			foreach($model->video as $v)
			{
				if( !array_key_exists($v->id,$videos) )
				{
					$v->delete();
				}
			}

			foreach($videos as $key => $video)
			{
				$NewVideo = EventVideo::model()->findByPk($key);

				if(!$NewVideo)$NewVideo = new EventVideo();



				if($video['video'])
				{
					$NewVideo->video = $video['video'];
					$NewVideo->event_id = $model->id;
					$NewVideo->save();
				}

				$image = CUploadedFile::getInstanceByName('videoImage['.$key.']');
				if(!$image)continue;

				if(!EventsUploadedImage::hasErrors($image))
				{
					$NewVideo->addImage($image);
					$NewVideo->save();
				}
				else
					$this->setFlashMessage(Yii::t('EventsModule.admin', 'Ошибка загрузки изображения {name}', array('{name}'=>$image->getName())));
			}
		}
	}
}