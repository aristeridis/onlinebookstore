<?php

defined('_JEXEC') or die;

abstract class ModTTContentHelper  
{

public static function getAjax()
     {

     	$result= ModTTContentHelper::import_content();
     	return $result;
    
	
	
}
public static function import_content()
	{
		if (!defined('DS')) {
		define( 'DS', DIRECTORY_SEPARATOR );
		}
		//get root folder
		$rootFolder = explode(DS,dirname(__FILE__));
		$mod_folder = implode(DS,$rootFolder);
		$importpath = $mod_folder.'/content/imports.php';
		require_once($importpath);
		$import_result = templatetoaster_import_start();
		return $import_result;
	}
 
}