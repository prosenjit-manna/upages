<?php
	// 1.3 - fixed URLs to work for installations in sub-directories of the root 
	//       server folder, switched to using the $wpst_url variable for internal 
	// wp-stattraq links
	require_once('../wp-includes/functions.php');
	// make sure the user who is logged in, if they're logged in, has permissions to alter things.
	get_currentuserinfo();
?>
<div id="menu">
<img src="/wp-content/plugins/wp-stattraq/images/nav_logo.gif" alt="StatTraq" />
<ul class="inline">
<?php
echo 
	($view == 'summary' ? '<li class="selected">Summary</li>' : "<li><a href=\"{$wpst_url}&view=summary&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber={$limitNumber}\">Summary</a></li>") .
	($view == 'hit_counter' ? '<li class="selected">Hit Counter</li>' : "<li><a href=\"{$wpst_url}&view=hit_counter&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber={$limitNumber}\">Hit Counter</a></li>") .
	($view == 'user_counter' ? '<li class="selected">User Counter</li>' : "<li><a href=\"{$wpst_url}&view=user_counter&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber={$limitNumber}\">User Counter</a></li>") .
	($view == 'page_views' ? '<li class="selected">Page Views</li>' : "<li><a href=\"{$wpst_url}&view=page_views&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber={$limitNumber}\">Page Views</a></li>") .
	($view == "user_agent" ? "<li class=\"selected\">Browser</li>" : "<li><a href=\"{$wpst_url}&view=user_agent&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber={$limitNumber}\">Browser</a></li>") .
	($view == "referrer" ? "<li class=\"selected\">Referrer</li>" : "<li><a href=\"{$wpst_url}&view=referrer&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber={$limitNumber}\">Referrer</a></li>") .
	($view == "query_strings" ? "<li class=\"selected\">Search Terms</li>" : "<li><a href=\"{$wpst_url}&view=query_strings&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber={$limitNumber}\">Search Terms</a></li>") .
	($view == "search_engine_stats" ? "<li class=\"selected\"><acronym title=\"Search Engine\">SE</acronym> Saturation</li>" : "<li><a href=\"{$wpst_url}&view=search_engine_stats&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber={$limitNumber}\"><acronym title=\"Search Engine\">SE</acronym> Saturation</a></li>") .
	($view == "ip_address" ? "<li class=\"selected\">IP Addresses</li>" : "<li><a href=\"{$wpst_url}&view=ip_address&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber={$limitNumber}\">IP addresses</a></li>");
if($user_level >= 5)
{
	echo ($view == 'options' ? '<li class="selected">Options</li>' : '<li><a href="'.$wpst_url.'&view=options">Options</a></li>');
}
?>
</ul>
</div>
<div id="rightSide">
	<h5>Number of results per Page</h5>
	<ul class="inline">
<?php
echo 			'<li>' . ($limitNumber == 10 ? "10" : "<a href=\"{$wpst_url}&view={$view}&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber=10\">10</a>") . '</li>' .
			'<li>' . ($limitNumber == 20 ? "20" : "<a href=\"{$wpst_url}&view={$view}&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber=20\">20</a>") . '</li>' .
			'<li>' . ($limitNumber == 50 ? "50" : "<a href=\"{$wpst_url}&view={$view}&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber=50\">50</a>") . '</li>' .
			'<li>' . ($limitNumber == 100 ? "100" : "<a href=\"{$wpst_url}&view={$view}&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber=100\">100</a>") . '</li>' .
			'<li>' . ($limitNumber == 500 ? "500" : "<a href=\"{$wpst_url}&view={$view}&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber=500\">500</a>") . '</li>' .
			'<li>' . ($limitNumber == 1000 ? "1000" : "<a href=\"{$wpst_url}&view={$view}&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;limitNumber=1000\">1000</a>") . '</li>';
?>
</ul>
<h5>Select a Time Period</h5>
<ol id="timeframe">
<?php
echo
		($time_frame == 6 ? '<li class="selected">Year</li>' :  "<li><a href=\"{$wpst_url}&view={$view}&amp;time_frame=6&amp;year=$year&amp;month=$month&amp;day=$day&amp;orderBy={$orderBy}&amp;session_id={$session_id}&amp;showReferrerType={$showReferrerType}&amp;limitNumber={$limitNumber}\">Year</a></li>") .
		($time_frame == 8 ? '<li class="selected">Month</li>' :  "<li><a href=\"{$wpst_url}&view={$view}&amp;time_frame=8&amp;year=$year&amp;month=$month&amp;day=$day&amp;orderBy={$orderBy}&amp;session_id={$session_id}&amp;showReferrerType={$showReferrerType}&amp;limitNumber={$limitNumber}\">Month</a></li>") .
		($time_frame == 10 ? '<li class="selected">Day</li>' :  "<li><a href=\"{$wpst_url}&view={$view}&amp;time_frame=10&amp;year=$year&amp;month=$month&amp;day=$day&amp;orderBy={$orderBy}&amp;session_id={$session_id}&amp;showReferrerType={$showReferrerType}&amp;limitNumber={$limitNumber}\">Day</a></li>") .
		($time_frame == 12 ? '<li class=\"selected\">Hour</li>' :  "<li><a href=\"{$wpst_url}&view={$view}&amp;time_frame=12&amp;year=$year&amp;month=$month&amp;day=$day&amp;orderBy={$orderBy}&amp;session_id={$session_id}&amp;showReferrerType={$showReferrerType}&amp;limitNumber={$limitNumber}\">Hour</a></li>") .
	'</ol>';
require_once("calendar.php");
echo generate_calendar();

// if the view has more data - output it here on the right side.
if(function_exists('getRightSide'))
{
	getRightSide();
}
?>
</div>
