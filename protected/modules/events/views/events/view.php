<?php

/**
 * View category pages
 * @var PageCategory $model
 */

// Set meta tags
$this->pageTitle = ($model->meta_title) ? $model->meta_title : $model->title;
$this->pageKeywords = $model->meta_keywords;
$this->pageDescription = $model->meta_description;
?>


	<!-- Start article -->
	<article class="blog-post-wrapper">

		<div class="entry-header">
			<h2 class="entry-title"><?=$model->title?></h2>
			<div class="entry-meta">
				<ul class="list-inline">
					<li><span class="the-time"><?=date("Y.m.d", strtotime($model->event_date))?></span></li>
				</ul>
			</div><!-- /.entry-meta -->
		</div><!-- /.entry-header -->
		<div class="entry-content">
			<?=$model->full_description?>
		</div><!-- /.entry-content -->

		<footer class="entry-footer">
			<h3>Event photos</h3>
			<div class="row">
				<?foreach($model->images as $image):?>
					<div class="bb-img col-md-3 col-sm-3">
						<a class="fancybox-thumb" rel="fancybox-thumb-1" href="<?=$image->getUrl("1000x1000")?>" title="">
							<img src="<?=$image->getUrl("200x150",'cropFromCenter')?>" alt="" />
						</a>
					</div>
				<?endforeach;?>
			</div> <!-- /.row -->
		</footer><!-- /.entry-footer -->

		<?if($model->video):?>
		<footer class="entry-footer">
			<h3>Event video</h3>
			<div class="row">
				<?foreach($model->video as $video):?>
					<div class="bb-video col-md-4 col-sm-4">
						<div class="bb-play text-center">
							<a class="fancybox-thumb fancybox.iframe play glyphicon glyphicon-play-circle" href="<?=$video->video?>"></a>
						</div>
						<a class="fancybox-thumb fancybox.iframe" href="<?=$video->video?>" title="">
							<img src="<?=$video->getUrl("500x500",'cropFromCenter')?>" alt="" />
						</a>
					</div>
				<?endforeach;?>
			</div> <!-- /.row -->
		</footer><!-- /.entry-footer -->
		<?endif;?>
	</article>
	<!-- End article -->
