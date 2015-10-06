<?php @session_start(); @error_reporting(E_ERROR | E_WARNING | E_PARSE);
/*
Plugin Name: ARPrice 
Description: Ultimate Wordpress Pricing Table Plugin
Version: 1.0.1
Plugin URI: http://arprice.arformsplugin.com
Author: Repute InfoSystems
Author URI: http://arprice.arformsplugin.com
*/

define( 'PRICINGTABLE_DIR', WP_PLUGIN_DIR.'/arprice' );
define( 'PRICINGTABLE_URL', WP_PLUGIN_URL.'/arprice' );
define( 'PRICINGTABLE_CORE_DIR', PRICINGTABLE_DIR.'/core' );
define( 'PRICINGTABLE_CLASSES_DIR', PRICINGTABLE_DIR.'/core/classes' );
define( 'PRICINGTABLE_CLASSES_URL', PRICINGTABLE_URL.'/core/classes' );
define( 'PRICINGTABLE_IMAGES_URL', PRICINGTABLE_URL.'/images' );
define( 'PRICINGTABLE_INC_DIR', PRICINGTABLE_DIR.'/inc' );
define( 'PRICINGTABLE_VIEWS_DIR', PRICINGTABLE_DIR.'/core/views' );
define( 'PRICINGTABLE_MODEL_DIR', PRICINGTABLE_DIR.'/core/models' );
define( 'ARP_PT_TXTDOMAIN', 'ARPrice');
define( 'FS_METHOD','direct');


if(is_ssl())
    define('ARPURL', str_replace('http://', 'https://', WP_PLUGIN_URL.'/arprice'));
else
    define('ARPURL', WP_PLUGIN_URL.'/arprice');


$wpupload_dir 	= wp_upload_dir();
$upload_dir = $wpupload_dir['basedir'].'/arprice';
$upload_url = $wpupload_dir['baseurl'].'/arprice';
wp_mkdir_p($upload_dir);

$css_upload_dir = $upload_dir.'/css';
wp_mkdir_p($css_upload_dir);

$template_images_upload_dir = $upload_dir.'/template_images';
wp_mkdir_p($template_images_upload_dir);

$arp_import_dir = $upload_dir.'/import';
wp_mkdir_p($arp_import_dir);

define('PRICINGTABLE_UPLOAD_DIR', $upload_dir);

define('PRICINGTABLE_UPLOAD_URL', $upload_url);

global $arpriceplugin;

global $arp_pricingtable;
$arp_pricingtable=new ARP_PricingTable();

/* Defining Pricing Table Version */
global $arprice_version;
$arprice_version='1.0.1';

/* Defining Rolls for Pricing table Plugin*/
global $allrole;
$allrole=array("editor","author","contributor","subscriber");

global $pricingtableajaxurl;
$pricingtableajaxurl = admin_url('admin-ajax.php');

if(file_exists(PRICINGTABLE_CLASSES_DIR.'/class.arprice.php'))
	require_once(PRICINGTABLE_CLASSES_DIR.'/class.arprice.php' );
	
if( file_exists( PRICINGTABLE_CLASSES_DIR.'/class.arprice_form.php' ) )
	require_once( PRICINGTABLE_CLASSES_DIR.'/class.arprice_form.php' );
	
if( file_exists( PRICINGTABLE_CLASSES_DIR.'/class.arprice_analytics.php' ) )
	require_once( PRICINGTABLE_CLASSES_DIR.'/class.arprice_analytics.php' );

if( file_exists( PRICINGTABLE_CLASSES_DIR.'/class.arprice_analytics_chart.php' ) )
	require_once( ( PRICINGTABLE_CLASSES_DIR.'/class.arprice_analytics_chart.php' ) );
	
if( file_exists( PRICINGTABLE_CLASSES_DIR.'/class.arprice_import_export.php' ) )
	require_once( ( PRICINGTABLE_CLASSES_DIR.'/class.arprice_import_export.php' ) );
	
if( file_exists( PRICINGTABLE_CLASSES_DIR.'/class.arp_fonts.php' ) )
	require_once( ( PRICINGTABLE_CLASSES_DIR.'/class.arp_fonts.php' ) );
	





			

global $arprice_class;
$arprice_class = new arprice();

global $arprice_form;
$arprice_form = new arprice_form();

global $arprice_analytics;
$arprice_analytics = new arprice_analytics;

global $arprice_analytics_chart;
$arprice_analytics_chart = new arprice_analytics_chart();

global $arprice_import_export;
$arprice_import_export = new arprice_import_export();

global $arprice_fonts;
$arprice_fonts = new arprice_fonts();



global $arp_mainoptionsarr;
global $arp_coloptionsarr;
global $arp_tempbuttonsarr;
global $arp_templateorderarr;

global $arp_is_animation,$arp_has_tooltip,$arp_has_fontawesome;
$arp_is_animation = 0;
$arp_has_tooltip = 0;
$arp_has_fontawesome = 0;

if(class_exists('WP_Widget')){
    require_once(PRICINGTABLE_DIR . '/core/widgets/arprice_widget.php');
    add_action('widgets_init', create_function('', 'return register_widget("arprice_widget");'));
}


if( file_exists( PRICINGTABLE_CORE_DIR.'/vc/class_vc_extend.php' ) ){
	require_once( ( PRICINGTABLE_CORE_DIR.'/vc/class_vc_extend.php' ) );
	global $arprice_vdextend;
	$arprice_vdextend= new ARPrice_VCExtendArp();	
}



class ARP_PricingTable
{
		function ARP_PricingTable()
		{
				register_activation_hook(__FILE__, array( 'ARP_PricingTable', 'install' ) );
				
				register_uninstall_hook(__FILE__, array( 'ARP_PricingTable', 'uninstall' ) );
				
				add_action( 'admin_menu', array( &$this, 'pricingtable_menu' ), 27 );
								
				add_action( 'wp_ajax_editplan',array( &$this,'editplan' ));
				
				add_action( 'wp_ajax_editpackage',array( &$this,'editpackage' ));
				
				add_action( 'admin_enqueue_scripts', array( &$this, 'set_css' ),10);
				
				add_action( 'admin_enqueue_scripts', array( &$this, 'set_js' ),10);
				
				// Front end css and js
				add_action( 'wp_head', array( &$this, 'set_front_css' ),1);
				
				add_action( 'wp_head', array( &$this, 'set_front_js' ),1);
				
				
				add_action( 'init', array( &$this, 'arp_pricing_table_main_settings' ));
				
				add_action( 'plugins_loaded', array( &$this, 'arp_pricing_table_load_textdomain' ) );
				
				add_action('wp_head', array(&$this, 'arp_enqueue_template_css'), 1, 0);
				
				add_action('enqueue_preview_style', array(&$this,'arp_enqueue_preview_css'),1,4);
								
				add_action('admin_init', array(&$this, 'arp_db_check'));
				
				add_filter('admin_footer_text', array(&$this, 'replace_footer_admin'));
				
				add_filter( 'update_footer', array(&$this, 'replace_footer_version'), '1234');
				
				add_action( 'admin_head',  array($this, 'arp_hide_update_notice_to_all_admin_users'), 10000 );
				
				add_action('wp_footer', array(&$this, 'footer_js'), 1, 0);
				
				add_filter('arp_append_googlemap_js', array($this,'append_googlemap_js'),1,1 );
		}
		
		function replace_footer_admin ()   
		{  
			echo '<span id="footer-thankyou"></span>';  
		
		}  
		
		function replace_footer_version() 
		{
			return ' ';
		}


		
		/* Loading plugin text domain */
		function arp_pricing_table_load_textdomain()
		{
			load_plugin_textdomain( ARP_PT_TXTDOMAIN,false,dirname( plugin_basename( __FILE__ ) ) .'/languages/' );
		}
		
		function arp_pricing_table_main_settings()
		{	
			global $arp_mainoptionsarr,$arp_pricingtable;
			$arp_mainoptionsarr = $arp_pricingtable->arp_mainoptions();
			
			global $arp_coloptionsarr;
			$arp_coloptionsarr = $arp_pricingtable->arp_columnoptions();
			
			global $arp_tempbuttonsarr;
			$arp_tempbuttonsarr = $arp_pricingtable->arp_tempbuttonsoptions();
			
			global $arp_templateorderarr;
			$arp_templateorderarr  = $arp_pricingtable->arp_template_order();
			
		}
		
