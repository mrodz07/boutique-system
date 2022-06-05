<?php
  session_start();
	require_once "../models/UserManager.php";
	require_once "../models/ItemManager.php";
  $itemManager = itemManager::getInstance();
	$userManager = userManager::getInstance();
  $username = $_SESSION['username'];

	if (empty($_POST['submit'])){
    header("Location: /app/user_list.php");
    exit;
	}

  if (!isset($username)) {
    $error = "Entra a tu cuenta antes de acceder al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }
  
	$args = array(
	    'product'  => FILTER_SANITIZE_NUMBER_INT,
	    'brand'  => FILTER_SANITIZE_NUMBER_INT,
      'season' => FILTER_SANITIZE_NUMBER_INT,
	    'category'  => FILTER_SANITIZE_NUMBER_INT,
	    'gender'  => FILTER_SANITIZE_NUMBER_INT,
	    'color'  => FILTER_SANITIZE_NUMBER_INT,
	    'size'  => FILTER_SANITIZE_NUMBER_INT,
	    'description'  => FILTER_SANITIZE_STRING
	);

	$post = (object)filter_input_array(INPUT_POST, $args);

if($itemManager->saveSpec($post->product, $post->brand, $post->season, $post->category, $post->gender, $post->color, $post->size, $post->description)) {
    $_SESSION['message'] = "El artículo se agregó correctamente";
  } else {
    $_SESSION['error'] = "El artículo que añadiste ya se encuentra en la lista";
  }
	header("Location: /app/item_list.php");
?>
