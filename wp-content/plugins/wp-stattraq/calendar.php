<?php

/************************************************************
Version   Change
  1.1.1  - This patch will fix the multiple month entires for 
          the same month.
  1.2.6	 - fixed links to /wp-admin/admin.php?page=wp-stattraq/index.php?...

************************************************************/

/*
	TODO: handle going back and forth from year to year, month to month, day to 
		day with arrows above the generated list.
*/

function generate_calendar()
{
	global $time_frame;
	$output = "<div id=\"calendar\">";
	switch($time_frame)
	{
  	case 6: // YEARS
		  $output .= generate_year_list(); // generates a list of years available
	    break;
	  case 8: // MONTHS
		  $output .= generate_month_list(); // generates a list of months available.
	    break;
	  case 10: // DAYS
		  $output .= generate_month_calendar(); // generates the traditional month calendar
	    break;
	  case 12: // HOURS
		  $output .= generate_hour_list(); // lists the hours available
	    break;
	  default:
		  $output .= "No timeframe selected";
	    break;
	}
		
  return $output . "</div>";
  
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
// YEARS

function generate_year_list()
{
	global $time_frame, $year, $view, $session_id, $wpdb, $tablestattraq, $limitNumber, $options, $wpst_url;
	$output .= "<ol>";
	$sqlQuery = "SELECT DISTINCT DATE_FORMAT( access_time, '%Y' ) AS access_time2, COUNT(access_time) as cnt 
               FROM $tablestattraq " . ($options['user_counts_hide_bots'] == 'true'? "
               WHERE user_agent_type=0" : '' ) ." 
               GROUP BY access_time2 ORDER BY access_time2";
/*	$sqlQuery = "SELECT DISTINCT DATE_FORMAT( access_time, '%Y' ) AS access_time, COUNT(access_time) as cnt 
               FROM $tablestattraq " . ($options['user_counts_hide_bots'] == 'true'? "
               WHERE user_agent_type=0" : '' ) ." 
               GROUP BY access_time ORDER BY access_time";  */
               
	$results = $wpdb->get_results($sqlQuery);
	if($results)
	{
  	foreach($results as $row)
	  {
		  $output .= ('<li><a href="'.$wpst_url.'view=' . $view . '&amp;time_frame=' . $time_frame . '
                   &amp;year=' . $row->access_time2 . '&amp;session_id=' . $session_id . '
                   &amp;limitNumber=' . $limitNumber . '" title="Hits: ' . number_format($row->cnt) . '"' . 
                   ($row->year == $year ? ' class="today"' : '') . '>' . $row->access_time2 . '</a></li>');
      /*$output .= ('<li><a href="index.php?view=' . $view . '&amp;time_frame=' . $time_frame . '
                  &amp;year=' . $row->access_time . '&amp;session_id=' . $session_id . '
                  &amp;limitNumber=' . $limitNumber . '" title="Hits: ' . number_format($row->cnt) . '"' . 
                  ($row->year == $year ? ' class="today"' : '') . '>' . $row->access_time . '</a></li>');  */
	  }
	}
	else
	{
		$output .= "<li>No Data</li>"; 
	}
	
	$output .= "</ol>";
	return $output;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
// MONTHS
function generate_month_list()
{
  global $time_frame, $year, $month, $day, $hour, $minute, $view, $session_id, 
         $wpdb, $tablestattraq, $limitNumber, $options, $wpst_url;
	$output = "<ol>";
  $sqlQuery = "SELECT DISTINCT COUNT(access_time) as cnt, 
               DATE_FORMAT( access_time, '%Y-%M' ) as access_time2, 
               DATE_FORMAT( access_time, '%Y' ) as year, 
               DATE_FORMAT( access_time, '%m' ) AS month 
               FROM $tablestattraq WHERE " . ($options['user_counts_hide_bots'] == 'true'? " user_agent_type=0 AND" : '' ) ." 
               access_time BETWEEN '" . ($year-1) . "1201000000' AND '" . ($year+1) . "0201000000' 
               GROUP BY access_time2 ORDER BY month DESC";
/*	$sqlQuery = "SELECT COUNT(access_time) as cnt, DATE_FORMAT( access_time, '%Y-%M' ) as access_time, 
                      DATE_FORMAT( access_time, '%Y' ) as year, DATE_FORMAT( access_time, '%m' ) AS month 
                      FROM $tablestattraq 
                      WHERE " . ($options['user_counts_hide_bots'] == 'true'? " user_agent_type=0 AND" : '' ) ." 
                      access_time BETWEEN '" . ($year-1) . "1201000000' AND '" . ($year+1) . "0201000000' 
                      GROUP BY access_time ORDER BY month DESC";  */
	$results = $wpdb->get_results($sqlQuery);
	if($results)
	{
  	foreach($results as $row)
	  {
      $output .= '<li><a href="'.$wpst_url.'view='.$view.'&amp;time_frame='.$time_frame.'
                  &amp;year='.$row->year.'&amp;month='.$row->month.'&amp;session_id='.$session_id.'
                  &amp;limitNumber='.$limitNumber.'" title="Hits: ' . number_format($row->cnt) . '"
                  ' . ($row->month == $month ? ' class="today"' : '') . '>'.$row->access_time2.'</a></li>';
	/*	  $output .= '<li><a href="index.php?view='.$view.'&amp;time_frame='.$time_frame.'
                  &amp;year='.$row->year.'&amp;month='.$row->month.'&amp;session_id='.$session_id.'
                  &amp;limitNumber='.$limitNumber.'" title="Hits: ' . number_format($row->cnt) . '"
                  ' . ($row->month == $month ? ' class="today"' : '') . '>'.$row->access_time.'</a></li>'; */
	  }
	}
  else
	{
		$output .= "<li>No Data</li>";
	}
	
	$output .= "</ol>";
	return $output;
}

////////////////////////////////////////////////////////////////////////////////
// HOUR

function generate_hour_list()
{
  global $time_frame, $year, $month, $day, $hour, $minute, $view, $session_id, 
         $wpdb, $tablestattraq, $limitNumber, $options, $wpst_url;
	$output = "<ol>";

	$time_format = get_settings("time_format");
	
	$sqlQuery = "SELECT DISTINCT DATE_FORMAT( access_time, '%H' ) AS hour, 
                               COUNT(access_time) AS cnt 
                               FROM $tablestattraq 
                               WHERE access_time BETWEEN '" . st_createDateQueryString($year, $month, $day, 0, 0, 0 ) . "' 
                                 AND '" . st_createDateQueryString($year, $month, $day, 23, 59, 59 ) . "' " . 
                                 ($options['user_counts_hide_bots'] == 'true'? 
                                "AND user_agent_type=0" : '' ) ." GROUP BY hour ORDER BY hour ASC";
	$results = $wpdb->get_results($sqlQuery);
	if($results)
	{
  	$time_format = get_settings('time_format');
	  foreach($results as $row)
	  {
		  $cTime = $year.'-'.($month<10? '0' : '' ) . $month . '-' .  ($day<10? '0' : '' ) . $day .  ' ' .$row->hour . ':00:00';
		  $formatted_hour = mysql2date($time_format, $cTime);
	 	  $output .= '<li><a href="'.$wpst_url.'view='.$view.'&amp;time_frame='.$time_frame.'
                  &amp;year='.$year.'&amp;month='.$month.'&amp;day='.$day.'&amp;hour=' . $row->hour . '
                  &amp;session_id='.$session_id.'&amp;limitNumber='.$limitNumber.'" title="Hits: ' . 
                  number_format($row->cnt) . '"' . ($hour == $row->hour ? ' class="today"' : '') .
                  '>'.$formatted_hour.'</a></li>';
	  }
	}
	else
	{
		$output .= "<li>No Data</li>"; 
	}
	
	$output .= "</ol>";
	return $output;
}
////////////////////////////////////////////////////////////////////////////////////////
// DAY (IN MONTH TABLE FORM)
function generate_month_calendar()
{
  global $time_frame, $year, $month, $day, $hour, $minute, $view, $session_id, 
       $wpdb, $tablestattraq, $limitNumber, $options, $wpst_url;
       
  $date = $day;

	$time_frame = 10;

	$first_of_month = mktime (0,0,0, $month, 1, $year);
	/* remember that mktime will automatically correct if invalid dates are entered
	/ for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
	/ this provides a built in "rounding" feature to generate_calendar() */
	$maxdays   = date('t', $first_of_month); //number of days in the month

  $month = (((int)$month) < 10 ? '0'.$month : $month);
	
  $blogDays = Array();
  $day_heading_length = 1;
	$wpdb->show_errors();
	$results = $wpdb->get_results("SELECT DISTINCT DATE_FORMAT( access_time, '%e' ) AS access_day, 
                                 COUNT(access_time) AS cnt 
                                 FROM $tablestattraq 
                                 WHERE access_time BETWEEN '{$year}{$month}01000000' 
                                 AND '{$year}{$month}{$maxdays}235959'" . 
                                 ($options['user_counts_hide_bots'] == 'true'? " 
                                 AND user_agent_type=0" : '' ) ." 
                                 GROUP BY access_day 
                                 ORDER BY access_time");
	if($results) // if we get anything from the $wpdb
	{
	  foreach($results as $row)
  	{
		  $blogDays[$row->access_day] = $row->cnt;
	  }
	}

	// links for previous & next
	$starters = $wpst_url . 'view='.$view.'&amp;limitNumber='.$limitNumber;
	$prev_link = $starters . '&amp;month=' . ($month == 1 ? '12&amp;year=' . ($year-1) : ($month-1). '
                            &amp;year='.$year.'&amp;time_frame=10');
	$next_link = $starters . '&amp;month=' . ($month == 12 ? '1&amp;year=' . ($year+1) : ($month+1). '
                            &amp;year='.$year.'&amp;time_frame=10');
	
	static $day_headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	static $month_names = array('You should never see this!','January','February','March','April','May',
                              'June','July','August','September','October','November','December');
	$date_info = getdate($first_of_month);   //get info about the first day of the month
	$month     = $date_info['mon'];
	$year      = $date_info['year'];

	$calendar  	= '<table class="calendar"><thead>' .
					'<tr><th class="calendar-navigation"><a href="'.$prev_link.'">&lt;&lt;</a></th>' .
					'<th colspan="5" id="calendar-header">' . $month_names[$month] . ' ' . $year . '</th>' .
					'<th class="calendar-navigation"><a href="'.$next_link.'">&gt;&gt;</a></th></tr></thead>';
	
	if($day_heading_length > 0 and $day_heading_length <= 4){
		$calendar .= '<tr>';
		foreach($day_headings as $day_heading)
    {
			$calendar .= '<th abbr="'.$day_heading.'" class="dayofweek">' . 
                   ($day_heading_length != 4 ? substr($day_heading, 0, $day_heading_length) : $day_heading) .	
                   '</th>';
		}
		
		$calendar .= "</tr>";
	}
	
	$calendar .= '<tr>';

	$weekday = $date_info['wday']; //weekday (zero based) of the first day of the month
	$c_day = 1; // starting day of the month
	//take care of the first "empty" days of the month
	if($weekday > 0)
  {
    $calendar .= '<td colspan="'.$weekday.'">&nbsp;</td>';
  }

	//print the days of the month
	while ($c_day <= $maxdays)
  {
		if($weekday == 7)
    { //start a new week
			$calendar .= '</tr><tr>';
			$weekday = 0;
		}
		//if a linking function is provided
		if(array_key_exists($c_day,$blogDays))
    {
			$link = $wpst_url . 'view=' . $view . '&amp;time_frame=' . $time_frame . '
               &amp;year=' . $year . '&amp;month=' . ($month < 10? '0':'') . $month . '
               &amp;day=' . ($c_day < 10 ? '0' : '') . $c_day . '&amp;hour=' . $hour . '
               &amp;minute=' . $minute . '&amp;limitNumber=' . $limitNumber;
			$calendar .= '<td'.($date==$c_day ? ' class="today"':'').'><a href="'.$link.
                   '" title="Hits: ' . number_format($blogDays[$c_day]) . '">' . $c_day . '</a></td>';
		}
    else
    {
			$calendar .= '<td'.($date==$c_day ? ' class="today"':'') . '>' . $c_day . '</td>';
		}
		
		$c_day++;
		$weekday++;
	}
	
	if($weekday != 7)
  {
		$calendar .= '<td colspan="' . (7 - $weekday) . '">&nbsp;</td>';
	}
	
	return $calendar . '</tr></table>';
}
?>
