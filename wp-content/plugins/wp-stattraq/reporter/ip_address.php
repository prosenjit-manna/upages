<?php
function getPageTitle()
{
	return "IP Addresses";
}

function getPageContent()
{
global $time_frame, $year, $month, $day, $hour, $minute, $view, $limitPage, $limitNumber, $wpdb, $tablestattraq, $options, $wpst_ip_url;
?>
<script>
function toggleInfo(sLineID)
{
	var sDisplay = document.getElementById('lineid:'+sLineID).style.display;
	document.getElementById('lineid:'+sLineID).style.display = (sDisplay == 'none'? '' : 'none');
}
</script>
<h1>
IP Address
</h1>
<p class="description">
On the Internet each computer has what is called an IP address.  That is a number on a network that is used to identify the computer so that data (such as a web page) can be transmitted to the computer.  When a computer requests a web page the IP address is sent.
</p>
<?php
$ip_address = st_getVar("ip_address", null);
$orderBy = st_getVar("orderBy", "ip_address DESC");
$startDate = date("Ymd");
$endDate = date("Ymd");
$betweenClause = "";
$date_format = "%Y-%m-%d %H:i";
if($time_frame == 4) // years
{
	$date_format = "%Y";
}
if($time_frame == 6) // months
{
	$startDate = st_createDateQueryString($year, 1, 1, 0, 0, 0);
	$endDate = st_createDateQueryString($year, 12, 31, 23, 59, 59);
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m";
}
else if($time_frame == 8) // days
{
	$startDate = st_createDateQueryString($year, $month, 1, 0, 0, 0);
	$endDate = st_createDateQueryString($year, $month, 31, 23, 59, 59);
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d %H:%i";
}
else if($time_frame == 10) // hours
{
	$startDate = st_createDateQueryString($year, $month, $day, 0, 0, 0);
	$endDate = st_createDateQueryString($year, $month, $day, 23, 59, 59);
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d %H:00";
}
// minute
else if($time_frame == 12)
{
	$startDate = st_createDateQueryString($year, $month, $day, $hour, 0, 0);
	$endDate = st_createDateQueryString($year, $month, $day, $hour, 59, 59);
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
	$date_format = "%Y-%m-%d %H:i";
}

$totalHits = 0;
$maxHits = 0;
$rows = array();

if($ip_address != null)
	$betweenClause .= " AND ip_address = '{$ip_address}'";

$hideBots = ($options['ip_addresses_hide_bots'] == 'true' ? ' AND user_agent_type=0 ' : '' );
	
$sqlQuery = "SELECT DISTINCT ip_address, DATE_FORMAT(access_time,'$date_format') AS dd, browser, line_id, article_id FROM $tablestattraq $betweenClause $hideBots GROUP BY dd, ip_address ORDER BY $orderBy LIMIT $limitPage, $limitNumber";
$results = $wpdb->get_results($sqlQuery);
echo "<table cellpadding=\"4\">" .
	"<tr>" .
		"<th><a href=\"index.php?view=ip_address&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&orderBy=" . ($orderBy == "dd DESC" ? "dd ASC" : "dd DESC" ) . "\">time</a></th>" .
		"<th><a href=\"index.php?view=ip_address&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&orderBy=" . ($orderBy == "ip_address DESC" ? "ip_address ASC" : "ip_address DESC" ) . "\">ip</a></th>" . 
		"<th><a href=\"index.php?view=ip_address&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&orderBy=" . ($orderBy == "browser DESC" ? "browser ASC" : "browser DESC" ) . "\">Browser</a></th>" .
		"<th>Article</th>" .
		"<th>Who Is</th>" .
		"<th>Info</th>" .
	"</tr>";
if($results)
{
	foreach($results as $row)
	{
		echo "<tr>\n\t" .
				"<td>{$row->dd}</td>" . // date
				"<td><a href=\"index.php?view=ip_address&time_frame=$time_frame&year=$year&month=$month&day=$day&hour=$hour&minute=$minute&date_format=$date_format&ip_address={$row->ip_address}\">{$row->ip_address}</a></td>" . // IP Address
				"<td>{$row->browser}</td>" . // Browser
				"<td>{$row->article_id}</td>" . // Article ID
				"<td><a href=\"http://ws.arin.net/cgi-bin/whois.pl?queryinput={$row->ip_address}\" target=\"_blank\">whois</a></td>" . 
				"<td><a href=\"#\" onclick=\"toggleInfo('{$row->line_id}')\">info</a></td>" . 
			"</tr>\n";
			
		echo "<tr id=\"lineid:{$row->line_id}\" style=\"display:none;\">\n\t" .
			"<td colspan=\"6\">";
		$sqlQuery = "SELECT * FROM $tablestattraq where line_id={$row->line_id}";
		$access = $wpdb->get_row($sqlQuery);
		
		?>
		<dl>
			<dt><strong>Access Time: </strong></dt>
				<dd><?php echo $access->access_time;?></dd>
			<dt><strong>IP Address: </strong></dt>
				<dd><?php echo $access->ip_address;?></>
				<a href="http://ws.arin.net/cgi-bin/whois.pl?queryinput=<?php echo $access->ip_address?>" target="_blank">whois</a></dd>
			<dt><strong>URL: </strong></dt>
				<dd><?php echo $access->url;?></dd>
			<dt><strong>Article ID: </strong></dt>
				<dd><?php echo $access->article_id;?></dd>
			<dt><strong>User Agent: </strong></dt>
				<dd><?php echo $access->user_agent;?></dd>
			<dt><strong>Browser: </strong></dt> 
				<dd><?php echo $access->browser;?></dd>
			<dt><strong>Referrer: </strong></dt>
				<dd><?php echo $access->referrer;?></dd>
		</dl>
		<?php
			echo "</td></tr>\n";
			
	}
}
echo "</table>";
}
?>