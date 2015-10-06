<?php
/*
Plugin Name: StatTraq
Plugin URI: http://randypeterman.com/StatTraq
Description: This plugin will allow you to keep track of every hit on your public WordPress site (note that it does not track admin activity). To install please click <a href="admin.php?page=wp-stattraq/stattraq-install.php">here</a>.
Version: 1.3.0

*************************************************************
Version   Change
  1.1    -Changed the plugin information from Randy Peterman 
          to me as the author and mainatainer of this plugin.
         -I also add new versions of Internet Explorer, Opera,
          and Firefox to the browser lists.
         -I fixed Apple Safari to show versions information.
         -I fixed Opera versioning bug.
         -I changed $strpos to strpos.
         -I add the panel admin button for direct access to the
          Stat Traq screens.  Code from the plugin WP-stattraq-button.
  1.1.1  - Fixed the stat button to be php code instead of Java 
          Script.  This was causing issues with feeds.
    	 - Also included code to not track the admin user activities.
  1.2.6  - Now works with wordpress 2.6
	     - integrates into administration
  1.3.0  - updated to work better with WP 2.7 and up
         - Added dashboard widget
************************************************************/
require_once(ABSPATH.'/wp-admin/admin-functions.php');
require_once(ABSPATH.'/wp-content/plugins/wp-stattraq/utils.php');
global $pagenow, $menu, $submenu, $parent_file, $submenu_file;
define('ST_BROWSER', 0);
define('ST_BOT', 1);
define('ST_FEED', 2);
$browser_type = ST_BROWSER;

// used to return early if a feed request is handled first and the regular 
// StatTraq event gets called
$bFeedMeFirst = false;

if(!headers_sent()) {
	@session_start();
}
$tablestattraq = $table_prefix . 'stattraq';
$table_stattraq_options = $table_prefix . 'stattraq_options';

/*
Plugin WP-stattraq-button
*/

add_action('admin_menu', 'stattraq_menu');

/*
End of Plugin code.
*/

function stat_traq_event($passed_param){
    global $doing_rss, $p, $tablestattraq, $wpdb, $browser_type, $table_prefix,
           $cookiehash, $bFeedMeFirst;

	if($bFeedMeFirst)
	{
		return $passed_param;
	}

    $wpdb->hide_errors();
    $s_id = session_id();
    // need to get the real article_id or type of server request (RSS, RDF, ATOM, Ping, etc)
    if (is_single)
    {
    	$article_id = get_the_ID();
    }
    // global/multi request
    else
    {
    	$article_id = 0;
    }
    if(!isset($s_id)){
        $s_id = session_id();
    }

    $ipAddress = statTraqGetIPAddress();
    $urlRequested = statTraqGetPageURL();
    $browser = statTraqGetBrowser();
    $referrer = (isset($_SERVER['HTTP_REFERER']) ? "'" . $_SERVER['HTTP_REFERER'] . "'" :"NULL");
    $userAgent = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "NULL");
    $search_phrase = statTraqGetSearchPhrase($referrer);

/*


It checks whether the user is a registered, logged-in user

**********
Modifications to the existing stattraq code:
(*) global $cookiehash; (above)
(*) the longer piece of code below
(*) new condition in the if immediately below
*/
		$isIgnored = false;

		// Do not track the admin pages -- no one cares.
		if ( is_admin() || 
		     is_404() ||
			 isset($_COOKIE["wordpressuser_".$cookiehash]) || 
			 strstr($_SERVER["PHP_SELF"], "wp-login.php") ) $isIgnored = true; 

        // Test if user is admin, only get userinfo, when user is logged in
        if ( is_user_logged_in() ) {
             global $user_level;
   		     get_currentuserinfo();
             if ( $user_level > 8 ) {
			 	$isIgnored = true;
			}
        }

	if (!strstr($_SERVER['PHP_SELF'], 'wp-admin') && !strstr($_SERVER['PHP_SELF'], 'wp-stattraq') && !$isIgnored)
	{
		$wpdb->query("INSERT INTO $tablestattraq (session_id, access_time, ip_address, url, article_id, referrer, user_agent, browser, user_agent_type, search_phrase) values ('".$s_id."', NOW(), '$ipAddress','$urlRequested', '$article_id', $referrer,'$userAgent','$browser', $browser_type, " . ($search_phrase==null?"NULL" : "'$search_phrase'") . ")");
	}
    $wpdb->show_errors();
    return $passed_param;
}

