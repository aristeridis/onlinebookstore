<?php
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
$columnwidth=((100)/4).'%';
$app = Factory::getApplication();
$this->category->text = $this->category->description;
$app->triggerEvent('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;
$results = $app->triggerEvent('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));
$results = $app->triggerEvent('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));
$results = $app->triggerEvent('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));
?>
<div class=" com-content-category-blog blog" itemscope itemtype="https://schema.org/Blog">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<h1 class="ttr_page_title">
<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
<?php endif; ?>
<?php if ($this->params->get('show_category_title', 1) OR $this->params->get('page_subheading')) : ?>
<h3>
<?php echo $this->escape($this->params->get('page_subheading')); ?>
</h3>
<?php endif; ?>
<?php if ($this->params->get('show_category_title', 1) OR $this->params->get('show_description', 1)) : ?>
<article class="ttr_post list">
<div class="ttr_post_content_inner">
<?php if ($this->params->get('show_category_title')) : ?>
<div class="ttr_post_inner_box">
<h2 class="ttr_post_title">
<span class="subheading-category"><?php echo $this->category->title;?></span>
</h2>
</div>
<?php endif; ?>
<?php if (($this->params->get('show_description') && $this->category->description) || ($this->params->def('show_description_image') && $this->category->getParams()->get('image'))) : ?>
<div class="ttr_article">
<div class="postcontent">
<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
<img src="<?php echo $this->category->getParams()->get('image'); ?>" alt="description image"/>
<?php endif; ?>
<?php if ($this->params->get('show_description') && $this->category->description) : ?>
<?php echo JHtml::_('content.prepare', $this->category->description); ?>
<?php endif; ?>
<div style="clear: both;"></div>
</div>
</div>
<?php endif; ?>
</div>
</article>
<?php endif; ?>
<div class="row">
<?php $flag=0;?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<?php $flag=1;?>
<?php foreach ($this->lead_items as &$item) : ?>
<div class="col-xl-12 col-lg-12">
<article class="ttr_post list">
<div class="ttr_post_content_inner">
<?php
$this->item = &$item;
echo $this->loadTemplate('item');
?>
</div>
</article>
</div>
<?php
$leadingcount++;
?>
<?php endforeach; ?>
<?php endif; ?>
<?php
$class_suffix_lg  = round((12 / 4));
if(empty($class_suffix_lg)){ 
$class_suffix_lg  =4;
}
 $md =4;
$class_suffix_md  = round((12 / $md));
 $xs =1;
$class_suffix_xs  = round((12 / $xs));
$columncounter=0;
?>
<?php if (!empty($this->intro_items)):
 if($flag == 1) { ?>
</div>
<div class="row">
<?php }
foreach ($this->intro_items as $key => &$item) :
$columncounter++; ?>
<div class="col-xl-<?php echo $class_suffix_lg;?> col-lg-<?php echo $class_suffix_lg;?> col-md-<?php echo $class_suffix_md;?> col-sm-<?php echo $class_suffix_xs;?> col-xs-<?php echo $class_suffix_xs;?> col-<?php echo $class_suffix_xs;?> <?php echo $this->pageclass_sfx;?>">
<article class="ttr_post grid">
<div class ="ttr_post_content_inner">
<?php
$this->item = &$item;
echo $this->loadTemplate('item');
?>
</div>
</article>
</div>
<?php if(($columncounter) % $xs == 0){ echo '<div class=" visible-xs-block d-block" style="clear:both;width:0px;"></div>';}
if(($columncounter) % $md == 0){ echo '<div class=" visible-md-block d-md-block" style="clear:both;width:0px;"></div>';
echo '<div class=" visible-lg-block d-lg-block" style="clear:both;"></div>';}
if(($columncounter) % 4 == 0){ echo '<div class=" visible-lg-block d-xl-block d-lg-block" style="clear:both;"></div>';}?>
<?php endforeach; ?>
<?php endif; ?>
</div>
<?php if (!empty($this->link_items)) : ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>
<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
<div class="cat-children" style="clear:both">
<h3>
<?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
</h3>
<?php echo $this->loadTemplate('children'); ?>
</div>
<?php endif; ?>
<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
<div class="com-content-category-blog__navigation w-100">
<?php if ($this->params->def('show_pagination_results', 1)) : ?>
<p class="com-content-category-blog__counter counter float-right pt-3 pr-2">
<?php echo $this->pagination->getPagesCounter(); ?>
</p>
<?php endif; ?>
<div class="com-content-category-blog__pagination">
<?php echo $this->pagination->getPagesLinks(); ?>
</div>
</div>
<?php endif; ?>
</div>
