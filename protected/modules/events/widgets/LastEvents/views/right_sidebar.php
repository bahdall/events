
<aside class="widget widget_popular">
    <h2 class="widget-title">Last Events</h2>

    <?php foreach($events as $e): ?>
        <div class="media">
            <div class="media-left">
                <?if( isset($e->images[0]) ):?>
                <a href="<?=$e->getViewUrl()?>">
                    <img class="media-object" src="<?=$e->images[0]->getUrl("40x40")?>" alt="">
                </a>
                <?endif;?>
            </div><!-- /.media-left -->
            <div class="media-body">
                <h3 class="media-heading"><a href="<?=$e->getViewUrl()?>"><?=$e->title?></a></h3>
                <span class="the-time"><a href="<?=$e->getViewUrl()?>"><?=date("Y.m.d", strtotime($e->event_date))?></a></span>
            </div><!-- /.media-body -->
        </div><!-- /.media -->
    <?endforeach;?>
</aside>