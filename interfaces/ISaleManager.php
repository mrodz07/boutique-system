<?php
	interface ISaleManager {
    public function createSale($id_pay, $id_inventory, $id_state, $quantity);
    public function updateSale($id, $id_pay, $id_inventory, $id_state, $quantity);
    public function getSale($id);
    public function getAll();
    public function removeSale($id);
	}
?>
