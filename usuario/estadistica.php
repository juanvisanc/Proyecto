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
  <?php include 'cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="css/registro.css">
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
  <?php include 'include.php'; ?>

      <?php

      //si no existe idequipo vuelta atras
      if (!isset($_GET['idEq'])) {
        header('Location: index.php');
      }

      //si no existe idpartido vuelta atras
      if (!isset($_GET['idP'])) {
        header('Location: index.php');
      }

      $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
           //$conection->set_charset("utf8");
      mysqli_set_charset($connection, "utf8");

      if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $mysqli->connect_error);
        exit();
      }
      $idE=$_GET['idEq'];
      $idP=$_GET['idP'];

      //sacamos el nombre del equipo para titulo
      $result = $connection->query("SELECT nombre FROM EQUIPO where idEquipo=$idE;");
      $obj = $result->fetch_object();

      //si esta logueado
      if(isset($_SESSION["usuario"])){

        //si es admin o su equipo es el que hemos pasado podrá editar las estadisticas
        if($_SESSION["rol"]==='admin' or $_SESSION["equipo"]===$idE){
      ?>
      <div class="row">
        <div class="col-md-12">
          <h3 class="colabora">Estadisticas <?php echo "$obj->nombre"; ?></h3>
          <hr>
        </div>
        <div class="col-md-6">
          <table class="table table-hover text-center">
          <thead>
            <tr>
              <th class="text-center">Jugador</th>
              <th class="text-center">Goles</th>
              <th class="text-center">Tarjetas Amarilla</th>
              <th class="text-center">Tarjetas Rojas</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <?php

          //en un lado todos los jugadores y en el otro las estadisticas
          $result = $connection->query("SELECT * from JUGADOR
            where idEquipo=$idE and idJugador not in(
              SELECT ju.idJugador FROM JUGADOR ju,Juego j
              where ju.idJugador=j.idJugador and j.idPartido=$idP);");

              while($obj = $result->fetch_object()) {
                echo "<tr><form method='POST' action='../colaborador/jugado.php'>
                <input type='number' value='$obj->idJugador' name='jugador' style='display:none' required/>
                <input type='number' value='$idP' name='partido' style='display:none' required/>
                <input type='number' value='$idE' name='equipo' style='display:none' required/>";
                echo "<td id='jugador'>$obj->numero $obj->alias</td>";
                echo "<td><input type='number' class='form-control' value='0' name='goles' min='0' required></td>";
                echo "<td><input type='number' class='form-control' value='0' name='ta' min='0' max='2' required></td>";
                echo "<td><input type='number' class='form-control' value='0' name='tr' min='0' max='1' required></td>";
                echo "<td><input type='submit' name='enviar' id='submit' value='Guardar' class='btn btn-success pull-right'></td>";
                echo "</form></tr>";
              }


          ?>
          </table>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <table class="table table-hover text-center">
          <thead>
            <tr>
              <th class="text-center">Jugador</th>
              <th class="text-center">Goles</th>
              <th class="text-center">Tarjetas Amarilla</th>
              <th class="text-center">Tarjetas Rojas</th>
            </tr>
          </thead>
          <?php
          echo "<tr>";
          $result2 = $connection->query("SELECT j.*,ju.* from Juego j , JUGADOR ju where j.idJugador=ju.idJugador and
            j.idPartido=$idP and j.idJugador in
            (Select idJugador from JUGADOR where idEquipo=$idE);");
          while($obj2 = $result2->fetch_object()) {
          echo "<td>$obj2->numero $obj2->alias</td>";
          echo "<td>$obj2->goles</td>";
          echo "<td>$obj2->tarjetasA</td>";
          echo "<td>$obj2->tarjetasR</td>";
          echo "</tr>";
          }
           ?>
          </table>
        </div>

      </div>


      <?php

      //si esta logueado pero no es admin ni es su equipo
    }else {
    ?>
    <div class="row">
      <div class="col-md-12">
        <h3 class="colabora">Estadisticas <?php echo "$obj->nombre"; ?></h3>
        <hr>
      </div>
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <table class="table table-hover text-center">
        <thead>
          <tr>
            <th class="text-center">Jugador</th>
            <th class="text-center">Goles</th>
            <th class="text-center">Tarjetas Amarilla</th>
            <th class="text-center">Tarjetas Rojas</th>
            <th></th>
          </tr>
        </thead>
        <?php
        echo "<tr>";
        $result2 = $connection->query("SELECT j.*,ju.* from Juego j , JUGADOR ju where j.idJugador=ju.idJugador and
          j.idPartido=$idP and j.idJugador in
          (Select idJugador from JUGADOR where idEquipo=$idE);");
        while($obj2 = $result2->fetch_object()) {
        echo "<td>$obj2->numero $obj2->alias</td>";
        echo "<td>$obj2->goles</td>";
        echo "<td>$obj2->tarjetasA</td>";
        echo "<td>$obj2->tarjetasR</td>";
        echo "</tr>";
        }
         ?>
        </table>
      </div>

    </div>

    <?php }

    //en caso de no estar logueado solo podra ver las estadisticas
  }else { ?>
    <div class="row">
      <div class="col-md-12">
        <h3 class="colabora">Estadisticas <?php echo "$obj->nombre"; ?></h3>
        <hr>
      </div>
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <table class="table table-hover text-center">
        <thead>
          <tr>
            <th class="text-center">Jugador</th>
            <th class="text-center">Goles</th>
            <th class="text-center">Tarjetas Amarilla</th>
            <th class="text-center">Tarjetas Rojas</th>
            <th></th>
          </tr>
        </thead>
        <?php
        echo "<tr>";
        $result2 = $connection->query("SELECT j.*,ju.* from Juego j , JUGADOR ju where j.idJugador=ju.idJugador and
          j.idPartido=$idP and j.idJugador in
          (Select idJugador from JUGADOR where idEquipo=$idE);");
        while($obj2 = $result2->fetch_object()) {
        echo "<td>$obj2->numero $obj2->alias</td>";
        echo "<td>$obj2->goles</td>";
        echo "<td>$obj2->tarjetasA</td>";
        echo "<td>$obj2->tarjetasR</td>";
        echo "</tr>";
        }
         ?>
        </table>
      </div>

    </div>
    <?php }
       ?>

      <footer class="container-fluid text-center">
        <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
      </footer>
</body>

</html>
