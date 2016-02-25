<!DOCTYPE html>
<html>

<head>
  <?php include 'cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="./css/registro.css">
</head>
<style media="screen">
  .form-control {
    min-width: 0;
    width: 5em;
    display: inline;
}
  th{
    text-align: center;
  }
</style>

<!-- script para el dialog-->
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
<body>

  <?php
    //Para entrar en esta página hay que mandar la jornada
    if (!isset($_GET['id'])) {
      header('Location: index.php');
    }

    include 'include.php';
    $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
         //$conection->set_charset("utf8");
    mysqli_set_charset($connection, "utf8");

    $id=$_GET['id'];

  if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $mysqli->connect_error);
    exit();
  }

  ?>
  <div class="row">
    <div class="col-md-12">
      <h3 class="colabora">Jornada <?php echo $id ?></h3>
      <hr>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <table class="table table-hover text-center">
        <?php

        //si se es admin
          if (isset($_SESSION['usuario']) and $_SESSION['rol']=='admin') {
            ?>
        <thead>
          <tr>
            <th>Local</th>
            <th>Goles Local</th>
            <th>Goles Visitante</th>
            <th>Visitante</th>
            <th>Fecha</th>
            <th>Eliminar</th>
            <th></th>
        <?php
        //si no es admin
       }else {?>
          <thead>
            <tr>
              <th>Local</th>
              <th>Resultado</th>
              <th>Visitante</th>
              <th>Fecha</th>
              <th>Localidad</th>
        <?php } ?>
          </tr>
        </thead>
        <?php


        $result = $connection->query("SELECT p.*, l.nombre as local,v.nombre as visitante,
          l.idEquipo as lo,v.idEquipo as vi FROM EQUIPO l, PARTIDO p, EQUIPO v
          WHERE l.idEquipo=p.idEquipoL and p.idEquipoV=v.idEquipo and jornada=$id;");

          if ($result->num_rows===0) {
            echo "<div id='dialog-message' title='Error.'>
              <p>
                No existe esa Jornada. Por favor, elija otra jornada.
              </p>
              </div>";
          }

          //si no esta logueado o esta logueado pero no es admin solo podra ver y enlazar
          if (!isset($_SESSION['usuario']) or (isset($_SESSION['usuario']) and $_SESSION['rol']!=='admin')){
          while($obj = $result->fetch_object()) {
            echo "<tr><td><a href='../usuario/estadistica.php?idEq=$obj->lo&idP=$obj->idPartido'>$obj->local</a></td><td id='resultado'>$obj->golesL:$obj->golesV</td>
                        <td><a href='../usuario/estadistica.php?idEq=$obj->vi&idP=$obj->idPartido'>$obj->visitante</a></td><td>$obj->fecha</td><td>$obj->localidad</td></tr>";
          }

          //sacamos todas las jornadas disponibles para poder linkearlas
          $result = $connection->query("SELECT jornada from PARTIDO order by jornada desc limit 1;");
          $obj = $result->fetch_object();
          $cont=1;
          $fin=$obj->jornada;
            echo "<tr><th  colspan='7'>Jornadas disponibles:";
            while ($cont<=$fin) {
              echo "<a href='../usuario/calendario.php?id=$cont'> $cont</a>";
              $cont=$cont+1;
            }
            echo "</th></tr>";
            $result->close();
            unset($obj);
            unset($connection);

            //si es admin
        }elseif (isset($_SESSION['usuario']) and $_SESSION['rol']=='admin') {
          while($obj = $result->fetch_object()) {
            echo "<tr><form method='POST' action='../admin/guarda_resultado.php'>
            <input type='number' value='$obj->idPartido' name='id' style='display:none' required/>
            <input type='number' value='$id' name='jornada' style='display:none' required/>
            <td><a href='../usuario/estadistica.php?idEq=$obj->lo&idP=$obj->idPartido'>$obj->local</a></td>
            <td><input type='number' class='form-control' value='$obj->golesL' name='golesL' min='0' required></td>
            <td><input type='number' class='form-control' value='$obj->golesV' name='golesV' min='0' required></td>
            <td><a href='../usuario/estadistica.php?idEq=$obj->vi&idP=$obj->idPartido'>$obj->visitante</a></td><td>$obj->fecha</td>
            <td><a href='../admin/elimina_partido.php?id=$obj->idPartido&jornada=$id'>
            <span class='glyphicon glyphicon-trash'/></a></td>
            <td>
            <input type='submit' name='enviar' id='submit' value='Guardar' class='btn btn-success pull-right'>
            </td></form></tr>";
          }
          $result = $connection->query("SELECT jornada from PARTIDO order by jornada desc limit 1;");
          $obj = $result->fetch_object();
          $cont=1;
          $fin=$obj->jornada;
            echo "<tr><th  colspan='7'>Jornadas disponibles:";
            while ($cont<=$fin) {
              echo "<a href='../usuario/calendario.php?id=$cont'> $cont</a>";
              $cont=$cont+1;
            }
            echo "</th></tr>";
            $result->close();
            unset($obj);
            unset($connection);
        }
            echo "</th></tr>";


         ?>
      </table>
    </div>
  </div>
  <footer class="container-fluid text-center">
    <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
  </footer>
</body>

</html>