function stattraq_feed_event($passed_param)
{
    global $doing_rss, $p, $tablestattraq, $wpdb, $browser_type, $table_prefix,
           $cookiehash, $bFeedMeFirst;

	$bFeedMeFirst = true;

    $wpdb->hide_errors();
    $s_id = session_id();
    // need to get the real article_id or type of server request (RSS, RDF, ATOM, Ping, etc)
    
    $article_id = 'Feed';
    if(!isset($s_id)){
        $s_id = session_id();
    }

    $ipAddress = statTraqGetIPAddress();
    $urlRequested = statTraqGetPageURL();
    $browser = statTraqGetBrowser();
    $referrer = (isset($_SERVER['HTTP_REFERER']) ? "'" . $_SERVER['HTTP_REFERER'] . "'" :"NULL");
    $userAgent = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "NULL");
    $search_phrase = statTraqGetSearchPhrase($referrer);

	$isIgnored = false;

	// Do not track the admin pages -- no one cares.
	if ( is_admin() || is_404() || isset($_COOKIE["wordpressuser_".$cookiehash]) || strstr($_SERVER["PHP_SELF"], "wp-login.php") ) 
	{
		$isIgnored = true; 
	}
    // Test if user is admin, only get userinfo, when user is logged in
    if ( is_user_logged_in() )
    {
         global $user_level;
   		 get_currentuserinfo();
         if ( $user_level > 8 ) 
         {
			$isIgnored = true;
		 }
    }

	if (!strstr($_SERVER['PHP_SELF'], 'wp-admin') && !strstr($_SERVER['PHP_SELF'], 'wp-stattraq') && !$isIgnored)
	{
		$wpdb->query("INSERT INTO $tablestattraq (session_id, access_time, ip_address, url, article_id, referrer, user_agent, browser, user_agent_type, search_phrase) values ('".$s_id."', NOW(), '$ipAddress','$urlRequested', '$article_id', $referrer,'$userAgent','$browser', $browser_type, " . ($search_phrase==null?"NULL" : "'$search_phrase'") . ")");
	}
    $wpdb->show_errors();
    return $passed_param;
}

function stattraq_menu() 
{
	if (function_exists('add_menu_page')) 
  {
    // add_menu_page('Stat Traq', 'Stat Traq', 8, '../wp-stattraq/');
    // add_menu_page('Stat Traq', 'Stat Traq', 8, '../wp-content/plugins/wp-stattraq/index.php');
    add_menu_page('Stat Traq', 'Stat Traq', 8, 'wp-stattraq/index.php');
    add_action('admin_head', 'stattraq_admin_css');
    }
}

function stattraq_admin_css()
{
    echo '<style type="text/css">';
    echo '@import \''. get_bloginfo('wpurl') .'/wp-content/plugins/wp-stattraq/styles/normal.css\';';
    echo '</style>';
}

function statTraqGetPageURL() 
{
	 return 'http' . ($_SERVER["HTTPS"] == 'on' ? 's' : '') . '://' . $_SERVER["SERVER_NAME"] . ($_SERVER["SERVER_PORT"] != '80' ? ':' . $_SERVER["SERVER_PORT"] : '' ) . $_SERVER["REQUEST_URI"];
}

