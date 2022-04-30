<?php
$app  = JFactory::getApplication();
$doc  = JFactory::getDocument();
$user = JFactory::getUser();
$templateparams = $app->getTemplate(true)->params;
$this->language = $doc->language;
$this->direction = $doc->direction;


// Social icons
$soc = array(
	"fa-twitter" => $this->params->get("twitter"),
	"fa-facebook" => $this->params->get("facebook"),
	"fa-flickr" => $this->params->get("flickr"),
	"fa-linkedin" => $this->params->get("linkedin"),
	"fa-youtube-play" => $this->params->get("youtube"),
	"fa-pinterest" => $this->params->get("pinterest"),
	"fa-google-plus" => $this->params->get("google"),
	"fa-dribbble" => $this->params->get("dribbble"),
	"fa-vimeo-square" => $this->params->get("vimeo"),
	"fa-instagram" => $this->params->get("instagram"),
	"fa-vk" => $this->params->get("vk")
);

require(JPATH_BASE."/templates/".$this->template."/function.php");

if(checkJavaScriptIncludedOS('jQuerOs-2.2.4.min.js') === false){
    $doc->addScript($this->baseurl."/templates/".$this->template."/javascript/jQuerOs-2.2.4.min.js");
    $doc->addScriptDeclaration('jQuerOs=jQuerOs.noConflict();');
}

// count Modules
$left	 = $this->countModules('SidebarLeft');
$right   = $this->countModules('SidebarRight');
$search  = $this->countModules('Search');
$topmenu = $this->countModules('topMenu');
$copyrights = $this->params->get("copyrights");

// Add Stylesheets
$doc->addStyleSheet($this->baseurl."/templates/".$this->template."/bootstrap/css/bootstrap.css");
$doc->addStyleSheet($this->baseurl."/templates/".$this->template."/css/style.css");
$doc->addStyleSheet($this->baseurl."/templates/".$this->template."/css/os_pages.css");

// Add Script
$doc->addScript($this->baseurl."/templates/".$this->template."/bootstrap/js/bootstrap.js");
$doc->addScript($this->baseurl."/templates/".$this->template."/javascript/custom.js");


//if(version_compare(JVERSION,"3.0.0","ge")){
 //  JHtml::_('bootstrap.framework');
//}  else {
   // $doc->addScript($this->baseurl."/templates/".$this->template."/bootstrap/js/bootstrap-joomin.js");
   //$doc->addScript($this->baseurl."/templates/".$this->template."/bootstrap/js/bootstrap.min.js");

//}

?>

<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">

<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic|Dosis:200,300,400,500,600,700,800|Abel|Droid+Sans:400,700|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Lora:400,700,400italic,700italic|PT+Sans:400,700,400italic,700italic|PT+Sans+Narrow:400,700|Quicksand:300,400,700|Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic|Lobster|Ubuntu+Condensed|Oxygen:400,300,700|Oswald:700,400,300|Open+Sans+Condensed:300,700,300italic|Roboto+Condensed:300italic,400italic,700italic,400,700,300|Open+Sans:300italic,400italic,600italic,700italic,800italic,800,700,400,600,300|Prosto+One|Francois+One|Comfortaa:700,300,400|Raleway:300,600,900,500,400,100,800,200,700|Roboto:300,700,500italic,900,300italic,400italic,900italic,100italic,100,500,400,700italic|Roboto+Slab:300,700,100,400|Share:700,700italic,400italic,400' rel='stylesheet' type='text/css'
>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

 <jdoc:include type="head" />

<script type="text/javascript"><?php echo $this->params->get('tracking_code')?></script>
<!--[if IE 7]> <link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/style_ie7.css" /> <![endif]-->
<!--[if IE 8]> <link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/style_ie8.css" /> <![endif]-->
<!--[if IE 9]> <link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/style_ie9.css" /> <![endif]-->

<?php 
	require_once  ( JPATH_BASE . '/templates/'.$this->template.
		'/template_details_style/template_details_style.inc.php');	
?>	



<?php 
if($this->params->get('expand_preloader') !== "0" ){
	require_once  ( JPATH_BASE . '/templates/'.$this->template.
		'/preloader/preloader_style.inc.php');	
}
?>	


<?php 
if($this->params->get('expand_preloader') !== "0" ){
	require_once  ( JPATH_BASE . '/templates/'.$this->template.
	'/preloader/preloader_script.inc.php');
}
?>	

</head>

<body>

<!--==============================================
=            preloader html structure            =
===============================================-->

