<?php
function getPageTitle()
{
	return "Session List";
}

function getPageContent()
{
	global $time_frame, $year, $month, $day, $hour, $minute, $view, $limitPage, 
	$limitNumber, $wpdb, $tablestattraq, $wpst_url;
$orderBy = st_getVar("orderBy", "dd DESC");
$startDate = date("Ymd");
$endDate = date("Ymd");
$betweenClause = "WHERE session_id <> 0";
$date_format = "%Y-%m-%d %H:i";
$drill_date_format = 6;
$width = 600;
if($time_frame == 6) // months
{
	$startDate = st_createDateQueryString($year, 1, 1, 0, 0, 0);
	$endDate = st_createDateQueryString($year, 12, 31, 23, 59, 59);
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
	$drill_date_format = 8;
}
else if($time_frame == 8) // days
{
	$startDate = "{$year}" . ($month<10? "0" : "" ) . $month . "01000000";
	$endDate = "{$year}" . ($month<10? "0" : "" ) . $month . "31235959";
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
	$drill_date_format = 10;
}
else if($time_frame == 10) // hours
{
	$startDate = "{$year}" . ($month<10? "0" : "" ) . $month . ($day<10? "0" : "" ) . $day . "000000";
	$endDate = "{$year}" . ($month<10? "0" : "" ) . $month .  ($day<10? "0" : "" ) . $day . "235959";
	$betweenClause .= " AND access_time BETWEEN '$startDate' AND '$endDate'";
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

echo "<p>Click a session ID for details of that session.</p>";

$results = getPageDBResults("%Y-%m-%d %H:%i", $time_frame, $betweenClause, $orderBy);

echo "<table>" .
			"<thead>" . 
				"<tr>" .
					("<th><a href=\"{$wpst_url}view=sessions&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "\">Date</a></th>") . 
					("<th><a href=\"{$wpst_url}view=sessions&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&orderBy=" . ($orderBy == "session_id DESC" ? "session_id ASC" : "session_id DESC" ) . "\">Session</a></th>") .
				"</tr>" .
			"</thead>";
echo 		'<tfoot><tr>' .
					("<th><a href=\"{$wpst_url}view=sessions&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "\">Date</a></th>") . 
					("<th><a href=\"{$wpst_url}view=sessions&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&orderBy=" . ($orderBy == "session_id DESC" ? "session_id ASC" : "session_id DESC" ) . "\">Session</a></th>") .
				'</tr>' .
			'</tfoot>';			
echo '<tbody>';
if($results)
{
foreach($results as $row)
{
	$session_id = $row->session_id;
	echo "<tr>" .
				"<td>{$row->fmtDate}</td>" .
				"<td><a href=\"{$wpst_url}view=session&year={$year}&month={$month}&day={$day}&hour=$hour&time_frame=$drill_date_format&session_id={$session_id}\">$session_id</a></td>" .
				"<td>{$row->cnt}</td>" .
			"</tr>";
}
}else{
	echo '<tr><td>No data for this time period</td></tr>';
}
echo '</tbody></table>';
}

function getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy, $debug = false)
{
global $limitPage, $limitNumber, $wpdb, $tablestattraq;
	$sqlQuery = "SELECT DISTINCT session_id, DATE_FORMAT(access_time,'$date_format') as fmtDate, substring( access_time, 1, $time_frame  )  AS dd, COUNT(access_time) as cnt FROM $tablestattraq $betweenClause GROUP BY session_id ORDER BY $orderBy LIMIT $limitPage, $limitNumber";
	$results = $wpdb->get_results($sqlQuery);
	if($debug)
		echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $results;
}

?>