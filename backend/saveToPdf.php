<?php
/*
 * Created on 14.08.2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

$data = htmlspecialchars($_POST["content"]);

$dir = "../summary/";
$time = date("d.m.Y_H-i",time());
$filename = "LCP" . '_' . $time . '.txt';

$file = $dir . $filename;
$fh = fopen($file, 'w') or die("can't open file");
fwrite($fh, $data);
fclose($fh);

echo '/summary/' . $filename ;