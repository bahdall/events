<?php

	Yii::import('application.modules.store.components.SCompareProducts');
	Yii::import('application.modules.store.models.wishlist.StoreWishlist');

	$assetsManager = Yii::app()->clientScript;


	$assetsManager->registerCoreScript('jquery');
	$assetsManager->registerCoreScript('jquery.ui');

	// jGrowl notifications
	Yii::import('ext.jgrowl.Jgrowl');
	Jgrowl::register();

	// Disable jquery-ui default theme
	$assetsManager->scriptMap=array(
		'jquery-ui.css'=>false,
	);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo CHtml::encode($this->pageTitle) ?></title>
	<meta charset="UTF-8"/>
	<meta name="description" content="<?php echo CHtml::encode($this->pageDescription) ?>">
	<meta name="keywords" content="<?php echo CHtml::encode($this->pageKeywords) ?>">


	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/jqueryui/css/custom-theme/jquery-ui-1.8.19.custom.css">


	<!-- Flaticon CSS -->
	<link href="<?php echo Yii::app()->theme->baseUrl ?>/assets/fonts/flaticon/flaticon.css" rel="stylesheet">
	<!-- font-awesome CSS -->
	<link href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/font-awesome.min.css" rel="stylesheet">
	<!-- Offcanvas CSS -->
	<link href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/hippo-off-canvas.css" rel="stylesheet">
	<!-- animate CSS -->
	<link href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/animate.css" rel="stylesheet">
	<!-- owl.carousel CSS -->
	<!-- REVOLUTION BANNER CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/settings.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/fancyBox/source/jquery.fancybox.css" media="screen">
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/style.css" rel="stylesheet">
	<!-- Responsive CSS -->
	<link href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/responsive.css" rel="stylesheet">

	<script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/modernizr-2.8.1.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Exo+2:400,400italic,500,700,700italic,500italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar">
	<div id="st-container" class="st-container hippo-offcanvas-wrapper hippo-offcanvas-left slide-in-on-top">
		<div class="st-pusher hippo-offcanvas-pusher">
			<div class="st-content hippo-offcanvas-contents">
				<div class="st-content-inner">

					<header class="header">
						<nav class="navbar navbar-default navbar-mini" role="navigation">
							<div class="container">
								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse navbar-collapse">
									<ul class="nav navbar-nav navbar-right">
										<li>
											<a class="page-scroll" href="<?=Yii::app()->createUrl('/pages/pages/list', array('url' => 'news'))?>">News</a>
										</li>
										<li><a class="page-scroll" href="<?=Yii::app()->createUrl('/feedback')?>">Contacts</a></li>
										<li><a class="page-scroll" href="<?=Yii::app()->createUrl('/pages/pages/view', array('url' => 'vacancies'))?>">Vacancies</a></li>
										<li><a class="page-scroll" href="http://thehype.ru/">TheHype.Ru Card</a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
							</div><!-- /.container -->
						</nav>

						<nav class="navbar navbar-default fixed-navbar navbar-bottom" role="navigation">
							<div class="container">

								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed">
										<span class="sr-only">Toggle navigation</span>
										<i class="fa fa-bars"></i>
									</button>
									<!-- offcanvas-trigger-effects -->
									<h1 class="logo">
										<?$this->widget( 'application.modules.core.widgets.IncludeFile.IncludeFile' ,array('file' => 'logo'))?>
									</h1>
								</div>


								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse navbar-collapse">
									<ul class="nav navbar-nav navbar-right">
										<li><a class="page-scroll" href="/">Home</a></li>
										<li><a class="page-scroll" href="<?=Yii::app()->createUrl('/pages/pages/view', array('url' => 'about'))?>">About</a></li>
										<li><a class="page-scroll" href="<?=Yii::app()->createUrl('/events/events/list')?>">Party Gallery</a></li>
										<li><a class="page-scroll" href="<?=Yii::app()->createUrl('/pages/pages/view', array('url' => 'party'))?>">Party</a></li>
										<li><a class="page-scroll" href="<?=Yii::app()->createUrl('/pages/pages/futureList', array('url' => 'calendar'))?>">Calendar</a></li>
										<li><a class="page-scroll" href="<?=Yii::app()->createUrl('/pages/pages/view', array('url' => 'fun'))?>">Fun</a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
							</div><!-- /.container -->
						</nav>
					</header>

					<?if($this->isHome()):?>
						<?$this->widget('application.modules.banners.widgets.nivoslider.NivoSlider',array(
							'banner_id' => 2,
							'width' => 1000,
							'height' => 800,
						))?>

						<?php echo $content?>

					<?else:?>
						<section class="blog-page">
							<div class="container">
								<div class="row">
									<div class="col-xs-12 col-sm-8 col-md-9">
										<?php echo $content?>
									</div>

									<div class="col-xs-12 col-sm-4 col-md-3">

										<div class="sidebar-wrapper">
											<?
											$this->widget('application.modules.events.widgets.LastEvents.LastEvents',array(
												'count' => 6,
												'view' => 'right_sidebar',
											));
											?>
										</div><!-- /.sidebar-wrapper -->

									</div>

								</div>
							</div>
						</section>
					<?endif;?>


					<!-- footer start -->
					<footer id="contact" class="footer-widget-wrapper">
						<div class="container">
							<div class="row">
								<div class="col-sm-3 col-md-3">
									<div class="footer-widget footer-logo">
										<?$this->widget( 'application.modules.core.widgets.IncludeFile.IncludeFile' ,array('file' => 'logo'))?>
									</div><!-- /.col-md-6 -->
								</div><!-- /.col-md-6 -->
								<div class="col-sm-3 col-md-3">
									<div class="footer-widget">
										<h3>Contacts</h3>
										<?$this->widget( 'application.modules.core.widgets.IncludeFile.IncludeFile' ,array('file' => 'contacts'))?>

										<a class="feedback-modal" data-toggle="modal" data-target="#feedModal" href="#">Send us your feedback</a>

										<!-- Modal -->
										<div class="modal fade" id="feedModal" tabindex="-1" role="dialog" aria-labelledby="feedModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
														</button>
														<h4 class="modal-title" id="feedModalLabel">Send us your feedback</h4>
													</div>
													<div class="modal-body">
														<?php
														Yii::import('feedback.FeedbackModule');
														Yii::import('feedback.models.FeedbackForm');
														$model = new FeedbackForm;

														$form=$this->beginWidget('CActiveForm', array(
															'action' => Yii::app()->createUrl('/feedback'),
														)); ?>


														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<?php echo CHtml::activeLabel($model,'name', array('required'=>true)); ?>
																	<?php echo CHtml::activeTextField($model,'name', array(
																		'class' => 'form-control',
																	)); ?>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<?php echo CHtml::activeLabel($model,'email', array('required'=>true)); ?>
																	<?php echo CHtml::activeTextField($model,'email', array(
																		'class' => 'form-control',
																	)); ?>
																</div>
															</div>
														</div>

														<div class="form-group text-area">
															<?php echo CHtml::activeLabel($model,'message', array('required'=>true)); ?>
															<?php echo CHtml::activeTextArea($model,'message', array(
																'class' => 'form-control',
																'rows' => 10,
															)); ?>
														</div>

														<?php if(Yii::app()->settings->get('feedback', 'enable_captcha')): ?>
															<div class="row">
																<div class="col-md-6">
																	<label><?php $this->widget('CCaptcha', array(
																			'clickableImage'=>true,
																			'showRefreshButton'=>false,
																			'captchaAction' => '/feedback/default/captcha'
																		)) ?></label>
																	<?php echo CHtml::activeTextField($model, 'code', array(
																		'class' => 'form-control',
																	))?>
																</div>
															</div>
														<?php endif; ?>

														<br>

														<button type="submit" class="btn btn-primary"><?php echo Yii::t('FeedbackModule.core', 'Отправить') ?></button>


														<?php $this->endWidget(); ?>
													</div>
												</div>
											</div>
										</div>
									</div><!-- /.footer-widget -->
								</div><!-- /.col-md-2 -->

								<div class="col-sm-6 col-md-6 text-right">
									<div class="footer-widget copyright">
										<h3>Web site created by <a href="http://goodone.uz/" target="_blank">GoodOne</a></h3>
									</div>
								</div>

							</div><!-- /.row -->



						</div><!-- /.container -->
					</footer>
					<!-- footer end -->
				</div> <!-- .st-content-inner -->
			</div> <!-- .st-content -->
		</div> <!-- .st-pusher -->


	<!-- OFFCANVAS MENU -->
	<div class="offcanvas-menu offcanvas-effect visible-xs hippo-offcanvas-container" style="display: block;">
		<button type="button" class="close" aria-hidden="true" data-toggle="offcanvas" id="off-canvas-close-btn">×</button>
		<h3>Sidebar Menu</h3>
		<ul class="list-unstyled">
			<li class="active"><a class="offcanvas-link" href="http://demo3.themerox.com/html/orchid/#page-top">Home<span class="sr-only">(current)</span></a></li>
			<li><a class="offcanvas-link" href="http://demo3.themerox.com/html/orchid/#services">Services</a></li>
			<li><a class="offcanvas-link" href="http://demo3.themerox.com/html/orchid/#work">Works</a></li>
			<li><a class="offcanvas-link" href="http://demo3.themerox.com/html/orchid/#about">About</a></li>
			<li><a class="offcanvas-link" href="http://demo3.themerox.com/html/orchid/#blog">Blog</a></li>
			<li><a class="offcanvas-link" href="http://demo3.themerox.com/html/orchid/#contact">Contact</a></li>
		</ul>
	</div><!-- .offcanvas-menu -->
	</div><!-- /st-container -->

	<!-- Modal -->
	<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
					<h4 class="modal-title" id="eventModalLabel">Send us your feedback</h4>
				</div>
				<div class="modal-body">
					<?php
					Yii::import('feedback.FeedbackModule');
					Yii::import('feedback.models.FutureEventForm');
					$model = new FutureEventForm;

					$form=$this->beginWidget('CActiveForm', array(
						'action' => Yii::app()->createUrl('/feedback/event'),
					)); ?>


					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<?php echo CHtml::activeLabel($model,'name', array('required'=>true)); ?>
								<?php echo CHtml::activeTextField($model,'name', array(
									'class' => 'form-control',
								)); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<?php echo CHtml::activeLabel($model,'email', array('required'=>true)); ?>
								<?php echo CHtml::activeTextField($model,'email', array(
									'class' => 'form-control',
								)); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<?php echo CHtml::activeLabel($model,'title', array('required'=>true)); ?>
								<?php echo CHtml::activeTextField($model,'title', array(
									'class' => 'form-control',
								)); ?>
							</div>
						</div>
					</div>

					<div class="form-group text-area">
						<?php echo CHtml::activeLabel($model,'message', array('required'=>true)); ?>
						<?php echo CHtml::activeTextArea($model,'message', array(
							'class' => 'form-control',
							'rows' => 10,
						)); ?>
					</div>

					<?php if(Yii::app()->settings->get('feedback', 'enable_captcha')): ?>
						<div class="row">
							<div class="col-md-6">
								<label><?php $this->widget('CCaptcha', array(
										'clickableImage'=>true,
										'showRefreshButton'=>false,
										'captchaAction' => '/feedback/default/captcha'
									)) ?></label>
								<?php echo CHtml::activeTextField($model, 'code', array(
									'class' => 'form-control',
								))?>
							</div>
						</div>
					<?php endif; ?>

					<br>

					<button type="submit" class="btn btn-primary"><?php echo Yii::t('FeedbackModule.core', 'Отправить') ?></button>


					<?php $this->endWidget(); ?>
				</div>
			</div>
		</div>
	</div>


	<!-- Preloader -->
	<div id="preloader" style="display: none;">
		<div id="status" style="display: none;">
			<div class="status-mes"></div>
		</div>
	</div>


	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/bootstrap.js"></script>
	<!-- wow.min.js -->
	<script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/wow.min.js"></script>
	<!-- jQuery REVOLUTION Slider  -->
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/jquery.themepunch.tools.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/jquery.themepunch.revolution.min.js"></script>
	<!-- smoothscroll -->
	<script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/smoothscroll.js"></script>
	<!-- twitterFetcher_min -->
	<!-- // <script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/twitterFetcher_min.js"></script> -->
	<!-- owl.carousel -->
	<!-- Offcanvas Menu -->
	<script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/hippo-offcanvas.js"></script>
	<!-- inview -->
	<script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/jquery.inview.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/fancyBox/source/jquery.fancybox.pack.js"></script>
	<!-- stellar -->
	<!-- // <script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/jquery.stellar.js"></script> -->
	<!-- countTo -->
	<!-- // <script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/jquery.countTo.js"></script> -->
	<!-- Scrolling Nav JavaScript -->
	<script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/jquery.easing.min.js"></script>
	<!-- flickerPhoto -->
	<script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/flickerPhoto.min.js"></script>
	<!-- Shuffle.min js -->
	<!-- // <script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/jquery.shuffle.min.js"></script> -->
	<!-- Custom Script -->
	<script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/scripts.js"></script>


	<div id="toTop"><i class="flaticon-thin16"></i></div>
</body>
</html>