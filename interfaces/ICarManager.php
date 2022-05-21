<?php
	interface ICarManager{
    public function save($id, $id_marca, $ac);
    public function get($id);
    public function getAll();
    public function update($id, $nombre, $id_marca, $ac);
    public function delete($id);
    public function checkUser($id);
    public static function getInstance();
	}
?>
