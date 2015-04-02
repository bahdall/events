<?php
/**
 * Images tabs
 */
Yii::import('ext.jqPrettyPhoto');
Yii::import('application.modules.events.components.EventsImagesConfig');

// Register view styles
Yii::app()->getClientScript()->registerCss('infoStyles', "
	table.imagesList {
		float: left;
		width: 45%;
		min-width:250px;
		margin-right: 15px;
		margin-bottom: 15px;
	}
	div.MultiFile-list {
		margin-left:190px
	}
");

// Upload button
echo CHtml::openTag('div', array('class'=>'row'));
echo CHtml::label(Yii::t('EventsModule.admin', 'Выберите изображения'), 'files');
	$this->widget('system.web.widgets.CMultiFileUpload', array(
		'name'=>'EventImage',
		'model'=>$model,
		'attribute'=>'files',
		'accept'=>implode('|', EventsImagesConfig::get('extensions')),
	));
echo CHtml::closeTag('div');
// Images
if ($model->images)
{
	foreach($model->images as $image)
	{
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$image,
			'id'=>'EventImage'.$image->id,
			'htmlOptions'=>array(
				'class'=>'detail-view imagesList',
			),
			'attributes'=>array(
				array(
					'label'=>Yii::t('EventsModule.admin', 'Изображение'),
					'type'=>'raw',
					'value'=>CHtml::link(
						CHtml::image($image->getUrl(false, false,true), CHtml::encode($image->image), array('height'=>'150px',)),
						$image->getUrl(false, false, true),
						array('target'=>'_blank', 'class'=>'pretty', 'title'=>CHtml::encode($image->image))
					),
				),
				'id',
				array(
					'label'=>Yii::t('EventsModule.admin', 'Действия'),
					'type'=>'raw',
					'value'=>CHtml::ajaxLink(Yii::t('EventsModule.admin', 'Удалить'),$this->createUrl('deleteImage', array('id'=>$image->id)),
						array(
							'type'=>'POST',
							'data'=>array(Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken),
							'success'=>"js:$('#EventImage$image->id').hide().remove()",
						),
						array(
							'id'=>'DeleteImageLink'.$image->id,
							'confirm'=>Yii::t('EventsModule.admin', 'Вы действительно хотите удалить это изображение?'),
						)
					),
				),
			),
		));
	}
}

// Fancybox ext
$this->widget('application.extensions.fancybox.EFancyBox', array(
	'target'=>'a.pretty',
	'config'=>array(),
));