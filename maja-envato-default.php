<?php

/*

The default values

*/

class MAJA_Envato_Default
{
	function get_default()
	{
		$def = array(
					'title' 		=> '', 
					
					'market' 	=> 'themeforest',
					'action' 	=> 'popular',
					'sub' 	=> 'items_last_week',
					'count' => 5,
					'refer' => 'majakovskij',
					'cache' => 30,
					
					'thumb_width' => 80,
					'padding' => 10,
					'columns' => 3,
										
					'use_class'			=>'',
					'use_container'     =>'div',
					'use_hook'			=>''
                );	
                
          return $def;
     }
}


?>