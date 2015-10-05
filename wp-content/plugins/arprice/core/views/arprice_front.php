<?php
if( ! function_exists( 'arp_get_pricing_table_string' ) ){
	function arp_get_pricing_table_string( $table_id, $pricetable_name = "", $is_tbl_preview = 0 ) {
	
	global $wpdb,$arprice_form,$arp_mainoptionsarr,$arp_pricingtable;
	$arp_mainoptionsarr = $arp_pricingtable->arp_mainoptions();
	$id 	= $table_id;
	$name 	= $pricetable_name;
	
	if( $is_tbl_preview && $is_tbl_preview == 1 )
	{
		if( isset($_REQUEST['optid']) && $_REQUEST['optid'] != '' )
		{
			$post_values = get_option( $_REQUEST['optid'] );
			$get_preview_data = $arprice_form->get_preview_table( $post_values );
			
			//update_option( $_REQUEST['optid'], '' );
			$id	= $table_id	= $get_preview_data['table_id'];
			$is_template = $get_preview_data['is_template'];
			$is_animated = $get_preview_data['is_animated'];
			$opts = maybe_unserialize($get_preview_data['table_options']);
			$general_option = maybe_unserialize($get_preview_data['general_options']);
			
			$arp_template_name = $get_preview_data['template_name'];
			
		}		
	}
	else
	{
		$sql = $wpdb->get_row( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice WHERE ID = %d AND status = %s ", $id, 'published') );
		$table_id = $sql->ID;
		$sql_opt = $wpdb->get_results( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice_options WHERE table_id = %d ", $table_id) );
		$is_template = $sql->is_template;
		$is_animated = $sql->is_animated;
		$opts 			= maybe_unserialize($sql_opt[0]->table_options);
		$general_option = maybe_unserialize( $sql->general_options );
		$arp_template_name = $sql->template_name;
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
	
	$arp_tablet_view_width = $arp_mainoptionsarr['general_options']['template_options']['arp_tablet_view_width'];
		
	$opts['columns'] = $table_cols; 
	
	
		
	$column_animation	= $general_option['column_animation'];
	
	$is_animation = $column_animation['is_animation'];
	
	$column_settings = $general_option['column_settings'];
	
	$hover_type = $column_settings['column_highlight_on_hover'];
	
	$template_settings = $general_option['template_setting'];
	
	$general_settings = $general_option['general_settings'];
	
	$template_type = $template_settings['template_type'];
	
	$template = $template_settings['template'];
	
	$template_id = $template_settings['template'];
	
	$ref_template = $general_settings['reference_template'];
	
	$is_responsive = $general_option['column_settings']['is_responsive'];
		
	if( $is_tbl_preview == 1 )
	{	
		$template_feature = maybe_unserialize(stripslashes($general_option['template_setting']['template_feature']));
	}
	else
	{		
		$template_feature = $arp_mainoptionsarr['general_options']['template_options']['features'][$ref_template];
	}

	if( $is_tbl_preview == 1 )
	{
		if( $is_template == 1){
			do_action('enqueue_preview_style',$arp_template_name,$arp_template_name,0,$is_template);
		}else{
			do_action('enqueue_preview_style',$id,$id,0,$is_template);
		}
		
	}
	
	
	
	
	$tablestring = "";
	
	$title_cls = "";
	
	if( $column_animation['is_animation'] == 'yes' ){
		$animation_margin = 'margin-bottom:45px;';
	} else {
		$animation_margin = '';
	}
	
	//pre render action
	do_action('arp_predisplay_pt_action',$table_id);
	do_action('arp_predisplay_pt_action'.$table_id,$table_id);
	
	$tablestring = apply_filters('arp_predisplay_pricingtable_filter', $tablestring, $table_id);
	
	if( $column_animation['is_animation'] == 'yes' and $column_animation['pagi_nav_btn'] == 'pagination_top' )
		$tablestring .= "<div class='arp_pagination arp_pagination_top arp_paging_style_1' id='arp_slider_".$id."_paginatio_top'></div>";
	$tablestring .= "<div class='arp_template_main_container' id='arp_template_main_container'>";
	$tablestring .= "<div class='ArpTemplate_main' id=\"ArpTemplate_main\" style='clear:both;".$animation_margin."'>";
	$column_ord = str_replace('\'','"',$general_settings['column_order']);

	$col_ord_arr =  json_decode( $column_ord,true );
	
	
	if( $is_template == 1){
		$template_name = $arp_template_name;
	}else{
		$template_name = $table_id;
	}	
	
	if( $is_tbl_preview == 1 ){
		if($ref_template == 'arptemplate_5' || $ref_template == 'arptemplate_7'){
			$googlemap = 0;
				if( $opts['columns'] )
				{
					foreach( $opts['columns'] as $columns )
					{
						$html_content	= isset($columns['arp_header_shortcode']) ? $columns['arp_header_shortcode'] : "";
						if( preg_match('/arp_googlemap/', $html_content) )
							$googlemap = 1;														
					}	
				}
				
				if( $googlemap )
				{
					$tablestring .= '<script type="text/javascript" language="javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>';
					$tablestring .='<script type="text/javascript" language="javascript" src="'.PRICINGTABLE_URL.'/js/jquery.gomap-1.3.2.min.js"></script>';
				}
		}	
	}
	
	$tablestring .= "<style type='text/css' media='all'>";

	$tablestring .= $arprice_form->arp_render_customcss($template_name, $general_option,1,$opts,$is_animated );
	
	
	
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
	
	$tablestring .= get_option('arp_global_custom_css');
		
	$tablestring .= isset($general_settings['arp_custom_css']) ? $general_settings['arp_custom_css'] : "";
	
	if( get_option('arp_desktop_responsive_size') and get_option('arp_desktop_responsive_size') > 0 and $general_option['column_settings']['is_responsive'] == 1 ){
		$tablestring .= ".arp_template_main_container{ max-width:".get_option('arp_desktop_responsive_size')."px !important; }";
	}
		
	if( get_option('arp_mobile_responsive_size') and get_option('arp_mobile_responsive_size') > 0 and $general_option['column_settings']['is_responsive'] == 1 ){
		$tablestring .= "
			@media all and (max-width:".get_option('arp_mobile_responsive_size')."px){";
			$tablestring .= ".arptemplate_".$template_name." .ArpPricingTableColumnWrapper.no_animation.maincaptioncolumn, .arptemplate_".$template_name." .ArpPricingTableColumnWrapper.no_animation, .arptemplate_".$template_name." .ArpPricingTableColumnWrapper.maincaptioncolumn, .arptemplate_".$template_name." .ArpPricingTableColumnWrapper{";
				$tablestring .= "max-width:100% !important;";
				if($is_animation){
					$tablestring .= "width:100%;";
				}else{
					$tablestring .= "width:100% !important;";
				}
				/*$tablestring .= "position:inherit !important;";*/
			$tablestring .= "}";
			
		$tablestring .= "}";
	}
	
	if( get_option('arp_mobile_responsive_size') and get_option('arp_mobile_responsive_size') > 0 ){
		$tablestring .= "@media all and (max-width:".get_option('arp_mobile_responsive_size')."px){";
		
			if($ref_template == 'arptemplate_1'){
				$tablestring .= ".arptemplate_".$template_name." .maincaptioncolumn .arpplan{";
					$tablestring .= "border-right:1px solid #E3E3E3 !important;";
				$tablestring .= "}";
			}
			if($ref_template == 'arptemplate_12'){
				$tablestring .= ".arptemplate_".$template_name." .maincaptioncolumn .arpplan{";
					$tablestring .= "border-right:1px solid #E0E0E0;";
				$tablestring .= "}";
			}
			
			if($ref_template == 'arptemplate_9'){
				$tablestring .= ".arptemplate_".$template_name." .maincaptioncolumn .arpcolumnheader  .arpcaptiontitle{";
					$tablestring .= "border-right:1px solid #D9D9D9;";
					$tablestring .= "border-radius: 2px 2px 0px 0px;
										-moz-border-radius: 2px 2px 0px 0px;
										-webkit-border-radius: 2px 2px 0px 0px;
										-o-border-radius: 2px 2px 0px 0px;";
										
				$tablestring .= "}";
				$tablestring .= ".arptemplate_".$template_name." .maincaptioncolumn .arppricingtablebodycontent{";
					$tablestring .= "border-right:1px solid #D9D9D9;";
				$tablestring .= "}";
			}
			
			
			
			if($ref_template == 'arptemplate_6'){
				
				$tablestring .= ".arptemplate_".$template_name." .arppricingtablebodycontent{";
					$tablestring .= "border-left:1px solid #cccccc;";
				$tablestring .= "}";
				
				$tablestring .= ".arptemplate_".$template_name." .arppricetablecolumnprice{";
					$tablestring .= "border-left:1px solid #cccccc;";
				$tablestring .= "}";
				
				$tablestring .= ".arptemplate_".$template_name." .arp_allcolumnsdiv .arpcolumnfooter{";
					$tablestring .= "border-left:1px solid #cccccc;";
				$tablestring .= "}";
				
				$tablestring .= ".arptemplate_".$template_name." .arp_allcolumnsdiv .arpplan .arppricetablecolumntitle{";
					$tablestring .= "border-left:1px solid #cccccc;";
				$tablestring .= "}";
			}
			
			
			
		$tablestring .= "}";
	}
	
	$tablestring .= ".arptemplate_".$template_name." .ArpPricingTableColumnWrapper{";
		$column_min_width = '';
		if( ( $column_settings['column_min_width'] == '' or $column_settings['column_min_width'] < 1 ) and $is_responsive == 1){
			$column_min_width = $arp_mainoptionsarr['general_options']['template_options']['arp_min_max_width'][$reference_template]['min-width'];
		} else {
			$column_min_width = $column_settings['column_min_width'];
		}
		$tablestring .= "min-width:".$column_min_width."px;";
		
		if( $column_settings['column_max_width'] != '' and $column_settings['column_max_width'] > 0 and $is_responsive == 1){
			$tablestring .= "max-width:".$column_settings['column_max_width']."px;";
		}
		
	$tablestring .= "}";
	
	$tablestring .= "</style>";
	
	$tltp_bgcolor = $arprice_form->hex2rgb($general_option['tooltip_settings']['background_color']);
	
	$tablestring .= "<input type='hidden' id='arp_mobile_size_width' name='arp_mobile_size_width' value='".get_option('arp_mobile_responsive_size')."' />";
	$tablestring .= "<input type='hidden' id='arp_is_responsive' name='arp_is_responsive' value='".$general_option['column_settings']['is_responsive']."' />" ;
	$tablestring .= "<input type='hidden' id='arp_is_animated' name='arp_is_animated' value='".$is_animated."' />";
	
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
		
	if($general_option['tooltip_settings']['animation'])
	{
		$tooltip_animation = $general_option['tooltip_settings']['animation'];
	}	
	else
	{
		$tooltip_animation = 'grow';
	}
	
	$tablestring .= "<div class='arp_inlinescript'><script type='text/javascript'>
		function arp_tooltip_support_".$template_name."(){
			jQuery('.arp_price_table_".$template_name." .arp_tooltip').tooltipster({
				animation: '".$tooltip_animation."',
				theme: 'arp_tooltip_".$template_name."',
				position:'".$general_option['tooltip_settings']['position']."',
				positionTracker:true,
				contentAsHTML:true,
				interactive:false,
				maxWidth:350,	
				autoClose:true,
				speed:250,
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
		}
	</script>";

$tablestring .= "<input type='hidden' name='template' id='arp_template' value='".$template_settings['template']."' />";
$tablestring .= "<input type='hidden' name='template_type' id='arp_template_type' value='".$template_type."' />";
$tablestring .= "<input type='hidden' name='is_tbl_preview' id='is_tbl_preview' value='".$is_tbl_preview."' />";
$tablestring .= "<input type='hidden' name='arp_ref_template' id='arp_ref_template' value='".$ref_template."' /></div>";
$tablestring .= "<input type='hidden' id='arp_column_effect_type' name='arp_column_effect_type' value='".$hover_type."' /> ";
  
	$template_id = $template_settings['template'];
	$color_scheme = 'arp'.$template_settings['skin'];
	if($hover_type == 0)
	{
		$hover_class = 'hover_effect';
	}
	else if($hover_type == 1)
	{
		$hover_class = 'shadow_effect';
	}
	else
	{
		$hover_class = 'no_effect';
	}
	if($is_animation != "" && $is_animation == 'yes')
	{
		$animation_class = 'has_animation';
	}
	else
	{
		$animation_class = 'no_animation';
	}
	$global_column_width = "";
	if( $column_settings['all_column_width'] && $column_settings['all_column_width'] > 0 ){
		$global_column_width = 'width:'.$column_settings['all_column_width'].'px;';
	}


if( $column_animation['is_animation'] == 'yes' and $column_animation['pagi_nav_btn'] != 'navigation' ){
	global $arp_is_animation;
	$arp_is_animation = 1;
	$slider_pagination_container = 'arp_slider_pagination';
	if( $column_animation['pagi_nav_btn'] == 'pagination_top' ){
		$slider_pagination_container .= ' Top';
	} else if ( $column_animation['pagi_nav_btn'] == 'pagination_bottom' or $column_animation['pagi_nav_btn'] == 'both' ) {
		$slider_pagination_container .= ' Bottom';
	}
} else {
	$slider_pagination_container = '';
}


/* Navigation button for animation */ 
	$navigation	= "";
	if( $column_animation['is_animation'] == 'yes' )
	{
		$navigation 		= ( $column_animation['pagi_nav_btn'] == 'navigation' or $column_animation['pagi_nav_btn'] == 'both' ) ? 1 : 0;
	}
    $tablestring .= "<div class='arp_prev_div'"; if(!$navigation) { $tablestring .= " style='display:none;'"; } $tablestring .= ">";
    $tablestring .= "<div id='arp_prev_btn_".$template_name."' class='arp_prev_btn arp_nav_style_1'></div>";
    $tablestring .= "</div>";
    
	/* Navigation button for animation */ 

//$tablestring .= "<div class='ArpPriceTable arp_price_table_".$table_id." arp_template_".$id." ".$color_scheme." ".$slider_pagination_container."'";
$tablestring .= "<div class='ArpPriceTable arp_price_table_".$template_name." arptemplate_".$template_name." ".$color_scheme." ".$slider_pagination_container."'";

	/* If Table has Animation */
    if( isset($column_animation['is_animation']) and $column_animation['is_animation'] == 'yes' )
	{
		global $arp_pricingtable;
		$arp_pricingtable->arp_pricing_table_main_settings();
		global $arp_mainoptionsarr;
		$data_items 		= $column_animation['visible_column'] ? $column_animation['visible_column'] : 1;
		$scrolling_columns 	= $column_animation['scrolling_columns'] ? $column_animation['scrolling_columns'] : 1;
		$navigation 		= ( $column_animation['pagi_nav_btn'] == 'navigation' or $column_animation['pagi_nav_btn'] == 'both' ) ? 1 : 0;
		$transition_speed	= $column_animation['transition_speed'] ? $column_animation['transition_speed'] : '500';
		//$hide_caption		= $column_animation['hide_caption'] ? $column_animation['hide_caption'] : 0;
		$hide_caption 		= ( $column_settings['hide_caption_column'] == 1 ) ? 1 : 0;
		//$infinite			= $column_animation['is_infinite'] ? $column_animation['is_infinite'] : 0;
		$autoplay 			= ( $column_animation['autoplay'] == 1 ) ? 1 : 0;
		$infinite			= $autoplay ? 1 : 0;
		
		$sliding_effect = (in_array($column_animation['sliding_effect'], $arp_mainoptionsarr['general_options']['column_animation']['sliding_effect'])) ? $column_animation['sliding_effect'] : 'slide';
		$easing_effect = (in_array($column_animation['sliding_effect'], $arp_mainoptionsarr['general_options']['column_animation']['easing_effect'])) ? $column_animation['sliding_effect'] :'swing';
		
		
		
		
		
		$tablestring .= "data-animate='true' data-id='".$template_name."' data-items='".$data_items."' data-scroll='".$scrolling_columns."' data-autoplay='".$autoplay."' data-effect='".$sliding_effect."' data-speed='".$transition_speed."' data-caption='".$hide_caption."' data-infinite='".$infinite."' data-easing='".$easing_effect."' style='display:table-cell;'";		 
	}			
$tablestring .= ">";

    $tablestring .= "<div id='ArpPricingTableColumns'"; if($navigation) { $tablestring .= " style='display:table-cell;'"; }
	
	$tablestring .= ">";
	
	
		
		$x = 0;
		if($opts['columns'] and count( $opts['columns'] ) > 0 )
		{
			/* Caption Column */
			$header_img = array();
			foreach( $opts['columns'] as $j=>$columns )
			{
				if( isset($columns['arp_header_shortcode']) && $columns['arp_header_shortcode'] != '' )
					$header_img[] = 1;
				else
					$header_img[] = 0;
			}
			
			foreach( $opts['columns'] as $j=>$columns ){
				
				if( $columns['column_width'] != '' && $columns['column_width'] > 0 ){
					$inline_column_width[] = 1;
				} else {
					$inline_column_width[] = 0;
				}
				
			}
			
			
			$margin_top_all_div	= "";
			if(  isset($column_animation['is_animation']) and $column_animation['is_animation'] == 'yes' ){
				if($ref_template == 'arptemplate_10' || $ref_template == 'arptemplate_13' || $ref_template == 'arptemplate_14' || $ref_template == 'arptemplate_15' || $ref_template == 'arptemplate_16')
				{
					$margin_top_all_div = 'padding-top:36px;';
				}
				else
				{
					$margin_top_all_div = 'padding-top:22px;';
				}
			}
			$tablestring .= "<div class='arp_allcolumnsdiv' style='".$margin_top_all_div."'>";
			
            
			foreach($opts['columns'] as $j=>$columns)
			{
				
				if($columns['is_caption'] == 1 and $template_feature['caption_style'] == 'default') {
					$inlinecolumnwidth = "";
						if($columns["column_width"] != "")
							$inlinecolumnwidth= 'width:'.$columns["column_width"].'px';
					$column_highlight = $opts['columns'][$j]['column_highlight'];
						if($column_highlight && $column_highlight == 1)
							$highlighted_column = 'column_highlight';
				
				if( $columns['column_width'] != '' or ( $global_column_width != ''  and $is_responsive != 1 ) ){
					$has_custom_column_width = 'has_custom_column_width="true"';
					$has_custom_width = 'arp_has_custom_width';
				} else {
					$has_custom_column_width = 'has_custom_column_width="false"';
					$has_custom_width = '';
				}
				
				if( $column_settings['space_between_column'] == 'yes' and $column_settings['column_space'] > 0 ){
					$has_column_space = 'has_column_space="'.$column_settings['column_space'].'"';
				} else {
					$has_column_space = 'has_column_space="false"';
				}
				
				$column_settings['hide_caption_column'] = isset($column_settings['hide_caption_column']) ? $column_settings['hide_caption_column'] : "";				
                $tablestring .= "<div id='main_".$j."' ".$has_custom_column_width." ".$has_column_space." class='ArpPricingTableColumnWrapper ".$has_custom_width." style_".$j." maincaptioncolumn ".$animation_class."' style='"; if( ($columns['is_hidden'] && $columns['is_hidden'] == 1 ) or $column_settings['hide_caption_column'] == 1 ){ $tablestring .= "display:none;"; } if( $columns['column_width'] != '' && $columns['column_width'] > 0 ){ $tablestring .= $inlinecolumnwidth; } else { if( $is_responsive != 1 ){ $tablestring .= $global_column_width; } } $tablestring .= "'"; $tablestring.= " >";
				
				$tablestring .= "<div class='arpplan "; if($columns['is_caption'] == 1){ $tablestring .= "maincaptioncolumn"; }else{ $tablestring .= $j." "; } if($x % 2 == 0){ $tablestring .= " arpdark-bg ArpPriceTablecolumndarkbg"; } $tablestring .= "' style='"; if( ( $columns['is_hidden'] && $columns['is_hidden'] == 1 ) or $column_settings['hide_caption_column'] == 1 ){ $tablestring .= "display:none;"; } $tablestring .= "' >";
                	if( $ref_template == 'arptemplate_15' )
							$tablestring .= "<div class='arp_template_rocket'><div></div></div>";
					$tablestring .= "<div class='planContainer'>";
                    		
						if( ( $template == 'arptemplate_4' || $template == 'arptemplate_12') && in_array(1,$header_img) )
							$header_cls = 'has_header_code';
						
                    	$tablestring .= "<div class='arpcolumnheader ".(isset($header_cls) ? $header_cls : "")."'>";
														
									if($columns['is_caption'] == 1)
									{
										if( $template_feature['caption_title'] == 'default' )
										{
											if( $template == 'arptemplate_1' && in_array(1,$header_img))
												$header_cls = 'has_header_code';
											else
												$header_cls = '';
                                    
                                        	$tablestring .= "<div class='arpcaptiontitle ".$header_cls."'>".do_shortcode( stripslashes_deep($columns['html_content']) )."</div>";
										}
										else if( $template_feature['caption_title'] == 'style_1' )
										{											
                                    		$tablestring .= "<div class='arpcaptiontitle'>
                                            	
                                                <div class='arpcaptiontitle_style_1'>".do_shortcode( stripslashes_deep($columns['html_content']) )."</div>
                                            </div>";
										}
									}
									else
									{
										$tablestring .= "<div class='arppricetablecolumntitle'>
											<div class='bestPlanTitle'>".do_shortcode( stripslashes_deep($columns['package_title']) )."</div>
										</div>
										<div class='arppricetablecolumnprice ".$template_feature['amount_style']."'>".do_shortcode( stripslashes_deep($columns['html_content']) )."</div>";
									}
								
                        $tablestring .= "</div>
                        <div class='arpbody-content arppricingtablebodycontent'>
                            <ul class='arp_opt_options arppricingtablebodyoptions' id='column_".$x."' style='text-align:".$columns['body_text_alignment']."' >";
	
                                $r = 0;
								
								$row_order= isset($opts['columns'][$j]['row_order']) ? $opts['columns'][$j]['row_order'] : array();										
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
										if($x % 2 == 0)
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
                                	
									if( $rows['row_tooltip'] != '' ){
										global $arp_has_tooltip;
										$arp_has_tooltip = 1;
									}
																		
									$fa_pattern = '/fa/i';
									
									if( preg_match( $fa_pattern, $rows['row_description'] ) > 0 or preg_match( $fa_pattern, $rows['row_tooltip'] ) > 0 or preg_match( $fa_pattern, $rows['row_label'] ) > 0 or preg_match($fa_pattern,$columns['html_content']) > 0 or preg_match($fa_pattern,$columns['package_title']) > 0 ){
										global $arp_has_fontawesome;
										$arp_has_fontawesome = 1;
									}
									
									//exit;
									
                                    $tablestring .= "<li class='".$cls."' id='arp_row_".$ri."' style='text-align:"; /*if($rows['row_des_txt_align'] == 'right'){ $tablestring .= "right";} else if($rows['row_des_txt_align'] == 'left'){ $tablestring .= "left";} else { $tablestring .= "center"; }*/ $tablestring .= "' ><span class='"; if($rows['row_tooltip'] != ""){ $tablestring .= "arp_tooltip"; } $tablestring .= "' title='"; if($rows['row_tooltip'] != ""){ $tablestring .= stripslashes_deep($rows['row_tooltip']); } $tablestring .= "'>".(!empty($rows['row_description']) ? stripslashes_deep($rows['row_description']) :'&nbsp;')."</span></li>";
								
								
                                }
                            
                           $tablestring .= "</ul>
                        </div>";
                        
							if( $template_feature['button_position'] == 'default' )
							{                        
                            	$tablestring .= "<div class='arpcolumnfooter arp_".strtolower($columns['button_size'])."_btn'>";
								
                                    if($columns['button_text'] == '' && empty($columns['btn_img']) )
                                    {                                
                                    	$tablestring .= "<div class='arppricetablebutton'>&nbsp;</div>";                                
                                    }
                                    else
                                    {
										if( $columns['paypal_code'] != '' ){
										$columns['paypal_code'] = do_shortcode($columns['paypal_code']);
										$paypal_btn = 1;
										} else {
											$paypal_btn = 0;
										}
										
                                        $tablestring .= "<div class='arppricetablebutton' style='text-align:center;'>
                                            <button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important; width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;'"; } $tablestring .= " onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .= "\",\"".$paypal_btn."\",this);'>"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .= "</button>";
											$tablestring .= "<div id='paypal_form' style='display:none;'>";
												$tablestring .= $columns['paypal_code'];
											$tablestring .= "</div>";
                                        $tablestring .= "</div>";
                                    }
                                
                            	$tablestring .= "</div>";
                            }                        
               $tablestring .= "</div>";
			 $tablestring .= "</div>";
             $tablestring .= "</div>";
 				//echo $tablestring;
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
			$c = $x;
			if($c == 0)
			{
				$c = $x = 1;
			}
			//$counter = 1;
			
			$new_arr = array();
			if( is_array( $col_ord_arr ) && count( $col_ord_arr ) > 0 ){
				foreach( $col_ord_arr as $key=> $value ){
					$new_value = str_replace('main_','',$value);
					$new_col_id = $new_value;
					foreach( $opts['columns'] as $j=>$columns ){
						if( $new_col_id == $j ){
							$new_arr['columns'][$new_col_id] = $columns;
						}
					}
				}
			} else {
				$new_arr = $opts;
			}
				
			foreach($new_arr['columns'] as $j=>$columns)
			{
				
				if( $columns['is_caption'] == 0 ) {
					$inlinecolumnwidth = "";
					if($columns["column_width"] != "")
						$inlinecolumnwidth= 'width:'.$columns["column_width"].'px';
					$column_highlight = $opts['columns'][$j]['column_highlight'];
						if($column_highlight && $column_highlight == 1)
							$highlighted_column = 'column_highlight ';
						else 
							$highlighted_column = '';
							
						if( $columns['column_width'] != '' or ( $global_column_width != '' and $is_responsive != 1 ) ){
							$has_custom_column_width = 'has_custom_column_width="true"';
							$has_custom_width = 'has_custom_width';
						} else {
							$has_custom_column_width = 'has_custom_column_width="false"';
							$has_custom_width = '';
						}
						
						if( $column_settings['space_between_column'] == 'yes' and $column_settings['column_space'] > 0 ){
							$has_column_space = 'has_column_space="'.$column_settings['column_space'].'"';
						} else {
							$has_column_space = 'has_column_space="false"';
						}
				
				$tablestring .= "<div id='main_".$j."' ".$has_custom_column_width." ".$has_column_space."  class='".$highlighted_column." ArpPricingTableColumnWrapper style_".$j." ".$hover_class." ".$animation_class." ".$has_custom_width." '  style='"; if($columns['is_hidden'] && $columns['is_hidden'] == 1){ $tablestring .= "display:none !important;"; } if($c == 0){ $tablestring .= "border-left:1px solid #DADADA;"; } if( $columns['column_width'] != '' && $columns['column_width'] > 0 ){ $tablestring .= $inlinecolumnwidth; } else { if( $is_responsive != 1 ){ $tablestring .= $global_column_width; } } $tablestring .= "'"; $tablestring.= ">";
				
                    $tablestring .= "<div class='arpplan "; if($columns['is_caption'] == 1){ $tablestring .= "maincaptioncolumn"; }else{ $tablestring .= "column_".$c; } if($x % 2 == 0){ $tablestring .= " arpdark-bg ArpPriceTablecolumndarkbg"; } $tablestring .= "'>";
                        if( $ref_template == 'arptemplate_15' )
							$tablestring .= "<div class='arp_template_rocket'><div></div></div>";
						
						$columns['ribbon_setting']['arp_ribbon'] = isset($columns['ribbon_setting']['arp_ribbon']) ? $columns['ribbon_setting']['arp_ribbon'] : "";	
                        $tablestring .= "<div class='planContainer ".$columns['ribbon_setting']['arp_ribbon']." '>";
                         
							if( isset($columns['arp_header_shortcode']) && $columns['arp_header_shortcode'] != '' )
								$header_cls = 'has_arp_shortcode';
							else
								$header_cls = '';
								
						if( $columns['ribbon_setting'] and $columns['ribbon_setting']['arp_ribbon'] != '' and $columns['ribbon_setting']['arp_ribbon_content'] != ''){
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
											//$tablestring .= "color:".$columns['ribbon_setting']['arp_ribbon_txtcol'].";";
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
                                	
										if( isset($columns['arp_header_shortcode']) && $columns['arp_header_shortcode'] != '' && $template_feature['header_shortcode_position'] == 'position_1' )
										{
										
											$tablestring .= "<div class='arp_header_shortcode'>";
												
													if( $template_feature['header_shortcode_type'] == 'normal' )
														$tablestring .= do_shortcode( $columns['arp_header_shortcode'] );
													else if( $template_feature['header_shortcode_type'] == 'rounded_corner' )
													{
														$tablestring .= "<div class='rounded_corder'>".do_shortcode( $columns['arp_header_shortcode'] )."</div>";
													}	
												
											$tablestring .= "</div>";
                                    
										}
									
                                        if($columns['is_caption'] == 1)
                                        {                                  
                                    		$tablestring .= "<div class='arpcaptiontitle'>".do_shortcode( stripslashes_deep( $columns['html_content'] ) )."</div>";
									    }
                                        else
                                        {
												
                                        $tablestring .= "<div class='arppricetablecolumntitle'>";
																				
										$tablestring .= "<div class='bestPlanTitle ".$title_cls."'>".do_shortcode( stripslashes_deep( $columns['package_title'] ) )."</div>";
                                        
											if( $template_feature['column_description'] == 'enable' && $template_feature['column_description_style'] == 'style_1' && $columns['column_description'] != '' )
											{
                                        		$tablestring .= "<div class='column_description ".$title_cls."'>".stripslashes_deep($columns['column_description'])."</div>";
											}
										
                                        $tablestring .= "</div>";
                                        
											if( $template_feature['column_description'] == 'enable' && $template_feature['column_description_style'] == 'style_3' && $columns['column_description'] != '' )
											{
												$tablestring .= "<div class='column_description ".$title_cls."'>".stripslashes_deep($columns['column_description'])."</div>";
											}
										
											if( $template_feature['button_position'] == 'position_2' )
											{
												$columns['paypal_code'] = isset($columns['paypal_code']) ? $columns['paypal_code'] : "";
												$columns['btn_img']	= isset($columns['btn_img']) ? $columns['btn_img'] : "";
												
												if( $columns['paypal_code'] != '' ){
												$columns['paypal_code'] = do_shortcode($columns['paypal_code']);
												$paypal_btn = 1;
												} else {
													$paypal_btn = 0;
												}
												$tablestring .= "<div class='arppricetablebutton' style='text-align:center;'>
                                                    <button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important;width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;'"; } $tablestring .= " onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .= "\",\"".$paypal_btn."\",this); '>"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .= "</button>";
													$tablestring .= "<div id='paypal_form' style='display:none;'>";
														$tablestring .= $columns['paypal_code'];
													$tablestring .= "</div>";
                                                $tablestring .= "</div>";
											}
											
											if( $template_feature['header_shortcode_position'] == 'default' )
											{
												if( $columns['arp_header_shortcode'] != '' && $template_feature['header_shortcode_type'] == 'normal')
													$tablestring .= "<div class='arp_header_shortcode'>".do_shortcode( $columns['arp_header_shortcode'] )."</div>";
												else if( $template_feature['header_shortcode_type'] == 'rounded_border' )
													$tablestring .= "<div class='rounded_corder'>".do_shortcode( $columns['arp_header_shortcode'] )."</div>";
												//$tablestring .= "<div class='arp_header_shortcode'>".do_shortcode( $columns['arp_header_shortcode'] )."</div>";
											}
									if( $template_feature['amount_style'] != 'style_3' ){		
										$tablestring .= "<div class='arppricetablecolumnprice ".$template_feature['amount_style']."'>";
												
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
															$tablestring .= "<span class=\"arp_price_value\">";
																$tablestring .= $columns['price_text'];
															$tablestring .= "</span>";
															$tablestring .= "<span class=\"arp_price_duration\">";
																$tablestring .= $columns['price_label'];
															$tablestring .= "</span>";
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
												} else if( $template_feature['amount_style'] == 'style_2' )
												{
													//$tablestring .= "<div class='arppricetablecolumnprice style_2' data-column='main_".$j."' data-template_id='".$template_id."' data-level='pricing_level_options' data-type='other_columns_buttons'>";
														$tablestring .= "<div class='arp_price_wrapper'>";
															$tablestring .= "<span class=\"arp_price_duration\">";
																$tablestring .= $columns['price_label'];
															$tablestring .= "</span>";
															$tablestring .= "<span class=\"arp_price_value\">";
																$tablestring .= $columns['price_text'];
															$tablestring .= "</span>";
														$tablestring .= "</div>";
														$tablestring .= do_shortcode( isset($columns['html_content']) ? $columns['html_content'] : "" );
													//$tablestring .= "</div>";
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
													$columns['paypal_code'] = isset($columns['paypal_code']) ? $columns['paypal_code'] : "";
													$columns['btn_img']	= isset($columns['btn_img']) ? $columns['btn_img'] : "";													
													if( $columns['paypal_code'] != '' ){
														$columns['paypal_code'] = do_shortcode($columns['paypal_code']);
														$paypal_btn = 1;
													} else {
														$paypal_btn = 0;
													}
													$tablestring .= "<div class='arppricetablebutton' style='text-align:center;'>
                                                        <button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important;width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;'"; } $tablestring .= " onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .= "\",\"".$paypal_btn."\",this); '>"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .= "</button>";
														$tablestring .= "<div id='paypal_form' style='display:none;'>";
															$tablestring .= $columns['paypal_code'];
														$tablestring .= "</div>";
                                                    $tablestring .= "</div>";
												}
										$tablestring .= "</div>";
                                    	}
                                        }
										if( $columns['arp_header_shortcode'] != '' && $template_feature['header_shortcode_position'] == 'position_2') 
										{
											$tablestring .= "<div class='arp_header_shortcode'>";
											
												if( $template_feature['header_shortcode_type'] == 'normal' )
													$tablestring .= do_shortcode( $columns['arp_header_shortcode'] );
												else if( $template_feature['header_shortcode_type'] == 'rounded_corner' )
												{
													$tablestring .= "<div class='rounded_corder'>".do_shortcode( $columns['arp_header_shortcode'] )."</div>";
												}	
											$tablestring .= "</div>";										
										}
										
                            $tablestring .= "</div>";
							
                            
                            
                         $tablestring .= "<div class='arpbody-content arppricingtablebodycontent'>";
						 if( $template_feature['button_position'] == 'position_3' ){
							$tablestring .= "<div class='column_description ".$title_cls."'>".stripslashes_deep($columns['column_description'])."</div>";
							
							$columns['btn_img']	= isset($columns['btn_img']) ? $columns['btn_img'] : "";
							
							$tablestring .= "<div class='arpcolumnfooter arp_".strtolower($columns['button_size'])."_btn' id='arpcolumnfooter' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
													$tablestring .= "<div class='arppricetablebutton' data-column='main_".$j."' style='text-align:center;'>
                                                        <button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn' id='bestPlanButton' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important;width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;'"; } $tablestring .= " onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .= "\"); '"; $tablestring .= ">"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .= "</button>";
							$tablestring .= "</div>";
							 $tablestring .= "</div>";
							 
							 
							
							 
						
										
						}
						 
						 
						 
						 
                                $tablestring .= "<ul class='arp_opt_options arppricingtablebodyoptions' id='".$x."' style='text-align:".$columns['body_text_alignment']."'>";
                                 												
                                    $r = 0;
                                    
                                    $row_order= isset($opts['columns'][$j]['row_order']) ? $opts['columns'][$j]['row_order'] : array();										
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
                                            if($x % 2 == 0)
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
										
										if( $rows['row_tooltip'] != '' ){
											global $arp_has_tooltip;
											$arp_has_tooltip = 1;
										}
										
										$fa_pattern = '/fa/i';
										
										$columns['column_title'] = isset($columns['column_title']) ? $columns['column_title'] : "";
										$columns['html_content'] = isset($columns['html_content']) ? $columns['html_content'] : "";
										
										if( preg_match( $fa_pattern, $rows['row_description'] ) > 0 or preg_match( $fa_pattern, $rows['row_tooltip'] ) > 0 or preg_match( $fa_pattern, $rows['row_label'] ) > 0 or preg_match( $fa_pattern, $columns['button_text'] ) > 0 or preg_match($fa_pattern,$columns['html_content']) > 0 or preg_match($fa_pattern,$columns['column_title']) > 0 or preg_match($fa_pattern,$columns['price_text']) > 0 or preg_match($fa_pattern,$columns['price_label']) > 0 or preg_match($fa_pattern,$columns['column_description']) > 0 or preg_match($fa_pattern,$columns['arp_header_shortcode']) > 0 or preg_match($fa_pattern,$columns['package_title']) > 0 ){
											global $arp_has_fontawesome;
											$arp_has_fontawesome = 1;
										}
										
										if( $template_feature['caption_style'] == 'style_1' and $template_feature['list_alignment'] != 'default' ){
											$tablestring .= "<li class='".$cls; if($rows['row_tooltip'] != ""){ $tablestring .= " arp_tooltip_li"; } $tablestring .= "' id='arp_row_".$ri."'>";		
                                        	$tablestring .= "<span class='caption_li'>".(!empty($rows['row_label']) ? stripslashes_deep($rows['row_label']) : '&nbsp;')."</span>";
                                                $tablestring .= "<span class='caption_detail "; if($rows['row_tooltip'] != ""){ $tablestring .= " arp_tooltip"; } $tablestring .= "' title='"; if($rows['row_tooltip'] != ""){ $tablestring .= stripslashes_deep($rows['row_tooltip']); } $tablestring .= "'>".(!empty($rows['row_description']) ? stripslashes_deep($rows['row_description']) : '&nbsp;')."</span>
											</li>";                                    
											
											
										} else if( $template_feature['caption_style'] == 'style_2' ) {
										
											$tablestring .= "<li class='".$cls; if($rows['row_tooltip'] != ""){ $tablestring .= " arp_tooltip_li"; } $tablestring .= "' id='arp_row_".$ri."'";
											
											$tablestring .= ">";
                                            $tablestring .= "<span class='caption_detail "; if($rows['row_tooltip'] != ""){ $tablestring .= " arp_tooltip"; } $tablestring .= "' title='"; if($rows['row_tooltip'] != ""){ $tablestring .= stripslashes_deep($rows['row_tooltip']); } $tablestring .= "'>".(!empty($rows['row_description']) ? stripslashes_deep($rows['row_description']) :'&nbsp;')."</span>";
											
											
											
											$tablestring .= "<span class='caption_li'>".(!empty($rows['row_label']) ? stripslashes_deep($rows['row_label']) : '&nbsp;')."</span>";
											$tablestring .= "</li>";
											
										}
										else if( $template_feature['list_alignment'] != 'default' )
										{  
										$tablestring .= "<li class='".$cls; if($rows['row_tooltip'] != ""){ $tablestring .= " arp_tooltip_li"; } $tablestring .= "' id='arp_row_".$ri."' style='text-align:".$template_feature['list_alignment']."' >";
                                            $tablestring .= "<span class='"; if($rows['row_tooltip'] != ""){ $tablestring .= " arp_tooltip"; } $tablestring .= "' title='"; if($rows['row_tooltip'] != ""){ $tablestring .= stripslashes_deep($rows['row_tooltip']); } $tablestring .= "'>".(!empty($rows['row_description']) ? stripslashes_deep($rows['row_description']) : '&nbsp;')."</span>
                                           </li>";
										}
										else
										{ 
                                    		$tablestring .= "<li class='".$cls; if($rows['row_tooltip'] != ""){ $tablestring .= " arp_tooltip_li"; } $tablestring .= "' id='arp_row_".$ri."' style='text-align:"; /*if($rows['row_des_txt_align'] == 'right'){ $tablestring .= "right";} else if($rows['row_des_txt_align'] == 'left'){ $tablestring .= "left";} else { $tablestring .= "center"; }*/ $tablestring .= "' >";
											
											
                                            $tablestring .= "<span class='"; if($rows['row_tooltip'] != ""){ $tablestring .= " arp_tooltip"; } $tablestring .= "' title='"; if($rows['row_tooltip'] != ""){ $tablestring .= stripslashes_deep($rows['row_tooltip']); } $tablestring .= "'>".(!empty($rows['row_description']) ? stripslashes_deep($rows['row_description']) : '&nbsp;')."</span>
                                           </li>";
										}
										$last_li_cls = $cls;
                                    }
									if( $template_feature['button_position'] != 'default' ){
										$tablestring .= "<li class='arp_last_list_item ".$last_li_cls."'></li>";
									}
                                $tablestring .= "</ul>";
                            $tablestring .= "</div>";
							
							
							
							if($template_feature['amount_style'] == 'style_3'){
							$tablestring .= "<div class='arppricetablecolumnprice ".$template_feature['amount_style']."' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='pricing_level_options' data-type='other_columns_buttons' >";
    													$tablestring .= "<div class='arp_price_wrapper'>";
															$tablestring .= "<span class=\"arp_price_duration\">";
																$tablestring .= $columns['price_label'];
															$tablestring .= "</span>";
															$tablestring .= "<span class=\"arp_price_value\">";
																$tablestring .= $columns['price_text'];	
															$tablestring .= "</span>";	
														$tablestring .= "</div>";
														$tablestring .= do_shortcode( $columns['html_content'] );
												 
											
								if( $template_feature['button_position'] == 'position_4' )
									{
													$tablestring .= "<div class='arpcolumnfooter arp_".strtolower($columns['button_size'])."_btn' id='arpcolumnfooter' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons'>";
													//ondblclick='get_template_options(\"".$template_id."\",\"button_options\",\"other_columns_buttons\",this,\"main_".$j."\")'
													$columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";
													$tablestring .= "<div class='arppricetablebutton' data-column='main_".$j."' style='text-align:center;'>
                                                        <button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn' id='bestPlanButton' data-column='main_".$j."' data-template_id='".$ref_template."' data-level='button_options' data-type='other_columns_buttons' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important;width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;'"; } $tablestring .= " onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .= "\"); '"; $tablestring .= ">"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .= "</button>";
														
                                                    $tablestring .= "</div>";
													  $tablestring .= "</div>";
													
													
												}
												
								$tablestring .= "</div>";	
							}

                        
                        	
                            if($columns['button_text'] == '' && $template_feature['second_btn'] == false && $columns['btn_img'] == "" )
                            {
								 $tablestring .= "<div class='arpcolumnfooter arp_".strtolower($columns['button_size'])."_btn'>";
                        		$tablestring .= "<div class='arppricetablebutton'>&nbsp;</div>";
								$tablestring .="</div>";	                  
                            }
                            else if( $template_feature['button_position'] == 'default' )
                            {
							$tablestring .= "<div class='arpcolumnfooter arp_".strtolower($columns['button_size'])."_btn'>";
							
									if( $template_feature['second_btn'] == true && $columns['button_s_text'] != '' ){ $has_s_btn = 'has_second_btn'; } else { $has_s_btn = 'no_second_btn'; }
									
                        			$tablestring .= "<div class='arppricetablebutton' style='text-align:center;'>";
										if( $columns['button_text'] != '' )
										{
											
											if( isset($columns['paypal_code']) && $columns['paypal_code'] != '' ){
											$columns['paypal_code'] = do_shortcode($columns['paypal_code']);
											$paypal_btn = 1;
											} else {
												$paypal_btn = 0;
											}
											$columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";
											$tablestring .= "<button type='button' class='bestPlanButton arp_".strtolower($columns['button_size'])."_btn ".$has_s_btn."' "; if($columns['btn_img'] != ""){ $tablestring .= "style='background:url(".$columns['btn_img'].") no-repeat !important;width:".$columns['btn_img_width']."px;height:".$columns['btn_img_height']."px;' "; }  $tablestring .= "onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .="\",\"".$paypal_btn."\",this);'>"; if($columns['btn_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_text']); } $tablestring .="</button>";
											$tablestring .= "<div id='paypal_form' style='display:none;'>";
												$tablestring .= isset($columns['paypal_code']) ? $columns['paypal_code'] : "";
											$tablestring .= "</div>";
										}
										
										if( $template_feature['second_btn'] == true && $columns['button_s_text'] != '' )
										{
											if( $columns['paypal_s_code'] != '' ){
												$paypal_s_btn = 1;
											} else {
												$paypal_s_btn = 0;
											}
											if( $columns['button_text'] != '' ){ $has_f_btn = 'has_first_btn'; } else { $has_f_btn = 'no_first_btn'; }
											$tablestring .= "<button type='button' class='bestPlanButton arp_".strtolower($columns['button_s_size'])."_btn SecondBestPlanButton ".$has_f_btn."' "; if($columns['button_s_img'] != ""){ $tablestring .= "style='background:url(".$columns['button_s_img'].") no-repeat !important;width:".$columns['btn_s_img_width']."px;height:".$columns['btn_s_img_height']."px;' "; }  $tablestring .= "onclick='arp_redirect(\"".$columns['button_url']."\", \""; if($columns['s_is_new_window'] == 1){ $tablestring .= "1"; } else { $tablestring .= "0"; } $tablestring .="\",\"".$paypal_s_btn."\",this);'>"; if($columns['button_s_img'] == ""){ $tablestring .= stripslashes_deep($columns['button_s_text']); } $tablestring .="</button>";
											$tablestring .= "<div id='paypal_form' style='display:none;'>";
												$tablestring .= $columns['paypal_s_code'];
											$tablestring .= "</div>";
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
								if( $template_feature['column_description'] == 'enable' and $template_feature['column_description_style'] == 'after_button' ){
									$tablestring .= "<div class='column_description ".$title_cls."'>".stripslashes_deep($columns['column_description'])."</div>";
								}
                            } 
                        
                    $tablestring .= "</div>";
                $tablestring .= "</div>";
            $tablestring .= "</div>";
   
			$c++;
			if($x % 5 == 0)
			{
				$c = 1;
			}
			$x++;
			}
		}

			$tablestring .= "</div>";
			
		} else {
			$tablestring .= __('Please select valid table',ARP_PT_TXTDOMAIN);
		}
	   
$tablestring .= "</div>";
$tablestring .= "</div>";
/* Navigation button for animation */ 
    $tablestring .= "<div class='arp_next_div' "; if(!$navigation) { $tablestring .= "style='display:none;'"; } $tablestring .= ">";
    	$tablestring .= "<div id='arp_next_btn_".$template_name."' class='arp_next_btn arp_nav_style_1'></div>";
    $tablestring .= "</div>";
    /* Navigation button for animation */
$tablestring .= "</div>";
$tablestring .= "</div>";


	
if( $column_animation['is_animation'] == 'yes' and ( $column_animation['pagi_nav_btn'] == 'pagination_bottom' or $column_animation['pagi_nav_btn'] == 'both' ) )
		$tablestring .= "<div class='arp_pagination arp_pagination_top arp_paging_style_1' id='arp_slider_".$id."_paginatio_top'></div>";


$tablestring = apply_filters('arp_postdisplay_pricingtable_filter', $tablestring, $table_id);

//post render action
do_action('arp_postdisplay_pt_action',$table_id);
do_action('arp_postdisplay_pt_action'.$table_id,$table_id);


$hostname = $_SERVER["HTTP_HOST"]; 
global $arprice_class;
$setact = 0;
$verifycode = get_option("arpSortOrder");
$verified = 0;
if($verifycode != "")
{
	global $arpriceplugin;
	$verified = $arprice_class->$arpriceplugin();
}
if($verified != 0)
{
	$setact = 1;
}
elseif($verifycode == "")
{
	$filename = PRICINGTABLE_VIEWS_DIR."/activated_license.php";
	if(file_exists($filename)) 
	{
		$setact = 1;
	}
}

global $arp_has_tooltip;
if( $arp_has_tooltip == 1 ){
	$tablestring .= "<div><script type='text/javascript'>";
		//$tablestring .= "setTimeout( function(){ arp_tooltip_support(); },100 );";
		$tablestring .= "
			jQuery(document).ready(function(){
				arp_tooltip_support_".$template_name."();
			});
		";
	$tablestring .= "</script></div>";
}
$inbuild = "";
if($setact == 0) { $inbuild = " (U)"; }
$tablestring .= '  
<!--Plugin Name: ARPrice	
	Plugin Version: '.get_option('arprice_version').' '.$inbuild.'
	Developed By: Repute Infosystems
	Developer URL: http://www.reputeinfosystems.com/
-->';

// changes for replace \n for remove p tag   08jan2015
$tablestring = preg_replace("~\r?~", "", $tablestring);
$tablestring = preg_replace("~\r\n?~", "", $tablestring);
$tablestring = preg_replace("/\n\n+/", "", $tablestring);		
$tablestring = preg_replace("|\n|", "", $tablestring);	
$tablestring = preg_replace("~\n~", "", $tablestring);

return $tablestring;	// return table string
	}
}
?>