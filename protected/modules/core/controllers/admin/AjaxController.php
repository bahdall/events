<?php

Yii::import('application.modules.orders.models.Order');
Yii::import('application.modules.comments.models.Comment');

class AjaxController extends SAdminController
{
	public function actionGetCounters()
	{
		echo json_encode(array(
			'comments' => (int ) Comment::model()->waiting()->count(),
			'orders'   => (int ) Order::model()->new()->count(),
		));
	}


	public function actionSaveFile()
	{
		if($_POST)
		{
			$fileName = Yii::app()->request->getPost("FileName");
			$fileContent = Yii::app()->request->getPost("FileContent");

			if( file_exists($fileName) )
			{
				file_put_contents($fileName, $fileContent );
				echo Yii::t('CoreModule.core','Успешно');
			}
			else
			{
				echo Yii::t('CoreModule.core','Файл не доступен для записи');
			}

		}
	}
}