<?php

	/** Display pages list **/
	$this->pageHeader = Yii::t('EventsModule.core', 'События');

	$this->breadcrumbs = array(
		'Home'=>$this->createUrl('/admin'),
		Yii::t('EventsModule.core', 'События'),
	);

	$this->topButtons = $this->widget('application.modules.admin.widgets.SAdminTopButtons', array(
		'template'=>array('create'),
		'elements'=>array(
			'create'=>array(
				'link'=>$this->createUrl('create'),
				'title'=>Yii::t('EventsModule.core', 'Создать событие'),
				'options'=>array(
					'icons'=>array('primary'=>'ui-icon-plus')
				)
			),
		),
	));

	$this->widget('ext.sgridview.SGridView', array(
		'dataProvider'=>$dataProvider,
		'id'=>'pagesListGrid',
		'afterAjaxUpdate'=>"function(){registerFilterDatePickers()}",
		'filter'=>$model,
		'columns'=>array(
			array(
				'class'=>'CCheckBoxColumn',
			),
			array(
				'class'=>'SGridIdColumn',
				'name'=>'id',
			),
			array(
				'name'=>'title',
				'type'=>'raw',
				'value'=>'CHtml::link(CHtml::encode($data->title), array("update", "id"=>$data->id))',
			),
			array(
				'name'=>'url',
				'type'=>'raw',
				'value'=>'CHtml::link(CHtml::encode($data->url), $data->getViewUrl(), array("target"=>"_blank"))',
			),
			'event_date',
			// Buttons
			array(
				'class'=>'CButtonColumn',
				'template'=>'{update}{delete}',
			),
		),
	));

	Yii::app()->clientScript->registerScript("pageDatepickers", "
		function registerFilterDatePickers(id, data){
			jQuery('input[name=\"Event[event_date]\"]').datepicker({
				dateFormat:'yy-mm-dd',
				constrainInput: false
			});
		}
		registerFilterDatePickers();
	");