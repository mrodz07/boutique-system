<?php
	require_once "../models/CarManager.php";
  $carManager = CarManager::getInstance();
	$id = filter_input(INPUT_GET, 'car', FILTER_VALIDATE_INT);

	if( $id ){
		$carManager->delete($id);
	}
	header("Location:" . CarManager::baseurl() . "/app/list.php");
?>
