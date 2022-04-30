<?php 
use Joomla\CMS\HTML\HTMLHelper;
defined('_JEXEC') or die ('Restricted access');
$app	= JFactory::getApplication();
$doc = JFactory::getDocument();
$baseurl = $doc->baseurl;
$temp_name = $doc->template;
if(array_key_exists(''.$baseurl.'/templates/'.$temp_name.'/js/jui/bootstrap.min.js' , $doc->_scripts)) {
unset($doc->_scripts[''.$baseurl.'/templates/'.$temp_name.'/js/jui/bootstrap.min.js']);
}
$main_navid = '';
?>
<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<jdoc:include type="head" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php global $template_path;
$template_path = JURI::base() . 'templates/' . $app->getTemplate();
HTMLHelper::_('jquery.framework');
$doc->addScript(JURI::base() .'/templates/' . $this->template . '/js/jui/popper.min.js', 'text/javascript');
$doc->addScript(JURI::base() .'/templates/' . $this->template . '/js/jui/bootstrap.min.js', 'text/javascript');
$doc->addScript(JURI::base() .'/templates/' . $this->template . '/js/jui/jquery-ui-1.9.2.custom.min.js', 'text/javascript');
$doc->addStyleSheet('templates/'.$this->template.'/css/bootstrap.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');
$doc->addStyleSheet( $this->baseurl . '/media/vendor/fontawesome-free/css/fontawesome.min.css' );
$style = $this->params->get('custom_css');
if (($style || $style == Null) && !empty($style)) {
 $doc->addStyleDeclaration($style);
}
$doc->addScript($template_path.'/js/totop.js');
$doc->addScript($template_path.'/js/tt_animation.js');
$user = JFactory::getUser();
$frontediting = ($app->isClient('site') && $app->get('frontediting', 1) && !$user->guest);
if ( $frontediting ) {
JHtml::_('script', 'system/frontediting.js', array('version' => 'auto', 'relative' => true));
}
$doc->addScript($template_path.'/js/customjs.js');
$doc->addScript($template_path.'/js/tt_slideshow.js');
?>
<?php $str = JURI::base(); ?>
<style type="text/css">
<?php $bg = $this->params->get('header_background');
if(!empty($bg)){ ?>
header #ttr_header_inner {
background: url('<?php echo $str.$this->params->get('header_background');?>') no-repeat
<?php 
$stretch = "";
$stretch_option = $this->params->get('header_stretch');
if($stretch_option == "Uniform"){
$stretch = "/ contain";
}else if($stretch_option == "Uniform to fill"){
$stretch = "/ cover";
}
else if($stretch_option == "Fill"){
$stretch = " / 100% 100% ";
}
else if($stretch_option == "Fill"){
$stretch = " / auto auto ";
}
echo $this->params->get('header_horizontal_alignment') ." " . $this->params->get('header_vertical_alignment'). $stretch ."!important; }";
} ?>
@media (min-width:1024px){.ttr_title_style, header .ttr_title_style a, header .ttr_title_style a:link, header .ttr_title_style a:visited, header .ttr_title_style a:hover {
font-size:<?php echo $this->params->get('Site_Title_FontSize'); ?>px;
<?php $color = $this->params->get('site_title_color');
if ( $color ) {
echo 'color: ' .  $color . ';';
} ?>
}
.ttr_slogan_style {
font-size:<?php echo $this->params->get('Site_Slogan_FontSize'); ?>px;
<?php $color = $this->params->get('site_slogan_color');
if ( $color ) {
echo 'color: ' .  $color . ';';
} ?>
}
h1.ttr_block_heading, h2.ttr_block_heading, h3.ttr_block_heading, h4.ttr_block_heading, h5.ttr_block_heading, h6.ttr_block_heading, p.ttr_block_heading {
font-size:<?php echo $this->params->get('block_heading_font_size'); ?>px;
<?php $color = $this->params->get('block_heading_color');
if ( $color ) {
echo 'color: ' .  $color . ';';
} ?>
}
h1.ttr_verticalmenu_heading, h2.ttr_verticalmenu_heading, h3.ttr_verticalmenu_heading, h4.ttr_verticalmenu_heading, h5.ttr_verticalmenu_heading, h6.ttr_verticalmenu_heading, p.ttr_verticalmenu_heading {
font-size:<?php echo $this->params->get('sidebar_menu_font_size'); ?>px;
<?php $color = $this->params->get('sidebar_menu_heading_color');
if ( $color ) {
echo 'color: ' .  $color . ';';
} ?>
}
footer#ttr_footer #ttr_copyright a:not(.btn),#ttr_copyright a {
font-size:<?php echo $this->params->get('Copyright_FontSize'); ?>px;
<?php $color = $this->params->get('footer_copyright_color');
if ( $color ) {
echo 'color: ' .  $color . ';';
} ?>
}
#ttr_footer_designed_by_links span#ttr_footer_designed_by {
font-size:<?php echo $this->params->get('Designed_By_FontSize'); ?>px;
<?php $color = $this->params->get('footer_designed_by_color');
if ( $color ) {
echo 'color: ' .  $color . ';';
} ?>
}
 footer#ttr_footer #ttr_footer_designed_by_links a:not(.btn) , footer#ttr_footer_designed_by_links a:link:not(.btn), footer#ttr_footer_designed_by_links a:visited:not(.btn), footer#ttr_footer_designed_by_links a:hover:not(.btn) {
