<?php
extract($_GET);
$serializedd = unserialize(rawurldecode($_GET['serializedd']));
include("phpgraphlib.php"); 
$graph=new PHPGraphLib(1000,300);
$graph->addData($serializedd);
$graph->setLegend(true);
$graph->setLegendOutlineColor('white');
$graph->setLegendTitle('Reference');
$graph->setBarColor('#ff6600');
$graph->setIntervals(50);
$graph->setGrid(true);
$graph->setXValuesHorizontal(true);
$graph->createGraph();
?>