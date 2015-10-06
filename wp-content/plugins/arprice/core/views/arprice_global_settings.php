<script type="text/javascript" language="javascript">
	function show_success_msg(){
		jQuery('.success_message').fadeIn();
		setTimeout( function(){ jQuery('.success_message').fadeOut('slow'); },3000 );
	}
</script>
<?php 
$hostname = $_SERVER["HTTP_HOST"]; 
global $arprice_class;
$setact = 0;
global $arpriceplugin;
$setact = $arprice_class->$arpriceplugin();

if( isset( $_POST['save_global_settings'] ) ){
	
	$global_custom_css = stripslashes_deep( $_POST['arp_custom_css'] );
	
	$number_pattern = '/^[0-9]+$/';
	
	update_option( 'arp_global_custom_css',$global_custom_css );
	
	if( $_POST['arp_mobile_responsive_size'] != '' ){
		if( preg_match( $number_pattern, $_POST['arp_mobile_responsive_size'] ) > 0 ){
			$mobile_view_width = $_POST['arp_mobile_responsive_size'];
			update_option( 'arp_mobile_responsive_size',$mobile_view_width );
		} else {
			$mobile_view_width = 480;
		}
	} else {
		$mobile_view_width = 480;
	}
	
	if( $_POST['arp_tablet_responsive_size'] != '' ){
		if( preg_match( $number_pattern, $_POST['arp_tablet_responsive_size'] ) > 0 ){
			$mobile_view_width = $_POST['arp_tablet_responsive_size'];
			update_option( 'arp_tablet_responsive_size',$mobile_view_width );
		} else {
			$tablet_view_width = 768;
		}
	} else {
		$tablet_view_width = 768;
	}
	
	if( $_POST['arp_desktop_responsive_size'] != '' ){
		if( preg_match( $number_pattern, $_POST['arp_desktop_responsive_size'] ) > 0 ){
			$mobile_view_width = $_POST['arp_desktop_responsive_size'];
			update_option( 'arp_desktop_responsive_size',$mobile_view_width );
		} else {
			$tablet_view_width = 0;
		}
	} else {
		$tablet_view_width = 0;
	}
	
	echo "<script type='text/javascript' language='javascript'> setTimeout( function(){ show_success_msg(); },10 ); </script>";
}

?>
<h1 style="margin:30px 0 30px 0;"><?php _e('Pricing Table Settings',ARP_PT_TXTDOMAIN); ?></h1>
<div class="success_message global_settings" id="global_settings_success_message"> 
    <div class="message_descripiton"><?php _e('Changes Saved Successfully.', ARP_PT_TXTDOMAIN); ?></div>		
