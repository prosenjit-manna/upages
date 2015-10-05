<?php
	@header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	@header("Cache-Control: post-check=0, pre-check=0", false);
	@header("Pragma: no-cache");
	@header("Expires: 0");
?>
<script>
	jQuery(function(){
		jQuery("#scroll_top_wrapper").scroll(function(){
			jQuery("#main_package").scrollLeft(jQuery("#scroll_top_wrapper").scrollLeft());
		});
		jQuery("#main_package").scroll(function(){
			jQuery("#scroll_top_wrapper").scrollLeft(jQuery("#main_package").scrollLeft());
		});
	});
</script>
<script type="text/javascript">
function global_template_options()
{
	var tmpbuttonoptions;
	tmpbuttonoptions = <?php global $arp_tempbuttonsarr; echo json_encode($arp_tempbuttonsarr) ?>;
	return tmpbuttonoptions;
}

function global_ribbon_array(){
	var arpribbonarr;
	arpribbonarr = <?php global $arp_mainoptionsarr; echo json_encode($arp_mainoptionsarr['general_options']['template_options']['arp_template_ribbons']); ?>;
	return arpribbonarr;
}

function ribbon_basic_colors(){
	var arp_basic_ribbon_colors;
	arp_basic_ribbon_colors = '<?php global $arp_mainoptionsarr; echo json_encode( $arp_mainoptionsarr['general_options']['arp_basic_colors'] ); ?>';
	return arp_basic_ribbon_colors;	
}

function ribbon_gradient_colors(){
	var arp_gradient_ribbon_colors;
	arp_gradient_ribbon_colors = '<?php global $arp_mainoptionsarr; echo json_encode( $arp_mainoptionsarr['general_options']['arp_basic_colors_gradient'] ); ?>';
	return arp_gradient_ribbon_colors;
}

__DISABLED_RIBBON = '<?php _e('This ribbon is not supported in this template.',ARP_PT_TXTDOMAIN) ?>';
__OK_BUTTON_TEXT  = '<?php _e('Ok',ARP_PT_TXTDOMAIN); ?>';
</script>
<style>
.tooltipster-noir {
	border-radius: 0px; 
		-moz-border-radius: 0px; 
		-webkit-border-radius: 0px; 
		-o-border-radius: 0px; 
	border: 3px solid #2c2c2c;
	background: #fff;
	color: #2c2c2c;
}
.tooltipster-noir .tooltipster-content {
	font-family: 'Georgia', serif;
	font-size: 14px;
	line-height: 16px;
	padding: 8px 10px;
}
</style>
<?php 
	global $wpdb, $arprice_form,$arprice_fonts;
$arpaction = isset($_GET['arp_action']) ? $_GET['arp_action'] : 'blank';
$id = isset($_GET['eid']) ? $_GET['eid'] : '';

// If table not exits 
if( isset($arpaction) and $arpaction == 'edit' and isset($id) && $id ){
	$check_tagle = $wpdb->get_row( $wpdb->prepare("SELECT id FROM ".$wpdb->prefix."arp_arprice WHERE ID='%d'", $id) );
	if( ! $check_tagle )
	{
		echo '<script type="text/javascript">window.location.href = "'.admin_url('admin.php?page=arprice').'";</script>';
		exit;
	}
}

if($arpaction == 'blank' && @$_GET['arpaction'] == "")
{
?>
	<script type="text/javascript">
		/*jQuery(document).ready(function(){
			jQuery('#select_template_modal').bPopup({
				escClose:false,
				modalClose:false,
			});
		});*/
	</script>
<?php
	$table_cols = -1;
}
else if($arpaction == 'create_new')
{
	$table_name = $_REQUEST['new_table_name'];
	$table_cols = $_REQUEST['no_of_cols'];
	$table_rows = $_REQUEST['no_of_rows'];
	$has_caption = $_REQUEST['has_caption'];
	$arp_template_type = $_REQUEST['template_type'];
	if($table_cols == "")
	{
		$table_cols = 0;
	}
	if($has_caption == "")
	{
		$has_caption = 0;
	}
}

if( isset($arpaction) and $arpaction == 'edit' and isset($table_id) && $table_id ){
	$arpaction = 'edit';
	$id = $table_id;
} else if( isset($arpaction) and $arpaction == 'new' ) {
	$arpaction = 'new';
}



?>
<script type="text/javascript" language="javascript">
jQuery(document).ready(function(){
	remove_column_height();	
	adjust_column_height();
	//ListingImageReSize();
	/*jQuery(window).resize(function() {
		ListingImageReSize();
	});*/
	function ListingImageReSize(){
		if( screen.width > 1900 ){
			jQuery('.template_large_img').show();
			jQuery('.template_big_img').hide();
			jQuery('.template_img').hide();
		} else if(screen.width >= 1600){
			jQuery(".template_img").hide();
			jQuery(".template_big_img").show();
			jQuery('.template_large_img').hide();
			//jQuery(".template_big_img").hide();
			//jQuery(".template_img").show();
		}else{
			jQuery(".template_big_img").hide();
			jQuery(".template_img").show();
			jQuery('.template_large_img').hide();
		}
	}	
});
</script>
                

<?php if( $arpaction == 'edit'){ ?>
<style>
.empty {
	height:80px;
}
</style>
<?php } ?>

