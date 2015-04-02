<?php

class DefaultController extends SAdminController {

	/**
	 * Display pages list.
	 */
	public function actionIndex()
	{
		$model = new Banners('search');

		if (!empty($_GET['Banners']))
			$model->attributes = $_GET['Banners'];

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
			$model = new Banners;
			$images = array();
		}
		else
		{
			$model = Banners::model()->findByPk($_GET['id']);
			$images = BannersImages::model()->language($_GET)->sort()->findAll('banner_id = :banner_id',array(
				'banner_id' => $model->id,
			));
		}

		if (!$model)
			throw new CHttpException(404, Yii::t('BannersModule.core', 'Баннер не найдена.'));

		$form = new STabbedForm('application.modules.banners.views.admin.default.bannerForm', $model);
		$form->additionalTabs = array(
			Yii::t('BannersModule.core','Изображения') => $this->renderPartial('_images', array(
				'model' => $model,
				'images' => $images,
			), true),
		);

		if (Yii::app()->request->isPostRequest)
		{
			$model->attributes = $_POST['Banners'];

			if ($model->validate())
			{
				$model->save();

				$this->saveImages($model);

				$this->setFlashMessage(Yii::t('BannersModule.core', 'Изменения успешно сохранены'));

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
	 * Delete page by Pk
	 */
	public function actionDelete()
	{
		if (Yii::app()->request->isPostRequest)
		{
			$model = Banners::model()->findAllByPk($_REQUEST['id']);

			if (!empty($model))
			{
				foreach($model as $page)
					$page->delete();
			}

			if (!Yii::app()->request->isAjaxRequest)
				$this->redirect('index');
		}
	}


	protected function saveImages($model)
	{
		if( isset($_POST['images']) )
		{
			foreach($model->images as $img)
			{
				if( !array_key_exists($img->id,$_POST['images']) )
				{
					$imgDelete = BannersImages::model()->findAllByPk($img->id);
					foreach($imgDelete as $item)
						$item->delete();
				}
			}

			$count = count($_POST['images']);
			foreach($_POST['images'] as $index => $image)
			{
				$bannerImage = BannersImages::model()->language($_GET)->findByPk($index,'banner_id = :banner_id',array(
					':banner_id' => $model->id,
				));

				if($bannerImage)
				{
					$bannerImage->attributes = $image;
					$bannerImage->sort = $count--;
					$bannerImage->save();
				}
				else
				{
					$newImage = new BannersImages();
					$newImage->attributes = $image;
					$newImage->banner_id = $model->id;
					$newImage->sort = $count--;
					$newImage->save();
				}

			}
		}

	}
}