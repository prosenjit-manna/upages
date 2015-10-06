/*
	Pricing Table Front Side JavaScript
*/

jQuery(document).ready(function(){
	
	if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
		jQuery(".ArpPricingTableColumnWrapper").bind('touchstart', function(){ });
	}
	
	var template_type = jQuery("#arp_template_type").val();
	//slider();
	
	var mobile_view_width = jQuery('#arp_mobile_size_width').val();
	
	if( mobile_view_width == '' )
		var device_width = 480;
	else
		var device_width = mobile_view_width;
		
	width = jQuery(window).width();
	
	var template_type = '';
	
	if( width < device_width ){
		slider(template_type,1,1);
	} else {
		slider();
	}
	
	var preview = jQuery("#is_tbl_preview").val();
	if(preview == 1){
		jQuery("span.ribbontext_1").addClass('ribbontext_preview');
		jQuery("span.ribbontext_2").addClass('ribbontext_preview');
	}
	
	
	array = new Array();
	var template = jQuery("#arp_template").val();
	jQuery('.'+template).find(".arp_allcolumnsdiv").find('.ArpPricingTableColumnWrapper').each(function(i){
		if( jQuery(this).find('.arpcolumnheader').hasClass('has_arp_shortcode'))
			array[i] = 'has_header_scode';
		else
			array[i] = 0;								   
	});
		
	default_scode_position = new Array('arptemplate_1','arptemplate_12','arptemplate_5','arptemplate_11');
	position_scode_1 = new Array('arptemplate_4');
	position_scode_2 = new Array('arptemplate_3','arptemplate_7','arptemplate_8');
	
	if( jQuery.inArray( template, default_scode_position ) > -1 ){
		if( jQuery.inArray( 'has_header_scode', array ) > -1 ){
			jQuery('.'+template).find(".arp_allcolumnsdiv").find('.ArpPricingTableColumnWrapper').each(function(i){
				jQuery(this).find('.arpcolumnheader').addClass('has_arp_shortcode');
				div = jQuery('<div class=\'arp_header_shortcode\'></div>');
				if( !jQuery(this).find('.arpcolumnheader').find('div').hasClass('arp_header_shortcode') ){
					div.insertAfter( jQuery(this).find('.arpcolumnheader').find('.arppricetablecolumntitle') );
				}
			});
		}
	} else if( jQuery.inArray( template, position_scode_1 ) > -1 ) {
		if( jQuery.inArray( 'has_header_scode', array ) > -1 ){
			jQuery('.'+template).find(".arp_allcolumnsdiv").find('.ArpPricingTableColumnWrapper').each(function(i){
				jQuery(this).find('.arpcolumnheader').addClass('has_arp_shortcode');
				div = jQuery('<div class=\'arp_header_shortcode\'></div>');
				if( !jQuery(this).find('.arpcolumnheader').find('div').hasClass('arp_header_shortcode') ){
					jQuery(this).find('.arpcolumnheader').append(div);
				}
			});
		}
	} else if( jQuery.inArray( template, position_scode_2 ) > -1 ){
		if( jQuery.inArray( 'has_header_scode', array ) > -1 ){
			jQuery('.'+template).find(".arp_allcolumnsdiv").find('.ArpPricingTableColumnWrapper').each(function(i){
				jQuery(this).find('.arpcolumnheader').addClass('has_arp_shortcode');
				div = jQuery('<div class=\'arp_header_shortcode\'></div>');
				if( !jQuery(this).find('.arpcolumnheader').find('div').hasClass('arp_header_shortcode') ){
					jQuery(this).find('.arpcolumnheader').prepend(div);
				}
			});
		}
	}
	
	if( template == 'arptemplate_8'){
		jQuery('.ArpPricingTableColumnWrapper').each(function(){
			jQuery(this).find('div.arp_header_shortcode').css('min-height','100px');
		});
	}

	arp_get_google_map_front();
	
	setTimeout(function() {
		remove_column_height();
		arp_header_title_responsive();
		arp_price_text_responsive();
		arp_price_label_responsive();
		adjust_column_height();
		arp_column_desc_responsive();
		set_best_plan_button_height();
		arp_column_wrapper_height();
		set_slider_height();
	}, 1000);
				
	/* Responsive Template Width Calculation */
	responsive_template_width_calculation();
	
	jQuery('.ArpPricingTableColumnWrapper').each(function(){
		if( jQuery(this).hasClass('column_highlight') )
		{
			jQuery(this).attr('has_column_highlighted', 'true');
		} else {
			jQuery(this).attr('has_column_highlighted', 'false');
		}
	});
	set_slider_height();
});