<?php 
if($this->params->get('expand_preloader') !== "0" ){
	require_once  (JPATH_BASE . '/templates/'.$this->template.
	 '/preloader/preloader_html.inc.php');
}
?>	
<!--====  End of preloader html structure  ====-->

	<div class="header">
		<div id="header_top">
			<div class="container">
			
			<?php if ($search || $topmenu): ?>
				<div  class="row">
					 <?php if ($search): ?>
					    <div id="Search" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					    	<jdoc:include type="modules" name="Search" style="html5" />
					    </div>
					  <?php endif; ?>
					<?php if ($topmenu): ?>
					    <div class="top_menu<?php print (($search && $topmenu ) ? ' col-lg-8 col-md-8 col-sm-8 col-xs-12' : ' col-lg-12 col-md-12 col-sm-12 col-xs-12'); ?>">
							<div id="site-navigation-top" class="navbar" role="navigation">
								<div class="navbar-header">
							      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-navbar-collapse">
							        <i class="fa fa-bars"></i>
							      </button>
							    </div>
								<div id="top-navbar-collapse" class="collapse navbar-collapse navbar-ex1-collapse">
									<jdoc:include type="modules" name="topmenu" style="html5" />
								</div>
							</div><!-- #site-navigation -->
					    </div>
					  <?php endif; ?>
					</div>
			<?php endif ?>
			
				   
					<div class="row">
			
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<jdoc:include type="modules" name="Top1" style="html5" />
			
							<?php if ( $this->params->get('logo_file') ) { ?>
								    <div id="logo">
									  <a href="<?php echo $this->params->get('logo_link')?>">
									      <img src="<?php echo $this->params->get('logo_file')?>" alt="Logo" />
									  </a>
								    </div>
							<?php } ?>
			
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<jdoc:include type="modules" name="Top2" style="html5" />
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<jdoc:include type="modules" name="Top3" style="html5" />
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<jdoc:include type="modules" name="Top4" style="html5" />
						</div>
					</div>

					</div>
				</div> <!--id header_top-->
				  
			
				    <div id="header_bottom">
				    	<div class="container">
				    		<div class="row">
			
								<div class="soc_icons_box col-lg-3 col-lg-push-9 col-md-12 col-sm-12 col-xs-12">
										<ul class="soc_icons" >
											<?php foreach($soc as $key => $value) {
												if ($value != null) { ?>
													<li>
														<a href="<?php echo $value ?>" class="fa <?php echo $key ?>" target="_blank" rel="nofollow"></a>
													</li>
											<?php } } ?>
										</ul>
								</div>

								<?php if ($this->countModules('Mainmenu')): ?>
							    <div class="main_menu col-lg-9 col-lg-pull-3 col-md-12 col-sm-12 col-xs-12">
									<nav id="site-navigation-main" class="navbar" role="navigation">
										<div class="navbar-header">
									      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar-collapse">
									        <i class="fa fa-bars"></i>
									      </button>
									    </div>
										<div id="main-navbar-collapse" class="collapse navbar-collapse">
											<jdoc:include type="modules" name="Mainmenu" style="html5" />
										</div>
									</nav><!-- #site-navigation -->
							    </div>
							<?php endif; ?>

				    		</div>
				    	</div>
				    </div>
				    <!--id header_bottom-->

		 </div> <!--class header-->

		 	<?php if ($this->countModules('Slideshow')): ?>
				<div class="row map_block">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					    <jdoc:include type="modules" name="Slideshow" style="html5" />
					    <div class="container">
					    	<div class="row">
					    		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-3">
								    <jdoc:include type="modules" name="position-1" style="html5" />
					    		</div>
					    	</div>
					    </div>
					</div>
				</div>
		    <?php endif; ?>

		<div id="wrapper" class="container">
		    <?php if ($this->countModules('Breadcrumbs') || $this->countModules('position-0')): ?>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<jdoc:include type="modules" name="Breadcrumbs" style="html5" />
					<jdoc:include type="modules" name="position-0" style="html5" />
				</div>
			</div>
		    <?php endif; ?>

		    <?php if ($this->countModules('Feature1') || $this->countModules('position-2') || $this->countModules('Feature2') || $this->countModules('position-3') || $this->countModules('Feature3') || $this->countModules('position-4')): ?>
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<jdoc:include type="modules" name="Feature1" style="html5" />
					<jdoc:include type="modules" name="position-2" style="html5" />
				</div>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
					<jdoc:include type="modules" name="Feature2" style="html5" />
					<jdoc:include type="modules" name="position-3" style="html5" />
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<jdoc:include type="modules" name="Feature3" style="html5" />
					<jdoc:include type="modules" name="position-4" style="html5" />
				</div>
			</div>
		    <?php endif; ?>

			<div id="globalContent">

				<?php if ($this->countModules('ContentTop1') || $this->countModules('position-5') || $this->countModules('ContentTop2') || $this->countModules('position-6')): ?>
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<jdoc:include type="modules" name="ContentTop1" style="html5" />
							<jdoc:include type="modules" name="position-5" style="html5" />
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<jdoc:include type="modules" name="ContentTop2" style="html5" />
							<jdoc:include type="modules" name="position-6" style="html5" />
						</div>
					</div>
				<?php endif; ?>

			    <div class="row">
					<?php if ($left): ?>
					      <div class="sidebar-left col-lg-3 col-md-3 col-sm-3 col-xs-12"><jdoc:include type="modules" name="SidebarLeft" style="html5" /></div>
					<?php endif; ?>

						<div id="contentBox" class="<?php if ($left && $right) {print('col-lg-6 col-md-6 col-sm-6 col-xs-12');} else if ($left || $right) {print('col-lg-9 col-md-9 col-sm-9 col-xs-12');} else {print('col-lg-12 col-md-12 col-sm-12 col-xs-12');} ?>">
							<jdoc:include type="modules" name="location_map" style="html5" />
							<div><jdoc:include type="message" /></div>
							<div><jdoc:include type="component" /></div>

						</div>

					<?php if ($right): ?>
						<div class="sidebar-right col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<jdoc:include type="modules" name="SidebarRight" style="html5" />
						</div>
					<?php endif; ?>
			    </div>

				<?php if ($this->countModules('ContentBottom1') || $this->countModules('position-7') || $this->countModules('ContentBottom2') || $this->countModules('position-8')): ?>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<jdoc:include type="modules" name="ContentBottom1" style="html5" />
							<jdoc:include type="modules" name="position-7" style="html5" />
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<jdoc:include type="modules" name="ContentBottom2" style="html5" />
							<jdoc:include type="modules" name="position-8" style="html5" />
						</div>
					</div>
				<?php endif; ?>

			</div> <!--globalContent-->

		    <?php if ($this->countModules('Bottom1') || $this->countModules('position-9') || $this->countModules('Bottom2') || $this->countModules('position-10') || $this->countModules('Bottom3') || $this->countModules('position-11') || $this->countModules('Bottom4') || $this->countModules('position-12')): ?>
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<jdoc:include type="modules" name="Bottom1" style="html5" />
					<jdoc:include type="modules" name="position-9" style="html5" />
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<jdoc:include type="modules" name="Bottom2" style="html5" />
					<jdoc:include type="modules" name="position-10" style="html5" />
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<jdoc:include type="modules" name="Bottom3" style="html5" />
					<jdoc:include type="modules" name="position-11" style="html5" />
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<jdoc:include type="modules" name="Bottom4" style="html5" />
					<jdoc:include type="modules" name="position-12" style="html5" />
				</div>
			</div>
		    <?php endif; ?>
		</div> <!--wrapper-->

		<div id="footer">
		    <div class="container">
				

				<?php if ($this->countModules('Footer1') || $this->countModules('Footer2') || $this->countModules('Footer3') || $this->countModules('Footer4')): ?>
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<?php if ( $this->params->get('logo_file') ) { ?>
								    <div id="logo">
									  <a href="<?php echo $this->params->get('logo_link')?>">
									      <img src="<?php echo $this->params->get('logo_file')?>" alt="Logo" />
									  </a>
								    </div>
							<?php } ?>
							<jdoc:include type="modules" name="Footer1" style="html5" />
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<jdoc:include type="modules" name="Footer2" style="html5" />
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<jdoc:include type="modules" name="Footer3" style="html5" />
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<jdoc:include type="modules" name="Footer4" style="html5" />
						</div>
					</div>
				<?php endif; ?>

				<?php if ($this->countModules('position-13') ):?>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<jdoc:include type="modules" name="position-13" style="html5" />
						</div>
					</div>
				<?php endif; ?>

				<div class="content_footer row">
					<div class="copyrights col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<?php echo $copyrights; ?>
					</div>

					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<?php if ($this->countModules('footerMenu')): ?>
						<div class="footer_menu">
						<nav id="site-navigation-footer" class="navbar" role="navigation">
						<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#footer-navbar-collapse">
						<i class="fa fa-bars"></i>
						</button>
						</div>
						<div id="footer-navbar-collapse" class="collapse navbar-collapse">
						<jdoc:include type="modules" name="footerMenu" style="html5" />
						</div>
						</nav><!-- #site-navigation -->
						</div>
						<?php endif; ?>
					</div>

					<div class="soc_icons_box col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<ul class="soc_icons" >
							<?php foreach($soc as $key => $value) {
								if ($value != null) { ?>
									<li>
										<a href="<?php echo $value ?>" class="fa <?php echo $key ?>" target="_blank" rel="nofollow"></a>
									</li>
							<?php } } ?>
						</ul>
					</div>
				</div> <!--content_footer-->

				<?php if ( $this->countModules('position-14') || $this->countModules('debug')): ?>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<jdoc:include type="modules" name="position-14" style="html5" />
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<jdoc:include type="modules" name="debug" style="html5" />
						</div>
					</div>
				<?php endif; ?>
		    </div>
		</div> <!--id footer-->
	</body>
</html>