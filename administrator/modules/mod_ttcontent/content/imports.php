<?php
use Joomla\CMS\Factory;
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.application.application');
$GLOBALS['formcounter'] = 1;

class Templatetoaster_Parse_Content
{
    private $xml_content;

    function __construct($path)
    {
        $this->xml_content = simplexml_load_file($path);
        if (!$this->xml_content)
        {
            die("<div class='alert alert-danger'>Unable to import content</div> ");
        }
    }

    // get the site title from xml file
    public function get_site_title()
    {
        if (!isset($this
            ->xml_content
            ->sitetitle))
        {
            return false;
        }
        $site_title = (string)$this
            ->xml_content->sitetitle;
        return $site_title;
    }

    // get the site slogan from xml file
    public function get_site_slogan()
    {
        if (!isset($this
            ->xml_content
            ->siteslogan))
        {
            return false;
        }
        $site_slogan = (string)$this
            ->xml_content->siteslogan;
        return $site_slogan;
    }

    // get the pages from xml file
    public function get_pages_data()
    {
        if (!isset($this
            ->xml_content
            ->pages) || !isset($this
            ->xml_content
            ->pages
            ->content))
        {
            return false;
        }

        $all_pages = array();
        foreach ($this
            ->xml_content
            ->pages->content as $page_node)
        {
            $this->parse_all_pages($page_node, $all_pages);
        }
        return $all_pages;
    }

    // get the menu from xml file
    public function get_menu_data()
    {
        if (!isset($this
            ->xml_content
            ->menu) || !isset($this
            ->xml_content
            ->menu
            ->menu_item))
        {
            return false;
        }
        $menu_info = array();
        foreach ($this
            ->xml_content
            ->menu->menu_item as $menu_item)
        {
            $this->parse_menu($menu_item, $menu_info);
        }
        return $menu_info;

    }

    // Parse the pages from xml file
    private function parse_all_pages($page_node, &$all_pages)
    {
        $page = array(
            'meta_id' => (string)$page_node->meta_ID,
            'id' => (string)$page_node->id,
            'title' => (string)$page_node->page_title,
            'alias' => (string)$page_node->alias,
            'state' => (string)$page_node->state,
            'featured' => (string)$page_node->featured,
            'modified' => (string)$page_node->modified,
            'publish_up' => (string)$page_node->publish_up,
            'publish_down' => (string)$page_node->publish_down,
            'created' => (string)$page_node->created,
            'created_by_alias' => (string)$page_node->created_by_alias,
            'introtext' => (string)$page_node->introtext,
            'show_title' => (string)$page_node->page_title_visibility,
            'contactforms' => $page_node->contactforms
        ); // parse 'contactforms' as an array
        $all_pages[] = $page;

    }

    // Parse the menu from the xml file
    private function parse_menu($menu_item, &$menu_info)
    {
        $menu_item_info = array(
            'menu_item_id' => (string)$menu_item->menu_item_id,
            'title' => (string)$menu_item->menu_item_title,
            'path' => (string)$menu_item->menu_item_path,
            'status' => (int)$menu_item->menu_item_status,
            'parent' => (string)$menu_item->menu_item_parent,
            'url' => (string)$menu_item->menu_item_url,
            'articlename' => (string)$menu_item->menu_item_articlename,
            'articletype' => (string)$menu_item->menu_item_articletype,
            'menu_slug' => (string)$menu_item->menu_item_slug
        );

        $menu_info[] = $menu_item_info;

    }

    // parse the sidebar blocks from xml file
    private function parse_all_blocks($blocks_node, &$all_blocks)
    {
        if (!isset($blocks_node))
        {
            return;
        }

        $widget_nodes = $blocks_node->xpath('./*[self::block]');
        $result = array();
        foreach ($widget_nodes as $node)
        {
            $block = array();
            $block['type'] = (string)$node->attributes()->type;
            $block['name'] = (string)$node->attributes()->name;
            $block['title'] = (string)$node->attributes()->title;
            $block['tt_blockID'] = (string)$node->attributes()->tt_blockID;
            if (isset($node->content))
            {
                $block['content'] = (string)$node->content;
            }
            if (isset($node->contactforms))
            {
                $block['contactforms'] = $node->contactforms;
            }
            if (isset($node
                ->widget_pages
                ->widget_page))
            {
                $page_list = array();
                foreach ($node
                    ->widget_pages->widget_page as $pages)
                {
                    $page_list[] = (string)$pages;
                }
                $block['show_on_page'] = $page_list;
            }
            $result[] = $block;
        }
        $all_blocks = array_merge($all_blocks, $result);
    }

    // get the footer from xml file
    public function get_footer_data()
    {
        if (!isset($this
            ->xml_content
            ->footers) || !isset($this
            ->xml_content
            ->footers
            ->footer))
        {
            return false;
        }

        $all_cells = array();
        foreach ($this
            ->xml_content
            ->footers->footer as $cell)
        {
            $all_cell_blocks = array();
            $this->parse_all_blocks($cell, $all_cell_blocks);
            $all_cells[] = array(
                'name' => (string)$cell->attributes()->name,
                'cell' => $all_cell_blocks
            );
        }

        return $all_cells;
    }

    // get the menu textarea modules from the xml file
    public function get_menushapes_data()
    {
        if (!isset($this
            ->xml_content
            ->Shapes
            ->menushapes) || !isset($this
            ->xml_content
            ->Shapes
            ->menushapes
            ->menu))
        {
            return false;
        }
        $menu_blocks = array();
        foreach ($this
            ->xml_content
            ->Shapes
            ->menushapes->menu as $menu_block)
        {
            $all_menu_blocks = array();
            $this->parse_all_blocks($menu_block, $all_menu_blocks);
            $menu_blocks[] = array(
                'name' => (string)$menu_block->attributes()->name,
                'menu_blocks' => $all_menu_blocks
            );
        }
        return $menu_blocks;
    }

