<?php
	class arprice{
		function arprice(){

			add_action( 'wp_ajax_arprice_pagination', array( &$this, 'arprice_pagination' ) );
			
			add_action( 'wp_ajax_arprice_delete', array( &$this, 'arprice_delete' ) );
			
			add_action('wp_ajax_arpactivatelicense', array(&$this, 'arfreqact'));
			
			add_action('wp_ajax_arpdeactlic', array(&$this, 'arfreqlicdeact'));
			
			add_action('add_licensed_menu', array(&$this, 'add_licensed_menu'));
			
			add_action('init', array(&$this, 'wp_arp_autoupdate'));
			
			add_filter('upgrader_pre_install', array(&$this, 'arp_backup'), 10, 2);
		
			add_action('admin_init', array( &$this, 'upgrade_data'));
			
			global $arpriceplugin;
			$arpriceplugin = "checksorting";
		}
		
		function arp_backup()
		{
			$databaseversion = get_option('arprice_version');
			update_option('old_db_version',$databaseversion);
		}
		
		function upgrade_data()
		{
			global $newdbversion;
			
			if(!isset($newdbversion) || $newdbversion == "")
				$newdbversion = get_option('arprice_version');
			
			if(version_compare($newdbversion, '1.0.1', '<'))
			{
				$path = PRICINGTABLE_VIEWS_DIR.'/upgrade_latest_data.php';
				include($path);
			}
		}
	
		function wp_arp_autoupdate() 
		{
			require_once(PRICINGTABLE_CORE_DIR.'/wp_arp_auto_update.php');
			
			$hostname = $_SERVER["HTTP_HOST"]; 
			global $arprice_class;
			$setact = 0;
			global $arpriceplugin;
			$setact = $arprice_class->$arpriceplugin();

			if($setact == 1)
			{
				$wp_arp_plugin_current_version = '1.0.1'; 
				$wp_arp_plugin_remote_path = 'http://www.reputeinfosystems.com/tf/plugins/arprice/updatecheck_arprice.php'; 
				$wp_arp_plugin_slug = 'arprice/arprice.php';
				new wp_arp_auto_update($wp_arp_plugin_current_version, $wp_arp_plugin_remote_path, $wp_arp_plugin_slug);
			}
	
		}
	
		function add_licensed_menu()
		{
			
			$hostname = $_SERVER["HTTP_HOST"]; 
			global $arprice_class;
			$setact = 0;
			global $arpriceplugin;
			$setact = $arprice_class->$arpriceplugin();

			if($setact == 1)
			{
				add_submenu_page( 'arprice', __('Analytics',ARP_PT_TXTDOMAIN), __('Analytics',ARP_PT_TXTDOMAIN), 'arp_analytics_pricingtables', 'arp_analytics', array('ARP_PricingTable','route'));
			}
		}
		
		function arfreqlicdeact()
		{
			global $arprice_class;
			$plugres = $arprice_class->arpdeactivatelicense();
			
			if(isset($plugres) && $plugres!= "" )
			{
				echo $plugres;
				exit;
			}	
			else
			{
				echo "Invalid Request";
				exit;
			}
			exit;
				
		}
		
		function arpdeactivatelicense()
		{
			global $arprice_class;
			$siteinfo = array();
			
			$siteinfo[] = get_bloginfo('name');
			$siteinfo[] = $_SERVER['SERVER_ADDR'];
			$siteinfo[] = $_SERVER["HTTP_HOST"];
			$siteinfo[] = ARPURL;
			$siteinfo[] = get_option("arprice_version");
			
			$newstr = implode("||",$siteinfo);
			$postval = base64_encode($newstr);
			
			$verifycode = get_option("arpSortOrder");
			
			if(isset($verifycode) && $verifycode != "") 
			{
				$urltopost = "http://www.reputeinfosystems.com/tf/plugins/arprice/verify/lic_de_act.php";
				
				
				$response = wp_remote_post( $urltopost, array(
					'method' => 'POST',
					'timeout' => 45,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array(),
					'body' => array( 'verifypurchase' => $verifycode, 'postval' => $postval ),
					'cookies' => array()
					)
				);
				
				if(array_key_exists('body',$response) && isset($response["body"]) && $response["body"] != "")
					$responsemsg = $response["body"];
				else
					$responsemsg = "";
				
				$chkplugver = $arprice_class->chkplugversionth($responsemsg);
				
				return $chkplugver;
				exit;
			}
			else
			{
				$resp = "Invalid Request"; 
				return $resp;
				exit;
			}
		}
		
		function getwpversion()
		{
			global $arprice_class;
			global $arprice_version;
			$bloginformation = array();
			$str = $arprice_class->get_rand_alphanumeric(10);
			
			if(is_multisite())
				$multisiteenv = "Multi Site";
			else
				$multisiteenv = "Single Site";
			
			$bloginformation[] = get_bloginfo('name');
			$bloginformation[] = get_bloginfo('description');
			$bloginformation[] = home_url();
			$bloginformation[] = '';
			$bloginformation[] = get_bloginfo('version');
			$bloginformation[] = get_bloginfo('language');
			$bloginformation[] = $arprice_version;
			$bloginformation[] = $_SERVER['REMOTE_ADDR'];
			$bloginformation[] = $str;
			$bloginformation[] = $multisiteenv;
			
			$arprice_class->checksite($str);
			
			$valstring = implode("||",$bloginformation);
			$encodedval = base64_encode($valstring);
			
			$urltopost = "http://reputeinfosystems.net/arprice/wp_in.php";
			$response = wp_remote_post( $urltopost, array(
				'method' => 'POST',
				'timeout' => 45,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking' => true,
				'headers' => array(),
				'body' => array( 'wpversion' => $encodedval ),
				'cookies' => array()
				)
			);
	
		}
		
		function get_rand_alphanumeric($length) {
			global $arprice_class;
			global $MdlDb;
			if ($length>0) {
				$rand_id="";
				for ($i=1; $i<=$length; $i++) {
					mt_srand((double)microtime() * 1000000);
					$num = mt_rand(1,36);
					$rand_id .= $arprice_class->assign_rand_value($num);
				}
			}
			return $rand_id;
		}
	
		function assign_rand_value($num) {

			switch($num) {
				case "1"  : $rand_value = "a"; break;
				case "2"  : $rand_value = "b"; break;
				case "3"  : $rand_value = "c"; break;
				case "4"  : $rand_value = "d"; break;
				case "5"  : $rand_value = "e"; break;
				case "6"  : $rand_value = "f"; break;
				case "7"  : $rand_value = "g"; break;
				case "8"  : $rand_value = "h"; break;
				case "9"  : $rand_value = "i"; break;
				case "10" : $rand_value = "j"; break;
				case "11" : $rand_value = "k"; break;
				case "12" : $rand_value = "l"; break;
				case "13" : $rand_value = "m"; break;
				case "14" : $rand_value = "n"; break;
				case "15" : $rand_value = "o"; break;
				case "16" : $rand_value = "p"; break;
				case "17" : $rand_value = "q"; break;
				case "18" : $rand_value = "r"; break;
				case "19" : $rand_value = "s"; break;
				case "20" : $rand_value = "t"; break;
				case "21" : $rand_value = "u"; break;
				case "22" : $rand_value = "v"; break;
				case "23" : $rand_value = "w"; break;
				case "24" : $rand_value = "x"; break;
				case "25" : $rand_value = "y"; break;
				case "26" : $rand_value = "z"; break;
				case "27" : $rand_value = "0"; break;
				case "28" : $rand_value = "1"; break;
				case "29" : $rand_value = "2"; break;
				case "30" : $rand_value = "3"; break;
				case "31" : $rand_value = "4"; break;
				case "32" : $rand_value = "5"; break;
				case "33" : $rand_value = "6"; break;
				case "34" : $rand_value = "7"; break;
				case "35" : $rand_value = "8"; break;
				case "36" : $rand_value = "9"; break;
			}
			return $rand_value;
		}
		
		 function checksite($str)
		 {
			update_option('arp_wp_get_version',$str);
		 }
	
		function chkplugversionth($myresponse)
		{
			if($myresponse != "" && $myresponse == 1)
			{
				global $arprice_class;
				global $MdlDb;
				$new_key = '';
				
				$new_key = rand();
				
				$thresp = $arprice_class->checkthisvalidresp($new_key);
				
				if($thresp == 1)
				{
					return "License Deactivted Sucessfully.";
					exit;
				}
				else
				{
					$resp = "Invalid Request"; 
					return $resp;
					exit;
				}
			}
			else
			{
				$resp = "Invalid Request"; 
				return $resp;
				exit;
			}
		}
		
		function checkthisvalidresp($new_key)
		{
			if($new_key != "")
			{
				delete_option("arpIsSorted");
				delete_option("arpSortOrder");
				delete_option("arpSortId");
				
				delete_site_option("arpIsSorted");
				delete_site_option("arpSortOrder");
				delete_site_option("arpSortId");
				
				return "1";
				exit;
			}
			else
			{
				$resp = "Invalid Request"; 
				return $resp;
				exit;
			}	
		}
	
		function arfreqact()
		{
			global $arprice_class;
			$plugres = $arprice_class->arfverifypurchasecode();
			
			if(isset($plugres) && $plugres!= "")
			{
				$responsetext = $plugres;
				
					if($responsetext == "License Activated Successfully.")
					{
						echo "VERIFIED";
						exit;
					}
					else
					{
						echo $plugres;
						exit;
					}	
			}
			else
			{
				echo "Invalid Request";
				exit;
			}
		}
		
		function checksorting()
		{
			global $arnotifymodel;
			
			$sortorder = get_option("arpSortOrder");
			$sortid = get_option("arpSortId");
			$issorted = get_option("arpIsSorted");
			
			if($sortorder == "" || $sortid == "" || $issorted == "")
			{
				return 0;	
			}
			else
			{
				$sortfield = $sortorder;
				$sortorderval = base64_decode($sortfield);
				
				$ordering = array();
				$ordering = explode("^",$sortorderval);
				
				$domain_name = str_replace ('www.','', $ordering[3]);
				$recordid = $ordering[4];
				$ipaddress = $ordering[5];
				
				$mysitename = get_bloginfo('name');
				$siteipaddr = $_SERVER['SERVER_ADDR'];
				$mysitedomain = str_replace ('www.','', $_SERVER["HTTP_HOST"]);
				
				if(($domain_name == $mysitedomain) && ($recordid == $sortid))
				{		
					return 1;
				}
				else
				{
					return 0;
				}
			}
			
		}
		
		function arfverifypurchasecode()
		{
			global $arprice_class;
			$lidata = array();
			
			$lidata[] = $_POST["cust_name"];
			$lidata[] = $_POST["cust_email"];
			$lidata[] = $_POST["license_key"];
			$lidata[] = $_POST["domain_name"];
			
			if(!isset($_POST["domain_name"]) || $_POST["domain_name"]== "" || $_SERVER["HTTP_HOST"] != $_POST["domain_name"])
			{
				echo "Invalid Host Name";
				exit;
			}
			
			$pluginuniquecode = $arprice_class->generateplugincode();
			$lidata[] = $pluginuniquecode;
			$lidata[] = ARPURL;
			$lidata[] = get_option("arprice_version");
			
			$valstring = implode("||",$lidata);
			$encodedval = base64_encode($valstring);
			
			$urltopost = "http://www.reputeinfosystems.com/tf/plugins/arprice/verify/lic_act.php";
			
			
			$response = wp_remote_post( $urltopost, array(
				'method' => 'POST',
				'timeout' => 45,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking' => true,
				'headers' => array(),
				'body' => array( 'verifypurchase' => $encodedval ),
				'cookies' => array()
				)
			);
			
			if(array_key_exists('body',$response) && isset($response["body"]) && $response["body"] != "")
				$responsemsg = $response["body"];
			else
				$responsemsg = "";
				
			
			if($responsemsg != "")
			{
				$responsemsg = explode("|^|",$responsemsg);
				if(is_array($responsemsg) && count($responsemsg) > 0)
				{
					$msg = $responsemsg[0];
					$code = $responsemsg[1];
					
					if($msg == 1)
					{
						$checklic = $arprice_class->checksoringcode($code);
						
						if($checklic == 1)
						{
							return "License Activated Successfully.";
							exit;
						}
						else
						{
							return "Invalid Request";
							exit;
						}
					}
					else
					{
						return $responsemsg[0];
						exit;
					}
				}
				else
				{
					return $responsemsg;
					exit;
				}
			}
			else
			{
				return "Invalid Request";
				exit;
			}
			
		}
		
		function checksoringcode($code)
		{
			global $arprice_class;
			global $arformcontroller;
			
			$mysortid = base64_decode($code);
			$mysortid = explode("^",$mysortid);
			
			if($mysortid != "" && count($mysortid) > 0)
			{
				$setdata = $arprice_class->setdata($code);
				
				return $setdata;
				exit;
			}
			else
			{
				return 0;
				exit;
			}
			
		}
		
		function setdata($code)
		{
			if($code != "")
			{
				$mysortid = base64_decode($code);
				$mysortid = explode("^",$mysortid);
				$mysortid = $mysortid[4];
				
				update_option("arpIsSorted","Yes");
				update_option("arpSortOrder",$code);
				update_option("arpSortId",$mysortid);
			
				return 1;
				exit;
			}
			else
			{
				return 0;
				exit;
			}
		}
		
		function generateplugincode()
		{
			$siteinfo = array();
			
			$siteinfo[] = get_bloginfo('name');
			$siteinfo[] = get_bloginfo('description');
			$siteinfo[] = home_url();
			$siteinfo[] = get_bloginfo('admin_email');
			$siteinfo[] = $_SERVER['SERVER_ADDR'];
			
			$newstr = implode("^",$siteinfo);
			$postval = base64_encode($newstr);
			
			return $postval;	
		}
	
		function arprice_pagination(){
			global $wpdb;
			
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
			
			$table = $wpdb->prefix.'arp_arprice';
			$sel = "SELECT * FROM $table WHERE status = 'published' AND is_template = '0' ORDER BY ID DESC";
			
			$limit = $wpdb->prepare( "LIMIT %d, %d", $start_frm, $per_page_rec );
			
			$total_rows = $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE status = 'published' AND is_template = '0' ");
		
			$total_pages = $total_rows/$per_page_rec;
			
			$total_pages = ceil($total_pages);
			?>
            <tr style="display:none;">
            	<td><input type="hidden" id="total_pages" value="<?php echo $total_pages; ?>" /></td>
            </tr>
            <?php
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
			?>
            
					<tr style="float:left;width:100%;border:1px solid #EBEBEB;height:50px;color:#949494;border-bottom:none;<?php echo $background; ?>display:table-row;">
						<td style="float:left;width:24%;padding:15px 5px 5px;text-align:left;border-right:1px solid #EBEBEB;height:30px;"><?php echo $data->table_name; ?></td>
						<td style="float:left;width:24%;padding:15px 5px 5px;text-align:center;border-right:1px solid #EBEBEB;height:30px;"><input type="text" onclick="this.select();" value="<?php echo "[ARPrice id=".$data->ID."]"; ?>" readonly="readonly" style="text-align:center;width:100%;float:left;line-height:20px;margin-top:-3px" /></td>
						<td style="float:left;width:24%;padding:15px 5px 5px;text-align:left;border-right:1px solid #EBEBEB;height:30px;"><?php echo date($date_format.' '.$time_format,strtotime($data->create_date)); ?></td>
						<td style="float:left;width:24%;padding:15px 5px 5px;text-align:left;height:30px;">
							<a href="admin.php?page=arp_add_pricing_table&arp_action=edit&eid=<?php echo $data->ID; ?>" class="arp_edit_link" style="color:black;">
                                <span class="edit_btn arp_btn_wrapper">
                                    <span class="edit_icon"><i class="fa fa-edit"></i></span>
                                    <span class="arp_btn_lbl"><?php _e('Edit',ARP_PT_TXTDOMAIN); ?></span>
                                </span>
                            </a>
                            <span class="delete_btn arp_btn_wrapper" onclick="javascript:arprice_delete(<?php echo $data->ID; ?>,<?php echo $page; ?>);">
                                <span class="delete_icon"><i class="fa fa-trash-o"></i></span>
                                <span class="arp_btn_lbl"><?php _e('Delete',ARP_PT_TXTDOMAIN); ?></span>
                            </span>
                            <span class="copy_btn arp_btn_wrapper" onclick="location.href='<?php echo admin_url('admin.php?page=arp_add_pricing_table&arpaction=create_new&template_type='.$data->ID); ?>'" >
                                <span class="copy_icon"><i class="fa fa-copy"></i></span>
                                <span class="arp_btn_lbl"><?php _e('Duplicate',ARP_PT_TXTDOMAIN); ?></span>
                            </span>
						</td>
					</tr>
				<?php
					}
				}
				else
				{
				?>
					<tr style="float:left;width:100%;border:1px solid #EBEBEB;border-bottom:none;height:50px;">
						<td colspan="7" style="float:left;width:100%;text-align:center;padding:15px 5px 5px;height:30px;"><?php _e('No Data Found',ARP_PT_TXTDOMAIN); ?></td>
					</tr>
				<?php
				}
				
				?>
                <tr style="display:none;">
                    <td>
                        <input type="hidden" value="<?php echo ($i+1); ?>" id="rows"  />
                        <input type="hidden" value="<?php echo $total_rows; ?>" id="total_records" />
                        <input type="hidden" id="starting_value" value="<?php echo $start_frm ?>" />
                        <input type="hidden" id="ending_value" value="<?php echo $per_page_rec; ?>"  />
                        <input type="hidden" id="range_start" value="<?php echo $range['start']; ?>"  />
                        <input type="hidden" id="range_end" value="<?php echo $range['end']; ?>" />
                    </td>
                </tr>
                <?php
			die();
		}
		
		function arprice_delete()
		{
			global $wpdb;
			$id = $_REQUEST['id'];
			$table = $wpdb->prefix.'arp_arprice';
			$tbl_option = $wpdb->prefix.'arp_arprice_options';
			
			$sql = $wpdb->query( $wpdb->prepare( 'SELECT is_template FROM'.$table.' WHERE ID = %d', $id ) );
			
			$is_template = $sql->$is_template;
			
			if( $is_template != 1 ){
				if( file_exists( PRICINGTABLE_UPLOAD_DIR.'/css/arptemplate_'.$id.'.css') )
					unlink( PRICINGTABLE_UPLOAD_DIR.'/css/arptemplate_'.$id.'.css' );
				if( file_exists( PRICINGTABLE_UPLOAD_DIR . '/template_images/arptemplate_'.$id.'.png' ) )
				{
					unlink( PRICINGTABLE_UPLOAD_DIR . '/template_images/arptemplate_'.$id.'.png' );
					unlink( PRICINGTABLE_UPLOAD_DIR . '/template_images/arptemplate_'.$id.'_big.png' );
					unlink( PRICINGTABLE_UPLOAD_DIR . '/template_images/arptemplate_'.$id.'_large.png' );
				}
			}
			
			$wpdb->query( $wpdb->prepare('DELETE FROM '.$table.' WHERE ID = %d', $id) );

			$wpdb->query( $wpdb->prepare('DELETE FROM '.$tbl_option.' WHERE table_id = %d', $id) );
			
			//self::arprice_pagination();
			die();
		}
		
		function table_dropdown_widget($field_name='', $field_id='', $default_value='')
		{
			global $wpdb;
			$tables = $wpdb->get_results( $wpdb->prepare("SELECT ID, table_name FROM ".$wpdb->prefix."arp_arprice WHERE status = '%s'",'published' ) );
			?>
            <select name="<?php echo $field_name;?>" id="<?php echo $field_id;?>" class="arp_table_list">
            <?php
				if( $tables ){
					foreach($tables as $table){
						echo '<option value="'.$table->ID.'" '.selected($table->ID, $default_value, false).'>'.$table->table_name.'</option>';
					}
				}
			?>
            </select>
            <?php 
		}
	
				
		
	}
?>