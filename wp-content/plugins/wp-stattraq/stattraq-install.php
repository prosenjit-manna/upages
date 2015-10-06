<?php
/************************************************************
Version   Change
  1.1     Add the version to the web page and also give the 
          user an option to upgrade from version 1.0b (Beta)
          to the current version 1.1.  I also add 3 new indexes 
          to the stattraq table for the following fields:
          ip_address, article_id, and access_time
          I also optimize the table stattraq on the upgrade 
          options.
  1.1.1   Fixed the call to Utils.php.
  1.2.6   Changed path to wp-config and version numbers
	  removed utils.php
  1.3.0   upgrade the version to 1.3.0	  

************************************************************/


	require_once(ABSPATH.'/wp-config.php');
	$tablestattraq = $table_prefix . 'stattraq';
	$table_stattraq_options = $table_prefix . 'stattraq_options';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<title>WordPress-StatTraq Installer</title>
	<style type="text/css">
	body{
		font-family: Garamond, "Times New Roman", serif;
	}
	.word{
		color: #003399;
	}
	</style>
</head>

<body>
<h1>StatTraq for <span class="word">Word</span>Press</h1>
<h1>Version: <?php echo($stattraq_version); ?></h1>
<?php
if(isset($_GET['create_stattraq_table']))
{

	$createTableSQL = "CREATE TABLE `{$tablestattraq}` (
  `line_id` int(11) NOT NULL auto_increment,
  `session_id` varchar(128) NOT NULL default '0',
  `access_time` DATETIME NOT NULL,
  `ip_address` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `article_id` varchar(128) NOT NULL default '0',
  `user_agent` varchar(255) NOT NULL default '',
  `browser` varchar(64) default NULL,
  `user_agent_type` INT DEFAULT '0' NOT NULL,
  `referrer` varchar(255) default NULL,
  `search_phrase` varchar(255) default NULL,
  PRIMARY KEY  (`line_id`)
)";
	mysql_query($createTableSQL) or die("<strong>Could Not Create StatTraq log Table</strong><br />" . mysql_error());
	$sqlQuery = "ALTER TABLE `{$tablestattraq}` ADD INDEX ( `ip_address` )";
	mysql_query($sqlQuery) or die(mysql_error());
	$sqlQuery = "ALTER TABLE `{$tablestattraq}` ADD INDEX ( `article_id` )";
	mysql_query($sqlQuery) or die(mysql_error());
	$sqlQuery = "ALTER TABLE `{$tablestattraq}` ADD INDEX ( `access_time` )";
	mysql_query($sqlQuery) or die(mysql_error());

$sqlQuery = "CREATE TABLE {$table_stattraq_options} (
  `option_name` varchar(255) NOT NULL default '',
  `option_value` varchar(255) NOT NULL default '',
  UNIQUE KEY `option_name` (`option_name`)
)";
	mysql_query($sqlQuery) or die("<strong>Could Not Create StatTraq options Table</strong><br />" .mysql_query());
