<?php
/*
* Add-on Name: Ultimate Google Maps
* Add-on URI: https://www.brainstormforce.com
*/
if(!class_exists("Ultimate_Google_Maps")){
	class Ultimate_Google_Maps{
		function __construct(){
			add_action("admin_init",array($this,"google_maps_init"));
			add_shortcode("ultimate_google_map",array($this,"display_ultimate_map"));
			add_action('wp_enqueue_scripts', array($this, 'ultimate_google_map_script'));
			
			add_action('save_post', array($this,'ultimate_shortcode_id_array') ); //is post has our map shortcode
		}
		function ultimate_google_map_script()
		{
			wp_register_script("googleapis","https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false",array(),ULTIMATE_VERSION,false);
			if(is_front_page())
			{
				$page_id = get_option('page_on_front');
			}
			else
			{
				$page_id = get_the_ID();
			}
			$option_id_array = get_option('ultimate_google_map');
			if($option_id_array) {
				if(!empty($option_id_array))
				{
					if (in_array($page_id, $option_id_array)) {
						wp_enqueue_script('googleapis');
					}
				}
			}
		}
		function google_maps_init(){
			if ( function_exists('vc_map'))
			{
				vc_map( array(
					"name" => __("Google Map", "smile"),
					"base" => "ultimate_google_map",
					"class" => "vc_google_map",
					"controls" => "full",
					"show_settings_on_create" => true,
					"icon" => "vc_google_map",
					"description" => __("Display Google Maps to indicate your location.", "smile"),
					"category" => __("Ultimate VC Addons", "smile"),
					"params" => array(
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Width (in %)", "smile"),
							"param_name" => "width",
							"admin_label" => true,
							"value" => "100%",
							"group" => "General Settings"
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Height (in px)", "smile"),
							"param_name" => "height",
							"admin_label" => true,
							"value" => "300px",
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Map type", "smile"),
							"param_name" => "map_type",
							"admin_label" => true,
							"value" => array(__("Roadmap", "smile") => "ROADMAP", __("Satellite", "smile") => "SATELLITE", __("Hybrid", "smile") => "HYBRID", __("Terrain", "smile") => "TERRAIN"),
							"group" => "General Settings"
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Latitude", "smile"),
							"param_name" => "lat",
							"admin_label" => true,
							"value" => "18.591212",
							"description" => __('<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">Here is a tool</a> where you can find Latitude & Longitude of your location', "smile"),
							"group" => "General Settings"
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Longitude", "smile"),
							"param_name" => "lng",
							"admin_label" => true,
							"value" => "73.741261",
							"description" => __('<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">Here is a tool</a> where you can find Latitude & Longitude of your location', "smile"),
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"heading" => __("Map Zoom", "smile"),
							"param_name" => "zoom",
							"value" => array(
								__("18 - Default", "smile") => 12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20
							),
							"group" => "General Settings"
						),
						array(
							"type" => "checkbox",
							"heading" => __("", "smile"),
							"param_name" => "scrollwheel",
							"value" => array(
								__("Disable map zoom on mouse wheel scroll", "smile") => "disable",
							),
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Street view control", "smile"),
							"param_name" => "streetviewcontrol",
							"value" => array(__("Disable", "smile") => "false", __("Enable", "smile") => "true"),
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Map type control", "smile"),
							"param_name" => "maptypecontrol",
							"value" => array(__("Disable", "smile") => "false", __("Enable", "smile") => "true"),
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Map pan control", "smile"),
							"param_name" => "pancontrol",
							"value" => array(__("Disable", "smile") => "false", __("Enable", "smile") => "true"),
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Zoom control", "smile"),
							"param_name" => "zoomcontrol",
							"value" => array(__("Disable", "smile") => "false", __("Enable", "smile") => "true"),
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Zoom control size", "smile"),
							"param_name" => "zoomcontrolsize",
							"value" => array(__("Small", "smile") => "SMALL", __("Large", "smile") => "LARGE"),
							"dependency" => Array("element" => "zoomControl","value" => array("true")),
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Marker/Point icon", "smile"),
							"param_name" => "marker_icon",
							"value" => array(__("Use Google Default", "smile") => "default", __("Use Plugin's Default", "smile") => "default_self", __("Upload Custom", "smile") => "custom"),
							"group" => "General Settings"
						),
						array(
							"type" => "attach_image",
							"class" => "",
							"heading" => __("Upload Image Icon:", "smile"),
							"param_name" => "icon_img",
							"admin_label" => true,
							"value" => "",
							"description" => __("Upload the custom image icon.", "smile"),
							"dependency" => Array("element" => "marker_icon","value" => array("custom")),
							"group" => "General Settings"
						),
						array(
							"type" => "textarea_html",
							"class" => "",
							"heading" => __("Info Window Text", "smile"),
							"param_name" => "content",
							"value" => "",
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Top margin", "smile"),
							"param_name" => "top_margin",
							"value" => array(
								__("Page (small)", "smile") => "page_margin_top", 
								__("Section (large)", "smile") => "page_margin_top_section",  
								__("None", "smile") => "none"
							),
							"group" => "General Settings"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Map Width Override", "upb_google_map"),
							"param_name" => "map_override",
							"value" =>array(
								"Default Width"=>"0",
								"Apply 1st parent element's width"=>"1",
								"Apply 2nd parent element's width"=>"2",
								"Apply 3rd parent element's width"=>"3",
								"Apply 4th parent element's width"=>"4",
								"Apply 5th parent element's width"=>"5",
								"Apply 6th parent element's width"=>"6",
								"Apply 7th parent element's width"=>"7",
								"Apply 8th parent element's width"=>"8",
								"Apply 9th parent element's width"=>"9",
								"Full Width "=>"full",
								"Maximum Full Width"=>"ex-full",
							),
							"description" => __("By default, the map will be given to the Visual Composer row. However, in some cases depending on your theme's CSS - it may not fit well to the container you are wishing it would. In that case you will have to select the appropriate value here that gets you desired output..", "upb_google_map"),
							"group" => "General Settings"
						),
						array(
							"type" => "textarea_raw_html",
							"class" => "",
							"heading" => "Google Styled Map JSON",
							"param_name" => "map_style",
							"value" => "",
							"description" => __("<a target='_blank' href='http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html'>Click here</a> to get the style JSON code for styling your map."),
							"group" => "Styling",
						),
						array(
								"type" => "textfield",
								"heading" => __("Extra class name", "js_composer"),
								"param_name" => "el_class",
								"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
								"group" => "General Settings"
						),
						array(
							"type" => "heading",
							"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/f57sh' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
							"param_name" => "notification",
							'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
							"group" => "General Settings"
						),
					)
				));
			}
		}
		function display_ultimate_map($atts,$content = null){			
			$width = $height = $map_type = $lat = $lng = $zoom = $streetviewcontrol = $maptypecontrol = $top_margin = $pancontrol = $zoomcontrol = $zoomcontrolsize = $marker_icon = $icon_img = $map_override = $output = $map_style = $scrollwheel = $el_class = '';
			extract(shortcode_atts(array(
				//"id" => "map",
				"width" => "100%",
				"height" => "300px",
				"map_type" => "ROADMAP",
				"lat" => "18.591212",
				"lng" => "73.741261",
				"zoom" => "14",
				"scrollwheel" => "",
				"streetviewcontrol" => "",
				"maptypecontrol" => "",
				"pancontrol" => "",
				"zoomcontrol" => "",
				"zoomcontrolsize" => "",
				"marker_icon" => "",
				"icon_img" => "",
				"top_margin" => "page_margin_top",
				"map_override" => "0",
				"map_style" => "",
				"el_class" => "",
				"map_vc_template" => ""
			), $atts));
			$marker_lat = $lat;
			$marker_lng = $lng;
			if($marker_icon == "default_self"){
				$icon_url = plugins_url("../assets/img/icon-marker-pink.png",__FILE__);
			} elseif($marker_icon == "default"){
				$icon_url = "";
			} else {
				$ico_img = wp_get_attachment_image_src( $icon_img, 'large');
				$icon_url = $ico_img[0];
			}
			$id = "map_".uniqid();
			$wrap_id = "wrap_".$id;
			$map_type = strtoupper($map_type);
			$width = (substr($width, -1)!="%" && substr($width, -2)!="px" ? $width . "px" : $width);
			$map_height = (substr($height, -1)!="%" && substr($height, -2)!="px" ? $height . "px" : $height);
			
			$margin_css = '';
			if($top_margin != 'none')
			{
				$margin_css = $top_margin;
			}
			
			if($map_vc_template == 'map_vc_template_value')
				$el_class .= 'uvc-boxed-layout';
			
			$output .= "<div id='".$wrap_id."' class='ultimate-map-wrapper ".$el_class."' style='".($map_height!="" ? "height:" . $map_height . ";" : "")."'><div id='" . $id . "' data-map_override='".$map_override."' class='ultimate_google_map wpb_content_element ".$margin_css."'" . ($width!="" || $map_height!="" ? " style='" . ($width!="" ? "width:" . $width . ";" : "") . ($map_height!="" ? "height:" . $map_height . ";" : "") . "'" : "") . "></div></div>";
			if($scrollwheel == "disable"){
				$scrollwheel = 'false';
			} else {
				$scrollwheel = 'true';
			}
			$output .= "<script type='text/javascript'>
			(function($) {
  			'use strict';
			var map_$id = null;
			var coordinate_$id;
			try
			{			
				var map_$id = null;
				var coordinate_$id;
				coordinate_$id=new google.maps.LatLng($lat, $lng);
				var mapOptions= 
				{
					zoom: $zoom,
					center: coordinate_$id,
					scaleControl: true,
					streetViewControl: $streetviewcontrol,
					mapTypeControl: $maptypecontrol,
					panControl: $pancontrol,
					zoomControl: $zoomcontrol,
					scrollwheel: $scrollwheel,
					zoomControlOptions: {
					  style: google.maps.ZoomControlStyle.$zoomcontrolsize
					},";
					if($map_style == ""){
						$output .= "mapTypeId: google.maps.MapTypeId.$map_type,";
					} else {
						$output .= " mapTypeControlOptions: {
					  		mapTypeIds: [google.maps.MapTypeId.$map_type, 'map_style']
						}";
					}
				$output .= "};";
				if($map_style !== ""){
				$output .= 'var styles = '.rawurldecode(base64_decode(strip_tags($map_style))).';
						var styledMap = new google.maps.StyledMapType(styles,
					    	{name: "Styled Map"});
						';
				}
				$output .= "var map_$id = new google.maps.Map(document.getElementById('$id'),mapOptions);";
				if($map_style !== ""){
				$output .= "map_$id.mapTypes.set('map_style', styledMap);
 							 map_$id.setMapTypeId('map_style');";
				}
				if($marker_lat!="" && $marker_lng!="")
				{
				$output .= "
					var marker_$id = new google.maps.Marker({
						position: new google.maps.LatLng($marker_lat, $marker_lng),
						animation:  google.maps.Animation.DROP,
						map: map_$id,
						icon: '".$icon_url."'
					});
					google.maps.event.addListener(marker_$id, 'click', toggleBounce);";
					if($content !== ""){
						$output .= "
							var infowindow = new google.maps.InfoWindow();
							infowindow.setContent('<div class=\"map_info_text\" style=\'color:#000;\'>".trim(preg_replace('/\s+/', ' ', do_shortcode($content)))."</div>');
							infowindow.open(map_$id,marker_$id);";
					}
				}
				$output .= "
			}
			catch(e){};
			jQuery(document).ready(function($){
				resize_uvc_map('".$id."','".$wrap_id."');
				google.maps.event.trigger(map_$id, 'resize');
				$(window).resize(function(){
					resize_uvc_map('".$id."','".$wrap_id."');
					google.maps.event.trigger(map_$id, 'resize');
					if(map_$id!=null)
						map_$id.setCenter(coordinate_$id);
				});
			});
			jQuery(window).load(function($){
				google.maps.event.trigger(map_$id, 'resize');
				if(map_$id!=null)
					map_$id.setCenter(coordinate_$id);
			});
			function toggleBounce() {
			  if (marker_$id.getAnimation() != null) {
				marker_$id.setAnimation(null);
			  } else {
				marker_$id.setAnimation(google.maps.Animation.BOUNCE);
			  }
			}
			})(jQuery);
			</script>";
			return $output;
		}
		
		function ultimate_shortcode_id_array($post_id)
		{
			if ( wp_is_post_revision( $post_id )) {
				return;
			}
			$post_type = get_post_type( $post_id );
			$option_name = 'ultimate_google_map';
			$id_array = $this->ultimate_find_shortcode_occurences($option_name, $post_type);
			$autoload = 'yes';
			if (false == add_option($option_name, $id_array, '', 'yes')) update_option($option_name, $id_array);
		}
		function ultimate_find_shortcode_occurences($shortcode, $post_type)
		{
			$found_ids = array();
			$args = array(
				'post_type'   => $post_type,
				'post_status' => 'publish',
				'posts_per_page' => -1,
			);
			$query_result = new WP_Query($args);
			foreach ($query_result->posts as $post) {
				if (false !== strpos($post->post_content, $shortcode)) {
					$found_ids[] = $post->ID;
				}
			}
			return $found_ids;
		}
	}
	new Ultimate_Google_Maps;
}