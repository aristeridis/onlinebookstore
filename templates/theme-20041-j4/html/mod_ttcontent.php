<?php
defined('_JEXEC') or die;

// Include dependencies.
JLoader::register('ModTTContentHelper', __DIR__ . '/helper.php');
JLoader::register('ModTTContentHelper', __DIR__ . '/default.php');

// Instantiate global document object
$doc = JFactory::getDocument();

$js = <<<JS
(function ($) {
	$(document).on('click', 'input[name=ttr_data]', function (event) {
         event.preventDefault();
		
		request = {
					'option' : 'com_ajax',
					'module' : 'ttcontent',
					'format' : 'raw'
				};
 $('.progress').css('display','flex');
		$.ajax
         ({
			type   : 'POST',
			data   : request,
                     success:function(response)
                     {
							
                           if(response.success = 'success')
                            {		 
								$('.progress').css('display','none');
								 $('.status_msg').html(response);
                        		
                            }
	                        else
	                        {
								 $('.progress').css('display','none');
	                           $('.status_msg').html(response);
	                        }
                     }
		});
	});
})(jQuery)
    
JS;
$doc->addScriptDeclaration($js);
$style='.progress {'	
	.'width: 20px;'
	.'height:20px;'
	.'z-index: 9999;'
	.'margin-top:10px'
	.'}'
	.'.progress img{'
	.'height:20px'
	.'}';
$doc->addStyleDeclaration($style);

require JModuleHelper::getLayoutPath('mod_ttcontent', $params->get('layout', 'default'));