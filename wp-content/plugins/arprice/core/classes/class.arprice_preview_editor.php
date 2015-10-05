<?php
if( ! function_exists( 'arp_get_pricing_table_string_editor' ) ){
	function arp_get_pricing_table_string_editor( $table_id, $pricetable_name = "", $is_tbl_preview = 0, $general_option = '', $opts='', $is_clone = '' ) {
	
	
	
	global $wpdb,$arprice_form,$arprice_fonts;
	$id 	= $table_id;
	$name 	= $pricetable_name;
	
	global $arp_tempbuttonsarr,$arp_mainoptionsarr,$arprice_form,$arprice_fonts;
	
	$tablestring = "";
	$title_cls = "";
	$header_cls = "";
	
 	$tablestring .= "   <style type='text/css'>
	    body { overflow-x: hidden;} 
		.tooltipster-content{
			font-family: 'Open Sans' !important;
			font-size: 13px;
			font-weight: normal;
			line-height: normal !important;
			padding: 5px 10px !important;
		}
		.tooltipster-base{
			width:auto !important;
			border:none;
			border-radius:2px;
				-moz-border-radius:2px;
				-webkit-border-radius:2px;
				-o-border-radius:2px;
			min-height:30px;
			box-shadow:0 1px 2px rgba(0, 0, 0, 0.5);
				-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.5);
				-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.5);
				-o-box-shadow:0 1px 2px rgba(0, 0, 0, 0.5);
			background:#D9534F;
			color:#ffffff;
		}
	</style>";

	if( isset($_REQUEST['arp_action']) && $_REQUEST['arp_action'] == 'edit' ){
	
    	$tablestring .= "<script type='text/javascript' language='javascript'>
			jQuery(document).ready(function(){
				var right_side_tooltip_options = '';
				var left_side_tooltip_options = '';
				//console.log('this is document ready');
								
				left_side_tooltip_options = {
					position:'bottom',
					arrow:true,
					multiple:true,
					functionBefore: function(origin, continueTooltip) {
						//console.log('inside');
						jQuery(document).find('body').css('overflow-x','hidden');
						// we'll make this function asynchronous and allow the tooltip to go ahead and show the loading notification while fetching our data
						continueTooltip();
						
					}
				};
				
				jQuery('.btn:not(\'.selected\')').tooltipster(left_side_tooltip_options);
				
			});
		</script>";
    }
	if( $is_tbl_preview && $is_tbl_preview == 1 )
	{
		if( isset($_REQUEST['optid']) && $_REQUEST['optid'] != '' )
		{
			$post_values = get_option( $_REQUEST['optid'] );
			$get_preview_data = $arprice_form->get_preview_table( $post_values );
			//update_option( $_REQUEST['optid'], '' );
			$id	= $table_id	= $get_preview_data['table_id'];
			$is_animated = $get_preview_data['is_animated'];
			$opts = maybe_unserialize($get_preview_data['table_options']);
			$general_option = maybe_unserialize($get_preview_data['general_options']);
		}
	} else if ( $is_tbl_preview && $is_tbl_preview == 3 ){
		
		$opts = maybe_unserialize($opts);
		$general_option = maybe_unserialize($general_option);
		
	} else {
		$sql = $wpdb->get_row( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice WHERE ID = %d AND status = %s ", $id, 'published') );
		$table_id = $sql->ID;
		$sql_opt = $wpdb->get_results( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice_options WHERE table_id = %d ", $table_id) );
		$is_animated = $sql->is_animated;
		$opts 			= maybe_unserialize($sql_opt[0]->table_options);
		$general_option = maybe_unserialize( $sql->general_options );
		$is_template = $sql->is_template;
		apply_filters('arp_append_googlemap_js',$table_id);
	}
	
	$table_cols = array();
	$table_cols = $table_cols_new = $opts['columns'];
	
	$maxrowcount = 0;
	if(is_array($table_cols))
	{
		foreach($table_cols as $countcol )
		{
			if($countcol['rows'] && count($countcol['rows']) > $maxrowcount)
				$maxrowcount = count($countcol['rows']); 
		}	
		$maxrowcount--;
	}
		
	$opts['columns'] = $table_cols;
		
	$column_animation	= $general_option['column_animation'];
	
	$is_animation = $column_animation['is_animation'];
	
	$column_settings = $general_option['column_settings'];
	
	$hover_type = $column_settings['column_highlight_on_hover'];
	
	$template_settings = $general_option['template_setting'];
	
	$general_settings = $general_option['general_settings'];
	
	$template_type = $template_settings['template_type'];
	
	$template = $template_settings['template'];
	
	$ref_template = $general_settings['reference_template'];
	
	$template_id = $template_settings['template'];
	
	$tooltip_settings = $general_option['tooltip_settings'];
	
	$arp_template_skin = $template_settings['skin'];
	
	$reference_template = $general_settings['reference_template'];
	
	$caption_col = array();
	
	if(is_array($opts['columns']))
	{	
	foreach( $opts['columns'] as $key=>$val ){
		if( $val['is_caption'] == 1 ){
			$caption_col[] = 1;
		} else {
			$caption_col[] = 0;
		}
	}
	}
	$tablestring .= "<div class='pricingtable_menu_belt' style='display:block;'>";
		
		$tablestring .= "<div class='pricingtable_menu_inner'>";
			
			$tablestring .= "<div class='pricing_table_main'>";
				
				$tablestring .= "<div class='pt_table_main_cnt'>";
					$tablestring .= "<label class='header_table_name enable' id='main_table_name' data-image='".PRICINGTABLE_IMAGES_URL."/icons/edit-icon_hover.png' data-field='pricing_table_main'>";
						$tablestring .= $name;
					$tablestring .= "</label>";
					$tablestring .= "<input type='hidden' name='pricing_table_main' id='pricing_table_main' class='txt_price_tabe' value='".$name."'>";
				$tablestring .= "</div>";
				
			$tablestring .= "</div>";
			
			$tablestring .= "<div class='pricing_table_btns'>";
      
	  			$tablestring .= "<div class='btn_field' style='float:right;' >";
                            
					$tablestring .= "<div class='savebtn enable' id='save_btn' title=''>";
                    	
							$tablestring .= "<div class='savebtnimg'>&nbsp;</div>";
                                
							$tablestring .= "<div class='savebtndiv'>".__('Save',ARP_PT_TXTDOMAIN)."</div>";
							
					$tablestring .= "</div>";
						                            
					$tablestring .= "<div class='savebtn' data-src='".$arprice_form->get_direct_link()."' id='preview_btn' onClick='arp_preview_new(\"".$arprice_form->get_direct_link()."\");' >";
						$tablestring .= "<div class='previewbtnimg'>&nbsp;</div>";
						
						$tablestring .= "<div class='savebtndiv'>".__('Preview',ARP_PT_TXTDOMAIN)."</div>";
						
					$tablestring .= "</div>";
                            
					$tablestring .= "<div class='savebtn' id='template_close_btn' onClick='javascript:location.href=\"admin.php?page=arprice\"'>";
						
						$tablestring .= "<div class='closebtnimg'>&nbsp;</div>";
						
						$tablestring .= "<div class='savebtndiv'>".__('Close',ARP_PT_TXTDOMAIN)."</div>";
							
					$tablestring .= "</div>";
                            
					$arp_template = isset($arp_template) ? $arp_template : '';
					$arp_template_skin = ($arp_template_skin) ? $arp_template_skin : '';
					$arptemplate_1 = ($id) ? 'arptemplate_'.$id : '';
					$tablestring .= "<input type='hidden' name='arp_template' id='arp_template' value='".$arptemplate_1."' />";
					$tablestring .= "<input type='hidden' name='arp_template_old' id='arp_template_old' value='".$arp_template."' />";
					$tablestring .= "<input type='hidden' name='arp_template_skin' id='arp_template_skin' value='".$arp_template_skin."' />";
							
				$tablestring .= "</div>";
					
			$tablestring .= "</div>";
		
		$tablestring .= "</div>";
		
		$tablestring .= "<div class='general_options_bar'>";
			
			$tablestring .= "<div class='general_options_bar_content'>";
				
				$tablestring .= "<div class='general_column_options_tab enable global_opts'>";
					
					$tablestring .= "<div class='general_column_options_tabimg'>&nbsp;</div>";
					
					$tablestring .= "<div class='general_column_options_tabdiv'>".__('Column Options',ARP_PT_TXTDOMAIN)."</div>";
					
					$tablestring .= "<div class='column_option_dropdown' id='column_option_dropdown'>";
						
						$tablestring .= "<div class='column_content_light_row column_opt_row'>";
						
							$tablestring .= "<div class='column_opt_label'>".__('Allow Space between Column',ARP_PT_TXTDOMAIN)."</div>";
							
							$tablestring .= "<div class='column_opt_opts'>";
																
								$tablestring .= "<input type='checkbox' name='space_between_column' id='space_between_column' value='yes' ".checked($column_settings['space_between_column'],'yes',false)." class='arp_checkbox light_bg' />";
							
							$tablestring .= "</div>";
						
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='column_content_dark_row column_opt_row'>";
						
							$tablestring .= "<div class='column_opt_label'>".__('Space between Columns',ARP_PT_TXTDOMAIN)."</div>";
							
							$tablestring .= "<div class='column_opt_opts'>";
							
								$tablestring .= "<input type='text' name='column_space' class='arp_tab_txt' value='".$column_settings['column_space']."' id='column_space' /><label style='float:left;margin-left:3px;margin-top:24px;font-size:13px;'>".__('Px',ARP_PT_TXTDOMAIN)."</label>";
							
							$tablestring .= "</div>";
						
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='column_content_dark_row column_opt_row'>";
						
							$tablestring .= "<div class='column_opt_label'>".__('Column Width',ARP_PT_TXTDOMAIN)."</div>";
							
							$tablestring .= "<div class='column_opt_opts'>";
								$column_width_readonly = '';
								if( $column_settings['is_responsive'] == 1 ){
									$column_width_readonly = 'readonly="readonly"';
								} else {
									$column_width_readonly = '';
								}
								$tablestring .= "<input type='text' ".$column_width_readonly." name='all_column_width' class='arp_tab_txt' value='".$column_settings['all_column_width']."' id='all_column_width' /><label style='float:left;margin-left:3px;margin-top:24px;font-size:13px;'>".__('Px',ARP_PT_TXTDOMAIN)."</label>";
							
							$tablestring .= "</div>";
						
						$tablestring .= "</div>";
						
						
						$tablestring .= "<div class='column_content_light_row column_opt_row'>";
							
							$tablestring .= "<div class='column_opt_label'>".__('Is responsive?',ARP_PT_TXTDOMAIN)."</div>";
							
							$tablestring .= "<div class='column_opt_opts'>";
							
								$tablestring .= "<input type='checkbox' name='is_responsive' id='is_responsive' class='arp_checkbox light_bg' value='1' ".checked($column_settings['is_responsive'],1,false)." />";
							
							$tablestring .= "</div>";
							
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='column_content_light_row column_opt_row'>";
						
							$tablestring .= "<div class='column_opt_label'>".__('Column Width (minimum)',ARP_PT_TXTDOMAIN)."</div>";
							
							$tablestring .= "<div class='column_opt_opts' id='column_min_width'>";
								$column_min_width = '';
								if( $column_settings['column_min_width'] == '' or $column_settings['column_min_width'] < 1){
									$column_min_width = $arp_mainoptionsarr['general_options']['template_options']['arp_min_max_width'][$reference_template]['min-width'];
								} else {
									$column_min_width = $column_settings['column_min_width'];
								}
								$cl_min_width = '';
								if( $column_settings['is_responsive'] == 1 ){
									$cl_min_width = '';
								} else {
									$cl_min_width = 'readonly="readonly"';
								}
								$tablestring .= "<input type='text' name='column_min_width' ".$cl_min_width." class='arp_tab_txt' value='".$column_min_width."' id='column_min_width' /><label style='float:left;margin-left:3px;margin-top:24px;font-size:13px;'>".__('Px',ARP_PT_TXTDOMAIN)."</label>";
								
							$tablestring .= "</div>";
						
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='column_content_dark_row column_opt_row'>";
						
							$tablestring .= "<div class='column_opt_label'>".__('Column Width (maximum)',ARP_PT_TXTDOMAIN)."</div>";
							
							$tablestring .= "<div class='column_opt_opts' id='column_max_width'>";
								
								$cl_max_width = '';
								if( $column_settings['is_responsive'] == 1 ){
									$cl_max_width = '';
								} else {
									$cl_max_width = 'readonly="readonly"';
								}
								
								$tablestring .= "<input type='text' ".$cl_max_width." name='column_max_width' class='arp_tab_txt' value='".$column_settings['column_max_width']."' id='column_max_width' /><label style='float:left;margin-left:3px;margin-top:24px;font-size:13px;'>".__('Px',ARP_PT_TXTDOMAIN)."</label>";
								
							$tablestring .= "</div>";
						
						$tablestring .= "</div>";
						
						
						if( in_array( 1, $caption_col ) )
							$style = 'display:block;';
						else
							$style = 'display:none;';
							
						$tablestring .= "<div class='column_content_dark_row column_opt_row' id='column_content_hide_caption_column' style='".$style."'>";
							
							$tablestring .= "<div class='column_opt_label'>".__('Hide Caption Column',ARP_PT_TXTDOMAIN)."</div>";
							
							$tablestring .= "<div class='column_opt_opts'>";
								
								$column_settings['hide_caption_column'] = isset($column_settings['hide_caption_column']) ? $column_settings['hide_caption_column'] : "";
								$tablestring .= "<input type='checkbox' name='hide_caption_column' id='hide_caption_column' class='arp_checkbox light_bg' value='1' ".checked($column_settings['hide_caption_column'],1,false)." />";
							
							$tablestring .= "</div>";
							
						$tablestring .= "</div>";
						
						if( in_array( 1, $caption_col ) )
							$cls = 'column_content_light_row';
						else
							$cls = 'column_content_dark_row';
						
						if( $is_animation ==  1 or $is_animation == 'yes' )
							$display = 'display:none;';
						else
							$display = 'display:block';
						
						$tablestring .= "<div class='".$cls." column_opt_row' id='column_content_opacity' style='".$display."' >";
							
							$tablestring .= "<div class='column_opt_label'>".__('Opacity',ARP_PT_TXTDOMAIN)."</div>";
							
							$tablestring .= "<div class='column_opt_opts'>";
							
								$tablestring .= "<input type='hidden' name='column_opacity' id='column_opacity' value='".$column_settings['column_opacity']."' />";
								
								$tablestring .= "<dl class='arp_selectbox' id='column_opacity_dd' data-name='column_opacity' data-id='column_opacity' style='width:30%;margin-top:28px;float:left;'>";
								
									if( $column_settings['column_opacity'] ){
										$arp_selectbox_placeholder = $column_settings['column_opacity'];
									} else {
										$arp_selectbox_placeholder = __('Choose Option',ARP_PT_TXTDOMAIN);
									}
									
									$tablestring .= "<dt><span>".$arp_selectbox_placeholder."</span><input type='text' style='display:none;' value='".$column_settings['column_opacity']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                                    	$tablestring .= "<dd>";
	                                        $tablestring .= "<ul class='arp_column_opacity' data-id='column_opacity'>";
                                        	
											foreach($arp_mainoptionsarr['general_options']['column_opacity'] as $column_opacity){
                                            	$tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='".$column_opacity."' data-label='".$column_opacity."'>".$column_opacity."</li>";
                                        	}
											$tablestring .= "</ul>";
											
										$tablestring .= "</dd>";
									
									$tablestring .= "</di>";
							
							$tablestring .= "</div>";
							
						$tablestring .= "</div>";
					
					$tablestring .= "</div>";
					
				$tablestring .= "</div>";
				
				//
				
				$tablestring .= "<div class='general_animation_tab enable global_opts' >";
				
					$tablestring .= "<div class='general_animation_tabimg'>&nbsp;</div>";
					
					$tablestring .= "<div class='general_animation_tabdiv'>".__('Effects',ARP_PT_TXTDOMAIN)."</div>";
					
					$tablestring .= "<div class='animation_dropdown'>";
						
						$tablestring .= "<div class='column_option_animation_dropdown' id='column_option_animation_dropdown'>";
							
														
								$tablestring .= "<div class='column_content_light_row column_opt_row'>";
								
									$tablestring .= "<div class='column_opt_label'>".__('Active Column',ARP_PT_TXTDOMAIN)."</div>";
									
									$tablestring .= "<div class='column_opt_opts'>";
									
										$tablestring .= "<div class='column_hover_effect'>";
										
											$tablestring .= "<input type='hidden' id='column_high_on_hover' name='column_high_on_hover' value='".$column_settings['column_highlight_on_hover']."' >";
											
											$tablestring .= "<dl class='arp_selectbox' id='column_high_on_hover_dd' data-name='column_high_on_hover' data-id='column_high_on_hover' style='float: left; width: 110px; margin-top: 28px;'>";
											
												if( $arp_mainoptionsarr['general_options']['highlightcolumnonhover'][$column_settings['column_highlight_on_hover']] != '' ){
													$arp_selectbox_placeholder = $column_settings['column_highlight_on_hover'];
													$arp_selectbox_placeholder = $arp_mainoptionsarr['general_options']['highlightcolumnonhover'][$arp_selectbox_placeholder];
												} else {
													$arp_selectbox_placeholder = __('Choose Option',ARP_PT_TXTDOMAIN);
												}
											
												$tablestring .= "<dt><span>".$arp_selectbox_placeholder."</span><input type='text' style='display:none;' value='".$arp_mainoptionsarr['general_options']['highlightcolumnonhover'][$column_settings['column_highlight_on_hover']]."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											
												$tablestring .= "<dd>";
												
													$tablestring .= "<ul data-id='column_high_on_hover'>";
													
														foreach( $arp_mainoptionsarr['general_options']['highlightcolumnonhover'] as $j=>$hover_effect){
														
															if( $is_animated == 1 && $hover_effect == 'Hover Effect'){	
															
															}else{
																$tablestring .= "<li class='arp_selectbox_option' data-value='".$j."' data-label='".$hover_effect."'>".$hover_effect."</li>";	
															}												
														}
													
													$tablestring .= "</ul>";
												
												$tablestring .= "</dd>";
											
											$tablestring .= "</dl>";
										
										$tablestring .= "</div>";
									
									$tablestring .= "</div>";
								
								$tablestring .= "</div>";
							
							
							
							$tablestring .= "<div class='column_content_dark_row column_opt_row'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Column Rotation',ARP_PT_TXTDOMAIN);
								
									$tablestring .= "<div class='column_opt_label_halp'>(".__('Rotation effect will be shown in preview only.',ARP_PT_TXTDOMAIN).")</div>";
								
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
								
									if( $column_animation['is_animation'] == 'yes' )
										$checked = "checked='checked'";
									else
										$checked = '';
								
									$tablestring .= "<input type='checkbox' ".$checked." class='arp_checkbox light_bg' name='is_animation' id='is_animation' value='yes' />";
								
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";
							
							
							
							$tablestring .= "<div class='column_content_light_row column_opt_row arp_allow_animation'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Visible Columns',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
									
									$vcols_readonly = '';
									
									if( $column_animation['is_animation'] == 'yes' )
										$vcols_readonly = '';
									else
										$vcols_readonly = 'readonly="readonly"';
								
									$tablestring .= "<input type='text' ".$vcols_readonly." name='visible_columns' class='arp_tab_txt' value='".$column_animation['visible_column']."' id='visible_columns' />";
								
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";
							
							
							
							$tablestring .= "<div class='column_content_dark_row column_opt_row arp_allow_animation'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Column to scroll',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
									$scols_readonly = '';
									if( $column_animation['is_animation'] == 'yes' )
										$scols_readonly = '';
									else
										$scols_readonly = 'readonly="readonly"';
									$tablestring .= "<input type='text' ".$scols_readonly." name='column_to_scroll' class='arp_tab_txt' value='".$column_animation['scrolling_columns']."' id='column_to_scroll' />";
								
								$tablestring .= "</div>";
								
							$tablestring .= "</div>";
							
							
							
							$tablestring .= "<div class='column_content_light_row column_opt_row arp_allow_animation'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Transition Speed',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
									$anim_speed = '';
									if( $column_animation['is_animation'] == 'yes' )
										$anim_speed = '';
									else
										$anim_speed = 'readonly="readonly"';
									$tablestring .= "<input type='text' ".$anim_speed." name='slide_transition_speed' class='arp_tab_txt' value='".$column_animation['transition_speed']."' id='slide_transition_speed' />";
								
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";
							
							
							
							$tablestring .= "<div class='column_content_dark_row column_opt_row arp_allow_animation'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Autoplay',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
								
									if( $column_animation['autoplay'] == 1 )
										$checked = "checked='checked'";
									else
										$checked = '';
								
									$tablestring .= "<input type='checkbox' name='is_autoplay' class='arp_checkbox light_bg' id='is_autoplay' value='1' ".$checked." />";
								 
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";
							
							//
							
							$tablestring .= "<div class='column_content_light_row column_opt_row'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Navigation / Pagination Button',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
								
									$default = $column_animation['pagi_nav_btn'];
									
									$option = $arp_mainoptionsarr['general_options']['column_animation']['pagi_nav_btns'][$default];
									
									$tablestring .= "<div class='column_animation_easing_effect'>";
									
										$tablestring .= "<input type='hidden' name='pagination_navigation_buttons' id='pagination_navigation_buttons' value='".$default."' />";
										
										$tablestring .= "<dl class='arp_selectbox' id='pagi_nav_btns' data-name='pagi_nav_btns' data-id='pagination_navigation_buttons' style='float: left; width: 110px; margin-top: 28px;'>";
										
											$tablestring .= "<dt><span style='width:95px;float:left;'>".$option."</span><input type='text' value='".$option."' style='display:none;' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											
											$tablestring .= '<dd>';
											
												$tablestring .= "<ul class='arp_column_pagination_navigation' data-id='pagination_navigation_buttons' style='max-height:80px;'>";
												
													foreach( $arp_mainoptionsarr['general_options']['column_animation']['pagi_nav_btns'] as $x => $btns){
													
														$tablestring .= "<li class='arp_selectbox_option' data-value='".$x."' data-label='".$btns."' >".$btns."</li>";
													
													}
												
												$tablestring .= "</ul>";
											
											$tablestring .= "</dd>";
										
										$tablestring .= "</dl>";
									
									$tablestring .= "</div>";
								
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";
							
							//
							
							$tablestring .= "<div class='column_content_dark_row column_opt_row'>";
							
								$navigation_effect = array();
								$navigation_effect = array_merge($arp_mainoptionsarr['general_options']['column_animation']['easing_effect'],$arp_mainoptionsarr['general_options']['column_animation']['sliding_effect']);
								
								$tablestring .= "<div class='column_opt_label'>".__('Navigation effect',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
								
									$tablestring .= "<div class='column_animation_sliding_effect'>";
										
										$tablestring .= "<input type='hidden' id='sliding_effect' name='sliding_effect' value='".$column_animation['sliding_effect']."' />";
										
										$tablestring .= "<dl class='arp_selectbox' id='sliding_effect_dd' data-name='sliding_effect' data-id='sliding_effect' style='float: left; width: 110px; margin-top: 28px;'>";
										
												if( $column_animation['sliding_effect'] )
													$arp_selectbox_placeholder = $column_animation['sliding_effect'];
												elseif( $column_animation['easing_effect'] )
													$arp_selectbox_placeholder = $column_animation['easing_effect'];	
												else
													$arp_selectbox_placeholder = __('Choose Option',ARP_PT_TXTDOMAIN);
											
											 $tablestring .= "<dt><span>".$arp_selectbox_placeholder."</span><input type='text' style='display:none;' value='".$column_animation['sliding_effect']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											 	$tablestring .= "<dd>";
													$tablestring .= "<ul class='arp_column_sliding_effect' data-id='sliding_effect' style='max-height:80px;'>";
														foreach( $navigation_effect as $effect ){
															$tablestring .= "<li class='arp_selectbox_option' data-value='".$effect."' data-label='".$effect."'>".$effect."</li>";
														}
													$tablestring .= "</ul>";
												$tablestring .= "</dd>";
											$tablestring .= "</dl>";
										
									$tablestring .= "</div>";
								
								$tablestring .= "</div>";
								
							$tablestring .= "</div>";
							
							//
						
						$tablestring .= "</div>";
					
					$tablestring .= "</div>";
					
				$tablestring .= "</div>";
				
				//
				
				$tablestring .= "<div class='general_tooltip_tab enable global_opts' >";
				
					$tablestring .= "<div class='general_tooltip_tabimg'>&nbsp;</div>";
					
					$tablestring .= "<div class='general_tooltip_tabdiv'>".__('Tooltip',ARP_PT_TXTDOMAIN)."</div>";
					
					$tablestring .= "<div class='tooltip_dropdown'>";
						
						$tablestring .= "<div class='column_option_tooltip_dropdown' id='column_option_tooltip_dropdown'>";
						
							$tablestring .= "<div class='column_content_light_row column_opt_row'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Background Color',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
								
									$tablestring .= "<div class='color_picker' data-id='tooltip_bgcolor' id='tooltip_bgcolor_div' style='background:".$tooltip_settings['background_color'].";' data-color='".$tooltip_settings['background_color']."' >";
										
										$tablestring .= "<div class='colorpicker_arrow_div'>";
										
											$tablestring .= "<div class='colorpicker_arrow'></div>";
										
										$tablestring .= "</div>";
										
									$tablestring .= "</div>";
									
									$tablestring .= "<input type='hidden' id='tooltip_bgcolor' name='tooltip_bgcolor' value='".$tooltip_settings['background_color']."' />";
								
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";
							
							//
							
							$tablestring .= "<div class='column_content_dark_row column_opt_row'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Text Color',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
								
									$tablestring .= "<div class='color_picker' data-id='tooltip_txtcolor' id='tooltip_txtcolor_div' style='background:".$tooltip_settings['text_color'].";' data-color='".$tooltip_settings['text_color']."' >";
										
										$tablestring .= "<div class='colorpicker_arrow_div'>";
										
											$tablestring .= "<div class='colorpicker_arrow'></div>";
										
										$tablestring .= "</div>";
										
									$tablestring .= "</div>";
									
									$tablestring .= "<input type='hidden' id='tooltip_txtcolor' name='tooltip_txtcolor' value='".$tooltip_settings['text_color']."' />";
								
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";
							
							//
							
							$tablestring .= "<div class='column_content_light_row column_opt_row'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Animation Style',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
								
									$tablestring .= "<div class='tooltip_animation' id='tooltip_animation'>";
										
										$tablestring .= "<input type='hidden' id='tooltip_animation_style' name='tooltip_animation_style' value='".$tooltip_settings['animation']."'  />";
										$tablestring .= "<dl class='arp_selectbox' data-name='tooltip_animation_style' data-id='tooltip_animation_style' style='float:left;width:110px;margin-top:28px;'>";
											
											if( $tooltip_settings['animation'] )
												$arp_selectbox_placeholder = $tooltip_settings['animation'];
											else
												$arp_selectbox_placeholder = __('Choose Option',ARP_PT_TXTDOMAIN);
												
											$tablestring .= "<dt><span>".$arp_selectbox_placeholder."</span><input type='text' value='".$tooltip_settings['animation']."' style='display:none;' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											
											$tablestring .= "<dd>";
												
												$tablestring .= "<ul data-id='tooltip_animation_style'>";

													foreach( $arp_mainoptionsarr['general_options']['tooltipsetting']['animation'] as $tooltip_animation ){
														$tablestring .= "<li class='arp_selectbox_option' data-value='".$tooltip_animation."' data-label='".$tooltip_animation."'>".$tooltip_animation."</li>";
													}
				
												$tablestring .= "</ul>";
									
											$tablestring .= "</dd>";
											
										$tablestring .= "</dl>";
											
									$tablestring .= "</div>";
								
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";
							
							//
							
							
							$tablestring .= "<div class='column_content_dark_row column_opt_row'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Tooltip Position',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
								
									$tablestring .= "<div class='tooltip_position' id='tooltip_position'>";

										$tablestring .= "<input type='hidden' id='tooltip_position' name='tooltip_position' value='".$tooltip_settings['position']."' />";
										
										$tablestring .= "<dl class='arp_selectbox' id='tooltip_postion_dd' data-name='tooltip_position' data-id='tooltip_position' style='float:left;width:110px;margin-top:28px;'>";

											if( $tooltip_settings['position'] )
												$arp_selectbox_placeholder = $tooltip_settings['position'];
											else
												$arp_selectbox_placeholder = __('Choose Option',ARP_PT_TXTDOMAIN);

											 $tablestring .= "<dt><span>".$arp_selectbox_placeholder."</span><input type='text' style='display:none;' value='".$tooltip_settings['position']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";

											 $tablestring .= "<dd>";
												
												$tablestring .= "<ul data-id='tooltip_position'>";
												
													foreach( $arp_mainoptionsarr['general_options']['tooltipsetting']['position'] as $tltp_position ){
													
														$tablestring .= "<li class='arp_selectbox_option' data-value='".$tltp_position."' data-label='".$tltp_position."'>".$tltp_position."</li>";
														
													}
												$tablestring .= "</ul>";
												
											$tablestring .= "</dd>";
										
										$tablestring .= "</dl>";
										
									$tablestring .= "</div>";
								
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";
						
							//
							
							$tablestring .= "<div class='column_content_light_row column_opt_row'>";
							
								$tablestring .= "<div class='column_opt_label'>".__('Tooltip Style',ARP_PT_TXTDOMAIN)."</div>";
								
								$tablestring .= "<div class='column_opt_opts'>";
								
									$tablestring .= "<div class='tooltip_style' id='tooltip_style'>";
									
										$tablestring .= "<input type='hidden' id='tooltip_style' name='tooltip_style' value='".$tooltip_settings['style']."' />";
										
										$tablestring .= "<dl class='arp_selectbox' id='tooltip_style_dd' data-name='tooltip_style' data-id='tooltip_style' style='float:left;width:110px;margin-top:28px;'>";

											if( $tooltip_settings['style'] )
													$arp_selectbox_placeholder = $tooltip_settings['style'];
												else
													$arp_selectbox_placeholder = __('Choose Option',ARP_PT_TXTDOMAIN);

											$tablestring .= "<dt><span>".$arp_selectbox_placeholder."</span><input type='text' style='display:none;' value='".$tooltip_settings['style']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
											 
											$tablestring .= "<dd>";
											
												$tablestring .= "<ul data-id='tooltip_style'>";
											
													foreach( $arp_mainoptionsarr['general_options']['tooltipsetting']['style'] as $tooltip_style ){
													
														$tablestring .= "<li class='arp_selectbox_option' data-value='".$tooltip_style."' data-label='".$tooltip_style."'>".$tooltip_style."</li>";
													
													}
												$tablestring .= "</ul>";
												
											$tablestring .= "</dd>";
											
										$tablestring .= "</dl>";
										
									$tablestring .= "</div>";
								
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";
							
							//
							
							$tablestring .= "<div class='column_content_dark_row column_opt_row'>";
							
								$tablestring .= "<div class='aro_tooltip_font_title'>".__('Font Settings',ARP_PT_TXTDOMAIN)."</div>";
								
							$tablestring .= "</div>";
							
							//
							
							$tablestring .= "<div class='column_content_light_row column_opt_row' style='height:145px;'>";
							
								$tablestring .= "<div class='arp_tooltip_setting_main'>";
									
									$tablestring .= "<div class='arp_tooltip_inner'>";
									
										$tablestring .= "<div class='column_opt_label'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
										
										$tablestring .= "<div class='column_opt_opts'>";
									
											$tablestring .= "<div class='tooltip_font_family_div'>";
										
												$tablestring .= "<input type='hidden' id='tooltip_font_family' name='tooltip_font_family' value='".$tooltip_settings['tooltip_font_family']."' />";
												$tablestring .= "<dl class='arp_selectbox' id='tooltip_font_family_dd' data-name='tooltip_font_family' data-id='tooltip_font_family'  style='margin-top:28px; width:100%;'>";
												
													if( $tooltip_settings['tooltip_font_family'] )
														$arp_selectbox_placeholder = $tooltip_settings['tooltip_font_family'];
													else
														$arp_selectbox_placeholder = __('Choose Option',ARP_PT_TXTDOMAIN);
														
													$tablestring .= "<dt><span style='float:left;max-width:100px;'>".$arp_selectbox_placeholder."</span><input type='text' style='display:none;' value='".$tooltip_settings['tooltip_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
												
													$tablestring .= "<dd>";
												
														$tablestring .= "<ul class='arp_tooltip_font_setting' data-id='tooltip_font_family'>";
														
															$default_fonts = $arprice_fonts->get_default_fonts();		
															$google_fonts = $arprice_fonts->google_fonts_list();

															$tablestring .= "<ol class='arp_selectbox_group_label'>".__('Default Fonts',ARP_PT_TXTDOMAIN)."</ol>";
													
															foreach( $default_fonts as $font ) {
															
																$tablestring .= "<li class='arp_selectbox_option' data-value='".$font."' data-label='".$font."'>".$font."</li>";
															}
														
															$tablestring .= "<ol class='arp_selectbox_group_label'>".__('Google Fonts',ARP_PT_TXTDOMAIN)."</ol>";
															
															foreach( $google_fonts as $font ) {
															
																$tablestring .= "<li class='arp_selectbox_option' data-value='".$font."' data-label='".$font."'>".$font."</li>";
															}
														
														$tablestring .= "</ul>";
														
													$tablestring .= "</dd>";
											
												$tablestring .= "</dl>";
											
											$tablestring .= "</div>";
								
										
											
									$tablestring .= "</div>";
									
									//
									
									$tablestring .= "<div class='arp_tooltip_setting_left'>";
                                            	
										$tablestring .= "<div class='column_opt_label'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
                                       		
											$tablestring .= "<div class='column_opt_opts'>";
                                        
                                        		$tablestring .= "<div class='tooltip_font_size_div'>";
												
                                                	$tablestring .= "<input type='hidden' id='tooltip_font_size' name='tooltip_font_size' value='".$tooltip_settings['tooltip_font_size']."' />";
                            	                    $tablestring .= "<dl class='arp_selectbox' id='tooltip_font_size_dd' data-name='tooltip_font_size' data-id='tooltip_font_size'  style='float:left;width:115px;margin-top:28px;max-width:115px;'>";
                                                    	if( $tooltip_settings['tooltip_font_size'] )
                                                            $arp_selectbox_placeholder = $tooltip_settings['tooltip_font_size'];
                                                        else
                                                            $arp_selectbox_placeholder = __('Choose Option',ARP_PT_TXTDOMAIN);
                                                     
													 	$tablestring .= "<dt><span style='float:left;max-width:100px;'>".$arp_selectbox_placeholder."</span><input type='text' style='display:none;' value='".$tooltip_settings['tooltip_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                                                     	
														$tablestring .= "<dd>";
														
															$size_arr = array();
	                                                    
														 	$tablestring .= "<ul class='arp_tooltip_font_setting' data-id='tooltip_font_size'>";
                                                        	
																for($s=8;$s<=20;$s++)
																	$size_arr[]=$s;
																for($st=22;$st<=70;$st+=2)
																	$size_arr[]=$st;
															
																foreach($size_arr as $size)  {
															
                                                            		$tablestring .= "<li class='arp_selectbox_option' data-value='".$size."' data-label='".$size."'>".$size."</li>";
																}
                                                        	$tablestring .= "</ul>";
                                                    
														$tablestring .= "</dd>";
                                                	
													$tablestring .= "</dl>";
													
                                            	$tablestring .= "</div>";
                                            
                                        	$tablestring .= "</div>";
                                            
										$tablestring .= "</div>";
										
										$tablestring .= "<div class='arp_tooltip_setting_right'>";
                                            	
											$tablestring .= "<div class='column_opt_label'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
											
											$tablestring .= "<div class='column_opt_opts'>";
											
	                                        $tablestring .= "<div class='tooltip_font_style_div' >";
											
                                                $tablestring .= "<input type='hidden' id='tooltip_font_style' name='tooltip_font_style' value='".$tooltip_settings['tooltip_font_style']."' />";
                                                $tablestring .= "<dl class='arp_selectbox' id='tooltip_font_style_dd' data-name='tooltip_font_style' data-id='tooltip_font_style' style='float:left;width:115px;margin-top:28px;max-width:115px;'>";
													if( $tooltip_settings['tooltip_font_style'] )
														$arp_selectbox_placeholder = ucfirst($tooltip_settings['tooltip_font_style']);
													else
														$arp_selectbox_placeholder = __('Choose Option',ARP_PT_TXTDOMAIN);

                                                     $tablestring .= "<dt><span style='float:left;max-width:100px;'>".$arp_selectbox_placeholder."</span><input type='text' style='display:none;' value='".ucfirst($tooltip_settings['tooltip_font_style'])."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                                                     
													 $tablestring .= "<dd>";
													 
                                                      	$tablestring .= "<ul class='arp_tooltip_font_setting' data-id='tooltip_font_style' >";
                                                      		$tablestring .= $arprice_form->font_style_new();
                                                        $tablestring .= "</ul>";
														
                                                    $tablestring .= "</dd>";
													
                                               $tablestring .= "</dl>";
											   
                                            $tablestring .= "</div>";
											
                                        $tablestring .= "</div>";
										
                                    $tablestring .= "</div>";
                                            
								//
								
								$tablestring .= "</div>";
									
							$tablestring .= "</div>";
						
						$tablestring .= "</div>";
							
							//
							
						$tablestring .= "</div>";
						
						//
						
					
					$tablestring .= "</div>";
				
				$tablestring .= "</div>";
				
				//
				
				$tablestring .= "<div class='general_custom_css_tab enable global_opts' >";
				
					$tablestring .= "<div class='general_custom_css_tabimg'> </div>";
					
					$tablestring .= "<div class='general_custom_css_tabdiv'>".__('Custom CSS',ARP_PT_TXTDOMAIN)."</div>";
					
					$tablestring .= "<div class='custom_css_dropdown'>";
						
						$tablestring .= "<div class='column_opt_label_div'>".__('Enter css class and style',ARP_PT_TXTDOMAIN)."</div>";
						
						$tablestring .= "<div class='column_content_light_row column_opt_row'>";
							
							$general_settings['arp_custom_css'] = isset($general_settings['arp_custom_css']) ? $general_settings['arp_custom_css'] : "";
							$tablestring .= "<textarea class='arp_custom_css' name='arp_custom_css' id='arp_custom_css'>".$general_settings['arp_custom_css']."</textarea>";
							$tablestring .= "<div style='float:left; margin:11px 0 0 14px;'><span style='font-weight:normal; margin-right:6px;'>(e.g.) .btn{color:#000000;}</span></div>";
							$tablestring .= "<button id='arp_custom_css_btn' style='float:right; margin: 5px 14px 0 0;' class='col_opt_btn' type='button'>".__('Apply To Editor',ARP_PT_TXTDOMAIN)."</button>";
						
						$tablestring .= "</div>";
						
					$tablestring .= "</div>";
				
				$tablestring .= "</div>";
				
				//
				
				$tablestring .= "<div class='general_color_opts enable'>";
				
					$tablestring .= "<div class='general_color_tabdiv'>".__('Choose Color :',ARP_PT_TXTDOMAIN)."</div>";
					
						$tablestring .= "<div class='general_color_box_div' id='general_color_box_div' target-div='template_color_scheme' data-id='".$id."' data-array='".json_encode($arp_mainoptionsarr['general_options']['template_options']['skin_color_code'][$reference_template])."' data-skins='".json_encode($arp_mainoptionsarr['general_options']['template_options']['skins'][$reference_template])."'>";
					
							global $arp_mainoptionsarr;
							if( $reference_template == '' )
								$reference_template = 'arptemplate_1';
								
							$key = array_search($arp_template_skin,$arp_mainoptionsarr['general_options']['template_options']['skins'][$reference_template]);
							
							if( $arp_mainoptionsarr['general_options']['template_options']['skins'][$reference_template][$key] == 'multicolor' )
								$cls = 'multi-color-small-icon';
							else
								$cls = '';
								
							if( $arp_mainoptionsarr['general_options']['template_options']['skins'][$reference_template][$key] != 'multicolor' )
								$color = '#'.$arp_mainoptionsarr['general_options']['template_options']['skin_color_code'][$reference_template][$key];
							else
								$color = '';
								
							$tablestring .= "<div class='general_color_box ".$cls."' id='general_color_box' style='background:".$color."'></div>";
							$tablestring .= "<div class='general_color_seperator'></div>";
							$tablestring .= "<div class='general_color_box_img'></div>";
							
						$tablestring .= "</div>";
						
					$tablestring .= "</div>";
					
					$display = ( empty($id) or $is_clone == 1 ) ? 'display:none' : '';
					
					$shortcode_txt = ( !empty($id) ) ? '[ARPrice id='.$id.']' : '';
					
					$tablestring .= "<div id='arp_shortcode' class='arp_shortcode_main' style='".$display."' >";
					
						$tablestring .= "<div class='arp_shortcode_title'>".__('Shortcode',ARP_PT_TXTDOMAIN)." :</div>";
						
						$tablestring .= "<div class='general_choose_template arp_shortcode'>";
							$tablestring .= "<div class='savebtndiv' id='arp_shortcode_value'>".$shortcode_txt."</div>";
						$tablestring .= "</div>";
					
					$tablestring .= "</div>";
				
				$tablestring .= "</div>";
								
			$tablestring .= "</div>";
			
		$tablestring .= "</div>";
		
		
	
	if( $is_tbl_preview == 1 )
	{	
		$template_feature = maybe_unserialize(stripslashes($general_option['template_setting']['template_feature']));
	}
	else
	{	
		global $arp_mainoptionsarr;
		
		$template_feature = $arp_mainoptionsarr['general_options']['template_options']['features'][$ref_template];
	}
	
	$template_css = '';
	
	if( $is_template == 1){
		$template_name = $sql->template_name;
	}else{
		$template_name = $table_id;
	}
	
	
	if( $is_template == 1){
		if( file_exists( PRICINGTABLE_DIR.'/css/templates/arptemplate_'.$sql->template_name.'.css') )
		{
			
			$template_css = @file_get_contents(PRICINGTABLE_URL."/css/templates/arptemplate_".$sql->template_name.".css");
			
			$template_css = str_replace('../../images', PRICINGTABLE_IMAGES_URL, $template_css);
		}
	}else{
		if( file_exists( PRICINGTABLE_UPLOAD_DIR.'/css/arptemplate_'.$id.'.css') )
		{
			
			$template_css = @file_get_contents(PRICINGTABLE_UPLOAD_URL."/css/arptemplate_".$id.".css");
		}
	}
		
	$tablestring .= "<style id='arptemplatecss' type='text/css'>".$template_css."</style>";
	

	
	$arp_front_css	= @file_get_contents(PRICINGTABLE_URL."/css/arprice_front.css"); 
	
	$arp_front_css	= str_replace('../images', PRICINGTABLE_IMAGES_URL, $arp_front_css);
	
	$tablestring .= "<style id='arpfrontcss' type='text/css'>".$arp_front_css."</style>";
	
	$col_ord_arr =  json_decode( $general_settings['column_order'] );
	
	
	if( $column_animation['is_animation'] == 'yes' ){
		$animation_margin = 'margin-bottom:45px;';
	} 
	if( $column_animation['is_animation'] == 0 ) {
		$animation_margin = 'margin-bottom:-5px;';
	}
	if( isset($column_animation['is_animation']) and $column_animation['is_animation'] == 'yes' and $column_animation['is_pagination'] == 1 and ( $column_animation['pagination_position'] == 'Top' or $column_animation['pagination_position'] == 'Both' ) )
    	$tablestring .= "<div class='arp_pagination ".$column_animation['pagination_style']." arp_pagination_top' id='arp_slider_".$id."_pagination_top'></div>";

	$tablestring .= "<div class='ArpTemplate_main' id=\"ArpTemplate_main\" style='clear:both;".$animation_margin."'>";
	$tablestring .= "<style type='text/css' media='all'>";
		
		
	$tablestring .= $arprice_form->arp_render_customcss($template_name, $general_option, 0,$opts,$is_animated);
	
	if( $general_option['tooltip_settings']['style'] == 'normal')
	{
		$tablestring .= " .arp_tooltip_".$id." {
			border-radius:4px;
				-moz-border-radius:4px;
				-webkit-border-radius:4px;
				-o-border-radius:4px;

		}";
	} else if ( $general_option['tooltip_settings']['style'] == 'glass') {
		$tablestring .= " .arp_tooltip_".$id." {
			border-radius:7px;
				-moz-border-radius:7px;
				-webkit-border-radius:7px;
				-o-border-radius:7px;
			box-shadow:0px 0px 20px rgba(0,0,0,0.3);
			 -moz-box-shadow:0px 0px 20px rgba(0,0,0,0.3);
			 -webkit-box-shadow:0px 0px 20px rgba(0,0,0,0.3);
			 -o-box-shadow:0px 0px 20px rgba(0,0,0,0.3);
		}";
	} else if( $general_option['tooltip_settings']['style'] == 'drop' ) {
		$tablestring .= ".arp_tooltip_".$id." {
			border-radius:20px;
				-moz-border-radius:20px;
				-webkit-border-radius:20px;
				-o-border-radius:20px;
			padding:10px;
			text-align:center;
		}";
	}
	$tablestring .= $general_settings['arp_custom_css'];
	
	/*$tablestring .= ".arptemplate_".$template_name." .ArpPricingTableColumnWrapper{";
	
		$column_min_width = '';
		if( $column_settings['column_min_width'] == '' or $column_settings['column_min_width'] < 1 ){
			$column_min_width = $arp_mainoptionsarr['general_options']['template_options']['arp_min_max_width'][$reference_template]['min-width'];
		} else {
			$column_min_width = $column_settings['column_min_width'];
		}
		$tablestring .= "min-width:".$column_min_width."px;";
		
		if( $column_settings['column_max_width'] != '' and $column_settings['column_max_width'] > 0 ){
			$tablestring .= "max-width:".$column_settings['column_max_width']."px;";
		}
		
	$tablestring .= "}"; */
	
	$tablestring .= "</style>";
	
	$tltp_bgcolor = $arprice_form->hex2rgb($general_option['tooltip_settings']['background_color']);
	
	if( $general_option['tooltip_settings']['style'] == 'normal' || $general_option['tooltip_settings']['style'] == 'drop' ) {
		$tooltip_bg_color = 'rgb('.$tltp_bgcolor['red'].','.$tltp_bgcolor['green'].','.$tltp_bgcolor['blue'].')';
	} else if ( $general_option['tooltip_settings']['style'] == 'glass' ) {
		$tooltip_bg_color = 'rgba('.$tltp_bgcolor['red'].','.$tltp_bgcolor['green'].','.$tltp_bgcolor['blue'].',0.9)';
	} else if ( $general_option['tooltip_settings']['style'] == 'alert' ) {
		$tooltip_bg_color = 'rgba('.$tltp_bgcolor['red'].','.$tltp_bgcolor['green'].','.$tltp_bgcolor['blue'].',0.7)';
	}
		
	if( $general_option['tooltip_settings']['tooltip_width'] == '' )
		$tooltip_max_width = 'null';
	else
		$tooltip_max_width = $general_option['tooltip_settings']['tooltip_width'];
	
	$tablestring .= "<div id='arp_inlinestyle'> </div> ";	
	$tablestring .= "<div class='arp_inlinescript'><script type='text/javascript'>
	jQuery(document).ready(function(){
		jQuery('.arp_price_table_".$id." .arp_tooltip').tooltipster({
			animation: '".$general_option['tooltip_settings']['animation']."',
			theme: 'arp_tooltip_".$id."',
			position:'".$general_option['tooltip_settings']['position']."',
			maxWidth:".$tooltip_max_width.",
			positionTracker:true,
			contentAsHTML:true,
			interactive:true,
			autoClose:true,
			onlyOne:true,
			multiple:true,";
			if($is_tbl_preview == 2){
				$tablestring .= 'functionReady:function(origin,tooltip){
					jQuery(document).find("body").css("overflow-x","");
				},
				functionAfter:function(origin,tooltip){
					jQuery(document).find("body").css("overflow-x","");
				},';
			}
			if( $general_option['tooltip_settings']['style'] == 'normal' )
			{
				$tablestring .= "functionBefore:function(origin,tooltip){";									
						if( $general_option['tooltip_settings']['position'] == 'top' )
							$tablestring .=	"jQuery(tooltip).find('.tooltipster-arrow').find('span').css('bottom','-6px');";
						
						else if ( $general_option['tooltip_settings']['position'] == 'bottom' )
							$tablestring .=	"jQuery(tooltip).find('.tooltipster-arrow').find('span').css('top','-6px');";
						
						else if ( $general_option['tooltip_settings']['position'] == 'left' )
							$tablestring .= "jQuery(tooltip).find('.tooltipster-arrow').find('span').css('right','-6px');";
						
						else if ( $general_option['tooltip_settings']['position'] == 'right' )
							$tablestring .= "jQuery(tooltip).find('.tooltipster-arrow').find('span').css('left','-6px');";	
				$tablestring .= "}";
				
			} else if( $general_option['tooltip_settings']['style'] == 'glass' || $general_option['tooltip_settings']['style'] == 'alert') {
			
				$tablestring .= "functionBefore:function(origin,tooltip){
					var background_color = '".$tooltip_bg_color."';";
					
						if( $general_option['tooltip_settings']['position'] == 'top' )
							$tablestring .= "jQuery(tooltip).find('.tooltipster-arrow').find('span').attr('style','border-left: 5px solid transparent !important;border-right: 6px solid transparent !important;border-top: 6px solid '+background_color+';bottom: -6px;')";
							
						else if ( $general_option['tooltip_settings']['position'] == 'bottom' )
							$tablestring .= "jQuery(tooltip).find('.tooltipster-arrow').find('span').attr('style','border-left: 6px solid transparent !important;border-right: 6px solid transparent !important;border-bottom: 5px solid '+background_color+';top: -5px;')";
									
						else if ( $general_option['tooltip_settings']['position'] == 'left' )
							$tablestring .= "jQuery(tooltip).find('.tooltipster-arrow').find('span').attr('style','border-bottom: 5px solid transparent !important;border-top: 5px solid transparent !important;border-left: 5px solid '+background_color+';right: -5px;top:55%;')";
								
						else if ( $general_option['tooltip_settings']['position'] == 'right' )
							$tablestring .= "jQuery(tooltip).find('.tooltipster-arrow').find('span').attr('style','border-bottom: 5px solid transparent !important;border-top: 5px solid transparent !important;border-right: 5px solid '+background_color+';left: -5px;top:55%;')";
				$tablestring .= "}";
			} else if( $general_option['tooltip_settings']['style'] == 'drop') {
			
				$tablestring .= "functionBefore:function(origin,tooltip){
					var background_color = '".$tooltip_bg_color."';";
						if( $general_option['tooltip_settings']['position'] == 'top' )
							$tablestring .= "jQuery(tooltip).find('.tooltipster-arrow').find('span').attr('style','border-left: 5px solid transparent !important;border-right: 6px solid transparent !important;border-top: 6px solid '+background_color+';bottom: -6px;')";
							
						else if ( $general_option['tooltip_settings']['position'] == 'bottom' )
							$tablestring .= "jQuery(tooltip).find('.tooltipster-arrow').find('span').attr('style','border-left: 6px solid transparent !important;border-right: 6px solid transparent !important;border-bottom: 5px solid '+background_color+';top: -5px;')";
									
						else if ( $general_option['tooltip_settings']['position'] == 'left' )
							$tablestring .= "jQuery(tooltip).find('.tooltipster-arrow').find('span').attr('style','border-bottom: 5px solid transparent !important;border-top: 5px solid transparent !important;border-left: 5px solid '+background_color+';right: -5px;')";
								
						else if ( $general_option['tooltip_settings']['position'] == 'right' )
							$tablestring .= "jQuery(tooltip).find('.tooltipster-arrow').find('span').attr('style','border-bottom: 5px solid transparent !important;border-top: 5px solid transparent !important;border-right: 5px solid '+background_color+';left: -5px;')";
				$tablestring .= "}";
			}
						
		$tablestring .= "});
	});
</script>";

	$global_column_width = "";
	
	if( $column_settings['all_column_width'] && $column_settings['all_column_width'] > 0 ){
		$global_column_width = 'width:'.$column_settings['all_column_width'].'px;';
	}


$tablestring .= "<input type='hidden' name='template' id='arp_template' value='".$template_settings['template']."' />";
$tablestring .= "<input type='hidden' name='template_type' id='arp_template_type' value='".$template_type."' />";
$tablestring .= "<input type='hidden' name='is_tbl_preview' id='is_tbl_preview' value='".$is_tbl_preview."' /></div>";
$tablestring .= "<input type='hidden' name='column_level_dynamic_array' id='column_level_dynamic_array' />";
$tablestring .= "<input type='hidden' name='column_min_width_hidden' id='".$arp_mainoptionsarr['general_options']['template_options']['arp_min_max_width'][$reference_template]['min-width']."' id='column_min_width_hidden' />";
$tablestring .= "<input type='hidden' name='column_max_width_hidden' id='".$arp_mainoptionsarr['general_options']['template_options']['arp_min_max_width'][$reference_template]['max-width']."' id='column_max_width_hidden' />";

$tablestring .= "<input type='hidden' id='arp_template_name' name='arp_template_name' value='arptemplate_".$template_name."' />";

	$template_id = $template_settings['template'];
	$color_scheme = 'arp'.$template_settings['skin'];
	if($hover_type == 0 and $is_tbl_preview != 2)
	{
		$hover_class = 'hover_effect';
	}
	else if($hover_type == 1 and $is_tbl_preview != 2)
	{
		$hover_class = 'shadow_effect';
	}
	else
	{
		$hover_class = 'no_effect';
	}
	
	if($is_animation != "" and $is_tbl_preview != 2)
	{
		$animation_class = 'has_animation';
	}
	else
	{
		$animation_class = 'no_animation';
	}
		
if( $column_animation['is_animation'] == 'yes' and $column_animation['is_pagination'] == 1 and $is_tbl_preview != 2){
	$slider_pagination_container = 'arp_slider_pagination';
	if( $column_animation['pagination_position'] == 'Top' )
		$slider_pagination_container .= ' Top';
	else if( $column_animation['pagination_position'] == 'Both' )
		$slider_pagination_container .= ' Both';
	else if( $column_animation['pagination_position'] == 'Bottom' )
		$slider_pagination_container .= ' Bottom';
}
else{
	$slider_pagination_container = '';
}
	

$tablestring .= "<div class='ArpPriceTable arp_price_table_".$template_name." arptemplate_".$template_name." ".$color_scheme." ".$slider_pagination_container."'";


    if( isset($column_animation['is_animation']) and $column_animation['is_animation'] == 'yes' and $is_tbl_preview != 2 and $is_tbl_preview != 3 )
	{
		$data_items 		= $column_animation['visible_column'] ? $column_animation['visible_column'] : 1;
		$scrolling_columns 	= $column_animation['scrolling_columns'] ? $column_animation['scrolling_columns'] : 1;
		$navigation 		= ( $column_animation['navigation'] == 1 ) ? 1 : 0;
		$autoplay 			= ( $column_animation['autoplay'] == 1 ) ? 1 : 0;
		$sliding_effect 	= $column_animation['sliding_effect'] ? $column_animation['sliding_effect'] : 'slide';
		$transition_speed	= $column_animation['transition_speed'] ? $column_animation['transition_speed'] : '500';
		$hide_caption		= $column_animation['hide_caption'] ? $column_animation['hide_caption'] : 0;
		$infinite			= $column_animation['is_infinite'] ? $column_animation['is_infinite'] : 0;
		$easing_effect 		= $column_animation['easing_effect'] ? $column_animation['easing_effect'] : 'swing';
		
		$tablestring .= "data-animate='true' data-id='".$table_id."' data-items='".$data_items."' data-scroll='".$scrolling_columns."' data-autoplay='".$autoplay."' data-effect='".$sliding_effect."' data-speed='".$transition_speed."' data-caption='".$hide_caption."' data-infinite='".$infinite."' data-easing='".$easing_effect."'";		 
	}			
$tablestring .= ">";

	$navigation = "";
	if( $column_animation['is_animation'] == 'yes' and $is_tbl_preview != 2 )
	{
		$navigation 		= ( $column_animation['navigation'] == 1 ) ? 1 : 0;
	}
    $tablestring .= "<div class='arp_prev_div'"; if(!$navigation) { $tablestring .= " style='display:none;'"; } $tablestring .= ">";
    $tablestring .= "<div id='arp_prev_btn_".$table_id."' class='arp_prev_btn ".$column_animation['navigation_style']."'></div>";
    $tablestring .= "</div>";
    $ref_template = $general_settings['reference_template'];
	
    $tablestring .= "<div id='ArpPricingTableColumns'"; if($navigation) { $tablestring .= " style='display:table-cell;'"; }
	
	$tablestring .= ">";
		
		$x = 0;
		if($opts['columns'] and count( $opts['columns'] ) > 0 )
		{
			
			$header_img = array();
			foreach( $opts['columns'] as $j=>$columns )
			{
				if( isset($columns['arp_header_shortcode']) && $columns['arp_header_shortcode'] != '' )
					$header_img[] = 1;
				else
					$header_img[] = 0;
			}
			$new_arr = array();
			if( is_array( $col_ord_arr ) && count( $col_ord_arr ) > 0 ){
				foreach( $col_ord_arr as $key=> $value ){
					$new_value = str_replace('main_','',$value);
					$new_col_id = $new_value;
					foreach( $opts['columns'] as $j=>$columns ){
						if( $new_col_id == $j ){
							if( $columns['is_caption'] != 1 ){
								$new_arr['columns'][$new_col_id] = $columns;
							}
						}
					}
				}
			} else {
				$new_arr = $opts;
			}
			
			
			foreach( $opts['columns'] as $j=>$column ){
				if( $column['is_caption'] == 1) {
					$caption_column[] = 'yes';
				} else {
					$caption_column[] = 'no';
				}
			}
			if( in_array( 'yes',$caption_column) ){
				$has_caption = 1;
			} else {
				$has_caption = 0;
			}
			$column_count=1;
			foreach($opts['columns'] as $j=>$columns)
			{
				if($columns['is_caption'] == 1 and $template_feature['caption_style'] == 'default') {
					$inlinecolumnwidth = "";
						if($columns["column_width"] != ""){
							$inlinecolumnwidth= 'width:'.$columns["column_width"].'px';
						} else {
							if( $column_settings['is_responsive'] != 1 ){
								$inlinecolumnwidth = $global_column_width;
							}
						}
					$column_highlight = $opts['columns'][$j]['column_highlight'];
						if($column_highlight && $column_highlight == 1 and $is_table_preview != 2 )
							$highlighted_column = 'column_highlight';
                $tablestring .= "<div class='ArpPricingTableColumnWrapper no_transition  maincaptioncolumn ".$animation_class." style_".$j."' style='"; if($column_settings['hide_caption_column'] && $column_settings['hide_caption_column'] == 1){ $tablestring .= "display:none;"; } $tablestring .= $inlinecolumnwidth."' id='main_".$j."'  is_caption='1' data-template_id='".$ref_template."' data-level='column_level_options' data-type='caption_column_buttons' >";

				$tablestring .= '<input type="hidden" value="1" name="caption_column_0" id="caption_column">';
				$tablestring .= "<div class='arpplan "; if($columns['is_caption'] == 1){ $tablestring .= "maincaptioncolumn"; }else{ $tablestring .= $j." "; } if($x % 2 == 0){ $tablestring .= " arpdark-bg ArpPriceTablecolumndarkbg"; } $tablestring .= "' style='";  $tablestring .= "' >";
                	if( $ref_template == 'arptemplate_15' )
						$tablestring .= "<div class='arp_template_rocket'><div></div></div>";
					$tablestring .= "<div class='planContainer'>";
                    		
						if( ( $ref_template == 'arptemplate_4' || $ref_template == 'arptemplate_12') && in_array(1,$header_img) )
							$header_cls = 'has_header_code';
						
                    	$tablestring .= "<div class='arpcolumnheader ".$header_cls."' data-column='main_".$j."' >";
														
									if($columns['is_caption'] == 1)
									{
										if( $template_feature['caption_title'] == 'default' )
										{
											if( $template == 'arptemplate_1' && in_array(1,$header_img))
												$header_cls = 'has_header_code';
											else
												$header_cls = '';
                                    
                                        	$tablestring .= "<div class='arpcaptiontitle ".$header_cls."' id='column_header' data-column='main_column_0' data-template_id='".$ref_template."' data-level='header_level_options' data-type='caption_column_buttons'>".do_shortcode( $columns['html_content'] )."</div>";
											
										}
										else if( $template_feature['caption_title'] == 'style_1' )
										{											
                                    		$tablestring .= "<div class='arpcaptiontitle' id='column_header' data-template_id='".$ref_template."' data-level='header_level_options' data-type='caption_column_buttons' data-column='main_column_0'>
                                            	
                                                <div class='arpcaptiontitle_style_1'>".do_shortcode( $columns['html_content'] )."</div>
                                            </div>";
											
										}
									}
									else
									{
										$tablestring .= "<div class='arppricetablecolumntitle' id='column_header' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='header_level_options' data-type='caption_column_buttons'>
											<div class='bestPlanTitle'>".do_shortcode( $columns['package_title'] )."</div>
										</div>
										<div class='arppricetablecolumnprice' data-column='main_".$j."'>".do_shortcode( $columns['html_content'] )."</div>";
										
									}
								
                        $tablestring .= "</div>
                        <div class='arpbody-content arppricingtablebodycontent' id='arppricingtablebodycontent' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='body_level_options' data-type='caption_column_buttons'>
                            <ul class='arp_opt_options arppricingtablebodyoptions' id='column_".$x."' style='text-align:".$columns['body_text_alignment']."'>";
	
                                $r = 0;
								
								$row_order= isset($opts['columns'][$j]['row_order']) ? $opts['columns'][$j]['row_order'] : "";										
								
								if( $row_order && is_array( $row_order ) )
								{
									$rows = array();
									asort($row_order);
									$ji = 0;
									$maxorder = max($row_order) ? max($row_order) : 0;
									foreach($opts['columns'][$j]['rows'] as $rowno => $row)
									{	
										$row_order[ $rowno ] = isset( $row_order[ $rowno ] ) ? $row_order[ $rowno ] : ($maxorder+1);
									}								
									foreach( $row_order as $row_id => $order_id )
									{
										if( $opts['columns'][$j]['rows'][ $row_id ] )
										{
											$rows[ 'row_'.$ji ] = $opts['columns'][$j]['rows'][ $row_id ]; 		
											$ji++;
										}
									}
									$opts['columns'][$j]['rows'] = $rows;
								}
								$column_count++;
								
								for($ri=0; $ri <= $maxrowcount; $ri++)
								{
									$rows = isset($opts['columns'][$j]['rows']['row_'.$ri]) ? $opts['columns'][$j]['rows']['row_'.$ri] : array(); 
									
									if($columns['is_caption'] == 1)
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
									else
									{
										if($column_count % 2 == 0)
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
									}
                                	if( $rows['row_description'] == '' ) { $rows['row_description'] = '&nbsp;'; }
                                    $tablestring .= "<li data-column='main_".$j."' class=' arpbodyoptionrow ".$cls."' id='arp_row_".$ri."' style='text-align:"; /*if($rows['row_des_txt_align'] == 'right'){ $tablestring .= "right";} else if($rows['row_des_txt_align'] == 'left'){ $tablestring .= "left";} else { $tablestring .= "center"; }*/ $tablestring .= "' data-template_id='".$ref_template."' data-level='body_li_level_options' data-type='caption_column_buttons' ><span class='"; if($rows['row_tooltip'] != ""){ /*$tablestring .= "arp_tooltip";*/ } $tablestring .= "' title='"; if($rows['row_tooltip'] != ""){ $tablestring .= esc_html($rows['row_tooltip']); } $tablestring .= "'>".stripslashes_deep($rows['row_description'])."</span></li>";
                                }
                            
                           $tablestring .= "</ul>
                        </div>";
                        
							if( $template_feature['button_position'] == 'default' )
							{                        
                            	$tablestring .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_".$j."'>";
								
                                    if($columns['button_text'] != '' && $columns['btn_img'] != "")
                            
                                    {                                
                                        $tablestring .= "<div class='arppricetablebutton' data-column='main_".$j."' style='text-align:center;'>
                                            <button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn' id='bestPlanButton' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important; width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;'"; } /*$tablestring .= " onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .= "\");'";*/ $tablestring .= ">"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .= "</button>";
                                        $tablestring .= "</div>";
                                    }
                                
                            	$tablestring .= "</div>";
                            }                        
            $tablestring .= "</div>";
			$tablestring .= "</div>";
			
			
			$col_no = explode('_',$j);
			
			$tablestring .= "<div class='column_level_settings' id='column_level_settings_new' data-column='main_column_0'>";
				$tablestring .= "<div class='btn-main'>";
			
					$tablestring .= "<div class='btn' id='column_level_options__button_1' data-level='column_level_options' style='display:none;' title='".__('Column Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Column Settings',ARP_PT_TXTDOMAIN)."' ><img src='".PRICINGTABLE_IMAGES_URL."/icons/general-setting-icon.png'></div>";
					
			
					$tablestring .= "<div class='btn action_btn' col-id=".$col_no[1]." data-level='column_level_options' id='delete_column' style='display:none;' title='".__('Delete Column',ARP_PT_TXTDOMAIN)."' data-title='".__('Delete Column',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/delete-icon2.png'></div>";					
					
			
					$tablestring .= "<div class='btn' id='header_level_options__button_1' data-level='header_level_options' title='".__('Header Settings',ARP_PT_TXTDOMAIN)."' data-title=title='".__('Header Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-setting-icon.png' ></div>";
										
			
					$tablestring .= "<div class='btn' id='body_level_options__button_1' data-level='body_level_options' style='display:none;' title='".__('Content Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Content Settings',ARP_PT_TXTDOMAIN)."'><img src='".PRICINGTABLE_IMAGES_URL."/icons/content-setting-icon.png'></div>";
					
					
					
					$tablestring .= "<div class='btn' id='body_li_level_options__button_1' data-level='body_li_level_options' title='".__('Description Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Description Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/description-setting-icon.png'></div>";
					$tablestring .= "<div class='btn' id='body_li_level_options__button_2' data-level='body_li_level_options' title='".__('Tooltip Settings',ARP_PT_TXTDOMAIN)."' data-title='".__('Tooltip Settings',ARP_PT_TXTDOMAIN)."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/tooltip-setting-icon.png'></div>";
					
					$tablestring .= "<div class='btn action_btn' id='add_new_row' data-level='body_li_level_options' title='".__('Add New Row',ARP_PT_TXTDOMAIN)."' data-title='".__('Add New Row',ARP_PT_TXTDOMAIN)."' data-id='".$col_no[1]."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/add-icon2.png'></div>";
					$tablestring .= "<div class='btn action_btn' id='copy_row' alt='' data-level='body_li_level_options' title='".__('Duplicate Row',ARP_PT_TXTDOMAIN)."' data-title='".__('Duplicate Row',ARP_PT_TXTDOMAIN)."' col-id='".$col_no[1]."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/duplicate-icon2.png'></div>";
					$tablestring .= "<div class='btn action_btn' id='remove_row' row-id='' data-level='body_li_level_options' title='".__('Delete Row',ARP_PT_TXTDOMAIN)."' data-title='".__('Delete Row',ARP_PT_TXTDOMAIN)."' col-id='".$col_no[1]."' style='display:none;'><img src='".PRICINGTABLE_IMAGES_URL."/icons/delete-icon2.png'></div>";
										
				$tablestring .= "</div>";
				
				$tablestring .= "<div class='column_level_options'>";
					
					
					
					$tablestring .= "<div class='column_option_div' level-id='column_level_options__button_1' style='display:none;'>";
					
						$tablestring .= "<div class='col_opt_row' id='column_width' style='display:none;'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('width (optional)',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								
								$tablestring .= "<div class='col_opt_input'>";
								$tablestring .= "<input type='text' name='column_width_".$col_no[1]."' id='column_width_input' data-column='main_".$j."' class='col_opt_input' value='".$columns["column_width"]."'>";
								$tablestring .= "<span>".__('Px',ARP_PT_TXTDOMAIN)."</span>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
													
						$tablestring .= "<div class='col_opt_row' id='set_hidden' style='display:none;'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Hidden (Optional)',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div two_column'>";
								$tablestring .= "<div class='arp_checkbox_div'>";
								if( $columns['is_hidden'] == 1 ) { $checked = "checked='checked'"; } else { $checked = ''; }
								$tablestring .= "<input type='checkbox' class='arp_checkbox dark_bg' ".$checked." value='1' id='show_column' name='show_column_".$col_no[1]."' data-column='main_".$j."' />";
								$tablestring .= "<label class='arp_checkbox_label'>".__('Yes',ARP_PT_TXTDOMAIN)."</label>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='column_level_caption_arp_ok_div__button_1' >";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
					$tablestring .= "</div>";
					
					
					
					$tablestring .= "<div class='column_option_div' level-id='header_level_options__button_1' style='display:none;'>";
					
						$tablestring .= "<div class='col_opt_row' id='column_title'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Column Title',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
								$tablestring .= "<textarea name='html_content_0' id='column_title_input' class='col_opt_textarea' data-column='main_column_0'>";
								$tablestring .= $columns['html_content'];
								$tablestring .= "</textarea>";
							$tablestring .= "</div>";
							$tablestring .= "<div class='col_opt_button'>";
							if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['caption_column_buttons']['header_level_options__button_1']) ){
								if(in_array('arp_object',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['caption_column_buttons']['header_level_options__button_1'])  ){
									$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster' name='add_header_object_".$col_no[1]."' id='add_arp_object' data-insert='column_title_input' data-column='main_".$j."' title='".__('Add Media',ARP_PT_TXTDOMAIN)."'>";
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/image-icon.png' />";
										
									$tablestring .= "</button>";
									$tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
								}
							}
							if( is_array( $arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['caption_column_buttons']['header_level_options__button_1'] ) ){
								if( in_array('arp_fontawesome',$arp_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['caption_column_buttons']['header_level_options__button_1']) ){
									
									$tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster' name='add_header_fontawesome_".$col_no[1]."' id='add_header_fontawesome' data-insert='column_title_input' data-column='main_".$j."' title='".__('Add Font Awesome Icon', ARP_PT_TXTDOMAIN)."' >";
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$tablestring .= "</button>";
								}
							}
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='header_caption_font_family'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
					
								$tablestring .= "<input type='hidden' id='header_font_family' name='header_font_family_".$col_no[1]."' data-column='main_".$j."' value='".$columns['header_font_family']."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='header_font_family_".$col_no[1]."' data-id='header_font_family_".$col_no[1]."'>";
									$tablestring .= "<dt><span>".$columns['header_font_family']."</span><input type='text' style='display:none;' value='".$columns['header_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='header_font_family' data-column='".$j."'>";
					
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row' id='header_caption_font_size'>";
							$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
								
									$tablestring .= "<input type='hidden' id='header_font_size' name='header_font_size_".$col_no[1]."' data-column='main_".$j."' value='".$columns['header_font_size']."' />";
									$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='header_font_size_".$col_no[1]."' data-id='header_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
										$tablestring .= "<dt><span>".$columns['header_font_size']."</span><input type='text' style='display:none;' value='".$columns['header_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
										$tablestring .= "<dd>";
											$size_arr = '';
											$tablestring .= "<ul data-id='header_font_size' data-column='".$j."'>";
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
						
						$tablestring .= "<div class='col_opt_row' id='header_caption_font_color'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
													
								$tablestring .= "<div class='col_opt_input_div' data-level='header_level_options' level-id='header_button1' >";
								
								
								
								$tablestring .= "<div class='arp_style_btn arptooltipster ".($columns['header_style_bold'] == 'bold' ? 'selected' : '')."' title='Bold' data-align='left' data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn arptooltipster ".($columns['header_style_italic'] == 'italic' ? 'selected' : '')."' title='Italic' data-align='center' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn arptooltipster ".($columns['header_style_decoration'] == 'underline' ? 'selected' : '')."' title='Underline' data-align='right' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn arptooltipster ".($columns['header_style_decoration'] == 'line-through' ? 'selected' : '')."' title='Line-through' data-align='right' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								
								
								$tablestring .= "<input type='hidden' id='header_style_bold' name='header_style_bold_".$col_no[1]."' value='".$columns['header_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='header_style_italic' name='header_style_italic_".$col_no[1]."' value='".$columns['header_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='header_style_decoration' name='header_style_decoration_".$col_no[1]."' value='".$columns['header_style_decoration']."' /> ";
								
								
		
							$tablestring .= "</div>";
							
							
						$tablestring .= "</div>";
						
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='header_level_caption_arp_ok_div__button_1' >";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
											
					$tablestring .= "</div>";
					
					
					
					
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
						
						$tablestring .= "<div class='col_opt_row' id='body_li_caption_font_family'>";
							$tablestring .= "<div class='col_opt_title_div'>".__('Font Family',ARP_PT_TXTDOMAIN)."</div>";
							$tablestring .= "<div class='col_opt_input_div'>";
						
								$tablestring .= "<input type='hidden' id='content_font_family' name='content_font_family_".$col_no[1]."' value='".$columns['content_font_family']."' data-column='main_".$j."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='content_font_family_".$col_no[1]."' data-id='content_font_family_".$col_no[1]."'>";
									$tablestring .= "<dt><span>".$columns['content_font_family']."</span><input type='text' style='display:none;' value='".$columns['content_font_family']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$tablestring .= "<ul data-id='content_font_family' data-column='".$j."'>";
						
										$tablestring .= "</ul>";
									$tablestring .= "</dd>";
								$tablestring .= "</dl>";
							$tablestring .= "</div>";
						$tablestring .= "</div>";
								
								
						$tablestring .= "<div class='col_opt_row' id='body_li_caption_font_size'>";
							$tablestring .= "<div class='btn_type_size'>";
								$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Size',ARP_PT_TXTDOMAIN)."</div>";
								$tablestring .= "<div class='col_opt_input_div two_column'>";
						
								$tablestring .= "<input type='hidden' id='content_font_size' name='content_font_size_".$col_no[1]."' data-column='main_".$j."' value='".$columns['content_font_size']."' />";
								$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='content_font_size_".$col_no[1]."' data-id='content_font_size_".$col_no[1]."' style='width:115px;max-width:115px;'>";
									$tablestring .= "<dt><span>".$columns['content_font_size']."</span><input type='text' style='display:none;' value='".$columns['content_font_size']."' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
									$tablestring .= "<dd>";
										$size_arr = array();
										$tablestring .= "<ul data-id='content_font_size' data-column='".$j."'>";
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
								
							//end
							
							
						$tablestring .= "</div>";
							
						$tablestring .= "<div class='col_opt_row' id='body_li_caption_font_color'>";
							$tablestring .= "<div class='col_opt_title_div two_column'>".__('Font Style',ARP_PT_TXTDOMAIN)."</div>";
							
						
							
								$tablestring .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button1' >";
								
								
								
								$tablestring .= "<div class='arp_style_btn arptooltipster ".($columns['body_li_style_bold'] == 'bold' ? 'selected' : '')."' title='".__('Bold',ARP_PT_TXTDOMAIN)."' data-align='left' data-column='main_".$j."' id='arp_style_bold' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-bold'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn arptooltipster ".($columns['body_li_style_italic'] == 'italic' ? 'selected' : '')."' title='".__('Italic',ARP_PT_TXTDOMAIN)."' data-align='center' data-column='main_".$j."' id='arp_style_italic' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-italic'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn arptooltipster ".($columns['body_li_style_decoration'] == 'underline' ? 'selected' : '')."' title='".__('Underline',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_underline' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-underline'></i>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='arp_style_btn arptooltipster ".($columns['body_li_style_decoration'] == 'line-through' ? 'selected' : '')."' title='".__('Line-through',ARP_PT_TXTDOMAIN)."' data-align='right' data-column='main_".$j."' id='arp_style_strike' data-id='".$col_no[1]."'>";
									$tablestring .= "<i class='fa fa-strikethrough'></i>";
								$tablestring .= "</div>";
								
								
								
								$tablestring .= "<input type='hidden' id='body_li_style_bold' name='body_li_style_bold_".$col_no[1]."' value='".$columns['body_li_style_bold']."' /> ";
								$tablestring .= "<input type='hidden' id='body_li_style_italic' name='body_li_style_italic_".$col_no[1]."' value='".$columns['body_li_style_italic']."' /> ";
								$tablestring .= "<input type='hidden' id='body_li_style_decoration' name='body_li_style_decoration_".$col_no[1]."' value='".$columns['body_li_style_decoration']."' /> ";
								
								
								
		
							$tablestring .= "</div>";
							
							//new font style btn ends
						$tablestring .= "</div>";
					
						
						$tablestring .= "<div class='col_opt_row arp_ok_div' id='body_level_caption_arp_ok_div__button_1' >";
							$tablestring .= "<div class='col_opt_btn_div'>";
								$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
									$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
								$tablestring .= "</button>";							
							$tablestring .= "</div>";
						$tablestring .= "</div>";
						
					$tablestring .= "</div>";
					

					$tablestring .= "<input type='hidden' id='total_rows' value='".count($columns['rows'])."' name='total_rows_".$col_no[1]."' />";
					
					$tablestring .= "<div class='column_option_div' level-id='body_li_level_options__button_1' style='display:none;'>";
						
						foreach( $columns['rows'] as $n=> $row )
						{
							$row_no = explode('_',$n);
							$splitedid = explode('_',$n);
						

							
							$tablestring .= "<div class='arp_row_wrapper' id='arp_".$n."' style='display:none;'>";
								
								$tablestring .= "<div class='col_opt_row arp_".$n."' id='description".$splitedid[1]."' >";
									$tablestring .= "<div class='col_opt_title_div'>".__('Description',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div'>";
										$tablestring .= "<textarea id='arp_li_description' col-id=".$col_no[1]." class='col_opt_textarea' name='row_".$col_no[1]."_description_".$row_no[1]."'>";
											$tablestring .= stripslashes_deep($row['row_description']);
										$tablestring .= "</textarea>";
									$tablestring .= "</div>";
								$tablestring .= "</div>";
								
								//li level objects
													
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
								
								$tablestring .= "<div class='col_opt_row arp_ok_div arp_".$n."' id='body_li_level_caption_arp_ok_div__button_1".$splitedid[1]."' >";
									$tablestring .= "<div class='col_opt_btn_div'>";
										$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
										$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
										$tablestring .= "</button>";								
									$tablestring .= "</div>";
								$tablestring .= "</div>";
							
							$tablestring .= "</div>";			
							
							// BODY LI TOOLTIP
														
						}
						
					$tablestring .= "</div>";
					
					$tablestring .= "<div class='column_option_div' level-id='body_li_level_options__button_2' style='display:none;'>";
						foreach( $columns['rows'] as $n=> $row )
						{
							$row_no = explode('_',$n);
							$splitedid = explode('_',$n);
							
							$tablestring .= "<div class='arp_tooltip_wrapper' id='arp_".$n."' style='display:none;' >";
										
								$tablestring .= "<div class='col_opt_row arp_".$n."' id='tooltip".$splitedid[1]."' >";
									$tablestring .= "<div class='col_opt_title_div'>".__('Tooltip',ARP_PT_TXTDOMAIN)."</div>";
									$tablestring .= "<div class='col_opt_input_div'>";
										$tablestring .= "<textarea id='arp_li_tooltip' col-id=".$col_no[1]." class='col_opt_textarea' name='row_".$col_no[1]."_tooltip_".$row_no[1]."'>";
											$tablestring .= stripslashes_deep($row['row_tooltip']);
										$tablestring .= "</textarea>";
									$tablestring .= "</div>";
								$tablestring .= "</div>";
								
								$tablestring .= "<div class='col_opt_row arp_".$n."' id='body_tooltip_add_shortcode".$splitedid[1]."' >";
								$tablestring .= "<div class='col_opt_btn_div'>";
									$tablestring .= "<button type='button' class='col_opt_btn arptooltipster arp_add_tooltip_shortcode' id='arp_add_tooltip_shortcode' name='row_".$col_no[1]."_add_tooltip_shortcode_btn_".$row_no[1]."' col-id=".$col_no[1]." data-id='".$col_no[1]."' data-row-id='tooltip_".$splitedid[1]."' title='".__('Add Font Awesome Icon',ARP_PT_TXTDOMAIN)."' >";
								
										$tablestring .= "<img src='".PRICINGTABLE_IMAGES_URL."/icons/font-awesome-icon.png' />";
									$tablestring .= "</button>";
								$tablestring .= "</div>";
							$tablestring .= "</div>";
								
								$tablestring .= "<div class='col_opt_row arp_ok_div arp_".$n."' id='body_li_level_caption_arp_ok_div__button_2".$splitedid[1]."' >";
									$tablestring .= "<div class='col_opt_btn_div'>";									
										$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
											$tablestring .= __('Ok',ARP_PT_TXTDOMAIN);
										$tablestring .= "</button>";
									$tablestring .= "</div>";
								$tablestring .= "</div>";
								
							$tablestring .= "</div>";
						}
					$tablestring .= "</div>";
					
				$tablestring .= "</div>";
				
			$tablestring .= "</div>";
			
		
		$tablestring .= "</div>";

				$x++;
				} //only for caption column
				else if($columns['is_caption'] == 1 and $template_feature['caption_style'] == 'style_1')
				{
					for($i = 0;$i <= $maxrowcount; $i++ )
					{
						$rows = isset($opts['columns'][$j]['rows']['row_'.$i]) ? $opts['columns'][$j]['rows']['row_'.$i] : array();
						$caption_li[$i] = stripslashes_deep($rows['row_description']);
					}
				} else if($columns['is_caption'] == 1 and $template_feature['caption_style'] == 'style_2') {
					for( $i = 0; $i <= $maxrowcount; $i++ )
					{
						$rows = isset($opts['columns'][$j]['rows']['row_'.$i]) ? $opts['columns'][$j]['rows']['row_'.$i] : array();
						$caption_li[$i] = stripslashes_deep($rows['row_description']);
					}
				}
			}
			
			$tablestring .= "<div class='arp_allcolumnsdiv' id='arp_allcolumnsdiv'>";
			
            $c = $x;
			if($c == 0)
			{
				$c = $x = 1;
			}
			$new_arr = array();
			if( is_array( $col_ord_arr ) && count( $col_ord_arr ) > 0 ){
				foreach( $col_ord_arr as $key=> $value ){
					$new_value = str_replace('main_','',$value);
					$new_col_id = $new_value;
					foreach( $opts['columns'] as $j=>$columns ){
						if( $new_col_id == $j ){
							if( $columns['is_caption'] != 1 ){
								$new_arr['columns'][$new_col_id] = $columns;
							}
						}
					}
				}
			} else {
				$new_arr = $opts;
			}
			
			$counter = 1;
			
			foreach($new_arr['columns'] as $j=>$columns)
			{	
				if( $columns['is_caption'] == 0 ) {
					$inlinecolumnwidth = "";
					if($columns["column_width"] != ""){
						$inlinecolumnwidth= 'width:'.$columns["column_width"].'px';
					} else {
						if( $column_settings['is_responsive'] != 1 ){
							$inlinecolumnwidth = $global_column_width;
						}
					}
					$column_highlight = $opts['columns'][$j]['column_highlight'];
						if($column_highlight && $column_highlight == 1 and $is_tbl_preview != 2)
							$highlighted_column = 'column_highlight ';
						else 
							$highlighted_column = '';
								
				$col_no = explode('_',$j);
                $tablestring .= "<div class='".$highlighted_column." ArpPricingTableColumnWrapper no_transition style_".$j." ".$hover_class." ".$animation_class."' id='main_column_".$col_no[1]."'  style='"; /*if($columns['is_hidden'] && $columns['is_hidden'] == 1){ $tablestring .= "display:none !important;"; }*/ if($c == 0){ $tablestring .= "border-left:1px solid #DADADA;"; } $tablestring .= $inlinecolumnwidth."' is_caption='0' data-order='".$counter."' data-template_id='".$ref_template."' data-level='column_level_options' data-type='other_columns_buttons' >";
										
					
                    $tablestring .= "<div class='arpplan "; if($columns['is_caption'] == 1){ $tablestring .= "maincaptioncolumn"; }else{ $tablestring .= "column_".$c; } if($x % 2 == 0){ $tablestring .= " arpdark-bg ArpPriceTablecolumndarkbg"; } $tablestring .= "'>";
					
						if( $ref_template == 'arptemplate_15' )
							$tablestring .= "<div class='arp_template_rocket'><div></div></div>";
							$columns['ribbon_setting']['arp_ribbon'] = isset($columns['ribbon_setting']['arp_ribbon']) ? $columns['ribbon_setting']['arp_ribbon'] : "";					
                        $tablestring .= "<div class='planContainer ".$columns['ribbon_setting']['arp_ribbon']."'>";
                         
							if( $columns['arp_header_shortcode'] != '' )
								$header_cls = 'has_arp_shortcode';
							else
								$header_cls = '';
						
						if( isset($columns['ribbon_setting']) && $columns['ribbon_setting'] and $columns['ribbon_setting']['arp_ribbon'] != '' and $columns['ribbon_setting']['arp_ribbon_content'] != ''){
							$basic_col = $arp_mainoptionsarr['general_options']['arp_basic_colors'];
							$ribbon_bg_col = $columns['ribbon_setting']['arp_ribbon_bgcol'];
							$base_color = $ribbon_bg_col;
							$base_color_key = array_search($base_color,$basic_col);
							$gradient_color = $arp_mainoptionsarr['general_options']['arp_basic_colors_gradient'][$base_color_key];
							$tablestring .= "<div id='arp_ribbon_container' class='arp_ribbon_container arp_ribbon_".strtolower($columns['ribbon_setting']['arp_ribbon_position'])." ".$columns['ribbon_setting']['arp_ribbon']." ' >";
							
								$tablestring .= "<style type='text/css'>";
								if( in_array( $base_color,$basic_col ) ){
									if( $columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_1' or $columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3'){
										$tablestring .= "#main_".$j." .arp_ribbon_content:before, #main_".$j." .arp_ribbon_content:after{";
											$tablestring .= "border-top-color:".$gradient_color." !important;";
										$tablestring .= "}";
									}
									if( $columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3'){
										$tablestring .= "#main_".$j." .arp_ribbon_content{";
											$tablestring .= "border-top:75px solid ".$base_color.";";
											$tablestring .= "color:".$columns['ribbon_setting']['arp_ribbon_txtcol'].";";
										$tablestring .= "}";
									} else {
										$tablestring .= "#main_".$j." .arp_ribbon_content{";
											$tablestring .= "background:".$base_color.";";
											$tablestring .= "background-color:".$base_color.";";
											$tablestring .= "background-image:-moz-linear-gradient(top, ".$base_color.", ".$gradient_color.");";
											$tablestring .= "background-image:-webkit-gradient(linear, 0 0, 0 100%, from(".$base_color."), to(".$gradient_color."));";
											$tablestring .= "background-image:-webkit-linear-gradient(top, ".$base_color.", ".$gradient_color.");";
											$tablestring .= "background-image:-o-linear-gradient(top, ".$base_color.", ".$gradient_color.");";
											$tablestring .= "background-image:linear-gradient(to bottom, ".$base_color.", ".$gradient_color.");";
											$tablestring .= "background-repeat:repeat-x;";
											$tablestring .= "filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='".$base_color."', endColorstr='".$gradient_color."', GradientType=0);";
											$tablestring .= '-ms-filter: "progid:DXImageTransform.Microsoft.gradient (startColorstr="'.$base_color.'", endColorstr="'.$gradient_color.'", GradientType=0)";';
											$tablestring .= "box-shadow:0 0 3px rgba(0,0,0,0.3);";
											$tablestring .= "color:".$columns['ribbon_setting']['arp_ribbon_txtcol'].";";
										$tablestring .= "}";
									}
								} else {
									if( $columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_1' or $columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3'){
										$tablestring .= "#main_".$j." .arp_ribbon_content:before,#main_".$j." .arp_ribbon_content:after{";
											$tablestring .= "border-top-color:".$base_color."  !important;";
										$tablestring .= "}";
									}
									if( $columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3'){
										$tablestring .= "#main_".$j." .arp_ribbon_content{";
											$tablestring .= "border-top:75px solid ".$base_color.";";
											$tablestring .= "color:".$columns['ribbon_setting']['arp_ribbon_txtcol'].";";
										$tablestring .= "}";
									} else {
										$tablestring .= "#main_".$j." .arp_ribbon_content{";
											$tablestring .= "background:".$base_color.";";
											$tablestring .= "color:".$columns['ribbon_setting']['arp_ribbon_txtcol'].";";
										$tablestring .= "}";
									}
								}
								$tablestring .= "</style>";
							
								$tablestring .= "<div class='arp_ribbon_content arp_ribbon_".strtolower($columns['ribbon_setting']['arp_ribbon_position'])."'>";
									if( $columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3' )
										$tablestring .= "<span>";
									$tablestring .= $columns['ribbon_setting']['arp_ribbon_content'];
									if( $columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3' )
										$tablestring .= "</span>";
								$tablestring .= "</div>";
								
							$tablestring .= "</div>";
						}
						
						$tablestring .= "<div class='arpcolumnheader ".$header_cls."'>";
                                		if( $template_feature['header_shortcode_position'] == 'default' && ( $ref_template == 'arptemplate_2' or $ref_template == 'arptemplate_5' ) ){
											$tablestring .= "<div class='arp_header_selection_new' data-template_id='".$ref_template."' data-level='header_level_options' data-type='other_columns_buttons' data-column='main_".$j."'>";
										}
										if( $columns['arp_header_shortcode'] != '' && $template_feature['header_shortcode_position'] == 'position_1' )
										{
										// start
										
										if( $template_feature['header_shortcode_position'] == 'position_1' && ( $ref_template == 'arptemplate_8' or $ref_template == 'arptemplate_7' ) ){
											$tablestring .= "<div class='arp_header_selection_new' data-template_id='".$ref_template."' data-level='header_level_options' data-type='other_columns_buttons'  data-column='main_".$j."'>";
										}
										$tablestring .= "<div class='arp_header_shortcode'>";
                                                if( $template_feature['header_shortcode_type'] == 'normal'){
                                                    $tablestring .= $arprice_form->arp_get_video_image($columns['arp_header_shortcode']);
                                                }
												else if( $template_feature['header_shortcode_type'] == 'rounded_corner' )
												{
                                                    $tablestring .= "<div class='rounded_corder'>".do_shortcode( $columns['arp_header_shortcode'] )."</div>";
                                                }	
											
                                        $tablestring .= "</div>";
                                    
										}
									
                                        if($columns['is_caption'] == 1)
                                        {                                  
                                    		$tablestring .= "<div class='arpcaptiontitle' id='column_header' data-template_id='".$ref_template."' data-level='header_level_options' data-type='other_columns_buttons'  data-column='main_".$j."'>".do_shortcode( $columns['html_content'] )."</div>";
											
											
									    }
                                        else
                                        {
										
										if( $ref_template == 'arptemplate_7' || $ref_template == 'arptemplate_3' ){
											$tablestring .= "<div class='arp_header_selection_new' data-template_id='".$ref_template."' data-level='header_level_options' data-type='other_columns_buttons' data-column='main_".$j."'>";
										}
									
									$tablestring .= "<div class='arppricetablecolumntitle' id='column_header' data-template_id='".$ref_template."' data-level='header_level_options' data-type='other_columns_buttons' data-column='main_".$j."'><div class='bestPlanTitle ".$title_cls."'>".do_shortcode( $columns['package_title'] )."</div>";
										
                                        
											if( $template_feature['column_description'] == 'enable' && $template_feature['column_description_style'] == 'style_1' && $columns['column_description'] != '' )
											{
												$tablestring .= "<div class='column_description ".$title_cls."'>".stripslashes_deep($columns['column_description'])."</div>";
											}
										
                                        $tablestring .= "</div>";
										
										if( $template_feature['header_shortcode_position'] == 'position_1' && ( $ref_template == 'arptemplate_8' or $ref_template == 'arptemplate_7' ) ){
											$tablestring .= "</div>";
										}
										
											if( $template_feature['column_description'] == 'enable' && $template_feature['column_description_style'] == 'style_3' && $columns['column_description'] != '' )
											{
												$tablestring .= "<div class='column_description ".$title_cls."'>".stripslashes_deep($columns['column_description'])."</div>";
											}
										if( $ref_template == 'arptemplate_7' ||  $ref_template == 'arptemplate_3' ){
											$tablestring .= "</div>";
										}
											if( $template_feature['button_position'] == 'position_2' )
											{
											
												$tablestring .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
												//ondblclick='get_template_options(\"".$template_id."\",\"button_options\",\"other_columns_buttons\",this,\"main_".$j."\")'
												$columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";
												$tablestring .= "<div class='arppricetablebutton' data-column='main_".$j."' style='text-align:center;'>";
												$tablestring .= "<button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn' id='bestPlanButton' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important;width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;'"; } /*$tablestring .= " onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .= "\"); '";*/ $tablestring .= ">"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .= "</button>";
												
                                                $tablestring .= "</div>";
												$tablestring .= "</div>";
											}
											
											if( $template_feature['header_shortcode_position'] == 'default' )
											{
												if( $columns['arp_header_shortcode'] != '' && $template_feature['header_shortcode_type'] == 'normal')
												{
												if($ref_template == 'arptemplate_5'){
													$tablestring .= "<div class='arp_header_shortcode'>".$arprice_form->arp_get_video_image($columns['arp_header_shortcode'])."</div>";				
												}else{
													$tablestring .= "<div class='arp_header_shortcode'>".do_shortcode( $columns['arp_header_shortcode'] )."</div>";										}
												}else if( $template_feature['header_shortcode_type'] == 'rounded_border' ){
  								    				$tablestring .= "<div class='rounded_corder'>".do_shortcode( $columns['arp_header_shortcode'] )."</div>";
												}
												
											} 
										if( $template_feature['header_shortcode_position'] == 'default' && ( $ref_template == 'arptemplate_2' or $ref_template == 'arptemplate_5' )){
											$tablestring .= "</div>";
										}
										if( $template_feature['amount_style'] == 'style_2' )
											$amount_style_cls = 'style_2';
										$tablestring .= "<div class='arppricetablecolumnprice ".( isset($amount_style_cls) ? $amount_style_cls : "" )."' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='pricing_level_options' data-type='other_columns_buttons' >";
										
												
                                                if( $template_feature['amount_style'] == 'default' )
                                                {
													$tablestring .= "<div class='arp_price_wrapper'>";
														if( $ref_template == 'arptemplate_1' ){
															$tablestring .= $columns['price_text'];
														} else if( $ref_template == 'arptemplate_4' ){
															$tablestring .= "<div class='arpmain_price'>";
																$tablestring .= "<div class='arp_pricerow'>";
																	$tablestring .= "<span class=\"arp_price_value\">";
																		$tablestring .= $columns['price_text'];
																	$tablestring .= "</span>";
																	$tablestring .= "<span class=\"arp_price_duration\">";
																		$tablestring .= $columns['price_label'];
																	$tablestring .= "</span>";
																$tablestring .= "</div>";
															$tablestring .= "</div>"; 
														}else {
															
															/*if( $template == 'arptemplate_10' ){
																$tablestring .= "<span class=\"arp_price_duration\">";
																	$tablestring .= $columns['price_label'];
																$tablestring .= "</span>";
																$tablestring .= "<span class=\"arp_price_value\">";
																	$tablestring .= $columns['price_text'];
																$tablestring .= "</span>";
															}else*/{
																$tablestring .= "<span class=\"arp_price_value\">";
																	$tablestring .= $columns['price_text'];
																$tablestring .= "</span>";
																$tablestring .= "<span class=\"arp_price_duration\">";
																	$tablestring .= $columns['price_label'];
																$tablestring .= "</span>";
															}	
														}
													$tablestring .= "</div>";
													
													$tablestring .= isset($columns['html_content']) ? $columns['html_content'] : ""; 
                                                }
                                                else if( $template_feature['amount_style'] == 'style_1' )
                                                {
                                                	$tablestring .= "<div class='arp_pricename'>";
														$tablestring .= "<div class='arp_price_wrapper'>";
															$tablestring .= "<span class=\"arp_price_value\">";
																$tablestring .= $columns['price_text'];
															$tablestring .= "</span>";
															$tablestring .= "<span class=\"arp_price_duration\">";
																$tablestring .= $columns['price_label'];
															$tablestring .= "</span>";
															
														$tablestring .= "</div>";
													$tablestring .= "</div>";
													$columns['html_content'] = isset($columns['html_content']) ? $columns['html_content'] : "";
													$tablestring .= do_shortcode( $columns['html_content'] );
												} else if( $template_feature['amount_style'] == 'style_2' ) {
														$tablestring .= "<div class='arp_price_wrapper'>";
														if( $template == 'arptemplate_11' ){
															$tablestring .= "<div class='arp_pricename_selection_new' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='pricing_level_options' data-type='other_columns_buttons'>";
														}
															$tablestring .= "<span class=\"arp_price_duration\">";
																$tablestring .= $columns['price_label'];
															$tablestring .= "</span>";
															$tablestring .= "<span class=\"arp_price_value\">";
																$tablestring .= $columns['price_text'];
															$tablestring .= "</span>";
																	
														if( $template == 'arptemplate_11' ){
															$tablestring .= "</div>";
														}
														$tablestring .= "</div>";
														$columns['html_content'] = isset($columns['html_content'] ) ? $columns['html_content']  : "";
														$tablestring .= do_shortcode( $columns['html_content'] );
												}
												
												if( $ref_template == 'arptemplate_12' )
													$tablestring .= "<div class='custom_seperator_1'></div>";
													              
													if( $template_feature['column_description'] == 'enable' && $template_feature['column_description_style'] == 'style_2' && $columns['column_description'] != '')
													{
														$tablestring .= "<div class='custom_ribbon_wrapper'>";
															$tablestring .= "<div class='column_description'>".stripslashes_deep($columns['column_description'])."</div>";
														$tablestring .= "</div>";
													}
																									
												if( $columns['column_description'] != '' && $template_feature['column_description'] == 'enable' && $template_feature['column_description_style'] == 'style_4' )
												{
                                                	$tablestring .= "<div class='column_description'>".stripslashes_deep($columns['column_description'])."</div>";
												}
												
												if( $template_feature['button_position'] == 'position_1' )
												{
													$tablestring .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
													//ondblclick='get_template_options(\"".$template_id."\",\"button_options\",\"other_columns_buttons\",this,\"main_".$j."\")'
													$columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";
													$tablestring .= "<div class='arppricetablebutton' data-column='main_".$j."' style='text-align:center;'>
                                                        <button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn' id='bestPlanButton' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important;width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;'"; } /*$tablestring .= " onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .= "\"); '";*/ $tablestring .= ">"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .= "</button>";
														
                                                    $tablestring .= "</div>";
													  $tablestring .= "</div>";
													
													
												}
										$tablestring .= "</div>";
                                    
                                        }
										if( $columns['arp_header_shortcode'] != '' && $template_feature['header_shortcode_position'] == 'position_2') 
										{
											$tablestring .= "<div class='arp_header_shortcode'>";
												if( $template_feature['header_shortcode_type'] == 'normal' )
													$tablestring .= do_shortcode( $columns['arp_header_shortcode'] );
												else if( $template_feature['header_shortcode_type'] == 'rounded_border' )
												{
													$tablestring .= "<div class='rounded_corder'>".do_shortcode( $columns['arp_header_shortcode'] )."</div>";
												}	
											$tablestring .= "</div>";										
										}
										
                            $tablestring .= "</div>";
							                            
						 $tablestring .= "<div class='arpbody-content arppricingtablebodycontent' id='arppricingtablebodycontent' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='body_level_options' data-type='other_columns_buttons'>";
						 
						
						if( $template_feature['button_position'] == 'position_3' ){
							$tablestring .= "<div class='column_description ".$title_cls."'>".stripslashes_deep($columns['column_description'])."</div>";
							
							
							
							$tablestring .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
							$columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";
													$tablestring .= "<div class='arppricetablebutton' data-column='main_".$j."' style='text-align:center;'>
                                                        <button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn' id='bestPlanButton' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important;width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;'"; }  $tablestring .= ">"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .= "</button>";
							$tablestring .= "</div>";
							 $tablestring .= "</div>";
						
										
						}
						
							$tablestring .= "<ul class='arp_opt_options arppricingtablebodyoptions' id='".$j."' style='text-align:".$columns['body_text_alignment'].";'>";
                                 												
                                    $r = 0;
                                    
                                    $row_order= isset($new_arr['columns'][$j]['row_order']) ? $new_arr['columns'][$j]['row_order'] : array();										
                                    if( $row_order && is_array( $row_order ) )
                                    {
                                        $rows = array();
                                        asort($row_order);
                                        $ji = 0;									
                                        $maxorder = max($row_order) ? max($row_order) : 0;
                                        foreach($new_arr['columns'][$j]['rows'] as $rowno => $row)
                                        {	
                                            $row_order[ $rowno ] = isset( $row_order[ $rowno ] ) ? $row_order[ $rowno ] : ($maxorder+1);
                                        }
                                                                             
                                        foreach( $row_order as $row_id => $order_id )
                                        {
                                            if( $new_arr['columns'][$j]['rows'][ $row_id ] )
                                            {
                                                $rows[ 'row_'.$ji ] = $new_arr['columns'][$j]['rows'][ $row_id ]; 		
                                                $ji++;
                                            }
                                        }
                                        
                                        $new_arr['columns'][$j]['rows'] = $rows;
                                    }
                                  	$column_count++;
                                    for($ri=0; $ri <= $maxrowcount; $ri++)
                                    {
                                        $rows = isset($new_arr['columns'][$j]['rows']['row_'.$ri]) ? $new_arr['columns'][$j]['rows']['row_'.$ri] : array(); 
                                        
                                        if($columns['is_caption'] == 1)
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
                                        else
                                        {
										
											if($column_count % 2 == 0)
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
                                        }
										//$caption_li
										if( $rows['row_description'] == '' ) { $rows['row_description'] = '&nbsp;'; }
										if( $template_feature['caption_style'] == 'style_1' and $template_feature['list_alignment'] != 'default' ){
										$tablestring .= "<li data-template_id='".$ref_template."' data-level='body_li_level_options' data-type='other_columns_buttons' data-column='main_".$j."' class=' arpbodyoptionrow ".$cls; if($rows['row_tooltip'] != ""){ /*$tablestring .= " arp_tooltip_li";*/ } $tablestring .= "' id='arp_row_".$ri."'>";
										//onclick='get_template_options(\"".$template_id."\",\"body_li_level_options\",\"other_columns_buttons\",this,\"main_".$j."\")'
                                        	$tablestring .= "<span class='caption_li'>".$rows['row_label']."</span>";
                                                $tablestring .= "<span class='caption_detail "; if($rows['row_tooltip'] != ""){ /*$tablestring .= " arp_tooltip";*/ } $tablestring .= "' title='"; if($rows['row_tooltip'] != ""){ $tablestring .= esc_html($rows['row_tooltip']); } $tablestring .= "'>".stripslashes_deep($rows['row_description'])."</span>
                                            </li>";                                    
										} else if( $template_feature['caption_style'] == 'style_2' ) {
										
											$tablestring .= "<li data-template_id='".$ref_template."' data-level='body_li_level_options' data-type='other_columns_buttons' data-column='main_".$j."' class=' arpbodyoptionrow ".$cls; if($rows['row_tooltip'] != ""){ /*$tablestring .= " arp_tooltip_li";*/ } $tablestring .= "' id='arp_row_".$ri."'";
											
											$tablestring .= ">";
                                            $tablestring .= "<span class='caption_detail "; if($rows['row_tooltip'] != ""){ /*$tablestring .= " arp_tooltip";*/ } $tablestring .= "' title='"; if($rows['row_tooltip'] != ""){ $tablestring .= esc_html($rows['row_tooltip']); } $tablestring .= "'>".stripslashes_deep($rows['row_description'])."</span>";
											$tablestring .= "<span class='caption_li'>".$rows['row_label']."</span>";
											$tablestring .= "</li>";
											
										}
										else if( $template_feature['list_alignment'] != 'default' )
										{  
										$tablestring .= "<li data-template_id='".$ref_template."' data-level='body_li_level_options' data-type='other_columns_buttons' data-column='main_".$j."' class=' arpbodyoptionrow ".$cls; if($rows['row_tooltip'] != ""){ /*$tablestring .= " arp_tooltip_li";*/ } $tablestring .= "' id='arp_row_".$ri."' style='text-align:".$template_feature['list_alignment']."' >";
										//onclick='get_template_options(\"".$template_id."\",\"body_li_level_options\",\"other_columns_buttons\",this,\"main_".$j."\")'
                                            $tablestring .= "<span class='"; if($rows['row_tooltip'] != ""){ /*$tablestring .= " arp_tooltip";*/ } $tablestring .= "' title='"; if($rows['row_tooltip'] != ""){ $tablestring .= stripslashes_deep($rows['row_tooltip']); } $tablestring .= "'>".stripslashes_deep($rows['row_description'])."</span>
                                           </li>";
										}
										else
										{ 
                                    		$tablestring .= "<li data-template_id='".$ref_template."' data-level='body_li_level_options' data-type='other_columns_buttons' data-column='main_".$j."' class=' arpbodyoptionrow ".$cls; if($rows['row_tooltip'] != ""){ /*$tablestring .= " arp_tooltip_li";*/ } $tablestring .= "' id='arp_row_".$ri."' style='text-align:"; /*if($rows['row_des_txt_align'] == 'right'){ $tablestring .= "right";} else if($rows['row_des_txt_align'] == 'left'){ $tablestring .= "left";} else { $tablestring .= "center"; }*/ $tablestring .= "' >";
											//onclick='get_template_options(\"".$template_id."\",\"body_li_level_options\",\"other_columns_buttons\",this,\"main_".$j."\")'
                                            $tablestring .= "<span class='"; if($rows['row_tooltip'] != ""){ /*$tablestring .= " arp_tooltip";*/ } $tablestring .= "' title='"; if($rows['row_tooltip'] != ""){ $tablestring .= stripslashes_deep($rows['row_tooltip']); } $tablestring .= "'>".stripslashes_deep($rows['row_description'])."</span>
                                           </li>";
										}
                                    }
                                $tablestring .= "</ul>";
                            $tablestring .= "</div>";
							
							
							// TMP5

							
							if($template_feature['amount_style'] == 'style_3'){
							$tablestring .= "<div class='arppricetablecolumnprice' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='pricing_level_options' data-type='other_columns_buttons' >";
    													$tablestring .= "<div class='arp_price_wrapper'>";
															
															$tablestring .= "<span class=\"arp_price_duration\">";
																$tablestring .= $columns['price_label'];
															$tablestring .= "</span>";
															$tablestring .= "<span class=\"arp_price_value\">";
																$tablestring .= $columns['price_text'];
															$tablestring .= "</span>";
														$tablestring .= "</div>";
														$columns['html_content'] = isset($columns['html_content']) ? $columns['html_content'] : "";
														$tablestring .= do_shortcode( $columns['html_content'] );
												 
											
								if( $template_feature['button_position'] == 'position_4' )
									{
													$tablestring .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
													//ondblclick='get_template_options(\"".$template_id."\",\"button_options\",\"other_columns_buttons\",this,\"main_".$j."\")'
													$columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";
													$tablestring .= "<div class='arppricetablebutton' data-column='main_".$j."' style='text-align:center;'>
                                                        <button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn' id='bestPlanButton' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important;width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;'"; } /*$tablestring .= " onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .= "\"); '";*/ $tablestring .= ">"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .= "</button>";
														
                                                    $tablestring .= "</div>";
													  $tablestring .= "</div>";
													
													
												}
												
								$tablestring .= "</div>";	
							}
							
							
							
						
							
							
							// TMP5
                        
                        
                            if($columns['button_text'] == '' && $template_feature['second_btn'] == false && $columns['btn_img'] == "")
							
                            {
								$tablestring .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_".$j."' >";
	                        		$tablestring .= "<div class='arppricetablebutton'>&nbsp;</div>"; 
								$tablestring .= "</div>";	                 
                            }
							
                            else if( $template_feature['button_position'] == 'default' )
                            {
								$tablestring .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
								//ondblclick='get_template_options(\"".$template_id."\",\"button_options\",\"other_columns_buttons\",this,\"main_".$j."\")'
							
									if( $template_feature['second_btn'] == true && $columns['button_s_text'] != '' ){ $has_s_btn = 'has_second_btn'; } else { $has_s_btn = 'no_second_btn'; }
									
									$columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";
                        			$tablestring .= "<div class='arppricetablebutton' data-column='main_".$j."' style='text-align:center;'>";
										if( $columns['button_text'] != '' )
										{
											$tablestring .= "<button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn ".$has_s_btn."' id='bestPlanButton' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' data-column='main_".$j."' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important;width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;' "; }  /*$tablestring .= "onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .="\");'";*/ $tablestring .= ">"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .="</button>";
										}
										
										if( $template_feature['second_btn'] == true && $columns['button_s_text'] != '' )
										{
											if( $columns['button_text'] != '' ){ $has_f_btn = 'has_first_btn'; } else { $has_f_btn = 'no_first_btn'; }
											$tablestring .= "<button type='button' class='bestPlanButton arp_".strtolower($columns['button_s_size'])."_btn SecondBestPlanButton ".$has_f_btn."' id='bestPlanButton' data-template_id='".$ref_template."' data-level='second_button_options' data-type='other_columns_buttons' data-column='main_".$j."' "; if($columns['button_s_img'] != ""){ $tablestring .= "style='background:url(".$columns['button_s_img'].") no-repeat !important;width:".$columns['btn_s_img_width']."px;height:".$columns['btn_s_img_height']."px;' "; }  /*$tablestring .= "onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['s_is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .="\");'";*/ $tablestring .= ">"; if($columns['button_s_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_s_text']); } $tablestring .="</button>";
										}
									$tablestring .= "</div>";
								
									if( $ref_template == 'arptemplate_16' ){
										$tablestring .= "<div class='arp_bottom_image'>";
											$tablestring .= "<ul class='arp_boat_img'><li></li></ul>";
											$tablestring .= "<ul class='arp_water_imgs'>";
												$tablestring .= "<li class='arp_water_img_1'></li>";
												$tablestring .= "<li class='arp_water_img_2'></li>";
											$tablestring .= "</ul>";
										$tablestring .= "</div>";
									}
																
								$tablestring .= "</div>";	
                            } 
                        	
							if( $template_feature['column_description'] == 'enable' and $template_feature['column_description_style'] == 'after_button' ){
								$tablestring .= "<div class='column_description ".$title_cls."'>".stripslashes_deep($columns['column_description'])."</div>";
							}
							
                    $tablestring .= "</div>";
                $tablestring .= "</div>";
			
			
			/* Dynamic Button Options */
			$col_no = explode('_',$j);
				include(PRICINGTABLE_CLASSES_DIR.'/class.arprice_preview_editor_option.php');	
			$tablestring .= "</div>";		//ArpPricingTableColumnWrapper div
			
			
							
			$c++;
				
					if($x % 5 == 0)
					{
						$c = 1;
					}
				//}	
				$x++;
			}
			$counter++;
		}

		$tablestring .= "</div>";
			
	} else {
			$tablestring .= __('Please select valid table',ARP_PT_TXTDOMAIN);
		}
	   
	   

$tablestring .= "<div id='arp_all_font_listing' style='display:none;'>";	
	$default_fonts = $arprice_fonts->get_default_fonts();		
	$google_fonts = $arprice_fonts->google_fonts_list();
	$tablestring .= "<ol class='arp_selectbox_group_label'>".__('Default Fonts',ARP_PT_TXTDOMAIN)."</ol>";
	foreach( $default_fonts as $font ){
		$tablestring .= "<li data-value='".$font."' data-label='".$font."'>".$font."</li>";
	}	
		$tablestring .= "<ol class='arp_selectbox_group_label'>".__('Google Fonts',ARP_PT_TXTDOMAIN)."</ol>";
	foreach( $google_fonts as $font ){
	 	$tablestring .= "<li data-value='".$font."' data-label='".$font."'>".$font."</li>";
	}
$tablestring .= "</div>";	   
	   
	   
$tablestring .= "</div>";

    $tablestring .= "<div class='arp_next_div' "; if(!$navigation) { $tablestring .= "style='display:none;'"; } $tablestring .= ">";
    	$tablestring .= "<div id='arp_next_btn_".$table_id."' class='arp_next_btn ".$column_animation['navigation_style']."'></div>";
    $tablestring .= "</div>";

$tablestring .= "</div>";
$tablestring .= "</div>";
if( isset($column_animation['is_animation']) and $column_animation['is_animation'] == 'yes' and $is_tbl_preview != 2 and $column_animation['is_pagination'] == 1 and ( $column_animation['pagination_position'] == 'Bottom' or $column_animation['pagination_position'] == 'Both'  ) )
    	$tablestring .= "<div class='arp_pagination
 ".$column_animation['pagination_style']." arp_pagination
_bottom' id='arp_slider
_".$id."_pagination_bottom'></div>";

return $tablestring;	
	}
}
?>