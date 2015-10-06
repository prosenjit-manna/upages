<?php
	require_once('dataSet.php');

// VALUES location
define('VALS_NONE', 0);		// don't display values
define('VALS_TOP', 1); 		// above chart
define('VALS_BARTOP', 2); 	// above bar
define('VALS_BOTTOM', 3); 	// below chart
define('VALS_TNB', 4); 		// top and bottom

define('VAL_DIR_HOR', 0);
define('VAL_DIR_VER', 1);


// LABELS location
define('LABS_NONE', 0);		// don't display labels
define('LABS_TOP', 1); 		// above chart
define('LABS_BARTOP', 2); 	// above bar
define('LABS_BOTTOM', 3); 	// below chart
define('LABS_TNB', 4);		// top and bottom
// Tick location
define('TICK_NONE', 0);		// don't display ticks
define('TICK_LEFT', 1);		// display on left
define('TICK_RIGHT', 2);	// display on right
define('TICK_BOTH', 3);		// display on both left and right

define('KEYS_NONE', 0);		// don't display keys
define('KEYS_LEFT', 1);		// display on left
define('KEYS_RIGHT', 2);	// display on right
define('KEYS_TOP', 3);		// display on top
define('KEYS_BOTTOM', 4);	// display on bottom

define('FADE_HORIZONTAL', 0);
define('FADE_VERTICAL', 1);	

	class StatGraph
	{
		// values
		var $graphTitle;
		var $dataSets;
		
		// settings
		var $chartWidth;
		var $chartHeight;
		
		function StatGraph()
		{
			$this->graphTitle = 'StatGraph';
			$this->dataSets = array();
			$this->chartWidth = 650;
			$this->chartHeight = 350;
		}
		
/******************************************************************************/

		function setGraphTitle($newVal)
		{
			$this->graphTitle = $newVal;
		}

/******************************************************************************/
		
		function setShowTitle($bool = true)
		{
			$this->showTitle = $bool;
		}
		
/******************************************************************************/
		
		function setDataSet($setName, $set)
		{
			$this->dataSet[$setName] = $newVal;
		}
		
/******************************************************************************/
		
		function getDataSet($setName)
		{
			if(array_key_exists($setName, $this->dataSets))
			{
				return $this->dataSets[$setName];
			}
		}

/******************************************************************************/
		
		function getDataSetsKeys()
		{
			return array_keys($this->dataSets);
		}
		
/******************************************************************************/

		function getDataSetsValues()
		{
			return array_values($this->dataSets);
		}

/******************************************************************************/

		function setGraphWidth($newVal)
		{
			$this->chartWidth = $newVal;
		}
		
/******************************************************************************/

		function setGraphHeight($newVal)
		{
			$this->chartHeight = $newVal;
		}

/******************************************************************************/		
// UTILITY FUNCTIONS

function getRGBColor($hexadecimalNumber = 'B0C4DE' )
{
	$red = hexdec(substr($hexadecimalNumber, 0, 2));
	$green = hexdec(substr($hexadecimalNumber, 2, 2));
	$blue = hexdec(substr($hexadecimalNumber, 4, 2));
	return array("red" => $red, "green" => $green, "blue" => $blue);
}
		
/******************************************************************************/

function calculateDifference($startColor, $endColor)
{
	return ($startColor >= $endColor ? $startColor - $endColor : $endColor - $startColor);
}

/******************************************************************************/
	
function getFadeColor($startColor, $endColor ,$i , $stepWidth)
{
	return ($startColor > $endColor ? $startColor - $stepWidth * $i : $startColor + $stepWidth * $i);
}

function drawBackgroundFade($img, $x1, $y1, $x2, $y2, $hexadecimalStartColor, $hexadecimalEndColor, $fadeDirection = FADE_VERTICAL)
{
	$height = $y2;
	$width = $x2;
//	echo $hexadecimalStartColor, ' ' , $hexadecimalEndColor , '<br />';
	$startColor = $this->getRGBColor($hexadecimalStartColor);
	$redStartColor = $startColor["red"];
	$greenStartColor = $startColor["green"];
	$blueStartColor = $startColor["blue"];
	
	$endColor = $this->getRGBColor($hexadecimalEndColor);
	$redEndColor = $endColor["red"];
	$greenEndColor = $endColor["green"];
	$blueEndColor = $endColor["blue"];
	
	$redSteps = $this->calculateDifference($redStartColor, $redEndColor);
	$greenSteps = $this->calculateDifference($greenStartColor, $greenEndColor);
	$blueSteps = $this->calculateDifference($blueStartColor, $blueEndColor);
	
	if($fadeDirection == FADE_HORIZONTAL)
	{
		// height of each individual color block
		$redStep = $redSteps / $height;
		$greenStep = $greenSteps / $height;
		$blueStep = $blueSteps / $height;
		
		$i = $height;
		while($i > 0)
	   {
	      $color = imageColorExact(
				$img, 
				$this->getFadeColor($redStartColor, $redEndColor, $i, $redStep),
				$this->getFadeColor($greenStartColor, $greenEndColor, $i, $greenStep),
				$this->getFadeColor($blueStartColor, $blueEndColor, $i, $blueStep)
				);
			// check for duplicate colors, don't allocate them
			if ($color == -1)
			{
				$color = ImageColorAllocate(
				$img,
				$this->getFadeColor($redStartColor ,$redEndColor,$i,$redStep),
				$this->getFadeColor($greenStartColor, $greenEndColor, $i, $greenStep),
				$this->getFadeColor($blueStartColor, $blueEndColor, $i, $blueStep));    
			}
			imageLine($img,$x1,$i+$y1,$x1+$width,$i+$y1,$color);
			$i--;
			}
	}
	else
	{
		// height of each individual color block
		$redStep = $redSteps / $width;
		$greenStep = $greenSteps / $width;
		$blueStep = $blueSteps / $width;
		
		$i = $width;
		while($i > 0)
	   {
	      $color = imageColorExact(
				$img, 
				$this->getFadeColor($redStartColor, $redEndColor, $i, $redStep),
				$this->getFadeColor($greenStartColor, $greenEndColor, $i, $greenStep),
				$this->getFadeColor($blueStartColor, $blueEndColor, $i, $blueStep)
				);
			// check for duplicate colors, don't allocate them
			if ($color == -1)
			{
				$color = ImageColorAllocate(
				$img,
				$this->getFadeColor($redStartColor ,$redEndColor,$i,$redStep),
				$this->getFadeColor($greenStartColor, $greenEndColor, $i, $greenStep),
				$this->getFadeColor($blueStartColor, $blueEndColor, $i, $blueStep));    
			}
			imageLine($img, $i+$x1, $y1, $x1+$i, $height+$y1, $color);
			$i--;
		}
	}
}
	
}
?>