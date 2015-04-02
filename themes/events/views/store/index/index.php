<?php

/**
 * Site start view
 */
$src = '/themes/default/assets/images/mainPageBanner.png';
$src2 = '/themes/default/assets/images/temp/banner.jpg';
?>

<div style="clear: both; margin-bottom: 60px"></div>

<div class="wide_line">
	<span>Популярные товары</span>
</div>

<div class="products_list">
	<?php
		foreach($popular as $p)
			$this->renderPartial('_product', array('data'=>$p));
	?>
</div>

<?php $this->beginClip('underFooter'); ?>
<div style="clear:both;"></div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#shares .share_list ul li a").click(function(){
			$("#shares .share_list ul li").removeClass('active');
			$(this).parent().addClass('active');
			$("#shares .products_list").load('/store/index/renderProductsBlock/'+$(this).attr('href'));
			return false;
		});
	});
</script>

<div id="shares">
	<div class="shared_products">
		<div class="share_list">
			<ul>
				<li class="active"><a href="newest">Новинки</a></li>
				<li><a href="added_to_cart">Хиты продаж</a></li>
			</ul>
		</div>

		<div style="clear:both;"></div>

		<div class="products_list">
			<?php
			foreach($newest as $p)
				$this->renderPartial('_product', array('data'=>$p));
			?>
		</div>
	</div>
</div>



<?$this->widget( 'application.modules.pages.widgets.LastNews.LastNews' ,array(
	'section_id' => 7,
	'count' => 3,
))?>
<?php $this->endClip(); ?>