function statTraqGetBrowser()
{
	global $s_id, $browser_type;
	$ua = $_SERVER['HTTP_USER_AGENT'];
	// OPERA detection
	if(strpos($ua, 'Opera') !== false){
	
	  $startpos = strpos($ua, 'Opera') + 6;
	  $endpos = $startpos + 4;
	  $vernew = substr($ua,$startpos,$endpos);
	  

		if(strpos($ua, 'Opera 3') !== false || strpos($ua, 'Opera/3') !== false)
			$ver = 3;
		else if(strpos($ua, 'Opera 4') !== false || strpos($ua, 'Opera/4') !== false)
			$ver = 4;
		else if(strpos($ua, 'Opera 5') !== false || strpos($ua, 'Opera/5') !== false)
			$ver = 5;
		else if(strpos($ua, 'Opera 6') !== false || strpos($ua, 'Opera/6') !== false)
			$ver = 6;
		else if(strpos($ua, 'Opera 7') !== false || strpos($ua, 'Opera/7') !== false)
			$ver = 7;
		else if(strpos($ua, 'Opera 8') !== false || strpos($ua, 'Opera/8') !== false)
			$ver = 8;
		else if(strpos($ua, 'Opera 9') !== false || strpos($ua, 'Opera/9') !== false)
			$ver = 9;
		else if(strpos($ua, 'Opera 10') !== false || strpos($ua, 'Opera/10') !== false)
			$ver = 10;
		else
		{
		 	$ver = '';  
		}
    
		return 'Opera ' . $ver;
		/*return 'Opera ' . $vernew; */
		
	// FeedSeeker spoofs MSIE 5
	}else if(strpos($ua, 'YahooFeedSeeker') !== false){
		$browser_type = ST_FEED;
		$s_id = "YahooFeedSeeker";
		return 'Yahoo Feed Seeker';
		
	}
	else if(strpos($ua, 'MSIE') !== false)
	{
	
    if (strpos($ua, 'MSIE ') !== false)
    {
  	  $startpos = strpos($ua, 'MSIE ') + 5;
	    $endpos = $startpos + 3;
	    $vernew = substr($ua,$startpos,$endpos);
	  }
	  else
	  {
  	  $startpos = strpos($ua, 'MSIE') + 4;
	    $endpos = $startpos + 3;
	    $vernew = substr($ua,$startpos,$endpos);
      }
		if(strpos($ua, 'MSIE 9')!==false || strpos($ua, 'MSIE9')!==false)
				$ver = 9;	
		else if(strpos($ua, 'MSIE 8')!==false || strpos($ua, 'MSIE8')!==false)
				$ver = 8;
		else if(strpos($ua, 'MSIE 7')!==false || strpos($ua, 'MSIE7')!==false)
				$ver = 7;
		else if(strpos($ua, 'MSIE 6')!==false || strpos($ua, 'MSIE6')!==false)
				$ver = 6;
		else if(strpos($ua, 'MSIE 5.5') !== false)
				$ver = 5.5;
		else if(strpos($ua, 'MSIE 5') !== false)
				$ver = 5;
		else if(strpos($ua, "MSIE 4") !== false)
			$ver = 4;
		else if(strpos($ua, 'MSIE 3') !== false)
			$ver = 3;
		else if(strpos($ua, 'MSIE 2') !== false)
			$ver = 2;
		else
			$ver = '';
		return 'Internet Explorer ' . $ver;
		/* return 'Internet Explorer ' . $vernew; */
		
	}
	else if(strpos($ua, 'Phoenix')!== false)
	{
		return 'Mozilla Phoenix';	
	}
	else if(strpos($ua, 'Firebird') !== false)
	{
	
	  $startpos = strpos($ua, 'Firebird') + 9;
	  $endpos = $startpos + 3;
	  $vernew = substr($ua,$startpos,$endpos);
	
	
		if(strpos($ua, 'Firebird/0.6')!== false)
			$ver = 0.6;
		else if(strpos($ua, 'Firebird/0.7')!== false)
			$ver = 0.7;
		else
			$ver = '';
			
		return 'Mozilla Firebird ' . $ver;
	  /* return	'Mozilla Firebird ' . $vernew;  */
	  
	}
	else if(strpos($ua, 'Firefox') !== false)
	{
	
	  $startpos = strpos($ua, 'Firefox') + 8;
	  $endpos = $startpos + 3;
	  $vernew = substr($ua,$startpos,$endpos);
	
		if(strpos($ua, '/0.9') !== false)
			$ver = 0.9;
		else if(strpos($ua, '/0.8') !== false)
			$ver = 0.8;
		else if(strpos($ua, '/0.7') !== false)
			$ver = 0.7;
		else if(strpos($ua, '/0.6') !== false)
			$ver = 0.6;
		else if(strpos($ua, '/0.5') !== false)
			$ver = 0.5;
		else if(strpos($ua, '/0.4') !== false)
			$ver = 0.4;
		else if(strpos($ua, '/0.3') !== false)
			$ver = 0.3;
		else if(strpos($ua, '/0.2') !== false)
			$ver = 0.2;
		else if(strpos($ua, '/0.1') !== false)
			$ver = 0.1;
		else if(strpos($ua, '/1.0') !== false)
			$ver = 1;
		else if(strpos($ua, '/1.1') !== false)
			$ver = 1.1;
		else if(strpos($ua, '/1.2') !== false)
			$ver = 1.2;
		else if(strpos($ua, '/1.3') !== false)
			$ver = 1.3;
		else if(strpos($ua, '/1.4') !== false)
			$ver = 1.4;
		else if(strpos($ua, '/1.5') !== false)
			$ver = 1.5;
		else if(strpos($ua, '/1.6') !== false)
			$ver = 1.6;
		else if(strpos($ua, '/1.7') !== false)
			$ver = 1.7;
		else if(strpos($ua, '/1.8') !== false)
			$ver = 1.8;
		else if(strpos($ua, '/1.9') !== false)
			$ver = 1.9;
		else if(strpos($ua, '/2.0') !== false)
			$ver = 2.0;
		else if(strpos($ua, '/3.0') !== false)
			$ver = '3.x';
		else if(strpos($ua, '/3.5') !== false)
			$ver = '3.5';
		else if(strpos($ua, '/3.6') !== false)
			$ver = '3.6';
		else if(strpos($ua, '/4.0') !== false)
			$ver = '4.0';
		else
		{
			$ver = '';
		}
    	
		return 'Mozilla Firefox ' . $ver;
		/* return 'Mozilla Firefox ' . $vernew; */
		
		
	}else if(strpos($ua, 'Safari') !== false){
			
		if(strpos($ua, '/100') !== false)
			$ver = '1.1.0';
		else if(strpos($ua, '/125.2') !== false)
			$ver = '1.2.2';
		else if(strpos($ua, '/125.4') !== false)
			$ver = '1.2.3';
		else if(strpos($ua, '/125.5.5') !== false)
			$ver = '1.2.4';
		else if(strpos($ua, '/125.5.6') !== false)
			$ver = '1.2.4';
		else if(strpos($ua, '/125.5.7') !== false)
			$ver = '1.2.4';
		else if(strpos($ua, '/125.5') !== false)
			$ver = '1.2.3';
		else if(strpos($ua, '/312.1') !== false)
			$ver = '1.3.0';
		else if(strpos($ua, '/312.5') !== false)
			$ver = '1.3.1';
		else if(strpos($ua, '/312.8') !== false)
			$ver = '1.3.2';
		else if(strpos($ua, '/85.7') !== false)
			$ver = '1.0.2';
		else if(strpos($ua, '/85.8') !== false)
			$ver = '1.0.3';
		else if(strpos($ua, '/412.7') !== false)
			$ver = '2.0.1';
		else if(strpos($ua, '/412') !== false)
			$ver = '2.0.0';
		else if(strpos($ua, '/416.1') !== false)
			$ver = '2.0.2';
		else if(strpos($ua, '/417.9') !== false)
			$ver = '2.0.3';
		else if(strpos($ua, '/418.9') !== false)
			$ver = '2.0.4';
		else if(strpos($ua, '/418.8') !== false)
			$ver = '2.0.4';
		else if(strpos($ua, '/418') !== false)
			$ver = '2.0.3';
		else
		{
			$ver = '';
		}
     
		/* return 'Apple Safari'; */
		return 'Apple Safari ' . $ver; 

		
	}else if(strpos($ua, 'Konqueror') !== false){
		return 'Konqueror';
		
	}else if(strpos($ua, 'Gecko') !== false){
		return 'Mozilla';
		
	}else if(strpos($ua, 'Lynx')!== false){
		return 'Lynx';
		
	}else if((strpos($ua, 'Mozilla/4.') !== false && 
            strpos($ua, 'compatible') !== true )|| 
            strpos($ua, 'Mozilla 4.0 (Linux)')!==false){
		return 'Netscape 4';
		
	}else if(strpos($ua, 'Mozilla/3') !== false){
		return 'Netscape 3';
		
	}else if(strpos($ua, 'LinkWalker')!== false){
		$browser_type = ST_BOT;
		$s_id = 'LinkWalker';
		return 'LinkWalker';
	}
		
// FEED PARSERS
		
///////////////////////////////////////////////////////		
// Its not a browser so it must be a Feed Parser
//////////////////////////////////////////////////////
	else if(strpos($ua, 'UniversalFeedParser') !== false)
	{
		$browser_type = ST_FEED;
		$s_id = 'UniversalFeedParser';
		return 'Universal Feed Parser';
		
	}else if(strpos($ua, 'NewsGator') !== false){
		$browser_type = ST_FEED;
		$s_id = 'NewsGator';
		return 'NewsGator';
		
	}else if(strpos($ua, 'TrillianPRO') !== false){
		$browser_type = ST_FEED;
		$s_id = 'trillianpro';
		return 'Trillian Pro';
		
	}else if(strpos($ua, 'Feedster') !== false){
		$browser_type = ST_FEED;
		$s_id = 'feedster';
		return 'Feedster';
		
	}else if(strpos($ua, 'FeedRover')){
		$browser_type = ST_FEED;
		$s_id = "FeedRover";
		return "FeedRover";
		
	}else if(strpos($ua, "lmspider") !== false){
		$browser_type = ST_FEED;
		$s_id = "lmspider";
		return "lmspider";
		
	}else if(strpos($ua, "Googlebot") !== false){
		$browser_type = ST_BOT;
		$s_id = "google";
		return "Googlebot";
		
	}else if(strpos($ua, "msnbot") !== false){
		$browser_type = ST_BOT;
		$s_id = "msnbot";
		return "msnbot";
		
	}else if(strpos($ua, "Technoratibot") !== false){
		$browser_type = ST_BOT;
		$s_id = "Technoratibot";
		return "Technoratibot";
		
	}else if(strpos($ua, "The World as a Blog")!==false){
		$browser_type = ST_BOT;
		$s_id = "The World as a Blog";
		return "The World as a Blog";
		
	}else if(strpos($ua, "blo.gs") !== false){
		$browser_type = ST_BOT;
		$s_id = "blo.gs";
		return "blo.gs";
		
	}else if(strpos($ua, "obidos-bot") !== false){
		$browser_type = ST_BOT;
		$s_id = "obidos-bot";
		return "obidos-bot";
		
	}else if(strpos($ua, "blogsnowbot") !== false){
		$browser_type = ST_BOT;
		$s_id = "blogsnowbot";
		return "blogsnowbot";
		
	}else if(strpos($ua, "Fresh Search") !== false){
		$browser_type = ST_BOT;
		$s_id = "Fresh Search";
		return "Fresh Search";
		
	}else if(strpos($ua, "larbin") !== false){
		$browser_type = ST_BOT;
		$s_id = "larbin";
		return "Larbin";
		
	}else if(strpos($ua, "Bloglines") !== false){
		$browser_type = ST_BOT;
		$s_id = "Bloglines";
		return "Bloglines";
		
	}else if(strpos($ua, "feedsucker") !== false){
		$browser_type = ST_FEED;
		$s_id = "feedsucker";
		return $s_id;
		
	}else if(strpos($ua, "NPBot") !== false){
		$browser_type = ST_BOT;
		$s_id = "npbot";
		return "NPBot";
		
	}else if(strpos($ua, "NetNewsWire")!== false){
		$browser_type = ST_FEED;
		$s_id = "NetNewsWire";
		return $s_id;
		
	}else if(strpos($ua, "almaden") !== false){	
		$browser_type = ST_BOT;
		$s_id = "almaden_ibm_crawler";
		return "IBM Research Crawler";
		
	}else if(strpos($ua, "bot") !== false){
		$browser_type = ST_BOT;
		$s_id = "bot";
		return "Bot[$ua]";
		
	}else if(strpos($ua, "FeedDemon") !== false){
		$browser_type = ST_FEED;
		return "FeedDemon";
		
	}else if(strpos($ua, "Syndic8") !== false){
		$browser_type = ST_FEED;
		$s_id = "syndic8";
		return "Syndic8";
		
	}else if(strpos($ua, "W3C_Validator") !== false){
		$browser_type = ST_BOT;
		$s_id = "w3c_validator";
		return "W3C Validator";
		
	}else if(strpos($ua, "FeedFixer") !== false){
		$browser_type = ST_FEED;
		$s_id = "feedfixer";
		return "FeedFixer";
		
	}else if(strpos($ua, "FeedValidator") !== false){
		$browser_type = ST_FEED;
		$s_id = "feedvalidator";
		return "FeedValidator";
		
	}else if((strpos($ua, "Slurp/cat") !== false) || (strpos($ua, "Yahoo! Slurp") !== false)){
		$browser_type = ST_BOT;
		$s_id = "inktomi_yahoo";
		return "Inktomi/Yahoo";
		
	}else if(strpos($ua, "FAST-WebCrawler") !== false){
		$browser_type = ST_BOT;
		$s_id = "fast_webcrawler";
		return "fast_webcrawler";
		
	}else if(strpos($ua, "Ask Jeeves") !== false){
		$browser_type = ST_BOT;
		$s_id = "askjeeves";
		return "Ask Jeeves";
		
	}else if(strpos($ua, "PubSub")!==false){
		$browser_type = ST_BOT;
		$s_id = "PubSub";
		return "PubSub";
		
	}else if(strpos($ua, "Sauce Reader")!==false){
		$browser_type = ST_FEED;
		$s_id = "Sauce Reader";
		return "Sauce Reader";
		
	}else if(strpos($ua, "BlogShares")!==false){
		$browser_type = ST_FEED;
		$s_id = "BlogShares";
		return "BlogShares";
		
	}else if(strpos($ua, "BlogPulse")!==false){
		$browser_type = ST_FEED;
		$s_id = "BlogPulse";
		return $s_id;
		
	}else if(strpos($ua, "feed") !== false){
		$browser_type = ST_BOT;
		$s_id = "nasty_spider";
		return "Some Feed Monger[$ua]";
		
	}else{
		$browser_type = ST_BOT;
		return "Other[$ua]";
	}
}

