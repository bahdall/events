

<!-- Last Events start -->
<section id="welcome" class="testimonial-section text-center bb-welcome">
	<div class="container">
		<div class="row text-center">
			<div class="col-xs-12">
				<h2 class="section-title wow zoomIn">Welcome To TheHype</h2>
			</div>
		</div> <!-- /.row -->

		<div class="bb-welcome-text">
			<?
			$this->widget( 'application.modules.core.widgets.IncludeFile.IncludeFile' ,array('file' => 'welcome_text'));
			?>
		</div>
	</div>
</section>



<?
$this->widget('application.modules.events.widgets.LastEvents.LastEvents',array(
	'count' => 3,
	'countImages' => 6,
));
?>
