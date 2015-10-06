<?php
	global $wpdb, $arprice_import_export;
	
	if(isset($_FILES["arp_pt_import_file"]))
	{
		global $wpdb,$WP_Filesystem;
		
		$wp_upload_dir 	= wp_upload_dir();
		$upload_dir 	= $wp_upload_dir['basedir'].'/arprice/import/';
		
		$output_dir = $wp_upload_dir['basedir'].'/arprice/import/';
		$output_url = $wp_upload_dir['baseurl'].'/arprice/import/';
		
		if(!is_dir($output_dir))
			wp_mkdir_p($output_dir);
		
		$extexp = explode(".",$_FILES["arp_pt_import_file"]["name"]);
		$ext = $extexp[count($extexp)-1];
		
		//Filter the file types , if you want.
		if(strtolower($ext) == "zip")
		{
			if ($_FILES["arp_pt_import_file"]["error"] > 0)
			{
			  echo "Error: " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
				if(@move_uploaded_file($_FILES["arp_pt_import_file"]["tmp_name"],$output_dir. $_FILES["arp_pt_import_file"]["name"]))
				{
					$explodezipfilename = explode(".",$_FILES["arp_pt_import_file"]["name"]);
					$zipfilename = $explodezipfilename[0];
					$flag = $arprice_import_export->extract_zip($output_dir.$_FILES["arp_pt_import_file"]["name"],$output_dir.$zipfilename."_temp");
					if($flag == 'ok')
					{
						?>
                        	<script>
								var file_name = '<?php echo $zipfilename; ?>';
								jQuery.ajax({
									type:'POST',
									url:ajaxurl,
									data:'action=import_table&xml_file='+file_name,
									success:function(res)
									{
										if(res == 1)
										{
											jQuery("#import_success_message").css('display','block');
											setTimeout(function hide_msg(){ jQuery("#import_success_message").fadeOut('slow'); },3000);
											jQuery.ajax({
												type:'POST',
												url:ajaxurl,
												data:'action=get_table_list',
												success:function(res)
												{
													jQuery("#export_table_lists").html(res);
												}
											});
										}
										else if(res == 0)
										{
											jQuery("#import_validation_zip_error_message").css('display','');
											setTimeout(function hide_err_msg(){ jQuery("#import_validation_zip_error_message").fadeOut('slow'); },3000);
										}
									}
								});
							</script>
                        <?php
					}
				}
			}
		}
		
	}
?>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#arp_pt_import_file').live('change', function(){ 
		var filename = jQuery(this).val();
		if(filename==""){
			jQuery('#arp_pt_import_file_name').html('No file Selected');
		}else{
			jQuery('#arp_pt_import_file_name').html(filename);
		}
	});
});



/* Validating Imported file */
function check_valid_imported_file()
{
	var importFile = jQuery( "#arp_pt_import_file" ).val();	
	var extension = importFile.substr( (importFile.lastIndexOf('.') +1) );
	var file_nm = importFile.split('_');
	if (importFile==null || importFile=="")
  	{
		jQuery("#import_invalid_zip_error_message").css('display','none');
		jQuery("#import_blank_zip_error_message").css('display','');
		jQuery(window.opera?'html':'html, body').animate({ scrollTop: jQuery('#import_blank_zip_error_message').offset().top-250 }, 'slow' );
		return false;
	}
	else if(extension != 'zip')
	{
		jQuery("#import_blank_zip_error_message").css('display','none');
		jQuery("#import_invalid_zip_error_message").css('display','');
		jQuery(window.opera?'html':'html, body').animate({ scrollTop: jQuery('#import_invalid_zip_error_message').offset().top-250 }, 'slow' );
		return false;
	}
	else if( file_nm[0] != 'arp' )
	{	
		var isIE11 = !!navigator.userAgent.match(/Trident.*rv\:11\./);
		if(jQuery.browser.webkit || jQuery.browser.msie || jQuery.browser.opera || isIE11){ 	
			var arr_file_path = importFile.split('\\');
			var filename = arr_file_path[arr_file_path.length - 1];
			var arr_file_name = filename.split('_');
				if( arr_file_name[0] != 'arp' ){
					jQuery("#import_invalid_zip_error_message").css('display','');
					jQuery(window.opera?'html':'html, body').animate({ scrollTop: jQuery('#import_invalid_zip_error_message').offset().top-250 }, 'slow' );
					return false;
				}else{
					return true;
				}
		}else{ 
			jQuery("#import_invalid_zip_error_message").css('display','');
			jQuery(window.opera?'html':'html, body').animate({ scrollTop: jQuery('#import_invalid_zip_error_message').offset().top-250 }, 'slow' );
			return false;
		}
		
	}
	else
	{
		return true;
	}
}

/* JavaScript for Exporting Table */
function import_export_table()
{
	var form = jQuery("#arp_export").serialize();
	if(jQuery("#table_to_export").val() == "" || jQuery("#table_to_export").val() == null)
	{
		jQuery("#export_blank_error_message").css('display','');
		//setTimeout(function hide_err_msg(){ jQuery("#export_blank_error_message").fadeOut('slow'); },3000);
		return false;
	}
	else
	{
		return true;
		
	}
	return false;
}

</script>

