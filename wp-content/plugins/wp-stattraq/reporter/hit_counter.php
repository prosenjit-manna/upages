<?php
/************************************************************
Version   Change
  1.1    -Removed the following code because it is not used in
          the file anywhere else.  It was also causing issues 
          for PHP versions above 4.1.  $str = $row[2];
          

************************************************************/

function getPageTitle()
{
	return "Hit Counter";
}

$startDate = st_createDateQueryString($year, 1, 1, 0, 0, 0);
$endDate = st_createDateQueryString($year, 12, 31, 23, 59, 59);
$betweenClause = "WHERE line_id != 0";
$drill_date_format = 6;
$chart_type = st_getVar("chart_type", "hz_bar");
$date_format = "%Y";
$the_interval = "%m";
$width = 600;
switch($time_frame){
case 8: // days
	$startDate = st_createDateQueryString($year,$month,1,0,0,0);
	$endDate = st_createDateQueryString($year,$month,31,23,59,59);
	$date_format = "%Y-%m-%d";
	$the_interval = "%d";
	$drill_date_format = 8;
break;
case 10: // hours
	$startDate = st_createDateQueryString($year,$month,$day,0,0,0);
	$endDate = st_createDateQueryString($year,$month,$day,23,59,59);
	$date_format = "%Y-%m-%d %H:00";
	$the_interval = "%H";
	$drill_date_format = 10;
break;
case 12: // minute
	$startDate = st_createDateQueryString($year,$month,$day,$hour,0,0);
	$endDate = st_createDateQueryString($year,$month,$day,$hour,59,59);
	$date_format = "%Y-%m-%d %H:%i";
	$the_interval = "%i";
	$drill_date_format = 0;
	$width = 780;
break;
default: // do nothing, the default is above and set already.
break;
}
$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";

function getPageContent()
{
global $time_frame, $year, $month, $day, $hour, $minute, $view, $limitPage, $limitNumber, 
	$the_interval, $date_format, $startDate, $endDate, $wpdb, $tablestattraq, $options, 
	$betweenClause, $width, $drill_date_format, $chart_type, $wpst_chart_url, $wpst_url;
$orderBy = st_getVar("orderBy", "dd DESC");

$totalHits = 0;
$maxHits = 0;
$rows = array();

$results = getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy);
if($results)
{
$count = count($results);
for($i = 0;$i<$count;$i++)
{
	$row = $results[$i];
	$totalHits += $row->cnt;
	if($maxHits < $row->cnt){$maxHits = $row->cnt;}
	$rows[] = $row;
}
}
?>
<h1><img src="/wp-content/plugins/wp-stattraq/images/hits_icon_32.gif" alt="WordPress Hits" />WordPress Hits</h1>
<p class="description">
	After a page is requested in WordPress the StatTraq plugin is called to enter 
		information about the request.
	This page reflects the total number of pages requested from WordPress (excluding 
		WordPress Admin and StatTraq pages)
</p>
<?php
echo "<ul class=\"inline\">";
	echo "<li><a href=\"javascript:return false;\" onclick=\"document.getElementById('chart_img').src='{$wpst_chart_url}chart=hit_counter&amp;time_frame=$time_frame&amp;year=$year&amp;month=$month&amp;day=$day&amp;hour=$hour&amp;minute=$minute&amp;date_format=" . urlencode($date_format) . "&amp;startDate=$startDate&amp;endDate=$endDate&amp;width=$width&amp;height=270&amp;orderBy=$orderBy&amp;chart_type=hz_line&amp;limitNumber={$limitNumber}';return false;\">Line</a></li>";
	echo "<li><a href=\"javascript:return false;\" onclick=\"document.getElementById('chart_img').src='{$wpst_chart_url}chart=hit_counter&amp;time_frame=$time_frame&amp;year=$year&amp;month=$month&amp;day=$day&amp;hour=$hour&amp;minute=$minute&amp;date_format=" . urlencode($date_format) . "&amp;startDate=$startDate&amp;endDate=$endDate&amp;width=$width&amp;height=270&amp;orderBy=$orderBy&amp;chart_type=hz_bar&amp;limitNumber={$limitNumber}';return false;\">Bar</a></li>";
echo '</ul>';

echo "\n<img id=\"chart_img\" class=\"chart-picture\" src=\"{$wpst_chart_url}chart=hit_counter&amp;time_frame=$time_frame&amp;year=$year&amp;month=$month&amp;day=$day&amp;hour=$hour&amp;minute=$minute&amp;startDate=$startDate&amp;endDate=$endDate&amp;width=$width&amp;height=270&amp;orderBy=$orderBy&amp;chart_type=$chart_type&amp;limitNumber={$limitNumber}\" width=\"$width\" height=\"270\" alt=\"chart\" />\n";

if(count($rows) > 0)
echo '<p>Average hits during this time period: ' . number_format($totalHits/count($rows),2) . '</p>';
else
echo '<p>No hits during this time period.</p>';

