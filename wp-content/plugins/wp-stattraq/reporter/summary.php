<?php
/************************************************************
Version   Change
  1.1     Fixed the code to reconize pages as well as posts.
************************************************************/

#require_once('utils.php');

function getmicrotime()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
} 

$STARTTIME = getmicrotime(false);
$LASTTIME = $STARTTIME;
$TIMESTAMPCOUNT=0;

function PrintTimestamp()
{
   global $STARTTIME, $LASTTIME, $TIMESTAMPCOUNT;
   $now = getmicrotime(false);
   echo "\n\n<!-- [TIME] ";
   echo "Elapsed: ".number_format($now-$STARTTIME,4);
   echo "  Delta: ".number_format($now-$LASTTIME, 6);
   echo "  Now: ".$now;
   echo "  Instance: ".$TIMESTAMPCOUNT++;
   echo " -->\n\n";
   $LASTTIME = $now;
}

$startDate = st_createDateQueryString($year, 1, 1, 0, 0, 0);
$endDate = st_createDateQueryString($year, 12, 31, 23, 59, 59);
$date_format = "%Y-%m";
$the_interval = "%m";
switch($time_frame){
case 8: // days
	$startDate = st_createDateQueryString($year,$month,1,0,0,0);
	$endDate = st_createDateQueryString($year,$month,31,23,59,59);
	$date_format = "%Y-%m-%d";
	$the_interval = "%d";
break;
case 10: // hours
	$startDate = st_createDateQueryString($year,$month,$day,0,0,0);
	$endDate = st_createDateQueryString($year,$month,$day,23,59,59);
	$date_format = "%Y-%m-%d %H:00";
	$the_interval = "%H";	
break;
case 12: // minute
	$startDate = st_createDateQueryString($year,$month,$day,$hour,0,0);
	$endDate = st_createDateQueryString($year,$month,$day,$hour,59,59);
	$date_format = "%Y-%m-%d %H:%i";
	$the_interval = "%i";
break;
default: // do nothing, the default is above and set already.
break;
}
$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";

$whereUserAgentType = ($options['user_counts_hide_bots'] == 'true'? "AND user_agent_type=0" : '' );

