<?php
/************************************************************
Version   Change
  1.1    -Changed the version number from 1.0b (Beta) to 1.1
         -Add table redefines that was removed from the
          wp-settings.php file.
  1.1.1  -Changed the version number from 1.1 to 1.1.1
  1.2.6  - Changed the version number from 1.1.1 to 1.2.6

************************************************************/

$tablestattraq = $table_prefix . 'stattraq';
$table_stattraq_options = $table_prefix . 'stattraq_options';
$stattraq_version = "1.3";

global $wpdb, $tableposts, $tableusers, $tablecategories, $tablepost2cat,
       $tablecomments, $tablelinks, $tablelinkcategories, $tableoptions, 
       $tablepostmeta, $wpst_url, $wpst_chart_url, $wpst_ip_url;

$tableposts = $wpdb->posts;
$tableusers = $wpdb->users;
$tablecategories = $wpdb->categories;
$tablepost2cat = $wpdb->post2cat;
$tablecomments = $wpdb->comments;
$tablelinks = $wpdb->links;
$tablelinkcategories = $wpdb->linkcategories;
$tableoptions = $wpdb->options;
$tablepostmeta = $wpdb->postmeta;


function st_getVar($varName, $default=null)
{
	if(isset($_GET[$varName]))
		return $_GET[$varName];
	elseif(isset($_POST[$varName]))
		return $_POST[$varName];
	else
		return $default;
}

function st_getVarOrCookie($varName, $default)
{
	if(isset($_GET[$varName]))
		return $_GET[$varName];
	elseif(isset($_POST[$varName]))
		return $_POST[$varName];
	elseif(isset($_COOKIE[$varName]))
		return $_COOKIE[$varName];
	else
		return $default;
}

function st_createDateQueryString($year, $month, $day, $hour, $minute, $second)
{
	return $year . 
		($month < 10?"0":"") . $month .
		($day < 10?"0":"") . $day .
		($hour < 10?"0":"") . $hour .
		($minute < 10?"0":"") . $minute .
		($second < 10?"0":"") . $second ;
}

function st_longDateToTimeObj($lDate)
{
	$yr = intval(substr($lDate,0, 4));
	$mo = intval(substr($lDate, 4, 2));
	$dy = intval(substr($lDate, 6, 2));
	$hr = intval(substr($lDate, 8, 2));
	$mn = intval(substr($lDate, 10, 2));
	return mktime($hr, $mn, 0, $mo, $dy, $yr);
}

function st_loadOptions()
{
global $table_stattraq_options, $wpdb;
$options = array();
$options['disable_login'] = false;
$options['default_view'] = 'options';
$options['default_time_frame'] = 8;
$options['default_limit_number'] =  20;
$options['user_counts_hide_bots'] = false;
$options['user_agents_hide_bots'] = false;
$options['referrers_hide_this_blog'] = false;
$options['ip_addresses_hide_bots'] = false;
$results = $wpdb->get_results("SELECT * FROM $table_stattraq_options");
if($results)
{
	foreach($results as $result){
		switch($result->option_name){
		case 'options_defaults_disable_login':$options['disable_login'] = $result->option_value;break;
		case 'options_defaults_view':$options['default_view'] = $result->option_value;break;
		case 'options_defaults_time_frame':$options['default_time_frame'] = $result->option_value;break;
		case 'options_defaults_limit_number':$options['default_limit_number'] = $result->option_value;break;
		case 'options_user_counts_hide_bots':$options['user_counts_hide_bots'] = $result->option_value;break;
		case'options_user_agents_hide_bots':$options['user_agents_hide_bots'] = $result->option_value;break;
		case 'options_referrers_hide_this_blog':$options['referrers_hide_this_blog'] = $result->option_value;break;
		case 'options_ip_addresses_hide_bots':$options['ip_addresses_hide_bots'] = $result->option_value;break;
		}
	}
}
return $options;
}

?>