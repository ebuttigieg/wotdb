<?php 
	$cs=Yii::app()->clientScript;
	$cs->registerPackage('font-awesome');
	$cs->registerPackage('bootstrap');
	$cs->registerPackage('uniform');
	$cs->registerPackage('jquery-migrate');
	$cs->registerPackage('bootstrap-hover-dropdown');
	$cs->registerPackage('jquery-slimscroll');
	$cs->registerPackage('jquery-blockui');
	$cs->registerPackage('jquery-cookie');
	
	$cs->registerScript($this->getId().'Init','App.init();', CClientScript::POS_READY);
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="Статистика клана" name="description"/>
<meta content="K0TAFEY" name="author"/>
<meta name="MobileOptimized" content="320">

<!-- BEGIN THEME STYLES -->
<link href="/css/style-conquer.css" rel="stylesheet" type="text/css"/>
<link href="/css/style.css" rel="stylesheet" type="text/css"/>
<link href="/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
<link href="/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<a class="navbar-brand" href="/">
		<img src="<?php echo WotClan::currentClan()->clan_ico;?>" alt="logo" class="img-responsive"/>
		</a>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<img src="/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->		
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">			
			<li class="devider">
				 &nbsp;
			</li>
			<?php if(!Yii::app()->user->isGuest):?>
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<img alt="" src="/img/avatar3_small.jpg"/>
				<span class="username">
					 <?php echo Yii::app()->user->name; ?>
				</span>
				<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="/site/logout"><i class="fa fa-key"></i> Log Out</a>
					</li>
				</ul>
			</li>
		<!-- END USER LOGIN DROPDOWN -->
		<?php endif;?>
		</ul>
	<!-- END TOP NAVIGATION MENU -->
	</div>
