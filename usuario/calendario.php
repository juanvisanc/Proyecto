<!DOCTYPE html>
<html>

<head>
  <?php include 'cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="./css/registro.css">
</head>
<style media="screen">
  #resultado{
    padding-left:4%;
  }
  .form-control {
    min-width: 0;
    width: 5em;
    display: inline;
}
</style>
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
    //Para entrar en esta página hay que mandar id del equipo, si no para atras.
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
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Local</th>
            <th>Goles Local</th>
            <th>Goles Visitante</th>
            <th>Visitante</th>
            <th>Fecha</th>
            <?php
              if (isset($_SESSION['usuario']) and $_SESSION['rol']=='admin') {
                ?>
                <th><th>
                  <?php } ?>
          </tr>
        </thead>
        <?php
        $result = $connection->query("SELECT p.*, l.nombre as local,v.nombre as visitante,l.idEquipo as lo,
          v.idEquipo as vi FROM EQUIPO l, PARTIDO p, EQUIPO v
          WHERE l.idEquipo=p.idEquipoL and p.idEquipoV=v.idEquipo and jornada=$id;");

          if ($result->num_rows===0) {
            echo "<div id='dialog-message' title='Error.'>
              <p>
                No existe esa Jornada. Por favor, elija otra jornada.
              </p>
              </div>";
          }

          if (!isset($_SESSION['usuario'])){
          while($obj = $result->fetch_object()) {
            echo "<tr><td>$obj->local</td><td id='resultado'>$obj->golesL</td><td id='resultado'>$obj->golesV</td>
            <td>$obj->visitante</td><td>$obj->fecha</td></tr>";
          }
        }elseif (isset($_SESSION['usuario']) and $_SESSION['rol']=='admin') {
          while($obj = $result->fetch_object()) {
            echo "<tr><td>$obj->local</td><td><input type='number' class='form-control' value='$obj->golesL' name='golesL' required></td>
            <td><input type='text' class='form-control' value='$obj->golesV' name='golesV' min='0' required></td>
            <td>$obj->visitante</td><td>$obj->fecha</td><td>
            <input type='submit' name='enviar' id='submit' value='Guardar' class='btn btn-success pull-right'></td></tr>";
          }
        }elseif (isset($_SESSION['usuario']) and $_SESSION['rol']!=='admin'){
          $equipo=$_SESSION['equipo'];
          while($obj = $result->fetch_object()) {
            if ($equipo==$obj->lo) {
              echo "<tr><td><a href='#'>$obj->local</a></td><td id='resultado'>$obj->golesL:$obj->golesV</td>
                          <td>$obj->visitante</td><td>$obj->fecha</td></tr>";
            }elseif ($equipo==$obj->vi) {
              echo "<tr><td>$obj->local</td><td id='resultado'>$obj->golesL:$obj->golesV</td>
              <td><a href='#'>$obj->visitante</a></td><td>$obj->fecha</td></tr>";
            }else {
              echo "<tr><td>$obj->local</td><td id='resultado'>$obj->golesL:$obj->golesV</td>
                        <td>$obj->visitante</td><td>$obj->fecha</td></tr>";
            }
          }
        }
          $result->close();
          unset($obj);
          unset($connection);
         ?>
      </table>
    </div>
  </div>
  <footer class="container-fluid text-center">
    <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
  </footer>
</body>

</html>
