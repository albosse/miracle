<?php
include_once 'helper/TransformXML.php';
include_once '../classes/Event.php';
include_once '../classes/Gateway.php';
include_once '../classes/Task.php';
include_once '../classes/Process.php';
include_once '../classes/SequenceFlow.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="application/xhtml+xml;  charset=utf-8" />
	<title> XML Parser </title>
</head>
  <body>
  <h1> XML Hochladen und auswerten </h1>
    <?php

if (isset ($_FILES['thefile']['tmp_name']) || isset($_GET['file']))
{
	$file = isset($_FILES['thefile']['tmp_name'])? $_FILES['thefile']['tmp_name'] : '../processes/bpmn/' . $_GET['file'];
	$filename = isset($_FILES['thefile']['tmp_name'])? $_FILES['thefile']['name'] : $_GET['file'];
	$xml = simplexml_load_file($file);

	$name = explode('.',$filename);
	$transform = new TransformXML($name[0]);
	$transform->generateObject($xml->process);
	$transform->serialise();

	echo '<a href="process_xml.php">Zurück<br /><br /></a>';
	echo '<b>Der Prozess wurde erfolgreich generiert.</b><br /><br />';

	echo '<h2>' . $filename . '</h2><br />';

	//Print the Process object
	echo '<pre>';
	print_r($transform->getProcess());
	echo '</pre>';
}
	else
	{
		//Show form
	?>
	<fieldset>
		<legend>Einen neuen Prozess verarbeiten</legend>
		      <form method="post" enctype="multipart/form-data">
		        <input type="file" name="thefile" accept="application/xhtml+xml"><br>
		        <input type="submit" value="Auswerten">
		      </form>
	</fieldset>

		<fieldset>
		<legend>Prozess auf dem Server umwandeln</legend>
		      <?php
		if ($handle = opendir('../processes/bpmn')) {
		    while (false !== ($file = readdir($handle))) {
		        if ($file != "." && $file != ".." && (strpos($file,'bpmn') || strpos($file,'xml'))) {
		            echo '<a href="process_xml.php?file=' . $file . '">' . $file . '</a><br />';
		        }
		    }
		    closedir($handle);
		}
		?>
		</fieldset>

		<fieldset>
		<legend>Seite aus Prozess generieren</legend>
		      <?php
		if ($handle = opendir('../processes/serialized')) {
		    while (false !== ($file = readdir($handle))) {
		        if ($file != "." && $file != ".." && strpos($file,'miracle') ) {
		            echo '<a href=' . $file . '>' . $file . '</a><br />';
		        }
		    }
		    closedir($handle);
		}

		echo '<a href="../backend/convert_to_html.php">Testfall</a>';
			?>
		</fieldset>
    <?php } ?>
  </body>
</html>