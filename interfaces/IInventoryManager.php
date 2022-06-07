<?php
	interface IInventoryManager {
    public function getAvailable($id_spec);
    public function getPrice($id_spec);
    public function getConsignated($id_spec);
    public function getReserved($id_spec);
    public function getSold($id_spec);
    public function getAll();
    public function updateAvailable($id_spec, $quantity);
    public function updateConsignated($id_spec, $quantity);
    public function updateReserved($id_spec, $quantity);
    public function updatePrice($id_spec, $price);
    public function deleteItem($id_spec);
	}
?>