    // get the footer textarea modules from the xml file
    public function get_footershapes_data()
    {
        if (!isset($this
            ->xml_content
            ->Shapes
            ->footershapes) || !isset($this
            ->xml_content
            ->Shapes
            ->footershapes
            ->footer))
        {

            return false;
        }
        $footer_blocks = array();
        foreach ($this
            ->xml_content
            ->Shapes
            ->footershapes->footer as $footer_block)
        {
            $all_footer_blocks = array();
            $this->parse_all_blocks($footer_block, $all_footer_blocks);
            $footer_blocks[] = array(
                'name' => (string)$footer_block->attributes()->name,
                'footer_blocks' => $all_footer_blocks
            );
        }
        return $footer_blocks;
    }
    // get the slideshow textarea modules from the xml file
    public function get_slideshowshapes_data()
    {
        if (!isset($this
            ->xml_content
            ->Shapes
            ->slideshowshapes) || !isset($this
            ->xml_content
            ->Shapes
            ->slideshowshapes
            ->slideshow))
        {
            return false;
        }
        $slide_blocks = array();
        foreach ($this
            ->xml_content
            ->Shapes
            ->slideshowshapes->slideshow as $slide_block)
        {
            $all_slide_blocks = array();
            $this->parse_all_blocks($slide_block, $all_slide_blocks);
            $slide_blocks[] = array(
                'name' => (string)$slide_block->attributes()->name,
                'slide_blocks' => $all_slide_blocks
            );
        }
        return $slide_blocks;
    }

    // get the header textarea modules from the xml file
    public function get_headershapes_data()
    {
        if (!isset($this
            ->xml_content
            ->Shapes
            ->headershapes) || !isset($this
            ->xml_content
            ->Shapes
            ->headershapes
            ->header))
        {
            return false;
        }
        $header_blocks = array();
        foreach ($this
            ->xml_content
            ->Shapes
            ->headershapes->header as $header_block)
        {
            $all_header_blocks = array();
            $this->parse_all_blocks($header_block, $all_header_blocks);
            $header_blocks[] = array(
                'name' => (string)$header_block->attributes()->name,
                'header_blocks' => $all_header_blocks
            );
        }
        return $header_blocks;
    }

    // get the sidebar content from the xml file
    public function get_sidebar_data()
    {
        if (!isset($this
            ->xml_content
            ->sidebars) || !isset($this
            ->xml_content
            ->sidebars
            ->sidebar))
        {
            return false;
        }

        $all_sidebars = array();
        foreach ($this
            ->xml_content
            ->sidebars->sidebar as $sidebar_node)
        {
            $all_blocks = array();
            $this->parse_all_blocks($sidebar_node, $all_blocks);
            $all_sidebars[] = array(
                'name' => (string)$sidebar_node->attributes()->name,
                'blocks' => $all_blocks
            );
        }
        return $all_sidebars;
    }
}

class Templatetoaster_Import_Content
{
    //Theme_Content_Import
    public $uploads;
    private $custom_menuID = null;
    private $page_list, $slug_list = array();
    public function start_import()
    {
        $success = true;
        $rootFolder = explode(DS, dirname(__FILE__));
        $mod_folder = implode(DS, $rootFolder);

        // parses content.xml
        $parser = new Templatetoaster_Parse_Content($mod_folder . '/content.xml');
        $pages_info = $parser->get_pages_data();
        $menu_info = $parser->get_menu_data();
        $sidebars_info = $parser->get_sidebar_data();
        $images = 'images';
        $video = 'video';
        $image_path = $mod_folder . "/" . $images;
        $video_path = $mod_folder . "/" . $video;
        $title = $parser->get_site_title();
        $slogan = $parser->get_site_slogan();
        $footers_info = $parser->get_footer_data();
        $header_text_blocks = $parser->get_headershapes_data();
        $menu_text_blocks = $parser->get_menushapes_data();
        $footer_text_blocks = $parser->get_footershapes_data();
        $slideshow_text_blocks = $parser->get_slideshowshapes_data();
        //delete the existing modules
        $this->delete_existing_tt_blocks();
        if ($pages_info)
        {
            $success = $success && $this->insert_pages($pages_info);
        }
        if ($menu_info)
        {
            $success = $success && $this->insert_menu($menu_info);
        }
        $this->update_articles($pages_info);

        if ($sidebars_info)
        {
            $success = $success && $this->insert_sidebars($sidebars_info);
        }
        if ($footers_info)
        {
            $success = $success && $this->insert_footer($footers_info);
        }
        if ($header_text_blocks)
        {
            $success = $success && $this->insert_shapes($header_text_blocks, "header_blocks");
        }
        if ($menu_text_blocks)
        {
            $success = $success && $this->insert_shapes($menu_text_blocks, "menu_blocks");
        }
        if ($footer_text_blocks)
        {
            $success = $success && $this->insert_shapes($footer_text_blocks, "footer_blocks");
        }
        if ($slideshow_text_blocks)
        {
            $success = $success && $this->insert_shapes($slideshow_text_blocks, "slide_blocks");
        }

        // if Images exists in content uploads it to the upload directory
        $folderExists = JFolder::exists($image_path);
        if ($folderExists)
        {
            $success = $success && $this->upload_media('images');
        }
        $video_folder_exists = JFolder::exists($video_path);
        if ($video_folder_exists)
        {
            $success = $success && $this->upload_media('video');
        }
        return $success;
    }

