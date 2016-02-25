<!DOCTYPE html>
<html>
<style media="screen">
.form-control {
  min-width: 0;
  width: 5em;
  display: inline;
}

</style>
<head>
  <?php include '../colaborador/cabecera.php'; ?>
    <link rel="stylesheet" type="text/css" href="../admin/css/usuarios.css">
</head>
  <body>
    <?php

    include '../colaborador/include.php';

    //solo si es admin
    if (isset($_SESSION["usuario"]) and $_SESSION['rol']==='admin' ) {
      $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
      //$conection->set_charset("utf8");
      mysqli_set_charset($connection, "utf8");

      if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $mysqli->connect_error);
        exit();
      }

      ?>
      <div class="row">
        <div class="col-md-12">
          <h3 class="colabora">Crear nuevo equipo</h3>
          <hr>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <table class="table table-hover">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Localidad</th>
              <th>Imagen</th>
              <th></th>
            </tr>
          </thead>
          <tr><form method='POST' enctype="multipart/form-data" action='../admin/crearequipo.php'>
          <td><input class='form-control' type='text' name='nombre'  required/></td>
          <td><input class='form-control' type='text' name='localidad'  required/></td>
          <td><input type='file' name='imagen' id="imagen" required/></td>
          <td><input type='submit' name='enviar' id='submit' value='Guardar' class='btn btn-success pull-right'></td>
        </form></tr>
        </table>
      </div>
    </div>
    <?php
    }else {
      header('Location: ../usuario/index.php');
    }
      ?>

        <footer class="container-fluid text-center">
          <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
        </footer>
  </body>
</html>
