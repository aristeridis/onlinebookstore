<?php 

$templateparams = $app->getTemplate(true)->params;

$Section_class = array("header","central_content","footer");

$header_levels = array("h1","h2","h3","h4","h5","h6"); 

$count_meni = range(1,5);

$count_type_buttons = range(1,16);

?>





<style>


body {
    font-family:"<?=$this->params->get('body_font', 'PT Sans Narrow') ?>";
    background-color:<?= $this->params->get('body_color')?>;


	<?php if ($this->params->get('body_custom_bg_file')==""):
	?>

    background-image: url('<?= $this->baseurl ?>/templates/<?= $this->template; ?>/images/<?= $this->params->get('body_background')?>');

	<?php endif; ?>



	<?php if ($this->params->get('body_custom_bg_file')!=""):?>
	/*custom bg images*/
		background-image: url("<?= $this->baseurl ?>/<?= $this->params->get('body_custom_bg_file')?>");
		background-size: <?= $this->params->get('body_bg_size')?>;
		background-repeat: <?= $this->params->get('body_bg_repeat')?> ;
		background-attachment: <?= $this->params->get('body_bg_attachment')?> ;
		-ms-background-position-x:<?= $this->params->get('body_bg_hr_position')?> ;
		background-position-x: <?= $this->params->get('body_bg_hr_position')?>;
		-ms-background-position-y:<?= $this->params->get('body_bg_vr_position')?> ;
		background-position-y:<?= $this->params->get('body_bg_vr_position')?> ;

	<?php endif;  ?>




    color: <?= $this->params->get('body_text_color')?>;
}

a {
    color:<?= $this->params->get('body_link_color')?>;
    text-decoration:<?= $this->params->get('body_underline', 'underline')?>;
    font-family:"<?= $this->params->get('links_font', 'PT Sans Narrow')?>";
}
a:hover {
    color:<?= $this->params->get('body_link_hover_color')?>;
    text-decoration:<?= $this->params->get('body_hover_underline')?>;
}


<?php foreach ($header_levels as $key=>$body_header_levels): ?>

<?php 
	$font_family = 'body_'.$body_header_levels . '_font';
	$color = 'body_'.$body_header_levels . '_color';
	$font_size =  'body_'.$body_header_levels . '_size';
	$font_weight = 'body_'.$body_header_levels . '_font_weight';
	$text_transform = 'body_'.$body_header_levels . '_text_transform';
	$text_align = 'body_'.$body_header_levels . '_text_align';
?>

<?= "$body_header_levels"; ?> {
	font-family:"<?= $this->params->get($font_family , 'PT Sans Narrow')?>";
	color:<?= $this->params->get($color)?>;
	font-size: <?= $this->params->get($font_size)?>px;
	font-weight: <?= $this->params->get($font_weight)?>;
	text-transform: <?= $this->params->get($text_transform)?>;
	text-align: <?= $this->params->get($text_align)?>;
}

<?php endforeach; ?>




<?php foreach ($Section_class as $key=>$section_class): ?>


<?php 

	$expand_section_bg = 'expand_' . $section_class . '_bg';
	$expand_section_font = 'expand_' . $section_class . '_font';
	$expand_section_links = 'expand_' . $section_class . '_links';
	$expand_section_overlay = 'expand_' . $section_class . '_overlay';

	$section_color = $section_class . '_color';
	$section_background = $section_class . '_background';
	$section_custom_bg_file = $section_class . '_custom_bg_file';
	$section_bg_size = $section_class . '_bg_size';
	$section_bg_repeat = $section_class . '_bg_repeat';
	$section_bg_attachment = $section_class . '_bg_attachment';
	$section_bg_position_x = $section_class . '_bg_hr_position';
	$section_bg_position_y = $section_class . '_bg_vr_position';

	$section_overlay_bg_color =  $section_class . '_overlay_bg_color';
	$section_overlay_opacity =  $section_class . '_overlay_opacity';

	$section_text_color = $section_class . '_text_color';
	$section_font = $section_class . '_font';
	$section_links_font = $section_class . '_links_font';

	$section_link_color = $section_class . '_link_color';
	$section_underline =  $section_class . '_underline';
	$section_link_hover_color =  $section_class . '_link_hover_color';
	$section_hover_underline =  $section_class . '_hover_underline';

