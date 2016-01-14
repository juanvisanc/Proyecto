<!DOCTYPE html>
<html>
  <head>
    <title>Fútbol-7 Sevilla</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/jugador.css">
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
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
          <?php

            $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
            //$conection->set_charset("utf8");
            mysqli_set_charset($connection, "utf8");

            $id=$_GET['id'];

            if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $mysqli->connect_error);
              exit();
            }

            if ($result = $connection->query("SELECT j.alias,j.nombre,j.apellidos,e.idEquipo FROM EQUIPO e,JUGADOR j
              WHERE j.idEquipo=e.idEquipo and j.idJugador=$id;")) {
              $obj = $result->fetch_object();
              echo "<h1 class='jugador'>$obj->nombre $obj->apellidos <b>'$obj->alias'</b></h1>";
            }

          ?>
          <table class="table table-hover">

            <?php

                $result = $connection->query("select j.numero,j.posicion,j.edad,j.altura,j.peso,
                COUNT(ju.idJugador) AS 'jugado',
                SUM(ju.goles) as 'gol',SUM(ju.tarjetasA) as 'ta',SUM(ju.tarjetasR) as 'tr'
                from JUGADOR j,Juego ju WHERE j.idJugador=ju.idJugador and ju.idJugador=$id;");
                  $obj = $result->fetch_object();

                    echo "<tr>";
                    echo "<th>Número</th>";
                    echo "<td>".$obj->numero."</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Posición</th>";
                    echo "<td>".$obj->posicion."</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Edad</th>";
                    echo "<td>".$obj->edad."</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Altura</th>";
                    echo "<td>".$obj->altura." metros</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Peso</th>";
                    echo "<td>".$obj->peso." kilos</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Partidos jugados</th>";
                    echo "<td>".$obj->jugado."</td>";
                    echo "</tr>";
                    if ($obj->gol==NULL) {
                      echo "<tr>";
                      echo "<th>Goles</th>";
                      echo "<td>0</td>";
                      echo "</tr>";
                    }else {
                      echo "<tr>";
                      echo "<th>Goles</th>";
                      echo "<td>".$obj->gol."</td>";
                      echo "</tr>";
                    }

                    if ($obj->ta==NULL) {
                      echo "<tr>";
                      echo "<th>Tarjetas amarillas</th>";
                      echo "<td>0</td>";
                      echo "</tr>";
                    }else {
                      echo "<tr>";
                      echo "<th>Tarjetas amarillas</th>";
                      echo "<td>".$obj->ta."</td>";
                      echo "</tr>";
                    }
                    if ($obj->tr==NULL) {
                      echo "<tr>";
                      echo "<th>Tarjetas rojas</th>";
                      echo "<td>0</td>";
                      echo "</tr>";
                    }else {
                      echo "<tr>";
                      echo "<th>Tarjetas rojas</th>";
                      echo "<td>".$obj->tr."</td>";
                      echo "</tr>";
                    }


                  echo "</table>";
                  $result->close();
                  unset($obj);
                  unset($connection);




                ?>

          </div>
          <div class="col-sm-2"></div>
      </div>
    <footer class="container-fluid text-center">
      <p>Esta página está basada en la colaboración voluntaria,
        por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
    </footer>
  </body>
</html>
