<?php
	interface IItemManager{
    public function saveProduct($name);
    public function saveBrand($name);
    public function saveType($name);
    public function saveSpec($id_product, $id_brand, $id_season, $id_category, $id_gender, $id_color, $id_size, $description);
    public function saveSpecType($id_spec, $id_type);
    public function updateProduct($id, $name);
    public function updateBrand($id, $name);
    public function updateType($id, $name);
    public function updateSpec($id, $id_product, $id_brand, $id_season, $id_category, $id_gender, $id_color, $id_size, $description);
    public function updateSpecType($id, $id_spec, $id_type);
    public function getProduct($id);
    public function getBrand($id);
    public function getType($id);
    public function getSpec($id);
    public function getGender($id);
    public function getSize($id);
    public function getSizeStage($id);
    public function getColor($id);
    public function getTone($id);
    public function getColorTone($id);
    public function getCategory($id);
    public function getSeason($id);
    public function getState($id);
    public function getSpecType($id);
    public function getAllProducts();
    public function getAllBrands();
    public function getAllGenders();
    public function getAllSizes();
    public function getAllSizeStages();
    public function getAllColors();
    public function getAllTones();
    public function getAllColorTones();
    public function getAllCategories();
    public function getAllSeasons();
    public function getAllTypes();
    public function getAllStates();
    public function getAllSpec();
    public function getAllSpecTypes();
    public function deleteProduct($id);
    public function deleteBrand($id);
    public function deleteType($id);
    public function deleteSpec($id);
	}
?>