		/* Setting General Options for Pricing table */
		function arp_mainoptions()
		{
			$arpoptionsarr = apply_filters('arp_pricing_table_available_main_settings', array(

            'general_options' => array(
								'template_options' => array(
														'templates' => array( 'arptemplate_1', 'arptemplate_4','arptemplate_12','arptemplate_3','arptemplate_5','arptemplate_7','arptemplate_8','arptemplate_11','arptemplate_10','arptemplate_6','arptemplate_2','arptemplate_9','arptemplate_13','arptemplate_15','arptemplate_14','arptemplate_16' ),
														
														'skins' => array( 'arptemplate_1' => array('green','yellow','darkorange','darkred','red','violet','pink','blue','darkblue','lightgreen','darkestblue','cyan','black','multicolor'), 'arptemplate_4'=>array('darkgreen','darkred','green','blue','red','purple','darkbrown','brown','orange','skyblue'), 'arptemplate_12'=>array('blue','cyan','orange','green','red','skyblue','maroon','purple','darkgray','brightorange','multicolor'), 'arptemplate_3'=>array('black','green','orange','red','teal','yellow','blue','darkgreen','maroon','purple'), 'arptemplate_5'=>array('red','yellow','blue','green','violet','cyan','pink','limegreen','orange','darkblue','multicolor'),'arptemplate_7'=>array('blue','black','cyan','lightblue','red','yellow','olive','darkpurple','darkred','pink','brown'),'arptemplate_8'=>array('purple','skyblue','red','green','blue','orange','darkcyan','yellow','pink','teal','multicolor'),'arptemplate_11'=>array('yellow','limegreen','red','blue','pink','cyan','lightpink','violet','gray','green'),'arptemplate_10'=>array('red','teal','orange','blue','green','lightteal','pink','lightgreen','darkorange','purple','darkblue','gray','multicolor'),'arptemplate_6'=>array('green','blue','red','cyan','limegreen','darkblue','pink','darkcyan','violet','black'),'arptemplate_2'=>array('red','blue','orange','green','yellow','violet','cyan','darkblue','pink','khakhi','multicolor'),'arptemplate_9'=>array('darkyellow','limegreen','darkviolet','darkred','lightorange','orange','cyan','magenta','yellow','red','multicolor'), 'arptemplate_13'=>array('darkblue','cyan','green','red','blue','brown','darkcyan','darkmagenta'),'arptemplate_15'=>array('yellow','red','green','cyan','blue','pink','purple','orange','darkyellow','limegreen'),'arptemplate_14'=>array('orange','limegreen','blue','violet','lightorange','cyan','red','yellow','gray','darkblue'),'arptemplate_16'=>array('orange','darkgreen','darkred','magenta','blue','darkblue','darkcyan','red','darklimegreen','gray') ),
														
														'skin_color_code' => array('arptemplate_1'=>array('6dae2e','fbb400','e75c01','c32929','e52937','713887','EB005C','29A1D3','2F3687','1BA341','2F4251','009E7B','5C5C5C','Multicolor'),'arptemplate_4'=>array('1BA341','DC143B','81C500','2F4C86','FF2E1D','532B71','BA2014','D86009','FFB700','00AEFF'),'arptemplate_12'=>array('143B86','059B90','E38B05', '23A359','C10F0F','2284C1','8A0135','7B1EC7','474F62','D03509','Multicolor'),'arptemplate_3'=>array('39434D','24B968','E87C3C','E84C3D','6DBEBF','EBBF44','316493','7FB45C','9A272A','6F4786'),'arptemplate_5'=>array('E52937','FBB400','20AEFF','199800','734EAB','00D8CD','FF1D77','91D100','FE7D22','2F3687','Multicolor'),'arptemplate_7'=>array('3473DC','3E3E3C','1EAE8B','1BACE1','F33C3E','FFA800','8FB021','5B48A2','79302A','ED1374','B11D00'),'arptemplate_8'=>array('AB6ED7','44B7E4','F15859','7FB948','595EB7','FF6E3D','54CAB0','FFC74B','EC3E9A','25D0D7','Multicolor'),'arptemplate_11'=>array('EFA738','43B34D','FF3241','09B1F8','E3328C','11B0B6','F15F74','8F4AFF','949494','78C335'),'arptemplate_10'=>array('E92526','00A392','FFAD00','50B8F5','01A358','1FC4C8','E83473','66AD33','FF622B','8250A9','3E38A4','89888D','Multicolor'),'arptemplate_6'=>array('87BD41','29A1D3','E84C3D','1FC4C8','2ECB72','5165A2','C31F5B','009E7B','703784','6D7383'),'arptemplate_2'=>array('EB6154','55B4EC','EE7E34','90D558','EBBF20','9955CC','1FC4C8','476EBB','E43E7E','BAAD8B','Multicolor'),'arptemplate_9'=>array('AFBA5A','00c140','7003AE','AF1D04','F2B10F','FE7D22','03B88B','B037C0','CBB963','AC113D','Multicolor'), 'arptemplate_13'=>array('01325b','03735D','168737','C61C1C','00A0EA','883D13','005760','602B63'),'arptemplate_15'=>array('EAA700','EC155B','18B949','09D1B5','10A4FA','EC3F8F','755EC6','FA5655','BE8E44','8CA91D'),'arptemplate_14'=>array('F15A23','2DCC70','3598DB','9661D7','F49C14','1BBC9B','E52937','9CC31A','757575','384C81'),'arptemplate_16'=>array('FE7C22','6DAE2E','B41E1F','A859B5','29A1D3','2F3687','009E7B','E52937','3D735B','6D7C7F')),
														
														'template_type' => array('arptemplate_1'=>'normal','arptemplate_4'=>'advanced','arptemplate_12'=>'advanced','arptemplate_3'=>'advanced','arptemplate_5'=>'advanced','arptemplate_7'=>'advanced','arptemplate_8'=>'advanced','arptemplate_11'=>'advanced','arptemplate_10'=>'advanced','arptemplate_6'=>'advanced','arptemplate_2'=>'advanced','arptemplate_9'=>'advanced','arptemplate_13'=>'advanced','arptemplate_15'=>'advanced','arptemplate_14'=>'advanced','arptemplate_16'=>'advanced'),
														
														'features' => array(
															'arptemplate_1' => array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'additional_shortcode'=>false,'is_animated'=>0),
															
															'arptemplate_2'=> array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style'=>'default','caption_title'=>'default','header_shortcode_type'=>'rounded_border','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'style_2','second_btn'=>false,'is_animated'=>0),
															
															'arptemplate_3' => array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'position_4','caption_style'=>'style_1','amount_style'=>'style_3','list_alignment'=>'right','ribbon_type'=>'default','column_description_style'=>'style_3','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'position_1','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'additional_shortcode'=>false,'is_animated'=>0),
															
															'arptemplate_4' => array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default', 'caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'position_2','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'additional_shortcode'=>false,'is_animated'=>0),
															
															'arptemplate_5' => array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'none','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style'=>'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'additional_shortcode'=>true,'is_animated'=>0),
															
															'arptemplate_6'=> array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'style_1','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'style_1','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>0),
															
															'arptemplate_7' => array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'position_1','caption_style'=>'none','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style'=>'style_3','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'position_1','tooltip_position'=>'top-left','tooltip_style'=>'style_1','second_btn'=>false,'additional_shortcode'=>true,'is_animated'=>0),
															
															'arptemplate_8' => array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'position_2','caption_style'=>'style_1','amount_style'=>'style_2','list_alignment'=>'center','ribbon_type'=>'default','column_description_style'=>'default','caption_title'=>'default','header_shortcode_type'=>'rounded_corner','header_shortcode_position'=>'position_1','tooltip_position'=>'top','tooltip_style'=>'style_2','second_btn'=>false,'additional_shortcode'=>true,'is_animated'=>0),
															
															'arptemplate_9'=> array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style'=>'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>0),
															
															'arptemplate_10'=> array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'position_3','caption_style'=>'style_2','amount_style'=>'default','list_alignment'=>'left','ribbon_type'=>'default','column_description_style' => 'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'additional_shortcode'=>false,'is_animated'=>0),
															
															'arptemplate_11' => array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'position_1','caption_style'=>'none','amount_style'=>'style_1','list_alignment'=>'default','ribbon_type'=>'default','column_description_style'=>'style_4','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'additional_shortcode'=>false,'is_animated'=>0),
															
															'arptemplate_12' => array('column_description'=>'enable','custom_ribbon'=>'enable','button_position'=>'position_1','caption_style'=>'default','amount_style'=>'style_1','list_alignment'=>'default','ribbon_type'=>'custom_style_1','column_description_style' => 'style_2','caption_title'=>'style_1','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top-left','tooltip_style'=>'default','second_btn'=>false,'additional_shortcode'=>false,'is_animated'=>0),
															