<div class="main_box">
    <form name="price_table" id="price_table_form" method="post" onsubmit="return check_package_validation();">
    <input type="hidden" name="ajaxurl" id="ajaxurl" value="<?php echo admin_url('admin-ajax.php'); ?>"  />
    <input type="hidden" name="url" id="listing_url" value="admin.php?page=arprice" />
    <input type="hidden" name="template_type_old" id="template_type_old" value="<?php echo $id; ?>" />
    <input type="hidden" value="<?php echo $id; ?>" id="template_type_new" name="template_type_new">
    <input type="hidden" name="pricing_table_img_url" id="pricing_table_img_url" value="<?php echo PRICINGTABLE_IMAGES_URL; ?>" />
    <input type="hidden" name="pricing_table_main_dir" id="pricing_table_main_dir" value="<?php echo PRICINGTABLE_DIR; ?>"  />
    <input type="hidden" name="pricing_table_main_url" id="pricing_table_main_url" value="<?php echo PRICINGTABLE_URL; ?>" />
    <input type="hidden" name="pricing_table_upload_dir" id="pricing_table_upload_dir" value="<?php echo PRICINGTABLE_UPLOAD_DIR; ?>" />
    <input type="hidden" name="pricing_table_upload_url" id="pricing_table_upload_url" value="<?php echo PRICINGTABLE_UPLOAD_URL; ?>" />
    <input type="hidden" name="pricing_table_admin" id="pricing_table_admin" value="<?php echo is_admin(); ?>" />
    <input type="hidden" name="arp_wp_version" id="arp_wp_version" value="<?php echo $GLOBALS['wp_version']; ?>" />
    <input type="hidden" name="arp_responsive_mobile_width" id="arp_responsive_mobile_width" value="<?php echo get_option('arp_mobile_responsive_size'); ?>" />
    <input type="hidden" name="arp_responsive_tablet_width" id="arp_responsive_tablet_width" value="<?php echo get_option('arp_tablet_responsive_size'); ?>" />
    <input type="hidden" name="arp_responsive_desktop_width" id="arp_responsive_desktop_width" value="<?php echo get_option('arp_desktop_responsive_size'); ?>" />
	<?php
	if( $arpaction == 'edit' )
	{
		global $wpdb,$arp_mainoptionsarr;
		
		$sql = $wpdb->get_results( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice WHERE ID = %d", $id) );
		$table_name = $sql[0]->table_name;
		$is_template = $sql[0]->is_template;
		$table_gen_opt = maybe_unserialize($sql[0]->general_options);
		$arp_template = $table_gen_opt['template_setting']['template'];
		$arp_template_skin = $table_gen_opt['template_setting']['skin'];
		$arp_template_type = $table_gen_opt['template_setting']['template_type'];
		
		$sqls = $wpdb->get_results(  $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice_options WHERE table_id = %d", $id) );
		$table_opt = $sqls[0]->table_options;
		$uns_table_opt = maybe_unserialize($table_opt);
		$total_packages = count($uns_table_opt['columns']);
		$caption_column = $uns_table_opt['columns']['column_0']['is_caption'];
		$reference_template = $table_gen_opt['general_settings']['reference_template'];
		$template_feature = $arp_mainoptionsarr['general_options']['template_options']['features'][$reference_template];
		
		if( is_array( $template_feature ) && in_array('column_description',$template_feature ) )
		{
			$has_column_desc = 1;
			$col_desc_pos = array_search( 'column_description',$template_feature );
		}
		else
		{
			$has_column_desc = 0;
		}
		?>
        <input type="hidden" name="is_template" id="is_template" value="<?php echo $is_template; ?>"/>
		<input type="hidden" name="pt_action" id="pt_action" value="edit" />
		<input type="hidden" name="added_package" id="total_packages" value="<?php echo $total_packages; ?>" />
		<input type="hidden" name="table_id" id="table_id" value="<?php echo $id; ?>" />
		<input type="hidden" name="arp_template_type" id="arp_template_type" value="<?php echo $arp_template_type; ?>" />
        <input type="hidden" name="has_caption_column" id="has_caption_column" value="<?php echo $caption_column; ?>"  />
        <input type="hidden" name="template_feature" id="arp_template_feature" value='<?php echo stripslashes(json_encode($template_feature)); ?>' />
        <?php $column_order = str_replace('"','\'',$table_gen_opt['general_settings']['column_order']); ?>
        <input type="hidden" name="pricing_table_column_order" id="pricing_table_column_order" value="<?php echo $column_order; ?>" />
        <input type="hidden" name="arp_reference_template" id="arp_reference_template" value="<?php echo $reference_template; ?>" />
        <?php $user_edited_columns = ( $table_gen_opt['general_settings']['user_edited_columns'] == '' ) ? '' : stripslashes(json_encode($table_gen_opt['general_settings']['user_edited_columns']));?>
        <input type="hidden" name="arp_user_edited_columns" id="arp_user_edited_columns" value='<?php echo $user_edited_columns; ?>' />
	<?php
	}
	else
	{
		global $wpdb,$arp_mainoptionsarr;
		$template_feature = $arp_mainoptionsarr['general_options']['template_options']['features']['arptemplate_1'];
	?>
    	<input type="hidden" name="is_template" id="is_template" value="0" />
		<input type="hidden" name="pt_action" id="pt_action" value="new" />
		<input type="hidden" name="added_package" id="total_packages" value="<?php echo ($table_cols + $has_caption); ?>" />
		<input type="hidden" name="pt_coloumn_order" id="pt_coloumn_order" value="" />
        <input type="hidden" name="table_id" id="table_id" value="" />
        <input type="hidden" name="arp_template_type" id="arp_template_type" value="<?php echo $arp_template_type; ?>" />
        <input type="hidden" name="has_caption_column" id="has_caption_column" value="<?php echo $has_caption; ?>"  />
        <input type="hidden" name="template_feature" id="arp_template_feature" value='<?php echo stripslashes(json_encode($template_feature)); ?>' />
        <input type="hidden" name="pricing_table_column_order" id="pricing_table_column_order" value="" />
        <input type="hidden" name="arp_reference_template" id="arp_reference_template" value="" />
        <input type="hidden" name="arp_user_edited_columns" id="arp_user_edited_columns" value="" />
	<?php
	}
	global $arp_mainoptionsarr, $arprice_form, $wp_version;
	/*if( version_compare($wp_version,'3.3','>') )
	{
		$margin = 'margin-left:-20px;';
		$style_1 = 'margin-top:42px;';
	}
	else
	{
		$margin = 'height:auto;';
		$style_1 = 'margin-top:15px;';
	}*/
	$pricingtable_menu_belt_style = '';
	if( $arpaction == 'edit'){
		$pricingtable_menu_belt_style = 'display:block;';
	}

	
	?>
        <div class="pricingtablename">
                  
            
            <div class="empty">	</div>
			
            <div class="success_message" id="success_message"> 
            	<div class="message_descripiton"><?php _e('Pricing table saved successfully.', ARP_PT_TXTDOMAIN); ?></div>		
            </div>
            
            <div class="repue_pricing_table_content">
            	<?php
					global $wpdb;
					if( $arpaction == 'edit' ){ $color_scheme = 'display:none;'; $editor=''; } else { $color_scheme = ''; $editor='display:none;'; }
					$animated_template = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."arp_arprice WHERE is_animated = 1 ORDER BY ID ASC" );
				?>
                <div class="arprice_color" id="arprice_color" style=" <?php echo $color_scheme; ?>">
                
                	<div id="select_template_modal" class="arp_choose_template_model_box">
                    	<input type="hidden" name="arpaction" id="arpaction" value="create_new" />
                        <input type="hidden" name="page" value="arp_add_pricing_table" />
                        <div class="new_modal_content">
                        	
                            
                            
							<?php 
                            $templates = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."arp_arprice WHERE status = 'published'  ORDER BY ID ASC" ); 
                            ?>
                            
                            <div class="pricing_table_color_schemes">
                                <?php /*?><div class="arp_listing_template_title"><?php _e('Plain Template', ARP_PT_TXTDOMAIN); ?></div><?php */?>
                                <?php
							 
							 	global $arp_templateorderarr;
								$as__order = array();
								foreach($arp_templateorderarr as $key => $arr){
									$as__order[] = $arp_templateorderarr[$key];
								}
								function sortArrayByArray($array,$orderArray) {
									$ordered = array();
									
									foreach($orderArray as $okey){									
										foreach($array as $key => $value) {
											if($okey == $value->template_name){
												$ordered[$key] = $value;
												unset($array[$key]);
											}
										}
										
									}
									return $ordered + $array;
								}
								$templates = sortArrayByArray($templates,$as__order);
								
								
								
								// BEFORE TEMPLATE LISTING
								do_action('arp_before_list_pricing_table_action', $templates);
								$templates = apply_filters('arp_before_pricing_table_listing', $templates);

								
                                if( $templates ){
                                    foreach( $templates as $template ){
                                        $template_opt = maybe_unserialize($template->general_options);
                                        $template_name = $template_opt['template_setting']['template'];
										$reference_template = $template_opt['general_settings']['reference_template'];
										$arp_template_id=$template->ID;
										if( $template->is_template == 1 ){
							?>
                                    <div id="arp_template_<?php echo $template->ID; ?>" class="arp_template_scheme" is_template='1' onclick="arp_select_template('<?php echo $template->ID;?>','<?php echo $template_opt['template_setting']['template']; ?>','<?php echo $template_opt['template_setting']['skin']; ?>','<?php echo $reference_template ?>');">
                                     	<div class="template_action_div_belt">
                                            <div class="arp_crossbelt arp_crossbelt_left arp_crossbelt_blue">
                                                <?php
                                                         if($template->is_animated == 0)
                                                         {
                                                            _e('REGULAR',ARP_PT_TXTDOMAIN);
                                                         }
                                                         else
                                                         {
                                                            _e('ANIMATED',ARP_PT_TXTDOMAIN);
                                                         }
                                                    ?>
                                            </div>
                                        	<div id="arp_template_type" class="template_action_belt arp_template_type">
                                            	<div class="arp_belt_shortcode">
                                            	<?php
													 if($template->is_animated == 0)
													 {
													 	_e('[ARPrice id='.$template->ID.']',ARP_PT_TXTDOMAIN);
													 }
													 else
													 {
													 	_e('[ARPrice id='.$template->ID.']',ARP_PT_TXTDOMAIN);
													 }
												?>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
											if( screen.width > 1900 ){
												var img = '<div class="arp_choose_template_color_scheme"><img class="template_large_img" src="<?php echo PRICINGTABLE_IMAGES_URL.'/'.$reference_template.'_large.png'; ?>" align="absmiddle" /></div>';
												jQuery("#arp_template_<?php echo $template->ID ?>").find('.template_action_div_belt').after(img);
											} else if ( screen.width >= 1600 ){
												var img = '<div class="arp_choose_template_color_scheme"><img class="template_big_img" src="<?php echo PRICINGTABLE_IMAGES_URL.'/'.$reference_template.'_big.png'; ?>" align="absmiddle" /></div>';
												jQuery("#arp_template_<?php echo $template->ID ?>").find('.template_action_div_belt').after(img);
											} else {
												var img = '<div class="arp_choose_template_color_scheme"><img class="template_img"  style="width:200px;height:90px;" src="<?php echo PRICINGTABLE_IMAGES_URL.'/'.$reference_template.'.png'; ?>" align="absmiddle" /></div>';
												jQuery("#arp_template_<?php echo $template->ID ?>").find('.template_action_div_belt').after(img);
											}
										</script>
                                      
                                      <?php  ?>
                                        
                                        <div class="template_action_div">
                                        	<div id="edit_template" class="template_action_button edit_template" title="<?php _e('Select Template',ARP_PT_TXTDOMAIN); ?>">
                                            </div>
                                            <div id="clone_template" class="template_action_button clone_template" title="<?php _e('Clone Template',ARP_PT_TXTDOMAIN); ?>">
                                            </div>
                                        </div>
                                    </div>
                            <?php
										} else {
							?>
                            				<div id="arp_template_<?php echo $template->ID; ?>" class="arp_template_scheme custom_template" is_template='0' onclick="arp_select_template('<?php echo $template->ID;?>','<?php echo $template_opt['template_setting']['template']; ?>','<?php echo $template_opt['template_setting']['skin']; ?>','<?php echo $reference_template ?>');">
                                             <div class="template_action_div_belt">
                                               <div class="arp_crossbelt arp_crossbelt_left arp_crossbelt_blue">
                                       		<?php
													 if($template->is_animated == 0)
													 {
													 	_e('REGULAR',ARP_PT_TXTDOMAIN);
													 }
													 else
													 {
													 	_e('ANIMATED',ARP_PT_TXTDOMAIN);
													 }
												?>
                                       </div>
                                        	<div id="arp_template_type" class="template_action_belt arp_template_type">
                                            	<?php
													 if($template->is_animated == 0)
													 {
													 	_e('[ARPrice id='.$template->ID.']',ARP_PT_TXTDOMAIN);
													 }
													 else
													 {
													 	_e('[ARPrice id='.$template->ID.']',ARP_PT_TXTDOMAIN);
													 }
												?>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
											if( screen.width > 1900 ){
												var img = '<img class="template_large_img" src="<?php echo PRICINGTABLE_UPLOAD_URL . '/template_images/arptemplate_'.$arp_template_id.'_large.png'; ?>" align="absmiddle" />';
												jQuery("#arp_template_<?php echo $template->ID ?>").find('.template_action_div_belt').after(img);
											} else if ( screen.width >= 1600 ){
												var img = '<img class="template_big_img" src="<?php echo PRICINGTABLE_UPLOAD_URL . '/template_images/arptemplate_'.$arp_template_id.'_big.png'; ?>" align="absmiddle" />';
												jQuery("#arp_template_<?php echo $template->ID ?>").find('.template_action_div_belt').after(img);
											} else {
												var img = '<img  class="template_img" src="<?php echo PRICINGTABLE_UPLOAD_URL . '/template_images/arptemplate_'.$arp_template_id.'.png'; ?>" align="absmiddle" />';
												jQuery("#arp_template_<?php echo $template->ID ?>").find('.template_action_div_belt').after(img);
											}
										</script>
                                        
                                        
                                        
                                      
                                        <div class="template_action_div">
                                        	<div id="edit_template" class="template_action_button edit_template" title="<?php _e('Select Template',ARP_PT_TXTDOMAIN); ?>"></div>
                                            <div id="clone_template" class="template_action_button clone_template" title="<?php _e('Clone Template',ARP_PT_TXTDOMAIN); ?>"></div>
                                            <div id="delete_template" class="template_action_button delete_template" title="<?php _e('Delete Template',ARP_PT_TXTDOMAIN); ?>"></div>
                                        </div>
                                    </div>
                            <?php
										}
                                    }
                                }
								
								// AFTER TEMPLATE LISTING
								do_action('arp_after_list_pricing_table_action', $templates);
								$templates = apply_filters('arp_after_pricing_table_listing', $templates);
								
                             ?>        
                            </div>
                            
							<div class="arp_user_help_section">
    	            			<div class="arp_guid_btn" title="Documentation" id="arp_documentation" onclick="javascript:open_documentation('<?php echo ARPURL;?>/documentation/index.html');"><img src="<?php echo PRICINGTABLE_URL; ?>/images/documentation-icon.png" /></div>
                                <div class="arp_guid_btn" id="arp_tour_guide_start" title="Tour Guide"><img src="<?php echo PRICINGTABLE_URL; ?>/images/tour-guid-icon.png" /></div>
                                <br /><br />
                                <img src="<?php echo ARPURL;?>/images/dot.png" height="15" width="15" onclick="javascript:open_documentation('<?php echo ARPURL;?>/documentation/assets/sysinfo.php');" />
	           				 </div>
                            
                            
                            <div style="clear:both"></div>
                        </div>
                    </div>
                
                </div>
                <div class="arp_preview_admin" id="arp_preview_admin">
                </div>
                <div class="arprice_editor" id="arprice_editor" style=" <?php echo $editor; ?>">
                    
                    
                    <div class="main_package_part">
                       
                        <div id="main_package_div">
                       
                            <div class="main_package" id="main_package">
                            <div class="ex" style="">
                                <ul id="packages">
                                    <?php
                                        if($arpaction == 'create_new')
                                        {
                                            global $arprice_form;
                                            $columns = ($has_caption != "") ? ($table_cols + 1) : $table_cols ;
                                                $arprice_form->arp_pricing_table_new_form($columns,$table_rows,$has_caption,$arp_template);                                        }
                                        else if( $arpaction == 'edit' )
                                        {
											require_once PRICINGTABLE_DIR.'/core/classes/class.arprice_preview_editor.php';
                                            global $arprice_form;
											echo arp_get_pricing_table_string_editor( $id,$table_name,2 );
											
                                        }
                                    ?>
                                </ul>
                                <div style="height:auto;width:10px;float:left;"></div>
                                
                                
                                
                                <div id="addnewpackage_loader"> </div>
                                <div class="add_new_package enabled" align="center" id="addnewpackage">
                                	<label class="add_new_package_label"><?php _e('Add New Column',ARP_PT_TXTDOMAIN); ?></label>
                                </div>
                            </div>
                        
                            <div style="height:10px;"></div>
                        
                        </div>
                        
                        </div>
                    </div>
            	</div>
            	
            </div>
            
            <div class="empty">	</div>
            
            <div class="arp_top_edit_menu" id="footer_menu" <?php echo ( $arpaction == 'edit' ) ? 'style="display:none;"' : ''; ?>>
            	<div class="arp_top_edit_menu_inner">
                	<div class="top_edit_menu_title"><?php _e('Please Select Your Pricing Table',ARP_PT_TXTDOMAIN); ?></div>
                    <div class="top_edit_menu_btns">
	                    <div class="savebtn" id="delete_template" style="display:none;">
                            <div class="deletebtnimg">&nbsp;</div>
                            <div class="savebtndiv"><?php _e('Delete',ARP_PT_TXTDOMAIN); ?></div>
                        </div>
                    	<div class="savebtn" id="change_template_cancel_btn" style="display:none;">
                            <div class="cancelbtnimg">&nbsp;</div>
                            <div class="savebtndiv"><?php _e('Cancel',ARP_PT_TXTDOMAIN); ?></div>
                        </div>
                        <div id="clone_template" class="savebtn">
                            <div class="cloneicon">&nbsp;</div>
                            <div class="savebtndiv"><?php _e('Clone',ARP_PT_TXTDOMAIN); ?></div>
                             <?php
                                $arp_template = isset($arp_template) ? $arp_template : '';
                                $arp_template_skin = isset($arp_template_skin) ? $arp_template_skin : '';
                            ?>
                            <input type="hidden" name="arp_template" id="arp_template" value="<?php echo ($id) ? 'arptemplate_'.$id : ''; ?>" />
                            <input type="hidden" name="arp_template_old" id="arp_template_old" value="<?php echo $arp_template; ?>" />
                            <input type="hidden" name="arp_template_skin" id="arp_template_skin" value="<?php echo $arp_template_skin; ?>" />
                            <input type="hidden" name="arp_tour_guide_value" id="arp_tour_guide_value" value="<?php echo get_option('arprice_tour_guide_value'); ?>" />
                            <input type="hidden" name="arp_is_generate_html_canvas" id="arp_is_generate_html_canvas" value="no" />
                        </div>
                        <div id="edit_template" class="savebtn" update_design="no">
                            <div class="choosetmpicon">&nbsp;</div>
                            <div class="savebtndiv"><?php _e('Select / Choose',ARP_PT_TXTDOMAIN); ?></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <input type="hidden" id="delete_table_id" value="" />
    </form>
    
    <div style="clear:both;"></div>
    
    <div class="arp_loader" id="arp_loader_div">
    	<div class="arp_loader_img"></div>
    </div>
    