    private function insert_pages($pages_info)
    {
        $db1 = JFactory::getDbo();
        $db1->setQuery("SELECT fval.id FROM #__fields fval WHERE fval.title ='TTpageid'");
        $field_id = $db1->loadResult();
        if (empty($field_id))
        {
            $this->create_article_field();
        }
        else
        {
            $query2 = "update `#__fields` set state=1 where title = 'TTpageid'";
            $db2 = JFactory::getDBO();
            $db2->setQuery($query2);
            $db2->execute();
        }
        $this->create_category();
        foreach ($pages_info as $num => $page)
        {
            $db = JFactory::getDbo();
            $db->setQuery("SELECT fvalue.item_id FROM #__fields_values fvalue WHERE fvalue.value ='" . $page['meta_id'] . "'");
            $item_id = $db->loadResult();
            if (empty($item_id))
            {
                $this->create_articles($page);
            }
            else
            {
                $this->create_articles($page, $item_id);
            }
        }
        //for loop end.
        return true;
    }
    // create default category-Page for articles exported from TT
    function create_category()
    {
        $category = array(
            'id' => 0,
            'hits' => "0",
            'extension' => "com_content",
            'parent_id' => "1",
            'title' => "Page",
            'alias' => "",
            'note' => "",
            'description' => "",
            'access' => "1",
            'published' => "1",
            'metadesc' => "",
            'metakey' => "",
            'created_user_id' => "0",
            'created_time' => "",
            'modified_time' => "",
            'language' => "*",
            'params' => array(
                'category_layout' => "",
                'image' => "",
                'image_alt' => ""
            ) ,
            'metadata' => array(
                'author' => "",
                'robots' => ""
            )
        );
        /*JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_categories/models', 'CategoriesModel');
        JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_categories/tables/');
        $model = JModelLegacy::getInstance('Category', 'CategoriesModel', array('ignore_request' => true));*/
        $model = Factory::getApplication()->bootComponent('com_categories')
            ->getMVCFactory()
            ->createModel('Category', 'Administrator', ['ignore_request' => true]);
        $result = $model->save($category);
        return $result;
    }
    // save contact form
    private function save_contact_form($contact_form_field, $attr)
    {
        $fields = array();
        $fieldcounter = 0;
        $email_layout = "";
        foreach ($contact_form_field as $con_info)
        {
            $min_length = '';
            $max_length = '';
            $field_label = $con_info['ttr_item_id'];
            if ($con_info['item_format'] == "NoValidation") $field_type = 'text';
            elseif ($con_info['item_format'] == "Email") $field_type = 'email';
            elseif ($con_info['item_format'] == "Numeric")
            {
                $field_type = 'number';
                $min_length = '10';
                $max_length = '10';
            }
            else $field_type = 'url';
            if ($con_info['ttr_item_idreq'] == "off")
            {
                $required = '0';
                $custom_error = '';
            }
            else
            {
                $required = '1';
                $custom_error = 'Please fill the required fields.';
            }
            $fields += array(
                'fields' . $fieldcounter => array(
                    'name' => str_replace(' ', '-', strtolower($field_label)) ,
                    'type' => $field_type,
                    'label' => $field_label,
                    'required' => $required,
                    'custom_error' => $custom_error,
                    'show_label' => '1',
                    'options' => '',
                    'width' => '12',
                    'placeholder' => '',
                    'textarearows' => '4',
                    'min_length' => $min_length,
                    'max_length' => $max_length,
                    'min' => '',
                    'max' => '',
                    'optionslayout' => 'inline',
                    'calendar_min' => '',
                    'calendar_max' => '',
                    'calendar_format' => '',
                ) ,
            );
            $fieldcounter += 1;
            $email_layout .= "<p><strong>{" . str_replace(' ', '-', strtolower($field_label)) . ":label} :</strong> {" . str_replace(' ', '-', strtolower($field_label)) . ":value}</p>\r\n";
        }
        // message field
        $message_label = (string)$attr['msg_name'];
        $fields += array(
            'fields' . $fieldcounter => array(
                'name' => str_replace(' ', '-', strtolower($message_label)) ,
                'type' => 'textarea',
                'label' => $message_label,
                'required' => '0',
                'custom_error' => '',
                'show_label' => '1',
                'options' => '',
                'width' => '12',
                'placeholder' => '',
                'textarearows' => '4',
                'min_length' => '',
                'max_length' => '',
                'min' => '',
                'max' => '',
                'optionslayout' => 'inline',
                'calendar_min' => '',
                'calendar_max' => '',
                'calendar_format' => '',
            ) ,
        );
        $fieldcounter += 1;
        $email_layout .= "<p><strong>{" . str_replace(' ', '-', strtolower($message_label)) . ":label} :</strong> {" . str_replace(' ', '-', strtolower($message_label)) . ":value}</p>\r\n";
        // file attachment field
        $BrowseButtonVisibility = (string)$attr['BrowseButtonVisibility'];
        if ($BrowseButtonVisibility == "Visible")
        {
            $fields += array(
                'fields' . $fieldcounter => array(
                    'name' => 'file',
                    'type' => 'file',
                    'label' => 'File',
                    'required' => '0',
                    'custom_error' => '',
                    'show_label' => '1',
                    'options' => '',
                    'width' => '12',
                    'placeholder' => '',
                    'textarearows' => '4',
                    'min_length' => '',
                    'max_length' => '',
                    'min' => '',
                    'max' => '',
                    'optionslayout' => 'inline',
                    'calendar_min' => '',
                    'calendar_max' => '',
                    'calendar_format' => '',
                ) ,
            );
            $email_layout .= "<p><strong>{file:label} :</strong> {file:value}</p>\r\n";
        }
        $form_name = str_replace(' ', '-', strtolower('TT Form')) . "-" . $GLOBALS['formcounter'];
        $GLOBALS['formcounter'] += 1;
        // check if form exists
        $db_form = JFactory::getDbo();
        $db_form->setQuery("SELECT id FROM #__modules WHERE title = '" . $form_name . "'");
        $form_id = $db_form->loadResult();
        if ($form_id)
        {
            $db = JFactory::getDbo();
            $db->setQuery("DELETE FROM #__modules WHERE title='" . $form_name . "'");
            $db->execute();
        }
        $user = JFactory::getUser();
        $recipient_mail = '';
        if (empty($recipient_mail))
        {
            $recipient_mail = $user->email;
        }
        //pass array for new contact form
        $contactForm = array(
            'id' => '',
            'title' => $form_name,
            'note' => '',
            'module' => 'mod_jdsimplecontactform',
            'showtitle' => '0',
            'published' => '1',
            'publish_up' => '',
            'publish_down' => '',
            'client_id' => '0',
            'position' => '',
            'access' => '1',
            'ordering' => '1',
            'language' => '*',
            'assignment' => '0',
            'assigned' => array() ,
            'rules' => array(
                'core.delete' => array(
                    0
                ) ,
                'core.edit' => array(
                    0
                ) ,
                'core.edit.state' => array(
                    0
                ) ,
                'module.edit.frontend' => array(
                    0
                ) ,
            ) ,
            'params' => array(
                'title' => '',
                'description' => '',
                'ajaxsubmit' => '1',
                'captcha' => '0',
                'submittext' => 'Send Message',
                'submitclass' => 'btn-default btn-md',
                'submit_btn_width' => '8',
                'thankyou_message' => 'Message send successfully.',
                'redirect_url' => '',
                'fields' => $fields,
                'email_from' => '',
                'email_name' => '{name:value}',
                'email_subject' => '{subject:value}',
                'email_to' => $recipient_mail,
                'reply_to' => '',
                'email_cc' => '',
                'email_bcc' => $recipient_mail,
                'single_sendcopy_email' => '0',
                'singleSendCopyEmail_field' => '',
                'singleSendCopyEmailField_title' => '',
                'sendcopy_email' => '0',
                'sendcopyemail_field' => '',
                'sendcopyemailfield_title' => '',
                'email_template' => 'custom',
                'email_custom' => $email_layout,
                'layout' => '_:default',
                'moduleclass_sfx' => '',
                'module_tag' => 'div',
                'bootstrap_size' => '0',
                'header_tag' => 'h3',
                'header_class' => '',
                'style' => '0',
            ) ,
            'tags' => 'null'
        );
        $cform = Factory::getApplication()->bootComponent('com_modules')
            ->getMVCFactory()
            ->createModel('Module', 'Administrator');
        $tt_contact = $cform->save($contactForm);
        $db_form = JFactory::getDbo();
        $db_form->setQuery("SELECT id FROM #__modules WHERE title = '" . $form_name . "'");
        $form_id = $db_form->loadResult();
        return $form_id;
    }

