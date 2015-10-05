<?php
/************************************************************
Version   Change
  1.1     Fixed the code to reconize pages as well as posts.
************************************************************/

function getPageTitle()
{
	return "Page Views";
}

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
		$startDate = st_createDateQueryString($year, 1, 1, 0, 0, 0);;
		$endDate = st_createDateQueryString($year, 12, 31, 23, 59, 59);
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

$whereUserAgentType = ( $options['user_counts_hide_bots'] == 'true'? "AND user_agent_type=0" : '' );
	
function getPageContent()
{
	global $time_frame, $year, $month, $day, $hour, $minute, $view, $limitPage, 
	$limitNumber, $tablestattraq, $tableposts, $wpdb, $orderBy, $betweenClause, 
	$date_format, $startDate, $endDate, $drill_date_format, $width, $table_prefix,
	$wpst_url, $wpst_chart_url;

?>
  <h1><img src="/wp-content/plugins/wp-stattraq/images/pages_icon_32.gif" alt="Page Views" />Page Views</h1>
  <p class="description">
	The Number of times the public pages in WordPress were viewed.  Mixed pages are pages that have multiple posts on them.  Feed represents the RSS ant Atom feeds.
  </p>
<?php	
	$totalHits = 0;
	$maxHits = 0;
	$rows = array();
	
	$results = getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy);
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
	echo "<br />\n<img class=\"chart-picture\" src=\"{$wpst_chart_url}chart=page_views&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&startDate=$startDate&endDate=$endDate&width=$width&height=270&orderBy=$orderBy&limitPage={$limitPage}&limitNumber={$limitNumber}\" width=\"$width\" height=\"270\" alt=\"chart\" />\n";
	echo "<div id=\"chart-description\">Chart displays the number of times a page was viewed in the given time frame and the last date viewed.</div>";
	if(count($rows) > 0)
		echo "<p>Average hits during this time period: " . ($totalHits/count($rows)) . "</p>";
	else
		echo "<p>No hits during this time period.</p>";
	
	echo "<table>" .
				"<thead>" . 
					"<tr>" .
						("<th><a href=\"{$wpst_url}view=page_views&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=".urlencode($date_format) . "&orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "&amp;limitNumber={$limitNumber}\">Article</a></th>") . 
						("<th><a href=\"{$wpst_url}view=page_views&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=".urlencode($date_format) . "&orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "&amp;limitNumber={$limitNumber}\">Hits</a></th>") .
						("<th>perc.</th>") .
					"</tr>" .
				"</thead>" . 
				"<tfoot>" . 
					"<tr>" .
						("<th><a href=\"{$wpst_url}view=page_views&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=".urlencode($date_format) . "&orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "&amp;limitNumber={$limitNumber}\">Article</a></th>") . 
						("<th><a href=\"{$wpst_url}view=page_views&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=".urlencode($date_format) . "&orderBy=" . ($orderBy == "cnt DESC" ? "cnt ASC" : "cnt DESC" ) . "&amp;limitNumber={$limitNumber}\">Hits</a></th>") .
						("<th>perc.</th>") .
					"</tr>" .
				"</tfoot>";
	
				
	echo "<tbody>\n";
	$blogAddress = get_settings('home') . '/' . get_settings('blogfilename');
	foreach ($rows as $key => $row) {
	    $year = $row->year;
		 $month = $row->month;
		 $day = $row->day;
		 $hour = $row->hour;
		 $minute = $row->minute;
     
     $posts_found_table = $table_prefix . "posts";
     $quid_options = "             ";
     if (($row->article_id == 0) || ($row->article_id == 'Feed'))
     {
       $quid_options = "Blank";
     }
     else
     {
       $res2 = "SELECT guid FROM " . $posts_found_table . " WHERE ID='" . addslashes($row->article_id) . "'";
                        
       if (!mysql_query($res2))
       {
         $quid_options = "Blank";
       }
       else
       {
         $quid_options = mysql_result(mysql_query($res2),0,0);
       }
     }      
 
     if (strpos($quid_options, "page") === false)
     {
       $page_post_link = "?p=";
     }
     else
     {
       $page_post_link = "?page_id=";
     }

		if($row->article_id == '0')
			$post_title = 'Mixed';
		else if($row->article_id == 'Feed')
			$post_title = 'Feed';
		else
		{
			$post_title = $wpdb->get_row("SELECT post_title FROM $tableposts WHERE ID='{$row->article_id}'");
			$post_title = stripslashes($post_title->post_title);
		}
		echo "<tr>";
				echo "<td>". ( ((int)$row->article_id) > 0 ? "<a href=\"" . $blogAddress . $page_post_link . $row->article_id . "\">" . $post_title . "</a>"  : $post_title ) . "</td>";
				echo "<td class=\"right\">{$row->cnt}</td>" . 
					"<td class=\"right\">" . round(($row->cnt/$totalHits)*100) . "%</td>" .
				"</tr>";
	}
	echo "</tbody>";
	echo "</table>";
}

function getPageDBResults($date_format, $time_frame, $betweenClause, $orderBy, $debug = false)
{
	global $limitPage, $limitNumber, $tablestattraq, $wpdb, $whereUserAgentType;
	$sqlQuery = "SELECT article_id, COUNT( line_id ) AS cnt, DATE_FORMAT(access_time,'%Y') AS year, DATE_FORMAT(access_time,'%m') AS month, DATE_FORMAT(access_time,'%d') AS day, DATE_FORMAT(access_time,'%H') AS hour, DATE_FORMAT(access_time,'%i') AS minute, DATE_FORMAT(access_time,'$date_format') AS dd FROM $tablestattraq $betweenClause $whereUserAgentType GROUP BY article_id ORDER BY $orderBy LIMIT $limitPage, $limitNumber";
	$results = $wpdb->get_results($sqlQuery);
	if($debug)
		echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $results;
}

/*
	FUNCTION: getChartDBResults()
	DESCRIPTION:
	Returns the results for the chart_maker.php functions:
		the results are returned as a result set.
*/
function getChartDBResults($time_frame, $startDate, $endDate, $betweenClause, $orderBy, $debug = false)
{
	global $limitPage, $limitNumber, $tablestattraq, $wpdb, $whereUserAgentType;
	if($limitNumber > 20)
		$limitNumber = 20;
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
	$sqlQuery = "SELECT article_id AS dd, article_id AS the_key, COUNT( line_id ) AS cnt, COUNT( line_id ) AS the_value FROM $tablestattraq $betweenClause $whereUserAgentType $interval GROUP by article_id ORDER BY $orderBy LIMIT $limitPage, $limitNumber";
	$result = $wpdb->get_results($sqlQuery);
	if($debug)
		echo "<div class=\"SQLQuery\">Query: $sqlQuery </div>";
	return $result;
}
?>
