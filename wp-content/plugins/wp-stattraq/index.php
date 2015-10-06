<?php
/************************************************************
Version   Change
  1.1     Changed the footer information from Randy Peterman
          to me as the author.
          Fixed the code so that you can view it without logging in.
  1.1.1   Patch fix for disable login feature.
  1.2.6   This one works with wordpress 2.6, now it integrates with 
	  normal wordpress administration. Changed the footer
	  information from Murph to me as the author.

************************************************************/
// Import own css file
add_action('admin_head', 'stattraq_admin_css');
timer_start();
$options = st_loadOptions();

$year = (int)st_getVar('year',date("Y"));
$month = (int)st_getVar('month',date("m"));
$day = (int)st_getVar('day',date("d"));
$hour = (int)st_getVar('hour',date("H"));
$minute = (int)st_getVar('day',date("i"));
$view = st_getVar('view', $options['default_view']);
$time_frame = st_getVar('time_frame', $options['default_time_frame']); // day
$orderBy = st_getVar('orderBy', "dd");
$session_id = st_getVar('session_id', 'google');
$limitPage = st_getVar('limitPage',0); // the page number for the SQL query limit
$limitNumber = st_getVar('limitNumber', $options['default_limit_number']); // the number of results to be returned in the query
$showReferrerType = st_getVar('showReferrerType', 0);

$wpst_url = get_bloginfo('wpurl') . "/wp-admin/admin.php?page=wp-stattraq/index.php&";
$wpst_ip_url = get_bloginfo('wpurl') . "/wp-content/plugins/wp-stattraq/access_detail.php?";
$wpst_chart_url = get_bloginfo('wpurl') . "/wp-content/plugins/wp-stattraq/reporter/chart_maker.php?";

// TODO: Check to see if file exists
$views = array('hit_counter', 'ip_address', 'page_views', 'query_strings', 'search_engine_stats', 'referrer', 'session', 'sessions', 'summary', 'user_agent', 'user_counter', 'options');
if(in_array($view, $views))
{
	require_once(dirname(__FILE__)."/reporter/{$view}.php");
}
else
{
	echo "You hacker you.";
	exit();
}
?>
<div style="clear:right;">
<?php 
require_once('navigation.php');
?>
<div id="stcontent">
<?php
getPageContent();
?>
</div>
<div id="stfooter">
Fresh as of: <?php echo date("Y-m-d H:i:s")?><br />
Generated in: <?php timer_stop(1);?> seconds
<br />
StatTraq <?php echo $stattraq_version;?> Maintained by <a href="http://www.randypeterman.com">Randy Peterman</a>.
</div>
</div>