<!DOCTYPE html>
<html>
<head>
  <?php include 'cabecera.php'; ?>
    <link rel="stylesheet" type="text/css" href="../usuario/css/registro.css">
</head>
<body>
  <?php
  include '../colaborador/include.php';
  if (isset($_SESSION['usuario']) and isset($_GET['id'])) {

      $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
      //$conection->set_charset("utf8");
      mysqli_set_charset($connection, "utf8");

      if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $mysqli->connect_error);
        exit();
      }

      $id=$_GET['id'];
      $usuario=$_SESSION['usuario'];
      $equipo=$_SESSION['equipo'];
      $result = $connection->query("SELECT * FROM ENTRENADOR where idEntrenador=$id and nombreUsu='$usuario';");
      if ($result->num_rows===1) {
        $obj = $result->fetch_object();
        ?>
        <div class="row">
          <div class="col-md-12">
            <h3 class="colabora"><?php echo "$obj->nombre $obj->apellidos"; ?></h3>
            <hr>
          </div>
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <table class="table table-hover">
              <?php
              echo "<tr>";
              echo "<th class='col-md-6'>Nombre</th>";
              echo "<td>".$obj->nombre."</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<th>Apellidos</th>";
              echo "<td>".$obj->apellidos."</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<th>Nombre de usuario</th>";
              echo "<td>".$obj->nombreUsu."</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<th>Email</th>";
              echo "<td>".$obj->correo."</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<th>Colabora como</th>";
              echo "<td>".$obj->rol."</td>";
              echo "</tr>";

               ?>
             </table>
          </div>
        </div>

    <?php }else {
        header("Location: ../usuario/index.php");
      }

    }else {
      header("Location: ../usuario/index.php");
    }
      ?>
  <footer class="container-fluid text-center">
    <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
  </footer>
</body>
</html>
