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
    ?>
    <div class="container">
      <h2 class="main-title">Add brand</h2>
      <form action="<?php echo CarManager::baseurl() ?>/app/save_brand.php" method="POST"> 
        <div class="form-group">
          <label for="username">Name</label>
          <input type="text" name="nombre" value="" class="form-control" id="nombre" placeholder="Nombre">
        </div>
        <input type="submit" name="submit" class="button info" value="Save brand"/>
      </form>
    </div>
  </body>
</html>