</div>
<div class="arprice_chart_main">
	<div class="arprice_global_settings">
    	
        <div class="arprice_title"><h2><?php _e('Global Settings',ARP_PT_TXTDOMAIN); ?> </h2></div>
        <div class="arprice_analytics_browser" style="float:left; width:97.8%;">
        <form name="arp_settings_form" method="post" enctype="multipart/form-data">
    		<table width="100%" cellpadding="0" cellspacing="0" border="0" style="float:left;">
        		
               <?php if($setact == 1)
				{ ?>
                 	
                 		
        			<tr class="arfmainformfield" valign="top"><td class="lbltitle" colspan="2" style="font-weight:bold; font-size:20px; "><?php _e('Product License',ARP_PT_TXTDOMAIN); ?>&nbsp;</td></tr>
        
                    <tr class="arfmainformfield" valign="top">
                
                
					<td class="tdclass" style="padding-left:30px; padding-top:22px; font-weight:bold;" width="18%">
        				


        				<label class="lblsubtitle"><?php _e('License Status', ARP_PT_TXTDOMAIN) ?></label>
					
                    </td>
                    
					<td>	
        				 <div id="licenseactivatedmessage" class="updated" style="width:100px; vertical-align:top;"><?php echo "Active"; ?></div>
						
                        <a href="javascript:void(0);" onclick="deactivate_license();"><?php _e('Deactivate License',ARP_PT_TXTDOMAIN);?></a>
						<span id="deactivate_loader" style="display:none;"><img src="<?php echo PRICINGTABLE_IMAGES_URL.'/loading_activation.gif';?>" height="15" /></span>   		
                    <span id="deactivate_error" class="arp_not_verify_li" style="display:none;"><?php _e('Invalid Request', ARP_PT_TXTDOMAIN); ?></span>
                    <span id="deactivate_success" class="arp_verify_li"  style="display:none;"><?php _e('License Deactivated Successfully.', ARP_PT_TXTDOMAIN); ?></span>

        				
					</td>
                </tr>
                
                <tr class="arfmainformfield" valign="top"><td class="lbltitle" colspan="2" style="font-weight:bold; font-size:16px; "><div class="dotted_line" style="width:96%">&nbsp;</div>&nbsp;</td></tr>
                
                
        
				<?php }
				if($setact != 1)
				{
				
		?>
                
        
        		<tr class="arfmainformfield" valign="top"><td class="lbltitle" colspan="2" style="font-weight:bold; font-size:16px; "><?php _e('Product License', ARP_PT_TXTDOMAIN); ?>&nbsp;</td></tr>
                <tr>
                	<td colspan="2" style="padding-left:10px;">
                    <br /><label class="lblsubtitle"><?php _e('A valid license key entitles you to support and enables automatic upgrades. Also you can get analytics after activate your license. A license key only be used for one installation of WordPress at a time.',ARP_PT_TXTDOMAIN)?></label><br /><br />
                    </td>
                </tr>
                
				<tr class="arpmainformfield" valign="top">
                
                
					<td class="tdclass" style="padding-left:30px;" width="18%">
        				


        				<label class="lblsubtitle"><?php _e('Customer Name', ARP_PT_TXTDOMAIN) ?>&nbsp;&nbsp;<span style="vertical-align:middle" class="arfglobalrequiredfield">*</span></label>
					
                    </td>
                    
					<td>	
        				 <input type="text" name="li_customer_name" id="li_customer_name" class="txtstandardnew" size="42" value="" autocomplete="off" />
                          <div class="arperrmessage" id="li_customer_name_error" style="display:none;"><?php _e('This field cannot be blank.', ARP_PT_TXTDOMAIN); ?></div>


        				
					</td>
                </tr>
                
                <tr class="arpmainformfield" valign="top">
                
                
					<td class="tdclass" style="padding-left:30px;" width="18%">
        				


        				<label class="lblsubtitle"><?php _e('Customer Email', ARP_PT_TXTDOMAIN) ?>&nbsp;&nbsp;&nbsp;</label>
					
                    </td>
                    
					<td>	
        				 <input type="text" name="li_customer_email" id="li_customer_email" class="txtstandardnew" size="42" value="" autocomplete="off" />


        				
					</td>
                </tr> 	
                        
                <tr class="arpmainformfield" valign="top">
                
					<td class="tdclass" style="padding-left:30px;" width="18%">        			
        				

        				<label class="lblsubtitle"><?php _e('Purchase Code', ARP_PT_TXTDOMAIN) ?>&nbsp;&nbsp;<span style="vertical-align:middle" class="arfglobalrequiredfield">*</span></label>
					
                    </td>
                    
                    <td>	

        				<input type="text" name="li_license_key" id="li_license_key" class="txtstandardnew" size="42" value="" autocomplete="off" />
						<div class="arperrmessage" id="li_license_key_error" style="display:none;"><?php _e('This field cannot be blank.', ARP_PT_TXTDOMAIN); ?></div>

            	</td>


            </tr>
    
				<tr class="arpmainformfield" valign="top">
                
					<td class="tdclass" style="padding-left:30px;" width="18%">        			
        				

        				<label class="lblsubtitle"><?php _e('Domain Name', ARP_PT_TXTDOMAIN) ?>&nbsp;&nbsp;&nbsp;</label>
					
                    </td>
                    
                    <td>	
						<label class="lblsubtitle"><?php echo $hostname;?></label>
                        <input type="hidden" name="li_domain_name" id="li_domain_name" class="txtstandardnew" size="42" value="<?php echo $hostname;?>" autocomplete="off" />

            	</td>


            </tr>
    
				<tr class="arpmainformfield" valign="top">
                
					<td class="tdclass">        			
        				
					
                    </td>
                    
                

        				 <td style="padding-top:20px;">					
                    <span id="license_link"><button type="button" id="verify-purchase-code" name="continue" style="width:150px; border:0px; color:#FFFFFF; height:40px; border-radius:3px;" class="greensavebtn"><?php _e('Activate', ARP_PT_TXTDOMAIN); ?></button></span>
                    <span id="license_loader" style="display:none;"><img src="<?php echo PRICINGTABLE_IMAGES_URL.'/loading_activation.gif';?>" height="15" /></span>   		
                    <span id="license_error" class="arp_not_verify_li" style="display:none;">&nbsp;</span>
                    <span id="license_success" class="arp_verify_li"  style="display:none;"><?php _e('License Activated Successfully.', ARP_PT_TXTDOMAIN); ?></span>
                    <input type="hidden" name="ajaxurl" id="ajaxurl" value="<?php echo admin_url('admin-ajax.php'); ?>"  />
                   </td>




            </tr>
            	
                <tr class="arfmainformfield" valign="top"><td class="lbltitle" colspan="2" style="font-weight:bold; font-size:16px; "><div class="dotted_line" style="width:96%">&nbsp;</div>&nbsp;</td></tr>
            
            <?php } ?>
        	
            
            
        	<tr class="arfmainformfield" valign="top"><td class="lbltitle" colspan="2" style="font-weight:bold; font-size:16px; "><?php _e('Global Custom CSS', ARP_PT_TXTDOMAIN); ?>&nbsp;</td></tr>
            
            <tr>
            	<td class="tdclass" style="padding-left:30px; vertical-align:top; padding-top:20px;" width="18%">
        				


        				<label class="lblsubtitle"><?php _e('Custom CSS', ARP_PT_TXTDOMAIN) ?></label>
					
                    </td>
            	<td>
					<textarea class='arp_custom_css' style="width:70%; margin-left:0px;" name='arp_custom_css' id='arp_custom_css' ><?php echo get_option('arp_global_custom_css'); ?></textarea>
            	</td>
            </tr>
            <tr>
            	<td class="tdclass" style="padding-left:30px;" width="18%">
        				


        				<label class="lblsubtitle">&nbsp;</label>
					
                    </td>
            	<td>
					<span style='font-weight:normal; margin-right:6px; margin-bottom:30px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(e.g.)&nbsp;&nbsp; .btn{color:#000000;}</span>
            	</td>
            </tr>
        
       <tr class="arfmainformfield" valign="top"><td class="lbltitle" colspan="2" style="font-weight:bold; font-size:16px; "><div class="dotted_line" style="width:96%">&nbsp;</div>&nbsp;</td></tr>
                           
        <tr class="arfmainformfield" valign="top"><td class="lbltitle" colspan="2" style="font-weight:bold; font-size:16px; margin-bottom:20px; float:left; "><?php _e('Resonsive Settings',ARP_PT_TXTDOMAIN); ?>&nbsp;</td></tr>
            
           		<tr class="arpmainformfield" valign="top">
                
                
					<td class="tdclass" style="padding-left:30px;" width="18%">
        				


        				<label class="lblsubtitle"><?php _e('Mobile View', ARP_PT_TXTDOMAIN) ?><span style="font-size:13px; color:#FF0000; "> (Max-Width)</span></label>
					
                    </td>
                    
					<td>	
        				 <input type="text" name="arp_mobile_responsive_size" id="arp_mobile_responsive_size" class="txtstandardnew" size="42" value="<?php echo get_option('arp_mobile_responsive_size'); ?>" autocomplete="off" />&nbsp;&nbsp;<label class="responsive_screen_width_unit"><?php _e('px',ARP_PT_TXTDOMAIN); ?></label>
					</td>
                </tr>
                
                <tr class="arpmainformfield" valign="top">
                
                
					<td class="tdclass" style="padding-left:30px;" width="18%">
        				


        				<label class="lblsubtitle"><?php _e('Tablet View', ARP_PT_TXTDOMAIN) ?><span style="font-size:13px; color:#FF0000;"> (Max-Width)</span></label>
					
                    </td>
                    
					<td>	
        				 <input type="text" name="arp_tablet_responsive_size" id="arp_tablet_responsive_size" class="txtstandardnew" size="42" value="<?php echo get_option('arp_tablet_responsive_size'); ?>" autocomplete="off" />&nbsp;&nbsp;<label class="responsive_screen_width_unit"><?php _e('px',ARP_PT_TXTDOMAIN); ?></label>


        				
					</td>
                </tr> 	
                        
                <tr class="arpmainformfield" valign="top">
                
					<td class="tdclass" style="padding-left:30px;" width="18%">        			
        				

        				<label class="lblsubtitle"><?php _e('Desktop View', ARP_PT_TXTDOMAIN) ?><br /> <span style="color:#FF0000"><?php _e('(Optional)', ARP_PT_TXTDOMAIN); ?></span></label>
					
                    </td>
                    
                    <td>	

        				<input type="text" name="arp_desktop_responsive_size" id="arp_desktop_responsive_size" class="txtstandardnew" size="42" value="<?php echo get_option('arp_desktop_responsive_size'); ?>" autocomplete="off" />&nbsp;&nbsp;<label class="responsive_screen_width_unit"><?php _e('px',ARP_PT_TXTDOMAIN); ?></label><br>
					<span style="color:#FF0000">(Zero (0) means Unlimited)</span>

            	</td>


            </tr>
            
       		<tr style="margin-top:50px;">
            	<td width="18%" >&nbsp;</td>
            	<td><button type="submit" id="set_global_settings" name="save_global_settings" style="width:150px; border:0px; margin-top:50px; color:#FFFFFF; height:40px; border-radius:3px;" class="greensavebtn"><?php _e('Save Changes', ARP_PT_TXTDOMAIN); ?></button></td>
            </tr>
       </table>
      	</form>
        </div>
                            
    </div>
    
</div>