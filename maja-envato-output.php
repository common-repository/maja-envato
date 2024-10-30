<?php  

/*

The Output class

*/


class Maja_Envato_Output
{

	var $plugin = "maja-envato"; /**/
	
	
	function output($instance, $before='', $after='') 
	{
		$src = $this->get_cached($instance, $instance['market'].$instance['action']);
		
	    if( !empty($src) )
	    {
	    	$json_data = json_decode($src, true);
	    	
	    	if($instance['action'] == 'popular')
	    	{
	    		$data = $json_data[$instance['action']][$instance['sub']];
	    	}else{
	    		$data = $json_data[$instance['action']];
	    	}
	    	
	    	$core = new MAJA_Envato_Core($this->plugin);  /**/
			$template = $core->checkTemplate($instance['use_hook']);
			$counter = 0;
			$ulclass = ($instance['use_class']) ? ' class="'.$instance['use_class'].'"' : '';
			$cont = ($template && $instance['use_container']!='') ? $instance['use_container'] : "div";
			$html = "<".$cont.$ulclass.">";

	    	echo $before.$html;
	    	
	    	$count = ($instance['count']>0) ? $instance['count'] : count($data);
	    	
	    	for($i = 0; $i < $count; $i++)
	    	{
				if($template)
				{
					include($template);
					$counter++;
				}else{ 
					echo '<a href="'.$data[$i]['url'].'?ref='.$instance['refer'].'" title="'.$data[$i]['item'].'"">';
					
					$margin = ($counter % $instance['columns'] == ($instance['columns']-1)) ? '0' : $instance['padding'];
					echo '<img src="'.$data[$i]['thumbnail'].'" style="margin-top:'.$instance['padding'].'px;margin-right:'.$margin.'px" width="'.$instance['thumb_width'].'" />';
					echo '</a>';
					$counter++;
				}
			}
				
			echo "</".$cont.">".$after;
	    }

	}
	
	
	
	
	function get_cached($instance, $name)
	{
		$fileName = dirname(__FILE__) ."/". $name . ".json";
		
		if( !file_exists( $fileName ))
		{
			$data = $this->do_request($instance, $name);
		} else{
			$fileModified = filemtime( $fileName );
			$today = time( );
			$hoursSince = round(($today - $fileModified)/3600, 3);
			$expire = $instance['cache'] / 60.00;
			if( $hoursSince > $expire )
			{
				$this->do_request($instance, $name);
			}
		}
		
		$theFile = fopen( $fileName, "r" );
		$jsonData = fread( $theFile, filesize( $fileName ));
		fclose( $theFile );
		
		return $jsonData;
	}
	

	
	
	function do_request($instance, $name)
	{
		$ch = curl_init();
		$filePath = dirname(__FILE__) ."/". $name . ".json";
		$fp = fopen( $filePath, "w");
		curl_setopt($ch, CURLOPT_URL, 'http://marketplace.envato.com/api/edge/'.$instance['action'].':'.$instance['market'].'.json');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if (!$result = curl_exec($ch)) {
			curl_close ($ch);
		} else{
			curl_close ($ch);
		}
	}
	
		
	
	
}

?>