function responsive_template_width_calculation(){
	
	jQuery('.ArpTemplate_main').each(function(){
		
		$this = jQuery(this);
		
		var container_width = jQuery(this).parent().width();
			
		var columns = jQuery(this).find('.ArpPricingTableColumnWrapper:visible').length;
		
		var width = container_width / columns;
		
		var column_width = Math.floor( width );
		
		var is_responsive = $this.find('#arp_is_responsive').val();
						
		if( typeof( $this.find('.ArpPriceTable').attr('data-animate') ) != undefined && is_responsive == 1){
							
			jQuery($this).find('.ArpPricingTableColumnWrapper:visible').each(function(){
				var column_width_new = column_width;
				
				if( jQuery(this).css('border-left-width') != '' && jQuery(this).css('border-left-width') != '0px' ) {
					var column_left_border_width = parseInt( jQuery(this).css('border-left-width').replace('px','') );
					column_width_new = parseInt( column_width_new ) - parseInt( column_left_border_width );
				}
				
				if( jQuery(this).css('border-right-width') != '' && jQuery(this).css('border-right-width') != '0px' ) {
					var column_right_border_width = parseInt( jQuery(this).css('border-right-width').replace('px','') );
					column_width_new = parseInt( column_width_new ) - parseInt( column_right_border_width );
				}
				
				if( jQuery(this).attr('has_custom_column_width') == 'false' ){
					
					if( jQuery(this).attr('has_column_space') != 'false' ){
						column_width_new = parseInt( column_width_new ) - parseInt( jQuery(this).attr('has_column_space') );
					}
									
					var new_col_width = ( column_width_new * 100 ) / container_width; 
														
					new_col_width = Math.floor(new_col_width);
					
					new_col_width = new_col_width + '%';
					
					var is_preview = jQuery('#is_tbl_preview').val();
					
					var mobile_device_width = jQuery('#arp_mobile_size_width').val();
					
					if( mobile_device_width == '' || mobile_device_width == 0 )
						var device_width = 480
					else
						var device_width = mobile_device_width;
					
					if( is_preview == 1 ){
						if( screen.width > device_width && jQuery(document).width() > device_width ){
							jQuery(this).css( 'width',new_col_width );
						} else {
							jQuery(this).css( 'width','95%');
						}
					} else {
						if( screen.width > device_width ){
							jQuery(this).css( 'width',new_col_width );
						} else {
							jQuery(this).css( 'width','95%');
						}
					}
				}
				
			});
		}
	});
}

function arp_get_google_map_front(){
	if( jQuery('.arp_googlemap').length > 0 ){
		jQuery('.arp_googlemap').each(function(){
			
			var map_data = jQuery(this).data('map');
		
			if( typeof( map_data ) === 'string' )
				map_data = jQuery.parseJSON( map_data );
			
			var address = map_data.markers[0].address;
			var icon = map_data.markers[0].icon;
			var title = map_data.markers[0].title;
			var zoom = map_data.zoom;
			var $this = this;
			var content = map_data.markers[0].html.content;
			var popup = map_data.markers[0].html.popup;
			var maptype = map_data.maptype;
			
			if( icon != null ){
				icon = map_data.markers[0].icon.image;
			} else {
				icon = null;
			}
			
			if( zoom == null ){
				zoom = 14;
			} else {
				zoom = zoom;
			}
			
			jQuery.ajax({
				url:'https://maps.googleapis.com/maps/api/geocode/json',
				type:'GET',
				data:'address='+address,
				success:function(res){
					var lat = res.results[0].geometry.location.lat;
					var lng = res.results[0].geometry.location.lng;
					
					get_google_map_content( lat, lng, icon, $this, zoom, title,content,popup,maptype);
					
				}
			});
		});
	}
}