font-size:<?php echo $this->params->get('Designed_By_Link_FontSize'); ?>px;
<?php $color = $this->params->get('footer_designed_by_link_color');
if ( $color ) {
echo 'color: ' .  $color . ';';
} ?>
}
}
}
</style>
<?php
echo '<style type="text/css">';
$modulelist = JModuleHelper::getModuleList();
foreach ($modulelist as $module) {
if($module->module === 'mod_menu') {
$moduleParams = new JRegistry($module->params);
$module_style = $moduleParams->get('module_style');
if ($module_style === 'custom_style') {
$active_color = $moduleParams->get('active_color');
$hover_color = $moduleParams->get('hover_color');
$normal_color = $moduleParams->get('normal_color');
if ($module->position === 'Menu' && (!empty($active_color) || !empty($hover_color) || !empty($normal_color))) {
$main_navid = 'id="nav_menu-' .$module->id. '" ';
}
if (!empty($active_color)) {
echo '#nav_menu-' .$module->id. ' ul li.active a {color:'.$active_color.';}';
}
if (!empty($hover_color)) {
echo '#nav_menu-' . $module->id . ' ul li a:hover, #nav_menu-' . $module->id . ' li:hover ul.child li a:hover, #nav_menu-' . $module->id . ' li:hover ul.sub-menu li a:hover {color:'.$hover_color.';}';
}
if (!empty($normal_color)) {
echo '#nav_menu-' .$module->id. ' ul li a, #nav_menu-' . $module->id . ' ul.child li a, #nav_menu-' . $module->id . ' li:hover ul.sub-menu li a, #nav_menu-' .$module->id. ' li a:visited, #nav_menu-' .$module->id. ' li a:focus {color:'.$normal_color.';}';
}
}
}
}
echo '</style>';
?>
<?php
?>
<!--[if lte IE 8]>
<link rel="stylesheet"  href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/menuie.css" type="text/css"/>
<link rel="stylesheet"  href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/vmenuie.css" type="text/css"/>
<![endif]-->
<!--[if IE 7]>
<style type="text/css" media="screen">
#ttr_vmenu_items  li.ttr_vmenu_items_parent {display:inline;}
</style>
<![endif]-->
<!--[if lt IE 9]>
$doc->addScript($template_path.'/js/html5shiv.js');
$doc->addScript($template_path.'/js/respond.js');
<![endif]-->
</head>
<?php
$input = JFactory::getApplication()->input;
$option = $app->input->getCmd('option');
$catname = strtolower($app->getUserState( '$option.categoryname'));
$view = $input->get('view');
$view   = $input->getCmd('view');
$catid = $input->getCmd('catid');
if ($view =="article") { 
$item_id = $input->getInt('id');
$table = JTable::getInstance('content', 'JTable');
$table->load($item_id);
if (($catid && $catname !== 'page') || (!isset($catid) && $catname !== 'page')) {
echo'<body  class="'.$table->alias.' blog-wp">';
} else {
echo'<body  class="'.$table->alias.'">';
}
} else {
echo'<body class="blog-wp">';
}
?>
<div class="totopshow">
<a href="#" class="back-to-top"><img alt="Back to Top" src="<?php echo $template_path?>/images/gototop.png"/></a>
</div>
<div class="margin_collapsetop"></div>
<div class="ttr_banner_header">
<?php
if(  $this->countModules('HAModulePosition00')||  $this->countModules('HAModulePosition01')||  $this->countModules('HAModulePosition02')||  $this->countModules('HAModulePosition03')):
?>
<div class="ttr_banner_header_inner_above_widget_container">
<div class="ttr_banner_header_inner_above0 container row">
<?php
$showcolumn= $this->countModules('HAModulePosition00');
?>
<?php if($showcolumn): ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="headerabovecolumn1">
<jdoc:include type="modules" name="HAModulePosition00" style="<?php if(($this->params->get('hamoduleposition00') == 'block') || ($this->params->get('hamoduleposition00') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('HAModulePosition01');
?>
<?php if($showcolumn): ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="headerabovecolumn2">
<jdoc:include type="modules" name="HAModulePosition01" style="<?php if(($this->params->get('hamoduleposition01') == 'block') || ($this->params->get('hamoduleposition01') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('HAModulePosition02');
?>
<?php if($showcolumn): ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="headerabovecolumn3">
<jdoc:include type="modules" name="HAModulePosition02" style="<?php if(($this->params->get('hamoduleposition02') == 'block') || ($this->params->get('hamoduleposition02') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('HAModulePosition03');
?>
<?php if($showcolumn): ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="headerabovecolumn4">
<jdoc:include type="modules" name="HAModulePosition03" style="<?php if(($this->params->get('hamoduleposition03') == 'block') || ($this->params->get('hamoduleposition03') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
</div>
</div>
<div style="clear: both;"></div>
<?php endif; ?>
</div>
<div class="margin_collapsetop"></div>
<header id="ttr_header">
<div class="margin_collapsetop"></div>
<div id="ttr_header_inner">
<div class="innermenu"><div class="margin_collapsetop"></div>
<?php if ($this->countModules('Menu')):?>
<div id="ttr_menu"> 
<div class="margin_collapsetop"></div>
<nav <?php echo $main_navid;?>class="navbar-default navbar-expand-md navbar">
<div id="ttr_menu_inner_in">
<div class="ttr_menu_element_alignment container">
</div>
<div id="navigationmenu">
<div class="navbar-header">
<button id="nav-expander" data-target=".nav-menu" data-toggle="collapse" class="navbar-toggle" type="button">
<span class="ttr_menu_toggle_button">
<span class="sr-only">
</span>
<span class="icon-bar navbar-toggler-icon">
</span>
<span class="icon-bar navbar-toggler-icon">
</span>
<span class="icon-bar navbar-toggler-icon">
</span>
</span>
<span class="ttr_menu_button_text">
Menu
</span>
</button>
</div>
<div class="menu-center collapse navbar-collapse nav-menu">
<jdoc:include type="modules" name="Menu" style="none"/>
</div>
</div>
<div class="ttr_images_container">
<div class="ttr_menu_logo">
</div>
</div>
</div>
</nav>
</div>
<?php endif; ?>

