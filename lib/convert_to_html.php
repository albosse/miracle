<?php
include_once 'helper/TransformXML.php';
include_once 'helper/PageGenerator.php';
include_once '../classes/Event.php';
include_once '../classes/Gateway.php';
include_once '../classes/Task.php';
include_once '../classes/Process.php';
include_once '../classes/SequenceFlow.php';

$filename = 'Testprozess.miracle';
$transform = new TransformXML();
$process = $transform->unserialise($filename);

$pg = new PageGenerator($process,str_replace('.miracle','',$filename));
$page = $pg->process();

echo $page;

?>
