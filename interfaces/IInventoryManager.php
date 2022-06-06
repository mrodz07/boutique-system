<?php
	interface IInventoryManager{
    public function saveItem($id_spec, $id_state, $quantity, $price, $date);
    public function getItem($id);
    public function updateItem($id_spec, $id_state, $quanityt, $price, $date);
    public function deleteItem($id);
	}
?>
