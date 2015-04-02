<?php
	// Page create/edit view

	$this->topButtons = $this->widget('application.modules.admin.widgets.SAdminTopButtons', array(
		'form'=>$form,
		'deleteAction'=>$this->createUrl('/events/admin/default/delete', array('id'=>$model->id))
	));

	$title = ($model->isNewRecord) ? Yii::t('EventsModule.admin', 'Создание события') :
		Yii::t('EventsModule.admin', 'Редактирование события');

	$this->breadcrumbs = array(
		'Home'=>$this->createUrl('/admin'),
		Yii::t('EventsModule.admin', 'События')=>$this->createUrl('index'),
		($model->isNewRecord) ? Yii::t('EventsModule.admin', 'Создание события') : CHtml::encode($model->title),
	);

	$this->pageHeader = $title;
?>

<!-- Use padding-all class with SidebarAdminTabs -->
<div class="form wide padding-all">
	<?php echo $form->asTabs(); ?>
</div>

