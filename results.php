<html>
<head>
<style type="text/css">

body {background-color:#a6a8a6; }
td.value {
	background-image: url(/images/gifs/gridline58.gif);
	background-repeat: repeat-x;
	background-position: left top;
	border-left: 1px solid #e5e5e5;
	border-right: 1px solid #e5e5e5;
	padding:0;
	border-bottom: none;
	background-color:transparent;
}
td {
	padding: 4px 6px;
	border-bottom:1px solid #e5e5e5;
	border-left:1px solid #e5e5e5;
	background-color:#fff;
}
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 80%;
}
td.value img {
	vertical-align: middle;
	margin: 5px 5px 5px 0;
}
th {
	text-align: left;
	vertical-align:top;
}
td.last {
	border-bottom:1px solid #e5e5e5;
}
td.first {
	border-top:1px solid #e5e5e5;
}
.auraltext
{
   position: absolute;
   font-size: 0;
   left: -1000px;
}
.assesstable {
	background-image:url(/images/pngs/bg_fade.png);
	background-repeat:repeat-x;
	background-position:left top;
	padding-left:20px;

}
caption {
	font-size:90%;
	font-style:italic;
}
em {
color:red;
font-size:110%;
}

</style>
</head>
<body>
<?php
extract($_POST);
//login taken from cookie set in the password_protect.php file	
$login = $_COOKIE["verify"];	
		/* database connector */
		$mysql_serveradress		= "";	// Address MySQL Server is located
		$mysql_username			= "";		// Username for your MySQL Server
		$mysql_password			= "";		// Password for your MySQL Server
		$connection = @mysql_connect("$mysql_serveradress","$mysql_username","$mysql_password");
		if (!$connection) die("Can't connect to database server");
		/* end connector */
		
		//used to provide the list of librarians
		$iquery = "SELECT DISTINCT Librarian FROM reference.questions WHERE Librarian != '' OR 'blank' ORDER by Librarian";
		$iresult = mysql_query($iquery,$connection)or die("<b>A fatal MySQL error occured<br />Please Alert Mr. Stephens</b>.\n<br />Query: " . $new_order . "<br />\nError: (" . mysql_errno() . ") " . mysql_error()); ;
		
		//this is used for the date selector.
		 include 'calendar.php'; 
		
		
		if (isset($libn)) 
			{
			echo "
				<h2>Select a Date Range</h2>
				<form name=\"mainform\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
					<input onClick=\"ds_sh(this);\" name=\"start_date\" size=\"30\" style=\"cursor: text\" />
					<input onClick=\"ds_sh(this);\" name=\"end_date\" size=\"30\" style=\"cursor: text\" />
					<input type=\"hidden\" name=\"libn\" value=\"$libn\" />
					<input type=\"hidden\" name=\"range\" value=\"1\" />
					<input type=\"submit\" name=\"Submit\" value=\"Submit\" />
				</form>
				";
						
			echo "
				<form name=\"mainform2\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
					<input type=\"submit\" onclick=\"delete window.libn;\" name=\"Submit\" value=\"View everyone's data\" />
				</form>
				";
						
			echo "<form name=\"mainform3\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">";
						
			if (isset($range)) 
				{ 
				echo "
					<input type=\"hidden\" name=\"range\" value=\"1\" />
					<input type=\"hidden\" name=\"start_date\" value=\"$start_date\"/>
					<input type=\"hidden\" name=\"end_date\" value=\"$end_date\" />";
				}
			echo "<select name=\"libn\"><option value=\"\"></option>";
			while($row = mysql_fetch_array($iresult)) 
				{ 
					echo "<option value=\"".$row['Librarian']."\">". $row['Librarian'] . "</option>";
				}

			echo "
				</select>
				<input type=\"submit\" onclick=\"delete window.libn;\" name=\"Submit\" value=\"View Specific Librarian\" />
				</form>
			";
			}
		else 
			{
			echo "
				<h2>Select a Date Range</h2>
				<form name=\"mainform\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
					<input onClick=\"ds_sh(this);\" name=\"start_date\" size=\"30\" style=\"cursor: text\" />
					<input onClick=\"ds_sh(this);\" name=\"end_date\" size=\"30\" style=\"cursor: text\" />
					<input type=\"hidden\" name=\"range\" value=\"1\" />
					<input type=\"submit\" name=\"Submit\" value=\"Submit\" />
				</form>
				";
			echo "<form name=\"mainform3\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">";
			if (isset($range)) 
				{ 
					echo "
						<input type=\"hidden\" name=\"range\" value=\"1\" />
						<input type=\"hidden\" name=\"start_date\" value=\"$start_date\"/>
						<input type=\"hidden\" name=\"end_date\" value=\"$end_date\" />
						";
				}
			echo "<select name=\"libn\"><option value=\"\"></option>";
			while($row = mysql_fetch_array($iresult)) 
				{ 
				echo "<option value=\"".$row['Librarian']."\">". $row['Librarian'] . "</option>";
				}
				echo "
					</select>
					<input type=\"submit\" name=\"Submit\" value=\"View Specific Librarian\" />
					</form>
					";
			}
		/* 	This bit is used for the graph to show reference questions by date. 
			The graph gets unweildy if it shows too much data.
		*/
		$mo = date("m",strtotime("-1 month"));
		if ($mo = "12") {$mo = "01";}
		$ye = date("Y");
		if ($mo = "12") { $ye = $ye-1;}
		$thismo =  $ye."-".$mo."-01";
		
		//if a date range is specified, this block is executed, otherwise the next block is
		if ($range == "1" )
			{
			//query for the questions
			$query1 = "SELECT * FROM reference.questions WHERE Date BETWEEN '$start_date' AND '$end_date'";
			//librarian stats query:
			$libquery = "SELECT Librarian, COUNT(*) AS cat_num FROM reference.questions WHERE Date BETWEEN '$start_date' AND '$end_date' GROUP BY Librarian";
			//query for results by date
			$datequery = "SELECT Date, count(*) as Rcount from reference.questions WHERE Research = '1' AND Date BETWEEN '$start_date' AND '$end_date' GROUP BY Date ORDER BY Date;";
			//query for day of the week
			$dayof = "SELECT DAYOFWEEK( Date ) AS day , count( 1 ) AS daycount FROM reference.questions Where Date BETWEEN '$start_date' AND '$end_date' GROUP BY 1;";						$titletext = "<h2>The graphs below represent data for user: <em>$libn</em> from <em>".$start_date."</em> to <em>".$end_date."</em></h2>";
			$datetext = "";		
			
			if (isset($libn)) 
				{
				//query for the questions
				$query1 = "SELECT * FROM reference.questions WHERE Librarian LIKE '%$libn%' AND Date BETWEEN '$start_date' AND '$end_date'";
				$datequery = "SELECT Date, count(*) as Rcount from reference.questions WHERE Librarian LIKE '%$libn%' AND Research = '1' AND Date BETWEEN '$start_date' AND '$end_date' GROUP BY Date ORDER BY Date;";
				$dayof = "SELECT DAYOFWEEK( Date ) AS day , count( 1 ) AS daycount FROM reference.questions WHERE Librarian LIKE '%$libn%' AND Date BETWEEN '$start_date' AND '$end_date' GROUP BY 1;";
				$titletext = "<h2>The graphs below represent data for user: <em>$libn</em> from <em>".$start_date."</em> to <em>".$end_date."</em></h2>";
				$datetext = "";
				}				
			}
		else 
			{		
			//queries
			$query1 = "SELECT * FROM reference.questions ORDER BY Time";
			$libquery = "SELECT Librarian, COUNT(*) AS cat_num FROM reference.questions GROUP BY Librarian";
			$datequery = "SELECT Date, count(*) as Rcount from reference.questions WHERE Research = '1' AND Date >= '$thismo' GROUP BY Date ORDER BY Date;";
			$dayof = "SELECT DAYOFWEEK( Date ) AS day , count( 1 ) AS daycount FROM reference.questions GROUP BY 1;";
			$titletext = "<h2>The graphs below represent all past data</h2>";
			$datetext = "This graph shows only this month and the previous month";
						
			if (isset($libn)) 
				{
				//query for the questions
				$query1 = "SELECT * FROM reference.questions WHERE Librarian LIKE '%$libn%'";
				$datequery = "SELECT Date, count(*) as Rcount from reference.questions WHERE Librarian LIKE '%$libn%' AND Research = '1' AND Date >= '$thismo' GROUP BY Date ORDER BY Date;";
				$dayof = "SELECT DAYOFWEEK( Date ) AS day , count( 1 ) AS daycount FROM reference.questions WHERE Librarian LIKE '%$libn%' GROUP BY 1;";
				$titletext = "<h2>The graphs below represent data for user: <em>$libn</em>";
				$datetext = "This graph shows only this month and the previous month";	
				}
			}
		
		//execute queries
		$libresult =  mysql_query($libquery,$connection)or die("<b>A fatal MySQL error occured<br />Please Alert Mr. Stephens</b>.\n<br />Query: " . $new_order . "<br />\nError: (" . mysql_errno() . ") " . mysql_error()); ;
		$result = mysql_query($query1,$connection)or die("<b>A fatal MySQL error occured<br />Please Alert Mr. Stephens</b>.\n<br />Query: " . $new_order . "<br />\nError: (" . mysql_errno() . ") " . mysql_error()); ;
		$dateresult = mysql_query($datequery,$connection)or die("<b>A fatal MySQL error occured<br />Please Alert Mr. Stephens</b>.\n<br />Query: " . $new_order . "<br />\nError: (" . mysql_errno() . ") " . mysql_error()); ;
		$week = mysql_query($dayof,$connection)or die("<b>A fatal MySQL error occured<br />Please Alert Mr. Stephens</b>.\n<br />Query: " . $new_order . "<br />\nError: (" . mysql_errno() . ") " . mysql_error()); ;
				
		//loop for the librarian stats
		while($row = mysql_fetch_array($libresult)) 
			{
			$libs[] = $row['0'];
			$nums[] = $row['1'];
			}
		
		//this combines the two array into an array in the form that the graph function requires
		if ((is_array($libs)) && (is_array($nums)))
			{
			$libnums = array_combine($libs, $nums);
			}
				
		//these set the intial value for the variables which will hold the counts for each answer. $n holds the total count of submissions.
		$a="0";
		$b="0";
		$c="0";
		$d="0";
		$e="0";
		$f="0";
		$g="0";
		$n = mysql_num_rows($result);

		//this loop is used to determine both number of questions of each type as well as the questions of each type by hour	
		while($row = mysql_fetch_array($result)) 
			{
			//counts questions by type the "trow" statements are used to determine what time the questions were asked for the time graph
			if (substr_count($row['Research'], '1'))
				{
					$a++;
					$trow1[] = substr($row['Time'], 0, 2);
				}
			if (substr_count($row['Directional'], '1'))
				{
					$b++;
					$trow2[] = substr($row['Time'], 0, 2);
				}
			if (substr_count($row['Computer_Help'], '1'))
				{
					$c++;
					$trow3[] = substr($row['Time'], 0, 2);
				}
			if (substr_count($row['Print_Copy'], '1'))
				{
					$d++;
					$trow4[] = substr($row['Time'], 0, 2);
				}
			if (substr_count($row['eLearning'], '1'))
				{
					$e++;
					$trow5[] = substr($row['Time'], 0, 2);
				}
			if (substr_count($row['Consultation'], '1'))
				{
					$f++;
					$trow6[] = substr($row['Time'], 0, 2);
				}
			}
				
			//these create an arrays with each time for each question
			if(is_array($trow1)){$trow1 = array_count_values($trow1);}
			if(is_array($trow2)){$trow2 = array_count_values($trow2);}
			if(is_array($trow3)){$trow3 = array_count_values($trow3);}
			if(is_array($trow4)){$trow4 = array_count_values($trow4);}
			if(is_array($trow5)){$trow5 = array_count_values($trow5);}
			if(is_array($trow6)){$trow6 = array_count_values($trow6);}
			
				

			$multi = $n*4; //the 4 here is arbitrary based on what looked good with both little data and months of data.
			$multi = $n/$multi;
			$nwidth = $n*$multi;
			$jwidth = $j*$multi;
			$kwidth = $k*$multi;
			$lwidth = $l*$multi;
			$awidth = $a*$multi;
			$bwidth = $b*$multi;
			$cwidth = $c*$multi;
			$dwidth = $d*$multi;
			$ewidth = $e*$multi;
			$fwidth = $f*$multi;

				//percentages (and prevents dividing by zero)
				if ($n != 0)
					{
						$mx = 100/$n; //creates the multiplier for the precentages
						$amx = round($a*$mx, 2);
						$bmx = round($b*$mx, 2);
						$cmx = round($c*$mx, 2);
						$dmx = round($d*$mx, 2);
						$emx = round($e*$mx, 2);
								$fmx = round($f*$mx, 2);
							}
							
							
		//loop for the reference question count by date
			while($row = mysql_fetch_array($dateresult, MYSQL_ASSOC)) 
							{
						
							if (isset($arr)){
								$testvar = 1;
								}
								$arr = array(substr($row['Date'], 5, 5) => $row[Rcount]);
							
							if ($testvar == 1){
							
							$arr2 = array_merge($arr2, $arr);
							
							} else {
							$arr2 = $arr;
							}
							
						}
						
			//section for the day of the week			
					while($row = mysql_fetch_array($week, MYSQL_ASSOC)) 
							{
							
							if (isset($arrd1)){
								$testvard = 1;
								}
								
								
								$arrd1 = array($row['day'] => $row['daycount']);
							
							if ($testvard == 1){
							
							$arrd = array_merge($arrd, $arrd1);
							
							} else {
							$arrd = $arrd1;
							
							}
							
						}
							$arrd['Sunday'] = $arrd['0'];
							$arrd['Monday'] = $arrd['1'];
							$arrd['Tuesday'] = $arrd['2'];
							$arrd['Wednesday'] = $arrd['3'];
							$arrd['Thursday'] = $arrd['4'];
							$arrd['Friday'] = $arrd['5'];
							$arrd['Saturday'] = $arrd['6'];
							//This line is necessary because the array gets repeated twice... for some reason
							$arrd = array_slice($arrd, 7);
							
							
	//begin echoing out the first graph, then linking in the images for the other graphs. Note: the first graph is a very simple one that I made before finding the phpgraph library used for the other graphs. 							
	echo $titletext."


	<h3>Number of Questions</h3>
		<table cellspacing=\"0\" cellpadding=\"0\" class=\"assesstable\" >
			<tr>
				<th>Question Type</th>
				<th>Graph</th>
				<th >Number of questions </th>
				<th> Percentage</th>
			</tr>
			<tr class=\"stats\">
				<td class=\"first\"  style=\"width:180px\">		Reference
				</td>
				<td class=\"value first\" style=\"". $nwidth ."\">
					<img src=\"/images/pngs/bar.png\" alt=\"\" width=\"". $awidth ."\" height=\"16\" />
				</td>
				<td>
					". $a ."
				</td>
				<td>
				
					". $amx."%
				</td>
			</tr>	
			<tr class=\"stats\">
				<td> 
					Directional
				</td>
				<td class=\"value\">
					<img src=\"/images/pngs/bar.png\" alt=\"\" width=\"". $bwidth ."\" height=\"16\" />
						</td>
				<td>". $b ."
				</td>
				<td>
					". $bmx."%
				</td>
			</tr>
			<tr class=\"stats\">
				<td>
					Computer Help
				</td>
				<td class=\"value\">
					<img src=\"/images/pngs/bar.png\" alt=\"\" width=\"". $cwidth ."\" height=\"16\" />
						</td>
				<td>". $c ."
				</td>
				<td>
					". $cmx."% 
				</td>
			</tr>
			<tr class=\"stats\">
				<td>
					Printing and Copying
				</td>
				<td class=\"value\">
					<img src=\"/images/pngs/bar.png\" alt=\"\" width=\"". $dwidth ."\" height=\"16\" />
						</td>
				<td>". $d ."
				</td>
				<td>
					". $dmx."% 
				</td>	
			</tr>
			
			<tr class=\"stats\">
				<td>
					e-Learning
				</td>
				<td class=\"value\">
					<img src=\"/images/pngs/bar.png\" alt=\"\" width=\"". $ewidth ."\" height=\"16\" />
						</td>
				<td>". $e ."
				</td>
				<td>
					". $emx."% 
				</td>	
			</tr>
			<tr class=\"stats\">
				<td class=\"last\">
					Consultations
				</td>
				<td class=\"value last\">
					<img src=\"/images/pngs/bar.png\" alt=\"\" width=\"". $fwidth ."\" height=\"16\" />
						</td>
				<td>". $f ."
				</td>
				<td>
					". $fmx."% 
				</td>	
			</tr>
		</table>";
		
		echo "<h3>Questions by Hour</h3>";
	
		//these are used to pass the arrays through the url
		$serialized = rawurlencode(serialize($trow1));
		$serialized2 = rawurlencode(serialize($trow2));
		$serialized3 = rawurlencode(serialize($trow3));
		$serialized4 = rawurlencode(serialize($trow4));
		$serialized5 = rawurlencode(serialize($trow5));
		$serialized6 = rawurlencode(serialize($trow6));
		
		//link to first graph
		echo "<img src=\"result-hour.php?testvar=".$serialized."&testvar2=".$serialized2."&testvar3=".$serialized3."&testvar4=".$serialized4."&testvar5=".$serialized5."&testvar6=".$serialized6."\" >";

	if (!isset($libn)) 
		{
		echo "<h3>Questions per Librarians</h3>";

		//used to pass array to the third graph
		$libnums = rawurlencode(serialize($libnums));

		//link to the third graph
		echo "<img src=\"result-librarians.php?libnum=".$libnums."\" >";	
		}
			
		//for the reference question by date graph
		echo "<h3>Reference Questions by Date: <span style=\"font-size:70%\"><em>".$datetext."</em></span></h3>";
		$serializedc = rawurlencode(serialize($arr2));
		echo "<img src=\"result-date.php?serializedc=".$serializedc."\" >";
		
		//for the reference question by day graph
		echo "<h3>Reference Questions by Day of the week</h3>";
		$serializedd = rawurlencode(serialize($arrd));
		echo "<img src=\"result-day.php?serializedd=".$serializedd."\" >";

		//form to clear the date range
		echo "<form name=\"clear\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\"><input type=\"submit\" name=\"Submit\" value=\"Clear Date Range\" /></form><br /><a href=\"index.php\">Back to input page</a>";
	?>
</body>
</html>