function get_google_map_content( lat,lng,icon,object,zoom_level,title,content,popup,maptype ){
	var LntLng = new google.maps.LatLng(lat,lng);
	var mapOption = {
		center:LntLng,
		zoom:parseInt(zoom_level),
		mapTypeId: google.maps.MapTypeId.maptype
	}
	var infoWindowContent = {
		content:content,
	}
	var map = new google.maps.Map( object, mapOption );
	var infoWindow = new google.maps.InfoWindow(infoWindowContent);
	var marker = new google.maps.Marker({
		position:LntLng,
		title:title,
		icon:icon
	});
	marker.setMap(map);
	if( popup == true ){
		infoWindow.open(map,marker);
	} else {
		google.maps.event.addListener(marker, 'click', function() {
			infoWindow.open(map,marker);
		});
	}
}
	
function arp_redirect(re_url, is_new_tab, is_paypal, object){
	if( is_paypal == 1 ){
		jQuery(object).parent().find('#paypal_form').find('form').submit();
	} else {
		if( is_new_tab == '1')
		{
			var win = window.open(re_url, '_blank');
			win.focus();
		}
		else
		{
			location.href = re_url;
		}
	}
}

/* Slider JS */
function slider(template_type,items_visible,scroll_items){
	var items = '';
	var scroll = '';
	items = items_visible;
	scroll = scroll_items;
	jQuery('.ArpPriceTable').each(function(e){
		var table_id 		= jQuery(this).attr('data-id');

		var is_animation  = jQuery(this).attr('data-animate');
					
		if( is_animation === 'true' )
		{
			var duration	= jQuery(this).attr('data-speed');
			var effect 		= jQuery(this).attr('data-effect');
			
			if( typeof(scroll) === 'undefined' )
				scroll 		= jQuery(this).attr('data-scroll');
						
			if( typeof(items) === 'undefined' )
				items 		= jQuery(this).attr('data-items');
				
			var autoplay 	= jQuery(this).attr('data-autoplay');
			var hide_cap 	= jQuery(this).attr('data-caption');
			var infinite	= jQuery(this).attr('data-infinite');
			var easing	    = jQuery(this).attr('data-easing');
			
			if( hide_cap == 1 ) {
				jQuery('.maincaptioncolumn').remove();
			}
			
			var carouselOptions = {
				circular : parseInt( autoplay ) ? true : false,
				items: parseInt(items),
				responsive:true,
				width:'100%',
				prev: {
					items: parseInt(scroll),
					button: jQuery('#arp_prev_btn_'+table_id),
					fx: effect,
					easing: easing,
					duration: parseInt(duration)
				},
				next: {
					items: parseInt(scroll),
					button: jQuery('#arp_next_btn_'+table_id),
					fx: effect,
					easing: easing,
					duration: parseInt(duration)
				},
				auto: {
					items: parseInt(scroll),
					play: (parseInt(autoplay) ? true : false),
					fx: effect,
					easing: easing,
					duration: parseInt(duration)
				},
			};
			
			if( jQuery(this).hasClass('arp_slider_pagination') )
			{
				carouselOptions.pagination = {
					items: parseInt(scroll),
					container:'.arp_pagination',
					fx:effect,
					easing: easing,
					duration:parseInt(duration)
				}
				
			}
			
			jQuery('.arp_price_table_'+table_id+' .arp_allcolumnsdiv').carouFredSel(carouselOptions);
						
			arp_setslider_width( table_id, parseInt(items), scroll, jQuery(this).find('#ArpPricingTableColumns').width() );		//resize columns
		}
	});
}
function arp_setslider_width( table_id, items, iscroll, wrapper_width){
	if( table_id === undefined )
		return;
	

	
	var width = jQuery('.arp_price_table_'+table_id+' .arp_allcolumnsdiv .ArpPricingTableColumnWrapper').first().outerWidth();
	
	var html = '';
	var item_width = (wrapper_width / items);

	if( jQuery('.arp_price_table_'+table_id+' .arp_allcolumnsdiv .ArpPricingTableColumnWrapper').first().css('margin-right') != '' && jQuery('.arp_price_table_'+table_id+' .arp_allcolumnsdiv .ArpPricingTableColumnWrapper').first().css('margin-right') != '0px'){
		var right_space = jQuery('.arp_price_table_'+table_id+' .arp_allcolumnsdiv .ArpPricingTableColumnWrapper').first().css('margin-right');
		var right_sp = right_space.replace('px','');
		item_width = item_width - right_sp;
	}
	
	var actual_width = Math.floor( item_width );
	
	html += "<style type='text/css' id='arp_column_slider_width'>";
		html += '.arptemplate_'+table_id+' .ArpPricingTableColumnWrapper.no_animation.maincaptioncolumn:not(.has_custom_width), .arptemplate_'+table_id+' .ArpPricingTableColumnWrapper.no_animation:not(.has_custom_width), .arptemplate_'+table_id+' .ArpPricingTableColumnWrapper.maincaptioncolumn:not(.has_custom_width), .arptemplate_'+table_id+' .ArpPricingTableColumnWrapper:not(.has_custom_width){';
			html += 'width:'+actual_width+'px !important;';
			html += 'min-width:'+actual_width+'px !important;';
		html += '}';
	html += "</style>" ;
	
	jQuery('.arp_price_table_'+table_id+' .caroufredsel_wrapper').find('style#arp_column_slider_width').first().remove();
	
	jQuery('.arp_price_table_'+table_id+' .caroufredsel_wrapper').prepend( html );
}