<div class="arp_import_export_main">

	<div class="arp_import_export_main_title">
    	<h2><?php _e('Import / Export Pricing Tables',ARP_PT_TXTDOMAIN); ?></h2>
    </div>
    <div class="clear" style="clear:both;"></div>
    <div class="success_message" id="import_success_message" style="display:none;float:left;width:95.5%;margin-left:10px;margin-bottom:15px;">
    	<?php _e('Table Imported Successfully',ARP_PT_TXTDOMAIN); ?>
    </div> 
    <div class="error_message" id="import_validation_zip_error_message" style="display:none;">
    	<?php _e('Please Select file exported from ARPrice Plugin.',ARP_PT_TXTDOMAIN); ?>
    </div>
    <div class="error_message" id="import_invalid_zip_error_message" style="display:none;">
    	<?php _e('Please Select Valid File.', ARP_PT_TXTDOMAIN); ?>
    </div>
    <div class="error_message" id="import_blank_zip_error_message" style="display:none;">
    	<?php _e('Please Select File.', ARP_PT_TXTDOMAIN); ?>
    </div>
    <div class="error_message" id="export_blank_error_message" style="display:none;">
    	<?php _e('Please Select Table.', ARP_PT_TXTDOMAIN); ?>
    </div>
    
    <div class="arp_import_export_main_inner">
    
   
    <div class="arp_import_export_sub_title">
    	
    	<h2><?php _e('Export Pricing Tables',ARP_PT_TXTDOMAIN); ?></h2>
        
    </div>
    
    
    <div class="arp_import_export_frm">
        <form  name="arp_export" method="post" action="<?php echo PRICINGTABLE_CLASSES_URL.'/class.arprice_export_table.php' ?>" id="arp_export" onsubmit="return import_export_table();">   
     
        		
       	        
		<div class="arp_import_export_list" style="float:left;width:100%;padding:20px;">
            <div class="import_export_list_main" style="float:left;width:30%;display:table;">

                
	    <div class="arp_import_export_frm_title"><?php _e('Please Select Table(s)',ARP_PT_TXTDOMAIN); ?></div>
		<div class="arp_import_export_frm_select" id="export_table_lists"><?php $arprice_import_export->get_table_list(); ?></div>
	        <div class="arp_import_export_frm_submit">
    	    	<!--input type="submit" name="export_tables" value="<?php //_e('Export',ARP_PT_TXTDOMAIN); ?>"  / -->
        	    <button class="arp_import_export_btn" type="submit" name="export_tables"><img style="float:left; margin:2px 3px 0 0"; src="<?php echo PRICINGTABLE_IMAGES_URL.'/icons/export-icon.png'; ?>"><?php _e('Export',ARP_PT_TXTDOMAIN); ?></button> 
            </div>   
        </div>
        </div>
       
         
        </form>
     </div> 
    
   
    <div class="arp_import_export_sub_title">
    	<h2><?php _e('Import Pricing Tables',ARP_PT_TXTDOMAIN); ?></h2>
    </div>
    
    <form name="arp_import" id="arp_import" method="post" enctype="multipart/form-data" onsubmit="return check_valid_imported_file();" >
       <div class="arp_import_export_list" style="float:left;width:auto;padding:20px;">
       
                <div class="import_export_list_main_import">
                    <table align="left" cellpadding="0" cellspacing="0" width="35%">
                        <tr><td colspan="3"><?php _e('Please Upload zip file exported from ARPrice plugin',ARP_PT_TXTDOMAIN); ?></td></tr>
                        <tr><td class="empty">&nbsp;</td></tr>
                        <tr><td style="font-weight:bold;"><?php _e('Select File :',ARP_PT_TXTDOMAIN); ?></td></tr>
                        <!--<tr><td class="empty">&nbsp;</td></tr> -->
                        <tr><td>
                        
                        <input type="file" style="opacity:0;width:0px !important;;height:0px !important;;padding:0px !important;" id="arp_pt_import_file" name="arp_pt_import_file"  />
                        <label for="arp_pt_import_file">
                               <div  class="text pd_input_control pd_input_small helpdesk_txt" style="float:left; width:99%; border: 1px solid #CCCCCC; border-radius: 3px;">
                                            <div class="arp_import_export_file_btn">
                                                <div style="margin:7px;"><?php _e('Add File', ARP_PT_TXTDOMAIN); ?></div>
                                            </div>
                                            <div>
                                                <div id="arp_pt_import_file_name" style="background:#ffffff; line-height:34px; overflow:hidden; padding: 0 21px;  text-align: right;">
                                                    <?php _e('No file Selected', ARP_PT_TXTDOMAIN); ?>
                                                 </div>
                                           </div>
                                 </div>
                            </label>    
                        </td></tr>
                        
                        
                        <tr><td><!--input style="margin-top:10px;" type="submit" name="imprort_file" id="import_file" value="<?php //_e('Import',ARP_PT_TXTDOMAIN); ?>" class="arp_import_btn" / -->
                            <button style="margin-top:10px;" class="arp_import_export_btn" type="submit" name="imprort_file" id="import_file"><img style="float:left; margin:2px 3px 0 0"; src="<?php echo PRICINGTABLE_IMAGES_URL.'/icons/import-icon.png'; ?>"><?php _e('Import',ARP_PT_TXTDOMAIN); ?></button>
                        </td>
                        </tr>
                    </table>
                </div>
        </div>
    </form>
    </div>
</div>