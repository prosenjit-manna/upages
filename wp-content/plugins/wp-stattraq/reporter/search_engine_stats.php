<?php
/*	SELECT  DISTINCT wp_posts.ID, wp_posts.post_title
FROM wp_stattraq, wp_posts
WHERE access_time > wp_posts.post_date wp_stattraq.article_id=wp_posts.ID AND wp_stattraq.browser =  'Inktomi/Yahoo' ORDER BY ID*/

function getPageTitle()
{
	return "Search Engine Saturation";
}

function getPageContent()
{
global $time_frame, $year, $month, $day, $hour, $minute, $view, $showReferrerType, $siteName, $limitNumber, $tableposts, $wpdb;
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

$google = getPageDBResults("Googlebot", $date_format, $time_frame, $betweenClause, $orderBy);
$yahoo = getPageDBResults("Inktomi/Yahoo", $date_format, $time_frame, $betweenClause, $orderBy);
$msn = getPageDBResults("msnbot", $date_format, $time_frame, $betweenClause, $orderBy);

$total = $wpdb->get_var("SELECT COUNT(ID) FROM $tableposts WHERE post_status='publish'");
$google_count = 0;
$yahoo_count = 0;
$msn_count = 0;
if($google)
{
	$google_count = $google->cnt;
}
if($yahoo)
{
	$yahoo_count = $yahoo->cnt;
}
if($msn)
{
	$msn_count = $msn->cnt;
}

?>

<h1><img src="/wp-content/plugins/wp-stattraq/images/user_agents_icon_32.gif" alt="Search Engine Saturation" />Search Engine Saturation</h1>
<p class="description">
These results do not reflect any time period but merely reflect which pages have been searched by the search engines since being added or modified.
</p>
<table>
	<thead>
		<tr>
			<th></th>
			<th>Google</th>
			<th>Yahoo</th>
			<th>MSN</th>
		</tr>
	</thead>
	<tbody>
		<?php
		echo '<tr><td>Number of Pages Indexed</td><td class="right">' . $google_count . '</td><td class="right">' . $yahoo_count . '</td><td class="right">' . $msn_count . '</td></tr>';
		echo '<tr><td>Number of Pages <em>Not</em> Indexed</td><td class="right">' . ($total - $google_count) . '</td><td class="right">' . ($total - $yahoo_count) . '</td><td class="right">' . ($total - $msn_count) . '</td></tr>';
		echo '<tr><td>Percent Saturation</td><td class="right">' . floor(($google_count/$total)*100) . '%</td><td class="right">' . floor(($yahoo_count/$total)*100) . '%</td><td class="right">' . floor(($msn_count/$total)*100) . '%</td></tr>';
		?>
	</tbody>
</table>
<h3>Submit Your Blog to the Top Search Engines</h3>
<p class="description">
	You can click the links below to add your WordPress site to the search engines' list of links to spider.
</p>
<dl>
	<dt>Google.com</dt>
	<dd><a href="http://www.google.com/addurl.html">http://www.google.com/addurl.html</a></dd>
	<dt>Yahoo.com (requires login)</dt>
	<dd><a href="http://submit.search.yahoo.com/free/request">http://submit.search.yahoo.com/free/request</a></d>
	<dt>MSN.com</dt>
	<dd><a href="http://search.msn.com/docs/submit.aspx?FORM=WSDD2">http://search.msn.com/docs/submit.aspx?FORM=WSDD2</a></d>
</dl>
<?php
}

function getPageDBResults($searchEngine, $date_format, $time_frame, $betweenClause, $orderBy, $debug = false)
{
global $wpdb, $tablestattraq, $tableposts, $limitNumber;
$sqlQuery = "SELECT COUNT(DISTINCT ID) AS cnt FROM $tablestattraq, $tableposts WHERE access_time > post_modified AND article_id=ID AND browser = '$searchEngine'";
	$wpdb->hide_errors();
	$results = $wpdb->get_row($sqlQuery);
	if($debug)
		echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $results;
}
?>