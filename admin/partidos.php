<!DOCTYPE html>
<html>

<head>
  <?php include '../colaborador/cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="../admin/css/usuarios.css">
</head>

<body>
  <?php
        include '../colaborador/include.php';


        //solo entra si es admin
        if (isset($_SESSION['usuario']) and $_SESSION['rol']==='admin') {
        $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
        mysqli_set_charset($connection, "utf8");

        if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
        }
        $result = $connection->query("SELECT * FROM EQUIPO;");
      ?>
    <div class="row">
      <div class="col-sm-12">
        <h3 class="colabora">Partidos</h3>
        <hr>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <form id="registerForm" method="POST" action="inserta_partido.php">
          <div class="form-group">
            <div class="col-xs-6">
              <label>Local</label>
              <div class="input-group">
                <select class="form-control" name="local" required>
                  <option>---Elige equipo---</option>
                  <?php
                  while($obj = $result->fetch_object()) {
                      echo"<option value='$obj->idEquipo'>$obj->nombre</option>";
                  }
                   ?>
                </select>
                <span class="input-group-addon"><span class="glyphicon  glyphicon-menu-down"></span></span>
              </div>
              <br>
              <label>Visitante</label>
              <div class="input-group">
                <select class="form-control" name="visitante" required>
                  <option>---Elige equipo---</option>
                  <?php
                  $result = $connection->query("SELECT * FROM EQUIPO;");
                  while($obj = $result->fetch_object()) {
                      echo"<option value='$obj->idEquipo'>$obj->nombre</option>";
                  }
                   ?>
                </select>
                <span class="input-group-addon"><span class="glyphicon  glyphicon-menu-down"></span></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-6">
              <label>Fecha</label>
              <div class="input-group">
                <input type="date" class="form-control" name="fecha" placeholder="Fecha" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
              </div>
              <br>
              <label>Localidad</label>
              <div class="input-group">
                <input type="text" class="form-control" name="localidad" placeholder="Localidad" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-4"></div>
        </div>
        <div class="form-group">
          <div class="col-xs-4">
            <br>
            <label>Jornada</label>
            <div class="input-group">
              <input type="number" class="form-control" name="jornada" min='1' placeholder="Jornada" required>
              <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
            </div>
            <br>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
          <div class="input-group-addon">
            <input type="submit" name="enviar" id="submit" value="Guardar" class="btn btn-success pull-right">
          </div>
        </div>
        <br>
      </div>
        </form>
        <br>
        </div>
      </div>
      <br>
    <?php
  }else {
    header('Location: ../usuario/index.php');
  }
      ?>
      <footer class="container-fluid text-center">
        <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
      </footer>
</body>

</html>
