<?php
/************************************************************
Version   Change
  1.1     Fixed the code so that you can view it without logging in.
  1.1.1   Patch fix for disable login feature.
  1.2.6	  admin-intgration


************************************************************/
require_once('utils.php');
$options = loadOptions();
$line_id = getVar("line_id", null);
$access_time = date("Y-m-d H:i:s");
$ip_address = "0.0.0.0";
$url = "none";
$article_id = "0";
$user_agent = "";
$browser = "";
$referrer = "";

$sqlQuery = "SELECT * FROM $tablestattraq where line_id={$line_id}";
$row = $wpdb->get_row($sqlQuery);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<title>StatTraq Access Detail</title>
	<link rel="stylesheet" type="text/css" title="style" href="styles/normal.css" />
</head>

<body>
<fieldset>
	<legend>Access Detail</legend>
<dl>
	<dt><strong>Access Time: </strong></dt>
		<dd><?php echo $row->access_time;?></dd>
	<dt><strong>IP Address: </strong></dt>
		<dd><?php echo $row->ip_address;?></>
		<a href="http://ws.arin.net/cgi-bin/whois.pl?queryinput=<?php echo $row->ip_address?>" target="_blank">whois</a></dd>
	<dt><strong>URL: </strong></dt>
		<dd><?php echo $row->url;?></dd>
	<dt><strong>Article ID: </strong></dt>
		<dd><?php echo $row->article_id;?></dd>
	<dt><strong>User Agent: </strong></dt>
		<dd><?php echo $row->user_agent;?></dd>
	<dt><strong>Browser: </strong></dt> 
		<dd><?php echo $row->browser;?></dd>
	<dt><strong>Referrer: </strong></dt>
		<dd><?php echo $row->referrer;?></dd>
</dl>
	<a href="javascript:window.close();">Close</a>
</fieldset>
</body>
</html>
