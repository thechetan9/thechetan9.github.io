<?php

	require '../C/Class_Database.php';
	require '../C/Class_Manufacturer.php';

	$manufacturer = new Manufacturer();

	echo $manufacturer->insert(["manufacturer_name"=>$_REQUEST["name"]]);
?>