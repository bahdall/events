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
	</article>
	<!-- End article -->