															'arptemplate_13'=> array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'style_2','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'after_button','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>1),
															
															'arptemplate_14'=> array('column_description'=>'disable','custom_ribbon'=>'enable','button_position'=>'position_1','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'custom_style_2','column_description_style' => 'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>1),
															
															'arptemplate_15'=> array('column_description'=>'disable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'default','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>1),
															
															'arptemplate_16'=> array('column_description'=>'enable','custom_ribbon'=>'disable','button_position'=>'default','caption_style'=>'default','amount_style'=>'default','list_alignment'=>'default','ribbon_type'=>'default','column_description_style' => 'style_1','caption_title'=>'default','header_shortcode_type'=>'normal','header_shortcode_position'=>'default','tooltip_position'=>'top','tooltip_style'=>'default','second_btn'=>false,'is_animated'=>1),
															
													  ),
													  
													  'arp_ribbons' => array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3','arp_ribbon_4','arp_ribbon_5'),
													  
													  'arp_template_ribbons'=>array(
													  		'arptemplate_1'	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3','arp_ribbon_4'),
															'arptemplate_2' 	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3','arp_ribbon_4','arp_ribbon_5'),
															'arptemplate_3' 	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3','arp_ribbon_4','arp_ribbon_5'),
															'arptemplate_4'	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3','arp_ribbon_4','arp_ribbon_5'),
															
															'arptemplate_5' 	=> array('arp_ribbon_2','arp_ribbon_4'),
															'arptemplate_6' 	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3','arp_ribbon_4'),
															'arptemplate_7'	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3'),
															'arptemplate_8' 	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3','arp_ribbon_4','arp_ribbon_5'),
															
															'arptemplate_9' 	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3'),
															'arptemplate_10' 	=> array('arp_ribbon_2','arp_ribbon_4'),
															'arptemplate_11' 	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3','arp_ribbon_4'),
															'arptemplate_12' 	=> array('arp_ribbon_2','arp_ribbon_4'),
															
															'arptemplate_13' 	=> array('arp_ribbon_2','arp_ribbon_4'),
															'arptemplate_14' 	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3','arp_ribbon_4','arp_ribbon_5'),
															'arptemplate_15' 	=> array('arp_ribbon_2','arp_ribbon_4'),
															'arptemplate_16' 	=> array('arp_ribbon_1','arp_ribbon_2','arp_ribbon_3','arp_ribbon_4','arp_ribbon_5')
													  ),
													  'arp_tablet_view_width' => array(
													  		'arptemplate_1'	=> '19.5',
															'arptemplate_2' 	=> '23',
															'arptemplate_3' 	=> '23',
															'arptemplate_4'	=> '19.5',
															
															'arptemplate_5' 	=> '23.5',
															'arptemplate_6' 	=> '19',
															'arptemplate_7'	=> '23',
															'arptemplate_8' 	=> '23',
															
															'arptemplate_9' 	=> '19',
															'arptemplate_10' 	=> '23',
															'arptemplate_11' 	=> '23',
															'arptemplate_12' 	=> '32',
															
															'arptemplate_13' 	=> '23',
															'arptemplate_14' 	=> '23',
															'arptemplate_15' 	=> '23',
															'arptemplate_16' 	=> '23'
													  )
								),
								
								'arp_basic_colors' => array('#ff7525','#ffcf33','#e3e500','#00d2d7','#4fe3fe','#ff67b4','#c96098','#ff1515','#ffcea6','#ffc22f','#dbd423','#0bc124','#00e430','#00a9ff','#a1bed6','#006be1','#00573f','#04d2ab','#ff5c77','#6951ff','#ac3f07','#b5fe01','#666666','#ffe217','#5d9cec','#bbea8a','#496b90','#9943d8','#d6a153','#8a0000','#0385a0','#45487d','#8d5d17','#f2f2f2','#3e3a39','#90d73d'),
								
								'arp_basic_colors_gradient' => array('#e75500','#c99a00','#8aa301','#00a5a9','#46aec1','#ce0f70','#7b164c','#c80202','#e68e51','#f48a00','#876705','#006400','#00951f','#0182c4','#5f7c97','#003a7a','#003f32','#16a086','#a0132a','#2105cc','#5e1d0b','#699001','#3c3c3c','#c09505','#3a72b9','#699f2f','#1e2a36','#531084','#8f6229','#590101','#02414e','#151845','#633b00','#c0c0c0','#0c0b0b','#145502'),
													 
								'fontoption' => array(
												'header_fonts' => array('font_family' => 'Arial', 'font_size' => '32', 'font_color' => '#ffffff', 'font_style' => 'normal'), 
												'price_fonts' => array('font_family' => 'Arial', 'font_size' => '16', 'font_color' => '#ffffff', 'font_style' => 'normal'),
												'price_text_fonts' => array('font_family' => 'Arial', 'font_size' => '16', 'font_color' => '#ffffff', 'font_style' => 'normal'),
												'content_fonts' => array('font_family' => 'Arial', 'font_size' => '12', 'font_color' => '#364762', 'font_style' => 'bold'), 
												'button_fonts' => array('font_family' => 'Arial', 'font_size' => '14', 'font_color' => '#ffffff', 'font_style' => 'bold')
												), 
								'column_animation' => array(
												'is_enable' => 0, 
												'visible_column_count' => 2, 
												'columns_to_scroll' => 2,
												'is_navigation' => 1, 
												'autoplay' => 1, 
												'sliding_effect' => array('slide','fade','crossfade','directscroll', 'cover', 'uncover'), 
												'sliding_transition_speed' => 750,
												'navigation_style' => array('arp_nav_style_1','arp_nav_style_2'),
												'pagination' => 1,
												'pagination_style' => array('arp_paging_style_1','arp_paging_style_2'),
												'pagination_position' => array('Top','Bottom','Both'),
												'easing_effect' => array('swing','linear','cubic','elastic', 'quadratic'),
												'infinite'	=> 1,
												'pagi_nav_btns' => array('navigation'=>'Navigation','pagination_top'=>'Pagination Top','pagination_bottom'=>'Pagination Bottom','both'=>'Both'),
												'def_pagin_nav' => 'both'
												/*'hide_caption' => 1,*/
												), 
								'is_spacebetweencolumns' => 'no', 
								'spacebetweencolumns' => '0px', 
								'tooltipsetting' => array(
													'width' => '',
													'background_color' => '#000000', 
													'text_color' => '#FFFFFF',
													'animation'	 => array('grow','fade','swing','slide','fall'),
													'position' => array('top','bottom','left','right'),
													'style' => array('normal','alert','glass'/*,'drop'*/),
													), 
								'is_responsive' => 1, 
								'hide_caption_column'=>0,
								'highlightcolumnonhover' => array('Hover Effect','Shadow Effect','None'),
								'button_settings' => array(
														'button_shadow_color' => '#FFFFFF',
														'button_radius'		  => 0
													),
								'column_opacity' => array(1,0.90,0.80,0.70,0.60,0.50,0.40,0.30,0.20,0.10)					
													
			)
			) );
			return $arpoptionsarr;
		}
		
		/* Setting Default Options */
		function arp_columnoptions()
		{
			$arptempbutoptionsarr = apply_filters('arp_pricing_table_available_column_settings', array(	
			
			'column_options' => array('width' => 'auto', 'alignment' =>array( 'left', 'center', 'right' ),'column_highlight'=>0, 'show_column' => 1, 'ribbon_icon' => array(), 'ribbon_position' => array('left','right') ),
			
			'header_options' => array(
						'column_title' => '', 
						'price' => '', 
						'html_content' => '', 
						'html_shortcode_options' => array(
									'image' => array('image'	=> __('Image', ARP_PT_TXTDOMAIN)),
									'video' => array(
													'youtube'	=> __('Youtube video', ARP_PT_TXTDOMAIN), 
													'vimeo'		=> __('Vimeo Video', ARP_PT_TXTDOMAIN), 
													'screenr'	=> __('Screenr Video', ARP_PT_TXTDOMAIN), 
													'video'		=> __('html5 Video', ARP_PT_TXTDOMAIN), 
													'dailymotion' =>__('Dailymotion Video', ARP_PT_TXTDOMAIN),
													'metacafe' =>__('Metacafe Video', ARP_PT_TXTDOMAIN),	
									),
									'audio' => array(
													'audio'		=> __('html5 Audio', ARP_PT_TXTDOMAIN),	
													'soundcloud' =>__('Soundcloud Audio', ARP_PT_TXTDOMAIN),
													'mixcloud' =>__('Mixcloud Audio', ARP_PT_TXTDOMAIN),
													'beatport' =>__('Beatport Audio', ARP_PT_TXTDOMAIN), 
									),
									'other' => array(
													'googlemap'	=> __('Google Map', ARP_PT_TXTDOMAIN),
													'embed' =>__('Embed Block', ARP_PT_TXTDOMAIN),
									),
									
													), 
						'image_shortcode_options' => array(
													'url'		=> __('Image URL', ARP_PT_TXTDOMAIN),
													'height' 	=> __('Height', ARP_PT_TXTDOMAIN),
													'width' 	=> __('Width', ARP_PT_TXTDOMAIN),
													), 
						'youtube_shortcode_options' => array(
													'id' 		=> __('Video id', ARP_PT_TXTDOMAIN),
													'height' 	=> __('Height', ARP_PT_TXTDOMAIN),
													'autoplay' 	=> __('Autoplay', ARP_PT_TXTDOMAIN),
													),
						'vimeo_shortcode_options' => array(
													'id' 		=> __('Video id', ARP_PT_TXTDOMAIN),
													'height' 	=> __('Height', ARP_PT_TXTDOMAIN),
													'autoplay' 	=> __('Autoplay', ARP_PT_TXTDOMAIN),
													),
						'screenr_shortcode_options' => array(
													'id' 		=> __('Video id', ARP_PT_TXTDOMAIN),
													'height' 	=> __('Height', ARP_PT_TXTDOMAIN),
													),
						'video_shortcode_options' => array(
													'mp4' 		=> __('MP4 source', ARP_PT_TXTDOMAIN),
													'webm' 		=> __('Webm source', ARP_PT_TXTDOMAIN), 
													'ogg' 		=> __('Ogg source', ARP_PT_TXTDOMAIN), 
													'poster'	=> __('Poster image source', ARP_PT_TXTDOMAIN),
													'autoplay'	=> __('Autoplay', ARP_PT_TXTDOMAIN), 
													'loop' 		=> __('Loop', ARP_PT_TXTDOMAIN),
													),
						'audio_shortcode_options' => array(
													'autoplay'	=> __('Autoplay', ARP_PT_TXTDOMAIN), 
													'loop' 		=> __('Loop', ARP_PT_TXTDOMAIN),
													'mp3' 		=> __('MP3 source', ARP_PT_TXTDOMAIN),
													'ogg' 		=> __('Ogg source', ARP_PT_TXTDOMAIN), 
													'wav'		=> __('Wav source', ARP_PT_TXTDOMAIN), 
													),

						'googlemap_shortcode_options' => array(
													'address' 	=> __('Address', ARP_PT_TXTDOMAIN),
													'height' 	=> __('Height', ARP_PT_TXTDOMAIN),
													'zoom_level'=> __('Zoom level', ARP_PT_TXTDOMAIN),
													'marker_image' 		=> __('Marker image source', ARP_PT_TXTDOMAIN),
													'mapinfo_title' 	=> __('Marker title', ARP_PT_TXTDOMAIN),
													'mapinfo_content' 	=> __('Map info window content', ARP_PT_TXTDOMAIN),
													'mapinfo_show_default' => __('Info window by default?', ARP_PT_TXTDOMAIN),
													), 
						'dailymotion_shortcode_options' => array(
													'id' 		=> __('Video id', ARP_PT_TXTDOMAIN),
													'height' 	=> __('Height', ARP_PT_TXTDOMAIN),
													'autoplay' 	=> __('Autoplay', ARP_PT_TXTDOMAIN),			
													),
						'metacafe_shortcode_options' => array(
													'id' 		=> __('Video id', ARP_PT_TXTDOMAIN),
													'height' 	=> __('Height', ARP_PT_TXTDOMAIN),
													'autoplay' 	=> __('Autoplay', ARP_PT_TXTDOMAIN),			
													),	
													
						'soundcloud_shortcode_options' => array(
													'id' 		=> __('Track id', ARP_PT_TXTDOMAIN),
													'height' 	=> __('Height', ARP_PT_TXTDOMAIN),
													'autoplay' 	=> __('Autoplay', ARP_PT_TXTDOMAIN),			
													),	
													
						'mixcloud_shortcode_options' => array(
													'url' 		=> __('Track url', ARP_PT_TXTDOMAIN),
													'height' 	=> __('Height', ARP_PT_TXTDOMAIN),
													'autoplay' 	=> __('Autoplay', ARP_PT_TXTDOMAIN),			
													),	
													
						'beatport_shortcode_options' => array(
													'id' 		=> __('Track id', ARP_PT_TXTDOMAIN),
													'height' 	=> __('Height', ARP_PT_TXTDOMAIN),
													'autoplay' 	=> __('Autoplay', ARP_PT_TXTDOMAIN),			
													),
																																																			
						'embed_shortcode_options' => array(
													'id' 		=> __('Embed', ARP_PT_TXTDOMAIN),
													/*'height' 	=> __('Height', ARP_PT_TXTDOMAIN)*/
													),								
													
						),
						
			'column_body_options' => array('body_description' => '', 'description_shortcode_options' => array('icons','icon_alignment'), 'icon_shortcode_options' => array(), 'description_alignment' =>'center', 'tooltip_text' => '' ),
			
			'column_button_options' => array(
								'button_size' => array(
												'small'		=> __('Small', ARP_PT_TXTDOMAIN),
												'medium' 	=> __('Medium', ARP_PT_TXTDOMAIN),
												'large' 	=> __('Large', ARP_PT_TXTDOMAIN),
												), 
								'button_type' => array(
												'button'		=> __('Button', ARP_PT_TXTDOMAIN),
												'submit_button'	=> __('Submit', ARP_PT_TXTDOMAIN), 
												), 
								'button_text' => '', 
								'button_icon'=> array(), 
								'button_link' => '', 
								'open_link_in_new_window' => '0', 
								'button_custom_image' => ''
								),
			
			));
			
			return $arptempbutoptionsarr;
		}
		
		
		/* Setting Template Button Options for Pricing table */
		function arp_tempbuttonsoptions()
		{
			$rpttempbutoptionsarr = apply_filters('arp_pricing_table_available_column_button_settings', array(

			'template_button_options' => array(
								'features' => array(
								
									'arptemplate_1' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(
																								  'header_level_options__button_1'=>array('column_title','header_caption_font_family','header_caption_font_size','header_caption_font_style','header_caption_font_color','arp_object','arp_fontawesome','header_level_caption_arp_ok_div__button_1'),
																								 ),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_object','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(
															  							     'body_level_options__button_1'=>array('text_alignment','body_li_caption_font_family','body_li_caption_font_size','body_li_caption_font_style','body_li_caption_font_color','body_level_caption_arp_ok_div__button_1'),
																							 
																						  ),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(
															  									'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_caption_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_caption_arp_ok_div__button_2'),
																								
																								
																								
															  								 ),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																								
																								
																								
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																					  ),
															  					),
									),
									
									'arptemplate_4' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								  
																								   
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(
																								'header_level_options__button_1'=>array('column_title','header_caption_font_family','header_caption_font_size','header_caption_font_style','header_caption_font_color','arp_fontawesome','header_level_caption_arp_ok_div__button_1'),
																							 ),
																							'other_columns_buttons'=>array(
																							   	'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																							 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(
															  							     'body_level_options__button_1'=>array('text_alignment','body_li_caption_font_family','body_li_caption_font_size','body_li_caption_font_style','body_li_caption_font_color','body_level_caption_arp_ok_div__button_1'),
																							 
																						  ),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(
															  									'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_caption_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_caption_arp_ok_div__button_2'),
																								
																								
																								
															  								 ),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																							
																							
																							
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																					  ),
															  					),
									),
									
									
									'arptemplate_12' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								   
																								   
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(
																								  'header_level_options__button_1'=>array('column_title','header_caption_font_family','header_caption_font_size','header_caption_font_style','header_caption_font_color','arp_fontawesome','header_level_caption_arp_ok_div__button_1'),
																								 ),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																								'pricing_level_options__button_3'=>array('column_description','column_description_other_font_family','column_description_other_font_size','column_description_other_font_style','column_description_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_3'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(
															  							     'body_level_options__button_1'=>array('text_alignment','body_li_caption_font_family','body_li_caption_font_size','body_li_caption_font_style','body_li_caption_font_color','body_level_caption_arp_ok_div__button_1'),
																							 
																						  ),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(
															  									'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_caption_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_caption_arp_ok_div__button_2'),
																								
																								
																								
															  								 ),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																								
																								
																								
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																					  ),
															  					),
									),
									
									'arptemplate_3' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								   
																								   
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_object','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								   'header_level_options__button_2'=>array('column_description','column_description_other_font_family','column_description_other_font_size','column_description_other_font_style','column_description_other_font_color','arp_object','arp_fontawesome','header_level_other_arp_ok_div__button_2'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																								
																								
																								
																								
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																							
																					  ),
															  					),
									),
									
									'arptemplate_5' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								   
																								   
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								   'header_level_options__button_3'=>array('additional_shortcode','arp_fontawesome','header_level_other_arp_ok_div__button_3'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																								
																								
																								
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																							
																					  ),
															  					),
									),
									
									'arptemplate_7' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								   
																								   
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								   'header_level_options__button_2'=>array('column_description','column_description_other_font_family','column_description_other_font_size','column_description_other_font_style','column_description_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_2'),
																								   'header_level_options__button_3'=>array('additional_shortcode','arp_fontawesome','header_level_other_arp_ok_div__button_3'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																								
																								
																								
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																							
																					  ),
															  					),
									),
									
									'arptemplate_8' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								   
																								   
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								   'header_level_options__button_3'=>array('additional_shortcode','arp_object','arp_fontawesome','header_level_other_arp_ok_div__button_3'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							'body_level_options__button_2'=>array('body_label_other_font_family','body_label_other_font_size','body_label_other_font_style','body_label_other_font_color','body_level_other_arp_ok_div__button_2'),
																							
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('add_shortcode','label','arp_fontawesome','add_shortcode','label','arp_fontawesome','body_li_level_other_arp_ok_div__button_3',    'body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																								
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																							
																					  ),
															  					),
									),
									
									'arptemplate_11' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																								 ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								   
																								   
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_object','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																								'pricing_level_options__button_3'=>array('column_description','column_description_other_font_family','column_description_other_font_size','column_description_other_font_style','arp_fontawesome','column_description_other_font_color','pricing_level_other_arp_ok_div__button_3'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																								
																								
																								
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																							
																					  ),
															  					),
									),
									
									'arptemplate_10' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																							),
																							'other_columns_buttons'=>array(
																								'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																							),
																						),
															  'header_level_options'=>array('caption_column_buttons'=>array(
															  									'header_level_options__button_1'=>array('column_title','header_caption_font_family','header_caption_font_size','header_caption_font_style','header_caption_font_color','header_level_caption_arp_ok_div__button_1'),
															  						),
															  								'other_columns_buttons'=>array(
																								'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																						),
																						
															  'body_level_options'=>array('caption_column_buttons'=>array(
															  							     'body_level_options__button_1'=>array(),
																							 
																						  ),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							'body_level_options__button_2'=>array('body_label_other_font_family','body_label_other_font_size','body_label_other_font_style','body_label_other_font_color','body_level_other_arp_ok_div__button_2'),
																							'body_level_options__button_3'=>array('column_description','column_description_other_font_family','column_description_other_font_size','column_description_other_font_style','column_description_other_font_color','arp_fontawesome','body_level_other_arp_ok_div__button_3'),
																							
																						  ),
																						 ),
																						 
																						 
																	
																	
																						 
															  'body_li_level_options'=>array('caption_column_buttons'=>
															  				array('body_li_level_options__button_1'=>
																			array('body_li_add_shortcode','arp_object','description','body_li_level_caption_arp_ok_div__button_1'),'body_li_level_options__button_2'=>array('tooltip','body_li_level_caption_arp_ok_div__button_2'),
																								
															  								 ),
																							 'other_columns_buttons'=>array(
																	 	'body_li_level_options__button_1'=>array('add_shortcode','label','arp_fontawesome','body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																		'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																		
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																							
																					  ),
															  					),
															  'second_button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'second_button_options__button_1'=>array('button_text_s','add_icon_s','external_btn_s','second_button_other_font_family','second_button_other_font_size','second_button_other_font_style','second_button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'second_button_options__button_2'=>array('button_image_s','add_shortcode_s','button_options_other_arp_ok_div__button_2'),
																							'second_button_options__button_3'=>array('redirect_link_s','open_in_new_window_s','button_size','button_options_other_arp_ok_div__button_3'),
																					  ),
															  					),
															
									),
									
									'arptemplate_6' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								   
																								   
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(
															  									'header_level_options__button_1'=>array('column_title','header_caption_font_family','header_caption_font_size','header_caption_font_style','header_caption_font_color','arp_object','arp_fontawesome','header_level_caption_arp_ok_div__button_1'),
																							),
																							'other_columns_buttons'=>array(
																							   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_object','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																							   'header_level_options__button_2'=>array('column_description','column_description_other_font_family','column_description_other_font_size','column_description_other_font_style','column_description_other_font_color','arp_object','arp_fontawesome','header_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_object','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_object','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(
															  								'body_level_options__button_1'=>array('text_alignment','body_li_caption_font_family','body_li_caption_font_size','body_li_caption_font_style','body_li_caption_font_color','body_level_caption_arp_ok_div__button_1'),
																						),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(
															  									'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_caption_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_caption_arp_ok_div__button_2'),
															  								 ),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																								
																								
																								
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																							
																					  ),
															  					),
									),
									'arptemplate_2' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','column_level_caption_arp_ok_div__button_1'),
																								 ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								  ),
																						),
															  'header_level_options'=>array('caption_column_buttons'=>array(),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								   'header_level_options__button_3'=>array('additional_shortcode','arp_object','arp_fontawesome','header_level_other_arp_ok_div__button_3'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																					  ),
															  					),
									),
									'arptemplate_9' => array('column_level_options'=>array('caption_column_buttons'=>array(
																								  'column_level_options__button_1'=>array('column_width','set_hidden','select_ribbon','column_level_caption_arp_ok_div__button_1'),
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								   
																								  
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(
																								  'header_level_options__button_1'=>array('column_title','header_caption_font_family','header_caption_font_size','header_caption_font_style','header_caption_font_color','arp_object','arp_fontawesome','header_level_caption_arp_ok_div__button_1'),
																								 ),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_object','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_object','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_object','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(
															  							     'body_level_options__button_1'=>array('text_alignment','body_li_caption_font_family','body_li_caption_font_size','body_li_caption_font_style','body_li_caption_font_color','body_level_caption_arp_ok_div__button_1'),
																							 
																						  ),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																							
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(
															  									'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_caption_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_caption_arp_ok_div__button_2'),
																								
																								
																								
															  								 ),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																								
																								
																								
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																					  ),
															  					),
									),
									'arptemplate_13'=>array('column_level_options'=>array('caption_column_buttons'=>array(
																								  
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
																								   'column_level_options__button_2'=>array('column_description','column_description_other_font_family','column_description_other_font_size','column_description_other_font_style','column_description_other_font_color','arp_fontawesome','column_level_other_arp_ok_div__button_2'),
																								  
																								  
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(
																								  'header_level_options__button_1'=>array('column_title','header_caption_font_family','header_caption_font_size','header_caption_font_style','header_caption_font_color','header_level_caption_arp_ok_div__button_1'),
																								 ),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_object','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_object','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(
															  							     'body_level_options__button_1'=>array('text_alignment','body_li_caption_font_family','body_li_caption_font_size','body_li_caption_font_style','body_li_caption_font_color','body_level_caption_arp_ok_div__button_1'),
																						  ),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(
															  									'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_caption_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_caption_arp_ok_div__button_2'),
															  								 ),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																					  ),
															  					),
									
									
									
													  ),
								'arptemplate_15'=>array('column_level_options'=>array('caption_column_buttons'=>array(),
																						'other_columns_buttons'=>array(
																							'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),																	   ),
																				),
														'header_level_options'=>array('caption_column_buttons'=>array(
																								  'header_level_options__button_1'=>array('column_title','header_caption_font_family','header_caption_font_size','header_caption_font_style','header_caption_font_color','header_level_caption_arp_ok_div__button_1'),
																								 ),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_object','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_object','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(
															  							     'body_level_options__button_1'=>array('text_alignment','body_li_caption_font_family','body_li_caption_font_size','body_li_caption_font_style','body_li_caption_font_color','body_level_caption_arp_ok_div__button_1'),
																						  ),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(
															  									'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_caption_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_caption_arp_ok_div__button_2'),
															  								 ),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																					  ),
															  					),
									
									
									
													  ),

									'arptemplate_14'=>array('column_level_options'=>array('caption_column_buttons'=>array(),
																						'other_columns_buttons'=>array(
																							'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),																	   ),
																				),
														'header_level_options'=>array('caption_column_buttons'=>array(
																								  'header_level_options__button_1'=>array('column_title','header_caption_font_family','header_caption_font_size','header_caption_font_style','header_caption_font_color','header_level_caption_arp_ok_div__button_1'),
																								 ),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(
															  							     'body_level_options__button_1'=>array('text_alignment','body_li_caption_font_family','body_li_caption_font_size','body_li_caption_font_style','body_li_caption_font_color','body_level_caption_arp_ok_div__button_1'),
																						  ),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(
															  									'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_caption_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_caption_arp_ok_div__button_2'),
															  								 ),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																					  ),
															  					),
									
									
									
													  ),									
									'arptemplate_16'=>array('column_level_options'=>array('caption_column_buttons'=>array(
																								  
																								  ),
																								'other_columns_buttons'=>array(
																								   'column_level_options__button_1'=>array('column_width','column_highlight','set_hidden','select_ribbon','column_level_other_arp_ok_div__button_1'),
				
																								   ),
																								   ),
															  'header_level_options'=>array('caption_column_buttons'=>array(
																								  'header_level_options__button_1'=>array('column_title','header_caption_font_family','header_caption_font_size','header_caption_font_style','header_caption_font_color','header_level_caption_arp_ok_div__button_1'),
																								 ),
																								'other_columns_buttons'=>array(
																								   'header_level_options__button_1'=>array('column_title','header_other_font_family','header_other_font_size','header_other_font_style','header_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_1'),
																								   'header_level_options__button_2'=>array('column_description','column_description_other_font_family','column_description_other_font_size','column_description_other_font_style','column_description_other_font_color','arp_fontawesome','header_level_other_arp_ok_div__button_2')
																								 ),
																							),
															  'pricing_level_options'=>array('caption_column_buttons'=>array(),
															  								 'other_columns_buttons'=>array(
																							 	'pricing_level_options__button_1'=>array('price_text','price_text_other_font_family','price_text_other_font_size','price_text_other_font_style','price_text_other_font_color','arp_object','arp_fontawesome','pricing_level_other_arp_ok_div__button_1'),
																								'pricing_level_options__button_2'=>array('price_label','price_label_other_font_family','price_label_other_font_size','price_label_other_font_style','price_label_other_font_color','arp_object','arp_fontawesome','pricing_level_other_arp_ok_div__button_2'),
																							 ),
																							),
															  'body_level_options'=>array('caption_column_buttons'=>array(
															  							     'body_level_options__button_1'=>array('text_alignment','body_li_caption_font_family','body_li_caption_font_size','body_li_caption_font_style','body_li_caption_font_color','body_level_caption_arp_ok_div__button_1'),
																						  ),
																						  'other_columns_buttons'=>array(
																						  	'body_level_options__button_1'=>array('text_alignment','body_li_other_font_family','body_li_other_font_size','body_li_other_font_style','body_li_other_font_color','body_level_other_arp_ok_div__button_1'),
																						  ),
																						 ),
															  'body_li_level_options'=>array('caption_column_buttons'=>array(
															  									'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_caption_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_caption_arp_ok_div__button_2'),
															  								 ),
																							 'other_columns_buttons'=>array(
																							 	'body_li_level_options__button_1'=>array('body_li_add_shortcode','arp_object','description','body_li_level_other_arp_ok_div__button_1'),
																								'body_li_level_options__button_2'=>array('tooltip','arp_fontawesome','body_li_level_other_arp_ok_div__button_2'),
																							 ),
															  						   ),
															  'button_options'=>array('caption_column_buttons'=>array(),
															  						  'other_columns_buttons'=>array(
																					  		'button_options__button_1'=>array('button_text','add_icon','button_size','button_other_font_family','button_other_font_size','button_other_font_style','button_other_font_color','button_options_other_arp_ok_div__button_1'),
																							'button_options__button_2'=>array('button_image','add_shortcode','button_options_other_arp_ok_div__button_2'),
																							'button_options__button_3'=>array('redirect_link','open_in_new_window','external_btn','button_options_other_arp_ok_div__button_3'),
																					  ),
															  					),
									
									
									
													  ),									
								))
			) );
			return $rpttempbutoptionsarr;
		}
		
		/* Setting Admin CSS  */
		function set_css()
		{
		
			wp_register_style( 'arprice_admin_css',PRICINGTABLE_URL.'/css/arprice_admin.css' );
			
			wp_register_style( 'arprice_fontawesome_css',PRICINGTABLE_URL.'/css/font-awesome.css' );
			
			wp_register_style( 'arprice_tooltip_css', PRICINGTABLE_URL.'/css/tooltipster.css' );
			
			wp_register_style( 'arprice_colpick_css', PRICINGTABLE_URL.'/css/colpick.css' );
			
			wp_register_style( 'arprice_font_css_admin', PRICINGTABLE_URL.'/fonts/arp_fonts.css' );
			
			wp_register_style( 'arprice_bootstrap_tour_css',PRICINGTABLE_URL.'/css/bootstrap-tour-standalone.css' );
			
			if( isset( $_REQUEST['page'] ) && ( $_REQUEST['page'] == 'arprice' || $_REQUEST['page'] == 'arp_add_pricing_table' || $_REQUEST['page'] == 'arp_analytics' || $_REQUEST['page'] == 'arp_import_export' || $_REQUEST['page'] == 'arp_global_settings' ) )
			{
				if( version_compare( $GLOBALS['wp_version'], '2.9', '>') and version_compare( $GLOBALS['wp_version'], '3.2', '<') ){
					wp_enqueue_style('arprice_admin_css_3.0',PRICINGTABLE_URL.'/css/arprice_admin_3.0.css');
				} 
				
				else if (version_compare( $GLOBALS['wp_version'],'3.1','>') and version_compare( $GLOBALS['wp_version'],'3.3','<') ){
					wp_enqueue_style('arprice_admin_css_3.2',PRICINGTABLE_URL.'/css/arprice_admin_3.2.css');
					
				}
				
				else if (version_compare( $GLOBALS['wp_version'],'3.2','>') and version_compare( $GLOBALS['wp_version'],'3.4','<') ){
					wp_enqueue_style('arprice_admin_css_3.3',PRICINGTABLE_URL.'/css/arprice_admin_3.3.css');
				}	
					 else if (version_compare( $GLOBALS['wp_version'],'3.3','>') and version_compare( $GLOBALS['wp_version'],'3.5','<') ){
					wp_enqueue_style('arprice_admin_css_3.4',PRICINGTABLE_URL.'/css/arprice_admin_3.4.css');
				} else if (version_compare( $GLOBALS['wp_version'],'3.4','>') and version_compare( $GLOBALS['wp_version'],'3.6','<') ){
					wp_enqueue_style('arprice_admin_css_3.5',PRICINGTABLE_URL.'/css/arprice_admin_3.5.css');
				} else if (version_compare( $GLOBALS['wp_version'],'3.5','>') and version_compare( $GLOBALS['wp_version'],'3.8','<') ){
					wp_enqueue_style('arprice_admin_css_3.6',PRICINGTABLE_URL.'/css/arprice_admin_3.6.css');
				} else if (version_compare( $GLOBALS['wp_version'],'3.7','>') ){
					wp_enqueue_style('arprice_admin_css_3.8',PRICINGTABLE_URL.'/css/arprice_admin_3.8.css');
				}
								
				wp_enqueue_style( 'arprice_admin_css' );
				
				wp_enqueue_style( 'arprice_fontawesome_css' );
				
				wp_enqueue_style( 'arprice_font_css_admin' );
				
				wp_enqueue_style('arprice_bootstrap_tour_css');
				
				if( isset($_REQUEST['page']) and $_REQUEST['page'] == 'arprice' ){
					wp_enqueue_style( 'arprice_tooltip_css' );
					
					wp_enqueue_style( 'arprice_colpick_css' );
					
				}
			}
			
		}
		
		
		/* Setting Frond CSS */
		function set_front_css()
		{
			if(!is_admin())
			{
				// Common CSS
				wp_register_style( 'arprice_front_css',PRICINGTABLE_URL.'/css/arprice_front.css' );
							
				// Tooltip CSS
				wp_register_style( 'arprice_front_tooltip_css', PRICINGTABLE_URL.'/css/tooltipster.css' );
				
				// Font Awesome CSS
				wp_register_style( 'arp_fontawesome_css',PRICINGTABLE_URL.'/css/font-awesome.css' );
				
				// Font CSS
				wp_register_style( 'arprice_font_css_front', PRICINGTABLE_URL.'/fonts/arp_fonts.css' );		
			}
		}
		
		/* Setting CSS as per Selected Template */
		function arp_enqueue_template_css(){
	
			global $post,$arprice_form;
			
			$upload_main_url 	= PRICINGTABLE_UPLOAD_URL.'/css';
			
			$post_content = isset($post->post_content) ? $post->post_content : '';
			$parts = @explode("[ARPrice",$post_content);
			$myidpart = @explode("id=",$parts[1]);
			$myid = @explode("]",$myidpart[1]);
			
			if( !is_admin() )
			{
				global $wp_query;	
				$posts = $wp_query->posts;
				$pattern = '\[(\[?)(ARPrice)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';
				
				if(is_array($posts))
				{
					foreach ($posts as $post){
						if (   preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
							&& array_key_exists( 2, $matches )
							&& in_array( 'ARPrice', $matches[2] ) )
						{
							
							break;	
						}    
					}
									
					$formids = array();					
					if(is_array($matches) && count($matches)>0)
					{
						foreach($matches as $k=>$v)
						{
							
							
							foreach($v as $key => $val)
							{
								$parts = explode("id=",$val);
								if($parts > 0 && isset($parts[1]))
								{
									
									if (stripos(@$parts[1], ']') !== false) {
										$partsnew = explode("]",$parts[1]);
										$formids[] = $partsnew[0];
									}
									else if (stripos(@$parts[1], ' ') !== false) {
										
										$partsnew = explode(" ",$parts[1]);
										$formids[] = $partsnew[0];
									}
									else
									{
										
									}
									
								}
								
							}
							
						}
					}
				}
				
				
				$newvalarr = array();
									
				if(isset($formids) and is_array($formids) && count($formids) > 0)
				{
					foreach($formids as $newkey => $newval)
					{
						$newval = str_replace('"','',$newval);
						$newval = str_replace("'","",$newval);
						if(stripos($newval, ' ') !== false) {
						$partsnew = explode(" ",$newval);
						$newvalarr[] = $partsnew[0];
						}
						else
							$newvalarr[] = $newval;
					}
				}
				
				if( $newvalarr )
					$newvalues_enqueue = $arprice_form->get_table_enqueue_data( $newvalarr ); 
				
				if(is_array($newvalues_enqueue) && count($newvalues_enqueue) > 0)
				{
					$to_google_map 	= 0;
					$templates 		= array();
					$is_template = 0;
					
					foreach($newvalues_enqueue as $n=>$newqnqueue)
					{
						if( $newqnqueue['googlemap'] )
							$to_google_map = 1;
						
						//$templates[] = $newqnqueue['template']; 
						if($newqnqueue['template_name'] != 0){
							$templates[] = $newqnqueue['template_name'];	
						}else{
							$templates[] = $n;	
						}
						
						if(!empty($newqnqueue['is_template'])){
							$is_template = $newqnqueue['is_template'];
						}
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
						
				
						
						wp_enqueue_style( 'arprice_front_css' );
				
						wp_enqueue_style( 'arprice_font_css_front' );
						
				

						foreach($newvalues_enqueue as $template_id => $newqnqueue)
						{
							if(isset($newqnqueue['is_template']) && !empty($newqnqueue['is_template'])){
								wp_register_style( 'arptemplate_'.$newqnqueue['template_name'].'_css',PRICINGTABLE_URL.'/css/templates/arptemplate_'.$newqnqueue['template_name'].'.css' );				
								wp_enqueue_style( 'arptemplate_'.$newqnqueue['template_name'].'_css' );
								
							} else {

								wp_register_style( 'arptemplate_'.$template_id.'_css',PRICINGTABLE_UPLOAD_URL.'/css/arptemplate_'.$template_id.'.css' );				
								wp_enqueue_style( 'arptemplate_'.$template_id.'_css' );
							}
						}
						
						
				
					}
					
				}
				
			}
		
		}
		
		/* Setting Front Side JavaScript */
		function set_front_js()
		{
			if(!is_admin())
			{
				// Setting jQuery
				wp_enqueue_script( 'jquery' );
				
				// Common JS
				wp_register_script( 'arprice_js',PRICINGTABLE_URL.'/js/arprice_front.js');
								
				// Slider JS
				wp_register_script( 'arprice_slider_js',PRICINGTABLE_URL.'/js/jquery.carouFredSel.js');
								
				// Tooltip JS
				wp_register_script( 'arp_tooltip_front', PRICINGTABLE_URL.'/js/jquery.tooltipster.js' );
								
			}			
			
		}
		
		/* Setting Admin JavaScript */
		function set_js()
		{
		
			wp_register_script( 'arprice_js',PRICINGTABLE_URL.'/js/arprice.js');
			
			wp_register_script( 'arprice_sortable_resizable_js',PRICINGTABLE_URL.'/js/arprice_sortable_resizable.js');
			 
			wp_register_script( 'arprice_analytics_js',PRICINGTABLE_URL.'/js/arprice_analytics.js');
			
			wp_register_script( 'arprice_highchart_js', PRICINGTABLE_URL.'/js/highchart/highcharts.js');
			
			wp_register_script( 'arprice_highchart_3d_js', PRICINGTABLE_URL.'/js/highchart/highcharts-3d.js');
			
			wp_register_script( 'arp_bpopup', PRICINGTABLE_URL.'/js/jquery.bpopup.min.js' );
			
			wp_register_script( 'arp_tooltip', PRICINGTABLE_URL.'/js/jquery.tooltipster.js' );
			
			wp_register_script( 'arprice_colpick', PRICINGTABLE_URL.'/js/colpick.js' );
			
			wp_register_script( 'arp_jeditable_js', PRICINGTABLE_URL.'/js/jquery.jeditable.mini.js');
			
			wp_register_script( 'arprice_editor_js', PRICINGTABLE_URL.'/js/arprice_editor.js' );
			
			wp_register_script( 'arprice_html2canvas_js', PRICINGTABLE_URL.'/js/html2canvas.js' );
			
			wp_register_script( 'arprice_bootstrap_tour_js', PRICINGTABLE_URL.'/js/bootstrap-tour-standalone.js' );
			
			wp_register_script('arprice_tour_guide', PRICINGTABLE_URL.'/js/arprice_tour_guide.js' );
			if( isset( $_REQUEST['page'] ) && ( $_REQUEST['page'] == 'arprice' || $_REQUEST['page'] == 'arp_add_pricing_table' || $_REQUEST['page'] == 'arp_analytics' || $_REQUEST['page'] == 'arp_import_export'  || $_REQUEST['page'] == 'arp_global_settings' ) )
			{
				if( version_compare( $GLOBALS['wp_version'],'3.5','<' ) ){
 					wp_enqueue_script('jquery-underscore-min',PRICINGTABLE_URL.'/js/underscore.min.js' );
  				}
				if( version_compare( $GLOBALS['wp_version'],'3.4','<' ) ){
				
					wp_enqueue_script('jquery-latest',PRICINGTABLE_URL.'/js/jquery-1.7.2.min.js' );
				
				} else {
					wp_enqueue_script( 'jquery' );
				}
				
				
				if( isset($_REQUEST['page']) and ($_REQUEST['page'] == 'arprice' || $_REQUEST['page'] == 'arp_global_settings') ){	
											
					wp_enqueue_script( 'arprice_js');
					
					wp_enqueue_script( 'arprice_sortable_resizable_js');
					
					wp_enqueue_script( 'arp_bpopup' );
					
					if( version_compare( $GLOBALS['wp_version'],'3.3','<' ) ){
					
						wp_enqueue_script( 'arp_custom_jquery_ui', PRICINGTABLE_URL.'/js/jquery-ui.js' );
						
					} else {
						
						wp_enqueue_script( 'jquery-ui-core' );
						
						wp_enqueue_script( 'jquery-effects-slide' );
						
					}
					
					wp_enqueue_script( 'jquery-ui-sortable' );
					
					wp_enqueue_script( 'jquery-ui-resizable' );
					
					wp_enqueue_script( 'media-upload' );
					
					wp_enqueue_script( 'arp_tooltip' );
					
					wp_enqueue_script( 'arprice_colpick' );
					
					wp_enqueue_script( 'arp_jeditable_js' );
					
					wp_enqueue_script( 'arprice_editor_js' );
					
					wp_enqueue_script( 'arprice_select_picker_js' );
					
					wp_enqueue_script( 'arprice_html2canvas_js');
					
					wp_enqueue_script( 'arprice_bootstrap_tour_js');
					
					wp_enqueue_script( 'arprice_tour_guide');
					
					
				}
				
				
				if(isset($_REQUEST['page']) and $_REQUEST['page'] == 'arp_analytics'){
					wp_enqueue_script( 'arprice_analytics_js' );
					
					wp_enqueue_script( 'arprice_highchart_js' );
					
					wp_enqueue_script( 'arprice_highchart_3d_js');
					
				}
				
				
			}
			
		}
		
		/* Setting Menu Position */
		function get_free_menu_position($start, $increment = 0.1)
		{
				foreach ($GLOBALS['menu'] as $key => $menu) {
					$menus_positions[] = $key;
				}
				if (!in_array($start, $menus_positions)) return $start;
				/* the position is already reserved find the closet one */
				while (in_array($start, $menus_positions)) {
					$start += $increment;
				}
				return $start;
		}
		
		/* Setting Capabilities for user */
		function arp_capabilities()
		{
			$cap = array(
				'arp_view_pricingtables' => __('View And Manage Pricing Tables', ARP_PT_TXTDOMAIN),
				'arp_add_udpate_pricingtables' => __('Add/Edit Pricing Tables', ARP_PT_TXTDOMAIN),
				'arp_analytics_pricingtables' => __('View Analytics of Pricing Tables', ARP_PT_TXTDOMAIN),
				'arp_import_export_pricingtables' => __('Import/Export Pricing Tables', ARP_PT_TXTDOMAIN),
				'arp_global_settings_pricingtables' => __('Import/Export Pricing Tables', ARP_PT_TXTDOMAIN),
			);
	
			return $cap;
    	}
		
	    // Adding Pricing Table Menu
		function pricingtable_menu()
		{
			global $arp_pricingtable;
				if(current_user_can('administrator'))
				{
					global $current_user;
					$arproles = $arp_pricingtable->arp_capabilities();
					foreach($arproles as $arprole => $arproledescription)
						$current_user->add_cap( $arprole );
		
					unset($arproles);
					unset($arprole);
					unset($arproledescription);
				}
				
				$place = $arp_pricingtable->get_free_menu_position(26.1 , .1);
				
				// add custom role to these menu links
				
				add_menu_page( 'ARPrice', 'ARPrice', 'arp_view_pricingtables', 'arprice', array(&$this,'route'),PRICINGTABLE_IMAGES_URL.'/pricing_table_icon.png',(string)$place);
				
				
				
				do_action('add_licensed_menu');
				
				
				
				add_submenu_page( 'arprice', __('Import/Export',ARP_PT_TXTDOMAIN), __('Import/Export',ARP_PT_TXTDOMAIN), 'arp_import_export_pricingtables', 'arp_import_export', array( &$this, 'route' ) );
				
				add_submenu_page( 'arprice', __('Settings',ARP_PT_TXTDOMAIN), __('Settings',ARP_PT_TXTDOMAIN), 'arp_global_settings_pricingtables', 'arp_global_settings', array( &$this, 'route' ) );
		}
		
		function route()
		{
			global $arp_pricingtable,$arprice_form;
			if( isset($_REQUEST['page']) and $_REQUEST['page'] == 'arprice' ){	
				//self::displaylist();
				$arp_pricingtable->addnew();
			} else if( isset($_REQUEST['page']) and $_REQUEST['page'] == 'arp_add_pricing_table' ) {
				if( isset($_REQUEST['arpaction']) and $_REQUEST['arpaction'] == 'create_new' )
					$arprice_form->edit_template();
				else
					$arp_pricingtable->addnew();
			} else if( isset($_REQUEST['page']) and $_REQUEST['page'] == 'arp_analytics') {
				$arp_pricingtable->analytics();
			} else if( isset($_REQUEST['page']) and $_REQUEST['page'] == 'arp_import_export' ) {
				$arp_pricingtable->import_export();
			} else if( isset($_REQUEST['page']) and $_REQUEST['page'] == 'arp_global_settings' ) {
				$arp_pricingtable->load_global_settings();
			} else{
				$arp_pricingtable->addnew();
			}
		}
		
		function addnew()
		{
			if( file_exists( PRICINGTABLE_VIEWS_DIR.'/arprice_listing_editor.php' ) )
				include( PRICINGTABLE_VIEWS_DIR.'/arprice_listing_editor.php' );
		}
		
		function analytics()
		{
			if( file_exists( PRICINGTABLE_VIEWS_DIR.'/arprice_analytics.php' ) )
				include( PRICINGTABLE_VIEWS_DIR.'/arprice_analytics.php' );
		}
		
		function import_export()
		{
			if( file_exists( PRICINGTABLE_VIEWS_DIR.'/arprice_import_export.php' ) )
				include( PRICINGTABLE_VIEWS_DIR.'/arprice_import_export.php' );
		}
		
		function load_global_settings()
		{
			if( file_exists( PRICINGTABLE_VIEWS_DIR.'/arprice_global_settings.php' ) )
				include( PRICINGTABLE_VIEWS_DIR.'/arprice_global_settings.php' );
		}
		
		function arp_db_check()
		{
			global $arp_pricingtable;
			$arprice_version = get_option('arprice_version');
		
			if( !isset($arprice_version) || $arprice_version =='' && is_multisite() ) 
			{
				$arp_pricingtable->install();
			}
		}
		
		function install()
		{
			global $arp_pricingtable;
			
			$arprice_version = get_option('arprice_version');
		
			if( !isset($arprice_version) || $arprice_version ==''  ) 
			{
				$arp_pricingtable->arp_pricing_table_main_settings();
				
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
								
				global $wpdb, $arprice_version;
				
				$charset_collate = '';

				if( $wpdb->has_cap( 'collation' ) ){
		
					if( !empty($wpdb->charset) )
						$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
	
					if( !empty($wpdb->collate) )
						$charset_collate .= " COLLATE $wpdb->collate";
				}
			
				update_option('arprice_version', $arprice_version);
				
				update_option('arprice_tour_guide_value', 'yes');		
					
				$table = $wpdb->prefix.'arp_arprice';
				
				$sql_table = "CREATE TABLE IF NOT EXISTS {$table}(
							
							 ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
							 table_name VARCHAR(255) NOT NULL, 
							 template_name int(11) NOT NULL,
							 general_options TEXT NOT NULL, 
							 is_template int(1) NOT NULL,
							 is_animated int(1) NOT NULL,
							 status VARCHAR(255) NOT NULL, 
							 pricing_css TEXT NOT NULL, 
							 create_date DATETIME NOT NULL 
							 
							 ){$charset_collate}";
				
				dbDelta($sql_table);
				
				$table_opt = $wpdb->prefix.'arp_arprice_options';
				
				$sql_table_opt = "CREATE TABLE IF NOT EXISTS {$table_opt}( 
								  ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
								  table_id INT(11) NOT NULL, 
								  table_options TEXT NOT NULL 
								
								){$charset_collate}";
				
				dbDelta($sql_table_opt);
				
				$tablecreate = $wpdb->prefix.'arp_arprice_analytics';
						
				$sqltable="	CREATE TABLE IF NOT EXISTS {$tablecreate}(
							tracking_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
							pricing_table_id int NOT NULL,
							browser_info TEXT NOT NULL,
							browser_name VARCHAR(255) NOT NULL,
							browser_version VARCHAR(255) NOT NULL,
							page_url varchar(255) NOT NULL,
							referer varchar(255) NOT NULL,
							ip_address varchar(255) NOT NULL,
							country_name varchar(255) NOT NULL,
							session_id varchar(255) NOT NULL,
							added_date DATETIME NOT NULL
							
							){$charset_collate}";
				dbDelta($sqltable);
				
				$arp_pricingtable->arp_pricing_table_templates();		//install default templates
				
				$arp_pricingtable->arp_set_global_settings();
				global $arprice_class;
				$arprice_class->getwpversion();
			}
		}
		
		function uninstall()
		{			
			
			global $wpdb;
			if ( is_multisite() ) {		
				$blogs = $wpdb->get_results("SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A);
				if ($blogs) {
					foreach($blogs as $blog) {
						switch_to_blog($blog['blog_id']);
						
						delete_option('arprice_version');
						delete_option("arpIsSorted");
						delete_option("arpSortOrder");
						delete_option("arpSortId");
						delete_option('arprice_tour_guide_value');
						delete_option('arp_mobile_responsive_size');
						delete_option('arp_tablet_responsive_size');
						delete_option('arp_desktop_responsive_size');
						delete_option('arp_global_custom_css');
						delete_option('arp_wp_get_version');
						delete_option('arp_previewoptions');
						delete_option('arp_tablegeneraloption');
						delete_option('arp_tablecolumnoption');
						
						$wpdb->query("DELETE FROM ".$wpdb->options." WHERE option_name LIKE '%arp_previewtabledata_%'");
						$table = $wpdb->prefix.'arp_arprice';
						$table_opt = $wpdb->prefix.'arp_arprice_options';
						$table_analytics = $wpdb->prefix.'arp_arprice_analytics';
						$wpdb->query("DROP TABLE IF EXISTS $table");
						$wpdb->query("DROP TABLE IF EXISTS $table_opt");
						$wpdb->query("DROP TABLE IF EXISTS $table_analytics");
			
					}
					restore_current_blog();
				}
				
			} else {		
				delete_option('arprice_version');
				delete_option("arpIsSorted");
				delete_option("arpSortOrder");
				delete_option("arpSortId");
				delete_option('arprice_tour_guide_value');
				delete_option('arp_mobile_responsive_size');
				delete_option('arp_tablet_responsive_size');
				delete_option('arp_desktop_responsive_size');
				delete_option('arp_global_custom_css');
				delete_option('arp_wp_get_version');
				delete_option('arp_previewoptions');
				delete_option('arp_tablegeneraloption');
				delete_option('arp_tablecolumnoption');
						
				$wpdb->query("DELETE FROM ".$wpdb->options." WHERE option_name LIKE '%arp_previewtabledata_%'");
				$table = $wpdb->prefix.'arp_arprice';
				$table_opt = $wpdb->prefix.'arp_arprice_options';
				$table_analytics = $wpdb->prefix.'arp_arprice_analytics';
				$wpdb->query("DROP TABLE IF EXISTS $table");
				$wpdb->query("DROP TABLE IF EXISTS $table_opt");
				$wpdb->query("DROP TABLE IF EXISTS $table_analytics");
				
			}
		
		}
		
		function arp_pricing_table_templates()
		{
			include(PRICINGTABLE_CLASSES_DIR.'/class.arprice_default_templates.php');
		}
		
		function arp_enqueue_preview_css( $id, $template_id, $is_admin_preview,$is_template)
		{
			if( $is_template == 1 ){
			
				wp_register_style( 'arprice_preview_css_'.$id, PRICINGTABLE_URL.'/css/templates/arptemplate_'.$template_id.'.css' );
			
				wp_print_styles( 'arprice_preview_css_'.$id );
			} else {
				wp_register_style( 'arprice_preview_css_'.$id, PRICINGTABLE_UPLOAD_URL.'/css/arptemplate_'.$template_id.'.css' );
				
				wp_print_styles( 'arprice_preview_css_'.$id);
			}
			
			if( $is_admin_preview == 1 )
			{
				wp_register_style( 'arprice_front_css',PRICINGTABLE_URL.'/css/arprice_front.css' );
				
				wp_print_styles( 'arprice_front_css' );
				
				wp_register_script( 'arp_tooltip_front', PRICINGTABLE_URL.'/js/jquery.tooltipster.js' );
				
				wp_register_script( 'arprice_js', PRICINGTABLE_URL.'/js/arprice_front.js' );
			}
			
			wp_print_scripts( 'arprice_js');
			
			wp_print_scripts( 'arprice_slider_js');
			
			wp_print_scripts( 'arp_tooltip_front' );
			
		}
	
		function arp_hide_update_notice_to_all_admin_users()
		{
			if(isset($_GET) and (isset($_GET['page']) and preg_match('/arp*/', $_GET['page'])))
			{
				remove_all_actions( 'network_admin_notices',10000 );
				remove_all_actions( 'user_admin_notices',10000 );
				remove_all_actions( 'admin_notices',10000 );
				remove_all_actions( 'all_admin_notices',10000 );
			}
		}
		
		function footer_js($location='footer')
		{
			global $arp_is_animation, $arp_has_tooltip, $arp_has_fontawesome;
			
			if( $arp_is_animation == 1 )
				wp_enqueue_script( 'arprice_slider_js' );
			
			if( $arp_has_tooltip == 1 ){
				wp_enqueue_style( 'arprice_front_tooltip_css' );
				wp_enqueue_script( 'arp_tooltip_front' );
			}
			
			if( $arp_has_fontawesome == 1 )
				wp_enqueue_style( 'arp_fontawesome_css' );
        }
		
		function append_googlemap_js( $newvalarr ){
			
			global $arp_pricingtable,$arprice_form;
			$arr[] = $newvalarr;
			
			$newvalues_enqueue = $arprice_form->get_table_enqueue_data( $arr ); 
						
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
			}
		}
		
		
		
		
		function arp_template_order()
		{
			
			
			$arptmparr = apply_filters('arp_pricing_template_order_managed', array(
			
				'arptemplate_1' => 1,
				'arptemplate_2' => 2,
				'arptemplate_3' => 3,
				'arptemplate_4' => 4,
				
				'arptemplate_5' => 5,
				'arptemplate_6' => 6,
				'arptemplate_7' => 7,
				'arptemplate_8' => 8,
				
				'arptemplate_9' => 9,
				'arptemplate_10' => 10,
				'arptemplate_11' => 11,
				'arptemplate_12' => 12,
				
				'arptemplate_13' => 13,
				'arptemplate_14' => 14,
				'arptemplate_15' => 15,
				'arptemplate_16' => 16
			));
			
			
	
			return $arptmparr;
		}
		
		function arp_set_global_settings(){
			add_option('arp_mobile_responsive_size',480);
			add_option('arp_tablet_responsive_size',768);
			add_option('arp_desktop_responsive_size',0);
			add_option('arp_global_custom_css','');
		}
			
}
?>