<?php

/**
 * View page
 * @var Page $model
 */

// Set meta tags
$this->pageTitle       = ($model->meta_title) ? $model->meta_title : $model->title;
$this->pageKeywords    = $model->meta_keywords;
$this->pageDescription = $model->meta_description;
?>

<!-- Start article -->
<article class="blog-post-wrapper">

	<div class="entry-header">
		<h2 class="entry-title"><?=$model->title?></h2>
		<div class="entry-meta">
			<ul class="list-inline">
				<li><span class="the-time"><?=date("Y.m.d", strtotime($model->publish_date))?></span></li>
			</ul>
		</div><!-- /.entry-meta -->
	</div><!-- /.entry-header -->
	<div class="entry-content">
		<?=$model->full_description?>
	</div><!-- /.entry-content -->

</article>
<!-- End article -->