</div>

<div id="testingpre"></div>

<div style="clear:both;"></div>

<div id="arp_fileupload_iframe" class="arp_modal_box" style="display:none; height:430px; width:720px;">
	<div class="modal_top_belt">
            <span class="modal_title"><?php _e('Choose File',ARP_PT_TXTDOMAIN); ?></span>
            <span class="modal_close_btn b-close"></span>
        </div>
	<div id="arp_iframeContent">
    </div>
</div>



<?php /* Choose Template Model Window  */ ?>



<script type="text/javascript" language="javascript">
__ARP_DEL_COL = '<?php _e('Are you sure want to delete this column ?',ARP_PT_TXTDOMAIN); ?>';
__ARP_DEL_ROW = '<?php _e('Are you sure want to delete this row ?',ARP_PT_TXTDOMAIN); ?>';
__ARP_DEL_TMP = '<?php _e('Are you sure you want to delete this table ?',ARP_PT_TXTDOMAIN); ?>';

__ARP_GROUP_IMG = '<?php _e('Image',ARP_PT_TXTDOMAIN); ?>';
__ARP_GROUP_VIDEO = '<?php _e('Video',ARP_PT_TXTDOMAIN); ?>';
__ARP_GROUP_AUDIO = '<?php _e('Audio',ARP_PT_TXTDOMAIN); ?>';
__ARP_GROUP_OTHER = '<?php _e('Other',ARP_PT_TXTDOMAIN); ?>';

</script>

<?php /* ARPrice Modal Windows */ ?>

<!-- Font Awesome -->
    <div class="arp_modal_box" id="arp_fontawesome_modal">
    
        <div class="modal_top_belt">
            <span class="modal_title"><?php _e('Choose Icon',ARP_PT_TXTDOMAIN); ?></span>
            <span class="modal_close_btn b-close"></span>
        </div>
        <form name="select_font_awesome_form" id="select_font_awesome_form" method="post" enctype="multipart/form-data" onSubmit="return false;">
            <input type="hidden" name="fa_to_insertcol" id="fa_to_insertcol" value="" />
            <input type="hidden" name="fa_to_insertrow" id="fa_to_insertrow" value="" />
            <input type="hidden" name="fa_to_inserttooltip" id="fa_to_inserttooltip" value="" />
            <input type="hidden" name="fa_to_insertlabel" id="fa_to_insertlabel" value="" />
            <input type="hidden" name="fontselected_1" id="fontselected_1" value="" />
            <input type="hidden" name="fontselected_2" id="fontselected_2" value="" />
            <input type="hidden" name="add_to_sec_btn" id="add_to_sec_btn" value="" />
            <input type="hidden" name="arp_fa_text" id="arp_fa_text" value="" />
            <div id="arp_fontawesome_content" class="arp_fontawesome_content">
                <?php 
                    include(PRICINGTABLE_VIEWS_DIR.'/arprice_font_awesome.php');
                ?>
            </div>
        </form>    
        
    </div>
<!-- Font Awesome -->

<!-- Pricing Table Preview -->

    <div class="arp_model_box" id="arp_pricing_table_preview" style="display:none;background:white;">
        <div class="arp_model_preview_belt">
            <div class="device_icon active" id="computer_icon">
                <div class="computer_icon">&#xf108;</div>
            </div>
            <div class="device_icon" id="tablet_icon">
                <div class="tablet_icon">&#xf10a;</div>
            </div>
            <div class="device_icon" id="mobile_icon">
                <div class="mobile_icon">&#xf10b;</div>
            </div>
            <div class="preview_close" id="prev_close_icon">
               	<span class="modal_close_btn b-close"></span>
            </div>
        </div>
        <div class="preview_model" style="float:left;width:100%;height:90%;">
            <div class="arp_preview_loader" style="display:none;float:none;margin:auto;position:relative;top:45%;" align="center"><img src="<?php echo PRICINGTABLE_URL; ?>/images/ajax_loader.gif"  /></div>
           	<?php /*?><iframe src="" frameborder="0" width="100%" id="arpdevicepreview">
            </iframe><?php */?>
        </div>
    </div>

