<?php
function getPageTitle(){return "User Counter";}

$startDate = st_createDateQueryString($year, 1, 1, 0, 0, 0);
$endDate = st_createDateQueryString($year, 12, 31, 23, 59, 59);
$betweenClause = "WHERE session_id <> 0";
$date_format = "%Y-%m-%d %H:i";
$date_format = "%Y";
$the_interval = "%m";
$drill_date_format = 6;
$width = 600;
if($time_frame == 6) // months
{
	$startDate = st_createDateQueryString($year, 1, 1, 0, 0, 0);
	$endDate = st_createDateQueryString($year, 12, 31, 23, 59, 59);
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
	$the_interval = '%m';
	$drill_date_format = 8;
}
else if($time_frame == 8) // days
{
	$startDate = "{$year}" . ($month<10? "0" : "" ) . $month . "01000000";
	$endDate = "{$year}" . ($month<10? "0" : "" ) . $month . "31235959";
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
	$the_interval = '%d';
	$drill_date_format = 10;
}
else if($time_frame == 10) // hours
{
	$startDate = "{$year}" . ($month<10? "0" : "" ) . $month . ($day<10? "0" : "" ) . $day . "000000";
	$endDate = "{$year}" . ($month<10? "0" : "" ) . $month .  ($day<10? "0" : "" ) . $day . "235959";
	$the_interval = '%H';
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
	$drill_date_format = 12;
}
// minute
else if($time_frame == 12)
{
	$startDate = st_createDateQueryString($year,$month,$day,$hour,0,0);
	$endDate = st_createDateQueryString($year,$month,$day,$hour,59,59);
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
	$drill_date_format = 0;
	$the_interval = '%i';
	$width = 780;
}

$whereUserAgentType = ( $options['user_counts_hide_bots'] == 'true'? "AND user_agent_type=0" : '' );

function getPageContent()
{
global $time_frame, $year, $month, $day, $hour, $minute, $view, $limitPage, 
	$limitNumber, $wpdb, $tablestattraq, $betweenClause, $options, $drill_date_format, 
	$startDate, $endDate, $width, $wpst_url, $wpst_chart_url;
$orderBy = st_getVar("orderBy", "dd DESC");

$totalHits = 0;
$maxHits = 0;
$rows = array();

$results = getPageDBResults("%Y-%m-%d %H:%i", $time_frame, $betweenClause, $orderBy);
if($results)
{
	foreach($results as $row)
	{
		$totalHits += $row->cnt;
		if($maxHits < $row->cnt)
			$maxHits = $row->cnt;
		$rows[] = $row;
	}
}

?>
<h1><img src="/wp-content/plugins/wp-stattraq/images/hits_icon_32.gif" alt="User Counter" />User Counter</h1>
<p>
	When a browser or user agent visits your WordPress blog each hit is recorded in the database.  StatTraq attempts to set a cookie for your blog to keep track of the user.  However, spiders and <acronym title="Really Simple Syndication">RSS</acronym> feed spiders are often counted as one visitor (Feed services sometimes act as a proxy to reduce the bandwidth required by the service and the stress this adds to your server).
</p>
<?php
echo "<br />\n<img class=\"chart-picture\" src=\"{$wpst_chart_url}chart=user_counter&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&startDate=$startDate&endDate=$endDate&width=$width&height=270&orderBy=$orderBy&amp;limitNumber={$limitNumber}\" width=\"$width\" height=\"270\" alt=\"chart\" />\n";

if(count($rows) > 0)
echo "<p>Average hits during this time period: " . number_format($totalHits/count($rows),2) . "</p>";
else
echo "<p>No hits during this time period.</p>";

echo "<table>" .
			"<thead>" . 
				"<tr>" .
					("<th><a href=\"{$wpst_url}view=user_counter&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=".urlencode($date_format) . "&orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "\">Date</a></th>") . 
					("<th><a href=\"{$wpst_url}view=user_counter&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=".urlencode($date_format) . "&orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "\">Users</a></th>") .
					("<th>perc.</th>") .
					("<th>Sessions</th>") .
				"</tr>" .
			"</thead>" .
			"<tfoot>" . 
				"<tr>" .
					("<th><a href=\"{$wpst_url}view=user_counter&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=".urlencode($date_format) . "&orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "\">Date</a></th>") . 
					("<th><a href=\"{$wpst_url}view=user_counter&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=".urlencode($date_format) . "&orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "\">Users</a></th>") .
					("<th>perc.</th>") .
					("<th>Sessions</th>") .
				"</tr>" .
			"</tfoot>";
			
echo "<tbody>\n";
foreach ($rows as $row) {
$str = $row->cnt;
    $year = $row->year;
	 $month = $row->month;
	 $day = $row->day;
	 $hour = $row->hour;
	 $minute = $row->minute;
	echo "<tr>";
		if($drill_date_format != 0)
			echo "<td><a href=\"{$wpst_url}view=user_counter&time_frame={$drill_date_format}&year={$year}&month={$month}&day={$day}&hour={$hour}&minute={$minute}\">{$row->fmtDate}</a></td>";
		else 
			echo "<td>{$row->fmtDate}</td>";
			echo "<td class=\"right\">{$row->cnt}</td>" . 
				"<td class=\"right\">" . round(($row->cnt/$totalHits)*100) . "%</td>" .
				"<td><a href=\"{$wpst_url}view=sessions&year={$year}&month={$month}&day={$day}&hour=$hour&time_frame=$drill_date_format\">Sessions</a></td>" .
			"</tr>";
}
echo "</tbody>";
echo "</table>";
}

function getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy, $debug = false)
{
global $limitPage, $limitNumber, $wpdb, $tablestattraq, $the_interval, $options, $whereUserAgentType;
	$sqlQuery = "SELECT DATE_FORMAT(access_time,'$date_format') AS fmtDate, substring( access_time, 1, $time_frame  ) AS dd, COUNT( session_id ) AS cnt, DATE_FORMAT(access_time,'%Y') AS year, DATE_FORMAT(access_time,'%m') AS month, DATE_FORMAT(access_time,'%d') AS day, DATE_FORMAT(access_time,'%H') AS hour, DATE_FORMAT(access_time,'%i') AS minute, DATE_FORMAT(access_time, '$the_interval') AS the_interval FROM $tablestattraq $betweenClause $whereUserAgentType GROUP  BY the_interval ORDER BY $orderBy LIMIT $limitPage, $limitNumber";
	$result = $wpdb->get_results($sqlQuery);
	if($debug)
		echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $result;
}

function getChartDBResults($time_frame, $startDate, $endDate, $betweenClause, $orderBy, $debug = false)
{
global $limitPage, $limitNumber, $wpdb, $tablestattraq, $the_interval, $options, $whereUserAgentType;
	if($time_frame == 4)
	{
		$date_format = "%Y";
		$interval = "";
	}
	else if($time_frame == 6)
	{
		$date_format = "%Y-%m";
		$interval = "AND access_time > DATE_SUB('$endDate', INTERVAL 12 MONTH)";
	}
	if($time_frame == 8)
	{
		$date_format = "%d";
		$interval = "AND access_time > DATE_SUB('$endDate', INTERVAL 31 DAY)";
	}
	else if($time_frame == 10)
	{
		$date_format = "%H";
		$interval = "AND access_time > DATE_SUB('$endDate', INTERVAL 24 HOUR)";
	}
	else if($time_frame == 12)
	{
		$date_format = "%i";
		$interval = "AND access_time > DATE_SUB('$endDate', INTERVAL 60 MINUTE)";
	}
	$sqlQuery = "SELECT DATE_FORMAT(access_time,'$date_format') AS dd, DATE_FORMAT(access_time,'$date_format') AS the_key , COUNT( session_id ) AS cnt, COUNT( session_id ) AS the_value FROM $tablestattraq $betweenClause $whereUserAgentType $interval AND session_id <> 0 GROUP by dd ORDER BY $orderBy LIMIT $limitPage, $limitNumber";
	$result = $wpdb->get_results($sqlQuery);
	if($debug)
		echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $result;
}
?>