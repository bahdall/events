<?php

Yii::import('application.modules.events.EventsModule');

/**
 * Admin menu items for pages module
 */
return array(
	'events' =>array(
		'position'=>6,
		'label' => Yii::t('EventsModule.core','События'),
		'items'=>array(
			array(
				'label'=>Yii::t('EventsModule.core', 'События'),
				'url'=>array('/admin/events'),
				'position'=>3
			),
		),
	),
);