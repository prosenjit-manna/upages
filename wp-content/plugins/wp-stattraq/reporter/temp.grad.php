<?php

require_once('StatGraph.php');

class StatTraqPieChart extends StatGraph
{

	var $dataSet;
	var $useFade;
	//fill in chart parameters
	var $chartTotal;
	var $chartDiameter;
	var $chartFont;
	var $chartFontHeight;
	var $chartWidth;
	var $chartHeight;
	var $chartLineColor = '000000';

/******************************************************************************/
	
  	function circle_point($degrees, $diameter) 
  	{
		$x = cos(deg2rad($degrees)) * ($diameter/2);
		$y = sin(deg2rad($degrees)) * ($diameter/2);
		
    	return (array($x, $y));
  	}

/******************************************************************************/	
	
	function StatTraqPieChart()
	{
	$this->StatGraph = new StatGraph();
	$this->useFade = true;
	//fill in chart parameters
	$this->chartTotal = 0;
	$this->chartDiameter = 300;
	$this->chartFont = 2;
	$this->chartFontHeight = imagefontheight($this->chartFont);
	}
	
/******************************************************************************/

function setDataSet($newVal)
{
	$this->dataSet = $newVal;
}

function setGraphWidth($newVal)
{
	$this->chartWidth = $newVal;
}

function setGraphHeight($newVal)
{
	$this->chartHeight = $newVal;
}

function setGraphDiameter($newVal)
{
	$this->chartDiameter = $newVal;
}

function drawPieChart($img)
{
	//determine total of all values
	$dataLength = $this->dataSet->getLength();
	$this->chartTotal = $this->dataSet->getValuesSum();

	$this->chartCenterX = $this->chartDiameter/2 + 10;
	$this->chartCenterY = $this->chartDiameter/2 + 10;

	//allocate colors
	$colorBody = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
	$colorBorder = imagecolorallocate($img, 0x00, 0x00, 0x00);
	$colorBorderShadow = imagecolorallocate($img, 0xCC, 0xCC, 0xCC);
	$colorText = imagecolorallocate($img, 0x00, 0x00, 0x00);

	$startColors = array('FF0000', '00FF00', '0000FF', 'FFFF00', 'FF00FF', '00FFFF', '990000', '009900', '000099', '999900', '990099', '009999');
	$endColors = array('FF5151', '86FF87', '7374FF', 'FFFFA2', 'FFA8FF', '93FEFF', 'FF5353', '9FFFA0', '7374FF', 'FEFF71', 'FE57FF', '66FDFF');

	foreach($startColors as $color)
	{
		$argghh = $this->getRGBColor($color);
		$colorSlice[] = ImageColorAllocate($img, $argghh['red'], $argghh['green'], $argghh['blue']);
	}

	//fill background
	imagefill($img, 0, 0, $colorBody);
	$this->drawBackgroundFade($img, 0, 0, $this->chartWidth, $this->chartHeight/2, 'B0C4DE', 'FFFFFF', FADE_HORIZONTAL);

	/*
	** draw each slice
	*/
	$degrees = 0;
	$index = 0;
	$vals = $this->dataSet->values;
	$keys = array_keys($this->dataSet->values);
	while($index < $dataLength)
	{
		$startDegrees = round($degrees);
		$degrees += (($vals[$keys[$index]]/$this->chartTotal)*360);
		$endDegrees = round($degrees);
		$CurrentColor = $colorSlice[$index%(count($colorSlice))];
		//draw arc
		imagearc($img, $this->chartCenterX, $this->chartCenterY, $this->chartDiameter, $this->chartDiameter, $startDegrees, $endDegrees, $colorBorder);
		//draw start line from center
		list($ArcX, $ArcY) = $this->circle_point($startDegrees, $this->chartDiameter);
		imageline($img, $this->chartCenterX, $this->chartCenterY, floor($this->chartCenterX + $ArcX), floor($this->chartCenterY + $ArcY), $colorBorder);
		//draw end line from center
		list($ArcX, $ArcY) = $this->circle_point($endDegrees, $this->chartDiameter);
		imageline($img, $this->chartCenterX, $this->chartCenterY, ceil($this->chartCenterX + $ArcX), ceil($this->chartCenterY + $ArcY), $colorBorder);
		//fill slice
		$MidPoint = round((($endDegrees - $startDegrees)/2) + $startDegrees);
		list($ArcX, $ArcY) = $this->circle_point($MidPoint, $this->chartDiameter/2);
		imagefilltoborder($img, floor($this->chartCenterX + $ArcX), floor($this->chartCenterY + $ArcY), $colorBorder,$CurrentColor);
		if($this->useFade){
			$this->drawPieFade($img, $this->chartCenterX, $this->chartCenterY, $this->chartDiameter, $this->chartDiameter, $startDegrees, $endDegrees, $startColors[$index%(count($colorSlice))], $endColors[$index%(count($colorSlice))] );
		}
		// height of key
		$LineY = $this->chartDiameter + 20 + ($index*($this->chartFontHeight+2));
		//draw color box
		imagerectangle($img, 10, $LineY, 10 + $this->chartFontHeight, ($LineY + $this->chartFontHeight), $colorBorder);
		imagefilltoborder($img, 12, $LineY + 2, $colorBorder,$CurrentColor);
		//draw label
		imagestring($img, $this->chartFont, 20 + $this->chartFontHeight, $LineY, $keys[$index] . ': ' . $vals[$keys[$index]], $colorText);
		$index++; // loop iterator
	}
	
	//draw border
	imagearc($img, $this->chartCenterX, $this->chartCenterY, $this->chartDiameter, $this->chartDiameter, 0, 180, $colorBorder);
	imagearc($img, $this->chartCenterX, $this->chartCenterY, $this->chartDiameter, $this->chartDiameter, 180, 360, $colorBorder);
	imagearc($img, $this->chartCenterX, $this->chartCenterY, $this->chartDiameter+7, $this->chartDiameter+7, 0, 180, $colorBorder);
	imagearc($img, $this->chartCenterX, $this->chartCenterY, $this->chartDiameter+7, $this->chartDiameter+7, 180, 360, $colorBorder);
	imagefilltoborder($img, floor($this->chartCenterX + ($this->chartDiameter/2) + 2), $this->chartCenterY, $colorBorder, $colorBorder);

	//output image
	header("Content-type: image/png");
	imagepng($img);
	imagedestroy($img);
} // end function drawPieChart

