<?php
   // PhpLineGraph Version 1.0
   // Adapted from the Bar Graph Generator for PHP Written By TJ Hunter (tjhunter@ruistech.com)
	// Adapted by Randy Peterman
   // Released Under the GNU Public License.
   // http://www.randypeterman.com

class PhpLineGraph
{
   /* -------------------------------- */
   /* Preference Variables             */
   /* -------------------------------- */
   var $_debug;
   var $_image;            // The image to print the bargraph too.
   var $_x;                // The starting column of the bargraph
   var $_y;                // The starting row of the bargraph
   var $_width;            // The width of the bargraph
   var $_height;           // The height of the bargraph
   var $_startBarColorHex; // The top color of the bargraph
   var $_endBarColorHex;   // The bottom color of the bargraph
   var $_lineColorHex;     // The color of the lines and text
	var $_barLineColorHex;  // The color of the lines around the bars
   var $_barSpacing;       // The spacing width in between each bar
   var $_numOfValueTicks;  // The number of horizontal rule ticks
   var $_values;           // An array of arrays of the values of each bargraph and it's label
   var $_showLabels;       // If true, print the labels to the image
   var $_showValues;       // If true, print the values to the image
   var $_showBarBorder;    // If true, draws a box of around each bar
   var $_showFade;         // If true, draws each bar with a gradient
   var $_showOuterBox;     // If true, draws the box on the outside of the bargraph

   /* -------------------------------- */
   /* Private Variables                */
   /* -------------------------------- */
   var $_topMargin;
   var $_bottomMargin;
   var $_leftMargin;
   var $_rightMargin;
   var $_barWidth;
   var $_minBarHeight;
   var $_maxBarHeight;
   var $_realMinBarHeight;
   var $_realMaxBarHeight;
   var $_buffer;

   function PhpLineGraph()
   {
      $this->_debug = false;
      $this->_values = array();
      $this->_startBarColorHex = "0000ff";
      $this->_endBarColorHex = "ffffff";
      $this->_lineColorHex = "000000";
		$this->_barLineColorHex = "000000";
      $this->_barSpacing = 10;
      $this->_numOfValueTicks = 4;
      $this->_buffer = .5;
      $this->_showLabels = true;
      $this->_showValues = true;
      $this->_showBarBorder = true;
      $this->_showFade = true;
      $this->_showOuterBox = true;
   }

   function AddValue($labelName, $theValue)
   {
		$new_array = array("label" => $labelName, "value" => $theValue);
		if(gettype($new_array) == "array")
	      array_push($this->_values, $new_array);
		else
		{
			echo "Some other type: " . gettype($new_array);
		}
   }

   function SetDebug($debug)
   {
      $this->_debug = $debug;
   }

   function SetX($x)
   {
      $this->_x = $x;
   }

   function SetY($y)
   {
      $this->_y = $y;
   }

   function SetWidth($width)
   {
      $this->_width = $width;
   }

   function SetHeight($height)
   {
      $this->_height = $height;
   }

   function SetStartBarColor($color)
   {
      $this->_startBarColorHex = $color;
   }

   function SetEndBarColor($color)
   {
      $this->_endBarColorHex = $color;
   }

   function SetLineColor($color)
   {
      $this->_lineColorHex = $color;
   }
	
	function setBarLineColor($color)
	{
		$this->_barLineColor = $color;
	}

   function SetBarSpacing($barSpacing)
   {
      $this->_barSpacing = $barSpacing;
   }

   function SetNumOfValueTicks($ticks)
   {
      $this->_numOfValueTicks = $ticks;
   }

   function SetShowLabels($labels)
   {
      $this->_showLabels = $labels;
   }

   function SetShowValues($values)
   {
      $this->_showValues = $values;
   }

   function SetBarBorder($border)
   {
      $this->_showBarBorder = $border;
   }

   function SetShowFade($fade)
   {
      $this->_showFade = $fade;
   }

   function SetShowOuterBox($box)
   {
      $this->_showOuterBox = $box;
   }


