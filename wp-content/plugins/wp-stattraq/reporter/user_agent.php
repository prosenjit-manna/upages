<?php
function getPageTitle()
{
	return "Browsers";
}

function getPageContent()
{
global $time_frame, $year, $month, $day, $hour, $minute, $view, $limitPage, 
       $limitNumber, $wpdb, $tablestattraq, $options, $wpst_url;
$orderBy = st_getVar("orderBy", "cnt DESC");
$startDate = date("Ymd");
$endDate = date("Ymd");
$betweenClause = "";
$date_format = "%Y-%m-%d %H:i";

$first_of_month = mktime (0,0,0, $month, 1, $year);
	#remember that mktime will automatically correct if invalid dates are entered
	# for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
	# this provides a built in "rounding" feature to generate_calendar()
	$maxdays   = date('t', $first_of_month); #number of days in the month

if($time_frame == 4) // years
{
	$betweenClause = "WHERE line_id <> -1"; // bluff the where clause
	$date_format = "%Y";
}
if($time_frame == 6) // months
{
	$startDate = $year . '0100000000';
	$endDate = ($year+1) . '0101000000';
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m";
}
else if($time_frame == 8) // days
{
	$startDate = st_createDateQueryString($year, $month, 1, 0, 0, 0);
	$endDate = st_createDateQueryString($year, $month, $maxdays, 23, 59, 59);
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d";
}
else if($time_frame == 10) // hours
{
	$startDate = st_createDateQueryString($year, $month, $day, 0, 0, 0);
	$endDate = st_createDateQueryString($year, $month, $day, 23, 59, 59);;
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d %H:00";
}
// minute
else if($time_frame == 12)
{
	$startDate = st_createDateQueryString($year,$month,$day,$hour,0,0);
	$endDate = st_createDateQueryString($year,$month,$day,$hour,59,59);
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d %H:i";
}

$totalHits = 0;
$maxHits = 0;

?>
<h1><img src="/wp-content/plugins/wp-stattraq/images/user_agents_icon_32.gif" alt="Browsers" /> Browsers</h1>
<p class="description">
Displays the different user agents that have requested documents from WordPress.
You can configure the options page to not display bots and <acronym title="Really Simple Syndication">RSS</acronym>/Atom aggregators.
</p>
<?php
echo "<table>" .
	"<tr>" .
		"<td><a href=\"{$wpst_url}view=user_agent&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&limitNumber=$limitNumber&orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "\">Count</td>" .
		"<td><a href=\"{$wpst_url}view=user_agent&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&limitNumber=$limitNumber&orderBy=" . ($orderBy == "browser DESC" ? "browser ASC" : "browser DESC" ) . "\">Browser</a></td>" .
	"</tr>";

	$hideBots = ($options['user_agents_hide_bots'] == 'true' ? ' AND user_agent_type=0 ' : '' );
	
$sqlQuery = "SELECT COUNT(browser) AS cnt, browser, DATE_FORMAT(access_time,'$date_format') AS dd FROM $tablestattraq $betweenClause $hideBots GROUP BY browser ORDER By $orderBy LIMIT $limitPage, $limitNumber";
$results = $wpdb->get_results($sqlQuery);
if($results)
{
	foreach($results as $row)
	{
		echo "<tr><td>{$row->cnt}</td><td>{$row->browser}</td></tr>";
	}
}
echo "</table>";
}
?>