jQuery(window).load(function(){
	adjust_column_height();
});

jQuery(window).resize(function(e){
	
	
	
	if( typeof( window.orientation ) !== undefined && window.orientation < 1 ){
		return false;
	}
	
	/*setTimeout( function() {
						remove_column_height();	
						adjust_column_height();
							arp_header_title_responsive();	
	arp_price_text_responsive();
	arp_price_label_responsive();
	arp_column_desc_responsive();
	arp_column_wrapper_height();
					}
	, 500 );*/
	
	setTimeout(function() {
		remove_column_height();
		arp_header_title_responsive();
		arp_price_text_responsive();
		arp_price_label_responsive();
		adjust_column_height();
		arp_column_desc_responsive();
		set_best_plan_button_height();
		arp_column_wrapper_height();
		set_slider_height();
	}, 500);
	
	var mobile_view_width = jQuery('#arp_mobile_size_width').val();
	if( mobile_view_width == '' )
		var device_width = 480;
	else
		var device_width = mobile_view_width;
		
	width = jQuery(window).width();
	var template_type = '';
	
	if( width < device_width ){
		slider(template_type,1,1);
	} else {
		slider();
	}
	set_slider_height();	
	responsive_template_width_calculation();
});

/* JS for Responsive Hight of Column */
function remove_column_height(){	
	var template_type = jQuery("#arp_template_type").val();
	
	jQuery(".ArpTemplate_main").each(function(){
		cols = jQuery(this).find("ul.arppricingtablebodyoptions").length;
		var $this = jQuery(this);
		jQuery($this).find('li').css('height','');
		jQuery($this).find('li').css('min-height','');
		jQuery($this).find('li').css('line-height','');
		jQuery($this).find('li').css('padding','');
	});
}

function adjust_column_height(){
	var template_type = jQuery("#arp_template_type").val();
	var template = jQuery("#arp_template").val();
	jQuery(".ArpTemplate_main").each(function(){
		cols = jQuery(this).find(".arp_allcolumnsdiv").find(".ArpPricingTableColumnWrapper").length;
		$this = jQuery(this);
		for(x = 1; x <= cols; x++)
		{
			$this.find("#main_column_"+x).find('ul.arp_opt_options li').each(function(y){
				if( $this.find(".arpplan.maincaptioncolumn").is(':visible')){
					var base_height = $this.find(".arpplan.maincaptioncolumn li#arp_row_"+y).height();
				}
				if(base_height == null || base_height < 0){
					var base_height = $this.find("ul.arp_opt_options li#arp_row_"+y).height();
				}
				if(base_height > 0)
				{
					height = $this.find("#main_column_"+x).find('ul.arp_opt_options li#arp_row_'+y).height();
					if( base_height > height )
					{
						jQuery($this).find("li#arp_row_"+y).height((base_height+10));
					}
					if ( height > base_height ){
						jQuery($this).find("li#arp_row_"+y).height((height+10));
					}
					if( height == 0 ){
						jQuery($this).find('li#arp_row_'+y).height(base_height);
					}
				}
				if(base_height == 0){
					if(x != 0){
						height = $this.find("#main_column_"+x).find('ul.arp_opt_options li#arp_row_'+y).height();	
						if(height > base_height){
							row_id = "arp_row_"+y;
							$this.find("li#"+row_id).height(height);
						}
						if(base_height > height){
							row_id = "arp_row_"+y;
							$this.find("li#"+row_id).height(base_height);
						}
					}
				}
			});
		}
	});
	arp_header_title_responsive();
}