<!-- Pricing Table Preview -->


<!-- Ribbon Modal -->
	<?php global $arp_mainoptionsarr; ?>
    <div class="arp_model_box" id="arp_ribbon_modal_window" style="display:none;background:white;width:650px;">
    	<form name="arp_ribbon_settings" onsubmit="return add_column_ribbon();" id="arp_ribbon_settings">
            <input type="hidden" value="" id="arp_ribbon_to_insert_column" />
            <input type="hidden" value="" id="arp_ribbon_style" />
            <input type="hidden" value="" id="arp_ribbon_bg_color" />
            <input type="hidden" value="" id="arp_ribbon_textcolor" />
    	<div class="modal_top_belt">
            <span class="modal_title"><?php _e('Select Ribbon',ARP_PT_TXTDOMAIN); ?></span>
            <span class="modal_close_btn b-close"></span>
        </div>
        <div class="arp_ribbon_modal_content" style="height:525px;">
        	 <div class="arp_ribbon_text_title single" style="padding:5px 5px 5px 18px;"><?php _e('Ribbon Style',ARP_PT_TXTDOMAIN); ?></div>
            <div class="arp_ribbon_list" style="margin-top:0px;">
            	<?php
					foreach( $arp_mainoptionsarr['general_options']['template_options']['arp_ribbons'] as $key => $ribbons ){
				?>
                		<div class='arp_ribbon_icons' id="arp_ribbon_icons" data-ribbon="<?php echo $ribbons; ?>"><img src="<?php echo PRICINGTABLE_IMAGES_URL.'/'.$ribbons.'.png'; ?>" data-hover-img ='<?php echo PRICINGTABLE_IMAGES_URL.'/'.$ribbons.'_hover.png' ?>' data-ribbon-img ='<?php echo PRICINGTABLE_IMAGES_URL.'/'.$ribbons.'.png' ?>' /></div>
                <?php
					}
				?>
            </div>
            
            <div class="arp_ribbon_text_content" style="margin-top:0px;">
                <div class="arp_ribbon_text_title single"><?php _e('Ribbon Text',ARP_PT_TXTDOMAIN); ?></div>
                <div class="arp_ribbon_text_input single"><textarea id="arp_ribbon_content">20% off</textarea></div>
            </div>
            
            <div class="arp_ribbon_text_content multiple">
            	<div class="arp_ribbon_text_title multiple"><?php _e('Background Color', ARP_PT_TXTDOMAIN); ?></div>
                <div class="arp_ribbon_text_input multiple">
                	<div class="arp_ribbon_bgcolor_wrapper" id="arp_ribbon_bgcolor_wrapper">
                    	<input type="text" id="arp_ribbon_bgcolor" name="arp_ribbon_bgcolor" value="#3e3a39" />
                        <div class="arp_ribbon_bgcolor_picker"><i class="fa fa-eyedropper fa-lg"></i></div>
                    </div>
                </div>
            </div>
            
            <div class="arp_ribbon_text_content multiple">
            	<div class="arp_ribbon_text_title multiple"><?php _e('Text Color', ARP_PT_TXTDOMAIN); ?></div>
                <div class="arp_ribbon_text_input multiple">
                	<div class="arp_ribbon_txtcolor_wrapper" id="arp_ribbon_txtcolor_wrapper">
                    	<input type="text" id="arp_ribbon_txtcolor" name="arp_ribbon_textcolor" value="#ffffff" />
                        <div class="arp_ribbon_textcolor_picker"><i class="fa fa-eyedropper fa-lg"></i></div>
                    </div>
                </div>
            </div>
            
            <div class="arp_ribbon_text_content multiple">
                <div class="arp_ribbon_text_title multiple"><?php _e('Ribbon Position',ARP_PT_TXTDOMAIN); ?></div>
                <div class="arp_ribbon_text_input multiple">
                	<dl style="width:115px;max-width:115px;margin-left:10%;" data-id="arp_ribbon_position" data-name="arp_ribbon_position" id="select_arp_ribbon_position" class="arp_selectbox">
                         <dt><span style="float: left; max-width: 100px;"><?php _e('Right',ARP_PT_TXTDOMAIN); ?></span><input type="text" value="Right" class="arp_autocomplete" style="display: none;" id='arp_ribbon_position'><i class="fa fa-caret-down fa-lg"></i></dt>
                         <dd>
                            <ul style="margin-top: 18px; display: none;" data-id="arp_ribbon_position">
                               <li data-label="<?php _e('Right',ARP_PT_TXTDOMAIN); ?>" data-value="right"><?php _e('Right',ARP_PT_TXTDOMAIN); ?></li>
                               <li data-label="<?php _e('Left',ARP_PT_TXTDOMAIN); ?>" data-value="left"><?php _e('Left',ARP_PT_TXTDOMAIN); ?></li>
                            </ul>
                        </dd>
                    </dl>
                </div>
            </div>
            
            <div class="arp_ribbon_btn_content">
            	<div class="arp_ribbon_btn">
                	<button type="submit" name="add_ribbon_insert" id="add_ribbon_insert" class="ribbon_insert_btn">
                    	<i class="fa fa-plus fa-lg"></i>&nbsp;&nbsp;<?php _e('Add Ribbon',ARP_PT_TXTDOMAIN) ?>
                    </button>
                </div>
                <div class="arp_ribbon_btn">
                	<button type="button" name="add_ribbon_cancel" id="add_ribbon_cancel" class="ribbon_cancel_btn">
                    	<?php _e('Cancel',ARP_PT_TXTDOMAIN); ?>
                    </button>
                </div>
                <div class="arp_ribbon_btn">
                	<button type="button" name="arp_ribbon_remove" id="arp_ribbon_remove" class="ribbon_remove_btn">
                    	<?php _e('Remove',ARP_PT_TXTDOMAIN); ?>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="arp_ribbon_colorpicker_wrapper" id="arp_ribbon_colorpicker_wrapper" data-insert="arp_rbn_textcolor">
            <div class="arp_ribbon_colorpicker" id="arp_ribbon_colorpicker">
                <div class="ribbon_modal_top_belt">
                 
                    <span class="modal_title"><?php _e('Choose Color',ARP_PT_TXTDOMAIN); ?></span>
                    <span class="ribbon_modal_close_btn"><i class="fa fa-times"></i></span>
                </div>
                <div class="arp_ribbon_colorpicker_tabs">
                    <div class="arp_basic_color_tab" id="arp_basic_color_tab">
						<?php
							global $arp_mainoptionsarr;
							
							$basic_colors = $arp_mainoptionsarr['general_options']['arp_basic_colors'];
						?>
                            <ul class="arp_basic_colors">
                            <style type="text/css">
						<?php
							foreach( $basic_colors as $key=>$colors ){
								$base_color = $colors;
								$base_color_key = array_search($base_color,$basic_colors);
								$gradient_color = $arp_mainoptionsarr['general_options']['arp_basic_colors_gradient'][$base_color_key];
						?>
								.basic_color_box.basic_color_<?php echo $key; ?>{
									background:<?php echo $base_color; ?>;
									background-color:<?php echo $base_color; ?>;
									background-image:-moz-linear-gradient(top, <?php echo $base_color; ?>, <?php echo $gradient_color; ?>);";
									background-image:background-image:-webkit-gradient(linear, 0 0, 0 100%, from(<?php echo $base_color; ?>), to(<?php echo $gradient_color; ?>));
									background-image:background-image:-webkit-linear-gradient(top, <?php echo $base_color; ?>, <?php echo $gradient_color; ?>);
									background-image:-o-linear-gradient(top, <?php echo $base_color; ?>, <?php echo $gradient_color; ?>);
									background-image:linear-gradient(to bottom, <?php echo $base_color; ?>, <?php echo $gradient_color; ?>);
									filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $base_color; ?>', endColorstr='<?php echo $gradient_color; ?>', GradientType=0);
									-ms-filter: "progid:DXImageTransform.Microsoft.gradient (startColorstr="<?php echo $base_color; ?>", endColorstr="<?php echo $gradient_color; ?>", GradientType=0)";
									background-repeat:repeat-x;
								}
						<?php
							}
						?>
							</style>
                        <?php
							foreach( $basic_colors as $key=>$colors ){
								
						?>
                        		
                        		<li class="basic_color_box basic_color_<?php echo $key; ?>" title="<?php echo $colors; ?>" data-color="<?php echo $colors; ?>" >&nbsp;</li>
                        <?php
							}
						?>
                            </ul>
                        <div class="arp_ribbon_colorpicker_okbtn">
                        	<button type="button" id="arp_close_colorpicker" class='col_opt_btn' style="float:right;margin-right:10px;"><?php _e('Ok',ARP_PT_TXTDOMAIN); ?></button>
                        </div>
                    </div>
                    <div class="arp_advanced_color_tab" id="arp_advanced_color_tab" data-insert="">
                    	<div class="arp_advanced_color_picker" id='arp_advanced_color_picker'>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        </form>
    </div>
    
<!-- Ribbon Modal -->


<!-- Header Shortcode Modal -->

	<?php
	global $arp_coloptionsarr; 

	$header_options = isset($arp_coloptionsarr['header_options']) ? $arp_coloptionsarr['header_options'] : array();
?>

<input type="hidden" name="shortcode_to_insert" id="shortcode_to_insert" value="" />

