<?php
	require_once "../models/UserManager.php";
  $userManager = UserManager::getInstance();
	$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);

	if ($username) {
		$userManager->delete($username);
	}
	header("Location: /app/user_list.php");
?>
