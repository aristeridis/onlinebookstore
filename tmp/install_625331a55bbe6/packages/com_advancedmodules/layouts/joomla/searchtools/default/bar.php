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
use Joomla\CMS\Layout\LayoutHelper as JLayoutHelper;

$data = $displayData;

if ($data['view'] instanceof AdvancedModulesViewModules && JFactory::getApplication()->input->get('layout', '', 'cmd') !== 'modal')
{
	// Add the client selector before the form filters.
	$clientIdField = $data['view']->filterForm->getField('client_id');
	?>
	<div class="js-stools-field-filter js-stools-client_id">
		<?php echo $clientIdField->input; ?>
	</div>
	<?php
}

// Display the main joomla layout.
echo JLayoutHelper::render('joomla.searchtools.default.bar', $data, null, ['component' => 'none']);