    public function get_contactusform_data($contact_form)
    {
        $contactus_info = array();
        $i = 0;

        $i = $i + 1;

        if (!isset($contact_form->ListViewItem))
        {
            return false;
        }

        $contactus = array();
        foreach ($contact_form->ListViewItem as $item)
        {
            $item_name = preg_replace('/\s+/', '', $item);
            /*if("Email" == (string)$item_name)
             continue;*/

            $this->parse_items($item_name, $item, $contactus);
        }
        return $contactus;

    }

    private function parse_items($item_name, $item, &$contactus_info)
    {
        $item_id = 'ttr_item_id';
        $item_req = $item_id . 'req';
        $req = (string)$item->attributes()->Tag;
        if (isset($item->attributes()
            ->ContentStringFormat) && !empty($item->attributes()
            ->ContentStringFormat)) $contentstring = (string)$item->attributes()->ContentStringFormat;
        else $contentstring = "NoValidation";
        $hidden = (string)$item->attributes()->IsTabStop;
        $form_item = null;
        if ($req == "Mandate")
        {
            $form_item = array(
                "$item_id" => (string)$item,
                "item_format" => $contentstring,
                "$item_req" => 'on',
                "is_hidden" => $hidden
            );
        }
        else
        {
            $form_item = array(
                "$item_id" => (string)$item,
                "item_format" => $contentstring,
                "$item_req" => 'off',
                "is_hidden" => $hidden
            );
        }
        $contactus_info[] = $form_item;
    }
    function create_article_field()
    {
        $art_field = array(
            'id' => 0,
            'context' => 'com_content.article',
            'group_id' => '0',
            'assigned_cat_ids' => array(
                '0' => ""
            ) ,
            'title' => 'TTpageid',
            'name' => strtolower('TTpageid') ,
            'type' => 'text',
            'required' => '0',
            'default_value' => '',
            'state' => '1',
            'created_user_id' => "0",
            'language' => '*',
            'note' => "",
            'label' => 'TTpageid',
            'description' => "",
            'access' => '1',
            'rules' => array(
                'core.delete' => [],
                'core.edit' => [],
                'core.edit.state' => [],
                'core.edit.value' => []
            ) ,
            'params' => array(
                'hint' => "",
                'render_class' => "",
                'class' => "",
                'label_class' => "",
                'showlabel' => "1",
                'show_on' => "2",
                'label_render_class' => "",
                'display' => "2",
                'layout' => "",
                'display_readonly' => "2"
            ) ,
            'fieldparams' => array(
                'filter' => "JComponentHelper::filterText",
                'maxlength' => ""
            ) ,
        );

        $model = Factory::getApplication()->bootComponent('com_fields')
            ->getMVCFactory()
            ->createModel('Field', 'Administrator', ['ignore_request' => true]);
        //call model method
        $result = $model->save($art_field);
        return $result;
    }
    function create_articles($page, $item_id = 0)
    {
        $db = JFactory::getDbo();
        $db->setQuery("SELECT * FROM #__categories cat  WHERE cat.title='Page' AND cat.extension='com_content'");
        $cat_detail = $db->loadRow();
        $cat_id = $cat_detail[0];
        if ($page['show_title'] == "false")
        {
            $show_title = '0';
        }
        else
        {
            $show_title = '1';
        }
        $article = array(

            'id' => $item_id,
            'title' => $page['title'],
            'alias' => strtolower(str_replace(" ", '-', $page['alias'])) ,
            'note' => "",
            'version_note' => "",
            'articletext' => "",
            'state' => $page['state'],
            'catid' => $cat_id,
            'created' => JFactory::getDate()->toSQL() ,
            'created_by' => JFactory::getUser()
                ->get('id') ,
            'created_by_alias' => $page['created_by_alias'],
            'modified' => $page['modified'],
            'publish_up' => JFactory::getDate()->toSQL() ,
            'publish_down' => $page['publish_down'],
            'metakey' => "",
            'metadesc' => "",
            'access' => "1",
            'language' => "*",
            'featured' => $page['featured'],
            'introtext' => "",
            'contactforms' => $page['contactforms'],
            'attribs' => array(
                'article_layout' => "",
                'show_title' => $show_title,
                'link_titles' => "",
                'show_tags' => "",
                'show_intro' => "",
                'info_block_position' => "",
                'info_block_show_title' => "0",
                'show_category' => "0",
                'link_category' => "",
                'show_parent_category' => "",
                'link_parent_category' => "",
                'show_associations' => "",
                'show_author' => "0",
                'link_author' => "",
                'show_create_date' => "",
                'show_publisg_date' => "",
                'show_modify_date' => "",
                'show_item_navigation' => "0",
                'show_icons' => "",
                'show_print_icon' => "0",
                'show_email_icon' => "0",
                'show_votes' => "",
                'show_hits' => "0",
                'show_noauth' => "",
                'url_position' => "",
                'alternative_readmore' => "",
                'article_page_title' => "",
                'show_publishing_options' => "",
                'show_article_options' => "",
                'show_urls_images_backend' => "",
                'show_urls_images_frontend' => ""
            ) ,
            'xreference' => "",
            'images' => array(
                'image_intro' => "",
                'float_intro' => "",
                'image_intro_alt' => "",
                'image_intro_caption' => "",
                'image_fulltext' => "",
                'float_fulltext' => "",
                'image_fulltext_alt' => "",
                'image_fulltext_caption' => ""
            ) ,
            'urls' => array(
                'urla' => 0,
                'urlatext' => "",
                'targeta' => "",
                'urlb' => 0,
                'urlbtext' => "",
                'targetb' => "",
                'urlc' => 0,
                'urlctext' => "",
                'targetc' => ""
            ) ,
            'metadata' => array(
                'robots' => "",
                'author' => "",
                'rights' => "",
                'xreference' => ""
            ) ,
            'com_fields' => array(
                'ttpageid' => $page['meta_id']
            )
        );
        $model = Factory::getApplication()->bootComponent('com_content')
            ->getMVCFactory()
            ->createModel('Article', 'Administrator', ['ignore_request' => true]);
        //call model method
        $result = $model->save($article);
        return $result;
    }

