<!DOCTYPE html>
<html>
<head>
  <?php include 'cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="./css/jugador.css">
</head>
<body>

  <!-- script dialog. Se pondra en include?? -->
  <script>
    $(function() {
      $("#dialog-message").dialog({
        modal: true,
        buttons: {
          Ok: function() {
            $(this).dialog("close");
          }
        },
        open: function(event, ui) {
          setTimeout("$('#dialog-message').dialog('close')", 5000);
        }
      });
    });
  </script>


  <?php
      //Para entrar en esta página hay que mandar id del jugador, si no para atras.
      if (!isset($_GET['id'])) {
        header('Location: index.php');
      }

      //include comun
      include 'include.php';
    ?>

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

            //sacamos para titulo el nombre y equipo del jugador
            if ($result = $connection->query("SELECT j.alias,j.nombre,j.apellidos,e.idEquipo,e.nombre
              as 'eq' FROM EQUIPO e,JUGADOR j
              WHERE j.idEquipo=e.idEquipo and j.idJugador=$id;")) {
                $obj = $result->fetch_object();

                echo "<h1 class='jugador'>
                <img src='../imagenes/$obj->idEquipo.png'>$obj->nombre $obj->apellidos <b>'$obj->alias'</b>
                </h1>";
            }

          ?>
            <table class="table table-hover">

              <?php

                //sacamos caracteristicas y estadisticas del jugador
                $result = $connection->query("select j.numero,j.posicion,j.edad,j.altura,j.peso,
                COUNT(ju.idJugador) AS 'jugado',
                SUM(ju.goles) as 'gol',SUM(ju.tarjetasA) as 'ta',SUM(ju.tarjetasR) as 'tr'
                from JUGADOR j,Juego ju WHERE j.idJugador=ju.idJugador and ju.idJugador=$id;");
                  $obje = $result->fetch_object();

                    echo "<tr>";
                    echo "<th class='col-md-6'>Equipo</th>";
                    echo "<td>".$obj->eq."<img class='icono' src='../imagenes/$obj->idEquipo.png'></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Número</th>";
                    echo "<td>".$obje->numero."</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Posición</th>";
                    echo "<td>".$obje->posicion."</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Edad</th>";
                    echo "<td>".$obje->edad."</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Altura</th>";
                    echo "<td>".$obje->altura." metros</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Peso</th>";
                    echo "<td>".$obje->peso." kilos</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Partidos jugados</th>";
                    echo "<td>".$obje->jugado."</td>";
                    echo "</tr>";

                    //en caso que no haya jugado ningun partido gol es null, al igual q TR y TA. Ponemos 0
                    if ($obje->gol==NULL) {
                      echo "<tr>";
                      echo "<th>Goles</th>";
                      echo "<td>0</td>";
                      echo "</tr>";
                    }else {
                      echo "<tr>";
                      echo "<th>Goles</th>";
                      echo "<td>".$obje->gol."</td>";
                      echo "</tr>";
                    }

                    if ($obje->ta==NULL) {
                      echo "<tr>";
                      echo "<th>Tarjetas amarillas</th>";
                      echo "<td>0</td>";
                      echo "</tr>";
                    }else {
                      echo "<tr>";
                      echo "<th>Tarjetas amarillas</th>";
                      echo "<td>".$obje->ta."</td>";
                      echo "</tr>";
                    }
                    if ($obje->tr==NULL) {
                      echo "<tr>";
                      echo "<th>Tarjetas rojas</th>";
                      echo "<td>0</td>";
                      echo "</tr>";
                    }else {
                      echo "<tr>";
                      echo "<th>Tarjetas rojas</th>";
                      echo "<td>".$obje->tr."</td>";
                      echo "</tr>";
                    }


                  echo "</table>";
                  $result->close();
                  unset($obj);
                  unset($obje);
                  unset($connection);




                ?>

        </div>

      </div>
      <footer class="container-fluid text-center">
        <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
      </footer>
</body>

</html>
