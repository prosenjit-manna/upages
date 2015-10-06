<?php
	class arprice_import_export
	{
		
		function arprice_import_export()
		{
					
			add_action( 'wp_ajax_import_table', array(&$this, 'import_table' ) );
			
			add_action( 'wp_ajax_get_table_list', array(&$this, 'export_table_list' ) );
		}
	
		function get_table_list()
		{
			global $wpdb;
			$table = $wpdb->prefix.'arp_arprice';
		
			$res = $wpdb->get_results("SELECT * FROM ".$table." WHERE  status = 'published'");
	
		?>
        	<select multiple="multiple" name="table_to_export[]" id="table_to_export" style="float:right;min-height:150px;min-width:160px;">
            	<?php
					foreach($res as $r)
					{
				?>
                		<option value="<?php echo $r->ID; ?>"><?php echo $r->table_name; ?></option>
                <?php
					}
				?>
            </select>
        <?php
		}
		
		function export_table_list()
		{
			global $arprice_import_export;
			$arprice_import_export->get_table_list();
			die();
		}
		
		function extract_zip($filename,$output_dir)
		{
			$zip = new ZipArchive;
			if ($zip->open($filename) === TRUE) {
				$zip->extractTo($output_dir);
				$zip->close();
				return 'ok';
			} else {
				return 'failed';
			}
		}
		
		
		function import_table()
		{
			global $wpdb;
			
			$table = $wpdb->prefix.'arp_arprice';

			$table_opt = $wpdb->prefix.'arp_arprice_options';
			
			$file_name = $_REQUEST['xml_file'];
					
			@ini_set('max_execution_time',0);
			
			$wp_upload_dir = wp_upload_dir();
			
			$output_url = $wp_upload_dir['baseurl'].'/arprice/import/'.$file_name.'_temp/';
			$output_dir = $wp_upload_dir['basedir'].'/arprice/import/'.$file_name.'_temp/';
			
			$upload_dir_path = $wp_upload_dir['basedir'].'/arprice/';
			$upload_dir_url = $wp_upload_dir['baseurl'].'/arprice/';
			
			$xml_file = $output_dir.$file_name.'.xml';
			
			$xml = file_get_contents($xml_file);
			
			$ik = 1;
			
			
			$xml = simplexml_load_string($xml);
			
			if(isset($xml->arp_table))
			{
				foreach($xml->children() as $key_main=>$val_main)
				{
					$attr = $val_main->attributes();
					$old_id = $attr['id'];
					$status = $val_main->status;
					$is_template = $val_main->is_template;
					$template_name = $val_main->template_name;
					$is_animated = $val_main->is_animated;
					
						
					
					$table_name = $val_main->arp_table_name;
					$pricing_css = $val_main->pricing_css;
					$arp_template_css = $val_main->arp_template_css;

					
					$arp_template_img = $val_main->arp_template_img;
					$arp_template_img_big = $val_main->arp_template_img_big;
					$arp_template_img_large = $val_main->arp_template_img_large;
					
					$date = current_time('mysql');
					foreach($val_main->options->children() as $key=>$val)
					{
						if($key == 'general_options')
						{
							$general_options = trim($val);
							
							$general_options = str_replace('[AND]','&',$general_options);
						}
						else if($key == 'column_options')
						{
							$column_options = trim($val);
							
							$column_options = str_replace('[AND]','&',$column_options);
							
							$column_opts = maybe_unserialize($column_options);
							
							foreach($column_opts['columns'] as $c=>$columns)
							{
								$header_img = $c.'_img';
								
								$btn_img = $c.'_btn_img';
								
								$btn_s_img = $c.'_btn_s_img';
								
								$gmap_marker = $c.'_gmap_marker';
								
								$html5_mp4_video = $c.'_html5_mp4_video';
								
								$html5_webm_video = $c.'_html5_webm_video';
								
								$html5_ogg_video = $c.'_html5_ogg_video';
								
								$html5_video_poster = $c.'_html5_video_poster';
								
								$html5_mp3_audio = $c.'_html5_mp3_audio';
								
								$html5_ogg_audio = $c.'_html5_ogg_audio';
								
								$html5_wav_audio = $c.'_html5_wav_audio';
								
								if($val_main->$header_img != "")
								{
									$header_image = $c.'_img';
									$image_width = $c.'_img_width';
									$image_height = $c.'_img_height';
									$img_class = $c.'_img_class';
									$image = $val_main->$header_image;	
									$img_name = explode('/',$image);
									$img_nm = $img_name[count($img_name)-1];
									$img_name = 'arp_'.time().'_'.$img_nm;
									@copy($output_url.'temp_'.$img_nm,$upload_dir_path.$img_name);
									$html  = "<img src='".$upload_dir_url.$img_name."'";
									$html .= " height='".$val_main->$image_height."'";
									$html .= " width='".$val_main->$image_width."'";
									$html .= " class='".$val_main->$img_class."'>";
									$column_opts['columns'][$c]['arp_header_shortcode'] = $html;
								}
								else if($val_main->$gmap_marker != "")
								{
									$gmap_img = $c."_gmap_marker";
									$gmap_image = $val_main->$gmap_img;
									$gmap_img_nm = explode('/',$gmap_image);
									$gmap_img_nm = $gmap_img_nm[count($gmap_img_nm)-1];
									$gmap_img_name = 'arp_'.time().'_'.$gmap_img_nm;
									@copy($output_url.'temp_'.$gmap_img_nm,$upload_dir_path.$gmap_img_name);
									$dt = $column_opts['columns'][$c]['html_content'];
									$dt = @preg_replace('#\s(marker_image)="[^"]+"#',' marker_image="'.$upload_dir_url.$gmap_img_nm.'"',$dt);
									$column_opts['columns'][$c]['arp_header_shortcode'] = $dt;
								}
								
								if($val_main->$html5_mp4_video != "")
								{
									$html5_mp4_video = $c."_html5_mp4_video";
									$h5_mp4_video = $val_main->$html5_mp4_video;
									$h5_mp4_video_nm = explode('/',$h5_mp4_video);
									$h5_mp4_video_nm = $h5_mp4_video_nm[count($h5_mp4_video_nm) - 1];
									$h5_mp4_video_name = 'arp_'.time().'_'.$h5_mp4_video_nm;
									@copy($output_url.'temp_'.$h5_mp4_video_nm,$upload_dir_path.$h5_mp4_video_name);
									$dt = $column_opts['columns'][$c]['html_content'];
									$dt = preg_replace('#\s(mp4)="[^"]+"#',' mp4="'.$upload_dir_url.$h5_mp4_video_name.'"',$dt);
									$column_opts['columns'][$c]['arp_header_shortcode'] = $dt;
								}
								if($val_main->$html5_webm_video != "")
								{
									$html5_webm_video = $c."_html5_webm_video";
									$h5_webm_video = $val_main->$html5_webm_video;
									$h5_webm_video_nm = explode('/',$h5_webm_video);
									$h5_webm_video_nm = $h5_webm_video_nm[count($h5_webm_video_nm) - 1];
									$h5_webm_video_name = 'arp_'.time().'_'.$h5_webm_video_nm;
									@copy($output_url.'temp_'.$h5_webm_video_nm,$upload_dir_path.$h5_webm_video_name);
									$dt = $column_opts['columns'][$c]['html_content'];
									$dt = preg_replace('#\s(webm)="[^"]+"#',' webm="'.$upload_dir_url.$h5_webm_video_name.'"',$dt);
									$column_opts['columns'][$c]['arp_header_shortcode'] = $dt;
								}
								if($val_main->$html5_ogg_video != "")
								{
									$html5_ogg_video = $c."_html5_ogg_video";
									$h5_ogg_video = $val_main->$html5_ogg_video;
									$h5_ogg_video_nm = explode('/',$h5_ogg_video);
									$h5_ogg_video_nm = $h5_ogg_video_nm[count($h5_ogg_video_nm) - 1];
									$h5_ogg_video_name = 'arp_'.time().'_'.$h5_ogg_video_nm;
									@copy($output_url.'temp_'.$h5_ogg_video_nm,$upload_dir_path.$h5_ogg_video_name);
									$dt = $column_opts['columns'][$c]['html_content'];
									$dt = preg_replace('#\s(ogg)="[^"]+"#',' ogg="'.$upload_dir_url.$h5_ogg_video_name.'"',$dt);
									$column_opts['columns'][$c]['arp_header_shortcode'] = $dt;
								}
								if($val_main->$html5_video_poster != "")
								{
									$html5_video_poster = $c.'_html5_video_poster';
									$h5_video_poster = $val_main->$html5_video_poster;
									$h5_video_poster_nm = explode('/',$h5_video_poster);
									$h5_video_poster_nm = $h5_video_poster_nm[count($h5_video_poster_nm) - 1];
									$h5_video_poster_name = 'arp_'.time().'_'.$h5_video_poster_nm;
									@copy($output_url.'temp_'.$h5_video_poster_nm,$upload_dir_path.$h5_video_poster_name);
									$dt = $column_opts['columns'][$c]['html_content'];
									$dt = preg_replace('#\s(poster)="[^"]+"#',' poster="'.$upload_dir_url.$h5_video_poster_name.'"',$dt);
									$column_opts['columns'][$c]['arp_header_shortcode'] = $dt;
								}
								
								if($val_main->$html5_mp3_audio != "")
								{
									$h5_mp3_audio = $val_main->$html5_mp3_audio;
									$h5_mp3_audio_nm = explode('/',$h5_mp3_audio);
									$h5_mp3_audio_nm = $h5_mp3_audio_nm[count($h5_mp3_audio_nm)-1];
									$h5_mp3_audio_name = 'arp_'.time().'_'.$h5_mp3_audio_nm;
									@copy($output_url.'temp_'.$h5_mp3_audio_nm,$upload_dir_path.$h5_mp3_audio_name);
									$dt = $column_opts['columns'][$c]['html_content'];
									$dt = preg_replace('#\s(mp3)="[^"]+"#',' mp3="'.$upload_dir_url.$h5_mp3_audio_name.'"',$dt);
									$column_opts['columns'][$c]['arp_header_shortcode'] = $dt;
								}
								if($val_main->$html5_ogg_audio != "")
								{
									$h5_ogg_audio = $val_main->$html5_ogg_audio;
									$h5_ogg_audio_nm = explode('/',$h5_ogg_audio);
									$h5_ogg_audio_nm = $h5_ogg_audio_nm[count($h5_ogg_audio_nm)-1];
									$h5_ogg_audio_name = 'arp_'.time().'_'.$h5_ogg_audio_nm;
									@copy($output_url.'temp_'.$h5_ogg_audio_nm,$upload_dir_path.$h5_ogg_audio_name);
									$dt = $column_opts['columns'][$c]['html_content'];
									$dt = preg_replace('#\s(ogg)="[^"]+"#',' ogg="'.$uplad_dir_url.$h5_ogg_audio_name.'"',$dt);
									$column_opts['columns'][$c]['arp_header_shortcode'] = $dt;
								}
								if($val_main->$html5_wav_audio != "")
								{
									$h5_wav_audio = $val_main->$html_wav_audio;
									$h5_wav_audio_nm = explode('/',$h5_wav_audio);
									$h5_wav_audio_nm = $h5_wav_audio_nm[count($h5_wav_audio_nm) - 1];
									$h5_wav_audio_name = 'arp_'.time().'_'.$h5_wav_audio_nm;
									@copy($output_url.'temp_'.$h5_wav_audio_nm,$upload_dir_path.$h5_wav_audio_name);
									$dt = $column_opts['columns'][$c]['html_content'];
									$dt = preg_replace('#\s(wav)="[^"]+"#',' wav="'.$upload_dir_url.$h5_wav_audio_name.'"',$dt);
									$column_opts['columns'][$c]['arp_header_shortcode'] = $dt;
								}
								
								if($val_main->$btn_img != "")
								{
									$btn_image = $c."_btn_img";
									$button_img = $val_main->$btn_image;
									$image_name = explode('/',$button_img);
									$image_nm = $image_name[count($image_name)-1];
									$image_name = 'arp_'.time().'_'.$image_nm;
									@copy($output_url.'temp_'.$image_nm,$upload_dir_path.$image_name);
									$column_opts['columns'][$c]['btn_img'] = $upload_dir_url.$image_name;
								}
								
								if($val_main->$btn_s_img != "")
								{
									$btn_s_image = $c."_btn_s_img";
									$button_s_img = $val_main->$btn_s_image;
									$s_img_name = explode('/',$button_s_img);
									$s_img_nm = $s_img_name[count($image_name)-1];
									$s_image_name = 'arp_'.time().'_'.$s_img_nm;
									@copy($output_url.'temp_'.$s_img_nm,$upload_dir_path.$s_image_name);
									$column_opts['columns'][$c]['btn_s_img'] = $upload_dir_url.$s_image_name;
								}
							}
							$column_options = maybe_serialize($column_opts);	
						}
						
					}
					
					$wpdb->query( $wpdb->prepare( 'INSERT INTO '.$table.' (table_name,general_options,is_template,is_animated,status,pricing_css,create_date) VALUES (%s,%s,%s,%s,%s,%s,%s)', $table_name,$general_options,0,$is_animated,$status,$pricing_css,$date ) );
					
					$new_id = $wpdb->insert_id;
					
					
					if($is_template	== 1){
						$css_content = str_replace( 'arptemplate_'.$template_name,'arptemplate_'.$new_id,$arp_template_css );
				
					}else{
						$css_content = str_replace( 'arptemplate_'.$old_id,'arptemplate_'.$new_id,$arp_template_css );
				
					}
					
					$css_file_name = 'arptemplate_'.$new_id.'.css';
					
				
					
					
					$template_img_name = 'arptemplate_'.$new_id.'.png';
					$template_img_big_name = 'arptemplate_'.$new_id.'_big.png';
					$template_img_large_name = 'arptemplate_'.$new_id.'_large.png';
					
					@copy($arp_template_img,$upload_dir_path.'template_images/'.$template_img_name);
					@copy($arp_template_img_big,$upload_dir_path.'template_images/'.$template_img_big_name);
					@copy($arp_template_img_large,$upload_dir_path.'template_images/'.$template_img_large_name);
					
					
									
					WP_Filesystem();
		
					global $wp_filesystem;
					
					$wp_filesystem->put_contents( PRICINGTABLE_UPLOAD_DIR.'/css/'.$css_file_name, $css_content, 0777 );
					
				
					
					$wpdb->query( $wpdb->prepare( 'INSERT INTO '.$table_opt.' (table_id,table_options) VALUES (%d,%s)', $new_id,$column_options ) );
				}
				@unlink($wp_upload_dir['basedir'].'/arprice/import/'.$file_name.'.zip');

				echo 1;
				
			}
			else if( !isset($xml->arp_table) )
			{
				echo 0;
			}
			
			die();
		}	
	}
	
	
?>