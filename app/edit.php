<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar auto</title>
    <link rel="stylesheet" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body>
    <?php
        require_once "../models/CarManager.php";
        $carManager = CarManager::getInstance();
        $id = filter_input(INPUT_GET, 'car', FILTER_VALIDATE_INT);
        if(!$id) {
            header("Location:" . $carManager->baseurl() . "/app/list.php");
        }
        $carManager->checkCar($id);
        $car = $carManager->get($id);
        $brands = $carManager->getAllBrands();        
    ?>
    <div class="container">
      <h2 class="main-title">Edit car</h2>
      <form action="<?php echo CarManager::baseurl() ?>/app/update.php" method="POST">
          <div class="form-group">
              <label for="username">Nombre</label>
              <input type="text" name="nombre" value="<?php echo $car->nombre ?>" class="form-control" id="nombre" placeholder="Username">
          </div>
          <div class="form-group">
            <p>Brand</p>
            <select name="id_marca">
              <?php foreach($brands as $brand) { ?>
                <?php if ($car->id_marca == $brand->id) { ?>
                  <option value="<?php echo $brand->id?>" selected><?php echo $brand->nombre?></option>
                <?php } else { ?>
                  <option value="<?php echo $brand->id?>"><?php echo $brand->nombre?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
              <p>Air conditioning</p>
              <?php if ($car->aire_acondicionado) {?>
                <input type="radio" name="ac" value="true" class="form-control" id="ac" checked="checked">True</input>
                <input type="radio" name="ac" value="false" class="form-control" id="ac">False</input>
              <?php } else { ?>
                <input type="radio" name="ac" value="true" class="form-control" id="ac">True</input>
                <input type="radio" name="ac" value="false" class="form-control" id="ac" checked="checked">False</input>
              <?php } ?>
          </div>
          <input type="hidden" name="id" value="<?php echo $car->id ?>" />
          <input type="submit" name="submit" class="button info" value="Update car"/>
      </form>
    </div>
</body>
</html>
