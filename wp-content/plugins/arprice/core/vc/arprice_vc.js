jQuery(document).on('click','.ARPrice_Shortode_field',function(e){
		jQuery(".arp_param_block").find('.ARPrice_Shortode_field').css('box-shadow', '');
		jQuery(".arp_param_block").find('.ARPrice_Shortode_field').css('opacity', '0.7');
		var id = jQuery(this).attr('id');
		jQuery(this).css('box-shadow', '0 0 0 3px rgba(86,178,11, 1)');
		jQuery(this).css('opacity', '1');
		if(id)
		{
			jQuery(".arp_param_block").find(".wpb_vc_param_value").val(id);
		}
		
});
