<?php

class dataSet
{
		var $setName;
		var $fadeStartColor;
		var $fadeEndColor;
		var $values;
		var $valuesSum;
		var $barStartColor;
		var $barEndColor;
		
		function dataSet()
		{
			$this->setName = 'Super Set';
			$this->values = array();
			$this->valuesSum = 0;
		}
/******************************************************************************/

		function setValue($newKey, $newValue)
		{
			$this->values[$newKey] = $newValue;
			$this->valuesSum += intval($newValue);
		}

/******************************************************************************/	

		function getValue($keyName)
		{
			return (array_key_exists($keyName, $this->values) ? $this->values[$keyName] : 0 );
		}

		function getLength()
		{
			return count($this->values);
		}
		
/******************************************************************************/		

		function getDataSet()
		{
			return $this->values;
		}

/******************************************************************************/		

		function getValuesSum()
		{
			return array_sum($this->values);
		}

/******************************************************************************/		

function getStartColor()
{
	return $this->barStartColor;
}

/******************************************************************************/

function getEndColor()
{
	return $this->barEndColor;
}

function getDataSetName()
{
	return $this->setName;
}

function setDataSetName($newVal = 'Data Set')
{
	$this->setName = $newVal;
}

}
?>