<?php
/**
 * @package         Advanced Module Manager
 * @version         7.8.6
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2018 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

/**
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\CMS\Factory as JFactory;
use Joomla\CMS\Form\FormHelper as JFormHelper;

JFormHelper::loadFieldClass('list');

require_once __DIR__ . '/../../helpers/modules.php';

class JFormFieldModulesMenuId extends JFormFieldList
{
	protected $type = 'ModulesMenuId';

	public function getOptions()
	{
		$clientId = JFactory::getApplication()->input->get('client_id', 0, 'int');
		$options  = ModulesHelper::getMenuItemAssignmentOptions($clientId);

		return array_merge(parent::getOptions(), $options);
	}
}