    function update_articles($pages_info)
    {
        foreach ($pages_info as $num => $page)
        {
            // update article with contact form
            if (isset($page['contactforms']))
            {
                $contact_forms = $page['contactforms'];

                foreach ($contact_forms as $contact_info)
                {
                    foreach ($contact_info as $contact_form)
                    {
                        $contact_form_object = $this->get_contactusform_data($contact_form);
                        if (!$contact_form_object) return;
                        $con_id = $contact_form['id'];
                        $attr = $contact_form->attributes();
                        $contact_form_id = $this->save_contact_form($contact_form_object, $attr);
                        $page['introtext'] = str_replace($con_id, $contact_form_id, $page['introtext']);
                    }
                }
            }
            if (array_key_exists('introtext', $page))
            {
                $introtext = $this->set_link_src($page['introtext']);
            }
            $db = JFactory::getDbo();
            $db->setQuery("SELECT fvalue.item_id FROM #__fields_values fvalue WHERE fvalue.value ='" . $page['meta_id'] . "'");
            $item = $db->loadResult();
            $text = addslashes($introtext);
            $query1 = "update `#__content` set introtext='" . $text . "' where id = '" . $item . "'";
            $db1 = JFactory::getDBO();
            $db1->setQuery($query1);
            $db1->execute();
        }

    }
    private function insert_menu($menu_info)
    {
        global $alias_arrays;
        $alias_arrays = array();
        $db = JFactory::getDbo();
        // delete menu from menu_type
        $query = "DELETE FROM #__menu_types WHERE menutype='custommenu'";
        $db->setQuery($query);
        $db->execute();
        /*$db->setQuery("SELECT menu.id FROM #__menu_types menu WHERE menu.title='motgagecompany-j4-menu' AND menu.menutype='custommenu'");
        $mid = $db->loadResult();
        if(empty($mid))
        {*/
        // create TT-menu
        $this->add_tt_menu();
        //	}
        $menu_block = array(
            'title' => "motgagecompany-j4-menu",
            'type' => "custom_menu",
            'tt_blockID' => "tt_menu",
            'show_on_page' => array()
        );
        // unpublish if any other menu is set on menu position
        $query1 = "update `#__modules` set published=0 where position = 'Menu' and title != 'Admin Menu'";
        $db1 = JFactory::getDBO();
        $db1->setQuery($query1);
        $db1->execute();
        // add TT-menu module and assign menu position
        $this->add_module($menu_block, 'Menu', "menu");

        // delete all menu items
        $query = "DELETE FROM #__menu WHERE menutype='Custommenu'";
        $db->setQuery($query);
        $db->execute();

        foreach ($menu_info as $slug => $menuitem)
        {
	        $home = '0';
	        $link = "";
	        $layout = "";
	        $art_layout = "";
	        $mtype = "";
        	$show_title = '0';
            if ($menuitem['url'] != null)
            {
                $flag = true;
            }
            else
            {
                $flag = false;
            }
            if (!empty($menuitem['parent']))
            {
                $alias = $menuitem['menu_slug'];
                // set the path of parent and child menu items
                $parent_name = $menuitem['parent'];
                $query = "SELECT * FROM #__menu WHERE title ='" . $parent_name . "' AND menutype='custommenu'";
                $db = JFactory::getDBO();
                $db->setQuery($query);
                $result = $db->loadRow();
                $parent_id = $result[0];
            }
            else
            {
                $parent_id = 1;
                $alias = strtolower(str_replace(" ", '-', $menuitem['menu_slug']));
            }
            $query_menu = "SELECT * FROM #__menu WHERE alias ='" . $alias . "'";
            $db2 = JFactory::getDBO();
            $db2->setQuery($query_menu);
            $result = $db2->loadRow();
            if ($result != null)
            {
                $new_alias = $alias . "-tt";
            }
            else
            {
                $new_alias = $alias;
            }
            // stores the value of menu-items alias in array depending upon the existing values of menu items
            $alias_array = array(
                $alias => $new_alias
            );
            $alias_arrays = array_merge($alias_arrays, $alias_array);
            if (strtolower($menuitem['menu_item_id']) == "home")
            {
                $home = '1'; // set home page as default front page
                
            }
            else
            {
                $home = '0';
            }

            if ($flag == true)
            {
                $link = JURI::root() . "index.php" . $menuitem['url'];
                $mtype = "url";
                $layout = "";
                $art_layout = "";
            }
            else
            {
                if ($menuitem['articletype'] == "article")
                {
                    $db1 = JFactory::getDbo();
                    $db1->setQuery("SELECT * FROM #__categories cat  WHERE cat.title='Page' AND cat.extension='com_content'");
                    $cat_details = $db1->loadRow();
                    $categoryid = $cat_details[0];
                    $art_slug = $menuitem['menu_slug'];
					$query = "SELECT * FROM #__content WHERE alias ='" .$art_slug. "'and catid = '".$categoryid."'";
                    $db = JFactory::getDBO();
                    $db->setQuery($query);
                    $result = $db->loadRow();
                    if($result)
                    {
	                    if(strtolower($menuitem['menu_item_id']) == "home")
						{
						$home = '1'; // set home page as default front page
						}
						
	                    $art_id = $result[0];
	                    $db2 = JFactory::getDBO();
	                    $db2->setQuery("SELECT attribs FROM #__content WHERE id ='" . $art_id . "'");
	                    $show_result = $db2->loadRowList();
	                    if ($show_result)
	                    {
		                    foreach ($show_result as $output) $parameter = json_decode($output[0], true);
		                    $show_title = $parameter['show_title'];
	                    }
	                    
	                    $link = 'index.php?option=com_content&view=' . $menuitem['articletype'] . '&id=' . $art_id;
	                    $layout = "";
	                    $art_layout = "";
	                    $mtype = "component";
                    }
                    else
                    {
                    error_log('Theme Import Content Module Error : Unable to make Menu Item "' . $menuitem['title'] . '", may be because of mismatched slug of menu item or the article not found.');
                    }
                }

                if ($menuitem['articletype'] == "category")
                {
                    $link = 'index.php?option=com_content&view=' . $menuitem['articletype'] . '&layout=blog&id=2';
                    $layout = "blog";
                    $art_layout = "_:default";
                    $mtype = "component";
                    $show_title = "1";
                }
            }

            $query = "SELECT * FROM #__extensions WHERE name = 'com_content'";
            $db->setQuery($query);
            $res = $db->loadRow();
            $comp_id = $res[0];
            $menu_item = array(
                'id' => 0,
                'title' => $menuitem['title'],
                'alias' => $new_alias,
                'note' => "",
                'link' => $link,
                'menutype' => "custommenu",
                'type' => $mtype,
                'published' => 1,
                'parent_id' => $parent_id,
                'component_id' => $comp_id,
                'browserNav' => "",
                'access' => 1,
                'template_style_id' => 0,
                'home' => $home,
                'language' => "*",
                'toggle_modules_assigned' => 1,
                'toggle_modules_published' => 1,
                'params' => array(
                    'layout_type' => $layout,
                    'article_layout' => $art_layout,
                    'orderby_sec' => "",
                    'order_date' => "",
                    'display_num' => "",
                    'filter_field' => "",
                    'introtext_limit' => "100",
                    'show_intro' => "",
                    'info_block_position' => "",
                    'info_block_show_title' => "0",
                    'show_category' => "0",
                    'link_category' => "",
                    'show_parent_category' => "",
                    'link_parent_category' => "",
                    'link_titles' => "",
                    'show_title' => $show_title,
                    'show_author' => "0",
                    'link_author' => "",
                    'show_create_date' => "",
                    'show_modify_date' => "",
                    'show_publish_date' => "0",
                    'show_item_navigation' => "0",
                    'show_hits' => "0",
                    'menu-anchor_title' => "",
                    'menu-anchor_css' => "",
                    'menu_image' => "",
                    'menu_image_css' => "",
                    'menu_text' => 1,
                    'menu_show' => $menuitem['status'],
                    'show_print_icon' => "0",
                    'show_email_icon' => "0",
                    'page_title' => "",
                    'show_page_heading' => "",
                    'page_heading' => "",
                    'page_class_sfx' => "",
                    'menu-meta_description' => "",
                    'menu-meta_keywords' => "",
                    'robots' => "",
                    'secure' => 0,
                )
            );
            $model = Factory::getApplication()->bootComponent('com_menus')
                ->getMVCFactory()
                ->createModel('Item', 'Administrator');
            $result = $model->save($menu_item);
        }
        return $result;

    }
    function add_tt_menu()
    {
        $menu = array(
            'id' => 0,
            'menutype' => strtolower("Custommenu") ,
            'title' => "motgagecompany-j4-menu",
            'description' => "This is TemplateToaster Custom menu",
            'client_id' => "0",
            'rules' => array(
                'core.manage' => "",
                'core.create' => "",
                'core.delete' => "",
                'core.edit' => "",
                'core.edit.state' => ""
            )
        );

        $model = Factory::getApplication()->bootComponent('com_menus')
            ->getMVCFactory()
            ->createModel('Menu', 'Administrator');
        $result = $model->save($menu);
        return $result;
    }

