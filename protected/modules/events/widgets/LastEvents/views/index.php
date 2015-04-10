

<!-- Last Events start -->
<section id="events" class="testimonial-section section-padding">
    <div class="container">
        <div class="row text-center">
            <div class="col-xs-12">
                <h2 class="section-title wow zoomIn">Events of TheHype Moscow</h2>
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
                <div class="col-sm-10 col-md-10">
                    <?$i=0;?>
                    <?foreach($e->images as $image):?>
                        <?if($i++ >= $this->countImages)break;?>
                        <div class="bb-img col-md-2 col-sm-2">
                            <a class="fancybox-thumb" rel="fancybox-thumb-1" href="<?=$image->getUrl("1000x1000")?>" title="">
                                <img src="<?=$image->getUrl("127x100",'cropFromCenter')?>" alt="" />
                            </a>
                        </div>
                    <?endforeach;?>
                </div>
                <div class="col-sm-2 col-md-2 bb-morephoto">
                    <a href="<?=$e->getViewUrl()?>" class="btn btn-primary">More photos &amp; videos</a>
                </div>
            </div> <!-- /.row -->
        </div>
        <?endforeach;?>

    </div>
</section>