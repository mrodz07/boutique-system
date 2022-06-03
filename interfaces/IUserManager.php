<?php
	interface IUserManager{
    public function save($username, $password, $isAdmin);
    public function updatePass($username, $password);
    public function updateUsername($oldUsername, $newUsername);
    public function checkUsername($username);
    public function checkCredentials($username, $password);
    public function get($username);
    public function getAll();
    public function delete($username);
	}
?>
