<?php
function getPageTitle()
{
	return "Session Details";
}

function getPageContent()
{
global $time_frame, $year, $month, $day, $hour, $minute, $view, $session_id, $tablestattraq, $wpdb, $limitNumber, $wpst_url;
$orderBy = getVar("orderBy", "dd DESC");
$startDate = date("Ymd");
$endDate = date("Ymd");
$betweenClause = "WHERE session_id = '{$session_id}'";
$date_format = "%Y-%m-%d %H:i";
$drill_date_format = 6;
$width = 600;
if($time_frame == 4) // years
{
	$date_format = "%Y";
}
if($time_frame == 6) // months
{
	$startDate = createDateQueryString($year, 1, 1, 0, 0, 0);
	$endDate = createDateQueryString($year, 12, 31, 23, 59, 59);
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m";
	$drill_date_format = 8;
}
else if($time_frame == 8) // days
{
	$startDate = "{$year}" . ($month<10? "0" : "" ) . $month . "01000000";
	$endDate = "{$year}" . ($month<10? "0" : "" ) . $month . "31235959";
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d";
	$drill_date_format = 10;
}
else if($time_frame == 10) // hours
{
	$startDate = "{$year}" . ($month<10? "0" : "" ) . $month . ($day<10? "0" : "" ) . $day . "000000";
	$endDate = "{$year}" . ($month<10? "0" : "" ) . $month .  ($day<10? "0" : "" ) . $day . "235959";
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d %H:00";
	$drill_date_format = 12;
}
// minute
else if($time_frame == 12)
{
	$startDate = "{$year}" . ($month<10? "0" : "" ) . $month .  ($day<10? "0" : "" ) . $day . ($hour < 10?"0" : "") . "{$hour}0000";
	$endDate = "{$year}" . ($month<10? "0" : "" ) . $month .  ($day<10? "0" : "" ) . $day . ($hour < 10?"0" : "") . "5959";
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
	$drill_date_format = 0;
	$width = 780;
}

// START OF PAGE CONTENT OUTPUT

echo "<h2>Session: {$session_id}</h2>";

// SESSION DETAILS
$sqlQuery = "SELECT * FROM $tablestattraq $betweenClause LIMIT 0,1";
$row = $wpdb->get_row($sqlQuery);
echo "<dl>" . 
		"<dt>IP Address:</dt><dd><a href=\"http://ws.arin.net/cgi-bin/whois.pl?queryinput={$row->ip_address}\" target=\"_blank\" title=\"Click for Who Is Information\">{$row->ip_address}</a></dd>" . 
		"<dt>Browser:</dt><dd>{$row->browser}</dd>" . 
		"<dt>User Agent:</dt><dd>{$row->user_agent}</dd>" . 
		"<dt>Referrer:</dt><dd>{$row->referrer}</dd>" . 
	"</dl>";

$result = getPageDBResults("%Y-%m-%d %H:%i", $time_frame, $betweenClause, $orderBy, false);

echo "<table>" .
			"<thead>" . 
				"<tr>" .
					"<th><a href=\"{$wpst_url}view=session&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&limitNumber=$limitNumber&orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "\">Date</a></th>" . 
					"<th><a href=\"{$wpst_url}view=session&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&limitNumber=$limitNumber&orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "\">Page</a></th>" . 
				"</tr>" .
			"</thead>";
			
echo "<tbody>\n";
if($result)
{
	foreach($result as $row)
	{
		echo "<tr>" .
					"<td>{$row->access_time}</td>" .
					"<td>{$row->article_id}</td>" .
				"</tr>";
	}
}
echo "</tbody>";
echo "</table>";
}

function getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy, $debug = false)
{
	global $session_id, $tablestattraq, $wpdb;
	$sqlQuery = "SELECT DATE_FORMAT(access_time,'$date_format') AS access_time, substring( access_time, 1, $time_frame  )  AS dd, article_id FROM $tablestattraq $betweenClause ORDER BY $orderBy";
	$result = $wpdb->get_results($sqlQuery);
	if($debug)
		echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $result;
}

?>
