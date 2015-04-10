<?php

/**
 * @var $this Controller
 */

$this->pageTitle = Yii::t('FeedbackModule.core', 'Contacts');

?>


<!-- Start article -->
<article class="blog-post-wrapper">

    <div class="entry-header" style="padding: 21px 20px 5px;">
        <h2 class="entry-title"><?php echo Yii::t('FeedbackModule.core', 'Contacts') ?></h2>
    </div><!-- /.entry-header -->
    <div  style="padding: 10px 20px 25px;">

        <?php $form=$this->beginWidget('CActiveForm'); ?>

        <!-- Display errors  -->
        <?php echo $form->errorSummary($model,NULL,NULL, array(
            'class' => 'bg-danger',
            'style' => 'padding: 10px; margin-bottom: 5px;'
        )); ?>

        <?if( $mess = Yii::app()->user->getFlash('messages') ):?>
        <div class="bg-success" style="padding: 10px; margin-bottom: 5px;">
            <?=$mess[0]?>
        </div>
        <?endif;?>



        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo CHtml::activeLabel($model,'name', array('required'=>true)); ?>
                    <?php echo CHtml::activeTextField($model,'name', array(
                        'class' => 'form-control',
                    )); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo CHtml::activeLabel($model,'email', array('required'=>true)); ?>
                    <?php echo CHtml::activeTextField($model,'email', array(
                        'class' => 'form-control',
                    )); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo CHtml::activeLabel($model,'title', array('required'=>true)); ?>
                    <?php echo CHtml::activeTextField($model,'title', array(
                        'class' => 'form-control',
                    )); ?>
                </div>
            </div>
        </div>

        <div class="form-group text-area">
            <?php echo CHtml::activeLabel($model,'message', array('required'=>true)); ?>
            <?php echo CHtml::activeTextArea($model,'message', array(
                'class' => 'form-control',
                'rows' => 10,
            )); ?>
        </div>

        <?php if(Yii::app()->settings->get('feedback', 'enable_captcha')): ?>
            <div class="row">
                <div class="col-md-6">
                    <label><?php $this->widget('CCaptcha', array('clickableImage'=>true,'showRefreshButton'=>false)) ?></label>
                    <?php echo CHtml::activeTextField($model, 'code', array(
                        'class' => 'form-control',
                    ))?>
                </div>
            </div>
        <?php endif; ?>
        <br>
        <button type="submit" class="btn btn-primary"><?php echo Yii::t('FeedbackModule.core', 'SEND') ?></button>


        <?php $this->endWidget(); ?>

    </div><!-- /.entry-content -->
</article>
<!-- End article -->