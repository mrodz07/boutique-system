<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Listado de autos</title>
    <link rel="stylesheet" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body>
    <?php
      require_once "../models/CarManager.php";
      $carManager = CarManager::getInstance();
      $cars = $carManager->getAll();        
    ?>
    <div class="container">
      <h2 class="main-title">Car List</h2>
          <div class="button-container">
            <a class="button info" href="<?php echo CarManager::baseurl() ?>/app/add.php">Add car</a>
            <a class="button info" href="<?php echo CarManager::baseurl() ?>/app/add_brand.php">Add brand</a>
          </div>
          <?php if(!empty($cars)) { ?>
          <table class="table">
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Marca</th>
              <th>Aire acondicionado</th>
              <th>Opciones</th>
            </tr>
            
            <?php foreach($cars as $car) { ?>
              <tr>
                <td><?php echo $car->id ?></td>
                <td><?php echo $car->nombre ?></td>
                <td><?php echo $carManager->getBrand($car->id_marca)->nombre ?></td>
                <td><?php echo $car->aire_acondicionado > 0 ? 'Sí' : 'No' ?></td>
                <td>
                    <a class="button info" href="<?php echo CarManager::baseurl() ?>/app/edit.php?car=<?php echo $car->id ?>">Edit</a> 
                    <a class="button info" href="<?php echo CarManager::baseurl() ?>/app/delete.php?car=<?php echo $car->id ?>">Delete</a>
                </td>
              </tr>
            <?php } ?>
          </table>
          <?php
            } else {
          ?>
            <div class="msg alert">There are 0 registered users</div>
          <?php
            }
          ?>
      </div>
    </div>
  </body>
</html>
