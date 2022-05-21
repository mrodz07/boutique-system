<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Añadir autos</title>
    <link rel="stylesheet" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body>
    <?php
      require_once "../models/CarManager.php";
      $carManager = CarManager::getInstance();
      $brands = $carManager->getAllBrands();        
    ?>
    <div class="container">
      <h2 class="main-title">Add car</h2>
      <form action="<?php echo CarManager::baseurl() ?>/app/save.php" method="POST"> 
        <div class="form-group">
          <label for="username">Name</label>
          <input type="text" name="nombre" value="" class="form-control" id="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
          <p>Brand</p>
          <select name="id_marca">
            <?php foreach($brands as $brand) { ?>
              <option value="<?php echo $brand->id?>"><?php echo $brand->nombre?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
            <label for="password">Air conditioning</label>
            <input type="radio" name="ac" value="true" class="form-control" id="ac">True</input>
            <input type="radio" name="ac" value="false" class="form-control" id="ac">False</input>
        </div>
        <input type="submit" name="submit" class="button info" value="Save car"/>
      </form>
    </div>
  </body>
</html>
