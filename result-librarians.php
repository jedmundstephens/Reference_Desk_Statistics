<?php
extract($_GET);
$libnum = unserialize(rawurldecode($_GET['libnum']));
arsort($libnum);
include('phpgraphlib.php');
include('phpgraphlib_pie.php');
$graph = new PHPGraphLibPie(900, 300);
$data = $libnum;
$graph->addData($data);
$graph->setLabelTextColor('90,90,90');
$graph->setLegendTextColor('50,50,50');
$graph->createGraph();
?>