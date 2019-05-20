<?php
	// require '../vendor/autoload.php';
	require '../C/Class_Database.php';
	require '../C/Class_Manufacturer.php';

	$manufacturer = new Manufacturer();

	echo json_encode($manufacturer->selectAll());
?>