function adjust_column_title(){
	var base_height_arr = new Array();
	var col_title_height_arr = new Array();
	var sort_keys = new Array();
	var base_height_json = '';
	jQuery('.ArpPricingTableColumnWrapper').each(function(x){
		var col_id = jQuery(this).attr('id');
		
		var base_height = jQuery(this).find('.arpcolumnheader').height();
		base_height_arr[x] = base_height;
		sort_keys[x] = base_height;
		
		if( jQuery(this).hasClass('maincaptioncolumn') )
			var col_title_height = jQuery(this).find('.arpcaptiontitle').height();
		else
			var col_title_height = jQuery(this).find('.arppricetablecolumntitle').height();
		
		col_title_height_arr[x] = col_title_height;
	});
	
	sort_keys.sort(function(a,b){ return b-a; });
	
	heighest_height = sort_keys[0];
	
	var h_column_id = '';
	
	for( var key in base_height_arr ){
		if( heighest_height == base_height_arr[key] )
			h_column_id = 'main_column_'+key;
	}
	
	var base_height = jQuery('#'+h_column_id).find('.arpcolumnheader').height();
	if( jQuery('.ArpPricingTableColumnWrapper#'+h_column_id).hasClass('maincaptioncolumn') )
		var base_title_height = jQuery('#'+h_column_id).find('.arpcaptiontitle').height();
	else
		var base_title_height = jQuery('#'+h_column_id).find('.bestPlanTitle').height();
		
	jQuery('.ArpPricingTableColumnWrapper').each(function(){
		if( h_column_id != jQuery(this).attr('id') ){
			jQuery(this).find('.arpcolumnheader').height(base_height);
			if( jQuery(this).hasClass('maincaptioncolumn') )
				jQuery(this).find('.arpcaptiontitle').height( base_title_height );
			else
				jQuery(this).find('.arppricetablecolumntitle').height( base_title_height );
		}
	});
}
function arp_header_title_responsive()
{
	jQuery('.arp_template_main_container').each(function(){
		var template = jQuery(this).find('#arp_ref_template').val();
 		if(template && template!="" )
		{
			if(template == 'arptemplate_1')
			{
				jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
					jQuery(this).find('.arpcolumnheader').css('height','auto');
					jQuery(this).find('.arpcolumnheader').find('.bestPlanTitle,.arpcaptiontitle ').css('height','auto');
				});
			}
			else
			{
				jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
					jQuery(this).find('.arpcolumnheader').find('.bestPlanTitle ').css('height','auto');
				});
			}
			
			
			var max_height=0;
			
			if(template == 'arptemplate_1')
			{
				jQuery('.ArpPricingTableColumnWrapper',this).each(function(x){
					if(max_height<jQuery(this).find('.arpcolumnheader,.arpcaptiontitle ').height())
					{
						max_height = jQuery(this).find('.arpcolumnheader,.arpcaptiontitle ').height();
					}
				});
			}
			else
			{
				jQuery('.ArpPricingTableColumnWrapper',this).each(function(x){
					if(max_height<jQuery(this).find('.arpcolumnheader').find('.bestPlanTitle').height())
					{
						max_height = jQuery(this).find('.arpcolumnheader').find('.bestPlanTitle').height();
					}
				});
			}
			
			if(template == 'arptemplate_1')
			{
				jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
					jQuery(this).find('.arpcolumnheader').height(max_height);
					jQuery(this).find('.arpcolumnheader').find('.arpcaptiontitle').height(max_height-40);
					jQuery(this).find('.arpcolumnheader').find('.bestPlanTitle').height(max_height-59);
					
				});
			}
			else if(template == 'arptemplate_9' || template == 'arptemplate_6')
			{
				jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
					jQuery(this).find('.arpcolumnheader').find('.bestPlanTitle').height(max_height);
				});
				jQuery('.arpcaptiontitle',this).css('margin-top',jQuery('.ArpPricingTableColumnWrapper:not(.ArpPricingTableColumnWrapper.maincaptioncolumn)',this).first().find('.arppricetablecolumntitle').outerHeight()+'px');
				
			}
			else if(template == 'arptemplate_12')
			{
				jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
					jQuery(this).find('.arpcolumnheader').find('.bestPlanTitle').height(max_height);
				});
				jQuery('.arpcaptiontitle',this).css('margin-top',jQuery('.ArpPricingTableColumnWrapper:not(.ArpPricingTableColumnWrapper.maincaptioncolumn)',this).first().find('.arppricetablecolumntitle').outerHeight()-1+'px');
				
			}
			else
			{
				jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
					jQuery(this).find('.arpcolumnheader').find('.bestPlanTitle').height(max_height);
					
				});
			}
			
		}
	});
}
function arp_price_text_responsive()
{
	jQuery('.arp_template_main_container').each(function(){
		var template = jQuery(this).find('#arp_ref_template').val();
		if(template && template!="" && template != 'arptemplate_1' && template != 'arptemplate_4' && template != 'arptemplate_12' && template != 'arptemplate_5'  && template != 'arptemplate_7'  && template != 'arptemplate_11' && template != 'arptemplate_6'  && template != 'arptemplate_9')
		{
			jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
				jQuery(this).find('.arp_price_value').css('height','auto');
			});
			
				
			var max_height=0;
			jQuery('.ArpPricingTableColumnWrapper',this).each(function(x){
				new_height=jQuery(this).find('.arp_price_value').height();
				if(new_height && max_height<new_height)
				{
					max_height = jQuery(this).find('.arp_price_value').height();
				}
			});
			
			jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
				jQuery(this).find('.arp_price_value').height(max_height);
			});
		}
	});
}
function arp_price_label_responsive()
{
	jQuery('.arp_template_main_container').each(function(){
		var template = jQuery(this).find('#arp_ref_template').val();
		if(template && template!="" && template != 'arptemplate_1' && template != 'arptemplate_4' && template != 'arptemplate_12' && template != 'arptemplate_5' && template != 'arptemplate_7'  && template != 'arptemplate_11' && template != 'arptemplate_6'  && template != 'arptemplate_9')
		{
			jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
				jQuery(this).find('.arp_price_duration').css('height','auto');
			});
						
			var max_height=0;
			jQuery('.ArpPricingTableColumnWrapper',this).each(function(x){
				new_height=jQuery(this).find('.arp_price_duration').height();
				if(new_height && max_height<new_height)
				{
					max_height = jQuery(this).find('.arp_price_duration').height();
				}
			});
			
			jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
				jQuery(this).find('.arp_price_duration').height(max_height);
			});
		}
	});
}