	/******************************************************************************/


function drawPieFade($img, $centerX, $centerY, $elWidth, $elHeight, $arcStart, $arcEnd, $hexadecimalStartColor, $hexadecimalEndColor)
{
	$this->chartDiameter;
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
		
		$redStep = $redSteps / ($arcEnd-$arcStart);
		$greenStep = $greenSteps /  ($arcEnd-$arcStart);
		$blueStep = $blueSteps /  ($arcEnd-$arcStart);
		
		$steps =  round($this->chartDiameter/4);
		$mx = $this->chartDiameter/2;
		$i = ceil($mx/4);
		while($i--)
	   {
	      $color = imageColorExact($img, $this->getFadeColor($redStartColor, $redEndColor, $i, $redStep), $this->getFadeColor($greenStartColor, $greenEndColor, $i, $greenStep), $this->getFadeColor($blueStartColor, $blueEndColor, $i, $blueStep));
			// check for duplicate colors, don't allocate them
			if ($color == -1)
			{
				$color = ImageColorAllocate($img,$this->getFadeColor($redStartColor ,$redEndColor,$i,$redStep),$this->getFadeColor($greenStartColor, $greenEndColor, $i, $greenStep),$this->getFadeColor($blueStartColor, $blueEndColor, $i, $blueStep));
			}
					//draw arc
		imagearc($img, $this->chartCenterX, $this->chartCenterY, $mx-$i, $mx-$i, $arcStart, $arcEnd, $color);
		//draw start line from center
		list($ArcX, $ArcY) = $this->circle_point($arcStart, $mx-$i);
		imageline($img, $this->chartCenterX, $this->chartCenterY, floor($this->chartCenterX + $ArcX), floor($this->chartCenterY + $ArcY), $color);
		//draw end line from center
		list($ArcX, $ArcY) = $this->circle_point($arcEnd, $mx-$i);
		imageline($img, $this->chartCenterX, $this->chartCenterY, ceil($this->chartCenterX + $ArcX), ceil($this->chartCenterY + $ArcY), $color);
		//fill slice
		$MidPoint = round((($arcEnd - $arcStart)/2) + $arcStart);
		list($ArcX, $ArcY) = $this->circle_point($MidPoint, ($mx-$i)/2);
		//imagefilltoborder($img, floor($this->chartCenterX + $ArcX), floor($this->chartCenterY + $ArcY), $color,$color);
		}
}	

	function getEndColor(&$end)
	{
		$col = $this->getRGBColor($end);
		if($col['red'] == $col['green'] && $col['red'] == $col['blue']){
					// red is the highest color
		
		}
	}

} // end class	

$img = ImageCreateTrueColor(500, 700);

$grp1 = new dataSet();
$grp1->setValue(14, 56);
$grp1->setValue(16, 112);
$grp1->setValue(17, 11);
$grp1->setValue(20, 56);

$chart = new StatTraqPieChart();
$chart->setGraphWidth(500);
$chart->setGraphHeight(700);
$chart->setGraphDiameter(500-20);
$chart->setDataSet($grp1);
$chart->drawPieChart($img);
?>
