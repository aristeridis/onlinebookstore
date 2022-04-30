<?php 

defined('_JEXEC') or die;
JLoader::register('ModTTContentHelper', __DIR__ . '/helper.php');
JLoader::register('ModTTContentHelper', __DIR__ . '/imports.php');
?>
<html>
    <body>
    <div class="status" id="content_import"> 
<h2>Import content from Joomla Template</h2>	
      <form>
        <input name="ttr_data" type="submit" value="Import Content" class="btn btn-primary"/>
      </form>
    <div class='progress' style="display:none;"><img src='<?php echo JURI::root().'administrator/modules/mod_ttcontent/images/Spinner.gif'; ?>'></div>
    </div>
     <div class="status_msg"></div>
    </body>
</html>