   function RGBColor($hexColor) // Returns an array of decimal values from a hex color
   {
      $r = hexdec(substr($hexColor, 0, 2));
      $g = hexdec(substr($hexColor, 2, 2));
      $b = hexdec(substr($hexColor, 4, 2));

      $RGBColors = array("red" => $r, "green" => $g, "blue" => $b);

      return $RGBColors;
   }

   function DebugPrint() // Prints a bunch of debug information.
   {
      foreach($this->_values as $value)
      {
         echo $value["label"] . "=" . $value["value"] . "<br>\n";
      }

      $startColor = $this->RGBColor($this->_startBarColorHex);
      echo "StartColor: " . $startColor["red"] . ", " . $startColor["green"] . ", " . $startColor["blue"] . "<br>\n";

      $endColor = $this->RGBColor($this->_endBarColorHex);
      echo "EndColor: " . $endColor["red"] . ", " . $endColor["green"] . ", " . $endColor["blue"] . "<br>\n";

      $lineColor = $this->RGBColor($this->_lineColorHex);
      echo "LineColor: " . $lineColor["red"] . ", " . $lineColor["green"] . ", " . $lineColor["blue"] . "<br>\n";

      echo "x=" . $this->_x . "<br>\n";
      echo "y=" . $this->_y . "<br>\n";
      echo "width=" . $this->_width . "<br>\n";
      echo "height=" . $this->_height . "<br>\n";
      echo "startBarColorHex=" . $this->_startBarColorHex . "<br>\n";
      echo "endBarColorHex=" . $this->_endBarColorHex . "<br>\n";
      echo "lineColorHex=" . $this->_lineColorHex . "<br>\n";
      echo "barSpacing=" . $this->_barSpacing . "<br>\n";
      echo "numOfValueTicks=" . $this->_numOfValueTicks . "<br>\n";

   }

   function dif ($start,$end)
   {
       if ($start >= $end)
           $dif = $start - $end;
       else
           $dif = $end - $start;
        
       return $dif;
   }

   function draw($start,$end,$pos,$step_width)
   {
       if ($start > $end)    
           $color = $start - $step_width * $pos;
       else
           $color = $start + $step_width * $pos;
           
       return $color;
   }    

