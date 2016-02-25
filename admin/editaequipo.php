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

    //si hay id del equipo y es admin el usuario
    if (isset($_GET['id'])) {
        if (isset($_SESSION["usuario"]) and $_SESSION['rol']==='admin' ) {
          $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
          //$conection->set_charset("utf8");
          mysqli_set_charset($connection, "utf8");

          if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $mysqli->connect_error);
            exit();
          }
          $equipo=$_GET['id'];

          //sacamos datos del equipo para ponerlos en los values
          $result= $connection->query("SELECT * FROM EQUIPO where idEquipo=$equipo;");
          $obj=$result->fetch_object();
          ?>
          <div class="row">
            <div class="col-md-12">
              <h3 class="colabora">Editar equipo</h3>
              <hr>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Localidad</th>
                  <th></th>
                </tr>
              </thead>
              <tr><form method='POST' action='../admin/editadoequipo.php'>
                <input class='form-control' <?php echo "value='$obj->idEquipo'"; ?> type='text' name='id' style='display:none' required/>
              <td><input class='form-control' <?php echo "value='$obj->nombre'"; ?> type='text' name='nombre'  required/></td>
              <td><input class='form-control' <?php echo "value='$obj->localidad'"; ?> type='text' name='localidad'  required/></td>
              <td><input type='submit' name='enviar' id='submit' value='Guardar' class='btn btn-success pull-right'></td>
            </form></tr>
            </table>
          </div>
        </div>
        <?php
        }else {
          header('Location: ../usuario/index.php');
        }
      }else {
        header('Location: ../usuario/index.php');
        }

          ?>

        <footer class="container-fluid text-center">
          <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
        </footer>
  </body>
</html>
