<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en'>
<head>
<title>Venkatesh Javvaji's Work Calendar</title>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<link rel='stylesheet' type='text/css' href='calendar.css'></link>
</head>
<body>

<div class="container">

<h1>Assigment-3<br />Part-2: Calendar Page<br /><hr /><?php date_default_timezone_set("America/New_York"); echo date("l jS \of F Y h:i:s A"); ?></h1>

<table id="event_table">
	<tr class="table_header">
		<td id="hr_td">Time</td><td>Venkatesh</td><td>Surya</td><td>John</td>
	</tr>

<?php
	date_default_timezone_set("America/New_York");
	$hours_to_show=12;
	$hourCounter=0;
	$counter = 0;
	$begin1=array("Mon"=>8,"Tue"=>8,"Wed"=>8,"Thu"=>8,"Fri"=>8);
	
	$Lunch1=array("Mon"=>12,"Tue"=>12,"Wed"=>13,"Thu"=>12,"Fri"=>13);
	
	$Stop1=array("Mon"=>18,"Tue"=>18,"Wed"=>18,"Thu"=>18,"Fri"=>18);
	
	$Start2=array("Mon"=>12,"Tue"=>16,"Wed"=>18,"Thu"=>16,"Fri"=>18);
	
	$Lunch2=array("Mon"=>16,"Tue"=>18,"Wed"=>21,"Thu"=>21,"Fri"=>21);
	
	$Stop2=array("Mon"=>20,"Tue"=>24,"Wed"=>24,"Thu"=>24,"Fri"=>24);
	
	$Start3=array("Wed"=>8,"Thu"=>8,"Fri"=>8,"Sat"=>8,"Sun"=>11);
	
	$Lunch3=array("Wed"=>12,"Thu"=>13,"Fri"=>12,"Sat"=>14,"Sun"=>15);
	
	$Stop3=array("Wed"=>18,"Thu"=>18,"Fri"=>18,"Sat"=>17,"Sun"=>19);
	
	$startHour=date("G");
	
	
	$flag=true; //Set the flag to color alternate row in the table
	
	
	$functionDay=date("D", strtotime('+'.$counter.' days'));

	
	function get_hour_string($timestamp){
		$timeStr="";
		if($timestamp>=12&&$timestamp<=23){
			$timeStr.=$timestamp-12;
			$timeStr.=" p.m.";
		}elseif($timestamp==0){
			$timeStr.=12;
			$timeStr.=" a.m.";
		}else{
		$timeStr.=$timestamp;
		$timeStr.=" a.m.";
		}
		return $timeStr;
	}

	function TimeTable($begin, $Stop, $lunch, $time, $day)
		{
				if(array_key_exists($day, $begin)&&$time<=$Stop[$day])
					{
						if($time==$lunch[$day]){
						return " class='lunch'> Lunch Time";
							}else{
								return " class='work'> Work Time";
								}
					}
		return ">Off";
		}

?>

	
<?php

$hours_to_show=12;
	for($i=1;$i<=$hours_to_show;$i++)
		{
		if($flag){
			echo "<tr class='even_row'>";
		}else{
			echo "<tr class='odd_row'>";
		}
		echo "<td class='hr_td'>".get_hour_string(date("G", strtotime('+'.$hourCounter.' hours')))."</td>";
		
		$timings=TimeTable($begin1,$Stop1,$Lunch1,$startHour, $functionDay);
		
		
		echo "<td class='hr_td'".$timings."</td>";
		$timings=TimeTable($Start2,$Stop2,$Lunch2,$startHour, $functionDay);
		
		
		echo "<td class='hr_td'".$timings."</td>";
		$timings=TimeTable($Start3,$Stop3,$Lunch3,$startHour, $functionDay);
		
		
		echo "<td class='hr_td'".$timings."</td>";
		echo "</tr>";
		 //increase hour for next loop iteration
		$startHour++;
		$hourCounter++;
		//flag that switches even and odd coloring
		
		
		$flag=!$flag;
	}
	
	
	date_default_timezone_set("America/New_York");
?>
</table>	

<h1><a href="TextEditor.html">Assignment-3 Part-1 Link</a></h1>



</div>	
</body>
</html>


