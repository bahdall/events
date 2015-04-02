<?php


return array(
	'id'=>'pageUpdateForm',
	'showErrorSummary'=>true,
	'elements'=>array(
		'content'=>array(
			'type'=>'form',
			'title'=>Yii::t('BannersModule.core', 'Содержимое'),
			'elements'=>array(
				'name'=>array(
					'type'=>'text',
				),
				'status'=>array(
					'type'=>'dropdownlist',
					'items'=>Banners::statuses()
				),
			),
		),
	),
);

