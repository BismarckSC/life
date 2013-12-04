<?php


//$file = basename($_GET["file"]);
$file = $_GET["file"];

header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=relatorio.txt");
header("Content-Type: application/txt");
header("Content-Transfer-Encoding: binary");
// read the file from disk
readfile($file);

?>