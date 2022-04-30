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

defined('_JEXEC') or die;

use RegularLabs\Library\Protect as RL_Protect;
use RegularLabs\Plugin\System\AdvancedModules\Plugin;

// Do not instantiate plugin on install pages
// to prevent installation/update breaking because of potential breaking changes
$input = \Joomla\CMS\Factory::getApplication()->input;
if ($input->get('action') != '' && in_array($input->get('option'), ['com_installer', 'com_regularlabsmanager']))
{
	return;
}

if ( ! is_file(__DIR__ . '/vendor/autoload.php'))
{
	return;
}

require_once __DIR__ . '/vendor/autoload.php';

class PlgSystemAdvancedModules extends Plugin
{
	public $_alias       = 'advancedmodules';
	public $_title       = 'ADVANCED_MODULE_MANAGER';
	public $_lang_prefix = 'AMM';

	public $_page_types      = ['html'];
	public $_enable_in_admin = true;

	public function extraChecks()
	{
		if ( ! RL_Protect::isComponentInstalled('advancedmodules'))
		{
			return false;
		}

		return true;
	}

	/*
	 * Below are the events that this plugin uses
	 * All handling is passed along to the parent run method
	 */
	public function onAfterInitialise()
	{
		$this->run();
	}

	public function onAfterRoute()
	{
		$this->run();
	}

	public function onAfterRender()
	{
		$this->run();
	}
}

