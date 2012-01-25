<?php
extract($_GET);
$testvar = unserialize(rawurldecode($_GET['testvar']));
$testvar2 = unserialize(rawurldecode($_GET['testvar2']));
$testvar3 = unserialize(rawurldecode($_GET['testvar3']));
$testvar4 = unserialize(rawurldecode($_GET['testvar4']));
$testvar5 = unserialize(rawurldecode($_GET['testvar5']));
$testvar6 = unserialize(rawurldecode($_GET['testvar6']));

for ($i = "09"; $i < "22"; $i++) {
	if (isset($testvar[$i])) {}
	else
	{$testvar[$i] = "0";
	}
	
	}
	for ($i = "09"; $i < "22"; $i++) {
	if (isset($testvar2[$i])) {}
	else
	{$testvar2[$i] = "0";
	}
	
	}
	for ($i = "09"; $i < "22"; $i++) {
	if (isset($testvar3[$i])) {}
	else
	{$testvar3[$i] = "0";
	}
	
	}
	for ($i = "09"; $i < "22"; $i++) {
	if (isset($testvar4[$i])) {}
	else
	{$testvar4[$i] = "0";
	}
	
	}
	for ($i = "09"; $i < "22"; $i++) {
	if (isset($testvar5[$i])) {}
	else
	{$testvar5[$i] = "0";
	}
	
	}
	for ($i = "09"; $i < "22"; $i++) {
	if (isset($testvar6[$i])) {}
	else
	{$testvar6[$i] = "0";
	}
	
	}

//this bit adjusts the interval of the graph to be more readable.	
$max = max($testvar);
$max2 = max($testvar2);
$max3 = max($testvar3);
$max4 = max($testvar4);
$max5 = max($testvar5);
$max6 = max($testvar6);
$umax = max(array($max, $max2, $max3, $max4, $max5, $max6));
$umax5 = $umax/5;
$inter = ceil(intval($umax5)/5)*5;

ceil(intval($umax)/5)*5;
$test1 = $testvar['09'];
$test2 = $testvar['10'];
$test3 = $testvar['11'];
$test4 = $testvar['12'];
$test5 = $testvar['13'];
$test6 = $testvar['14'];
$test7 = $testvar['15'];
$test8 = $testvar['16'];
$test9 = $testvar['17'];
$test10 = $testvar['18'];
$test11 = $testvar['19'];
$test12 = $testvar['20'];
$test13 = $testvar['21'];

$testa1 = $testvar2['09'];
$testa2 = $testvar2['10'];
$testa3 = $testvar2['11'];
$testa4 = $testvar2['12'];
$testa5 = $testvar2['13'];
$testa6 = $testvar2['14'];
$testa7 = $testvar2['15'];
$testa8 = $testvar2['16'];
$testa9 = $testvar2['17'];
$testa10 = $testvar2['18'];
$testa11 = $testvar2['19'];
$testa12 = $testvar2['20'];
$testa13 = $testvar2['21'];

$testb1 = $testvar3['09'];
$testb2 = $testvar3['10'];
$testb3 = $testvar3['11'];
$testb4 = $testvar3['12'];
$testb5 = $testvar3['13'];
$testb6 = $testvar3['14'];
$testb7 = $testvar3['15'];
$testb8 = $testvar3['16'];
$testb9 = $testvar3['17'];
$testb10 = $testvar3['18'];
$testb11 = $testvar3['19'];
$testb12 = $testvar3['20'];
$testb13 = $testvar3['21'];

$testc1 = $testvar4['09'];
$testc2 = $testvar4['10'];
$testc3 = $testvar4['11'];
$testc4 = $testvar4['12'];
$testc5 = $testvar4['13'];
$testc6 = $testvar4['14'];
$testc7 = $testvar4['15'];
$testc8 = $testvar4['16'];
$testc9 = $testvar4['17'];
$testc10 = $testvar4['18'];
$testc11 = $testvar4['19'];
$testc12 = $testvar4['20'];
$testc13 = $testvar4['21'];

