<?php

/**
 * View category pages
 * @var PageCategory $model
 */

// Set meta tags
$this->pageTitle = "Events gallery";
$this->pageKeywords = "Events gallery";
$this->pageDescription = "Events gallery";
?>

    <section>
        <?$this->widget( 'application.modules.core.widgets.IncludeFile.IncludeFile' ,array('file' => 'events'))?>
    </section>

    <!-- Last Events start -->
    <section id="events" class="testimonial-section">
        <div class="row text-center">
            <div class="col-xs-12">
                <h2 class="section-title wow zoomIn">Events gallery</h2>
            </div>
        </div> <!-- /.row -->

        <?php foreach($events as $e): ?>
            <div class="bb-evet">
                <div class="row content-row">
                    <div class="col-sm-6 col-md-6">
                        <h3><?=$e->title?></h3>
                    </div>
                    <div class="col-sm-4 col-md-4 text-right">
                        <h3><?=date("Y.m.d", strtotime($e->event_date))?></h3>
                    </div>
                </div> <!-- /.row -->

                <div class="row content-row">
                    <div class="col-sm-9 col-md-9">
                        <?$i=0;?>
                        <?foreach($e->images as $image):?>
                            <?if($i++ >= 4)break;?>
                            <div class="bb-img col-md-3 col-sm-3">
                                <a class="fancybox-thumb" rel="fancybox-thumb-1" href="<?=$image->getUrl("1000x1000")?>" title="">
                                    <img src="<?=$image->getUrl("127x100",'cropFromCenter')?>" alt="" />
                                </a>
                            </div>
                        <?endforeach;?>
                    </div>
                    <div class="col-sm-3 col-md-3 bb-morephoto">
                        <a href="<?=$e->getViewUrl()?>" class="btn btn-primary">More photos &amp; videos</a>
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
    </section>


