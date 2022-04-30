<?php

defined('_JEXEC') or die();

class pkg_TT_ContentInstallerScript
{
    
    /**
     * Called after any type of action
     *
     * @param     string              $route      Which action is happening (install|uninstall|discover_install)
     *
     * @return    boolean                         True on success
     */
    public function postflight($route)
    {
		jimport('joomla.filesystem.file');
        // Enable module
		$query = "update `#__extensions` set enabled=1 where type = 'module' and element = 'mod_ttcontent'";
		$db = JFactory::getDBO();
		$db->setQuery($query);
		$db->execute();
		
		$query= "select id  from `#__modules` where  module like 'mod_ttcontent'";
		$db->setQuery($query);
		$id=$db->loadResult();
		
		$query2 = "select * from `#__modules_menu` where  moduleid=".$id;
		$db->setQuery($query2);
		$result=$db->loadResult();
		if(!$result)
		{
			// Module assignment
			$query = "insert into `#__modules_menu` (menuid, moduleid) select 0 as menuid, id as moduleid from `#__modules`
                        where  module like 'mod_ttcontent'";
			$db->setQuery($query);
			$db->execute();
		}
		// Module default location
		$query = "update `#__modules` set position='cpanel',ordering=-1,published=1,access=2 where module = 'mod_ttcontent'";
		$db = JFactory::getDBO();
		$db->setQuery($query);
		$result = $db->execute();
		// set the default template
		$filename =  JFile::makeSafe('motgagecompany-j4');
		$db1 = JFactory::getDBO();
		$query1 = "select id from `#__template_styles` where template='". $filename . "'";
		$db1->setQuery($query1);
		$tid = $db1->loadResult();
		$model = new \Joomla\Component\Templates\Administrator\Model\StyleModel;
		$model->setHome($tid);
		// redirect to control panel import content button
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>
		<div class="alert-message">To import content, please <a href="index.php#content_import">Click here.</a></div>
		</div>';
			
    }
     
 
}
