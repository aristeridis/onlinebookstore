<?php
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;
$app = JFactory::getApplication();
$params = $this->item->params;
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);
$assocParam = (Associations::isEnabled() && $params->get('show_associations'));
?>
<?php echo LayoutHelper::render('joomla.content.intro_image', $this->item); ?>
<div class="item-content">
<?php if ($this->item->state == ContentComponent::CONDITION_UNPUBLISHED || strtotime($this->item->publish_up) > strtotime(Factory::getDate())
|| (!is_null($this->item->publish_down) && strtotime($this->item->publish_down) < strtotime(Factory::getDate()))) : ?>
<div class="system-unpublished">
<?php endif; ?>
<?php if ($params->get('show_title')) : ?>
<div class="ttr_post_inner_box">
<h2 class="ttr_post_title">
<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
<?php echo $this->escape($this->item->title); ?></a>
<?php else : ?>
<?php echo $this->escape($this->item->title); ?>
<?php endif; ?>
</h2>
</div>
<?php endif; ?>
<div class="ttr_article">
	<?php if ($canEdit) : ?>
		<?php echo LayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item)); ?>
	<?php endif; ?>
	<div class ="postedon">
	<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
		|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>
	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
		<?php echo LayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
	<?php endif; ?>
	<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php echo LayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
	<?php endif; ?>
	</div>
	<div class="postcontent">
	<?php if (!$params->get('show_intro')) : ?>
		<?php echo $this->item->event->afterDisplayTitle; ?>
	<?php endif; ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>
	<?php echo $this->item->introtext; ?>
	<div style="clear:both;"></div>
</div>
<?php if ($info == 1 || $info == 2) : ?>
	<?php if ($useDefList) : ?>
	<?php echo LayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
<?php endif; ?>
<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
<?php echo LayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
<?php endif; ?>
<?php endif; ?>
<?php if ($params->get('show_readmore') && $this->item->readmore) :
if ($params->get('access-view')) :
$link = Route::_(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
else :
	$menu = Factory::getApplication()->getMenu();
	$active = $menu->getActive();
	$itemId = $active->id;
	$link = new Uri(Route::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));
	$link->setVar('return', base64_encode(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)));
	endif; ?>
<?php echo LayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>
<?php endif; ?>
</div>
<?php if ($this->item->state == ContentComponent::CONDITION_UNPUBLISHED || strtotime($this->item->publish_up) > strtotime(Factory::getDate())
	|| (!is_null($this->item->publish_down) && strtotime($this->item->publish_down) < strtotime(Factory::getDate()))) : ?>
</div>
<?php endif; ?>
</div>
<?php echo $this->item->event->afterDisplayContent; ?>