    private function insert_shapes($text_blocks, $block_type)
    {
        foreach ($text_blocks as $text_block)
        {
            foreach ($text_block[$block_type] as $block)
            {
                $position = $block['name'];
                $result = $this->add_module($block, $position, "shapes");
            }
        }
        return $result;
    }

    private function insert_footer($footers_info)
    {
        foreach ($footers_info as $footer)
        {
            foreach ($footer['cell'] as $block)
            {
                $position = $footer['name'];
                if (isset($block['contactforms']))
                {
                    //contact form import
                    $contact_forms = $block['contactforms'];

                    foreach ($contact_forms as $contact_info)
                    {
                        foreach ($contact_info as $contact_form)
                        {
                            $contact_form_object = $this->get_contactusform_data($contact_form);
                            if (!$contact_form_object) return;
                            $con_id = $contact_form['id'];
                            $attr = $contact_form->attributes();
                            $contact_form_id = $this->save_contact_form($contact_form_object, $attr);
                            $block['content'] = str_replace($con_id, $contact_form_id, $block['content']);
                        }
                    }
                }
                $result = $this->add_module($block, $position, "footer");
            }
        }
        return $result;
    }

    private function insert_sidebars($sidebars_info)
    {
        foreach ($sidebars_info as $sidebar)
        {
            foreach ($sidebar['blocks'] as $block)
            {
                $position = $sidebar['name'];
                if (isset($block['contactforms']))
                {
                    //contact form import
                    $contact_forms = $block['contactforms'];

                    foreach ($contact_forms as $contact_info)
                    {
                        foreach ($contact_info as $contact_form)
                        {
                            $contact_form_object = $this->get_contactusform_data($contact_form);
                            if (!$contact_form_object) return;
                            $con_id = $contact_form['id'];
                            $attr = $contact_form->attributes();
                            $contact_form_id = $this->save_contact_form($contact_form_object, $attr);
                            $block['content'] = str_replace($con_id, $contact_form_id, $block['content']);
                        }
                    }
                }
                $result = $this->add_module($block, $position, "sidebar");
            }
        }
        $search_block = array(
            'title' => "Search",
            'type' => "search",
            'tt_blockID' => "tt_search",
            'show_on_page' => array(
                "blog"
            )
        );
        $result = $this->add_module($search_block, $position = "right", "sidebar");
        return $result;
    }
    function delete_existing_tt_blocks()
    {
        $model = Factory::getApplication()->bootComponent('com_modules')
            ->getMVCFactory()
            ->createModel('Module', 'Administrator');
        $db = JFactory::getDBO();
        $db->setQuery("SELECT id,params,position FROM #__modules");
        $result = $db->loadRowList();
        if ($result)
        {
            foreach ($result as $out)
            {
                if($out[1] != null && $out[2] != null)
				{	$parameter = json_decode($out[1],true);
					if ($out[2] == 'left' || $out[2] == 'right' || array_key_exists ('tt_blockID', $parameter))
					{
						$db1 = JFactory::getDBO();
						$db1->setQuery("UPDATE #__modules SET published = '-2' WHERE id =". $out[0]);
						$db1->execute();
						$model->delete($out[0]);
					} 
				}
            }
        }
    }
    function add_module($block, $position, $location)
    {
        global $alias_arrays;
        $model = Factory::getApplication()->bootComponent('com_modules')
            ->getMVCFactory()
            ->createModel('Module', 'Administrator');
        $assign_id = array();

        if (empty($block['show_on_page']))
        {
            $assign_id = array();
        }
        else
        {
            // get the id of the pages to show the module
            foreach ($block['show_on_page'] as $single)
            {
                $val = strtolower($single);
                if (is_array($alias_arrays) && isset($alias_arrays[$val]))
                {
                    $value = $alias_arrays[$val];
                    $query1 = "SELECT id FROM #__menu WHERE alias='" . $value . "'";
                    $db = JFactory::getDBO();
                    $db->setQuery($query1);
                    $ids = (int)$db->loadResult();
                    if ($ids != null)
                    {
                        array_push($assign_id, $ids);
                    }
                }
            }
        }
        if ($block['type'] == 'custom_menu')
        {
            $mod = 'mod_menu';
            $content = " ";
        }
        else if ($block['type'] == 'search')
        {
            $mod = 'mod_search';
            $content = " ";
        }
        else
        {
            $mod = 'mod_custom';
            $content = $this->set_link_src($block['content']);
        }
        $rootFolder = explode(DS, dirname(__FILE__));
        $mod_folder = implode(DS, $rootFolder);
        $obj = new Templatetoaster_Parse_Content($mod_folder . '/content.xml');
        $menu_info = $obj->get_menu_data();
        $count_items = count($menu_info);
        $count = count($block['show_on_page']);
        if ($count == $count_items || $block['show_on_page'] == null)
        {
            $assignment = "0"; // if module is present on the pages
            
        }
        else
        {
            $assignment = "1"; // selected pages
            
        }
        if ($location == "footer" || $location == "shapes")
        {
            $showtitle = "0";
        }
        else
        {
            $showtitle = "1";
        }
        $module = array(
            'title' => $block['title'],
            'content' => $content,
            'showtitle' => $showtitle,
            'position' => $position,
            'published' => "1",
            'publish_up' => "",
            'publish_down' => "",
            'access' => "1",
            'ordering' => "1",
            'language' => "*",
            'note' => "",
            'assignment' => $assignment,
            'assigned' => $assign_id,
            'params' => array(
                'prepare_content' => "1",
                'backgroungimage' => "",
                'layout' => "_:default",
                'moduleclass_sfx' => "",
                'menutype' => "custommenu",
                'startLevel' => 1,
                'endLevel' => 0,
                'showAllChildren' => 1,
                'cache' => 1,
                'cache_time' => 900,
                'cachemode' => "static",
                'module_tag' => "div",
                'bootstrap_size' => "0",
                'header_tag' => "h3",
                'header_class' => "",
                'style' => "0",
                'tt_blockID' => $block["tt_blockID"]
            ) ,
            'rules' => array(
                'core.delete' => [],
                'core.edit' => [],
                'core.edit.state' => [],
                'module.edit.frontend' => []
            ) ,
            'module' => $mod,
            'client_id' => "",
            'id' => 0
        );
        $result = $model->save($module);
        return $result;
    }
    // upload the images to joomla
    private function upload_media($type)
    {
        jimport('joomla.filesystem.folder');
        $path = JPATH_SITE . "/" . "images" . "/motgagecompany-j4/";
        $mode = 0755;
        JFolder::create($path, $mode);

        $result = true;

        $rootFolder = explode(DS, dirname(__FILE__));
        $tt_images_dir = implode(DS, $rootFolder) . '/' . $type;
        $tt_content_images = opendir($tt_images_dir);
        //$base_folder = implode(DS,$rootFolder).'\images';
        $currentfolderlevel = 4;
        array_splice($rootFolder, -$currentfolderlevel);
        while ($tt_read_image = readdir($tt_content_images))
        {
            $var1 = $tt_images_dir . "/" . $tt_read_image;
            $searchpath = implode(DS, $rootFolder) . "/" . $type;
            if (JFolder::exists($path))
            {
                $var2 = implode(DS, $rootFolder) . "/" . "images" . "/motgagecompany-j4/" . $tt_read_image;
                if ($tt_read_image != '.' && $tt_read_image != '..')
                {
                    if (!file_exists($tt_read_image))
                    {
                        $result = $result && copy($var1, $var2);
                    }
                }
            }
        }
        return $result;
    }
    // find image source from the content
    function tt_media_src($match)
    {
        $url1 = JURI::root() . 'images/motgagecompany-j4';
        list($str, $src_attr, $quote, $filename, $png) = $match;

        return $src_attr . $quote . $url1 . '/' . $png . $quote;
    }

