<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Weblinks
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\CMSPlugin;

/**
 * System plugin for Joomla Web Links.
 *
 * @since  __DEPLOY_VERSION__
 */
class PlgSystemWeblinks extends CMSPlugin
{
	/**
	 * Database Driver Instance
	 *
	 * @var    \Joomla\Database\DatabaseDriver
	 * @since  4.0.0
	 */
	protected $db;

	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  __DEPLOY_VERSION__
	 */
	protected $autoloadLanguage = true;

	/**
	 * Supported Extensions
	 *
	 * @var    array
	 * @since  __DEPLOY_VERSION__
	 */
	private $supportedExtensions = array(
		'mod_stats',
		'mod_stats_admin',
	);

	/**
	 * Method to add statistics information to Administrator control panel.
	 *
	 * @param   string  $extension  The extension requesting information.
	 *
	 * @return  array containing statistical information.
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function onGetStats($extension)
	{
		if (!in_array($extension, $this->supportedExtensions))
		{
			return array();
		}

		if (!ComponentHelper::isEnabled('com_weblinks'))
		{
			return array();
		}

		$query = $this->db->getQuery(true)
			->select('COUNT(id) AS count_links')
			->from('#__weblinks')
			->where('state = 1');
		$webLinks = $this->db->setQuery($query)->loadResult();

		if (!$webLinks)
		{
			return array();
		}

		return array(array(
			'title' => Text::_('PLG_SYSTEM_WEBLINKS_STATISTICS'),
			'icon'  => 'out-2',
			'data'  => $webLinks
		));
	}
}
