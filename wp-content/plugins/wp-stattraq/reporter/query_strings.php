<?php
function getPageTitle()
{
	return "Search Terms";
}

function getPageContent()
{
	global $time_frame, $year, $month, $day, $hour, $minute, $view, 
			$showReferrerType, $siteName, $limitNumber, $wpst_url;
$orderBy = st_getVar("orderBy", "cnt DESC");
if(strstr($orderBy, 'search_phrase')==false && strstr($orderBy, 'cnt')==false)
	$orderBy = "cnt DESC";
$startDate = date("Ymd");
$endDate = date("Ymd");
$betweenClause = "";
$date_format = "%Y-%m-%d %H:i";
$drill_date_format = 6;
$width = 600;
if($time_frame == 4) // years
{
	$date_format = "%Y";
}
if($time_frame == 6) // months
{
	$startDate = $year . '0100000000';
	$endDate = ($year+1) . '0101000000';
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m";
	$drill_date_format = 8;
}
else if($time_frame == 8) // days
{
	$startDate = "{$year}" . ($month<10? "0" : "" ) . $month . "01000000";
	$endDate = "{$year}" . ($month<10? "0" : "" ) . $month . "31235959";
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d";
	$drill_date_format = 10;
}
else if($time_frame == 10) // hours
{
	$startDate = "{$year}" . ($month<10? "0" : "" ) . $month . ($day<10? "0" : "" ) . $day . "000000";
	$endDate = "{$year}" . ($month<10? "0" : "" ) . $month .  ($day<10? "0" : "" ) . $day . "235959";
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d %H:00";
	$drill_date_format = 12;
}
// minute
else if($time_frame == 12)
{
	$startDate = "{$year}" . ($month<10? "0" : "" ) . $month .  ($day<10? "0" : "" ) . $day . ($hour < 10?"0" : "") . "{$hour}0000";
	$endDate = "{$year}" . ($month<10? "0" : "" ) . $month .  ($day<10? "0" : "" ) . $day . ($hour < 10?"0" : "") . "5959";
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d %H:i";
	$drill_date_format = 0;
	$width = 780;
}

$totalHits = 0;
$maxHits = 0;
$rows = array();

$results = getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy);
// START PAGE CONTENT OUTPUT

echo "<h1><img src=\"/wp-content/plugins/wp-stattraq/images/searches_icon_32.gif\" alt=\"Search Terms\" />Search Terms</h1>";

echo "<table>" .
			"<thead>" . 
				"<tr>" .
					'<th>Search</th>' .
					("<th><a href=\"{$wpst_url}view=query_strings&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&orderBy=" . ($orderBy == "search_phrase DESC" ? "search_phrase ASC" : "search_phrase DESC" ) . "&amp;showReferrerType=$showReferrerType&amp;limitNumber={$limitNumber}\">Search Term</a></th>") . 
					("<th><a href=\"{$wpst_url}view=query_strings&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "&amp;showReferrerType=$showReferrerType&amp;limitNumber={$limitNumber}\"># ref</a></th>") . 
				"</tr>" .
			"</thead>" .
			"<tfoot>" . 
				"<tr>" .
					'<th>Search</th>' .
					("<th><a href=\"{$wpst_url}view=query_strings&amp;time_frame=$time_frame&amp;year=$year&amp;month=$month&amp;day=$day&amp;hour=$hour&amp;minute=$minute&amp;date_format=$date_format&amp;orderBy=" . ($orderBy == "search_phrase DESC" ? "search_phrase ASC" : "search_phrase DESC" ) . "&amp;showReferrerType=$showReferrerType&amp;limitNumber={$limitNumber}\">Search Term</a></th>") . 
					("<th><a href=\"{$wpst_url}view=query_strings&amp;time_frame=$time_frame&amp;year=$year&amp;month=$month&amp;day=$day&amp;hour=$hour&amp;minute=$minute&amp;date_format=$date_format&amp;orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "&amp;showReferrerType=$showReferrerType&amp;limitNumber={$limitNumber}\"># ref</a></th>") . 
				"</tr>" .
			"</tfoot>";
			
echo "<tbody>\n";
if($results)
{
foreach($results as $row) {
	echo '<tr><td style="font-size: smaller;"><a href="http://search.yahoo.com/search?p=' . urlencode($row->search_phrase) . '" title="Search Yahoo!">Y</a>|<a href="http://search.msn.com/results.aspx?q=' . urlencode($row->search_phrase) . '" title="Search MSN">M</a></td>' . 
											'<td><a href="http://www.google.com/search?q=' . urlencode($row->search_phrase) . '" title="Search Google">' . htmlentities($row->search_phrase) .'</a></td><td class="right">'.$row->cnt.'</td></tr>';
}
}
else
{
	echo '<tr><td>No Data for this statistic</td></tr>';
}
echo "</tbody>" . "\n</table>";
}

function getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy, $debug = false)
{
global $wpdb, $tablestattraq, $limitNumber;
// If there's a between clause, add something to it.
	$sqlQuery = "SELECT search_phrase, COUNT(search_phrase) as cnt FROM $tablestattraq $betweenClause AND search_phrase != 'NULL' GROUP BY search_phrase ORDER BY $orderBy LIMIT 0, $limitNumber";
	$wpdb->hide_errors();
	$results = $wpdb->get_results($sqlQuery);
	//if($debug)
	//	echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $results;
}

?>