?>
<p>Woo Hoo!  Your table is ready.  Let the stats be collected and may you find your blog heavily trafficked.</p>
<p><strong>OK, NOW REMOVE THIS FILE FROM THE SERVER SO THAT PEOPLE DON'T SCREW WITH YOUR INSTALLATION!</strong></p>
<p>Go, look at some stats: <a href="/wp-admin/admin.php?page=wp-stattraq/index.php">here</a></p>
<?php
}
else if($_GET['update_stattraq_tables'])
{
	$sqlQuery = "ALTER TABLE {$tablestattraq} CHANGE `access_time` `access_time` DATETIME DEFAULT NULL";
	mysql_query($sqlQuery) or die(mysql_error());
	$sqlQuery = "ALTER TABLE `{$tablestattraq}` ADD `user_agent_type` INT DEFAULT '0' NOT NULL AFTER `browser`";
	mysql_query($sqlQuery) or die(mysql_error());
	$sqlQuery = "CREATE TABLE {$table_stattraq_options} (
  `option_name` varchar(255) NOT NULL default '',
  `option_value` varchar(255) NOT NULL default '',
  UNIQUE KEY `option_name` (`option_name`)
)";
	mysql_query($sqlQuery) or die(mysql_query());
	// TODO: create options table
 	 $sqlQuery = "UPDATE {$tablestattraq} SET user_agent_type=2 WHERE article_id = 'Feed'";
	 mysql_query($sqlQuery) or die(mysql_error());
	 
	 $sqlQuery = "UPDATE {$tablestattraq} SET user_agent_type=1 
		WHERE browser = 'Googlebot' OR
	 		browser = 'msnbot' OR
			browser = 'Technoratibot' OR
			browser = 'The World as a Blog' OR
			browser = 'blo.gs' OR
			browser = 'obidos-bot' OR
			browser = 'blogsnowbot' OR
			browser = 'Fresh Search' OR
			browser = 'Larbin' OR
			browser = 'Bloglines' OR 
			browser = 'NPBot' OR
			browser = 'IBM Research Crawler' OR
			browser = 'W3C Validator' OR
			browser = 'Inktomi/Yahoo' OR
			browser = 'fast_webcrawler' OR
			browser = 'Ask Jeeves' OR
			browser = 'PubSub'";
		mysql_query($sqlQuery) or die(mysql_error());
		
		$sqlQuery = "ALTER TABLE `{$tablestattraq}` ADD INDEX ( `ip_address` )";
  	mysql_query($sqlQuery) or die(mysql_error());
	  $sqlQuery = "ALTER TABLE `{$tablestattraq}` ADD INDEX ( `article_id` )";
	  mysql_query($sqlQuery) or die(mysql_error());
	  $sqlQuery = "ALTER TABLE `{$tablestattraq}` ADD INDEX ( `access_time` )";
	  mysql_query($sqlQuery) or die(mysql_error());
	  $sqlQuery = "OPTIMIZE TABLE `{$tablestattraq}`";
	  mysql_query($sqlQuery) or die(mysql_error());

	?>
	<p>
		You're updated and ready to roll.
	</p>
	<?php
}
else if($_GET['update_stattraq_tables_2'])
{
	$sqlQuery = "ALTER TABLE `{$tablestattraq}` ADD INDEX ( `ip_address` )";
	mysql_query($sqlQuery) or die(mysql_error());
	$sqlQuery = "ALTER TABLE `{$tablestattraq}` ADD INDEX ( `article_id` )";
	mysql_query($sqlQuery) or die(mysql_error());
	$sqlQuery = "ALTER TABLE `{$tablestattraq}` ADD INDEX ( `access_time` )";
	mysql_query($sqlQuery) or die(mysql_error());
	$sqlQuery = "OPTIMIZE TABLE `{$tablestattraq}`";
	mysql_query($sqlQuery) or die(mysql_error());
	 
	?>
	<p>
		You're updated and ready to roll.
	</p>
	<?php
}
else
{?>
<p>
	<a href="/wp-admin/admin.php?page=wp-stattraq/stattraq-install.php&create_stattraq_table=You Betcha&amp;Tony_Nuzzi_Cracks_Me_Up=True">Create the StatTraq Table for version 1.2.6</a><br />OR<br />
	<a href="/wp-admin/admin.php?page=wp-stattraq/stattraq-install.php&update_stattraq_tables=Surely&amp;Dave O=Rocks">Update from any older version prior to 1.0b (beta) to latest version of stattraq 1.1 or 1.x.x</a><br />OR<br />
	<a href="/wp-admin/admin.php?page=wp-stattraq/stattraq-install.php&update_stattraq_tables_2=awesome&amp;we will rock=you">Update from version 1.0b (Beta) to the latest version of stattraq 1.x.x</a>
</p><?php
}
?>
</body>
</html>