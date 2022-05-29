<?php
	interface IUserManager{
    public function save($username, $password, $isAdmin);
    public function updatePass($username, $password);
    public function checkUsername($username);
    public function checkCredentials($username, $password);
	}
?>
