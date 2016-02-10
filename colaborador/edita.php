<!DOCTYPE html>
<html>

<head>
  <?php include 'cabecera.php'; ?>
    <link rel="stylesheet" type="text/css" href="../usuario/css/equipo.css">
</head>

<body>
  <?php

  include 'include.php';
  if (isset($_GET['id']) and isset($_GET['equipo']) and isset($_SESSION["usuario"])) {
    $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
    //$conection->set_charset("utf8");
    mysqli_set_charset($connection, "utf8");

    if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $mysqli->connect_error);
      exit();
    }
    $equipo=$_GET['equipo'];
    $equipoUsu=$_SESSION["equipo"];
    $jugador=$_GET['id'];
    $result = $connection->query("SELECT idJugador FROM JUGADOR WHERE
      idEquipo=$equipoUsu and idJugador=$jugador;");

      if ($result->num_rows !==0 or $_SESSION["rol"]==='admin') {
  ?>

    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <?php
          //Sacamos los atributos de jugadores para poder editarlos.
          $result = $connection->query("SELECT * from JUGADOR WHERE idJugador=$jugador;");

        $obj = $result->fetch_object();
        echo "<h1 class='jugador'>
        <img src='../imagenes/$equipo.png'>$obj->nombre $obj->apellidos <b>'$obj->alias'</b>
        </h1>";
        ?>


          <form id="registerForm" method="POST" action="editado.php">
            <input style='display:none' type='text' name='equipo' <?php echo "value='$equipo'"?>>
            <input style='display:none' type='text' name='jugador' <?php echo "value='$jugador'"?>>
            <div class="form-group">
              <div class="col-xs-6">
                <label for="InputName">Nombre</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nombre" <?php echo "value='$obj->nombre'"?>
                  placeholder="Nombre" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
                <br>
                <label for="InputName">Apellidos</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="apellidos" <?php echo "value='$obj->apellidos'"?>
                  placeholder="Apellidos" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
                <hr>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-6">
                <label for="InputName">Alias</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="alias"
                  placeholder="Alias" <?php echo "value='$obj->alias'"?> required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
                <br>
                <label for="InputCity">Posición</label>
                <div class="input-group">
                  <select name="posicion" class="form-control" required>
                    <option <?php echo "value='$obj->posicion'"?>><?php echo "$obj->posicion"?></option>
                    <option value='Portero'>Portero</option>
                    <option value='Defensa'>Defensa</option>
                    <option value='Medio'>Medio</option>
                    <option value='Delantero'>Delantero</option>
                  </select>
                  <span class="input-group-addon"><span class="glyphicon  glyphicon-menu-down"></span></span>
                </div>
                <hr>
              </div>
            </div>

            <div class="form-group">
              <div class="col-xs-3">
                <label>Número</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="numero" <?php echo "value='$obj->numero'"?>
                  placeholder="Numero" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
              </div>
              <div class="col-xs-3">
                <label>Edad</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="edad" <?php echo "value='$obj->edad'"?>
                  placeholder="Edad" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
              </div>
              <div class="col-xs-3">
                <label for="InputEmail">Altura</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="altura" <?php echo "value='$obj->altura'"?>
                  placeholder="Altura" step="0.01" min="0" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
              </div>
              <div class="col-xs-3">
                <label for="InputEmail">Peso</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="peso" <?php echo "value='$obj->peso'"?>
                  placeholder="Peso" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
              </div>
            </div>
            <br>
            <div class="form-group">
              <div class="input-group-addon">
                <input type="submit" name="enviar" id="submit" value="Editar" class="btn btn-success pull-right">
              </div>
            </div>
      </div>
    </div>
    </div>
    <br>
    </form>
    <?php

        $result->close();
        unset($obj);
        unset($connection);
        }else {
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
