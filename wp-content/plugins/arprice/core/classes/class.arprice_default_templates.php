<?php
	global $wpdb, $arp_mainoptionsarr, $arp_coloptionsarr, $arprice_form;
	
		
	$values['name'] = 'ARPrice Template 1';
	$values['is_template'] = 1;
	$values['template_name'] = 1;
	$values['status'] = 'published';
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	
	$arp_price_font_settings = array();
	
	$arp_price_text_font_settings = array();
	
	$arp_content_font_settings = array();
	
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_1';
	$arp_pt_template_settings['skin']			= 'multicolor';
	$arp_pt_template_settings['template_type']  = 'normal';
	$arp_pt_template_settings['features']       = array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false);
		
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3","main_column_4"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_1';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'no';
	$arp_pt_column_settings['column_space'] 		= '0';
	$arp_pt_column_settings['column_highlight_on_hover'] = 0;
	$arp_pt_column_settings['is_responsive'] 		= 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 140;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['hide_caption_colunmn'] = 0;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = 'arp_nav_style_1';
	$arp_pt_column_animation['pagination'] = 1;
	$arp_pt_column_animation['pagination_style'] = 'arp_paging_style_1';
	$arp_pt_column_animation['pagination_position'] = 'Top';
	$arp_pt_column_animation['easing_effect'] ='swing';
	$arp_pt_column_animation['infinite'] = 1;
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['background_color'];
	$arp_pt_tooltip_settings['text_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['text_color'];
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans Bold';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 16;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings, 'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
		
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
	
	$column['column_0']['package_title'] = '';
	$column['column_0']['column_description'] = '';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['column_align'] = 'left';
	
	
	$column['column_0']['header_font_family'] = 'Open Sans';
	$column['column_0']['header_font_size'] = 26;
	$column['column_0']['header_font_color'] = '#333333';
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	
	
	 
	$column['column_0']['price_font_family'] = 'Open Sans';
	$column['column_0']['price_font_size'] = 18;
	
	$column['column_0']['price_font_color'] = '#ffffff';
	$column['column_0']['price_label_style_bold'] = 'bold';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_0']['price_text_font_family'] = 'Open Sans';
	$column['column_0']['price_text_font_size'] = 18;
	
	$column['column_0']['price_text_font_color'] = '#ffffff';
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = '';
	$column['column_0']['column_description_font_size'] = '';
	
	$column['column_0']['column_description_font_color'] = '';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = 'Arial';
	$column['column_0']['content_font_size'] = 16;
	
	$column['column_0']['content_font_color'] = '#364762';
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_0']['button_font_family'] = 'Open Sans Bold';
	$column['column_0']['button_font_size'] = 17;
	
	$column['column_0']['button_font_color'] = '#ffffff';
	$column['column_0']['button_style_bold'] = '';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings*/
		
	$column['column_0']['is_caption'] = 1;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	$column['column_0']['html_content'] = "Hosting Plans";
	$column['column_0']['body_text_alignment'] = 'left';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_0']['row_description'] = 'Data Storage';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_1']['row_description'] = 'MySQL Databases';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_2']['row_description'] = 'Daily Backup';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_3']['row_description'] = 'Free Domains';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_4']['row_description'] = 'Online Support';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['button_size'] = '';
    $column['column_0']['button_type'] = '';
	$column['column_0']['button_text'] = '';
	$column['column_0']['button_url'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Bronze';
	$column['column_1']['column_description'] = '';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = 'Open Sans';
	$column['column_1']['header_font_size'] = 28;
	
	$column['column_1']['header_font_color'] = '#ffffff';
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = 'Open Sans';
	$column['column_1']['price_font_size'] = 18;
	//$column['column_1']['price_font_style'] = 'bold';
	$column['column_1']['price_font_color'] = '#ffffff';
	$column['column_1']['price_label_style_bold'] = 'bold';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_1']['price_text_font_family'] = 'Open Sans';
	$column['column_1']['price_text_font_size'] = 18;
	
	$column['column_1']['price_text_font_color'] = '#ffffff';
	$column['column_1']['price_text_style_bold'] = 'bold';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = '';
	$column['column_1']['column_description_font_size'] = '';
	
	$column['column_1']['column_description_font_color'] = '';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = 'Arial';
	$column['column_1']['content_font_size'] = 16;
	//$column['column_1']['content_font_style'] = 'normal';
	$column['column_1']['content_font_color'] = '#364762';
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_1']['button_font_family'] = 'Open Sans Bold';
	$column['column_1']['button_font_size'] = 17;
	//$column['column_1']['button_font_style'] = 'normal';
	$column['column_1']['button_font_color'] = '#ffffff';
	$column['column_1']['button_style_bold'] = '';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings*/
		
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	//$column['column_1']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_1']['price_text'] = "<span class='arp_price_value'><span class='arp_currency'>$</span>20</span><span class='arp_price_duration'> / month</span>";
	$column['column_1']['price_label'] = '';
	$column['column_1']['arp_header_shortcode'] = '';
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '20GB';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '15 Databases';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = 'No';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = '2 Domains';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = 'No';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'button';
	$column['column_1']['button_text'] = 'Purchase';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Silver';
	$column['column_2']['column_description'] = '';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = 'Open Sans';
	$column['column_2']['header_font_size'] = 28;
	//$column['column_1']['header_font_style'] = 'normal';
	$column['column_2']['header_font_color'] = '#ffffff';
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = 'Open Sans';
	$column['column_2']['price_font_size'] = 18;
	//$column['column_1']['price_font_style'] = 'bold';
	$column['column_2']['price_font_color'] = '#ffffff';
	$column['column_2']['price_label_style_bold'] = 'bold';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_2']['price_text_font_family'] = 'Open Sans';
	$column['column_2']['price_text_font_size'] = 18;
	//$column['column_1']['price_text_font_style'] = 'bold';
	$column['column_2']['price_text_font_color'] = '#ffffff';
	$column['column_2']['price_text_style_bold'] = 'bold';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = '';
	$column['column_2']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_2']['column_description_font_color'] = '';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = 'Arial';
	$column['column_2']['content_font_size'] = 16;
	//$column['column_1']['content_font_style'] = 'normal';
	$column['column_2']['content_font_color'] = '#364762';
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_2']['button_font_family'] = 'Open Sans Bold';
	$column['column_2']['button_font_size'] = 17;
	//$column['column_1']['button_font_style'] = 'normal';
	$column['column_2']['button_font_color'] = '#ffffff';
	$column['column_2']['button_style_bold'] = '';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = '';
	//$column['column_2']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_2']['price_text'] = "<span class='arp_price_value'><span class='arp_currency'>$</span>50</span><span class='arp_price_duration'> / month</span>";
	$column['column_2']['price_label'] = "";
	$column['column_2']['arp_header_shortcode'] = '';
	$column['column_2']['body_text_alignment'] = 'center';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '80GB';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '100 Databases';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = 'No';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = '5 Domains';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = 'No';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'button';
	$column['column_2']['button_text'] = 'Purchase';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
	$column['column_2']['s_is_new_window'] = '';
    $column['column_2']['is_new_window'] = 0;
	
	$column['column_3']['package_title'] = 'Gold';
	$column['column_3']['column_description'] = '';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = 'Open Sans';
	$column['column_3']['header_font_size'] = 28;
	//$column['column_1']['header_font_style'] = 'normal';
	$column['column_3']['header_font_color'] = '#ffffff';
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = 'Open Sans';
	$column['column_3']['price_font_size'] = 18;
	//$column['column_1']['price_font_style'] = 'bold';
	$column['column_3']['price_font_color'] = '#ffffff';
	$column['column_3']['price_label_style_bold'] = 'bold';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_3']['price_text_font_family'] = 'Open Sans';
	$column['column_3']['price_text_font_size'] = 18;
	//$column['column_1']['price_text_font_style'] = 'bold';
	$column['column_3']['price_text_font_color'] = '#ffffff';
	$column['column_3']['price_text_style_bold'] = 'bold';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = '';
	$column['column_3']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_3']['column_description_font_color'] = '';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = 'Arial';
	$column['column_3']['content_font_size'] = 16;
	//$column['column_1']['content_font_style'] = 'normal';
	$column['column_3']['content_font_color'] = '#364762';
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_3']['button_font_family'] = 'Open Sans Bold';
	$column['column_3']['button_font_size'] = 17;
	//$column['column_1']['button_font_style'] = 'normal';
	$column['column_3']['button_font_color'] = '#ffffff';
	$column['column_3']['button_style_bold'] = '';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings*/
		
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	//$column['column_3']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_3']['price_text'] = "<span class='arp_price_value'><span class='arp_currency'>$</span>60</span><span class='arp_price_duration'> / month</span>";
	$column['column_3']['price_label'] = '';
	$column['column_3']['arp_header_shortcode'] = '';
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = '150GB';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = '150 Databases';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = 'Yes';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = '10 Domains';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'button';
	$column['column_3']['button_text'] = 'Purchase';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
    $column['column_3']['is_new_window'] = 0;
	$column['column_3']['s_is_new_window'] = '';
	
	$column['column_4']['package_title'] = 'Platinum';
	$column['column_4']['column_description'] = '';
	$column['column_4']['custom_ribbon_txt'] = '';
	$column['column_4']['column_width'] = '';
	$column['column_4']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_4']['header_font_family'] = 'Open Sans';
	$column['column_4']['header_font_size'] = 28;
	//$column['column_1']['header_font_style'] = 'normal';
	$column['column_4']['header_font_color'] = '#ffffff';
	$column['column_4']['header_style_bold'] = '';
	$column['column_4']['header_style_italic'] = '';
	$column['column_4']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_4']['price_font_family'] = 'Open Sans';
	$column['column_4']['price_font_size'] = 18;
	//$column['column_1']['price_font_style'] = 'bold';
	$column['column_4']['price_font_color'] = '#ffffff';
	$column['column_4']['price_label_style_bold'] = 'bold';
	$column['column_4']['price_label_style_italic'] = '';
	$column['column_4']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_4']['price_text_font_family'] = 'Open Sans';
	$column['column_4']['price_text_font_size'] = 18;
	//$column['column_1']['price_text_font_style'] = 'bold';
	$column['column_4']['price_text_font_color'] = '#ffffff';
	$column['column_4']['price_text_style_bold'] = 'bold';
	$column['column_4']['price_text_style_italic'] = '';
	$column['column_4']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_4']['column_description_font_family'] = '';
	$column['column_4']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_4']['column_description_font_color'] = '';
	$column['column_4']['column_description_style_bold'] = '';
	$column['column_4']['column_description_style_italic'] = '';
	$column['column_4']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_4']['content_font_family'] = 'Arial';
	$column['column_4']['content_font_size'] = 16;
	//$column['column_1']['content_font_style'] = 'normal';
	$column['column_4']['content_font_color'] = '#364762';
	$column['column_4']['body_li_style_bold'] = '';
	$column['column_4']['body_li_style_italic'] = '';
	$column['column_4']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_4']['button_font_family'] = 'Open Sans Bold';
	$column['column_4']['button_font_size'] = 17;
	//$column['column_1']['button_font_style'] = 'normal';
	$column['column_4']['button_font_color'] = '#ffffff';
	$column['column_4']['button_style_bold'] = '';
	$column['column_4']['button_style_italic'] = '';
	$column['column_4']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	$column['column_4']['is_caption'] = 0;
	$column['column_4']['is_hidden'] = '';
	$column['column_4']['column_highlight'] = '';
	//$column['column_4']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_4']['price_text'] = "<span class='arp_price_value'><span class='arp_currency'>$</span>99</span><span class='arp_price_duration'> / month</span>";
	$column['column_4']['price_label'] = "";
	$column['column_4']['arp_header_shortcode'] = '';
	$column['column_4']['body_text_alignment'] = 'center';
	$column['column_4']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_0']['row_description'] = 'Unlimited';
	$column['column_4']['rows']['row_0']['row_tooltip'] = '';
	$column['column_4']['rows']['row_0']['row_label'] = '';
	$column['column_4']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_1']['row_description'] = 'Unlimited Databases';
	$column['column_4']['rows']['row_1']['row_tooltip'] = '';
	$column['column_4']['rows']['row_1']['row_label'] = '';
	$column['column_4']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_2']['row_description'] = 'Yes';
	$column['column_4']['rows']['row_2']['row_tooltip'] = '';
	$column['column_4']['rows']['row_2']['row_label'] = '';
	$column['column_4']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_3']['row_description'] = '20 Domains';
	$column['column_4']['rows']['row_3']['row_tooltip'] = '';
	$column['column_4']['rows']['row_3']['row_label'] = '';
	$column['column_4']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_4']['rows']['row_4']['row_tooltip'] = '';
	$column['column_4']['rows']['row_4']['row_label'] = '';
	$column['column_4']['button_size'] = 'Medium';
    $column['column_4']['button_type'] = 'button';
	$column['column_4']['button_text'] = 'Purchase';
	$column['column_4']['button_url'] = '#';
	$column['column_4']['button_s_size'] = '';
	$column['column_4']['button_s_type'] = '';
	$column['column_4']['button_s_text'] = '';
	$column['column_4']['button_s_url'] = '';
	$column['column_4']['s_is_new_window'] = '';
    $column['column_4']['is_new_window'] = 0;
			
	$pt_columns = array('columns'=>$column);
	
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	/* ARPrice Template 2 */
	
	$values['name'] = 'ARPrice Template 2';
	$values['is_template'] = 1;
	$values['status'] = 'published';
	$values['template_name'] = 2;
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	$arp_price_font_settings = array();
	$arp_content_font_settings = array();
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_2';
	$arp_pt_template_settings['skin']			= 'multicolor';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style'=>'default','caption_title'=>'default','header_shortcode_type'=>'rounded_border','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'style_2','second_btn'=>false,'is_animated'=>0);
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_2';
	$arp_pt_general_settings['user_edited_columns'] = '';
		
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'yes';
	$arp_pt_column_settings['column_space'] = '10';
	$arp_pt_column_settings['column_highlight_on_hover'] = 0;
	$arp_pt_column_settings['is_responsive'] = 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 160;
	$arp_pt_column_settings['column_max_width'] = 250;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'][1];
	$arp_pt_column_animation['pagination'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination'];
	$arp_pt_column_animation['pagination_style'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'][1];
	$arp_pt_column_animation['pagination_position'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_position'][0];
	$arp_pt_column_animation['easing_effect'] = $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'][0];
	$arp_pt_column_animation['infinite'] = 0;
	
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = '#2579eb';
	$arp_pt_tooltip_settings['text_color'] = '#FFFFFF';
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans Bold';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 18;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings,'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
	
	
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
		
	$column['column_0']['package_title'] = 'Basic';
	$column['column_0']['column_description'] = '';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = 'Lato';
	$column['column_0']['header_font_size'] = 26;
	$column['column_0']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_0']['price_font_family'] = "Open Sans Bold";
	$column['column_0']['price_font_size'] = 43;
	$column['column_0']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Lato';
	$column['column_0']['price_text_font_size'] = 16;
	$column['column_0']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Arial';
	$column['column_0']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#7c7c7c';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Lato";
	$column['column_0']['content_font_size'] = 16;
	$column['column_0']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_0']['content_label_font_family'] = 'Arial';
	$column['column_0']['content_label_font_size'] = 15;
	//$column['column_0']['content_label_font_style'] = 'bold';
	$column['column_0']['content_label_font_color'] = '#2a2e31';
	$column['column_0']['body_label_style_bold'] = 'bold';
	$column['column_0']['body_label_style_italic'] = '';
	$column['column_0']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Open Sans Bold";
	$column['column_0']['button_font_size'] = 20;
	$column['column_0']['button_font_color'] = "#2a2e31";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_0']['button_style_bold'] = 'bold';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>19.00";
	$column['column_0']['price_label'] = "Monthly";
	$column['column_0']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_2_1.png">';
	$column['column_0']['body_text_alignment'] = 'center';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_0']['row_description'] = '10 GB Disk Space';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_1']['row_description'] = '5 Databases';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_2']['row_description'] = '5 Domains';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_3']['row_description'] = 'No online Support';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'Button';
	$column['column_0']['button_text'] = 'Buy Now';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Personal';
	$column['column_1']['column_description'] = '';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = 'Lato';
	$column['column_1']['header_font_size'] = 26;
	$column['column_1']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = "Open Sans Bold";
	$column['column_1']['price_font_size'] = 43;
	$column['column_1']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	
	$column['column_1']['price_text_font_family'] = 'Lato';
	$column['column_1']['price_text_font_size'] = 16;
	$column['column_1']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Arial';
	$column['column_1']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#7c7c7c';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Lato";
	$column['column_1']['content_font_size'] = 16;
	$column['column_1']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_1']['content_label_font_family'] = 'Arial';
	$column['column_1']['content_label_font_size'] = 15;
	//$column['column_0']['content_label_font_style'] = 'bold';
	$column['column_1']['content_label_font_color'] = '#2a2e31';
	$column['column_1']['body_label_style_bold'] = 'bold';
	$column['column_1']['body_label_style_italic'] = '';
	$column['column_1']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Open Sans Bold";
	$column['column_1']['button_font_size'] = 20;
	$column['column_1']['button_font_color'] = "#2a2e31";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_1']['button_style_bold'] = 'bold';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>29.00";
	$column['column_1']['price_label'] = "Monthly";
	$column['column_1']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_2_2.png">';
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '50 GB Disk Space';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '25 Databases';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = '25 Domains';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = 'No online Support';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'Button';
	$column['column_1']['button_text'] = 'Buy Now';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Standard';
	$column['column_2']['column_description'] = '';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = 1;
	
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = 'Lato';
	$column['column_2']['header_font_size'] = 26;
	$column['column_2']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = "Open Sans Bold";
	$column['column_2']['price_font_size'] = 43;
	$column['column_2']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Lato';
	$column['column_2']['price_text_font_size'] = 16;
	$column['column_2']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Arial';
	$column['column_2']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#7c7c7c';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Lato";
	$column['column_2']['content_font_size'] = 16;
	$column['column_2']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_2']['content_label_font_family'] = 'Arial';
	$column['column_2']['content_label_font_size'] = 15;
	//$column['column_0']['content_label_font_style'] = 'bold';
	$column['column_2']['content_label_font_color'] = '#2a2e31';
	$column['column_2']['body_label_style_bold'] = 'bold';
	$column['column_2']['body_label_style_italic'] = '';
	$column['column_2']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Open Sans Bold";
	$column['column_2']['button_font_size'] = 20;
	$column['column_2']['button_font_color'] = "#2a2e31";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_2']['button_style_bold'] = 'bold';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>39.00";
	$column['column_2']['price_label'] = "Monthly";
	$column['column_2']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_2_3.png">';
	$column['column_2']['body_text_alignment'] = 'center';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '80 GB Disk Space';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '30 Databases';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = '30 Domains';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = 'Online Support';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Buy Now';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
	$column['column_2']['s_is_new_window'] = '';
    $column['column_2']['is_new_window'] = 0;	
	
	$column['column_3']['package_title'] = 'Ultimate Pro';
	$column['column_3']['column_description'] = '';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['column_align'] = 'left';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = 'Lato';
	$column['column_3']['header_font_size'] = 26;
	$column['column_3']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = "Open Sans Bold";
	$column['column_3']['price_font_size'] = 43;
	$column['column_3']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_3']['price_label_style_bold'] = '';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Lato';
	$column['column_3']['price_text_font_size'] = 16;
	$column['column_3']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Arial';
	$column['column_3']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#7c7c7c';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Lato";
	$column['column_3']['content_font_size'] = 16;
	$column['column_3']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_3']['content_label_font_family'] = 'Arial';
	$column['column_3']['content_label_font_size'] = 15;
	//$column['column_0']['content_label_font_style'] = 'bold';
	$column['column_3']['content_label_font_color'] = '#2a2e31';
	$column['column_3']['body_label_style_bold'] = 'bold';
	$column['column_3']['body_label_style_italic'] = '';
	$column['column_3']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Open Sans Bold";
	$column['column_3']['button_font_size'] = 20;
	$column['column_3']['button_font_color'] = "#2a2e31";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_3']['button_style_bold'] = 'bold';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */

	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>99.00";
	$column['column_3']['price_label'] = "Monthly";
	$column['column_3']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_2_4.png">';
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = 'Unlimited Disk Space';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = 'Unlimited Database';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = '30 Domains';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = 'Online Support';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Buy Now';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;
		
	$pt_columns = array('columns'=>$column);
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	
	/* ARPrice Template 3 */
	
	$values['name'] = 'ARPrice Template 3';
	$values['is_template'] = 1;
	$values['template_name'] = 3;
	$values['status'] = 'published';
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	$arp_price_font_settings = array();
	$arp_content_font_settings = array();
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_3';
	$arp_pt_template_settings['skin']			= 'black';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'position_4','caption_style'=>'style_1','amount_style'=>'style_3','list_alignment'=>'right','ribbon_type'=>'default','column_description_style'=>'style_3','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'position_1','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>0);
	
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_3';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'yes';
	$arp_pt_column_settings['column_space'] = '10';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] = 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 130;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 

	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'][0];
	$arp_pt_column_animation['pagination'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination'];
	$arp_pt_column_animation['pagination_style'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'][0];
	$arp_pt_column_animation['pagination_position'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_position'][2];
	$arp_pt_column_animation['easing_effect'] = $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'][4];
	$arp_pt_column_animation['infinite'] = $arp_mainoptionsarr['general_options']['column_animation']['infinite'];
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = '#000000';
	$arp_pt_tooltip_settings['text_color'] = '#FFFFFF';
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '175';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Arial';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 16;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings,'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
	
	
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
		
	$column['column_0']['package_title'] = 'Basic';
	$column['column_0']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus.';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	//$column['column_0']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>20</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>20";
	$column['column_0']['price_label'] = "per month";
	$column['column_0']['arp_header_shortcode'] = '';
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = "Abel";
	$column['column_0']['header_font_size'] = 30;
	$column['column_0']['header_font_color'] = "#454648";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_0']['header_style_bold'] = 'bold';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_0']['price_font_family'] = "Abel";
	$column['column_0']['price_font_size'] = 46;
	$column['column_0']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Open Sans';
	$column['column_0']['price_text_font_size'] = 13;
	$column['column_0']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Lucida Sans Unicode';
	$column['column_0']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#605f5f';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Abel";
	$column['column_0']['content_font_size'] = 17;
	$column['column_0']['content_font_color'] = "#494c4f";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Content Label Font Settings */
	$column['column_0']['content_label_font_family'] = '';
	$column['column_0']['content_label_font_size'] = '';
	$column['column_0']['content_label_font_style'] = '';
	//$column['column_0']['content_label_font_color'] = '';
	$column['column_0']['body_label_style_bold'] = '';
	$column['column_0']['body_label_style_italic'] = '';
	$column['column_0']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Abel";
	$column['column_0']['button_font_size'] = 20;
	$column['column_0']['button_font_color'] = "#444649";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_0']['button_style_bold'] = 'bold';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_0']['body_text_alignment'] = '';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_0']['row_description'] = '25 Domains';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_1']['row_description'] = '200MB Disk Space';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_2']['row_description'] = '20GB Traffic';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_3']['row_description'] = 'PHP / Mysql Database';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_4']['row_description'] = '25 Email Account';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'button';
	$column['column_0']['button_text'] = 'Choose Plan';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Team';
	$column['column_1']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus.';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	//$column['column_1']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>99</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>99";
	$column['column_1']['price_label'] = "per month";
	$column['column_1']['arp_header_shortcode'] = '';
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = "Abel";
	$column['column_1']['header_font_size'] = 30;
	$column['column_1']['header_font_color'] = "#454648";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_1']['header_style_bold'] = 'bold';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_1']['price_font_family'] = "Abel";
	$column['column_1']['price_font_size'] = 46;
	$column['column_1']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	$column['column_1']['price_text_font_family'] = 'Open Sans';
	$column['column_1']['price_text_font_size'] = 13;
	$column['column_1']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Lucida Sans Unicode';
	$column['column_1']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#605f5f';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Abel";
	$column['column_1']['content_font_size'] = 17;
	$column['column_1']['content_font_color'] = "#494c4f";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Content Label Font Settings */
	$column['column_1']['content_label_font_family'] = '';
	$column['column_1']['content_label_font_size'] = '';
	$column['column_1']['content_label_font_style'] = '';
	//$column['column_0']['content_label_font_color'] = '';
	$column['column_1']['body_label_style_bold'] = '';
	$column['column_1']['body_label_style_italic'] = '';
	$column['column_1']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Abel";
	$column['column_1']['button_font_size'] = 20;
	$column['column_1']['button_font_color'] = "#444649";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_1']['button_style_bold'] = 'bold';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_1']['body_text_alignment'] = '';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '50 Domains';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '400MB Disk Space';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = '40GB Traffic';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = 'PHP / Mysql Database';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = '50 Email Account';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'button';
	$column['column_1']['button_text'] = 'Choose Plan';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Premium';
	$column['column_2']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus.';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = 1;
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = "Abel";
	$column['column_2']['header_font_size'] = 30;
	$column['column_2']['header_font_color'] = "#454648";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_2']['header_style_bold'] = 'bold';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = "Abel";
	$column['column_2']['price_font_size'] = 46;
	$column['column_2']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Open Sans';
	$column['column_2']['price_text_font_size'] = 13;
	$column['column_2']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Lucida Sans Unicode';
	$column['column_2']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#605f5f';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Abel";
	$column['column_2']['content_font_size'] = 17;
	$column['column_2']['content_font_color'] = "#494c4f";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Content Label Font Settings */
	$column['column_2']['content_label_font_family'] = '';
	$column['column_2']['content_label_font_size'] = '';
	$column['column_2']['content_label_font_style'] = '';
	//$column['column_0']['content_label_font_color'] = '';
	$column['column_2']['body_label_style_bold'] = '';
	$column['column_2']['body_label_style_italic'] = '';
	$column['column_2']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Abel";
	$column['column_2']['button_font_size'] = 20;
	$column['column_2']['button_font_color'] = "#444649";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_2']['button_style_bold'] = 'bold';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>149";
	$column['column_2']['price_label'] = "per month";
	$column['column_2']['arp_header_shortcode'] = '';
	$column['column_2']['body_text_alignment'] = '';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '75 Domains';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '800MB Disk Space';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = '60GB Traffic';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = 'PHP / Mysql Database';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = '75 Email Account';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Choose Plan';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
    $column['column_2']['is_new_window'] = 0;
	$column['column_2']['s_is_new_window'] = '';
	
	$column['column_3']['package_title'] = 'Corporate';
	$column['column_3']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus.';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['column_align'] = 'left';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = "Abel";
	$column['column_3']['header_font_size'] = 30;
	$column['column_3']['header_font_color'] = "#454648";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_3']['header_style_bold'] = 'bold';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = "Abel";
	$column['column_3']['price_font_size'] = 46;
	$column['column_3']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_3']['price_label_style_bold'] = '';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Open Sans';
	$column['column_3']['price_text_font_size'] = 13;
	$column['column_3']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Lucida Sans Unicode';
	$column['column_3']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#605f5f';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Abel";
	$column['column_3']['content_font_size'] = 17;
	$column['column_3']['content_font_color'] = "#494c4f";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Content Label Font Settings */
	$column['column_3']['content_label_font_family'] = '';
	$column['column_3']['content_label_font_size'] = '';
	$column['column_3']['content_label_font_style'] = '';
	//$column['column_0']['content_label_font_color'] = '';
	$column['column_3']['body_label_style_bold'] = '';
	$column['column_3']['body_label_style_italic'] = '';
	$column['column_3']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Abel";
	$column['column_3']['button_font_size'] = 20;
	$column['column_3']['button_font_color'] = "#444649";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_3']['button_style_bold'] = 'bold';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>199";
	$column['column_3']['price_label'] = "per month";
	$column['column_3']['arp_header_shortcode'] = '';
	$column['column_3']['body_text_alignment'] = '';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = 'Unlimited Domains';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = 'Unlimited Disk Space';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = '99GB Traffic';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = 'PHP / Mysql Database';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = '100 Email Account';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Choose Plan';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;
	
	$pt_columns = array('columns'=>$column);
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	
	/* ARPrice Template 4 */
	
	$values['name'] = 'ARPrice Template 4';
	$values['is_template'] = 1;
	$values['template_name'] = 4;
	$values['status'] = 'published';
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	$arp_price_font_settings = array();
	$arp_content_font_settings = array();
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_4';
	$arp_pt_template_settings['skin']			= 'darkgreen';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default', 'caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'position_2','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>0);
	
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3","main_column_4"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_4';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'no';
	$arp_pt_column_settings['column_space'] = '0';
	$arp_pt_column_settings['column_highlight_on_hover'] = 0;
	$arp_pt_column_settings['is_responsive'] = 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 140;
	$arp_pt_column_settings['column_max_width'] = 260;
	$arp_pt_column_settings['hide_caption_column'] = 0;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
												
																	 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'][1];
	$arp_pt_column_animation['pagination'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination'];
	$arp_pt_column_animation['pagination_style'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'][1];
	$arp_pt_column_animation['pagination_position'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_position'][1];
	$arp_pt_column_animation['easing_effect'] = $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'][1];
	$arp_pt_column_animation['infinite'] = $arp_mainoptionsarr['general_options']['column_animation']['infinite'];

	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = '#000000';
	$arp_pt_tooltip_settings['text_color'] = '#FFFFFF';
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][1];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 16;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings,'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
	
	
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
	
	$column['column_0']['package_title'] = '';
	$column['column_0']['column_description'] = '';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 1;
	
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = "Open Sans";
	$column['column_0']['header_font_size'] = 26;
	$column['column_0']['header_font_color'] = "#000000";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_0']['price_font_family'] = "Arial";
	$column['column_0']['price_font_size'] = 16;
	$column['column_0']['price_font_color'] = "#000000";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = "Arial";
	$column['column_0']['price_text_font_size'] = 16;
	$column['column_0']['price_text_font_color'] = "#7a7a7a";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = '';
	$column['column_0']['column_description_font_size'] = '';
	//$column['column_0']['column_description_font_style'] = '';
	$column['column_0']['column_description_font_color'] = '';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Contnet Font Settngs */
	$column['column_0']['content_font_family'] = "Roboto Condensed";
	$column['column_0']['content_font_size'] = 17;
	$column['column_0']['content_font_color'] = "#3d3b3b";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';	
	/* Contnet Font Settings */

	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Roboto Condensed";
	$column['column_0']['button_font_size'] = 17;
	$column['column_0']['button_font_color'] = "#000000";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_0']['body_label_style_bold'] = 'bold';
	$column['column_0']['body_label_style_italic'] = '';
	$column['column_0']['body_label_style_decoration'] = '';
	/* Button Font Settings */
		
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	$column['column_0']['html_content'] = "Hosting Plans";
	$column['column_0']['body_text_alignment'] = 'left';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_0']['row_description'] = 'Data Storage';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_1']['row_description'] = 'MySQL Databases';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_2']['row_description'] = 'Email Accounts';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_3']['row_description'] = 'Free Domain';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_4']['row_description'] = 'Online Support';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['rows']['row_5']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_5']['row_description'] = 'Support Tickets';
	$column['column_0']['rows']['row_5']['row_tooltip'] = '';
	$column['column_0']['rows']['row_5']['row_label'] = '';
	$column['column_0']['button_size'] = '';
    $column['column_0']['button_type'] = '';
	$column['column_0']['button_text'] = '';
	$column['column_0']['button_url'] = '';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
		
	$column['column_1']['package_title'] = 'Bronze';
	$column['column_1']['column_description'] = '';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = "Open Sans Bold";
	$column['column_1']['header_font_size'] = 24;
	$column['column_1']['header_font_color'] = "#FFFFFF";
	//$column['column_1']['header_font_style'] = "normal";
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = "Open Sans Bold";
	$column['column_1']['price_font_size'] = 24;
	$column['column_1']['price_font_color'] = "#000000";
	//$column['column_1']['price_font_style'] = "normal";
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	$column['column_1']['price_text_font_family'] = "Open Sans";
	$column['column_1']['price_text_font_size'] = 14;
	$column['column_1']['price_text_font_color'] = "#7a7a7a";
	//$column['column_1']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = '';
	$column['column_1']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_1']['column_description_font_color'] = '';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Body Font Settngs */
	$column['column_1']['content_font_family'] = "Roboto Condensed";
	$column['column_1']['content_font_size'] = 17;
	$column['column_1']['content_font_color'] = "#3d3b3b";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Body Font Settings */
	
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Roboto Condensed";
	$column['column_1']['button_font_size'] = 19;
	$column['column_1']['button_font_color'] = "#000000";
	//$column['column_1']['button_font_style'] = "bold";
	$column['column_1']['button_style_bold'] = 'bold';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>20";
	$column['column_1']['price_label'] = "month";
	$column['column_1']['arp_header_shortcode'] = '';
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '10 GB';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = 'Every additional space of 1 GB costs $1.49';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '5 Databases';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = 'Every additional database costs $1.49';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = '5 Email Accounts';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = 'Every additional email account costs $1.99';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = '5 Free Domain';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = 'Every additional domain costs $1.49';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = 'No';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['rows']['row_5']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_5']['row_description'] = '2 tickets / month';
	$column['column_1']['rows']['row_5']['row_label'] = '';
	$column['column_1']['rows']['row_5']['row_tooltip'] = 'Every additional ticket costs $0.99';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'button';
	$column['column_1']['button_text'] = 'Purchase';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
    $column['column_1']['is_new_window'] = 0;
	$column['column_1']['s_is_new_window'] = '';
	
	$column['column_2']['package_title'] = 'Silver';
	$column['column_2']['column_description'] = '';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = "Open Sans Bold";
	$column['column_2']['header_font_size'] = 24;
	$column['column_2']['header_font_color'] = "#FFFFFF";
	//$column['column_1']['header_font_style'] = "normal";
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = "Open Sans Bold";
	$column['column_2']['price_font_size'] = 24;
	$column['column_2']['price_font_color'] = "#000000";
	//$column['column_1']['price_font_style'] = "normal";
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = "Open Sans";
	$column['column_2']['price_text_font_size'] = 14;
	$column['column_2']['price_text_font_color'] = "#7a7a7a";
	//$column['column_1']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = '';
	$column['column_2']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_2']['column_description_font_color'] = '';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Body Font Settngs */
	$column['column_2']['content_font_family'] = "Roboto Condensed";
	$column['column_2']['content_font_size'] = 17;
	$column['column_2']['content_font_color'] = "#3d3b3b";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Body Font Settings */
	
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Roboto Condensed";
	$column['column_2']['button_font_size'] = 19;
	$column['column_2']['button_font_color'] = "#000000";
	//$column['column_1']['button_font_style'] = "bold";
	$column['column_2']['button_style_bold'] = 'bold';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = 1;
	
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>50";
	$column['column_2']['price_label'] = "month";
	$column['column_2']['arp_header_shortcode'] = '';
	$column['column_2']['body_text_alignment'] = 'center';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '25 GB';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_0']['row_tooltip'] = 'Every additional space of 1 GB costs $1.49';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '10 Databases';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = 'Every additional database costs $1.49';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = '10 Email Accounts';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = 'Every additional email account costs $1.99';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = '10 Domains';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = 'Every additional domain costs $1.49';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = 'No';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['rows']['row_5']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_5']['row_description'] = '5 tickets / month';
	$column['column_2']['rows']['row_5']['row_label'] = '';
	$column['column_2']['rows']['row_5']['row_tooltip'] = 'Every additional ticket costs $0.99';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'button';
	$column['column_2']['button_text'] = 'Purchase';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
	$column['column_2']['s_is_new_window'] = '';
    $column['column_2']['is_new_window'] = 0;
	
	$column['column_3']['package_title'] = 'Gold';
	$column['column_3']['column_description'] = '';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['is_caption'] = 0;
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = "Open Sans Bold";
	$column['column_3']['header_font_size'] = 24;
	$column['column_3']['header_font_color'] = "#FFFFFF";
	//$column['column_1']['header_font_style'] = "normal";
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = "Open Sans Bold";
	$column['column_3']['price_font_size'] = 24;
	$column['column_3']['price_font_color'] = "#000000";
	//$column['column_1']['price_font_style'] = "normal";
	$column['column_3']['price_label_style_bold'] = '';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = "Open Sans";
	$column['column_3']['price_text_font_size'] = 14;
	$column['column_3']['price_text_font_color'] = "#000000";
	//$column['column_1']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = '';
	$column['column_3']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_3']['column_description_font_color'] = '';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Body Font Settngs */
	$column['column_3']['content_font_family'] = "Roboto Condensed";
	$column['column_3']['content_font_size'] = 17;
	$column['column_3']['content_font_color'] = "#3d3b3b";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Body Font Settings */
	
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Roboto Condensed";
	$column['column_3']['button_font_size'] = 19;
	$column['column_3']['button_font_color'] = "#000000";
	//$column['column_1']['button_font_style'] = "bold";
	$column['column_3']['button_style_bold'] = 'bold';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>69";
	$column['column_3']['price_label'] = "month";
	$column['column_3']['arp_header_shortcode'] = '';
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = '50 GB';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_0']['row_tooltip'] = 'Every additional space of 1 GB costs $1.49';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = '30 Databases';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = 'Every additional database costs $1.49';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = '20 Email Accounts';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = 'Every additional email account costs $1.99';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = '30 Domains';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = 'Every additional domain costs $1.49';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['rows']['row_5']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_5']['row_description'] = '10 tickets / month';
	$column['column_3']['rows']['row_5']['row_label'] = '';
	$column['column_3']['rows']['row_5']['row_tooltip'] = 'Every additional ticket costs $0.99';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'button';
	$column['column_3']['button_text'] = 'Purchase';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;	
	
	$column['column_4']['package_title'] = 'Platinum';
	$column['column_4']['column_description'] = '';
	$column['column_4']['custom_ribbon_txt'] = '';
	$column['column_4']['column_width'] = '';
	$column['column_4']['column_align'] = 'left';
	$column['column_4']['is_caption'] = 0;
	
	/* Header Font Settings */
	$column['column_4']['header_font_family'] = "Open Sans Bold";
	$column['column_4']['header_font_size'] = 24;
	$column['column_4']['header_font_color'] = "#FFFFFF";
	//$column['column_1']['header_font_style'] = "normal";
	$column['column_4']['header_style_bold'] = '';
	$column['column_4']['header_style_italic'] = '';
	$column['column_4']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_4']['price_font_family'] = "Open Sans Bold";
	$column['column_4']['price_font_size'] = 24;
	$column['column_4']['price_font_color'] = "#000000";
	//$column['column_1']['price_font_style'] = "normal";
	$column['column_4']['price_label_style_bold'] = '';
	$column['column_4']['price_label_style_italic'] = '';
	$column['column_4']['price_label_style_decoration'] = '';
	
	$column['column_4']['price_text_font_family'] = "Open Sans";
	$column['column_4']['price_text_font_size'] = 14;
	$column['column_4']['price_text_font_color'] = "#7a7a7a";
	//$column['column_1']['price_text_font_style'] = "normal";
	$column['column_4']['price_text_style_bold'] = '';
	$column['column_4']['price_text_style_italic'] = '';
	$column['column_4']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_4']['column_description_font_family'] = '';
	$column['column_4']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_4']['column_description_font_color'] = '';
	$column['column_4']['column_description_style_bold'] = '';
	$column['column_4']['column_description_style_italic'] = '';
	$column['column_4']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Body Font Settngs */
	$column['column_4']['content_font_family'] = "Roboto Condensed";
	$column['column_4']['content_font_size'] = 17;
	$column['column_4']['content_font_color'] = "#3d3b3b";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_4']['body_li_style_bold'] = '';
	$column['column_4']['body_li_style_italic'] = '';
	$column['column_4']['body_li_style_decoration'] = '';
	/* Body Font Settings */
	
	/* Button Font Settings */
	$column['column_4']['button_font_family'] = "Roboto Condensed";
	$column['column_4']['button_font_size'] = 19;
	$column['column_4']['button_font_color'] = "#000000";
	//$column['column_1']['button_font_style'] = "bold";
	$column['column_4']['button_style_bold'] = 'bold';
	$column['column_4']['button_style_italic'] = '';
	$column['column_4']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_4']['is_hidden'] = '';
	$column['column_4']['column_highlight'] = '';
	
	$column['column_4']['price_text'] = "<span class='arp_currency'>$</span>99";
	$column['column_4']['price_label'] = "month";
	$column['column_4']['arp_header_shortcode'] = '';
	$column['column_4']['body_text_alignment'] = 'center';
	$column['column_4']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_0']['row_description'] = 'Unlimited';
	$column['column_4']['rows']['row_0']['row_label'] = '';
	$column['column_4']['rows']['row_0']['row_tooltip'] = 'Enjoy unlmited disk space';
	$column['column_4']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_1']['row_description'] = 'Unlimited Database';
	$column['column_4']['rows']['row_1']['row_label'] = '';
	$column['column_4']['rows']['row_1']['row_tooltip'] = 'Enjoy unlimited databases';
	$column['column_4']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_2']['row_description'] = '30 Email accounts';
	$column['column_4']['rows']['row_2']['row_label'] = '';
	$column['column_4']['rows']['row_2']['row_tooltip'] = 'Every additional email account costs $1.99';
	$column['column_4']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_3']['row_description'] = '30 Free Domains';
	$column['column_4']['rows']['row_3']['row_label'] = '';
	$column['column_4']['rows']['row_3']['row_tooltip'] = 'Every additional domain costs $1.49';
	$column['column_4']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_4']['rows']['row_4']['row_label'] = '';
	$column['column_4']['rows']['row_4']['row_tooltip'] = '';
	$column['column_4']['rows']['row_5']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_5']['row_description'] = '30 tickets / month';
	$column['column_4']['rows']['row_5']['row_label'] = '';
	$column['column_4']['rows']['row_5']['row_tooltip'] = 'Every additional ticket costs $0.99';
	$column['column_4']['button_size'] = 'Medium';
    $column['column_4']['button_type'] = 'button';
	$column['column_4']['button_text'] = 'Purchase';
	$column['column_4']['button_url'] = '#';
	$column['column_4']['button_s_size'] = '';
	$column['column_4']['button_s_type'] = '';
	$column['column_4']['button_s_text'] = '';
	$column['column_4']['button_s_url'] = '';
	$column['column_4']['s_is_new_window'] = '';
    $column['column_4']['is_new_window'] = 0;
		
	$pt_columns = array('columns'=>$column);
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	/* ARPrice Template 5 */

	
	$values['name'] = 'ARPrice Template 5';
	$values['is_template'] = 1;
	$values['template_name'] = 5;
	$values['status'] = 'published';
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	$arp_price_font_settings = array();
	$arp_content_font_settings = array();
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_5';
	$arp_pt_template_settings['skin']			= 'multicolor';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'none','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style'=>'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>0);
	
	
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_5';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'no';
	$arp_pt_column_settings['column_space'] = '0';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] = 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 150;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'][0];
	$arp_pt_column_animation['pagination'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination'];
	$arp_pt_column_animation['pagination_style'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'][0];
	$arp_pt_column_animation['pagination_position'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_position'][0];
	$arp_pt_column_animation['easing_effect'] = $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'][0];
	$arp_pt_column_animation['infinite'] = $arp_mainoptionsarr['general_options']['column_animation']['infinite'];
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = '#000000';
	$arp_pt_tooltip_settings['text_color'] = '#FFFFFF';
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '200';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Arial';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 15;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings,'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
	
	
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
		
	$column['column_0']['package_title'] = 'Basic';
	$column['column_0']['column_description'] = '';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = 'Roboto';
	$column['column_0']['header_font_size'] = 20;
	$column['column_0']['header_font_color'] = "#FFFFFF";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_0']['price_font_family'] = "Jockey One";
	$column['column_0']['price_font_size'] = 46;
	$column['column_0']['price_font_color'] = "#FFFFFF";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Open Sans';
	$column['column_0']['price_text_font_size'] = 17;
	$column['column_0']['price_text_font_color'] = "#FFFFFF";
	//$column['column_0']['price_text_font_style'] = "italic";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = 'italic';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Open Sans';
	$column['column_0']['column_description_font_size'] = 10;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#ffffff';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Open Sans";
	$column['column_0']['content_font_size'] = 15;
	$column['column_0']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Roboto";
	$column['column_0']['button_font_size'] = 20;
	$column['column_0']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_0']['button_style_bold'] = '';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
		
	
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>49";
	$column['column_0']['price_label'] = "/ month";
	$column['column_0']['arp_header_shortcode'] = '[arp_youtube_video id="QpU_JbAO_Cg" height="145" autoplay="0"]';
	$column['column_0']['body_text_alignment'] = 'left';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_0']['row_description'] = '10 GB Disk Space';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_1']['row_description'] = '5 Databases';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_2']['row_description'] = '5 Email Accounts';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_3']['row_description'] = '5 Free Domain';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_4']['row_description'] = 'Online Support';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'Button';
	$column['column_0']['button_text'] = 'Order Now';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Small Business';
	$column['column_1']['column_description'] = '';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = 1;
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = 'Roboto';
	$column['column_1']['header_font_size'] = 20;
	$column['column_1']['header_font_color'] = "#FFFFFF";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = "Jockey One";
	$column['column_1']['price_font_size'] = 46;
	$column['column_1']['price_font_color'] = "#FFFFFF";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	$column['column_1']['price_text_font_family'] = 'Open Sans';
	$column['column_1']['price_text_font_size'] = 17;
	$column['column_1']['price_text_font_color'] = "#FFFFFF";
	//$column['column_0']['price_text_font_style'] = "italic";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = 'italic';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Open Sans';
	$column['column_1']['column_description_font_size'] = 10;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#ffffff';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Open Sans";
	$column['column_1']['content_font_size'] = 15;
	$column['column_1']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Roboto";
	$column['column_1']['button_font_size'] = 20;
	$column['column_1']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_1']['button_style_bold'] = '';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>69";
	$column['column_1']['price_label'] = "/ month";
	$column['column_1']['arp_header_shortcode'] = '[arp_youtube_video id="l62OY19rZ7k" height="145" autoplay="0"]';
	$column['column_1']['body_text_alignment'] = 'left';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_0']['row_description'] = '20 GB Disk Space';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_1']['row_description'] = '10 Databases';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_2']['row_description'] = '10 Email Accounts';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_3']['row_description'] = '10 Free Domain';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_4']['row_description'] = 'Online Support';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'Button';
	$column['column_1']['button_text'] = 'Order Now';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Professional';
	$column['column_2']['column_description'] = '';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = 'Roboto';
	$column['column_2']['header_font_size'] = 20;
	$column['column_2']['header_font_color'] = "#FFFFFF";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = "Jockey One";
	$column['column_2']['price_font_size'] = 46;
	$column['column_2']['price_font_color'] = "#FFFFFF";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Open Sans';
	$column['column_2']['price_text_font_size'] = 17;
	$column['column_2']['price_text_font_color'] = "#FFFFFF";
	//$column['column_0']['price_text_font_style'] = "italic";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = 'italic';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Open Sans';
	$column['column_2']['column_description_font_size'] = 10;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#ffffff';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Open Sans";
	$column['column_2']['content_font_size'] = 15;
	$column['column_2']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Roboto";
	$column['column_2']['button_font_size'] = 20;
	$column['column_2']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_2']['button_style_bold'] = '';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>79";
	$column['column_2']['price_label'] = "/ month";
	$column['column_2']['arp_header_shortcode'] = '[arp_youtube_video id="JQwg9G99GJE" height="145" autoplay="0"]';
	$column['column_2']['body_text_alignment'] = 'left';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_0']['row_description'] = '25 GB Disk Space';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_1']['row_description'] = '10 Databases';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_2']['row_description'] = '10 Email Accounts';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_3']['row_description'] = '10 Domains';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_4']['row_description'] = 'Online Support';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Order Now';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
	$column['column_2']['s_is_new_window'] = '';
    $column['column_2']['is_new_window'] = 0;
	
	$column['column_3']['package_title'] = 'Enterprise';
	$column['column_3']['column_description'] = '';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = 'Roboto';
	$column['column_3']['header_font_size'] = 20;
	$column['column_3']['header_font_color'] = "#FFFFFF";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_3']['price_font_family'] = "Jockey One";
	$column['column_3']['price_font_size'] = 46;
	$column['column_3']['price_font_color'] = "#FFFFFF";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_3']['price_label_style_bold'] = '';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Open Sans';
	$column['column_3']['price_text_font_size'] = 17;
	$column['column_3']['price_text_font_color'] = "#FFFFFF";
	//$column['column_0']['price_text_font_style'] = "italic";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = 'italic';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Open Sans';
	$column['column_3']['column_description_font_size'] = 10;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#ffffff';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Open Sans";
	$column['column_3']['content_font_size'] = 15;
	$column['column_3']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Roboto";
	$column['column_3']['button_font_size'] = 20;
	$column['column_3']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_3']['button_style_bold'] = '';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>99";
	$column['column_3']['price_label'] = "/ month";
	$column['column_3']['arp_header_shortcode'] = '[arp_youtube_video id="h_c3iQImXZg" height="145" autoplay="0"]';
	$column['column_3']['body_text_alignment'] = 'left';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_0']['row_description'] = 'Unlimited Disk Space';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_1']['row_description'] = 'Unlimited Database';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_2']['row_description'] = '30 Email accounts';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_3']['row_description'] = '30 Free Domains';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Order Now';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;
		
	$pt_columns = array('columns'=>$column);
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	/* ARPrice Template 6 */

	
	$values['name'] = 'ARPrice Template 6';
	$values['is_template'] = 1;
	$values['status'] = 'published';
	$values['template_name'] = 6;
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	$arp_price_font_settings = array();
	$arp_content_font_settings = array();
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_6';
	$arp_pt_template_settings['skin']			= 'green';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       =  array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'style_1','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'style_1','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>0);
	
	
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3","main_column_4"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_6';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'no';
	$arp_pt_column_settings['column_space'] = '0';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] = 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 130;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'][0];
	$arp_pt_column_animation['pagination'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination'];
	$arp_pt_column_animation['pagination_style'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'][0];
	$arp_pt_column_animation['pagination_position'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_position'][0];
	$arp_pt_column_animation['easing_effect'] = $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'][0];
	$arp_pt_column_animation['infinite'] = $arp_mainoptionsarr['general_options']['column_animation']['infinite'];
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = '#FFFFFF';
	$arp_pt_tooltip_settings['text_color'] = '#000000';
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans Bold';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 14;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings,'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
	
	
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
	
	
	$column['column_0']['package_title'] = '';
	$column['column_0']['column_description'] = '';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = 'Open Sans Bold';
	$column['column_0']['header_font_size'] = 19;
	//$column['column_0']['header_font_style'] = 'normal';
	$column['column_0']['header_font_color'] = '#ffffff';
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_0']['price_font_family'] = 'Open Sans';
	$column['column_0']['price_font_size'] = 18;
	//$column['column_0']['price_font_style'] = 'normal';
	$column['column_0']['price_font_color'] = '#ffffff';
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_0']['price_text_font_family'] = 'Open Sans';
	$column['column_0']['price_text_font_size'] = 18;
	//$column['column_0']['price_text_font_style'] = 'normal';
	$column['column_0']['price_text_font_color'] = '#ffffff';
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Open Sans';
	$column['column_0']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#ffffff';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = 'Open Sans Bold';
	$column['column_0']['content_font_size'] = 14;
	//$column['column_0']['content_font_style'] = 'normal';
	$column['column_0']['content_font_color'] = '#ffffff';
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_0']['button_font_family'] = 'Open Sans Bold';
	$column['column_0']['button_font_size'] = 16;
	//$column['column_0']['button_font_style'] = 'normal';
	$column['column_0']['button_font_color'] = '#ffffff';
	$column['column_0']['button_style_bold'] = 'bold';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	
	$column['column_0']['is_caption'] = 1;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	$column['column_0']['html_content'] = "Choos Your Plan";
	$column['column_0']['body_text_alignment'] = 'left';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_0']['row_description'] = 'Data Storage';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_1']['row_description'] = 'MySQL Databases';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_2']['row_description'] = 'Daily Backup';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_3']['row_description'] = 'Free Domains';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_4']['row_description'] = 'Online Support';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['button_size'] = '';
    $column['column_0']['button_type'] = '';
	$column['column_0']['button_text'] = '';
	$column['column_0']['button_url'] = '';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Basic';
	$column['column_1']['column_description'] = 'Aenean a placerat neque';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = 'Open Sans Bold';
	$column['column_1']['header_font_size']   = 26;
	//$column['column_1']['header_font_style']  = 'normal';
	$column['column_1']['header_font_color']  = '#ffffff';
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = 'Open Sans Bold';
	$column['column_1']['price_font_size']   = 65;
	//$column['column_1']['price_font_style']  = 'normal';
	$column['column_1']['price_font_color']  = '#7C7C7C';
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_1']['price_text_font_family'] = 'Open Sans';
	$column['column_1']['price_text_font_size']   = 15;
	//$column['column_1']['price_text_font_style']  = 'normal';
	$column['column_1']['price_text_font_color']  = '#7C7C7C';
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Open Sans';
	$column['column_1']['column_description_font_size'] = 13;
	//$column['column_1']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#ffffff';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = 'Open Sans';
	$column['column_1']['content_font_size']   = 14;
	//$column['column_1']['content_font_style']  = 'normal';
	$column['column_1']['content_font_color']  = '#7C7C7C';
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_1']['button_font_family'] = 'Roboto';
	$column['column_1']['button_font_size'] = 15;
	//$column['column_0']['button_font_style'] = 'normal';
	$column['column_1']['button_font_color'] = '#ffffff';
	$column['column_1']['button_style_bold'] = 'bold';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings*/
		
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	//$column['column_1']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>14";
	$column['column_1']['price_label'] = "monthly";
	$column['column_1']['arp_header_shortcode'] = '';
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '20GB';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '15 Databases';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = 'No';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = '2 Domains';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = 'No';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'button';
	$column['column_1']['button_text'] = 'Purchase';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Standard';
	$column['column_2']['column_description'] = 'Aenean a placerat neque';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = 'Open Sans Bold';
	$column['column_2']['header_font_size']   = 26;
	//$column['column_1']['header_font_style']  = 'normal';
	$column['column_2']['header_font_color']  = '#ffffff';
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = 'Open Sans Bold';
	$column['column_2']['price_font_size']   = 65;
	//$column['column_1']['price_font_style']  = 'normal';
	$column['column_2']['price_font_color']  = '#7C7C7C';
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_2']['price_text_font_family'] = 'Open Sans';
	$column['column_2']['price_text_font_size']   = 15;
	//$column['column_1']['price_text_font_style']  = 'normal';
	$column['column_2']['price_text_font_color']  = '#7C7C7C';
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Open Sans';
	$column['column_2']['column_description_font_size'] = 13;
	//$column['column_1']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#ffffff';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = 'Open Sans';
	$column['column_2']['content_font_size']   = 14;
	//$column['column_1']['content_font_style']  = 'normal';
	$column['column_2']['content_font_color']  = '#7C7C7C';
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_2']['button_font_family'] = 'Roboto';
	$column['column_2']['button_font_size'] = 15;
	//$column['column_0']['button_font_style'] = 'normal';
	$column['column_2']['button_font_color'] = '#ffffff';
	$column['column_2']['button_style_bold'] = 'bold';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = '';
	//$column['column_2']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>24";
	$column['column_2']['price_label'] = "monthly";
	$column['column_2']['arp_header_shortcode'] = '';
	$column['column_2']['body_text_alignment'] = 'center';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '80GB';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '100 Databases';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = 'No';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = '5 Domains';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = 'No';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'button';
	$column['column_2']['button_text'] = 'Purchase';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
	$column['column_2']['s_is_new_window'] = '';
    $column['column_2']['is_new_window'] = 0;
	
	$column['column_3']['package_title'] = 'Premium';
	$column['column_3']['column_description'] = 'Aenean a placerat neque';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = 'Open Sans Bold';
	$column['column_3']['header_font_size']   = 26;
	//$column['column_1']['header_font_style']  = 'normal';
	$column['column_3']['header_font_color']  = '#ffffff';
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = 'Open Sans Bold';
	$column['column_3']['price_font_size']   = 65;
	//$column['column_1']['price_font_style']  = 'normal';
	$column['column_3']['price_font_color']  = '#7C7C7C';
	$column['column_3']['price_label_style_bold'] = 'bold';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_3']['price_text_font_family'] = 'Open Sans';
	$column['column_3']['price_text_font_size']   = 15;
	//$column['column_1']['price_text_font_style']  = 'normal';
	$column['column_3']['price_text_font_color']  = '#7C7C7C';
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Open Sans';
	$column['column_3']['column_description_font_size'] = 13;
	//$column['column_1']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#ffffff';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = 'Open Sans';
	$column['column_3']['content_font_size']   = 14;
	//$column['column_1']['content_font_style']  = 'normal';
	$column['column_3']['content_font_color']  = '#7C7C7C';
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_3']['button_font_family'] = 'Roboto';
	$column['column_3']['button_font_size'] = 15;
	//$column['column_0']['button_font_style'] = 'normal';
	$column['column_3']['button_font_color'] = '#ffffff';
	$column['column_3']['button_style_bold'] = 'bold';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	//$column['column_3']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>34";
	$column['column_3']['price_label'] = "monthly";
	$column['column_3']['arp_header_shortcode'] = '';
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = '150GB';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = '150 Databases';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = 'Yes';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = '10 Domains';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'button';
	$column['column_3']['button_text'] = 'Purchase';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
    $column['column_3']['is_new_window'] = 0;
	$column['column_3']['s_is_new_window'] = '';
	
	$column['column_4']['package_title'] = 'Ultimate';
	$column['column_4']['column_description'] = 'Aenean a placerat neque';
	$column['column_4']['custom_ribbon_txt'] = '';
	$column['column_4']['column_width'] = '';
	$column['column_4']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_4']['header_font_family'] = 'Open Sans Bold';
	$column['column_4']['header_font_size']   = 26;
	//$column['column_1']['header_font_style']  = 'normal';
	$column['column_4']['header_font_color']  = '#ffffff';
	$column['column_4']['header_style_bold'] = '';
	$column['column_4']['header_style_italic'] = '';
	$column['column_4']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_4']['price_font_family'] = 'Open Sans Bold';
	$column['column_4']['price_font_size']   = 65;
	//$column['column_1']['price_font_style']  = 'normal';
	$column['column_4']['price_font_color']  = '#7C7C7C';
	$column['column_4']['price_label_style_bold'] = '';
	$column['column_4']['price_label_style_italic'] = '';
	$column['column_4']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_4']['price_text_font_family'] = 'Open Sans';
	$column['column_4']['price_text_font_size']   = 15;
	//$column['column_1']['price_text_font_style']  = 'normal';
	$column['column_4']['price_text_font_color']  = '#7C7C7C';
	$column['column_4']['price_text_style_bold'] = '';
	$column['column_4']['price_text_style_italic'] = '';
	$column['column_4']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_4']['column_description_font_family'] = 'Open Sans';
	$column['column_4']['column_description_font_size'] = 13;
	//$column['column_1']['column_description_font_style'] = 'normal';
	$column['column_4']['column_description_font_color'] = '#ffffff';
	$column['column_4']['column_description_style_bold'] = '';
	$column['column_4']['column_description_style_italic'] = '';
	$column['column_4']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_4']['content_font_family'] = 'Open Sans';
	$column['column_4']['content_font_size']   = 14;
	//$column['column_1']['content_font_style']  = 'normal';
	$column['column_4']['content_font_color']  = '#7C7C7C';
	$column['column_4']['body_li_style_bold'] = '';
	$column['column_4']['body_li_style_italic'] = '';
	$column['column_4']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_4']['button_font_family'] = 'Roboto';
	$column['column_4']['button_font_size'] = 15;
	//$column['column_0']['button_font_style'] = 'normal';
	$column['column_4']['button_font_color'] = '#ffffff';
	$column['column_4']['button_style_bold'] = 'bold';
	$column['column_4']['button_style_italic'] = '';
	$column['column_4']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	$column['column_4']['is_caption'] = 0;
	$column['column_4']['is_hidden'] = '';
	$column['column_4']['column_highlight'] = '';
	//$column['column_4']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_4']['price_text'] = "<span class='arp_currency'>$</span>44";
	$column['column_4']['price_label'] = "monthly";
	$column['column_4']['arp_header_shortcode'] = '';
	$column['column_4']['body_text_alignment'] = 'center';
	$column['column_4']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_0']['row_description'] = 'Unlimited';
	$column['column_4']['rows']['row_0']['row_tooltip'] = '';
	$column['column_4']['rows']['row_0']['row_label'] = '';
	$column['column_4']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_1']['row_description'] = 'Unlimited Databases';
	$column['column_4']['rows']['row_1']['row_tooltip'] = '';
	$column['column_4']['rows']['row_1']['row_label'] = '';
	$column['column_4']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_2']['row_description'] = 'Yes';
	$column['column_4']['rows']['row_2']['row_tooltip'] = '';
	$column['column_4']['rows']['row_2']['row_label'] = '';
	$column['column_4']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_3']['row_description'] = '20 Domains';
	$column['column_4']['rows']['row_3']['row_tooltip'] = '';
	$column['column_4']['rows']['row_3']['row_label'] = '';
	$column['column_4']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_4']['rows']['row_4']['row_tooltip'] = '';
	$column['column_4']['rows']['row_4']['row_label'] = '';
	$column['column_4']['button_size'] = 'Medium';
    $column['column_4']['button_type'] = 'button';
	$column['column_4']['button_text'] = 'Purchase';
	$column['column_4']['button_url'] = '#';
	$column['column_4']['button_s_size'] = '';
	$column['column_4']['button_s_type'] = '';
	$column['column_4']['button_s_text'] = '';
	$column['column_4']['button_s_url'] = '';
	$column['column_4']['s_is_new_window'] = '';
    $column['column_4']['is_new_window'] = 0;
			
	$pt_columns = array('columns'=>$column);
	
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	
	/* ARPrice Template 7 */

	
	$values['name'] = 'ARPrice Template 7';
	$values['is_template'] = 1;
	$values['template_name'] = 7;
	$values['status'] = 'published';
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	$arp_price_font_settings = array();
	$arp_content_font_settings = array();
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_7';
	$arp_pt_template_settings['skin']			= 'blue';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'position_1','caption_style'=>'none','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style'=>'style_3','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'position_1','tooltip_position'=>'top-left','tooltip_style'=>'style_1','second_btn'=>false,'is_animated'=>0);
	
	
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_7';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	$arp_pt_column_settings['space_between_column'] =  'yes';
	$arp_pt_column_settings['column_space'] = '10';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] = 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 150;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'][0];
	$arp_pt_column_animation['pagination'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination'];
	$arp_pt_column_animation['pagination_style'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'][0];
	$arp_pt_column_animation['pagination_position'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_position'][0];
	$arp_pt_column_animation['easing_effect'] = $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'][0];
	$arp_pt_column_animation['infinite'] = $arp_mainoptionsarr['general_options']['column_animation']['infinite'];
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = '#77b900';
	$arp_pt_tooltip_settings['text_color'] = '#FFFFFF';
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][2];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Arial';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 14;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings,'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
	
	
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
		
	$column['column_0']['package_title'] = 'Basic';
	$column['column_0']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus. Integer porttitor diam eget porta accumsan.';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	//$column['column_0']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>11</span><span class=\"arp_price_duration\">/ month</span></div>";
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>11";
	$column['column_0']['price_label'] = "/ month";
	
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = 'Open Sans Bold';
	$column['column_0']['header_font_size'] = 19;
	$column['column_0']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_0']['header_style_bold'] = 'bold';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_0']['price_font_family'] = "Anton";
	$column['column_0']['price_font_size'] = 46;
	$column['column_0']['price_font_color'] = "#3E3E3C";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Arial';
	$column['column_0']['price_text_font_size'] = 16;
	$column['column_0']['price_text_font_color'] = "#898989";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = 'bold';
	$column['column_0']['price_text_style_italic'] = 'italic';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Arial';
	$column['column_0']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#7c7c7c';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Arial";
	$column['column_0']['content_font_size'] = 14;
	$column['column_0']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Arial";
	$column['column_0']['button_font_size'] = 18;
	$column['column_0']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_0']['button_style_bold'] = '';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_0']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_7_1.jpg" />';
	$column['column_0']['body_text_alignment'] = 'left';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_0']['row_description'] = '<i class="fa fa-clock-o"></i> 10 GB Disk Space';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_1']['row_description'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/icon2.png" /> 5 Databases';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_2']['row_description'] = '<i class="fa fa-star"></i> 5 Email Accounts';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_3']['row_description'] = '<i class="fa fa-heart"></i> 5 Free Domain';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'Button';
	$column['column_0']['button_text'] = 'Sign Up';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Team';
	$column['column_1']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus. Integer porttitor diam eget porta accumsan.';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = 1;
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = 'Open Sans Bold';
	$column['column_1']['header_font_size'] = 19;
	$column['column_1']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_1']['header_style_bold'] = 'bold';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_1']['price_font_family'] = "Anton";
	$column['column_1']['price_font_size'] = 46;
	$column['column_1']['price_font_color'] = "#3E3E3C";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';

	$column['column_1']['price_text_font_family'] = 'Arial';
	$column['column_1']['price_text_font_size'] = 16;
	$column['column_1']['price_text_font_color'] = "#898989";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = 'bold';
	$column['column_1']['price_text_style_italic'] = 'italic';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Arial';
	$column['column_1']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#7c7c7c';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Arial";
	$column['column_1']['content_font_size'] = 14;
	$column['column_1']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Arial";
	$column['column_1']['button_font_size'] = 18;
	$column['column_1']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_1']['button_style_bold'] = '';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_1']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>22</span><span class=\"arp_price_duration\"> / month</span></div>";
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>22";
	$column['column_1']['price_label'] = "/ month";
	$column['column_1']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_7_2.jpg" />';
	$column['column_1']['body_text_alignment'] = 'left';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_0']['row_description'] = '<i class="fa fa-clock-o"></i> 20 GB Disk Space';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_1']['row_description'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/icon2.png" /> 10 Databases';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_2']['row_description'] = '<i class="fa fa-star"></i> 10 Email Accounts';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_3']['row_description'] = '<i class="fa fa-heart"></i> 10 Free Domain';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'Button';
	$column['column_1']['button_text'] = 'Sign Up';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Premium';
	$column['column_2']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus. Integer porttitor diam eget porta accumsan.';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = 0;
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = 'Open Sans Bold';
	$column['column_2']['header_font_size'] = 19;
	$column['column_2']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_2']['header_style_bold'] = 'bold';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_2']['price_font_family'] = "Anton";
	$column['column_2']['price_font_size'] = 46;
	$column['column_2']['price_font_color'] = "#3E3E3C";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Arial';
	$column['column_2']['price_text_font_size'] = 16;
	$column['column_2']['price_text_font_color'] = "#898989";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = 'bold';
	$column['column_2']['price_text_style_italic'] = 'italic';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Arial';
	$column['column_2']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#7c7c7c';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Arial";
	$column['column_2']['content_font_size'] = 14;
	$column['column_2']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Arial";
	$column['column_2']['button_font_size'] = 18;
	$column['column_2']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_2']['button_style_bold'] = '';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_2']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>38</span><span class=\"arp_price_duration\"> / month</span></div>";
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>38";
	$column['column_2']['price_label'] = "/ month";
	$column['column_2']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_7_3.jpg" />';
	$column['column_2']['body_text_alignment'] = 'left';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_0']['row_description'] = '<i class="fa fa-clock-o"></i> 25 GB Disk Space';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_1']['row_description'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/icon2.png" /> 10 Databases';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_2']['row_description'] = '<i class="fa fa-star"></i> 10 Email Accounts';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = 'Pertinax vel eum moleti';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_3']['row_description'] = '<i class="fa fa-heart"></i> 10 Domains';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Sign Up';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
    $column['column_2']['is_new_window'] = 0;
	$column['column_2']['s_is_new_window'] = '';
	
	$column['column_3']['package_title'] = 'Corporate';
	$column['column_3']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus. Integer porttitor diam eget porta accumsan.';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = 'Open Sans Bold';
	$column['column_3']['header_font_size'] = 19;
	$column['column_3']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_3']['header_style_bold'] = 'bold';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_3']['price_font_family'] = "Anton";
	$column['column_3']['price_font_size'] = 46;
	$column['column_3']['price_font_color'] = "#3E3E3C";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_3']['price_label_style_bold'] = '';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Arial';
	$column['column_3']['price_text_font_size'] = 16;
	$column['column_3']['price_text_font_color'] = "#898989";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = 'bold';
	$column['column_3']['price_text_style_italic'] = 'italic';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Arial';
	$column['column_3']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#7c7c7c';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Arial";
	$column['column_3']['content_font_size'] = 14;
	$column['column_3']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Arial";
	$column['column_3']['button_font_size'] = 18;
	$column['column_3']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_3']['button_style_bold'] = '';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_3']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>49</span><span class=\"arp_price_duration\"> / month</span></div>";
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>49";
	$column['column_3']['price_label'] = "/ month";
	$column['column_3']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_7_4.jpg" />';
	$column['column_3']['body_text_alignment'] = 'left';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_0']['row_description'] = '<i class="fa fa-clock-o"></i> Unlimited Disk Space';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_1']['row_description'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/icon2.png" /> Unlimited Database';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_2']['row_description'] = '<i class="fa fa-star"></i> 30 Email accounts';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_3']['row_description'] = '<i class="fa fa-heart"></i> 30 Free Domains';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Sign Up';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;
		
	$pt_columns = array('columns'=>$column);
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	
	/* ARPrice Template 8 */

	
	$values['name'] = 'ARPrice Template 8';
	$values['is_template'] = 1;
	$values['template_name'] = 8;
	$values['status'] = 'published';
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	$arp_price_font_settings = array();
	$arp_content_font_settings = array();
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_8';
	$arp_pt_template_settings['skin']			= 'purple';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'position_2','caption_style'=>'style_1','amount_style'=>'style_2','list_alignment'=>'center','ribbon_type'=>'default','column_description_style'=>'default','caption_title'=>'default','header_shortcode_type'=>'rounded_corner','header_shortcode_position'=>'position_1','tooltip_position'=>'top','tooltip_style'=>'style_2','second_btn'=>false,'is_animated'=>0);
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_8';
	$arp_pt_general_settings['user_edited_columns'] = '';
		
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'yes';
	$arp_pt_column_settings['column_space'] = '1';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] = 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 150;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'][1];
	$arp_pt_column_animation['pagination'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination'];
	$arp_pt_column_animation['pagination_style'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'][1];
	$arp_pt_column_animation['pagination_position'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_position'][0];
	$arp_pt_column_animation['easing_effect'] = $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'][0];
	$arp_pt_column_animation['infinite'] = 0;
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = '#2579eb';
	$arp_pt_tooltip_settings['text_color'] = '#FFFFFF';
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans Bold';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 18;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings,'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
	
	
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
		
	$column['column_0']['package_title'] = 'Basic Pro';
	$column['column_0']['column_description'] = '';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = 'Open Sans Semibold';
	$column['column_0']['header_font_size'] = 22;
	$column['column_0']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_0']['price_font_family'] = "Arial";
	$column['column_0']['price_font_size'] = 40;
	$column['column_0']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Arial';
	$column['column_0']['price_text_font_size'] = 13;
	$column['column_0']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Arial';
	$column['column_0']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#7c7c7c';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Open Sans Bold";
	$column['column_0']['content_font_size'] = 15;
	$column['column_0']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Content Label Font Settings */
	$column['column_0']['content_label_font_family'] = 'Open Sans';
	$column['column_0']['content_label_font_size'] = 14;
	//$column['column_0']['content_label_font_style'] = 'bold';
	$column['column_0']['content_label_font_color'] = '#000000';
	$column['column_0']['body_label_style_bold'] = '';
	$column['column_0']['body_label_style_italic'] = '';
	$column['column_0']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Open Sans Bold";
	$column['column_0']['button_font_size'] = 18;
	$column['column_0']['button_font_color'] = "#323232";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_0']['button_style_bold'] = '';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_0']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_duration\">per month</span><span class=\"arp_price_value\"><span class='arp_currency'>$</span>5</span></div>";
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>5";
	$column['column_0']['price_label'] = "per month";
	$column['column_0']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_8_1.png">';
	$column['column_0']['body_text_alignment'] = 'center';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_0']['row_description'] = '10 GB';
	$column['column_0']['rows']['row_0']['row_label'] = 'Data Storage';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_1']['row_description'] = '5';
	$column['column_0']['rows']['row_1']['row_label'] = 'MySQL Databases';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_2']['row_description'] = '5';
	$column['column_0']['rows']['row_2']['row_label'] = 'Email Accounts';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_3']['row_description'] = '5';
	$column['column_0']['rows']['row_3']['row_label'] = 'Free Domain';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_4']['row_description'] = 'No';
	$column['column_0']['rows']['row_4']['row_label'] = 'Online Support';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'Button';
	$column['column_0']['button_text'] = 'Submit';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Standard Pro';
	$column['column_1']['column_description'] = '';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = 'Open Sans Semibold';
	$column['column_1']['header_font_size'] = 22;
	$column['column_1']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_1']['price_font_family'] = "Arial";
	$column['column_1']['price_font_size'] = 40;
	$column['column_1']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_1']['price_label_style_bold'] = 'bold';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	$column['column_1']['price_text_font_family'] = 'Arial';
	$column['column_1']['price_text_font_size'] = 13;
	$column['column_1']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Arial';
	$column['column_1']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#7c7c7c';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Open Sans Bold";
	$column['column_1']['content_font_size'] = 15;
	$column['column_1']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Content Label Font Settings */
	$column['column_1']['content_label_font_family'] = 'Open Sans';
	$column['column_1']['content_label_font_size'] = 14;
	//$column['column_0']['content_label_font_style'] = 'bold';
	$column['column_1']['content_label_font_color'] = '#000000';
	$column['column_1']['body_label_style_bold'] = '';
	$column['column_1']['body_label_style_italic'] = '';
	$column['column_1']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Open Sans Bold";
	$column['column_1']['button_font_size'] = 18;
	$column['column_1']['button_font_color'] = "#323232";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_1']['button_style_bold'] = '';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	

	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>50";
	$column['column_1']['price_label'] = "per month";
	$column['column_1']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_8_2.png">';
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '25 GB';
	$column['column_1']['rows']['row_0']['row_label'] = 'Data Storage';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '10';
	$column['column_1']['rows']['row_1']['row_label'] = 'MySQL Databases';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = '10';
	$column['column_1']['rows']['row_2']['row_label'] = 'Email Accounts';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = '10';
	$column['column_1']['rows']['row_3']['row_label'] = 'Free Domain';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = 'No';
	$column['column_1']['rows']['row_4']['row_label'] = 'Online Support';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'Button';
	$column['column_1']['button_text'] = 'Submit';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Advanced Pro';
	$column['column_2']['column_description'] = '';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = 1;
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = 'Open Sans Semibold';
	$column['column_2']['header_font_size'] = 22;
	$column['column_2']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_2']['price_font_family'] = "Arial";
	$column['column_2']['price_font_size'] = 40;
	$column['column_2']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_2']['price_label_style_bold'] = 'bold';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Arial';
	$column['column_2']['price_text_font_size'] = 13;
	$column['column_2']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Arial';
	$column['column_2']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#7c7c7c';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Open Sans Bold";
	$column['column_2']['content_font_size'] = 15;
	$column['column_2']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Content Label Font Settings */
	$column['column_2']['content_label_font_family'] = 'Open Sans';
	$column['column_2']['content_label_font_size'] = 14;
	//$column['column_0']['content_label_font_style'] = 'bold';
	$column['column_2']['content_label_font_color'] = '#000000';
	$column['column_2']['body_label_style_bold'] = '';
	$column['column_2']['body_label_style_italic'] = '';
	$column['column_2']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Open Sans Bold";
	$column['column_2']['button_font_size'] = 18;
	$column['column_2']['button_font_color'] = "#323232";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_2']['button_style_bold'] = '';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_2']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_duration\">per month</span><span class=\"arp_price_value\"><span class='arp_currency'>$</span>69</span></div>";
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>69";
	$column['column_2']['price_label'] = "per month";
	$column['column_2']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_8_3.png">';
	$column['column_2']['body_text_alignment'] = 'center';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '50 GB';
	$column['column_2']['rows']['row_0']['row_label'] = 'Data Storage';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '30';
	$column['column_2']['rows']['row_1']['row_label'] = 'MySQL Databases';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = '20';
	$column['column_2']['rows']['row_2']['row_label'] = 'Email Accounts';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = '30';
	$column['column_2']['rows']['row_3']['row_label'] = 'Free Domain';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_2']['rows']['row_4']['row_label'] = 'Online Support';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Submit';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
	$column['column_2']['s_is_new_window'] = '';
    $column['column_2']['is_new_window'] = 0;	
	
	$column['column_3']['package_title'] = 'Ultimate Pro';
	$column['column_3']['column_description'] = '';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['column_align'] = 'left';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = 'Open Sans Semibold';
	$column['column_3']['header_font_size'] = 22;
	$column['column_3']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_3']['price_font_family'] = "Arial";
	$column['column_3']['price_font_size'] = 40;
	$column['column_3']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_3']['price_label_style_bold'] = 'bold';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Arial';
	$column['column_3']['price_text_font_size'] = 13;
	$column['column_3']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Arial';
	$column['column_3']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#7c7c7c';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Open Sans Bold";
	$column['column_3']['content_font_size'] = 15;
	$column['column_3']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Content Label Font Settings */
	$column['column_3']['content_label_font_family'] = 'Open Sans';
	$column['column_3']['content_label_font_size'] = 14;
	//$column['column_0']['content_label_font_style'] = 'bold';
	$column['column_3']['content_label_font_color'] = '#000000';
	$column['column_3']['body_label_style_bold'] = '';
	$column['column_3']['body_label_style_italic'] = '';
	$column['column_3']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Open Sans Bold";
	$column['column_3']['button_font_size'] = 18;
	$column['column_3']['button_font_color'] = "#323232";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_3']['button_style_bold'] = '';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_3']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_duration\">per month</span><span class=\"arp_price_value\"><span class='arp_currency'>$</span>99</span></div>";
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>99";
	$column['column_3']['price_label'] = "per month";
	$column['column_3']['arp_header_shortcode'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_8_4.png">';
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = 'Unlimited';
	$column['column_3']['rows']['row_0']['row_label'] = 'Data Storage';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = 'Unlimited Database';
	$column['column_3']['rows']['row_1']['row_label'] = 'MySQL Databases';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = '30';
	$column['column_3']['rows']['row_2']['row_label'] = 'Email Accounts';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = '30';
	$column['column_3']['rows']['row_3']['row_label'] = 'Free Domain';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_3']['rows']['row_4']['row_label'] = 'Online Support';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Submit';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;
		
	$pt_columns = array('columns'=>$column);
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	
	/* ARPrice Tempalte 9 */
	
	$values['name'] = 'ARPrice Template 9';
	$values['is_template'] = 1;
	$values['template_name'] = 9;
	$values['status'] = 'published';
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	
	$arp_price_font_settings = array();
	
	$arp_price_text_font_settings = array();
	
	$arp_content_font_settings = array();
	
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_9';
	$arp_pt_template_settings['skin']			= 'darkyellow';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style'=>'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>0);
		
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3","main_column_4"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_9';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'yes';
	$arp_pt_column_settings['column_space'] 		= '1';
	$arp_pt_column_settings['column_highlight_on_hover'] = 0;
	$arp_pt_column_settings['is_responsive'] 		= 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 130;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['hide_caption_colunmn'] = 0;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = 'arp_nav_style_1';
	$arp_pt_column_animation['pagination'] = 1;
	$arp_pt_column_animation['pagination_style'] = 'arp_paging_style_1';
	$arp_pt_column_animation['pagination_position'] = 'Top';
	$arp_pt_column_animation['easing_effect'] ='swing';
	$arp_pt_column_animation['infinite'] = 1;
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['background_color'];
	$arp_pt_tooltip_settings['text_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['text_color'];
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans Bold';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 16;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings, 'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
		
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
	
	$column['column_0']['package_title'] = '';
	$column['column_0']['column_description'] = '';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = 'Open Sans Bold';
	$column['column_0']['header_font_size'] = 23;
	//$column['column_0']['header_font_style'] = 'normal';
	$column['column_0']['header_font_color'] = '#333333';
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_0']['price_font_family'] = 'Arvo';
	$column['column_0']['price_font_size'] = 40;
	//$column['column_0']['price_font_style'] = 'bold';
	$column['column_0']['price_font_color'] = '#ffffff';
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_0']['price_text_font_family'] = 'Open Sans';
	$column['column_0']['price_text_font_size'] = 15;
	//$column['column_0']['price_text_font_style'] = 'normal';
	$column['column_0']['price_text_font_color'] = '#ffffff';
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = '';
	$column['column_0']['column_description_font_size'] = '';
	//$column['column_0']['column_description_font_style'] = '';
	$column['column_0']['column_description_font_color'] = '';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = 'Raleway';
	$column['column_0']['content_font_size'] = 15;
	//$column['column_0']['content_font_style'] = 'normal';
	$column['column_0']['content_font_color'] = '#7c7c7c';
	$column['column_0']['body_li_style_bold'] = 'bold';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_0']['button_font_family'] = 'Open Sans Bold';
	$column['column_0']['button_font_size'] = 17;
	//$column['column_0']['button_font_style'] = 'normal';
	$column['column_0']['button_font_color'] = '#ffffff';
	$column['column_0']['button_style_bold'] = '';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	$column['column_0']['is_caption'] = 1;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	$column['column_0']['html_content'] = "Hosting Plans";
	$column['column_0']['body_text_alignment'] = 'left';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_0']['row_description'] = 'Data Storage';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_1']['row_description'] = 'MySQL Databases';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_2']['row_description'] = 'Daily Backup';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_3']['row_description'] = 'Free Domains';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_4']['row_description'] = 'Online Support';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['button_size'] = '';
    $column['column_0']['button_type'] = '';
	$column['column_0']['button_text'] = '';
	$column['column_0']['button_url'] = '';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Basic';
	$column['column_1']['column_description'] = '';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = 'Open Sans Bold';
	$column['column_1']['header_font_size'] = 24;
	//$column['column_1']['header_font_style'] = 'normal';
	$column['column_1']['header_font_color'] = '#ffffff';
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = 'Arvo';
	$column['column_1']['price_font_size'] = 40;
	//$column['column_1']['price_font_style'] = 'bold';
	$column['column_1']['price_font_color'] = '#ffffff';
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_1']['price_text_font_family'] = 'Open Sans';
	$column['column_1']['price_text_font_size'] = 15;
	//$column['column_1']['price_text_font_style'] = 'normal';
	$column['column_1']['price_text_font_color'] = '#ffffff';
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = '';
	$column['column_1']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_1']['column_description_font_color'] = '';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = 'Raleway';
	$column['column_1']['content_font_size'] = 15;
	//$column['column_1']['content_font_style'] = 'normal';
	$column['column_1']['content_font_color'] = '#ffffff';
	$column['column_1']['body_li_style_bold'] = 'bold';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_1']['button_font_family'] = 'Open Sans Bold';
	$column['column_1']['button_font_size'] = 17;
	//$column['column_1']['button_font_style'] = 'normal';
	$column['column_1']['button_font_color'] = '#000000';
	$column['column_1']['button_style_bold'] = '';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	//$column['column_1']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>20";
	$column['column_1']['price_label'] = " per month";
	$column['column_1']['arp_header_shortcode'] = '';
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '20GB';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '15 Databases';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = 'No';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = '2 Domains';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = 'No';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'button';
	$column['column_1']['button_text'] = "<i class='fa fa-sign-in fa-lg'></i>&nbsp;Sign Up";
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Starter';
	$column['column_2']['column_description'] = '';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = 'Open Sans Bold';
	$column['column_2']['header_font_size'] = 26;
	//$column['column_1']['header_font_style'] = 'normal';
	$column['column_2']['header_font_color'] = '#ffffff';
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = 'Arvo';
	$column['column_2']['price_font_size'] = 40;
	//$column['column_1']['price_font_style'] = 'bold';
	$column['column_2']['price_font_color'] = '#ffffff';
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_2']['price_text_font_family'] = 'Open Sans';
	$column['column_2']['price_text_font_size'] = 15;
	//$column['column_1']['price_text_font_style'] = 'normal';
	$column['column_2']['price_text_font_color'] = '#ffffff';
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = '';
	$column['column_2']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_2']['column_description_font_color'] = '';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = 'Raleway';
	$column['column_2']['content_font_size'] = 15;
	//$column['column_1']['content_font_style'] = 'normal';
	$column['column_2']['content_font_color'] = '#ffffff';
	$column['column_2']['body_li_style_bold'] = 'bold';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_2']['button_font_family'] = 'Open Sans Bold';
	$column['column_2']['button_font_size'] = 17;
	//$column['column_1']['button_font_style'] = 'normal';
	$column['column_2']['button_font_color'] = '#000000';
	$column['column_2']['button_style_bold'] = '';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = '';
	//$column['column_2']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>50";
	$column['column_2']['price_label'] = "per month";
	$column['column_2']['arp_header_shortcode'] = '';
	$column['column_2']['body_text_alignment'] = 'center';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '80GB';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '100 Databases';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = 'No';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = '5 Domains';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = 'No';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'button';
	$column['column_2']['button_text'] = "<i class='fa fa-sign-in fa-lg'></i>&nbsp;Sign Up";
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
	$column['column_2']['s_is_new_window'] = '';
    $column['column_2']['is_new_window'] = 0;
	
	$column['column_3']['package_title'] = 'Gold';
	$column['column_3']['column_description'] = '';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = 'Open Sans Bold';
	$column['column_3']['header_font_size'] = 26;
	//$column['column_1']['header_font_style'] = 'normal';
	$column['column_3']['header_font_color'] = '#ffffff';
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = 'Arvo';
	$column['column_3']['price_font_size'] = 40;
	//$column['column_1']['price_font_style'] = 'bold';
	$column['column_3']['price_font_color'] = '#ffffff';
	$column['column_3']['price_label_style_bold'] = '';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_3']['price_text_font_family'] = 'Open Sans';
	$column['column_3']['price_text_font_size'] = 15;
	//$column['column_1']['price_text_font_style'] = 'normal';
	$column['column_3']['price_text_font_color'] = '#ffffff';
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = '';
	$column['column_3']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_3']['column_description_font_color'] = '';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = 'Raleway';
	$column['column_3']['content_font_size'] = 15;
	//$column['column_1']['content_font_style'] = 'normal';
	$column['column_3']['content_font_color'] = '#ffffff';
	$column['column_3']['body_li_style_bold'] = 'bold';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_3']['button_font_family'] = 'Open Sans Bold';
	$column['column_3']['button_font_size'] = 17;
	//$column['column_1']['button_font_style'] = 'normal';
	$column['column_3']['button_font_color'] = '#000000';
	$column['column_3']['button_style_bold'] = '';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	//$column['column_3']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>60";
	$column['column_3']['price_label'] = " per month";
	$column['column_3']['arp_header_shortcode'] = '';
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = '150GB';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = '150 Databases';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = 'Yes';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = '10 Domains';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'button';
	$column['column_3']['button_text'] = "<i class='fa fa-sign-in fa-lg'></i>&nbsp;Sign Up";
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
    $column['column_3']['is_new_window'] = 0;
	$column['column_3']['s_is_new_window'] = '';
	
	$column['column_4']['package_title'] = 'Platinum';
	$column['column_4']['column_description'] = '';
	$column['column_4']['custom_ribbon_txt'] = '';
	$column['column_4']['column_width'] = '';
	$column['column_4']['column_align'] = 'left';
	
	/* Header Font Settings */
	$column['column_4']['header_font_family'] = 'Open Sans Bold';
	$column['column_4']['header_font_size'] = 26;
	//$column['column_1']['header_font_style'] = 'normal';
	$column['column_4']['header_font_color'] = '#ffffff';
	$column['column_4']['header_style_bold'] = '';
	$column['column_4']['header_style_italic'] = '';
	$column['column_4']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_4']['price_font_family'] = 'Arvo';
	$column['column_4']['price_font_size'] = 40;
	//$column['column_1']['price_font_style'] = 'bold';
	$column['column_4']['price_font_color'] = '#ffffff';
	$column['column_4']['price_label_style_bold'] = '';
	$column['column_4']['price_label_style_italic'] = '';
	$column['column_4']['price_label_style_decoration'] = '';
	 
	
	/* Price Text Font Settings */
	$column['column_4']['price_text_font_family'] = 'Open Sans';
	$column['column_4']['price_text_font_size'] = 15;
	//$column['column_1']['price_text_font_style'] = 'normal';
	$column['column_4']['price_text_font_color'] = '#ffffff';
	$column['column_4']['price_text_style_bold'] = '';
	$column['column_4']['price_text_style_italic'] = '';
	$column['column_4']['price_text_style_decoration'] = '';
	/* Price Text Font Settings */
	
	/* Column Description Font Settings */
	$column['column_4']['column_description_font_family'] = '';
	$column['column_4']['column_description_font_size'] = '';
	//$column['column_1']['column_description_font_style'] = '';
	$column['column_4']['column_description_font_color'] = '';
	$column['column_4']['column_description_style_bold'] = '';
	$column['column_4']['column_description_style_italic'] = '';
	$column['column_4']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_4']['content_font_family'] = 'Raleway';
	$column['column_4']['content_font_size'] = 15;
	//$column['column_1']['content_font_style'] = 'normal';
	$column['column_4']['content_font_color'] = '#ffffff';
	$column['column_4']['body_li_style_bold'] = 'bold';
	$column['column_4']['body_li_style_italic'] = '';
	$column['column_4']['body_li_style_decoration'] = '';
	/* Content Font Settings*/
	
	/* Button Font Settings*/
	$column['column_4']['button_font_family'] = 'Open Sans Bold';
	$column['column_4']['button_font_size'] = 17;
	//$column['column_1']['button_font_style'] = 'normal';
	$column['column_4']['button_font_color'] = '#000000';
	$column['column_4']['button_style_bold'] = '';
	$column['column_4']['button_style_italic'] = '';
	$column['column_4']['button_style_decoration'] = '';
	/* Button Font Settings*/
	
	$column['column_4']['is_caption'] = 0;
	$column['column_4']['is_hidden'] = '';
	$column['column_4']['column_highlight'] = '';
	//$column['column_4']['html_content'] = "<div class=\"arp_price_wrapper\"></div>";
	$column['column_4']['price_text'] = "<span class='arp_currency'>$</span>99";
	$column['column_4']['price_label'] = "per month";
	$column['column_4']['arp_header_shortcode'] = '';
	$column['column_4']['body_text_alignment'] = 'center';
	$column['column_4']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_0']['row_description'] = 'Unlimited';
	$column['column_4']['rows']['row_0']['row_tooltip'] = '';
	$column['column_4']['rows']['row_0']['row_label'] = '';
	$column['column_4']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_1']['row_description'] = 'Unlimited Databases';
	$column['column_4']['rows']['row_1']['row_tooltip'] = '';
	$column['column_4']['rows']['row_1']['row_label'] = '';
	$column['column_4']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_2']['row_description'] = 'Yes';
	$column['column_4']['rows']['row_2']['row_tooltip'] = '';
	$column['column_4']['rows']['row_2']['row_label'] = '';
	$column['column_4']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_3']['row_description'] = '20 Domains';
	$column['column_4']['rows']['row_3']['row_tooltip'] = '';
	$column['column_4']['rows']['row_3']['row_label'] = '';
	$column['column_4']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_4']['rows']['row_4']['row_tooltip'] = '';
	$column['column_4']['rows']['row_4']['row_label'] = '';
	$column['column_4']['button_size'] = 'Medium';
    $column['column_4']['button_type'] = 'button';
	$column['column_4']['button_text'] = "<i class='fa fa-sign-in fa-lg'></i>&nbsp;Sign Up";
	$column['column_4']['button_url'] = '#';
	$column['column_4']['button_s_size'] = '';
	$column['column_4']['button_s_type'] = '';
	$column['column_4']['button_s_text'] = '';
	$column['column_4']['button_s_url'] = '';
	$column['column_4']['s_is_new_window'] = '';
    $column['column_4']['is_new_window'] = 0;
	
	$pt_columns = array('columns'=>$column);
	
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	
	/* ARPrice Template 10 */

	
	$values['name'] = 'ARPrice Template 10';
	$values['is_template'] = 1;
	$values['template_name'] = 10;
	$values['status'] = 'published';
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	$arp_price_font_settings = array();
	$arp_content_font_settings = array();
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_10';
	$arp_pt_template_settings['skin']			= 'red';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'position_3','caption_style'=>'style_2','amount_style'=>'default','list_alignment'=>'left','ribbon_type'=>'default','column_description_style' => 'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>0);
	
	
	
	
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_10';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'no';
	$arp_pt_column_settings['column_space'] = '';
	$arp_pt_column_settings['column_highlight_on_hover'] = 0;
	$arp_pt_column_settings['is_responsive'] = 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 150;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['hide_caption_column'] = 0;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'][0];
	$arp_pt_column_animation['pagination'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination'];
	$arp_pt_column_animation['pagination_style'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'][0];
	$arp_pt_column_animation['pagination_position'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_position'][0];
	$arp_pt_column_animation['easing_effect'] = $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'][0];
	$arp_pt_column_animation['infinite'] = $arp_mainoptionsarr['general_options']['column_animation']['infinite'];
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = '#FFFFFF';
	$arp_pt_tooltip_settings['text_color'] = '#000000';
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 14;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings,'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
	
	
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
	
	
	
	$column['column_0']['package_title'] = 'Basic Package';
	$column['column_0']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus.';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	//$column['column_1']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>19.55</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>19.55";
	$column['column_0']['price_label'] = "per month";
	$column['column_0']['arp_header_shortcode'] = '';
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = 'Roboto';
	$column['column_0']['header_font_size'] = 19;
	$column['column_0']['header_font_color'] = "#FFFFFF";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_0']['header_style_bold'] = 'bold';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_0']['price_font_family'] = "Roboto";
	$column['column_0']['price_font_size'] = 40;
	$column['column_0']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_0']['price_label_style_bold'] = 'bold';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Roboto';
	$column['column_0']['price_text_font_size'] = 14;
	$column['column_0']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Open Sans';
	$column['column_0']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#333333';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Roboto";
	$column['column_0']['content_font_size'] = 14;
	$column['column_0']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	
	$column['column_0']['content_label_font_family'] = 'Roboto';
	$column['column_0']['content_label_font_size'] = 14;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_0']['content_label_font_color'] = '#656565';
	$column['column_0']['body_label_style_bold'] = 'bold';
	$column['column_0']['body_label_style_italic'] = '';
	$column['column_0']['body_label_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Roboto";
	$column['column_0']['button_font_size'] = 19;
	$column['column_0']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_0']['button_style_bold'] = 'bold';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_0']['body_text_alignment'] = 'center';
	
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_0']['row_description'] = '10';
	$column['column_0']['rows']['row_0']['row_label'] = 'Domains';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_1']['row_description'] = '200MB';
	$column['column_0']['rows']['row_1']['row_label'] = 'Disk space';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_2']['row_description'] = '25GB';
	$column['column_0']['rows']['row_2']['row_label'] = 'Traffic';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_3']['row_description'] = 'PHP/MYSQL';
	$column['column_0']['rows']['row_3']['row_label'] = 'Database';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_4']['row_description'] = '10 email';
	$column['column_0']['rows']['row_4']['row_label'] = 'Accounts';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'Button';
	$column['column_0']['button_text'] = 'Buy';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = 'Medium';
	$column['column_0']['button_s_type'] = 'Button';
	$column['column_0']['button_s_text'] = 'More';
	$column['column_0']['button_s_url'] = '#';
	$column['column_0']['s_is_new_window'] = 1;
    $column['column_0']['is_new_window'] = 0;
	
	
	$column['column_1']['package_title'] = 'Basic Package';
	$column['column_1']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus.';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	//$column['column_1']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>19.55</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>19.55";
	$column['column_1']['price_label'] = "per month";
	$column['column_1']['arp_header_shortcode'] = '';
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = 'Roboto';
	$column['column_1']['header_font_size'] = 19;
	$column['column_1']['header_font_color'] = "#FFFFFF";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_1']['header_style_bold'] = 'bold';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = "Roboto";
	$column['column_1']['price_font_size'] = 40;
	$column['column_1']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_1']['price_label_style_bold'] = 'bold';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	$column['column_1']['price_text_font_family'] = 'Roboto';
	$column['column_1']['price_text_font_size'] = 14;
	$column['column_1']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Open Sans';
	$column['column_1']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#333333';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Roboto";
	$column['column_1']['content_font_size'] = 14;
	$column['column_1']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	
	$column['column_1']['content_label_font_family'] = 'Roboto';
	$column['column_1']['content_label_font_size'] = 14;
	//$column['column_1']['content_label_font_style'] = 'normal';
	$column['column_1']['content_label_font_color'] = '#656565';
	$column['column_1']['body_label_style_bold'] = 'bold';
	$column['column_1']['body_label_style_italic'] = '';
	$column['column_1']['body_label_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Roboto";
	$column['column_1']['button_font_size'] = 19;
	$column['column_1']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_1']['button_style_bold'] = 'bold';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '40';
	$column['column_1']['rows']['row_0']['row_label'] = 'Domains';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '350MB';
	$column['column_1']['rows']['row_1']['row_label'] = 'Disk space';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = '40GB';
	$column['column_1']['rows']['row_2']['row_label'] = 'Traffic';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = 'PHP/MYSQL';
	$column['column_1']['rows']['row_3']['row_label'] = 'Database';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = '50 email';
	$column['column_1']['rows']['row_4']['row_label'] = 'Accounts';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'Button';
	$column['column_1']['button_text'] = 'Buy';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = 'Medium';
	$column['column_1']['button_s_type'] = 'Button';
	$column['column_1']['button_s_text'] = 'More';
	$column['column_1']['button_s_url'] = '#';
	$column['column_1']['s_is_new_window'] = 0;
    $column['column_1']['is_new_window'] = 0;
	
	
	$column['column_2']['package_title'] = 'Standard Package';
	$column['column_2']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus.';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = '';
	//$column['column_2']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>29.99</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>29.55";
	$column['column_2']['price_label'] = "per month";
	$column['column_2']['arp_header_shortcode'] = '';
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = 'Roboto';
	$column['column_2']['header_font_size'] = 19;
	$column['column_2']['header_font_color'] = "#FFFFFF";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_2']['header_style_bold'] = 'bold';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_2']['price_font_family'] = "Roboto";
	$column['column_2']['price_font_size'] = 40;
	$column['column_2']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_2']['price_label_style_bold'] = 'bold';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Roboto';
	$column['column_2']['price_text_font_size'] = 14;
	$column['column_2']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Open Sans';
	$column['column_2']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#333333';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Roboto";
	$column['column_2']['content_font_size'] = 14;
	$column['column_2']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	
	$column['column_2']['content_label_font_family'] = 'Roboto';
	$column['column_2']['content_label_font_size'] = 14;
	//$column['column_1']['content_label_font_style'] = 'normal';
	$column['column_2']['content_label_font_color'] = '#656565';
	$column['column_2']['body_label_style_bold'] = 'bold';
	$column['column_2']['body_label_style_italic'] = '';
	$column['column_2']['body_label_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Roboto";
	$column['column_2']['button_font_size'] = 19;
	$column['column_2']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_2']['button_style_bold'] = 'bold';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_2']['body_text_alignment'] = 'center';
	
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '50';
	$column['column_2']['rows']['row_0']['row_label'] = 'Domains';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '500MB';
	$column['column_2']['rows']['row_1']['row_label'] = 'Disk space';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = '50GB';
	$column['column_2']['rows']['row_2']['row_label'] = 'Traffic';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = 'PHP/MYSQL';
	$column['column_2']['rows']['row_3']['row_label'] = 'Database';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = '75 email';
	$column['column_2']['rows']['row_4']['row_label'] = 'Accounts';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Buy';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = 'Medium';
	$column['column_2']['button_s_type'] = 'Button';
	$column['column_2']['button_s_text'] = 'More';
	$column['column_2']['button_s_url'] = '#';
	$column['column_2']['s_is_new_window'] = 0;
    $column['column_2']['is_new_window'] = 0;
	

	$column['column_3']['package_title'] = 'Premium Package';
	$column['column_3']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus.';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = 'Roboto';
	$column['column_3']['header_font_size'] = 19;
	$column['column_3']['header_font_color'] = "#FFFFFF";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_3']['header_style_bold'] = 'bold';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_3']['price_font_family'] = "Roboto";
	$column['column_3']['price_font_size'] = 40;
	$column['column_3']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_3']['price_label_style_bold'] = 'bold';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Roboto';
	$column['column_3']['price_text_font_size'] = 14;
	$column['column_3']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Open Sans';
	$column['column_3']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#333333';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Roboto";
	$column['column_3']['content_font_size'] = 14;
	$column['column_3']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	
	$column['column_3']['content_label_font_family'] = 'Roboto';
	$column['column_3']['content_label_font_size'] = 14;
	//$column['column_1']['content_label_font_style'] = 'normal';
	$column['column_3']['content_label_font_color'] = '#656565';
	$column['column_3']['body_label_style_bold'] = 'bold';
	$column['column_3']['body_label_style_italic'] = '';
	$column['column_3']['body_label_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Roboto";
	$column['column_3']['button_font_size'] = 19;
	$column['column_3']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_3']['button_style_bold'] = 'bold';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_3']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>39.55</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>39.55";
	$column['column_3']['price_label'] = "per month";
	$column['column_3']['arp_header_shortcode'] = '';
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = '75';
	$column['column_3']['rows']['row_0']['row_label'] = 'Domains';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = '750MB';
	$column['column_3']['rows']['row_1']['row_label'] = 'Disk space';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = '100GB';
	$column['column_3']['rows']['row_2']['row_label'] = 'Traffic';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = 'PHP/MYSQL';
	$column['column_3']['rows']['row_3']['row_label'] = 'Database';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = '100';
	$column['column_3']['rows']['row_4']['row_label'] = 'Accounts';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Buy';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = 'Medium';
	$column['column_3']['button_s_type'] = 'Button';
	$column['column_3']['button_s_text'] = 'More';
	$column['column_3']['button_s_url'] = '#';
	$column['column_3']['s_is_new_window'] = 0;
    $column['column_3']['is_new_window'] = 0;
	
	
	$column['column_4']['package_title'] = 'Ultimate Package';
	$column['column_4']['column_description'] = 'Aliquam euismod erat libero, eu condimentum nisl hendrerit vel. Ut sit amet congue lectus.';
	$column['column_4']['custom_ribbon_txt'] = '';
	$column['column_4']['column_width'] = '';
	$column['column_4']['is_caption'] = 0;
	$column['column_4']['is_hidden'] = '';
	$column['column_4']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_4']['header_font_family'] = 'Roboto';
	$column['column_4']['header_font_size'] = 19;
	$column['column_4']['header_font_color'] = "#FFFFFF";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_4']['header_style_bold'] = 'bold';
	$column['column_4']['header_style_italic'] = '';
	$column['column_4']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_4']['price_font_family'] = "Roboto";
	$column['column_4']['price_font_size'] = 40;
	$column['column_4']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_4']['price_label_style_bold'] = 'bold';
	$column['column_4']['price_label_style_italic'] = '';
	$column['column_4']['price_label_style_decoration'] = '';
	
	$column['column_4']['price_text_font_family'] = 'Roboto';
	$column['column_4']['price_text_font_size'] = 14;
	$column['column_4']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_4']['price_text_style_bold'] = '';
	$column['column_4']['price_text_style_italic'] = '';
	$column['column_4']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_4']['column_description_font_family'] = 'Open Sans';
	$column['column_4']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_4']['column_description_font_color'] = '#333333';
	$column['column_4']['column_description_style_bold'] = '';
	$column['column_4']['column_description_style_italic'] = '';
	$column['column_4']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_4']['content_font_family'] = "Roboto";
	$column['column_4']['content_font_size'] = 14;
	$column['column_4']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_4']['body_li_style_bold'] = '';
	$column['column_4']['body_li_style_italic'] = '';
	$column['column_4']['body_li_style_decoration'] = '';
	
	$column['column_4']['content_label_font_family'] = 'Roboto';
	$column['column_4']['content_label_font_size'] = 14;
	//$column['column_1']['content_label_font_style'] = 'normal';
	$column['column_4']['content_label_font_color'] = '#656565';
	$column['column_4']['body_label_style_bold'] = 'bold';
	$column['column_4']['body_label_style_italic'] = '';
	$column['column_4']['body_label_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Button Font Settings */
	$column['column_4']['button_font_family'] = "Roboto";
	$column['column_4']['button_font_size'] = 19;
	$column['column_4']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "bold";
	$column['column_4']['button_style_bold'] = 'bold';
	$column['column_4']['button_style_italic'] = '';
	$column['column_4']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_4']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>49.99</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_4']['price_text'] = "<span class='arp_currency'>$</span>49.55";
	$column['column_4']['price_label'] = "per month";
	$column['column_4']['arp_header_shortcode'] = '';
	$column['column_4']['body_text_alignment'] = 'center';
	
	$column['column_4']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_0']['row_description'] = '100';
	$column['column_4']['rows']['row_0']['row_label'] = 'Domains';
	$column['column_4']['rows']['row_0']['row_tooltip'] = '';
	$column['column_4']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_1']['row_description'] = '1GB';
	$column['column_4']['rows']['row_1']['row_label'] = 'Disk space';
	$column['column_4']['rows']['row_1']['row_tooltip'] = '';
	$column['column_4']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_2']['row_description'] = 'Unlimited';
	$column['column_4']['rows']['row_2']['row_label'] = 'Traffic';
	$column['column_4']['rows']['row_2']['row_tooltip'] = '';
	$column['column_4']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_3']['row_description'] = 'PHP/MYSQL';
	$column['column_4']['rows']['row_3']['row_label'] = 'Database';
	$column['column_4']['rows']['row_3']['row_tooltip'] = '';
	
	$column['column_4']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_4']['row_description'] = 'Unlimited';
	$column['column_4']['rows']['row_4']['row_label'] = 'Accounts';
	$column['column_4']['rows']['row_4']['row_tooltip'] = '';
	
	
	$column['column_4']['button_size'] = 'Medium';
    $column['column_4']['button_type'] = 'Button';
	$column['column_4']['button_text'] = 'Buy';
	$column['column_4']['button_url'] = '#';
	$column['column_4']['button_s_size'] = 'Medium';
	$column['column_4']['button_s_type'] = 'Button';
	$column['column_4']['button_s_text'] = 'More';
	$column['column_4']['button_s_url'] = '#';
	$column['column_4']['s_is_new_window'] = 0;
    $column['column_4']['is_new_window'] = 0;
	
	$pt_columns = array('columns'=>$column);
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	/* ARPrice Template 11 */

	
	$values['name'] = 'ARPrice Template 11';
	$values['is_template'] = 1;
	$values['template_name'] = 11;
	$values['status'] = 'published';
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	$arp_price_font_settings = array();
	$arp_content_font_settings = array();
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_11';
	$arp_pt_template_settings['skin']			= 'yellow';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'position_1','caption_style'=>'none','amount_style'=>'style_1','list_alignment'=>'default','ribbon_type'=>'default','column_description_style'=>'style_4','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>0);
	
	
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_11';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'no';
	$arp_pt_column_settings['column_space'] = '0';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] = 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 150;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'][0];
	$arp_pt_column_animation['pagination'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination'];
	$arp_pt_column_animation['pagination_style'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'][0];
	$arp_pt_column_animation['pagination_position'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_position'][0];
	$arp_pt_column_animation['easing_effect'] = $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'][0];
	$arp_pt_column_animation['infinite'] = $arp_mainoptionsarr['general_options']['column_animation']['infinite'];
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = '#FFFFFF';
	$arp_pt_tooltip_settings['text_color'] = '#000000';
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Roboto Condensed';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 14;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'bold';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings,'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
	
	
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
		
	$column['column_0']['package_title'] = 'Basic';
	$column['column_0']['column_description'] = 'Aliquam euisod erat libero condimentum nisl hendrerit.';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	//$column['column_0']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>10</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>10";
	$column['column_0']['price_label'] = "per month";
	$column['column_0']['arp_header_shortcode'] = '';
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = 'Roboto Condensed';
	$column['column_0']['header_font_size'] = 28;
	$column['column_0']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_0']['header_style_bold'] = 'bold';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_0']['price_font_family'] = "Roboto Condensed";
	$column['column_0']['price_font_size'] = 48;
	$column['column_0']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_0']['price_label_style_bold'] = 'bold';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Roboto Condensed';
	$column['column_0']['price_text_font_size'] = 18;
	$column['column_0']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Open Sans';
	$column['column_0']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#ffffff';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Roboto Condensed";
	$column['column_0']['content_font_size'] = 18;
	$column['column_0']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Roboto Condensed";
	$column['column_0']['button_font_size'] = 20;
	$column['column_0']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_0']['button_style_bold'] = 'bold';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */	
	
	$column['column_0']['body_text_alignment'] = 'left';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_0']['row_description'] = '<i class="fa fa-clock-o"></i> sit dolor lobortis';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_1']['row_description'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/icon2.png" /> Falli libris has id fa';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_2']['row_description'] = '<i class="fa fa-star"></i> pertinax vel eum';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_3']['row_description'] = '<i class="fa fa-heart"></i> taleni nolui gniferu';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'Button';
	$column['column_0']['button_text'] = 'Purchase';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;

	$column['column_1']['package_title'] = 'Personal';
	$column['column_1']['column_description'] = 'Aliquam euisod erat libero condimentum nisl hendrerit.';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = 'Roboto Condensed';
	$column['column_1']['header_font_size'] = 28;
	$column['column_1']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_1']['header_style_bold'] = 'bold';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_1']['price_font_family'] = "Roboto Condensed";
	$column['column_1']['price_font_size'] = 48;
	$column['column_1']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_1']['price_label_style_bold'] = 'bold';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	$column['column_1']['price_text_font_family'] = 'Roboto Condensed';
	$column['column_1']['price_text_font_size'] = 18;
	$column['column_1']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Open Sans';
	$column['column_1']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#ffffff';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Roboto Condensed";
	$column['column_1']['content_font_size'] = 18;
	$column['column_1']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Roboto Condensed";
	$column['column_1']['button_font_size'] = 20;
	$column['column_1']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_1']['button_style_bold'] = 'bold';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_1']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>20</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>20";
	$column['column_1']['price_label'] = "per month";
	$column['column_1']['arp_header_shortcode'] = '';
	$column['column_1']['body_text_alignment'] = 'left';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_0']['row_description'] = '<i class="fa fa-clock-o"></i> sit dolor logortis';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_1']['row_description'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/icon2.png" /> Falli libris has id fa';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_2']['row_description'] = '<i class="fa fa-star"></i> pertinax vel eum';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_1']['rows']['row_3']['row_description'] = '<i class="fa fa-heart"></i> taleni nolui gniferu';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'Button';
	$column['column_1']['button_text'] = 'Purchase';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Business';
	$column['column_2']['column_description'] = 'Aliquam euisod erat libero condimentum nisl hendrerit.';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = 1;
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = 'Roboto Condensed';
	$column['column_2']['header_font_size'] = 28;
	$column['column_2']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_2']['header_style_bold'] = 'bold';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_2']['price_font_family'] = "Roboto Condensed";
	$column['column_2']['price_font_size'] = 48;
	$column['column_2']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_2']['price_label_style_bold'] = 'bold';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Roboto Condensed';
	$column['column_2']['price_text_font_size'] = 18;
	$column['column_2']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Open Sans';
	$column['column_2']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#ffffff';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Roboto Condensed";
	$column['column_2']['content_font_size'] = 18;
	$column['column_2']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Roboto Condensed";
	$column['column_2']['button_font_size'] = 20;
	$column['column_2']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_2']['button_style_bold'] = 'bold';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_2']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>50</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>50";
	$column['column_2']['price_label'] = "per month";
	$column['column_2']['arp_header_shortcode'] = '';
	$column['column_2']['body_text_alignment'] = 'left';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_0']['row_description'] = '<i class="fa fa-clock-o"></i> sit dolor logortis';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_1']['row_description'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/icon2.png" /> Falli libris has id fa';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_2']['row_description'] = '<i class="fa fa-star"></i> pertinax vel eum';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_2']['rows']['row_3']['row_description'] = '<i class="fa fa-heart"></i> taleni nolui gniferu';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Purchase';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
	$column['column_2']['s_is_new_window'] = '';
    $column['column_2']['is_new_window'] = 0;
	
	$column['column_3']['package_title'] = 'Enterprise';
	$column['column_3']['column_description'] = 'Aliquam euisod erat libero condimentum nisl hendrerit.';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = 'Roboto Condensed';
	$column['column_3']['header_font_size'] = 28;
	$column['column_3']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_3']['header_style_bold'] = 'bold';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_3']['price_font_family'] = "Roboto Condensed";
	$column['column_3']['price_font_size'] = 48;
	$column['column_3']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_3']['price_label_style_bold'] = 'bold';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Roboto Condensed';
	$column['column_3']['price_text_font_size'] = 18;
	$column['column_3']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Open Sans';
	$column['column_3']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#ffffff';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Roboto Condensed";
	$column['column_3']['content_font_size'] = 18;
	$column['column_3']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Roboto Condensed";
	$column['column_3']['button_font_size'] = 20;
	$column['column_3']['button_font_color'] = "#ffffff";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_3']['button_style_bold'] = 'bold';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_3']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>69</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>69";
	$column['column_3']['price_label'] = "per month";
	$column['column_3']['arp_header_shortcode'] = '';
	$column['column_3']['body_text_alignment'] = 'left';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_0']['row_description'] = '<i class="fa fa-clock-o"></i> sit dolor logortis';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_1']['row_description'] = '<img src="'.PRICINGTABLE_IMAGES_URL.'/icon2.png" /> Falli libris has id fa';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_2']['row_description'] = '<i class="fa fa-star"></i> pertinax vel eum';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_3']['rows']['row_3']['row_description'] = '<i class="fa fa-heart"></i> taleni nolui gniferu';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Purchase';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;	
		
	$pt_columns = array('columns'=>$column);
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	
	/* ARPrice Template 12 */
	
	
	$values['name'] = 'ARPrice Template 12';
	$values['is_template'] = 1;
	$values['template_name'] = 12;
	$values['status'] = 'published';
	$values['is_animated'] = 0;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	$arp_price_font_settings = array();
	$arp_content_font_settings = array();
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_12';
	$arp_pt_template_settings['skin']			= 'blue';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'enable','custom_ribbon'=>'enable','button_position'=>'position_1','caption_style'=>'default','amount_style'=>'style_1','list_alignment'=>'default','ribbon_type'=>'custom_style_1','column_description_style' => 'style_2','caption_title'=>'style_1','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>0);
	
	
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_12';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'no';
	$arp_pt_column_settings['column_space'] = '0';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] = 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 215;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['hide_caption_column'] = 0;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'][0];
	$arp_pt_column_animation['pagination'] = 0;
	$arp_pt_column_animation['pagination_style'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'][0];
	$arp_pt_column_animation['pagination_position'] = $arp_mainoptionsarr['general_options']['column_animation']['pagination_position'][0];
	$arp_pt_column_animation['easing_effect'] = $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'][2];
	$arp_pt_column_animation['infinite'] = 0;
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	
	$arp_pt_tooltip_settings['background_color'] = '#000000';
	$arp_pt_tooltip_settings['text_color'] = '#FFFFFF';
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][3];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans Semibold';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 14;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings,'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
	
	
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
	
	$column['column_0']['package_title'] = '';
	$column['column_0']['column_description'] = '';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 1;
	$column['column_0']['is_hidden'] = 0;
	$column['column_0']['column_highlight'] = '';
	$column['column_0']['html_content'] = "Hosting Plans";
	
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = "Open Sans Bold";
	$column['column_0']['header_font_size'] = 22;
	$column['column_0']['header_font_color'] = "#666666";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_0']['header_style_bold'] = 'bold';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_0']['price_font_family'] = "Arial";
	$column['column_0']['price_font_size'] = 58;
	$column['column_0']['price_font_color'] = "#FFFFFF";
	//$column['column_0']['price_font_style'] = "bold";
	$column['column_0']['price_label_style_bold'] = 'bold';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Open Sans';
	$column['column_0']['price_text_font_size'] = 13;
	$column['column_0']['price_text_font_color'] = "#FFFFFF";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Open Sans';
	$column['column_0']['column_description_font_size'] = 10;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#ffffff';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Open Sans Semibold";
	$column['column_0']['content_font_size'] = 14;
	$column['column_0']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Open Sans Bold";
	$column['column_0']['button_font_size'] = 18;
	$column['column_0']['button_font_color'] = "#c27800";
	$column['column_0']['button_font_style'] = "bold";
	$column['column_0']['button_style_bold'] = 'bold';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_0']['body_text_alignment'] = 'left';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_0']['row_description'] = 'Data Storage';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_1']['row_description'] = 'MySQL Databases';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_2']['row_description'] = 'Email Accounts';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_3']['row_description'] = 'Free Domain';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_4']['row_description'] = 'Online Support';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['rows']['row_5']['row_des_txt_align'] = 'left';
	$column['column_0']['rows']['row_5']['row_description'] = 'Support Tickets';
	$column['column_0']['rows']['row_5']['row_label'] = '';
	$column['column_0']['rows']['row_5']['row_tooltip'] = '';
	$column['column_0']['button_size'] = '';
    $column['column_0']['button_type'] = '';
	$column['column_0']['button_text'] = '';
	$column['column_0']['button_url'] = '';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Basic Pro';
	$column['column_1']['column_description'] = "<div class='custom_ribbon'>Save $15</div><div>Nunc at diam ornare, pretium sapien</div>";
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = "Open Sans Bold";
	$column['column_1']['header_font_size'] = 19;
	$column['column_1']['header_font_color'] = "#ffffff";
	//$column['column_1']['header_font_style'] = "bold";
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = "Arial";
	$column['column_1']['price_font_size'] = 54;
	$column['column_1']['price_font_color'] = "#FFFFFF";
	//$column['column_1']['price_font_style'] = "bold";
	$column['column_1']['price_label_style_bold'] = 'bold';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	$column['column_1']['price_text_font_family'] = 'Open Sans';
	$column['column_1']['price_text_font_size'] = 13;
	$column['column_1']['price_text_font_color'] = "#FFFFFF";
	//$column['column_1']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Open Sans';
	$column['column_1']['column_description_font_size'] = 10;
	//$column['column_1']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#ffffff';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Open Sans Semibold";
	$column['column_1']['content_font_size'] = 14;
	$column['column_1']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Open Sans Bold";
	$column['column_1']['button_font_size'] = 18;
	$column['column_1']['button_font_color'] = "#c27800";
	//$column['column_1']['button_font_style'] = "bold";
	$column['column_1']['button_style_bold'] = 'bold';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_1']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>20</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>20";
	$column['column_1']['price_label'] = "per month";
	$column['column_1']['arp_header_shortcode'] = '';
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '10 GB';
	$column['column_1']['rows']['row_0']['row_tooltip'] = 'Every additional space of 1 GB costs $1.49';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '5 Databases';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = 'Every additional database costs $1.49';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = '5 Email Accounts';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = 'Every additional email account costs $1.99';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = '5 Free Domain';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = 'Every additional domain costs $1.49';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = 'No';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['rows']['row_5']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_5']['row_description'] = '2 tickets / month';
	$column['column_1']['rows']['row_5']['row_label'] = '';
	$column['column_1']['rows']['row_5']['row_tooltip'] = 'Every additional ticket costs $0.99';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'button';
	$column['column_1']['button_text'] = 'Signup';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Standard Pro';
	$column['column_2']['column_description'] = "<div class='custom_ribbon'>Save $35</div><div>Nunc at diam ornare, pretium sapien</div>";
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = 1;
	
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = "Open Sans Bold";
	$column['column_2']['header_font_size'] = 19;
	$column['column_2']['header_font_color'] = "#ffffff";
	//$column['column_1']['header_font_style'] = "bold";
	$column['column_2']['header_style_bold'] = 'bold';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = "Arial";
	$column['column_2']['price_font_size'] = 54;
	$column['column_2']['price_font_color'] = "#FFFFFF";
	//$column['column_1']['price_font_style'] = "bold";
	$column['column_2']['price_label_style_bold'] = 'bold';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Open Sans';
	$column['column_2']['price_text_font_size'] = 13;
	$column['column_2']['price_text_font_color'] = "#FFFFFF";
	//$column['column_1']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Open Sans';
	$column['column_2']['column_description_font_size'] = 10;
	//$column['column_1']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#ffffff';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Open Sans Semibold";
	$column['column_2']['content_font_size'] = 14;
	$column['column_2']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Open Sans Bold";
	$column['column_2']['button_font_size'] = 18;
	$column['column_2']['button_font_color'] = "#c27800";
	//$column['column_1']['button_font_style'] = "bold";
	$column['column_2']['button_style_bold'] = 'bold';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_2']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>50</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>50";
	$column['column_2']['price_label'] = "per month";
	$column['column_2']['arp_header_shortcode'] = '';
	$column['column_2']['body_text_alignment'] = 'center';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '25 GB';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_0']['row_tooltip'] = 'Every additional space of 1 GB costs $1.49';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '10 Databases';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = 'Every additional database costs $1.49';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = '10 Email Accounts';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = 'Every additional email account costs $1.99';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = '10 Domains';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = 'Every additional domain costs $1.49';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = 'No';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['rows']['row_5']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_5']['row_description'] = '5 tickets / month';
	$column['column_2']['rows']['row_5']['row_label'] = '';
	$column['column_2']['rows']['row_5']['row_tooltip'] = 'Every additional ticket costs $0.99';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'button';
	$column['column_2']['button_text'] = 'Signup';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
	$column['column_2']['s_is_new_window'] = '';
    $column['column_2']['is_new_window'] = 0;
	
	$column['column_3']['package_title'] = 'Advanced Pro';
	$column['column_3']['column_description'] = "<div class='custom_ribbon'>Save $45</div><div>Nunc at diam ornare, pretium sapien</div>";
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = "Open Sans Bold";
	$column['column_3']['header_font_size'] = 19;
	$column['column_3']['header_font_color'] = "#ffffff";
	//$column['column_1']['header_font_style'] = "bold";
	$column['column_3']['header_style_bold'] = 'bold';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = "Arial";
	$column['column_3']['price_font_size'] = 54;
	$column['column_3']['price_font_color'] = "#FFFFFF";
	//$column['column_1']['price_font_style'] = "bold";
	$column['column_3']['price_label_style_bold'] = 'bold';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Open Sans';
	$column['column_3']['price_text_font_size'] = 13;
	$column['column_3']['price_text_font_color'] = "#FFFFFF";
	//$column['column_1']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Open Sans';
	$column['column_3']['column_description_font_size'] = 10;
	//$column['column_1']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#ffffff';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Open Sans Semibold";
	$column['column_3']['content_font_size'] = 14;
	$column['column_3']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Open Sans Bold";
	$column['column_3']['button_font_size'] = 18;
	$column['column_3']['button_font_color'] = "#c27800";
	//$column['column_1']['button_font_style'] = "bold";
	$column['column_3']['button_style_bold'] = 'bold';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>69";
	$column['column_3']['price_label'] = "per month";
	$column['column_3']['arp_header_shortcode'] = '';
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = '50 GB';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_0']['row_tooltip'] = 'Every additional space of 1 GB costs $1.49';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = '30 Databases';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = 'Every additional database costs $1.49';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = '20 Email Accounts';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = 'Every additional email account costs $1.99';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = '30 Domains';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = 'Every additional domain costs $1.49';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['rows']['row_5']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_5']['row_description'] = '10 tickets / month';
	$column['column_3']['rows']['row_5']['row_label'] = '';
	$column['column_3']['rows']['row_5']['row_tooltip'] = 'Every additional ticket costs $0.99';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'button';
	$column['column_3']['button_text'] = 'Signup';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;	
	
	$column['column_4']['package_title'] = 'Ultimate Pro';
	$column['column_4']['column_description'] = "<div class='custom_ribbon'>Save $50</div>Nunc at diam ornare, pretium sapien";
	$column['column_4']['custom_ribbon_txt'] = '';
	$column['column_4']['column_width'] = '';
	$column['column_4']['column_align'] = 'left';
	$column['column_4']['is_caption'] = 0;
	$column['column_4']['is_hidden'] = '';
	$column['column_4']['column_highlight'] = '';
	/* Header Font Settings */
	$column['column_4']['header_font_family'] = "Open Sans Bold";
	$column['column_4']['header_font_size'] = 19;
	$column['column_4']['header_font_color'] = "#ffffff";
	//$column['column_1']['header_font_style'] = "bold";
	$column['column_4']['header_style_bold'] = 'bold';
	$column['column_4']['header_style_italic'] = '';
	$column['column_4']['header_style_decoration'] = '';
	/* Header Font Settings */
	 
	$column['column_4']['price_font_family'] = "Arial";
	$column['column_4']['price_font_size'] = 54;
	$column['column_4']['price_font_color'] = "#FFFFFF";
	//$column['column_1']['price_font_style'] = "bold";
	$column['column_4']['price_label_style_bold'] = 'bold';
	$column['column_4']['price_label_style_italic'] = '';
	$column['column_4']['price_label_style_decoration'] = '';

	$column['column_4']['price_text_font_family'] = 'Open Sans';
	$column['column_4']['price_text_font_size'] = 13;
	$column['column_4']['price_text_font_color'] = "#FFFFFF";
	//$column['column_1']['price_text_font_style'] = "normal";
	$column['column_4']['price_text_style_bold'] = '';
	$column['column_4']['price_text_style_italic'] = '';
	$column['column_4']['price_text_style_decoration'] = '';
	 
	/* Column Description Font Settings */
	$column['column_4']['column_description_font_family'] = 'Open Sans';
	$column['column_4']['column_description_font_size'] = 10;
	//$column['column_1']['column_description_font_style'] = 'normal';
	$column['column_4']['column_description_font_color'] = '#ffffff';
	$column['column_4']['column_description_style_bold'] = '';
	$column['column_4']['column_description_style_italic'] = '';
	$column['column_4']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	/* Content Font Settings */
	$column['column_4']['content_font_family'] = "Open Sans Semibold";
	$column['column_4']['content_font_size'] = 14;
	$column['column_4']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "normal";
	$column['column_4']['body_li_style_bold'] = '';
	$column['column_4']['body_li_style_italic'] = '';
	$column['column_4']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	/* Button Font Settings */
	$column['column_4']['button_font_family'] = "Open Sans Bold";
	$column['column_4']['button_font_size'] = 18;
	$column['column_4']['button_font_color'] = "#c27800";
	//$column['column_1']['button_font_style'] = "bold";
	$column['column_4']['button_style_bold'] = 'bold';
	$column['column_4']['button_style_italic'] = '';
	$column['column_4']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	//$column['column_4']['html_content'] = "<div class=\"arp_price_wrapper\"><span class=\"arp_price_value\"><span class='arp_currency'>$</span>99</span><span class=\"arp_price_duration\">per month</span></div>";
	$column['column_4']['price_text'] = "<span class='arp_currency'>$</span>99";
	$column['column_4']['price_label'] = "per month";
	$column['column_4']['arp_header_shortcode'] = '';
	$column['column_4']['body_text_alignment'] = 'center';
	$column['column_4']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_0']['row_description'] = 'Unlimited';
	$column['column_4']['rows']['row_0']['row_tooltip'] = 'Enjoy unlmited disk space';
	$column['column_4']['rows']['row_0']['row_label'] = '';
	$column['column_4']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_1']['row_description'] = 'Unlimited Database';
	$column['column_4']['rows']['row_1']['row_tooltip'] = 'Enjoy unlimited databases';
	$column['column_4']['rows']['row_1']['row_label'] = '';
	$column['column_4']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_2']['row_description'] = '30 Email accounts';
	$column['column_4']['rows']['row_2']['row_tooltip'] = 'Every additional email account costs $1.99';
	$column['column_4']['rows']['row_2']['row_label'] = '';
	$column['column_4']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_3']['row_description'] = '30 Free Domains';
	$column['column_4']['rows']['row_3']['row_tooltip'] = 'Every additional domain costs $1.49';
	$column['column_4']['rows']['row_3']['row_label'] = '';
	$column['column_4']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_4']['row_description'] = 'Yes';
	$column['column_4']['rows']['row_4']['row_tooltip'] = '';
	$column['column_4']['rows']['row_4']['row_label'] = '';
	$column['column_4']['rows']['row_5']['row_des_txt_align'] = 'center';
	$column['column_4']['rows']['row_5']['row_description'] = '30 tickets / month';
	$column['column_4']['rows']['row_5']['row_tooltip'] = 'Every additional ticket costs $0.99';
	$column['column_4']['rows']['row_5']['row_label'] = '';
	$column['column_4']['button_size'] = 'Medium';
    $column['column_4']['button_type'] = 'button';
	$column['column_4']['button_text'] = 'Signup';
	$column['column_4']['button_url'] = '#';
	$column['column_4']['button_s_size'] = '';
	$column['column_4']['button_s_type'] = '';
	$column['column_4']['button_s_text'] = '';
	$column['column_4']['button_s_url'] = '';
	$column['column_4']['s_is_new_window'] = '';
    $column['column_4']['is_new_window'] = 0;
		
	$pt_columns = array('columns'=>$column);
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	
	/* ARPrice Tempalte 13 */
	
	$values['name'] = 'ARPrice Template 13';
	$values['is_template'] = 1;
	$values['template_name'] = 13;
	$values['status'] = 'published';
	$values['is_animated'] = 1;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	
	$arp_price_font_settings = array();
	
	$arp_price_text_font_settings = array();
	
	$arp_content_font_settings = array();
	
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_13';
	$arp_pt_template_settings['skin']			= 'darkblue';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'style_2','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'after_button','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>1);
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_13';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'yes';
	$arp_pt_column_settings['column_space'] 		= '10';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] 		= 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 150;
	$arp_pt_column_settings['column_max_width'] = 275;
	$arp_pt_column_settings['hide_caption_colunmn'] = 0;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = 'arp_nav_style_1';
	$arp_pt_column_animation['pagination'] = 1;
	$arp_pt_column_animation['pagination_style'] = 'arp_paging_style_1';
	$arp_pt_column_animation['pagination_position'] = 'Top';
	$arp_pt_column_animation['easing_effect'] ='swing';
	$arp_pt_column_animation['infinite'] = 1;
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['background_color'];
	$arp_pt_tooltip_settings['text_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['text_color'];
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans Bold';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 16;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings, 'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
		
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
	
	$column['column_0']['package_title'] = 'Basic Package';
	$column['column_0']['column_description'] = 'Aliquam euismod erat conentum nisl hendreritvel. Devin euismod erat condimen.';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>16.55";
	$column['column_0']['price_label'] = "monthly";
	$column['column_0']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = "Open Sans Bold";
	$column['column_0']['header_font_size'] = 19;
	$column['column_0']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_0']['price_font_family'] = "Anton";
	$column['column_0']['price_font_size'] = 42;
	$column['column_0']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Open Sans';
	$column['column_0']['price_text_font_size'] = 16;
	$column['column_0']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_0']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#ffffff';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Open Sans Bold";
	$column['column_0']['content_font_size'] = 16;
	$column['column_0']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_0']['content_label_font_family'] = 'Open Sans';
	$column['column_0']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_0']['content_label_font_color'] = '#ffffff';
	$column['column_0']['body_label_style_bold'] = '';
	$column['column_0']['body_label_style_italic'] = '';
	$column['column_0']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Open Sans Bold";
	$column['column_0']['button_font_size'] = 17;
	$column['column_0']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_0']['button_style_bold'] = '';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
		
	$column['column_0']['body_text_alignment'] = 'center';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_0']['row_description'] = '2500 Contacts';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_1']['row_description'] = '8000 Email';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_2']['row_description'] = '20 Specialities';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_3']['row_description'] = '1 Assistance';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_4']['row_description'] = '10GB Bandwidth';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'button';
	$column['column_0']['button_text'] = 'Sign up Now';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Standard Package';
	$column['column_1']['column_description'] = 'Aliquam euismod erat conentum nisl hendreritvel. Devin euismod erat condimen.';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>26.55";
	$column['column_1']['price_label'] = "monthly";
	$column['column_1']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = "Open Sans Bold";
	$column['column_1']['header_font_size'] = 19;
	$column['column_1']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = "Anton";
	$column['column_1']['price_font_size'] = 42;
	$column['column_1']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	$column['column_1']['price_text_font_family'] = 'Open Sans';
	$column['column_1']['price_text_font_size'] = 16;
	$column['column_1']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_1']['column_description_font_size'] = 13;
	
	$column['column_1']['column_description_font_color'] = '#ffffff';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Open Sans Bold";
	$column['column_1']['content_font_size'] = 16;
	$column['column_1']['content_font_color'] = "#ffffff";
	
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_1']['content_label_font_family'] = 'Open Sans';
	$column['column_1']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_1']['content_label_font_color'] = '#ffffff';
	$column['column_1']['body_label_style_bold'] = '';
	$column['column_1']['body_label_style_italic'] = '';
	$column['column_1']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Open Sans Bold";
	$column['column_1']['button_font_size'] = 17;
	$column['column_1']['button_font_color'] = "#FFFFFF";
	
	$column['column_1']['button_style_bold'] = '';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '5000 Contacts';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '10000 Email';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = '30 Specialities';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = '2 Assistance';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = '20GB Bandwidth';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'button';
	$column['column_1']['button_text'] = 'Sign up Now';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Business Package';
	$column['column_2']['column_description'] = 'Aliquam euismod erat conentum nisl hendreritvel. Devin euismod erat condimen.';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = '';
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>36.55";
	$column['column_2']['price_label'] = "monthly";
	$column['column_2']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = "Open Sans Bold";
	$column['column_2']['header_font_size'] = 19;
	$column['column_2']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = "Anton";
	$column['column_2']['price_font_size'] = 42;
	$column['column_2']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Open Sans';
	$column['column_2']['price_text_font_size'] = 16;
	$column['column_2']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_2']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#ffffff';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Open Sans Bold";
	$column['column_2']['content_font_size'] = 16;
	$column['column_2']['content_font_color'] = "#ffffff";
	
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_2']['content_label_font_family'] = 'Open Sans';
	$column['column_2']['content_label_font_size'] = 16;
	
	$column['column_2']['content_label_font_color'] = '#ffffff';
	$column['column_2']['body_label_style_bold'] = '';
	$column['column_2']['body_label_style_italic'] = '';
	$column['column_2']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Open Sans Bold";
	$column['column_2']['button_font_size'] = 17;
	$column['column_2']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_2']['button_style_bold'] = '';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_2']['body_text_alignment'] = 'center';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '8000 Contacts';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '12000 Email';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = '50 Specialities';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = '5 Assistance';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = '50GB Bandwidth';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Sign up Now';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
    $column['column_2']['is_new_window'] = 0;
	$column['column_2']['s_is_new_window'] = '';
	
	
	$column['column_3']['package_title'] = 'Advanced Package';
	$column['column_3']['column_description'] = 'Aliquam euismod erat conentum nisl hendreritvel. Devin euismod erat condimen.';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>46.55";
	$column['column_3']['price_label'] = "monthly";
	$column['column_3']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = "Open Sans Bold";
	$column['column_3']['header_font_size'] = 19;
	$column['column_3']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "bold";
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = "Anton";
	$column['column_3']['price_font_size'] = 42;
	$column['column_3']['price_font_color'] = "#ffffff";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_3']['price_label_style_bold'] = '';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Open Sans';
	$column['column_3']['price_text_font_size'] = 16;
	$column['column_3']['price_text_font_color'] = "#ffffff";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_3']['column_description_font_size'] = 13;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#ffffff';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Open Sans Bold";
	$column['column_3']['content_font_size'] = 16;
	$column['column_3']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_3']['content_label_font_family'] = 'Open Sans';
	$column['column_3']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_3']['content_label_font_color'] = '#ffffff';
	$column['column_3']['body_label_style_bold'] = '';
	$column['column_3']['body_label_style_italic'] = '';
	$column['column_3']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Open Sans Bold";
	$column['column_3']['button_font_size'] = 17;
	$column['column_3']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_3']['button_style_bold'] = '';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = '10000 Contacts';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = '15000 Email';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = '100 Specialities';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = '10 Assistance';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = '100GB Bandwidth';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Sign up Now';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;
	
	$pt_columns = array('columns'=>$column);
	
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	
	/* ARPrice Tempalte 14 */
	
	$values['name'] = 'ARPrice Template 14';
	$values['is_template'] = 1;
	$values['template_name'] = 14;
	$values['status'] = 'published';
	$values['is_animated'] = 1;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	
	$arp_price_font_settings = array();
	
	$arp_price_text_font_settings = array();
	
	$arp_content_font_settings = array();
	
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_14';
	$arp_pt_template_settings['skin']			= 'orange';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'disable','custom_ribbon'=>'enable','button_position'=>'position_1','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'custom_style_2','column_description_style' => 'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>1);
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_14';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'yes';
	$arp_pt_column_settings['column_space'] 		= '10';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] 		= 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 150;
	$arp_pt_column_settings['column_max_width'] = 275;
	$arp_pt_column_settings['hide_caption_colunmn'] = 0;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = 'arp_nav_style_1';
	$arp_pt_column_animation['pagination'] = 1;
	$arp_pt_column_animation['pagination_style'] = 'arp_paging_style_1';
	$arp_pt_column_animation['pagination_position'] = 'Top';
	$arp_pt_column_animation['easing_effect'] ='swing';
	$arp_pt_column_animation['infinite'] = 1;
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['background_color'];
	$arp_pt_tooltip_settings['text_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['text_color'];
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans Bold';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 16;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings, 'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
		
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
	
	$column['column_0']['package_title'] = 'Basic Package';
	$column['column_0']['column_description'] = '';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>20";
	$column['column_0']['price_label'] = "monthly";
	$column['column_0']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = "Open Sans Bold";
	$column['column_0']['header_font_size'] = 19;
	$column['column_0']['header_font_color'] = "#000000";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_0']['price_font_family'] = "Francois One";
	$column['column_0']['price_font_size'] = 40;
	$column['column_0']['price_font_color'] = "#0058B3";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Open Sans Bold';
	$column['column_0']['price_text_font_size'] = 14;
	$column['column_0']['price_text_font_color'] = "#444444";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_0']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#ffffff';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Open Sans Bold";
	$column['column_0']['content_font_size'] = 14;
	$column['column_0']['content_font_color'] = "#333333";
	//$column['column_0']['content_font_style'] = "";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_0']['content_label_font_family'] = 'Open Sans';
	$column['column_0']['content_label_font_size'] = 14;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_0']['content_label_font_color'] = '#ffffff';
	$column['column_0']['body_label_style_bold'] = '';
	$column['column_0']['body_label_style_italic'] = '';
	$column['column_0']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Open Sans Bold";
	$column['column_0']['button_font_size'] = 20;
	$column['column_0']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_0']['button_style_bold'] = '';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
		
	$column['column_0']['body_text_alignment'] = 'center';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_0']['row_description'] = '2500 Contacts';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_1']['row_description'] = '8000 Email';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_2']['row_description'] = '20 Specialities';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_3']['row_description'] = '1 Assistance';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_4']['row_description'] = '10GB Bandwidth';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'button';
	$column['column_0']['button_text'] = 'Buy Now';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Standard Package';
	$column['column_1']['column_description'] = '';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>30";
	$column['column_1']['price_label'] = "monthly";
	$column['column_1']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = "Open Sans Bold";
	$column['column_1']['header_font_size'] = 19;
	$column['column_1']['header_font_color'] = "#000000";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = "Francois One";
	$column['column_1']['price_font_size'] = 40;
	$column['column_1']['price_font_color'] = "#0058B3";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	$column['column_1']['price_text_font_family'] = 'Open Sans Bold';
	$column['column_1']['price_text_font_size'] = 14;
	$column['column_1']['price_text_font_color'] = "#444444";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_1']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#ffffff';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Open Sans Bold";
	$column['column_1']['content_font_size'] = 14;
	$column['column_1']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_1']['content_label_font_family'] = 'Open Sans';
	$column['column_1']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_1']['content_label_font_color'] = '#ffffff';
	$column['column_1']['body_label_style_bold'] = '';
	$column['column_1']['body_label_style_italic'] = '';
	$column['column_1']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Open Sans Bold";
	$column['column_1']['button_font_size'] = 20;
	$column['column_1']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_1']['button_style_bold'] = '';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '5000 Contacts';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '10000 Email';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = '30 Specialities';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = '2 Assistance';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = '20GB Bandwidth';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'button';
	$column['column_1']['button_text'] = 'Buy Now';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Business Package';
	$column['column_2']['column_description'] = '';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = '';
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>50";
	$column['column_2']['price_label'] = "monthly";
	$column['column_2']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = "Open Sans Bold";
	$column['column_2']['header_font_size'] = 19;
	$column['column_2']['header_font_color'] = "#000000";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = "Francois One";
	$column['column_2']['price_font_size'] = 40;
	$column['column_2']['price_font_color'] = "#0058B3";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Open Sans Bold';
	$column['column_2']['price_text_font_size'] = 14;
	$column['column_2']['price_text_font_color'] = "#444444";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_2']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#ffffff';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Open Sans Bold";
	$column['column_2']['content_font_size'] = 14;
	$column['column_2']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_2']['content_label_font_family'] = 'Open Sans';
	$column['column_2']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_2']['content_label_font_color'] = '#ffffff';
	$column['column_2']['body_label_style_bold'] = '';
	$column['column_2']['body_label_style_italic'] = '';
	$column['column_2']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Open Sans Bold";
	$column['column_2']['button_font_size'] = 20;
	$column['column_2']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_2']['button_style_bold'] = '';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_2']['body_text_alignment'] = 'center';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '8000 Contacts';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '12000 Email';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = '50 Specialities';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = '5 Assistance';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = '50GB Bandwidth';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Buy Now';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
    $column['column_2']['is_new_window'] = 0;
	$column['column_2']['s_is_new_window'] = '';
	
	
	$column['column_3']['package_title'] = 'Advanced Package';
	$column['column_3']['column_description'] = '';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>90";
	$column['column_3']['price_label'] = "monthly";
	$column['column_3']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = "Open Sans Bold";
	$column['column_3']['header_font_size'] = 19;
	$column['column_3']['header_font_color'] = "#000000";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = "Francois One";
	$column['column_3']['price_font_size'] = 40;
	$column['column_3']['price_font_color'] = "#0058B3";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_3']['price_label_style_bold'] = '';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Open Sans Bold';
	$column['column_3']['price_text_font_size'] = 14;
	$column['column_3']['price_text_font_color'] = "#444444";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_3']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#ffffff';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Open Sans Bold";
	$column['column_3']['content_font_size'] = 14;
	$column['column_3']['content_font_color'] = "#333333";
	//$column['column_1']['content_font_style'] = "";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_3']['content_label_font_family'] = 'Open Sans';
	$column['column_3']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_3']['content_label_font_color'] = '#ffffff';
	$column['column_3']['body_label_style_bold'] = '';
	$column['column_3']['body_label_style_italic'] = '';
	$column['column_3']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Open Sans Bold";
	$column['column_3']['button_font_size'] = 20;
	$column['column_3']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_3']['button_style_bold'] = '';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = '10000 Contacts';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = '15000 Email';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = '100 Specialities';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = '10 Assistance';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = '100GB Bandwidth';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Buy Now';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;
	
	$pt_columns = array('columns'=>$column);
	
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
			
	/* ARPrice Tempalte 15 */
	
	$values['name'] = 'ARPrice Template 15';
	$values['is_template'] = 1;
	$values['template_name'] = 15;
	$values['status'] = 'published';
	$values['is_animated'] = 1;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	
	$arp_price_font_settings = array();
	
	$arp_price_text_font_settings = array();
	
	$arp_content_font_settings = array();
	
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_15';
	$arp_pt_template_settings['skin']			= 'yellow';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>1);
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_15';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'yes';
	$arp_pt_column_settings['column_space'] 		= '10';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] 		= 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 140;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['hide_caption_colunmn'] = 0;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = 'arp_nav_style_1';
	$arp_pt_column_animation['pagination'] = 1;
	$arp_pt_column_animation['pagination_style'] = 'arp_paging_style_1';
	$arp_pt_column_animation['pagination_position'] = 'Top';
	$arp_pt_column_animation['easing_effect'] ='swing';
	$arp_pt_column_animation['infinite'] = 1;
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['background_color'];
	$arp_pt_tooltip_settings['text_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['text_color'];
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans Bold';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 16;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings, 'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
		
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
	
	$column['column_0']['package_title'] = 'Basic Package';
	$column['column_0']['column_description'] = '';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>19";
	$column['column_0']['price_label'] = "monthly";
	$column['column_0']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = "Open Sans Bold";
	$column['column_0']['header_font_size'] = 22;
	$column['column_0']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_0']['price_font_family'] = "Open Sans Bold";
	$column['column_0']['price_font_size'] = 46;
	$column['column_0']['price_font_color'] = "#EAA700";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Open Sans';
	$column['column_0']['price_text_font_size'] = 14;
	$column['column_0']['price_text_font_color'] = "#333333";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_0']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#ffffff';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Open Sans Bold";
	$column['column_0']['content_font_size'] = 14;
	$column['column_0']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_0']['content_label_font_family'] = 'Open Sans';
	$column['column_0']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_0']['content_label_font_color'] = '#ffffff';
	$column['column_0']['body_label_style_bold'] = '';
	$column['column_0']['body_label_style_italic'] = '';
	$column['column_0']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Open Sans Bold";
	$column['column_0']['button_font_size'] = 20;
	$column['column_0']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_0']['button_style_bold'] = '';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_0']['body_text_alignment'] = 'left';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_0']['row_description'] = '2500 Contacts';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_1']['row_description'] = '8000 Email';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_2']['row_description'] = '20 Specialities';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_3']['row_description'] = '1 Assistance';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_4']['row_description'] = '10GB Bandwidth';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'button';
	$column['column_0']['button_text'] = 'Sign up';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Standard Package';
	$column['column_1']['column_description'] = '';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>30";
	$column['column_1']['price_label'] = "monthly";
	$column['column_1']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = "Open Sans Bold";
	$column['column_1']['header_font_size'] = 22;
	$column['column_1']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = "Open Sans Bold";
	$column['column_1']['price_font_size'] = 46;
	$column['column_1']['price_font_color'] = "#EAA700";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';
	
	$column['column_1']['price_text_font_family'] = 'Open Sans';
	$column['column_1']['price_text_font_size'] = 14;
	$column['column_1']['price_text_font_color'] = "#333333";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_1']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#ffffff';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Open Sans Bold";
	$column['column_1']['content_font_size'] = 14;
	$column['column_1']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_1']['content_label_font_family'] = 'Open Sans';
	$column['column_1']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_1']['content_label_font_color'] = '#ffffff';
	$column['column_1']['body_label_style_bold'] = '';
	$column['column_1']['body_label_style_italic'] = '';
	$column['column_1']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Open Sans Bold";
	$column['column_1']['button_font_size'] = 20;
	$column['column_1']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_1']['button_style_bold'] = '';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_1']['body_text_alignment'] = 'left';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '5000 Contacts';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '10000 Email';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = '30 Specialities';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = '2 Assistance';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = '20GB Bandwidth';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'button';
	$column['column_1']['button_text'] = 'Sign up';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Business Package';
	$column['column_2']['column_description'] = '';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = '';
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>50";
	$column['column_2']['price_label'] = "monthly";
	$column['column_2']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = "Open Sans Bold";
	$column['column_2']['header_font_size'] = 22;
	$column['column_2']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = "Open Sans Bold";
	$column['column_2']['price_font_size'] = 46;
	$column['column_2']['price_font_color'] = "#EAA700";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';
	
	$column['column_2']['price_text_font_family'] = 'Open Sans';
	$column['column_2']['price_text_font_size'] = 14;
	$column['column_2']['price_text_font_color'] = "#333333";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_2']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#ffffff';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Open Sans Bold";
	$column['column_2']['content_font_size'] = 14;
	$column['column_2']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_2']['content_label_font_family'] = 'Open Sans';
	$column['column_2']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_2']['content_label_font_color'] = '#ffffff';
	$column['column_2']['body_label_style_bold'] = '';
	$column['column_2']['body_label_style_italic'] = '';
	$column['column_2']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Open Sans Bold";
	$column['column_2']['button_font_size'] = 20;
	$column['column_2']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_2']['button_style_bold'] = '';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_2']['body_text_alignment'] = 'left';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '8000 Contacts';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '12000 Email';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = '50 Specialities';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = '5 Assistance';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = '50GB Bandwidth';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Sign up';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
    $column['column_2']['is_new_window'] = 0;
	$column['column_2']['s_is_new_window'] = '';
	
	
	$column['column_3']['package_title'] = 'Advanced Package';
	$column['column_3']['column_description'] = 'Aliquam euismod erat conentum nisl hendreritvel. Devin euismod erat condimen.';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>90";
	$column['column_3']['price_label'] = "monthly";
	$column['column_3']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = "Open Sans Bold";
	$column['column_3']['header_font_size'] = 22;
	$column['column_3']['header_font_color'] = "#ffffff";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = "Open Sans Bold";
	$column['column_3']['price_font_size'] = 46;
	$column['column_3']['price_font_color'] = "#EAA700";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_3']['price_label_style_bold'] = '';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';
	
	$column['column_3']['price_text_font_family'] = 'Open Sans';
	$column['column_3']['price_text_font_size'] = 14;
	$column['column_3']['price_text_font_color'] = "#333333";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Open Sans Semibold';
	$column['column_3']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#ffffff';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Open Sans Bold";
	$column['column_3']['content_font_size'] = 14;
	$column['column_3']['content_font_color'] = "#ffffff";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_3']['content_label_font_family'] = 'Open Sans';
	$column['column_3']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_3']['content_label_font_color'] = '#ffffff';
	$column['column_3']['body_label_style_bold'] = '';
	$column['column_3']['body_label_style_italic'] = '';
	$column['column_3']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Open Sans Bold";
	$column['column_3']['button_font_size'] = 20;
	$column['column_3']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_3']['button_style_bold'] = '';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_3']['body_text_alignment'] = 'left';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = '10000 Contacts';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = '15000 Email';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = '100 Specialities';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = '10 Assistance';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = '100GB Bandwidth';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Sign up';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;
	
	$pt_columns = array('columns'=>$column);
	
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
	
	
	/* ARPrice Tempalte 16 */
	
	$values['name'] = 'ARPrice Template 16';
	$values['is_template'] = 1;
	$values['template_name'] = 16;
	$values['status'] = 'published';
	$values['is_animated'] = 1;
	
	$arp_pt_gen_options = array();
	
	$arp_pt_template_settings = array();
	
	$arp_pt_font_settings = array();
	
	$arp_pt_general_settings = array();
	
	$arp_header_font_settings = array();
	
	$arp_price_font_settings = array();
	
	$arp_price_text_font_settings = array();
	
	$arp_content_font_settings = array();
	
	$arp_button_font_settings = array();
	
	$arp_pt_column_settings = array();
	
	$arp_pt_column_animation = array();
	
	$arp_pt_tooltip_settings = array();
	
	$arp_pt_button_settings = array();
	
	$arp_pt_template_settings['template']		= 'arptemplate_16';
	$arp_pt_template_settings['skin']			= 'orange';
	$arp_pt_template_settings['template_type']  = 'advanced';
	$arp_pt_template_settings['features']       = array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'style_1','caption_title'=>'style_1','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>1);
	
	$arp_pt_general_settings['column_order'] = '["main_column_0","main_column_1","main_column_2","main_column_3"]';
	$arp_pt_general_settings['reference_template'] = 'arptemplate_16';
	$arp_pt_general_settings['user_edited_columns'] = '';
	
	$arp_pt_button_settings['button_shadow_color'] = '#ffffff';
	$arp_pt_button_settings['button_radius'] = 0;
	
	$arp_pt_column_settings['space_between_column'] =  'yes';
	$arp_pt_column_settings['column_space'] 		= '10';
	$arp_pt_column_settings['column_highlight_on_hover'] = 1;
	$arp_pt_column_settings['is_responsive'] 		= 1;
	$arp_pt_column_settings['all_column_width'] = 250;
	$arp_pt_column_settings['column_min_width'] = 150;
	$arp_pt_column_settings['column_max_width'] = 270;
	$arp_pt_column_settings['hide_caption_colunmn'] = 0;
	$arp_pt_column_settings['column_opacity'] = $arp_mainoptionsarr['general_options']['column_opacity'][0]; 
	
	$arp_pt_column_animation['is_animation'] = 'no';
	$arp_pt_column_animation['visible_column'] = 2;
	$arp_pt_column_animation['scrolling_columns'] = 2;
	$arp_pt_column_animation['navigation'] = 1;
	$arp_pt_column_animation['autoplay'] = 1;
	$arp_pt_column_animation['sliding_effect'] = 'slide';
	$arp_pt_column_animation['transition_speed'] = 750;
	$arp_pt_column_animation['navigation_style'] = 'arp_nav_style_1';
	$arp_pt_column_animation['pagination'] = 1;
	$arp_pt_column_animation['pagination_style'] = 'arp_paging_style_1';
	$arp_pt_column_animation['pagination_position'] = 'Top';
	$arp_pt_column_animation['easing_effect'] ='swing';
	$arp_pt_column_animation['infinite'] = 1;
	/*$arp_pt_column_animation['hide_caption'] = 1;*/
	$arp_pt_column_animation['pagi_nav_btn'] = 'both';
	
	$arp_pt_tooltip_settings['background_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['background_color'];
	$arp_pt_tooltip_settings['text_color'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['text_color'];
	$arp_pt_tooltip_settings['animation'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'][0];
	$arp_pt_tooltip_settings['position'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['position'][0];
	$arp_pt_tooltip_settings['style'] = $arp_mainoptionsarr['general_options']['tooltipsetting']['style'][0];
	$arp_pt_tooltip_settings['tooltip_width'] = '';
	$arp_pt_tooltip_settings['tooltip_font_family'] = 'Open Sans Bold';
	$arp_pt_tooltip_settings['tooltip_font_size'] = 16;
	$arp_pt_tooltip_settings['tooltip_font_style'] = 'normal';
	
	$arp_pt_font_settings['header_fonts'] = $arp_header_font_settings;
	$arp_pt_font_settings['price_fonts'] = $arp_price_font_settings;
	$arp_pt_font_settings['price_text_fonts'] = $arp_price_text_font_settings;
	$arp_pt_font_settings['content_fonts'] = $arp_content_font_settings;
	$arp_pt_font_settings['button_fonts'] = $arp_button_font_settings;
	
	$arp_pt_gen_options = array('template_setting'=>$arp_pt_template_settings, 'font_settings'=>$arp_pt_font_settings,'column_settings'=>$arp_pt_column_settings,'column_animation'=>$arp_pt_column_animation,'tooltip_settings'=>$arp_pt_tooltip_settings,'general_settings'=>$arp_pt_general_settings,'button_settings'=>$arp_pt_button_settings);
	
	$values['options'] = maybe_serialize($arp_pt_gen_options);
		
	$table_id = $arprice_form->create($values);
	
	$pt_columns = array();
	
	$column = array();
	
	$column['column_0']['package_title'] = 'Basic Package';
	$column['column_0']['column_description'] = 'Taleni nolui gniferu';
	$column['column_0']['custom_ribbon_txt'] = '';
	$column['column_0']['column_width'] = '';
	$column['column_0']['is_caption'] = 0;
	$column['column_0']['is_hidden'] = '';
	$column['column_0']['column_highlight'] = '';
	$column['column_0']['price_text'] = "<span class='arp_currency'>$</span>20.00";
	$column['column_0']['price_label'] = "monthly";
	$column['column_0']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_0']['header_font_family'] = "Amaranth";
	$column['column_0']['header_font_size'] = 24;
	$column['column_0']['header_font_color'] = "#0B4A90";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_0']['header_style_bold'] = '';
	$column['column_0']['header_style_italic'] = '';
	$column['column_0']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_0']['price_font_family'] = "Fredoka One";
	$column['column_0']['price_font_size'] = 42;
	$column['column_0']['price_font_color'] = "#E9510E";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_0']['price_label_style_bold'] = '';
	$column['column_0']['price_label_style_italic'] = '';
	$column['column_0']['price_label_style_decoration'] = '';
	
	$column['column_0']['price_text_font_family'] = 'Amaranth';
	$column['column_0']['price_text_font_size'] = 16;
	$column['column_0']['price_text_font_color'] = "#E9510E";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_0']['price_text_style_bold'] = '';
	$column['column_0']['price_text_style_italic'] = '';
	$column['column_0']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_0']['column_description_font_family'] = 'Open Sans';
	$column['column_0']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_0']['column_description_font_color'] = '#28292A';
	$column['column_0']['column_description_style_bold'] = '';
	$column['column_0']['column_description_style_italic'] = '';
	$column['column_0']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_0']['content_font_family'] = "Open Sans Bold";
	$column['column_0']['content_font_size'] = 16;
	$column['column_0']['content_font_color'] = "#3E5D6C";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_0']['body_li_style_bold'] = '';
	$column['column_0']['body_li_style_italic'] = '';
	$column['column_0']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_0']['content_label_font_family'] = 'Open Sans';
	$column['column_0']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_0']['content_label_font_color'] = '#ffffff';
	$column['column_0']['body_label_style_bold'] = '';
	$column['column_0']['body_label_style_italic'] = '';
	$column['column_0']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_0']['button_font_family'] = "Amaranth";
	$column['column_0']['button_font_size'] = 20;
	$column['column_0']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_0']['button_style_bold'] = '';
	$column['column_0']['button_style_italic'] = '';
	$column['column_0']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_0']['body_text_alignment'] = 'center';
	$column['column_0']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_0']['row_description'] = '2500 Contacts';
	$column['column_0']['rows']['row_0']['row_label'] = '';
	$column['column_0']['rows']['row_0']['row_tooltip'] = '';
	$column['column_0']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_1']['row_description'] = '8000 Email';
	$column['column_0']['rows']['row_1']['row_label'] = '';
	$column['column_0']['rows']['row_1']['row_tooltip'] = '';
	$column['column_0']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_2']['row_description'] = '20 Specialities';
	$column['column_0']['rows']['row_2']['row_label'] = '';
	$column['column_0']['rows']['row_2']['row_tooltip'] = '';
	$column['column_0']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_3']['row_description'] = '1 Assistance';
	$column['column_0']['rows']['row_3']['row_label'] = '';
	$column['column_0']['rows']['row_3']['row_tooltip'] = '';
	$column['column_0']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_0']['rows']['row_4']['row_description'] = '10GB Bandwidth';
	$column['column_0']['rows']['row_4']['row_label'] = '';
	$column['column_0']['rows']['row_4']['row_tooltip'] = '';
	$column['column_0']['button_size'] = 'Medium';
    $column['column_0']['button_type'] = 'button';
	$column['column_0']['button_text'] = 'Buy Now';
	$column['column_0']['button_url'] = '#';
	$column['column_0']['button_s_size'] = '';
	$column['column_0']['button_s_type'] = '';
	$column['column_0']['button_s_text'] = '';
	$column['column_0']['button_s_url'] = '';
	$column['column_0']['s_is_new_window'] = '';
    $column['column_0']['is_new_window'] = 0;
	
	$column['column_1']['package_title'] = 'Standard Package';
	$column['column_1']['column_description'] = 'Taleni nolui gniferu';
	$column['column_1']['custom_ribbon_txt'] = '';
	$column['column_1']['column_width'] = '';
	$column['column_1']['is_caption'] = 0;
	$column['column_1']['is_hidden'] = '';
	$column['column_1']['column_highlight'] = '';
	$column['column_1']['price_text'] = "<span class='arp_currency'>$</span>30.00";
	$column['column_1']['price_label'] = "monthly";
	$column['column_1']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_1']['header_font_family'] = "Amaranth";
	$column['column_1']['header_font_size'] = 24;
	$column['column_1']['header_font_color'] = "#0B4A90";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_1']['header_style_bold'] = '';
	$column['column_1']['header_style_italic'] = '';
	$column['column_1']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_1']['price_font_family'] = "Fredoka One";
	$column['column_1']['price_font_size'] = 42;
	$column['column_1']['price_font_color'] = "#E9510E";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_1']['price_label_style_bold'] = '';
	$column['column_1']['price_label_style_italic'] = '';
	$column['column_1']['price_label_style_decoration'] = '';

	$column['column_1']['price_text_font_family'] = 'Amaranth';
	$column['column_1']['price_text_font_size'] = 16;
	$column['column_1']['price_text_font_color'] = "#E9510E";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_1']['price_text_style_bold'] = '';
	$column['column_1']['price_text_style_italic'] = '';
	$column['column_1']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_1']['column_description_font_family'] = 'Open Sans';
	$column['column_1']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_1']['column_description_font_color'] = '#28292A';
	$column['column_1']['column_description_style_bold'] = '';
	$column['column_1']['column_description_style_italic'] = '';
	$column['column_1']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_1']['content_font_family'] = "Open Sans Bold";
	$column['column_1']['content_font_size'] = 16;
	$column['column_1']['content_font_color'] = "#3E5D6C";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_1']['body_li_style_bold'] = '';
	$column['column_1']['body_li_style_italic'] = '';
	$column['column_1']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_1']['content_label_font_family'] = 'Open Sans';
	$column['column_1']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_1']['content_label_font_color'] = '#ffffff';
	$column['column_1']['body_label_style_bold'] = '';
	$column['column_1']['body_label_style_italic'] = '';
	$column['column_1']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_1']['button_font_family'] = "Amaranth";
	$column['column_1']['button_font_size'] = 20;
	$column['column_1']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_1']['button_style_bold'] = '';
	$column['column_1']['button_style_italic'] = '';
	$column['column_1']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_1']['body_text_alignment'] = 'center';
	$column['column_1']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_0']['row_description'] = '5000 Contacts';
	$column['column_1']['rows']['row_0']['row_label'] = '';
	$column['column_1']['rows']['row_0']['row_tooltip'] = '';
	$column['column_1']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_1']['row_description'] = '10000 Email';
	$column['column_1']['rows']['row_1']['row_label'] = '';
	$column['column_1']['rows']['row_1']['row_tooltip'] = '';
	$column['column_1']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_2']['row_description'] = '30 Specialities';
	$column['column_1']['rows']['row_2']['row_label'] = '';
	$column['column_1']['rows']['row_2']['row_tooltip'] = '';
	$column['column_1']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_3']['row_description'] = '2 Assistance';
	$column['column_1']['rows']['row_3']['row_label'] = '';
	$column['column_1']['rows']['row_3']['row_tooltip'] = '';
	$column['column_1']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_1']['rows']['row_4']['row_description'] = '20GB Bandwidth';
	$column['column_1']['rows']['row_4']['row_label'] = '';
	$column['column_1']['rows']['row_4']['row_tooltip'] = '';
	$column['column_1']['button_size'] = 'Medium';
    $column['column_1']['button_type'] = 'button';
	$column['column_1']['button_text'] = 'Buy Now';
	$column['column_1']['button_url'] = '#';
	$column['column_1']['button_s_size'] = '';
	$column['column_1']['button_s_type'] = '';
	$column['column_1']['button_s_text'] = '';
	$column['column_1']['button_s_url'] = '';
	$column['column_1']['s_is_new_window'] = '';
    $column['column_1']['is_new_window'] = 0;
	
	$column['column_2']['package_title'] = 'Business Package';
	$column['column_2']['column_description'] = 'Taleni nolui gniferu';
	$column['column_2']['custom_ribbon_txt'] = '';
	$column['column_2']['column_width'] = '';
	$column['column_2']['is_caption'] = 0;
	$column['column_2']['is_hidden'] = '';
	$column['column_2']['column_highlight'] = '';
	$column['column_2']['price_text'] = "<span class='arp_currency'>$</span>50.00";
	$column['column_2']['price_label'] = "monthly";
	$column['column_2']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_2']['header_font_family'] = "Amaranth";
	$column['column_2']['header_font_size'] = 24;
	$column['column_2']['header_font_color'] = "#0B4A90";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_2']['header_style_bold'] = '';
	$column['column_2']['header_style_italic'] = '';
	$column['column_2']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_2']['price_font_family'] = "Fredoka One";
	$column['column_2']['price_font_size'] = 42;
	$column['column_2']['price_font_color'] = "#E9510E";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_2']['price_label_style_bold'] = '';
	$column['column_2']['price_label_style_italic'] = '';
	$column['column_2']['price_label_style_decoration'] = '';

	$column['column_2']['price_text_font_family'] = 'Amaranth';
	$column['column_2']['price_text_font_size'] = 16;
	$column['column_2']['price_text_font_color'] = "#E9510E";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_2']['price_text_style_bold'] = '';
	$column['column_2']['price_text_style_italic'] = '';
	$column['column_2']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_2']['column_description_font_family'] = 'Open Sans';
	$column['column_2']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_2']['column_description_font_color'] = '#28292A';
	$column['column_2']['column_description_style_bold'] = '';
	$column['column_2']['column_description_style_italic'] = '';
	$column['column_2']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */
	
	/* Content Font Settings */
	$column['column_2']['content_font_family'] = "Open Sans Bold";
	$column['column_2']['content_font_size'] = 16;
	$column['column_2']['content_font_color'] = "#3E5D6C";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_2']['body_li_style_bold'] = '';
	$column['column_2']['body_li_style_italic'] = '';
	$column['column_2']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_2']['content_label_font_family'] = 'Open Sans';
	$column['column_2']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_2']['content_label_font_color'] = '#ffffff';
	$column['column_2']['body_label_style_bold'] = '';
	$column['column_2']['body_label_style_italic'] = '';
	$column['column_2']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_2']['button_font_family'] = "Amaranth";
	$column['column_2']['button_font_size'] = 20;
	$column['column_2']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_2']['button_style_bold'] = '';
	$column['column_2']['button_style_italic'] = '';
	$column['column_2']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_2']['body_text_alignment'] = 'center';
	$column['column_2']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_0']['row_description'] = '8000 Contacts';
	$column['column_2']['rows']['row_0']['row_label'] = '';
	$column['column_2']['rows']['row_0']['row_tooltip'] = '';
	$column['column_2']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_1']['row_description'] = '12000 Email';
	$column['column_2']['rows']['row_1']['row_label'] = '';
	$column['column_2']['rows']['row_1']['row_tooltip'] = '';
	$column['column_2']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_2']['row_description'] = '50 Specialities';
	$column['column_2']['rows']['row_2']['row_label'] = '';
	$column['column_2']['rows']['row_2']['row_tooltip'] = '';
	$column['column_2']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_3']['row_description'] = '5 Assistance';
	$column['column_2']['rows']['row_3']['row_label'] = '';
	$column['column_2']['rows']['row_3']['row_tooltip'] = '';
	$column['column_2']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_2']['rows']['row_4']['row_description'] = '50GB Bandwidth';
	$column['column_2']['rows']['row_4']['row_label'] = '';
	$column['column_2']['rows']['row_4']['row_tooltip'] = '';
	$column['column_2']['button_size'] = 'Medium';
    $column['column_2']['button_type'] = 'Button';
	$column['column_2']['button_text'] = 'Buy Now';
	$column['column_2']['button_url'] = '#';
	$column['column_2']['button_s_size'] = '';
	$column['column_2']['button_s_type'] = '';
	$column['column_2']['button_s_text'] = '';
	$column['column_2']['button_s_url'] = '';
    $column['column_2']['is_new_window'] = 0;
	$column['column_2']['s_is_new_window'] = '';
	
	
	$column['column_3']['package_title'] = 'Advanced Package';
	$column['column_3']['column_description'] = 'Taleni nolui gniferu';
	$column['column_3']['custom_ribbon_txt'] = '';
	$column['column_3']['column_width'] = '';
	$column['column_3']['is_caption'] = 0;
	$column['column_3']['is_hidden'] = '';
	$column['column_3']['column_highlight'] = '';
	$column['column_3']['price_text'] = "<span class='arp_currency'>$</span>90.00";
	$column['column_3']['price_label'] = "monthly";
	$column['column_3']['arp_header_shortcode'] = '';
	
	/* Header Font Settings */
	$column['column_3']['header_font_family'] = "Amaranth";
	$column['column_3']['header_font_size'] = 24;
	$column['column_3']['header_font_color'] = "#0B4A90";
	//$column['column_0']['header_font_style'] = "normal";
	$column['column_3']['header_style_bold'] = '';
	$column['column_3']['header_style_italic'] = '';
	$column['column_3']['header_style_decoration'] = '';
	/* Header Font Settings */
	
	 
	$column['column_3']['price_font_family'] = "Fredoka One";
	$column['column_3']['price_font_size'] = 42;
	$column['column_3']['price_font_color'] = "#E9510E";
	//$column['column_0']['price_font_style'] = "normal";
	$column['column_3']['price_label_style_bold'] = '';
	$column['column_3']['price_label_style_italic'] = '';
	$column['column_3']['price_label_style_decoration'] = '';

	$column['column_3']['price_text_font_family'] = 'Amaranth';
	$column['column_3']['price_text_font_size'] = 16;
	$column['column_3']['price_text_font_color'] = "#E9510E";
	//$column['column_0']['price_text_font_style'] = "normal";
	$column['column_3']['price_text_style_bold'] = '';
	$column['column_3']['price_text_style_italic'] = '';
	$column['column_3']['price_text_style_decoration'] = '';
	 
	
	/* Column Description Font Settings */
	$column['column_3']['column_description_font_family'] = 'Open Sans';
	$column['column_3']['column_description_font_size'] = 14;
	//$column['column_0']['column_description_font_style'] = 'normal';
	$column['column_3']['column_description_font_color'] = '#28292A';
	$column['column_3']['column_description_style_bold'] = '';
	$column['column_3']['column_description_style_italic'] = '';
	$column['column_3']['column_description_style_decoration'] = '';
	/* Column Description Font Settings */

	/* Content Font Settings */
	$column['column_3']['content_font_family'] = "Open Sans Bold";
	$column['column_3']['content_font_size'] = 16;
	$column['column_3']['content_font_color'] = "#3E5D6C";
	//$column['column_0']['content_font_style'] = "normal";
	$column['column_3']['body_li_style_bold'] = '';
	$column['column_3']['body_li_style_italic'] = '';
	$column['column_3']['body_li_style_decoration'] = '';
	/* Content Font Settings */
	
	/* Content Label Font Settings */
	$column['column_3']['content_label_font_family'] = 'Open Sans';
	$column['column_3']['content_label_font_size'] = 16;
	//$column['column_0']['content_label_font_style'] = 'normal';
	$column['column_3']['content_label_font_color'] = '#ffffff';
	$column['column_3']['body_label_style_bold'] = '';
	$column['column_3']['body_label_style_italic'] = '';
	$column['column_3']['body_label_style_decoration'] = '';
	/* Content Label Font Settings */
	
	/* Button Font Settings */
	$column['column_3']['button_font_family'] = "Amaranth";
	$column['column_3']['button_font_size'] = 20;
	$column['column_3']['button_font_color'] = "#FFFFFF";
	//$column['column_0']['button_font_style'] = "normal";
	$column['column_3']['button_style_bold'] = '';
	$column['column_3']['button_style_italic'] = '';
	$column['column_3']['button_style_decoration'] = '';
	/* Button Font Settings */
	
	$column['column_3']['body_text_alignment'] = 'center';
	$column['column_3']['rows']['row_0']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_0']['row_description'] = '10000 Contacts';
	$column['column_3']['rows']['row_0']['row_label'] = '';
	$column['column_3']['rows']['row_0']['row_tooltip'] = '';
	$column['column_3']['rows']['row_1']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_1']['row_description'] = '15000 Email';
	$column['column_3']['rows']['row_1']['row_label'] = '';
	$column['column_3']['rows']['row_1']['row_tooltip'] = '';
	$column['column_3']['rows']['row_2']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_2']['row_description'] = '100 Specialities';
	$column['column_3']['rows']['row_2']['row_label'] = '';
	$column['column_3']['rows']['row_2']['row_tooltip'] = '';
	$column['column_3']['rows']['row_3']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_3']['row_description'] = '10 Assistance';
	$column['column_3']['rows']['row_3']['row_label'] = '';
	$column['column_3']['rows']['row_3']['row_tooltip'] = '';
	$column['column_3']['rows']['row_4']['row_des_txt_align'] = 'center';
	$column['column_3']['rows']['row_4']['row_description'] = '100GB Bandwidth';
	$column['column_3']['rows']['row_4']['row_label'] = '';
	$column['column_3']['rows']['row_4']['row_tooltip'] = '';
	$column['column_3']['button_size'] = 'Medium';
    $column['column_3']['button_type'] = 'Button';
	$column['column_3']['button_text'] = 'Buy Now';
	$column['column_3']['button_url'] = '#';
	$column['column_3']['button_s_size'] = '';
	$column['column_3']['button_s_type'] = '';
	$column['column_3']['button_s_text'] = '';
	$column['column_3']['button_s_url'] = '';
	$column['column_3']['s_is_new_window'] = '';
    $column['column_3']['is_new_window'] = 0;
	
	$pt_columns = array('columns'=>$column);
	
	$opts = maybe_serialize($pt_columns);
	
	$arprice_form->option_create($table_id,$opts);
	
	unset($values);
?>