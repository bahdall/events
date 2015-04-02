<?php

Yii::import('application.modules.banners.BannersModule');

/**
 * Admin menu items for pages module
 */
return array(
	'cms'=>array(
		'position'=>5,
		'items'=>array(
			array(
				'label'=>Yii::t('BannersModule.core', 'Баннеры'),
				'url'=>array('/admin/banners'),
				'position'=>3
			),
			array(
				'label'=>Yii::t('BannersModule.core', 'Слайдеры'),
				'url'=>array('/admin/banners/sliders'),
				'position'=>3
			),
		),
	),
);