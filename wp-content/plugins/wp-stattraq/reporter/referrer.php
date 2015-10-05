<?php

$showReferrerType = st_getVar("showReferrerType",0);

function getPageTitle()
{
	return "Referrers";
}

function getPageContent()
{
	global $time_frame, $year, $month, $day, $hour, $minute, $view, 
	$showReferrerType, $siteName, $wpdb, $tablestattraq, $wpst_url, $limitNumber;
$orderBy = st_getVar("orderBy", "cnt DESC");
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
	$startDate = st_createDateQueryString($year,$month,$day,$hour,0,0);
	$endDate = st_createDateQueryString($year,$month,$day,$hour,59,59);
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d %H:i";
	$drill_date_format = 0;
	$width = 780;
}

$totalHits = 0;
$maxHits = 0;
$rows = array();

$results = getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy, false);
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

// START PAGE CONTENT OUTPUT

?>
<h1><img src="/wp-content/plugins/wp-stattraq/images/referrers_icon_32.gif" alt="Referrers" />Referrers</h1>
<p class="description">
	When a site refers to your WordPress blog and the browser passes referrer data this is recorded to help you know who's linking to your site.  See also the Search Terms to understand what the search engines are referring to your site for.
</p>
<?php

echo "<table>" .
			"<thead>" . 
				"<tr>" .
					("<th><a href=\"{$wpst_url}view=referrer&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&limitNumber={$limitNumber}&orderBy=" . ($orderBy == "referrer DESC" ? "referrer ASC" : "referrer DESC" ) . "\">Referrer</a></th>") . 
					("<th><a href=\"{$wpst_url}view=referrer&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&limitNumber={$limitNumber}&orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "\"># ref</a></th>") . 
					("<th>ref. %</th>") . 
					("<th><a href=\"{$wpst_url}view=referrer&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&limitNumber={$limitNumber}&orderBy=" . ($orderBy == "url DESC" ? "url ASC" : "url DESC" ) . "\">URL</a></th>") . 
				"</tr>" .
			"</thead>" .
			"<tfoot>" . 
				"<tr>" .
					("<th><a href=\"{$wpst_url}view=referrer&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&limitNumber={$limitNumber}&orderBy=" . ($orderBy == "referrer DESC" ? "referrer ASC" : "referrer DESC" ) . "\">Referrer</a></th>") . 
					("<th><a href=\"{$wpst_url}view=referrer&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&limitNumber={$limitNumber}&orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "\"># ref</a></th>") . 
					("<th>ref. %</th>") . 
					("<th><a href=\"{$wpst_url}view=referrer&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&limitNumber={$limitNumber}&orderBy=" . ($orderBy == "url DESC" ? "url ASC" : "url DESC" ) . "\">URL</a></th>") . 
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
			echo "<td><a href=\"" . htmlentities($row->referrer) . "\" target=\"_blank\">".(strlen($row->referrer) > 50 ? substr($row->referrer,0,50):$row->referrer)."</a></td>";
		else 
			echo "<td>{$row->referrer}</td>";
		echo 		"<td class=\"right\">{$row->cnt}</td>" .
					"<td class=\"right\">" . round(($row->cnt/$totalHits)*100) . "%</td>" .
					"<td>" . $row->url . "</td>" .			
					"</tr>";
}
echo "</tbody>";
echo "</table>";
}

function getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy, $debug = false)
{
global $limitPage, $limitNumber, $wpdb, $tablestattraq, $options;

$hideBots = ($options['referrers_hide_this_blog']==true ? ' AND referrer NOT LIKE "' . get_settings('home') . '%" ' : '' );

	$sqlQuery = "SELECT distinct referrer, substring( access_time, 1, $time_frame  )  AS dd, COUNT( line_id ) AS cnt, DATE_FORMAT(access_time,'%Y') AS year, DATE_FORMAT(access_time,'%m') AS month, DATE_FORMAT(access_time,'%d') AS day, DATE_FORMAT(access_time,'%H') AS hour, DATE_FORMAT(access_time,'%i') AS minute, url FROM $tablestattraq $betweenClause $hideBots AND referrer != 'NULL' GROUP BY referrer ORDER BY $orderBy LIMIT $limitPage, $limitNumber";
	$result = $wpdb->get_results($sqlQuery);
	if($debug)
		echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $result;
}

function getSearchTerm($urlStr)
{
	$result = "";
	$iIndex = 0;
	if(($iIndex = strstr($urlStr, "google")) !== false)
	{
		// TODO: look for "q=" to "&" following "q="
		$iIndex = strpos($urlStr,"q=",$iIndex+1) + 2;
		$j = $j = strpos($urlStr,"&",$iIndex+1);
		$jIndex = ($j !== false ? $j : strlen($urlStr));
		return substr($urlStr,$iIndex, $jIndex);
	}
	else if(($iIndex = strstr($urlStr, "yahoo")) !== false)
	{
		// TODO: look for "p=" to "&" following "p="
				return "Yahoo!";
	}
	else
		return $result;
}

?>