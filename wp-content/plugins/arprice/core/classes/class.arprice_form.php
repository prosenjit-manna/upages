<?php

class arprice_form
{
	function arprice_form()
	{
		add_action( 'wp_ajax_add_price_table', array( &$this, 'arp_add_pricing_table' ) );
		
		//add_action( 'wp_ajax_append_new_package', array( &$this, 'append_new_package_new' ) );
		
		add_action( 'wp_ajax_add_new_row', array( &$this, 'add_new_row_new' ) );
		
		add_action( 'wp_ajax_update_price_table', array( &$this, 'update_price_table' ) );
		
		add_action('init', array(&$this, 'parse_standalone_request'), 1);
		
		add_shortcode('arp_youtube_video', array(&$this, 'arp_youtube_video_shortcode'));
		
		add_shortcode('arp_vimeo_video', array(&$this, 'arp_vimeo_video_shortcode'));
		
		add_shortcode('arp_screenr_video', array(&$this, 'arp_screenr_video_shortcode'));
		
		add_shortcode('arp_html5_video', array(&$this, 'arp_html5_video_shortcode'));
		
		add_shortcode('arp_html5_audio', array(&$this, 'arp_html5_audio_shortcode'));
		
		add_shortcode('arp_googlemap', array(&$this, 'arp_googlemap_shortcode'));
		
		add_shortcode('arp_dailymotion_video', array(&$this, 'arp_dailymotion_video_shortcode'));
		
		add_shortcode('arp_metacafe_video', array(&$this, 'arp_metacafe_video_shortcode'));
		
		add_shortcode('arp_soundcloud_audio', array(&$this, 'arp_soundcloud_audio_shortcode'));
		
		add_shortcode('arp_mixcloud_audio', array(&$this, 'arp_mixcloud_audio_shortcode'));
		
		add_shortcode('arp_beatport_audio', array(&$this, 'arp_beatport_audio_shortcode'));
		
		add_shortcode('arp_embed', array(&$this, 'arp_embed_shortcode'));
		
		
		
		
		//add_action( 'wp_ajax_choose_template_skin', array( &$this, 'choose_template_skin' ) ); 
		
		add_action( 'wp_ajax_arp_updatetabledata', array( &$this, 'arp_updatetabledata' ) );
		
		
		
		add_action( 'wp_ajax_load_pricing_table', array( &$this, 'arp_load_pricing_table' ) );
		
		add_filter( 'widget_text', array(&$this, 'arp_widget_text_filter'), 9 );
		
		add_action( 'wp_ajax_append_new_package_new', array( &$this, 'append_new_package_new_1' ) );
		
		/*add_action( 'wp_ajax_update_template_design', array( &$this, 'arp_update_template_design' ) );*/
		
		add_action( 'wp_ajax_arp_save_template_image', array( &$this, 'arp_save_template_image' ) );
		
		add_action( 'wp_ajax_update_arp_tour_guide_value', array( &$this, 'update_arp_tour_guide_value' ) );
		
	}
	
	function arp_add_pricing_table()
	{
		global $wpdb;
		
		// MODIFY PRICING TABLE BEFORE SAVING
		$_POST = apply_filters('arp_change_values_before_update_pricing_table', $_POST);
		
		do_action('arp_before_update_pricing_table', $_POST);
    	
		$main_table_title = $_POST['pricing_table_main'];
		
		$is_tbl_preview = ( isset($_POST['is_tbl_preview']) and $_POST['is_tbl_preview'] == 1 ) ? 1 : 0;
		
		$dt = current_time('mysql');
		
		$total = $_POST['added_package'];
		
		if($main_table_title == "" && !$is_tbl_preview)
		{
			return;
		}
		
		@parse_str( $_POST['pt_coloumn_order'], $pt_coloumn_order );
		
		$template 		= $_POST['arp_template'];
		$template_name 	= $_POST['arp_template_name'];
		
		$template_skin 	= $_POST['arp_template_skin'];
		$template_type  = $_POST['arp_template_type'];
		$template_feature = json_decode ( stripslashes_deep( $_POST['template_feature'] ), true );
		
		$template_setting = array( 'template'=>$template, 'skin'=>$template_skin, 'template_type'=>$template_type, 'features'=>$template_feature );
		
		$custom_css = stripslashes_deep( $_POST['arp_custom_css'] );
		
		$column_order = stripslashes_deep( $_POST['pricing_table_column_order'] );
		
		$column_ord = str_replace('\'','"',$column_order);
		$col_ord_arr =  json_decode( $column_ord,true );
		if( $_POST['has_caption_column'] == 1 and !in_array('main_column_0',$col_ord_arr))
			array_unshift( $col_ord_arr, 'main_column_0' );
		$new_id = array();
		
		
		if( is_array( $col_ord_arr ) and count($col_ord_arr) > 0 ){
			foreach( $col_ord_arr as $key=>$value )
				$new_id[$key] = str_replace('main_column_','',$value);
		}
		
		$total = max( $new_id );
		
		$column_order = json_encode( $col_ord_arr );
		
		$reference_template = $_POST['arp_reference_template'];
		
		$user_edited_columns = json_decode( stripslashes_deep($_POST['arp_user_edited_columns']),true );
		
		$general_settings = array('arp_custom_css'=>$custom_css,'column_order'=>$column_order,'reference_template'=>$reference_template,'user_edited_columns'=>$user_edited_columns);
		
		
		
		$button_shadow_clr = $_POST['button_shadow_color'];
		$button_radius = $_POST['button_radius'];
		
		$header_font_setting = array('font_family'=>$header_font_family,'font_size'=>$header_font_size,'font_color'=>$header_font_color,'font_style'=>$header_font_style);
		$price_font_setting = array('font_family'=>$price_font_family,'font_size'=>$price_font_size,'font_color'=>$price_font_color,'font_style'=>$price_font_style);
		$price_text_font_setting = array('font_family'=>$price_text_font_family,'font_size'=>$price_text_font_size,'font_color'=>$price_text_font_color,'font_style'=>$price_text_font_style);
		$content_font_setting = array('font_family'=>$content_font_family,'font_size'=>$content_font_size,'font_color'=>$content_font_color,'font_style'=>$content_font_style);
		$button_font_setting = array('font_family'=>$button_font_family,'font_size'=>$button_font_size,'font_color'=>$button_font_color,'font_style'=>$button_font_style);
		$button_settings = array('button_shadow_color'=>$button_shadow_clr,'button_radius'=>$button_radius);
		
		$font_setting = array('header_fonts'=>$header_font_setting,'price_fonts'=>$price_font_setting, 'price_text_fonts'=>$price_text_font_setting, 'content_fonts'=>$content_font_setting, 'button_fonts'=>$button_font_setting);
		
		$is_column_space = $_POST['space_between_column'];
		$column_space = $_POST['column_space'];
		$hover_highlight = $_POST['column_high_on_hover'];
		$is_responsive = $_POST['is_responsive'];
		$all_column_width = $_POST['all_column_width'];
		$column_min_width = $_POST['column_min_width'];
		$column_max_width = $_POST['column_max_width'];
		$hide_caption_column = $_POST['hide_caption_column'];
		$column_opacity = $_POST['column_opacity'];
		
		
		$column_setting = array('space_between_column'=>$is_column_space,'column_space'=>$column_space,'column_highlight_on_hover'=>$hover_highlight,'is_responsive'=>$is_responsive,'column_min_width'=>$column_min_width,'column_max_width'=>$column_max_width,'hide_caption_column'=>$hide_caption_column,'column_opacity' =>$column_opacity,'all_column_width'=>$all_column_width);
		
		$is_animation = $_POST['is_animation'];
		$visible_columns = $_POST['visible_columns'];
		$scroll_column = $_POST['column_to_scroll'];
		$is_navigation = $_POST['is_navigation'];
		$is_autoplay = $_POST['is_autoplay'];
		$sliding_effect = $_POST['sliding_effect'];
		$transition_speed = $_POST['slide_transition_speed'];
		$hide_caption_animation = $_POST['hide_caption_animation'];
		$navigation_style = $_POST['navigation_style'];
		$easing_effect = $_POST['easing_effect'];
		$is_pagination = $_POST['is_pagination'];
		$pagination_style = $_POST['pagination_style'];
		$pagination_position = $_POST['pagination_position'];
		$infinite 	= $_POST['is_infinite'];
		$pagi_nav_btn = $_POST['pagination_navigation_buttons'];
		
		$column_animation = array( 'is_animation'=>$is_animation, 'visible_column'=>$visible_columns, 'scrolling_columns'=>$scroll_column, 'navigation'=>$is_navigation, 'autoplay'=>$is_autoplay,'sliding_effect'=>$sliding_effect, 'transition_speed'=>$transition_speed, 'hide_caption'=>$hide_caption_animation,'navigation_style'=>$navigation_style,'easing_effect'=>$easing_effect, 'is_pagination'=>$is_pagination, 'pagination_style'=>$pagination_style, 'pagination_position'=>$pagination_position, 'is_infinite'=>$infinite,'pagi_nav_btn'=>$pagi_nav_btn );
		
		$tooltip_bgcolor   = stripslashes_deep($_POST['tooltip_bgcolor']);
		$tooltip_txt_color = stripslashes_deep($_POST['tooltip_txtcolor']);
		$tooltip_animation = $_POST['tooltip_animation_style'];
		$tooltip_position  = $_POST['tooltip_position'];
		$tooltip_width 	   = $_POST['tooltip_width'];
		$tooltip_style     = $_POST['tooltip_style'];
		$tooltip_font_family = stripslashes_deep($_POST['tooltip_font_family']);
		$tooltip_font_size = $_POST['tooltip_font_size'];
		$tooltip_font_style = $_POST['tooltip_font_style'];
		
		$tooltip_setting = array( 'background_color'=>$tooltip_bgcolor, 'text_color'=>$tooltip_txt_color,'animation'=>$tooltip_animation, 'position'=>$tooltip_position,'tooltip_width'=>$tooltip_width, 'style'=> $tooltip_style,'tooltip_font_family'=>$tooltip_font_family,'tooltip_font_size'=>$tooltip_font_size,'tooltip_font_style'=>$tooltip_font_style );
		
		$tab_general_opt = array( 'template_setting'=>$template_setting , 'font_settings'=>$font_setting, 'column_settings'=>$column_setting, 'column_animation'=>$column_animation, 'tooltip_settings'=>$tooltip_setting, 'general_settings'=>$general_settings,'button_settings'=>$button_settings );
		
		$general_opt = maybe_serialize($tab_general_opt);
		
		$row = array();
		$column_order = array();
		$row_order = array();
		
		if($total > 0)
		{	
			
			if( $is_tbl_preview && $is_tbl_preview == 1 )
			{
				$temp_status	= 'draft';
				
				$id = $wpdb->query( $wpdb->prepare( 'INSERT INTO '.$wpdb->prefix.'arp_arprice (table_name,general_options,status,create_date) VALUES (%s,%s,%s,%s)', $main_table_title,$general_opt, $temp_status,$dt ) );
		
				$table_id = $wpdb->insert_id;
			} else {
				$new_status = 'published';
								
				$type_of_template = $template_feature['is_animated'];
					
					$id = $wpdb->query( $wpdb->prepare( 'INSERT INTO '.$wpdb->prefix.'arp_arprice (table_name,general_options,is_animated,status,create_date) VALUES (%s,%s,%d,%s,%s)',$main_table_title,$general_opt, $type_of_template,$new_status, $dt ) );		
						$table_id = $wpdb->insert_id;
			}
			
			// AFTER UPDATE PRICING TABLE
			
			do_action('arp_after_update_pricing_table', $table_id,$_POST);
    		do_action('arp_after_update_pricing_table'.$table_id, $table_id, $_POST);
			
    		$table_id = apply_filters('arp_change_values_after_update_pricing_table', $table_id, $_POST);
	
			if($total > 1)
			{	
				$ki = 1;			
				for($i = 0; $i <= $total; $i++)
				{
					if( !in_array( $i,$new_id ) )
						continue;
					$Title = 'column_'.$i;
					$column_width = $_POST['column_width_'.$i];
					$column_title = stripslashes_deep($_POST['column_title_'.$i]);
					$column_desc = stripslashes_deep($_POST['arp_column_description_'.$i]);
					$cstm_rbn_txt = stripslashes_deep($_POST['arp_custom_ribbon_txt_'.$i]);
					$column_highlight = $_POST['column_highlight_'.$i];
					
					
					
					$column_ribbon_style	= stripslashes_deep($_POST['arp_ribbon_style_'.$i]);
					$column_ribbon_position = stripslashes_deep($_POST['arp_ribbon_position_'.$i]);
					$column_ribbon_bgcolor	= stripslashes_deep($_POST['arp_ribbon_bgcol_'.$i]);
					$column_ribbon_txtcolor = stripslashes_deep($_POST['arp_ribbon_textcol_'.$i]);
					$column_ribbon_content  = stripslashes_deep($_POST['arp_ribbon_content_'.$i]);
					
					$header_font_family =  stripslashes_deep($_POST['header_font_family_'.$i]);
					$header_font_size =  $_POST['header_font_size_'.$i];
					$header_font_style =  $_POST['header_font_style_'.$i];
					$header_font_color  =  stripslashes_deep($_POST['header_font_color_'.$i]);
					
					$header_style_bold = $_POST['header_style_bold_'.$i];
					$header_style_italic = $_POST['header_style_italic_'.$i];
					$header_style_decoration = $_POST['header_style_decoration_'.$i];
					
					$price_font_family = stripslashes_deep($_POST['price_font_family_'.$i]);
					$price_font_size = $_POST['price_font_size_'.$i];
					$price_font_color = stripslashes_deep($_POST['price_font_color_'.$i]);
					$price_font_style = $_POST['price_font_style_'.$i];
					
					$price_label_style_bold = $_POST['price_label_style_bold_'.$i];
					$price_label_style_italic = $_POST['price_label_style_italic_'.$i];
					$price_label_style_decoration = $_POST['price_label_style_decoration_'.$i];
					
					$price_text_font_family = stripslashes_deep($_POST['price_text_font_family_'.$i]);
					$price_text_font_size = $_POST['price_text_font_size_'.$i];
					$price_text_font_style = $_POST['price_text_font_style_'.$i];
					$price_text_font_color = stripslashes_deep($_POST['price_text_font_color_'.$i]);
					
					$price_text_style_bold = $_POST['price_text_style_bold_'.$i];
					$price_text_style_italic = $_POST['price_text_style_italic_'.$i];
					$price_text_style_decoration = $_POST['price_text_style_decoration_'.$i];
					
					
					$column_description_font_family = stripslashes_deep($_POST['column_description_font_family_'.$i]);
					$column_description_font_size = $_POST['column_description_font_size_'.$i];
					$column_description_font_style = $_POST['column_description_font_style_'.$i];
					$column_description_font_color = stripslashes_deep($_POST['column_description_font_color_'.$i]);
					
					$column_description_style_bold = $_POST['column_description_style_bold_'.$i];
					$column_description_style_italic = $_POST['column_description_style_italic_'.$i];
					$column_description_style_decoration = $_POST['column_description_style_decoration_'.$i];
					
					
					$content_font_family = stripslashes_deep($_POST['content_font_family_'.$i]);
					$content_font_size = $_POST['content_font_size_'.$i];
					$content_font_color = stripslashes_deep($_POST['content_font_color_'.$i]);
					$content_font_style = $_POST['content_font_style_'.$i];
					
					$body_li_style_bold = $_POST['body_li_style_bold_'.$i];
					$body_li_style_italic = $_POST['body_li_style_italic_'.$i];
					$body_li_style_decoration = $_POST['body_li_style_decoration_'.$i];
					
					
					$content_label_font_family = stripslashes_deep( $_POST['content_label_font_family_'.$i] );
					$content_label_font_size = $_POST['content_label_font_size_'.$i];
					$content_label_font_color = stripslashes_deep($_POST['content_font_color_'.$i]);
					$content_label_font_style = $_POST['content_font_style_'.$i];
					
					$body_label_style_bold = $_POST['body_label_style_bold_'.$i];
					$body_label_style_italic = $_POST['body_label_style_italic_'.$i];
					$body_label_style_decoration = $_POST['body_label_style_decoration_'.$i];
					
					$button_font_family = stripslashes_deep($_POST['button_font_family_'.$i]);
					$button_font_size = $_POST['button_font_size_'.$i];
					$button_font_color = stripslashes_deep($_POST['button_font_color_'.$i]);
					$button_font_style = $_POST['button_font_style_'.$i];
					
					$button_style_bold = $_POST['button_style_bold_'.$i];
					$button_style_italic = $_POST['button_style_italic_'.$i];
					$button_style_decoration = $_POST['button_style_decoration_'.$i];
					
					$second_button_font_family = stripslashes_deep($_POST['second_button_font_family_'.$i]);
					$second_button_font_size = $_POST['second_button_font_size_'.$i];
					$second_button_font_style = $_POST['second_button_font_style_'.$i];
					$second_button_font_color = stripslashes_deep($_POST['second_button_font_color_'.$i]);
					
					$caption = isset($_POST['caption_column_'.$i]) ? $_POST['caption_column_'.$i] : 0;
					$show_column 	= isset($_POST['show_column_'.$i]) ? 1 : 0;
					$header_shortcode = stripslashes_deep($_POST['additional_shortcode_'.$i]);
					$html_content 	= stripslashes_deep($_POST['html_content_'.$i]);
					$price_text 	= stripslashes_deep($_POST['price_text_'.$i]);
					$price_label 	= stripslashes_deep($_POST['price_label_'.$i]);
					$gmap_marker = stripslashes_deep($_POST['gmap_marker'.$i]);
					$total_rows 	= $_POST['total_rows_'.$i];
					$body_text_alignment = $_POST['body_text_alignment_'.$i];
					
					$ji = 1;
					$row = array();
					if( $total_rows > 0 )
					{
						for($j = 0; $j < $total_rows; $j++)
						{
							$row_title = 'row_'.$j;
							$row_label 		= stripslashes_deep($_POST['row_'.$i.'_label_'.$j]);
							$row_des_align 	= stripslashes_deep($_POST['row_'.$i.'_description_text_alignment_'.$j]);
							$row_des 		= stripslashes_deep($_POST['row_'.$i.'_description_'.$j]);
							$row_tooltip 	= stripslashes_deep($_POST['row_'.$i.'_tooltip_'.$j]);
							
							$row[$row_title] = array('row_des_txt_align'=>$row_des_align, 'row_description'=>$row_des, 'row_tooltip'=>$row_tooltip, 'row_label'=>$row_label);
														
							unset($_POST['row_'.$i.'_description_text_alignment_'.$j]);
							unset($_POST['row_'.$i.'_description_'.$j]);
							unset($_POST['row_'.$i.'_tooltip_'.$j]);
							
							$ji++;
						}
					}
					$btn_size 	= $_POST['button_size_'.$i];
					$btn_type 	= $_POST['button_type_'.$i];
					$btn_text 	= stripslashes_deep($_POST['btn_content_'.$i]);
					$paypal_btn = stripslashes_deep($_POST['paypal_code_'.$i]);
					$btn_link 	= stripslashes_deep($_POST['btn_link_'.$i]);
					$btn_img 	= stripslashes_deep($_POST['btn_img_url_'.$i]);
					$btn_img_height = $_POST['button_img_height_'.$i];
					$btn_img_width 	= $_POST['button_img_width_'.$i];
					$btn_s_size = $_POST['second_button_size_'.$i];
					$btn_s_type = $_POST['second_button_type_'.$i];
					$btn_s_text = stripslashes_deep($_POST['second_btn_content_'.$i]);
					$paypal_s_btn = stripslashes_deep($_POST['second_paypal_code_'.$i]);
					$btn_s_link = stripslashes_deep($_POST['second_btn_link_'.$i]);
					$btn_s_img  = stripslashes_deep($_POST['second_btn_img_url_'.$i]);
					$btn_s_img_height = $_POST['second_button_img_height_'.$i];
					$btn_s_img_width = $_POST['second_button_img_width_'.$i];
					$s_is_new_window = $_POST['second_new_window_'.$i];
					$is_new_window 	= $_POST['new_window_'.$i];
					
					if( !isset($table_columns[ $Title ]['row_order']) || !is_array($table_columns[ $Title ]['row_order']) )
					{
						@parse_str($_POST[$Title.'_row_order'], $col_row_order);
						$row_order= $col_row_order;
					}
					
					$ribbon_settings = array(
						'arp_ribbon' 			=> $column_ribbon_style,
						'arp_ribbon_bgcol' 		=> $column_ribbon_bgcolor,
						'arp_ribbon_txtcol' 	=> $column_ribbon_txtcolor,
						'arp_ribbon_position' 	=> $column_ribbon_position,
						'arp_ribbon_content'	=> $column_ribbon_content,
					);
					
					$column[$Title] = array( 
										'package_title'			=> $column_title, 
										'column_width'			=> $column_width,
										'is_caption'			=> $caption,
										'column_description' 	=> $column_desc,
										'column_highlight'		=> $column_highlight,
										'custom_ribbon_txt'		=> $cstm_rbn_txt,
										'is_hidden'				=> $show_column, 
										'arp_header_shortcode'	=> $header_shortcode, 
										'html_content'			=> $html_content,
										'price_text'			=> $price_text,
										'price_label'			=> $price_label,
										'gmap_marker'			=> $google_map_marker,
										'body_text_alignment'	=> $body_text_alignment,
										'rows'					=> $row, 
										'button_size'			=> $btn_size, 
										'button_type'			=> $btn_type, 
										'button_text'			=> $btn_text,
										'paypal_code'			=> $paypal_btn,
										'button_url'			=> $btn_link, 
										'btn_img'				=> $btn_img, 
										'btn_img_height'		=> $btn_img_height, 
										'btn_img_width'			=> $btn_img_width,
										'button_s_size'			=> $btn_s_size,
										'button_s_type'			=> $btn_s_type,
										'button_s_text'			=> $btn_s_text,
										'paypal_s_code'			=> $paypal_s_btn,
										'button_s_link'			=> $btn_s_link,
										'button_s_img'			=> $btn_s_img,
										'button_s_img_height'	=> $btn_s_img_height,
										'button_s_img_width'	=> $btn_s_img_width,
										's_is_new_window'		=> $s_is_new_window,
										'is_new_window'			=> $is_new_window, 
										'ribbon_setting'		=> $ribbon_settings,
										'header_font_family'	=> $header_font_family,
										'header_font_size'		=> $header_font_size,
										'header_font_style'		=> $header_font_style,
										'header_font_color'		=> $header_font_color,
										'header_style_bold'     => $header_style_bold,
										'header_style_italic'   => $header_style_italic,
										'header_style_decoration' => $header_style_decoration,
										
										'price_font_family'		=> $price_font_family,
										'price_font_size'		=> $price_font_size,
										'price_font_style'		=> $price_font_style,
										'price_font_color'		=> $price_font_color,
										'price_label_style_bold' => $price_label_style_bold,
										'price_label_style_italic' => $price_label_style_italic,
										'price_label_style_decoration' => $price_label_style_decoration,
										
										'price_text_font_family'=> $price_text_font_family,
										'price_text_font_size'	=> $price_text_font_size,
										'price_text_font_style' => $price_text_font_style,
										'price_text_font_color' => $price_text_font_color,
										'price_text_style_bold' => $price_text_style_bold,
										'price_text_style_italic' => $price_text_style_italic,
										'price_text_style_decoration' => $price_text_style_decoration,
										
										'content_font_family'	=> $content_font_family,
										'content_font_size'		=> $content_font_size,
										'content_font_style' 	=> $content_font_style,
										'content_font_color'	=> $content_font_color,
										'body_li_style_bold'    => $body_li_style_bold,
										'body_li_style_italic'  => $body_li_style_italic,
										'body_li_style_decoration' => $body_li_style_decoration,
										
										'content_label_font_family' => $content_label_font_family,
										'content_label_font_size'	=> $content_label_font_size,
										'content_label_font_style'	=> $content_label_font_style,
										'content_label_font_color'	=> $content_label_font_color,
										'body_label_style_bold'     => $body_label_style_bold,
										'body_label_style_italic'   => $body_label_style_italic,
										'body_label_style_decoration' => $body_label_style_decoration,
										
										'button_font_family'	=> $button_font_family,
										'button_font_size'		=> $button_font_size,
										'button_font_color'		=> $button_font_color,
										'button_font_style'		=> $button_font_style,
										'button_style_bold' 	=> $button_style_bold,
										'button_style_italic' 	=> $button_style_italic,
										'button_style_decoration' => $button_style_decoration,
										
										'second_button_font_family'=> $second_button_font_family,
										'second_button_font_size'  => $second_button_font_size,
										'second_button_font_style' => $second_button_font_style,
										'second_button_font_color' => $second_button_font_color,
										'column_description_font_family'=> $column_description_font_family,
										'column_description_font_size'=> $column_description_font_size,
										'column_description_font_style'=>$column_description_font_style,
										'column_description_font_color'=>$column_description_font_color,
										'column_description_style_bold'=>$column_description_style_bold,
										'column_description_style_italic'=>$column_description_style_italic,
										'column_description_style_decoration'=>$column_description_style_decoration,
										);
				}
			}
			else
			{
				$Title = 'column_0';
				$column_width = $_POST['column_width_0'];
				$column_title = $_POST['column_title_0'];
				$column_highlight = $_POST['column_highlight_0'];
				$column_desc = stripslashes_deep($_POST['arp_column_description_0']);
				$cstm_rbn_txt = stripslashes_deep($_POST['arp_custom_ribbon_txt_0']);
				
				/*$column_ribbonimg		= $_POST['arp_ribbonimg_0'];	
				$column_ribbontext		= stripslashes_deep($_POST['arp_ribbontext_0']);
				$column_ribbonposition	= $_POST['arp_ribbonposition_0'];	*/
				
				$column_ribbon_style	= stripslashes_deep($_POST['arp_ribbon_style_0']);
				$column_ribbon_position = stripslashes_deep($_POST['arp_ribbon_position_0']);
				$column_ribbon_bgcolor	= stripslashes_deep($_POST['arp_ribbon_bgcol_0']);
				$column_ribbon_txtcolor = stripslashes_deep($_POST['arp_ribbon_textcol_0']);
				$column_ribbon_content  = stripslashes_deep($_POST['arp_ribbon_content_0']);
				
				$caption = isset($_POST['caption_column_0']) ? $_POST['caption_column_0'] : 0;
				$show_column 	= isset($_POST['show_column_0']) ? 1 : 0;
				$price 			= $_POST['price_0'];
				$html_content 	= stripslashes_deep($_POST['html_content_0']);
				$price_text 	= stripslashes_deep($_POST['price_text_0']);
				$price_label 	= stripslashes_deep($_POST['price_label_0']);
				$header_shortcode = stripslashes_deep($_POST['additional_shortcode_0']);
				$gmap_marker 	= $_POST['gmap_marker_0'];
				$total_rows 	= $_POST['total_rows_0'];
				
				$header_font_family =  stripslashes_deep($_POST['header_font_family_0']);
				$header_font_size =  $_POST['header_font_size_0'];
				$header_font_style =  $_POST['header_font_style_0'];
				$header_font_color  =  stripslashes_deep($_POST['header_font_color_0']);
				
				$header_style_bold = $_POST['header_style_bold_0'];
				$header_style_italic = $_POST['header_style_italic_0'];
				$header_style_decoration = $_POST['header_style_decoration_0'];
				
				$price_font_family = stripslashes_deep($_POST['price_font_family_0']);
				$price_font_size = $_POST['price_font_size_0'];
				$price_font_color = stripslashes_deep($_POST['price_font_color_0']);
				$price_font_style = $_POST['price_font_style_0'];
				
				$price_label_style_bold = $_POST['price_label_style_bold_0'];
				$price_label_style_italic = $_POST['price_label_style_italic_0'];
				$price_label_style_decoration = $_POST['price_label_style_decoration_0'];
				
				$price_text_font_family = stripslashes_deep($_POST['price_text_font_family_0']);
				$price_text_font_size = $_POST['price_text_font_size_0'];
				$price_text_font_style = $_POST['price_text_font_style_0'];
				$price_text_font_color = stripslashes_deep($_POST['price_text_font_color_0']);
				
				$price_text_style_bold = $_POST['price_text_style_bold_0'];
				$price_text_style_italic = $_POST['price_text_style_italic_0'];
				$price_text_style_decoration = $_POST['price_text_style_decoration_0'];
				
				
				$column_description_font_family = stripslashes_deep($_POST['column_description_font_family_0']);
				$column_description_font_size = $_POST['column_description_font_size_0'];
				$column_description_font_style = $_POST['column_description_font_style_0'];
				$column_description_font_color = stripslashes_deep($_POST['column_description_font_color_0']);
				
				$column_description_style_bold = $_POST['column_description_style_bold_0'];
				$column_description_style_italic = $_POST['column_description_style_italic_0'];
				$column_description_style_decoration = $_POST['column_description_style_decoration_0'];
				
				
				$content_font_family = stripslashes_deep($_POST['content_font_family_0']);
				$content_font_size = $_POST['content_font_size_0'];
				$content_font_color = stripslashes_deep($_POST['content_font_color_0']);
				$content_font_style = $_POST['content_font_style_0'];
				
				$body_li_style_bold = $_POST['body_li_style_bold_0'];
				$body_li_style_italic = $_POST['body_li_style_italic_0'];
				$body_li_style_decoration = $_POST['body_li_style_decoration_0'];
				
				
				$content_label_font_family = stripslashes_deep($_POST['content_label_font_family_0']);
				$content_label_font_size = $_POST['content_label_font_family_0'];
				$content_label_font_color = stripslashes_deep($_POST['content_label_font_color_0']);
				$content_label_font_style = $_POST['content_label_font_style_0'];
				
				$body_label_style_bold = $_POST['body_label_style_bold_0'];
				$body_label_style_italic = $_POST['body_label_style_italic_0'];
				$body_label_style_decoration = $_POST['body_label_style_decoration_0'];
				
				$button_font_family = stripslashes_deep($_POST['button_font_family_0']);
				$button_font_size = $_POST['button_font_size_0'];
				$button_font_color = stripslashes_deep($_POST['button_font_color_0']);
				$button_font_style = $_POST['button_font_style_0'];
				
				$button_style_bold = $_POST['button_style_bold_0'];
				$button_style_italic = $_POST['button_style_italic_0'];
				$button_style_decoration = $_POST['button_style_decoration_0'];
				
				
				$second_button_font_family = stripslashes_deep( $_POST['second_button_font_family_0']);
				$second_button_font_size   = $_POST['second_button_font_size_0'];
				$second_button_font_style  = $_POST['second_button_font_style_0'];
				$second_button_font_color  = stripslashes_deep($_POST['second_button_font_color_0']);
				
				$ji = 1;
				$row = array();
				if( $total_rows > 0 )
				{
					for($j = 0; $j < $total_rows; $j++)
					{
						$row_title 		= 'row_'.$j;
						$row_label      = stripslashes_deep($_POST['row_0_label_'.$j]);
						$row_des_align 	= stripslashes_deep($_POST['row_0_description_text_alignment_'.$j]);
						$row_des 		= stripslashes_deep($_POST['row_0_description_'.$j]);
						$row_tooltip 	= stripslashes_deep($_POST['row_0_tooltip_'.$j]);
						
						$row[$row_title]= array('row_des_txt_align'=>$row_des_align, 'row_description'=>$row_des, 'row_tooltip'=>$row_tooltip,'row_label'=>$row_label);
						
						unset($_POST['row_0_description_text_alignment_'.$j]);
						unset($_POST['row_0_description_'.$j]);
						unset($_POST['row_0_tooltip_'.$j]);
						$ji++;
					}
				}
				$body_text_alignemtn = $_POST['body_text_alignment_0'];
				$btn_size 	= $_POST['button_size_0'];
				$btn_type 	= $_POST['button_type_0'];
				$btn_text 	= stripslashes_deep($_POST['btn_content_0']);
				$paypal_code = stripslashes_deep($_POST['paypal_code_0']);
				$btn_link 	= stripslashes_deep($_POST['btn_link_0']);
				$btn_img 	= stripslashes_deep($_POST['btn_img_url_0']);
				$btn_img_height = $_POST['button_img_height_0'];
				$btn_img_width 	= $_POST['button_img_width_0'];
				$btn_s_size = $_POST['second_button_size_0'];
				$btn_s_type = $_POST['second_button_type_0'];
				$btn_s_text = stripslashes_deep($_POST['second_btn_content_0']);
				$paypal_s_btn = stripslashes_deep($_POST['second_paypal_code_0']);
				$btn_s_link = stripslashes_deep($_POST['second_btn_link_0']);
				$btn_s_img = stripslashes_deep($_POST['second_btn_img_url_0']);
				$btn_s_img_height = $_POST['second_button_img_height_0'];
				$btn_s_img_width = $_POST['second_button_img_width_0'];
				$s_is_new_window = $_POST['second_new_window_0'];
				$is_new_window 	= $_POST['new_window_0'];
				
				if( !isset($table_columns[ $Title ]['row_order']) || !is_array($table_columns[ $Title ]['row_order']) )
				{
					@parse_str($_POST[$Title.'_row_order'], $col_row_order);
					$row_order= $col_row_order;
				}
				
				$ribbon_settings = array(
					'arp_ribbon' 			=> $column_ribbon_style,
					'arp_ribbon_bgcol' 		=> $column_ribbon_bgcolor,
					'arp_ribbon_txtcol' 	=> $column_ribbon_txtcolor,
					'arp_ribbon_position' 	=> $column_ribbon_position,
					'arp_ribbon_content'	=> $column_ribbon_content,
				);										
					
				$column[$Title] = array( 
									'package_title'			=> $column_title, 
									'column_width'			=> $column_width, 
									'is_caption'			=> $caption,
									'column_description' 	=> $column_desc,
									'custom_ribbon_txt' 	=> $cstm_rbn_txt,
									'column_highlight'		=> $column_highlight,
									'is_hidden'				=> $show_column, 
									'arp_header_shortcode'	=> $header_shortcode, 
									'html_content'			=> $html_content,
									'price_text'			=> $price_text,
									'price_label'			=> $price_label,
									'gmap_marker'			=> $gmap_marker,
									'body_text_alignemnt'	=> $body_text_alignment,
									'rows'					=> $row,
									'button_size'			=> $btn_size,
									'button_type'			=> $btn_type,
									'button_text'			=> $btn_text,
									'paypal_code'			=> $paypal_btn,
									'button_url'			=> $btn_link,
									'btn_img'				=> $btn_img,
									'btn_img_height'		=> $btn_img_height,
									'btn_img_width'			=> $btn_img_width,
									'button_s_size'			=> $btn_s_size,
									'button_s_type'			=> $btn_s_type,
									'button_s_text'			=> $btn_s_text,
									'paypal_s_code'			=> $paypal_s_btn,
									'button_s_link'			=> $btn_s_link,
									'button_s_img'			=> $btn_s_img,
									'button_s_img_height'	=> $btn_s_img_height,
									'button_s_img_width'	=> $btn_s_img_width,
									's_is_new_window'		=> $s_is_new_window,
									'is_new_window'			=> $is_new_window, 
									'ribbon_setting'		=> $ribbon_settings,
									'header_font_family'	=> $header_font_family,
									'header_font_size'		=> $header_font_size,
									'header_font_style'		=> $header_font_style,
									'header_font_color'		=> $header_font_color,
									
									'header_style_bold'     => $header_style_bold,
									'header_style_italic'   => $header_style_italic,
									'header_style_decoration' => $header_style_decoration,
									
									'content_font_family'	=> $content_font_family,
									'content_font_size'		=> $content_font_size,
									'content_font_style' 	=> $content_font_style,
									'content_font_color'	=> $content_font_color,
									
									'body_li_style_bold'    => $body_li_style_bold,
									'body_li_style_italic'  => $body_li_style_italic,
									'body_li_style_decoration' => $body_li_style_decoration,
									
									'content_label_font_family' => $content_label_font_family,
									'content_label_font_size'	=> $content_label_font_size,
									'content_label_font_style'	=> $content_label_font_style,
									'content_label_font_color'	=> $content_label_font_color,
									
									'body_label_style_bold'     => $body_label_style_bold,
									'body_label_style_italic'   => $body_label_style_italic,
									'body_label_style_decoration' => $body_label_style_decoration,
									
									'price_font_family'		=> $price_font_family,
									'price_font_size'		=> $price_font_size,
									'price_font_style'		=> $price_font_style,
									'price_font_color'		=> $price_font_color,
									
									'price_label_style_bold' => $price_label_style_bold,
									'price_label_style_italic' => $price_label_style_italic,
									'price_label_style_decoration' => $price_label_style_decoration,
									
									'price_text_font_family'=> $price_text_font_family,
									'price_text_font_size'	=> $price_text_font_size,
									'price_text_font_style' => $price_text_font_style,
									'price_text_font_color' => $price_text_font_color,
									
									'price_text_style_bold' => $price_text_style_bold,
									'price_text_style_italic' => $price_text_style_italic,
									'price_text_style_decoration' => $price_text_style_decoration,
									
									'button_font_family'	=> $button_font_family,
									'button_font_size'		=> $button_font_size,
									'button_font_color'		=> $button_font_color,
									'button_font_style'		=> $button_font_style,
									
									'button_style_bold' 	=> $button_style_bold,
									'button_style_italic' 	=> $button_style_italic,
									'button_style_decoration' => $button_style_decoration,
									
									'second_button_font_family' => $second_button_font_family,
									'second_button_font_size'   => $second_button_font_size,
									'second_button_font_style'  => $second_button_font_style,
									'second_button_font_color'  => $second_button_font_color,
									'column_description_font_family'=> $column_description_font_family,
									'column_description_font_size'=> $column_description_font_size,
									'column_description_font_style'=>$column_description_font_style,
									'column_description_font_color'=>$column_description_font_color,
									
									'column_description_style_bold'=>$column_description_style_bold,
									'column_description_style_italic'=>$column_description_style_italic,
									'column_description_style_decoration'=>$column_description_style_decoration,
									
									);
				
				$column_order[ $Title ] = 1;
			}
		}
		else
		{
			return;
		}
		
		$tbl_opt['columns'] = $column;
		$tbl_opt['column_order'] = $column_order;
		$table_options = maybe_serialize($tbl_opt);
		
		
		$ins = $wpdb->query( $wpdb->prepare( 'INSERT INTO '.$wpdb->prefix.'arp_arprice_options (table_id,table_options) VALUES (%d,%s)',$table_id,$table_options ) );
		
		$css_file_name = $template_name.'.css';

		//$css_responsive_name = $template_name.'_responsive.css';
		
		WP_Filesystem();
		
		global $wp_filesystem;
		
		if( file_exists( PRICINGTABLE_DIR.'/css/templates/'.$css_file_name ) )
		{
			$css = file_get_contents( PRICINGTABLE_URL.'/css/templates/'.$css_file_name );
			//$css_responsive = file_get_contents( PRICINGTABLE_URL.'/css/templates/'.$css_responsive_name );
		}else {
			$css = file_get_contents( PRICINGTABLE_UPLOAD_URL.'/css/'.$css_file_name );
			//$css_responsive = file_get_contents( PRICINGTABLE_UPLOAD_URL.'/css/'.$css_responsive_name);
		}
		
		$css_new = str_replace($template_name,'arptemplate_'.$table_id,$css);
		
		$css_new = str_replace('../../images',PRICINGTABLE_IMAGES_URL,$css_new);
		
		
		
		$path = PRICINGTABLE_UPLOAD_DIR.'/css/';
			
		$file_name = 'arptemplate_'.$table_id.'.css';	
					
		$wp_filesystem->put_contents( $path.$file_name, $css_new, 0777 );
		
		// Query for delete preview data option start
		$all_previewoption	= get_option('arp_previewoptions');
		$all_previewoption	= maybe_unserialize($all_previewoption);
		if( $all_previewoption && count($all_previewoption) > 0 )
		{
			$option_to_delete	= array();
			$day_ago_time = strtotime("-2 days");
			$all_previewoption_db	= $all_previewoption;
			foreach($all_previewoption as $opt_name => $opt_date )
			{
				if( isset($opt_name) && $opt_name !='' && $opt_name != '0' && $opt_date <= $day_ago_time )
				{
					$option_to_delete[]	=  $opt_name;
					unset($all_previewoption_db[$opt_name]);
				}
			}	
			if( $option_to_delete && count($option_to_delete) > 0 )
			{
				update_option('arp_previewoptions', $all_previewoption_db);		// Update Remaining options
				$option_to_delete_str	= @implode("','", $option_to_delete);
				$option_to_delete_str 	= "'".$option_to_delete_str."'"; 
				$wpdb->query("DELETE FROM ".$wpdb->options." WHERE option_name IN (".$option_to_delete_str.")");
			}	
		}
		// Query for delete preview data option end
		
		echo $table_id;
				
		die();
	}
	
	function update_price_table()
	{
		global $wpdb;
		
		$table_id = $_POST['table_id'];
		
		
		// MODIFY PRICING TABLE BEFORE SAVING
		$_POST = apply_filters('arp_change_values_before_update_pricing_table', $_POST);
		
		do_action('arp_before_update_pricing_table', $_POST);
		
		$main_table_title = $_POST['pricing_table_main'];
		
		$dt = current_time('mysql');
		
		$total = $_POST['added_package'];
		
		$template = $_POST['arp_template'];
		$template_skin = $_POST['arp_template_skin'];
		$template_name 	= $_POST['arp_template_name'];
		$template_type = $_POST['arp_template_type'];
		$template_feature = json_decode ( stripslashes_deep( $_POST['template_feature'] ), true );
						
		$template_setting = array( 'template'=>$template, 'skin'=>$template_skin, 'template_type'=>$template_type, 'features'=>$template_feature);
		
		$custom_css = stripslashes_deep( $_POST['arp_custom_css'] );
		
	
		$column_order = stripslashes_deep( $_POST['pricing_table_column_order'] );
		
		$column_ord = str_replace('\'','"',$column_order);
		$col_ord_arr =  json_decode( $column_ord,true );
		if( $_POST['has_caption_column'] == 1 and !in_array('main_column_0',$col_ord_arr) )
			array_unshift( $col_ord_arr, 'main_column_0' );

		$new_id = array();	
		
		if( is_array( $col_ord_arr ) and count($col_ord_arr) > 0 ){
			foreach( $col_ord_arr as $key=>$value )
				$new_id[$key] = str_replace('main_column_','',$value);
		}
		
		/*echo "<pre>";
		print_r( $new_id );
		echo "</pre>";
		exit;*/
		
		$total = max( $new_id );
		
		$column_order = json_encode( $col_ord_arr );
				
		$reference_template = $_POST['arp_reference_template'];
		
		$user_edited_columns = json_decode( stripslashes_deep($_POST['arp_user_edited_columns']),true );
		
		$general_settings = array('arp_custom_css'=>$custom_css,'column_order'=>$column_order,'reference_template'=>$reference_template,'user_edited_columns'=>$user_edited_columns);
		
		
		
		$button_shadow_clr = @stripslashes_deep($_POST['button_shadow_color']);
		$button_radius = @$_POST['button_radius'];
		
		$header_font_setting = array('font_family'=>@$header_font_family,'font_size'=>@$header_font_size,'font_color'=>@$header_font_color,'font_style'=>@$header_font_style);
		$price_font_setting = array('font_family'=>@$price_font_family,'font_size'=>@$price_font_size,'font_color'=>@$price_font_color,'font_style'=>@$price_font_style);
		$price_text_font_setting = array('font_family'=>@$price_text_font_family,'font_size'=>@$price_text_font_size,'font_color'=>@$price_text_font_color,'font_style'=>@$price_text_font_style);
		$content_font_setting = array('font_family'=>@$content_font_family,'font_size'=>@$content_font_size,'font_color'=>@$content_font_color,'font_style'=>@$content_font_style);
		$button_font_setting = array('font_family'=>@$button_font_family,'font_size'=>@$button_font_size,'font_color'=>@$button_font_color,'font_style'=>@$button_font_style);
		$button_settings = array('button_shadow_color'=>$button_shadow_clr,'button_radius'=>$button_radius);
		$font_setting = array('header_fonts'=>$header_font_setting,'price_fonts'=>$price_font_setting, 'price_text_fonts'=>$price_text_font_setting, 'content_fonts'=>$content_font_setting, 'button_fonts'=>$button_font_setting);
		
		//$button_settings = array('button_shadow_color'=>$button_shadow_clr,'button_radius'=>$button_radius);
		
		$is_column_space = @$_POST['space_between_column'];
		$column_space = @stripslashes_deep($_POST['column_space']);
		$hover_highlight = @stripslashes_deep($_POST['column_high_on_hover']);
		$is_responsive = @$_POST['is_responsive'];
		$all_column_width = @$_POST['all_column_width'];
		$column_min_width = @$_POST['column_min_width'];
		$column_max_width = @$_POST['column_max_width'];
		$hide_caption_column = @$_POST['hide_caption_column'];
		$column_opacity = @$_POST['column_opacity'];
		
		$column_setting = array('space_between_column'=>$is_column_space,'column_space'=>$column_space,'column_highlight_on_hover'=>$hover_highlight,'is_responsive'=>$is_responsive, 'column_min_width'=>$column_min_width,'column_max_width'=>$column_max_width,'hide_caption_column'=>$hide_caption_column,'column_opacity' => $column_opacity,'all_column_width'=>$all_column_width);
	
		$is_animation = @$_POST['is_animation'];
		$visible_columns = @$_POST['visible_columns'];
		$scroll_column = @$_POST['column_to_scroll'];
		$is_navigation = @$_POST['is_navigation'];
		$is_autoplay = @$_POST['is_autoplay'];
		$sliding_effect = @stripslashes_deep($_POST['sliding_effect']);
		$transition_speed = @$_POST['slide_transition_speed'];
		$hide_caption_animation = @stripslashes_deep($_POST['hide_caption_animation']);
		$navigation_style = @stripslashes_deep($_POST['navigation_style']);
		$easing_effect = @stripslashes_deep($_POST['easing_effect']);
		$is_pagination = @$_POST['is_pagination'];
		$pagination_style = @stripslashes_deep($_POST['pagination_style']);
		$pagination_position = @stripslashes_deep($_POST['pagination_position']);
		$infinite 	= @$_POST['is_infinite'];
		$pagi_nav_btn = @$_POST['pagination_navigation_buttons'];
		
		$column_animation = array( 'is_animation'=>$is_animation, 'visible_column'=>$visible_columns, 'scrolling_columns'=>$scroll_column, 'navigation'=>$is_navigation, 'autoplay'=>$is_autoplay,'sliding_effect'=>$sliding_effect, 'transition_speed'=>$transition_speed, 'hide_caption'=> $hide_caption_animation, 'navigation_style'=>$navigation_style,'easing_effect'=>$easing_effect, 'is_pagination'=>$is_pagination, 'pagination_style'=>$pagination_style, 'pagination_position'=>$pagination_position, 'is_infinite'=>$infinite,'pagi_nav_btn'=>$pagi_nav_btn );
		
		$tooltip_bgcolor   = @stripslashes_deep($_POST['tooltip_bgcolor']);
		$tooltip_txt_color = @stripslashes_deep($_POST['tooltip_txtcolor']);
		$tooltip_animation = @stripslashes_deep($_POST['tooltip_animation_style']);
		$tooltip_position  = @stripslashes_deep($_POST['tooltip_position']);
		$tooltip_width 	   = @$_POST['tooltip_width'];
		$tooltip_style	   = @$_POST['tooltip_style'];
		$tooltip_font_family = @stripslashes_deep($_POST['tooltip_font_family']);
		$tooltip_font_size = @$_POST['tooltip_font_size'];
		$tooltip_font_style = @$_POST['tooltip_font_style'];
		
		$tooltip_setting = array( 'background_color'=>$tooltip_bgcolor, 'text_color'=>$tooltip_txt_color, 'animation'=>$tooltip_animation, 'position'=>$tooltip_position, 'tooltip_width'=>$tooltip_width, 'style'=>$tooltip_style,'tooltip_font_family'=>$tooltip_font_family,'tooltip_font_size'=>$tooltip_font_size,'tooltip_font_style'=>$tooltip_font_style );
		
		$tab_general_opt = array( 'template_setting'=>$template_setting, 'font_settings'=>$font_setting, 'column_settings'=>$column_setting, 'column_animation'=>$column_animation, 'tooltip_settings'=>$tooltip_setting, 'general_settings'=>$general_settings,'button_settings'=>$button_settings);
		
		$general_opt = maybe_serialize($tab_general_opt);
		
		//for table options
		$sql_results 	= $wpdb->get_results( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice_options WHERE table_id = %d", $table_id) );
		$table_opt 		= $sql_results[0]->table_options;
		$uns_table_opt 	= maybe_unserialize($table_opt);
		$table_columns 	= $uns_table_opt['columns'];
				
		if($total > 0)
		{
			$query_results = $wpdb->query( $wpdb->prepare( 'UPDATE '.$wpdb->prefix.'arp_arprice SET table_name = %s, general_options= %s WHERE ID = %d',$main_table_title,$general_opt, $table_id ) );
			// AFTER UPDATE PRICING TABLE
			
			do_action('arp_after_update_pricing_table', $table_id,$_POST);
    		do_action('arp_after_update_pricing_table'.$table_id, $table_id, $_POST);
			
    		$query_results = apply_filters('arp_change_values_after_update_pricing_table', $table_id,$query_results,$_POST);
			
			if( !isset($_POST['is_tbl_preview']) )
				$wpdb->update($wpdb->prefix.'arp_arprice', array('status' =>'published'), array('ID'=>$table_id));
			
			if($total > 1)
			{
				for($i = 0; $i <= $total; $i++)
				{
					if( !in_array( $i,$new_id ) )
						continue;
					$Title = 'column_'.$i;
					$column_width = @$_POST['column_width_'.$i];
					$column_title = @stripslashes_deep($_POST['column_title_'.$i]);
					$column_desc = @stripslashes_deep($_POST['arp_column_description_'.$i]);
					$cstm_rbn_txt = @stripslashes_deep($_POST['arp_custom_ribbon_txt_'.$i]);
					$column_highlight = @$_POST['column_highlight_'.$i];
					
					$caption = isset($_POST['caption_column_'.$i]) ? $_POST['caption_column_'.$i] : 0;
					$show_column 	= isset($_POST['show_column_'.$i]) ? 1 : 0;
					$header_shortcode = @stripslashes_deep($_POST['additional_shortcode_'.$i]);
					$html_content 	= @stripslashes_deep($_POST['html_content_'.$i]);
					$price_text		= @stripslashes_deep($_POST['price_text_'.$i]);
					$price_label	= @stripslashes_deep($_POST['price_label_'.$i]);
					$gmap_marker	= @$_POST['gmap_marker_'.$i];
					$total_rows 	= @$_POST['total_rows_'.$i];
					
					$column_ribbon_style	= @stripslashes_deep($_POST['arp_ribbon_style_'.$i]);
					$column_ribbon_position = @stripslashes_deep($_POST['arp_ribbon_position_'.$i]);
					$column_ribbon_bgcolor	= @stripslashes_deep($_POST['arp_ribbon_bgcol_'.$i]);
					$column_ribbon_txtcolor = @stripslashes_deep($_POST['arp_ribbon_textcol_'.$i]);
					$column_ribbon_content  = @stripslashes_deep($_POST['arp_ribbon_content_'.$i]);
					
					$header_font_family =  @stripslashes_deep($_POST['header_font_family_'.$i]);
					$header_font_size =  @$_POST['header_font_size_'.$i];
					$header_font_style =  @$_POST['header_font_style_'.$i];
					$header_font_color  =  @stripslashes_deep($_POST['header_font_color_'.$i]);
					
					$header_style_bold = @$_POST['header_style_bold_'.$i];
					$header_style_italic = @$_POST['header_style_italic_'.$i];
					$header_style_decoration = @$_POST['header_style_decoration_'.$i];
					
					$price_font_family = @stripslashes_deep($_POST['price_font_family_'.$i]);
					$price_font_size = @$_POST['price_font_size_'.$i];
					$price_font_style = @$_POST['price_font_style_'.$i];
					$price_font_color = @stripslashes_deep($_POST['price_font_color_'.$i]);
					
					$price_label_style_bold = @$_POST['price_label_style_bold_'.$i];
					$price_label_style_italic = @$_POST['price_label_style_italic_'.$i];
					$price_label_style_decoration = @$_POST['price_label_style_decoration_'.$i];
					
					
					$price_text_font_family = @stripslashes_deep($_POST['price_text_font_family_'.$i]);
					$price_text_font_size = @$_POST['price_text_font_size_'.$i];
					$price_text_font_style = @$_POST['price_text_font_style_'.$i];
					$price_text_font_color = @stripslashes_deep($_POST['price_text_font_color_'.$i]);
					
					$price_text_style_bold = @$_POST['price_text_style_bold_'.$i];
					$price_text_style_italic = @$_POST['price_text_style_italic_'.$i];
					$price_text_style_decoration = @$_POST['price_text_style_decoration_'.$i];
					
					
					$column_description_font_family = @stripslashes_deep($_POST['column_description_font_family_'.$i]);
					$column_description_font_size = @$_POST['column_description_font_size_'.$i];
					$column_description_font_style = @$_POST['column_description_font_style_'.$i];
					$column_description_font_color = @stripslashes_deep($_POST['column_description_font_color_'.$i]);
					
					$column_description_style_bold = @$_POST['column_description_style_bold_'.$i];
					$column_description_style_italic = @$_POST['column_description_style_italic_'.$i];
					$column_description_style_decoration = @$_POST['column_description_style_decoration_'.$i];
					
					$content_font_family = @stripslashes_deep($_POST['content_font_family_'.$i]);
					$content_font_size = @$_POST['content_font_size_'.$i];
					$content_font_color = @stripslashes_deep($_POST['content_font_color_'.$i]);
					$content_font_style = @$_POST['content_font_style_'.$i];
					
					$body_li_style_bold = @$_POST['body_li_style_bold_'.$i];
					$body_li_style_italic = @$_POST['body_li_style_italic_'.$i];
					$body_li_style_decoration = @$_POST['body_li_style_decoration_'.$i];
					
					$content_label_font_family = @stripslashes_deep($_POST['content_label_font_family_'.$i]);
					$content_label_font_size = @$_POST['content_label_font_size_'.$i];
					$content_label_font_color = @stripslashes_deep($_POST['content_label_font_color_'.$i]);
					$content_label_font_style = @$_POST['content_label_font_style_'.$i];
					
					$body_label_style_bold = @$_POST['body_label_style_bold_'.$i];
					$body_label_style_italic = @$_POST['body_label_style_italic_'.$i];
					$body_label_style_decoration = @$_POST['body_label_style_decoration_'.$i];
					
					$button_font_family = @stripslashes_deep($_POST['button_font_family_'.$i]);
					$button_font_size = @$_POST['button_font_size_'.$i];
					$button_font_color = @stripslashes_deep($_POST['button_font_color_'.$i]);
					$button_font_style = @$_POST['button_font_style_'.$i];
					
					$button_style_bold = @$_POST['button_style_bold_'.$i];
					$button_style_italic = @$_POST['button_style_italic_'.$i];
					$button_style_decoration = @$_POST['button_style_decoration_'.$i];
					
					
					$second_button_font_family = @stripslashes_deep($_POST['second_button_font_family_'.$i]);
					$second_button_font_size = @$_POST['second_button_font_size_'.$i];
					$second_button_font_style = @$_POST['second_button_font_color_'.$i];
					$second_button_font_color = @stripslashes_deep($_POST['second_button_font_color_'.$i]);
					
					$row = array();
					if( $total_rows > 0 )
					{
						for($j = 0; $j < $total_rows; $j++)
						{
							$row_title 		= 'row_'.$j;
							$row_label 		= @stripslashes_deep($_POST['row_'.$i.'_label_'.$j]);
							$row_des_align 	= @stripslashes_deep($_POST['row_'.$i.'_description_text_alignment_'.$j]);
							$row_des 		= @stripslashes_deep($_POST['row_'.$i.'_description_'.$j]);
							$row_tooltip 	= @stripslashes_deep($_POST['row_'.$i.'_tooltip_'.$j]);
							
							$row[$row_title] = array('row_des_txt_align'=>$row_des_align, 'row_description'=>$row_des, 'row_tooltip'=>$row_tooltip,'row_label'=>$row_label);
							
							unset($_POST['row_'.$i.'_description_text_alignment_'.$j]);
							unset($_POST['row_'.$i.'_description_'.$j]);
							unset($_POST['row_'.$i.'_tooltip_'.$j]);
							
						}
					}
					$body_text_alignment = @$_POST['body_text_alignment_'.$i];
					$btn_size 	= @$_POST['button_size_'.$i];
					$btn_type 	= @$_POST['button_type_'.$i];
					$btn_text 	= @stripslashes_deep($_POST['btn_content_'.$i]);
					$paypal_btn = @stripslashes_deep($_POST['paypal_code_'.$i]);
					$btn_link 	= @stripslashes_deep($_POST['btn_link_'.$i]);
					$btn_img 	= @stripslashes_deep($_POST['btn_img_url_'.$i]);
					$btn_img_height	= @$_POST['button_img_height_'.$i];
					$btn_img_width 	= @$_POST['button_img_width_'.$i];
					$btn_s_size = @$_POST['second_button_size_'.$i];
					$btn_s_type = @$_POST['second_button_type_'.$i];
					$btn_s_text = @stripslashes_deep($_POST['second_btn_content_'.$i]);
					$paypal_s_btn = @stripslashes_deep($_POST['second_paypal_code_'.$i]);
					$btn_s_link = @stripslashes_deep($_POST['second_btn_link_'.$i]);
					$btn_s_img = @stripslashes_deep($_POST['second_btn_img_url_'.$i]);
					$btn_s_img_height = @$_POST['second_button_img_height_'.$i];
					$btn_s_img_width = @$_POST['second_button_img_width_'.$i];
					$s_is_new_window = @$_POST['second_new_window_'.$i];
					$is_new_window 	= @$_POST['new_window_'.$i];
					
					if( !@$table_columns[ $Title ]['row_order'] || !is_array(@$table_columns[ $Title ]['row_order']) )
					{
						@parse_str($_POST[$Title.'_row_order'], $col_row_order);
						$row_order= @$col_row_order;
					}
					else
						$row_order= @$table_columns[ $Title ]['row_order']; 
					
					$ribbon_settings = array(
						'arp_ribbon' 			=> $column_ribbon_style,
						'arp_ribbon_bgcol' 		=> $column_ribbon_bgcolor,
						'arp_ribbon_txtcol' 	=> $column_ribbon_txtcolor,
						'arp_ribbon_position' 	=> $column_ribbon_position,
						'arp_ribbon_content'	=> $column_ribbon_content,
					);
					
					$column[$Title] = array( 
										'package_title'			=> $column_title,
										'column_width'			=> $column_width,
										'is_caption'			=> $caption,
										'column_description'	=> $column_desc,
										'custom_ribbon_txt' 	=> $cstm_rbn_txt,
										'column_highlight'		=> $column_highlight,
										'is_hidden'				=> $show_column,
										'arp_header_shortcode'	=> $header_shortcode,
										'html_content'			=> $html_content,
										'price_text'			=> $price_text,
										'price_label'			=> $price_label,
										'gmap_marker'			=> $gmap_marker,
										'body_text_alignment'	=> $body_text_alignment,
										'rows'					=> $row,
										'button_size'			=> $btn_size,
										'button_type'			=> $btn_type,
										'button_text'			=> $btn_text,
										'paypal_code'			=> $paypal_btn,
										'button_url'			=> $btn_link,
										'btn_img'				=> $btn_img,
										'btn_img_height'		=> $btn_img_height,
										'btn_img_width'			=> $btn_img_width,
										'button_s_size'			=> $btn_s_size,
										'button_s_type'			=> $btn_s_type,
										'button_s_text'			=> $btn_s_text,
										'paypal_s_btn'			=> $paypal_s_btn,
										'button_s_link'			=> $btn_s_link,
										'button_s_img'			=> $btn_s_img,
										'button_s_img_height'	=> $btn_s_img_height,
										'button_s_img_width'	=> $btn_s_img_width,
										's_is_new_window'		=> $s_is_new_window,
										'is_new_window'			=> $is_new_window,
										'ribbon_setting'		=> $ribbon_settings,
										'header_font_family'	=> $header_font_family,
										'header_font_size'		=> $header_font_size,
										'header_font_style'		=> $header_font_style,
										'header_font_color'		=> $header_font_color,
										
										'header_style_bold'     => $header_style_bold,
										'header_style_italic'   => $header_style_italic,
										'header_style_decoration' => $header_style_decoration,
										
										'price_font_family'		=> $price_font_family,
										'price_font_size'		=> $price_font_size,
										'price_font_style'		=> $price_font_style,
										'price_font_color'		=> $price_font_color,
										
										'price_label_style_bold' => $price_label_style_bold,
										'price_label_style_italic' => $price_label_style_italic,
										'price_label_style_decoration' => $price_label_style_decoration,
										
										'price_text_font_family'=> $price_text_font_family,
										'price_text_font_size'	=> $price_text_font_size,
										'price_text_font_style' => $price_text_font_style,
										'price_text_font_color' => $price_text_font_color,
										
										'price_text_style_bold' => $price_text_style_bold,
										'price_text_style_italic' => $price_text_style_italic,
										'price_text_style_decoration' => $price_text_style_decoration,
										
										'content_font_family'	=> $content_font_family,
										'content_font_size'		=> $content_font_size,
										'content_font_style' 	=> $content_font_style,
										'content_font_color'	=> $content_font_color,
										
										'body_li_style_bold'    => $body_li_style_bold,
										'body_li_style_italic'  => $body_li_style_italic,
										'body_li_style_decoration' => $body_li_style_decoration,				
										
										'content_label_font_family'	=> $content_label_font_family,
										'content_label_font_size'	=> $content_label_font_size,
										'content_label_font_style'	=> $content_label_font_style,
										'content_label_font_color'	=> $content_label_font_color,
										
										'body_label_style_bold'     => $body_label_style_bold,
										'body_label_style_italic'   => $body_label_style_italic,
										'body_label_style_decoration' => $body_label_style_decoration,
										
										
										'button_font_family'	=> $button_font_family,
										'button_font_size'		=> $button_font_size,
										'button_font_color'		=> $button_font_color,
										'button_font_style'		=> $button_font_style,
										
										'button_style_bold' 	=> $button_style_bold,
										'button_style_italic' 	=> $button_style_italic,
										'button_style_decoration' => $button_style_decoration,
										
										'second_button_font_family' => $second_button_font_family,
										'second_button_font_size'   => $second_button_font_size,
										'second_button_font_style'  => $second_button_font_style,
										'second_button_font_color'  => $second_button_font_color,
										'column_description_font_family'=> $column_description_font_family,
										'column_description_font_size'=> $column_description_font_size,
										'column_description_font_style'=>$column_description_font_style,
										'column_description_font_color'=>$column_description_font_color,
										
										'column_description_style_bold'=>$column_description_style_bold,
										'column_description_style_italic'=>$column_description_style_italic,
										'column_description_style_decoration'=>$column_description_style_decoration,
										);
				}
			}
			else
			{
				$Title = 'column_0';
				$column_width 	= $_POST['column_width_0'];
				$column_title 	= stripslashes_deep($_POST['column_title_0']);
				$column_highlight = $_POST['column_highlight_0'];
				$column_desc = stripslashes_deep($_POST['arp_column_description_0']);
				$cstm_rbn_txt = stripslashes_deep($_POST['arp_custom_ribbon_txt_0']);
			
				
				$column_ribbon_style	= stripslashes_deep($_POST['arp_ribbon_style_0']);
				$column_ribbon_position = stripslashes_deep($_POST['arp_ribbon_position_0']);
				$column_ribbon_bgcolor	= stripslashes_deep($_POST['arp_ribbon_bgcol_0']);
				$column_ribbon_txtcolor = stripslashes_deep($_POST['arp_ribbon_textcol_0']);
				$column_ribbon_content  = stripslashes_deep($_POST['arp_ribbon_content_0']);
				
				$caption = isset($_POST['caption_column_0']) ? $_POST['caption_column_0'] : 0;
				$show_column 	= isset($_POST['show_column_0']) ? 1 : 0;
				$header_shortcode = stripslashes_deep($_POST['additional_shortcode_0']);
				$html_content 	= stripslashes_deep($_POST['html_content_0']);
				$price_text		= stripslashes_deep($_POST['price_text_0']);
				$price_label	= stripslashes_deep($_POST['price_label_0']);
				$gmap_marker	= stripslashes_deep($_POST['gmap_marker_0']);
				$total_rows 	= $_POST['total_rows_0'];
				$row = array();
				if( $total_rows > 0 )
				{
					for($j = 0; $j < $total_rows; $j++)
					{
						$row_title = 'row_'.$j;
						$row_label 		= stripslashes_deep($_POST['row_0_label_'.$j]);
						$row_des_align 	= stripslashes_deep($_POST['row_0_description_text_alignment_'.$j]);
						$row_des 		= stripslashes_deep($_POST['row_0_description_'.$j]);
						$row_tooltip 	= stripslashes_deep($_POST['row_0_tooltip_'.$j]);
						
						$row[$row_title] = array('row_des_txt_align'=>$row_des_align, 'row_description'=>$row_des, 'row_tooltip'=>$row_tooltip, 'row_label'=>$row_label);
						
						unset($_POST['row_0_description_text_alignment_'.$j]);
						unset($_POST['row_0_description_'.$j]);
						unset($_POST['row_0_tooltip_'.$j]);
					}
				}
				$body_text_alignemnt = $_POST['body_text_alignment_0'];
				$btn_size 	= $_POST['button_size_0'];
				$btn_type 	= $_POST['button_type_0'];
				$btn_text 	= stripslashes_deep($_POST['btn_content_0']);
				$paypal_btn = stripslashes_deep($_POST['paypal_code_0']);
				$btn_link 	= stripslashes_deep($_POST['btn_link_0']);
				$btn_img 	= stripslashes_deep($_POST['btn_img_url_0']);
				$btn_img_height = $_POST['button_img_height_0'];
				$btn_img_width 	= $_POST['button_img_width_0'];
				$btn_s_size = $_POST['second_button_size_0'];
				$btn_s_type = $_POST['second_button_type_0'];
				$btn_s_text = stripslashes_deep($_POST['second_btn_content_0']);
				$paypal_s_btn = stripslashes_deep($_POST['second_paypal_code_0']);
				$btn_s_link = stripslashes_deep($_POST['second_btn_link_0']);
				$btn_s_img = stripslashes_deep($_POST['second_btn_img_url_0']);
				$btn_s_img_height = $_POST['second_button_img_height_0'];
				$btn_s_img_width = $_POST['second_button_img_width_0'];
				$s_is_new_window = $_POST['second_new_window_0'];
				$is_new_window 	= $_POST['new_window_0'];
				
				$header_font_family =  stripslashes_deep($_POST['header_font_family_0']);
				$header_font_size =  $_POST['header_font_size_0'];
				$header_font_style =  $_POST['header_font_style_0'];
				$header_font_color  =  stripslashes_deep($_POST['header_font_color_0']);
				
				$header_style_bold = $_POST['header_style_bold_0'];
				$header_style_italic = $_POST['header_style_italic_0'];
				$header_style_decoration = $_POST['header_style_decoration_0'];
				
				
				$price_font_family = stripslashes_deep($_POST['price_font_family_0']);
				$price_font_size = $_POST['price_font_size_0'];
				$price_font_style = $_POST['price_font_style_0'];
				$price_font_color = stripslashes_deep($_POST['price_font_color_0']);
				
				$price_label_style_bold = $_POST['price_label_style_bold_0'];
				$price_label_style_italic = $_POST['price_label_style_italic_0'];
				$price_label_style_decoration = $_POST['price_label_style_decoration_0'];
				
				
				$price_text_font_family = stripslashes_deep($_POST['price_text_font_family_0']);
				$price_text_font_size = $_POST['price_text_font_size_0'];
				$price_text_font_style = $_POST['price_text_font_style_0'];
				$price_text_font_color = stripslashes_deep($_POST['price_text_font_color_0']);
				
				$price_text_style_bold = $_POST['price_text_style_bold_0'];
				$price_text_style_italic = $_POST['price_text_style_italic_0'];
				$price_text_style_decoration = $_POST['price_text_style_decoration_0'];
				
				$column_description_font_family = stripslashes_deep($_POST['column_description_font_family_0']);
				$column_description_font_size = $_POST['column_description_font_size_0'];
				$column_description_font_style = $_POST['column_description_font_style_0'];
				$column_description_font_color = stripslashes_deep($_POST['column_description_font_color_0']);
				
				$column_description_style_bold = $_POST['column_description_style_bold_0'];
				$column_description_style_italic = $_POST['column_description_style_italic_0'];
				$column_description_style_decoration = $_POST['column_description_style_decoration_0'];
				
				$content_font_family = stripslashes_deep($_POST['content_font_family_0']);
				$content_font_size = $_POST['content_font_size_0'];
				$content_font_color = stripslashes_deep($_POST['content_font_color_0']);
				$content_font_style = $_POST['content_font_style_0'];
				
				$body_li_style_bold = $_POST['body_li_style_bold_0'];
				$body_li_style_italic = $_POST['body_li_style_italic_0'];
				$body_li_style_decoration = $_POST['body_li_style_decoration_0'];
				
				$content_label_font_family = stripslashes_deep( $_POST['content_label_font_family_0']);
				$content_label_font_size = $_POST['content_label_font_size_0'];
				$content_label_font_color = stripslashes_deep($_POST['content_label_font_color_0']);
				$content_label_font_style = $_POST['content_label_font_style_0'];
				
				$body_label_style_bold = $_POST['body_label_style_bold_0'];
				$body_label_style_italic = $_POST['body_label_style_italic_0'];
				$body_label_style_decoration = $_POST['body_label_style_decoration_0'];
				
				$button_font_family = stripslashes_deep($_POST['button_font_family_0']);
				$button_font_size = $_POST['button_font_size_0'];
				$button_font_color = stripslashes_deep($_POST['button_font_color_0']);
				$button_font_style = $_POST['button_font_style_0'];
				
				$button_style_bold = $_POST['button_style_bold_0'];
				$button_style_italic = $_POST['button_style_italic_0'];
				$button_style_decoration = $_POST['button_style_decoration_0'];
				
				$second_button_font_family = stripslashes_deep($_POST['second_button_font_family_0']);
				$second_button_font_size = $_POST['second_button_font_size_0'];
				$second_button_font_style = $_POST['second_button_font_color_0'];
				$second_button_font_color = stripslashes_deep($_POST['second_button_font_color_0']);
				
				if( !$table_columns[ $Title ]['row_order'] || !is_array($table_columns[ $Title ]['row_order']) )
				{
					@parse_str($_POST[$Title.'_row_order'], $col_row_order);
					$row_order= $col_row_order;
				}
				else
					$row_order= $table_columns[ $Title ]['row_order'];
				
				$ribbon_settings = array(
					'arp_ribbon' 			=> $column_ribbon_style,
					'arp_ribbon_bgcol' 		=> $column_ribbon_bgcolor,
					'arp_ribbon_txtcol' 	=> $column_ribbon_txtcolor,
					'arp_ribbon_position' 	=> $column_ribbon_position,
					'arp_ribbon_content'	=> $column_ribbon_content,
				);
					
				$column[$Title] = array( 
									'package_title'			=> $column_title,
									'column_width'			=> $column_width,
									'is_caption'			=> $caption,
									'column_description' 	=> $column_desc,
									'custom_ribbon_txt' 	=> $cstm_rbn_txt,
									'column_highlight' 		=> $column_highlight,
									'is_hidden'				=> $show_column,
									'arp_header_shortcode'	=> $header_shortcode,
									'html_content'			=> $html_content,
									'price_text'			=> $price_text,
									'price_label'			=> $price_label,
									'gmap_marker'			=> $gmap_marker,
									'body_text_alignment'	=> $body_text_alignemnt,
									'rows'					=> $row,
									'button_size'			=> $btn_size,
									'button_type'			=> $btn_type,
									'button_text'			=> $btn_text,
									'paypal_code'			=> $paypal_btn,
									'button_url'			=> $btn_link,
									'btn_img'				=> $btn_img,
									'btn_img_height'		=> $btn_img_height,
									'btn_img_width'			=> $btn_img_width,
									'button_s_size'			=> $btn_s_size,
									'button_s_type'			=> $btn_s_type,
									'button_s_text'			=> $btn_s_text,
									'paypal_s_code'			=> $paypal_s_btn,
									'button_s_link'			=> $btn_s_link,
									'button_s_img'			=> $btn_s_img,
									'button_s_img_height'	=> $btn_s_img_height,
									'button_s_img_width'	=> $btn_s_img_width,
									's_is_new_window'		=> $s_is_new_window,
									'is_new_window'			=> $is_new_window,
									'ribbon_setting'		=> $ribbon_settings,
									'header_font_family'	=> $header_font_family,
									'header_font_size'		=> $header_font_size,
									'header_font_style'		=> $header_font_style,
									'header_font_color'		=> $header_font_color,
									
									'header_style_bold'     => $header_style_bold,
									'header_style_italic'   => $header_style_italic,
									'header_style_decoration' => $header_style_decoration,
									
									'price_font_family'		=> $price_font_family,
									'price_font_size'		=> $price_font_size,
									'price_font_style'		=> $price_font_style,
									'price_font_color'		=> $price_font_color,
									
									'price_label_style_bold' => $price_label_style_bold,
									'price_label_style_italic' => $price_label_style_italic,
									'price_label_style_decoration' => $price_label_style_decoration,
									
									'price_text_font_family'=> $price_text_font_family,
									'price_text_font_size'	=> $price_text_font_size,
									'price_text_font_style' => $price_text_font_style,
									'price_text_font_color' => $price_text_font_color,
									
									'price_text_style_bold' => $price_text_style_bold,
									'price_text_style_italic' => $price_text_style_italic,
									'price_text_style_decoration' => $price_text_style_decoration,
									
									'content_font_family'	=> $content_font_family,
									'content_font_size'		=> $content_font_size,
									'content_font_style' 	=> $content_font_style,
									
									'body_li_style_bold'    => $body_li_style_bold,
									'body_li_style_italic'  => $body_li_style_italic,
									'body_li_style_decoration' => $body_li_style_decoration,
									
									'content_label_font_family' => $content_label_font_family,
									'content_label_font_size'	=> $content_label_font_size,
									'content_label_font_style'	=> $content_label_font_style,
									'content_label_font_color'	=> $content_label_font_color,
									'content_font_color'	=> $content_font_color,
									
									'body_label_style_bold'     => $body_label_style_bold,
									'body_label_style_italic'   => $body_label_style_italic,
									'body_label_style_decoration' => $body_label_style_decoration,
									
									'button_font_family'	=> $button_font_family,
									'button_font_size'	=> $button_font_size,
									'button_font_color'	=> $button_font_color,
									'button_font_style'	=> $button_font_style,
									
									'button_style_bold' 	=> $button_style_bold,
									'button_style_italic' 	=> $button_style_italic,
									'button_style_decoration' => $button_style_decoration,
									
									'second_button_font_family' => $second_button_font_family,
									'second_button_font_size'   => $second_button_font_size,
									'second_button_font_style'  => $second_button_font_style,
									'second_button_font_color'  => $second_button_font_color,
									'column_description_font_family'=> $column_description_font_family,
									'column_description_font_size'=> $column_description_font_size,
									'column_description_font_style'=>$column_description_font_style,
									'column_description_font_color'=>$column_description_font_color,
									
									'column_description_style_bold'=>$column_description_style_bold,
									'column_description_style_italic'=>$column_description_style_italic,
									'column_description_style_decoration'=>$column_description_style_decoration,
									
									);
				
			}
		}
		else
		{
			return;
		}
			
		$uns_table_opt['columns'] = $column;
				
		$table_options = maybe_serialize($uns_table_opt);
				
		$ins = $wpdb->query( $wpdb->prepare( 'UPDATE '.$wpdb->prefix.'arp_arprice_options SET table_options = %s WHERE table_id = %d',$table_options,$table_id )	);
		
		// Query for delete preview data option start
		$all_previewoption	= get_option('arp_previewoptions');
		$all_previewoption	= maybe_unserialize($all_previewoption);
		if( $all_previewoption && count($all_previewoption) > 0 )
		{
			$option_to_delete	= array();
			$day_ago_time 	= strtotime("-2 days");
			$all_previewoption_db	= $all_previewoption;
			foreach($all_previewoption as $opt_name => $opt_date )
			{
				if( isset($opt_name) && $opt_name !='' && $opt_name != '0' && $opt_date <= $day_ago_time )
				{
					$option_to_delete[]	=  $opt_name;
					unset($all_previewoption_db[$opt_name]);
				}
			}	
			if( $option_to_delete && count($option_to_delete) > 0 )
			{
				update_option('arp_previewoptions', $all_previewoption_db);		// Update Remaining options
				$option_to_delete_str	= @implode("','", $option_to_delete);
				$option_to_delete_str 	= "'".$option_to_delete_str."'"; 
				$wpdb->query("DELETE FROM ".$wpdb->options." WHERE option_name IN (".$option_to_delete_str.")");
			}	
		}
		// Query for delete preview data option end
							
		die();		
	}
		
			
	function create($values = array())
	{
		global $wpdb;
	
		$form_name = $values['name'];
		$dt = current_time( 'mysql' );
		$status = $values['status'];
		$template = $values['is_template'];
		$template_name = $values['template_name'];
		$is_animated = $values['is_animated'];
		$options = $values['options'];
		
		$wpdb->query( $wpdb->prepare( "INSERT INTO ".$wpdb->prefix."arp_arprice (table_name,template_name,general_options,is_template,is_animated,status,create_date) VALUES (%s,%d,%s,%d,%d,%s,%s) ", $form_name,$template_name,$options,$template,$is_animated,$status,$dt ) );
		
		return $wpdb->insert_id;
	}
	
	function option_create($table_id,$opts)
	{
		global $wpdb;
		$wpdb->query( $wpdb->prepare( "INSERT INTO ".$wpdb->prefix."arp_arprice_options(table_id,table_options) VALUES (%d,%s)",$table_id,$opts ) );
	}
	
	
	function get_direct_link($tbl_id=''){

        $target_url = esc_url( get_home_url() . '/index.php?plugin=arprice&arpaction=preview&tbl='.$tbl_id);

        return $target_url;
    }
	
	function parse_standalone_request()
	{
		global $arprice_form;
		$plugin	= isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';  

        $action = isset($_REQUEST['arpaction']) ? $_REQUEST['arpaction'] : ''; 

        if( !empty($plugin) and $plugin == 'arprice' and !empty($action) and $action == 'preview' ){
         	
			$table_id = isset($_REQUEST['tbl']) ? $_REQUEST['tbl'] : ''; 	 
		  	$arprice_form->preview_table($table_id);
          	exit;
        }
		
	}
		
	function preview_table($table_id)
	{

        @header("Content-Type: text/html; charset=utf-8");

		@header("Cache-Control: no-cache, must-revalidate, max-age=0");
		
		$is_tbl_preview = 1;
								
        require(PRICINGTABLE_VIEWS_DIR.'/arprice_preview.php');   	
	}
	
	
	function edit_template()
	{
	global $wpdb;
		$arpaction_new = 'new';	 
		if( isset($_REQUEST['template_type']) and $_REQUEST['template_type'] == 'new' )
		{
			//for new table
		}
		else if( isset($_REQUEST['template_type']) and $_REQUEST['template_type'] != '' )
		{
			$template_id = $_REQUEST['template_type'];
			
			//get template details
			$tbl_res = $wpdb->get_row( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice WHERE ID = %d", $template_id) ); 
			
			$results = $wpdb->get_row( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice_options WHERE table_id = %d", $tbl_res->ID) );
						
			$new_values = array();
			
			$new_values['table_name'] 		= isset($tbl_res->table_name) ? $tbl_res->table_name : '';			
			$new_values['general_options'] 	= isset($tbl_res->general_options) ? $tbl_res->general_options : '';
			$new_values['is_template'] 		= 0;
			$new_values['status'] 			= 'draft';
			$new_values['create_date'] 		= current_time('mysql');
			
			$res = $wpdb->insert($wpdb->prefix."arp_arprice", $new_values);
			$table_id = $wpdb->insert_id; 
			
			$new_values = array();
			$new_values['table_id'] 		= $table_id;
			$new_values['table_options'] 	= isset($results->table_options) ? $results->table_options : '';
			$res = $wpdb->insert($wpdb->prefix."arp_arprice_options", $new_values);
			
			//update css
			$general_option = maybe_unserialize( $tbl_res->general_options ); 
			
			$general_font_settings 	= isset($general_option['font_settings']) ? $general_option['font_settings'] : array(); 
			
			$general_column_settings= isset($general_option['font_settings']) ? $general_option['column_settings'] : array(); 
			
			$general_tooltip_settings= isset($general_option['tooltip_settings']) ? $general_option['tooltip_settings'] : array();  
			
			$new_values = array();
						
			$arpaction_new = 'edit';
				
		}
			
		if(file_exists(PRICINGTABLE_VIEWS_DIR.'/arprice_listing_editor.php'))
			include(PRICINGTABLE_VIEWS_DIR.'/arprice_listing_editor.php');
			
	}
	
	function arp_youtube_video_shortcode( $atts )
	{	
	
		$video_id 	= isset( $atts['id'] ) ? $atts['id'] : '';	
		$autoplay 	= ( isset( $atts['autoplay'] ) and $atts['autoplay'] == 1 ) ? '1' : '';
		$https 		= is_ssl() ? 's' : '';
		$width 		= '100%';
		$height		= ( isset( $atts['height'] ) and $atts['height'] != '' ) ? $atts['height'] : 'auto';	
		$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';
		
		return '<div class="arp_youtube_video"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'><iframe src="http' . $https . '://www.youtube.com/embed/' . $video_id . '?wmode=opaque&amp;controls=1&amp;showinfo=1&amp;autohide=1&amp;rel=0&amp;autoplay=' . $autoplay . '" width="' . $width . '" height="' . $height . '" marginheight="0" marginwidth="0" frameborder="0"></iframe></div>';
				
	}
	
	function arp_vimeo_video_shortcode( $atts )
	{
		
		$video_id 	= isset( $atts['id'] ) ? $atts['id'] : '';	
		$autoplay 	= ( isset( $atts['autoplay'] ) and $atts['autoplay'] == 1 ) ? '1' : '0';
		$https 		= is_ssl() ? 's' : '';
		$color		= isset( $atts['color'] ) ? $atts['color'] : '';
		$width 		= '100%';
		$height		= ( isset( $atts['height'] ) and $atts['height'] != '' ) ? $atts['height'] : 'auto';	
		$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';
		
		return '<div class="arp_vimeo_video"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'><iframe src="http://player.vimeo.com/video/' . esc_attr( $video_id ) . '?title=0&amp;byline=0&amp;portrait=0&amp;autohide=1&amp;color=' . $color . '&amp;autoplay=' . $autoplay . '" width="' . $width . '" height="' . $height . '" marginheight="0" marginwidth="0" frameborder="0"></iframe></div>';
		
	}
	
	function arp_screenr_video_shortcode( $atts )
	{
		$video_id 	= isset( $atts['id'] ) ? $atts['id'] : '';	
		$width 		= '100%';
		$height		= ( isset( $atts['height'] ) and $atts['height'] != '' ) ? $atts['height'] : 'auto';
		$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';
		
		return '<div class="arp_screenr_video"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'><iframe src="http://www.screenr.com/embed/' . esc_attr( $video_id ) . '" width="' . $width . '" height="' . $height . '" marginheight="0" marginwidth="0" frameborder="0"></iframe></div>';
		
	}
	
	function arp_html5_video_shortcode( $atts )
	{
		extract( shortcode_atts( array (
					'mp4' => '',
					'webm' => '',
					'ogg' => '',
					'poster' => '',
					'autoplay' => 0,
					'loop' => 0
				), $atts ) );
				
				$mp4 = $mp4 != "" ? '<source src="'.$mp4.'" type="video/mp4">' : '';
				$webm = $webm != "" ? "<source src='".$webm."' type='video/webm'>" : '';
				$ogg = $ogg != "" ? "<source src='".$ogg."' type='video/ogg'>" : '';
				$poster = $poster != "" ? $poster_src : '';
				$autoplay = $autoplay == 1 ? "autoplay='true'" : '';
				$loop = $loop == 1 ? "loop='true'" : '';
			
				return '<video controls="controls"' . ( $autoplay != '' ? $autoplay : '' ) . ( $loop != '' ? $loop : '' ) . ( $poster != '' ? ' poster="' . $poster . '"' : '' ) .'>' . $mp4 . $webm . $ogg . '<object type="application/x-shockwave-flash" data="' .PRICINGTABLE_DIR . '/js/mediaelementjs/flashmediaelement.swf">
              <param name="movie" value="' . PRICINGTABLE_DIR . '/js/mediaelementjs/flashmediaelement.swf" />
              <param name="flashvars" value="controls=true&poster=' . $poster . '&file=' . $mp4 . '" />
              <img src="' . $poster . '" title="No video playback capabilities" />
	          </object></video>';
				 
	}
	
	function arp_html5_audio_shortcode( $atts )
	{
		extract( shortcode_atts(array(
			'mp3' => '',
			'wav' => '',
			'ogg' => '',
			'autoplay' => 0,
			'loop' => 0
		), $atts ) );
		
		$autoplay = $autoplay == 1 ? 'autoplay="true"' : '';
		$loop = $loop == 1 ? 'loop="yes"' : '';
		$mp3 = $mp3 != "" ? "<source src='". $mp3 . "' type='audio/mpeg'>" :'';
		$ogg = $ogg != '' ? '<source src="'. $ogg . '" type="audio/ogg">' : '';
		$wav = $wav != '' ? '<source src="'. $wav . '" type="audio/wav">' : '';
		
		return '<audio controls="controls"' . ( $autoplay != '' ? $autoplay : '' ) . ( $loop != '' ? $loop : '' ) . '>' . $mp3 . $ogg . $wav . '</audio>';
	}
	
	function arp_googlemap_shortcode( $atts )
	{
		extract( shortcode_atts( array( 
					'address' => '',
					'title' => '',
					'marker_image' =>'',
					'content' => NULL,
					'show_popup' => 'no',
					'zoom' => 14,
					'maptype' => 'ROADMAP',
					'width' => '100%',
					'height' => '300',
				 ), $atts ) );
				 
		$address= $address ? $address : '';
		$height = $height ? $height : '300'; 
		$popup 	= $show_popup ? true : false;
		$icon	= $marker_image ? $marker_image : '';
		$zoom	= $zoom_level ? $zoom_level : '14';
		$content= $content ? $content : '';
		$maptype= $maptype ? $maptype : 'ROADMAP';
		
		$mapdata = array();
		$mapdata['markers'][] = array ( 
			'address' 	=> $address,
			'title' 	=> $title,
			'icon' 		=> !empty( $icon ) ? array( 'image' => $icon ) : null,
			'html' 		=> isset( $content ) ? array( 
				'content' 	=> $content,
				'popup' 	=> $popup
			 ) : null,
		 );
		$mapdata['zoom'] = intval($zoom);
		$mapdata['maptype'] = $maptype;
		$mapdata['mapTypeControl'] = false;
				
		return '<div class="arp_googlemap" style="width:100%; height:' . $height . 'px;" data-map="' . esc_attr( json_encode( $mapdata ) ) . '"></div>';
	}
	
	function arp_dailymotion_video_shortcode( $atts )
	{	
	
		$video_id 	= isset( $atts['id'] ) ? $atts['id'] : '';	
		$autoplay 	= ( isset( $atts['autoplay'] ) and $atts['autoplay'] == 1 ) ? '1' : '';
		$https 		= is_ssl() ? 's' : '';
		$width 		= '100%';
		$height		= ( isset( $atts['height'] ) and $atts['height'] != '' ) ? $atts['height'] : 'auto';	
		$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';
		
		return '<div class="arp_dailymotion_video"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'><iframe src="http' . $https . '://www.dailymotion.com/embed/video/' . esc_attr( $video_id ) . '?wmode=opaque&amp;autoPlay=' . $autoplay . '" width="' . $width . '" height="' . $height . '" marginheight="0" marginwidth="0" frameborder="0"></iframe></div>';
				
	}
	
	
	function arp_metacafe_video_shortcode( $atts )
	{	
	
		$video_id 	= isset( $atts['id'] ) ? $atts['id'] : '';	
		$autoplay 	= ( isset( $atts['autoplay'] ) and $atts['autoplay'] == 1 ) ? '1' : '';
		$https 		= is_ssl() ? 's' : '';
		$width 		= '100%';
		$height		= ( isset( $atts['height'] ) and $atts['height'] != '' ) ? $atts['height'] : 'auto';	
		$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';
		
		return '<div class="arp_metacafe_video"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'><iframe src="http' . $https . '://www.metacafe.com/embed/' . $video_id . '?wmode=opaque&amp;controls=1&amp;showinfo=1&amp;autohide=1&amp;rel=0&amp;ap=' . $autoplay . '" width="' . $width . '" height="' . $height . '" marginheight="0" marginwidth="0" frameborder="0"></iframe></div>';
				
	}
	
	function arp_soundcloud_audio_shortcode( $atts )
	{	
		$audio_id 	= isset( $atts['id'] ) ? $atts['id'] : '';	
		$autoplay 	= (isset( $atts['autoplay'] ) and $atts['autoplay'] == 1 ) ? 'true' : 'false';
		$https 		= is_ssl() ? 's' : '';
		$width 		= '100%';
		$height		= ( isset( $atts['height'] ) and $atts['height'] != '' ) ? $atts['height'] : 'auto';	
		$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';
		
		return '<div class="arp_soundcloud_audio"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'><iframe src="http' . $https . '://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F' . esc_attr( $audio_id ) . '?wmode=opaque&amp;auto_play=' . $autoplay . '&amp;show_artwork=true" marginheight="0" marginwidth="0" frameborder="0"></iframe></div>';
				
	}
	function arp_mixcloud_audio_shortcode( $atts )
	{	
	
		$audio_url 	= isset( $atts['id'] ) ? $atts['id'] : '';	
		$autoplay 	= ( isset( $atts['autoplay'] ) and $atts['autoplay'] == 1 ) ? '1' : '';
		$https 		= is_ssl() ? 's' : '';
		
		$width 		= '100%';
		$height		= ( isset( $atts['height'] ) and $atts['height'] != '' ) ? $atts['height'] : 'auto';	
		$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';;
		
		return '<div class="arp_mixcloud_audio"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'><iframe src="http' . $https . '://www.mixcloud.com/widget/iframe/?feed=' . esc_attr( urlencode( trim( $audio_url, '/' ) ) ) . '%2F&amp;show_tracklist=&amp;wmode=opaque" marginheight="0" marginwidth="0" frameborder="0"></iframe></div>';
		
				
	}
	
	function arp_beatport_audio_shortcode( $atts )
	{	
	
		$audio_id 	= isset( $atts['id'] ) ? $atts['id'] : '';	
		$autoplay 	= ( isset( $atts['autoplay'] ) and $atts['autoplay'] == 1 ) ? '&amp;auto=yes' : '';
		$https 		= is_ssl() ? 's' : '';
		
		$width 		= '100%';
		$height		= ( isset( $atts['height'] ) and $atts['height'] != '' ) ? $atts['height'] : 'auto';	
		$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';;
		
		
		return '<div class="arp_beatport_audio"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'><iframe src="http' . $https . '://embed.beatport.com/player?id=' . esc_attr( $audio_id ) . '?wmode=opaque&amp;type=track' . $autoplay . '" marginheight="0" marginwidth="0" frameborder="0"></iframe></div>';
		
				
	}
	
	function arp_embed_shortcode( $atts )
	{	
	
		$embed 	= isset( $atts['embed'] ) ? $atts['embed'] : '';	
		
		return '<div class="arp_embed_video">'.html_entity_decode($embed).'</div>';
		
	}
	
	
	
	function arp_render_customcss($table_id, $general_option, $front_preview, $opts,$is_animated)
	{	
		global $arp_mainoptionsarr,$arprice_fonts,$arprice_form;
		
		$returnstring = "";
		
		$template_type = $general_option['template_setting']['template_type'];
		
		$general_font_settings 	= $general_option['font_settings']; 
		
		$general_column_settings= $general_option['column_settings']; 
		
		$general_tooltip_settings= $general_option['tooltip_settings'];
		
		$general_column_animation = $general_option['column_animation'];
		
		$general_template_settings = $general_option['template_setting'];
		
		$reference_template = $general_option['general_settings']['reference_template'];
				
		$new_values = array();
		/*echo "<pre>";
		print_r( $general_template_settings );
		echo "</pre>";*/
		
		$new_values['space_between_column'] = isset($general_column_settings['space_between_column']) ? 1 : 0;
		
		$new_values['column_space'] 		= $general_column_settings['column_space'];
		
		$new_values['highlight_column'] 	= isset($general_column_settings['highlightcolumnonhover']) ? 1 : 0;
				
		$new_values['tooltip_bg_color'] 	= $general_tooltip_settings['background_color'];
		
		$new_values['tooltip_text_color'] 	= $general_tooltip_settings['text_color'];
		
		$new_values['tooltip_style']		= isset($general_tooltip_settings['tooltip_style']) ? $general_tooltip_settings['tooltip_style'] : '';
		
		$new_values['tooltip_font_family']	= $general_tooltip_settings['tooltip_font_family'];
		
		$new_values['tooltip_font_size']	= $general_tooltip_settings['tooltip_font_size'];
		
		$new_values['tooltip_font_style']	= $general_tooltip_settings['tooltip_font_style'];
		
		$new_values['caption_style'] 		= @$general_template_settings['features']['caption_style'];
		
		$new_values['column_opacity'] 		= $general_column_settings['column_opacity'];
		
		$is_responsive 	= $general_column_settings['is_responsive'];
		
		$is_columnhover_on	= $general_column_settings['column_highlight_on_hover'];
		
		$is_columnanimation_on	= ( isset($general_column_animation['is_animation']) and $general_column_animation['is_animation'] == 'yes' ) ? 1 : 0;
		
		extract($new_values);
				
		if( is_ssl() )
			$googlefontbaseurl = "https://fonts.googleapis.com/css?family=";
		else	
			$googlefontbaseurl = "http://fonts.googleapis.com/css?family=";
			
		$default_fonts = $arprice_fonts->get_default_fonts();
		
		if( !in_array($tooltip_font_family,$default_fonts) && $tooltip_font_family != '' )
			$returnstring .= "@import url(".$googlefontbaseurl.urlencode(trim($tooltip_font_family)).");";
		
		if(is_array($opts['columns']))
		{	
		foreach($opts['columns'] as $k_col => $v_col){
			if( !in_array($v_col['header_font_family'],$default_fonts) && $v_col['header_font_family'] != '' )
				$returnstring .= "@import url(".$googlefontbaseurl.urlencode(trim($v_col['header_font_family']))."); ";
			
			if( !in_array($v_col['price_font_family'],$default_fonts) && $v_col['price_font_family'] != '' )
					$returnstring .= "@import url(".$googlefontbaseurl.urlencode(trim($v_col['price_font_family']))."); ";
					
			if( !in_array($v_col['price_text_font_family'],$default_fonts) && $v_col['price_text_font_family'] != '' )
					$returnstring .= "@import url(".$googlefontbaseurl.urlencode(trim($v_col['price_text_font_family']))."); ";
			
			if( !in_array($v_col['content_font_family'],$default_fonts) && $v_col['content_font_family'] != '' )
				$returnstring .= "@import url(".$googlefontbaseurl.urlencode(trim($v_col['content_font_family']))."); ";

			if( !in_array($v_col['button_font_family'],$default_fonts) && $v_col['button_font_family'] != '' )
				$returnstring .= "@import url(".$googlefontbaseurl.urlencode(trim($v_col['button_font_family']))."); ";
				
			if( isset($v_col['second_button_font_family']) && !in_array($v_col['second_button_font_family'],$default_fonts) && $v_col['second_button_font_family'] != '' )
				$returnstring .= "@import url(".$googlefontbaseurl.urlencode(trim($v_col['second_button_font_family']))."); ";
				
			if( isset($v_col['column_description_font_family']) && !in_array($v_col['column_description_font_family'],$default_fonts) && $v_col['column_description_font_family'] != '' )
				$returnstring .= "@import url(".$googlefontbaseurl.urlencode(trim($v_col['column_description_font_family']))."); ";
			
			if( isset($v_col['content_label_font_family']) && !in_array($v_col['content_label_font_family'],$default_fonts) && $v_col['content_label_font_family'] != '' )
				$returnstring .= "@import url(".$googlefontbaseurl.urlencode(trim($v_col['content_label_font_family']))."); ";
		}
		}
		
			
		//for header font-setting ? >        
		if( $general_option['button_settings']['button_radius'] != '' && $general_option['button_settings']['button_radius'] != 0  )
		{
			$returnstring .= ".arp_price_table_".$table_id." .bestPlanButton{
				border-radius:".$general_option['button_settings']['button_radius']."px !important;
					-moz-border-radius:".$general_option['button_settings']['button_radius']."px !important;
					-webkit-border-radius:".$general_option['button_settings']['button_radius']."px !important;
					-o-border-radius:".$general_option['button_settings']['button_radius']."px !important;
			}";
		}
		
		if(is_array($opts['columns']))
		{
		foreach( $opts['columns'] as $c=>$columns ){
		
			if( $columns['is_caption'] != 0 )
				$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .arpcolumnheader .arpcaptiontitle";
			else
				$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .arpcolumnheader .bestPlanTitle";
			
			
			
			$returnstring .= " {
			 	font-family: ".stripslashes($columns['header_font_family']).";
				font-size: ".$columns['header_font_size']."px; ";
				if( $columns['header_style_bold'] != '' )
					$returnstring .= " font-weight: ".$columns['header_style_bold'].";";
					
				if( $columns['header_style_italic'] != '' )
					$returnstring .= " font-style: ".$columns['header_style_italic'].";";
					
				if( $columns['header_style_decoration'] != '' )
					$returnstring .= " text-decoration: ".$columns['header_style_decoration'].";";
				
				
				$returnstring .= " color: ".$columns['header_font_color']."; 
			}";
			
			if( $template_type == 'normal' ){
			
				$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .arp_price_wrapper{";
					
					
					$returnstring .= "
						font-family:".stripslashes_deep($columns['price_font_family']).";
						font-size:".$columns['price_font_size']."px;";
						
				if( $columns['price_label_style_bold'] != '' )
					$returnstring .= " font-weight: ".$columns['price_label_style_bold'].";";
					
				if( $columns['price_label_style_italic'] != '' )
					$returnstring .= " font-style: ".$columns['price_label_style_italic'].";";
					
				if( $columns['price_label_style_decoration'] != '' )
					$returnstring .= " text-decoration: ".$columns['price_label_style_decoration'].";";
						
					if( isset($price_font_style) && $price_font_style )
						$returnstring .= $price_font_style;
					$returnstring .= "color:".$columns['price_font_color'].";";
				$returnstring .= "}";
				
			} else if( $template_type == 'advanced') {
			
				$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .arp_price_value{";
					$returnstring .= "
						font-family:".stripslashes_deep($columns['price_font_family']).";
						font-size:".$columns['price_font_size']."px;";

						
				if( $columns['price_label_style_bold'] != '' )
					$returnstring .= " font-weight: ".$columns['price_label_style_bold'].";";
					
				if( $columns['price_label_style_italic'] != '' )
					$returnstring .= " font-style: ".$columns['price_label_style_italic'].";";
					
				if( $columns['price_label_style_decoration'] != '' )
					$returnstring .= " text-decoration: ".$columns['price_label_style_decoration'].";";
					
						
					
					$returnstring .= "color:".$columns['price_font_color'].";";
				$returnstring .= "}";
				
				
				$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .arp_price_duration{";
					
					$returnstring .= "
						font-family:".stripslashes_deep($columns['price_text_font_family']).";
						font-size:".$columns['price_text_font_size']."px;";
						
				if( $columns['price_text_style_bold'] != '' )
					$returnstring .= " font-weight: ".$columns['price_text_style_bold'].";";
					
				if( $columns['price_text_style_italic'] != '' )
					$returnstring .= " font-style: ".$columns['price_text_style_italic'].";";
					
				if( $columns['price_text_style_decoration'] != '' )
					$returnstring .= " text-decoration: ".$columns['price_text_style_decoration'].";";
						
						
					
					$returnstring .= "color:".$columns['price_text_font_color'].";";
				$returnstring .= "}";
				


				if($reference_template  == 'arptemplate_15'){
					$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .arp_price_duration{";
						$returnstring .= "margin-top:".(($columns['price_font_size'] - $columns['price_text_font_size']) +10 )."px;";
	 				$returnstring .= "}";
				}
				
				
				
				}
			
			if( $caption_style == 'style_1' || $caption_style == 'style_2' ){
				$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .arp_opt_options li span.caption_detail";
			} else {
				$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .arp_opt_options li";
			}
			
			
			$returnstring .= "{";
			
				$returnstring .= "font-family:".stripslashes_deep($columns['content_font_family']).";";
				$returnstring .= "font-size:".$columns['content_font_size']."px;";
				
				if( $columns['body_li_style_bold'] != '' )
					$returnstring .= " font-weight: ".$columns['body_li_style_bold'].";";
					
				if( $columns['body_li_style_italic'] != '' )
					$returnstring .= " font-style: ".$columns['body_li_style_italic'].";";
					
				if( $columns['body_li_style_decoration'] != '' )
					$returnstring .= " text-decoration: ".$columns['body_li_style_decoration'].";";
					
				
				$returnstring .= "color:".$columns['content_font_color'].";";
			
			$returnstring .= "}";
			
			$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .bestPlanButton:not(.SecondBestPlanButton)";
			
			$returnstring .= "{";
			
				$returnstring .= "font-family:".stripslashes_deep($columns['button_font_family']).";";
				$returnstring .= "font-size:".$columns['button_font_size']."px;";
				
				
				//$returnstring .= "font-weight:".$button_font_weight.";";
				
				if( isset($columns['button_style_bold']) && $columns['button_style_bold'] != '' )
					$returnstring .= " font-weight: ".$columns['button_style_bold'].";";
					
				if( isset($columns['button_style_italic']) && $columns['button_style_italic'] != '' )
					$returnstring .= " font-style: ".$columns['button_style_italic'].";";
					
				if( isset($columns['button_style_decoration']) && $columns['button_style_decoration'] != '' )
					$returnstring .= " text-decoration: ".$columns['button_style_decoration'].";";
				
				
				
				$returnstring .= "color:".$columns['button_font_color'].";";
			
			$returnstring .= "}";
			
			$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .bestPlanButton.SecondBestPlanButton";
			
			if( isset($columns['second_button_font_style']) && $columns['second_button_font_style'] == 'italic' ){
				$second_button_font_weight = 'normal';
				$second_button_font_style  = 'font-style:italic;';
			} else {
				$second_button_font_style  = '';
				$second_button_font_weight = isset($columns['second_button_font_style']) ? $columns['second_button_font_style'] : "";
			}
			
			$returnstring .= "{";
				
				$returnstring .= "font-family:".stripslashes_deep( isset($columns['second_button_font_family']) ? $columns['second_button_font_family'] : "").";";
				$returnstring .= "font-size:".( isset($columns['second_button_font_size']) ? $columns['second_button_font_size'] : "" ).'px;';
				$returnstring .= "font-weight:".$second_button_font_weight.";";
				if( $second_button_font_style )
					$returnstring .= $second_button_font_style;
				$returnstring .= "color:".( isset($columns['second_button_font_color']) ? $columns['second_button_font_color'] : "" ).";";
				
			$returnstring .= "}";
			
			$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .column_description{";
			
				if( $columns['column_description_style_bold'] != '' )
					$returnstring .= " font-weight: ".$columns['column_description_style_bold'].";";
					
				if( $columns['column_description_style_italic'] != '' )
					$returnstring .= " font-style: ".$columns['column_description_style_italic'].";";
					
				if( $columns['column_description_style_decoration'] != '' )
					$returnstring .= " text-decoration: ".$columns['column_description_style_decoration'].";";
					
			
				$returnstring .= "font-family:".stripslashes_deep($columns['column_description_font_family']).";";
				$returnstring .= "font-size:".$columns['column_description_font_size'].'px;';
				$returnstring .= "color:".stripslashes_deep($columns['column_description_font_color']).";";
			
			$returnstring .= "}";
			
			$returnstring .= ".arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_".$c." .caption_li{";
				
				if( isset($columns['body_label_style_bold']) && $columns['body_label_style_bold'] != '' )
					$returnstring .= " font-weight: ".$columns['body_label_style_bold'].";";
					
				if( isset($columns['body_label_style_italic']) && $columns['body_label_style_italic'] != '' )
					$returnstring .= " font-style: ".$columns['body_label_style_italic'].";";
					
				if( isset($columns['body_label_style_decoration']) && $columns['body_label_style_decoration'] != '' )
					$returnstring .= " text-decoration: ".$columns['body_label_style_decoration'].";";
					
				
				$returnstring .= "font-family:".stripslashes_deep(isset($columns['content_label_font_family']) ? $columns['content_label_font_family'] : "").";";
				$returnstring .= "font-size:".( isset($columns['content_label_font_size']) ? $columns['content_label_font_size'] : "" ).'px;';
				$returnstring .= "color:".( isset($columns['content_label_font_color']) ? $columns['content_label_font_color'] : "" ).";";
				
				
			$returnstring .= "}";
			
		}
		}
		
        //for price font-setting       
        $returnstring .= ".arp_price_table_".$table_id." .arppricetablecolumnprice
        {
            font-family: ".stripslashes($price_font_family)." !important;
            font-size: ".$price_font_size." !important;
            font-weight: ".$price_font_weight." !important;";
            if( isset($price_font_style) && $price_font_style ) 
				$returnstring .= $price_font_style; 
            $returnstring .= " color: ".$price_font_color." !important; 
        }";
        
		if( $template_type == 'advanced' )
		{
            $returnstring .= " .arp_price_table_".$table_id." .arppricetablecolumnprice .arp_price_value{
                font-family: ".stripslashes($price_font_family)." !important;
                font-size: ".$price_font_size." !important;
                font-weight: ".$price_font_weight." !important;";
                if( isset($price_font_style) && $price_font_style ) 
					$returnstring .= $price_font_style; 
                $returnstring .= " color: ".$price_font_color." !important;
            }";
            $returnstring .= " .arp_price_table_".$table_id." .arppricetablecolumnprice .arp_price_duration{
                font-family: ".stripslashes($price_text_font_family)." !important;
                font-size: ".$price_text_font_size." !important;
                font-weight: ".$price_text_font_weight." !important;";
                if( isset($price_text_font_style) && $price_text_font_style ) 
					$returnstring .= $price_text_font_style; 
                $returnstring .= " color: ".$price_text_font_color." !important;			
            }";
		}
		
        //for tooltip 
		$returnstring .= " .arp_tooltip_".$table_id." {
			color: ".$tooltip_text_color." !important;";
			if( $tooltip_style == 'glass' )	{
				$color = $arprice_form->hex2rgb($tooltip_bg_color);
				$returnstring .= 'background:rgba('.$color['red'].','.$color['green'].','.$color['blue'].',0.9)';
			} else if ( $tooltip_style == 'alert' ) {
				$color = $arprice_form->hex2rgb($tooltip_bg_color);
				$returnstring .= 'background:rgba('.$color['red'].','.$color['green'].','.$color['blue'].',0.7)';
			} else{
				$returnstring .= "background: ".$tooltip_bg_color." !important;";
			}
		$returnstring .= "}";
		
		if( $tooltip_font_style == 'italic' ){
			$tltp_font_style = 'font-style:italic;';
			$tltp_font_weight = 'normal';
		} else {
			$tltp_font_style = 'font-style:noraml;';
			$tltp_font_weight = $tooltip_font_style;
		}
				
		$returnstring .= " .arp_tooltip_".$table_id." .tooltipster-content {
			line-height: 16px;
			padding: 8px 10px;
			font-family: ".stripslashes($tooltip_font_family).";
			font-size: ".$tooltip_font_size."px;
			font-weight: ".$tltp_font_weight.";";
			if($tltp_font_style) 
				$returnstring .= $tltp_font_style;
		$returnstring .= "}";
		       
		//space between column
		if( $space_between_column ) {
			
			$returnstring .= " .arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper{
				margin-right: ".$column_space."px;
			}";
		}
		
		//for responsive
        $returnstring .= " .ArpPriceTable.arp_price_table_".$table_id.".arptemplate_1 .maincaptioncolumn .arpcaptiontitle {
    		color: #E3E3E3;
		}";
        $returnstring .= ".ArpPriceTable.arp_price_table_".$table_id.".arptemplate_4 .maincaptioncolumn .arpcaptiontitle {
    		color: #000000;
		}";
        $returnstring .= ".ArpPriceTable.arp_price_table_".$table_id.".arptemplate_4 .maincaptioncolumn .arpcaptiontitle {
    		font-family:'opensans-regular-webfont',Arial, Helvetica, sans-serif;
            font-size:32px;
		}";
		
		if( $front_preview && $front_preview ==  1 ){
			
			// For  opacity
			$returnstring .= " .arp_price_table_".$table_id." #ArpPricingTableColumns .ArpPricingTableColumnWrapper{
				opacity: ".$column_opacity.";
			}";
		
		
		
			/*$returnstring .= ".ArpPriceTable {
					backface-visibility: hidden;
					-webkit-backface-visibility: hidden;
				}";*/
			
			
			if($is_animated){
			$returnstring .= "
				.arptemplate_".$table_id.".ArpPriceTable .ArpPricingTableColumnWrapper.shadow_effect.no_animation:hover,
				.arptemplate_".$table_id.".ArpPriceTable .ArpPricingTableColumnWrapper.shadow_effect.no_animation.column_highlight{
					-webkit-transition:all .5s;
					   -moz-transition:all .5s;
						 -o-transition:all .5s;
							transition:all .5s;
					-webkit-box-shadow:0 0 30px rgba(0,0,0,0.3);
					   -moz-box-shadow:0 0 30px rgba(0,0,0,0.3);
						 -o-box-shadow:0 0 30px rgba(0,0,0,0.3);
							box-shadow:0 0 30px rgba(0,0,0,0.3);
							position:relative !important;
							z-index:1;
				}";
				
			}else{
			$returnstring .= "
				.arptemplate_".$table_id.".ArpPriceTable .ArpPricingTableColumnWrapper.shadow_effect.no_animation:hover .arpplan,
				.arptemplate_".$table_id.".ArpPriceTable .ArpPricingTableColumnWrapper.shadow_effect.no_animation.column_highlight .arpplan{
					-webkit-transition:all .5s;
					   -moz-transition:all .5s;
						 -o-transition:all .5s;
							transition:all .5s;
					-webkit-box-shadow:0 0 30px rgba(0,0,0,0.3);
					   -moz-box-shadow:0 0 30px rgba(0,0,0,0.3);
						 -o-box-shadow:0 0 30px rgba(0,0,0,0.3);
							box-shadow:0 0 30px rgba(0,0,0,0.3);
							position:relative !important;
							z-index:1;
				}";
			}		
		}
		return $returnstring;
		
	}
	
	function get_ribbon_type( $ribbontext = 0 )
	{
		if( ! $ribbontext )
			return;
		
		if( preg_match('/_1/i', $ribbontext) )
			return 'arpribbon_1 arp_'.$ribbontext;
		else if( preg_match('/_2/i', $ribbontext) )
			return 'arpribbon_2 arp_'.$ribbontext;  
		else if( preg_match('/_3/i', $ribbontext) )	
			return 'arpribbon_3 arp_'.$ribbontext;
		else if( preg_match('/_4/i', $ribbontext) )	
			return 'arpribbon_4 arp_'.$ribbontext;
		else if( preg_match('/_5/i',$ribbontext) )
			return 'arpribbon_5 arp_'.$ribbontext;
		else if( preg_match('/_6/i',$ribbontext) )
			return 'arpribbon_6 arp_'.$ribbontext;
	}
	
	function get_preview_table( $values )
	{
		global $wpdb,$arp_mainoptionsarr;
				
		$table_id 			= $values['table_id'];
		
		$sql = $wpdb->get_results( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice WHERE ID = %d",$table_id) );
		
		$is_template = $sql[0]->is_template;
		$template_name = $sql[0]->template_name;
		$is_animated = $sql[0]->is_animated;
						
		$main_table_title	= $values['pricing_table_main'];
				
		$total 				= $values['added_package'];
		
		$template 			= $values['arp_template'];
		$template_skin 		= $values['arp_template_skin'];
		$template_type		= $values['arp_template_type'];
		$template_feature 	= maybe_serialize(json_decode(stripslashes($values['template_feature']),true));
		
		$template_setting 	= array( 'template'=>$template, 'skin'=>$template_skin, 'template_type'=>$template_type, 'template_feature'=> $template_feature);
		
		
		$custom_css = stripslashes_deep( $values['arp_custom_css'] );
				
		$column_order = stripslashes_deep( $values['pricing_table_column_order'] );
		
		$column_ord = str_replace('\'','"',$column_order);
		$col_ord_arr =  json_decode( $column_ord,true );
		
		if( $values['has_caption_column'] == 1 and !in_array('main_column_0',$col_ord_arr))
			array_unshift( $col_ord_arr, 'main_column_0' );
		$new_id = array();
		
		
		if( is_array( $col_ord_arr ) and count($col_ord_arr) > 0 ){
			foreach( $col_ord_arr as $key=>$value )
				$new_id[$key] = str_replace('main_column_','',$value);
		}
		
		$column_order = json_encode( $col_ord_arr );
		
		$total = max( $new_id );
		
		$reference_template = $values['arp_reference_template'];
		
		
		$user_edited_columns = json_decode( stripslashes_deep($values['arp_user_edited_columns']),true );
		
		$general_settings = array('arp_custom_css'=>$custom_css,'column_order'=>$column_order,'reference_template'=>$reference_template,'user_edited_columns'=>$user_edited_columns);
				
		$button_shadow_clr = @$values['button_shadow_color'];
		$button_radius = @$values['button_radius'];		
		
		$header_font_setting= array('font_family'=>@$header_font_family,'font_size'=>@$header_font_size,'font_color'=>@$header_font_color,'font_style'=>@$header_font_style);
		$price_font_setting = array('font_family'=>@$price_font_family,'font_size'=>@$price_font_size,'font_color'=>@$price_font_color,'font_style'=>@$price_font_style);
		$price_text_font_setting = array('font_family'=>@$price_text_font_family,'font_size'=>@$price_text_font_size,'font_color'=>@$price_text_font_color,'font_style'=>@$price_text_font_style);
		$content_font_setting= array('font_family'=>@$content_font_family,'font_size'=>@$content_font_size,'font_color'=>@$content_font_color,'font_style'=>@$content_font_style);
		$button_font_setting= array('font_family'=>@$button_font_family,'font_size'=>@$button_font_size,'font_color'=>@$button_font_color,'font_style'=>@$button_font_style);
		$button_settings = array('button_shadow_color'=>@$button_shadow_clr,'button_radius'=>@$button_radius);
		
		$font_setting 		= array('header_fonts'=>@$header_font_setting,'price_fonts'=>@$price_font_setting,'price_text_fonts'=>@$price_text_font_setting, 'content_fonts'=>@$content_font_setting, 'button_fonts'=>@$button_font_setting);
		
		$is_column_space 	= @$values['space_between_column'];
		$column_space 		= @$values['column_space'];
		$hover_highlight 	= @$values['column_high_on_hover'];
		$is_responsive 		= @$values['is_responsive'];
		//$is_responsive		= 1;
		$all_column_width   = @$values['all_column_width'];
		$column_min_width 	= @$values['column_min_width'];
		$column_max_width   = @$values['column_max_width'];
		$hide_caption_column = @$values['hide_caption_column'];
		$column_opacity 		= @$values['column_opacity'];
		
		$column_setting 	= array('space_between_column'=>$is_column_space,'column_space'=>$column_space,'column_highlight_on_hover'=>$hover_highlight,'is_responsive'=>$is_responsive, 'column_min_width'=>$column_min_width,'column_max_width'=>$column_max_width,'hide_caption_column'=>$hide_caption_column,'column_opacity' => $column_opacity, 'all_column_width'=>$all_column_width);
	
		$is_animation 		= @$values['is_animation'];
		$visible_columns 	= @$values['visible_columns'];
		$scroll_column 		= @$values['column_to_scroll'];
		$is_navigation	 	= @$values['is_navigation'];
		$is_autoplay 		= @$values['is_autoplay'];
		$sliding_effect 	= @$values['sliding_effect'];
		$transition_speed 	= @$values['slide_transition_speed'];
		$hide_caption_animation = @$values['hide_caption_animation'];
		$navigation_style   = @$values['navigation_style'];
		$easing_effect 		= @$values['easing_effect'];
		$is_pagination 		= @$values['is_pagination'];
		$pagination_style 	= @$values['pagination_style'];
		$pagination_position = @$values['pagination_position'];
		$infinite			= @$values['is_infinite'];
		$pagi_nav_btn		= @$values['pagination_navigation_buttons']; 
		
		$column_animation 	= array( 'is_animation'=>$is_animation, 'visible_column'=>$visible_columns, 'scrolling_columns'=>$scroll_column, 'navigation'=>$is_navigation, 'autoplay'=>$is_autoplay,'sliding_effect'=>$sliding_effect, 'transition_speed'=>$transition_speed, 'hide_caption'=>$hide_caption_animation, 'navigation_style'=>$navigation_style,'easing_effect'=>$easing_effect, 'is_pagination'=>$is_pagination, 'pagination_style'=>$pagination_style, 'pagination_position'=>$pagination_position,'is_infinite'=>$infinite,'pagi_nav_btn'=>$pagi_nav_btn );
		
		$tooltip_bgcolor 	= @$values['tooltip_bgcolor'];
		$tooltip_txt_color	= @$values['tooltip_txtcolor'];
		$tooltip_animation  = @$values['tooltip_animation_style'];
		$tooltip_position   = @$values['tooltip_position'];
		$tooltip_width 	    = @$values['tooltip_width'];
		$tooltip_style		= @$values['tooltip_style'];
		$tooltip_font_family = @$values['tooltip_font_family'];
		$tooltip_font_size = @$values['tooltip_font_size'];
		$tooltip_font_style = @$values['tooltip_font_style'];
		
		$tooltip_setting 	= array( /*'width'=>$tooltip_width,*/ 'background_color'=>$tooltip_bgcolor, 'text_color'=>$tooltip_txt_color, 'animation'=>$tooltip_animation, 'position'=>$tooltip_position, 'tooltip_width'=>$tooltip_width, 'style'=>$tooltip_style,'tooltip_font_family'=>$tooltip_font_family,'tooltip_font_size'=>$tooltip_font_size,'tooltip_font_style'=>$tooltip_font_style );
		
		$tab_general_opt 	= array( 'template_setting'=>$template_setting, 'font_settings'=>$font_setting, 'column_settings'=>$column_setting, 'column_animation'=>$column_animation, 'tooltip_settings'=>$tooltip_setting,'general_settings'=>$general_settings,'button_settings'=>$button_settings );
		
		$general_opt 		= maybe_serialize($tab_general_opt);
		
		//for table options
		$sql_results 	= $wpdb->get_results( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice_options WHERE table_id = %d", $table_id) );
		$table_opt 		= $sql_results[0]->table_options;
		$uns_table_opt 	= maybe_unserialize($table_opt);
		$table_columns 	= $uns_table_opt['columns']; 
		
		if($total > 0)
		{
			
			if($total > 1)
			{
				for($i = 0; $i <= $total; $i++)
				{
					if( !in_array( $i,$new_id ) )
						continue;
					$Title = 'column_'.$i;
					$column_width = @$values['column_width_'.$i];
					$column_title = @$values['column_title_'.$i];
					$column_desc = @$values['arp_column_description_'.$i];
					$cstm_rbn_txt = @$values['arp_custom_ribbon_txt_'.$i];
					$column_highlight = @$values['column_highlight_'.$i];
				
					
					$column_ribbon_style	= @stripslashes_deep($values['arp_ribbon_style_'.$i]);
					$column_ribbon_position = @stripslashes_deep($values['arp_ribbon_position_'.$i]);
					$column_ribbon_bgcolor	= @stripslashes_deep($values['arp_ribbon_bgcol_'.$i]);
					$column_ribbon_txtcolor = @stripslashes_deep($values['arp_ribbon_textcol_'.$i]);
					$column_ribbon_content  = @stripslashes_deep($values['arp_ribbon_content_'.$i]);
					
					$header_font_family = @$values['header_font_family_'.$i];
					$header_font_size 	= @$values['header_font_size_'.$i];
					$header_font_color 	= @$values['header_font_color_'.$i];
					$header_font_style 	= @$values['header_font_style_'.$i];
					
					$header_style_bold = @$values['header_style_bold_'.$i];
					$header_style_italic = @$values['header_style_italic_'.$i];
					$header_style_decoration = @$values['header_style_decoration_'.$i];
					
					$price_font_family = @stripslashes_deep($values['price_font_family_'.$i]);
					$price_font_size = @$values['price_font_size_'.$i];
					$price_font_color = @$values['price_font_color_'.$i];
					$price_font_style = @stripslashes_deep($values['price_font_style_'.$i]);
					
					$price_label_style_bold = @$values['price_label_style_bold_'.$i];
					$price_label_style_italic = @$values['price_label_style_italic_'.$i];
					$price_label_style_decoration = @$values['price_label_style_decoration_'.$i];
					
					$price_text_font_family = @stripslashes_deep($values['price_text_font_family_'.$i]);
					$price_text_font_size = @$values['price_text_font_size_'.$i];
					$price_text_font_style = @$values['price_text_font_style_'.$i];
					$price_text_font_color = @stripslashes_deep($values['price_text_font_color_'.$i]);
					
					$price_text_style_bold = @$values['price_text_style_bold_'.$i];
					$price_text_style_italic = @$values['price_text_style_italic_'.$i];
					$price_text_style_decoration = @$values['price_text_style_decoration_'.$i];
					
					$column_description_font_family = @stripslashes_deep($values['column_description_font_family_'.$i]);
					$column_description_font_size   = @$values['column_description_font_size_'.$i];
					$column_description_font_style  = @$values['column_description_font_style_'.$i];
					$column_description_font_color  = @stripslashes_deep($values['column_description_font_color_'.$i]);
					
					$column_description_style_bold = @$values['column_description_style_bold_'.$i];
					$column_description_style_italic = @$values['column_description_style_italic_'.$i];
					$column_description_style_decoration = @$values['column_description_style_decoration_'.$i];
					
					$content_font_family = @stripslashes_deep($values['content_font_family_'.$i]);
					$content_font_size = @$values['content_font_size_'.$i];
					$content_font_color = @stripslashes_deep($values['content_font_color_'.$i]);
					$content_font_style = @$values['content_font_style_'.$i];
					
					$body_li_style_bold = @$values['body_li_style_bold_'.$i];
					$body_li_style_italic = @$values['body_li_style_italic_'.$i];
					$body_li_style_decoration = @$values['body_li_style_decoration_'.$i];
					
					$content_label_font_family = @stripslashes_deep($values['content_label_font_family_'.$i]);
					$content_label_font_size = @$values['content_label_font_size_'.$i];
					$content_label_font_color = @stripslashes_deep($values['content_label_font_color_'.$i]);
					$content_label_font_style = @$values['content_label_font_style_'.$i];
					
					$body_label_style_bold = @$values['body_label_style_bold_'.$i];
					$body_label_style_italic = @$values['body_label_style_italic_'.$i];
					$body_label_style_decoration = @$values['body_label_style_decoration_'.$i];
										
					$button_font_family = @stripslashes_deep($values['button_font_family_'.$i]);
					$button_font_size = @$values['button_font_size_'.$i];
					$button_font_color = @$values['button_font_color_'.$i];
					$button_font_style = @stripslashes_deep($values['button_font_style_'.$i]);
					
					$button_style_bold = @$values['button_style_bold_'.$i];
					$button_style_italic = @$values['button_style_italic_'.$i];
					$button_style_decoration = @$values['button_style_decoration_'.$i];
					
					$second_button_font_family = @stripslashes_deep( $values['second_button_font_family_'.$i] );
					$second_button_font_size = @$values['second_button_font_size_'.$i];
					$second_button_font_style = @$values['second_button_font_style_'.$i];
					$second_button_font_color = @stripslashes_deep($values['second_button_font_color_'.$i]);
					
					$caption = isset($values['caption_column_'.$i]) ? $values['caption_column_'.$i] : 0;
					$show_column 	= isset($values['show_column_'.$i]) ? 1 : 0;
					$header_shortcode = @stripslashes_deep($values['additional_shortcode_'.$i]);
					$html_content 	= @stripslashes_deep($values['html_content_'.$i]);
					$price_text 	= @stripslashes_deep($values['price_text_'.$i]);
					$price_label	= @stripslashes_deep($values['price_label_'.$i]);
					$gmap_marker = @$values['gmap_marker'.$i];
					$total_rows 	= @$values['total_rows_'.$i];
					
					$row = array();
					if( $total_rows > 0 )
					{
						for($j = 0; $j < $total_rows; $j++)
						{
							$row_title 		= 'row_'.$j;
							$row_label 		= @$values['row_'.$i.'_label_'.$j];
							$row_des_align 	= @$values['row_'.$i.'_description_text_alignment_'.$j];
							$row_des 		= @stripslashes_deep($values['row_'.$i.'_description_'.$j]);
							$row_tooltip 	= @esc_html($values['row_'.$i.'_tooltip_'.$j]);
							
							$row[$row_title] = array('row_des_txt_align'=>$row_des_align, 'row_description'=>$row_des, 'row_tooltip'=>$row_tooltip,'row_label'=>$row_label);
							
							unset($values['row_'.$i.'_description_text_alignment_'.$j]);
							unset($values['row_'.$i.'_description_'.$j]);
							unset($values['row_'.$i.'_tooltip_'.$j]);
							
						}
					}
					$body_text_alignemnt = @$values['body_text_alignment_'.$i];
					$btn_size 	= @$values['button_size_'.$i];
					$btn_type 	= @$values['button_type_'.$i];
					$btn_text 	= @stripslashes_deep($values['btn_content_'.$i]);
					$paypal_btn = @stripslashes_deep($values['paypal_code_'.$i]);
					$btn_link 	= @$values['btn_link_'.$i];
					$btn_img 	= @$values['btn_img_url_'.$i];
					$btn_img_height	= @$values['button_img_height_'.$i];
					$btn_img_width 	= @$values['button_img_width_'.$i];
					$btn_s_size = @$values['second_button_size_'.$i];
					$btn_s_type = @$values['second_button_type_'.$i];
					$btn_s_text = @stripslashes_deep($values['second_btn_content_'.$i]);
					$paypal_s_btn = @stripslashes_deep($values['second_paypal_code_'.$i]);
					$btn_s_link = @$values['second_btn_link_'.$i];
					$btn_s_img = @$values['second_btn_img_url_'.$i];
					$btn_s_img_height = @$values['second_button_img_height_'.$i];
					$btn_s_img_width = @$values['second_button_img_width_'.$i];
					$s_is_new_window = @$values['second_new_window_'.$i];
					$is_new_window 	= @$values['new_window_'.$i];
					
					if( !@$table_columns[ $Title ]['row_order'] || !is_array(@$table_columns[ $Title ]['row_order']) )
					{
						@parse_str($values[$Title.'_row_order'], $col_row_order);
						$row_order= @$col_row_order;
					}
					else
						$row_order= @$table_columns[ $Title ]['row_order']; 
					
					$ribbon_settings = array(
						'arp_ribbon' 			=> $column_ribbon_style,
						'arp_ribbon_bgcol' 		=> $column_ribbon_bgcolor,
						'arp_ribbon_txtcol' 	=> $column_ribbon_txtcolor,
						'arp_ribbon_position' 	=> $column_ribbon_position,
						'arp_ribbon_content'	=> $column_ribbon_content,
					);
					
					$column[$Title] = array( 
										'package_title'			=> $column_title, 
										'column_width'			=> $column_width, 
										'is_caption'			=> $caption, 
										'column_description' 	=> $column_desc,
										'custom_ribbon_txt' 	=> $cstm_rbn_txt,
										'column_highlight' 		=> $column_highlight,
										'is_hidden'				=> $show_column, 
										'arp_header_shortcode' 	=> $header_shortcode, 
										'html_content'			=> $html_content,
										'price_text'			=> $price_text,
										'price_label'			=> $price_label,
										'gmap_marker'			=> @$google_map_marker,
										'body_text_alignment'	=> @$body_text_alignemnt,
										'rows'					=> $row, 
										'button_size'			=> $btn_size, 
										'button_type'			=> $btn_type, 
										'button_text'			=> $btn_text,
										'paypal_code'			=> $paypal_btn,
										'button_url'			=> $btn_link, 
										'btn_img'				=> $btn_img, 
										'btn_img_height'		=> $btn_img_height, 
										'btn_img_width'			=> $btn_img_width, 
										'button_s_size'			=> $btn_s_size,
										'button_s_type'			=> $btn_s_type,
										'button_s_text'			=> $btn_s_text,
										'paypal_s_code'			=> $paypal_s_btn,
										'button_s_link'			=> $btn_s_link,
										'button_s_img'			=> $btn_s_img,
										'button_s_img_height'	=> $btn_s_img_height,
										'button_s_img_width'	=> $btn_s_img_width,
										's_is_new_window'		=> $s_is_new_window,
										'is_new_window'	=> $is_new_window, 
										'row_order' 	=> $row_order, 
										'ribbon_setting'=> $ribbon_settings,
										'header_font_family'=>$header_font_family,
										'header_font_size'=>$header_font_size,
										'header_font_color'=>$header_font_color,
										'header_font_style'=>$header_font_style,
										
										'header_style_bold'     => $header_style_bold,
										'header_style_italic'   => $header_style_italic,
										'header_style_decoration' => $header_style_decoration,
										
										'price_font_family'		=> $price_font_family,
										'price_font_size'		=> $price_font_size,
										'price_font_style'		=> $price_font_style,
										'price_font_color'		=> $price_font_color,
										
										'price_label_style_bold' => $price_label_style_bold,
										'price_label_style_italic' => $price_label_style_italic,
										'price_label_style_decoration' => $price_label_style_decoration,
										
										'price_text_font_family'=> $price_text_font_family,
										'price_text_font_size'	=> $price_text_font_size,
										'price_text_font_style' => $price_text_font_style,
										'price_text_font_color' => $price_text_font_color,
										
										'price_text_style_bold' => $price_text_style_bold,
										'price_text_style_italic' => $price_text_style_italic,
										'price_text_style_decoration' => $price_text_style_decoration,


										
										'content_font_family'	=> $content_font_family,
										'content_font_size'		=> $content_font_size,
										'content_font_style' 	=> $content_font_style,
										'content_font_color'	=> $content_font_color,
										
										'body_li_style_bold'    => $body_li_style_bold,
										'body_li_style_italic'  => $body_li_style_italic,
										'body_li_style_decoration' => $body_li_style_decoration,
										
										'content_label_font_family'	=> $content_label_font_family,
										'content_label_font_size'	=> $content_label_font_size,
										'content_label_font_style'	=> $content_label_font_style,
										'content_label_font_color'	=> $content_label_font_color,
										
										'body_label_style_bold'     => $body_label_style_bold,
										'body_label_style_italic'   => $body_label_style_italic,
										'body_label_style_decoration' => $body_label_style_decoration,
										
										'button_font_family'	=> $button_font_family,
										'button_font_size'	=> $button_font_size,
										'button_font_color'	=> $button_font_color,
										'button_font_style'	=> $button_font_style,
										
										'button_style_bold' 	=> $button_style_bold,
										'button_style_italic' 	=> $button_style_italic,
										'button_style_decoration' => $button_style_decoration,
										
										'second_button_font_family'=> $second_button_font_family,
										'second_button_font_size'  => $second_button_font_size,
										'second_button_font_style' => $second_button_font_style,
										'second_button_font_color' => $second_button_font_color,
										'column_description_font_family'=> $column_description_font_family,
										'column_description_font_size'=> $column_description_font_size,
										'column_description_font_style'=>$column_description_font_style,
										'column_description_font_color'=>$column_description_font_color,
										
										'column_description_style_bold'=>$column_description_style_bold,
										'column_description_style_italic'=>$column_description_style_italic,
										'column_description_style_decoration'=>$column_description_style_decoration,
										
										);
				}
			}
			else
			{
				$Title = 'column_0';
				$column_width 	= $values['column_width_0'];
				$column_title 	= $values['column_title_0'];
				$column_desc = $values['arp_column_description_0'];
				$cstm_rbn_txt = $values['arp_custom_ribbon_txt_0'];
				/*$column_ribbonimg		= $values['arp_ribbonimg_0'];	
				$column_ribbontext		= $values['arp_ribbontext_0'];	
				$column_ribbonposition	= $values['arp_ribbonposition_0'];	*/
				$column_highlight = $values['column_highlight_0'];
				$caption = isset($values['caption_column_0']) ? $values['caption_column_0'] : 0;
				$show_column 	= isset($values['show_column_0']) ? 1 : 0;
				$header_shortcode 			= stripslashes_deep($values['additional_header_0']);
				$html_content 	= stripslashes_deep($values['html_content_0']);
				$price_text		= stripslashes_deep($values['price_text_0']);
				$price_label	= stripslashes_deep($values['price_label_0']);
				$gmap_marker 	= $values['gmap_marker_0'];
				$total_rows 	= $values['total_rows_0'];
				
				$column_ribbon_style	= stripslashes_deep($values['arp_ribbon_style_0']);
				$column_ribbon_position = stripslashes_deep($values['arp_ribbon_position_0']);
				$column_ribbon_bgcolor	= stripslashes_deep($values['arp_ribbon_bgcol_0']);
				$column_ribbon_txtcolor = stripslashes_deep($values['arp_ribbon_textcol_0']);
				$column_ribbon_content  = stripslashes_deep($values['arp_ribbon_content_0']);
				
				$header_font_family = $values['header_font_family_0'];
				$header_font_size 	= $values['header_font_size_0'];
				$header_font_color 	= $values['header_font_color_0'];
				$header_font_style 	= $values['header_font_style_0'];
				
				$header_style_bold = $values['header_style_bold_0'];
				$header_style_italic = $values['header_style_italic_0'];
				$header_style_decoration = $values['header_style_decoration_0'];
				
				$price_font_family = stripslashes_deep($values['price_font_family_0']);
				$price_font_size = $values['price_font_size_0'];
				$price_font_color = $values['price_font_color_0'];
				$price_font_style = $values['price_font_style_0'];
				
				$price_label_style_bold = $values['price_label_style_bold_0'];
				$price_label_style_italic = $values['price_label_style_italic_0'];
				$price_label_style_decoration = $values['price_label_style_decoration_0'];
				
				$price_text_font_family = stripslashes_deep($values['price_text_font_family_0']);
				$price_text_font_size = $values['price_text_font_size_0'];
				$price_text_font_style = $values['price_text_font_style_0'];
				$price_text_font_color = $values['price_text_font_color_0'];
				
				$price_text_style_bold = $values['price_text_style_bold_0'];
				$price_text_style_italic = $values['price_text_style_italic_0'];
				$price_text_style_decoration = $values['price_text_style_decoration_0'];
				
				$column_description_font_family = stripslashes_deep($values['column_description_font_family_0']);
				$column_description_font_size = stripslashes_deep($values['column_description_font_size_0']);
				$column_description_font_style = stripslashes_deep($values['column_description_font_style_0']);
				$column_description_font_color = stripslashes_deep($values['column_description_font_color_0']);
				
				$column_description_style_bold = $values['column_description_style_bold_0'];
				$column_description_style_italic = $values['column_description_style_italic_0'];
				$column_description_style_decoration = $values['column_description_style_decoration_0'];
				
				$content_font_family = $values['content_font_family_0'];
				$content_font_size = $values['content_font_size_0'];
				$content_font_color = $values['content_font_color_0'];
				$content_font_style = $values['content_font_style_0'];	
				
				$body_li_style_bold = $values['body_li_style_bold_0'];
				$body_li_style_italic = $values['body_li_style_italic_0'];
				$body_li_style_decoration = $values['body_li_style_decoration_0'];
				
				$content_label_font_family = stripslashes_deep($values['content_label_font_family_0']);
				$content_label_font_size = $values['content_label_font_size_0'];
				$content_label_font_color = stripslashes_deep($values['content_label_font_color_0']);
				$content_label_font_style = $values['content_label_font_style_0'];
				
				$body_label_style_bold = $values['body_label_style_bold_0'];
				$body_label_style_italic = $values['body_label_style_italic_0'];
				$body_label_style_decoration = $values['body_label_style_decoration_0'];
				
				$button_font_family = $values['button_font_family_0'];
				$button_font_size = $values['button_font_size_0'];
				$button_font_color = $values['button_font_color_0'];
				$button_font_style = $values['button_font_style_0'];
				
				$button_style_bold = $values['button_style_bold_0'];
				$button_style_italic = $values['button_style_italic_0'];
				$button_style_decoration = $values['button_style_decoration_0'];
				
				$second_button_font_family = stripslashes_deep( $values['second_button_font_family_0'] );
				$second_button_font_size = $values['second_button_font_size_0'];
				$second_button_font_style = $values['second_button_font_style_0'];
				$second_button_font_color = stripslashes_deep($values['second_button_font_color_0']);
				
				$row = array();
				if( $total_rows > 0 )
				{
					for($j = 0; $j < $total_rows; $j++)
					{
						$row_title = 'row_'.$j;
						$row_label		= $values['row_0_label_'.$j];
						$row_des_align 	= $values['row_0_description_text_alignment_'.$j];
						$row_des 		= stripslashes_deep($values['row_0_description_'.$j]);
						$row_tooltip 	= stripslashes_deep($values['row_0_tooltip_'.$j]);
						
						$row[$row_title] = array('row_des_txt_align'=>$row_des_align, 'row_description'=>$row_des, 'row_tooltip'=>$row_tooltip, 'row_label'=>$row_label);
						
						unset($values['row_0_description_text_alignment_'.$j]);
						unset($values['row_0_description_'.$j]);
						unset($values['row_0_tooltip_'.$j]);
					}
				}
				$body_text_alignemnt = $values['body_text_alignment_0'];
				$btn_size 	= $values['button_size_0'];
				$btn_type 	= $values['button_type_0'];
				$btn_text 	= stripslashes_deep($values['btn_content_0']);
				$btn_link 	= $values['btn_link_0'];
				$btn_img 	= $values['btn_img_url_0'];
				$btn_img_height = $values['button_img_height_0'];
				$btn_img_width 	= $values['button_img_width_0'];
				$btn_s_size = $values['second_button_size_0'];
				$btn_s_type = $values['second_button_type_0'];
				$btn_s_text = stripslashes_deep($values['second_btn_content_0']);
				$btn_s_link = $values['second_btn_link_0'];
				$btn_s_img = $values['second_btn_img_url_0'];
				$btn_s_img_height = $values['second_button_img_height_0'];
				$btn_s_img_width = $values['second_button_img_width_0'];
				$s_is_new_window = $values['second_new_window_0'];
				$is_new_window 	= $values['new_window_0'];
				
				if( !$table_columns[ $Title ]['row_order'] || !is_array($table_columns[ $Title ]['row_order']) )
				{
					@parse_str($values[$Title.'_row_order'], $col_row_order);
					$row_order= $col_row_order;
				}
				else
					$row_order= $table_columns[ $Title ]['row_order'];
				
				$ribbon_settings = array(
					'arp_ribbon' 			=> $column_ribbon_style,
					'arp_ribbon_bgcol' 		=> $column_ribbon_bgcolor,
					'arp_ribbon_txtcol' 	=> $column_ribbon_txtcolor,
					'arp_ribbon_position' 	=> $column_ribbon_position,
					'arp_ribbon_content'	=> $column_ribbon_content,
				);
					
				$column[$Title] = array( 
									'package_title'	=> $column_title, 
									'column_width'	=> $column_width, 
									'is_caption'	=> $caption, 
									'column_highlight' => $column_highlight,
									'custom_ribbon_txt' => $cstm_rbn_txt,
									'column_description' => $column_desc,
									'is_hidden'		=> $show_column,
									'arp_header_shortcode' => $header_shortcode, 
									'html_content'	=> $html_content,
									'price_text'	=> $price_text,
									'price_label'	=> $price_label,
									'gmap_marker'	=> $google_map_marker,
									'body_text_alignment' => $body_text_alignemnt,
									'rows'			=> $row, 
									'button_size'	=> $btn_size, 
									'button_type'	=> $btn_type, 
									'button_text'	=> $btn_text, 
									'button_url'	=> $btn_link, 
									'btn_img'		=> $btn_img, 
									'btn_img_height'=> $btn_img_height, 
									'btn_img_width'	=> $btn_img_width,
									'button_s_size'		=> $btn_s_size,
									'button_s_type'		=> $btn_s_type,
									'button_s_text'		=> $btn_s_text,
									'button_s_link'		=> $btn_s_link,
									'button_s_img'		=> $btn_s_img,
									'button_s_img_height' => $btn_s_img_height,
									'button_s_img_width'=> $btn_s_img_width,
									's_is_new_window'	=> $s_is_new_window,
									'is_new_window'		=> $is_new_window,
									'row_order' 	=> $row_order, 
									'ribbon_setting'=> $ribbon_settings,
									'header_font_family'=>$header_font_family,
									'header_font_size'=>$header_font_size,
									'header_font_color'=>$header_font_color,
									'header_font_style'=>$header_font_style,
									
									'header_style_bold'     => $header_style_bold,
									'header_style_italic'   => $header_style_italic,
									'header_style_decoration' => $header_style_decoration,
									
									'price_font_family'		=> $price_font_family,
									'price_font_size'		=> $price_font_size,
									'price_font_style'		=> $price_font_style,
									'price_font_color'		=> $price_font_color,
									
									'price_label_style_bold' => $price_label_style_bold,
									'price_label_style_italic' => $price_label_style_italic,
									'price_label_style_decoration' => $price_label_style_decoration,
									
									'price_text_font_family'=> $price_text_font_family,
									'price_text_font_size'	=> $price_text_font_size,
									'price_text_font_style' => $price_text_font_style,
									'price_text_font_color' => $price_text_font_color,
									
									'price_text_style_bold' => $price_text_style_bold,
									'price_text_style_italic' => $price_text_style_italic,
									'price_text_style_decoration' => $price_text_style_decoration,
									
									
									'content_font_family' => $content_font_family,
									'content_font_size'		=> $content_font_size,
									'content_font_style' 	=> $content_font_style,
									'content_font_color'	=> $content_font_color,
									
									'body_li_style_bold'    => $body_li_style_bold,
									'body_li_style_italic'  => $body_li_style_italic,
									'body_li_style_decoration' => $body_li_style_decoration,
									
									'content_label_font_family'	=> $content_label_font_family,
									'content_label_font_size'	=> $content_label_font_size,
									'content_label_font_style'	=> $content_label_font_style,
									'content_label_font_color'	=> $content_label_font_color,
									
									'body_label_style_bold'     => $body_label_style_bold,
									'body_label_style_italic'   => $body_label_style_italic,
									'body_label_style_decoration' => $body_label_style_decoration,
									
									
									'button_font_family'	=> $button_font_family,
									'button_font_size'		=> $button_font_size,
									'button_font_color'		=> $button_font_color,
									'button_font_style'		=> $button_font_style,
									
									'button_style_bold' 	=> $button_style_bold,
									'button_style_italic' 	=> $button_style_italic,
									'button_style_decoration' => $button_style_decoration,
									
									'second_button_font_family'=> $second_button_font_family,
									'second_button_font_size'  => $second_button_font_size,
									'second_button_font_style' => $second_button_font_style,
									'second_button_font_color' => $second_button_font_color,
									'column_description_font_family'=> $column_description_font_family,
									'column_description_font_size'=> $column_description_font_size,
									'column_description_font_style'=>$column_description_font_style,
									'column_description_font_color'=>$column_description_font_color,
									
									'column_description_style_bold'=>$column_description_style_bold,
									'column_description_style_italic'=>$column_description_style_italic,
									'column_description_style_decoration'=>$column_description_style_decoration,

									
									);
				
			}
		}
		else
		{
			return;
		}
		
		$uns_table_opt['columns'] = $column;
		
		$table_options = maybe_serialize($uns_table_opt);
		
		$table_arr = array( 'table_id' => $table_id, 'general_options' => $general_opt, 'table_options' => $table_options, 'is_template'=>$is_template ,'template_name' => $template_name,'is_animated'=>$is_animated);

		return $table_arr; 					
	}
		
	function arp_updatetabledata()
	{
		$all_previewtabledata_option	= get_option('arp_previewoptions');
		$all_previewtabledata_option	= maybe_unserialize($all_previewtabledata_option);
		$all_previewtabledata_option	= (array) $all_previewtabledata_option;
		
		if( get_option('arp_previewtabledata_1') == '' )
		{
			update_option('arp_previewtabledata_1', $_POST);			
			$all_previewtabledata_option[ 'arp_previewtabledata_1' ]	= time();
			echo 'arp_previewtabledata_1'; 	
		} 
		else if( get_option('arp_previewtabledata_2') == '' )
		{
			update_option('arp_previewtabledata_2', $_POST);
			$all_previewtabledata_option[ 'arp_previewtabledata_2' ]	= time();
			echo 'arp_previewtabledata_2'; 	
		}
		else if( get_option('arp_previewtabledata_3') == '' )
		{
			update_option('arp_previewtabledata_3', $_POST);
			$all_previewtabledata_option[ 'arp_previewtabledata_3' ]	= time();
			echo 'arp_previewtabledata_3'; 	
		}
		else if( get_option('arp_previewtabledata_4') == '' )
		{
			update_option('arp_previewtabledata_4', $_POST);
			$all_previewtabledata_option[ 'arp_previewtabledata_4' ]	= time();
			echo 'arp_previewtabledata_4'; 	
		}
		else if( get_option('arp_previewtabledata_5') == '' )
		{
			update_option('arp_previewtabledata_5', $_POST);
			$all_previewtabledata_option[ 'arp_previewtabledata_5' ]	= time();
			echo 'arp_previewtabledata_5'; 	
		}
		else if( get_option('arp_previewtabledata_6') == '' )
		{
			update_option('arp_previewtabledata_6', $_POST);
			$all_previewtabledata_option[ 'arp_previewtabledata_6' ]	= time();
			echo 'arp_previewtabledata_6'; 	
		}
		else if( get_option('arp_previewtabledata_7') == '' )
		{
			update_option('arp_previewtabledata_7', $_POST);
			$all_previewtabledata_option[ 'arp_previewtabledata_7' ]	= time();
			echo 'arp_previewtabledata_7'; 	
		}
		else if( get_option('arp_previewtabledata_8') == '' )
		{
			update_option('arp_previewtabledata_8', $_POST);
			$all_previewtabledata_option[ 'arp_previewtabledata_8' ]	= time();
			echo 'arp_previewtabledata_8'; 	
		}
		else if( get_option('arp_previewtabledata_9') == '' )
		{
			update_option('arp_previewtabledata_9', $_POST);
			$all_previewtabledata_option[ 'arp_previewtabledata_9' ]	= time();
			echo 'arp_previewtabledata_9'; 	
		}
		else
		{		
			$random = rand(11,9999);
			if( get_option('arp_previewtabledata_'.$random) != '' )
				$random = rand(11,9999);		
			update_option('arp_previewtabledata_'.$random, $_POST);
			$all_previewtabledata_option[ 'arp_previewtabledata_'.$random ]	= time();
			echo 'arp_previewtabledata_'.$random; 	
		}
				
		update_option('arp_previewoptions', $all_previewtabledata_option);
					
	die();
	}
	
	function get_table_enqueue_data( $tablearr = array() )
	{
		if( !$tablearr )
			return;		
		
		global $wpdb;
		
		$tableresutls = array();
				
		foreach( $tablearr as $table_id )
		{
			$tabledata 		= $wpdb->get_row( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice WHERE ID = %d", $table_id) ); 
			$tableoption	= $wpdb->get_row( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice_options WHERE table_id = %d", $table_id) ); 
						
			if( $tabledata && $tableoption )
			{
				$general_options= maybe_unserialize( $tabledata->general_options );
				$table_options 	= maybe_unserialize( $tableoption->table_options );
				
				$googlemap = 0;
				if( $table_options['columns'] )
				{
					foreach( $table_options['columns'] as $columns )
					{
						$html_content	= isset($columns['arp_header_shortcode']) ? $columns['arp_header_shortcode'] : "";
						if( preg_match('/arp_googlemap/', $html_content) )
							$googlemap = 1;														
					}	
				}
				
				$tableresutls[ $tabledata->ID ] = array(
					'template'		=> $general_options['template_setting']['template'],
					'skin'			=> $general_options['template_setting']['skin'],
					'template_name'	=> $tabledata->template_name,
					'is_template'	=> $tabledata->is_template,
					'googlemap'		=> $googlemap,
					);
			}	
			
		}
		
		return $tableresutls; 
	}
	
	function arp_choose_template_type( $template_1 = '' )
	{
		global $arp_mainoptionsarr;
		if( $template_1 == '' )
			$template = $_REQUEST['template'];
		else
			$template = $template_1;
		
		if( $template_1 != '' )
			return $arp_mainoptionsarr['general_options']['template_options']['template_type'][$template];
		else
			echo $arp_mainoptionsarr['general_options']['template_options']['template_type'][$template];
		
		die();
	}
	
	function arp_widget_text_filter( $content )
	{
    	$regex = '/\[\s*ARPrice\s+.*\]/';
		return preg_replace_callback( $regex, array($this, 'arp_widget_text_filter_callback'), $content );
		
    }

    function arp_widget_text_filter_callback( $matches ) {
	
		global $arprice_form;
		
		if( $matches[0] )
		{
			$parts 		= explode("id=",$matches[0]);
			$partsnew 	= explode(" ",$parts[1]);
			$tableid	= $partsnew[0];
			$tableid	= @trim($tableid);
			if( $tableid )
			{
				$newvalues_enqueue = $arprice_form->get_table_enqueue_data( array($tableid) ); 
								
				if(is_array($newvalues_enqueue) && count($newvalues_enqueue) > 0)
				{
					$to_google_map 	= 0;
					$templates 		= array();
					
					foreach($newvalues_enqueue as $newqnqueue)
					{
						if( $newqnqueue['googlemap'] )
							$to_google_map = 1;
						
						$templates[] = $newqnqueue['template']; 		
					}
					
					$templates = array_unique( $templates );
					
					if( $to_google_map )
					{
						wp_register_script( 'arp_googlemap_js', 'http://maps.google.com/maps/api/js?sensor=false' );
				
						wp_enqueue_script( 'arp_googlemap_js');
				
						wp_register_script( 'arp_gomap_js',PRICINGTABLE_URL.'/js/jquery.gomap-1.3.2.min.js');
				
						wp_enqueue_script( 'arp_gomap_js');
					}
					
					if( $templates )
					{
						wp_enqueue_script( 'arprice_js');
						wp_enqueue_script( 'arprice_slider_js');
						wp_enqueue_script( 'arp_tooltip_front' );
						//wp_enqueue_script( 'arprice_cufon' );
						//wp_enqueue_script( 'arp_cufon_font' );
				
						wp_enqueue_style( 'arprice_front_css' );
						wp_enqueue_style( 'arprice_front_tooltip_css' );
						wp_enqueue_style( 'arp_fontawesome_css' );	
						wp_enqueue_style( 'arprice_font_css_front' );
				
						foreach($templates as $template)
						{
							wp_register_style( 'arp_'.$template.'_css',PRICINGTABLE_URL.'/css/templates/'.$template.'.css' );				
							wp_enqueue_style( 'arp_'.$template.'_css' );
						}
					}
					
				}
					
			}
		}
				
        return do_shortcode( $matches[0] );
		
    }
	
	function hex2rgb( $colour ){
	
		if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	}
	
	function arp_load_pricing_table(){
                
		global $wpdb,$arp_mainoptionsarr;
		
		require_once PRICINGTABLE_DIR.'/core/classes/class.arprice_preview_editor.php';
		
		$template_id = $_REQUEST['id'];
		
		$template = $_REQUEST['template'];
		
		$skin = $_REQUEST['skin'];
		
		$ref_template = $_REQUEST['ref_temp'];
		
		$is_clone = $_REQUEST['is_clone'];
		
		$sql = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'arp_arprice WHERE ID = %d ', $template_id) );
		
		$table_name = $sql[0]->table_name;
		
		$general_options =  json_encode( maybe_unserialize( stripslashes( $sql[0]->general_options ) ) ) ;
		
		$opt = maybe_unserialize($sql[0]->general_options);
		
		$is_animated = $sql[0]->is_animated;
		
		$columns = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'arp_arprice_options WHERE table_id = %d', $template_id) );
		
		$column_options =  json_encode( maybe_unserialize( stripslashes( $columns[0]->table_options ) ) );
		
		$table = arp_get_pricing_table_string_editor( $template_id,$table_name,2,'','',$is_clone );
		
		$template_skins = json_encode($arp_mainoptionsarr['general_options']['template_options']['skins'][$ref_template]);
		
		$template_skin_codes = json_encode($arp_mainoptionsarr['general_options']['template_options']['skin_color_code'][$ref_template]);
		
		$options = json_decode( $general_options, true );
			
		$general_settings =  json_encode( $options['general_settings'] );
		
		$template_settings = json_encode( $options['template_setting'] );
						
		$template_type = $this->arp_choose_template_type( $ref_template );
		
		$columns = maybe_unserialize( stripslashes( $columns[0]->table_options ) );
		
		$total_columns = count($columns['columns']);
		
		$json_array = array( 'table'=> $table,'table_name'=>$table_name,'general_settings'=>$general_settings,'template_settings'=>$template_settings,'column_options'=>$column_options,'template_skins'=>$template_skins,'template_skin_codes'=>$template_skin_codes,'template_type'=>$template_type,'total_columns'=>$total_columns,'is_animated'=>$is_animated );
		
		$json_array = json_encode( $json_array );
		
		echo $json_array;
		
		die();
		
	}
	
	function font_settings( $selected_fonts = '' ){
	
		global $arprice_fonts;
		
		$default_fonts = $arprice_fonts->get_default_fonts();
		
		$google_fonts = $arprice_fonts->google_fonts_list();
		
		$str = '';
		
		$str .= '<optgroup label="'.__('Default Fonts',ARP_PT_TXTDOMAIN).'">';
		
		foreach( $default_fonts as $font )
		{
			$str .= '<option id="normal" '.selected($font,$selected_fonts,false).' value="'.$font.'">'.$font.'</option>';
		}
		
		$str .= '</optgroup>';
		
		$str .= '<optgroup label="'.__('Google Fonts',ARP_PT_TXTDOMAIN).'">';
		
		foreach( $google_fonts as $font )
		{
			$str .= '<option id="google" '.selected($font,$selected_fonts,false).' value="'.$font.'">'.$font.'</div>';
		}
		
		$str.= '</optgroup>';
		
		return $str;
	}
		
	function new_column( $packages, $columns, $features, $total_rows, $options, $has_caption, $template, $template_type, $table_id, $ref_template,$template_name ){
	
		global $arprice_fonts,$arprice_form,$arp_mainoptionsarr;
		
		$col_no = $packages;
		
			
		$column_ord = str_replace('\'','"',$options['general_settings']['column_order']);
		$col_ord_arr =  json_decode( $column_ord,true );
		if( $has_caption == 1 and in_array( 'main_column_0', $col_ord_arr ) ){
			$key = array_search( 'main_column_0',$col_ord_arr );
			unset( $col_ord_arr[$key] );
		}
		
		$new_arr = array();
		if( is_array( $col_ord_arr ) and count($col_ord_arr) > 0 ){
			foreach( $col_ord_arr as $key=>$value )
				$new_arr[$key] = str_replace('main_','',$value);
		}
		
		
		
		$new_arr = array_values( $new_arr );
		
		
		
		$cl_no = $col_no;
		$new_col_string = "";
		
		foreach( $new_arr as $new_val){
			if( $new_val == 'column_'.$col_no){
				$col_no = $col_no + 1;
			}
		}
				
		global $arp_tempbuttonsarr;
		if( $has_caption == 0 ){

			if( ($col_no+1) % 5 == 1 ){
				$arp_classname = 'column_1';
				if( is_array( $new_arr ) and count( $new_arr ) > 0 ){
					$column_no = $new_arr[0];
				}
				else{
					$column_no = ( $has_caption == 0 ) ? 'column_0' : 'column_1';
				}
			} else if ( ($col_no+1) % 5 == 2 ){
				$arp_classname = 'column_2';
				if( is_array( $new_arr ) and count( $new_arr ) > 0 ){
					if( $new_arr[1] != '' )
						$column_no = $new_arr[1];
					else
						$column_no = $new_arr[0];
					
				}else{
					$column_no = ( $has_caption == 0 ) ? 'column_1' : 'column_2';
				}
			} else if ( ($col_no+1) % 5 == 3 ){
				$arp_classname = 'column_3';
				if( is_array( $new_arr ) and count( $new_arr ) > 0 ){
					if( $new_arr[2] != '' )
						$column_no = $new_arr[2];
					else
						$column_no = $new_arr[0];
				} else {
					$column_no = ( $has_caption == 0 ) ? 'column_2' : 'column_3';
				}
			} else if ( ($col_no+1) % 5 == 4 ){
				$arp_classname = 'column_4';
				if( is_array( $new_arr ) and count( $new_arr ) > 0 ){
					if( $new_arr[3] != '' )
						$column_no = $new_arr[3];
					else
						$column_no = $new_arr[0];
				} else {
					$column_no = ( $has_caption == 0 ) ? 'column_3' : 'column_4';
				}
			} else if ( ($col_no+1) % 5 == 0 ){
				$arp_classname = 'column_5';
				if( is_array( $new_arr ) and count( $new_arr ) > 0 )
					$column_no = $new_arr[0];
				else
					$column_no = ( $has_caption == 0 ) ? 'column_0' : 'column_1';
			}
		
		}else{
			if( $col_no % 5 == 1 ){
				$arp_classname = 'column_1';
				if( is_array( $new_arr ) and count( $new_arr ) > 0 ){
					$column_no = $new_arr[0];
				}
				else{
					$column_no = ( $has_caption == 0 ) ? 'column_0' : 'column_1';
				}
			} else if ( $col_no % 5 == 2 ){
				$arp_classname = 'column_2';
				if( is_array( $new_arr ) and count( $new_arr ) > 0 ){
					if( $new_arr[1] != '' )
						$column_no = $new_arr[1];
					else
						$column_no = $new_arr[0];
					
				}else{
					$column_no = ( $has_caption == 0 ) ? 'column_1' : 'column_2';
				}
			} else if ( $col_no % 5 == 3 ){
				$arp_classname = 'column_3';
				if( is_array( $new_arr ) and count( $new_arr ) > 0 ){
					if( $new_arr[2] != '' )
						$column_no = $new_arr[2];
					else
						$column_no = $new_arr[0];
				} else {
					$column_no = ( $has_caption == 0 ) ? 'column_2' : 'column_3';
				}
			} else if ( $col_no % 5 == 4 ){
				$arp_classname = 'column_4';
				if( is_array( $new_arr ) and count( $new_arr ) > 0 ){
					if( $new_arr[3] != '' )
						$column_no = $new_arr[3];
					else
						$column_no = $new_arr[0];
				} else {
					$column_no = ( $has_caption == 0 ) ? 'column_3' : 'column_4';
				}
			} else if ( $col_no % 5 == 0 ){
					$arp_classname = 'column_5';
				
				if( is_array( $new_arr ) and count( $new_arr ) > 0 )
					$column_no = $new_arr[0];
				else
					$column_no = ( $has_caption == 0 ) ? 'column_0' : 'column_1';
			}
		}		
		
		$column = $columns['columns'][$column_no];
				
		if( isset($column['ribbon_setting']) && is_array($column['ribbon_setting']) && isset($column['ribbon_setting']['ribbonimg']) && $column['ribbon_setting']['ribbonimg'] != '')
		{
			$has_ribbon = 'has_ribbon';
		}
		else
		{
			$has_ribbon = '';
		}
		
		$price_font_family = $column['price_font_family'];
		$price_font_size = $column['price_font_size'];
		if( $column['price_font_style'] == 'italic' ){
			$price_font_style = 'font-style:italic;';
			$price_font_weight = 'font-weight:normal;';
		} else {
			$price_font_style = 'font-style:normal;';
			$price_font_weight = 'font-weight:'.$column['price_font_style'].';';
		}
		
		$price_font_color = $column['price_font_color'];
		
		$price_text_font_family = $column['price_text_font_family'];
		$price_text_font_size = $column['price_text_font_size'];
		
		if( $column['price_text_font_style'] == 'italic' ){
			$price_text_font_style = 'font-style:italic;';
			$price_text_font_weight = 'font-weight:normal;';
		} else {
			$price_text_font_style = 'font-style:normal;';
			$price_text_font_weight = 'font-weight:'.$column['price_text_font_style'].';';
		}
		
		$price_text_font_color = $column['price_text_font_color'];
		
		$column_description_font_family = $column['column_description_font_family'];
		$column_description_font_size = $column['column_description_font_size'];
		
		if( $column['column_description_font_style'] == 'italic' ){
			$column_description_font_style = 'font-style:italic;';
			$column_description_font_weight = 'font-weight:normal;';
		} else {
			$column_description_font_style = 'font-style:normal;';
			$column_description_font_weight = 'font-weight:'.$column['column_description_font_style'].';';
		}
		
		$column_description_font_color = $column['column_description_font_color'];
		
		$new_col_string .= "<div id='main_column_".$col_no."' class='ArpPricingTableColumnWrapper no_transition no_animation no_effect ".$has_ribbon." style_column_".$packages."' data-caption='".$has_caption."' is_caption='0' dat-col-no='".$column_no."' template_type='".$template_type."' data-template_id='".$ref_template."' data-level='column_level_options' data-type='other_columns_buttons' style='"; if( $column['column_width'] != '' && $column['column_width'] > 0 ){ $new_col_string .= 'width:'.$column_width.'px;'; } else { $new_col_string .= 'width:'.$options['column_settings']['all_column_width'].$options['column_settings']['all_column_width_unit'].';'; } if( $options['column_settings']['space_between_column'] == 'yes' && $options['column_settings']['column_space'] != '' && $options['column_settings']['column_space'] > 0 ){ $new_col_string .= "margin-right:".$options['column_settings']['column_space'].'px'; } $new_col_string .= "' >";
			
			$new_col_string .= "<style type='text/css' data-position='inside'>";
		
			if( $template_type != 'advanced' ){
				
				$new_col_string .= ".".$template_name." .ArpPricingTableColumnWrapper.style_column_".$packages." .arp_price_wrapper{";
				
					$new_col_string .= "font-family:".$price_font_family.';';
					
					$new_col_string .= "font-size:".$price_font_size.'px;';
					
					//$new_col_string .= $price_font_style;
					
					//$new_col_string .= $price_font_weight;
					
					$new_col_string .= "color:".$price_font_color.";";
					
					if( $column['price_label_style_bold'] != '' )
						$new_col_string .= " font-weight: ".$column['price_label_style_bold'].";";
					
					if( $column['price_label_style_italic'] != '' )
						$new_col_string .= " font-style: ".$column['price_label_style_italic'].";";
			
					if( $column['price_label_style_decoration'] != '' )
						$new_col_string .= " text-decoration: ".$column['price_label_style_decoration'].";";
					
					
				
				$new_col_string .= "}";
				
			} else {
			
				$new_col_string .= ".".$template_name." .ArpPricingTableColumnWrapper.style_column_".$packages." .arp_price_wrapper .arp_price_value {";
						
						$new_col_string .= "font-family:".$price_font_family.';';
					
						$new_col_string .= "font-size:".$price_font_size.'px;';
						
						//$new_col_string .= $price_font_style;
						
						//$new_col_string .= $price_font_weight;
						
					$new_col_string .= "color:".$price_font_color.";";
					
					if( $column['price_label_style_bold'] != '' )
						$new_col_string .= " font-weight: ".$column['price_label_style_bold'].";";
					
					if( $column['price_label_style_italic'] != '' )
						$new_col_string .= " font-style: ".$column['price_label_style_italic'].";";
			
					if( $column['price_label_style_decoration'] != '' )
						$new_col_string .= " text-decoration: ".$column['price_label_style_decoration'].";";
												
				$new_col_string .= "}";
				
				$new_col_string .= ".".$template_name." .ArpPricingTableColumnWrapper.style_column_".$packages." .arp_price_wrapper .arp_price_duration{";
				
					$new_col_string .= "font-family:".$price_text_font_family.';';
					
					$new_col_string .= "font-size:".$price_text_font_size.'px;';
					
					//$new_col_string .= $price_text_font_style;
					
					//$new_col_string .= $price_text_font_weight;
					
					$new_col_string .= "color:".$price_text_font_color.";";
							
					if( $column['price_text_style_bold'] != '' )
						$new_col_string .= " font-weight: ".$column['price_text_style_bold'].";";
					
					if( $column['price_text_style_italic'] != '' )
						$new_col_string .= " font-style: ".$column['price_text_style_italic'].";";
					
					if( $column['price_text_style_decoration'] != '' )
						$new_col_string .= " text-decoration: ".$column['price_text_style_decoration'].";";		
				
				$new_col_string .= "}";						
			}
		
			$new_col_string .= ".".$template_name." .ArpPricingTableColumnWrapper.style_column_".$packages." .column_description{";
				
				$new_col_string .= "font-family:".$column_description_font_family.';';
				
				$new_col_string .= "font-size:".$column_description_font_size.'px;';
				
				
				$new_col_string .= 'color:'.$column_description_font_color.';';
				
				
				if( $column['column_description_style_bold'] != '' )
						$new_col_string .= " font-weight: ".$column['column_description_style_bold'].";";
					
				if( $column['column_description_style_italic'] != '' )
						$new_col_string .= " font-style: ".$column['column_description_style_italic'].";";
			
				if( $column['column_description_style_decoration'] != '' )
						$new_col_string .= " text-decoration: ".$column['column_description_style_decoration'].";";
				
				
			$new_col_string .= "}";
			
			$new_col_string .= ".".$template_name." .ArpPricingTableColumnWrapper.style_column_".$packages. " ul.arppricingtablebodyoptions li{";
				if( $column['body_li_style_decoration'] != '' )
					$new_col_string .= " text-decoration: ".$column['body_li_style_decoration'].";";
			$new_col_string .= "}";
			
			$new_col_string .= ".".$template_name." .ArpPricingTableColumnWrapper.style_column_".$packages. " ul.arppricingtablebodyoptions li span.caption_li{";
					if( $column['body_label_style_decoration'] != '' )
						$new_col_string .= " text-decoration: ".$column['body_label_style_decoration'].";";			
			$new_col_string .= "}";
			
			
			
			if($ref_template  == 'arptemplate_15'){
					$new_col_string .=  ".".$template_name." .ArpPricingTableColumnWrapper.style_column_".$packages." .arp_price_duration{";
						$new_col_string .= "margin-top:".(($column['price_font_size'] - $column['price_text_font_size']) +10 )."px;";
	 				$new_col_string .= "}";
			}
		
		
		$new_col_string .= "</style>";
			
			$new_col_string .= "<div class='arpplan ".$arp_classname."'>";
				
				
				if( $column['arp_header_shortcode'] != '' )
					$header_cls = 'has_arp_shortcode';
				else
					$header_cls = '';
				
				if( $ref_template == 'arptemplate_15' )
					$new_col_string .= "<div class='arp_template_rocket'><div></div></div>";
				
				if( $column['ribbon_setting'] and $column['ribbon_setting']['arp_ribbon'] != '' and $column['ribbon_setting']['arp_ribbon_content'] != ''){		
					$arp_ribbon_class=$column['ribbon_setting']['arp_ribbon'];
				}
				else
				{
					$arp_ribbon_class="";
				}
				$new_col_string .= "<div class='planContainer ".$arp_ribbon_class."' >";
				
					if( $column['ribbon_setting'] and $column['ribbon_setting']['arp_ribbon'] != '' and $column['ribbon_setting']['arp_ribbon_content'] != ''){
						$basic_col = $arp_mainoptionsarr['general_options']['arp_basic_colors'];
						$ribbon_bg_col = $column['ribbon_setting']['arp_ribbon_bgcol'];
						$base_color = $ribbon_bg_col;
						$base_color_key = array_search($base_color,$basic_col);
						$gradient_color = $arp_mainoptionsarr['general_options']['arp_basic_colors_gradient'][$base_color_key];
						$new_col_string .= "<div id='arp_ribbon_container' class='arp_ribbon_container arp_ribbon_".strtolower($column['ribbon_setting']['arp_ribbon_position'])." ".$column['ribbon_setting']['arp_ribbon']." ' >";
						
							$new_col_string .= "<style type='text/css'>";
							if( in_array( $base_color,$basic_col ) ){
								if( $column['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_1' or $column['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3'){
									$new_col_string .= "#main_column_".$col_no." .arp_ribbon_content:before, #main_column_".$col_no." .arp_ribbon_content:after{";
										$new_col_string .= "border-top-color:".$gradient_color." !important;";
									$new_col_string .= "}";
								}
								if( $column['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3'){
									$new_col_string .= "#main_column_".$col_no." .arp_ribbon_content{";
										$new_col_string .= "border-top:75px solid ".$base_color.";";
										$new_col_string .= "color:".$column['ribbon_setting']['arp_ribbon_txtcol'].";";
									$new_col_string .= "}";
								} else {
									$new_col_string .= "#main_column_".$col_no." .arp_ribbon_content{";
										$new_col_string .= "background:".$base_color.";";
										$new_col_string .= "background-color:".$base_color.";";
										$new_col_string .= "background-image:-moz-linear-gradient(top, ".$base_color.", ".$gradient_color.");";
										$new_col_string .= "background-image:-webkit-gradient(linear, 0 0, 0 100%, from(".$base_color."), to(".$gradient_color."));";
										$new_col_string .= "background-image:-webkit-linear-gradient(top, ".$base_color.", ".$gradient_color.");";
										$new_col_string .= "background-image:-o-linear-gradient(top, ".$base_color.", ".$gradient_color.");";
										$new_col_string .= "background-image:linear-gradient(to bottom, ".$base_color.", ".$gradient_color.");";
										$new_col_string .= "background-repeat:repeat-x;";
										$new_col_string .= "filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='".$base_color."', endColorstr='".$gradient_color."', GradientType=0);";
										$new_col_string .= '-ms-filter: "progid:DXImageTransform.Microsoft.gradient (startColorstr="'.$base_color.'", endColorstr="'.$gradient_color.'", GradientType=0)";';
										$new_col_string .= "box-shadow:0 0 3px rgba(0,0,0,0.3);";
										$new_col_string .= "color:".$column['ribbon_setting']['arp_ribbon_txtcol'].";";
									$new_col_string .= "}";
								}
							} else {
								if( $column['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_1' or $column['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3'){
									$new_col_string .= "#main_column_".$col_no." .arp_ribbon_content:before,#main_column_".$col_no." .arp_ribbon_content:after{";
										$new_col_string .= "border-top-color:".$base_color."  !important;";
									$new_col_string .= "}";
								}
								if( $column['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3'){
									$new_col_string .= "#main_column_".$col_no." .arp_ribbon_content{";
										$new_col_string .= "border-top:75px solid ".$base_color.";";
										$new_col_string .= "color:".$column['ribbon_setting']['arp_ribbon_txtcol'].";";
									$new_col_string .= "}";
								} else {
									$new_col_string .= "#main_column_".$col_no." .arp_ribbon_content{";
										$new_col_string .= "background:".$base_color.";";
										$new_col_string .= "color:".$column['ribbon_setting']['arp_ribbon_txtcol'].";";
									$new_col_string .= "}";
								}
							}
							$new_col_string .= "</style>";
						
							$new_col_string .= "<div class='arp_ribbon_content arp_ribbon_".strtolower($column['ribbon_setting']['arp_ribbon_position'])."'>";
								if( $column['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3' )
									$new_col_string .= "<span>";
								$new_col_string .= $column['ribbon_setting']['arp_ribbon_content'];
								if( $column['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3' )
									$new_col_string .= "</span>";
							$new_col_string .= "</div>";
							
						$new_col_string .= "</div>";
					}
					
					$new_col_string .= "<div class='arpcolumnheader ".$header_cls."'>";
						if( $features['header_shortcode_position'] == 'default' && ( $ref_template == 'arptemplate_2' ||  $ref_template == 'arptemplate_5')  ){
							$new_col_string .= "<div class='arp_header_selection_new' data-template_id='".$ref_template."' data-level='header_level_options' data-type='other_columns_buttons' data-column='main_column_".$col_no."'>";
						}
						if( $column['arp_header_shortcode'] != '' && $features['header_shortcode_position'] == 'position_1' )
						{
							
							// Start 
							if( $features['header_shortcode_position'] == 'position_1' && ($ref_template == 'arptemplate_8' or $ref_template == 'arptemplate_7') ){
								$new_col_string .= "<div class='arp_header_selection_new' data-template_id='".$ref_template."' data-level='header_level_options' data-type='other_columns_buttons'  data-column='main_column_".$col_no."'>";
							}
							$new_col_string .= "<div class='arp_header_shortcode'>";
								
									if( $features['header_shortcode_type'] == 'normal' )
										$new_col_string .= do_shortcode( $column['arp_header_shortcode'] );
									else if( $features['header_shortcode_type'] == 'rounded_corner' )
									{
										$new_col_string .= "<div class='rounded_corder'>".do_shortcode( $column['arp_header_shortcode'] )."</div>";
									}	
								
							$new_col_string .= "</div>";
					
						}
					
						$ribbon_cls = @$this->get_ribbon_type($column['ribbon_setting']['ribbonimg']);
										
						if( preg_match('/_5/i',@$column['ribbon_setting']['ribbonimg']) && @$column['ribbon_setting']['ribbonposition'] == 'left' )
						{
							$title_cls = 'left_plan_title';
						}
						else if( preg_match('/_5/i',@$column['ribbon_setting']['ribbonimg']) && @$column['ribbon_setting']['ribbonposition'] == 'right' )
						{
							$title_cls = 'right_plan_title';
						}
						else if( !preg_match('/_5/i',@$column['ribbon_setting']['ribbonimg']) )
						{
							$title_cls = '';
						}
						
						if( $ref_template == 'arptemplate_7' || $ref_template == 'arptemplate_3' ){
							$new_col_string .= "<div class='arp_header_selection_new' data-template_id='".$ref_template."' data-level='header_level_options' data-type='other_columns_buttons' data-column='main_column_".$col_no."'>";
						}
						
						$new_col_string .= "<div id='column_header' class='arppricetablecolumntitle' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='header_level_options' data-type='other_columns_buttons'>";
							
							$header_font_family = 'font-family:'.$column['header_font_family'].';';
							
							$header_font_size = 'font-size:'.$column['header_font_size'].'px;';
							
							
							if( $column['header_style_bold'] != '' )
								$header_font_style .= " font-weight: ".$column['header_style_bold'].";";
					
							if( $column['header_style_italic'] != '' )
								$header_font_style .= " font-style: ".$column['header_style_italic'].";";
			
							if( $column['header_style_decoration'] != '' )
								$header_font_style .= " text-decoration: ".$column['header_style_decoration'].";";
								
						
							
							$header_font_color = 'color:'.$column['header_font_color'].';';
							
							$new_col_string .= "<div class='bestPlanTitle ".@$title_cls."' style='".@$header_font_family.@$header_font_size.@$header_font_style.@$header_font_color."'>";
								
								$new_col_string .= $column['package_title'];
								
							$new_col_string .= "</div>";
							
							if( $features['header_shortcode_position'] == 'position_1'&& ($ref_template == 'arptemplate_8' or $ref_template == 'arptemplate_7') ){
								$new_col_string .= "</div>";
							}
							if( $features['column_description'] == 'enable' && $features['column_description_style'] == 'style_1' && $column['column_description'] != '' )
							{
								$new_col_string .= "<div class='column_description ".@$title_cls."'>".@$column['column_description']."</div>";
							}
						
						$new_col_string .= "</div>";
						
						if( $features['column_description'] == 'enable' && $features['column_description_style'] == 'style_3' && $column['column_description'] != '' )
						{
							$new_col_string .= "<div class='column_description ".@$title_cls."'>".@$column['column_description']."</div>";
						}
						
						if( $ref_template == 'arptemplate_7' || $ref_template == 'arptemplate_3' ){
							$new_col_string .= "</div>";
						}
						
						if( $features['button_position'] == 'position_2' )
						{
						
							$button_font_family = 'font-family:'.$column['button_font_family'].';';	
							$button_font_size = 'font-size:'.$column['button_font_size'].'px;';
							
							if( @$column['button_style_bold'] != '' )
								$button_font_style .= " font-weight: ".$column['button_style_bold'].";";
					
							if( @$column['button_style_italic'] != '' )
								$button_font_style .= " font-style: ".$column['button_style_italic'].";";
			
							if( @$column['button_style_decoration'] != '' )
								$button_font_style .= " text-decoration: ".$column['button_style_decoration'].";";
								
							
							
							$button_font_color = 'color:'.$column['button_font_color'].';';
							
							$new_col_string .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
								$new_col_string .= "<div class='arppricetablebutton' style='text-align:center;'>
									<button type='button' id='bestPlanButton' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' id='arppricetablebutton' class='bestPlanButton arp_".strtolower($column['button_size'])."_btn' "; if($column['btn_img'] != ""){ $new_col_string .= "style='background:url(".$column['btn_img'].") no-repeat !important;width:".$column['btn_img_width']."px;height:".$column['btn_img_height']."px;'"; }else { $new_col_string .= "style='".$button_font_family.$button_font_size.$button_font_style.$button_font_color."'"; } $new_col_string .= " '>"; if($column['btn_img'] == ""){ $new_col_string .= stripslashes_deep($column['button_text']); } $new_col_string .= "</button>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							
						}
												
						if( $features['header_shortcode_position'] == 'default' )
						{
							if( $column['arp_header_shortcode'] != '' && $features['header_shortcode_type'] == 'normal')
								$new_col_string .= "<div class='arp_header_shortcode'>".$arprice_form->arp_get_video_image($column['arp_header_shortcode'])."</div>";
							else if( $features['header_shortcode_type'] == 'rounded_border' )
								$new_col_string .= "<div class='rounded_corder'>".do_shortcode( $column['arp_header_shortcode'] )."</div>";
						}
						if( $features['header_shortcode_position'] == 'default' && ( $ref_template == 'arptemplate_2' ||  $ref_template == 'arptemplate_5')  ){
							$new_col_string .= "</div>";
						}
						
						$amount_style_cls = ($features['amount_style'] == 'style_2') ? 'style_2' : '';
						$new_col_string .= "<div class='arppricetablecolumnprice ".$amount_style_cls."' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='pricing_level_options' data-type='other_columns_buttons'>";
							
						if( $features['amount_style'] == 'default' )
						{
							$new_col_string .= "<div class='arp_price_wrapper'>";
								
								if( $ref_template == 'arptemplate_1' ){
								
									$new_col_string .= $column['price_text'];
								
								} else if( $ref_template == 'arptemplate_4' ){
									
									$new_col_string .= "<div class='arpmain_price'>";
										
										$new_col_string .= "<div class='arp_pricerow'>";
										
											$new_col_string .= "<span class=\"arp_price_value\">";
											
												$new_col_string .= $column['price_text'];
												
											$new_col_string .= "</span>";
											
											$new_col_string .= "<span class=\"arp_price_duration\">";
										
												$new_col_string .= $column['price_label'];
											
											$new_col_string .= "</span>";
										
										$new_col_string .= "</div>";
										
									$new_col_string .= "</div>"; 
									
								} else {
								
									$new_col_string .= "<span class=\"arp_price_value\">";
									
										$new_col_string .= $column['price_text'];
									
									$new_col_string .= "</span>";
											
									$new_col_string .= "<span class=\"arp_price_duration\">";
									
										$new_col_string .= $column['price_label'];
									
									$new_col_string .= "</span>";
								
								}
								
							$new_col_string .= "</div>";
						
						//$new_col_string .= $columns['html_content'];
							$new_col_string .= $column['html_content']; 
						}
						else if( $features['amount_style'] == 'style_1' )
						{
							$new_col_string .= "<div class='arp_pricename'>";

								$new_col_string .= "<div class='arp_price_wrapper'>";
								
									$new_col_string .= "<span class=\"arp_price_value\">";

										$new_col_string .= $column['price_text'];
									
									$new_col_string .= "</span>";
									
									$new_col_string .= "<span class=\"arp_price_duration\">";
											
 										$new_col_string .= $column['price_label'];
									
									$new_col_string .= "</span>";

								$new_col_string .= "</div>";

							$new_col_string .= "</div>";
						} else if( $features['amount_style'] == 'style_2' ){
						
								$new_col_string .= "<div class='arp_price_wrapper'>";
									
									if( $ref_template == 'arptemplate_11' ){
										$new_col_string .= "<div class='arp_pricename_selection_new' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='pricing_level_options' data-type='other_columns_buttons'>";
									}
									$new_col_string .= "<span class=\"arp_price_duration\">";
									
									$new_col_string .= $column['price_label'];
							
									$new_col_string .= "</span>";
											
									$new_col_string .= "<span class=\"arp_price_value\">";
								
										$new_col_string .= $column['price_text'];
									
									$new_col_string .= "</span>";
									
									if( $ref_template == 'arptemplate_11' ){
										$new_col_string .= "</div>";
									}
							
								$new_col_string .= "</div>";
							
								$new_col_string .= do_shortcode( $column['html_content'] );
						}
						
						if( $features['ribbon_type'] == 'custom_style_1' && $features['custom_ribbon'] == 'enable' )
						{
							$new_col_string .= "<div class='custom_seperator_1'></div>
								<div class='custom_ribbon_wrapper'>
								<div class='custom_ribbon'>".$column['custom_ribbon_txt']."</div>";
									if( $features['column_description'] == 'enable' && $features['column_description_style'] == 'style_2' && $column['column_description'] != '')
									{
										$new_col_string .= "<div class='column_description'>".$column['column_description']."</div>";
									}
								
							$new_col_string .= "</div>";
						
						}
						
						if( $column['column_description'] != '' && $features['column_description'] == 'enable' && $features['column_description_style'] == 'style_4' )
						{
							$new_col_string .= "<div class='column_description'>".$column['column_description']."</div>";
						}
						
						if( $features['button_position'] == 'position_1' )
						{
						
							$button_font_family = 'font-family:'.$column['button_font_family'].';';	
							$button_font_size = 'font-size:'.$column['button_font_size'].'px;';
							
							if( $column['button_style_bold'] != '' )
								$button_font_style .= " font-weight: ".$column['button_style_bold'].";";
					
							if( $column['button_style_italic'] != '' )
								$button_font_style .= " font-style: ".$column['button_style_italic'].";";
			
							if( $column['button_style_decoration'] != '' )
								$button_font_style .= " text-decoration: ".$column['button_style_decoration'].";";
								
							
							
							$button_font_color = 'color:'.$column['button_font_color'].';';
							
							$new_col_string .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
							$new_col_string .= "<div class='arppricetablebutton' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' id='arppricetablebutton' style='text-align:center;'>
								<button type='button' id='bestPlanButton' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' class='bestPlanButton arp_".strtolower($column['button_size'])."_btn' "; if($column['btn_img'] != ""){ $new_col_string .= "style='background:url(".$column['btn_img'].") no-repeat !important;width:".$column['btn_img_width']."px;height:".$column['btn_img_height']."px;'"; }else { $new_col_string .= "style='".$button_font_family.$button_font_size.$button_font_style.$button_font_color."'"; } $new_col_string .= ">"; if($column['btn_img'] == ""){ $new_col_string .= stripslashes_deep($column['button_text']); } $new_col_string .= "</button>";
								
							$new_col_string .= "</div>";
							$new_col_string .= "</div>";
						}
						
						$new_col_string .= "</div>";
						
						if( $column['arp_header_shortcode'] != '' && $features['header_shortcode_position'] == 'position_2') 
						{
							$new_col_string .= "<div class='arp_header_shortcode'>";
							
								if( $features['header_shortcode_type'] == 'normal' )
									$new_col_string .= do_shortcode( $column['arp_header_shortcode'] );
								else if( $features['header_shortcode_type'] == 'rounded_corner' )
									$new_col_string .= "<div class='rounded_corder'>".do_shortcode( $column['arp_header_shortcode'] )."</div>";

							$new_col_string .= "</div>";										
						}
					
					$new_col_string .= "</div>";
										
					$new_col_string .= "<div id='arppricingtablebodycontent' class='arpbody-content arppricingtablebodycontent' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='body_level_options' data-type='other_columns_buttons'>";
					
				/// 05dec2014	
									
					if(  $features['button_position'] == 'position_3' ){
					
					$new_col_string .= "<div class='column_description ".$title_cls."'>".$column['column_description']."</div>";
							
					$button_font_family = 'font-family:'.$column['button_font_family'].';';	
							$button_font_size = 'font-size:'.$column['button_font_size'].'px;';
							
							
							if( $column['button_style_bold'] != '' )
								$button_font_style .= " font-weight: ".$column['button_style_bold'].";";
					
							if( $column['button_style_italic'] != '' )
								$button_font_style .= " font-style: ".$column['button_style_italic'].";";
			
							if( $column['button_style_decoration'] != '' )
								$button_font_style .= " text-decoration: ".$column['button_style_decoration'].";";
								
							
							
							$button_font_color = 'color:'.$column['button_font_color'].';';
							
							$new_col_string .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
							$new_col_string .= "<div class='arppricetablebutton' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' id='arppricetablebutton' style='text-align:center;'>
								<button type='button' id='bestPlanButton' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' class='bestPlanButton arp_".strtolower($column['button_size'])."_btn' "; if($column['btn_img'] != ""){ $new_col_string .= "style='background:url(".$column['btn_img'].") no-repeat !important;width:".$column['btn_img_width']."px;height:".$column['btn_img_height']."px;'"; }else { $new_col_string .= "style='".$button_font_family.$button_font_size.$button_font_style.$button_font_color."'"; } $new_col_string .= ">"; if($column['btn_img'] == ""){ $new_col_string .= stripslashes_deep($column['button_text']); } $new_col_string .= "</button>";
								
							$new_col_string .= "</div>";
							$new_col_string .= "</div>";		
										
						}
						/// 05dec2014						
						
						
						
						$content_font_family = 'font-family:'.$column['content_font_family'].';';
						$content_font_size = 'font-size:'.$column['content_font_size'].'px;';
						
						
						if( $column['body_li_style_bold'] != '' )
								$content_font_style .= " font-weight: ".$column['body_li_style_bold'].";";
					
						if( $column['body_li_style_italic'] != '' )
								$content_font_style .= " font-style: ".$column['body_li_style_italic'].";";
			
						if( $column['body_li_style_decoration'] != '' )
								$content_font_style .= " text-decoration: ".$column['body_li_style_decoration'].";";
						
						
						
						$content_font_color = 'color:'.$column['content_font_color'].';';
						
						$content_label_font_family = 'font-family:'.@$column['content_label_font_famliy'].';';
						$content_label_font_size = 'font-size:'.@$column['content_label_font_size'].'px;';
						
						if( $column['body_label_style_bold'] != '' )
							$content_label_font_style .= " font-weight: ".$column['body_label_style_bold'].";";
					
						if( $column['body_label_style_italic'] != '' )
							$content_label_font_style .= " font-style: ".$column['body_label_style_italic'].";";
		
						if( $column['body_label_style_decoration'] != '' )
							$content_label_font_style .= " text-decoration: ".$column['body_label_style_decoration'].";";
								
						
						
						$content_label_font_color = 'color:'.$column['content_label_font_color'].';';
						
						if( @$features['caption_style'] == 'default' || @$features['caption_style'] == 'none' ){
							$content_style = @$content_font_family.@$content_font_size.@$content_font_style.@$content_font_color;
						} else {
							$content_style = "";
						}
						
						$new_col_string .= "<ul id='column_".$col_no."' class='arp_opt_options arppricingtablebodyoptions' style='".$content_style."text-align:".$column['body_text_alignment']."' >";

							$r = 0;

							$maxrowcount = 0;
							
							$table_cols = $columns['columns'];
							
							if(is_array($table_cols))
							{
								foreach($table_cols as $countcol )
								{
									if($countcol['rows'] && count($countcol['rows']) > $maxrowcount)
										$maxrowcount = count($countcol['rows']); 
								}	
								$maxrowcount--;
							}
							
							$row_order= @$column['row_order'];										
														
							if( $row_order && is_array( $row_order ) )
							{
								$rows = array();
								asort($row_order);
								$ji = 0;
								$maxorder = max($row_order) ? max($row_order) : 0;
								foreach($column['rows'] as $rowno => $row)
								{	
									$row_order[ $rowno ] = isset( $row_order[ $rowno ] ) ? $row_order[ $rowno ] : ($maxorder+1);
								}								
								foreach( $row_order as $row_id => $order_id )
								{
									if( $column['rows'][ $row_id ] )
									{
										$rows[ 'row_'.$ji ] = $column['rows'][ $row_id ]; 		
										$ji++;
									}
								}
								$column['rows'] = $rows;
							}
							
							if( $has_caption == 1 and ( $features['caption_style'] == 'style_1' or $features['caption_style'] == 'style_2' ) )
							{
								for($i = 0;$i <= $maxrowcount; $i++ )
								{
									$rows = isset($column['rows']['row_'.$i]) ? $column['rows']['row_'.$i] : array();
									$caption_li[$i] = stripslashes_deep($rows['row_description']);
								}
							}
							
							for($ri=0; $ri <= $maxrowcount; $ri++)
							{
								if($col_no % 2 == 0)
								{
									if(($ri+1) % 2 == 0)
									{
										$cls = 'rowdarkcolorstyle';
									}
									else
									{
										$cls = '';
									}
								}
								else
								{
									if(($ri+1) % 2 == 0)
									{
										$cls = 'rowlightcolorstyle';
									}
									else
									{
										$cls = '';
									}
								}

								if( $features['caption_style'] == 'style_1' and $features['list_alignment'] != 'default' ){
									$new_col_string .= "<li data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='body_li_level_options' data-type='other_columns_buttons' class=' arpbodyoptionrow ".$cls."' id='arp_row_".$ri."'>";
									$new_col_string .= "<span class='caption_li' style='".$content_label_font_family.$content_label_font_size.$content_label_font_style.$content_label_font_weight.$content_label_font_color."'>".(!empty($column['rows']['row_'.$ri]['row_label']) ? stripslashes_deep($column['rows']['row_'.$ri]['row_label']) : '&nbsp;')."</span>";
									$new_col_string .= "<span class='caption_detail'  style='".$content_font_family.$content_font_size.$content_font_style.$content_font_weight.$content_font_color."'>".((!empty($column['rows']['row_'.$ri]['row_description'])) ? stripslashes_deep($column['rows']['row_'.$ri]['row_description']) :'&nbsp;' )."</span>
									</li>";                                    
								} else if( $features['caption_style'] == 'style_2' ) {
										
									$new_col_string .= "<li data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='body_li_level_options' data-type='other_columns_buttons' class=' arpbodyoptionrow ".$cls."' id='arp_row_".$ri."'";
									$new_col_string .= ">";
									$new_col_string .= "<span class='caption_detail' style='".$content_font_family.$content_font_size.$content_font_style.$content_font_weight.$content_font_color."' >".((!empty($column['rows']['row_'.$ri]['row_description'])) ? stripslashes_deep($column['rows']['row_'.$ri]['row_description']) :'&nbsp;' )."</span>";
									$new_col_string .= "<span class='caption_li' style='".$content_label_font_family.$content_label_font_size.$content_label_font_style.$content_label_font_weight.$content_label_font_color."'>".(!empty($column['rows']['row_'.$ri]['row_label']) ? stripslashes_deep($column['rows']['row_'.$ri]['row_label']) : '&nbsp;')."</span>";
									$new_col_string .= "</li>";
									
									
								}
								else if( $features['list_alignment'] != 'default' )
								{  
									$new_col_string .= "<li data-template_id='".$ref_template."' data-level='body_li_level_options' data-type='other_columns_buttons' class='arpbodyoptionrow ".$cls."' id='arp_row_".$ri."' style='' data-column='main_column_".$col_no."' >";
									$new_col_string .= "<span class='' title=''>".((!empty($column['rows']['row_'.$ri]['row_description'])) ? stripslashes_deep($column['rows']['row_'.$ri]['row_description']) :'&nbsp;' )."</span>
								   </li>";
								}
								else
								{ 
									$new_col_string .= "<li data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='body_li_level_options' data-type='other_columns_buttons' class='arpbodyoptionrow ".$cls; if($rows['row_tooltip'] != ""){ $new_col_string .= " arp_tooltip_li"; } $new_col_string .= "' id='arp_row_".$ri."' style='text-align:"; /*if($column['rows']['row_'.$ri]['row_des_txt_align'] == 'right'){ $new_col_string .= "right";} else if($column['rows']['row_'.$ri]['row_des_txt_align'] == 'left'){ $new_col_string .= "left";} else { $new_col_string .= "center"; }*/ $new_col_string .= "' >";
									
									$new_col_string .= "<span class=''>".((!empty($column['rows']['row_'.$ri]['row_description'])) ? stripslashes_deep($column['rows']['row_'.$ri]['row_description']) :'&nbsp;' )."</span>
								   </li>";
								}
							}
						
						$new_col_string .= "</ul>";
					$new_col_string .= "</div>";
					
					
						// TMP5
							if($features['amount_style'] == 'style_3'){
							$new_col_string .= "<div class='arppricetablecolumnprice' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='pricing_level_options' data-type='other_columns_buttons' >";
    													$new_col_string .= "<div class='arp_price_wrapper'>";
														
															$new_col_string .= "<span class=\"arp_price_duration\">";
														
																$new_col_string .= $column['price_label'];
															
															$new_col_string .= "</span>";
															
															$new_col_string .= "<span class=\"arp_price_value\">";
											
																$new_col_string .= $column['price_text'];
																
															$new_col_string .= "</span>";
																
														$new_col_string .= "</div>";
														$new_col_string .= do_shortcode( $column['html_content'] );
												 
											
								if( $features['button_position'] == 'position_4' )
									{
									
							$button_font_family = 'font-family:'.$column['button_font_family'].';';	
							$button_font_size = 'font-size:'.$column['button_font_size'].'px;';
							
							if( $column['button_style_bold'] != '' )
								$button_font_style .= " font-weight: ".$column['button_style_bold'].";";
					
							if( $column['button_style_italic'] != '' )
								$button_font_style .= " font-style: ".$column['button_style_italic'].";";
			
							if( $column['button_style_decoration'] != '' )
								$button_font_style .= " text-decoration: ".$column['button_style_decoration'].";";
	
							/*
							if( $column['button_font_style'] == 'italic' ){
								$button_font_style = 'font-style:italic;';
								$button_font_weight = 'font-weight:normal;';
							} else {
								$button_font_style = 'font-style:normal;';
								$button_font_weight = 'font-weight:'.$column['button_font_style'].';';
							}*/
							
							$button_font_color = 'color:'.$column['button_font_color'].';';
							
							$new_col_string .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
								$new_col_string .= "<div class='arppricetablebutton' style='text-align:center;'>
									<button type='button' id='bestPlanButton' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' id='arppricetablebutton' class='bestPlanButton arp_".strtolower($column['button_size'])."_btn' "; if($column['btn_img'] != ""){ $new_col_string .= "style='background:url(".$column['btn_img'].") no-repeat !important;width:".$column['btn_img_width']."px;height:".$column['btn_img_height']."px;'"; }else { $new_col_string .= "style='".$button_font_family.$button_font_size.$button_font_style.$button_font_color."'"; } $new_col_string .= " '>"; if($column['btn_img'] == ""){ $new_col_string .= stripslashes_deep($column['button_text']); } $new_col_string .= "</button>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
									
													  
													  
													
													
												}
												
								$new_col_string .= "</div>";	
							}
											
					if( $features['button_position'] == 'default' )
					{                        
						$new_col_string .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
						
							if($column['button_text'] == '' && $column['btn_img'] == "")
							{                                
								$new_col_string .= "<div class='arppricetablebutton'>&nbsp;</div>";                                
							}
							else
							{
								$button_font_family = 'font-family:'.stripslashes_deep($column['button_font_family']).';';	
								$button_font_size = 'font-size:'.$column['button_font_size'].'px;';
								
								$second_button_font_family = 'font-family:'.stripslashes_deep($column['second_button_font_family']).';';
								$second_button_font_size = 'font-size:'.$column['second_button_font_size'].'px;';
								
								
								if( $column['button_style_bold'] != '' )
									$button_font_style .= " font-weight: ".$column['button_style_bold'].";";
					
								if( $column['button_style_italic'] != '' )
									$button_font_style .= " font-style: ".$column['button_style_italic'].";";
			
								if( $column['button_style_decoration'] != '' )
									$button_font_style .= " text-decoration: ".$column['button_style_decoration'].";";
	
								
								
								if( $column['second_button_font_style'] == 'italic' ){
									$second_button_font_style = 'font-style:italic;';
									$second_button_font_weight = 'font-weight:normal;';
								} else {
									$second_button_font_style = 'font-style:normal;';
									$second_button_font_weight = 'font-weight:'.$column['second_button_font_weight'].';';
								}
								
								$button_font_color = 'color:'.$column['button_font_color'].';';
								
								$second_button_font_color = 'color:'.$column['second_button_font_color'].';';
								
							 	if( $features['second_btn'] == true && $column['button_s_text'] != '' ){
									$btn_cls = 'has_second_btn';
								} else {
									$btn_cls = 'no_second_btn';
								}
								$new_col_string .= "<div class='arppricetablebutton' id='arppricetablebutton' style='text-align:center;' data-column='main_column_".$col_no."'>
									<button type='button' data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' class='bestPlanButton arp_".strtolower($column['button_size'])."_btn ".$btn_cls."' id='bestPlanButton' "; if($column['btn_img'] != ""){ $new_col_string .= "style='background:url(".$column['btn_img'].") no-repeat !important; width:".$column['btn_img_width']."px;height:".$column['btn_img_height']."px;'"; }else { $new_col_string .= "style='".$button_font_family.$button_font_size.$button_font_style.$button_font_color."'"; } $new_col_string .= ">"; if($column['btn_img'] == ""){ $new_col_string .= stripslashes_deep($column['button_text']); } $new_col_string .= "</button>";
									if( $features['second_btn'] == true && $column['button_s_text'] != '' ){
										if( $column['button_text'] != '' ){
											$cls_1 = 'has_first_btn';
										} else {
											$cls_1 = 'no_first_btn';
										}
										$new_col_string .= "<button data-column='main_column_".$col_no."' data-template_id='".$ref_template."' data-level='second_button_options' data-type='other_columns_buttons' type='button' class='bestPlanButton arp_".strtolower($column['button_s_size'])."_btn SecondBestPlanButton ".$cls_1."' id='bestPlanButton' ";
											if( $column['btn_s_img'] != '' ){
												$new_col_string .= "style='background:url(".$column['btn_s_img'].") no-repeat; width:".$column['btn_s_img_width']."px;height:".$column['btn_s_img_height']."px;'";
											} else {
												$new_col_string .= "style='".$second_button_font_family.$second_button_font_size.$second_button_font_style.$second_button_font_weight.$second_button_font_color."'";
											}
											$new_col_string .= ">";
											if( $column['btn_s_img'] == "" ){ $new_col_string .= stripslashes_deep($column['button_s_text']); }
										$new_col_string .= "</button>";
									}
								$new_col_string .= "</div>";
								
								if( $ref_template == 'arptemplate_16' ){
								
									$new_col_string .= "<div class='arp_bottom_image'>";
								
										$new_col_string .= "<ul class='arp_boat_img'><li></li></ul>";
								
										$new_col_string .= "<ul class='arp_water_imgs'>";
								
											$new_col_string .= "<li class='arp_water_img_1'></li>";
								
											$new_col_string .= "<li class='arp_water_img_2'></li>";
								
										$new_col_string .= "</ul>";
								
									$new_col_string .= "</div>";
									
								}
							}
						
						$new_col_string .= "</div>";
					} 
					
					if( $features['column_description'] == 'enable' and $features['column_description_style'] == 'after_button' ){
						$new_col_string .= "<div class='column_description ".$title_cls."'>".stripslashes_deep($column['column_description'])."</div>";
					}
					
				$new_col_string .= "</div>";
				
			$new_col_string .= "</div>";
			
			
			$new_col_string .= "<div class='column_level_settings' id='column_level_settings_new' data-column='main_column_".$col_no."'>";
			
				$new_col_string .= "<div class='btn-main'>";
			
					
					// Column Level Options
					$new_col_string .= "<div class='btn' id='column_level_options__button_1' data-level='column_level_options' title='".__('Column Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/general-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='column_level_options__button_2' data-level='column_level_options' style='display:none;' title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-setting-icon.png'></div>";
					
					//$new_col_string .= "<div class='btn' id='column_level_options__button_action_duplicate' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/general-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' col-id=".$col_no." id='duplicate_column' style='display:none;' title='".__('Duplicate Column',ARP_PT_TXTDOMAIN)."' data-title='".__('Duplicate Column',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/duplicate-icon2.png'></div>";
					$new_col_string .= "<div class='btn' col-id=".$col_no." id='delete_column' style='display:none;' title='".__('Delete Column',ARP_PT_TXTDOMAIN)."' data-title='".__('Delete Column',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/delete-icon2.png'></div>";					
					
					// Header Level Options
					$new_col_string .= "<div class='btn' id='header_level_options__button_1' data-level='header_level_options' title='".__('Header Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Header Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='header_level_options__button_2' data-level='header_level_options' style='display:none;' title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='header_level_options__button_3' data-level='header_level_options' title='".__('Shortcode Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Shortcode Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/shortcode-setting-icon.png'></div>";
					
					// Pricing Level Options
					$new_col_string .= "<div class='btn' id='pricing_level_options__button_1' data-level='pricing_level_options' style='display:none;' title='".__('Price Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Price Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='pricing_level_options__button_2' data-level='pricing_level_options' style='display:none;' title='".__('Price Interval Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Price Interval Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='pricing_level_options__button_3' data-level='pricing_level_options' style='display:none;' title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-icon3.png'></div>";
					
					// Body Level Options
					$new_col_string .= "<div class='btn' id='body_level_options__button_1' data-level='body_level_options' style='display:none;' title='".__('Content Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Content Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='body_level_options__button_2' data-level='body_level_options' style='display:none;' title='".__('Content Label Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Content Label Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-lable-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='body_level_options__button_3' data-level='body_level_options' title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-setting-icon.png'></div>";
					
					//$new_col_string .= "<div class='btn' id='add_new_row' data-id='".$col_no[1]."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/general-setting-icon.png'></div>";
					
					// Body LI Options
					$new_col_string .= "<div class='btn' id='body_li_level_options__button_1' data-level='body_li_level_options' style='display:none;' title='".__('Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Description Settings',ARP_PT_TXTDOMAIN)."' ><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='body_li_level_options__button_2' data-level='body_li_level_options' title='".__('Tooltip Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Tooltip Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/tooltip-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='body_li_level_options__button_3' data-level='body_li_level_options' title='".__('Label Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Label Description Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/lable-description-setting-icon.png'></div>";
					
					$new_col_string .= "<div class='btn' id='add_new_row' data-id='".$col_no."' style='display:none;' title='".__('Add New Row',ARP_PT_TXTDOMAIN)."' data-title='".__('Add New Row',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/add-icon2.png'></div>";
					$new_col_string .= "<div class='btn' id='copy_row' alt='' col-id='".$col_no."' style='display:none;' title='".__('Duplicate Row',ARP_PT_TXTDOMAIN)."' data-title='".__('Duplicate Row',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/duplicate-icon2.png'></div>";
					$new_col_string .= "<div class='btn' id='remove_row' row-id='' col-id='".$col_no."' style='display:none;' title='".__('Delete Row',ARP_PT_TXTDOMAIN)."' data-title='".__('Delete Row',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/delete-icon2.png'></div>";
					
					// Button Options
					$new_col_string .= "<div class='btn' id='button_options__button_1' data-level='button_level_options' style='display:none;' title='".__('Button General Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button General Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/general-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='button_options__button_2' data-level='button_level_options' style='display:none;' title='".__('Button Image Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Image Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/buttonimage-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='button_options__button_3' data-level='button_level_options' style='display:none;' title='".__('Button Link/Script Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Link Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/buttonlink-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='button_options__button_4' data-level='button_level_options' style='display:none;' title='".__('Button Other Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Other Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/button-other-setting-icon.png'></div>";
					
					// Second Button Options
					$new_col_string .= "<div class='btn' id='second_button_options__button_1' data-level='second_button_level_options' style='display:none;' title='".__('Button General Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button General Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/general-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='second_button_options__button_2' data-level='second_button_level_options' style='display:none;' title='".__('Button Image Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Image Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/buttonimage-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='second_button_options__button_3' data-level='second_button_level_options' style='display:none;' title='".__('Button Link Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Link Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/buttonlink-setting-icon.png'></div>";
					$new_col_string .= "<div class='btn' id='second_button_options__button_4' data-level='second_button_level_options' style='display:none;' title='".__('Button Other Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Other Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/button-other-setting-icon.png'></div>";
					
				$new_col_string .= "</div>";
			
				$new_col_string .= "<div class='column_level_options'>";
				
					$new_col_string .= "<div class='column_option_div' level-id='column_level_options__button_1'>";
						
						$new_col_string .= "<div class='col_opt_row' id='column_width'>";
						
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Column Width',ARP_PT_TXTDOMAIN)."</div>";
							
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
							
								$new_col_string .= "<div class='col_opt_input'>";
								
									$new_col_string .= "<input type='text' name='column_width_".$col_no."' id='column_width_input' data-column='main_column_".$col_no."' class='col_opt_input' value='".$column['column_width']."' />";
									
									$new_col_string .= "<span>".__('Px',ARP_PT_TXTDOMAIN)."</span>";
								
								$new_col_string .= "</div>";
							
							$new_col_string .= "</div>";
						
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='column_highlight'>";
							
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Column Highlight',ARP_PT_TXTDOMAIN)."</div>";
							
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
								
								$new_col_string .= "<div class='arp_checkbox_div'>";
									
									if( $column['column_highlight'] == 1 ){ $checked = "checked='checked'"; } else { $checked = ''; }
									
									$new_col_string .= "<input type='checkbox' class='arp_checkbox dark_bg' ".$checked." value='1' id='column_highlight_input' name='column_highlight_".$col_no."' data-column='main_column_".$col_no."' />";
									
									$new_col_string .= "<label class='arp_checkbox_label'>".__('Yes',ARP_PT_TXTDOMAIN)."</label>";
									
								$new_col_string .= "</div>";
								
							$new_col_string .= "</div>";
							
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='set_hidden'>";
						
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Hidden (Optional)',ARP_PT_TXTDOMAIN)."</div>";
							
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
							
								$new_col_string .= "<div class='arp_checkbox_div'>";
								
									if( $column['is_hidden'] == 1 ){ $checked = "checked='checked'"; } else { $checked = ''; }
									
									$new_col_string .= "<input type='checkbox' class='arp_checkbox dark_bg' ".$checked." value='1' id='show_column' name='show_column_".$col_no."' data-column='main_column_".$col_no."' />";
									
									$new_col_string .= "<label class='arp_checkbox_label'>".__('Yes',ARP_PT_TXTDOMAIN)."</label>";
								
								$new_col_string .= "</div>";
							
							$new_col_string .= "</div>";
						
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='select_ribbon'>";
							
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Ribbon',ARP_PT_TXTDOMAIN)."</div>";
							
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
							
								$new_col_string .= "<button type='button' class='col_opt_btn' onclick='arp_select_ribbon(this)' name='ribbon_select_column_".$col_no."' id='ribbon_select' style='float:right;' data-column='main_column_".$col_no."'>";
							
									$new_col_string .= __('Select Ribbon',ARP_PT_TXTDOMAIN);
							
								$new_col_string .= "</button>";
								
								$new_col_string .= "<input type='hidden' id='arp_ribbon_style_main' name='arp_ribbon_style_".$col_no."' value='".$column['ribbon_setting']['arp_ribbon']."' />";
								$new_col_string .= "<input type='hidden' id='arp_ribbon_bgcol_main' name='arp_ribbon_bgcol_".$col_no."' value='".$column['ribbon_setting']['arp_ribbon_bgcol']."' />";
								$new_col_string .= "<input type='hidden' id='arp_ribbon_textcol_main' name='arp_ribbon_textcol_".$col_no."' value='".$column['ribbon_setting']['arp_ribbon_txtcol']."' />";
								$new_col_string .= "<input type='hidden' id='arp_ribbon_position_main' name='arp_ribbon_position_".$col_no."' value='".$column['ribbon_setting']['arp_ribbon_position']."' />";
								$new_col_string .= "<input type='hidden' id='arp_ribbon_content_main' name='arp_ribbon_content_".$col_no."' value='".$column['ribbon_setting']['arp_ribbon_content']."'>";
							
							$new_col_string .= "</div>";
							
						$new_col_string .= "</div>";
						
						//ok button div
						$new_col_string .= "<div class='col_opt_row arp_ok_div' id='column_level_other_arp_ok_div__button_1' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";							
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
						
					$new_col_string .= "</div>";
					
					////////////////
					
					$new_col_string .= "<div class='column_option_div' level-id='column_level_options__button_2'>";
						
						if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2'] ) ){
							if( in_array('column_description',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2'] ) ){
								
								$new_col_string .= "<div class='col_opt_row' id='column_description'>";
								
									$new_col_string .= "<div class='col_opt_title_div'>".__('Column Description',ARP_PT_TXTDOMAIN)."</div>";
								
									$new_col_string .= "<div class='col_opt_input_div'>";
								
										$new_col_string .= "<textarea id='arp_column_description' name='arp_column_description_".$col_no."'  class='col_opt_textarea' data-column='main_column_".$col_no."'>";
											$new_col_string .= stripslashes_deep($column['column_description']);
								
										$new_col_string .= "</textarea>";
								
									$new_col_string .= "</div>";
									
									$new_col_string .= "<div class='col_opt_button'>";
										
										if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2']) ){
										
											$new_col_string .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no."' id='add_arp_object' data-insert='arp_column_description' data-column='main_column_".$col_no."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
										
												$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
												
											$new_col_string .= "</button>";
											$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
										}
										
										if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2']) ){
											$new_col_string .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome' name='add_header_fontawesome_".$col_no."' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_column_".$col_no."' title='".__('Add Font', ARP_PT_TXTDOMAIN)."' >";
												$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
											$new_col_string .= "</button>";
										}
									$new_col_string .= "</div>";

								
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_family'>";
								
									$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
								
									$new_col_string .= "<div class='col_opt_input_div'>";
																		
										$new_col_string .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_".$col_no."' data-column='main_column_".$col_no."' value='".$column['column_description_font_family']."' />";
										$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_".$col_no."' data-id='column_description_font_family_".$col_no."'>";
											
											$new_col_string .= "<dt><span>".$column['column_description_font_family']."</span><input type='text' style='display:none;' value='".$column['column_description_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											
											$new_col_string .= "<dd>";
											
												$new_col_string .= "<ul data-id='column_description_font_family' data-column='column_".$col_no."'>";
												
													
												$new_col_string .= "</ul>";
											
											$new_col_string .= "</dd>";
											
										$new_col_string .= "</dl>";
								
									$new_col_string .= "</div>";
								
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_size'>";
								
									$new_col_string .= "<div class='btn_type_size'>";
								
										$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								
										$new_col_string .= "<div class='col_opt_input_div two_column'>";
																			
											$new_col_string .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_".$col_no."' value='".$column['column_description_font_size']."' data-column='main_column_".$col_no."' />";
											$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_".$col_no."' data-id='column_description_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
												
												$new_col_string .= "<dt><span>".$column['column_description_font_size']."</span><input type='text' style='display:none;' value='".$column['column_description_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
												
												$new_col_string .= "<dd>";
												
													$new_col_string .= "<ul data-id='column_description_font_size' data-column='column_".$col_no."'>";
													
															for($s=8;$s<=20;$s++)
																
																$size_arr[]=$s;
																
															for($st=22;$st<=70;$st+=2)
																
																$size_arr[]=$st;
																
															foreach($size_arr as $size)
															
																$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
												
													$new_col_string .= "</ul>";
												
												$new_col_string .= "</dd>";
												
											$new_col_string .= "</dl>";
								
										$new_col_string .= "</div>";
								
									$new_col_string .= "</div>";
									
										
										$new_col_string .= "<div class='btn_type_size'>";
									
										$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
									
										$new_col_string .= "<div class='col_opt_input_div two_column'>";
									
											$new_col_string .= $arprice_form->font_color('column_description_font_color_'.$col_no,'main_column_'.$col_no,$column['column_description_font_color'],'column_description_font_color',$column['column_description_font_color']);
									
										$new_col_string .= "</div>";
									
									$new_col_string .= "</div>";
										
									//end
								
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_color'>";
									
									$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$new_col_string .= "<div class='col_opt_input_div' data-level='column_level_options' level-id='column_button2' >";
								
								
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_bold'] == 'bold' ? 'selected' : '')."' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left'  data-column='main_column_".$col_no."' id='arp_style_bold' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-bold'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center'  data-column='main_column_".$col_no."' id='arp_style_italic' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-italic'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_decoration'] == 'underline' ? 'selected' : '' )."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_underline' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-underline'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_decoration'] == 'line-through' ? 'selected' : '' )."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_strike' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-strikethrough'></i>";
								$new_col_string .= "</div>";
								
								
								
								$new_col_string .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_".$col_no."' value='".$column['column_description_style_bold']."' /> ";
								$new_col_string .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_".$col_no."' value='".$column['column_description_style_italic']."' /> ";
								$new_col_string .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_".$col_no."' value='".$column['column_description_style_decoration']."' /> ";
								
								

		
							$new_col_string.= "</div>";
							
							//new font style btn ends
									
								$new_col_string .= "</div>";
							}
						}
						
						//ok button div
						
						$new_col_string .= "<div class='col_opt_row arp_ok_div' id='column_level_other_arp_ok_div__button_2' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";							
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
						
					$new_col_string .= "</div>";
					
				   ////////////////
					
					$new_col_string .= "<div class='column_option_div' level-id='header_level_options__button_1'>";
					
						$new_col_string .= "<div class='col_opt_row' id='column_title'>";
						
							$new_col_string .= "<div class='col_opt_title_div'>".__('Column Title',ARP_PT_TXTDOMAIN)."</div>";
						
							$new_col_string .= "<div class='col_opt_input_div'>";
								if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1']) || in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1']) ){
									
									$new_col_string .= "<textarea name='column_title_".$col_no."' id='column_title_input' data-column='main_column_".$col_no."' class='col_opt_textarea'>";
										$new_col_string .= $column['package_title'];
									$new_col_string .= "</textarea>";
									
								} else {
									
									$new_col_string .= "<input type='text' name='column_title_".$col_no."' id='column_title_input' data-column='main_column_".$col_no."' class='col_opt_input' value='".$column["package_title"]."'  />";
									
								}
						
							$new_col_string .= "</div>";
							
							$new_col_string .= "<div class='col_opt_button'>";
							if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1']) ){
								if(in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1'])  ){
									$new_col_string .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no."' id='add_arp_object' data-insert='column_title_input' data-column='main_column_".$col_no."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
										$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
										
									$new_col_string .= "</button>";
									$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
								}
							}
							
							if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1']) ){	
								if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1']) ){
									
									$new_col_string .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome' name='add_header_fontawesome_".$col_no."' id='add_header_fontawesome' data-insert='column_title_input' data-column='main_column_".$col_no."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
										$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";;
									$new_col_string .= "</button>";
								}
							}
							$new_col_string .= "</div>";
						
						$new_col_string .= "</div>";
						
						//
						
						$new_col_string .= "<div class='col_opt_row' id='header_other_font_family'>";
							
							$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							
							$new_col_string .= "<div class='col_opt_input_div'>";
							
								
								$new_col_string .= "<input type='hidden' id='header_font_family' name='header_font_family_".$col_no."' value='".$column['header_font_family']."' data-column='main_column_".$col_no."' />";
								$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='header_font_family_".$col_no."' data-id='header_font_family_".$col_no."'>";
									$new_col_string .= "<dt><span>".$column['header_font_family']."</span><input type='text' style='display:none;' value='".$column['header_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									
									$new_col_string .= "<dd>";
									
										$new_col_string .= "<ul data-id='header_font_family' data-column='column_".$col_no."'>";
										
											
										$new_col_string .= "</ul>";
									
									$new_col_string .= "</dd>";
									
								$new_col_string .= "</dl>";
							
							$new_col_string .= "</div>";
							
						$new_col_string .= "</div>";
						
						//
						
						$new_col_string .= "<div class='col_opt_row' id='header_other_font_size'>";
						
							$new_col_string .= "<div class='btn_type_size'>";
						
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
						
								$new_col_string .= "<div class='col_opt_input_div two_column'>";
						
									
									$new_col_string .= "<input type='hidden' id='header_font_size' name='header_font_size_".$col_no."' value='".$column['header_font_size']."' data-column='main_column_".$col_no."' />";
									$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='header_font_size_".$col_no."' data-id='header_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
										$new_col_string .= "<dt><span>".$column['header_font_size']."</span><input type='text' style='display:none;' value='".$column['header_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										
										$new_col_string .= "<dd>";
										
											$new_col_string .= "<ul data-id='header_font_size' data-column='column_".$col_no."'>";
										
													for($s=8;$s<=20;$s++)
										
														$size_arr[]=$s;
										
													for($st=22;$st<=70;$st+=2)
										
														$size_arr[]=$st;
										
													foreach($size_arr as $size)
										
														$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
										
											$new_col_string .= "</ul>";
										
										$new_col_string .= "</dd>";
										
									$new_col_string .= "</dl>";
						
								$new_col_string .= "</div>";
						
							$new_col_string .= "</div>";
							
				
									
									$new_col_string .= "<div class='btn_type_size'>";
						
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
						
								$new_col_string .= "<div class='col_opt_input_div two_column'>";
						
									$new_col_string .= $arprice_form->font_color('header_font_color_'.$col_no,'main_column_'.$col_no,$column['header_font_color'],'header_font_color',$column['header_font_color']);
						
								$new_col_string .= "</div>";
						
							$new_col_string .= "</div>";
									
								//end
							
						
						$new_col_string .= "</div>";
						
						//
						
						$new_col_string .= "<div class='col_opt_row' id='header_other_font_color'  >";
						
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$new_col_string .= "<div class='col_opt_input_div' data-level='header_level_options' level-id='header_button1' >";
								
								
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['header_style_bold'] == 'bold' ? 'selected' : '')."' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left'  data-column='main_column_".$col_no."' id='arp_style_bold' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-bold'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['header_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center'  data-column='main_column_".$col_no."' id='arp_style_italic' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-italic'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['header_style_decoration'] == 'underline' ? 'selected' : '' )."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_underline' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-underline'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['header_style_decoration'] == 'line-through' ? 'selected' : '' )."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_strike' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-strikethrough'></i>";
								$new_col_string .= "</div>";
								
								
								$new_col_string .= "<input   type='hidden' id='header_style_bold' name='header_style_bold_".$col_no."' value='".$column['header_style_bold']."' /> ";
								$new_col_string .= "<input type='hidden' id='header_style_italic' name='header_style_italic_".$col_no."' value='".$column['header_style_italic']."' /> ";
								$new_col_string .= "<input type='hidden' id='header_style_decoration' name='header_style_decoration_".$col_no."' value='".$column['header_style_decoration']."' /> ";
								
								
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$new_col_string.= "</div>";
							
							//new font style btn ends
						
						$new_col_string.= "</div>";
						
						//
						
						//ok button div
						$new_col_string .= "<div class='col_opt_row arp_ok_div' id='header_level_other_arp_ok_div__button_1'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";							
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
						
					$new_col_string .= "</div>";
					
					///////////////
					
					
					$new_col_string .= "<div class='column_option_div' level-id='body_level_options__button_3' style='display:none;'>";
					
						if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3']) ){
						if( in_array('column_description',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'] ) ){
							
								$new_col_string .= "<div class='col_opt_row' id='column_description'>";
								
									$new_col_string .= "<div class='col_opt_title_div'>".__('Column Description',ARP_PT_TXTDOMAIN)."</div>";
								
									$new_col_string .= "<div class='col_opt_input_div'>";
								
										$new_col_string .= "<textarea id='arp_column_description' name='arp_column_description_".$col_no."'  class='col_opt_textarea' data-column='main_column_".$col_no."'>";
								
											$new_col_string .= stripslashes_deep($column['column_description']);
								
										$new_col_string .= "</textarea>";
								
									$new_col_string .= "</div>";
									
									$new_col_string .= "<div class='col_opt_button'>";
										if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3']) ){
											$new_col_string .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no."' id='add_arp_object' data-insert='arp_column_description' data-column='main_column_".$col_no."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
												$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
												
											$new_col_string .= "</button>";
											$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
										}
										
										if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3']) ){
											$new_col_string .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no."' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_column_".$col_no."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
												$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
											$new_col_string .= "</button>";
										}
									$new_col_string .= "</div>";
								
								$new_col_string .= "</div>";
							
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_family'>";
								
									$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
								
									$new_col_string .= "<div class='col_opt_input_div'>";
								
										
										
										$new_col_string .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_".$col_no."' data-column='main_column_".$col_no."' value='".$column['column_description_font_family']."' />";
										$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_".$col_no."' data-id='column_description_font_family_".$col_no."'>";
											
											$new_col_string .= "<dt><span>".$column['column_description_font_family']."</span><input type='text' style='display:none;' value='".$column['column_description_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											
											$new_col_string .= "<dd>";
											
												$new_col_string .= "<ul data-id='column_description_font_family' data-column='column_".$col_no."'>";
												
												
											
												$new_col_string .= "</ul>";
											
											$new_col_string .= "</dd>";
											
										$new_col_string .= "</dl>";
								
									$new_col_string .= "</div>";
								
								$new_col_string .= "</div>";
							
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_size'>";
								
									$new_col_string .= "<div class='btn_type_size'>";
									
										$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
									
										$new_col_string .= "<div class='col_opt_input_div two_column'>";
									
											
											
											$new_col_string .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_".$col_no."' value='".$column['column_description_font_size']."' data-column='main_column_".$col_no."' />";
											$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_".$col_no."' data-id='column_description_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
												
												$new_col_string .= "<dt><span>".$column['column_description_font_size']."</span><input type='text' style='display:none;' value='".$column['column_description_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
												
												$new_col_string .= "<dd>";
												
													$new_col_string .= "<ul data-id='column_description_font_size' data-column='column_".$col_no."'>";
													
															for($s=8;$s<=20;$s++)
																
																$size_arr[]=$s;
																
															for($st=22;$st<=70;$st+=2)
																
																$size_arr[]=$st;
																
															foreach($size_arr as $size)
															
																$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
												
													$new_col_string .= "</ul>";
												
												$new_col_string .= "</dd>";
												
											$new_col_string .= "</dl>";
									
										$new_col_string .= "</div>";
									
									$new_col_string .= "</div>";
									
									
									
									//font color btn
										
										$new_col_string .= "<div class='btn_type_size'>";
									
										$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
									
										$new_col_string .= "<div class='col_opt_input_div two_column'>";
									
											$new_col_string .= $arprice_form->font_color('column_description_font_color_'.$col_no,'main_column_'.$col_no,$column['column_description_font_color'],'column_description_font_color',$column['column_description_font_color']);
									
										$new_col_string .= "</div>";
									
									$new_col_string .= "</div>";
											
									//end
									
									
								$new_col_string .= "</div>";
							
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_color'>";
									
									$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$new_col_string .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button3' >";
								
								
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_bold'] == 'bold' ? 'selected' : '')."' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left'  data-column='main_column_".$col_no."' id='arp_style_bold' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-bold'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center'  data-column='main_column_".$col_no."' id='arp_style_italic' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-italic'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_decoration'] == 'underline' ? 'selected' : '' )."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_underline' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-underline'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_decoration'] == 'line-through' ? 'selected' : '' )."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_strike' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-strikethrough'></i>";
								$new_col_string .= "</div>";
								
								
								$new_col_string .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_".$col_no."' value='".$column['column_description_style_bold']."' /> ";
								$new_col_string .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_".$col_no."' value='".$column['column_description_style_italic']."' /> ";
								$new_col_string .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_".$col_no."' value='".$column['column_description_style_decoration']."' /> ";
								
								
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$new_col_string.= "</div>";
							
							//new font style btn ends
									
								$new_col_string .= "</div>";
							}
						}
						
						//ok button div
						$new_col_string .= "<div class='col_opt_row arp_ok_div' id='body_level_other_arp_ok_div__button_3' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
								
					$new_col_string .= "</div>";
					

					///////////////////////
					
					
					
					
					
					$new_col_string .= "<div class='column_option_div' level-id='header_level_options__button_2' style='display:none;'>";
						if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2']) ){
							if( in_array('column_description',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2'] ) ){
							
								$new_col_string .= "<div class='col_opt_row' id='column_description'>";
								
									$new_col_string .= "<div class='col_opt_title_div'>".__('Column Description',ARP_PT_TXTDOMAIN)."</div>";
								
									$new_col_string .= "<div class='col_opt_input_div'>";
								
										$new_col_string .= "<textarea id='arp_column_description' name='arp_column_description_".$col_no."'  class='col_opt_textarea' data-column='main_column_".$col_no."'>";
								
											$new_col_string .= stripslashes_deep($column['column_description']);
								
										$new_col_string .= "</textarea>";
								
									$new_col_string .= "</div>";
									
									$new_col_string .= "<div class='col_opt_button'>";
										if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2']) ){
											$new_col_string .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no."' id='add_arp_object' data-insert='arp_column_description' data-column='main_column_".$col_no."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
												$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
											$new_col_string .= "</button>";
											$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
										}
										
										if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2']) ){
											$new_col_string .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome' name='add_header_fontawesome_".$col_no."' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_column_".$col_no."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
												$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
											$new_col_string .= "</button>";
										}
									$new_col_string .= "</div>";
								
								$new_col_string .= "</div>";
							
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_family'>";
								
									$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
								
									$new_col_string .= "<div class='col_opt_input_div'>";
								
										
										
										$new_col_string .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_".$col_no."' data-column='main_column_".$col_no."' value='".$column['column_description_font_family']."' />";
										$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_".$col_no."' data-id='column_description_font_family_".$col_no."'>";
											
											$new_col_string .= "<dt><span>".$column['column_description_font_family']."</span><input type='text' style='display:none;' value='".$column['column_description_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											
											$new_col_string .= "<dd>";
											
												$new_col_string .= "<ul data-id='column_description_font_family' data-column='column_".$col_no."'>";
												
												
												$new_col_string .= "</ul>";
											
											$new_col_string .= "</dd>";
											
										$new_col_string .= "</dl>";
								
									$new_col_string .= "</div>";
								
								$new_col_string .= "</div>";
							
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_size'>";
								
									$new_col_string .= "<div class='btn_type_size'>";
									
										$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
									
										$new_col_string .= "<div class='col_opt_input_div two_column'>";
									
											
											
											$new_col_string .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_".$col_no."' value='".$column['column_description_font_size']."' data-column='main_column_".$col_no."' />";
											$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_".$col_no."' data-id='column_description_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
												
												$new_col_string .= "<dt><span>".$column['column_description_font_size']."</span><input type='text' style='display:none;' value='".$column['column_description_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
												
												$new_col_string .= "<dd>";
												
													$new_col_string .= "<ul data-id='column_description_font_size' data-column='column_".$col_no."'>";
													
															for($s=8;$s<=20;$s++)
																
																$size_arr[]=$s;
																
															for($st=22;$st<=70;$st+=2)
																
																$size_arr[]=$st;
																
															foreach($size_arr as $size)
															
																$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
												
													$new_col_string .= "</ul>";
												
												$new_col_string .= "</dd>";
												
											$new_col_string .= "</dl>";
									
										$new_col_string .= "</div>";
									
									$new_col_string .= "</div>";
									
									
									
									//font color btn
										
										$new_col_string .= "<div class='btn_type_size'>";
									
										$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
									
										$new_col_string .= "<div class='col_opt_input_div two_column'>";
									
											$new_col_string .= $arprice_form->font_color('column_description_font_color_'.$col_no,'main_column_'.$col_no,$column['column_description_font_color'],'column_description_font_color',$column['column_description_font_color']);
									
										$new_col_string .= "</div>";
									
									$new_col_string .= "</div>";
										
									//end
									
								$new_col_string .= "</div>";
							
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_color'>";
									
										$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$new_col_string .= "<div class='col_opt_input_div' data-level='header_level_options' level-id='header_button2'>";
								
								
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_bold'] == 'bold' ? 'selected' : '')."' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left'  data-column='main_column_".$col_no."' id='arp_style_bold' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-bold'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center'  data-column='main_column_".$col_no."' id='arp_style_italic' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-italic'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_decoration'] == 'underline' ? 'selected' : '' )."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_underline' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-underline'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_decoration'] == 'line-through' ? 'selected' : '' )."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_strike' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-strikethrough'></i>";
								$new_col_string .= "</div>";
								
								
								
								$new_col_string .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_".$col_no."' value='".$column['column_description_style_bold']."' /> ";
								$new_col_string .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_".$col_no."' value='".$column['column_description_style_italic']."' /> ";
								$new_col_string .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_".$col_no."' value='".$column['column_description_style_decoration']."' /> ";
								
								
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$new_col_string.= "</div>";
							
							//new font style btn ends
									
								$new_col_string .= "</div>";
							}
						}
						
						
						
						//ok button div
						$new_col_string .= "<div class='col_opt_row arp_ok_div' id='header_level_other_arp_ok_div__button_2' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";							
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
					
					$new_col_string .= "</div>";
					
					///////////////
					
					$new_col_string .= "<div class='column_option_div' level-id='header_level_options__button_3' style='display:none;'>";
					
						if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'] ) ){
							if( in_array('column_description',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'] ) ){
								
								$new_col_string .= "<div class='col_opt_row' id='column_description'>";
								
									$new_col_string .= "<div class='col_opt_title_div'>".__('Column Description',ARP_PT_TXTDOMAIN)."</div>";
								
									$new_col_string .= "<div class='col_opt_input_div'>";
								
										$new_col_string .= "<textarea id='arp_column_description' name='arp_column_description_".$col_no."'  class='col_opt_textarea' data-column='main_column_".$col_no."'>";
											$new_col_string .= stripslashes_deep($column['column_description']);
								
										$new_col_string .= "</textarea>";
								
									$new_col_string .= "</div>";
									
									$new_col_string .= "<div class='col_opt_button'>";
										if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) ){
											$new_col_string .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no."' id='add_arp_object' data-insert='arp_column_description' data-column='main_column_".$col_no."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
												$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
												
											$new_col_string .= "</button>";
											$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
										}
										
										if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) ){
											$new_col_string .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome' name='add_header_fontawesome_".$col_no."' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_column_".$col_no."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
												$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
											$new_col_string .= "</button>";
										}
									$new_col_string .= "</div>";
								
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_family'>";
								
									$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
								
									$new_col_string .= "<div class='col_opt_input_div'>";
								
										
										$new_col_string .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_".$col_no."' data-column='main_column_".$col_no."' value='".$column['column_description_font_family']."' />";
										$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_".$col_no."' data-id='column_description_font_family_".$col_no."'>";
											
											$new_col_string .= "<dt><span>".$column['column_description_font_family']."</span><input type='text' style='display:none;' value='".$column['column_description_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											
											$new_col_string .= "<dd>";
											
												$new_col_string .= "<ul data-id='column_description_font_family' data-column='column_".$col_no."'>";
											

												
												
												$new_col_string .= "</ul>";
											
											$new_col_string .= "</dd>";
											
										$new_col_string .= "</dl>";
								
									$new_col_string .= "</div>";
								
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_size'>";
								
									$new_col_string .= "<div class='btn_type_size'>";
								
										$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								
										$new_col_string .= "<div class='col_opt_input_div two_column'>";
								
											
											
											$new_col_string .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_".$col_no."' value='".$column['column_description_font_size']."' data-column='main_column_".$col_no."' />";
											$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_".$col_no."' data-id='column_description_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
												
												$new_col_string .= "<dt><span>".$column['column_description_font_size']."</span><input type='text' style='display:none;' value='".$column['column_description_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
												
												$new_col_string .= "<dd>";
												
													$new_col_string .= "<ul data-id='column_description_font_size' data-column='column_".$col_no."'>";
													
															for($s=8;$s<=20;$s++)
																
																$size_arr[]=$s;
																
															for($st=22;$st<=70;$st+=2)
																
																$size_arr[]=$st;
																
															foreach($size_arr as $size)
															
																$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
												
													$new_col_string .= "</ul>";
												
												$new_col_string .= "</dd>";
												
											$new_col_string .= "</dl>";
								
										$new_col_string .= "</div>";
								
									$new_col_string .= "</div>";
									
									$new_col_string .= "<div class='btn_type_size'>";
								
										$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
								
										$new_col_string .= "<div class='col_opt_input_div two_column'>";
								
											
											
											$new_col_string .= "<input type='hidden' id='column_description_font_style' name='column_description_font_style_".$col_no."' value='".$column['column_description_font_style']."' data-column='main_column_".$col_no."' />";
											
											$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_style_".$col_no."' data-id='column_description_font_style_".$col_no."' style='width:115px;max-width:115px;'>";
												
												$new_col_string .= "<dt><span>".$column['column_description_font_style']."</span><input type='text' style='display:none;' value='".$column['column_description_font_style']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
												$new_col_string .= "<dd>";
												
													$new_col_string .= "<ul data-id='column_description_font_style' data-column='column_".$col_no."'>";
												
															$new_col_string .= $arprice_form->font_style_new();
												
													$new_col_string .= "</ul>";
												
												$new_col_string .= "</dd>";
												
											$new_col_string .= "</dl>";
																			
										$new_col_string .= "</div>";
								
									$new_col_string .= "</div>";
								
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_color'>";
									
									$new_col_string .= "<div class='btn_type_size'>";
									
										$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
									
										$new_col_string .= "<div class='col_opt_input_div two_column'>";
									
											$new_col_string .= $arprice_form->font_color('column_description_font_color_'.$col_no,'main_column_'.$col_no,$column['column_description_font_color'],'column_description_font_color',$column['column_description_font_color']);
									
										$new_col_string .= "</div>";
									
									$new_col_string .= "</div>";
									
								$new_col_string .= "</div>";
							}
							
								if( in_array('additional_shortcode',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'] ) ){
								
								$new_col_string .= "<div class='col_opt_row' id='additional_shortcode'>";
							
									$new_col_string .= "<div class='col_opt_title_div'>".__('Additional Shortcode',ARP_PT_TXTDOMAIN)."</div>";
									
									$new_col_string .= "<div class='col_opt_input_div'>";
									
										$new_col_string .= "<textarea id='additional_shortcode_input' name='additional_shortcode_".$col_no."'  class='col_opt_textarea'>";
									
										$new_col_string .= htmlentities($column['arp_header_shortcode']);
									
										$new_col_string .= "</textarea>";
									
									$new_col_string .= "</div>";
									if(in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) || in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])){
									
										$new_col_string .= "<div class='col_opt_button'>";
										
										if( $ref_template == 'arptemplate_5' || $ref_template == 'arptemplate_7' )
										{
											$new_col_string .= "<button type='button' class='col_opt_btn arptooltipster' onclick='add_header_shortcode_fn(this);' name='add_header_shortcode_btn_".$col_no."' id='add_header_shortcode' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											/*$tablestring .= "<i class='fa fa-plus'></i>";
											$tablestring .= __('Add Shortcode',ARP_PT_TXTDOMAIN);*/
											$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/audio-icon.png' />";
										$new_col_string .= "</button>";
										$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
										}
										
											if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) ){
												$new_col_string .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no."' id='add_arp_object' data-insert='additional_shortcode_input' data-column='main_column_".$col_no."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
													$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";	
												$new_col_string .= "</button>";
												$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
											}
											
											if(in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])){
												$new_col_string .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no."' id='add_header_fontawesome' data-insert='additional_shortcode_input' data-column='main_column_".$col_no."' title='".__('Add Font', ARP_PT_TXTDOMAIN)."' >";
													$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
												$new_col_string .= "</button>";
											}
										$new_col_string .= "</div>";
										
									} else {
										$new_col_string .= "<div class='col_opt_button'>";
											
											$new_col_string .= "<button type='button' class='col_opt_btn arptooltipster' onclick='add_header_shortcode_fn(this);' name='add_header_shortcode_btn_".$col_no."' id='add_header_shortcode' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
												
												$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/audio-icon.png' />";
											$new_col_string .= "</button>";
											
										$new_col_string .= "</div>";
									}
								$new_col_string .= "</div>";
							}
						}
						
						//ok button div
						$new_col_string .= "<div class='col_opt_row arp_ok_div' id='header_level_other_arp_ok_div__button_3' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";							
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
						
					$new_col_string .= "</div>";
					
					////////////////
					
					$new_col_string .= "<div class='column_option_div' level-id='pricing_level_options__button_1' style='display:none;'>";
						
						$new_col_string .= "<div class='col_opt_row' id='price_text'>";
							
							$new_col_string .= "<div class='col_opt_title_div'>".__('Price Text',ARP_PT_TXTDOMAIN)."</div>";
							
							$new_col_string .= "<div class='col_opt_input_div'>";
							
								$new_col_string .= "<textarea id='price_text_input' name='price_text_".$col_no."' class='col_opt_textarea' data-column='main_column_".$col_no."' style='min-height:80px;max-width:100%;width:100%;'>";
							
										$new_col_string .= $column['price_text'];
							
								$new_col_string .= "</textarea>";
								
								$new_col_string .= "<div class='col_opt_button'>";
								if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1']) ){
									if(in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1'])  ){
										$new_col_string .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no."' id='add_arp_object' data-insert='price_text_input' data-column='main_column_".$col_no."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
											
										$new_col_string .= "</button>";
										$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
									}
								}
								
								if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1']) ){	
									if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1']) ){								
										$new_col_string .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no."' id='add_header_fontawesome' data-insert='price_text_input' data-column='main_column_".$col_no."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
											$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
										$new_col_string .= "</button>";
									}
								}
								$new_col_string .= "</div>";
							
							$new_col_string .= "</div>";
							
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='price_text_other_font_family'>";
						
							$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";

							$new_col_string .= "<div class='col_opt_input_div'>";

								/*$new_col_string .= "<select class='arp_select_box' id='price_font_family' data-column='main_".$col_no."' name='price_font_family_".$col_no."'>";
						
									$new_col_string .= arprice_form::font_settings($column['price_font_family']);
				
								$new_col_string .= "</select>";*/
								
								$new_col_string .= "<input type='hidden' id='price_font_family' value='".$column['price_font_family']."' name='price_font_family_".$col_no."' data-column='main_column_".$col_no."' />";
								$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='price_font_family_".$col_no."' data-id='price_font_family_".$col_no."'>";
									$new_col_string .= "<dt><span>".$column['price_font_family']."</span><input type='text' style='display:none;' value='".$column['price_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									
									$new_col_string .= "<dd>";
									
										$new_col_string .= "<ul data-id='price_font_family' data-column='column_".$col_no."'>";
									
										
										
										$new_col_string .= "</ul>";
									
									$new_col_string .= "</dd>";
									
								$new_col_string .= "</dl>";
						
							$new_col_string .= "</div>";
						
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='price_text_other_font_size'>";
						
							$new_col_string .= "<div class='btn_type_size'>";
						
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
						
								$new_col_string .= "<div class='col_opt_input_div two_column'>";

									
									
									$new_col_string .= "<input type='hidden' id='price_font_size' name='price_font_size_".$col_no."' value='".$column['price_font_size']."' data-column='main_column_".$col_no."' />";
									$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='price_font_size_".$col_no."' data-id='price_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
										
										$new_col_string .= "<dt><span>".$column['price_font_size']."</span><input type='text' style='display:none;' value='".$column['price_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										
										$new_col_string .= "<dd>";
											
											$new_col_string .= "<ul data-id='price_font_size' data-column='".$j."'>";
													
													for($s=8;$s<=20;$s++)
													
														$size_arr[]=$s;
													
													for($st=22;$st<=70;$st+=2)
													
														$size_arr[]=$st;
													
													foreach($size_arr as $size) 
													
														$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
										
											$new_col_string .= "</ul>";
										
										$new_col_string .= "</dd>";
										
									$new_col_string .= "</dl>";
							
								$new_col_string .= "</div>";
							
							$new_col_string .= "</div>";
							
							
							//font color btn pos
								
										$new_col_string .= "<div class='btn_type_size'>";
							
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
							
								$new_col_string .= "<div class='col_opt_input_div two_column'>";
							
									$new_col_string .= $arprice_form->font_color('price_font_color_'.$col_no,'main_column_'.$col_no,$column['price_font_color'],'price_font_color',$column['price_font_color']);
							
								$new_col_string .= "</div>";
							
							$new_col_string .= "</div>";
								
							//end
							
							
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='price_text_other_font_color'>";
							
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$new_col_string .= "<div class='col_opt_input_div' data-level='pricing_level_options' level-id='pricing_button1'>";
								
								
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['price_label_style_bold'] == 'bold' ? 'selected' : '')."' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left'  data-column='main_column_".$col_no."' id='arp_style_bold' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-bold'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['price_label_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center'  data-column='main_column_".$col_no."' id='arp_style_italic' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-italic'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['price_label_style_decoration'] == 'underline' ? 'selected' : '' )."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_underline' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-underline'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['price_label_style_decoration'] == 'line-through' ? 'selected' : '' )."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_strike' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-strikethrough'></i>";
								$new_col_string .= "</div>";
								
								
								$new_col_string .= "<input type='hidden' id='price_label_style_bold' name='price_label_style_bold_".$col_no."' value='".$column['price_label_style_bold']."' /> ";
								$new_col_string .= "<input type='hidden' id='price_label_style_italic' name='price_label_style_italic_".$col_no."' value='".$column['price_label_style_italic']."' /> ";
								$new_col_string .= "<input type='hidden' id='price_label_style_decoration' name='price_label_style_decoration_".$col_no."' value='".$column['price_label_style_decoration']."' /> ";
								
								
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$new_col_string .= "</div>";
							
							//new font style btn ends
							
						$new_col_string .= "</div>";
						
						//ok button div
						$new_col_string .= "<div class='col_opt_row arp_ok_div' id='pricing_level_other_arp_ok_div__button_1' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";							
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
						
					$new_col_string .= "</div>";
					
					///////////
					
					$new_col_string .= "<div class='column_option_div' level-id='pricing_level_options__button_2' style='display:none;'>";
						
						$new_col_string .= "<div class='col_opt_row' id='price_label'>";
						
							$new_col_string .= "<div class='col_opt_title_div'>".__('Label Text',ARP_PT_TXTDOMAIN)."</div>";
						
							$new_col_string .= "<div class='col_opt_input_div'>";
						
								$new_col_string .= "<textarea id='price_label_input' name='price_label_".$col_no."' class='col_opt_textarea' data-column='main_column_".$col_no."' style='min-height:80px;max-width:100%;width:100%;'>";
						
										$new_col_string .= $column['price_label'];
						
								$new_col_string .= "</textarea>";
								if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2']) ){
									if(in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'])  ){
										$new_col_string .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no."' id='add_arp_object' data-insert='price_label_input' data-column='main_column_".$col_no."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
											
										$new_col_string .= "</button>";
										$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
									}
								}
								if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2']) ){
									if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2']) ){
										
										$new_col_string .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no."' id='add_header_fontawesome' data-insert='price_label_input' data-column='main_column_".$col_no."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
											$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
										$new_col_string .= "</button>";
									}
								}
							$new_col_string .= "</div>";
						
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='price_label_other_font_family'>";
						
							$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
						
							$new_col_string .= "<div class='col_opt_input_div'>";
						
							
								
								$new_col_string .= "<input type='hidden' id='price_text_font_family' name='price_text_font_family_".$col_no."' value='".$column['price_text_font_family']."' data-column='main_column_".$col_no."' />";
								
								$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='price_text_font_family_".$col_no."' data-id='price_text_font_family_".$col_no."'>";
									$new_col_string .= "<dt><span>".$column['price_text_font_family']."</span><input type='text' style='display:none;' value='".$column['price_text_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									
									$new_col_string .= "<dd>";
									
										$new_col_string .= "<ul data-id='price_text_font_family' data-column='main_column_".$col_no."'>";
										
									
										$new_col_string .= "</ul>";
									
									$new_col_string .= "</dd>";
									
								$new_col_string .= "</dl>";
				
							$new_col_string .= "</div>";
						
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='price_label_other_font_size'>";
						
							$new_col_string .= "<div class='btn_type_size'>";
						
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
						
								$new_col_string .= "<div class='col_opt_input_div two_column'>";
						
									/*$new_col_string .= "<select class='arp_select_box cls_font_size' id='price_text_font_size' name='price_text_font_size_".$col_no."' data-column='main_column_".$col_no."'>";
						
										$new_col_string .= arprice_form::font_size($column['price_text_font_size']);
						
									$new_col_string .= "</select>";*/
									
									$new_col_string .= "<input type='hidden' id='price_text_font_size' name='price_text_font_size_".$col_no."' value='".$column['price_text_font_size']."' data-column='main_column_".$col_no."' />";
									
									$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='price_text_font_size_".$col_no."' data-id='price_text_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
										
										$new_col_string .= "<dt><span>".$column['price_text_font_size']."</span><input type='text' style='display:none;' value='".$column['price_text_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										
										$new_col_string .= "<dd>";
											
											$new_col_string .= "<ul data-id='price_text_font_size' data-column='column_".$col_no."'>";
													
													for($s=8;$s<=20;$s++)
													
														$size_arr[]=$s;
													
													for($st=22;$st<=70;$st+=2)
													
														$size_arr[]=$st;
													
													foreach($size_arr as $size)
													
														$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
														
											$new_col_string .= "</ul>";
										
										$new_col_string .= "</dd>";
										
									$new_col_string .= "</dl>";
						
								$new_col_string .= "</div>";
						
							$new_col_string .= "</div>";
							
							
							
							//font color btn
							
									$new_col_string .= "<div class='btn_type_size'>";
						
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
						
								$new_col_string .= "<div class='col_opt_input_div two_column'>";
						
									$new_col_string .= $arprice_form->font_color('price_text_font_color_'.$col_no,'main_column_'.$col_no,$column['price_text_font_color'],'price_text_font_color',$column['price_text_font_color']);
						
								$new_col_string .= "</div>";
						
							$new_col_string .= "</div>";
								
							//end
							
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='price_label_other_font_color'>";
						
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$new_col_string .= "<div class='col_opt_input_div' data-level='pricing_level_options' level-id='pricing_button2' >";
								
								
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['price_label_style_bold'] == 'bold' ? 'selected' : '')."' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left'  data-column='main_column_".$col_no."' id='arp_style_bold' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-bold'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['price_label_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center'  data-column='main_column_".$col_no."' id='arp_style_italic' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-italic'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['price_label_style_decoration'] == 'underline' ? 'selected' : '' )."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_underline' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-underline'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['price_label_style_decoration'] == 'line-through' ? 'selected' : '' )."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_strike' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-strikethrough'></i>";
								$new_col_string .= "</div>";
								
								
								
								$new_col_string .= "<input type='hidden' id='price_text_style_bold' name='price_text_style_bold_".$col_no."' value='".$column['price_text_style_bold']."' /> ";
								$new_col_string .= "<input type='hidden' id='price_text_style_italic' name='price_text_style_italic_".$col_no."' value='".$column['price_text_style_italic']."' /> ";
								$new_col_string .= "<input type='hidden' id='price_text_style_decoration' name='price_text_style_decoration_".$col_no."' value='".$column['price_text_style_decoration']."' /> ";
								
								
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$new_col_string .= "</div>";
							
							//new font style btn ends
						
						$new_col_string .= "</div>";
						
						//ok button div
						$new_col_string .= "<div class='col_opt_row arp_ok_div' id='pricing_level_other_arp_ok_div__button_2' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";							
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
						
					$new_col_string .= "</div>";
					
					//////////////
					
					$new_col_string .= "<div class='column_option_div' level-id='pricing_level_options__button_3' style='display:none;'>";
								
					if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'] ) ){
						if( in_array('column_description',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'] ) ){
						
							$new_col_string .= "<div class='col_opt_row' id='column_description'>";
							
								$new_col_string .= "<div class='col_opt_title_div'>".__('Column Description',ARP_PT_TXTDOMAIN)."</div>";
							
								$new_col_string .= "<div class='col_opt_input_div'>";
							
									$new_col_string .= "<textarea id='arp_column_description' name='arp_column_description_".$col_no."'  class='col_opt_textarea' data-column='main_column_".$col_no."'>";
							
										$new_col_string .= stripslashes_deep($column['column_description']);
							
									$new_col_string .= "</textarea>";
							
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='col_opt_button'>";
									if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3']) ){
										$new_col_string .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no."' id='add_arp_object' data-insert='arp_column_description' data-column='main_column_".$col_no."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
											
										$new_col_string .= "</button>";
										$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
									}
									
									if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3']) ){
										$new_col_string .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no."' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_column_".$col_no."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
											$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
										$new_col_string .= "</button>";
									}
								$new_col_string .= "</div>";
							
							$new_col_string .= "</div>";
							
							$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_family'>";
							
								$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							
								$new_col_string .= "<div class='col_opt_input_div'>";
							
									
									
									$new_col_string .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_".$col_no."' data-column='main_column_".$col_no."' value='".$column['column_description_font_family']."' />";
									$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_".$col_no."' data-id='column_description_font_family_".$col_no."'>";
										
										$new_col_string .= "<dt><span>".$column['column_description_font_family']."</span><input type='text' style='display:none;' value='".$column['column_description_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										
										$new_col_string .= "<dd>";
										
											$new_col_string .= "<ul data-id='column_description_font_family' data-column='column_".$col_no."'>";
											
											
										
										
											$new_col_string .= "</ul>";
										
										$new_col_string .= "</dd>";
										
									$new_col_string .= "</dl>";
								
								$new_col_string .= "</div>";
							
							$new_col_string .= "</div>";
							
							$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_size'>";
								
								$new_col_string .= "<div class='btn_type_size'>";
								
									$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								
									$new_col_string .= "<div class='col_opt_input_div two_column'>";
								
										
										
										$new_col_string .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_".$col_no."' value='".$column['column_description_font_size']."' data-column='main_column_".$col_no."' />";
										$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_".$col_no."' data-id='column_description_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
											
											$new_col_string .= "<dt><span>".$column['column_description_font_size']."</span><input type='text' style='display:none;' value='".$column['column_description_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											
											$new_col_string .= "<dd>";
											
												$new_col_string .= "<ul data-id='column_description_font_size' data-column='column_".$col_no."'>";
												
														for($s=8;$s<=20;$s++)
															
															$size_arr[]=$s;
															
														for($st=22;$st<=70;$st+=2)
															
															$size_arr[]=$st;
															
														foreach($size_arr as $size)
														
															$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
											
												$new_col_string .= "</ul>";
											
											$new_col_string .= "</dd>";
											
										$new_col_string .= "</dl>";
								
									$new_col_string .= "</div>";
								
								$new_col_string .= "</div>";
								
								
								
								//font color btn
											$new_col_string .= "<div class='btn_type_size'>";
								
									$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
								
									$new_col_string .= "<div class='col_opt_input_div two_column'>";
								
										$new_col_string .= $arprice_form->font_color('column_description_font_color_'.$col_no,'main_column_'.$col_no,$column['column_description_font_color'],'column_description_font_color',$column['column_description_font_color']);
								
									$new_col_string .= "</div>";
								
								$new_col_string .= "</div>";
								//ends
							
							$new_col_string .= "</div>";
							
							$new_col_string .= "<div class='col_opt_row' id='column_description_other_font_color'>";
								
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$new_col_string .= "<div class='col_opt_input_div' data-level='pricing_level_options' level-id='pricing_button3' >";
								
								
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_bold'] == 'bold' ? 'selected' : '')."' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left'  data-column='main_column_".$col_no."' id='arp_style_bold' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-bold'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center'  data-column='main_column_".$col_no."' id='arp_style_italic' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-italic'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_italic'] == 'underline' ? 'selected' : '' )."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_underline' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-underline'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['column_description_style_italic'] == 'line-through' ? 'selected' : '' )."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_strike' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-strikethrough'></i>";
								$new_col_string .= "</div>";
								
								
								
								$new_col_string .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_".$col_no."' value='".$column['column_description_style_bold']."' /> ";
								$new_col_string .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_".$col_no."' value='".$column['column_description_style_italic']."' /> ";
								$new_col_string .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_".$col_no."' value='".$column['column_description_style_italic']."' /> ";
								
								
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$new_col_string .= "</div>";
							
							//new font style btn ends
							
							
							$new_col_string .= "</div>";
						}
					}
					
						//ok button div
						$new_col_string .= "<div class='col_opt_row arp_ok_div' id='pricing_level_other_arp_ok_div__button_3' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";							
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
					
					$new_col_string .= "</div>";
					
					////////////////
					
					$new_col_string .= "<div class='column_option_div' level-id='body_level_options__button_1' style='display:none;'>";
						
						$new_col_string .= "<div class='col_opt_row' id='text_alignment'>";
						
							$new_col_string .= "<div class='col_opt_title_div'>".__('Text Alignment',ARP_PT_TXTDOMAIN)."</div>";
						
							$new_col_string .= "<div class='col_opt_input_div'>";
								
								$alignment = $column['body_text_alignment'];
								
								$left_selected = ($alignment == 'left') ? 'align_selected' : '';
						
								$center_selected = ($alignment == 'center') ? 'align_selected' : '';
						
								$right_selected = ($alignment == 'right') ? 'align_selected' : '';
								
								$new_col_string .= "<div class='alignment_btn align_left_btn ".$left_selected."' data-align='left' id='align_left_btn' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-align-left fa-flip-vertical'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='alignment_btn align_center_btn ".$center_selected."' data-align='center' id='align_center_btn' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-align-center fa-flip-vertical'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='alignment_btn align_right_btn ".$right_selected."' data-align='right' id='align_right_btn' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-align-right fa-flip-vertical'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no."'>";
		
							$new_col_string .= "</div>";
							
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='body_li_other_font_family'>";
							
							$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							
							$new_col_string .= "<div class='col_opt_input_div'>";
							
								
								$new_col_string .= "<input type='hidden' id='content_font_family' name='content_font_family_".$col_no."' value='".$column['content_font_family']."' data-column='main_column_".$col_no."'/>";
								$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='content_font_family_".$col_no."' data-id='content_font_family_".$col_no."'>";
									$new_col_string .= "<dt><span>".$column['content_font_family']."</span><input type='text' style='display:none;' value='".$column['content_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									
									$new_col_string .= "<dd>";
									
										$new_col_string .= "<ul data-id='content_font_family' data-column='column_".$col_no."'>";
									
										
											
										$new_col_string .= "</ul>";
									
									$new_col_string .= "</dd>";
									
								$new_col_string .= "</dl>";
							
							$new_col_string .= "</div>";
							
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='body_li_other_font_size'>";
						
							$new_col_string .= "<div class='btn_type_size'>";
						
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
						
								$new_col_string .= "<div class='col_opt_input_div two_column'>";
						
									
									$new_col_string .= "<input type='hidden' id='content_font_size' name='content_font_size_".$col_no."' value='".$column['content_font_size']."' data-column=main_column_".$col_no." />";
									$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='content_font_size_".$col_no."' data-id='content_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
										$new_col_string .= "<dt><span>".$column['content_font_size']."</span><input type='text' style='display:none;' value='".$column['content_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$new_col_string .= "<dd>";
											$new_col_string .= "<ul data-id='content_font_size' data-column='column_".$col_no."'>";
													$size_arr=array();
													for($s=8;$s<=20;$s++)
														$size_arr[]=$s;
													for($st=22;$st<=70;$st+=2)
														$size_arr[]=$st;
													foreach($size_arr as $size)  {
														$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
													}
											$new_col_string .= "</ul>";
										$new_col_string .= "</dd>";
									$new_col_string .= "</dl>";
						
								$new_col_string .= "</div>";
						
							$new_col_string .= "</div>";
							
							
							
							//font color btn
									$new_col_string .= "<div class='btn_type_size'>";
						
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
						
								$new_col_string .= "<div class='col_opt_input_div two_column'>";
						
									$new_col_string .= $arprice_form->font_color('content_font_color_'.$col_no,'main_column_'.$col_no,$column['content_font_color'],'content_font_color',$column['content_font_color']);
						
								$new_col_string .= "</div>";
						
							$new_col_string .= "</div>";
							//end
							
						
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='body_li_other_font_color'>";
						
								$new_col_string.= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$new_col_string .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button1' >";
								
								
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['body_li_style_bold'] == 'bold' ? 'selected' : '')."' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left'  data-column='main_column_".$col_no."' id='arp_style_bold' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-bold'></i>";
							$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['body_li_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center'  data-column='main_column_".$col_no."' id='arp_style_italic' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-italic'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['body_li_style_decoration'] == 'underline' ? 'selected' : '' )."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_underline' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-underline'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['body_li_style_decoration'] == 'line-through' ? 'selected' : '' )."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_column_".$col_no."' id='arp_style_strike' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-strikethrough'></i>";
							$new_col_string .= "</div>";
								
								
								
								$new_col_string .= "<input type='hidden' id='body_li_style_bold' name='body_li_style_bold_".$col_no."' value='".$column['body_li_style_bold']."' /> ";
								$new_col_string .= "<input type='hidden' id='body_li_style_italic' name='body_li_style_italic_".$col_no."' value='".$column['body_li_style_italic']."' /> ";
								$new_col_string .= "<input type='hidden' id='body_li_style_decoration' name='body_li_style_decoration_".$col_no."' value='".$column['body_li_style_decoration']."' /> ";
								
								
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$new_col_string .= "</div>";
							
							//new font style btn ends
						
						$new_col_string .= "</div>";
						
						//ok button div
						$new_col_string .= "<div class='col_opt_row arp_ok_div' id='body_level_other_arp_ok_div__button_1' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";							
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
						
					$new_col_string .= "</div>";
					
					///////////
					
					$new_col_string .= "<div class='column_option_div' level-id='body_level_options__button_2' style='display:none;'>";
						$new_col_string .= "<input type='hidden' id='total_rows' name='total_rows_".$col_no."' value='".$total_rows."' />";
						$new_col_string .= "<div class='col_opt_row' id='body_label_other_font_family'>";
							$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							$new_col_string .= "<div class='col_opt_input_div'>";
								
								$new_col_string .= "<input type='hidden' id='content_label_font_family' name='content_label_font_family_".$col_no."' data-column='main_column_".$col_no."' value='".$column['content_label_font_family']."' />";
								$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='content_label_font_family_".$col_no."' data-id='content_label_font_family_".$col_no."'>";
									$new_col_string .= "<dt><span>".$column['content_label_font_family']."</span><input type='text' style='display:none;' value='".$column['content_label_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$new_col_string .= "<dd>";
										$new_col_string .= "<ul data-id='content_label_font_family' data-column='column_".$col_no."'>";
										
										
												
										$new_col_string .= "</ul>";
									$new_col_string .= "</dd>";
								$new_col_string .= "</dl>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='body_label_other_font_size'>";
							$new_col_string .= "<div class='btn_type_size'>";
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								$new_col_string .= "<div class='col_opt_input_div two_column'>";
									
									$new_col_string .= "<input type='hidden' id='content_label_font_size' name='content_label_font_size_".$col_no."' value='".$column['content_label_font_size']."' data-column='main_column_".$col_no."' />";
									$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='content_label_font_size_".$col_no."' data-id='content_label_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
										$new_col_string .= "<dt><span>".$column['content_label_font_size']."</span><input type='text' style='display:none;' value='".$column['content_label_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$new_col_string .= "<dd>";
											$new_col_string .= "<ul data-id='content_label_font_size' data-column='column_".$col_no."'>";
													for($s=8;$s<=20;$s++)
														$size_arr[]=$s;
													for($st=22;$st<=70;$st+=2)
														$size_arr[]=$st;
													foreach($size_arr as $size)  {
														$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
													}
											$new_col_string .= "</ul>";
										$new_col_string .= "</dd>";
									$new_col_string .= "</dl>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							
							
							
								//font color btn
										$new_col_string .= "<div class='btn_type_size'>";
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
								$new_col_string .= "<div class='col_opt_input_div two_column'>";
									$new_col_string .= $arprice_form->font_color('content_label_font_color_'.$col_no,'main_column_'.$col_no,$column['content_label_font_color'],'content_label_font_color',$column['content_label_font_color']);
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
								//ends
							
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='col_opt_row' id='body_label_other_font_color'>";
						
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$new_col_string .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button2' >";
								
								
								
								$new_col_string  .= "<div class='arp_style_btn arptooltipster 
".($column['body_label_style_bold_'] == 'bold' ? 'selected' : '')."' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left'  data-column='main_column_".$col_no."' id='arp_style_bold' data-id='".$col_no."'>";
									$new_col_string  .= "<i class='fa fa-bold'></i>";
								$new_col_string  .= "</div>";
								
								$new_col_string  .= "<div class='arp_style_btn arptooltipster 
".($column['body_label_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center'  data-column='main_column_".$col_no."' id='arp_style_italic' data-id='".$col_no."'>";
									$new_col_string  .= "<i class='fa fa-italic'></i>";
								$new_col_string  .= "</div>";
								
								$new_col_string  .= "<div class='arp_style_btn arptooltipster ".($column['body_label_style_decoration'] == 'underline' ? 'selected' : '' )."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_underline' data-id='".$col_no."'>";
									$new_col_string  .= "<i class='fa fa-underline'></i>";
								$new_col_string  .= "</div>";
								
								$new_col_string  .= "<div class='arp_style_btn arptooltipster ".($column['body_label_style_decoration'] == 'line-through' ? 'selected' : '' )."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_strike' data-id='".$col_no."'>";
									$new_col_string  .= "<i class='fa fa-strikethrough'></i>";
								$new_col_string  .= "</div>";
								
								
								
								
								$new_col_string .= "<input type='hidden' id='body_label_style_bold' name='body_label_style_bold_".$col_no."' value='".$column['body_label_style_bold']."' /> ";
								$new_col_string .= "<input type='hidden' id='body_label_style_italic' name='body_label_style_italic_".$col_no."' value='".$column['body_label_style_italic']."' /> ";
								$new_col_string .= "<input type='hidden' id='body_label_style_decoration' name='body_label_style_decoration_".$col_no."' value='".$column['body_label_style_decoration']."' /> ";
								
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$new_col_string  .= "</div>";
							
							//new font style btn ends
						
						$new_col_string .= "</div>";
						
						//ok button div
							$new_col_string .= "<div class='col_opt_row arp_ok_div' id='body_level_other_arp_ok_div__button_2' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_btn_div'>";
								$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
								$new_col_string .= "</button>";							
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
						
					$new_col_string .= "</div>";
					
					//////////
					
					$new_col_string .= "<div class='column_option_div' level-id='button_options__button_4' style='display:none;'>";
					
						
				
					$new_col_string .= "</div>";
					
					////////////
					
					$new_col_string .= "<div class='column_option_div' level-id='button_options__button_1' style='display:none;'>";
				
					// BUTTON TEXT
					$new_col_string .= "<div class='col_opt_row' id='button_text' style='display:none;'>";
						$new_col_string .= "<div class='col_opt_title_div'>".__('Button Content',ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div'>";
							$new_col_string .= "<textarea id='btn_content' data-column='main_column_".$col_no."' name='btn_content_".$col_no."' class='col_opt_textarea'>";
							$new_col_string .= $column['button_text'];
							$new_col_string .= "</textarea>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
								
				
					// ADD ICON
					$new_col_string .= "<div class='col_opt_row' id='add_icon' style='display:none;'>";
						$new_col_string .= "<div class='col_opt_btn_div'>";
							$new_col_string .= "<button onclick='add_arp_button_shortcode(this,false);' type='button' class='col_opt_btn' name='add_button_shortcode_".$col_no."' id='add_button_shortcode'>";
								/*$new_col_string .= "<i class='fa fa-plus'></i>";
								$new_col_string .= __('Add Icon',ARP_PT_TXTDOMAIN);*/
								$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
							$new_col_string .= "</button>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					$new_col_string .= "<div class='col_opt_row' id='button_size'>";
							$new_col_string .= "<div class='btn_type_size'>";
								$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Button Size',ARP_PT_TXTDOMAIN)."</div>";
								$new_col_string .= "<div class='col_opt_input_div two_column'>";
									
									global $arp_coloptionsarr;
									
									$new_col_string .= "<input type='hidden' id='button_size_input' name='button_size_".$col_no."' value='".$column['button_size']."' data-column='main_column_".$col_no."' />";
									$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='button_size_".$col_no."' data-id='button_size_".$col_no."' style='width:115px;max-width:115px;'>";
										$new_col_string .= "<dt><span>".$column['button_size']."</span><input type='text' style='display:none;' value='".$column['button_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$new_col_string .= "<dd>";
											$new_col_string .= "<ul data-id='button_size_input' data-column='column_".$col_no."'>";
												foreach( $arp_coloptionsarr['column_button_options']['button_size'] as $btn_size ){
													$new_col_string .= "<li data-value='".$btn_size."' data-label='".$btn_size."' >".$btn_size."</li>";
												}
											$new_col_string .= "</ul>";
										$new_col_string .= "</dd>";
									$new_col_string .= "</dl>";
									
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
					
					// BUTTON FONT FAMILY
					$new_col_string .= "<div class='col_opt_row' id='button_other_font_family' style='display:none;'>";
						$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div'>";
							/*$new_col_string .= "<select class='arp_select_box' id='button_font_family' data-column='main_column_".$col_no."' name='button_font_family_".$col_no."'>";
								$new_col_string .= arprice_form::font_settings($column['button_font_family']);
							$new_col_string .= "</select>";*/
							$new_col_string .= "<input type='hidden' id='button_font_family' name='button_font_family_".$col_no."' data-column='main_column_".$col_no."' value='".$column['button_font_family']."' />";
							$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='button_font_family_".$col_no[1]."' data-id='button_font_family_".$col_no[1]."'>";
								$new_col_string .= "<dt><span>".$column['button_font_family']."</span><input type='text' style='display:none;' value='".$column['button_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
								$new_col_string .= "<dd>";
									$new_col_string .= "<ul data-id='button_font_family' data-column='column_".$col_no."'>";
									
								
									$new_col_string .= "</ul>";
								$new_col_string .= "</dd>";
							$new_col_string .= "</dl>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					// BUTTON FONT SIZE
					$new_col_string .= "<div class='col_opt_row' id='button_other_font_size' style='display:none;'>";
						$new_col_string .= "<div class='btn_type_size'>";
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
								/*$new_col_string .= "<select class='arp_select_box cls_font_size' id='button_font_size' name='button_font_size_".$col_no."' data-column='main_column_".$col_no."'>";
									$new_col_string .= arprice_form::font_size($column['button_font_size']);
								$new_col_string .= "</select>";*/
								$new_col_string .= "<input type='hidden' id='button_font_size' name='button_font_size_".$col_no."' value='".$column['button_font_size']."' data-column='main_column_".$col_no."' />";
								$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='button_font_size_".$col_no."' data-id='button_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
									$new_col_string .= "<dt><span>".$column['button_font_size']."</span><input type='text' style='display:none;' value='".$column['button_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$new_col_string .= "<dd>";
										$new_col_string .= "<ul data-id='button_font_size' data-column='column_".$col_no."'>";
												for($s=8;$s<=20;$s++)
													$size_arr[]=$s;
												for($st=22;$st<=70;$st+=2)
													$size_arr[]=$st;
												foreach($size_arr as $size)  {
													$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
												}
										$new_col_string .= "</ul>";
									$new_col_string .= "</dd>";
								$new_col_string .= "</dl>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
				
						
						
						//font color btn 
							
								$new_col_string .= "<div class='btn_type_size'>";
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
								$new_col_string .= $arprice_form->font_color('button_font_color_'.$col_no,'main_column_'.$col_no,$column['button_font_color'],'button_font_color',$column['button_font_color']);
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
							
						//end
					
					$new_col_string .= "</div>";
				
					// BUTTON FONT COLOR
					$new_col_string .= "<div class='col_opt_row' id='button_other_font_color'>";
					
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$new_col_string .= "<div class='col_opt_input_div' data-level='button_level_options'  level-id='buttonoptions_button1' >";
								
								
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['button_style_bold'] == 'bold' ? 'selected' : '')."' data-align='left' title='".__('Bold',ARP_PT_TXTDOMAIN)."'  data-column='main_column_".$col_no."' id='arp_style_bold' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-bold'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string.= "<div class='arp_style_btn arptooltipster ".($column['button_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center'  data-column='main_column_".$col_no."' id='arp_style_italic' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-italic'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['button_style_decoration'] == 'underline' ? 'selected' : '' )."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_underline' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-underline'></i>";
								$new_col_string .= "</div>";
								
								$new_col_string .= "<div class='arp_style_btn arptooltipster ".($column['button_style_decoration'] == 'line-through' ? 'selected' : '' )."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right'  data-column='main_column_".$col_no."' id='arp_style_strike' data-id='".$col_no."'>";
									$new_col_string .= "<i class='fa fa-strikethrough'></i>";
								$new_col_string .= "</div>";
								
								
								
								$new_col_string .= "<input type='hidden' id='button_style_bold' name='button_style_bold_".$col_no."' value='".$column['button_style_bold']."' /> ";
								$new_col_string .= "<input type='hidden' id='button_style_italic' name='button_style_italic_".$col_no."' value='".$column['button_style_italic']."' /> ";
								$new_col_string .= "<input type='hidden' id='button_style_decoration' name='button_style_decoration_".$col_no."' value='".$column['button_style_decoration']."' /> ";
								
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$new_col_string.= "</div>";
							
							//new font style btn ends
						
					$new_col_string .= "</div>";
					
					//ok button div
					$new_col_string .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_1'>";
						$new_col_string .= "<div class='col_opt_btn_div'>";
							$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";							
								$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
							$new_col_string .= "</button>";								
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";	
					
					
				$new_col_string .= "</div>";
				
				$new_col_string .= "<div class='column_option_div' level-id='button_options__button_2' style='display:none;'>";
					
					// BUTTON IMAGE
					$new_col_string .= "<div class='col_opt_row' id='button_image' style='display:none;'>";
						$new_col_string .= "<div class='col_opt_title_div'>".__('Button Image url',ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div'>";
							$new_col_string .= "<input type='text' id='btn_img_url' class='col_opt_input arpbtn_img_url' name='btn_img_url_".$col_no."' value='".$column['btn_img']."' >";
						$new_col_string .= "</div>";
						$new_col_string .= "<input type='hidden' class='arpbtn_img_height' id='arpbtn_img_height' value='' name='button_img_height_".$col_no."' />";
						$new_col_string .= "<input type='hidden' class='arpbtn_img_width' id='arpbtn_img_width' value='' name='button_img_width_".$col_no."' />";
					$new_col_string .= "</div>";
				
					// ADD SHORTCODE
					$new_col_string .= "<div class='col_opt_row' id='add_shortcode' style='display:none;'>";
						$new_col_string .= "<div class='col_opt_btn_div'>";
							$new_col_string .= "<button onclick='add_arp_button_scode(this,false);' type='button' class='col_opt_btn' name='add_button_scode_".$col_no."' id='add_button_scode'>";
								/*$new_col_string .= "<i class='fa fa-plus'></i>";
								$new_col_string .= __('Add Shortcode',ARP_PT_TXTDOMAIN);*/
							$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
							$new_col_string .= "</button>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					//ok button div
					$new_col_string .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_2'>";
						$new_col_string .= "<div class='col_opt_btn_div'>";
							$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";							
								$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
							$new_col_string .= "</button>";								
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
								
				$new_col_string .= "</div>";
				
				$new_col_string .= "<div class='column_option_div' level-id='button_options__button_3' style='display:none;'>";
				
					// REDIRECT LINK
					$new_col_string .= "<div class='col_opt_row' id='redirect_link' style='display:none;'>";
						$new_col_string .= "<div class='col_opt_title_div'>".__('Button Link', ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div'>";
							$new_col_string .= "<input type='text' id='btn_link' class='col_opt_input' name='btn_link_".$col_no."' value='".$column['button_url']."' />";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";	
				
					// OPEN IN NEW WINDOW
					$new_col_string .= "<div class='col_opt_row' id='open_in_new_window' style='display:none;'>";
						$new_col_string .= "<div class='col_opt_title_div two_column more_size'>".__('Open in New Window?',ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div two_column small_size'>";
							$new_col_string .= "<div class='arp_checkbox_div'>";
								if( $column['is_new_window'] == 1 )
									$new_window = 'checked="checked"';
								else
									$new_window = '';
									
								$new_col_string .= "<input type='checkbox' class='arp_checkbox dark_bg' ".$new_window." id='new_window' value='1' name='new_window_".$col_no."' />";
								$new_col_string .= "<label class='arp_checkbox_label'>".__('Yes',ARP_PT_TXTDOMAIN)."</label>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
											
					$new_col_string .= "<div class='col_opt_row' id='external_btn_s'>";
						$new_col_string .= "<div class='col_opt_title_div'>".__('Paypal Code',ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div'>";
							$new_col_string .= "<textarea class='col_opt_textarea' name='second_paypal_code_".$col_no."' id='arp_paypal_code'>";
							$new_col_string .= $column['paypal_code'];
							$new_col_string .= "</textarea>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
						
						//ok button div
					$new_col_string .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_3'>";
						$new_col_string .= "<div class='col_opt_btn_div'>";
							$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";							
								$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
							$new_col_string .= "</button>";								
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";	
								
				$new_col_string .= "</div>";
				
				
				/////
				
				
				$new_col_string .= "<div class='column_option_div' level-id='second_button_options__button_1' style='display:none;'>";
					
					$new_col_string .= "<div class='col_opt_row' id='button_text_s'>";
						$new_col_string .= "<div class='col_opt_title_div'>".__('Button Content',ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div'>";
							$new_col_string .= "<textarea id='second_btn_content' data-column='main_column_column_".$col_no."' name='second_btn_content_".$col_no."' class='col_opt_textarea'>";
								$new_col_string .= $column['button_s_text'];
							$new_col_string .= "</textarea>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					$new_col_string .= "<div class='col_opt_row' id='add_icon_s'>";
						$new_col_string .= "<div class='col_opt_btn_div'>";
							$new_col_string .= "<button onclick='add_arp_button_shortcode(this,true);' type='button' class='col_opt_btn tooltipster' name='second_add_button_shortcode_".$col_no."' id='second_add_button_shortcode'>";
								/*$new_col_string .= "<i class='fa fa-plus'></i>";
								$new_col_string .= __('Add Icon',ARP_PT_TXTDOMAIN);*/
								$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
							$new_col_string .= "</button>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					$new_col_string .= "<div class='col_opt_row' id='external_btn_s'>";
						$new_col_string .= "<div class='col_opt_title_div'>".__('Paypal Code',ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div'>";
							$new_col_string .= "<textarea class='col_opt_textarea' name='second_paypal_code_".$col_no."' id='arp_paypal_code'>";
							$new_col_string .= $column['paypal_s_code'];
							$new_col_string .= "</textarea>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					$new_col_string .= "<div class='col_opt_row' id='second_button_other_font_family'>";
						$new_col_string .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div'>";
							
							$new_col_string .= "<input type='hidden' id='second_button_font_family' name='second_button_font_family_".$col_no."' data-column='main_column_".$col_no."' value='".$column['second_button_font_family']."' />";
							$new_col_string .= "<dl class='arp_selectbox column_level_dd' data-name='second_button_font_family_".$col_no[1]."' data-id='second_button_font_family_".$col_no[1]."'>";
								$new_col_string .= "<dt><span>".$column['second_button_font_family']."</span><input type='text' style='display:none;' value='".$column['second_button_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
								$new_col_string .= "<dd>";
									$new_col_string .= "<ul data-id='second_button_font_family' data-column='column_".$col_no."'>";
								
									$new_col_string .= "</ul>";
								$new_col_string .= "</dd>";
							$new_col_string .= "</dl>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					$new_col_string .= "<div class='col_opt_row' id='second_button_other_font_size'>";
						$new_col_string .= "<div class='btn_type_size'>";
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
							
								$new_col_string .= "<input type='hidden' id='second_button_font_size' name='second_button_font_size_".$col_no."' value='".$column['second_button_font_size']."' data-column='main_column_".$col_no."' />";
								$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='second_button_font_size_".$col_no."' data-id='second_button_font_size_".$col_no."' style='width:115px;max-width:115px;'>";
									$new_col_string .= "<dt><span>".$column['second_button_font_size']."</span><input type='text' style='display:none;' value='".$column['second_button_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$new_col_string .= "<dd>";
										$new_col_string .= "<ul data-id='second_button_font_size' data-column='column_".$col_no."'>";
												for($s=8;$s<=20;$s++)
													$size_arr[]=$s;
												for($st=22;$st<=70;$st+=2)
													$size_arr[]=$st;
												foreach($size_arr as $size)  {
													$new_col_string .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
												}
										$new_col_string .= "</ul>";
									$new_col_string .= "</dd>";
								$new_col_string .= "</dl>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
						
						$new_col_string .= "<div class='btn_type_size'>";
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
								
								$new_col_string .= "<input type='hidden' id='second_button_font_style' name='second_button_font_style_".$col_no."' value='".$column['second_button_font_style']."' data-column='main_column_".$col_no."' />";
								$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='second_button_font_style_".$col_no."' data-id='second_button_font_style_".$col_no."' style='width:115px;max-width:115px;'>";
									$new_col_string .= "<dt><span>".$column['second_button_font_style']."</span><input type='text' style='display:none;' value='".$column['second_button_font_style']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$new_col_string .= "<dd>";
										$new_col_string .= "<ul data-id='second_button_font_style' data-column='".$j."'>";
											$new_col_string .= $arprice_form->font_style_new();
										$new_col_string .= "</ul>";
									$new_col_string .= "</dd>";
								$new_col_string .= "</dl>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
				
					$new_col_string .= "<div class='col_opt_row' id='second_button_other_font_color'>";
						$new_col_string .= "<div class='btn_type_size'>";
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
								$new_col_string .= $arprice_form->font_color('second_button_font_color_'.$col_no,'main_column_'.$col_no,$column['second_button_font_color'],'second_button_font_color',$column['second_button_font_color']);
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					//ok button div
					$new_col_string .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_1' style='display:none;'>";
						$new_col_string .= "<div class='col_opt_btn_div'>";
							$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
								$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
							$new_col_string .= "</button>";							
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
									
				$new_col_string .= "</div>";
				
				$new_col_string .= "<div class='column_option_div' level-id='second_button_options__button_2' style='display:none;'>";
					
					$new_col_string .= "<div class='col_opt_row' id='button_image_s'>";
						$new_col_string .= "<div class='col_opt_title_div'>".__('Button Image url',ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div'>";
							$new_col_string .= "<input type='text' id='second_btn_img_url' class='col_opt_input arpbtn_img_url' name='second_btn_img_url_".$col_no."'>";
						$new_col_string .= "</div>";
						$new_col_string .= "<input type='hidden' id='second_arpbtn_img_height' class='arpbtn_img_height' value='' name='second_button_img_height_".$col_no."' />";
						$new_col_string .= "<input type='hidden' id='second_arpbtn_img_width' class='arpbtn_img_width' value='' name='second_button_img_width_".$col_no."' />";
					$new_col_string .= "</div>";
					
					$new_col_string .= "<div class='col_opt_row' id='add_shortcode_s'>";
						$new_col_string .= "<div class='col_opt_btn_div'>";
							$new_col_string .= "<button onclick='add_arp_button_scode(this,true);' type='button' class='col_opt_btn' name='second_add_button_scode_".$col_no."' id='second_add_button_shortcode'>";
								/*$new_col_string .= "<i class='fa fa-plus'></i>";
								$new_col_string .= __('Add Shortcode',ARP_PT_TXTDOMAIN);*/
							$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
							$new_col_string .= "</button>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					//ok button div
					$new_col_string .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_2' style='display:none;'>";
						$new_col_string .= "<div class='col_opt_btn_div'>";
							$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
								$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
							$new_col_string .= "</button>";							
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
										
				$new_col_string .= "</div>";
				
				$new_col_string .= "<div class='column_option_div' level-id='second_button_options__button_3' style='display:none;'>";
					
					$new_col_string .= "<div class='col_opt_row' id='redirect_link_s'>";
						$new_col_string .= "<div class='col_opt_title_div'>".__('Button Link', ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div'>";
							$new_col_string .= "<input type='text' id='second_btn_link' class='col_opt_input' name='second_btn_link_".$col_no."' value='".$column['button_s_url']."' />";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					$new_col_string .= "<div class='col_opt_row' id='open_in_new_window_s'>";
						$new_col_string .= "<div class='col_opt_title_div two_column more_size'>".__('Open in New Window?',ARP_PT_TXTDOMAIN)."</div>";
						$new_col_string .= "<div class='col_opt_input_div two_column small_size'>";
							$new_col_string .= "<div class='arp_checkbox_div'>";
								if( $column['s_is_new_window'] == 1 )
									$new_window = 'checked="checked"';
								else
									$new_window = '';
									
								$new_col_string .= "<input type='checkbox' class='arp_checkbox dark_bg' ".$new_window." id='second_new_window' value='1' name='second_new_window_".$col_no."' />";
								$new_col_string .= "<label class='arp_checkbox_label'>".__('Yes',ARP_PT_TXTDOMAIN)."</label>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					$new_col_string .= "<div class='col_opt_row' id='button_size_s'>";
						$new_col_string .= "<div class='btn_type_size'>";
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Button Size',ARP_PT_TXTDOMAIN)."</div>";
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
								global $arp_coloptionsarr;
								$new_col_string .= "<select id='second_button_size' name='second_button_size_".$col_no."' class='arp_select_box btn_type_size'>";
								foreach( $arp_coloptionsarr['column_button_options']['button_size'] as $btn_size ){
									if( $btn_size == $column['button_s_size'] )
										$selected_btn_size = "selected='selected'";
										
									$new_col_string .= "<option ".$selected_btn_size." value='".$btn_size."'>".$btn_size."</option>";
								}
								$new_col_string .= "</select>";
								$new_col_string .= "<input type='hidden' id='second_button_size' name='second_button_size_".$col_no."' data-column='main_column_".$col_no."' value='".$column['button_s_size']."' />";
								$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='second_button_size_".$col_no."' data-id='second_button_size_".$col_no."' style='width:115px;max-width:115px;'>";
									$new_col_string .= "<dt><span>".$column['button_s_size']."</span><input type='text' style='display:none;' value='".$column['button_s_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$new_col_string .= "<dd>";
										$new_col_string .= "<ul data-id='second_button_size' data-column='column_".$col_no."'>";
											foreach( $arp_coloptionsarr['column_button_options']['button_size'] as $btn_size ){
												$new_col_string .= "<li data-value='".$btn_size."' data-label='".$btn_size."' >".$btn_size."</li>";
											}
										$new_col_string .= "</ul>";
									$new_col_string .= "</dd>";
								$new_col_string .= "</dl>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
					//ok button div
					$new_col_string .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_3' style='display:none;'>";
						$new_col_string .= "<div class='col_opt_btn_div'>";
							$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
								$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
							$new_col_string .= "</button>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
				$new_col_string .= "</div>";
				
				$new_col_string .= "<div class='column_option_div' level-id='second_button_options__button_4' style='display:none;'>";
					
					
					
					$new_col_string .= "<div class='col_opt_row' id='button_type_s'>";
						$new_col_string .= "<div class='btn_type_size'>";
							$new_col_string .= "<div class='col_opt_title_div two_column'>".__('Button Type',ARP_PT_TXTDOMAIN)."</div>";
							$new_col_string .= "<div class='col_opt_input_div two_column'>";
							
								$new_col_string .= "<input type='hidden' id='second_button_type' name='second_button_type_".$col_no."' data-column='main_column_".$col_no."' value='".$column['button_s_type']."' />";
								$new_col_string .= "<dl class='arp_selectbox column_level_size_dd' data-name='second_button_size_".$col_no."' data-id='second_button_size_".$col_no."' style='width:115px;max-width:115px;'>";
									$new_col_string .= "<dt><span>".$column['button_s_type']."</span><input type='text' style='display:none;' value='".$column['button_s_type']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$new_col_string .= "<dd>";
										$new_col_string .= "<ul data-id='second_button_type' data-column='".$j."'>";
											foreach( $arp_coloptionsarr['column_button_options']['button_type'] as $btn_type=>$btn_type_value ){
												$new_col_string .= "<li data-value='".$btn_type."' data-label='".$btn_type_value."'>".$btn_type_value."</li>";
											}
										$new_col_string .= "</ul>";
									$new_col_string .= "</dd>";
								$new_col_string .= "</dl>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
					$new_col_string .= "</div>";
					
				$new_col_string .= "</div>";
				
				
				///////
				
				$new_col_string .= "<div class='column_option_div' level-id='body_li_level_options__button_1' style='display:none;'>";
					
					foreach( $column['rows'] as $n=> $row )
					{
						$row_no = explode('_',$n);
						$splitedid = explode('_',$n);
						
						$new_col_string .= "<div id='arp_".$n."' class='arp_row_wrapper' style='display:none;'>";
						
						if(in_array( 'label',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_1'] )){

							$new_col_string .= "<div class='col_opt_row arp_".$n."' id='label".$splitedid[1]."'>";
								$new_col_string .= "<div class='col_opt_title_div'>".__('Label',ARP_PT_TXTDOMAIN)."</div>";
								$new_col_string .= "<div class='col_opt_input_div'>";
									$new_col_string .= "<textarea id='label' class='col_opt_textarea' name='row_".$col_no."_label_".$row_no[1]."'>";
										$new_col_string .= stripslashes_deep($row['row_label']);
									$new_col_string .= "</textarea>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							
							
							if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_1'] ) ){
							
								if(in_array( 'arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_1'] )){
							$new_col_string .= "<div class='col_opt_row arp_".$n."' id='body_tooltip_add_shortcode".$splitedid[1]."' >";
								$new_col_string .= "<div class='col_opt_btn_div'>";
									$new_col_string .= "<button type='button' class='col_opt_btn arptooltipster arp_add_label_shortcode' id='arp_add_label_shortcode' name='row_".$col_no."_add_tooltip_shortcode_btn_".$row_no[1]."' col-id=".$col_no." data-id='".$col_no."' data-row-id='label_".$splitedid[1]."' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
										/*$tablestring .= "<i class='fa fa-plus'></i>";
										$tablestring .= __('Add Shortcode',ARP_PT_TXTDOMAIN);*/
										$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$new_col_string .= "</button>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							}
						}
					}	
						
							
							$new_col_string .= "<div class='col_opt_row arp_".$n."' id='description".$splitedid[1]."'>";
								$new_col_string .= "<div class='col_opt_title_div'>".__('Description',ARP_PT_TXTDOMAIN)."</div>";
								$new_col_string .= "<div class='col_opt_input_div'>";
									$new_col_string .= "<textarea id='arp_li_description' col-id=".$col_no." class='col_opt_textarea' name='row_".$col_no."_description_".$row_no[1]."'>";
										$new_col_string .= stripslashes_deep($row['row_description']);
									$new_col_string .= "</textarea>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							
							
								
							$new_col_string .= "<div class='col_opt_row arp_".$n."' id='body_li_add_shortcode".$splitedid[1]."' >";
								$new_col_string .= "<div class='col_opt_btn_div'>";	
									$new_col_string .= "<button type='button' class='col_opt_btn_icon arp_add_row_object arptooltipster' name='".$col_no."_add_body_li_object_".$row_no[1]."' id='arp_add_row_object' data-insert='arp_".$n." textarea#arp_li_description' data-column='main_column_".$col_no."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
										$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
									$new_col_string .= "</button>";
								$new_col_string .= "<label style='float:left;width:10px;'>&nbsp;</label>";
	
	
									$new_col_string .= "<button type='button' class='col_opt_btn arptooltipster arp_add_row_shortcode' id='arp_add_row_shortcode' name='row_".$col_no."_add_description_shortcode_btn_".$row_no[1]."' col-id=".$col_no." data-id='".$col_no."' data-row-id='' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
										$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$new_col_string .= "</button>";
							$new_col_string .= "</div>";
						$new_col_string .= "</div>";
							//
							
							
							//ok button div
							$new_col_string .= "<div class='col_opt_row arp_ok_div arp_".$n."' id='body_li_level_other_arp_ok_div__button_1".$splitedid[1]."' >";
								$new_col_string .= "<div class='col_opt_btn_div'>";
									$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
										$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
									$new_col_string .= "</button>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							
						$new_col_string .= "</div>";					
												
					}
				
				$new_col_string .= "</div>";
				
				
				$new_col_string .= "<div class='column_option_div' level-id='body_li_level_options__button_2' style='display:none;'>";
				
					foreach( $column['rows'] as $n=> $row )
					{
						$row_no = explode('_',$n);
						$splitedid = explode('_',$n);
						
						$new_col_string .= "<div class='arp_tooltip_wrapper' id='arp_".$n."' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_row arp_".$n."' id='tooltip".$splitedid[1]."' >";
								$new_col_string .= "<div class='col_opt_title_div'>".__('Tooltip',ARP_PT_TXTDOMAIN)."</div>";
								$new_col_string .= "<div class='col_opt_input_div'>";
									$new_col_string .= "<textarea id='arp_li_tooltip' col-id=".$col_no." class='col_opt_textarea' name='row_".$col_no."_tooltip_".$row_no[1]."'>";
										$new_col_string .= stripslashes_deep($row['row_tooltip']);
									$new_col_string .= "</textarea>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							
							if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_2'] ) ){
							
								if(in_array( 'arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_2'] )){
							$new_col_string .= "<div class='col_opt_row arp_".$n."' id='body_tooltip_add_shortcode".$splitedid[1]."' >";
								$new_col_string .= "<div class='col_opt_btn_div'>";
									$new_col_string .= "<button type='button' class='col_opt_btn arptooltipster arp_add_tooltip_shortcode' id='arp_add_tooltip_shortcode' name='row_".$col_no."_add_tooltip_shortcode_btn_".$row_no[1]."' col-id=".$col_no." data-id='".$col_no."' data-row-id='tooltip_".$splitedid[1]."' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
										/*$tablestring .= "<i class='fa fa-plus'></i>";
										$tablestring .= __('Add Shortcode',ARP_PT_TXTDOMAIN);*/
										$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$new_col_string .= "</button>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							}
						}	
							
							
							//ok button div
							$new_col_string .= "<div class='col_opt_row arp_ok_div arp_".$n."' id='body_li_level_other_arp_ok_div__button_2".$splitedid[1]."'  >";
									$new_col_string .= "<div class='col_opt_btn_div'>";
										$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
											$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
										$new_col_string .= "</button>";
									$new_col_string .= "</div>";	
							$new_col_string .= "</div>";
							
						$new_col_string .= "</div>";
					}
				
				$new_col_string .= "</div>";
				
				$new_col_string .= "<div class='column_option_div' level-id='body_li_level_options__button_3' style='display:none;'>";
					if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] ) ){
						if(in_array( 'label',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] )){
					foreach( $column['rows'] as $n=>$row ){
						$row_no = explode('_',$n);
						$splitedid = explode('_',$n);
						
						$new_col_string .= "<div class='arp_row_label_wrapper' id='arp_".$n."' style='display:none;'>";
							$new_col_string .= "<div class='col_opt_row arp_".$n."' id='label".$splitedid[1]."'>";
								$new_col_string .= "<div class='col_opt_title_div'>".__('Label',ARP_PT_TXTDOMAIN)."</div>";
								$new_col_string .= "<div class='col_opt_input_div'>";
									$new_col_string .= "<textarea id='label' class='col_opt_textarea' name='row_".$col_no."_label_".$row_no[1]."'>";
										$new_col_string .= stripslashes_deep($row['row_label']);
									$new_col_string .= "</textarea>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							
							
							if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] ) ){
							
								if(in_array( 'arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] )){
							$new_col_string .= "<div class='col_opt_row arp_".$n."' id='body_tooltip_add_shortcode".$splitedid[1]."' >";
								$new_col_string .= "<div class='col_opt_btn_div'>";
									$new_col_string .= "<button type='button' class='col_opt_btn arptooltipster arp_add_label_shortcode' id='arp_add_label_shortcode' name='row_".$col_no."_add_tooltip_shortcode_btn_".$row_no[1]."' col-id=".$col_no." data-id='".$col_no."' data-row-id='label_".$splitedid[1]."' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
										/*$tablestring .= "<i class='fa fa-plus'></i>";
										$tablestring .= __('Add Shortcode',ARP_PT_TXTDOMAIN);*/
										$new_col_string .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$new_col_string .= "</button>";
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							}
						}
							
							
							//ok button div
							$new_col_string .= "<div class='col_opt_row arp_ok_div arp_".$n."' id='body_li_level_other_arp_ok_div__button_3".$splitedid[1]."'>";
								$new_col_string .= "<div class='col_opt_btn_div'>";
									$new_col_string .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
										$new_col_string .= __('Ok',ARP_PT_TXTDOMAIN);
									$new_col_string .= "</button>";						
								$new_col_string .= "</div>";
							$new_col_string .= "</div>";
							
						$new_col_string .= "</div>";
					}
						}	
					}
				$new_col_string .= "</div>";
				
				
				
			
			$new_col_string .= "</div>";
						
			
		
		$new_col_string .= "</div>";
		
		$json_array = array('new_column'=>$new_col_string);
		
		return json_encode( $json_array );
	}
	
	function add_new_row_new(){
	
		$total_rows = $_POST['total_rows'];
		
		$features = json_decode( stripslashes_deep($_POST['template_features']),true);
		
		$column_id = $_POST['column'];
		
		$template = $_POST['template'];
		
		$li_id = $total_rows;
		
		$new_row_string = "";
		
		$new_row_wrapper = "";
		
		$new_row_tooltip = "";
		
		$new_row_label = "";
		
		$new_row_string .= "<li id='arp_row_".$li_id."' class='arpbodyoptionrow' data-column='main_column_".$column_id."' style=''>";
		
			if( $features['caption_style'] == 'style_1' || $features['caption_style'] == 'style_2' ){
				$new_row_string .= "<span class='caption_li'>&nbsp;</span>";
				$new_row_string .= "<span class='caption_detail' title=''>&nbsp;</span>";
			} else {
				$new_row_string .= "<span class='' title=''>&nbsp;</span>";
			}
		
		$new_row_string .= "</li>";
		
		// New Row Description
		
		$new_row_wrapper .= "<div id='arp_row_".$li_id."' class='arp_row_wrapper' style=''>";
		
		
			if($template == 'arptemplate_8' || $template == 'arptemplate_10'){
			$new_row_wrapper .= "<div id='label".$li_id."' class='col_opt_row arp_row_".$li_id."' style='display:none;'>";
				
					$new_row_wrapper .= "<div class='col_opt_title_div'>".__('Label',ARP_PT_TXTDOMAIN)."</div>";
					
					$new_row_wrapper .= "<div class='col_opt_input_div'>";
					
						$new_row_wrapper .= "<textarea id='label' class='col_opt_textarea' name='row_".$column_id."_label_".$li_id."'></textarea>";
					
					$new_row_wrapper .= "</div>";
				
				$new_row_wrapper .= "</div>";
				
				$new_row_wrapper .= "<div id='body_li_add_shortcode".$li_id."' class='col_opt_row arp_row_".$li_id."' style='display:none;'>";
		
				$new_row_wrapper .= "<div class='col_opt_btn_div'>";
  																   
					$new_row_wrapper .= "<button type='button' id='arp_add_label_shortcode' class='col_opt_btn arptooltipster arp_add_label_shortcode' data-row-id='label_".$li_id."' data-id='".$column_id."' col-id='".$column_id."' name='row_".$column_id."_add_tooltip_shortcode_btn_".$li_id."' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."'>";
					
																	
						$new_row_wrapper .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
		
					$new_row_wrapper .= "</button>";
		
				$new_row_wrapper .= "</div>";
		
			$new_row_wrapper .= "</div>";
			
			}
		
		
		
		
		
		
		
			$new_row_wrapper .= "<div id='description".$li_id."' class='col_opt_row arp_row_".$li_id."' style='display:none;'>";
		
				$new_row_wrapper .= "<div class='col_opt_title_div'>".__('Description',ARP_PT_TXTDOMAIN)."</div>";
		
				$new_row_wrapper .= "<div class='col_opt_input_div'>";
		
					$new_row_wrapper .= "<textarea id='arp_li_description' class='col_opt_textarea' name='row_".$column_id."_description_".$li_id."'>";
		
					$new_row_wrapper .= "</textarea>";
		
				$new_row_wrapper .= "</div>";
		
			$new_row_wrapper .= "</div>";
				
			
			
			
			//
				$new_row_wrapper .= "<div class='col_opt_row arp_".$n."' id='body_li_add_shortcode".$splitedid[1]."' >";
								$new_row_wrapper .= "<div class='col_opt_btn_div'>";	
									$new_row_wrapper .= "<button type='button' class='col_opt_btn_icon arp_add_row_object arptooltipster' name='".$col_no[1]."_add_body_li_object_".$row_no[1]."' id='arp_add_row_object' data-insert='arp_".$n." textarea#arp_li_description' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
										$new_row_wrapper .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
									$new_row_wrapper .= "</button>";
								$new_row_wrapper .= "<label style='float:left;width:10px;'>&nbsp;</label>";
	
	
									$new_row_wrapper .= "<button type='button' class='col_opt_btn arptooltipster arp_add_row_shortcode' id='arp_add_row_shortcode' name='row_".$col_no[1]."_add_description_shortcode_btn_".$row_no[1]."' col-id=".$col_no[1]." data-id='".$col_no[1]."' data-row-id='' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
										$new_row_wrapper .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$new_row_wrapper .= "</button>";
							$new_row_wrapper .= "</div>";
						$new_row_wrapper .= "</div>";
			//
			
				$new_row_wrapper .= "<div class='col_opt_row arp_ok_div arp_".$n." arp_row_".$li_id."' id='body_li_level_other_arp_ok_div__button_1".$splitedid[1]."'  >";
									$new_row_wrapper .= "<div class='col_opt_btn_div'>";
										$new_row_wrapper .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
											$new_row_wrapper .= __('Ok',ARP_PT_TXTDOMAIN);
										$new_row_wrapper.= "</button>";
									$new_row_wrapper .= "</div>";	
							$new_row_wrapper .= "</div>";
		
		$new_row_wrapper .= "</div>";
		
		// New Row Tooltip
		
		$new_row_tooltip .= "<div id='arp_row_".$li_id."' class='arp_tooltip_wrapper'>";
		
			$new_row_tooltip .= "<div id='tooltip".$li_id."' class='col_opt_row arp_row_".$li_id."' style='display:none'>";
		
				$new_row_tooltip .= "<div class='col_opt_title_div'>".__('Tooltip',ARP_PT_TXTDOMAIN)."</div>";
		
				$new_row_tooltip .= "<div class='col_opt_input_div'>";
		
					$new_row_tooltip .= "<textarea id='arp_li_tooltip' class='col_opt_textarea' name='row_".$column_id."_tooltip_".$li_id."' col-id='".$column_id."'></textarea>";
		
				$new_row_tooltip .= "</div>";
		
			$new_row_tooltip .= "</div>";
			
			$new_row_tooltip .= "<div id='body_li_add_shortcode".$li_id."' class='col_opt_row arp_row_".$li_id."' style='display:none;'>";
		
				$new_row_tooltip .= "<div class='col_opt_btn_div'>";
		
					
					
					$new_row_tooltip .= "<button type='button' class='col_opt_btn arptooltipster arp_add_tooltip_shortcode' id='arp_add_tooltip_shortcode' name='row_".$column_id."_add_tooltip_shortcode_btn_".$li_id."' col-id=".$column_id." data-id='".$column_id."' data-row-id='tooltip_".$li_id."' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
		
						/*$new_row_tooltip .= "<i class='fa fa-plus'></i>";
		
						$$new_row_tooltip .= __('Add Shortcode',ARP_PT_TXTDOMAIN);*/
						
						$new_row_tooltip .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
		
					$new_row_tooltip .= "</button>";
		
				$new_row_tooltip .= "</div>";
		
			$new_row_tooltip .= "</div>";
			
			
				$new_row_tooltip .= "<div class='col_opt_row arp_ok_div arp_".$n." arp_row_".$li_id."' id='body_li_level_other_arp_ok_div__button_2".$splitedid[1]."'  >";
									$new_row_tooltip .= "<div class='col_opt_btn_div'>";
										$new_row_tooltip .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
											$new_row_tooltip .= __('Ok',ARP_PT_TXTDOMAIN);
										$new_row_tooltip.= "</button>";
									$new_row_tooltip .= "</div>";	
							$new_row_tooltip .= "</div>";
			
			
		
		$new_row_tooltip .= "</div>";
		
		// New Row Label
		
		if( $features['caption_style'] == 'style_1' || $features['caption_style'] == 'style_2' ){
			
			$new_row_label .= "<div id='arp_row_".$li_id."' class='arp_row_label_wrapper'>";
				
				$new_row_label .= "<div id='label".$li_id."' class='col_opt_row arp_row_".$li_id."' style='display:none;'>";
				
					$new_row_label .= "<div class='col_opt_title_div'>".__('Label',ARP_PT_TXTDOMAIN)."</div>";
					
					$new_row_label .= "<div class='col_opt_input_div'>";
					
						$new_row_label .= "<textarea id='label' class='col_opt_textarea' name='row_".$column_id."_label_".$li_id."'></textarea>";
					
					$new_row_label .= "</div>";
				
				$new_row_label .= "</div>";
				
				$new_row_label .= "<div id='body_li_add_shortcode".$li_id."' class='col_opt_row arp_row_".$li_id."' style='display:none;'>";
		
				$new_row_label .= "<div class='col_opt_btn_div'>";
		
					$new_row_label .= "<button type='button' id='arp_add_row_shortcode' class='col_opt_btn arptooltipster arp_add_row_shortcode' data-row-id='row_".$li_id."' data-id='".$column_id."' col-id='".$column_id."' name='row_".$column_id."_add_description_shortcode_btn_".$li_id."' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."'>";
		
						
						
						$new_row_label .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
		
					$new_row_label .= "</button>";
		
				$new_row_label .= "</div>";
		
			$new_row_label .= "</div>";
				
				
				
					$new_row_label .= "<div class='col_opt_row arp_ok_div arp_".$n." arp_row_".$li_id."' id='body_li_level_other_arp_ok_div__button_3".$splitedid[1]."'  >";
									$new_row_label .= "<div class='col_opt_btn_div'>";
										$new_row_label .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
											$new_row_label .= __('Ok',ARP_PT_TXTDOMAIN);
										$new_row_label.= "</button>";
									$new_row_label .= "</div>";	
							$new_row_label .= "</div>";
				
			$new_row_label .= "</div>";
						
		}
		
		
		
		
		$json_array = array('new_row_string'=>$new_row_string,'new_row_wrapper'=>$new_row_wrapper,'new_row_tooltip'=>$new_row_tooltip,'new_row_label'=>$new_row_label);
		
		$json_array = json_encode( $json_array );
		
		echo $json_array;
		
		
				
		die();
	}
	
	function font_size($selected_size = ''){
		$str = '';
		for($s=8;$s<=20;$s++){ $size_arr[]=$s;}
		for($st=22;$st<=70;$st+=2){ $size_arr[]=$st;}
		foreach($size_arr as $size)  {
			//$str .= '<option '.checked($size,$selected_size).' value="'.$size.'">'.$size.'</div>';
			$str .= '<option '.selected($size,$selected_size,false).' value="'.$size.'">'.__(ucfirst($size),ARP_PT_TXTDOMAIN).'</option>';
		}
		return $str;
	}
	
	function font_style($selected_style = ''){
		$str = '';
		$style_arr = array('normal','italic','bold');
		foreach($style_arr as $style)  {
			$str .= '<option '.selected($style,$selected_style,false).' value="'.$style.'">'.__(ucfirst($style),ARP_PT_TXTDOMAIN).'</option>';
		}
		return $str;
	}
	
	function font_style_new(){
		$str = '';
		$style_arr = array('normal'=>__('Normal',ARP_PT_TXTDOMAIN),'italic'=>__('Italic',ARP_PT_TXTDOMAIN),'bold'=>__('Bold',ARP_PT_TXTDOMAIN));
		foreach($style_arr as $x=>$style)  {
			$str .= "<li data-value='".$x."' data-label='".$style."'>".$style."</li>";
		}
		return $str;
	}
		
	function font_color($property_name='',$data_column='',$data_column_id='',$id='',$value=''){
		$str = '';
		
		$str.='<div class="color_picker_font font_color_picker" data-column="'.$data_column.'" data-column-id="'.$data_column_id.'" id="'.$id.'" data-color="'.$value.'">
				<input type="text" id="'.$id.'" name="'.$property_name.'" value="'.$value.'" class="general_color_box general_color_box_font_color" />
				<div class="general_color_seperator"></div>
				<div class="general_color_box_img general_color_box_img_font_color"></div>
		</div>';

		
		return $str;
	}
	
	function append_new_package_new_1(){
	
		global $wpdb;
		
		$main_table_title = $_REQUEST['pricing_table_main'];
		
		$is_tbl_preview = ( isset($_POST['is_tbl_preview']) and $_POST['is_tbl_preview'] == 1 ) ? 1 : 0;
		
		$dt = current_time('mysql');
		
		$total = $_REQUEST['added_package'];
		
		if($main_table_title == "" && !$is_tbl_preview)
		{
			return;
		}
		
		@parse_str( $_POST['pt_coloumn_order'], $pt_coloumn_order );
		
		$template 		= $_POST['arp_template'];
		$template_name 	= $_POST['arp_template_name'];

		$template_skin 	= $_POST['arp_template_skin'];
		$template_type  = $_POST['arp_template_type'];
		$template_feature = json_decode ( stripslashes_deep( $_POST['template_feature'] ), true );
		
		$template_setting = array( 'template'=>$template, 'skin'=>$template_skin, 'template_type'=>$template_type, 'features'=>$template_feature ,'template_name'=>$template_name,);
		
		
		
		$custom_css = stripslashes_deep( $_POST['arp_custom_css'] );
		
		$column_order = stripslashes_deep( $_POST['pricing_table_column_order'] );
		
		$column_ord = str_replace('\'','"',$column_order);
		$col_ord_arr =  json_decode( $column_ord,true );
		if( $_POST['has_caption_column'] == 1 && !in_array('main_column_0',$col_ord_arr ))
			array_unshift( $col_ord_arr, 'main_column_0' );
		$new_id = array();
		if( is_array( $col_ord_arr ) and count($col_ord_arr) > 0 ){
			foreach( $col_ord_arr as $key=>$value )
				$new_id[$key] = str_replace('main_column_','',$value);
		}
		
		$total = max( $new_id );
		
		$reference_template = @$_POST['arp_reference_template'];
				
		$user_edited_columns = json_decode( stripslashes_deep($_POST['arp_user_edited_columns']),true );
		
		$general_settings = array('arp_custom_css'=>$custom_css,'column_order'=>$column_order,'reference_template'=>$reference_template,'user_edited_columns'=>$user_edited_columns);
				
		$button_shadow_clr = @$_POST['button_shadow_color'];
		$button_radius = @$_POST['button_radius'];
				
		$is_column_space = @$_POST['space_between_column'];
		$all_column_width = @$_POST['all_column_width'];
		$column_space = @$_POST['column_space'];
		$hover_highlight = @$_POST['column_high_on_hover'];
		$is_responsive = @$_POST['is_responsive'];
		$column_min_width = @$_POST['column_min_width'];
		$column_max_width = @$_POST['column_max_width'];
		$hide_caption_column = @$_POST['hide_caption_column'];
		
		$column_setting = array('space_between_column'=>$is_column_space,'column_space'=>$column_space,'column_highlight_on_hover'=>$hover_highlight,'is_responsive'=>$is_responsive,'column_min_width'=>$column_min_width,'column_max_width'=>$column_max_width,'hide_caption_column'=>$hide_caption_column,'all_column_width'=>$all_column_width);
		
		$is_animation = @$_POST['is_animation'];
		$visible_columns = @$_POST['visible_columns'];
		$scroll_column = @$_POST['column_to_scroll'];
		$is_navigation = @$_POST['is_navigation'];
		$is_autoplay = @$_POST['is_autoplay'];
		$sliding_effect = @$_POST['sliding_effect'];
		$transition_speed = @$_POST['slide_transition_speed'];
		$hide_caption_animation = @$_POST['hide_caption_animation'];
		$navigation_style = @$_POST['navigation_style'];
		$easing_effect = @$_POST['easing_effect'];
		$is_pagination = @$_POST['is_pagination'];
		$pagination_style = @$_POST['pagination_style'];
		$pagination_position = @$_POST['pagination_position'];
		$infinite 	= @$_POST['is_infinite'];
		$pagi_nav_btn = @$_POST['pagination_navigation_buttons'];
		
		$column_animation = array( 'is_animation'=>$is_animation, 'visible_column'=>$visible_columns, 'scrolling_columns'=>$scroll_column, 'navigation'=>$is_navigation, 'autoplay'=>$is_autoplay,'sliding_effect'=>$sliding_effect, 'transition_speed'=>$transition_speed, 'hide_caption'=>$hide_caption_animation,'navigation_style'=>$navigation_style,'easing_effect'=>$easing_effect, 'is_pagination'=>$is_pagination, 'pagination_style'=>$pagination_style, 'pagination_position'=>$pagination_position, 'is_infinite'=>$infinite,'pagi_nav_btn'=>$pagi_nav_btn );
		
		$tooltip_bgcolor   = @stripslashes_deep($_POST['tooltip_bgcolor']);
		$tooltip_txt_color = @stripslashes_deep($_POST['tooltip_txtcolor']);
		$tooltip_animation = @$_POST['tooltip_animation_style'];
		$tooltip_position  = @$_POST['tooltip_position'];
		$tooltip_width 	   = @$_POST['tooltip_width'];
		$tooltip_style     = @$_POST['tooltip_style'];
		$tooltip_font_family = @stripslashes_deep($_POST['tooltip_font_family']);
		$tooltip_font_size = @$_POST['tooltip_font_size'];
		$tooltip_font_style = @$_POST['tooltip_font_style'];
		
		$tooltip_setting = array( 'background_color'=>$tooltip_bgcolor, 'text_color'=>$tooltip_txt_color,'animation'=>$tooltip_animation, 'position'=>$tooltip_position,'tooltip_width'=>$tooltip_width, 'style'=> $tooltip_style,'tooltip_font_family'=>$tooltip_font_family,'tooltip_font_size'=>$tooltip_font_size,'tooltip_font_style'=>$tooltip_font_style );
		
		$tab_general_opt = array( 'template_setting'=>@$template_setting , /*'font_settings'=>$font_setting,*/ 'column_settings'=>@$column_setting, 'column_animation'=>@$column_animation, 'tooltip_settings'=>@$tooltip_setting, 'general_settings'=>@$general_settings,'button_settings'=>@$button_settings );
		
		$general_opt = maybe_serialize($tab_general_opt);
		
		$row = array();
		$column_order = array();
		$row_order = array();
		
		if($total > 0)
		{	
			update_option('arp_tablegeneraloption',$general_opt);
			if(count($new_id) > 1)
			{
				$ki = 1;			
				for($i = 0; $i <= $total; $i++)
				{
					if( !in_array( $i , $new_id ) )
						continue;
					$Title = 'column_'.$i;
					$column_width = @$_POST['column_width_'.$i];
					$column_title = @stripslashes_deep($_POST['column_title_'.$i]);
					$column_desc = @stripslashes_deep($_POST['arp_column_description_'.$i]);
					$cstm_rbn_txt = @stripslashes_deep($_POST['arp_custom_ribbon_txt_'.$i]);
					$column_highlight = @$_POST['column_highlight_'.$i];
					/*$column_ribbonimg		= stripslashes_deep($_POST['arp_ribbonimg_'.$i]);
					$column_ribbontext		= stripslashes_deep($_POST['arp_ribbontext_'.$i]);
					$column_ribbonposition	= $_POST['arp_ribbonposition_'.$i];	*/
					
					$column_ribbon_style	= @stripslashes_deep($_POST['arp_ribbon_style_'.$i]);
					$column_ribbon_position = @stripslashes_deep($_POST['arp_ribbon_position_'.$i]);
					$column_ribbon_bgcolor	= @stripslashes_deep($_POST['arp_ribbon_bgcol_'.$i]);
					$column_ribbon_txtcolor = @stripslashes_deep($_POST['arp_ribbon_textcol_'.$i]);
					$column_ribbon_content  = @stripslashes_deep($_POST['arp_ribbon_content_'.$i]);
					
					$header_font_family =  @stripslashes_deep($_POST['header_font_family_'.$i]);
					$header_font_size =  @$_POST['header_font_size_'.$i];
					$header_font_style =  @$_POST['header_font_style_'.$i];
					$header_font_color  =  @stripslashes_deep($_POST['header_font_color_'.$i]);
					
					$header_style_bold = @$_POST['header_style_bold_'.$i];
					$header_style_italic = @$_POST['header_style_italic_'.$i];
					$header_style_decoration = @$_POST['header_style_decoration_'.$i];
					
					$price_font_family = @stripslashes_deep($_POST['price_font_family_'.$i]);
					$price_font_size = @$_POST['price_font_size_'.$i];
					$price_font_color = @stripslashes_deep($_POST['price_font_color_'.$i]);
					$price_font_style = @$_POST['price_font_style_'.$i];
					
					$price_label_style_bold = @$_POST['price_label_style_bold_'.$i];
					$price_label_style_italic = @$_POST['price_label_style_italic_'.$i];
					$price_label_style_decoration = @$_POST['price_label_style_decoration_'.$i];

					
					$price_text_font_family = @stripslashes_deep($_POST['price_text_font_family_'.$i]);
					$price_text_font_size = @$_POST['price_text_font_size_'.$i];
					$price_text_font_style = @$_POST['price_text_font_style_'.$i];
					$price_text_font_color = @stripslashes_deep($_POST['price_text_font_color_'.$i]);
					
					$price_text_style_bold = @$_POST['price_text_style_bold_'.$i];
					$price_text_style_italic = @$_POST['price_text_style_italic_'.$i];
					$price_text_style_decoration = @$_POST['price_text_style_decoration_'.$i];
					
					$column_description_font_family = @stripslashes_deep($_POST['column_description_font_family_'.$i]);
					$column_description_font_size = @$_POST['column_description_font_size_'.$i];
					$column_description_font_style = @$_POST['column_description_font_style_'.$i];
					$column_description_font_color = @stripslashes_deep($_POST['column_description_font_color_'.$i]);
					
					$column_description_style_bold = @$_POST['column_description_style_bold_'.$i];
					$column_description_style_italic = @$_POST['column_description_style_italic_'.$i];
					$column_description_style_decoration = @$_POST['column_description_style_decoration_'.$i];
										
					$content_font_family = @stripslashes_deep($_POST['content_font_family_'.$i]);
					$content_font_size = @$_POST['content_font_size_'.$i];
					$content_font_color = @stripslashes_deep($_POST['content_font_color_'.$i]);
					$content_font_style = @$_POST['content_font_style_'.$i];
					
					$body_li_style_bold = @$_POST['body_li_style_bold_'.$i];
					$body_li_style_italic = @$_POST['body_li_style_italic_'.$i];
					$body_li_style_decoration = @$_POST['body_li_style_decoration_'.$i];
					
					$content_label_font_family = @stripslashes_deep($_POST['content_label_font_family_'.$i]);
					$content_label_font_size = @$_POST['content_label_font_size_'.$i];
					$content_label_font_color = @stripslashes_deep($_POST['content_label_font_color_'.$i]);
					$content_label_font_style = @$_POST['content_label_font_style_'.$i];
					
					$body_label_style_bold = @$_POST['body_label_style_bold_'.$i];
					$body_label_style_italic = @$_POST['body_label_style_italic_'.$i];
					$body_label_style_decoration = @$_POST['body_label_style_decoration_'.$i];
					
					$button_font_family = @stripslashes_deep($_POST['button_font_family_'.$i]);
					$button_font_size = @$_POST['button_font_size_'.$i];
					$button_font_color = @stripslashes_deep($_POST['button_font_color_'.$i]);
					$button_font_style = @$_POST['button_font_style_'.$i];
					
					$button_style_bold = @$_POST['button_style_bold_'.$i];
					$button_style_italic = @$_POST['button_style_italic_'.$i];
					$button_style_decoration = @$_POST['button_style_decoration_'.$i];
					
					$second_button_font_family = @stripslashes_deep($_POST['second_button_font_family_'.$i]);
					$second_button_font_size = @$_POST['second_button_font_size_'.$i];
					$second_button_font_style = @$_POST['second_button_font_style_'.$i];
					$second_button_font_color = @stripslashes_deep($_POST['second_button_font_color_'.$i]);
					
					$caption = isset($_POST['caption_column_'.$i]) ? $_POST['caption_column_'.$i] : 0;
					$show_column 	= isset($_POST['show_column_'.$i]) ? 1 : 0;
					$header_shortcode = @stripslashes_deep($_POST['additional_shortcode_'.$i]);
					$html_content 	= @stripslashes_deep($_POST['html_content_'.$i]);
					$price_text		= @stripslashes_deep($_POST['price_text_'.$i]);
					$price_label	= @stripslashes_deep($_POST['price_label_'.$i]);
					$gmap_marker = @stripslashes_deep($_POST['gmap_marker'.$i]);
					$total_rows 	= @$_POST['total_rows_'.$i];
					
					$ji = 1;
					$row = array();
					if( $total_rows > 0 )
					{
						for($j = 0; $j < $total_rows; $j++)
						{
							$row_title = 'row_'.$j;
							$row_label 		= @stripslashes_deep($_POST['row_'.$i.'_label_'.$j]);
							$row_des_align 	= @stripslashes_deep($_POST['row_'.$i.'_description_text_alignment_'.$j]);
							$row_des 		= @stripslashes_deep($_POST['row_'.$i.'_description_'.$j]);
							$row_tooltip 	= @stripslashes_deep($_POST['row_'.$i.'_tooltip_'.$j]);
							
							$row[$row_title] = array('row_des_txt_align'=>$row_des_align, 'row_description'=>$row_des, 'row_tooltip'=>$row_tooltip, 'row_label'=>$row_label);
														
							unset($_POST['row_'.$i.'_description_text_alignment_'.$j]);
							unset($_POST['row_'.$i.'_description_'.$j]);
							unset($_POST['row_'.$i.'_tooltip_'.$j]);
							
							$ji++;
						}
					}
					$body_text_alignemnt = @$_POST['body_text_alignment_'.$i];
					$btn_size 	= @$_POST['button_size_'.$i];
					$btn_type 	= @$_POST['button_type_'.$i];
					$btn_text 	= @stripslashes_deep($_POST['btn_content_'.$i]);
					$btn_link 	= @stripslashes_deep($_POST['btn_link_'.$i]);
					$btn_img 	= @stripslashes_deep($_POST['btn_img_url_'.$i]);
					$btn_img_height = @$_POST['button_img_height_'.$i];
					$btn_img_width 	= @$_POST['button_img_width_'.$i];
					$btn_s_size = @$_POST['second_button_size_'.$i];
					$btn_s_type = @$_POST['second_button_type_'.$i];
					$btn_s_text = @stripslashes_deep($_POST['second_btn_content_'.$i]);
					$btn_s_link = @stripslashes_deep($_POST['second_btn_link_'.$i]);
					$btn_s_img  = @stripslashes_deep($_POST['second_btn_img_url_'.$i]);
					$btn_s_img_height = @$_POST['second_button_img_height_'.$i];
					$btn_s_img_width = @$_POST['second_button_img_width_'.$i];
					$s_is_new_window = @$_POST['second_new_window_'.$i];
					$is_new_window 	= @$_POST['new_window_'.$i];
					
					if( !isset($table_columns[ $Title ]['row_order']) || !is_array(@$table_columns[ $Title ]['row_order']) )
					{
						@parse_str($_POST[$Title.'_row_order'], $col_row_order);
						$row_order= @$col_row_order;
					}
					
					$ribbon_settings = array(
						'arp_ribbon' 			=> $column_ribbon_style,
						'arp_ribbon_bgcol' 		=> $column_ribbon_bgcolor,
						'arp_ribbon_txtcol' 	=> $column_ribbon_txtcolor,
						'arp_ribbon_position' 	=> $column_ribbon_position,
						'arp_ribbon_content'	=> $column_ribbon_content,
					);
					
					$column[$Title] = array( 
										'package_title'			=> $column_title, 
										'column_width'			=> $column_width,
										'is_caption'			=> $caption,
										'column_description' 	=> $column_desc,
										'custom_ribbon_txt'		=> $cstm_rbn_txt,
										'is_hidden'				=> $show_column, 
										'arp_header_shortcode'	=> $header_shortcode, 
										'html_content'			=> $html_content,
										'price_text'			=> $price_text,
										'price_label'			=> $price_label,
										'gmap_marker'			=> @$google_map_marker,
										'body_text_alignment'	=> $body_text_alignemnt,
										'rows'					=> $row, 
										'button_size'			=> $btn_size, 
										'button_type'			=> $btn_type, 
										'button_text'			=> $btn_text, 
										'button_url'			=> $btn_link, 
										'btn_img'				=> $btn_img, 
										'btn_img_height'		=> $btn_img_height, 
										'btn_img_width'			=> $btn_img_width,
										'button_s_size'			=> $btn_s_size,
										'button_s_type'			=> $btn_s_type,
										'button_s_text'			=> $btn_s_text,
										'button_s_link'			=> $btn_s_link,
										'button_s_img'			=> $btn_s_img,
										'button_s_img_height'	=> $btn_s_img_height,
										'button_s_img_width'	=> $btn_s_img_width,
										's_is_new_window'		=> $s_is_new_window,
										'is_new_window'			=> $is_new_window, 
										'ribbon_setting'		=> $ribbon_settings,
										'header_font_family'	=> $header_font_family,
										'header_font_size'		=> $header_font_size,
										'header_font_style'		=> $header_font_style,
										'header_font_color'		=> $header_font_color,
										
										'header_style_bold'     => $header_style_bold,
										'header_style_italic'   => $header_style_italic,
										'header_style_decoration' => $header_style_decoration,
										
										'price_font_family'		=> $price_font_family,
										'price_font_size'		=> $price_font_size,
										'price_font_style'		=> $price_font_style,
										'price_font_color'		=> $price_font_color,
										
										'price_label_style_bold' => $price_label_style_bold,
										'price_label_style_italic' => $price_label_style_italic,
										'price_label_style_decoration' => $price_label_style_decoration,
										
										
										'price_text_font_family'=> $price_text_font_family,
										'price_text_font_size'	=> $price_text_font_size,
										'price_text_font_style' => $price_text_font_style,
										'price_text_font_color' => $price_text_font_color,
										
										
										'price_text_style_bold' => $price_text_style_bold,
										'price_text_style_italic' => $price_text_style_italic,
										'price_text_style_decoration' => $price_text_style_decoration,
										
										
										
										'content_font_family'	=> $content_font_family,
										'content_font_size'		=> $content_font_size,
										'content_font_style' 	=> $content_font_style,
										'content_font_color'	=> $content_font_color,
										
										'body_li_style_bold'    => $body_li_style_bold,
										'body_li_style_italic'  => $body_li_style_italic,
										'body_li_style_decoration' => $body_li_style_decoration,
										
										'content_label_font_family'	=> $content_label_font_family,
										'content_label_font_size'	=> $content_label_font_size,
										'content_label_font_style'	=> $content_label_font_style,
										'content_label_font_color'	=> $content_label_font_color,
										
										'body_label_style_bold'     => $body_label_style_bold,
										'body_label_style_italic'   => $body_label_style_italic,
										'body_label_style_decoration' => $body_label_style_decoration,
										
										
										'button_font_family'	=> $button_font_family,
										'button_font_size'	=> $button_font_size,
										'button_font_color'	=> $button_font_color,
										'button_font_style'	=> $button_font_style,
										
										'button_style_bold' 	=> $button_style_bold,
										'button_style_italic' 	=> $button_style_italic,
										'button_style_decoration' => $button_style_decoration,
										
										'second_button_font_family'=> $second_button_font_family,
										'second_button_font_size'  => $second_button_font_size,
										'second_button_font_style' => $second_button_font_style,
										'second_button_font_color' => $second_button_font_color,
										'column_description_font_family'=> $column_description_font_family,
										'column_description_font_size'=> $column_description_font_size,
										'column_description_font_style'=>$column_description_font_style,
										'column_description_font_color'=>$column_description_font_color,
										
										
										'column_description_style_bold'=>$column_description_style_bold,
										'column_description_style_italic'=>$column_description_style_italic,
										'column_description_style_decoration'=>$column_description_style_decoration,
										
										
										);
				}
			}
			else
			{
				$Title = 'column_0';
				$column_width = @$_POST['column_width_0'];
				$column_title = @$_POST['column_title_0'];
				$column_highlight = @$_POST['column_highlight_0'];
				$column_desc = @stripslashes_deep($_POST['arp_column_description_0']);
				$cstm_rbn_txt = @stripslashes_deep($_POST['arp_custom_ribbon_txt_0']);
				
				$caption = isset($_POST['caption_column_0']) ? $_POST['caption_column_0'] : 0;
				$show_column 	= isset($_POST['show_column_0']) ? 1 : 0;
				$price 			= @$_POST['price_0'];
				$html_content 	= @stripslashes_deep($_POST['html_content_0']);
				$price_text		= @stripslashes_deep($_POST['price_text_0']);
				$price_label	= @stripslashes_deep($_POST['price_label_0']);
				$header_shortcode = @stripslashes_deep($_POST['additional_shortcode_0']);
				$gmap_marker 	= @$_POST['gmap_marker_0'];
				$total_rows 	= @$_POST['total_rows_0'];
				
				$column_ribbon_style	= @stripslashes_deep($_POST['arp_ribbon_style_0']);
				$column_ribbon_position = @stripslashes_deep($_POST['arp_ribbon_position_0']);
				$column_ribbon_bgcolor	= @stripslashes_deep($_POST['arp_ribbon_bgcol_0']);
				$column_ribbon_txtcolor = @stripslashes_deep($_POST['arp_ribbon_textcol_0']);
				$column_ribbon_content  = @stripslashes_deep($_POST['arp_ribbon_content_0']);
				
				$header_font_family = @stripslashes_deep($_POST['header_font_family_0']);
				$header_font_size =  @$_POST['header_font_size_0'];
				$header_font_style =  @$_POST['header_font_style_0'];
				$header_font_color  =  @stripslashes_deep($_POST['header_font_color_0']);
				
				$header_style_bold = @$_POST['header_style_bold_0'];
				$header_style_italic = @$_POST['header_style_italic_0'];
				$header_style_decoration = @$_POST['header_style_decoration_0'];
				
				$price_font_family = @stripslashes_deep($_POST['price_font_family_0']);
				$price_font_size = @$_POST['price_font_size_0'];
				$price_font_color = @stripslashes_deep($_POST['price_font_color_0']);
				$price_font_style = @$_POST['price_font_style_0'];
				
				$price_label_style_bold = @$_POST['price_label_style_bold_0'];
				$price_label_style_italic = @$_POST['price_label_style_italic_0'];
				$price_label_style_decoration = @$_POST['price_label_style_decoration_0'];
				
				$price_text_font_family = @stripslashes_deep($_POST['price_text_font_family_0']);
				$price_text_font_size = @$_POST['price_text_font_size_0'];
				$price_text_font_style = @$_POST['price_text_font_style_0'];
				$price_text_font_color = @stripslashes_deep($_POST['price_text_font_color_0']);
				
				$price_text_style_bold = @$_POST['price_text_style_bold_0'];
				$price_text_style_italic = @$_POST['price_text_style_italic_0'];
				$price_text_style_decoration = @$_POST['price_text_style_decoration_0'];
				
				$column_description_font_family = @stripslashes_deep($_POST['column_description_font_family_0']);
				$column_description_font_size = @$_POST['column_description_font_size_0'];
				$column_description_font_style = @$_POST['column_description_font_style_0'];
				$column_description_font_color = @stripslashes_deep($_POST['column_description_font_color_0']);
				
				$column_description_style_bold = @$_POST['column_description_style_bold_0'];
				$column_description_style_italic = @$_POST['column_description_style_italic_0'];
				$column_description_style_decoration = @$_POST['column_description_style_decoration_0'];
				
				$content_font_family = @stripslashes_deep($_POST['content_font_family_0']);
				$content_font_size = @$_POST['content_font_size_0'];
				$content_font_color =@ stripslashes_deep($_POST['content_font_color_0']);
				$content_font_style = @$_POST['content_font_style_0'];
				
				$body_li_style_bold = @$_POST['body_li_style_bold_0'];
				$body_li_style_italic =@ $_POST['body_li_style_italic_0'];
				$body_li_style_decoration =@ $_POST['body_li_style_decoration_0'];
				
				$content_label_font_family = @stripslashes_deep($_POST['content_label_font_family_0']);
				$content_label_font_size =@ $_POST['content_label_font_size_0'];
				$content_label_font_color = @stripslashes_deep($_POST['content_label_font_color_0']);
				$content_label_font_style = @$_POST['content_label_font_style_0'];
				
				$body_label_style_bold = @$_POST['body_label_style_bold_0'];
				$body_label_style_italic =@$_POST['body_label_style_italic_0'];
				$body_label_style_decoration = @$_POST['body_label_style_decoration_0'];
				
				$button_font_family = @stripslashes_deep($_POST['button_font_family_0']);
				$button_font_size = @$_POST['button_font_size_0'];
				$button_font_color = @stripslashes_deep($_POST['button_font_color_0']);
				$button_font_style = @$_POST['button_font_style_0'];
				
				$button_style_bold = @$_POST['button_style_bold_0'];
				$button_style_italic = @$_POST['button_style_italic_0'];
				$button_style_decoration = @$_POST['button_style_decoration_0'];
				
				$second_button_font_family = @stripslashes_deep( $_POST['second_button_font_family_0']);
				$second_button_font_size   = @$_POST['second_button_font_size_0'];
				$second_button_font_style  = @$_POST['second_button_font_style_0'];
				$second_button_font_color  = @stripslashes_deep($_POST['second_button_font_color_0']);
				
				$ji = 1;
				$row = array();
				if( $total_rows > 0 )
				{
					for($j = 0; $j < $total_rows; $j++)
					{
						$row_title 		= 'row_'.$j;
						$row_label      = @stripslashes_deep($_POST['row_0_label_'.$j]);
						$row_des_align 	= @stripslashes_deep($_POST['row_0_description_text_alignment_'.$j]);
						$row_des 		= @stripslashes_deep($_POST['row_0_description_'.$j]);
						$row_tooltip 	= @stripslashes_deep($_POST['row_0_tooltip_'.$j]);
						
						$row[$row_title]= array('row_des_txt_align'=>$row_des_align, 'row_description'=>$row_des, 'row_tooltip'=>$row_tooltip,'row_label'=>$row_label);
						
						unset($_POST['row_0_description_text_alignment_'.$j]);
						unset($_POST['row_0_description_'.$j]);
						unset($_POST['row_0_tooltip_'.$j]);
						$ji++;
					}
				}
				$body_text_alignemnt =@ $_POST['body_text_alignment_0'];	
				$btn_size 	= @$_POST['button_size_0'];
				$btn_type 	=@ $_POST['button_type_0'];
				$btn_text 	= @stripslashes_deep($_POST['btn_content_0']);
				$btn_link 	= @stripslashes_deep($_POST['btn_link_0']);
				$btn_img 	= @stripslashes_deep($_POST['btn_img_url_0']);
				$btn_img_height = @$_POST['button_img_height_0'];
				$btn_img_width 	= @$_POST['button_img_width_0'];
				$btn_s_size =@ $_POST['second_button_size_0'];
				$btn_s_type =@ $_POST['second_button_type_0'];
				$btn_s_text = @stripslashes_deep($_POST['second_btn_content_0']);
				$btn_s_link = @stripslashes_deep($_POST['second_btn_link_0']);
				$btn_s_img = @stripslashes_deep($_POST['second_btn_img_url_0']);
				$btn_s_img_height = @$_POST['second_button_img_height_0'];
				$btn_s_img_width = @$_POST['second_button_img_width_0'];
				$s_is_new_window = @$_POST['second_new_window_0'];
				$is_new_window 	= @$_POST['new_window_0'];
				
				if( !isset($table_columns[ $Title ]['row_order']) || !is_array(@$table_columns[ $Title ]['row_order']) )
				{
					@parse_str($_POST[$Title.'_row_order'], $col_row_order);
					$row_order= @$col_row_order;
				}
				
				$ribbon_settings = array(
					'arp_ribbon' 			=> $column_ribbon_style,
					'arp_ribbon_bgcol' 		=> $column_ribbon_bgcolor,
					'arp_ribbon_txtcol' 	=> $column_ribbon_txtcolor,
					'arp_ribbon_position' 	=> $column_ribbon_position,
					'arp_ribbon_content'	=> $column_ribbon_content,
				);
					
				$column[$Title] = array( 
									'package_title'			=> $column_title, 
									'column_width'			=> $column_width, 
									'is_caption'			=> $caption,
									'column_description' 	=> $column_desc,
									'custom_ribbon_txt' 	=> $cstm_rbn_txt,
									'column_highlight'		=> $column_highlight,
									'is_hidden'				=> $show_column, 
									'arp_header_shortcode'	=> $header_shortcode, 
									'html_content'			=> $html_content,
									'price_text'			=> $price_text,
									'price_label'			=> $price_label,
									'gmap_marker'			=> $gmap_marker,
									'body_text_alignment'	=> $body_text_alignemnt,
									'rows'					=> $row,
									'button_size'			=> $btn_size,
									'button_type'			=> $btn_type,
									'button_text'			=> $btn_text,
									'button_url'			=> $btn_link,
									'btn_img'				=> $btn_img,
									'btn_img_height'		=> $btn_img_height,
									'btn_img_width'			=> $btn_img_width,
									'button_s_size'			=> $btn_s_size,
									'button_s_type'			=> $btn_s_type,
									'button_s_text'			=> $btn_s_text,
									'button_s_link'			=> $btn_s_link,
									'button_s_img'			=> $btn_s_img,
									'button_s_img_height'	=> $btn_s_img_height,
									'button_s_img_width'	=> $btn_s_img_width,
									's_is_new_window'		=> $s_is_new_window,
									'is_new_window'			=> $is_new_window, 
									'ribbon_setting'		=> $ribbon_settings,
									'header_font_family'	=> $header_font_family,
									'header_font_size'		=> $header_font_size,
									'header_font_style'		=> $header_font_style,
									'header_font_color'		=> $header_font_color,
									
									'header_style_bold'     => $header_style_bold,
									'header_style_italic'   => $header_style_italic,
									'header_style_decoration' => $header_style_decoration,
									
									'content_font_family'	=> $content_font_family,
									'content_font_size'		=> $content_font_size,
									'content_font_style' 	=> $content_font_style,
									'content_font_color'	=> $content_font_color,
									
									'body_li_style_bold'    => $body_li_style_bold,
									'body_li_style_italic'  => $body_li_style_italic,
									'body_li_style_decoration' => $body_li_style_decoration,
									
									'content_label_font_family'	=> $content_label_font_family,
									'content_label_font_size'	=> $content_label_font_size,
									'content_label_font_style'	=> $content_label_font_style,
									'content_label_font_color'	=> $content_label_font_color,
									
									'body_label_style_bold'     => $body_label_style_bold,
									'body_label_style_italic'   => $body_label_style_italic,
									'body_label_style_decoration' => $body_label_style_decoration,

									
									'price_font_family'		=> $price_font_family,
									'price_font_size'		=> $price_font_size,
									'price_font_style'		=> $price_font_style,
									'price_font_color'		=> $price_font_color,
									
									'price_label_style_bold' => $price_label_style_bold,
									'price_label_style_italic' => $price_label_style_italic,
									'price_label_style_decoration' => $price_label_style_decoration,

									
									'price_text_font_family'=> $price_text_font_family,
									'price_text_font_size'	=> $price_text_font_size,
									'price_text_font_style' => $price_text_font_style,
									'price_text_font_color' => $price_text_font_color,
									
									'price_text_style_bold' => $price_text_style_bold,
									'price_text_style_italic' => $price_text_style_italic,
									'price_text_style_decoration' => $price_text_style_decoration,
									
									'button_font_family'	=> $button_font_family,
									'button_font_size'		=> $button_font_size,
									'button_font_color'		=> $button_font_color,
									'button_font_style'		=> $button_font_style,
									
									'button_style_bold' 	=> $button_style_bold,
									'button_style_italic' 	=> $button_style_italic,
									'button_style_decoration' => $button_style_decoration,
									
									'second_button_font_family' => $second_button_font_family,
									'second_button_font_size'   => $second_button_font_size,
									'second_button_font_style'  => $second_button_font_style,
									'second_button_font_color'  => $second_button_font_color,
									'column_description_font_family'=> $column_description_font_family,
									'column_description_font_size'=> $column_description_font_size,
									'column_description_font_style'=>$column_description_font_style,
									'column_description_font_color'=>$column_description_font_color,
									
									'column_description_style_bold'=>$column_description_style_bold,
									'column_description_style_italic'=>$column_description_style_italic,
									'column_description_style_decoration'=>$column_description_style_decoration,
									
									);
				
				$column_order[ $Title ] = 1;
			}
		}
		else
		{
			return;
		}
		
		$tbl_opt['columns'] = $column;
		$tbl_opt['column_order'] = $column_order;
		$table_options = maybe_serialize($tbl_opt);
		
		update_option('arp_tablecolumnoption',$table_options);
		
		$table_id = $_POST['template_type_new'];
		
		echo $this->append_new_column($table_id);
						
		die();
	
	}
	
	function append_new_column($table_id){
		
		$general_options = get_option('arp_tablegeneraloption');
		
		$table_options = get_option('arp_tablecolumnoption');
		$columns = maybe_unserialize( $table_options );
		$options = maybe_unserialize( $general_options );
		
		foreach( $columns['columns'] as $j=>$column ){
			if( $column['is_caption'] == 1) {
				$caption_column[] = 'yes';
			} else {
				$caption_column[] = 'no';
			}
		}
		
		$total_rows = count( $columns['columns']['column_0']['rows'] );
		
		$total_packages = count($columns['columns']);
		
		$features = $options['template_setting']['features'];
		
		$template_type = $options['template_setting']['template_type'];
		
		if( in_array( 'yes',$caption_column) ){

			//$packages = $total_packages;
			
			$has_caption = 1;
			
		} else {
		
			//$packages = $total_packages + 1;
			
			$has_caption = 0;
			
		}
		
		$template = $options['template_setting']['template'];
		$template_name = $options['template_setting']['template_name'];
		$template_type = $options['template_setting']['template_type'];
		$reference_template = $options['general_settings']['reference_template'];
		
		update_option('arp_tablegeneraloption','');
		update_option('arp_tablecolumnoption','');
		
		return $this->new_column( $total_packages, $columns, $features, $total_rows, $options, $has_caption, $template, $template_type, $table_id,$reference_template,$template_name );
		
		
	}
		
	function arp_save_template_image()
	{
		WP_Filesystem();
 		global $wp_filesystem;

		$arp_image_data=isset($_POST['arp_image_data'])?$_POST['arp_image_data']:'';
		
		$template_id=isset($_POST['template_id'])?$_POST['template_id']:'';
		
 		if($arp_image_data!='' && $template_id!='')
		{
			$arp_image_data = str_replace('data:image/png;base64,', '', $arp_image_data);
			$arp_image_data = str_replace(' ', '+', $arp_image_data);
			$data = base64_decode($arp_image_data);
			$file = PRICINGTABLE_UPLOAD_DIR . '/template_images/arptemplate_'.$template_id.'_full_legnth.png';
			//file_put_contents($file, $data);
 			$wp_filesystem->put_contents( $file, $data, 0777 );
 
			list($width,$height)=getimagesize($file);
			$newheight=180;//90
			$newwidth=400;//200
			
			$src_image = imagecreatefrompng($file);
			$tmp_image=imagecreatetruecolor($newwidth,$newheight);
			$bgColor = imagecolorallocate($tmp_image, 255,255,255);
			imagefill($tmp_image , 0,0 , $bgColor);
			imagecopyresampled($tmp_image,$src_image,0,0,0,0,$newwidth,$newheight,$width,$height);
 			$filename =PRICINGTABLE_UPLOAD_DIR . '/template_images/arptemplate_'.$template_id.'.png';
			imagepng($tmp_image,$filename);
			imagedestroy($tmp_image);
			
			$newheight_big=238;//119;
			$newwidth_big=530;//265;
			$tmp_image_big=imagecreatetruecolor($newwidth_big,$newheight_big);
			$bgColor_big = imagecolorallocate($tmp_image_big, 255,255,255);
			imagefill($tmp_image_big , 0,0 , $bgColor_big);
			imagecopyresampled($tmp_image_big,$src_image,0,0,0,0,$newwidth_big,$newheight_big,$width,$height);
 			$filename_big = PRICINGTABLE_UPLOAD_DIR . '/template_images/arptemplate_'.$template_id.'_big.png'; 
			imagepng($tmp_image_big,$filename_big);
			imagedestroy($tmp_image_big);
			
			$newheight_large=300;//150;
			$newwidth_large=668;//334;
			$tmp_image_large=imagecreatetruecolor($newwidth_large,$newheight_large);
			$bgColor_large = imagecolorallocate($tmp_image_large, 255,255,255);
			imagefill($tmp_image_large , 0,0 , $bgColor_large);
			imagecopyresampled($tmp_image_large,$src_image,0,0,0,0,$newwidth_large,$newheight_large,$width,$height);
 			$filename_large = PRICINGTABLE_UPLOAD_DIR . '/template_images/arptemplate_'.$template_id.'_large.png'; 
			imagepng($tmp_image_large,$filename_large);
			imagedestroy($tmp_image_large);
			
			@unlink($file);
   		}
		die();
	}
	
	
	
	function arp_get_video_image($add_shortcode)
	{	
		$add_shortcode_text = str_replace('[','',$add_shortcode);
		$add_shortcode_text = str_replace(']','',$add_shortcode_text);
	
		$as_shortcode =  shortcode_parse_atts($add_shortcode_text);
		
		if($as_shortcode[0] == 'arp_youtube_video'){
			
			$video_id 	= isset( $as_shortcode['id'] ) ? $as_shortcode['id'] : '';	
			$width 		= '100%';
			$height		= ( isset( $as_shortcode['height'] ) and $as_shortcode['height'] != '' ) ? $as_shortcode['height'] : 'auto';	
			$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';
			
			$imageURL = "http://img.youtube.com/vi/".$video_id."/maxresdefault.jpg;";
			
			return '<div class="arp_youtube_video"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'>
				<img src="'.$imageURL.'"  height="'.$height.'"  />
			</div>';
			
		}elseif($as_shortcode[0] == 'arp_vimeo_video'){
		
		
			$video_id 	= isset( $as_shortcode['id'] ) ? $as_shortcode['id'] : '';	
			$width 		= '100%';
			$height		= ( isset( $as_shortcode['height'] ) and $as_shortcode['height'] != '' ) ? $as_shortcode['height'] : 'auto';	
			$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';
			
			$data = file_get_contents("http://vimeo.com/api/v2/video/".$video_id.".json");
			$data = json_decode($data);
			$imageURL = $data[0]->thumbnail_large;
			
			return '<div class="arp_vimeo_video"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'>
				<img src="'.$imageURL.'"  height="'.$height.'"  />
			</div>';
			
		}elseif($as_shortcode[0] == 'arp_screenr_video'){
		
			$video_id 	= isset( $as_shortcode['id'] ) ? $as_shortcode['id'] : '';	
			$width 		= '100%';
			$height		= ( isset( $as_shortcode['height'] ) and $as_shortcode['height'] != '' ) ? $as_shortcode['height'] : 'auto';
			$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';
			
			$data = file_get_contents("http://www.screenr.com/api/oembed.json?url=http://www.screenr.com/".$video_id);
			$data = json_decode($data);
			$imageURL = $data->thumbnail_url;

			return '<div class="arp_screenr_video"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'>
				<img src="'.$imageURL.'"  height="'.$height.'"  />
			</div>';
			
		}elseif($as_shortcode[0] == 'arp_html5_video'){
			$imageURL = '';
			if(!empty($as_shortcode['poster'])){
				$imageURL = $as_shortcode['poster'];
				return '<div class="arp_html5_video">
					<img src="'.$imageURL.'"   />
				</div>';
			}else{
				$imageURL = PRICINGTABLE_IMAGES_URL.'/video-icon.png';
				return '<div class="arp_html5_video">
				<img class="arp_video_img" src="'.$imageURL.'"   />
			</div>';
			}
		}elseif($as_shortcode[0] == 'arp_html5_audio'){	
			$imageURL = PRICINGTABLE_IMAGES_URL.'/audio-icon.png';
			return '<div class="arp_html5_audio">
				<img class="arp_audio_img" src="'.$imageURL.'"   />
			</div>';
		}elseif($as_shortcode[0] == 'arp_googlemap'){	
			
			$address = ($as_shortcode['address']) ? $as_shortcode['address'] : '';
			$zoom_level = ($as_shortcode['zoom_level']) ? $as_shortcode['zoom_level'] : '14';
			$height =  ($as_shortcode['height']) ? $as_shortcode['height'] : '300';
			
			$address= $address ? $address : '';
			$popup 	= $as_shortcode['show_popup'] ? true : false;
			$icon	= $as_shortcode['marker_image'] ? $as_shortcode['marker_image'] : '';
			$content= $as_shortcode['content'] ? $as_shortcode['content'] : '';
			$maptype= $as_shortcode['maptype'] ? $as_shortcode['maptype'] : 'ROADMAP';
			
			$mapdata = array();
			$mapdata['markers'][] = array (
				'address' 	=> $address,
				'title' 	=> $as_shortcode['title'],
				'icon' 		=> !empty( $icon ) ? array( 'image' => $icon ) : null,
				'html' 		=> isset( $content ) ? array( 
					'content' 	=> $content,
					'popup' 	=> $popup
				 ) : null,
			 );
			$mapdata['zoom'] = intval($zoom_level);
			$mapdata['maptype'] = $maptype;
			$mapdata['mapTypeControl'] = false;
			$address = str_replace(" ", "+", $address);
			$data = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address);
			$data = json_decode($data);
			$map_data = $data->results[0];
			$lat = $map_data->geometry->location->lat;
			$lng  = $map_data->geometry->location->lng;
			
			$imageURL = "https://maps.googleapis.com/maps/api/staticmap?center=".$lat.",".$lng."&zoom=".$zoom_level."&size=280x".$height;
			return '<div class="arp_googlemap"  data-map="' . esc_attr( json_encode( $mapdata ) ) . '"  style="width:100%; height:' . $height . 'px;"><img src="'.$imageURL.'"  height="'.$height.'"  /></div>';
			
			
		}elseif($as_shortcode[0] == 'arp_dailymotion_video'){
			
			$video_id 	= isset( $as_shortcode['id'] ) ? $as_shortcode['id'] : '';	
			$width 		= '100%';
			$height		= ( isset( $as_shortcode['height'] ) and $as_shortcode['height'] != '' ) ? $as_shortcode['height'] : 'auto';	
			$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';

			$data = file_get_contents('https://api.dailymotion.com/video/'.$video_id .'?fields=thumbnail_large_url');
			$data = json_decode($data);
			$imageURL = $data->thumbnail_large_url;
			
			return '<div class="arp_dailymotion_video"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'>
				<img src="'.$imageURL.'"  height="'.$height.'"  />
			</div>';
			
		}elseif($as_shortcode[0] == 'arp_metacafe_video'){
			
			$video_id 	= isset( $as_shortcode['id'] ) ? $as_shortcode['id'] : '';	
			$width 		= '100%';
			$height		= ( isset( $as_shortcode['height'] ) and $as_shortcode['height'] != '' ) ? $as_shortcode['height'] : 'auto';	
			$style 		= ( $height != 'auto' ) ? 'height:'.$height.'px !important; padding:0 !important;' : '';
			
			
			$imageURL = 'http://s' . mt_rand(1,4) . '.mcstatic.com/thumb/' . $video_id . '.jpg';
			
			return '<div class="arp_metacafe_video"' . ( $style != '' ? ' style="' . $style . '"' : '' ) .'>
				<img src="'.$imageURL.'"  height="'.$height.'"  />
			</div>';
			
		}elseif($as_shortcode[0] == 'arp_soundcloud_audio'){	
			$imageURL = PRICINGTABLE_IMAGES_URL.'/audio-icon.png';
			return '<div class="arp_soundcloud_audio">
				<img class="arp_audio_img" src="'.$imageURL.'"   />
			</div>';
		}elseif($as_shortcode[0] == 'arp_mixcloud_audio'){	
			$imageURL = PRICINGTABLE_IMAGES_URL.'/audio-icon.png';
			return '<div class="arp_mixcloud_audio">
				<img class="arp_audio_img" src="'.$imageURL.'"   />
			</div>';
		}elseif($as_shortcode[0] == 'arp_beatport_audio'){	
			$imageURL = PRICINGTABLE_IMAGES_URL.'/audio-icon.png';
			return '<div class="arp_beatport_audio">
				<img class="arp_audio_img" src="'.$imageURL.'"   />
			</div>';
		}elseif($as_shortcode[0] == 'arp_embed'){	
			$imageURL = PRICINGTABLE_IMAGES_URL.'/embed-icon.png';
			return '<div class="arp_embed_audio">
				<img class="arp_embed_img" src="'.$imageURL.'"   />
			</div>';
		}else{
			return do_shortcode($add_shortcode);
		}
		
	

	}
	
	
	function  update_arp_tour_guide_value(){
		$return = '0';
		update_option('arprice_tour_guide_value', 'no');
		if($_REQUEST['arp_tour_guide_value'] == 'arp_tour_guide_start_yes'){
			$return = '1';
		}
		
		echo $return;
		
		die();
	}
	
}
?>