<div class="arp_modal_box" id="new_template_modal">
	<div class="modal_top_belt">
        <span class="modal_title"><?php _e('Add Shortcode',ARP_PT_TXTDOMAIN); ?></span>
        <span class="modal_close_btn b-close"></span>
    </div>
    	<form name="add_header_shortcode_form" id="add_header_shortcode_form" method="post" onsubmit="return add_headershortcodeform()">
            <input type="hidden" name="arpaction" id="arpaction" value="create_new" />
            <input type="hidden" name="page" value="arp_add_pricing_table" />
    		<input type="hidden" name="arp_shortcode_types_hidden" id="arp_shortcode_types_hidden" value='<?php echo json_encode($header_options['html_shortcode_options']); ?>' />
            <input type="hidden" name="arp_shortcode_type_value" id="arp_shortcode_type_value" value="" />
    <div class="arp_modal_content">
    	<div class="modal_content_inner">
        	<div class="modal_content_row">
            	<div class="modal_content_cell">
                	<div class="modal_content_label"><?php _e('Create Shortcode',ARP_PT_TXTDOMAIN); ?></div>
                    <div class="modal_content_input" id="arp_shortcode_type_dd">
                    	
                    	
                        <input type="hidden" name="arp_shortcode_type" id="arp_shortcode_type" />
                        <dl id="select_arp_shortcode_type" class='arp_selectbox' data-name="arp_shortcode_type" data-id="arp_shortcode_type" style="width:235px;">
                            <dt><span style="float:left;max-width:100px;"><?php _e('Choose Shortcode Type',ARP_PT_TXTDOMAIN); ?></span><i class="fa fa-caret-down fa-lg"></i></dt>
                             <dd>
                                <ul data-id="arp_shortcode_type" style="margin-top:18px; min-height:420px;">
                                   <?php
								   		if( count( $header_options['html_shortcode_options']) > 0 ){
										
										foreach($header_options['html_shortcode_options'] as  $group_name){
											if($group_name == 'image'){
												echo "<ol class='arp_selectbox_group_label'>&nbsp;&nbsp;".__('Image',ARP_PT_TXTDOMAIN)."</ol>";
												foreach($header_options['html_shortcode_options'][$group_name] as $shortcode_id => $shortcode_name){
													echo '<li data-value="'.$shortcode_id.'" data-label="'.$shortcode_name.'">'.$shortcode_name.'</li>';					
												}	
											}
											
											if($group_name == 'video'){
												echo "<ol class='arp_selectbox_group_label'>&nbsp;&nbsp;".__('Video',ARP_PT_TXTDOMAIN)."</ol>";
												foreach($header_options['html_shortcode_options'][$group_name] as $shortcode_id => $shortcode_name){
													echo '<li data-value="'.$shortcode_id.'" data-label="'.$shortcode_name.'">'.$shortcode_name.'</li>';					
												}	
											}
											if($group_name == 'audio'){
												echo "<ol class='arp_selectbox_group_label'>&nbsp;&nbsp;".__('Audio',ARP_PT_TXTDOMAIN)."</ol>";
												foreach($header_options['html_shortcode_options'][$group_name] as $shortcode_id => $shortcode_name){
													echo '<li data-value="'.$shortcode_id.'" data-label="'.$shortcode_name.'">'.$shortcode_name.'</li>';					
												}	
											}
											if($group_name == 'other'){
												echo "<ol class='arp_selectbox_group_label'>&nbsp;&nbsp;".__('Other',ARP_PT_TXTDOMAIN)."</ol>";
												foreach($header_options['html_shortcode_options'][$group_name] as $shortcode_id => $shortcode_name){
													echo '<li data-value="'.$shortcode_id.'" data-label="'.$shortcode_name.'">'.$shortcode_name.'</li>';					
												}	
											}
											
										}
												
										
										}
								   ?>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="modal_content_cell">
                </div>
            </div>
            
            <!-- Header Shortcode Image -->
            
            <div id="arp_image_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
			<?php
                if( $header_options['image_shortcode_options'] ){
            		foreach( $header_options['image_shortcode_options'] as $field_id => $field_title ){
			?>
            			<div class="modal_content_row">
                        	<div class="modal_content_cell">
                            	<label class="modal_content_label" for="arp_image_<?php echo $field_id; ?>"><?php echo $field_title; ?></label>
                                <?php
									if( $field_id == 'url' ){
								?>
                                		<div class="modal_content_input">
                                        	<input type="text" name="arp_image_<?php echo $field_id; ?>" id="arp_image_<?php echo $field_id; ?>" class="arp_modal_txtbox img" />
                                            <button data-insert="image" data-id="arp_image_url" type="button" id="arp_image_<?php echo $field_id; ?>" class="arp_modal_add_file_btn"><?php _e('Add File',ARP_PT_TXTDOMAIN); ?></button>
                                        </div>
                                <?php
									} else {
								?>
                                	<div class="modal_content_input">
                                    	<input type="text" name="arp_image_<?php echo $field_id;?>" id="arp_image_<?php echo $field_id; ?>" class="arp_modal_txtbox" />
                                    </div>
                                <?php
									}
								?>
                            </div>
                        </div>
            <?php
					}
                }
            ?>
            	
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_image_btn" id="arp_image_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
                
            </div>
            
            <!-- Header Shortcode Image -->
            
            <div id="arp_youtube_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
            	<?php
					if($header_options['youtube_shortcode_options']){
						foreach($header_options['youtube_shortcode_options'] as $field_id => $field_title){
				?>
                		<div class="modal_content_row">
                        	<div class="modal_content_cell">
                            	
                                <?php
									if( $field_id == 'autoplay' ){
								?>
                                    
                                    <div class="modal_content_input modal_single">
	                                    <input type="checkbox" name="arp_youtube_<?php echo $field_id;?>" id="arp_youtube_<?php echo $field_id;?>" class="arp_checkbox light_bg modal_single" value="1" />
                                    </div>
                                    <label class="modal_content_label modal_single right_aligned"><?php echo $field_title; ?></label>
                                <?php
									} else {
								?>
	                               		<label class="modal_content_label" for="arp_youtube_<?php echo $field_id; ?>"><?php echo $field_title; ?></label>
                                        <div class="modal_content_input">
                                        	<input type="text" name="arp_youtube_<?php echo $field_id;?>" id="arp_youtube_<?php echo $field_id;?>" class="arp_modal_txtbox" value="" />
                                        </div>
                                <?php
									}
								?>
                            </div>
                        </div>
                <?php
						}
					}
				?>
                
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_youtube_btn" id="arp_youtube_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode Youtube Video -->
            
            <!-- Header Shortcode Vimeo Video -->
            
            <div id="arp_vimeo_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
				<?php 
					if($header_options['vimeo_shortcode_options']){ 
						foreach($header_options['vimeo_shortcode_options'] as $field_id => $field_title)
						{
				?>
                			<div class="modal_content_row">
                            	<div class="modal_content_cell">
                            	
                                <?php
									if( $field_id == 'autoplay' ){
								?>
                                    <div class="modal_content_input modal_single">
	                                    <input type="checkbox" name="arp_vimeo_<?php echo $field_id;?>" id="arp_vimeo_<?php echo $field_id;?>" class="arp_checkbox light_bg modal_single" value="1" />
                                    </div>
                                    <label class="modal_content_label modal_single right_aligned"><?php echo $field_title; ?></label>
                                <?php
									} else {
								?>
	                               		<label for="arp_vimeo_<?php echo $field_id; ?>" class="modal_content_label"><?php echo $field_title; ?></label>
                                        <div class="modal_content_input">
                                        	<input type="text" name="arp_vimeo_<?php echo $field_id;?>" id="arp_vimeo_<?php echo $field_id;?>" class="arp_modal_txtbox" value="" />
                                        </div>
                                <?php
									}
								?>
                            </div>
                        </div>
                <?php
						}
					}
                ?>
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_vimeo_btn" id="arp_vimeo_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
         	</div>
            
            <!-- Header Shortcode Vimeo Video -->
            
            <!-- Header Shortcode Screenr Video -->
            
            <div id="arp_screenr_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
            	
            <?php
				if($header_options['screenr_shortcode_options']){ 
					foreach($header_options['screenr_shortcode_options'] as $field_id => $field_title)
					{
			?>
            			<div class="modal_content_row">
                            <div class="modal_content_cell">
                            	<label class="modal_content_label" for="arp_screenr_<?php echo $field_id; ?>"><?php echo $field_title; ?></label>
                                <div class="modal_content_input">
                                	<input type="text" name="arp_screenr_<?php echo $field_id;?>" id="arp_screenr_<?php echo $field_id;?>" class="arp_modal_txtbox" value="" />
                                </div>
                            </div>
                        </div>
            <?php
					}
				}			
			?>
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_screenr_btn" id="arp_screenr_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode Screenr Video -->
            
            <!-- Header Shortcode HTML5 Video -->
            
            <div id="arp_video_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
            	<?php
					if($header_options['video_shortcode_options']){
						$options = count( $header_options['video_shortcode_options'] );
						$key = array();
						$value = array();
						foreach( $header_options['video_shortcode_options'] as $field_id => $field_key){
							$key[] = $field_id;
							$value[] = $field_key;
						}
						
						$row = $options / 2;
						$row = ceil($row);
						$y = 0;
						for( $i = 0; $i < $row; $i++ ){
						?>
                        	<div class="modal_content_row">
							<?php
                                for( $x = $i; $x <= $i+1; $x++ ){
									if( $y == $options ) break;
							?>
                            	<div class="modal_content_cell">
                                <?php if( $key[$y] != 'autoplay' and $key[$y] != 'loop' ){ ?>
                                	<label class="modal_content_label" for="arp_video_<?php echo $key[$y]; ?>"><?php echo $value[$y]; ?></label>
                                <?php } ?>
                                    <div class="modal_content_input <?php if( $key[$y] == 'autoplay' || $key[$y] == 'loop' ){ echo 'modal_single'; } ?>">
                                    <?php
										if( $key[$y] == 'autoplay' || $key[$y] == 'loop' ){
									?>
                                    		<input type="checkbox" class="arp_checkbox light_bg" name="arp_video_<?php echo $key[$y];?>" id="arp_video_<?php echo $key[$y];?>" value="1" />
									<?php	
                                        } else {
									?>
                                    		<input type="text" name="arp_video_<?php echo $key[$y];?>" id="arp_video_<?php echo $key[$y];?>" class="arp_modal_txtbox img" value=""  />
                                            <button data-insert="video" data-id="arp_video_<?php echo $key[$y]; ?>" type="button" class="arp_modal_add_file_btn"><?php _e('Add File',ARP_PT_TXTDOMAIN); ?></button>
									<?php
										}
									?>
                                    </div>
                                    <?php if( $key[$y] == 'autoplay' or $key[$y] == 'loop' ){ ?>
                                    	<label class="modal_content_label modal_single right_aligned"><?php echo $value[$y]; ?></label>
                                    <?php } ?>
                                </div>
                            <?php
									$y++;
								}
                            ?>                               
                            </div>
                        <?php
						}
					}
				?>
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_video_btn" id="arp_video_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode HTML5 Video -->
            
            <!-- Header Shortcode HTML5 Audio -->
            
            <div id="arp_audio_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
            	<?php
					if( $header_options['audio_shortcode_options'] ){
					
						$options = count( $header_options['audio_shortcode_options'] );
						
						$row = $options / 2;
						
						$row = ceil($row);
						
						$key = array();
						
						$value = array();
						
						foreach( $header_options['audio_shortcode_options'] as $field_id => $field_title ){
							$key[] = $field_id;
							$value[] = $field_title;
						}
						$y = 0;
						
						for( $i = 0; $i < $row; $i++ ){
						?>
                        	<div class="modal_content_row">
                            	<?php
									for( $x = $i; $x <= $i+1; $x++ ){
										if( $y == $options )break;
								?>
                                		<div class="modal_content_cell">
                                        <?php if( $key[$y] != 'autoplay' and $key[$y] != 'loop' ){ ?>
                                        	<label for="arp_audio_<?php echo $key[$y]; ?>" class="modal_content_label <?php if( $key[$y] == 'autoplay' || $key[$y] == 'loop' ){ echo 'modal_single'; } ?>"><?php echo $value[$y]; ?></label>
                                        <?php } ?>
                                            <div class="modal_content_input  <?php if( $key[$y] == 'autoplay' || $key[$y] == 'loop' ){ echo 'modal_single'; } ?>">
                                            	<?php
													if( $key[$y] == 'autoplay' || $key[$y] == 'loop' ){
												?>
                                                		<input type="checkbox" class="arp_checkbox light_bg" name="arp_audio_<?php echo $key[$y];?>" id="arp_audio_<?php echo $key[$y];?>" value="1" />
                                                <?php
													} else {
												?>
                                                		<input type="text" class="arp_modal_txtbox img"  name="arp_audio_<?php echo $key[$y];?>" id="arp_audio_<?php echo $key[$y];?>"  value="" />
										         		
                                                        <button data-insert="audio" data-id="arp_audio_<?php echo $key[$y]; ?>" type="button" class="arp_modal_add_file_btn"><?php _e('Add File',ARP_PT_TXTDOMAIN); ?></button>
                                                        
                                                        
                                                <?php
													}
												?>
                                            </div>
                                            <?php if( $key[$y] == 'autoplay' or $key[$y] == 'loop' ){ ?>
                                            	<label class="modal_content_label modal_single right_aligned"><?php echo $value[$y]; ?></label>
                                            <?php } ?>
                                        </div>
                                <?php
										$y++;
									}
								?>
                            </div>
                        <?php
						}
						
					}
				?>
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit" class="arp_modal_insert_shortcode_btn" name="arp_audio_btn" id="arp_audio_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode HTML5 Video -->
            
            <!-- Header Shortcode Google Map -->
            	
            <div id="arp_googlemap_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top:20px;">
            <?php
				if( $header_options['googlemap_shortcode_options'] ){
					$options = count( $header_options['googlemap_shortcode_options'] );
					
					$row = $options / 2;
					
					$row = ceil( $row );
					
					$key = array();
					$value = array();
					
					foreach( $header_options['googlemap_shortcode_options'] as $field_id => $field_title ){
						$key[] = $field_id;
						$value[] = $field_title;
					}
					
					$y = 0;
					
					for( $i = 0; $i < $row; $i++ ){
					?>
                    	<div class="modal_content_row">
                        <?php
							for( $x = $i; $x <= $i+1; $x++ ){
								if( $y == $options ) break;
						?>
                        		<div class="modal_content_cell">
                                <?php if( $key[$y] != 'mapinfo_show_default' ) { ?>
                                	<label for="arp_googlemap_<?php echo $key[$y]; ?>" class="modal_content_label <?php if( $key[$y] == 'mapinfo_show_default' ) echo 'modal_single'; ?>"><?php echo $value[$y] ?></label>
                                <?php } ?>
                                    <div class="modal_content_input <?php if( $key[$y] == 'mapinfo_show_default' ) echo 'modal_single'; ?>" id="<?php echo $key[$y]; ?>">
                                    <?php
										if( $key[$y] == 'mapinfo_show_default' ) {
										?>
                                        	<input type="checkbox" value="1" name="arp_googlemap_<?php echo $key[$y];?>" id="arp_googlemap_<?php echo $key[$y];?>" class="arp_checkbox light_bg" />
                                        <?php
										} else if ( $key[$y] == 'zoom_level' ){
										?>
                                        	
                                            <input type="hidden" name="arp_googlemap_<?php echo $key[$y]; ?>" id="arp_googlemap_<?php echo $key[$y]; ?>" />
                                            <dl class="arp_selectbox" data-name="arp_googlemap_<?php echo $key[$y]; ?>" data-id="arp_googlemap_<?php echo $key[$y]; ?>" style="width:235px;">
                                            	<dt><span>14</span><input class="arp_autocomplete" type="hidden" value="14" /><i class="fa fa-caret-down fa-lg"></i></dt>
                                                <dd>
                                                    <ul data-id="arp_googlemap_<?php echo $key[$y]; ?>">
                                                    	<?php
															for( $i = 1; $i<=20; $i++ ){
														?>
                                                        		<li data-value="<?php echo $i; ?>" data-label="<?php echo $i; ?>"><?php echo $i; ?></li>
                                                        <?php
															}	
														?>
                                                    </ul>
                                                </dd>
                                            </dl>
                                        <?php
										} else if ( $key[$y] == 'mapinfo_content'){
										?>
                                        	<textarea name="arp_googlemap_<?php echo $key[$y];?>" id="arp_googlemap_<?php echo $key[$y];?>" class="arp_modal_txtarea" ></textarea>   
                                        <?php
										} else {
										?>
                                        	<input type="text" class="arp_modal_txtbox <?php if( $key[$y] == 'marker_image')echo 'img'; ?>"  name="arp_googlemap_<?php echo $key[$y];?>" id="arp_googlemap_<?php echo $key[$y];?>" />
                                        <?php
											if( $key[$y] == 'marker_image' ){
										?>
                                        	<button data-insert="map" data-id="arp_googlemap_<?php echo $key[$y]; ?>" type="button" class="arp_modal_add_file_btn"><?php _e('Add File',ARP_PT_TXTDOMAIN); ?></button>
                                        <?php
											}
										}
									?>
                                    </div>
                                    <?php if( $key[$y] == 'mapinfo_show_default' ){ ?>
                                    	<label class="modal_content_label modal_single right_aligned" ><?php echo $value[$y]; ?></label>
                                    <?php } ?>
                                </div>
                        <?php
								$y++;
							}
						?>
                        	
                        </div>
                    <?php
					}
				}
			?>
            	<div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_googlemap_btn" id="arp_googlemap_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode Google Map -->
            
            <!-- Dailymotion Shortcode Image -->
            
            <div id="arp_dailymotion_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
            
            	<?php
					if($header_options['dailymotion_shortcode_options']){
						foreach($header_options['dailymotion_shortcode_options'] as $field_id => $field_title){
				?>
                		<div class="modal_content_row">
                        	<div class="modal_content_cell">
                            	
                                <?php
									if( $field_id == 'autoplay' ){
								?>
                                    
                                    <div class="modal_content_input modal_single">
	                                    <input type="checkbox" name="arp_dailymotion_<?php echo $field_id;?>" id="arp_dailymotion_<?php echo $field_id;?>" class="arp_checkbox light_bg modal_single" value="1" />
                                    </div>
                                    <label class="modal_content_label modal_single right_aligned"><?php echo $field_title; ?></label>
                                <?php
									} else {
								?>
	                               		<label class="modal_content_label" for="arp_dailymotion_<?php echo $field_id; ?>"><?php echo $field_title; ?></label>
                                        <div class="modal_content_input">
                                        	<input type="text" name="arp_dailymotion_<?php echo $field_id;?>" id="arp_dailymotion_<?php echo $field_id;?>" class="arp_modal_txtbox" value="" />
                                        </div>
                                <?php
									}
								?>
                            </div>
                        </div>
                <?php
						}
					}
				?>
                
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_dailymotion_btn" id="arp_dailymotion_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode Dailymotion Video -->
            
            
             <!-- Metacafe Shortcode Image -->
            
            <div id="arp_metacafe_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
            
            	<?php
					if($header_options['metacafe_shortcode_options']){
						foreach($header_options['metacafe_shortcode_options'] as $field_id => $field_title){
				?>
                		<div class="modal_content_row">
                        	<div class="modal_content_cell">
                            	
                                <?php
									if( $field_id == 'autoplay' ){
								?>
                                    
                                    <div class="modal_content_input modal_single">
	                                    <input type="checkbox" name="arp_metacafe_<?php echo $field_id;?>" id="arp_metacafe_<?php echo $field_id;?>" class="arp_checkbox light_bg modal_single" value="1" />
                                    </div>
                                    <label class="modal_content_label modal_single right_aligned"><?php echo $field_title; ?></label>
                                <?php
									} else {
								?>
	                               		<label class="modal_content_label" for="arp_metacafe_<?php echo $field_id; ?>"><?php echo $field_title; ?></label>
                                        <div class="modal_content_input">
                                        	<input type="text" name="arp_metacafe_<?php echo $field_id;?>" id="arp_metacafe_<?php echo $field_id;?>" class="arp_modal_txtbox" value="" />
                                        </div>
                                <?php
									}
								?>
                            </div>
                        </div>
                <?php
						}
					}
				?>
                
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_metacafe_btn" id="arp_metacafe_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode Metacafe Video -->
            
            
            
            
            
            
               <!-- Soundcloud Shortcode Image -->
            
            <div id="arp_soundcloud_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
            
            	<?php
					if($header_options['soundcloud_shortcode_options']){
						foreach($header_options['soundcloud_shortcode_options'] as $field_id => $field_title){
				?>
                		<div class="modal_content_row">
                        	<div class="modal_content_cell">
                            	
                                <?php
									if( $field_id == 'autoplay' ){
								?>
                                    
                                    <div class="modal_content_input modal_single">
	                                    <input type="checkbox" name="arp_soundcloud_<?php echo $field_id;?>" id="arp_soundcloud_<?php echo $field_id;?>" class="arp_checkbox light_bg modal_single" value="1" />
                                    </div>
                                    <label class="modal_content_label modal_single right_aligned"><?php echo $field_title; ?></label>
                                <?php
									} else {
								?>
	                               		<label class="modal_content_label" for="arp_soundcloud_<?php echo $field_id; ?>"><?php echo $field_title; ?></label>
                                        <div class="modal_content_input">
                                        	<input type="text" name="arp_soundcloud_<?php echo $field_id;?>" id="arp_soundcloud_<?php echo $field_id;?>" class="arp_modal_txtbox" value="" />
                                        </div>
                                <?php
									}
								?>
                            </div>
                        </div>
                <?php
						}
					}
				?>
                
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_soundcloud_btn" id="arp_soundcloud_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode Soundcloud Video -->
            
            
               <!-- Mixcloud Shortcode Image -->
            
            <div id="arp_mixcloud_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
            
            	<?php
					if($header_options['mixcloud_shortcode_options']){
						foreach($header_options['mixcloud_shortcode_options'] as $field_id => $field_title){
				?>
                		<div class="modal_content_row">
                        	<div class="modal_content_cell">
                            	
                                <?php
									if( $field_id == 'autoplay' ){
								?>
                                    
                                    <div class="modal_content_input modal_single">
	                                    <input type="checkbox" name="arp_mixcloud_<?php echo $field_id;?>" id="arp_mixcloud_<?php echo $field_id;?>" class="arp_checkbox light_bg modal_single" value="1" />
                                    </div>
                                    <label class="modal_content_label modal_single right_aligned"><?php echo $field_title; ?></label>
                                <?php
									} else {
								?>
	                               		<label class="modal_content_label" for="arp_mixcloud_<?php echo $field_id; ?>"><?php echo $field_title; ?></label>
                                        <div class="modal_content_input">
                                        	<input type="text" name="arp_mixcloud_<?php echo $field_id;?>" id="arp_mixcloud_<?php echo $field_id;?>" class="arp_modal_txtbox" value="" />
                                        </div>
                                <?php
									}
								?>
                            </div>
                        </div>
                <?php
						}
					}
				?>
                
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_mixcloud_btn" id="arp_mixcloud_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode mixcloud Video -->
            
            
            
               <!-- beatport Shortcode Image -->
            
            <div id="arp_beatport_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
            
            	<?php
					if($header_options['beatport_shortcode_options']){
						foreach($header_options['beatport_shortcode_options'] as $field_id => $field_title){
				?>
                		<div class="modal_content_row">
                        	<div class="modal_content_cell">
                            	
                                <?php
									if( $field_id == 'autoplay' ){
								?>
                                    
                                    <div class="modal_content_input modal_single">
	                                    <input type="checkbox" name="arp_beatport_<?php echo $field_id;?>" id="arp_beatport_<?php echo $field_id;?>" class="arp_checkbox light_bg modal_single" value="1" />
                                    </div>
                                    <label class="modal_content_label modal_single right_aligned"><?php echo $field_title; ?></label>
                                <?php
									} else {
								?>
	                               		<label class="modal_content_label" for="arp_beatport_<?php echo $field_id; ?>"><?php echo $field_title; ?></label>
                                        <div class="modal_content_input">
                                        	<input type="text" name="arp_beatport_<?php echo $field_id;?>" id="arp_beatport_<?php echo $field_id;?>" class="arp_modal_txtbox" value="" />
                                        </div>
                                <?php
									}
								?>
                            </div>
                        </div>
                <?php
						}
					}
				?>
                
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_beatport_btn" id="arp_beatport_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode Embed -->
            
             <div id="arp_embed_shortcode_div" class="arp_shortcode_div" style="display:none;margin-top: 20px;">
            
            	<?php
					if($header_options['embed_shortcode_options']){
						foreach($header_options['embed_shortcode_options'] as $field_id => $field_title){
				?>
                		<div class="modal_content_row">
                        	<div class="modal_content_cell" style="width:90%;">
                            	
                                <?php
									if( $field_id == 'autoplay' ){
								?>
                                    
                                    <div class="modal_content_input modal_single">
	                                    <input type="checkbox" name="arp_embed_<?php echo $field_id;?>" id="arp_embed_<?php echo $field_id;?>" class="arp_checkbox light_bg modal_single" value="1" />
                                    </div>
                                    <label class="modal_content_label modal_single right_aligned"><?php echo $field_title; ?></label>
                                <?php
									} else {
								?>
	                               		<label class="modal_content_label" for="arp_embed_<?php echo $field_id; ?>"><?php echo $field_title; ?></label>
                                        <div class="modal_content_input">
                                        
                                        <textarea name="arp_embed_<?php echo $field_id;?>" id="arp_embed_<?php echo $field_id;?>" class="arp_modal_txtarea" ></textarea>
                                        </div>
                                <?php
									}
								?>
                            </div>
                        </div>
                <?php
						}
					}
				?>
                
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit"  class="arp_modal_insert_shortcode_btn" name="arp_embed_btn" id="arp_embed_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
            </div>
            
            <!-- Header Shortcode Embed -->
            
            
            
            
        </div>
    </div>
    </form>
