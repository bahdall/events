<?php

/** Display pages list **/
$this->pageHeader = Yii::t('CoreModule.core', 'Слои');

$this->breadcrumbs = array(
	'Home'=>$this->createUrl('/admin'),
	Yii::t('CoreModule.core', 'Слои'),
);

$this->topButtons = $this->widget('application.modules.admin.widgets.SAdminTopButtons', array(
	'template'=>array('create'),
	'elements'=>array(
		'create'=>array(
			'link'=>$this->createUrl('create'),
			'title'=>Yii::t('CoreModule.core', 'Создать Слой'),
			'icon'=>'plus',
		),
	),
));

$this->widget('ext.sgridview.SGridView', array(
	'dataProvider'=>$model->search(),
	'id'=>'languagesListGrid',
	'filter'=>$model,
	//'ajaxUpdate'=>false,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
		),
		array(
			'class'=>'SGridIdColumn',
			'name'=>'id',
		),
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->name), array("update", "id"=>$data->id))',
		),
		'route',
		// Buttons
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
		),
	),
));