</div>
<?php if (($this->params->get('enable_site_Title')) || ($this->params->get('enable_site_Title') == Null)): ?>
<div class="ttr_title_position">
<?php $heading_tag = 'h3';
$temp = $this->params->get('Site_Title_Heading_Tag');
if($temp != Null)
$heading_tag = $temp;?>
<<?php echo $heading_tag; ?> class="ttr_title_style">
<a href="<?php echo $app->getCfg('live_site');?>">
<?php echo $this->params->get('Site_Title');?>
</a>
</<?php echo $heading_tag; ?>>
</div>
<?php endif; ?>
<?php if (($this->params->get('enable_site_slogan')) || ($this->params->get('enable_site_slogan') == Null)): ?>
<div class="ttr_slogan_position">
<?php $slogan_tag = 'h3';
$temp = $this->params->get('Site_Slogan_Heading_Tag');
if($temp != Null)
$slogan_tag = $temp;?>
<<?php echo $slogan_tag; ?> class="ttr_slogan_style">
<?php echo $this->params->get('Site_Slogan');?>
</<?php echo $slogan_tag; ?>>
</div>
<?php endif; ?>
<div class="ttr_header_element_alignment container">
<div class="ttr_images_container">
</div>
</div>
<div class="ttr_images_container">
<?php if (($this->params->get('enable_facebook_icon_header')) || ($this->params->get('enable_facebook_icon_header') == Null)): ?>
<a target="_self" href="<?php echo $this->params->get('facebook_Url_header');?>">
<img <?php if($this->params->get('facebook_icon_Image_header')!=""):?> src="<?php echo $this->params->get('facebook_icon_Image_header');?>" <?php else:?> src="<?php echo (JURI::base() . 'templates/' . $app->getTemplate().'/images/headerfacebook.png')?>" <?php endif; ?> alt="headerfacebook" class="ttr_header_facebook "/>
</a>
<?php endif; ?>
<?php if (($this->params->get('enable_Twitter_icon_header')) || ($this->params->get('enable_Twitter_icon_header') == Null)): ?>
<a target="_self" href="<?php echo $this->params->get('twitter_Url_header');?>">
<img <?php if($this->params->get('Twitter_icon_Image_header')!=""):?> src="<?php echo $this->params->get('Twitter_icon_Image_header');?>" <?php else:?> src="<?php echo (JURI::base() . 'templates/' . $app->getTemplate().'/images/headertwitter.png')?>" <?php endif; ?> alt="headertwitter" class="ttr_header_twitter "/>
</a>
<?php endif; ?>
<?php if (($this->params->get('enable_instagram_icon_header')) || ($this->params->get('enable_instagram_icon_header') == Null)): ?>
<a target="_self" href="<?php echo $this->params->get('instagram_Url_header');?>">
<img <?php if($this->params->get('Instagram_icon_Image_header')!=""):?> src="<?php echo $this->params->get('Instagram_icon_Image_header');?>" <?php else:?> src="<?php echo (JURI::base() . 'templates/' . $app->getTemplate().'/images/headerinstagram.png')?>" <?php endif; ?> alt="headerinstagram" class="ttr_header_instagram "/>
</a>
<?php endif; ?>
<div class="ttr_header_logo ">
<?php
if($this->params->get('site_logo_Image')!='')
{
$logo_image_path = $this->params->get('site_logo_Image');
}
else
{
	$logo_image_path = '';
}
$linkpath = $this->params->get('site_logo_navigation');
 if(!empty($linkpath) && $logo_image_path != '' && $this->params->get('enable_site_logo') && $this->params->get('enable_site_logo_link'))
{
?>
<a class="logo" href=<?php echo $linkpath; ?> target="">
<?php } ?>
<?php if ($this->params->get('enable_site_logo') && $logo_image_path != ''): ?>
<img src="<?php echo $logo_image_path; ?>" class="" />
<?php endif; ?>
<?php if(!empty($linkpath) && $this->params->get('enable_site_logo_link'))
{ 
echo "</a>"; 
} ?>
</div>
</div>
</div>
</header>
<div class="ttr_banner_header">
<?php
if(  $this->countModules('HBModulePosition00')||  $this->countModules('HBModulePosition01')||  $this->countModules('HBModulePosition02')||  $this->countModules('HBModulePosition03')):
?>
<div class="ttr_banner_header_inner_below_widget_container">
<div class="ttr_banner_header_inner_below0 container row">
<?php
$showcolumn= $this->countModules('HBModulePosition00');
?>
<?php if($showcolumn): ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="headerbelowcolumn1">
<jdoc:include type="modules" name="HBModulePosition00" style="<?php if(($this->params->get('hbmoduleposition00') == 'block') || ($this->params->get('hbmoduleposition00') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('HBModulePosition01');
?>
<?php if($showcolumn): ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="headerbelowcolumn2">
<jdoc:include type="modules" name="HBModulePosition01" style="<?php if(($this->params->get('hbmoduleposition01') == 'block') || ($this->params->get('hbmoduleposition01') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('HBModulePosition02');
?>
<?php if($showcolumn): ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="headerbelowcolumn3">
<jdoc:include type="modules" name="HBModulePosition02" style="<?php if(($this->params->get('hbmoduleposition02') == 'block') || ($this->params->get('hbmoduleposition02') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('HBModulePosition03');
?>
<?php if($showcolumn): ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="headerbelowcolumn4">
<jdoc:include type="modules" name="HBModulePosition03" style="<?php if(($this->params->get('hbmoduleposition03') == 'block') || ($this->params->get('hbmoduleposition03') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
</div>
</div>
<div style="clear: both;"></div>
<?php endif; ?>
</div>
<div class="ttr_banner_slideshow">
<?php
if(  $this->countModules('SAModulePosition00')||  $this->countModules('SAModulePosition01')||  $this->countModules('SAModulePosition02')||  $this->countModules('SAModulePosition03')):
?>
<div class="ttr_banner_slideshow_inner_above_widget_container">
<div class="ttr_banner_slideshow_inner_above0 container row">
<?php
$showcolumn= $this->countModules('SAModulePosition00');
?>
<?php if($showcolumn): ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="slideshowabovecolumn1">
<jdoc:include type="modules" name="SAModulePosition00" style="<?php if(($this->params->get('samoduleposition00') == 'block') || ($this->params->get('samoduleposition00') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('SAModulePosition01');
?>
<?php if($showcolumn): ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="slideshowabovecolumn2">
<jdoc:include type="modules" name="SAModulePosition01" style="<?php if(($this->params->get('samoduleposition01') == 'block') || ($this->params->get('samoduleposition01') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('SAModulePosition02');
?>
<?php if($showcolumn): ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="slideshowabovecolumn3">
<jdoc:include type="modules" name="SAModulePosition02" style="<?php if(($this->params->get('samoduleposition02') == 'block') || ($this->params->get('samoduleposition02') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('SAModulePosition03');
?>
<?php if($showcolumn): ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="slideshowabovecolumn4">
<jdoc:include type="modules" name="SAModulePosition03" style="<?php if(($this->params->get('samoduleposition03') == 'block') || ($this->params->get('samoduleposition03') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
</div>
</div>
<div style="clear: both;"></div>
<?php endif; ?>
</div>
<?php
$str = JURI::base();
for( $i=0 ; $i<2 ; $i++ ){
if ($this->params->get('slideshow_image_' . $i)):
$hz_align = $this->params->get('horizontal_align' . $i);
$vc_align = $this->params->get('vertical_align' . $i);
$stretch_option = $this->params->get('stretch' . $i);
if (strtolower($stretch_option) == strtolower("Uniform")) {
$stretch = "/ contain";
}
else if (strtolower($stretch_option) == strtolower("Uniform to Fill")) {
$stretch = "/ cover";
}
else if (strtolower($stretch_option) == strtolower("Fill")) {
$stretch = "/ 100% 100%";
}
else  {
$stretch = "/ auto auto";
}
$style='#Slide'.$i.'{'
.'background:url('.$str.$this->params->get('slideshow_image_' . $i).')'
.'no-repeat '. $hz_align . ' ' . $vc_align . ' ' . $stretch.' !important;}';
$doc->addStyleDeclaration($style);
endif;
}?>
<?php function slideshow($module = '') {
global $template_path;
 ?>
<div class="ttr_slideshow">
<div class="margin_collapsetop"></div>
<div id="ttr_slideshow_inner">
<ul>
<li id="Slide0" class="ttr_slide" data-slideEffect="SlideRight">
<a href="http://templatetoaster.com/"></a>
<div class="ttr_slideshow_last">
<div class="ttr_slideshow_element_alignment container" data-begintime="0" data-effect="SlideRight" data-easing="linear" data-slide="None" data-duration="0">
</div>
</div>
</li>
<li id="Slide1" class="ttr_slide" data-slideEffect="SlideRight">
<a href="http://templatetoaster.com/"></a>
<div class="ttr_slideshow_last">
<div class="ttr_slideshow_element_alignment container" data-begintime="0" data-effect="SlideRight" data-easing="linear" data-slide="None" data-duration="0">
</div>
</div>
</li>
</ul>
</div>
<?php  } 
 $menu = $app->getMenu(); 
 $template   = $app->getTemplate(true); 
 $params     = $template->params; 
 $is_slide   = $params->get('enable_slide','1'); 
 if ($is_slide) { 
 slideshow($this); ?> 
<div class="ttr_slideshow_in">
<div class="ttr_slideshow_last">
<div class="ttr_slideshow_element_alignment container">
</div>
<div class="left-button">
</div>
<div id="nav"></div>
<div class="ttr_slideshow_logo">
</div>
<div class="right-button">
</div>
</div>
</div>
</div>
<?php } 
 else { 
$lang = JFactory::getLanguage();
$isHome = $menu->getActive() == $menu->getDefault($lang->getTag());
 if ($isHome) {
 slideshow($this); ?>
<div class="ttr_slideshow_in">
<div class="ttr_slideshow_last">
<div class="left-button">
</div>
<div id="nav"></div>
<div class="ttr_slideshow_logo">
</div>
<div class="right-button">
</div>
</div>
</div>
</div>
<?php  }} ?>
<div class="ttr_banner_slideshow">
<?php
if(  $this->countModules('SBModulePosition00')||  $this->countModules('SBModulePosition01')||  $this->countModules('SBModulePosition02')||  $this->countModules('SBModulePosition03')):
?>
<div class="ttr_banner_slideshow_inner_below_widget_container">
<div class="ttr_banner_slideshow_inner_below0 container row">
<?php
$showcolumn= $this->countModules('SBModulePosition00');
?>
<?php if($showcolumn): ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="slideshowbelowcolumn1">
<jdoc:include type="modules" name="SBModulePosition00" style="<?php if(($this->params->get('sbmoduleposition00') == 'block') || ($this->params->get('sbmoduleposition00') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('SBModulePosition01');
?>
<?php if($showcolumn): ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="slideshowbelowcolumn2">
<jdoc:include type="modules" name="SBModulePosition01" style="<?php if(($this->params->get('sbmoduleposition01') == 'block') || ($this->params->get('sbmoduleposition01') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('SBModulePosition02');
?>
<?php if($showcolumn): ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="slideshowbelowcolumn3">
<jdoc:include type="modules" name="SBModulePosition02" style="<?php if(($this->params->get('sbmoduleposition02') == 'block') || ($this->params->get('sbmoduleposition02') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('SBModulePosition03');
?>
<?php if($showcolumn): ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="slideshowbelowcolumn4">
<jdoc:include type="modules" name="SBModulePosition03" style="<?php if(($this->params->get('sbmoduleposition03') == 'block') || ($this->params->get('sbmoduleposition03') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
</div>
</div>
<div style="clear: both;"></div>
<?php endif; ?>
</div>
<div class="margin_collapsetop"></div>
<div id="ttr_page"  class="container">
<div id="ttr_content_and_sidebar_container">
<?php
$showright= $this->countModules('right');
?>
<?php
if($showright){
?>
<div id="ttr_content">
<?php
}
else{
?>
<div id="ttr_content" class="zero_column" style="width:100%">
<?php
}
?>
<?php if ($view =="article") : ?>
<?php $content_id ="ttr_html_content_margin" ?>
<?php else : ?>
<?php $content_id ="ttr_content_margin" ?>
<?php  endif; ?>
<div id="<?php echo $content_id; ?>">
<div class="margin_collapsetop"></div>
<?php
if(  $this->countModules('CAModulePosition00')||  $this->countModules('CAModulePosition01')||  $this->countModules('CAModulePosition02')||  $this->countModules('CAModulePosition03')):
?>
<div class="ttr_topcolumn_widget_container">
<div class="contenttopcolumn0 row">
<?php
$showcolumn= $this->countModules('CAModulePosition00');
?>
<?php if($showcolumn): ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="topcolumn1">
<jdoc:include type="modules" name="CAModulePosition00" style="<?php if(($this->params->get('camoduleposition00') == 'block') || ($this->params->get('camoduleposition00') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('CAModulePosition01');
?>
<?php if($showcolumn): ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="topcolumn2">
<jdoc:include type="modules" name="CAModulePosition01" style="<?php if(($this->params->get('camoduleposition01') == 'block') || ($this->params->get('camoduleposition01') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('CAModulePosition02');
?>
<?php if($showcolumn): ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="topcolumn3">
<jdoc:include type="modules" name="CAModulePosition02" style="<?php if(($this->params->get('camoduleposition02') == 'block') || ($this->params->get('camoduleposition02') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('CAModulePosition03');
?>
<?php if($showcolumn): ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="topcolumn4">
<jdoc:include type="modules" name="CAModulePosition03" style="<?php if(($this->params->get('camoduleposition03') == 'block') || ($this->params->get('camoduleposition03') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
</div>
</div>
<div style="clear: both;"></div>
<?php endif; ?>
<jdoc:include type="message" style="width:100%;"/>
<jdoc:include type="component" />
<?php
if(  $this->countModules('CBModulePosition00')||  $this->countModules('CBModulePosition01')||  $this->countModules('CBModulePosition02')||  $this->countModules('CBModulePosition03')):
?>
<div class="ttr_bottomcolumn_widget_container">
<div class="contentbottomcolumn0 row">
<?php
$showcolumn= $this->countModules('CBModulePosition00');
?>
<?php if($showcolumn): ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="bottomcolumn1">
<jdoc:include type="modules" name="CBModulePosition00" style="<?php if(($this->params->get('cbmoduleposition00') == 'block') || ($this->params->get('cbmoduleposition00') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('CBModulePosition01');
?>
<?php if($showcolumn): ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="bottomcolumn2">
<jdoc:include type="modules" name="CBModulePosition01" style="<?php if(($this->params->get('cbmoduleposition01') == 'block') || ($this->params->get('cbmoduleposition01') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('CBModulePosition02');
?>
<?php if($showcolumn): ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="bottomcolumn3">
<jdoc:include type="modules" name="CBModulePosition02" style="<?php if(($this->params->get('cbmoduleposition02') == 'block') || ($this->params->get('cbmoduleposition02') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('CBModulePosition03');
?>
<?php if($showcolumn): ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="bottomcolumn4">
<jdoc:include type="modules" name="CBModulePosition03" style="<?php if(($this->params->get('cbmoduleposition03') == 'block') || ($this->params->get('cbmoduleposition03') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
</div>
</div>
<div style="clear: both;"></div>
<?php endif; ?>
<div class="margin_collapsetop"></div>
</div>
</div>
<?php if($showright) : ?>
<aside id="ttr_sidebar_right">
<div id="ttr_sidebar_right_margin">
<div class="margin_collapsetop"></div>
<jdoc:include type="modules" name="right" style="block" /> 
<div class="margin_collapsetop"></div>
</div>
</aside>
<?php endif; ?>
<div style="clear:both;"></div>
</div> <!--content_and_sidebar_container-->
</div> <!--ttr_page-->
<div class="footer-widget-area">
<div class="footer-widget-area_inner">
<?php
if(  $this->countModules('FAModulePosition00')||  $this->countModules('FAModulePosition01')||  $this->countModules('FAModulePosition02')||  $this->countModules('FAModulePosition03')):
?>
<div class="ttr_footer-widget-area_inner_above_widget_container">
<div class="ttr_footer-widget-area_inner_above0 container row">
<?php
$showcolumn= $this->countModules('FAModulePosition00');
?>
<?php if($showcolumn): ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="footerabovecolumn1">
<jdoc:include type="modules" name="FAModulePosition00" style="<?php if(($this->params->get('famoduleposition00') == 'block') || ($this->params->get('famoduleposition00') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('FAModulePosition01');
?>
<?php if($showcolumn): ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="footerabovecolumn2">
<jdoc:include type="modules" name="FAModulePosition01" style="<?php if(($this->params->get('famoduleposition01') == 'block') || ($this->params->get('famoduleposition01') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('FAModulePosition02');
?>
<?php if($showcolumn): ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="footerabovecolumn3">
<jdoc:include type="modules" name="FAModulePosition02" style="<?php if(($this->params->get('famoduleposition02') == 'block') || ($this->params->get('famoduleposition02') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('FAModulePosition03');
?>
<?php if($showcolumn): ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="footerabovecolumn4">
<jdoc:include type="modules" name="FAModulePosition03" style="<?php if(($this->params->get('famoduleposition03') == 'block') || ($this->params->get('famoduleposition03') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
</div>
</div>
<div style="clear: both;"></div>
<?php endif; ?>
</div>
</div>
<div class="margin_collapsetop"></div>
<footer id="ttr_footer">
<div class="margin_collapsetop"></div>
 <div id="ttr_footer_inner">