?>

       .<?= "$section_class"; ?>{

       	<?php if ($this->params->get($expand_section_bg)==1): ?>
	       	background-color:<?= $this->params->get($section_color)?>;

			<?php if ($this->params->get($section_custom_bg_file)==""): ?>

		       	background-image: url('<?= $this->baseurl ?>/templates/<?= $this->template; ?>/images/<?= $this->params->get($section_background)?>');

	       	<?php else: ?>

		       	background-image: url("<?= $this->baseurl ?>/<?= $this->params->get($section_custom_bg_file)?>");

			background-size: <?= $this->params->get($section_bg_size)?>;
			background-repeat: <?= $this->params->get($section_bg_repeat)?> ;
			background-attachment: <?= $this->params->get($section_bg_attachment)?> ;
			-ms-background-position-x: <?= $this->params->get($section_bg_position_x)?>;
			background-position-x:<?= $this->params->get($section_bg_position_x)?> ;
			-ms-background-position-y: <?= $this->params->get($section_bg_position_y)?>;
			background-position-y: <?= $this->params->get($section_bg_position_y)?>;


	       	<?php endif; ?>

	       	<?php if ($this->params->get($expand_section_overlay)==1): ?>

	       	position: relative;
	       	overflow: hidden;

	       	<?php endif; ?>


	    <?php endif; ?>

		<?php if ($this->params->get($expand_section_font)==1): ?>
		    color: <?= $this->params->get($section_text_color)?>;
		    font-family:"<?= $this->params->get($section_font, 'PT Sans Narrow') ?>";
	    <?php endif; ?>

       }


		<?php if ($this->params->get($expand_section_overlay)==1 && $this->params->get($expand_section_bg)==1): ?>

		.<?= "$section_class"; ?>>*{
			position: relative;
		    z-index: 1;
		}

		.<?= "$section_class"; ?>:after{
			content: '';
			position: absolute;
			width: 100%;
			height: 100%;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			background-color: <?= $this->params->get($section_overlay_bg_color)?>;	
			z-index: 0;
			<?php 
			$ms_opacity =  $this->params->get($section_overlay_opacity) * 100;
			?>
			-ms-filter:progid:DXImageTransform.Microsoft.Alpha(opacity= <?php echo $ms_opacity; ?> );
			filter:progid:DXImageTransform.Microsoft.Alpha(opacity= <?php echo $ms_opacity; ?> );
			-moz-opacity: <?= $this->params->get($section_overlay_opacity)?>;
			-khtml-opacity: <?= $this->params->get($section_overlay_opacity)?>;
			opacity: <?= $this->params->get($section_overlay_opacity)?>;
		}

		

		<?php endif; ?>

		<?php if ($this->params->get($expand_section_font)==1): ?>

			.<?= "$section_class"; ?> a {
			font-family:"<?= $this->params->get($section_links_font, 'PT Sans Narrow')?>";
			}

		<?php endif; ?>

		<?php if ($this->params->get($expand_section_links)==1): ?>
			.<?= "$section_class"; ?> a {
			color:<?= $this->params->get($section_link_color)?>;
			text-decoration:<?= $this->params->get($section_underline, 'underline')?>;
			}
			.<?= "$section_class"; ?> a:hover {
			color:<?= $this->params->get($section_link_hover_color)?>;
			text-decoration:<?= $this->params->get($section_hover_underline)?>;
			}
		<?php endif; ?>

		<?php foreach ($header_levels as $key=>$section_header_levels): ?>

			<?php 
			$expand_header_elem = 'expand_' . $section_class .'_'. $section_header_levels;
			$header_elem_color =   $section_class .  '_' . $section_header_levels . '_color';
			$header_elem_font_size =  $section_class .  '_' . $section_header_levels . '_size';
			?>

			<?php if ($this->params->get($expand_header_elem)==1): ?>
				.<?= "$section_class"; ?> <?= "$section_header_levels"; ?> {
				font-size:<?= $this->params->get($header_elem_font_size)?>px;
				color:<?= $this->params->get($header_elem_color )?>;
				}
			<?php endif; ?>

		<?php endforeach; ?>

<?php endforeach; ?>



<?php foreach ($count_meni as $key=>$count_meni): ?>