echo '<table>' .
			'<thead>' . 
				'<tr><th></th>' .
					("<th><a href=\"{$wpst_url}view=hit_counter&amp;time_frame=$time_frame&amp;year=$year&amp;month=$month&amp;day=$day&amp;hour=$hour&amp;minute=$minute&amp;date_format=" . urlencode($date_format) . "&amp;orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "\">Date</a></th>") . 
					("<th><a href=\"{$wpst_url}view=hit_counter&amp;time_frame=$time_frame&amp;year=$year&amp;month=$month&amp;day=$day&amp;hour=$hour&amp;minute=$minute&amp;date_format=" . urlencode($date_format) . "&amp;orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "\">Hits</a></th>") .
					("<th>perc.</th>") .
					("<th>IP</th>") .
					("<th>Browser</th>") .
					("<th>Referrer</th>") .
				'</tr>' .
			'</thead>';
echo		'<tfoot>' . 
				'<tr><th></th>' .
					("<th><a href=\"{$wpst_url}view=hit_counter&amp;time_frame=$time_frame&amp;year=$year&amp;month=$month&amp;day=$day&amp;hour=$hour&amp;minute=$minute&amp;date_format=" . urlencode($date_format) . "&amp;orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "\">Date</a></th>") . 
					("<th><a href=\"{$wpst_url}view=hit_counter&amp;time_frame=$time_frame&amp;year=$year&amp;month=$month&amp;day=$day&amp;hour=$hour&amp;minute=$minute&amp;date_format=" . urlencode($date_format) . "&amp;orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "\">Hits</a></th>") .
					("<th>perc.</th>") .
					("<th>IP</th>") .
					("<th>Browser</th>") .
					("<th>Referrer</th>") .
				'</tr>' .
			'</tfoot>';
			
echo "<tbody>\n";
$i = 1;
foreach ($rows as $key => $row) {
   $year = $row->year;
	 $month = $row->month;
	 $day = $row->day;
	 $hour = $row->hour;
	 $minute =$row->minute;

	echo '<tr><td>' . $i++ . '</td>';
		if($drill_date_format != 0)
		{
			echo "<td><a href=\"{$wpst_url}view=hit_counter&amp;time_frame={$drill_date_format}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;minute={$minute}\">{$row->fmtDate}</a></td>";
		}
		else
		{ 
			echo "<td>{$row->fmtDate}</td>";
		}
			echo "<td class=\"right\">{$row->cnt}</td>" . 
				"<td class=\"right\">" . round(($row->cnt/$totalHits)*100) . "%</td>" .
				"<td><a href=\"{$wpst_url}view=ip_address&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour=$hour&amp;time_frame=$drill_date_format\">ip addresses</a></td>" .
				"<td><a href=\"{$wpst_url}view=user_agent&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour=$hour&amp;time_frame=$drill_date_format\">User Agents</a></td>" .
				"<td><a href=\"{$wpst_url}view=referrer&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour=$hour&amp;time_frame=$drill_date_format\">Referrer</a></td>" .
			"</tr>";
}
echo "</tbody>";
echo "</table>";
}

function getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy, $debug = false)
{
	global $wpdb, $limitPage, $limitNumber, $tablestattraq, $options, $the_interval;
	$whereUserAgentType = ( $options['user_counts_hide_bots'] == 'true'? "AND user_agent_type=0" : '' );
	$sqlQuery = "SELECT DATE_FORMAT(access_time,'$date_format') AS fmtDate, substring( access_time, 1, $time_frame  )  AS dd, COUNT( line_id ) AS cnt, DATE_FORMAT(access_time,'%Y') AS year, DATE_FORMAT(access_time,'%m') AS month, DATE_FORMAT(access_time,'%d') AS day, DATE_FORMAT(access_time,'%H') AS hour, DATE_FORMAT(access_time,'%i') AS minute, DATE_FORMAT(access_time, '$the_interval') AS the_interval FROM $tablestattraq $betweenClause $whereUserAgentType GROUP  BY the_interval ORDER BY $orderBy LIMIT $limitPage, $limitNumber";
	$results = $wpdb->get_results($sqlQuery);
	if($debug)
		echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $results;
}

function getChartDBResults($time_frame, $startDate, $endDate, $betweenClause, $orderBy, $debug = false)
{
	global $wpdb, $tablestattraq, $options, $the_interval, $limitNumber;
	$whereUserAgentType = ( $options['user_counts_hide_bots'] == 'true'? "AND user_agent_type=0" : '' );
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
		$interval = "AND access_time > DATE_SUB($endDate, INTERVAL 60 MINUTE)";
	}
	$sqlQuery = "SELECT DATE_FORMAT(access_time,'$date_format') AS dd, DATE_FORMAT(access_time,'$date_format') AS the_key, COUNT( line_id ) AS cnt, COUNT( line_id ) AS the_value, DATE_FORMAT(access_time, '$the_interval') AS the_interval FROM $tablestattraq $betweenClause $whereUserAgentType $interval GROUP by the_interval ORDER BY $orderBy LIMIT 0, $limitNumber";
	$results = $wpdb->get_results($sqlQuery);
	if($debug)
		echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $results;
}
?>
