<?php

/**
 * View category pages
 * @var PageCategory $model
 */

// Set meta tags
$this->pageTitle = ($model->meta_title) ? $model->meta_title : $model->name;
$this->pageKeywords = $model->meta_keywords;
$this->pageDescription = $model->meta_description;
?>


<!-- Last Events start -->
<section id="events" class="testimonial-section">
    <div class="row text-center">
        <div class="col-xs-12">
            <h2 class="section-title wow zoomIn"><?php echo $model->name ?></h2>
        </div>
    </div> <!-- /.row -->

    <?php if (sizeof($pages) > 0): ?>
    <?php foreach($pages as $page): ?>
        <div class="bb-evet">
            <div class="row content-row">
                <div class="col-sm-6 col-md-6">
                    <h3><?php echo CHtml::link($page->title, array('/pages/pages/view', 'url'=>$page->url)); ?></h3>
                </div>
                <div class="col-sm-4 col-md-4 text-right">
                    <h3><?=date("Y.m.d", strtotime($page->publish_date))?></h3>
                </div>
            </div> <!-- /.row -->

            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <?php echo $page->short_description; ?>
                </div>
            </div> <!-- /.row -->
        </div>
    <?endforeach;?>

    <nav class="text-center">
        <?php $this->widget('CLinkPager', array(
            'pages' => $pagination,
            'footer' => '',
            'header' => '',
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
            'prevPageLabel' => '<',
            'nextPageLabel' => '>',
            'selectedPageCssClass' => 'active',
            'htmlOptions' => array(
                'class' => 'pagination pagination-lg',
            ),
        )) ?>
    </nav>

    <?php else: ?>
        <?php echo Yii::t('PagesModule.core', 'В категории нет страниц.') ?>
    <?php endif ?>
</section>
