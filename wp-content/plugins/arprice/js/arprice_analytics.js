/*
	ARPrice Admin Plugin: analytics
*/
jQuery(document).ready(function(){
								
	jQuery("#analytics_pagination").on('click','#analytics_next_page',function(){
		var pageno = jQuery(this).val();
		arprice_analytics_pagination(pageno);
	});
	
	jQuery('#analytics_pagination').on('click','button#analytics_page',function(){
		var pageno = jQuery(this).val();
		arprice_analytics_pagination(pageno);
	});
	
	jQuery("#analytics_pagination").on('click','#analytics_last_page',function(){
		var pageno = jQuery(this).val();
		arprice_analytics_pagination(pageno);
	});
	
	jQuery("#analytics_pagination").on('click','#analytics_previous_page',function(){
		var pageno = jQuery(this).val();
		arprice_analytics_pagination(pageno);
	});
	
	jQuery("#analytics_pagination").on('click','#analytics_first_page',function(){
		var pageno = jQuery(this).val();
		arprice_analytics_pagination(pageno);
	});		
});								

jQuery(document).on('blur',"#go_to_page",function(){
	var pageno = jQuery(this).val();
	if(!jQuery.isNumeric(pageno)){
		return false;		
	}
	pageno = Math.floor(pageno);
	var total_pages = jQuery("#analytics_total_pages").val();
	if(total_pages < pageno){
		pageno = total_pages;
	}
	arprice_analytics_pagination(pageno);
});

jQuery(document).on('click',"#go_to_page_btn",function(){
	var pageno = jQuery("#go_to_page").val();
	if(!jQuery.isNumeric(pageno)){
		return false;		
	}
	pageno = Math.floor(pageno);
	var total_pages = jQuery("#analytics_total_pages").val();
	if(total_pages < pageno){
		pageno = total_pages;
	}
	arprice_analytics_pagination(pageno);
});

/* Pricing Table Analycis Pagination Function */
function arprice_analytics_pagination(pageno)
{
	var total_pages = jQuery("#analytics_total_pages").val();
	jQuery.ajax({
		type:'POST',
		url:ajaxurl,
		data:'action=arp_analytics_pagination&pageno='+pageno,
		success:function(res)
		{
			jQuery("#analytics_table_data").html(res);
			jQuery("#current_page").addClass('page');
			jQuery("#current_page").removeClass('current_page');
			
			jQuery("button#analytics_page").each(function(){
				jQuery(this).removeAttr('disabled');
				jQuery(this).attr('class','page');
				if(jQuery(this).val() == pageno)
				{
					jQuery(this).addClass('current_page');
					jQuery(this).removeClass('page');
					jQuery(this).attr('disabled','disabled');
				}
			});
			jQuery("#analytics_previous_page").val(parseInt(pageno)-1);
			jQuery("#analytics_next_page").val(parseInt(pageno)+1);
			var starting_value = jQuery("#analytics_starting_value").val();
			var ending_value = jQuery("#analytics_ending_value").val();
			var total_records = jQuery("#analytics_total_records").val();
			var range_start = jQuery("#analytics_range_start").val();
			var range_end = jQuery("#analytics_range_end").val();
			var rows = jQuery("#analytics_rows").val();
			jQuery("#analytics_entries").html('Showing '+(parseInt(starting_value)+1)+' to '+(parseInt(starting_value)+parseInt(rows))+' of '+total_records+' entries');
			var html = '';
			html += '<div class="arp_go_page_main"><span>Go to page</span><input type="text" id="go_to_page" name="go_to_page" value="" /><button id="go_to_page_btn">GO</button></div>';
			
			html += '<div style="width:auto; float:right;">';
			
			html += '<button id="analytics_first_page" class="first_page" style="display:none;" value="1"><i class="fa fa-lg fa-angle-double-left"></i></button>';
			html += '<input type="hidden" value="'+total_pages+'" id="analytics_total_pages" />';
			html += '<input type="hidden" value="1" id="analytics_first_page" />';
			html += '<input type="hidden" value="1" id="analytics_current_pageno" />';
			html += '<button id="analytics_previous_page" class="previous_page" style="display:none;" value="'+(parseInt(pageno)-1)+'" ><i class="fa fa-angle-left fa-lg"></i></button>';
			html += '<span id="analytics_pages">';
			var i = range_start;
			while(parseInt(i) <= parseInt(range_end))
			{
				if(i == pageno)
				{
					html += '<button id="analytics_page" class="current_page" disabled="disabled" value='+i+'>'+i+'</button>';
				}
				else
				{
					html += '<button class="page" id="analytics_page" value='+i+'>'+i+'</button>';
				}
				i++;
			}
			html += '</span>';
			html += '<button id="analytics_next_page" class="next_page" value="'+(parseInt(pageno)+1)+'"><i class="fa fa-angle-right fa-lg"></i></button>';
			html += '<button id="analytics_last_page" class="last_page" value="'+total_pages+'"><i class="fa fa-lg fa-angle-double-right"></i></button>';
			html += '</div>';
			jQuery("#analytics_pagination").html(html);
			if(pageno > 1)
			{
				jQuery("button#analytics_first_page").css('display','inline-block');
				jQuery("button#analytics_previous_page").css('display','inline-block');
			}
			if(pageno == total_pages)
			{
				jQuery("button#analytics_next_page").css('display','none');
				jQuery("button#analytics_last_page").css('display','none');
			}
			else if(pageno < total_pages)
			{
				jQuery("button#analytics_next_page").css('display','inline-block');
				jQuery("button#analytics_last_page").css('display','inline-block');
			}
			if(pageno == 1)
			{
				jQuery("button#analytics_first_page").css('display','none');
				jQuery("button#analytics_previous_page").css('display','none');
			}
			jQuery("button#analytics_page").each(function(){
				var x = jQuery(this).val();
				if(parseInt(x) > parseInt(total_pages))
				{
					jQuery(this).remove();
				}
			});
		}
	});
}