function statTraqGetIPAddress() {
    if (isset($_SERVER)) {
        if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_CLIENT_IP"])){
            return $_SERVER["HTTP_CLIENT_IP"];
        }else{
            return $_SERVER["REMOTE_ADDR"];
        }
    }else{
        if( getenv('HTTP_X_FORWARDED_FOR' )){
            return getenv( 'HTTP_X_FORWARDED_FOR' );
        }elseif( getenv( 'HTTP_CLIENT_IP' ) ) {
            return getenv( 'HTTP_CLIENT_IP' );
        }else{
            return getenv( 'REMOTE_ADDR' );
        }
    }
}

function statTraqGetQueryPairs($url){
$parsed_url = parse_url($url);
$tab=parse_url($url);
$host = $tab['host'];
if(key_exists("query",$tab)){
 $query=$tab["query"];
 return explode("&",$query);
}
else{return null;}
}

function statTraqGetSearchPhrase($referrer = null){
	global $s;
	$key = null;
	if($referrer == null){
		return null;
	}else if(strpos($referrer, "google.")!== false || strpos($referrer, "msn.com") !== false){
		$key = "q";
	}else if(strpos($referrer, "yahoo.")!== false){
		$key = "p";
	}else if(strpos($referrer, "aol.") !== false || strpos($referrer, "netscape.") !== false){
		$key = "query";
	}
	if($s != null && $s != ''){return $s;}
	if($key!=null){
		$variables = statTraqGetQueryPairs($referrer);
		$i = count($variables);
		while($i--){
		   $tab=explode("=",$variables[$i]);
			   if($tab[0] == $key){return urldecode($tab[1]);}
		}
	}else
	return null;
}