<?php 
	$menu_class = 'custom_menu_' . $count_meni . '_class';
	$expand_meni= 'expand_custom_meni_' . $count_meni  ;
	$menu_bg_color = 'custom_menu_' .$count_meni.'_bg_color';	
	$menu_submenu_bg_color ='custom_menu_' .$count_meni. '_submenu_bg_color';
	$menu_item_hover_bg_color ='custom_menu_' . $count_meni . '_item_hover_bg_color';
	$menu_font = 'custom_menu_' . $count_meni . '_font';

	$menu_color = 'custom_menu_' . $count_meni . '_color';
	$menu_underline = 'custom_menu_' . $count_meni . '_underline';
	$menu_font_size = 'custom_menu_' . $count_meni . '_font_size';
	$menu_text_transform = 'custom_menu_' . $count_meni . '_text_transform';
	$menu_font_weight = 'custom_menu_' . $count_meni . '_font_weight';
	$menu_hover_color = 'custom_menu_' . $count_meni . '_hover_color';	
	$menu_hover_underline ='custom_menu_' . $count_meni . '_hover_underline';

	$dropmenu_item_color = 'custom_menu_' . $count_meni . '_dropmenu_item_color';
	$dropmenu_item_underline = 'custom_menu_' . $count_meni . '_dropmenu_item_underline';
	$dropmenu_item_font_size = 'custom_menu_' . $count_meni . '_dropmenu_item_font_size';
	$dropmenu_item_text_transform = 'custom_menu_' . $count_meni . '_dropmenu_item_text_transform';
	$dropmenu_item_font_weight = 'custom_menu_' . $count_meni . '_dropmenu_item_font_weight';
	$dropmenu_item_hover_color = 'custom_menu_' . $count_meni . '_dropmenu_item_hover_color';	
	$dropmenu_item_hover_underline ='custom_menu_' . $count_meni . '_dropmenu_item_hover_underline';


?>


<?php if 
	($this->params->get($menu_class)!="" && $this->params->get($expand_meni)!="0" ):?>

	/*.<?= $this->params->get($menu_class)?>  Style  */


	.<?= $this->params->get($menu_class)?>{
		background-color: <?= $this->params->get($menu_bg_color)?>;
	}

	.<?= $this->params->get($menu_class)?>.nav li.parent ul{
		background-color: <?= $this->params->get($menu_submenu_bg_color)?>;
	}

	.<?= $this->params->get($menu_class)?> li a:hover,
	.<?= $this->params->get($menu_class)?> li .nav-header:hover{
		background-color: <?= $this->params->get($menu_item_hover_bg_color)?>;
	}

	.<?= $this->params->get($menu_class)?> li a,
	.<?= $this->params->get($menu_class)?> li .nav-header{
		font-family:"<?= $this->params->get($menu_font, 'PT Sans Narrow')?>";
	}

	.<?= $this->params->get($menu_class)?> >li >a,
	.<?= $this->params->get($menu_class)?> >li >.nav-header {
		color:<?= $this->params->get($menu_color)?>;
		text-decoration:<?= $this->params->get($menu_underline, 'underline')?>;
		font-weight: <?= $this->params->get($menu_font_weight)?> ;
		font-size: <?= $this->params->get($menu_font_size)?>px ;
		text-transform: <?= $this->params->get($menu_text_transform)?>;
	}

	.<?= $this->params->get($menu_class)?> >li >a:hover,
	.<?= $this->params->get($menu_class)?> >li >.nav-header:hover {
		color:<?= $this->params->get($menu_hover_color)?>;
		text-decoration:<?= $this->params->get($menu_hover_underline)?>;
	}

		/*Drop Menu Item Style*/

		.<?= $this->params->get($menu_class)?> ul li a,
		.<?= $this->params->get($menu_class)?> ul li .nav-header {
			color:<?= $this->params->get($dropmenu_item_color)?> !important;
			text-decoration:<?= $this->params->get($dropmenu_item_underline, 'underline')?>;
			font-weight: <?= $this->params->get($dropmenu_item_font_weight)?> ;
			font-size: <?= $this->params->get($dropmenu_item_font_size)?>px ;
			text-transform: <?= $this->params->get($dropmenu_item_text_transform)?>;
		}

		.<?= $this->params->get($menu_class)?> ul li a:hover,
		.<?= $this->params->get($menu_class)?> ul li .nav-header:hover {
			color:<?= $this->params->get($dropmenu_item_hover_color)?> !important;
			text-decoration:<?= $this->params->get($dropmenu_item_hover_underline)?>;
		}


		/*End Drop Menu Item Style*/

	/*End .<?= $this->params->get($menu_class)?>  Style  */

