<?php
/**
 * @copyright   Copyright (c) 2020 TTMENUSTYLE. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgContentTTMENUSTYLEInstallerScript {

	function update( $parent ) {
		$this->install( $parent );
	}

	function install( $parent ) {
		// Joomla version.
		$joomlaVersion = 4;
		// activate the plugin
		 $db             = JFactory::getDbo();
		$tableExtensions = $db->quoteName( '#__extensions' );
		$columnElement   = $db->quoteName( 'element' );
		$columnType      = $db->quoteName( 'type' );
		$columnEnabled   = $db->quoteName( 'enabled' );

		// Enable plugin
		$db->setQuery( "UPDATE $tableExtensions SET $columnEnabled=1 WHERE $columnElement='ttmenustyle' AND $columnType='plugin'" );
		if ( $joomlaVersion < 4 ) {
			$db->query();
		} else {
			$db->execute();
		}

		echo '<br /><p>' . JText::_( 'TTMENUSTYLE_PLUGIN_ENABLED' ) . '</p><br />';
	}
}

