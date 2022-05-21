<?php
	interface ICarManager{
    public function save($id, $id_marca, $ac);
    public function saveBrand($nombre);
    public function get($id);
    public function getAll();
    public function getAllBrands();
    public function getBrand($id);
    public function update($id, $nombre, $id_marca, $ac);
    public function delete($id);
    public function checkCar($id);
    public static function getInstance();
	}
?>
