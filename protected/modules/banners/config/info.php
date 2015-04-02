<?php

Yii::import('application.modules.banners.BannersModule');

/**
 * Module info
 */ 
return array(
	'name'=>Yii::t('BannersModule.core', 'Баннеры'),
	'author'=>'tsharipov777@gmail.com',
	'version'=>'0.1',
	'description'=>Yii::t('BannersModule.core', 'Управление баннерами сайта.'),
	'config_url'  => Yii::app()->createUrl('/banners/admin/default/index'),
	'url'=>'', # Url to module home page.
	'widgets' => array(
		'Sliders' => array(
			'name' => 'SLIDERS',
			'description' => 'jquery Slider',
			'class' => 'application.modules.banners.widgets.Slider',
		),
	),
);