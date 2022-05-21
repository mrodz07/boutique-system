<?php
	require_once "../models/CarManager.php";
	if (empty($_POST['submit'])){
    header("Location:" . CarManager::baseurl() . "/app/list.php");
    exit;
	}

	$args = array(
	    'nombre'  => FILTER_SANITIZE_STRING,
	    'id_marca'  => FILTER_SANITIZE_STRING,
	    'ac'  => FILTER_SANITIZE_STRING,
	);

	$post = (object)filter_input_array(INPUT_POST, $args);

	$carManager = CarManager::getInstance();
	$carManager->save($post->nombre, $post->id_marca, $post->ac);
	header("Location:" . CarManager::baseurl() . "/app/list.php");

?>
