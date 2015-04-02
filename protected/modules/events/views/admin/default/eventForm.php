<?php

/*** Create/update page form ***/
Yii::import('zii.widgets.jui.CJuiDatePicker');

return array(
	'id'=>'pageUpdateForm',
	'showErrorSummary'=>true,
	'enctype'=>'multipart/form-data',
	'elements'=>array(
		'content'=>array(
			'type'=>'form',
			'title'=>Yii::t('EventsModule.core', 'Содержимое'),
			'elements'=>array(
				'title'=>array(
					'type'=>'text',
				),
				'url'=>array(
					'type'=>'text',
				),
				'event_date'=>array(
					'type'=>'CJuiDatePicker',
					'options'=>array(
						'dateFormat'=>'yy-mm-dd '.date('H:i:s'),
					),
				),
				'short_description'=>array(
					'type'=>'SRichTextarea',
				),
				'full_description'=>array(
					'type'=>'SRichTextarea',
				),
			),
		),
		'seo'=>array(
			'type'=>'form',
			'title'=>Yii::t('EventsModule.core', 'Мета данные'),
			'elements'=>array(
				'meta_title'=>array(
					'type'=>'text',
				),
				'meta_keywords'=>array(
					'type'=>'textarea',
				),
				'meta_description'=>array(
					'type'=>'textarea',
				),
			),
		),
	),
);

