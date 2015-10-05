<?php
	global $wpdb, $arprice_analytics,$arprice_analytics_chart;
	
	$per_page_rec = 10;
	$no_per_pages = 5;
	$page = 1;
	
	if( isset($_GET['pageno']) && $_GET['pageno'] != "")
	{
		$page = intval($_GET['pageno']);
		if($page < 1)
		 $page = 1;
	}
	else
	{
		$page = 1;
	}
	
	$start_frm = ($page - 1) * $per_page_rec;
	
	$table = $wpdb->prefix.'arp_arprice_analytics';
	$sel = "SELECT * FROM $table ORDER BY added_date DESC";
	
	$limit = $wpdb->prepare( "LIMIT %d, %d", $start_frm, $per_page_rec );
	
	$total_rows = $wpdb->get_var("SELECT COUNT(*) FROM $table");
	
	$total_pages = $total_rows/$per_page_rec;
	
	$total_pages = ceil($total_pages);

	if($total_pages > 1)
	{
		$sel = $sel." ".$limit;
	}
?>

<style>
	
	.page,.next_page,.last_page,.first_page,.previous_page{
		background:white;
		color:#000000;
		border:1px solid #E8E8E8;
		cursor:pointer;
		padding:4px 8px;
	}
	.page:hover,.next_page:hover,.last_page:hover,.first_page:hover,.previous_page:hover{
		background:#F5F5F6;
	}
	.current_page{
		background:#303641;
		color:white;
		border:1px solid #E8E8E8;
		padding:4px 8px;
	}
	.page:active,.next_page:active,.last_page:active,.first_page:active,.previous_page:active{
		transform:scale(0.9,0.9);
	}
	#analytics_pagination button{
		margin-left:5px;
	}
</style>

