<?php

ob_start();

include('../../../../../wp-load.php');
include "../../../../../wp-admin/includes/file.php";

global $wpdb, $WP_Filesystem;

$arp_db_version = get_option('arprice_version');

$wp_upload_dir 	= wp_upload_dir();
$upload_dir 	= $wp_upload_dir['basedir'].'/arprice/';
$upload_dir_url = $wp_upload_dir['url'];
$upload_dir_base_url 	= $wp_upload_dir['baseurl'].'/arprice/';
$charset = get_option('blog_charset');

@ini_set('max_execution_time',0);

if( !empty( $_REQUEST['table_to_export']) )
{
	$table_ids = implode(',',$_REQUEST['table_to_export']);
	
	$file_name = "arp_".time();
	
	$filename = $file_name.'.xml';
	
	$sql_main = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."arp_arprice WHERE ID in(".$table_ids.")");
	
	$xml = "";
	
	$xml  .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	
	$xml .= "<arp_tables>\n";
	
	foreach($sql_main as $key => $result)
	{
	
		$xml .= "\t<arp_table id='".$result->ID."'>\n";
		
		$xml .= "\t\t<site_url><![CDATA[".site_url()."]]></site_url>\n";
		
		$xml .= "\t\t<arp_plugin_version><![CDATA[".$arp_db_version."]]></arp_plugin_version>\n";
		
		$xml .= "\t\t<arp_table_name><![CDATA[".$result->table_name."]]></arp_table_name>\n";
		
		$xml .= "\t\t<status><![CDATA[".$result->status."]]></status>\n";
		
		$xml .= "\t\t<is_template><![CDATA[".$result->is_template."]]></is_template>\n";
		
		$xml .= "\t\t<template_name><![CDATA[".$result->template_name."]]></template_name>\n";
		
		$xml .= "\t\t<is_animated><![CDATA[".$result->is_animated."]]></is_animated>\n";
		
		
		$xml .= "\t\t<pricing_css><![CDATA[".$result->pricing_css."]]></pricing_css>\n";
		
		if($result->is_template == 1){
		
			$xml .= "\t\t<arp_template_img><![CDATA[".PRICINGTABLE_URL."/images/arptemplate_".$result->template_name.".png"."]]></arp_template_img>";
			$xml .= "\t\t<arp_template_img_big><![CDATA[".PRICINGTABLE_URL."/images/arptemplate_".$result->template_name."_big.png"."]]></arp_template_img_big>";
			$xml .= "\t\t<arp_template_img_large><![CDATA[".PRICINGTABLE_URL."/images/arptemplate_".$result->template_name."_large.png"."]]></arp_template_img_large>";
			
			$css = file_get_contents( PRICINGTABLE_URL.'/css/templates/arptemplate_'.$result->template_name.'.css');
			
			
			$css = str_replace('../../images',PRICINGTABLE_IMAGES_URL,$css);
			
			
			
		}else{
			$xml .= "\t\t<arp_template_img><![CDATA[".$upload_dir_base_url."template_images/arptemplate_".$result->ID.".png"."]]></arp_template_img>";
			$xml .= "\t\t<arp_template_img_big><![CDATA[".$upload_dir_base_url."template_images/arptemplate_".$result->ID."_big.png"."]]></arp_template_img_big>";
			$xml .= "\t\t<arp_template_img_large><![CDATA[".$upload_dir_base_url."template_images/arptemplate_".$result->ID."_large.png"."]]></arp_template_img_large>";
		
			
			$css = file_get_contents( PRICINGTABLE_UPLOAD_URL.'/css/arptemplate_'.$result->ID.'.css');
			
		}
		
		$xml .= "\t\t<arp_template_css><![CDATA[".$css."]]></arp_template_css>";
		

		
		$xml .= "\t\t<options>\n";
		
		$xml .= "\t\t\t<general_options>";
		
		$general_opt = str_replace('&','[AND]',$result->general_options);
		
		$xml .= "<![CDATA[".$general_opt."]]>";
		
		$xml .= "</general_options>\n";
		
		$sql = $wpdb->get_results( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice_options WHERE table_id = %d", $result->ID) );
		
		$xml .= "\t\t\t<column_options>";
		
		$table_opts = str_replace('&','[AND]',$sql[0]->table_options);
				
		$xml .= "<![CDATA[".$table_opts."]]>";
		
		$xml .= "</column_options>\n";
		
		$xml .= "\t\t</options>\n";
		
		$table_opt = maybe_unserialize($sql[0]->table_options);
								
		foreach($table_opt['columns'] as $c=>$res)
		{
			$str = $res['arp_header_shortcode'];
			
			$btn_img = $res['btn_img'];
			
			$btn_s_img = $res['button_s_img'];
			
			if($btn_img != "")
			{
				$btn_img_src = $btn_img;
				$img_file_name = explode('/',$btn_img_src);
				$btn_img_file = $img_file_name[count($img_file_name)-1];
				
				@copy($btn_img_src, $upload_dir."temp_".$btn_img_file);
				
				if( file_exists($upload_dir."temp_".$btn_img_file) ) {
				
					$filename_arry[] = "temp_".$btn_img_file;
					
					$button_img = "temp_".$file_name;
				
					$xml .= "\t\t<".$c."_btn_img>".$btn_img_src."</".$c."_btn_img>\n";
				}				
			}
			
			if( $btn_s_img != '')
			{
				$btn_s_img_src = $btn_s_img;
				$s_img_file_name = explode('/',$btn_s_img_src);
				$btn_s_img_file = $s_img_file_name[count($s_img_file_name)-1];

				@copy($btn_s_img_src,$upload_dir."temp_".$btn_s_img_file);
				
				if( file_exists( $upload_dir."temp_".$btn_s_img_file) ){
					
					$filename_arry[] = "temp_".$btn_s_img_file;
					
					$button_img = "temp_".$file_name;
					
					$xml .= "\t\t<".$c."_s_btn_img>".$btn_s_img_src."</".$c."_s_btn_img>\n";
				}
			}
			if($str != "")
			{
			
				$header_img = esc_html(stristr($str,'<img'));
				
				$google_map_marker = stristr($str,'[arp_googlemap');
				
				$html5_video = stristr($str,'[arp_html5_video');
				
				$html5_audio = stristr($str,'[arp_html5_audio');
							
				if($header_img != "")
				{				
					$img_src = getAttribute('src', $str);
										
					$img_height = getAttribute('height', $header_img);
					
					$img_width = getAttribute('width', $header_img);
					
					$img_class = getAttribute('class', $header_img);

					$img_src = trim($img_src,'&quot;');
					$img_src = trim($img_src,'"');
					$img_height = trim($img_height,'&quot;');
					$img_height = trim($img_height,'"');
					$img_width = trim($img_width,'&quot;');
					$img_width = trim($img_width,'"');
					$img_class = trim($img_class,'&quot;');
					$img_class = trim($img_class,'"');
					
					
					
					$explodefilename = explode('/',$img_src);
					
					$header_img_name = $explodefilename[count($explodefilename)-1];
					
					$header_img = $header_img_name;
					
					if($header_img != "")
					{
						$newfilename1 = $header_img;
						
						@copy($img_src, $upload_dir."temp_".$newfilename1);
						
						if( file_exists($upload_dir."temp_".$newfilename1) ) {
						
							$filename_arry[] = "temp_".$newfilename1;
						
							$header_img = "temp_".$newfilename1;
						}
						
					}
					
					if( file_exists($upload_dir."temp_".$newfilename1) ) {
					
						$xml .= "\t\t<".$c."_img>".$img_src."</".$c."_img>\n";
					
						$xml .= "\t\t<".$c."_img_width>".$img_width."</".$c."_img_width>\n";
					
						$xml .= "\t\t<".$c."_img_height>".$img_height."</".$c."_img_height>\n";
					
						$xml .= "\t\t<".$c."_img_class>".$img_class."</".$c."_img_class>\n";
					}					
					
				}
				else if($google_map_marker != "")
				{
					
					$gmap_marker_img = $res['gmap_marker'];
					$gmap_img = explode('/',$gmap_marker_img);
					$gmap_img = $gmap_img[count($gmap_img)-1];
										
					@copy($gmap_marker_img, $upload_dir."temp_".$gmap_img);
					
					if( file_exists($upload_dir."temp_".$gmap_img) ) {
						
						$filename_arry[] = "temp_".$gmap_img;
						
						$marker_image = "temp_".$gmap_img;	
														
						$xml .= "\t\t<".$c."_gmap_marker>".$gmap_marker_img."</".$c."_gmap_marker>\n";
					}					
				}
				else if($html5_video != "")
				{
					$pattern = get_shortcode_regex();
					preg_match('/'.$pattern.'/s',$res['arp_header_shortcode'],$preg_matches);
					$string = $preg_matches[3];
					
					$mp4_video = getAttribute('mp4',$res['arp_header_shortcode']);
					$mp4_video = trim($mp4_video,'"');
										
					if($mp4_video != "")
					{
						$mp4_video_name = explode('/',$mp4_video);
						$mp4_video_name = $mp4_video_name[count($mp4_video_name) - 1];
						
						@copy($mp4_video,$upload_dir."temp_".$mp4_video_name);
						
						if( file_exists($upload_dir."temp_".$mp4_video_name) ) {
							
							$filename_arry[] = "temp_".$mp4_video_name;
					
							$mp4_video_name = "temp_".$mp4_video_name;
											
							$xml .= "\t\t<".$c."_html5_mp4_video>".$mp4_video."</".$c."_html5_mp4_video>\n";
						}
					}
					
					$webm_video = getAttribute('webm',$res['arp_header_shortcode']);
					$webm_video = trim($webm_video,'"');
					
					if($webm_video != "")
					{
						$webm_video_name = explode('/',$webm_video);
						$webm_video_name = $webm_video_name[count($webm_video_name) - 1];
						
						@copy($webm_video,$upload_dir.'temp_'.$webm_video_name);
						
						if( file_exists($upload_dir."temp_".$webm_video_name) ) {
						
							$filename_arry[] = "temp_".$webm_video_name;
					
							$webm_video_name = "temp_".$webm_video_name;
						
							$xml .= "\t\t<".$c."_html5_webm_video>".$webm_video."</".$c."_html5_webm_video>\n";
						}					
					}
					
					$ogg_video = getAttribute('ogg',$res['arp_header_shortcode']);
					$ogg_video = trim($ogg_video,'"');
					
					if($ogg_video != "")
					{
						$ogg_video_name = explode('/',$ogg_video);
						$ogg_video_name = $ogg_video_name[count($ogg_video_name) - 1];
						
						@copy($ogg_video,$upload_dir.'temp_'.$ogg_video_name);
						
						if( file_exists($upload_dir."temp_".$ogg_video_name) ) {
						
							$filename_arry[] = "temp_".$ogg_video_name;
					
							$ogg_video_name = "temp_".$ogg_video_name;
						
							$xml .= "\t\t<".$c."_html5_ogg_video>".$ogg_video."</".$c."_html5_ogg_video>\n";
						}
					}
					
					$poster_img = getAttribute('poster',$res['arp_header_shortcode']);
					$poster_img = trim($poster_img,'"');
					
					if($poster_img != "")
					{
						$poster_img_nm = explode('/',$poster_img);
						$poster_img_nm = $poster_img_nm[count($poster_img_nm) - 1];
						
						@copy($poster_img,$upload_dir.'temp_'.$poster_img_nm);
						
						if( file_exists($upload_dir."temp_".$poster_img_nm) ) {
							
							$filename_arry[] = "temp_".$poster_img_nm;
					
							$poster_img_nm = "temp_".$poster_img_nm;
						
							$xml .= "\t\t<".$c."_html5_video_poster>".$poster_img."</".$c."_html5_video_poster>\n";
						}
						
					}
					
				}
				else if($html5_audio != "")
				{
					$pattern = get_shortcode_regex();
					preg_match('/'.$pattern.'/s',$res['arp_header_shortcode'],$preg_matches);
					$string = $preg_matches[3];
					
					$mp3_audio = getAttribute('mp3',$res['arp_header_shortcode']);
					$mp3_audio = trim($mp3_audio,'"');
					
					if($mp3_audio !="")
					{
						$mp3_audio_name = explode('/',$mp3_audio);
						$mp3_audio_name = $mp3_audio_name[count($mp3_audio_name) - 1];
						
						@copy($mp3_audio,$upload_dir.'temp_'.$mp3_audio_name);
						
						if( file_exists($upload_dir."temp_".$mp3_audio_name) ) {
							
							$filename_arry[] = "temp_".$mp3_audio_name;
					
							$mp3_audio_name = "temp_".$mp3_audio_name;
						
							$xml .= "\t\t<".$c."_html5_mp3_audio>".$mp3_audio."</".$c."_html5_mp3_audio>\n";
						}
					}
					
					$ogg_audio = getAttribute('ogg',$res['arp_header_shortcode']);
					$ogg_audio = trim($ogg_audio,'"');
					
					if($ogg_audio != "")
					{
						$ogg_audio_name = explode('/',$ogg_audio);
						$ogg_audio_name = $ogg_audio_name[count($ogg_audio_name)-1];
						
						@copy($ogg_audio,$upload_dir.'temp_'.$ogg_audio_name);
						
						if( file_exists($upload_dir."temp_".$ogg_audio_name) ) {
						
							$filename_arry[] = 'temp_'.$ogg_audio_name;
						
							$ogg_audio_name = 'temp_'.$ogg_audio_name;
						
							$xml .= "\t\t<".$c."_html5_ogg_audio>".$ogg_audio."</".$c."_html5_ogg_audio>\n";
						}
					}
					
					$wav_audio = getAttribute('wav',$res['arp_header_shortcode']);
					$wav_audio = trim($wav_audio,'"');
					
					if($wav_audio != "")
					{
						$wav_audio_name = explode('/',$wav_audio);
						$wav_audio_name = $wav_audio_name[count($wav_audio_name)-1];
						
						@copy($wav_audio,$upload_dir.'temp_'.$wav_audio_name);
						
						if( file_exists($upload_dir."temp_".$wav_audio_name) ) {
						
							$filename_arry[] = 'temp_'.$wav_audio_name;
						
							$wav_audio_name = 'temp_'.$wav_audio_name;
						
							$xml .= "\t\t<".$c."_html5_wav_audio>".$wav_audio."</".$c."_html5_wav_audio>\n";
						}
					}
				}
				
			}		
		}
		
		$xml .= "\t</arp_table>\n\n";
		
	}
	
	$xml .= "</arp_tables>";
	WP_Filesystem();
	
	global $wp_filesytem;
	$wp_filesystem->put_contents($upload_dir.$filename , $xml , 0777);
	
	$filename_arry[] = $filename;
	
	$file = @pathinfo($upload_dir.$filename);
	
	$filename_ser =  @serialize($filename_arry);

	$compressed_file = $file_name.'.zip';
	
	Create_zip($filename_ser,$upload_dir.$compressed_file,$upload_dir);
	
	@header('Content-Type: application/zip; charset=UTF-8', true);
	@header('Content-disposition: attachment; filename='.$compressed_file);
	@header('Content-Length: '.@filesize($upload_dir.$compressed_file));
	@readfile($upload_dir.$compressed_file);
	@unlink($upload_dir.$compressed_file);
}

function Create_zip($source, $destination,$destindir)
{
	$filename = array();
	$filename = @unserialize($source);
	
	$zip = new ZipArchive();
	if($zip->open($destination,ZipArchive::CREATE)===TRUE)
	{
		$i = 0;
		foreach($filename as $file)
		{
			$zip->addFile($destindir.$file, $file);
			$i++;
		}
		$zip->close(); 
	}
	
	foreach($filename as $file1)
	{
		@unlink($destindir.$file1);
	}
}

function getAttribute($att,$tag = '')
{
	$re = '/' . $att . '=([\'])?((?(1).+?|[^\s>]+))(?(1)\1)/is';

	if (preg_match($re, $tag, $match)) {
		return urldecode($match[2]);
	}
	return false;
}

?>