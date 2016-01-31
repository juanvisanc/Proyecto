<!DOCTYPE html>
<html>
  <head>
    <?php include 'cabecera.php' ?>
  <link rel="stylesheet" type="text/css" href="./css/equipo.css">
  </head>
  <body>
    <?php
    if (!isset($_GET['id'])) {
      header('Location: index.php');
    }
     ?>
     <?php include 'include.php' ?>
    <div class="row">
      <div class="col-md-8">
    <?php
        $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
        //$conection->set_charset("utf8");
        mysqli_set_charset($connection, "utf8");

        $id=$_GET['id'];

        if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
        }

        if ($result = $connection->query("SELECT nombre FROM EQUIPO WHERE idEquipo=$id;")){
          $obj = $result->fetch_object();

          echo "<h1 class='plantilla'><img src='../imagenes/$id.png'>Plantilla del $obj->nombre</h1>";
          $result = $connection->query("SELECT en.nombre, en.apellidos FROM EQUIPO  e,Entrena ent,
            ENTRENADOR en WHERE e.idEquipo=ent.idEquipo and ent.idEntrenador=en.idEntrenador and
            e.idEquipo=$id;");
          $obj = $result->fetch_object();
          if ($result->num_rows==0) {
            echo "<h4 class='plantilla'>Nombre del entrenador: No tenemos datos aún</h4>";
          }else {
            echo "<h4 class='plantilla'>Nombre del entrenador: $obj->nombre $obj->apellidos</h4>";
          }

          if($result3 = $connection->query("SELECT en.nombreUsu as usuario FROM Entrena ent,
              ENTRENADOR en WHERE ent.idEntrenador=en.idEntrenador and ent.idEquipo=$id;")){
            $obj3 = $result3->fetch_object();
          }

        ?>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Apellidos</th>
                  <th>Nombre</th>
                  <th>Alias</th>
                  <th>Ficha</th>
                  <?php if (isset($_SESSION["usuario"])){
                    if ($_SESSION["rol"]==='admin' or ($result->num_rows===1 and
                    $_SESSION["usuario"]===$obj3->usuario)) {
                    ?>
                  <th>Editar</th>
                  <th>Eliminar</th>
                  <?php }} ?>
                </tr>
              </thead>

    <?php

              $result2 = $connection->query("select j.nombre,j.apellidos,j.alias,j.idJugador from JUGADOR j,EQUIPO e
                WHERE j.idEquipo=e.idEquipo and e.idEquipo=$id;");

              while($obj2 = $result2->fetch_object()) {

                  echo "<tr>";
                  echo "<td>".$obj2->apellidos."</td>";
                  echo "<td>".$obj2->nombre."</td>";
                  echo "<td>".$obj2->alias."</td>";
                  echo "<td><a href='jugador.php?id=$obj2->idJugador'>Ver</a></td>";
                  if (isset($_SESSION["usuario"])){
                    if ($_SESSION["rol"]==='admin' or ($result->num_rows===1 and
                    $_SESSION["usuario"]===$obj3->usuario)) {
                    echo "<td><a href='jugador.php?id=$obj2->idJugador'>Edita</a></td>";
                    echo "<td><a href='jugador.php?id=$obj2->idJugador'>Elimina</a></td></tr>";
                  }else {
                    echo "</tr>";
                  }
                }
              }

              echo "</table>";
              $result->close();
              unset($obj);
              $result2->close();
              unset($obj2);
              unset($connection);


            }

        ?>
      </div>
      <div class="col-md-4">Clasificacion Último partido y próximo</div>
    </div>
    <footer class="container-fluid text-center">
      <p>Esta página está basada en la colaboración voluntaria,
        por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
    </footer>
  </body>
</html>
