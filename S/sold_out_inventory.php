<?php

	require '../C/Class_Database.php';
	require '../C/Class_Model.php';

	$model = new Model();

	echo $model->soldOut($_REQUEST['id']);
?>