<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Conquer | Data Tables - Basic Tables</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="css/bootstrap.min.css" rel="stylesheet" />
   <link href="css/bootstrap-responsive.min.css" rel="stylesheet" />
   <!--  link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" /-->
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style_responsive.css" rel="stylesheet" />
   <link href="css/style_default.css" rel="stylesheet" id="style_color" />
   <link href="#" rel="stylesheet" id="style_metro" />
   <!--  link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" /-->
   <!--  link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" /-->

  <?php Yii::app()->clientScript->registerCoreScript('font-awesome'); ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN HEADER -->
   <div id="header" class="navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="navbar-inner">
         <div class="container-fluid">
            <!-- BEGIN LOGO -->
            <a class="brand" href="index.html">
            <img src="img/logo.png" alt="Conquer" />
            </a>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="arrow"></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <div class="top-nav">
               <!-- BEGIN QUICK SEARCH FORM -->
               <form class="navbar-search hidden-phone">
                  <div class="search-input-icon">
                     <input type="text" class="search-query dropdown-toggle" id="quick_search" placeholder="Search" data-toggle="dropdown" />
                     <i class="icon-search"></i>
                     <!-- BEGIN QUICK SEARCH RESULT PREVIEW -->
                     <ul class="dropdown-menu extended">
                        <li>
                           <span class="arrow"></span>
                           <p>Found 23 results</p>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-success"><i class="icon-user"></i></span>
                           Nick Kim, Technical Mana...<i class="icon icon-arrow-right"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-info"><i class="icon-money"></i></span>
                           Anual Report,Dec 20...<i class="icon icon-arrow-right"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-warning"><i class="icon-comment"></i></span>
                           Re: Nick Dalton, Sep 11:...<i class="icon icon-arrow-right"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-important"><i class="icon-bullhorn"></i></span>
                           Office Setup, Mar 12...<i class="icon icon-arrow-right"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-info"><i class="icon-envelope"></i></span>
                           Re: Order Status, Jan 12...<i class="icon icon-arrow-right"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-info"><i class="icon-paper-clip"></i></span>
                           project_2011.docx, Feb 12...<i class="icon icon-arrow-right"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           See all results...
                           </a>
                        </li>
                     </ul>
                     <!-- END QUICK SEARCH RESULT PREVIEW -->
                  </div>
               </form>
               <!-- END QUICK SEARCH FORM -->
               <!-- BEGIN TOP NAVIGATION MENU -->
               <ul class="nav pull-right" id="top_menu">
                  <!-- BEGIN NOTIFICATION DROPDOWN -->
                  <li class="dropdown" id="header_notification_bar">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="icon-warning-sign"></i>
                     <span class="label label-important">15</span>
                     </a>
                     <ul class="dropdown-menu extended notification">
                        <li>
                           <p>You have 14 new notifications</p>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-success"><i class="icon-plus"></i></span>
                           New user registered.
                           <span class="small italic">Just now</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-important"><i class="icon-bolt"></i></span>
                           Server #12 overloaded.
                           <span class="small italic">15 mins</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-warning"><i class="icon-bell"></i></span>
                           Server #2 not respoding.
                           <span class="small italic">22 mins</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-info"><i class="icon-bullhorn"></i></span>
                           Application error.
                           <span class="small italic">40 mins</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-important"><i class="icon-bolt"></i></span>
                           Database overloaded 68%.
                           <span class="small italic">2 hrs</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="label label-important"><i class="icon-bolt"></i></span>
                           2 user IP addresses blacklisted.
                           <span class="small italic">5 hrs</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">See all notifications</a>
                        </li>
                     </ul>
                  </li>
                  <!-- END NOTIFICATION DROPDOWN -->
                  <!-- BEGIN INBOX DROPDOWN -->
                  <li class="dropdown" id="header_inbox_bar">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="icon-envelope-alt"></i>
                     <span class="label label-success">5</span>
                     </a>
                     <ul class="dropdown-menu extended inbox">
                        <li>
                           <p>You have 12 new messages</p>
                        </li>
                        <li>
                           <a href="#">
                           <span class="photo"><img src="./img/avatar-mini.png" alt="avatar" /></span>
                           <span class="subject">
                           <span class="from">Lisa Wong</span>
                           <span class="time">Just Now</span>
                           </span>
                           <span class="message">
                           Vivamus sed auctor nibh congue nibh.
                           </span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="photo"><img src="./img/avatar-mini.png" alt="avatar" /></span>
                           <span class="subject">
                           <span class="from">Alina Fionovna</span>
                           <span class="time">16 mins</span>
                           </span>
                           <span class="message">
                           Vivamus sed auctor nibh congue.
                           </span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <span class="photo"><img src="./img/avatar-mini.png" alt="avatar" /></span>
                           <span class="subject">
                           <span class="from">Mila Rock</span>
                           <span class="time">2 hrs</span>
                           </span>
                           <span class="message">
                           Vivamus sed auctor nibh congue.
                           </span>
                           </a>
                        </li>
                        <li>
                           <a href="#">See all messages</a>
                        </li>
                     </ul>
                  </li>
                  <!-- END INBOX DROPDOWN -->
                  <li class="divider-vertical hidden-phone hidden-tablet"></li>
                  <!-- BEGIN USER LOGIN DROPDOWN -->
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="icon-wrench"></i>
                     <b class="caret"></b>
                     </a>
                     <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-cogs"></i> System Settings</a></li>
                        <li><a href="#"><i class="icon-pushpin"></i> Shortcuts</a></li>
                        <li><a href="#"><i class="icon-trash"></i> Trash</a></li>
                     </ul>
                  </li>
                  <!-- END USER LOGIN DROPDOWN -->
                  <li class="divider-vertical hidden-phone hidden-tablet"></li>
                  <!-- BEGIN USER LOGIN DROPDOWN -->
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="icon-user"></i>
                     <b class="caret"></b>
                     </a>
                     <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-user"></i> Mark King</a></li>
                        <li><a href="#"><i class="icon-envelope-alt"></i> Inbox</a></li>
                        <li><a href="#"><i class="icon-tasks"></i> Tasks</a></li>
                        <li><a href="#"><i class="icon-ok"></i> Calendar</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
                     </ul>
                  </li>
                  <!-- END USER LOGIN DROPDOWN -->
               </ul>
               <!-- END TOP NAVIGATION MENU -->
            </div>
         </div>
      </div>
      <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
      <div id="sidebar" class="nav-collapse collapse">
         <div class="sidebar-toggler hidden-phone"></div>
         <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
         <div class="navbar-inverse">
            <form class="navbar-search visible-phone">
               <input type="text" class="search-query" placeholder="Search" />
            </form>
         </div>
         <!-- END RESPONSIVE QUICK SEARCH FORM -->
         <!-- BEGIN SIDEBAR MENU -->
         <?php
		$this->widget('ext.conquer.sidebar.Sidebar', array(
 			'items'=>array(
 				// Important: you need to specify url as 'controller/action',
 				// not just as 'controller' even if default acion is used.
 				array('label'=>'Home', 'url'=>array('site/index')),
 				// 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
 				array('label'=>'Products', 'url'=>'javascript:;', 'items'=>array(
 					array('label'=>'New Arrivals', 'url'=>array('product/new', 'tag'=>'new')),
 					array('label'=>'Most Popular', 'url'=>array('product/index', 'tag'=>'popular')),
 				)),
 				array('label'=>'Login', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
 			),
 		)); ?>
         <ul>
            <li>
               <a href="index.html">
               <i class="icon-home"></i> Dashboard
               </a>
            </li>
            <li class="has-sub">
               <a href="javascript:;">
               <i class="icon-bookmark-empty"></i> UI Elements
               <span class="arrow"></span>
               </a>
               <ul class="sub">
                  <li><a href="ui_elements_general.html">General</a></li>
                  <li><a href="ui_elements_buttons.html">Buttons</a></li>
                  <li><a href="ui_elements_tabs_accordions.html">Tabs & Accordions</a></li>
                  <li><a href="ui_elements_typography.html">Typography</a></li>
               </ul>
            </li>
            <li class="has-sub">
               <a href="javascript:;">
               <i class="icon-cogs"></i> Form Stuff
               <span class="arrow"></span>
               </a>
               <ul class="sub">
                  <li><a href="form_layout.html">Form Layouts</a></li>
                  <li><a href="form_component.html">Form Components</a></li>
                  <li><a href="form_wizard.html">Form Wizard</a></li>
                  <li><a href="form_validation.html">Form Validation</a></li>
               </ul>
            </li>
            <li class="has-sub active">
               <a href="javascript:;">
               <i class="icon-table"></i> Data Tables
               <span class="arrow open"></span>
               </a>
               <ul class="sub">
                  <li class="active"><a href="table_basic.html">Basic Tables</a></li>
                  <li><a href="table_advance.html">Advance Tables</a></li>
               </ul>
            </li>
            <li><a href="grids.html"><i class="icon-th"></i> Grids & Portlets</a></li>
            <li><a href="charts.html"><i class="icon-bar-chart"></i> Visual Charts</a></li>
            <li class="has-sub">
               <a href="javascript:;">
               <i class="icon-map-marker"></i> Maps
               <span class="arrow"></span>
               </a>
               <ul class="sub">
                  <li><a href="maps_google.html"> Google Maps</a></li>
                  <li><a href="maps_vector.html"> Vector Maps</a></li>
               </ul>
            </li>
            <li><a href="calendar.html"><i class="icon-ok"></i> Calendar</a></li>
            <li><a href="gallery.html"><i class="icon-camera"></i> Gallery</a></li>
            <li class="has-sub">
               <a href="javascript:;">
               <i class="icon-plane"></i> Sample Pages
               <span class="arrow"></span>
               </a>
               <ul class="sub">
                  <li><a href="sample_blank.html">Blank Page</a></li>
                  <li><a  href="sample_sidebar_closed.html">Sidebar Closed Page</a></li>
                  <li><a href="sample_pricing_tables.html">Pricing Tables</a></li>
                  <li><a href="sample_faq.html">FAQ</a></li>
               </ul>
            </li>
            <li><a href="login.html"><i class="icon-user"></i> Login Page</a></li>
         </ul>
         <!-- END SIDEBAR MENU -->
      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->
      <div id="body">
         <!-- BEGIN SAMPLE widget CONFIGURATION MODAL FORM-->
         <div id="widget-config" class="modal hide">
            <div class="modal-header">
               <button data-dismiss="modal" class="close" type="button"></button>
               <h3>widget Settings</h3>
            </div>
            <div class="modal-body">
               <p>Here will be a configuration form</p>
            </div>
         </div>
         <!-- END SAMPLE widget CONFIGURATION MODAL FORM-->
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN STYLE CUSTOMIZER-->
                  <div id="styler" class="hidden-phone">
                     <i class="icon-cog"></i>
                     <span class="settings">
                     <span class="text">Style:</span>
                     <span class="colors">
                     <span class="color-default" data-style="default">
                     </span>
                     <span class="color-grey" data-style="grey">
                     </span>
                     <span class="color-navygrey" data-style="navygrey">
                     </span>
                     <span class="color-red" data-style="red">
                     </span>
                     </span>
                     <span class="layout">
                     <label class="hidden-phone">
                     <input type="checkbox" class="header" checked value="" />Sticky Header
                     </label><br />
                     <label><input type="checkbox" class="metro" value="" />Metro Style</label>
                     </span>
                     </span>
                  </div>
                  <!-- END STYLE CUSTOMIZER-->
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                  <h3 class="page-title">
                     Basic Tables
                     <small>table samples</small>
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="index.html">Home</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Data Tables</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Basic Tables</a>
                     </li>
                  </ul>
                  <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span6">
                  <!-- BEGIN SAMPLE TABLE widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-reorder"></i>Simple Table</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                        <a href="javascript:;" class="icon-refresh"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                     </div>
                     <div class="widget-body">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th class="hidden-phone">Username</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>1</td>
                                 <td>Mark</td>
                                 <td>Otto</td>
                                 <td class="hidden-phone">makr124</td>
                                 <td><span class="label label-success">Approved</span></td>
                              </tr>
                              <tr>
                                 <td>2</td>
                                 <td>Jacob</td>
                                 <td>Nilson</td>
                                 <td class="hidden-phone">jac123</td>
                                 <td><span class="label label-info">Pending</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Larry</td>
                                 <td>Cooper</td>
                                 <td class="hidden-phone">lar</td>
                                 <td><span class="label label-warning">Suspended</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Sandy</td>
                                 <td>Lim</td>
                                 <td class="hidden-phone">sanlim</td>
                                 <td><span class="label label-danger">Blocked</span></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- END SAMPLE TABLE widget-->
               </div>
               <div class="span6">
                  <!-- BEGIN BORDERED TABLE widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-reorder"></i>Bordered Table</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                        <a href="javascript:;" class="icon-refresh"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                     </div>
                     <div class="widget-body">
                        <table class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th class="hidden-phone">Username</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>1</td>
                                 <td>Mark</td>
                                 <td>Otto</td>
                                 <td class="hidden-phone">makr124</td>
                                 <td><span class="label label-success">Approved</span></td>
                              </tr>
                              <tr>
                                 <td>2</td>
                                 <td>Jacob</td>
                                 <td>Nilson</td>
                                 <td class="hidden-phone">jac123</td>
                                 <td><span class="label label-info">Pending</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Larry</td>
                                 <td>Cooper</td>
                                 <td class="hidden-phone">lar</td>
                                 <td><span class="label label-warning">Suspended</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Sandy</td>
                                 <td>Lim</td>
                                 <td class="hidden-phone">sanlim</td>
                                 <td><span class="label label-danger">Blocked</span></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- END BORDERED TABLE widget-->
               </div>
            </div>
            <div class="row-fluid">
               <div class="span6">
                  <!-- BEGIN SAMPLE TABLE widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-reorder"></i>Striped Table</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                        <a href="javascript:;" class="icon-refresh"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                     </div>
                     <div class="widget-body">
                        <table class="table table-striped table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th class="hidden-phone">Username</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>1</td>
                                 <td>Mark</td>
                                 <td>Otto</td>
                                 <td class="hidden-phone">makr124</td>
                                 <td><span class="label label-success">Approved</span></td>
                              </tr>
                              <tr>
                                 <td>2</td>
                                 <td>Jacob</td>
                                 <td>Nilson</td>
                                 <td class="hidden-phone">jac123</td>
                                 <td><span class="label label-info">Pending</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Larry</td>
                                 <td>Cooper</td>
                                 <td class="hidden-phone">lar</td>
                                 <td><span class="label label-warning">Suspended</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Sandy</td>
                                 <td>Lim</td>
                                 <td class="hidden-phone">sanlim</td>
                                 <td><span class="label label-danger">Blocked</span></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- END SAMPLE TABLE widget-->
               </div>
               <div class="span6">
                  <!-- BEGIN CONDENSED TABLE widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-reorder"></i>Condensed Table</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                        <a href="javascript:;" class="icon-refresh"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                     </div>
                     <div class="widget-body">
                        <table class="table table-condensed table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th class="hidden-phone">Username</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>1</td>
                                 <td>Mark</td>
                                 <td>Otto</td>
                                 <td class="hidden-phone">makr124</td>
                                 <td><span class="label label-success">Approved</span></td>
                              </tr>
                              <tr>
                                 <td>2</td>
                                 <td>Jacob</td>
                                 <td>Nilson</td>
                                 <td class="hidden-phone">jac123</td>
                                 <td><span class="label label-info">Pending</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Larry</td>
                                 <td>Cooper</td>
                                 <td class="hidden-phone">lar</td>
                                 <td><span class="label label-warning">Suspended</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Sandy</td>
                                 <td>Lim</td>
                                 <td class="hidden-phone">sanlim</td>
                                 <td><span class="label label-danger">Blocked</span></td>
                              </tr>
                              <tr>
                                 <td>4</td>
                                 <td>Sandy</td>
                                 <td>Lim</td>
                                 <td class="hidden-phone">sanlim</td>
                                 <td><span class="label label-danger">Blocked</span></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- END CONDENSED TABLE widget-->
               </div>
            </div>
            <div class="row-fluid">
               <div class="span6">
                  <!-- BEGIN SAMPLE TABLE widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-cogs"></i>Advance Table</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                        <a href="javascript:;" class="icon-refresh"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                     </div>
                     <div class="widget-body">
                        <table class="table table-striped table-bordered table-advance table-hover">
                           <thead>
                              <tr>
                                 <th><i class="icon-briefcase"></i> Company</th>
                                 <th class="hidden-phone"><i class="icon-user"></i> Contact</th>
                                 <th><i class="icon-shopping-cart"></i> Total</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td class="highlight">
                                    <div class="success"></div>
                                    <a href="#">RedBull</a>
                                 </td>
                                 <td class="hidden-phone">Mike Nilson</td>
                                 <td>2560.60$</td>
                                 <td><a href="#" class="btn mini purple"><i class="icon-edit"></i> Edit</a></td>
                              </tr>
                              <tr>
                                 <td class="highlight">
                                    <div class="info"></div>
                                    <a href="#">Google</a>
                                 </td>
                                 <td class="hidden-phone">Adam Larson</td>
                                 <td>560.60$</td>
                                 <td><a href="#" class="btn mini black"><i class="icon-trash"></i> Delete</a></td>
                              </tr>
                              <tr>
                                 <td class="highlight">
                                    <div class="important"></div>
                                    <a href="#">Apple</a>
                                 </td>
                                 <td class="hidden-phone">Daniel Kim</td>
                                 <td>3460.60$</td>
                                 <td><a href="#" class="btn mini purple"><i class="icon-edit"></i> Edit</a></td>
                              </tr>
                              <tr>
                                 <td class="highlight">
                                    <div class="warning"></div>
                                    <a href="#">Microsoft</a>
                                 </td>
                                 <td class="hidden-phone">Nick </td>
                                 <td>2560.60$</td>
                                 <td><a href="#" class="btn mini blue"><i class="icon-share"></i> Share</a></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- END SAMPLE TABLE widget-->
               </div>
               <div class="span6">
                  <!-- BEGIN SAMPLE TABLE widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-cogs"></i>Advance Table</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                        <a href="javascript:;" class="icon-refresh"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                     </div>
                     <div class="widget-body">
                        <table class="table table-striped table-bordered table-advance table-hover">
                           <thead>
                              <tr>
                                 <th><i class="icon-briefcase"></i> From</th>
                                 <th class="hidden-phone"><i class="icon-question-sign"></i> Descrition</th>
                                 <th><i class="icon-bookmark"></i> Total</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td><a href="#">Pixel Ltd</a></td>
                                 <td class="hidden-phone">Server hardware purchase</td>
                                 <td>52560.10$ <span class="label label-success label-mini">Paid</span></td>
                                 <td><a href="#" class="btn mini green-stripe">View</a></td>
                              </tr>
                              <tr>
                                 <td>
                                    <a href="#">
                                    Smart House
                                    </a>
                                 </td>
                                 <td class="hidden-phone">Office furniture purchase</td>
                                 <td>5760.00$ <span class="label label-warning label-mini">Pending</span></td>
                                 <td><a href="#" class="btn mini blue-stripe">View</a></td>
                              </tr>
                              <tr>
                                 <td>
                                    <a href="#">
                                    FoodMaster Ltd
                                    </a>
                                 </td>
                                 <td class="hidden-phone">Company Anual Dinner Catering</td>
                                 <td>12400.00$ <span class="label label-success label-mini">Paid</span></td>
                                 <td><a href="#" class="btn mini blue-stripe">View</a></td>
                              </tr>
                              <tr>
                                 <td>
                                    <a href="#">
                                    WaterPure Ltd
                                    </a>
                                 </td>
                                 <td class="hidden-phone">Payment for Jan 2013</td>
                                 <td>610.50$ <span class="label label-danger label-mini">Overdue</span></td>
                                 <td><a href="#" class="btn mini red-stripe">View</a></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- END SAMPLE TABLE widget-->
               </div>
            </div>
            <!-- END PAGE CONTENT-->
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
   <div id="footer">
      2013 &copy; Conquer. Admin Dashboard Template.
      <div class="span pull-right">
         <span class="go-top"><i class="icon-arrow-up"></i></span>
      </div>
   </div>
   <!-- END FOOTER -->
   <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <!--  script src="assets/js/jquery-1.8.3.min.js"></script-->
   <script src="js/bootstrap.min.js"></script>
   <!--  script src="assets/js/jquery.blockui.js"></script-->
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <!--  script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script-->
   <!--  script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script-->
   <!--  script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script-->
   <script src="js/app.js"></script>
   <script>
      jQuery(document).ready(function() {
         // initiate layout and plugins
         App.init();
      });
   </script>
</body>
<!-- END BODY -->
</html>
