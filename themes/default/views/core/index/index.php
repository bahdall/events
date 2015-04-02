<?php

/**
 * Site start view
 */
$src = '/themes/default/assets/images/mainPageBanner.png';
$src2 = '/themes/default/assets/images/temp/banner.jpg';
?>

	<div style="clear: both; margin-bottom: 60px"></div>

<?php $this->beginClip('underFooter'); ?>
	<div style="clear:both;"></div>



<?$this->widget( 'application.modules.pages.widgets.LastNews.LastNews' ,array(
	'section_id' => 7,
	'count' => 3,
))?>
<?php $this->endClip(); ?>