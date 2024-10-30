<?php

/*
A Generic helper class
Version: 1.6
*/

class Maja_Envato_Core
{
	var $parent;
	var $instance;
	var $pathname;
	
	function Maja_Envato_Core($pathname)
	{
		$this->pathname = $pathname;
		//if( STYLESHEETPATH == TEMPLATEPATH ) // is not child
	}
	
	
	function getThemePlugins()
	{
		$res = array('');
		
		$path_int = "templates/";
		$internal = $this->getTemplates($path_int);
		foreach ($internal as $value) {
			array_push($res, $value);
		}

		$path_ext = TEMPLATEPATH . "/" . $this->pathname ."/";
		$external = $this->getTemplates($path_ext);
		foreach ($external as $value) {
			array_push($res, $value);
		}
		
		return $res;
	}
	
	
	
	
	function getTemplates($path)
	{
		$res = array();
		if(is_dir($path) && file_exists($path) )
		{
			if ($handle = opendir($path)) {
			    while (false !== ($entry = readdir($handle)))
			    {
			        if ($entry != "." && $entry != "..")
			        {
			        	$tmp = explode(".", $entry);
			        	if( strtolower($tmp[1]) == "php")
			        	{
			        		array_push($res, $tmp[0]);
			        	}
			        }
			    }
			    closedir($handle);
			}
		}
		return $res;
	}
	
	
	function checkTemplate($hook)
	{
		$template = false;
		
		$path_ext = TEMPLATEPATH . "/" . $this->pathname . "/" . $hook . ".php";
		$path_int = "templates/" . $hook . ".php";

		if( file_exists( $path_int ))
		{
			$template = $path_int;
		}
		
		if( file_exists( $path_ext ))
		{
			$template = $path_ext;
		}
		
		return $template;
	}
	
	
	
	function setFieldsGenerator($parent, $instance)
	{
		$this->parent = $parent;
		$this->instance = $instance;
	}
	
	
	
	function get_textfield($fieldname, $label=NULL)
	{
	?>
	<p>
		<label for="<?php echo $this->parent->get_field_id($fieldname); ?>">
			<?php echo ($label)?$label:$fieldname; ?>: 
			<input 
				class="widefat" 
				id="<?php echo $this->parent->get_field_id($fieldname); ?>" 
				name="<?php echo $this->parent->get_field_name($fieldname); ?>" 
				type="text" 
				value="<?php echo attribute_escape($this->instance[$fieldname]); ?>" />
		</label>
	</p>
	<?php
	}




	function get_checkbox($fieldname, $label=NULL)
	{
	?>
	<p>
	<label for="<?php echo $this->parent->get_field_id( $fieldname ); ?>"> 
		 
		<input
			id="<?php echo $this->parent->get_field_id( $fieldname ); ?>"
			name="<?php echo $this->parent->get_field_name( $fieldname ); ?>" 
			type="checkbox" 
			<?php 
			$prnt = ($this->instance[ $fieldname ]) ? 'checked="checked"' : '';
			echo $prnt;
			?>
		/> <?php echo ($label)?$label:$fieldname; ?>
	</label>
	</p>	
	<?php
	}
	

	function get_button($fieldname, $label=NULL)
	{
	?>
	<p>
	<label for="<?php echo $this->parent->get_field_id( $fieldname ); ?>"> 
		<input
			id="<?php echo $this->parent->get_field_id( $fieldname ); ?>"
			name="<?php echo $this->parent->get_field_name( $fieldname ); ?>" 
			type="button" 
			value="<?php echo ($label)?$label:$fieldname; ?>"
		/> 
	</label>
	</p>	
	<?php
	}
	
	
	function get_imageSelector($fieldname, $label=NULL)
	{
	?>
	<p>
	<label for="<?php echo $this->parent->get_field_id( $fieldname ); ?>"> 
		<input
			id="<?php echo $this->parent->get_field_id( $fieldname ); ?>"
			name="<?php echo $this->parent->get_field_name( $fieldname ); ?>" 
			type="button"
			class="maja-image-selector button-secondary"
			value="<?php echo ($label)?$label:$fieldname; ?>"
		/>
		<input type="hidden" 
			id="<?php echo $this->parent->get_field_id( $fieldname.'_src' ); ?>"
			name="<?php echo $this->parent->get_field_name( $fieldname.'_src' ); ?>"
			value="<?php echo attribute_escape($this->instance[$fieldname.'_src']); ?>" />
		<input type="hidden" 
			id="<?php echo $this->parent->get_field_id( $fieldname.'_lnk' ); ?>"
			name="<?php echo $this->parent->get_field_name( $fieldname.'_lnk' ); ?>"
			value="<?php echo attribute_escape($this->instance[$fieldname.'_lnk']); ?>" />
		<input type="hidden" 
			id="<?php echo $this->parent->get_field_id( $fieldname.'_alt' ); ?>"
			name="<?php echo $this->parent->get_field_name( $fieldname.'_alt' ); ?>"
			value="<?php echo attribute_escape($this->instance[$fieldname.'_alt']); ?>" />
		<input type="hidden" 
			id="<?php echo $this->parent->get_field_id( $fieldname.'_tit' ); ?>"
			name="<?php echo $this->parent->get_field_name( $fieldname.'_tit' ); ?>"
			value="<?php echo attribute_escape($this->instance[$fieldname.'_tit']); ?>" />
	</label>
	</p>
	
	<?php
		if( $this->instance[$fieldname.'_src']!='' )
		{
			echo '<img width="100%" src="'.attribute_escape($this->instance[$fieldname.'_src']).'" title="'.attribute_escape($this->instance[$fieldname.'_tit']).'" alt="'.attribute_escape($this->instance[$fieldname.'_alt']).'" />';
		}
	}
	
	
	



	function get_dropdown($fieldname, $arr, $label=NULL)
	{
	?>
	<p>
	<label for="<?php echo $this->parent->get_field_id($fieldname); ?>"> 
		<?php echo ($label)?$label:$fieldname; ?>: 
		<select class="widefat"
			id="<?php echo $this->parent->get_field_id( $fieldname ); ?>"
			name="<?php echo $this->parent->get_field_name( $fieldname ); ?>" >
			<?php 
			foreach ($arr as $value=>$key)
			{
			    echo '<option', ($key ? ' value="' . $key . '"' : ''), ($this->instance[$fieldname] == $key ? ' selected="selected"' : ''), '>', $key, '</option>';
			}
			?>
		</select>
	</label>
	</p>
	<?php
	}
	
	
	
	
	
	
	
	function is_widget_context($ref)
	{
		if ( isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],$ref->id_base) !== false ) {
			return true;
		} elseif ( isset($_REQUEST['_wp_http_referer']) && strpos($_REQUEST['_wp_http_referer'],$ref->id_base) !== false ) {
			return true;
		} elseif ( isset($_REQUEST['widget_id']) && strpos($_REQUEST['widget_id'],$ref->id_base) !== false ) {
			return true;
		}
		return false;
	}
	
	
}
?>