<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<div class="clearfix">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li>
					<form class="search-form" role="form" action="index.html" method="get">
						<div class="input-icon right">
							<i class="fa fa-search"></i>
							<input type="text" class="form-control input-medium input-sm" name="query" placeholder="Search...">
						</div>
					</form>
				</li>
				<li class="start active ">
					<a href="index.html">
					<i class="fa fa-home"></i>
					<span class="title">
						Dashboard
					</span>
					<span class="selected">
					</span>
					</a>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-cogs"></i>
					<span class="title">
						Page Layouts
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="layout_session_timeout.html">
							<span class="badge badge-warning">
								new
							</span>
							Session Timeout</a>
						</li>
						<li>
							<a href="layout_idle_timeout.html">
							<span class="badge badge-important">
								new
							</span>
							User Idle Timeout</a>
						</li>
						<li>
							<a href="layout_language_bar.html">
							<span class="badge badge-important">
								new
							</span>
							Language Switch Bar</a>
						</li>
						<li>
							<a href="layout_disabled_menu.html">
							Disabled Menu Links</a>
						</li>
						<li>
							<a href="layout_sidebar_reversed.html">
							<span class="badge badge-success">
								new
							</span>
							Right Sidebar Page</a>
						</li>
						<li>
							<a href="layout_sidebar_fixed.html">
							Sidebar Fixed Page</a>
						</li>
						<li>
							<a href="layout_sidebar_closed.html">
							Sidebar Closed Page</a>
						</li>
						<li>
							<a href="layout_blank_page.html">
							Blank Page</a>
						</li>
						<li>
							<a href="layout_boxed_page.html">
							Boxed Page</a>
						</li>
						<li>
							<a href="layout_boxed_not_responsive.html">
							Non-Responsive Layout</a>
						</li>
						<li>
							<a href="layout_ajax.html">
							Content Loading via Ajax</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-bookmark"></i>
					<span class="title">
						UI Features
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="ui_general.html">
							General</a>
						</li>
						<li>
							<a href="ui_buttons.html">
							Buttons</a>
						</li>
						<li>
							<a href="ui_typography.html">
							Typography</a>
						</li>
						<li>
							<a href="ui_modals.html">
							Modals</a>
						</li>
						<li>
							<a href="ui_extended_modals.html">
							Extended Modals</a>
						</li>
						<li>
							<a href="ui_tabs_accordions_navs.html">
							Tabs, Accordions & Navs</a>
						</li>
						<li>
							<a href="ui_toastr.html">
							<span class="badge badge-warning">
								new
							</span>
							Toastr Notifications</a>
						</li>
						<li>
							<a href="ui_datepaginator.html">
							<span class="badge badge-success">
								new
							</span>
							Date Paginator</a>
						</li>
						<li>
							<a href="ui_tree.html">
							Tree View</a>
						</li>
						<li>
							<a href="ui_nestable.html">
							Nestable List</a>
						</li>
						<li>
							<a href="ui_ion_sliders.html">
							<span class="badge badge-important">
								new
							</span>
							Ion Range Sliders</a>
						</li>
						<li>
							<a href="ui_noui_sliders.html">
							<span class="badge badge-success">
								new
							</span>
							NoUI Range Sliders</a>
						</li>
						<li>
							<a href="ui_jqueryui_sliders.html">
							jQuery UI Sliders</a>
						</li>
						<li>
							<a href="ui_knob.html">
							Knob Circle Dials</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-table"></i>
					<span class="title">
						Form Stuff
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="form_controls.html">
							Form Controls</a>
						</li>
						<li>
							<a href="form_layouts.html">
							Form Layouts</a>
						</li>
						<li>
							<a href="form_component.html">
							Form Components</a>
						</li>
						<li>
							<a href="form_editable.html">
							<span class="badge badge-warning">
								new
							</span>
							Form X-editable</a>
						</li>
						<li>
							<a href="form_wizard.html">
							Form Wizard</a>
						</li>
						<li>
							<a href="form_validation.html">
							Form Validation</a>
						</li>
						<li>
							<a href="form_image_crop.html">
							<span class="badge badge-important">
								new
							</span>
							Image Cropping</a>
						</li>
						<li>
							<a href="form_fileupload.html">
							Multiple File Upload</a>
						</li>
						<li>
							<a href="form_dropzone.html">
							Dropzone File Upload</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-sitemap"></i>
					<span class="title">
						Pages
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="page_inbox.html">
							<span class="badge badge-important">
								4
							</span>
							Inbox</a>
						</li>
						<li>
							<a href="page_locked.html">
							User Locked</a>
						</li>
						<li>
							<a href="page_portfolio.html">
							<span class="badge badge-warning badge-roundless">
								new
							</span>
							Portfolio</a>
						</li>
						<li>
							<a href="page_blog.html">
							Blog</a>
						</li>
						<li>
							<a href="page_blog_item.html">
							Blog Post</a>
						</li>
						<li>
							<a href="page_about.html">
							About Us</a>
						</li>
						<li>
							<a href="page_contact.html">
							Contact Us</a>
						</li>
						<li>
							<a href="page_calendar.html">
							<span class="badge badge-important">
								14
							</span>
							Calendar</a>
						</li>
						<li>
							<a href="page_profile.html">
							User Profile</a>
						</li>
						<li>
							<a href="page_faq.html">
							FAQ</a>
						</li>
						<li>
							<a href="page_invoice.html">
							Invoice</a>
						</li>
						<li>
							<a href="page_pricing_table.html">
							Pricing Tables</a>
						</li>
						<li>
							<a href="page_404_option1.html">
							404 Page Option 1</a>
						</li>
						<li>
							<a href="page_404_option2.html">
							404 Page Option 2</a>
						</li>
						<li>
							<a href="page_500_option1.html">
							500 Page Option 1</a>
						</li>
						<li>
							<a href="page_500_option2.html">
							500 Page Option 2</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;">
					<i class="fa fa-folder-open"></i>
					<span class="title">
						4 Level Menu
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
							<i class="fa fa-cogs"></i> Item 1
							<span class="arrow">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="javascript:;">
									<i class="fa fa-user"></i>
									Sample Link 1
									<span class="arrow">
									</span>
									</a>
									<ul class="sub-menu">
										<li>
											<a href="#"><i class="fa fa-times"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-pencil"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-edit"></i> Sample Link 1</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="fa fa-user"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-external-link"></i> Sample Link 2</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-bell"></i> Sample Link 3</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-globe"></i> Item 2
							<span class="arrow">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#"><i class="fa fa-user"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-external-link"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-bell"></i> Sample Link 1</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#">
							<i class="fa fa-folder-open"></i>
							Item 3 </a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-th"></i>
					<span class="title">
						Data Tables
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="table_basic.html">
							Basic Tables</a>
						</li>
						<li>
							<a href="table_responsive.html">
							Responsive Tables</a>
						</li>
						<li>
							<a href="table_managed.html">
							Managed Tables</a>
						</li>
						<li>
							<a href="table_editable.html">
							Editable Tables</a>
						</li>
						<li>
							<a href="table_advanced.html">
							Advanced Tables</a>
						</li>
						<li>
							<a href="table_ajax.html">
							Ajax Datatables</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-file-text"></i>
					<span class="title">
						Portlets
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="portlet_general.html">
							General Portlets</a>
						</li>
						<li>
							<a href="portlet_draggable.html">
							Draggable Portlets</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-map-marker"></i>
					<span class="title">
						Maps
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="maps_google.html">
							Google Maps</a>
						</li>
						<li>
							<a href="maps_vector.html">
							Vector Maps</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="charts.html">
					<i class="fa fa-bar-chart-o"></i>
					<span class="title">
						Visual Charts
					</span>
					</a>
				</li>
				<li class="last ">
					<a href="login.html">
					<i class="fa fa-user"></i>
					<span class="title">
						Login
					</span>
					</a>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
</div>
<!-- END SIDEBAR -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/js/respond.min.js"></script>
<script src="/js/excanvas.min.js"></script> 
<![endif]-->
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/scripts/app.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>