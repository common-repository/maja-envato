<?php

/*

The shortcode class

*/

class MAJA_Envato_ShortCode
{
	function maja_func($atts, $content = null)
	{
		$defclass = new MAJA_Envato_Default();
		$def = $defclass->get_default();
		
		$atts = shortcode_atts($def, $atts);
		
		ob_start();
			
		$out = new Maja_Envato_Output();
		$out->output($atts);
				
		$res = ob_get_contents();
		ob_clean();
		return $res;
    }
}

add_shortcode( 'majaenvato', array('MAJA_Envato_ShortCode', 'maja_func') );


?>