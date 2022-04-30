<?php
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;
$params  = $this->item->params;
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = Factory::getUser();
$app	= JFactory::getApplication();
$option = $app->input->getCmd('option');
$cat_title = $this->item->category_title;
$app->setUserState( '$option.categoryname', $cat_title );
$info    = $params->get('info_block_position', 0);
$app        = JFactory::getApplication();
$input = JFactory::getApplication()->input;
$view   = $input->getCmd('view');
$catid = $input->getCmd('catid');
$assocParam = (Associations::isEnabled() && $params->get('show_associations'));
?>
<div class="com-content-article item-page<?php echo $this->pageclass_sfx; ?>"itemscope itemtype="https://schema.org/Article">
<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? Factory::getApplication()->get('language') : $this->item->language; ?>">
<?php if ($this->params->get('show_page_heading')) : ?>
<div class="page-header">
<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
</div>
<?php endif;
if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
{
echo $this->item->pagination;
}
?>
<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>
<article class="ttr_post<?php echo $this->pageclass_sfx; ?>">
<div class="ttr_post_content_inner">
<?php if ($params->get('show_title')) : ?>
<div class="ttr_post_inner_box">
<?php if ($view =="article" && ! isset($catid)) : ?>
<h1 class="ttr_page_title">
<?php else : ?>
<h2 class="ttr_post_title">
<?php endif; ?>
<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
<a href="<?php echo $this->item->readmore_link; ?>">
<?php echo $this->escape($this->item->title); ?></a>
<?php else : ?>
<?php echo $this->escape($this->item->title); ?>
<?php endif; ?>
<?php if ($view =="article" && ! isset($catid)) : ?>
</h1>
<?php else : ?>
</h2>
<?php endif; ?>
</div>
<?php endif; ?>
<?php if ($this->item->state == ContentComponent::CONDITION_UNPUBLISHED) : ?>
<span class="badge badge-warning"><?php echo Text::_('JUNPUBLISHED'); ?></span>
<?php endif; ?>
<?php if (strtotime($this->item->publish_up) > strtotime(Factory::getDate())) : ?>
<span class="badge badge-warning"><?php echo Text::_('JNOTPUBLISHEDYET'); ?></span>
<?php endif; ?>
<?php if (!is_null($this->item->publish_down) && (strtotime($this->item->publish_down) < strtotime(Factory::getDate()))) : ?>
<span class="badge badge-warning"><?php echo Text::_('JEXPIRED'); ?></span>
<?php endif; ?>
</div>
<?php if ($canEdit) : ?>
<?php echo LayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item)); ?>
<?php endif; ?>
<div class="ttr_article">
<?php echo $this->item->event->afterDisplayTitle; ?>
<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
<div class="postedon">
<?php echo LayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
</div>
<?php endif; ?>
<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
<?php $this->item->tagLayout = new FileLayout('joomla.content.tags'); ?>
<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
<?php endif; ?>
<?php echo $this->item->event->beforeDisplayContent; ?>
<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>
<div class="postcontent">
<?php if ($params->get('access-view')) : ?>
<?php echo LayoutHelper::render('joomla.content.full_image', $this->item); ?>
<?php
if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative) :
echo $this->item->pagination;
endif;
?>
<?php if (isset ($this->item->toc)) :
echo $this->item->toc;
endif; ?>
<?php echo $this->item->text; ?>
<div style="clear:both;"></div>
<?php if ($info == 1 || $info == 2) : ?>
<?php if ($useDefList) : ?>
<div class="postedon">
<?php echo LayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
</div>
<?php endif; ?>
<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
<?php $this->item->tagLayout = new FileLayout('joomla.content.tags'); ?>
<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
<?php endif; ?>
<?php endif; ?>
	<?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative) :
	echo '<div>';
echo $this->item->pagination;
echo '</div>';
?>
<?php endif; ?>
<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>
<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
<?php echo LayoutHelper::render('joomla.content.intro_image', $this->item); ?>
<?php echo HTMLHelper::_('content.prepare', $this->item->introtext); ?>
<?php if ($params->get('show_readmore') && $this->item->fulltext != null) : ?>
<?php $menu = Factory::getApplication()->getMenu(); ?>
<?php $active = $menu->getActive(); ?>
<?php $itemId = $active->id; ?>
<?php $link = new Uri(Route::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false)); ?>
<?php $link->setVar('return', base64_encode(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language))); ?>
<p class="com-content-article__readmore readmore">
<a href="<?php echo $link; ?>" class="register">
<?php $attribs = json_decode($this->item->attribs); ?>
<?php
if ($attribs->alternative_readmore == null) :
echo Text::_('COM_CONTENT_REGISTER_TO_READ_MORE');
elseif ($readmore = $attribs->alternative_readmore) :
echo $readmore;
if ($params->get('show_readmore_title', 0) != 0) :
echo HTMLHelper::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
endif;
elseif ($params->get('show_readmore_title', 0) == 0) :
echo Text::sprintf('COM_CONTENT_READ_MORE_TITLE');
else :
echo Text::_('COM_CONTENT_READ_MORE');
echo HTMLHelper::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
endif; ?>
</a>
</p>
<?php endif; ?>
<?php endif; ?>
<?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
echo $this->item->pagination;
?>
<?php endif; ?>
<?php echo $this->item->event->afterDisplayContent; ?>
</div>
</div>
</article>
</div>
