<?php

function my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'my_function_admin_bar');
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php bloginfo('name'); ?></title>

<?php 
global $arp_pricingtable;

$arp_pricingtable->set_front_css();
$arp_pricingtable->set_front_js();

$upload_main_url 	= PRICINGTABLE_UPLOAD_URL.'/css';

wp_print_scripts();
?>
<link rel="stylesheet" href="<?php echo PRICINGTABLE_URL.'/css/font-awesome.css'?>" type="text/css">
<link rel="stylesheet" href="<?php echo PRICINGTABLE_URL.'/css/arprice_front.css'?>" type="text/css"> 
<link rel="stylesheet" href="<?php echo PRICINGTABLE_URL.'/fonts/arp_fonts.css' ?>" type="text/css">

<style type="text/css">
input, select, textarea { outline:none; }
body{ padding:20px; }
.bestPlanButton{
	cursor:pointer;
}
html{
	overflow-y:auto;
	float:left;
	width:100%;
	height:auto;
	padding-top:0px;
}
/*@media screen and (max-width:380px){
	html{
		width:88%;
	}
}*/
.arp_body_content
{
	background:none; 
	background-color:#FFFFFF; 
	padding:20px 30px 20px 30px; 
	margin:20px 0 0; 
	overflow:hidden; 
	width:100%;
	-webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
	-o-box-sizing:border-box;
    box-sizing: border-box;
	float:left;
	height:auto;
	
}
<?php 
$mobile_size = get_option('arp_mobile_responsive_size');
$tablet_size = get_option('arp_tablet_responsive_size');
 echo "@media screen and (min-width:".($mobile_size + 1)."px) and (max-width:".$tablet_size."px){
	.arp_body_content
	{
		padding: 20px 15px 20px 15px; 	
	}
}";
?>
/*@media screen and (min-width:481px) and (max-width:768px){
	.arp_body_content
	{
		padding:40px 15px; 	
	}
}
*/
</style>
</head>

<body class="arp_body_content">
<?php 
require_once PRICINGTABLE_DIR.'/core/views/arprice_front.php';
				
$contents = arp_get_pricing_table_string( $table_id, @$pricetable_name, 1 );

$contents = apply_filters('arp_predisplay_pricingtable', $contents, $table_id);
				
echo $contents;

?>
<script type="text/javascript" language="javascript" src="<?php echo PRICINGTABLE_URL.'/js/jquery.tooltipster.js'?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PRICINGTABLE_URL.'/css/tooltipster.css'; ?>" />
<?php 
if( @$opts )
{
	$googlemap = 0;
	if( $opts['columns'] )
	{
		foreach( $opts['columns'] as $columns )
		{
			$html_content	= $columns['arp_header_shortcode'];
			if( preg_match('/arp_googlemap/', $html_content) )
				$googlemap = 1;														
		}	
	}
	
	if( $googlemap )
	{
	?>
   	<script type="text/javascript" language="javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" language="javascript" src="<?php echo PRICINGTABLE_URL.'/js/jquery.gomap-1.3.2.min.js'; ?>"></script> 
    <?php	
	}
}
?>
</body>

</html>