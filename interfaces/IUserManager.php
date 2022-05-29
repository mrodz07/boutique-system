<?php
	interface IUserManager{
    public function save($username, $password);
    public function checkUsername($username);
    public function checkCredentials($username, $password);
	}
?>