</div>

<!-- Header Shortcode Modal -->

<!-- Slider Navigation Modal -->
	<div class="arp_model_box" id="arp_select_navigation_style" style="display:none;background:white;">
    	<div class="modal_top_belt">
            <span class="modal_title"><?php _e('Choose Navigation Style',ARP_PT_TXTDOMAIN); ?></span>
            <span id="nav_style_close" class="modal_close_btn b-close"></span>
        </div>
        <div class="arp_modal_content slider_pagination_navigation">
		<?php
        	global $arp_mainoptionsarr;
			foreach( $arp_mainoptionsarr['general_options']['column_animation']['navigation_style'] as $style )
			{
		?>
        		<div class="navigation_style_wrapper <?php echo ( isset($opt['column_animation']['navigation_style']) && $opt['column_animation']['navigation_style'] == $style ) ? 'selected'  : '';?>" id="<?php echo $style; ?>">
                    <div class="<?php echo $style; ?>" ></div>
                </div>
        <?php
			}
        ?>
        </div>
    </div>
<!-- Slider Navigation Modal -->

<!-- Slider Pagination Modal -->

	<div class="arp_modal_box" id="arp_select_pagination_style" style="display:none;background:#ffffff;">
    	<div class="modal_top_belt">
        	<span class="modal_title"><?php _e('Choose Pagination Style',ARP_PT_TXTDOMAIN); ?></span>
            <span id="paging_style_close" class="modal_close_btn b-close"></span>
        </div>
        <div class="arp_modal_content slider_pagination_navigation">
        <?php
			global $arp_mainoptionsarr;
			foreach( $arp_mainoptionsarr['general_options']['column_animation']['pagination_style'] as $style ){
		?>
        		<div class="pagination_style_wrapper <?php echo ( isset($opt['column_animation']['pagination_style']) && $opt['column_animation']['pagination_style'] == $style ) ? 'selected' : ''; ?>" id="<?php echo $style; ?>">
					<?php
                        for( $i = 1; $i <= 3; $i++ )
                        {
                    ?>
                        <div class="<?php echo $style.' page_'.$i; ?>" ></div>
                    <?php
                        }
                    ?>
                </div>
        <?php
			}
		?>
        </div>
    </div>

