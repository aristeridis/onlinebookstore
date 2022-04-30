<?php
/**
 * @package         Regular Labs Library
 * @version         18.11.3959
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2018 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

use RegularLabs\Library\ShowOn as RL_ShowOn;

if ( ! is_file(JPATH_LIBRARIES . '/regularlabs/autoload.php'))
{
	return;
}

require_once JPATH_LIBRARIES . '/regularlabs/autoload.php';

class JFormFieldRL_ShowOn extends \RegularLabs\Library\Field
{
	public $type = 'ShowOn';

	protected function getLabel()
	{
		return '';
	}

	protected function getInput()
	{
		$this->params = $this->element->attributes();

		$value       = (string) $this->get('value');
		$animate     = $this->get('animate', 1);
		$class       = $this->get('class', '');
		$formControl = $this->get('form', $this->formControl);
		$formControl = $formControl == 'root' ? '' : $formControl;

		if ( ! $value)
		{
			return RL_ShowOn::close();
		}

		return '</div></div>'
			. RL_ShowOn::open($value, $formControl, $this->group, $animate, $class)
			. '<div><div>';
	}
}
