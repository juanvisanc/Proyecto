<!DOCTYPE html>
<html>
  <head>
    <title>Fútbol-7 Sevilla</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </head>
  <body>
    <?php
      if (!isset($_GET['id'])) {
        header('Location: index.php');
      }else{

        $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol");
        $id=$_GET['id'];

        if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
        }

        if ($result = $connection->query("SELECT nombre FROM EQUIPO WHERE idEquipo=$id;")){
          $obj = $result->fetch_object();
          echo "<h1>Plantilla del $obj->nombre</h1>";


    ?>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Apellidos</th>
                  <th>Nombre</th>
                  <th>Alias</th>
                </tr>
              </thead>

    <?php

              $result = $connection->query("select j.nombre,j.apellidos,j.alias from JUGADOR j,EQUIPO e
                WHERE j.idEquipo=e.idEquipo and e.idEquipo=$id;");
              while($obj = $result->fetch_object()) {

                  echo "<tr>";
                  echo "<td>".$obj->apellidos."</td>";
                  echo "<td>".$obj->nombre."</td>";
                  echo "<td>".$obj->alias."</td></tr>";

              }

              echo "</table>";
              $result->close();
              unset($obj);
              unset($connection);


            }
          }
        ?>

  </body>
</html>
