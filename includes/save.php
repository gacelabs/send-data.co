<?php
if(!empty($_POST['data'])){
	echo "<pre>"; print_r($_POST); exit();
	$data = $_POST['data'];
	$fname = mktime() . ".txt";//generates random name
	$file = fopen("upload/" .$fname, 'w');//creates new file
	fwrite($file, $data);
	fclose($file);
}
?>