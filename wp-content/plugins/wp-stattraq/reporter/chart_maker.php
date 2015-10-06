<?php
require_once('../../../../wp-config.php');
#require_once(ABSPATH.'/wp-config.php');
$options = st_loadOptions();
$time_frame = st_getVar('time_frame', 8);
$chart = st_getVar("chart","hit_counter");
$limitPage = st_getVar("limitPage",0); // the page number for the SQL query limit
$limitNumber = st_getVar("limitNumber", 30); // the number of results to be returned in the query
$views = array("hit_counter", "ip_address", "page_views", "query_strings", "referrer", "session", "sessions", "summary", "user_agent", "user_counter");
if(in_array($chart, $views))
{
	require_once($chart.".php");
}
else
{
	echo "You hacker you.";
	exit();
}
   // PhpBarGraph HitLog Version 1.0
   // Bar Graph Hit Log Generator for PHP
   // Written By TJ Hunter (tjhunter@ruistech.com)
   // Released Under the GNU Public License.
   // http://www.ruistech.com/phpBarGraph

   // Specify which file format to output too.
   // $outputFormat = "gif";
    $outputFormat = "png";
   // $outputFormat = "jpg";
	// for future expansion - no other chart types are supported at this time.	
 	$chart_type = st_getVar('chart_type','hz_bar');

//chart=hit_counter
// time_frame=$time_frame&year=$year&month=$month&day=$day&date_format=$date_format&startDate=$startDate&endDate=$endDate&width=600&height=270

/*$year = getVar("year", date("Y"));
$month = getVar("month", date("m"));
$day = getVar("day", date("d"));
$hour = getVar("hour", date("H"));
$minute = getVar("minute", date("i"));*/
$startDate = st_getVar("startDate", date("Y-m-d 00:00:00"));
$endDate = st_getVar("endDate", date("Y-m-d 23:59:59"));
$imageWidth = st_getVar("width",600);
$imageHeight = st_getVar("height",270);
$betweenClause = "";
$orderBy = st_getVar("orderBy", "dd DESC");

if($time_frame != 4)
{
	$betweenClause = " WHERE access_time BETWEEN '$startDate' AND '$endDate'";
}

//   require("phpPieGraph.php");
   // Setup how high and how wide the ouput image is
   // Create a new Image
   $image = ImageCreate($imageWidth, $imageHeight);

   // Fill it with your favorite background color..
   $backgroundColor = ImageColorAllocate($image, 255, 255, 255);
   ImageFill($image, 0, 0, $backgroundColor);
   $text = ImageColorAllocate($image, 0, 0, 0);

   // Interlace the image..
   Imageinterlace($image, 1);
		$totalHits = 0;	
// HORZONTAL BAR CHART
	if($chart_type == 'hz_bar')
	{
   // We need to be able to use the bar graph class in phpBarGraph2.php
   require_once("phpBarGraph2.php");
	   // Create a new BarGraph..
	   $myBarGraph = new PhpBarGraph;
	   $myBarGraph->SetX(10);              // Set the starting x position
	   $myBarGraph->SetY(10);              // Set the starting y position
	   $myBarGraph->SetWidth($imageWidth-20);    // Set how wide the bargraph will be
	   $myBarGraph->SetHeight($imageHeight-20);  // Set how tall the bargraph will be
	   $myBarGraph->SetNumOfValueTicks(8); // Set this to zero if you don't want to show any. These are the vertical bars to help see the values.
	
		if($time_frame == 12)
		$myBarGraph->SetBarSpacing(0);
		else
	   $myBarGraph->SetBarSpacing(5);     // The default is 10. This changes the space inbetween each bar.
	
	   // Add Values to the bargraph.
	   $history=0;
	
	   $results = getChartDBResults($time_frame, $startDate, $endDate, $betweenClause, $orderBy, false);
		if($results)
		{
		$count = count($results);
	   for($i = 0;$i<$count;$i++)
	   {
			$r = $results[$i];
			$val = $r->the_value;
	      $myBarGraph->AddValue($r->the_key, $val);
			$totalHits += $val;
			$history++;
	   }
		}
	
	   // Set the colors of the bargraph..
	   $myBarGraph->SetStartBarColor("0029C1");  // This is the color on the top of every bar.
	   $myBarGraph->SetEndBarColor("00A0FA");    // This is the color on the bottom of every bar. This is not used when SetShowFade() is set to false.
	   $myBarGraph->SetLineColor("000000");      // This is the color all the lines and text are printed out with.
		$myBarGraph->SetBarLineColor("666666");

	   // Print the BarGraph to the image..
	   $myBarGraph->DrawBarGraph($image);
	}else if($chart_type == 'hz_line')
	{
   // We need to be able to use the bar graph class in phpBarGraph2.php
   require_once("phpLineGraph.php");
	   // Create a new BarGraph..
	   $myLineGraph = new PhpLineGraph;
	   $myLineGraph->SetX(10);              // Set the starting x position
	   $myLineGraph->SetY(10);              // Set the starting y position
	   $myLineGraph->SetWidth($imageWidth-20);    // Set how wide the bargraph will be
	   $myLineGraph->SetHeight($imageHeight-20);  // Set how tall the bargraph will be
	   $myLineGraph->SetNumOfValueTicks(8); // Set this to zero if you don't want to show any. These are the vertical bars to help see the values.
	
		$myLineGraph->SetBarSpacing(0);
	
	   // Add Values to the bargraph..
	   $history=0;
	
	   $results = getChartDBResults($time_frame, $startDate, $endDate, $betweenClause, $orderBy, false);
		if($results)
		{
	   $count = count($results);
	   for($i = 0;$i<$count;$i++)
	   {
			$r = $results[$i];
			$val = $r->the_value;
	      $myLineGraph->AddValue($r->the_key,$val);
			$totalHits+= $val;
			$history++;
	   }
		}
		
	   // Set the colors of the bargraph..
	   $myLineGraph->SetStartBarColor("0029C1");  // This is the color on the top of every bar.
	   $myLineGraph->SetEndBarColor("00A0FA");    // This is the color on the bottom of every bar. This is not used when SetShowFade() is set to false.
	   $myLineGraph->SetLineColor("000000");      // This is the color all the lines and text are printed out with.
		$myLineGraph->SetBarLineColor("666666");

	   // Print the BarGraph to the image..
	   $myLineGraph->DrawLineGraph($image);
	}

	
	
   Imagestring($image, 2, 2, $imageHeight-14, "$totalHits hits from " . date("Y-m-d H:i", st_longDateToTimeObj($startDate)) . " - " . date("Y-m-d H:i", st_longDateToTimeObj($endDate)) , $text);

    header("Content-type: image/png");
    // Output the Image to the browser in PNG format
    imagepng($image);

   // Destroy the image.
   Imagedestroy($image);
?> 