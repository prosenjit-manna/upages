<?php

class arprice_analytics_chart
{
	
	function arprice_analytics_chart()
	{
		
	}
		
	function arprice_Country()
	{
		global $arprice_analytics_chart;
	
		$countries = $arprice_analytics_chart->get_country_list();

	?>
		<script type="text/javascript">
			
			
			jQuery(function(){			
				jQuery("#arprice_analysis_country").highcharts({
					chart:{
						/*plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false */
						renderTo: 'container',
            			type: 'column',
			            margin: 75,
			            options3d: {
            			    enabled: true,
			                alpha: 5,
			                beta: 5,
            			    depth: 50,
			                viewDistance: 25
            			}
						
					},
					title:{
						text: ''
					},
					tooltip: {
						pointFormat: '<b>{point.name}:{point.y}</b>',
					},
					/*plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								format: '<b>{point.name}</b>: {point.percentage:.1f} %'
							}
						}
					},*/
					plotOptions: {
            			column: {
                			depth: 25
						}
        			},
					colors: ['#29CFCD'],
					series:[{
						type:'column',
						name:'Countries',
						data: [
							<?php 
								foreach($countries as $country)
								{
									$cntry = $country->country_name;
									$cnt = $arprice_analytics_chart->country_counter($cntry);
							?>
								['<?php echo $cntry; ?>',<?php echo $cnt; ?>],
							<?php
								}
							?>
						]
					}]
				});
				
			});
        </script>
        <div id="arprice_analysis_country">
        </div>
    <?php
	}
		
	function arprice_Browser()
	{
		global $wpdb, $arprice_analytics,$arprice_analytics_chart;
		
		$main_browser = $arprice_analytics_chart->main_browsers_list();
		
		?>
        <script type="text/javascript">
			jQuery(function () {    
				jQuery('#arprice_analytics_browser_tmp').highcharts({
					chart: {
						/* type: 'column'*/
						type: 'pie',
        				    options3d: {
		                	enabled: true,
	            		    alpha: 45
				            }
					},
					title: {
						text: ''
					},
					xAxis: {
						type: 'category',
						title:{
							text: 'Browsers'
						}
					},
					yAxis: {
						title:{
							text: 'Views'
						}
					},
					legend: {
						enabled: false,
					},
					tooltip:{
						pointFormat: '<b>{point.name}:  {point.y}</b>'
					},
					/*
					plotOptions: {
						series: {
							borderWidth: 0,
							dataLabels: {
								enabled: true,
							}
						}
					},*/
					 plotOptions: {
          			  pie: {
		                innerSize: 0,
        		        depth: 45
			            }
			        },
					colors: ['#F4514C', '#30BF63', '#FFB700','#FFE721','#0CBBD6','#4c50f4'],
					series: [{
						name: 'Browser',
						colorByPoint: true,
						data:[
						<?php
							foreach($main_browser as $browser)
							{
								$brws = $browser->browser_name;
			
								$counter_main[$brws] = $arprice_analytics_chart->main_browser_counter($brws);
								
								$versions[$brws] = $arprice_analytics_chart->main_browser_version($brws);
								
						?>
								{
								name:'<?php echo $brws; ?>',
								y:<?php echo $counter_main[$brws]; ?>
								/*drilldown: '<?php // echo strtolower($brws); ?>' */
								},
						<?php	
							}
						?>
						]
					}],
					
					/*drilldown: {
						series: [
						<?php 
						?>
						],
					}*/
				})
			});
				

		</script>
        <div id="arprice_analytics_browser_tmp">
        </div>
        <?php
	}
	
	function main_browsers_list()
	{
		global $wpdb;
		
		$sql = $wpdb->get_results("SELECT DISTINCT browser_name FROM ".$wpdb->prefix."arp_arprice_analytics");
		
		return $sql;
	}
	
	function main_browser_counter($browser)
	{
		global $wpdb;
		
		$sql = $wpdb->get_results( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice_analytics WHERE browser_name = %s", $browser) );
		
		return count($sql);
	}
	
	function main_browser_version($browser)
	{
		global $wpdb;
				
		return $wpdb->get_results( $wpdb->prepare("SELECT DISTINCT browser_version FROM ".$wpdb->prefix."arp_arprice_analytics WHERE browser_name = %s", $browser) );
	}
	
	function browser_counter($version)
	{
		global $wpdb;

		$sql = $wpdb->get_results( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."arp_arprice_analytics WHERE browser_version = %s", $version) );
		
		return count($sql);
	}
	
	function country_counter($country)
	{
		global $wpdb;
		
		$sql = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."arp_arprice_analytics WHERE country_name = '".$country."'" );
		
		return count($sql);
	}
	
	function get_country_list()
	{
		global $wpdb;
		
		$table = $wpdb->prefix.'arp_arprice_analytics';
		
		$countries = $wpdb->get_results( "SELECT DISTINCT country_name FROM $table ORDER BY country_name ASC " );
		
		return $countries;
	}
	
}

?>