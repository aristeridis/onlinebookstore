<?php
defined('_JEXEC') or die;
$inputclass = ' '; 
if ($button) :
if (!$imagebutton) :
 $inputclass = 'noicon ';
endif;
switch ($button_pos) :
case 'top' :
$inputclass = 'align_top';
break;
case 'bottom' :
$inputclass = 'align_bottom';
break;
case 'right' :
$inputclass = 'align_right';
break;
case 'left' :
default :
$inputclass = 'align_left';
break;
endswitch;
endif;
?>
<form action="<?php echo JRoute::_('index.php');?>" method="post">
<div class="input-group search<?php echo $params->get('moduleclass_sfx') . ' ' . $inputclass; ?>">
<?php
$output = '<input name="searchword" id="mod-search-searchword" maxlength="'.$maxlength.'" class="form-control input-text boxcolor'.$moduleclass_sfx . '" type="text" size="'.$width.'" value="'.$text.'"  onblur="if (this.value==\'\') this.value=\''.$text.'\';" onfocus="if (this.value==\''.$text.'\') this.value=\'\';" />';
$button_html="";
if ($button) :
if ($imagebutton) :
$custom_image = $params->get('search_button_icon');
$custom_class = '';
if (!empty($custom_image)) :
$img = $custom_image;
$custom_class= " ttr_search_icon";
endif;
$button_html = '<span class="input-group-btn"><input type="image" value="'.$button_text.'" class="btn btn-default '.$moduleclass_sfx.''.$custom_class.'" src="'.$img.'" onclick="this.form.searchword.focus();"/></span>';
else :
$button_html = '<span class="input-group-btn"><input type="submit" value="'.$button_text.'" class="btn btn-default '.$moduleclass_sfx.'" onclick="this.form.searchword.focus();"/></span>';
endif;
endif;
switch ($button_pos) :
case 'top' :
$button_html = $button_html.'<br>';
$output = $button_html.$output;
break;
case 'bottom':
$button_html = '<br>'.$button_html;
$output = $output.$button_html;
break;
case 'right' :
$output = $output.$button_html;
break;
case 'left' :
default :
$output = $button_html.$output;
break;
endswitch;
echo $output;
echo '<div style="clear:both;">';
echo '</div>';
?>
<input type="hidden" name="task" value="search"/>
<input type="hidden" name="option" value="com_search" />
<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>"/>
</div>
</form>
