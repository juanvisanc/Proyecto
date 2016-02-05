<!DOCTYPE html>
<html>
<head>
  <?php include '../colaborador/cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="../usuario/css/registro.css">
</head>
  <body>
    <?php
        include '../colaborador/include.php';

        if (isset($_SESSION['usuario']) and $_SESSION['rol']==='admin') {

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
          <h3 class="colabora">Usuarios registrados</h3>
          <hr>
        </div>
        <div class="col-md-9 col-md-offset-1">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Equipo</th>
              </tr>
            </thead>

            <?php
                if($result = $connection->query("SELECT * FROM ENTRENADOR;")){
                  while($obj = $result->fetch_object()) {

                    echo "<tr>";
                    echo "<td>".$obj->nombre."</td>";
                    echo "<td>".$obj->apellidos."</td>";
                    echo "<td>".$obj->correo."</td>";
                    echo "<td>".$obj->rol."</td>";

                    if ($obj->rol==='entrenador' or $obj->rol==='admin') {
                      $result2 = $connection->query("SELECT e.nombre FROM Entrena en,EQUIPO e
                         where en.idEquipo=e.idEquipo and en.idEntrenador=$obj->idEntrenador;");
                      $obj2=$result2->fetch_object();
                      echo "<td>".$obj2->nombre."</td></tr>";
                    }else{
                      $result3 = $connection->query("SELECT e.nombre FROM Colabora c ,EQUIPO e
                         where c.idEquipo=e.idEquipo and c.idEntrenador=$obj->idEntrenador;");
                      $obj3=$result3->fetch_object();
                      echo "<td>".$obj3->nombre."</td></tr>";
                    }
                }
                echo "</table>";

              }
             ?>

      <?php  }else{
          header("Location: ../usuario/index.php");
        }
    ?>
  </div>
</div>
    <footer class="container-fluid text-center">
      <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
    </footer>
  </body>
</html>
