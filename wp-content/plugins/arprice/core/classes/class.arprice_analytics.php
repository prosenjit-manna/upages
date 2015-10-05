<?php

class arprice_analytics
{
	function arprice_analytics()
	{	
		add_action( 'wp_ajax_arp_analytics_pagination', array(&$this, 'arp_analytics_pagination' ) );
		
		add_shortcode( 'ARPrice', array( &$this, 'arprice_Shortcode') );
	}
	
		function arprice_Shortcode( $atts )
		{
		
			global $wpdb, $arprice_analytics;
			
			if(!(extension_loaded('geoip')))
			{
				include(PRICINGTABLE_INC_DIR.'/geoip.inc');
			}
			
			extract(
					shortcode_atts
					( 
						array(
							'id' => '1',
						  ), $atts 
					) 
			);
					  
			$table_id = $atts['id'];	
			if($table_id == "")
			{
				$table_id = 1;
			}
			
			$result=$wpdb->get_row($wpdb->prepare("select * from ".$wpdb->prefix."arp_arprice where ID=%d",$table_id));
			$pricetable_name=$result->table_name;
			if($pricetable_name == "")
			{
				return "Please Select Valid Pricing Table";
			}
			else if($result->status != 'published' )
			{
				return "Please Select Valid Pricing Table";
			}
			
			$file_url = PRICINGTABLE_INC_DIR."/GeoIP.dat";
			if(!(extension_loaded('geoip'))) 
			{
				$gi = geoip_open($file_url,GEOIP_STANDARD);
				$country_name = geoip_country_name_by_addr($gi,$_SERVER['REMOTE_ADDR']);
			}
			else
			{
				$country_name = "";
			}

			$d=date("Y/m/d H:i:s");
			
			$brow=$_SERVER['HTTP_USER_AGENT'];
		
			$pageurl=$_SERVER['REQUEST_URI'];
			
			$ref=$_SERVER['HTTP_REFERER'];
			
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$ses_id=session_id();
			
			$browser = $arprice_analytics->getBrowser($brow);
			
							
			$sel = $wpdb->get_row($wpdb->prepare("SELECT tracking_id, session_id FROM ".$wpdb->prefix."arp_arprice_analytics WHERE pricing_table_id = ".$table_id." AND session_id = %s", $ses_id));
			
			if( $sel )
			{			
				require_once PRICINGTABLE_DIR.'/core/views/arprice_front.php';
				
				$contents = arp_get_pricing_table_string( $table_id );
				
				$contents = apply_filters('arp_predisplay_pricingtable', $contents, $table_id);
				
				return $contents;
			}
					
			$res=$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->prefix."arp_arprice_analytics (pricing_table_id,browser_info,browser_name,browser_version,page_url,referer,ip_address,country_name,session_id,added_date ) VALUES (%d,%s,%s,%s,%s,%s,%s,%s,%s,%s)",$table_id,$brow,$browser['browser_name'],$browser['version'],$pageurl,$ref,$ip,$country_name,$ses_id,$d));
			
						
			require_once PRICINGTABLE_DIR.'/core/views/arprice_front.php';
				
			$contents = arp_get_pricing_table_string( $table_id );
			
			$contents = apply_filters('arp_predisplay_pricingtable', $contents, $table_id);
				
			return $contents;
		}
		
	
	
	function arp_analytics_pagination()
	{
		global $wpdb,$arprice_analytics;
	
		$per_page_rec = 10;
		$no_per_pages = 5;
		$page = 1;
		
		if($_REQUEST['pageno'] != "")
		{
			$page = intval($_REQUEST['pageno']);
			if($page < 1)
			 $page = 1;
		}
		else
		{
			$page = 1;
		}
		
		$start_frm = ($page - 1) * $per_page_rec;
		
		$table = $wpdb->prefix.'arp_arprice_analytics';
		$sel = "SELECT * FROM $table ORDER BY added_date DESC";
		
		$limit	= $wpdb->prepare("LIMIT %d, %d", $start_frm, $per_page_rec );
		
		$total_rows = $wpdb->get_var("SELECT COUNT(*) FROM $table");
		
		$total_pages = $total_rows/$per_page_rec;
		
		$total_pages = ceil($total_pages);
	
		if($total_pages > 1)
		{
			$sel = $sel." ".$limit;
		}
		if($total_pages > 1)
		{
			$range = array('start'=>1 , 'end'=>$total_pages);
			
			if($total_pages > $no_per_pages)
			{
				if($page < $no_per_pages)
				{
					$range['start'] = 1;
					$range['end'] = $no_per_pages;
				}
				elseif($page == $no_per_pages)
				{
					$range['start'] = $page;
					$range['end'] = $page + $no_per_pages - 1;
				}
				elseif($page > $no_per_pages)
				{
					for($i=$page; $i<=$total_pages; $i++)
					{
						if($page == ((2*$no_per_pages)-1))
						{
							$range['start'] = $page;
							$range['end'] = $page + $no_per_pages - 1;		
						}
						elseif($page == $total_pages)
						{
							$range['start']=$page - 2;
							$range['end']=$page;
						}
						else
						{
							$range['start']=$page-1;
							$range['end']= $page +($no_per_pages-2);
						}
					}
				}
			}
		}
		if($wpdb->get_var($sel) > 0)
		{
			$row = $wpdb->get_results($sel);
            foreach($row as $i=>$data)
            {
                if(($i+1) % 2 == 0)
                {
                    $background = "background:#FFFFFF;";
                }
                else
                {
                    $background = "background:#F8F8F8;";
                }
				$date_format = get_option('date_format');
				$time_format = get_option('time_format');
				$pricetable_id=$data->pricing_table_id;		
				
				$result=$wpdb->get_row($wpdb->prepare("select * from ".$wpdb->prefix."arp_arprice where ID = %d",$pricetable_id));
				$pricetable_name=$result->table_name;
				$browser = $arprice_analytics->getBrowser($data->browser_info);
		?>	
            <tr style="float:left;width:100%;border:1px solid #DEDEDE;border-bottom:none;<?php echo $background; ?>">
            	<td width="11%"><?php echo $pricetable_name; ?></label></td>
				<td width="14%"><?php echo $browser['browser_name']." <br>( Version ".$browser['version']." )";  ?></label></td>
				<td width="9%"><?php echo $data->country_name; ?></label></td>
				<td width="9%"><?php echo $data->ip_address; ?></label></td>
				<td width="34%"><?php echo $data->referer; ?></label></td>
				<td width="16%" class="last_td"><label style="float:left;margin-top:5px;"><?php echo  date($date_format.' '.$time_format,strtotime($data->added_date)); ?></label></td>
				
            </tr>
        <?php
            }
		}
		?>
            <input type="hidden" value="<?php echo ($i+1); ?>" id="analytics_rows"  />
            <input type="hidden" value="<?php echo $total_rows ; ?>" id="analytics_total_records" />
            <input type="hidden" id="analytics_starting_value" value="<?php echo $start_frm ?>" />
            <input type="hidden" id="analytics_ending_value" value="<?php echo $per_page_rec; ?>"  />
            <input type="hidden" id="analytics_range_start" value="<?php echo $range['start']; ?>"  />
            <input type="hidden" id="analytics_range_end" value="<?php echo $range['end']; ?>" />
        <?php
		die();
	}
	
	function getBrowser($user_agent) 
	{ 		
		$u_agent = $user_agent; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
	

		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
		
		if( $platform != 'Unknown' )
		{
			
			if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
			{ 
				$bname = 'Internet Explorer'; 
				$ub = "MSIE"; 
			} 
			elseif(preg_match('/Firefox/i',$u_agent)) 
			{ 
				$bname = 'Mozilla Firefox'; 
				$ub = "Firefox"; 
			} 
			elseif(preg_match('/Chrome/i',$u_agent)) 
			{ 
				$bname = 'Google Chrome'; 
				$ub = "Chrome"; 
			} 
			elseif(preg_match('/Safari/i',$u_agent)) 
			{ 
				$bname = 'Apple Safari'; 
				$ub = "Safari"; 
			} 
			elseif(preg_match('/Opera/i',$u_agent)) 
			{ 
				$bname = 'Opera'; 
				$ub = "Opera"; 
			} 
			elseif(preg_match('/Netscape/i',$u_agent)) 
			{ 
				$bname = 'Netscape'; 
				$ub = "Netscape"; 
			}
			elseif(strpos($user_agent, 'Trident') !== FALSE) //For Supporting IE 11
			{	
				$bname = 'Internet Explorer'; 
				$ub = "Trident"; 
			}
		}
		
		
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
		
		}
		
		
		$i = count($matches['browser']);
		if ($i != 1) {
			
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		if( $ub == "Trident" ){
			$version = "11"; 
		}
		
		
		if ($version==null || $version=="") {$version="?";}
		return array('browser_name'=>$bname,'version'=>$version);
		
	}
}

?>