<!-- Slider Pagination Modal -->

<!-- Button Shortcode Modal -->

	<div class="arp_modal_box" id="arp_button_template_modal" style="display:none; background:#ffffff;">
    <form name="add_button_shortcode_form" id="add_button_shortcode_form" method="post" onsubmit="return add_rpt_btn_shortcode();">
        <input type="hidden" name="rptaction" id="rptaction" value="create_new" />
        <input type="hidden" name="page" value="rpt_add_pricing_table" />
    	<div class="modal_top_belt">
        	<span class="modal_title"><?php _e('Add Shortcode',ARP_PT_TXTDOMAIN); ?></span>
            <span id="button_style_close" class="modal_close_btn b-close"></span>
        </div>
        <div class="arp_modal_content arp_button_template">
        	<div id="rpt_btn_image_shortcode_div" class="rpt_shortcode_div" style="margin-top: 20px;">
            	<div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<label for="rpt_btn_image_url" class="modal_content_label"><?php _e('Image URL', ARP_PT_TXTDOMAIN);?></label>
                        <div class="modal_content_input">
                        	<input type="text" value="" class="arp_modal_txtbox img" id="arp_btn_image_url" name="rpt_btn_image_url">
                            <button data-insert="btn_image" data-id="arp_btn_image_url" type="button" class="arp_modal_add_file_btn"><?php _e('Add File',ARP_PT_TXTDOMAIN); ?></button>
                        </div>
                    </div>
                </div>
                
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<label for="rpt_btn_image_height" class="modal_content_label"><?php _e('Height',ARP_PT_TXTDOMAIN); ?></label>
                        <div class="modal_content_input">
                        	<input type="text" value="" class="arp_modal_txtbox" id="arp_btn_image_height" name="rpt_btn_image_height">
                        </div>
                    </div>
                </div>
                
                <div class="modal_content_row">
	                <div class="modal_content_cell">
                    	<label for="rpt_btn_image_width" class="modal_content_label"><?php _e('Width',ARP_PT_TXTDOMAIN); ?></label>
                        <div class="modal_content_input">
                        	<input type="text" value="" class="arp_modal_txtbox" id="arp_btn_image_width" name="rpt_btn_image_width">
                        </div>
                    </div>
                </div>
                
                <div class="modal_content_row">
                	<div class="modal_content_cell">
                    	<div class="modal_content_label"></div>
                        <div class="modal_content_input"><button type="submit" class="arp_modal_insert_shortcode_btn" name="rpt_image_btn" id="rpt_image_btn"><i class="fa fa-plus"></i><?php _e('Insert Shortcode',ARP_PT_TXTDOMAIN); ?></button></div>
                    </div>
                </div>
                
            </div>
        </div>
    </form>
    </div>