<h1 style="margin:30px 0 30px 0;"><?php _e('Pricing Table Analytics',ARP_PT_TXTDOMAIN); ?></h1>
<?php if($wpdb->get_var($sel) > 0){  ?>

<div class="arprice_chart_main">
	<div class="arprice_chart_browser">
    	<div class="arprice_title"><h2><?php _e('Visits By Browsers',ARP_PT_TXTDOMAIN); ?> </h2></div>
        
        <div class="arprice_analytics_browser">
    		<?php $arprice_analytics_chart->arprice_Browser(); ?>
        </div>
        
    </div>
    <div class="arprice_chart_country">
    	<div class="arprice_title"><h2><?php _e('Visits By Countries',ARP_PT_TXTDOMAIN); ?> </h2></div>
        	<div class="arprice_analytics_browser">
		    	<?php $arprice_analytics_chart->arprice_Country(); ?>
            </div>
    </div>
</div>


<div class="arprice_analysis_data">

	<h2><?php _e('All Visits Listing',ARP_PT_TXTDOMAIN); ?> </h2>
    
<table>
    <thead style="float:left;width:100%;background:#F5F5F6; border-left:1px solid #F5F5F6; border-right:1px solid #F5F5F6; border-top:1px solid #F5F5F6; border-bottom:none; ">
        <tr style="float:left;width:100%; background:#D9544F; border:1px solid #D9544F; border-bottom:none; border-radius: 3px 3px 0 0;">
            <th width="11%"><?php _e('Pricing Table',ARP_PT_TXTDOMAIN); ?></th>
            <th width="14%"><?php _e('Browser Info',ARP_PT_TXTDOMAIN); ?></th>
            <th width="9%"><?php _e('Country',ARP_PT_TXTDOMAIN); ?></th>
            <th width="9%"><?php _e('IP Address',ARP_PT_TXTDOMAIN); ?></th>
			<th width="34%"><?php _e('Referer URL',ARP_PT_TXTDOMAIN); ?></th>
			<th width="16%" style="border-right:none;" ><?php _e('Added Date',ARP_PT_TXTDOMAIN); ?></th>
        </tr>
    </thead>
    <tbody style="float:left;width:100%;" id="analytics_table_data">
    <input type="hidden" value="<?php echo $total_rows; ?>" id="analytics_total_records" />
    <input type="hidden" value="<?php echo $start_frm ?>" id="analytics_starting_value" />
    <input type="hidden" value="<?php echo $per_page_rec; ?>" id="analytics_ending_value" />
    <input type="hidden" value="<?php echo $no_per_pages; ?>" id="analytics_no_per_pages"  />
    <?php
		if($wpdb->get_var($sel) > 0)
		{
			$row = $wpdb->get_results($sel);
            foreach($row as $i=>$data)
            {
				$date_format = get_option('date_format');
				$time_format = get_option('time_format');
				$pricetable_id=$data->pricing_table_id;		
				
				$result=$wpdb->get_row($wpdb->prepare("select * from ".$wpdb->prefix."arp_arprice where ID = %d",$pricetable_id));
				$pricetable_name=$result->table_name;		
				$browser = $arprice_analytics->getBrowser($data->browser_info);
		?>
        	<tr style="float:left;width:100%;border:1px solid #DEDEDE;border-bottom:none;<?php echo (($i+1) % 2 == 0) ? 'background:##F3F3F3;' : 'background:#FFFFFF;'; ?>">
            	<td  width="11%"><label><?php echo $pricetable_name; ?></label></td>
				<td width="14%"><label><?php echo $browser['browser_name']." <br>( Version ".$browser['version']." )";  ?></label></td>
				<td width="9%"><label><?php echo $data->country_name; ?></label></td>
				<td width="9%"><label><?php echo $data->ip_address; ?></label></td>
				<td width="34%"><label><?php echo $data->referer; ?></label></td>
				<td width="16%" class="last_td"><label><?php echo  date($date_format.' '.$time_format,strtotime($data->added_date)); ?></label></td>
				
            </tr>
        <?php
            }
		}
		else
		{
		?>
        	<tr style="float:left;width:100%;border:1px solid #EBEBEB;border-bottom:none;height:50px;">
            	<td colspan="7" style="float:left;width:100%;height:30px;"> <?php _e('No Entries Founds',ARP_PT_TXTDOMAIN); ?> </td>
            </tr>
        <?php
		}
        ?>
    </tbody>
    
    <tfoot style="float:left;width:100%;background:#FFFFFF;">
    	<tr style="float:left;width:100%;border:1px solid #DEDEDE;height:55px;">
        	<?php
				if($total_rows > 0)
				{
					if($total_pages > 1)
					{
			?>
        	<td id="analytics_entries">Showing <?php echo ($start_frm+1); ?> to <?php echo $per_page_rec + $start_frm; ?> of <?php echo $total_rows; ?> Entries </td>
            <?php
					}
					else if($total_pages == 1)
					{
			?>
            <td id="analytics_entries">Showing <?php echo ($start_frm+1); ?> to <?php echo $total_rows; ?> of <?php echo $total_rows; ?> Entries </td>
            <?php
					}
				}
				else
				{
			?>
            <td  id="analytics_entries">Showing 0 to 0 of 0 Entries </td>
            <?php
				}
			?>                
            <?php
				if($total_pages > 1)
				{
					$range = array('start'=>1 , 'end'=>$total_pages);
					
					if($total_pages > $no_per_pages)
					{
						if($page < $no_per_pages)
						{
							$range['start'] = 1;
							$range['end'] = $no_per_pages;
						}
						elseif($page == $no_per_pages)
						{
							$range['start'] = $page;
							$range['end'] = $page + $no_per_pages - 1;
						}
						elseif($page > $no_per_pages)
						{
							for($i=$page; $i<=$total_pages; $i++)
							{
								if($page == ((2*$no_per_pages)-1))
								{
									$range['start'] = $page;
									$range['end'] = $page + $no_per_pages - 1;		
								}
								elseif($page == $total_pages)
								{
									$range['start']=$page - 2;
									$range['end']=$page;
								}
								else
								{
									$range['start']=$page-1;
									$range['end']= $page +($no_per_pages-2);
								}
							}
						}
					}
				}
			?>
            <input type="hidden" name="range_start" id="analytics_range_start" value="<?php echo isset($range['start']) ? $range['start'] : ""; ?>" />
            <input type="hidden" name="range_end" id="analytics_range_end" value="<?php echo isset($range['end']) ? $range['end'] : ""; ?>"  />
            <td id="analytics_pagination">
            	<div class="arp_go_page_main">
                         	<span><?php _e('Go To Page',ARP_PT_TXTDOMAIN); ?></span>	 
                            <input type="text" id="go_to_page" name="go_to_page" value="" />
                         	<button id="go_to_page_btn"><?php _e('Go',ARP_PT_TXTDOMAIN); ?></button> 
                </div>
                
                <div style="width:auto; float:right;">
            	<?php
					if($total_pages > 1)
					{
				?>
                        <button id="analytics_first_page" class="first_page" style="display:none;" value="1"><i class="fa fa-lg fa-angle-double-left"></i></button>
                        <input type="hidden" value="<?php echo $total_pages; ?>" id="analytics_total_pages" />
                        <input type="hidden" value="1" id="analytics_first_page" />
                        <input type="hidden" value="1" id="analytics_current_pageno" />
                        <button id="analytics_previous_page" class="previous_page" style="display:none;" value="<?php echo ($page-1); ?>" ><i class="fa fa-angle-left fa-lg"></i></button>
                        <span id="analytics_pages">
                         
                        <?php						
                        for($i=$range['start']; $i<=$range['end']; $i++)
                        {
                            if($i == $page)
                            {
                                ?>
                                    <button id="analytics_page" class="current_page" disabled="disabled" value="<?php echo $i; ?>"><?php echo $i; ?></button>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <button class="page" id="analytics_page" value="<?php echo $i; ?>"><?php echo $i; ?></button>
                                <?php
                            }
                        }
                        ?>
                        </span>
                            <button id="analytics_next_page" class="next_page" value="<?php echo ($page+1); ?>"><i class="fa fa-angle-right fa-lg"></i></button>
                            <button id="analytics_last_page" class="last_page" value="<?php echo $total_pages; ?>"><i class="fa fa-lg fa-angle-double-right"></i></button>
				<?php
					}
				?>
                </div>
            </td>
        </tr>
    </tfoot>
</table>
</div>
<?php }else{  ?>
	<div style="float: left; font-size: 18px; margin:15px; width: 100%; font-family: 'Open Sans Semibold';"><?php _e('Sorry, there is no record found for analytics',ARP_PT_TXTDOMAIN); ?></div>
	
<?php } ?>
