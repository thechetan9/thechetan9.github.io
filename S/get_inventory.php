<?php
	// print_r($_REQUEST);
	
	header('Access-Control-Allow-Origin: *');  

	require '../C/Class_Database.php';
	require '../C/Class_Inventory.php';

	$inventory = new Inventory();
	if(isset($_REQUEST['id']) && $_REQUEST['id'] != '')
	{
	    echo json_encode($inventory->select($_REQUEST['id'])[0]);
	} 
	else
	{
	    echo json_encode($inventory->selectAll());
	}
?>