function getPageContent()
	{
global $time_frame, $year, $month, $day, $hour, $minute, $view, $limitPage, $startDate, $endDate, $date_format, $the_interval,
		$limitNumber, $wpdb, $tablestattraq, $tableposts, $tablecomments, $tableusers, $tableposts, $betweenClause, $options, $whereUserAgentType,
    $table_prefix, $wpst_url;
$wpdb->show_errors();
?>
<h1><img src="/wp-content/plugins/wp-stattraq/images/summary_icon_32.gif" alt="Summary" />Summary</h1>
<p class="description">
	The Summary view groups much of the data in StatTraq in an easy-to-view page.  
	By clicking on the description header for each table you should be able to 
		see more detail for each section.
	Alternately you can navigate StatTraq with the menu on the lefthand side of 
		the page.
</p>
<?php
	$sqlQuery = "SELECT COUNT(session_id) AS sticky_cnt FROM $tablestattraq $betweenClause $whereUserAgentType AND session_id != 'NULL' AND session_id != '' GROUP BY session_id ORDER BY sticky_cnt DESC";
	$results = $wpdb->get_results($sqlQuery);
	$total_sessions = count($results);
	$total_sticky_cnt = 0;
	if($results)
	{
		foreach($results as $row)
		{
			if($row->sticky_cnt > 2)
				++$total_sticky_cnt;
			else
				break;
		}
	}
	if($total_sessions != 0)
	$percent_sticky = round(($total_sticky_cnt/$total_sessions)*100);
	else
		$percent_sticky = 0;

	$num_posts = $wpdb->get_var("SELECT COUNT( DISTINCT ID ) FROM $tableposts");
	$num_users = $wpdb->get_var("SELECT COUNT( DISTINCT ID ) FROM $tableusers");
	$num_comments = $wpdb->get_var("SELECT COUNT( DISTINCT comment_ID ) FROM $tablecomments");
?>
	<strong>Posts:</strong>
	<?php echo number_format($num_posts);?>
	<strong>Users:</strong>
	<?php echo number_format($num_users);?>
	<strong>Comments:</strong>
	<?php echo number_format($num_comments);?>
	<strong>Stickiness:</strong>
	<?php echo $percent_sticky;?>% <a href="javascript:alert('Stickiness is measured by finding the sessions that have multiple page views associated with them.');"
 title="What is this?">?</a>
<?php echo  PrintTimestamp();?>
<div id="pages">
			<h5 class="caption"><a href="<?php echo $wpst_url;?>view=page_views<?php echo '&amp;time_frame=',$time_frame,'&amp;year=',$year,'&amp;month=',$month,'&amp;day=',$day,'&amp;limitNumber='.$limitNumber;?>">Most Viewed Posts</a></h5>
			<table id="pagesTable" style="table-layout: fixed;">
					<colgroup>
						<col width="5%" />
						<col width="85%" />
						<col width="10%" />
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Page</th>
							<th>Views</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Page</th>
							<th>Views</th>
						</tr>
					</tfoot>		
					<tbody>
			<?php
				$count = $wpdb->get_row("SELECT COUNT(DISTINCT line_id) as cnt FROM $tablestattraq $betweenClause $whereUserAgentType AND article_id=0 GROUP BY article_id");
				echo '<tr class="Feed"><td>&nbsp;</td><td>Multiple Posts</td><td class="right">' , number_format($count->cnt) , '</td></tr>';
				$count = $wpdb->get_row("SELECT article_id, COUNT(DISTINCT line_id) as cnt FROM $tablestattraq $betweenClause $whereUserAgentType AND article_id='Feed' GROUP BY article_id");
				echo '<tr class="Feed"><td>&nbsp;</td><td>RSS/Atom/Feeds</td><td class="right">' , number_format($count->cnt) , '</td></tr>';
				
				$results = $wpdb->get_results("SELECT DISTINCT $tablestattraq.article_id, $tableposts.post_title, COUNT( DISTINCT $tablestattraq.line_id ) AS cnt FROM $tablestattraq, $tableposts $betweenClause $whereUserAgentType AND $tablestattraq.article_id=$tableposts.ID GROUP BY $tablestattraq.article_id ORDER BY cnt DESC LIMIT 0, $limitNumber");
				$i = 0;
				if($results){
		    	$blogAddress = get_settings('home') . '/' . get_settings('blogfilename');
					foreach($results as $row)
					{
					
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
					  
					?><tr class="<?php echo ($i % 2 == 0 ? 'even' : 'odd' );?>"><td><?php echo ++$i;?></td><td><a href="<?php echo $blogAddress . $page_post_link , $row->article_id;?>"> <?php echo stripslashes($row->post_title);?></a></td><td class="right"><?php echo number_format($row->cnt);?></td></tr>
<?php
					}
				}
?>
			</tbody>
		</table>
		<?php echo PrintTimestamp();?>
	</div>
	<div id="userAgents">
		<h5 class="caption"><a href="<?php echo $wpst_url;?>view=user_agent<?php echo "&amp;time_frame={$time_frame}&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;limitNumber={$limitNumber}"?>">User Agents</a></h5>
				<table id="userAgentsTable">
					<thead>
						<tr>
							<th>#</th>
							<th>User Agent</th>
							<th>Hits</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>User Agent</th>
							<th>Hits</th>
						</tr>
					</tfoot>		
					<tbody>
			<?php
			$results = $wpdb->get_results("SELECT COUNT( DISTINCT line_id) AS cnt, browser FROM $tablestattraq $betweenClause" . ($options['user_agents_hide_bots'] == 'true' ? " AND user_agent_type=0" : "" ) . " GROUP BY browser ORDER By cnt DESC LIMIT 0, $limitNumber");
			$i = 0;
			if($results){
				foreach($results as $row){
			?>
				<tr class="<?php echo ($i % 2 == 0 ? 'even' : 'odd' );?>"><td><?php echo ++$i;?></td><td><?php echo $row->browser;?></td><td class="right"><?php echo number_format($row->cnt);?></td></tr>
				<?php
				}
			}
			?>
					</tbody>
				</table>
				<?php echo  PrintTimestamp();?>
			</div>
			<div id="referrers">
				<h5 class="caption"><a href="<?php echo $wpst_url;?>view=referrer&amp;time_frame=<?php echo $time_frame,'&amp;year=',$year,'&amp;month=',$month,'&amp;day=',$day,'&amp;limitNumber=',$limitNumber?>">Referrers</a></h5>
				<table id="referrersTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Referrer</th>
							<th>Count</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Referrer</th>
							<th>Count</th>
						</tr>
					</tfoot>		
					<tbody>
			<?php
				
				$results = $wpdb->get_results('SELECT distinct referrer AS ref, COUNT( line_id ) AS cnt, url FROM '.$tablestattraq. ' ' . $betweenClause .' AND referrer != \'NULL\'' . ($options['referrers_hide_this_blog']==true ? ' AND referrer NOT LIKE "' . get_settings('home') . '%" ' : '' ) . ' GROUP BY referrer ORDER BY cnt DESC LIMIT 0,' . $limitNumber);
				$i = 0;
				if($results){
					$url = $short_url = "";
					foreach($results as $row){
						$short_url = substr($row->ref,0, 50);
					?>
						<tr class="<?php echo ($i % 2 == 0 ? 'even' : 'odd' );?>"><td><?php echo ++$i;?></td><td><a href="<?php echo htmlentities($row->ref);?>" title="<?php echo htmlentities($row->ref);?>"><?php echo $short_url;?> </a></td><td class="right"><?php echo number_format($row->cnt);?></td></tr>
					<?php
					}
				}
			?>
					</tbody>
				</table>
				<?php echo PrintTimestamp();?>
			</div>
			<div id="queryTerms">
				<h5 class="caption"><a href="<?php echo $wpst_url;?>view=query_strings&amp;time_frame=<?php echo $time_frame,'&amp;year=',$year,'&amp;month=',$month,'&amp;day=',$day,'&amp;limitNumber=',$limitNumber?>">Search Terms</a></h5>
				<table id="queryTermsTable">
					<colgroup>
						<col width="5%" align="right" />
						<col width="5%" />
						<col width="85%" />
						<col width="4%" align="right" />
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Search</th>
							<th>Term</th>
							<th>Referrals</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Search</th>
							<th>Term</th>
							<th>Referrals</th>
						</tr>
					</tfoot>
					<tbody>
					<?php
				$sqlQuery = "SELECT search_phrase, COUNT(search_phrase) as cnt FROM $tablestattraq $betweenClause AND search_phrase != 'NULL' GROUP BY search_phrase ORDER BY cnt DESC, access_time DESC LIMIT $limitPage, $limitNumber";
				$results = $wpdb->get_results($sqlQuery);
				$i = 0;
				if($results){
					$search_phrase = "";
					foreach($results as $row){
							$search_phrase = urlencode($row->search_phrase);
					?>
					<tr class="<?php echo ($i % 2 == 0 ? 'even' : 'odd' );?>"><td><?php echo ++$i;?></td><td style="font-size: smaller;"><a href="http://search.yahoo.com/search?p=<?php echo $search_phrase;?>" title="Search Yahoo!">Y</a>|<a href="http://search.msn.com/results.aspx?q=<?php echo $search_phrase ;?>" title="Search MSN">M</a></td><td><a href="http://www.google.com/search?q=<?php echo $search_phrase;?>" title="Search Google"><?php echo $row->search_phrase;?> </a></td><td class="right"><?php echo number_format($row->cnt);?></td></tr>
					<?php
					}
				}
				?>
					</tbody>
				</table>
				<?php echo PrintTimestamp();?>
			</div>
<!--[if IE]>
<script type="text/javascript">
	var width = (document.getElementById('pages').offsetWidth-12) + 'px'
	document.getElementById('pagesTable').style.width = width;
	document.getElementById('userAgentsTable').style.width = width;
	document.getElementById('queryTermsTable').style.width = width;
	document.getElementById('referrersTable').style.width = width;
</script>
<![endif]-->
<?php
	} // end getPageContent();