<?php endif; ?>
<?php endforeach; ?>



<?php  ?>

.soc_icons_box ul li a {
	font-size:<?= $this->params->get('soc_icons_size')?>px;
}


<?php foreach($count_type_buttons as $key=>$count_type_buttons): ?>

<?php 
	$button_selector = 'button_' .$count_type_buttons. '_selector';
	$expand_button = 'expand_button_' .$count_type_buttons;

	$button_bg_color = 'button_' .$count_type_buttons. '_bg_color';
	$button_bg_transparent = 'button_' .$count_type_buttons. '_background_transparent';

	$button_font =  'button_'.$count_type_buttons.'_font';
	$button_text_color = 'button_' .$count_type_buttons. '_text_color';
	$button_font_size =  'button_'.$count_type_buttons.'_font_size';
	$button_line_height = 'button_'.$count_type_buttons. '_line_height';
	$button_font_weight = 'button_' .$count_type_buttons.'_font_weight';
	$button_text_transform = 'button_' .$count_type_buttons. '_text_transform';

	$expand_button_text_shadow = 'expand_button_' .$count_type_buttons. '_text_shadow';
	$button_text_shadow_color = 'button_' .$count_type_buttons. '_text_shadow_color';
	$button_text_shadow_x= 'button_' .$count_type_buttons. '_text_shadow_x';
	$button_text_shadow_y = 'button_' .$count_type_buttons. '_text_shadow_y';
	$button_text_shadow_blur = 'button_' .$count_type_buttons. '_text_shadow_blur';

	$button_padding_top = 'button_' .$count_type_buttons. '_padding_top';
	$button_padding_right = 'button_' .$count_type_buttons. '_padding_right';
	$button_padding_bottom = 'button_' .$count_type_buttons. '_padding_bottom';
	$button_padding_left = 'button_' .$count_type_buttons. '_padding_left';

	$expand_button_box_shadow = 'expand_button_' .$count_type_buttons. '_box_shadow';
	$button_box_shadow_color = 'button_' .$count_type_buttons. '_box_shadow_color';
	$button_box_shadow_x = 'button_' .$count_type_buttons. '_box_shadow_x';
    $button_box_shadow_y = 'button_' .$count_type_buttons. '_box_shadow_y';
    $button_box_shadow_blur = 'button_' .$count_type_buttons. '_box_shadow_blur';
    $button_box_shadow_spread = 'button_' .$count_type_buttons. '_box_shadow_spread';
    $button_box_shadow_type = 'button_' .$count_type_buttons. '_box_shadow_type';

    $button_border_radius = 'button_' .$count_type_buttons. '_border_radius';

    $button_border_top_w = 'button_' .$count_type_buttons. '_border_top_w';
    $button_border_right_w = 'button_' .$count_type_buttons. '_border_right_w';
    $button_border_bottom_w = 'button_' .$count_type_buttons. '_border_bottom_w';
    $button_border_left_w = 'button_' .$count_type_buttons. '_border_left_w';

    $button_border_color = 'button_' .$count_type_buttons. '_border_color';
    $button_border_style = 'button_' .$count_type_buttons. '_border_style';

	$button_hover_bg_transparent = 'button_' .$count_type_buttons. '_hover_background_transparent';
    $button_hover_bg_color = 'button_' .$count_type_buttons. '_hover_bg_color';
    $button_hover_border_color = 'button_' .$count_type_buttons. '_hover_border_color';
    $button_hover_text_color = 'button_' .$count_type_buttons. '_hover_text_color';
?>


