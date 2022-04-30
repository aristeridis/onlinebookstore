<?php
defined('_JEXEC') or die;
?>
<div class="blog-featured" itemscope itemtype="https://schema.org/Blog">
<?php if ($this->params->get('show_page_heading') != 0) : ?>
<div class="page-header">
<h1 class="ttr_page_title">
<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
</div>
<?php endif; ?>
<?php if ($this->params->get('page_subheading')) : ?>
<h2>
<?php echo $this->escape($this->params->get('page_subheading')); ?>
</h2>
<?php endif; ?>
<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
<?php foreach ($this->lead_items as &$item) : ?>
<article class="ttr_post blog-items items-leading <?php echo $this->params->get('blog_class_leading'); ?>">
<div class="ttr_post_content_inner blog-item"itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
<?php
$this->item = & $item;
echo $this->loadTemplate('item');
?>
</div>
</article>
<?php $leadingcount++; ?>
<?php endforeach; ?>
</div>
<?php endif; ?>
<?php if (!empty($this->intro_items)) : ?>
<?php foreach ($this->intro_items as $key => &$item) : ?>
<artice class="ttr_post blog-items <?php echo $this->params->get('blog_class'); ?>">
<div class="ttr_post_content_inner blog-item"
itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
<?php
$this->item = & $item;
echo $this->loadTemplate('item');
?>
</div>
</article>
<?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($this->link_items)) : ?>
<div class="items-more">
<?php echo $this->loadTemplate('links'); ?>
</div>
<?php endif; ?>
<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) : ?>
<div class="w-100">
<?php if ($this->params->def('show_pagination_results', 1)) : ?>
<p class="counter float-right pt-3 pr-2">
<?php echo $this->pagination->getPagesCounter(); ?>
</p>
<?php endif; ?>
<?php echo $this->pagination->getPagesLinks(); ?>
</div>
<?php endif; ?>
</div>
