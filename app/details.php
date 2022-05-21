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
      <h2 class="main-title">Car details</h2>
        <div class="form-group">
          <p>ID</p>
          <input type="text" name="id" value="<?php echo $car->id ?>" class="form-control" id="id" placeholder="id" disabled>
        </div>
        <div class="form-group">
            <label for="username">Nombre</label>
            <input type="text" name="nombre" value="<?php echo $car->nombre ?>" class="form-control" id="nombre" placeholder="Username" disabled>
        </div>
        <div class="form-group">
          <p>Brand</p>
          <select name="id_marca" disabled>
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
              <input type="radio" name="ac" value="true" class="form-control" id="ac" checked="checked" disabled>True</input>
              <input type="radio" name="ac" value="false" class="form-control" id="ac" disabled>False</input>
            <?php } else { ?>
              <input type="radio" name="ac" value="true" class="form-control" id="ac" disabled>True</input>
              <input type="radio" name="ac" value="false" class="form-control" id="ac" checked="checked" disabled >False</input>
            <?php } ?>
        </div>
      </form>
    </div>
</body>
</html>