<!-- Button Shortcode Modal -->

<!-- Remove Row Modal -->
	<div class="arp_model_delete_box" id="arp_remove_row" style="display:none;background:white;">
    	<div class="modal_top_belt">
            <span class="modal_title"><?php _e('Delete Row',ARP_PT_TXTDOMAIN); ?></span>
            <span id="nav_style_close" class="modal_close_btn b-close"></span>
        </div>
        <div class="arp_modal_delete_content">
        	<div class="arp_delete_modal_msg">Are you sure want to delete this row?</div>
            
            <div class="arp_delete_modal_btn">
                <button id="Model_Delete_Row_Button" col-id=''row-id='' type="button" class="ribbon_insert_btn delete_row">Okay</button>
                <button id="Model_Delete_Row_Button"  class="ribbon_cancel_btn" type="button">Cancel</button>
            </div>
            
        </div>
    </div>
    
<!-- Remove Row Modal -->

<!-- Remove column -->
	<div class="arp_model_delete_box" id="arp_remove_column" style="display:none;background:white;">
    	<div class="modal_top_belt">
            <span class="modal_title"><?php _e('Delete Column',ARP_PT_TXTDOMAIN); ?></span>
            <span id="nav_style_close" class="modal_close_btn b-close"></span>
        </div>
        <div class="arp_modal_delete_content">
        	<div class="arp_delete_modal_msg">Are you sure want to delete this column?</div>
            <div class="arp_delete_modal_btn">
                <button id="Model_Delete_Column" col-id=""  type="button" class="ribbon_insert_btn delete_column">Okay</button>
                <button id="Model_Delete_Column"  class="ribbon_cancel_btn" type="button">Cancel</button>
            </div>
        </div>
    </div>
    
<!-- Remove column -->

<!-- Remove template -->
	<div class="arp_model_delete_box" id="arp_remove_template" style="display:none;background:white;">
    	<div class="modal_top_belt">
            <span class="modal_title"><?php _e('Delete Template',ARP_PT_TXTDOMAIN); ?></span>
            <span id="nav_style_close" class="modal_close_btn b-close"></span>
        </div>
        <div class="arp_modal_delete_content">
        	<div class="arp_delete_modal_msg">Are you sure you want to delete this template?</div>
            <div class="arp_delete_modal_btn">
               <button id="Model_Delete_Template"  type="button" class="ribbon_insert_btn delete_template">Okay</button>
               <button id="Model_Delete_Template"  class="ribbon_cancel_btn" type="button">Cancel</button>
            </div>
        </div>
    </div>
    
<!-- Remove template -->

<!--Empty Selection modal box-->
	<div class="arp_model_empty_box" id="arp_empty_temp" style="display:none;background:white;">
    	<div class="modal_top_belt_emptybox">
            <span class="modal_title_emptybox"><?php _e('Please Select a Template',ARP_PT_TXTDOMAIN); ?></span>
            
        </div>
        <div class="arp_modal_delete_content">
        	
            
            <div class="arp_empty_modal_btn">
                 <button id=""  type="button" class="ribbon_insert_btn b-close">Okay</button>
   </div>
            
        </div>
    </div>
<!---->

<!-- Header Object Modal Box -->
	<div class="arp_object_modal_box" id="arp_object_modal_box" style="display:none; background:#ffffff;">
        <form name="add_arp_object" id="add_arp_object" method="post" onsubmit="return false;">
        	<input type="hidden" id="arpcol_to_insert_object" name="arpcol_to_insert_object" />
            <input type="hidden" id="arpcol_insert" name="arpcol_insert" />
            <div class="modal_top_belt">
                <span class="modal_title"><?php _e('Add Shortcode',ARP_PT_TXTDOMAIN); ?></span>
                <span id="button_style_close" class="modal_close_btn b-close"></span>
            </div>
            <div class="arp_modal_content" style="padding:20px;">
				            
                    <div class="modal_content_row">
                        <div class="modal_content_cell">
                            <label for="rpt_btn_image_url" class="modal_content_label"><?php _e('Image URL', ARP_PT_TXTDOMAIN);?></label>
                            <div class="modal_content_input">
                                <input type="text" value="" class="arp_modal_txtbox img" id="arp_header_image_url" name="arp_header_image_url">
                                <button data-insert="header_object" data-id="arp_header_image_url" type="button" class="arp_header_object"><?php _e('Add File',ARP_PT_TXTDOMAIN); ?></button>
                            </div>
                        </div>
                    </div>
                    
                   <div class="modal_content_row">
                        <div class="modal_content_cell">
                            <label for="arp_header_image_height" class="modal_content_label"><?php _e('Height',ARP_PT_TXTDOMAIN); ?></label>
                            <div class="modal_content_input">
                                <input type="text" value="" class="arp_modal_txtbox" id="arp_header_image_height" name="arp_header_image_height">
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal_content_row">
                        <div class="modal_content_cell">
                            <label for="arp_header_image_width" class="modal_content_label"><?php _e('Width',ARP_PT_TXTDOMAIN); ?></label>
                            <div class="modal_content_input">
                                <input type="text" value="" class="arp_modal_txtbox" id="arp_header_image_width" name="arp_header_image_width">
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal_content_row">
                        <div class="modal_content_cell">
                            <div class="modal_content_label"></div>
                            <div class="modal_content_input"><button type="submit" onclick="arp_add_object();" class="arp_modal_insert_shortcode_btn" name="rpt_image_btn" id="rpt_image_btn"><i class="fa fa-plus"></i><?php _e('Add Image',ARP_PT_TXTDOMAIN); ?></button></div>
                        </div>
                    </div>
                
            </div>
        </form>
    </div>
<!---->


<!-- Font Awesome -->
    <div class="arp_modal_box" id="arp_obj_fontawesome_modal">
    
        <div class="modal_top_belt">
            <span class="modal_title"><?php _e('Choose Icon',ARP_PT_TXTDOMAIN); ?></span>
            <span class="modal_close_btn b-close"></span>
        </div>
        <form name="select_font_awesome_form" id="select_font_awesome_form" method="post" enctype="multipart/form-data" onSubmit="return false;">
            <input type="hidden" name="arpcol_to_insert_font" id="arpcol_to_insert_font" value="" />
            <input type="hidden" name="arpcol_insert_font" id="arpcol_insert_font" value="" />
            <div id="arp_fontawesome_content" class="arp_fontawesome_content">
                <?php 
                    include(PRICINGTABLE_VIEWS_DIR.'/arprice_font_awesome.php');
                ?>
            </div>
        </form>    
        
    </div>
<!-- Font Awesome -->



<!-- Tour Guide Model -->
   <div class="arp_model_delete_box" id="arp_tour_guide_model" style="display:none;background:white;">
    	<div class="modal_top_belt">
            <span class="modal_title"><?php _e('ARPrice Guided Tour',ARP_PT_TXTDOMAIN); ?></span>
            <span id="nav_style_close" class="arp_tour_guide_start_model modal_close_btn b-close"></span>
        </div>
        
        <div class="arp_modal_delete_content">
        	<div class="arp_delete_modal_msg"><?php _e('Please take a quick tour of basic functionalities.',ARP_PT_TXTDOMAIN); ?></div>
            
            <div class="arp_delete_modal_btn">
                <button id="arp_tour_guide_start_yes" class="arp_tour_guide_start_model ribbon_insert_btn b-close" type="button"><?php _e('Start Tour',ARP_PT_TXTDOMAIN); ?></button>
                <button id="arp_tour_guide_start_no" class="arp_tour_guide_start_model ribbon_insert_btn b-close" type="button" style="background:#373a3f;"><?php _e('Skip Tour',ARP_PT_TXTDOMAIN); ?></button>
            </div>
        </div>
    </div>
    
    
<!-- Tour Guide Model -->



<?php /* ARPrice Modal Windows */ ?>