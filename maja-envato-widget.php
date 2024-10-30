<?php

/*

The Widget class

*/


class MAJA_Envato_Widget extends WP_Widget
{

	  var $ns = 'MAJA_Envato_Widget'; /**/
	
	  function MAJA_Envato_Widget() /**/
	  {
	  		global $pagenow;
	  		
		    $widget_ops = array('classname' => $this->ns, 'description' => '' );
			$control_ops = array( 'id_base' => strtolower($this->ns) );
			$exp = explode('_', $this->ns);
		    $this->WP_Widget($this->ns, $exp[0]." ".$exp[1], $widget_ops, $control_ops);
		    
		    if('widgets.php'==$pagenow)
		    {
		    	// load something
		    }
	  }
	 
	 


	
	
	
	  function form($instance)
	  {
	  		$defclass = new MAJA_Envato_Default(); /**/
	  		
	  		$instance = wp_parse_args( (array) $instance, $defclass->get_default() );
	  		
	  		$out = new Maja_Envato_Form(); /**/
	  		
	  		$out->output($this, $instance);
	  }
		
		
	
	
	
	  function update($new_instance, $old_instance)
	  {
		    $instance = $old_instance;
		    
	  		$defclass = new MAJA_Envato_Default(); /**/
		    $fields = $defclass->get_default();
		    
		    foreach($fields as $k => $v)
		    {
		    	$instance[ $k ] = strip_tags( $new_instance[ $k ] );
		    }
		    
		    return $instance;
	  }
	 
	 
	 
	 
	 
	 
	  function widget($args, $instance)
	  {
	  		if(!is_admin()) // dont render output if in admin panel
	  		{
		  		extract($args, EXTR_SKIP);
		  		
		  		$before = $before_widget;
		  			  		
				$title = empty($instance['title']) ? '' : apply_filters('widget_title', strip_tags($instance['title']));
				if (!empty($title)) $before .= $before_title . $title . $after_title;
		  
		  		$out = new Maja_Envato_Output(); /**/
				$out->output($instance, $before, $after_widget);
			}
	  }
 
 
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("MAJA_Envato_Widget");') ); /**/
?>