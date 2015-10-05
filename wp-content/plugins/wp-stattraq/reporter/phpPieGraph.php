<?php

/*
phpGD Pie Chart V1.0
Released: Oct. 13, 2003
Copyright 2003 AdeptiSoft.com. All rights reserved.

Server Requirements: PHP 4.x with PNG support, GD 1.x or greater
License: Freeware (Limited Use)
For commercial use please email us at graphs@adeptisoft.com

Instructions:
1) Copy this file along with the adepti_logo.png to your web site.
   (note: you will need to change the $full_img_url path if you
    copy these to any directory other than your web root directory.)
1) Edit the "Settings" and "Data" section to fit your needs.
2) Insert the graph into your web page: <img src="adepti_graph.php">
3) Visit our web site/forums for more help. www.adeptisoft.com
*/

header("Content-type: image/png");

/* Settings */
$max=40;
$graph_width=340;
$graph_height=280;
$graph_title="This is a test!";
$graph_padding=10;

$use_logo=0; //Add logo to the bottom of your graph? 1-Yes 0-No
//$full_img_url=$_SERVER["DOCUMENT_ROOT"] . "/adepti_logo.png"; //You may change this to your own logo

/* Data */
$pie_array = array("test1" => 392,
                   "test2" => 290,
                   "test3" => 193);

$pie_array_sum = array_sum($pie_array);
$i=0;
$first=0;

function PrintGraph($pie_array) {

	global $graph_width,$graph_height,$graph_title,$graph_padding,$use_logo,$full_img_url,$first,$i,$pie_array_sum;

	$im = imagecreate($graph_width,$graph_height);

	if($use_logo==1) {

	    /* Import logo */
	    $logo=ImageCreateFromPNG($full_img_url);

	    /* Get size of imported logo */
	    $logo_size=GetImageSize($full_img_url);
	    $logo_width=$logo_size[0];
	    $logo_height=$logo_size[1];

	    /* Copy the logo into the graph */
	    $logo_dst_x=$graph_width-$logo_width-$graph_padding; //How far from left to position
	    $logo_dst_y=$graph_height-$logo_height-$graph_padding-0; //How far from top to position
	    ImageCopy($im, $logo, $logo_dst_x, $logo_dst_y, 0, 0, $logo_width, $logo_height);

	}

	/* Make our color palette */
	$white = ImageColorAllocate($im, 255, 255, 255);
	$black = ImageColorAllocate($im, 0, 0, 0);
	$darkblue = ImageColorAllocate($im, 72, 107, 143);
	$mediumgrey = ImageColorAllocate($im, 210, 210, 210);
	$color[] = ImageColorAllocate($im, 255, 0, 0);
	$color[] = ImageColorAllocate($im, 255, 0, 255);
	$color[] = ImageColorAllocate($im, 0, 0, 255);
	$color[] = ImageColorAllocate($im, 0, 255, 255);
	$color[] = ImageColorAllocate($im, 0, 255, 0);
	$color[] = ImageColorAllocate($im, 255, 255, 0);

	/* Fill the border of the whole graph with blue */
	ImageRectangle($im, 0, 0, $graph_width-1, $graph_height-1, $darkblue);

	ImageString($im, 5, $graph_width/2-strlen($graph_title)*4, $graph_padding, $graph_title, $black);

	foreach($pie_array as $name => $value) {

	    $pie_value = round(360 * ( $value / $pie_array_sum ),0);

	    /* Draw pie slices */
	    /* Draw pie slice with black border and filled with color */
	    ImageFilledArc($im, 130, 120+$graph_padding+20, 175, 175, $first, $pie_value+$first, $color[$i], IMG_ARC_PIE);
	    ImageFilledArc($im, 130, 120+$graph_padding+20, 175, 175, $first, $pie_value+$first, $black, IMG_ARC_EDGED | IMG_ARC_NOFILL);
		 $new_pie_value = 0;
	    $math=($pie_value/2)+$new_pie_value;
	    $new_pie_value=$pie_value+$new_pie_value;

	    //Determine padding for x and y position for numbers next to pie slices
	    $pie_padding=number_padding($math);
	    $x_padding=$pie_padding["x"];
	    $y_padding=$pie_padding["y"];

	    ImageString($im, 2, round(130+(cos(deg2rad($math))*(175/2)))+$x_padding, round(120+(sin(deg2rad($math))*(175/2)))+$y_padding+20, $value, $black);

	    $extra=$extra+15;
	    $first=$first+$pie_value;

	    /* Draw the key */
	    /* Draw the rectangles with black border */
	    ImageRectangle($im, 130+130-1, $graph_padding+40+$extra-1, 140+130+1, $graph_padding+30+$extra+1+20, $black);
	    ImageFilledRectangle($im, 130+130, $graph_padding+40+$extra, 140+130, $graph_padding+30+$extra+20, $color[$i]);

	    /* Draw the string name next to each rectangle */
	    ImageString($im, 2, 130+80+65, $graph_padding+40+$extra, "$name", $black);
	    $i++;

	}

	/* Print the copyright */
	/* Note: Please leave our copyright as-is. */
	$copyright="Copyright 2003 - AdeptiSoft.com";
	ImageString($im, 3, $graph_width/2-strlen($copyright)*3.5, $graph_padding+120+10+120, $copyright, $mediumgrey);

	imagepng($im);
	imagedestroy($im);

}

function number_padding($math) {

	if($math<46) { $x_padding=5; $y_padding=5; }
	if($math>=46 AND $math<91) { $x_padding=20; $y_padding=10; }
	if($math>=91 AND $math<136) { $x_padding=-20; $y_padding=10; }
	if($math>=136 AND $math<181) { $x_padding=-25; $y_padding=0; }
	if($math>=181 AND $math<226) { $x_padding=-20; $y_padding=0; }
	if($math>=226 AND $math<271) { $x_padding=-15; $y_padding=-5; }
	if($math>=269 AND $math<316) { $x_padding=0; $y_padding=-5; }
	if($math>=316 AND $math<361) { $x_padding=5; $y_padding=0; }

	return array("x" => $x_padding, "y" => $y_padding);

}

PrintGraph($pie_array);

?>