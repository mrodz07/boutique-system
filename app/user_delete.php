<?php
  session_start();

  $userManager = UserManager::getInstance();
  $username = $_SESSION['username'];

  if (!isset($username)) {
    $error = "Entra a tu cuenta antes de acceder al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }

	$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);

	if ($username) {
		$userManager->delete($username);
	}
	header("Location: /app/user_list.php");
?>