function getRightSide(){
	global $time_frame, $year, $month, $day, $hour, $minute, $view, $limitPage,  $startDate, $endDate, $date_format, $the_interval,
		$limitNumber, $wpdb, $tablestattraq, $tableposts, $tablecomments, $tableusers, $betweenClause, $whereUserAgentType;
?>
	<div id="hits">
		<h5 class="caption"><a href="index.php?view=hit_counter&amp;time_frame=<?php echo $time_frame,'&amp;year=',$year,'&amp;month=',$month,'&amp;day=',$day,'&amp;limitNumber=',$limitNumber?>" title="Click here for more detailed results about hits to the site.">Hits &amp; Users</a></h5>
	<table class="tabular" width="25%">
		<thead>
			<tr>
				<th>Time</th>
				<th>Hits</th>
				<th>Users</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Time</th>
				<th>Hits</th>
				<th>Users</th>
			</tr>
		</tfoot>
		<tbody>
<?php
$results = $wpdb->get_results("SELECT DATE_FORMAT(access_time,  '$date_format') AS db_date, 
DATE_FORMAT(access_time, '$the_interval') AS the_interval, 
COUNT( DISTINCT line_id )  AS cnt, 
COUNT(  DISTINCT session_id )  AS SID_cnt
FROM $tablestattraq
$betweenClause
$whereUserAgentType
GROUP  BY the_interval
ORDER  BY the_interval DESC");
	$total_hits = 0;
	$total_users = 0;
	$i = 1;
	if($results)
	{
		foreach($results as $row)
		{
			$total_hits += $row->cnt;
			$total_users += $row->SID_cnt;
		?>
			<tr class="<?php echo ($i++ % 2 == 0 ? 'even' : 'odd' );?>"><td><?php echo $row->db_date;?></td><td class="right"><?php echo number_format($row->cnt);?></td><td class="right"><?php echo number_format($row->SID_cnt);?></td></tr>
		<?php
		}
	}
?>
		<tr><td>Total</td><td class="right"><?php echo number_format($total_hits);?></td><td class="right"><?php echo number_format($total_users)?></td></tr>
		</tbody>
	</table>
	<?php echo  PrintTimestamp();?>
</div>
<?
	}
	
	function getPageTitle(){return 'Summary';}
?>
