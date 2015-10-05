<?php
require_once('../wp-admin/admin.php');

function getPageContent(){
global $wpdb, $tablestattraq, $table_stattraq_options, $options, $wpst_url;
$action = st_getVar('action');
$options_defaults_view = st_getVar('options_defaults_view', 'summary');
$options_defaults_time_frame = st_getVar('options_defaults_time_frame', 10);
$options_defaults_limit_number = st_getVar('options_defaults_limit_number', 20);
$options_user_counts_hide_bots = st_getVar('options_user_counts_hide_bots', 'false');
$options_user_agents_hide_bots = st_getVar('options_user_agents_hide_bots', 'false');
$options_referrers_hide_this_blog = st_getVar('options_referrers_hide_this_blog', 'false');
$options_ip_addresses_hide_bots = st_getVar('options_ip_addresses_hide_bots', 'false');

$saved = false;
if($action=='Save')
{
	
	// default view
	$sqlQuery = "UPDATE $table_stattraq_options SET option_value='$options_defaults_view' WHERE option_name='options_defaults_view'";
	if($wpdb->query($sqlQuery) == 0 && $options_defaults_view != $wpdb->get_var("SELECT option_value FROM $table_stattraq_options WHERE option_name='options_defaults_view'"))
	{
		$sqlQuery = "INSERT INTO $table_stattraq_options (option_name, option_value) VALUES ('options_defaults_view', '$options_defaults_view')";
		$wpdb->query($sqlQuery);
	}
	
	// TIME_FRAME
	$sqlQuery = "UPDATE $table_stattraq_options SET option_value='$options_defaults_time_frame' WHERE option_name='options_defaults_time_frame'";
	if($wpdb->query($sqlQuery) == 0 && $options_defaults_time_frame != $wpdb->get_var("SELECT option_value FROM $table_stattraq_options WHERE option_name='options_defaults_time_frame'"))
	{
		$sqlQuery = "INSERT INTO $table_stattraq_options (option_name, option_value) VALUES ('options_defaults_time_frame', '$options_defaults_time_frame')";
		$wpdb->query($sqlQuery);
	}
	// options_defaults_limit_number
	$sqlQuery = "UPDATE $table_stattraq_options SET option_value='$options_defaults_limit_number' WHERE option_name='options_defaults_limit_number'";
	if($wpdb->query($sqlQuery) == 0 && $options_defaults_limit_number != $wpdb->get_var("SELECT option_value FROM $table_stattraq_options WHERE option_name='options_defaults_limit_number'"))
	{
		$sqlQuery = "INSERT INTO $table_stattraq_options (option_name, option_value) VALUES ('options_defaults_limit_number', '$options_defaults_limit_number')";
		$wpdb->query($sqlQuery);
	}
	// options_user_counts_hide_bots
	$sqlQuery = "UPDATE $table_stattraq_options SET option_value='$options_user_counts_hide_bots' WHERE option_name='options_user_counts_hide_bots'";
	if($wpdb->query($sqlQuery) == 0 && $options_user_counts_hide_bots != $wpdb->get_var("SELECT option_value FROM $table_stattraq_options WHERE option_name='options_user_counts_hide_bots'"))
	{
		$sqlQuery = "INSERT INTO $table_stattraq_options (option_name, option_value) VALUES ('options_user_counts_hide_bots', '$options_user_counts_hide_bots')";
		$wpdb->query($sqlQuery);
	}
	$sqlQuery = "UPDATE $table_stattraq_options SET option_value='$options_user_agents_hide_bots' WHERE option_name='options_user_agents_hide_bots'";
	if($wpdb->query($sqlQuery) == 0 && $options_user_agents_hide_bots != $wpdb->get_var("SELECT option_value FROM $table_stattraq_options WHERE option_name='options_user_agents_hide_bots'"))
	{
		$sqlQuery = "INSERT INTO $table_stattraq_options (option_name, option_value) VALUES ('options_user_agents_hide_bots', '$options_user_agents_hide_bots')";
		$wpdb->query($sqlQuery);
	}
	$sqlQuery = "UPDATE $table_stattraq_options SET option_value='$options_referrers_hide_this_blog' WHERE option_name='options_referrers_hide_this_blog'";
	if($wpdb->query($sqlQuery) == 0 && $options_referrers_hide_this_blog != $wpdb->get_var("SELECT option_value FROM $table_stattraq_options WHERE option_name='options_referrers_hide_this_blog'"))
	{
		$sqlQuery = "INSERT INTO $table_stattraq_options (option_name, option_value) VALUES ('options_referrers_hide_this_blog', '$options_referrers_hide_this_blog')";
		$wpdb->query($sqlQuery);
	}
	$sqlQuery = "UPDATE $table_stattraq_options SET option_value='$options_ip_addresses_hide_bots' WHERE option_name='options_ip_addresses_hide_bots'";
	if($wpdb->query($sqlQuery) == 0 && $options_ip_addresses_hide_bots != $wpdb->get_var("SELECT option_value FROM $table_stattraq_options WHERE option_name='options_ip_addresses_hide_bots'"))
	{
		$sqlQuery = "INSERT INTO $table_stattraq_options (option_name, option_value) VALUES ('options_ip_addresses_hide_bots', '$options_ip_addresses_hide_bots')";
		$wpdb->query($sqlQuery);
	}
	$saved = true;
}
$results = $wpdb->get_results("SELECT * FROM $table_stattraq_options");
if($results)
{
	foreach($results as $result){
		switch($result->option_name){
		case 'options_defaults_view':
		$options_defaults_view = $result->option_value;
		break;
		case 'options_defaults_time_frame':
		$options_defaults_time_frame = $result->option_value;
		break;
		case 'options_defaults_limit_number':
		$options_defaults_limit_number = $result->option_value;
		break;
		case 'options_user_counts_hide_bots':
		$options_user_counts_hide_bots = $result->option_value;
		break;
		case'options_user_agents_hide_bots':
		$options_user_agents_hide_bots = $result->option_value;
		break;
		case 'options_referrers_hide_this_blog':
		$options_referrers_hide_this_blog = $result->option_value;
		break;
		case 'options_ip_addresses_hide_bots':
		$options_ip_addresses_hide_bots = $result->option_value;
		break;
		}
	}
}

?>
<form action="<?php echo $wpst_url;?>view=options" method="post">
<h1><img src="/wp-content/plugins/wp-stattraq/images/summary_icon_32.gif" alt="Summary" />Options</h1>
<p class="description">
	Set options for StatTraq
</p>
<?php
	if($saved)
	{
		echo "<h3>Options Saved.</h3>";
	}elseif($options['default_view'] == 'options')
	{
		echo "<h3 style=\"color: #023ED4;\">Please choose your options to start using StatTraq.</h3>";
	}
?>
<fieldset>
	<legend>Default Settings</legend>
	<dl>
		<dt><label for="options_defaults_view">Default View</label></dt>
		<dd>
			<select name="options_defaults_view" id="options_defaults_view">
				<option value="summary"<?php echo ($options_defaults_view=='summary'?' selected="selected"':'');?>>Summary</option>
				<option value="hit_counter"<?php echo ($options_defaults_view=='hit_counter'?' selected="selected"':'');?>>Hit Counter</option>
				<option value="user_counter"<?php echo ($options_defaults_view=='user_counter'?' selected="selected"':'');?>>User Counter</option>
				<option value="page_views"<?php echo ($options_defaults_view=='page_views'?' selected="selected"':'');?>>Page Views</option>
				<option value="user_agent"<?php echo ($options_defaults_view=='user_agent'?' selected="selected"':'');?>>Browsers</option>
				<option value="referrer"<?php echo ($options_defaults_view=='referrer'?' selected="selected"':'');?>>Referrers</option>
				<option value="query_strings"<?php echo ($options_defaults_view=='query_strings'?' selected="selected"':'');?>>Search Terms</option>
			</select>
			<br />
			When the StatTraq reporter loads up, show me this view
		</dd>
		<dt><label for="options_defaults_time_frame">Default Time Period</label></dt>
		<dd>
			<select name="options_defaults_time_frame" id="options_defaults_time_frame">
				<option value="4"<?php echo ($options_defaults_time_frame == 4 ? ' selected="selected"' : '');?>>Year</option>
				<option value="8"<?php echo ($options_defaults_time_frame == 8 ? ' selected="selected"' : '');?>>Month</option>
				<option value="10"<?php echo ($options_defaults_time_frame == 10 ? ' selected="selected"' : '');?>>Day</option>
				<option value="12"<?php echo ($options_defaults_time_frame == 12 ? ' selected="selected"' : '');?>>Hour</option>
			</select>
		</dd>
		<dt>Default number of results per report</dt>
		<dd>
			<input type="radio" name="options_defaults_limit_number" value="10" id="options_defaults_limit_number_10" <?php echo ($options_defaults_limit_number==10?'checked="checked"':'');?> /><label for="options_defaults_limit_number_10">10</label>
			<input type="radio" name="options_defaults_limit_number" value="20" id="options_defaults_limit_number_20" <?php echo ($options_defaults_limit_number==20?'checked="checked"':'');?> /><label for="options_defaults_limit_number_20">20</label>
			<input type="radio" name="options_defaults_limit_number" value="50" id="options_defaults_limit_number_50" <?php echo ($options_defaults_limit_number==50?'checked="checked"':'');?> /><label for="options_defaults_limit_number_50">50</label>
			<input type="radio" name="options_defaults_limit_number" value="100" id="options_defaults_limit_number_100" <?php echo ($options_defaults_limit_number==100?'checked="checked"':'');?> /><label for="options_defaults_limit_number_100">100</label>
			<input type="radio" name="options_defaults_limit_number" value="500" id="options_defaults_limit_number_500" <?php echo ($options_defaults_limit_number==500?'checked="checked"':'');?> /><label for="options_defaults_limit_number_500">500</label>
			<input type="radio" name="options_defaults_limit_number" value="1000" id="options_defaults_limit_number_1000" <?php echo ($options_defaults_limit_number==1000?'checked="checked"':'');?> /><label for="options_defaults_limit_number_1000">1000</label>
			<br />
				You will still be able to change the number of results after setting this default value, when you first load up the StatTraq reporter you will be shown results with these settings.
		</dd>
	</dl>
</fieldset>
<fieldset>
	<legend>User Count Report Settings</legend>
	<dl>
		<dt><input type="checkbox" name="options_user_counts_hide_bots" id="options_user_counts_hide_bots" value="true" <?php echo ($options_user_counts_hide_bots != 'false'?'checked="checked"':'');?> /><label for="options_user_counts_hide_bots">Hide bots in the user count statistics</label></dt>
	</dl>
</fieldset>
<fieldset>
	<legend>Browser/User Agent Report Settings</legend>
	<dl>
		<dt><input type="checkbox" name="options_user_agents_hide_bots" id="options_user_agents_hide_bots" value="true" <?php echo ($options_user_agents_hide_bots != 'false'?'checked="checked"':'');?> /><label for="options_user_agents_hide_bots">Hide Bots from User Agent statistics</label></dt>
		<dd>
			Show <em>only</em> browsers in this list and not bots or <acronym title="Really Simple Syndication">RSS</acronym>/Atom feed aggregators.
		</dd>
</dl>
</fieldset>
<fieldset>
	<legend>IP Address Report Settings</legend>
	<dl>
		<dt><input type="checkbox" name="options_ip_addresses_hide_bots" id="options_ip_addresses_hide_bots" value="true" <?php echo ($options_ip_addresses_hide_bots != 'false'?'checked="checked"':'');?> /><label for="options_ip_addresses_hide_bots">Hide Bots from IP Address statistics</label></dt>
		<dd>
			Show <em>only</em> browsers in this list and not bots or feed spiders.
		</dd>
</dl>
</fieldset>
<fieldset>
	<legend>Referrer Report Settings</legend>
	<dl>
		<dt><input type="checkbox" name="options_referrers_hide_this_blog" id="options_referrers_hide_this_blog" value="true" <?php echo ($options_referrers_hide_this_blog != 'false'?'checked="checked"':'');?> /><label for="options_referrers_hide_this_blog">Hide this blog from referrer reports</label></dt>
	</dl>
<input type="submit" name="action" value="Save" accesskey="s" />
</fieldset>
</form>
<?php
}
function getPageTitle(){return 'Options';}
?>