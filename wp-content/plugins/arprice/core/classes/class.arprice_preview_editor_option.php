<?php
	global $arprice_form;
	
			$tablestring .= "<div class='column_level_settings' id='column_level_settings_new' data-column='main_".$j."'>";
				$tablestring .= "<div class='btn-main'>";
					
					 
					$tablestring .= "<div class='btn' id='column_level_options__button_1' data-level='column_level_options' style='display:none;' title='".__('Column Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/general-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='column_level_options__button_2' data-level='column_level_options' style='display:none;' title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' ><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-setting-icon.png'></div>";
					
					$tablestring .= "<div class='btn action_btn' col-id=".$col_no[1]." data-level='column_level_options' id='duplicate_column' style='display:none;' title='".__('Duplicate Column',ARP_PT_TXTDOMAIN)."' data-title='".__('Duplicate Column',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/duplicate-icon2.png' ></div>";
					$tablestring .= "<div class='btn action_btn' col-id=".$col_no[1]." data-level='column_level_options' id='delete_column' style='display:none;' title='".__('Delete Column',ARP_PT_TXTDOMAIN)."' data-title='".__('Delete Column',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/delete-icon2.png' ></div>";
					
					
			 
					$tablestring .= "<div class='btn' id='header_level_options__button_1' data-level='header_level_options' title='".__('Header Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Header Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='header_level_options__button_2' data-level='header_level_options' title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='header_level_options__button_3' data-level='header_level_options' title='".__('Media Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Media Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/shortcode-setting-icon.png'></div>";
					
					
					 
					$tablestring .= "<div class='btn' id='pricing_level_options__button_1' data-level='pricing_level_options' title='".__('Price Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Price Settings',ARP_PT_TXTDOMAIN)."'  style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='pricing_level_options__button_2' data-level='pricing_level_options' title='".__('Price Interval Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Price Interval Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='pricing_level_options__button_3' data-level='pricing_level_options' title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-icon3.png'></div>";
					
					// Body Level Options
					$tablestring .= "<div class='btn' id='body_level_options__button_1' data-level='body_level_options' title='".__('Content Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Content Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='body_level_options__button_2' data-level='body_level_options' title='".__('Content Label Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Content Label Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-lable-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='body_level_options__button_3' data-level='body_level_options' title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Description Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-setting-icon.png'></div>";
					
					
					
					
					
					$tablestring .= "<div class='btn' id='body_li_level_options__button_1' data-level='body_li_level_options' title='".__('Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Description Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='body_li_level_options__button_2' data-level='body_li_level_options' title='".__('Tooltip Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Tooltip Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/tooltip-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='body_li_level_options__button_3' data-level='body_li_level_options' title='".__('Label Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Label Description Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/lable-description-setting-icon.png'></div>";
					
					$tablestring .= "<div class='btn action_btn' id='add_new_row' data-id='".$col_no[1]."' title='".__('Add New Row',ARP_PT_TXTDOMAIN)."' data-title='".__('Add New Row',ARP_PT_TXTDOMAIN)."' data-level='body_li_level_options' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/add-icon2.png'></div>";
					$tablestring .= "<div class='btn action_btn' id='copy_row' alt='' col-id='".$col_no[1]."' title='".__('Duplicate Row',ARP_PT_TXTDOMAIN)."' data-title='".__('Duplicate Row',ARP_PT_TXTDOMAIN)."' data-level='body_li_level_options' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/duplicate-icon2.png'></div>";
					$tablestring .= "<div class='btn action_btn' id='remove_row' row-id='' col-id='".$col_no[1]."' title='".__('Delete Row',ARP_PT_TXTDOMAIN)."' data-title='".__('Delete Row',ARP_PT_TXTDOMAIN)."' data-level='body_li_level_options' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/delete-icon2.png'></div>";
					
					// Button Options
					$tablestring .= "<div class='btn' id='button_options__button_1' data-level='button_level_options' title='".__('Button General Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button General Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/general-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='button_options__button_2' data-level='button_level_options' title='".__('Button Image Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Image Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/buttonimage-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='button_options__button_3' data-level='button_level_options' title='".__('Button Link/Script Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Link Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/buttonlink-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='button_options__button_4' data-level='button_level_options' title='".__('Button Other Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Other Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/button-other-setting-icon.png'></div>";
					
					// Second Button Options
					$tablestring .= "<div class='btn' id='second_button_options__button_1' data-level='second_button_level_options' title='".__('Button General Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button General Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/button-general-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='second_button_options__button_2' data-level='second_button_level_options' title='".__('Button Image Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Image Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/buttonimage-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='second_button_options__button_3' data-level='second_button_level_options' title='".__('Button Link Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Link Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/buttonlink-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='second_button_options__button_4' data-level='second_button_level_options' title='".__('Button Other Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Button Other Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/button-other-setting-icon.png'></div>";
						
				$tablestring .= "</div>";
				
				$tablestring .= "<div class='column_level_options'>";
				
					 
					$tablestring .= "<div class='column_option_div' level-id='column_level_options__button_1'>";
				
						$tablestring .= "<div class='col_opt_row' id='column_width'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('width (optional)',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								$tablestring .= "<div class='col_opt_input'>";
								$tablestring .= "<input type='text' name='column_width_".$col_no[1]."' id='column_width_input' data-column='main_".$j."' class='col_opt_input' value='".$columns["column_width"]."'>";
								$tablestring .= "<span>".__('Px',ARP_PT_TXTDOMAIN)."</span>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
									
						$tablestring .= "<div class='col_opt_row' id='column_highlight'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Column Highlight',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								$tablestring .= "<div class='arp_checkbox_div'>";
									if( $column_highlight == 1 ) { $checked = "checked='checked'"; } else { $checked = ''; }
									$tablestring .= "<input type='checkbox' class='arp_checkbox dark_bg' ".$checked." value='1' id='column_highlight_input' name='column_highlight_".$col_no[1]."' data-column='main_".$j."' />";
									$tablestring .= "<label class='arp_checkbox_label'>".__('Yes',ARP_PT_TXTDOMAIN)."</label>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
					
						$tablestring .= "<div class='col_opt_row' id='set_hidden'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Hidden (Optional)',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								$tablestring .= "<div class='arp_checkbox_div'>";
								if( $columns['is_hidden'] == 1 ) { $checked = "checked='checked'"; } else { $checked = ''; }
								$tablestring .= "<input type='checkbox' class='arp_checkbox dark_bg' ".$checked." value='1' id='show_column' name='show_column_".$col_no[1]."' data-column='main_".$j."' />";
								$tablestring .= "<label class='arp_checkbox_label'>".__('Yes',ARP_PT_TXTDOMAIN)."</label>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='select_ribbon'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Ribbon',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								$tablestring .= "<button type='button' class='col_opt_btn' onclick='arp_select_ribbon(this)' name='ribbon_select_".$j."' id='ribbon_select' style='float:right;' data-column='main_".$j."'>";
									$tablestring .= __('Select Ribbon',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";
								$columns['ribbon_setting']['arp_ribbon'] = isset($columns['ribbon_setting']['arp_ribbon']) ? $columns['ribbon_setting']['arp_ribbon'] : "";
								$tablestring .= "<input type='hidden' id='arp_ribbon_style_main' name='arp_ribbon_style_".$col_no[1]."' value='".$columns['ribbon_setting']['arp_ribbon']."' />";
								$columns['ribbon_setting']['arp_ribbon_bgcol'] = isset($columns['ribbon_setting']['arp_ribbon_bgcol']) ? $columns['ribbon_setting']['arp_ribbon_bgcol'] : "";
								$tablestring .= "<input type='hidden' id='arp_ribbon_bgcol_main' name='arp_ribbon_bgcol_".$col_no[1]."' value='".$columns['ribbon_setting']['arp_ribbon_bgcol']."' />";
								$columns['ribbon_setting']['arp_ribbon_txtcol'] = isset($columns['ribbon_setting']['arp_ribbon_txtcol']) ? $columns['ribbon_setting']['arp_ribbon_txtcol'] : "";
								$tablestring .= "<input type='hidden' id='arp_ribbon_textcol_main' name='arp_ribbon_textcol_".$col_no[1]."' value='".$columns['ribbon_setting']['arp_ribbon_txtcol']."' />";
								$columns['ribbon_setting']['arp_ribbon_position'] = isset($columns['ribbon_setting']['arp_ribbon_position']) ? $columns['ribbon_setting']['arp_ribbon_position'] : "";
								$tablestring .= "<input type='hidden' id='arp_ribbon_position_main' name='arp_ribbon_position_".$col_no[1]."' value='".$columns['ribbon_setting']['arp_ribbon_position']."' />";
								$columns['ribbon_setting']['arp_ribbon_content'] = isset($columns['ribbon_setting']['arp_ribbon_content']) ? $columns['ribbon_setting']['arp_ribbon_content'] : "";
								$tablestring .= "<input type='hidden' id='arp_ribbon_content_main' name='arp_ribbon_content_".$col_no[1]."' value='".$columns['ribbon_setting']['arp_ribbon_content']."' />";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
							
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='column_level_other_arp_ok_div__button_1' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
							
					
					$tablestring .= "</div>";
					
					
					
					  /*Column Description*/
					$tablestring .= "<div class='column_option_div' level-id='column_level_options__button_2' >";
					$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2'] = isset($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2']) ? $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2'] : "";
					if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2']) ){
							if( in_array('column_description',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2'] ) ){
							
								$tablestring .= "<div class='col_opt_row' id='column_description'>";
									$tablestring .= "<div class='col_opt_title_div'>".__('Column Description',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div'>";
										$tablestring .= "<textarea id='arp_column_description' name='arp_column_description_".$col_no[1]."'  class='col_opt_textarea' data-column='main_column_".$col_no[1]."'>";
											$tablestring .= stripslashes_deep($columns['column_description']);
										$tablestring .= "</textarea>";
									$tablestring .= "</div>";	
									$tablestring .= "<div class='col_opt_button'>";
										if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2']) )	{
											if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2']) ){
												$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no[1]."' id='add_arp_object' data-insert='arp_column_description' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
												$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
												
											$tablestring .= "</button>";
											$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
											}
										}
										
										if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2'] ) ){
											if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_level_options']['other_columns_buttons']['column_level_options__button_2']) ){
												$tablestring .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome' name='add_header_fontawesome_".$col_no[1]."' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_".$j."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
													$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
												$tablestring .= "</button>";
											}
										}
									$tablestring .= "</div>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='col_opt_row' id='column_description_other_font_family'>";
									$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div'>";
										
										$tablestring .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_".$col_no[1]."' data-column='main_".$j."' value='".$columns['column_description_font_family']."' />";
										$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_".$col_no[1]."' data-id='column_description_font_family_".$col_no[1]."'>";
											$tablestring .= "<dt><span>".$columns['column_description_font_family']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											$tablestring .= "<dd>";
												$tablestring .= "<ul data-id='column_description_font_family' data-column='".$j."'>";
												
												
														
												$tablestring .= "</ul>";
											$tablestring .= "</dd>";
										$tablestring .= "</dl>";
									$tablestring .= "</div>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='col_opt_row' id='column_description_other_font_size'>";
									$tablestring .= "<div class='btn_type_size'>";
										$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
										$tablestring .= "<div class='col_opt_input_div two_column'>";
											
											$tablestring .= "<input type='hidden' id='column_description_font_size' data-column='main_".$j."' name='column_description_font_size_".$col_no[1]."' value='".$columns['column_description_font_size']."' />";
											$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_".$col_no[1]."' data-id='column_description_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
												$tablestring .= "<dt><span>".$columns['column_description_font_size']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
												$tablestring .= "<dd>";
												$size_arr = array();
													$tablestring .= "<ul data-id='column_description_font_size' data-column='".$j."'>";
															for($s=8;$s<=20;$s++)
																$size_arr[]=$s;
															for($st=22;$st<=70;$st+=2)
																$size_arr[]=$st;
															foreach($size_arr as $size)  {
																$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
															}
													$tablestring .= "</ul>";
												$tablestring .= "</dd>";
											$tablestring .= "</dl>";
										$tablestring .= "</div>";
									$tablestring .= "</div>";
									
									
											
													$tablestring .= "<div class='btn_type_size'>";
										$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
										$tablestring .= "<div class='col_opt_input_div two_column'>";
											$tablestring .= $arprice_form->font_color('column_description_font_color_'.$col_no[1],'main_'.$j,$columns['column_description_font_color'],'column_description_font_color',$columns['column_description_font_color']);
										$tablestring .= "</div>";
									$tablestring .= "</div>";
												
										//end
									
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='col_opt_row' id='column_description_other_font_color'>";
								
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$tablestring .= "<div class='col_opt_input_div' data-level='column_level_options' level-id='column_button2' >";
								
								
								//check selected for bold
								
								
								if( $columns['column_description_style_bold'] == 'bold' ){
										$column1_style_bold_selected = 'selected';
									}
									else{
										$column1_style_bold_selected = '';
									}
									
									//check selected for italic
									
									if( $columns['column_description_style_italic'] == 'italic' ){
										$column1_style_italic_selected = 'selected';
									}
									else{
										$column1_style_italic_selected = '';
									}
									
									//check selected for underline or line-through
									
									if( $columns['column_description_style_decoration'] == 'underline' )
										{
											$column1_style_underline_selected = 'selected';
										}
										else{
											$column1_style_underline_selected = '';
										}
										
									if( $columns['column_description_style_decoration'] == 'line-through' )
										{
											$column1_style_linethrough_selected = 'selected';
										}
										else
										{
											$column1_style_linethrough_selected = '';
										}
								
								
								
								$tablestring .= "<div class='arp_style_btn ".$column1_style_bold_selected." arptooltipster' data-align='left' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$column1_style_italic_selected." arptooltipster' data-align='center' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$column1_style_underline_selected." arptooltipster' data-align='right' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$column1_style_linethrough_selected." arptooltipster' data-align='right' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_".$col_no[1]."' value='".$columns['column_description_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_".$col_no[1]."' value='".$columns['column_description_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_".$col_no[1]."' value='".$columns['column_description_style_decoration']."' /> ";
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$tablestring .= "</div>";
							
							//new font style btn ends
								
								$tablestring .= "</div>";
							}
						}
						
							
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='column_level_other_arp_ok_div__button_2' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
							
					
					$tablestring .= "</div>";
					
					 

					$tablestring .= "<div class='column_option_div' level-id='header_level_options__button_1' >";

						$tablestring .= "<div class='col_opt_row' id='column_title'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Column Title',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
								$col_no = explode('_',$j);
								if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1']) || in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1']) ){
								
									$tablestring .= "<textarea name='column_title_".$col_no[1]."' id='column_title_input' data-column='main_".$j."' class='col_opt_textarea' >";
										$tablestring .= $columns['package_title'];
									$tablestring .= "</textarea>";
								
								} else {
								
									$tablestring .= "<input type='text' name='column_title_".$col_no[1]."' id='column_title_input' data-column='main_".$j."' class='col_opt_input' value='".$columns["package_title"]."'  />";
								
								}
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_button'>";
								if(in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1'])  ){
									$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no[1]."' id='add_arp_object' data-insert='column_title_input' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
										
									$tablestring .= "</button>";
									$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
								}
								
								if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1']) ){
									
									$tablestring .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome' name='add_header_fontawesome_".$col_no[1]."' id='add_header_fontawesome' data-insert='column_title_input' data-column='main_".$j."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$tablestring .= "</button>";
								}
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='header_other_font_family'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
								
								$tablestring .= "<input type='hidden' id='header_font_family' name='header_font_family_".$col_no[1]."' value='".$columns['header_font_family']."' data-column='main_".$j."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='header_font_family_".$col_no[1]."' data-id='header_font_family_".$col_no[1]."'>";
									$tablestring .= "<dt><span>".$columns['header_font_family']."</span><input type='text' style='display:none;' value='".$columns['header_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='header_font_family' data-column='".$j."'>";
										
										
										
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
					
						$tablestring .= "<div class='col_opt_row' id='header_other_font_size'>";
							$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
							
								$tablestring .= "<input type='hidden' id='header_font_size' name='header_font_size_".$col_no[1]."' data-column='main_".$j."' value='".$columns['header_font_size']."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='header_font_size_".$col_no[1]."' data-id='header_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
									$tablestring .= "<dt><span>".$columns['header_font_size']."</span><input type='text' style='display:none;' value='".$columns['header_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='header_font_size' data-column='".$j."'>";
										$size_arr = array();
												for($s=8;$s<=20;$s++)
													$size_arr[]=$s;
													
												for($st=22;$st<=70;$st+=2)
													$size_arr[]=$st;
													
												foreach($size_arr as $size)  {
													$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
												}
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
														
							
							$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
									$tablestring .= $arprice_form->font_color('header_font_color_'.$col_no[1],'main_'.$j,$columns['header_font_color'],'header_font_color',$columns['header_font_color']);
								$tablestring .= "</div>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='header_other_font_color'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
							
								//check selected for bold
								$tablestring .= "<div class='col_opt_input_div' data-level='header_level_options' level-id='header_button1' >";
								
								if( $columns['header_style_bold'] == 'bold' ){
										$header_style_bold_selected = 'selected';
									}
									else{
										$header_style_bold_selected = '';
									}
									
									//check selected for italic
									
									if( $columns['header_style_italic'] == 'italic' ){
										$header_style_italic_selected = 'selected';
									}
									else{
										$header_style_italic_selected = '';
									}
									
									//check selected for underline or line-through
									
									if( $columns['header_style_decoration'] == 'underline' )
										{
											$header_style_underline_selected = 'selected';
										}
										else{
											$header_style_underline_selected = '';
										}
										
									if( $columns['header_style_decoration'] == 'line-through' )
										{
											$header_style_linethrough_selected = 'selected';
										}
										else
										{
											$header_style_linethrough_selected = '';
										}
											
									
								
								$tablestring .= "<div class='arp_style_btn ".$header_style_bold_selected."  arptooltipster' data-align='left' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$header_style_italic_selected." arptooltipster' data-align='center' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$header_style_underline_selected." arptooltipster' data-align='right' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$header_style_linethrough_selected." arptooltipster' data-align='right' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								
								$tablestring .= "<input type='hidden' id='header_style_bold' name='header_style_bold_".$col_no[1]."' value='".$columns['header_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='header_style_italic' name='header_style_italic_".$col_no[1]."' value='".$columns['header_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='header_style_decoration' name='header_style_decoration_".$col_no[1]."' value='".$columns['header_style_decoration']."' /> ";
								
								
		
							$tablestring .= "</div>";
							
							
						$tablestring .= "</div>";
						
							
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='header_level_other_arp_ok_div__button_1'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
					
					$tablestring .= "</div>";
					
					// COLUMN DESCRIPTION
					
					$tablestring .= "<div class='column_option_div' level-id='header_level_options__button_2' style='display:none;'>";
					$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2'] = isset($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2']) ? $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2'] : "";
					if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2']) ){
						if( in_array('column_description',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2'] ) ){
						
							$tablestring .= "<div class='col_opt_row' id='column_description'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Column Description',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									$tablestring .= "<textarea id='arp_column_description' name='arp_column_description_".$col_no[1]."'  class='col_opt_textarea' data-column='main_column_".$col_no[1]."'>";
										$tablestring .= stripslashes_deep($columns['column_description']);
									$tablestring .= "</textarea>";
								$tablestring .= "</div>";
								$tablestring .= "<div class='col_opt_button'>";
									if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2']) ){
										$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no[1]."' id='add_arp_object' data-insert='arp_column_description' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
										
									$tablestring .= "</button>";
									$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
									}
									
									if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2']) ){
										$tablestring .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome' name='add_header_fontawesome_".$col_no[1]."' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_".$j."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
										$tablestring .= "</button>";
									}
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_family'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									
									$tablestring .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_".$col_no[1]."' data-column='main_".$j."' value='".$columns['column_description_font_family']."' />";
									$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_".$col_no[1]."' data-id='column_description_font_family_".$col_no[1]."'>";
										$tablestring .= "<dt><span>".$columns['column_description_font_family']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$tablestring .= "<dd>";
											$tablestring .= "<ul data-id='column_description_font_family' data-column='".$j."'>";
											
											
													
											$tablestring .= "</ul>";
										$tablestring .= "</dd>";
									$tablestring .= "</dl>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_size'>";
								$tablestring .= "<div class='btn_type_size'>";
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div two_column'>";
										
										$tablestring .= "<input type='hidden' id='column_description_font_size' data-column='main_".$j."' name='column_description_font_size_".$col_no[1]."' value='".$columns['column_description_font_size']."' />";
										$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_".$col_no[1]."' data-id='column_description_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
											$tablestring .= "<dt><span>".$columns['column_description_font_size']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											$tablestring .= "<dd>";
											$size_arr = array();
												$tablestring .= "<ul data-id='column_description_font_size' data-column='".$j."'>";
														for($s=8;$s<=20;$s++)
															$size_arr[]=$s;
														for($st=22;$st<=70;$st+=2)
															$size_arr[]=$st;
														foreach($size_arr as $size)  {
															$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
														}
												$tablestring .= "</ul>";
											$tablestring .= "</dd>";
										$tablestring .= "</dl>";
									$tablestring .= "</div>";
								$tablestring .= "</div>";
								
									
										$tablestring .= "<div class='btn_type_size'>";
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div two_column'>";
										$tablestring .= $arprice_form->font_color('column_description_font_color_'.$col_no[1],'main_'.$j,$columns['column_description_font_color'],'column_description_font_color',$columns['column_description_font_color']);
									$tablestring .= "</div>";
								$tablestring .= "</div>";
									
								//end
								
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_color'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$tablestring .= "<div class='col_opt_input_div' data-level='header_level_options'  level-id='header_button2' >";
								
								//check selected for bold
								
								
								if( $columns['column_description_style_bold'] == 'bold' ){
										$header2_style_bold_selected = 'selected';
									}
									else{
										$header2_style_bold_selected = '';
									}
									
									//check selected for italic
									
									if( $columns['column_description_style_italic'] == 'italic' ){
										$header2_style_italic_selected = 'selected';
									}
									else{
										$header2_style_italic_selected = '';
									}
									
									//check selected for underline or line-through
									
									if( $columns['column_description_style_decoration'] == 'underline' )
										{
											$header2_style_underline_selected = 'selected';
										}
										else{
											$header2_style_underline_selected = '';
										}
										
									if( $columns['column_description_style_decoration'] == 'line-through' )
										{
											$header2_style_linethrough_selected = 'selected';
										}
										else
										{
											$header2_style_linethrough_selected = '';
										}
								
								
								$tablestring .= "<div class='arp_style_btn ".$header2_style_bold_selected." arptooltipster' data-align='left' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$header2_style_italic_selected." arptooltipster' data-align='center' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$header2_style_underline_selected." arptooltipster' data-align='right' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$header2_style_linethrough_selected." arptooltipster' data-align='right' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								
								$tablestring .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_".$col_no[1]."' value='".$columns['column_description_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_".$col_no[1]."' value='".$columns['column_description_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_".$col_no[1]."' value='".$columns['column_description_style_decoration']."' /> ";
								
								
								
								
		
							$tablestring .= "</div>";
							
							//new font style btn ends
							$tablestring .= "</div>";
						}
					}
						
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='header_level_other_arp_ok_div__button_2' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
							

					$tablestring .= "</div>";
					
					$tablestring .= "<div class='column_option_div' level-id='header_level_options__button_3' style='display:none;'>";
					$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'] = isset($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) ? $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'] : "";
					if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'] ) ){
						if( in_array('column_description',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'] ) ){
							$tablestring .= "<div class='col_opt_row' id='column_description'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Column Description',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									$tablestring .= "<textarea id='arp_column_description' name='arp_column_description_".$col_no[1]."'  class='col_opt_textarea' data-column='main_column_".$col_no[1]."'>";
										$tablestring .= stripslashes_deep($columns['column_description']);
									$tablestring .= "</textarea>";
								$tablestring .= "</div>";	
								$tablestring .= "<div class='col_opt_button'>";
									if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) ){
										$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no[1]."' id='add_arp_object' data-insert='arp_column_description' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
											
										$tablestring .= "</button>";
										$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
									}
									
									if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) ){
										$tablestring .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome' name='add_header_fontawesome_".$col_no[1]."' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_".$j."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
										$tablestring .= "</button>";
									}
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_family'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									
									$tablestring .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_".$col_no[1]."' data-column='main_".$j."' value='".$columns['column_description_font_family']."' />";
									$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_".$col_no[1]."' data-id='column_description_font_family_".$col_no[1]."'>";
										$tablestring .= "<dt><span>".$columns['column_description_font_family']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$tablestring .= "<dd>";
											$tablestring .= "<ul data-id='column_description_font_family' data-column='".$j."'>";
											
											
													
											$tablestring .= "</ul>";
										$tablestring .= "</dd>";
									$tablestring .= "</dl>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_size'>";
								$tablestring .= "<div class='btn_type_size'>";
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div two_column'>";
										
										$tablestring .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_".$col_no[1]."' value='".$columns['header_font_size']."' data-column='main_".$j."' />";
										$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_".$col_no[1]."' data-id='column_description_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
											$tablestring .= "<dt><span>".$columns['column_description_font_size']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											$tablestring .= "<dd>";
											$size_arr = array();
												$tablestring .= "<ul data-id='column_description_font_size' data-column='".$j."'>";
														for($s=8;$s<=20;$s++)
															$size_arr[]=$s;
														for($st=22;$st<=70;$st+=2)
															$size_arr[]=$st;
														foreach($size_arr as $size)  {
															$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
														}
												$tablestring .= "</ul>";
											$tablestring .= "</dd>";
										$tablestring .= "</dl>";
									$tablestring .= "</div>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='btn_type_size'>";
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div two_column'>";
										
										$tablestring .= "<input type='hidden' id='column_description_font_style' name='column_description_font_style_".$col_no[1]."' value='".$columns['column_description_font_style']."' data-column='main_".$j."' />";
										$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_style_".$col_no[1]."' data-id='column_description_font_style_".$col_no[1]."' style='width:115px;max-width:115px;'>";
											$tablestring .= "<dt><span>".$columns['column_description_font_style']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_style']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											$tablestring .= "<dd>";
												$tablestring .= "<ul data-id='column_description_font_style' data-column='".$j."'>";
														$tablestring .= $arprice_form->font_style_new();
												$tablestring .= "</ul>";
											$tablestring .= "</dd>";
										$tablestring .= "</dl>";
									$tablestring .= "</div>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_color'>";
								$tablestring .= "<div class='btn_type_size'>";
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div two_column'>";
										$tablestring .= $arprice_form->font_color('column_description_font_color_'.$col_no[1],'main_'.$j,$columns['column_description_font_color'],'column_description_font_color',$columns['column_description_font_color']);
									$tablestring .= "</div>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
						}
						if( in_array('additional_shortcode',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'] ) ){
							
							if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) || in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) ){
								$header_shortcode_txtarea_cls = 'editable_shortcode';
							} else {
								$header_shortcode_txtarea_cls = '';
							}
						
							$tablestring .= "<div class='col_opt_row' id='additional_shortcode'>";
						
								$tablestring .= "<div class='col_opt_title_div'>".__('Additional Shortcode',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									$tablestring .= "<textarea id='additional_shortcode_input' name='additional_shortcode_".$col_no[1]."'  class='col_opt_textarea ".$header_shortcode_txtarea_cls."' data-column='main_".$j."'>";
									$tablestring .= htmlentities($columns['arp_header_shortcode']);
									$tablestring .= "</textarea>";
								$tablestring .= "</div>";
								
								if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) || in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) ){
									$tablestring .= "<div class='col_opt_button'>";
									
									if( $ref_template == 'arptemplate_5' || $ref_template == 'arptemplate_7' )
										{
											$tablestring .= "<button type='button' class='col_opt_btn arptooltipster' onclick='add_header_shortcode_fn(this);' name='add_header_shortcode_btn_".$col_no[1]."' id='add_header_shortcode' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/audio-icon.png' />";
										$tablestring .= "</button>";
										$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
										}
										
										if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) ){
											$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no[1]."' id='add_arp_object' data-insert='additional_shortcode_input' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
												$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
											$tablestring .= "</button>";
											$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
										}
										
										if(in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])){
											$tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no[1]."' id='add_header_fontawesome' data-insert='additional_shortcode_input' data-column='main_".$j."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
												$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
											$tablestring .= "</button>";
										}
									$tablestring .= "</div>";
								} else {
									$tablestring .= "<div class='col_opt_button'>";
										$tablestring .= "<button type='button' class='col_opt_btn arptooltipster' onclick='add_header_shortcode_fn(this);' name='add_header_shortcode_btn_".$col_no[1]."' id='add_header_shortcode' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/audio-icon.png' />";
										$tablestring .= "</button>";
									$tablestring .= "</div>";
								}
							$tablestring .= "</div>";
						}
					}
					
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='header_level_other_arp_ok_div__button_3' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='column_option_div' level-id='pricing_level_options__button_1' style='display:none;'>";
						
						$tablestring .= "<div class='col_opt_row' id='price_text'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Price Text',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
								if( $template_type == 'normal' ){
									$col_opt_txtarea_cls = 'col_opt_textarea_big';
								} else {
									$col_opt_txtarea_cls = '';
								}
								
								$tablestring .= "<textarea id='price_text_input' name='price_text_".$col_no[1]."' class='col_opt_textarea ".$col_opt_txtarea_cls."' data-column='main_".$j."' style='min-height:80px;max-width:100%;width:100%;'>";
										$tablestring .= $columns['price_text'];
								$tablestring .= "</textarea>";
								$tablestring .= "<div class='col_opt_button'>";
									if(in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1'])  ){
										$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no[1]."' id='add_arp_object' data-insert='price_text_input' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
											
										$tablestring .= "</button>";
										$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
									}
									
									if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1']) ){
										
										$tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no[1]."' id='add_header_fontawesome' data-insert='price_text_input' data-column='main_".$j."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
										$tablestring .= "</button>";
									}
								$tablestring .= "</div>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='price_text_other_font_family'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
								
								$tablestring .= "<input type='hidden' id='price_font_family' name='price_font_family_".$col_no[1]."' value='".$columns['price_font_family']."' data-column='main_".$j."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='price_font_family_".$col_no[1]."' data-id='price_font_family_".$col_no[1]."'>";
									$tablestring .= "<dt><span>".$columns['price_font_family']."</span><input type='text' style='display:none;' value='".$columns['price_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='price_font_family' data-column='".$j."'>";
										
											
												
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='price_text_other_font_size'>";
						
							$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
									
									$tablestring .= "<input type='hidden' id='price_font_size' name='price_font_size_".$col_no[1]."' data-column='main_".$j."' value='".$columns['price_font_size']."' />";
									$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='price_font_size_".$col_no[1]."' data-id='price_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
										$tablestring .= "<dt><span>".$columns['price_font_size']."</span><input type='text' style='display:none;' value='".$columns['price_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$tablestring .= "<dd>";
											$tablestring .= "<ul data-id='price_font_size' data-column='".$j."'>";
											$size_arr = array();
													for($s=8;$s<=20;$s++)
														$size_arr[]=$s;
													for($st=22;$st<=70;$st+=2)
														$size_arr[]=$st;
													foreach($size_arr as $size)  {
														$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
													}
											$tablestring .= "</ul>";
										$tablestring .= "</dd>";
									$tablestring .= "</dl>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							
							
								$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
									$tablestring .= $arprice_form->font_color('price_font_color_'.$col_no[1],'main_'.$j,$columns['price_font_color'],'price_font_color',$columns['price_font_color']);
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							//font color new pos ends
							
							
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='price_text_other_font_color'>";
						
						$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$tablestring .= "<div class='col_opt_input_div' data-level='pricing_level_options' level-id='pricing_button1'>";
								
								//check selected for bold
								
								
								if( $columns['price_label_style_bold'] == 'bold' ){
										$pricing_style_bold_selected = 'selected';
									}
									else{
										$pricing_style_bold_selected = '';
									}
									
									//check selected for italic
									
									if( $columns['price_label_style_italic'] == 'italic' ){
										$pricing_style_italic_selected = 'selected';
									}
									else{
										$pricing_style_italic_selected = '';
									}
									
									//check selected for underline or line-through
									
									if( $columns['price_label_style_decoration'] == 'underline' )
										{
											$pricing_style_underline_selected = 'selected';
										}
										else{
											$pricing_style_underline_selected = '';
										}
										
									if( $columns['price_label_style_decoration'] == 'line-through' )
										{
											$pricing_style_linethrough_selected = 'selected';
										}
										else
										{
											$pricing_style_linethrough_selected = '';
										}
								
								
								
								$tablestring .= "<div class='arp_style_btn ".$pricing_style_bold_selected." arptooltipster' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left' data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$pricing_style_italic_selected." arptooltipster' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$pricing_style_underline_selected." arptooltipster' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$pricing_style_linethrough_selected." arptooltipster' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								
							
								$tablestring .= "<input type='hidden' id='price_label_style_bold' name='price_label_style_bold_".$col_no[1]."' value='".$columns['price_label_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='price_label_style_italic' name='price_label_style_italic_".$col_no[1]."' value='".$columns['price_label_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='price_label_style_decoration' name='price_label_style_decoration_".$col_no[1]."' value='".$columns['price_label_style_decoration']."' /> ";
								
								/*$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";*/
		
							$tablestring .= "</div>";
							
							//new font style btn ends
							
						$tablestring .= "</div>";
						
						
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='pricing_level_other_arp_ok_div__button_1' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
					$tablestring .= "</div>";					
					
					$tablestring .= "<div class='column_option_div' level-id='pricing_level_options__button_2' style='display:none;'>";
						
						$tablestring .= "<div class='col_opt_row' id='price_label'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Label Text',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
								$tablestring .= "<textarea id='price_label_input' name='price_label_".$col_no[1]."' class='col_opt_textarea' data-column='main_".$j."' style='min-height:80px;max-width:100%;width:100%;'>";
										$tablestring .= $columns['price_label'];
								$tablestring .= "</textarea>";
							$tablestring .= "</div>";
							$tablestring .= "<div class='col_opt_button'>";
								$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'] = isset($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2']) ? $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'] : "";
								if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2']) ){
									if(in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'])  ){
										$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no[1]."' id='add_arp_object' data-insert='price_label_input' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
											
										$tablestring .= "</button>";
										$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
									}
								}
								
								$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'] = isset($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2']) ? $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'] : "";
								if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'] ) ){
									if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2']) ){
										
										$tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no[1]."' id='add_header_fontawesome' data-insert='price_label_input' data-column='main_".$j."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
										$tablestring .= "</button>";
									}
								}
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='price_label_other_font_family'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
								
								$tablestring .= "<input type='hidden' id='price_text_font_family' value='".$columns['price_text_font_family']."' name='price_text_font_family_".$col_no[1]."' data-column='main_".$j."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='price_text_font_family_".$col_no[1]."' data-id='price_text_font_family_".$col_no[1]."'>";
									$tablestring .= "<dt><span>".$columns['price_text_font_family']."</span><input type='text' style='display:none;' value='".$columns['price_text_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='price_text_font_family' data-column='".$j."'>";
										
										
											
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='price_label_other_font_size'>";
						
							$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
									
									$tablestring .= "<input type='hidden' id='price_text_font_size' data-column='main_".$j."' name='price_text_font_size_".$col_no[1]."' value='".$columns['price_text_font_size']."' />";
									$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='price_text_font_size_".$col_no[1]."' data-id='price_text_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
										$tablestring .= "<dt><span>".$columns['price_text_font_size']."</span><input type='text' style='display:none;' value='".$columns['price_text_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$tablestring .= "<dd>";
											$tablestring .= "<ul data-id='price_text_font_size' data-column='".$j."'>";
											$size_arr = array();
													for($s=8;$s<=20;$s++)
														$size_arr[]=$s;
													for($st=22;$st<=70;$st+=2)
														$size_arr[]=$st;
													foreach($size_arr as $size)  {
														$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
													}
											$tablestring .= "</ul>";
										$tablestring .= "</dd>";
									$tablestring .= "</dl>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							
								
									$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
									$tablestring .= $arprice_form->font_color('price_text_font_color_'.$col_no[1],'main_'.$j,$columns['price_text_font_color'],'price_text_font_color',$columns['price_text_font_color']);
								$tablestring .= "</div>";
							$tablestring .= "</div>";
									
							//font color brn new pos end
							
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='price_label_other_font_color'>";
							
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$tablestring .= "<div class='col_opt_input_div' data-level='pricing_level_options' level-id='pricing_button2' >";
								
								//check selected for bold
								
								
								if( $columns['price_text_style_bold'] == 'bold' ){
										$pricing2_style_bold_selected = 'selected';
									}
									else{
										$pricing2_style_bold_selected = '';
									}
									
									//check selected for italic
									
									if( $columns['price_text_style_italic'] == 'italic' ){
										$pricing2_style_italic_selected = 'selected';
									}
									else{
										$pricing2_style_italic_selected = '';
									}
									
									//check selected for underline or line-through
									
									if( $columns['price_text_style_decoration'] == 'underline' )
										{
											$pricing2_style_underline_selected = 'selected';
										}
										else{
											$pricing2_style_underline_selected = '';
										}
										
									if( $columns['price_text_style_decoration'] == 'line-through' )
										{
											$pricing2_style_linethrough_selected = 'selected';
										}
										else
										{
											$pricing2_style_linethrough_selected = '';
										}
								
								
								
								$tablestring .= "<div class='arp_style_btn ".$pricing2_style_bold_selected." arptooltipster' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left' data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$pricing2_style_italic_selected." arptooltipster' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$pricing2_style_underline_selected." arptooltipster' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$pricing2_style_linethrough_selected." arptooltipster' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								
								
								
								$tablestring .= "<input type='hidden' id='price_text_style_bold' name='price_text_style_bold_".$col_no[1]."' value='".$columns['price_text_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='price_text_style_italic' name='price_text_style_italic_".$col_no[1]."' value='".$columns['price_text_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='price_text_style_decoration' name='price_text_style_decoration_".$col_no[1]."' value='".$columns['price_text_style_decoration']."' /> ";
								
								
		
							$tablestring .= "</div>";
							
							//new font style btn ends
							
						$tablestring .= "</div>";
						
							
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='pricing_level_other_arp_ok_div__button_2' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
							
						
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='column_option_div' level-id='pricing_level_options__button_3' style='display:none;'>";
					$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'] = isset($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3']) ? $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'] : "";
					if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'] ) ){
						if( in_array('column_description',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'] ) ){
						
							$tablestring .= "<div class='col_opt_row' id='column_description'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Column Description',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									$tablestring .= "<textarea id='arp_column_description' name='arp_column_description_".$col_no[1]."'  class='col_opt_textarea' data-column='main_column_".$col_no[1]."'>";
										$tablestring .= stripslashes_deep($columns['column_description']);
									$tablestring .= "</textarea>";
								$tablestring .= "</div>";
								$tablestring .= "<div class='col_opt_button'>";
									if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3']) ){
										$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no[1]."' id='add_arp_object' data-insert='arp_column_description' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
											
										$tablestring .= "</button>";
										$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
									}
									
									if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3']) ){
										$tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no[1]."' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_".$j."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
										$tablestring .= "</button>";
									}
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_family'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									
									$tablestring .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_".$col_no[1]."' data-column='main_".$j."' value='".$columns['column_description_font_family']."' data-column='main_".$j."' />";
									$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_".$col_no[1]."' data-id='column_description_font_family_".$col_no[1]."'>";
										$tablestring .= "<dt><span>".$columns['column_description_font_family']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$tablestring .= "<dd>";
											$tablestring .= "<ul data-id='column_description_font_family' data-column='".$j."'>";
											
											
											
													
													
											$tablestring .= "</ul>";
										$tablestring .= "</dd>";
									$tablestring .= "</dl>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_size'>";
								$tablestring .= "<div class='btn_type_size'>";
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div two_column'>";
										
										$tablestring .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_".$col_no[1]."' value='".$columns['column_description_font_size']."' data-column='main_".$j."' />";
										$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_".$col_no[1]."' data-id='column_description_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
											$tablestring .= "<dt><span>".$columns['column_description_font_size']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											$tablestring .= "<dd>";
												$tablestring .= "<ul data-id='column_description_font_size' data-column='".$j."'>";
												$size_arr = array();
														for($s=8;$s<=20;$s++)
															$size_arr[]=$s;
														for($st=22;$st<=70;$st+=2)
															$size_arr[]=$st;
														foreach($size_arr as $size)  {
															$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
														}
												$tablestring .= "</ul>";
											$tablestring .= "</dd>";
										$tablestring .= "</dl>";
									$tablestring .= "</div>";
								$tablestring .= "</div>";
								
								
									
									$tablestring .= "<div class='btn_type_size'>";
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div two_column'>";
										$tablestring .= $arprice_form->font_color('column_description_font_color_'.$col_no[1],'main_'.$j,$columns['column_description_font_color'],'column_description_font_color',$columns['column_description_font_color']);
									$tablestring .= "</div>";
								$tablestring .= "</div>";
									
								//font color btn new pos ends
								
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_color'>";
								
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$tablestring .= "<div class='col_opt_input_div' data-level='pricing_level_options' level-id='pricing_button3'>";
								
								
								//check selected for bold
								
								
								if( $columns['column_description_style_bold'] == 'bold' ){
										$pricing3_style_bold_selected = 'selected';
									}
									else{
										$pricing3_style_bold_selected = '';
									}
									
									//check selected for italic
									
									if( $columns['column_description_style_italic'] == 'italic' ){
										$pricing3_style_italic_selected = 'selected';
									}
									else{
										$pricing3_style_italic_selected = '';
									}
									
									//check selected for underline or line-through
									
									if( $columns['column_description_style_decoration'] == 'underline' )
										{
											$pricing3_style_underline_selected = 'selected';
										}
										else{
											$pricing3_style_underline_selected = '';
										}
										
									if( $columns['column_description_style_decoration'] == 'line-through' )
										{
											$pricing3_style_linethrough_selected = 'selected';
										}
										else
										{
											$pricing3_style_linethrough_selected = '';
										}
								
								
								
								$tablestring .= "<div class='arp_style_btn ".$pricing3_style_bold_selected."  arptooltipster' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left'  data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$pricing3_style_italic_selected." arptooltipster' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$pricing3_style_underline_selected." arptooltipster' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$pricing3_style_linethrough_selected." arptooltipster' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								
								$tablestring .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_".$col_no[1]."' value='".$columns['column_description_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_".$col_no[1]."' value='".$columns['column_description_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_".$col_no[1]."' value='".$columns['column_description_style_decoration']."' /> ";
								
								
								
		
							$tablestring .= "</div>";
							
							//new font style btn ends
								
							$tablestring .= "</div>";
						}
					}
					
					
						
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='pricing_level_other_arp_ok_div__button_3' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
					
					$tablestring .= "</div>";
					
					// BODY LEVEL OPTIONS
					$tablestring .= "<input type='hidden' id='total_rows' value='".count($columns['rows'])."' name='total_rows_".$col_no[1]."' />";
					$tablestring .= "<div class='column_option_div' level-id='body_level_options__button_1' style='display:none;'>";
						
						$tablestring .= "<div class='col_opt_row' id='text_alignment'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Text Alignment',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
								
								$alignment = $columns['body_text_alignment'];
								
								$left_selected = ($alignment == 'left') ? 'align_selected' : '';
								$center_selected = ($alignment == 'center') ? 'align_selected' : '';
								$right_selected = ($alignment == 'right') ? 'align_selected' : '';
								
								$tablestring .= "<div class='alignment_btn align_left_btn ".$left_selected."' data-align='left' id='align_left_btn' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-align-left fa-flip-vertical'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='alignment_btn align_center_btn ".$center_selected."' data-align='center' id='align_center_btn' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-align-center fa-flip-vertical'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='alignment_btn align_right_btn ".$right_selected."' data-align='right' id='align_right_btn' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-align-right fa-flip-vertical'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<input type='hidden' id='body_text_alignment' value='".$alignment."' name='body_text_alignment_".$col_no[1]."'>";
		
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='body_li_other_font_family'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
								
								$tablestring .= "<input type='hidden' id='content_font_family' value='".$columns['content_font_family']."' name='content_font_family_".$col_no[1]."' data-column='main_".$j."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='content_font_family_".$col_no[1]."' data-id='content_font_family_".$col_no[1]."'>";
									$tablestring .= "<dt><span>".$columns['content_font_family']."</span><input type='text' style='display:none;' value='".$columns['content_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='content_font_family' data-column='".$j."'>";
										
										
												
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='body_li_other_font_size'>";
							$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
								
									$tablestring .= "<input type='hidden' id='content_font_size' name='content_font_size_".$col_no[1]."' value='".$columns['content_font_size']."' data-column='main_".$j."' />";
									$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='content_font_size_".$col_no[1]."' data-id='content_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
										$tablestring .= "<dt><span>".$columns['content_font_size']."</span><input type='text' style='display:none;' value='".$columns['content_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$tablestring .= "<dd>";
											$tablestring .= "<ul data-id='content_font_size' data-column='".$j."'>";
											$size_arr = array();
													for($s=8;$s<=20;$s++)
														$size_arr[]=$s;
													for($st=22;$st<=70;$st+=2)
														$size_arr[]=$st;
													foreach($size_arr as $size)  {
														$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
													}
											$tablestring .= "</ul>";
										$tablestring .= "</dd>";
									$tablestring .= "</dl>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
						
								
									$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
									$tablestring .= $arprice_form->font_color('content_font_color_'.$col_no[1],'main_'.$j,$columns['content_font_color'],'content_font_color',$columns['content_font_color']);
								$tablestring .= "</div>";
							$tablestring .= "</div>";
								
							//font color btn new pos ends
							
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='body_li_other_font_color' data-level='body_level_options' level-id='bodylevel_button1'>";
						
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$tablestring .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button1' >";
								
								//check selected for bold
								
								
								if( $columns['body_li_style_bold'] == 'bold' ){
										$bodylevel_style_bold_selected = 'selected';
									}
									else{
										$bodylevel_style_bold_selected = '';
									}
									
									//check selected for italic
									
									if( $columns['body_li_style_italic'] == 'italic' ){
										$bodylevel_style_italic_selected = 'selected';
									}
									else{
										$bodylevel_style_italic_selected = '';
									}
									
									//check selected for underline or line-through
									
									if( $columns['body_li_style_decoration'] == 'underline' )
										{
											$bodylevel_style_underline_selected = 'selected';
										}
										else{
											$bodylevel_style_underline_selected = '';
										}
										
									if( $columns['body_li_style_decoration'] == 'line-through' )
										{
											$bodylevel_style_linethrough_selected = 'selected';
										}
										else
										{
											$bodylevel_style_linethrough_selected = '';
										}
								
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel_style_bold_selected." arptooltipster' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left' data-column='main_".$j."'  id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel_style_italic_selected." arptooltipster' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel_style_underline_selected." arptooltipster' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel_style_linethrough_selected." arptooltipster' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								
								$tablestring .= "<input type='hidden' id='body_li_style_bold' name='body_li_style_bold_".$col_no[1]."' value='".$columns['body_li_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='body_li_style_italic' name='body_li_style_italic_".$col_no[1]."' value='".$columns['body_li_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='body_li_style_decoration' name='body_li_style_decoration_".$col_no[1]."' value='".$columns['body_li_style_decoration']."' /> ";
								
								
								
		
							$tablestring .= "</div>";
							
							//new font style btn ends
							
						$tablestring .= "</div>";
						
						
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='body_level_other_arp_ok_div__button_1' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";								
						
						
					$tablestring .= "</div>";
										
					// BODY LEVEL OPTIONS 2
					
					$tablestring .= "<div class='column_option_div' level-id='body_level_options__button_2' style='display:none;'>";
					
						$tablestring .= "<div class='col_opt_row' id='body_label_other_font_family'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
								$columns['content_label_font_family'] = isset($columns['content_label_font_family']) ? $columns['content_label_font_family'] : "";
								$tablestring .= "<input type='hidden' id='content_label_font_family' value='".$columns['content_label_font_family']."' name='content_label_font_family_".$col_no[1]."' data-column='main_".$j."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='content_label_font_family_".$col_no[1]."' data-id='content_label_font_family_".$col_no[1]."'>";
									$tablestring .= "<dt><span>".$columns['content_label_font_family']."</span><input type='text' style='display:none;' value='".$columns['content_label_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='content_label_font_family' data-column='".$j."'>";
										
										
												
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='body_label_other_font_size'>";
							$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
									$columns['content_label_font_size'] = isset($columns['content_label_font_size']) ? $columns['content_label_font_size'] : "";
									$tablestring .= "<input type='hidden' id='content_label_font_size' name='content_label_font_size_".$col_no[1]."' value='".$columns['content_label_font_size']."' data-column='main_".$j."' />";
									$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='content_label_font_size_".$col_no[1]."' data-id='content_label_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
										$tablestring .= "<dt><span>".$columns['content_label_font_size']."</span><input type='text' style='display:none;' value='".$columns['content_label_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$tablestring .= "<dd>";
											$tablestring .= "<ul data-id='content_label_font_size' data-column='".$j."'>";
											$size_arr = array();
													for($s=8;$s<=20;$s++)
														$size_arr[]=$s;
													for($st=22;$st<=70;$st+=2)
														$size_arr[]=$st;
													foreach($size_arr as $size)  {
														$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
													}
											$tablestring .= "</ul>";
										$tablestring .= "</dd>";
									$tablestring .= "</dl>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							
							
							
							$columns['content_label_font_color'] = isset($columns['content_label_font_color']) ? $columns['content_label_font_color'] : "";
									$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
									$tablestring .= $arprice_form->font_color('content_label_font_color_'.$col_no[1],'main_'.$j,$columns['content_label_font_color'],'content_label_font_color',$columns['content_label_font_color']);
								$tablestring .= "</div>";
							$tablestring .= "</div>";
								
							
							
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='body_label_other_font_color'>";
						
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							
							
								$tablestring .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button2'>";
								
								
								
								
								
								if( isset($columns['body_label_style_bold']) && $columns['body_label_style_bold'] == 'bold' ){
										$bodylevel2_style_bold_selected = 'selected';
									}
									else{
										$bodylevel2_style_bold_selected = '';
									}
									
									
									
									if( isset($columns['body_label_style_italic']) && $columns['body_label_style_italic'] == 'italic' ){
										$bodylevel2_style_italic_selected = 'selected';
									}
									else{
										$bodylevel2_style_italic_selected = '';
									}
									
									
									
									if( isset($columns['body_label_style_decoration']) && $columns['body_label_style_decoration'] == 'underline' )
										{
											$bodylevel2_style_underline_selected = 'selected';
										}
										else{
											$bodylevel2_style_underline_selected = '';
										}
										
									if( isset($columns['body_label_style_decoration']) && $columns['body_label_style_decoration'] == 'line-through' )
										{
											$bodylevel2_style_linethrough_selected = 'selected';
										}
										else
										{
											$bodylevel2_style_linethrough_selected = '';
										}
								
								
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel2_style_bold_selected." arptooltipster' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left' data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel2_style_italic_selected." arptooltipster' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel2_style_underline_selected." arptooltipster' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel2_style_linethrough_selected." arptooltipster' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								$columns['body_label_style_bold'] = isset($columns['body_label_style_bold']) ? $columns['body_label_style_bold'] : "";
								$tablestring .= "<input type='hidden' id='body_label_style_bold' name='body_label_style_bold_".$col_no[1]."' value='".$columns['body_label_style_bold']."' /> ";
								$columns['body_label_style_italic'] = isset($columns['body_label_style_italic']) ? $columns['body_label_style_italic'] : "";
								$tablestring .= "<input type='hidden' id='body_label_style_italic' name='body_label_style_italic_".$col_no[1]."' value='".$columns['body_label_style_italic']."' /> ";
								$columns['body_label_style_decoration'] = isset($columns['body_label_style_decoration']) ? $columns['body_label_style_decoration']  :"";
								$tablestring .= "<input type='hidden' id='body_label_style_decoration' name='body_label_style_decoration_".$col_no[1]."' value='".$columns['body_label_style_decoration']."' /> ";
								
								
								
								
		
							$tablestring .= "</div>";
							
							//new font style btn ends
						
						
						$tablestring .= "</div>";
						
						
							
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='body_level_other_arp_ok_div__button_2' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='column_option_div' level-id='body_level_options__button_3' style='display:none;'>";
					
					$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'] = isset($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3']) ? $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'] : "";
					if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'] ) ){
						if( in_array('column_description',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'] ) ){
							$tablestring .= "<div class='col_opt_row' id='column_description'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Column Description',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									$tablestring .= "<textarea id='arp_column_description' name='arp_column_description_".$col_no[1]."'  class='col_opt_textarea' data-column='main_column_".$col_no[1]."'>";
										$tablestring .= stripslashes_deep($columns['column_description']);
									$tablestring .= "</textarea>";
								$tablestring .= "</div>";
								$tablestring .= "<div class='col_opt_button'>";
									if( in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3']) ){
										$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no[1]."' id='add_arp_object' data-insert='arp_column_description' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
											
										$tablestring .= "</button>";
										$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
									}
									
									if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3']) ){
										$tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no[1]."' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_".$j."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
											$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
										$tablestring .= "</button>";
									}
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_family'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									
									$tablestring .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_".$col_no[1]."' data-column='main_".$j."' value='".$columns['column_description_font_family']."' data-column='main_".$j."' />";
									$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_".$col_no[1]."' data-id='column_description_font_family_".$col_no[1]."'>";
										$tablestring .= "<dt><span>".$columns['column_description_font_family']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$tablestring .= "<dd>";
											$tablestring .= "<ul data-id='column_description_font_family' data-column='".$j."'>";
											
											
													
											$tablestring .= "</ul>";
										$tablestring .= "</dd>";
									$tablestring .= "</dl>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_size'>";
								$tablestring .= "<div class='btn_type_size'>";
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div two_column'>";
										
										$tablestring .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_".$col_no[1]."' value='".$columns['column_description_font_size']."' data-column='main_".$j."' />";
										$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_".$col_no[1]."' data-id='column_description_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
											$tablestring .= "<dt><span>".$columns['column_description_font_size']."</span><input type='text' style='display:none;' value='".$columns['column_description_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											$tablestring .= "<dd>";
												$tablestring .= "<ul data-id='column_description_font_size' data-column='".$j."'>";
												$size_arr = array();
														for($s=8;$s<=20;$s++)
															$size_arr[]=$s;
														for($st=22;$st<=70;$st+=2)
															$size_arr[]=$st;
														foreach($size_arr as $size)  {
															$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
														}
												$tablestring .= "</ul>";
											$tablestring .= "</dd>";
										$tablestring .= "</dl>";
									$tablestring .= "</div>";
								$tablestring .= "</div>";
								
								
									
										$tablestring .= "<div class='btn_type_size'>";
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div two_column'>";
										$tablestring .= $arprice_form->font_color('column_description_font_color_'.$col_no[1],'main_'.$j,$columns['column_description_font_color'],'column_description_font_color',$columns['column_description_font_color']);
									$tablestring .= "</div>";
								$tablestring .= "</div>";
									
								//end
								
							$tablestring .= "</div>";
							
							$tablestring .= "<div class='col_opt_row' id='column_description_other_font_color'>";
							
									$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
								$tablestring .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button3'>";
								
								
								//check selected for bold
								
								
								if( $columns['column_description_style_bold'] == 'bold' ){
										$bodylevel3_style_bold_selected = 'selected';
									}
									else{
										$bodylevel3_style_bold_selected = '';
									}
									
									//check selected for italic
									
									if( $columns['column_description_style_italic'] == 'italic' ){
										$bodylevel3_style_italic_selected = 'selected';
									}
									else{
										$bodylevel3_style_italic_selected = '';
									}
									
									//check selected for underline or line-through
									
									if( $columns['column_description_style_decoration'] == 'underline' )
										{
											$bodylevel3_style_underline_selected = 'selected';
										}
										else{
											$bodylevel3_style_underline_selected = '';
										}
										
									if( $columns['column_description_style_decoration'] == 'line-through' )
										{
											$bodylevel3_style_linethrough_selected = 'selected';
										}
										else
										{
											$bodylevel3_style_linethrough_selected = '';
										}
								
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel3_style_bold_selected." arptooltipster' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left' data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel3_style_italic_selected." arptooltipster' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel3_style_underline_selected." arptooltipster' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$bodylevel3_style_linethrough_selected." arptooltipster' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								
								
								$tablestring .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_".$col_no[1]."' value='".$columns['column_description_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_".$col_no[1]."' value='".$columns['column_description_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_".$col_no[1]."' value='".$columns['column_description_style_decoration']."' /> ";
								
								
								
								
		
							$tablestring .= "</div>";
							
							//new font style btn ends
								
							$tablestring .= "</div>";
						}
					}	
					
						
						
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='body_level_other_arp_ok_div__button_3' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						
						
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='column_option_div' level-id='button_options__button_4' style='display:none;'>";
					
						
					
					$tablestring .= "</div>";
				
				$tablestring .= "<div class='column_option_div' level-id='button_options__button_1' style='display:none;'>";
				
					// BUTTON TEXT
					$tablestring .= "<div class='col_opt_row' id='button_text' style='display:none;'>";
						$tablestring .= "<div class='col_opt_title_div'>".__('Button Content',ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div'>";
							$tablestring .= "<textarea id='btn_content' data-column='main_".$j."' name='btn_content_".$col_no[1]."' class='col_opt_textarea'>";
							$tablestring .= $columns['button_text'];
							$tablestring .= "</textarea>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
								
				
					// ADD ICON
					$tablestring .= "<div class='col_opt_row' id='add_icon' style='display:none;'>";
						$tablestring .= "<div class='col_opt_btn_div'>";
							$tablestring .= "<button onclick='add_arp_button_shortcode(this,false);' type='button' class='col_opt_btn arptooltipster' name='add_button_shortcode_".$col_no[1]."' id='add_button_shortcode' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."'>";
								/*$tablestring .= "<i class='fa fa-plus'></i>";
								$tablestring .= __('Add Icon',ARP_PT_TXTDOMAIN);*/
								$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
							$tablestring .= "</button>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='col_opt_row' id='button_size' style='display:none;'>";
						$tablestring .= "<div class='btn_type_size'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Button Size',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								global $arp_coloptionsarr;
								
								$tablestring .= "<input type='hidden' id='button_size_input' name='button_size_".$col_no[1]."' data-column='main_".$j."' value='".$columns['button_size']."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='button_size_".$col_no[1]."' data-id='button_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
									$tablestring .= "<dt><span>".$columns['button_size']."</span><input type='text' style='display:none;' value='".$columns['button_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='button_size_input' data-column='".$j."'>";
											foreach( $arp_coloptionsarr['column_button_options']['button_size'] as $btn_size ){
												$tablestring .= "<li data-value='".$btn_size."' data-label='".$btn_size."' >".$btn_size."</li>";
											}
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
									
					// BUTTON FONT FAMILY
					$tablestring .= "<div class='col_opt_row' id='button_other_font_family' style='display:none;'>";
						$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div'>";
							
							$tablestring .= "<input type='hidden' id='button_font_family' name='button_font_family_".$col_no[1]."' value='".$columns['button_font_family']."' data-column='main_".$j."' />";
							$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='button_font_family_".$col_no[1]."' data-id='button_font_family_".$col_no[1]."'>";
								$tablestring .= "<dt><span>".$columns['button_font_family']."</span><input type='text' style='display:none;' value='".$columns['button_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
								$tablestring .= "<dd>";
									$tablestring .= "<ul data-id='button_font_family' data-column='".$j."'>";
									
									
										
									$tablestring .= "</ul>";
								$tablestring .= "</dd>";
							$tablestring .= "</dl>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
					// BUTTON FONT SIZE
					$tablestring .= "<div class='col_opt_row' id='button_other_font_size' style='display:none;'>";
						$tablestring .= "<div class='btn_type_size'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								
								$tablestring .= "<input type='hidden' id='button_font_size' data-column='main_".$j."' name='button_font_size_".$col_no[1]."' value='".$columns['button_font_size']."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='button_font_size_".$col_no[1]."' data-id='button_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
									$tablestring .= "<dt><span>".$columns['button_font_size']."</span><input type='text' style='display:none;' value='".$columns['button_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='button_font_size' data-column='".$j."'>";
										$size_arr = array();
												for($s=8;$s<=20;$s++)
													$size_arr[]=$s;
												for($st=22;$st<=70;$st+=2)
													$size_arr[]=$st;
												foreach($size_arr as $size)  {
													$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
												}
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
				
						
						
						//font color btn
							$tablestring .= "<div class='btn_type_size'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								$tablestring .= $arprice_form->font_color('button_font_color_'.$col_no[1],'main_'.$j,$columns['button_font_color'],'button_font_color',$columns['button_font_color']);
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						//ends
						
					
					$tablestring .= "</div>";
				
					// BUTTON FONT COLOR
					$tablestring .= "<div class='col_opt_row' id='button_other_font_color'>";
					
						$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
							//new font style btns
							
							
								//check selected for bold
								
								
								if( $columns['button_style_bold'] == 'bold' ){
										$button1_style_bold_selected = 'selected';
									}
									else{
										$button1_style_bold_selected = '';
									}
									
									//check selected for italic
									
									if( $columns['button_style_italic'] == 'italic' ){
										$button1_style_italic_selected = 'selected';
									}
									else{
										$button1_style_italic_selected = '';
									}
									
									//check selected for underline or line-through
									
									if( $columns['button_style_decoration'] == 'underline' )
										{
											$button1_style_underline_selected = 'selected';
										}
										else{
											$button1_style_underline_selected = '';
										}
										
									if( $columns['button_style_decoration'] == 'line-through' )
										{
											$button1_style_linethrough_selected = 'selected';
										}
										else
										{
											$button1_style_linethrough_selected = '';
										}
							
							
								$tablestring .= "<div class='col_opt_input_div' data-level='button_level_options'  level-id='buttonoptions_button1' >";
								
								
								
								$tablestring .= "<div class='arp_style_btn ".$button1_style_bold_selected." arptooltipster' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left' data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$button1_style_italic_selected." arptooltipster' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$button1_style_underline_selected." arptooltipster' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn ".$button1_style_linethrough_selected." arptooltipster' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								
								$tablestring .= "<input type='hidden' id='button_style_bold' name='button_style_bold_".$col_no[1]."' value='".$columns['button_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='button_style_italic' name='button_style_italic_".$col_no[1]."' value='".$columns['button_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='button_style_decoration' name='button_style_decoration_".$col_no[1]."' value='".$columns['button_style_decoration']."' /> ";
								
								
								
		
							$tablestring .= "</div>";
							
							//new font style btn ends
						
					$tablestring .= "</div>";
					
					
					$tablestring .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_1'>";
						$tablestring .= "<div class='col_opt_btn_div'>";
							$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";							
								$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
							$tablestring .= "</button>";								
						$tablestring .= "</div>";
					$tablestring .= "</div>";	
					
					
					
				$tablestring .= "</div>";
				
				$tablestring .= "<div class='column_option_div' level-id='button_options__button_2' style='display:none;'>";
					
					// BUTTON IMAGE
					if($columns['btn_img'] != ''){$btn_img_height = $columns['btn_img_height'];}else{$btn_img_height='';}
					if($columns['btn_img'] != ''){$btn_img_width = $columns['btn_img_width'];}else{$btn_img_width='';}
					$tablestring .= "<div class='col_opt_row' id='button_image' style='display:none;'>";
						$tablestring .= "<div class='col_opt_title_div'>".__('Button Image url',ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div'>";
						$tablestring .= "<input type='text' id='btn_img_url' class='col_opt_input arpbtn_img_url' name='btn_img_url_".$col_no[1]."' value='".$columns['btn_img']."'>";
						$tablestring .= "</div>";
						$tablestring .= "<input type='hidden' class='arpbtn_img_height' id='arpbtn_img_height' value='".$btn_img_height."' name='button_img_height_".$col_no[1]."' />";
						$tablestring .= "<input type='hidden' class='arpbtn_img_width' id='arpbtn_img_width' value='".$btn_img_width."' name='button_img_width_".$col_no[1]."' />";
					$tablestring .= "</div>";
				
					// ADD SHORTCODE
					$tablestring .= "<div class='col_opt_row' id='add_shortcode' style='display:none;'>";
						$tablestring .= "<div class='col_opt_btn_div'>";
							$tablestring .= "<button onclick='add_arp_button_scode(this,false);' type='button' class='col_opt_btn arptooltipster' name='add_button_scode_".$col_no[1]."' id='add_button_scode' title='".__('Add Button Image',ARP_PT_TXTDOMAIN)."'>";
								
								$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
							$tablestring .= "</button>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
					
					$tablestring .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_2' style='display:none;'>";
						$tablestring .= "<div class='col_opt_btn_div'>";
							$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
								$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
							$tablestring .= "</button>";							
						$tablestring .= "</div>";
					$tablestring .= "</div>";						
								
				$tablestring .= "</div>";
				
				$tablestring .= "<div class='column_option_div' level-id='button_options__button_3' style='display:none;'>";
				
					// REDIRECT LINK
					$tablestring .= "<div class='col_opt_row' id='redirect_link' style='display:none;'>";
						$tablestring .= "<div class='col_opt_title_div'>".__('Button Link', ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div'>";
							$tablestring .= "<input type='text' id='btn_link' class='col_opt_input' name='btn_link_".$col_no[1]."' value='".$columns['button_url']."' />";
						$tablestring .= "</div>";
					$tablestring .= "</div>";	
				
					// OPEN IN NEW WINDOW
					$tablestring .= "<div class='col_opt_row' id='open_in_new_window' style='display:none;'>";
						$tablestring .= "<div class='col_opt_title_div two_column more_size'>".__('Open in New Window?',ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div two_column small_size'>";
							$tablestring .= "<div class='arp_checkbox_div'>";
								if( $columns['is_new_window'] == 1 )
									$new_window = 'checked="checked"';
								else
									$new_window = '';
									
								$tablestring .= "<input type='checkbox' class='arp_checkbox dark_bg' ".$new_window." id='new_window' value='1' name='new_window_".$col_no[1]."' />";
								$tablestring .= "<label class='arp_checkbox_label'>".__('Yes',ARP_PT_TXTDOMAIN)."</label>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
					//Paypal Code
					$columns['paypal_code'] = isset($columns['paypal_code']) ? $columns['paypal_code'] : "";
					
					$tablestring .= "<div class='col_opt_row' id='external_btn' style='display:none;'>";
						$tablestring .= "<div class='col_opt_title_div'>".__('Button Script (e.g. PayPal Code)',ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div'>";
							$tablestring .= "<textarea class='col_opt_textarea' name='paypal_code_".$col_no[1]."' id='arp_paypal_code'>";
							$tablestring .= $columns['paypal_code'];
							$tablestring .= "</textarea>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
						
					$tablestring .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_3' style='display:none;'>";
						$tablestring .= "<div class='col_opt_btn_div'>";							
							$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
								$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
							$tablestring .= "</button>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
								
				$tablestring .= "</div>";
				
				// SECOND BUTTON OPTIONS
				
				$tablestring .= "<div class='column_option_div' level-id='second_button_options__button_1' style='display:none;'>";
					
					$tablestring .= "<div class='col_opt_row' id='button_text_s'>";
						$tablestring .= "<div class='col_opt_title_div'>".__('Button Content',ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div'>";
							$tablestring .= "<textarea id='second_btn_content' data-column='main_".$j."' name='second_btn_content_".$col_no[1]."' class='col_opt_textarea'>";
								$tablestring .= $columns['button_s_text'];
							$tablestring .= "</textarea>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='col_opt_row' id='add_icon_s'>";
						$tablestring .= "<div class='col_opt_btn_div'>";
							$tablestring .= "<button onclick='add_arp_button_shortcode(this,true);' type='button' class='col_opt_btn tooltipster' name='second_add_button_shortcode_".$col_no[1]."' id='second_add_button_shortcode' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."'>";
								/*$tablestring .= "<i class='fa fa-plus'></i>";
								$tablestring .= __('Add Icon',ARP_PT_TXTDOMAIN);*/
								$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
							$tablestring .= "</button>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
					$columns['paypal_s_code'] = isset($columns['paypal_s_code']) ? $columns['paypal_s_code'] : "";
					$tablestring .= "<div class='col_opt_row' id='external_btn_s'>";
						$tablestring .= "<div class='col_opt_title_div'>".__('Button Script (e.g. PayPal Code)',ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div'>";
							$tablestring .= "<textarea class='col_opt_textarea' name='second_paypal_code_".$col_no[1]."' id='arp_paypal_code'>";
							$tablestring .= $columns['paypal_s_code'];
							$tablestring .= "</textarea>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='col_opt_row' id='second_button_other_font_family'>";
						$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div'>";
							
							$columns['second_button_font_family'] = isset($columns['second_button_font_family']) ? $columns['second_button_font_family'] : "";
							$tablestring .= "<input type='hidden' id='second_button_font_family' name='second_button_font_family_".$col_no[1]."' value='".$columns['second_button_font_family']."' data-column='main_".$j."' />";
							$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='second_button_font_family_".$col_no[1]."' data-id='second_button_font_family_".$col_no[1]."'>";
								$columns['second_button_font_family'] = isset($columns['second_button_font_family']) ? $columns['second_button_font_family'] : "";
								$tablestring .= "<dt><span>".$columns['second_button_font_family']."</span><input type='text' style='display:none;' value='".$columns['second_button_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
								$tablestring .= "<dd>";
									$tablestring .= "<ul data-id='second_button_font_family' data-column='".$j."'>";
									
											
											
									$tablestring .= "</ul>";
								$tablestring .= "</dd>";
							$tablestring .= "</dl>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='col_opt_row' id='second_button_other_font_size'>";
						$tablestring .= "<div class='btn_type_size'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								
								$columns['second_button_font_size'] = isset($columns['second_button_font_size']) ? $columns['second_button_font_size'] : "";
								$tablestring .= "<input type='hidden' id='second_button_font_size' name='second_button_font_size_".$col_no[1]."' value='".$columns['second_button_font_size']."' data-column='main_".$j."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='second_button_font_size_".$col_no[1]."' data-id='second_button_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
								$columns['second_button_font_size'] = isset($columns['second_button_font_size']) ? $columns['second_button_font_size'] : "";
									$tablestring .= "<dt><span>".$columns['second_button_font_size']."</span><input type='text' style='display:none;' value='".$columns['second_button_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='second_button_font_size' data-column='".$j."'>";
										$size_arr = array();
												for($s=8;$s<=20;$s++)
													$size_arr[]=$s;
												for($st=22;$st<=70;$st+=2)
													$size_arr[]=$st;
												foreach($size_arr as $size)  {
													$tablestring .= "<li data-value='".$size."' data-label='".$size."'>".$size."</li>";
												}
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='btn_type_size'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
							
							$columns['second_button_font_style'] = isset($columns['second_button_font_style']) ? $columns['second_button_font_style'] : "";	
								$tablestring .= "<input type='hidden' id='second_button_font_style' name='second_button_font_style_".$col_no[1]."' value='".$columns['second_button_font_style']."' data-column='main_".$j."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='second_button_font_style_".$col_no[1]."' data-id='second_button_font_style_".$col_no[1]."' style='width:115px;max-width:115px;'>";
								$columns['second_button_font_style'] = isset($columns['second_button_font_style']) ? $columns['second_button_font_style'] : "";
									$tablestring .= "<dt><span>".$columns['second_button_font_style']."</span><input type='text' style='display:none;' value='".$columns['second_button_font_style']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='second_button_font_style' data-column='".$j."'>";
												$tablestring .= $arprice_form->font_style_new();
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
				
					$tablestring .= "<div class='col_opt_row' id='second_button_other_font_color'>";
						$tablestring .= "<div class='btn_type_size'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Color',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
							$columns['second_button_font_color'] = isset($columns['second_button_font_color']) ? $columns['second_button_font_color'] : "";
								$tablestring .= $arprice_form->font_color('second_button_font_color_'.$col_no[1],'main_'.$j,$columns['second_button_font_color'],'second_button_font_color',$columns['second_button_font_color']);
							$tablestring .= "</div>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
						
					$tablestring .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_1' style='display:none;'>";
						$tablestring .= "<div class='col_opt_btn_div'>";
							$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
								$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
							$tablestring .= "</button>";							
						$tablestring .= "</div>";
					$tablestring .= "</div>";
						
									
				$tablestring .= "</div>";
				
				$tablestring .= "<div class='column_option_div' level-id='second_button_options__button_2' style='display:none;'>";
					
					$tablestring .= "<div class='col_opt_row' id='button_image_s'>";
						$tablestring .= "<div class='col_opt_title_div'>".__('Button Image url',ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div'>";
							$tablestring .= "<input type='text' id='second_btn_img_url' class='col_opt_input arpbtn_img_url' name='second_btn_img_url_".$col_no[1]."'>";
						$tablestring .= "</div>";
						$tablestring .= "<input type='hidden' id='second_arpbtn_img_height' class='arpbtn_img_height' value='' name='second_button_img_height_".$col_no[1]."' />";
						$tablestring .= "<input type='hidden' id='second_arpbtn_img_width' class='arpbtn_img_width' value='' name='second_button_img_width_".$col_no[1]."' />";
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='col_opt_row' id='add_shortcode_s'>";
						$tablestring .= "<div class='col_opt_btn_div'>";
							$tablestring .= "<button onclick='add_arp_button_scode(this,true);' type='button' class='col_opt_btn arptooltipster' name='second_add_button_scode_".$col_no[1]."' id='second_add_button_scode' title='".__('Add Button Image',ARP_PT_TXTDOMAIN)."'>";
								
								$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
							$tablestring .= "</button>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";

					$tablestring .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_2' style='display:none;'>";
						$tablestring .= "<div class='col_opt_btn_div'>";
							$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
								$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
							$tablestring .= "</button>";							
						$tablestring .= "</div>";
					$tablestring .= "</div>";
										
				$tablestring .= "</div>";
				
				$tablestring .= "<div class='column_option_div' level-id='second_button_options__button_3' style='display:none;'>";
					
					$tablestring .= "<div class='col_opt_row' id='redirect_link_s'>";
						$tablestring .= "<div class='col_opt_title_div'>".__('Button Link', ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div'>";
							$columns['button_s_url'] = isset($columns['button_s_url']) ? $columns['button_s_url'] : "";
							$tablestring .= "<input type='text' id='second_btn_link' class='col_opt_input' name='second_btn_link_".$col_no[1]."' value='".$columns['button_s_url']."' />";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='col_opt_row' id='open_in_new_window_s'>";
						$tablestring .= "<div class='col_opt_title_div two_column more_size'>".__('Open in New Window?',ARP_PT_TXTDOMAIN)."</div>";
						$tablestring .= "<div class='col_opt_input_div two_column small_size'>";
							$tablestring .= "<div class='arp_checkbox_div'>";
								if( $columns['s_is_new_window'] == 1 )
									$new_window = 'checked="checked"';
								else
									$new_window = '';
									
								$tablestring .= "<input type='checkbox' class='arp_checkbox dark_bg' ".$new_window." id='second_new_window' value='1' name='second_new_window_".$col_no[1]."' />";
								$tablestring .= "<label class='arp_checkbox_label'>".__('Yes',ARP_PT_TXTDOMAIN)."</label>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='col_opt_row' id='button_size_s'>";
						$tablestring .= "<div class='btn_type_size'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Button Size',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								$col_no = explode('_',$j);
								global $arp_coloptionsarr;
							
							
								$tablestring .= "<input type='hidden' id='second_button_size' data-column='main_".$j."' name='second_button_size_".$col_no[1]."' value='".$columns['button_s_size']."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='second_button_size_".$col_no[1]."' data-id='second_button_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
									$tablestring .= "<dt><span>".$columns['button_s_size']."</span><input type='text' style='display:none;' value='".$columns['button_s_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='second_button_size' data-column='".$j."'>";
											foreach( $arp_coloptionsarr['column_button_options']['button_size'] as $btn_size ){
												$tablestring .= "<li data-value='".$btn_size."' data-label='".$btn_size."' >".$btn_size."</li>";
											}
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_3' style='display:none;'>";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
				
				$tablestring .= "</div>";
				
				$tablestring .= "</div>";
				
				$tablestring .= "<div class='column_option_div' level-id='second_button_options__button_4' style='display:none;'>";
					
										
				$tablestring .= "</div>";
				
				$tablestring .= "<div class='column_option_div' level-id='body_li_level_options__button_1' style='display:none;'>";
				
					foreach( $columns['rows'] as $n=> $row )
					{
						$row_no = explode('_',$n);
						$splitedid = explode('_',$n);
						
					
						$tablestring .= "<div id='arp_".$n."' class='arp_row_wrapper' style='display:none;'>";
							
							if(in_array( 'label',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_1'] )){
							
							
							$tablestring .= "<div class='col_opt_row arp_".$n."' id='label".$splitedid[1]."'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Label',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									$tablestring .= "<textarea id='label' class='col_opt_textarea' name='row_".$col_no[1]."_label_".$row_no[1]."'>";
										$tablestring .= stripslashes_deep($row['row_label']);
									$tablestring .= "</textarea>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							
							if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_1'] ) ){
							
								if(in_array( 'arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_1'] )){
							$tablestring .= "<div class='col_opt_row arp_".$n."' id='body_tooltip_add_shortcode".$splitedid[1]."' >";
								$tablestring .= "<div class='col_opt_btn_div'>";
									$tablestring .= "<button type='button' class='col_opt_btn arptooltipster arp_add_label_shortcode' id='arp_add_label_shortcode' name='row_".$col_no[1]."_add_tooltip_shortcode_btn_".$row_no[1]."' col-id=".$col_no[1]." data-id='".$col_no[1]."' data-row-id='label_".$splitedid[1]."' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
										/*$tablestring .= "<i class='fa fa-plus'></i>";
										$tablestring .= __('Add Shortcode',ARP_PT_TXTDOMAIN);*/
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$tablestring .= "</button>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							}
						}	
						
						}	
							
							$tablestring .= "<div class='col_opt_row arp_".$n."' id='description".$splitedid[1]."'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Description',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									$tablestring .= "<textarea id='arp_li_description' col-id=".$col_no[1]." class='col_opt_textarea' name='row_".$col_no[1]."_description_".$row_no[1]."'>";
										$tablestring .= stripslashes_deep($row['row_description']);
									$tablestring .= "</textarea>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							
							
							$tablestring .= "<div class='col_opt_row arp_".$n."' id='body_li_add_shortcode".$splitedid[1]."' >";
								$tablestring .= "<div class='col_opt_btn_div'>";	
									$tablestring .= "<button type='button' class='col_opt_btn_icon arp_add_row_object arptooltipster' name='".$col_no[1]."_add_body_li_object_".$row_no[1]."' id='arp_add_row_object' data-insert='arp_".$n." textarea#arp_li_description' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
									$tablestring .= "</button>";
								$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
	
	
									$tablestring .= "<button type='button' class='col_opt_btn arptooltipster arp_add_row_shortcode' id='arp_add_row_shortcode' name='row_".$col_no[1]."_add_description_shortcode_btn_".$row_no[1]."' col-id=".$col_no[1]." data-id='".$col_no[1]."' data-row-id='' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$tablestring .= "</button>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						//

							
							$tablestring .= "<div class='col_opt_row arp_ok_div arp_".$n."' id='body_li_level_other_arp_ok_div__button_1".$splitedid[1]."' >";
								$tablestring .= "<div class='col_opt_btn_div'>";
									$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
										$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
									$tablestring .= "</button>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
						$tablestring .= "</div>";					
												
					}
				
				$tablestring .= "</div>";
				
				
				$tablestring .= "<div class='column_option_div' level-id='body_li_level_options__button_2' style='display:none;'>";
				
					foreach( $columns['rows'] as $n=> $row )
					{
						$row_no = explode('_',$n);
						$splitedid = explode('_',$n);
						
						$tablestring .= "<div class='arp_tooltip_wrapper' id='arp_".$n."' style='display:none;'>";
							$tablestring .= "<div class='col_opt_row arp_".$n."' id='tooltip".$splitedid[1]."' >";
								$tablestring .= "<div class='col_opt_title_div'>".__('Tooltip',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									$tablestring .= "<textarea id='arp_li_tooltip' col-id=".$col_no[1]." class='col_opt_textarea' name='row_".$col_no[1]."_tooltip_".$row_no[1]."'>";
										$tablestring .= stripslashes_deep($row['row_tooltip']);
									$tablestring .= "</textarea>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_2'] ) ){
							
								if(in_array( 'arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_2'] )){
							$tablestring .= "<div class='col_opt_row arp_".$n."' id='body_tooltip_add_shortcode".$splitedid[1]."' >";
								$tablestring .= "<div class='col_opt_btn_div'>";
									$tablestring .= "<button type='button' class='col_opt_btn arptooltipster arp_add_tooltip_shortcode' id='arp_add_tooltip_shortcode' name='row_".$col_no[1]."_add_tooltip_shortcode_btn_".$row_no[1]."' col-id=".$col_no[1]." data-id='".$col_no[1]."' data-row-id='tooltip_".$splitedid[1]."' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
										/*$tablestring .= "<i class='fa fa-plus'></i>";
										$tablestring .= __('Add Shortcode',ARP_PT_TXTDOMAIN);*/
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$tablestring .= "</button>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							}
						}	
						
							$tablestring .= "<div class='col_opt_row arp_ok_div arp_".$n."' id='body_li_level_other_arp_ok_div__button_2".$splitedid[1]."'  >";
									$tablestring .= "<div class='col_opt_btn_div'>";
										$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
											$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
										$tablestring .= "</button>";
									$tablestring .= "</div>";	
							$tablestring .= "</div>";
							
						$tablestring .= "</div>";
					}
				
				$tablestring .= "</div>";
				
				$tablestring .= "<div class='column_option_div' level-id='body_li_level_options__button_3' style='display:none;'>";
								if( is_array($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3']) ){
					if(in_array( 'label',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] )){	
	
					foreach( $columns['rows'] as $n=>$row ){
						$row_no = explode('_',$n);
						$splitedid = explode('_',$n);
						
						$tablestring .= "<div class='arp_row_label_wrapper' id='arp_".$n."' style='display:none;'>";
							$tablestring .= "<div class='col_opt_row arp_".$n."' id='label".$splitedid[1]."'>";
								$tablestring .= "<div class='col_opt_title_div'>".__('Label',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div'>";
									$tablestring .= "<textarea id='label' class='col_opt_textarea' name='row_".$col_no[1]."_label_".$row_no[1]."'>";
										$tablestring .= stripslashes_deep($row['row_label']);
									$tablestring .= "</textarea>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							
							
							$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] = isset($arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3']) ? $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] : "";
							if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] ) ){
							
								if(in_array( 'arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] )){
							$tablestring .= "<div class='col_opt_row arp_".$n."' id='body_tooltip_add_shortcode".$splitedid[1]."' >";
								$tablestring .= "<div class='col_opt_btn_div'>";
									$tablestring .= "<button type='button' class='col_opt_btn arptooltipster arp_add_label_shortcode' id='arp_add_label_shortcode' name='row_".$col_no[1]."_add_tooltip_shortcode_btn_".$row_no[1]."' col-id=".$col_no[1]." data-id='".$col_no[1]."' data-row-id='label_".$splitedid[1]."' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
										/*$tablestring .= "<i class='fa fa-plus'></i>";
										$tablestring .= __('Add Shortcode',ARP_PT_TXTDOMAIN);*/
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$tablestring .= "</button>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
							}
						}	
							
							
							$tablestring .= "<div class='col_opt_row arp_ok_div arp_".$n."' id='body_li_level_other_arp_ok_div__button_3".$splitedid[1]."'>";
								$tablestring .= "<div class='col_opt_btn_div'>";
									$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
										$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
									$tablestring .= "</button>";						
								$tablestring .= "</div>";
							$tablestring .= "</div>";	
							
						$tablestring .= "</div>";
					}
				}	
			}	
				$tablestring .= "</div>";
				
				
					
					
								
				$tablestring .= "</div>";
			$tablestring .= "</div>";
			

		
?>