function getVisitorCount($time_frame = 'year')
{
	global $wpdb, $tablestattraq;
	
	switch($time_frame)
	{
		case 'year':
			$startDate = date("Y-01-01 00:00:00");
			$endDate = date("Y-12-31 235959");
		break;
		case 'month':
			$startDate = date("Y-m-01 00:00:00");
			$endDate = date("Y-m-t 00:00:00");
		break;
		case 'day':
			$startDate = date("Y-m-d 00:00:00");
			$endDate = date("Y-m-d 23:59:59");
		break;
		case 'hour':
			$startDate = date("Y-m-d H:00:00");
			$endDate = date("Y-m-d H:59:59");
		break;
		default:
		break;
	}
	$sqlQuery = "SELECT COUNT(DISTINCT session_id) AS cnt FROM $tablestattraq WHERE " . ('all' != $time_frame  ? "access_time BETWEEN '$startDate' AND  '$endDate' AND" : '' ) ." user_agent_type=0";
	$output = $wpdb->get_row($sqlQuery);
	return $output->cnt;
}

// Create the function to output the contents of our Dashboard Widget
function getStatTraqWidgetContents()
{
	$year = (int)date("Y");
	$month = (int)date("m");
	$day = (int)date("d");
	$hour = (int)date("H");
	$minute = (int)date("i");
	$startDate = st_createDateQueryString($year,$month,$day,0,0,0);
	$endDate = st_createDateQueryString($year,$month,$day,23,59,59);
	
	$wpst_url = get_bloginfo('wpurl') . '/wp-admin/admin.php?page=wp-stattraq/index.php&view=summary';
	$wpst_chart_url = get_bloginfo('wpurl') . "/wp-content/plugins/wp-stattraq/reporter/chart_maker.php?";
	// Display whatever it is you want to show
	
	echo '<script>';
	echo	"var stWidth = document.getElementById('StatTraq').offsetWidth-24;";
	echo	'document.write(\'';
	echo "<a href=\"{$wpst_url}\"><img id=\"chart_img\" class=\"chart-picture\" src=\"{$wpst_chart_url}chart=hit_counter&amp;time_frame=10&amp;year={$year}&amp;month={$month}&amp;day={$day}&amp;hour={$hour}&amp;minute={$minute}&amp;startDate=$startDate&amp;endDate=$endDate&amp;width=' + stWidth + '&amp;height=270&amp;orderBy=dd&amp;chart_type=hz_bar&amp;limitNumber=24\" width=\"'+stWidth+'\" height=\"270\" alt=\"chart\" />";
	echo '\');</script>';
} 

// Create the function use in the action hook
function stattraq_add_dashboard_widgets()
{
	wp_add_dashboard_widget('StatTraq', 'StatTraq', 'getStatTraqWidgetContents', null);
} 

// Hoook into the 'wp_dashboard_setup' action to register our other functions

add_action('wp_dashboard_setup', 'stattraq_add_dashboard_widgets' );



// add the call to the API request
add_action('shutdown', 'stat_traq_event');

add_action ( 'do_feed_rss2', 'stattraq_feed_event' );
add_action ( 'do_feed_atom', 'stattraq_feed_event' );
add_action ( 'do_feed_rdf', 'stat_traq_feed_event' );
?>
