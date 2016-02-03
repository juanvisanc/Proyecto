<!DOCTYPE html>
<html>

<head>
  <?php include 'cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="../usuario/css/equipo.css">
</head>

<body>
  <?php
      include 'include.php';
      //Si no hay id de jugador o no existe sesion lo mandamos atras.
      if (!isset($_GET['id']) or !isset($_SESSION["usuario"])) {
        header("Location: ../usuario/index.php");
      }
      //Si es el admin o el equipo que pasamos coincide con el de la sesion podemos editar
      elseif($_SESSION["rol"]==='admin' or $_SESSION["equipo"]===$_GET["equipo"]){
        $jugador=$_GET["id"];
        $equipo=$_GET["equipo"];

        $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
        mysqli_set_charset($connection, "utf8");
        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
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

      }
        ?>


          <form id="registerForm" method="POST" action="registro.php">
            <div class="form-group">
              <div class="col-xs-6">
                <label for="InputName">Nombre</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nombre" <?php echo "value='$obj->nombre'"?> placeholder="Nombre" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
                <br>
                <label for="InputName">Apellidos</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="apellidos" <?php echo "value='$obj->apellidos'"?> placeholder="Apellidos" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
                <hr>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-6">
                <label for="InputName">Alias</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="alias" placeholder="Alias" <?php echo "value='$obj->alias'"?> required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
                <br>
                <label for="InputCity">Posición</label>
                <div class="input-group">
                  <select name="equipo" class="form-control" required>
                    <option value='portero'>Portero</option>
                    <option value='defensa'>Defensa</option>
                    <option value='medio'>Medio</option>
                    <option value='delantero'>Delantero</option>
                  </select>
                  <span class="input-group-addon"><span class="glyphicon  glyphicon-menu-down"></span></span>
                </div>
                <hr>
              </div>
            </div>

            <div class="form-group">
              <div class="col-xs-3">
                <label for="InputEmail">Número</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="numero" <?php echo "value='$obj->numero'"?> placeholder="Numero" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
              </div>
              <div class="col-xs-3">
                <label for="InputEmail">Edad</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="edad" <?php echo "value='$obj->edad'"?> placeholder="Edad" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
              </div>
              <div class="col-xs-3">
                <label for="InputEmail">Altura</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="altura" <?php echo "value='$obj->altura'"?> placeholder="Altura" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
              </div>
              <div class="col-xs-3">
                <label for="InputEmail">Peso</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="peso" <?php echo "value='$obj->peso'"?> placeholder="Peso" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
              </div>
            </div>
            <br>
            <div class="form-group">
              <div class="input-group-addon">
                <input type="submit" name="enviar" id="submit" value="Guardar" class="btn btn-success pull-right">
              </div>
            </div>
      </div>
    </div>
    </div>
    <br>
    </form>
    <footer class="container-fluid text-center">
      <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
    </footer>
</body>

</html>