    // find the links from the content
    function tt_link_src($match)
    {
        global $alias_arrays;
        $pagename = $match[1];
        if ($pagename != "#")
        {
            $pagename = strtolower(str_replace(" ", '-', $pagename));
            $url = JURI::root();
            $value = $alias_arrays[$pagename];
            $query = "SELECT id FROM #__menu WHERE alias ='" . $value . "'";
            $db = JFactory::getDBO();
            $db->setQuery($query);
            $article = $db->loadResult();
            // return 'href='. $url . 'index.php?Itemid='. $article ;
            $path = $url . "index.php?Itemid=" . $article;
            return $path;
        }

    }

    // Replaces the Img sources according to your
    private function set_link_src($post)
    {
        $str = '<?php echo $template_path; ?>';
        $post = str_replace($str, '', $post);
        $post = preg_replace_callback('/(src=)([\'"])([\/\\\]?images[\/\\\]?)(.*?)\2()/', array(
            $this,
            'tt_media_src'
        ) , $post);
        $post = preg_replace_callback('/[\'<][\'?]php echo get_url[\'(][\'"]?([^\'" >]+)[\')][\')][\';][\'?][\'>]/', array(
            $this,
            'tt_link_src'
        ) , $post);
        $post = preg_replace_callback('/(src=)([\'"])([\/\\\]?video[\/\\\]?)(.*?)\2()/', array(
            $this,
            'tt_media_src'
        ) , $post);

        return $post;
    }
}

//class end
// instance created and start the importing process.
function templatetoaster_import_start()
{
    $output = null;
    $tt_content_importer = new Templatetoaster_Import_Content();
    $result = $tt_content_importer->start_import();

    if ($result)
    {
        $query = "update `#__modules` set ordering=0,published=0,access=0 where module = 'mod_ttcontent'";
        $db = JFactory::getDBO();
        $db->setQuery($query);
        $db->execute();
        $query1 = "update `#__fields` set state=0 where title = 'TTpageid'";
        $db1 = JFactory::getDBO();
        $db1->setQuery($query1);
        $db1->execute();
        $output = '<div class="alert alert-success">Content Imported Successfully</div> 
					<style type="text/css">
					input[type="submit"].btn
					{
					display:none;
					}
					</style>';
    }
    else
    {
        $output = '<div class="alert alert-danger">There is an error while importing content</div> ';
    }
    return $output;
}

?>