<?php
if(  $this->countModules('abc0')):
?>
<div class="ttr_footer-widget-cell_inner_widget_container">
<div class="ttr_footer-widget-cell_inner0 container row">
<?php
$showcolumn= $this->countModules('abc0');
?>
<?php if($showcolumn): ?>
<div class="cell1 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
<div>
<div class="footercellcolumn1">
<jdoc:include type="modules" name="abc0" style="<?php if(($this->params->get('abc0') == 'block') || ($this->params->get('abc0') == Null)): echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell1 col-xl-12 col-lg-12 col-md-12 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
</div>
</div>
<div style="clear: both;"></div>
<?php endif; ?>
<div id="ttr_footer_top_for_widgets">
<div class="ttr_footer_top_for_widgets_inner">
<?php 
if($this->countModules('LeftFooterArea') || $this->countModules('CenterFooterArea') || $this->countModules('RightFooterArea')):
?>
<div class="footer-widget-area_fixed row">
<div style="margin:0 auto;"></div>
<?php if($this->countModules('LeftFooterArea')): ?>
<div id="first" class="widget-area col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
<jdoc:include type="modules" name="LeftFooterArea" style="<?php if(($this->params->get('leftfooterarea') == 'block') || ($this->params->get('leftfooterarea') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
<div class="visible-xs d-block" style="clear:both;"></div>
<?php else: ?>
<div id="first" class="widget-area  col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12 ">
&nbsp;
</div>
<div class="visible-xs d-block" style="clear:both;"></div>
<?php endif; ?>
<?php if($this->countModules('CenterFooterArea')): ?>
<div id="second" class="widget-area  col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
<jdoc:include type="modules" name="CenterFooterArea" style="<?php if(($this->params->get('centerfooterarea') == 'block') || ($this->params->get('centerfooterarea') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
<div class="visible-xs d-block" style="clear:both;"></div>
<?php else: ?>
<div id="second" class="widget-area  col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
&nbsp;
</div>
<div class="visible-xs d-block" style="clear:both;"></div>
<?php endif; ?>
<?php if($this->countModules('RightFooterArea')): ?>
<div id="third" class="widget-area  col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
<jdoc:include type="modules" name="RightFooterArea" style="<?php if(($this->params->get('rightfooterarea') == 'block') || ($this->params->get('rightfooterarea') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
<div class="visible-lg visible-md visible-sm visible-xs d-xl-block d-lg-block d-md-block d-sm-block d-block" style="clear:both;"></div>
<?php else: ?>
<div id="third" class="widget-area  col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
&nbsp;
</div>
<div class="visible-lg visible-md visible-sm visible-xs d-xl-block d-lg-block d-md-block d-sm-block d-block" style="clear:both;"></div>
<?php endif; ?>
</div>
<?php endif; ?>
</div>
</div>
<div class="ttr_footer_bottom_footer">
<div class="ttr_footer_bottom_footer_inner">
<div class="ttr_footer_element_alignment container">
<div class="ttr_images_container">
</div>
</div>
<div class="ttr_images_container">
<?php if (($this->params->get('enable_facebook_icon')) || ($this->params->get('enable_facebook_icon') == Null)): ?>
<a target="_self" href="<?php echo $this->params->get('facebook_Url');?>">
<img <?php if($this->params->get('facebook_icon_Image')!=""):?> src="<?php echo $this->params->get('facebook_icon_Image');?>" <?php else:?> src="<?php echo (JURI::base() . 'templates/' . $app->getTemplate().'/images/footerfacebook.png')?>" <?php endif; ?> alt="footerfacebook" class="ttr_footer_facebook "/>
</a>
<?php endif; ?>
<?php if (($this->params->get('enable_Twitter_icon')) || ($this->params->get('enable_Twitter_icon') == Null)): ?>
<a target="_self" href="<?php echo $this->params->get('twitter_Url');?>">
<img <?php if($this->params->get('Twitter_icon_Image')!=""):?> src="<?php echo $this->params->get('Twitter_icon_Image');?>" <?php else:?> src="<?php echo (JURI::base() . 'templates/' . $app->getTemplate().'/images/footertwitter.png')?>" <?php endif; ?> alt="footertwitter" class="ttr_footer_twitter "/>
</a>
<?php endif; ?>
<?php if (($this->params->get('enable_instagram_icon')) || ($this->params->get('enable_instagram_icon') == Null)): ?>
<a target="_self" href="<?php echo $this->params->get('instagram_Url');?>">
<img <?php if($this->params->get('Instagram_icon_Image')!=""):?> src="<?php echo $this->params->get('Instagram_icon_Image');?>" <?php else:?> src="<?php echo (JURI::base() . 'templates/' . $app->getTemplate().'/images/footerinstagram.png')?>" <?php endif; ?> alt="footerinstagram" class="ttr_footer_instagram "/>
</a>
<?php endif; ?>
</div>
<?php if (($this->params->get('enable_Designed_By')) || ($this->params->get('enable_Designed_By') == Null)): ?>
<div id="ttr_footer_designed_by_links">
<a <?php if ($this->params->get('Designed_By')): ?> href="<?php echo $this->params->get('Designed_By');?>"<?php else: ?> href="<?php echo $app->getCfg('live_site');?>"<?php endif; ?> target="_self" >
Joomla Template
</a>
<span id="ttr_footer_designed_by">
Designed With TemplateToaster
</span>
</div>
<?php endif; ?>
</div>
</div>
</div>
</footer>
<div class="margin_collapsetop"></div>
<div class="footer-widget-area">
<div class="footer-widget-area_inner">
<?php
if(  $this->countModules('FBModulePosition00')||  $this->countModules('FBModulePosition01')||  $this->countModules('FBModulePosition02')||  $this->countModules('FBModulePosition03')):
?>
<div class="ttr_footer-widget-area_inner_below_widget_container">
<div class="ttr_footer-widget-area_inner_below0 container row">
<?php
$showcolumn= $this->countModules('FBModulePosition00');
?>
<?php if($showcolumn): ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="footerbelowcolumn1">
<jdoc:include type="modules" name="FBModulePosition00" style="<?php if(($this->params->get('fbmoduleposition00') == 'block') || ($this->params->get('fbmoduleposition00') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell1 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('FBModulePosition01');
?>
<?php if($showcolumn): ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="footerbelowcolumn2">
<jdoc:include type="modules" name="FBModulePosition01" style="<?php if(($this->params->get('fbmoduleposition01') == 'block') || ($this->params->get('fbmoduleposition01') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell2 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('FBModulePosition02');
?>
<?php if($showcolumn): ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="footerbelowcolumn3">
<jdoc:include type="modules" name="FBModulePosition02" style="<?php if(($this->params->get('fbmoduleposition02') == 'block') || ($this->params->get('fbmoduleposition02') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell3 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<?php
$showcolumn= $this->countModules('FBModulePosition03');
?>
<?php if($showcolumn): ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div>
<div class="footerbelowcolumn4">
<jdoc:include type="modules" name="FBModulePosition03" style="<?php if(($this->params->get('fbmoduleposition03') == 'block') || ($this->params->get('fbmoduleposition03') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
</div>
</div>
</div>
<?php else: ?>
<div class="cell4 col-xl-3 col-lg-3 col-md-6 col-sm-12  col-xs-12 col-12" style="background-color:transparent;">
&nbsp;
</div>
<?php endif; ?>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
</div>
</div>
<div style="clear: both;"></div>
<?php endif; ?>
</div>
</div>
<?php if ($this->countModules('debug')){ ?>
<jdoc:include type="modules" name="debug" style="<?php if(($this->params->get('debug') == 'block') || ($this->params->get('debug') == Null)): echo "block"; else: echo "xhtml"; endif;?>"/>
<?php } ?>
</body>
</html>
<?php
jimport( 'joomla.utilities.utility' );
if (!function_exists('templatetoaster_contact_form_generate_response'))
{
function templatetoaster_contact_form_generate_response($type, $message){
if($type == "success")
echo'<div class="success">{$message}</div>';
else
echo'<div class="error">{$message}</div>';
}
}
if (!function_exists('test_input')){    //user posted variables
function test_input($data) {  // escape and sanitize POST values
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
}
if(isset($_POST['submit_values']))  { 
$nameErr = $emailErr ="";
$name = $email = $gender = $comment = $body = $website = "";
$message_sent = 'Mail Sent successfully';
$message_fail = 'Error in mail sending';
$to ="";
if (isset($_POST['Name'])) {
$name = test_input($_POST['Name']);
if (!preg_match('/^[a-zA-Z ]*$/',$name)) {
$nameErr = "Only letters and white space allowed";
}
}
if (isset($_POST['email'])) {
$emailErr = "Email is required";
}
else {
 $email = test_input($_POST['email']);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Invalid email format";
}
}
if(isset($_POST['Subject']) && $_POST['Subject']) {
$subject = $_POST['Subject'];
} else {
$subject = JURI::base().'-contact-form';
}
$body .= 'Message:' .$_POST['message'];
if(empty($nameErr) && empty($emailErr))   {
$result = JFactory::getMailer()->sendMail($name, $email, $to, $subject, $body);
if($result) {
templatetoaster_contact_form_generate_response('success', $message_sent ); //message sent!
} else {
templatetoaster_contact_form_generate_response('error', $message_fail ); //message failure!
}
}
else {
if(!empty($nameErr)){
templatetoaster_contact_form_generate_response('error', $nameErr); //message wasn't sent
}  elseif(!empty($emailErr)) {
templatetoaster_contact_form_generate_response('error', $emailErr); //message wasn't sent
}
}
}
function get_url(string $name){
$url = JURI::root();
$query="SELECT id FROM #__menu WHERE alias ='".$name. "'";
$db = JFactory::getDBO();
$db->setQuery($query);
$article = $db->loadResult();
return 'index.php?Itemid='. $article ;
}
?>
