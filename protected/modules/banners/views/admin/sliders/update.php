<?php

/**
 * System settings view
 */
$this->pageHeader = Yii::t('CoreModule.core', 'Слайдер');

$this->topButtons = $this->widget('admin.widgets.SAdminTopButtons', array(
    'form'=>$form,
    'template'=>array('history_back', 'save'),
));

$this->breadcrumbs = array(
    'Home'=>$this->createUrl('/admin'),
    Yii::t('CoreModule.core', 'Слайдеры') => $this->createUrl('index'),
    Yii::t('CoreModule.core', 'Слайдер'),
);
?>

<div class="form wide padding-all">
    <?php echo $form->asTabs(); ?>
</div>