   function DrawLineGraph($image)
   {
      if ($this->_debug)
         $this->DebugPrint();

      // Setup the margins
      $this->_topMargin = 0;
      $this->_bottomMargin = 30;
      $this->_leftMargin = 20;
      $this->_rightMargin = $this->_barSpacing + 1 + 10;

      // setup the color for the lines
      $tempLineColor = $this->RGBColor($this->_lineColorHex);
      $lineColor = ImageColorAllocate($image, $tempLineColor["red"], $tempLineColor["green"], $tempLineColor["blue"]);
		// setup the color for the bar lines
		$tempBarLineColor = $this->RGBColor($this->_barLineColorHex);
		$barLineColor = ImageColorAllocate($image, $tempBarLineColor["red"], $tempBarLineColor["green"], $tempBarLineColor["blue"]);
		
      $tempStartColor = $this->RGBColor($this->_startBarColorHex);
      $startColor = ImageColorAllocate($image, $tempStartColor["red"], $tempStartColor["green"], $tempStartColor["blue"]);

		$numEntries = count($this->_values);
      // Figure out how wide each bar is going to be.
		if($numEntries != 0)
      $this->_barWidth = ($this->_width - ($this->_leftMargin + $this->_rightMargin + 1) - (count($this->_values) * $this->_barSpacing)) / count($this->_values);

      // Find out what the smallest and largest amount is.
      $this->_minBarHeight = 0;
      $this->_maxBarHeight = 0;

      for ($i=0; $i < $numEntries; $i++)
      {
         if ($this->_minBarHeight > $this->_values[$i]["value"])
         {
            $this->_minBarHeight = $this->_values[$i]["value"];
         }
         if ($this->_maxBarHeight < $this->_values[$i]["value"])
         {
            $this->_maxBarHeight = $this->_values[$i]["value"];
         }
      }
      
      if ($this->_minBarHeight == 0 && $this->_maxBarHeight > 0) // Having the min value as 0 looks funny
      {
         $this->_minBarHeight = 1;
      }
      
      // Figure out how tall the tallest and smallest bar are going to be.
      $this->_realMinBarHeight = $this->_minBarHeight - (($this->_minBarHeight * $this->_buffer) + 1);
      $this->_realMaxBarHeight = $this->_maxBarHeight * ($this->_buffer + 1);
      $workArea = $this->_height - $this->_bottomMargin - $this->_topMargin - 1;

      // Print out all the ticks
      if ($this->_numOfValueTicks > $this->_maxBarHeight)
      {
         $this->_numOfValueTicks = $this->_maxBarHeight;
      }
      
      for ($i=1; $i<=$this->_numOfValueTicks; $i++)
      {
         $thisBarValue = floor((($this->_maxBarHeight - $this->_minBarHeight) / $this->_numOfValueTicks) * $i) + $this->_minBarHeight;
         $myTickheight = ($workArea / ($this->_maxBarHeight - $this->_realMinBarHeight) * ($thisBarValue - $this->_realMinBarHeight));

         // Figure out where we're going to put this tick..
         $y1 = $this->_height - $this->_bottomMargin - 1 - ($myTickheight);

         if ($thisBarValue >= $this->_minBarHeight)
         {
            imageline($image, $this->_leftMargin - 5 + $this->_x, $y1 + $this->_y,  $this->_width - $this->_rightMargin + $this->_barSpacing + $this->_x, $y1 + $this->_y, $lineColor);
            Imagestring($image, 1, $this->_leftMargin + $this->_x - 15, $y1 + $this->_y + 2, $thisBarValue, $lineColor);
         }
      }
      
      // Print out all the bars
		$num_items = count($this->_values);
      for ($i=1; $i<=$num_items; $i++)
      {
         // Get the bar height for this bar.
         $myBarheight = ($workArea / ($this->_maxBarHeight - $this->_realMinBarHeight) * ($this->_values[$i-1]["value"] - $this->_realMinBarHeight));
			$nextBarheight = ($workArea / ($this->_maxBarHeight - $this->_realMinBarHeight) * ($this->_values[$i]["value"] - $this->_realMinBarHeight));
         // Figure out where we're going to put this bar..
         $x1 = $this->_leftMargin + 9 + (($i-1) * $this->_barWidth) + ($i * $this->_barSpacing);
         $y1 = $this->_height - $this->_bottomMargin - -11 - ($myBarheight);
         $x2 = $this->_leftMargin  + 9 +(($i-1) * $this->_barWidth) + ($i * $this->_barSpacing) + $this->_barWidth;
         $y2 = $this->_height - $this->_bottomMargin - -11 - ($nextBarheight);
			// Print line
			$values = array($x1,$y1,$x1+3,$y1,$x2+3,$y2,$x2,$y2);
			imagefilledpolygon($image, $values, 4, $startColor );
			if($i != $num_items)
			{
				if($myBarheight<$nextBarheight)
					imagefilledellipse($image, $x2+2, $y2+2, 10, 10, $startColor);
				else
					imagefilledellipse($image, $x2, $y2, 10, 10, $startColor);
			}

         // Print the amount of the bar
         if ($this->_showValues)
         {
            Imagestring($image, 2, $x1 + $this->_x, $this->_height-($this->_bottomMargin/2)-10 + $this->_y, $this->_values[$i-1]["value"], $lineColor);
         }

         // Print out the label of the bar.
         if ($this->_showLabels)
         {
            Imagestring($image, 2, $x1 + $this->_x, $this->_height-($this->_bottomMargin/2) + $this->_y, $this->_values[$i-1]["label"], $lineColor);
         }
      }

      // draw the border box
      if ($this->_showOuterBox)
      {
         ImageRectangle($image, $this->_leftMargin + $this->_x, $this->_topMargin + $this->_y, $this->_width - $this->_rightMargin + $this->_barSpacing + $this->_x, $this->_height - $this->_bottomMargin + $this->_y, $lineColor);
      }
   }
}
?>