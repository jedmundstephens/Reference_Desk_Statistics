<?php
extract($_GET);
$serializedc = unserialize(rawurldecode($_GET['serializedc']));
include("phpgraphlib.php"); 
$graph=new PHPGraphLib(1000,300);
$graph->addData($serializedc);
$graph->setLegend(true);
$graph->setLegendOutlineColor('white');
$graph->setLegendTitle('Reference');
$graph->setBarColor('blue');
$graph->setIntervals(10);
$graph->setGrid(true);
$graph->setXValuesHorizontal(false);
$graph->createGraph();
?>