if( jQuery.isFunction( jQuery().on ) )
{
	jQuery(document).on('mouseenter', '.ArpPricingTableColumnWrapper', function(event){
		var parent_table	= jQuery(this).parents('.ArpPriceTable').first();
		if( jQuery(this).hasClass('maincaptioncolumn') == false )
			jQuery(parent_table).find('.ArpPricingTableColumnWrapper').removeClass('column_highlight');
	});
	
	jQuery(document).on('mouseleave', '.ArpPricingTableColumnWrapper', function(event){
		jQuery('.ArpPricingTableColumnWrapper').each(function(){
			var has_column_highlighted = jQuery(this).attr('has_column_highlighted');
			if( has_column_highlighted == 'true' )
			{
				jQuery(this).addClass('column_highlight');
			} 
		});
	});
} else {
	jQuery('.ArpPricingTableColumnWrapper').live('mouseenter', function(event){
		var parent_table	= jQuery(this).parents('.ArpPriceTable').first();
		if( jQuery(this).hasClass('maincaptioncolumn') == false )
		{
			jQuery(parent_table).find('.ArpPricingTableColumnWrapper').removeClass('column_highlight');																					
		}
	});	
	jQuery('.ArpPricingTableColumnWrapper').live('mouseleave', function(event){
		jQuery('.ArpPricingTableColumnWrapper').each(function(){
			var has_column_highlighted = jQuery(this).attr('has_column_highlighted');
			if( has_column_highlighted == 'true' )
			{
				jQuery(this).addClass('column_highlight');
			} 
		});
	});	
}

