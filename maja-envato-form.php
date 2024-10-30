<?php

/*

The Widget Form

*/


class Maja_Envato_Form
{

	function output($parent, $instance)
	{
	
		$core = new MAJA_Envato_Core("maja-envato");  /**/

		$core->setFieldsGenerator($parent, $instance);
		
		$core->get_textfield('title', 'Title');
		
		$core->get_dropdown('market', array('activeden','themeforest','codecanyon','audiojungle','videohive','graphicriver','3docean','photodune'), 'Market');
		
		$core->get_dropdown('action', array('popular', 'random-new-files'), 'Action');

		$core->get_dropdown('sub', array('items_last_week', 'items_last_three_months'), 'Range');

		$core->get_textfield('count', 'Number of items');
		
		$core->get_textfield('refer', 'Referrer Username');
		
		$core->get_textfield('cache', 'Cache expires <small>in minutes</small>');
		
		$core->get_textfield('thumb_width', 'Thumb Width');
		$core->get_textfield('padding', 'Padding');
		$core->get_textfield('columns', 'Number of Columns');


		
		$core->get_textfield('use_class', 'Container CSS class');
		$arr = $core->getThemePlugins();		
		if(count($arr)>1)
		{
			$core->get_textfield('use_container', 'Container tag');
			$core->get_dropdown('use_hook', $arr, 'Output Template');
		}
		
	}
}
?>