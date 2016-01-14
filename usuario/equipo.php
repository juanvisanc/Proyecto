<!DOCTYPE html>
<html>
  <head>
    <title>Fútbol-7 Sevilla</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/equipo.css">
  </head>
  <body>
    <?php
    if (!isset($_GET['id'])) {
      header('Location: index.php');
    }
     ?>
     <nav class="navbar navbar-inverse">
       <div class="container-fluid">
         <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
         </div>
         <div class="collapse navbar-collapse" id="myNavbar">
           <ul class="nav navbar-nav">
             <li><a href="index.php">Inicio</a></li>
             <li><a href="#">Clasificación</a></li>
             <li><a href="#">Calendario</a></li>
             <li><a href="registro.php">Registro</a></li>
           </ul>
           <ul class="nav navbar-nav navbar-right">
             <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
           </ul>
         </div>
       </div>
     </nav>

    <div class="jumbotron">
      <div class="container text-center">
        <h1>Fútbol-7</h1>
        <h4>Liga Provincial Sevillana</h4>
      </div>
    </div>
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
          echo "<h1 class='plantilla'>Plantilla del $obj->nombre</h1>";

          $result = $connection->query("SELECT en.nombre, en.apellidos FROM EQUIPO  e,Entrena ent,
            ENTRENADOR en WHERE e.idEquipo=ent.idEquipo and ent.idEntrenador=en.idEntrenador and
            e.idEquipo=$id;");
          $obj = $result->fetch_object();

          if ($result->num_rows==0) {
            echo "<h4 class='plantilla'>Nombre del entrenador: No tenemos datos aún</h4>";
          }else {
            echo "<h4 class='plantilla'>Nombre del entrenador: $obj->nombre $obj->apellidos</h4>";
          }
          $result->close();
          unset($obj);
    ?>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Apellidos</th>
                  <th>Nombre</th>
                  <th>Alias</th>
                  <th>Ficha</th>
                </tr>
              </thead>

    <?php

              $result = $connection->query("select j.nombre,j.apellidos,j.alias,j.idJugador from JUGADOR j,EQUIPO e
                WHERE j.idEquipo=e.idEquipo and e.idEquipo=$id;");
              while($obj = $result->fetch_object()) {

                  echo "<tr>";
                  echo "<td>".$obj->apellidos."</td>";
                  echo "<td>".$obj->nombre."</td>";
                  echo "<td>".$obj->alias."</td>";
                  echo "<td><a href='jugador.php?id=$obj->idJugador'>Ver</a></td></tr>";

              }

              echo "</table>";
              $result->close();
              unset($obj);
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
