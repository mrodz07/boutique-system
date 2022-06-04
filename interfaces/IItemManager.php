<?php
	interface IItemManager{
    public function saveProduct($name);
    public function saveBrand($name);
    public function saveType($name);
    public function saveSpec($id_product, $id_brand, $id_season, $id_category, $id_gender, $id_color, $id_size, $description);
    public function saveSpecType($name_spec, $name_type);
    public function updateProduct($name);
    public function updateBrand($name);
    public function updateType($name);
    public function updateSpec($id_product, $id_brand, $id_season, $id_category, $id_gender, $id_color, $id_size, $description);
    public function updateSpecType($name_spec, $name_type);
    public function getProduct($name);
    public function getBrand($name);
    public function getType($name);
    public function getSpec($name);
    public function deleteProduct($name);
    public function deleteBrand($name);
    public function deleteType($name);
    public function deleteSpec($name);
    public function getProduct($name);
    public function getBrand($name);
    public function getGender($name);
    public function getSize($name);
    public function getColor($name);
    public function getCategorie($name);
    public function getSeason($name);
    public function getType($name);
    public function getState($name);
    public function getSpec($name);
    public function getSpecType($name);
    public function getAllProducts();
    public function getAllBrands();
    public function getAllGenders();
    public function getAllSizes();
    public function getAllColors();
    public function getAllCategories();
    public function getAllSeasons();
    public function getAllTypes();
    public function getAllStates();
    public function getAllSpec($name);
    public function getAllSpecType($name);
	}
?>
