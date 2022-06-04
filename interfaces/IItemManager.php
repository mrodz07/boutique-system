<?php
	interface IItemManager{
    public function save_product($name);
    public function save_brand($name);
    public function save_phase($name);
    public function save_size($name);
    public function updatePass($username, $password);
    public function updateUsername($oldUsername, $newUsername);
    public function checkUsername($username);
    public function checkCredentials($username, $password);
    public function get($username);
    public function getAll();
    public function delete($username);
	}
?>
