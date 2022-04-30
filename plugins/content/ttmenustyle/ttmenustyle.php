<?php
/**
 * @copyright   Copyright (c) 2020 TTMENUSTYLE. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.plugin.plugin' );

/**
 * content - ttmenustyle Plugin
 *
 * @package     Joomla.Plugin
 * @subpakage   TTMENUSTYLE.ttmenustyle
 */
class plgcontentttmenustyle extends JPlugin {
	/**
	 * Load the language file on instantiation.
	 *
	 * @var boolean
	 */
	protected $autoloadLanguage = true;
	/**
	 * Constructor.
	 *
	 * @param   $subject
	 * @param   array   $config
	 */
	function __construct( &$subject, $config = array() ) {
		// call parent constructor
		parent::__construct( $subject, $config );
	}
	/**
	 * Prepare form and add my field.
	 *
	 * @param   JForm $form  The form to be altered.
	 * @param   mixed $data  The associated data for the form.
	 *
	 * @return  boolean
	 *
	 * @since   1.0
	 */
	function onContentPrepareForm( $form, $data ) {
		$app    = JFactory::getApplication();
		$option = $app->input->get( 'option' );

		switch ( $option ) {
			case 'com_modules':
				JForm::addFormPath( __DIR__ . '/forms' );
				$form->loadFile( 'advanced' );

				if ( $form->getName() != 'com_modules.module'
				|| ( $form->getName() == 'com_modules.module' && $data && ( $data->module != 'mod_menu' && $data->module != 'mod_search' ) ) ) {
					return;
				}
				
				if ( $form->getName() == 'com_modules.module' && $data && $data->module == 'mod_menu' ) {
					$form->loadFile( 'menu' );
					
				} elseif ( $form->getName() == 'com_modules.module' && $data && $data->module == 'mod_search' ) {
					$form->loadFile( 'search' );
				
				} else { // required to save fields data.
					$form->loadFile( 'menu' );
					$form->loadFile( 'search' );
					
				}
		}
		return true;
	}
}