<?php if 
	($this->params->get($button_selector)!="" &&  $this->params->get($expand_button)!="0" )
	{
 ?>

 /*Element <?=$count_type_buttons ?>  Begin  */

<?php
	$selectors = explode(",", $this->params->get($button_selector)); 
	
	for ($i = 0; $i < count($selectors); $i++) {
		if ($i != count($selectors) - 1) echo trim($selectors[$i]) . ",\n";
		else echo trim($selectors[$i]);
	}

?>
{
<?php if ($this->params->get($button_bg_transparent)=="transparent"):?>
	background:<?= $this->params->get($button_bg_transparent)?>;
<?php else: ?>
background:<?= $this->params->get($button_bg_color)?>;
<?php endif; ?>
	color: <?= $this->params->get($button_text_color)?>;
	font-family:"<?= $this->params->get($button_font, 'PT Sans Narrow')?>";
	font-size:<?= $this->params->get($button_font_size)?>px;
	line-height: <?= $this->params->get($button_line_height)?>px;
	font-weight: <?= $this->params->get($button_font_weight)?>;


	<?php if 
	($this->params->get($expand_button_text_shadow)=="1")
	{
	?>

	    <?php
		$button_text_shadow = $this->params->get($button_text_shadow_x) . "px " . 
		$this->params->get($button_text_shadow_y) . "px " .
		$this->params->get($button_text_shadow_blur) . "px " .
		$this->params->get($button_text_shadow_color)
		?>
		text-shadow: <?= "$button_text_shadow";  ?>;
    
	<?php }  else { ?>

		text-shadow: none; 

	<?php } ?>

	text-transform: <?= $this->params->get($button_text_transform)?> ;
	padding: <?= $this->params->get($button_padding_top)?>px <?= $this->params->get($button_padding_right)?>px <?= $this->params->get($button_padding_bottom)?>px  <?= $this->params->get($button_padding_left)?>px;

	-webkit-border-radius: <?= $this->params->get($button_border_radius)?>px;
	-moz-border-radius: <?= $this->params->get($button_border_radius)?>px;
	-o-border-radius: <?= $this->params->get($button_border_radius)?>px;
	border-radius: <?= $this->params->get($button_border_radius)?>px;

	border-top-width: <?= $this->params->get($button_border_top_w)?>px;
	border-right-width: <?= $this->params->get($button_border_right_w)?>px;
	border-bottom-width: <?= $this->params->get($button_border_bottom_w)?>px;
	border-left-width: <?= $this->params->get($button_border_left_w)?>px;

	border-color: <?= $this->params->get($button_border_color)?> ;
	border-style: <?= $this->params->get($button_border_style)?> ;

	<?php if ($this->params->get($expand_button_box_shadow)==1): ?>

	<?php
	$button_box_shadow = $this->params->get($button_box_shadow_x) . "px " . $this->params->get($button_box_shadow_y) . "px " .$this->params->get($button_box_shadow_blur) . "px " .$this->params->get($button_box_shadow_spread) . "px " .$this->params->get($button_box_shadow_color) . " " .$this->params->get($button_box_shadow_type);
	?>

	<?php else: ?>

	<?php
	$button_box_shadow = "none";
	?>

	<?php endif; ?>

	-webkit-box-shadow: <?= "$button_box_shadow";  ?>;
	-moz-box-shadow: <?= "$button_box_shadow";  ?>;
	-o-box-shadow: <?= "$button_box_shadow";  ?>;
	box-shadow: <?= "$button_box_shadow";  ?>;

	-webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}


<?php
	$selectors = explode(",", $this->params->get($button_selector)); 

	for ($i = 0; $i < count($selectors); $i++) {
		if ($i != count($selectors) - 1) echo trim($selectors[$i]) . ":hover,\n";
		else echo trim($selectors[$i]) . ":hover\n";
	}
?>
{
	<?php if ($this->params->get($button_hover_bg_transparent)=="transparent"):?>
	background:<?= $this->params->get($button_hover_bg_transparent)?>;
<?php else: ?>
background:<?= $this->params->get($button_hover_bg_color)?>;
<?php endif; ?>
	border-color: <?= $this->params->get($button_hover_border_color)?>;
	color: <?= $this->params->get($button_hover_text_color)?> ;
}

/*Element <?=$count_type_buttons ?>  end */

<?php } ?>

<?php endforeach; ?>


#logo img{

	<?php if ( $this->params->get('logo_width_type')==1): ?>

	width: <?= $this->params->get('logo_width')?>px;

	<?php else: ?>

	width: auto;

	<?php endif; ?>

	<?php if ( $this->params->get('logo_height_type')==1): ?>

	height: <?= $this->params->get('logo_height')?>px;

	<?php else: ?>

	height: auto;

	<?php endif; ?>


}

</style>
