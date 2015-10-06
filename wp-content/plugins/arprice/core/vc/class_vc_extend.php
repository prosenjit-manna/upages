<?php
if ( ! defined( 'WPINC' ) ) { die; }

class ARPrice_VCExtendArp {

	protected static $instance = null;

	public function __construct() {
		 add_action( 'init', array( $this, 'ARPintegrateWithVC' ) );
		 add_action( 'init', array( $this, 'callmyfunction' ) );
    } 
 
	/**
	 * Return an instance of this class
	 */
	 
	public static function arp_get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self;
		}
		
		return self::$instance;
	}
 
	/**
	 * Add to Visual Composer
	 */ 
 
    public function ARPintegrateWithVC() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(array(
				'name' => __('ARPrice', ARP_PT_TXTDOMAIN ),
				'description' => __('Ultimate Wordpress Pricing Table Plugin', ARP_PT_TXTDOMAIN ),
				'base' => 'ARPrice',
				'category' => __( 'Content', ARP_PT_TXTDOMAIN ),	
				'class' => '',
				'controls' => 'full',
				'admin_enqueue_css' => array(PRICINGTABLE_URL.'/core/vc/arprice_vc.css'),
				'icon' =>'arprice_vc_icon',
				'params' => array(
					array(
						"type" => "ARPrice_Shortode",
						'heading' => __('Ultimate Wordpress Pricing Table Plugin', ARP_PT_TXTDOMAIN),
						'param_name' => 'id',
						'value' => true,
						'description' => __('&nbsp;', ARP_PT_TXTDOMAIN ),
						'admin_label' => true
					)
				)
			) );
		}
    }
	
	public function callmyfunction(){
		if(function_exists('add_shortcode_param')){
			add_shortcode_param('ARPrice_Shortode',  array($this,'arprice_param_html'), PRICINGTABLE_URL.'/core/vc/arprice_vc.js');
		}
	}
	
	public function arprice_param_html($settings, $value) {
			if($settings){
					$html .= '<style>';
						$html .= '.arp_param_block .arp_vc_title{float: left; font-size: 17px; margin: 0 0 10px; width: 100%; font-weight: bold;}';
						$html .= '.arp_param_block{width:666px; margin:20px auto;}';
						$html .= '.arp_vd_img_list{margin:5px; padding:5px; float: left; cursor: pointer; border:1px solid #cccccc; opacity:}';
						$html .= '.arp_vd_img_list img{opacity:0.7}';
						$html .= '.arp_vd_img_list img:hover{
									opacity:1;
									box-shadow:0 0 0 3px rgba(86,178,11, 1);
									 -webkit-box-shadow:0 0 0 3px rgba(86,178,11, 1);
									 -moz-box-shadow:0 0 0 3px rgba(86,178,11, 1);
									 -o-box-shadow:0 0 0 3px rgba(86,178,11, 1);
									}';
					$html .='</style>';
					
					$html .= '<input type="hidden" name="'.$settings['param_name'].'" value="'.$value.'" class="wpb_vc_param_value">';
					
					
					global $wpdb;
					$arp_short_code_data = array();
					$templates = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."arp_arprice WHERE status = 'published'  ORDER BY ID ASC" ); 
					
					if(!empty($templates)){
						foreach($templates as $key => $template){
							$html .= '<div class="arp_vd_img_list" title="'. esc_attr($template->table_name ) . ' ">';
									if($template->is_template == '1'){
										$html .= '<img width="200" height="90"  alt="'. esc_attr($template->table_name) .'" id="'.$template->ID.'"  class="'. esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ) . '_field"   src="'.PRICINGTABLE_IMAGES_URL.'/arptemplate_'.$template->ID.'.png">';
										}else{
											$html .= '<img width="200" height="90" alt="'. esc_attr($template->table_name) .'" id="'.$template->ID.'"  class="'. esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ) . '_field"   src="'.PRICINGTABLE_UPLOAD_URL . '/template_images/arptemplate_'.$template->ID.'.png">';
										}
							$html .= '</div>';	
						}
					}
		}
    	return '<div class="arp_param_block"><div class="arp_vc_title">'.__('Please Select Your Pricing Table', ARP_PT_TXTDOMAIN).'</div>'.$html.'</div>';
	}
}?>