$testd1 = $testvar5['09'];
$testd2 = $testvar5['10'];
$testd3 = $testvar5['11'];
$testd4 = $testvar5['12'];
$testd5 = $testvar5['13'];
$testd6 = $testvar5['14'];
$testd7 = $testvar5['15'];
$testd8 = $testvar5['16'];
$testd9 = $testvar5['17'];
$testd10 = $testvar5['18'];
$testd11 = $testvar5['19'];
$testd12 = $testvar5['20'];
$testd13 = $testvar5['21'];

$teste1 = $testvar6['09'];
$teste2 = $testvar6['10'];
$teste3 = $testvar6['11'];
$teste4 = $testvar6['12'];
$teste5 = $testvar6['13'];
$teste6 = $testvar6['14'];
$teste7 = $testvar6['15'];
$teste8 = $testvar6['16'];
$teste9 = $testvar6['17'];
$teste10 = $testvar6['18'];
$teste11 = $testvar6['19'];
$teste12 = $testvar6['20'];
$teste13 = $testvar6['21'];

include("phpgraphlib.php"); 
$graph=new PHPGraphLib(1000,300);
$data=array("9am"=>$test1, "10am"=>$test2, "11am"=>$test3, "12pm"=>$test4, "1pm"=>$test5, "2pm"=>$test6, "3pm"=>$test7, "4pm"=>$test8, "5pm"=>$test9, "6pm"=>$test10, "7pm"=>$test11, "8pm"=>$test12, "9pm"=>$test13);
$data2=array("9am"=>$testa1, "10am"=>$testa2, "11am"=>$testa3, "12pm"=>$testa4, "1pm"=>$testa5, "2pm"=>$testa6, "3pm"=>$testa7, "4pm"=>$testa8, "5pm"=>$testa9, "6pm"=>$testa10, "7pm"=>$testa11, "8pm"=>$testa12, "9pm"=>$testa13);
$data3=array("9am"=>$testb1, "10am"=>$testb2, "11am"=>$testb3, "12pm"=>$testb4, "1pm"=>$testb5, "2pm"=>$testb6, "3pm"=>$testb7, "4pm"=>$testb8, "5pm"=>$testb9, "6pm"=>$testb10, "7pm"=>$testb11, "8pm"=>$testb12, "9pm"=>$testb13);
$data4=array("9am"=>$testc1, "10am"=>$testc2, "11am"=>$testc3, "12pm"=>$testc4, "1pm"=>$testc5, "2pm"=>$testc6, "3pm"=>$testc7, "4pm"=>$testc8, "5pm"=>$testc9, "6pm"=>$testc10, "7pm"=>$testc11, "8pm"=>$testc12, "9pm"=>$testc13);
$data5=array("9am"=>$testd1, "10am"=>$testd2, "11am"=>$testd3, "12pm"=>$testd4, "1pm"=>$testd5, "2pm"=>$testd6, "3pm"=>$testd7, "4pm"=>$testd8, "5pm"=>$testd9, "6pm"=>$testd10, "7pm"=>$testd11, "8pm"=>$testd12, "9pm"=>$testd13);
$data6=array("9am"=>$teste1, "10am"=>$teste2, "11am"=>$teste3, "12pm"=>$teste4, "1pm"=>$teste5, "2pm"=>$teste6, "3pm"=>$teste7, "4pm"=>$teste8, "5pm"=>$teste9, "6pm"=>$teste10, "7pm"=>$teste11, "8pm"=>$teste12, "9pm"=>$teste13);
$graph->addData($data, $data2, $data3, $data4, $data5, $data6);
$graph->setLegend(true);
$graph->setLegendOutlineColor('white');
$graph->setLegendTitle('Research', 'Directional', 'Computer Help', 'Printing/Copying', 'e-Learning', 'Consultation');
$graph->setBarColor('blue', 'green', '#ff00ff', 'purple', 'yellow', '#ff9900');
$graph->setIntervals($inter);
$graph->setGrid(true);
$graph->setXValuesHorizontal(true);
$graph->createGraph();
?>