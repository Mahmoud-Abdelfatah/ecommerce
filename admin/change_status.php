<?php
    include 'includes/session.php';

	$id = $_POST['id'];
    $action = $_POST['action'];

    //echo json_encode($action);
	$conn = $pdo->open();   

	$stmt = $conn->prepare("UPDATE   sales SET 	o_status=:action where id=:id");
	$stmt->execute(['id'=>$id,'action'=>$action]);

	$pdo->close();
	echo json_encode($action);