function set_best_plan_button_height()
{
	jQuery('.arp_template_main_container').each(function(){
		var template = jQuery(this).find('#arp_ref_template').val();
		if(template=='arptemplate_8'  || template=='arptemplate_13')
		{
			jQuery('.arppricetablebutton',this).each(function(){
				jQuery(this).height('auto');
			});	
			var max_height=0;
			jQuery('.arppricetablebutton',this).each(function(){
				if(max_height<jQuery(this).height())
				{
					max_height=jQuery(this).height();
				}
			});	
			jQuery('.arppricetablebutton',this).each(function(){
				jQuery(this).height(max_height);
			});	
			
		}	
	});
}
function arp_column_desc_responsive()
{
	jQuery('.arp_template_main_container').each(function(){
														 
		var template = jQuery('#arp_ref_template',this).val();
		if(template && template!="" && template != 'arptemplate_1' && template != 'arptemplate_4' && template != 'arptemplate_12' && template != 'arptemplate_5' && template != 'arptemplate_8' && template != 'arptemplate_6' && template != 'arptemplate_2' && template != 'arptemplate_9' && template != 'arptemplate_15' && template != 'arptemplate_14' )
		{
			jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
				jQuery(this).find('.column_description').css('height','auto');
			});
						
			var max_height=0;
			jQuery('.ArpPricingTableColumnWrapper',this).each(function(x){
				new_height=jQuery(this).find('.column_description').height();
				if(new_height && max_height<new_height)
				{
					max_height = jQuery(this).find('.column_description').height();
				}
			});
			
			jQuery('.ArpPricingTableColumnWrapper',this).each(function(){
				jQuery(this).find('.column_description').height(max_height);
			});
		}
	});
}

function arp_column_wrapper_height(){
	jQuery('.arp_template_main_container').each(function(){
		$this = jQuery(this);
		var is_animated = jQuery(this).find('#arp_is_animated').val();
		var col_effect  = jQuery(this).find('#arp_column_effect_type').val();
		if( is_animated == 0 && ( col_effect == 0 || col_effect == 2 ) ){
			$this.find('.ArpPricingTableColumnWrapper').each(function(){
				var arpplan_height = jQuery(this).find('.arpplan').height();				
				if( jQuery(this).hasClass('column_highlight') || ( jQuery(this).is(":hover") && !jQuery(this).hasClass('column_highlight') ) ){
					var arp_wrapper_height = arpplan_height - 20;
					if( $this.find('#arp_ref_template').val() == 'arptemplate_6')
						jQuery(this).css('margin-bottom','15px');
					else
						jQuery(this).css('margin-bottom','20px');
				} else {
					var arp_wrapper_height = arpplan_height + 40;
				}
				jQuery(this).height( arp_wrapper_height );
			});
		}
	});
}
function set_slider_height()
{
 	jQuery('.arp_template_main_container').each(function(){
		var template = jQuery(this).find('#arp_ref_template').val();
		var slider_height=0;												 
		jQuery('.ArpPricingTableColumnWrapper:not(.maincaptioncolumn)',this).each(function(){
			if(jQuery(this).is(':visible') && jQuery(this).height() && jQuery(this).height()>0 && slider_height==0)
			{
				if(parseInt(jQuery(this).find('.arpplan').outerHeight())>parseInt(jQuery(this).height()))
				{																					 
					slider_height=parseInt(jQuery(this).find('.arpplan').height())+44;
				}
				else
				{
					slider_height=parseInt(jQuery(this).height())+24;
				}
			}
		});
		if(template == 'arptemplate_8')
		{
			slider_height=slider_height+2;
		}
		else if(template == 'arptemplate_10')
		{
			slider_height=slider_height+16;
		}
		else if(template == 'arptemplate_13' || template == 'arptemplate_14' || template == 'arptemplate_15')
		{
			slider_height=slider_height+14;
		}
		else if(template == 'arptemplate_16')
		{
			slider_height=slider_height+36;
		}
		if(slider_height>0)
		{
			jQuery('.caroufredsel_wrapper',this).height(slider_height);	
		}
		
	});
}
