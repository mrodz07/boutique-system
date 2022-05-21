<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Listado de autos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <?php
      require_once "../models/CarManager.php";
      $carManager = CarManager::getInstance();
      $cars = $carManager->getAll();        
    ?>
    <div class="container">
      <div class="col-lg-12">
        <h2 class="text-center text-primary">Car List</h2>
          <div class="col-lg-1 pull-right" style="margin-bottom: 10px">
            <a class="btn btn-info" href="<?php echo CarManager::baseurl() ?>/app/add.php">Add car</a>
          </div>
          <?php if(!empty($cars)) { ?>
          <table class="table table-striped">
            <tr>
              <th>Id</th>
              <th>Car</th>
              <th>Marca</th>
              <th>Aire acondicionado</th>
            </tr>
            
            <?php foreach( $cars as $car ) { ?>
              <tr>
                <td><?php echo $car->id ?></td>
                <td><?php echo $car->nombre ?></td>
                <td><?php echo $car->id_marca ?></td>
                <td><?php echo $car->aire_acondicionado ?></td>
                <td>
                    <a class="btn btn-info" href="<?php echo CarManager::baseurl() ?>app/edit.php?user=<?php echo $car>id ?>">Edit</a> 
                    <a class="btn btn-info" href="<?php echo CarManager::baseurl() ?>app/delete.php?user=<?php echo $car>id ?>">Delete</a>
                </td>
              </tr>
            <?php } ?>
          </table>
          <?php
            } else {
          ?>
            <div class="alert alert-danger" style="margin-top: 100px">There are 0 registered users</div>
          <?php
            }
          ?>
      </div>
    </div>
  </body>
</html>
