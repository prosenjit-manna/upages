<?php
/*
* Add-on Name: Pricing Tables for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists("Ultimate_Pricing_Table")){
	class Ultimate_Pricing_Table{
		function __construct(){
			add_action("admin_init",array($this,"ultimate_pricing_init"));
			add_shortcode("ultimate_pricing",array($this,"ultimate_pricing_shortcode"));
		}
		function ultimate_pricing_init(){
			if(function_exists("vc_map")){
				vc_map(
				array(
				   "name" => __("Price Box"),
				   "base" => "ultimate_pricing",
				   "class" => "vc_ultimate_pricing",
				   "icon" => "vc_ultimate_pricing",
				   "category" => __("Ultimate VC Addons",'smile'),
				   "description" => __("Create nice looking pricing tables.","smile"),
				   "params" => array(
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Select Design Style", "smile"),
							"param_name" => "design_style",
							"value" => array(
								"Design 01" => "design01",
								"Design 02" => "design02",
								"Design 03" => "design03",
								"Design 04" => "design04",
								"Design 05" => "design05",
								"Design 06" => "design06",
							),
							"description" => __("Select Pricing table design you would like to use", "smile")
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Select Color Scheme", "smile"),
							"param_name" => "color_scheme",
							"value" => array(
								"Black" => "black",
								"Red" => "red",
								"Blue" => "blue",
								"Yellow" => "yellow",
								"Green" => "green",
								"Gray" => "gray",
								"Design Your Own" => "custom",
							),
							"description" => __("Which color scheme would like to use?", "smile")
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Main background Color", "smile"),
							"param_name" => "color_bg_main",
							"value" => "",
							"description" => __("Select normal background color.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Main text Color", "smile"),
							"param_name" => "color_txt_main",
							"value" => "",
							"description" => __("Select normal background color.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Highlight background Color", "smile"),
							"param_name" => "color_bg_highlight",
							"value" => "",
							"description" => __("Select highlight background color.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Highlight text Color", "smile"),
							"param_name" => "color_txt_highlight",
							"value" => "",
							"description" => __("Select highlight background color.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Package Name / Title", "smile"),
							"param_name" => "package_heading",
							"admin_label" => true,
							"value" => "",
							"description" => __("Enter the package name or table heading", "smile"),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Sub Heading", "smile"),
							"param_name" => "package_sub_heading",
							"value" => "",
							"description" => __("Enter short description for this package", "smile"),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Package Price", "smile"),
							"param_name" => "package_price",
							"value" => "",
							"description" => __("Enter the price for this package. e.g. $157", "smile"),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Price Unit", "smile"),
							"param_name" => "package_unit",
							"value" => "",
							"description" => __("Enter the price unit for this package. e.g. per month", "smile"),
						),
						array(
							"type" => "textarea_html",
							"class" => "",
							"heading" => __("Features", "smile"),
							"param_name" => "content",
							"value" => "",
							"description" => __("Create the features list using un-ordered list elements.", "smile"),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Button Text", "smile"),
							"param_name" => "package_btn_text",
							"value" => "",
							"description" => __("Enter call to action button text", "smile"),
						),
						array(
							"type" => "vc_link",
							"class" => "",
							"heading" => __("Button Link", "smile"),
							"param_name" => "package_link",
							"value" => "",
							"description" => __("Select / enter the link for call to action button", "smile"),
						),
						array(
							"type" => "checkbox",
							"class" => "",
							"heading" => __("", "smile"),
							"param_name" => "package_featured",
							"value" => array("Make this pricing box as featured" => "enable"),
						),
						array(
								"type" => "textfield",
								"heading" => __("Extra class name", "js_composer"),
								"param_name" => "el_class",
								"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
						),
						/* typoraphy - package */
						array(
							"type" => "ult_param_heading",
							"text" => __("Package Name/Title Settings"),
							"param_name" => "package_typograpy",
							"group" => "Typography",
							"class" => "ult-param-heading",
							'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
						),
						array(
							"type" => "ultimate_google_fonts",
							"heading" => __("Font Family", "smile"),
							"param_name" => "package_name_font_family",
							"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
							"group" => "Typography"
						),
						array(
							"type" => "ultimate_google_fonts_style",
							"heading" 		=>	__("Font Style", "smile"),
							"param_name"	=>	"package_name_font_style",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "font-size",
							"heading" => __("Font Size", "smile"),
							"param_name" => "package_name_font_size",
							"min" => 10,
							"suffix" => "px",
							"group" => "Typography"
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Font Color", "smile"),
							"param_name" => "package_name_font_color",
							"value" => "",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Line Height", "smile"),
							"param_name" => "package_name_line_height",
							"value" => "",
							"suffix" => "px",
							"group" => "Typography"
						),
						/* typoraphy - sub heading */
						array(
							"type" => "ult_param_heading",
							"text" => __("Sub-Heading Settings"),
							"param_name" => "subheading_typograpy",
							"group" => "Typography",
							"class" => "ult-param-heading",
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							"type" => "ultimate_google_fonts",
							"heading" => __("Font Family", "smile"),
							"param_name" => "subheading_font_family",
							"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
							"group" => "Typography"
						),
						array(
							"type" => "ultimate_google_fonts_style",
							"heading" 		=>	__("Font Style", "smile"),
							"param_name"	=>	"subheading_font_style",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "font-size",
							"heading" => __("Font Size", "smile"),
							"param_name" => "subheading_font_size",
							"min" => 10,
							"suffix" => "px",
							"group" => "Typography"
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Font Color", "smile"),
							"param_name" => "subheading_font_color",
							"value" => "",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Line Height", "smile"),
							"param_name" => "subheading_line_height",
							"value" => "",
							"suffix" => "px",
							"group" => "Typography"
						),
						/* typoraphy - price */
						array(
							"type" => "ult_param_heading",
							"text" => __("Price Settings"),
							"param_name" => "price_typograpy",
							"group" => "Typography",
							"class" => "ult-param-heading",
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							"type" => "ultimate_google_fonts",
							"heading" => __("Font Family", "smile"),
							"param_name" => "price_font_family",
							"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
							"group" => "Typography"
						),
						array(
							"type" => "ultimate_google_fonts_style",
							"heading" 		=>	__("Font Style", "smile"),
							"param_name"	=>	"price_font_style",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "font-size",
							"heading" => __("Font Size", "smile"),
							"param_name" => "price_font_size",
							"min" => 10,
							"suffix" => "px",
							"group" => "Typography"
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Font Color", "smile"),
							"param_name" => "price_font_color",
							"value" => "",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Line Height", "smile"),
							"param_name" => "price_line_height",
							"value" => "",
							"suffix" => "px",
							"group" => "Typography"
						),
						/* typoraphy - price unit*/
						array(
							"type" => "ult_param_heading",
							"text" => __("Price Unit Settings"),
							"param_name" => "price_unit_typograpy",
							"group" => "Typography",
							"class" => "ult-param-heading",
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							"type" => "ultimate_google_fonts",
							"heading" => __("Font Family", "smile"),
							"param_name" => "price_unit_font_family",
							"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
							"group" => "Typography"
						),
						array(
							"type" => "ultimate_google_fonts_style",
							"heading" 		=>	__("Font Style", "smile"),
							"param_name"	=>	"price_unit_font_style",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "font-size",
							"heading" => __("Font Size", "smile"),
							"param_name" => "price_unit_font_size",
							"min" => 10,
							"suffix" => "px",
							"group" => "Typography"
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Font Color", "smile"),
							"param_name" => "price_unit_font_color",
							"value" => "",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Line Height", "smile"),
							"param_name" => "price_unit_line_height",
							"value" => "",
							"suffix" => "px",
							"group" => "Typography"
						),
						/* typoraphy - feature*/
						array(
							"type" => "ult_param_heading",
							"text" => __("Features Settings"),
							"param_name" => "features_typograpy",
							"group" => "Typography",
							"class" => "ult-param-heading",
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							"type" => "ultimate_google_fonts",
							"heading" => __("Font Family", "smile"),
							"param_name" => "features_font_family",
							"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
							"group" => "Typography"
						),
						array(
							"type" => "ultimate_google_fonts_style",
							"heading" 		=>	__("Font Style", "smile"),
							"param_name"	=>	"features_font_style",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "font-size",
							"heading" => __("Font Size", "smile"),
							"param_name" => "features_font_size",
							"min" => 10,
							"suffix" => "px",
							"group" => "Typography"
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Font Color", "smile"),
							"param_name" => "features_font_color",
							"value" => "",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Line Height", "smile"),
							"param_name" => "features_line_height",
							"value" => "",
							"suffix" => "px",
							"group" => "Typography"
						),
						/* typoraphy - button */
						array(
							"type" => "ult_param_heading",
							"text" => __("Button Settings"),
							"param_name" => "button_typograpy",
							"group" => "Typography",
							"class" => "ult-param-heading",
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							"type" => "ultimate_google_fonts",
							"heading" => __("Font Family", "smile"),
							"param_name" => "button_font_family",
							"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
							"group" => "Typography"
						),
						array(
							"type" => "ultimate_google_fonts_style",
							"heading" 		=>	__("Font Style", "smile"),
							"param_name"	=>	"button_font_style",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "font-size",
							"heading" => __("Font Size", "smile"),
							"param_name" => "button_font_size",
							"min" => 10,
							"suffix" => "px",
							"group" => "Typography"
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Font Color", "smile"),
							"param_name" => "button_font_color",
							"value" => "",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Line Height", "smile"),
							"param_name" => "button_line_height",
							"value" => "",
							"suffix" => "px",
							"group" => "Typography"
						),
					)// params
				));// vc_map
			}
		}
		function ultimate_pricing_shortcode($atts,$content = null){
			$design_style = '';
			extract(shortcode_atts(array(
				"design_style" => "",
			),$atts));
			$output = '';
			require_once(__ULTIMATE_ROOT__.'/templates/pricing/pricing-'.$design_style.'.php');
			$design_func = 'generate_'.$design_style;
			$design_cls = 'Pricing_'.ucfirst($design_style);
			$class = new $design_cls;
			$output .= $class->generate_design($atts,$content);
			return $output;
		}
	} // class Ultimate_Pricing_Table
	new Ultimate_Pricing_Table;
}