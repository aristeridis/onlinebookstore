<?php

defined('JPATH_BASE') or die;
jimport('joomla.form.formfield');


class JFormFieldBTLAbout extends JFormField{

	public function getTemplateName(){
		$value = explode( DIRECTORY_SEPARATOR, str_replace( array( '\elements', '/elements' ), '', dirname(__FILE__) )) ;
		$templateName 	= end($value);
		//$templateName 	= $templateName [ count( $templateName ) - 1 ];
		return $templateName;
	}

	protected function getInput(){


		//reset if 1
		$reset = $this->form->getData()->get('params')->reset;
		
		if($reset == 1){
			$stdParams = trim(file_get_contents(__DIR__.'/../admin/default_DB.txt'));;

			//set params to DB
			$stdParamsToDb = addslashes($stdParams);
			$db = JFactory::getDbo();
			$query = "UPDATE #__template_styles SET params = '".$stdParamsToDb."' WHERE template = '".$this->getTemplateName()."'";
			$db->setQuery($query);
			$result = $db->query();

			//update page, in order to add new values in form
			$uri = JFactory::getURI();
			$app = JFactory::getApplication();
			$url = $uri->toString();
			$app->redirect($url);
		}


		$doc = JFactory::getDocument();

		$templateName = $this->getTemplateName();

 		$doc->addStyleSheet(JURI::root().'templates/'.$templateName.'/admin/css/btl_admin.css');
		if(version_compare(JVERSION,"3.0.0","lt")){
		    $doc->addScript(JURI::root().'templates/'.$templateName.'/admin/js/btl_slider.js');
		    $doc->addScript(JURI::root().'templates/'.$templateName.'/admin/js/btl_admin.js');
		}
	}

}
