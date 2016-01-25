<!DOCTYPE html>
<html>

<head>
  <title>Fútbol-7 Sevilla</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/registro.css">
</head>

<body>
  <?php
      $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
      //$conection->set_charset("utf8");
      mysqli_set_charset($connection, "utf8");

      if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $mysqli->connect_error);
        exit();
      }
  ?>
  <?php if (!isset($_POST['nombre'])): ?>
  <?php include 'include.php' ?>
  <div class="row">
    <div class="col-md-12">
      <h3 class="colabora">Colabora con nosotros</h3><hr>
    </div>
    <div class="col-md-6 col-md-offset-3">
      <form id="registerForm" method="POST" action="registro.php">
        <div class="form-group">
          <div class="col-xs-6">
            <label for="InputName">Nombre</label>
            <div class="input-group">
              <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
              <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
            </div>
            <br>
            <label for="InputName">Nombre de usuario</label>
            <div class="input-group">
              <input type="text" class="form-control" name="usuNombre" placeholder="Nombre de usuario" required>
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            </div>
            <hr>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-6">
            <label for="InputName">Apellidos</label>
            <div class="input-group">
              <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required>
              <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
            </div>
            <br>
            <label for="InputPassword">Contraseña</label>
            <div class="input-group">
              <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
              <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            </div>
            <hr>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <label for="InputEmail">Email</label>
            <div class="input-group">
              <input type="email" class="form-control" name="email" placeholder="Email" required>
              <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            </div>
            <br>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <label for="InputStreetName">¿Eres entrenador o colaborador?</label>
            <div class="input-group">
              <div class="form-inline required">
                <div class="form-group has-feedback">
                  <label class="input-group">
                    <span class="input-group-addon">
                      <input type="radio" name="entrenador" value="entrenador" required/>
                    </span>
                    <div class="form-control form-control-static">
                      Entrenador
                    </div>
                    <span class="glyphicon form-control-feedback "></span>
                  </label>
                </div>
                <div class="form-group has-feedback ">
                  <label class="input-group">
                    <span class="input-group-addon">
                                  <input type="radio" name="entrenador" value="colaborador" required/>
                              </span>
                    <div class="form-control form-control-static">
                      Colaborador
                    </div>
                    <span class="glyphicon form-control-feedback "></span>
                  </label>
                </div>
              </div>
            </div>
            <br>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <label for="InputCity">Equipo</label>
            <?php
                $result = $connection->query("SELECT nombre,idEquipo FROM EQUIPO;");
            ?>

              <div class="input-group">
                <select name="equipo" class="form-control" required>
                  <?php
                  while($obj = $result->fetch_object()) {
                      echo"<option value='$obj->idEquipo'>$obj->nombre</option>";
                  }
                  ?>
                </select>
                <span class="input-group-addon"><span class="glyphicon  glyphicon-menu-down"></span></span>
              </div>
              <br>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group-addon">
            <input type="submit" name="enviar" id="submit" value="Guardar" class="btn btn-success pull-right">
          </div>
        </div>
      </form>
    </div>
  </div>
  <footer class="container-fluid text-center">
    <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
  </footer>
  <?php else: ?>
    <?php
      $nombre=$_POST['nombre'];
      $apellidos=$_POST['apellidos'];
      $usuario=$_POST['usuNombre'];
      $pass=$_POST['password'];
      $email=$_POST['email'];
      $entrenador=$_POST['entrenador'];
      $equipo=$_POST['equipo'];


      $result = $connection->query("SELECT e.idEquipo FROM EQUIPO e,Entrena en
        WHERE e.idEquipo=en.idEquipo and e.idEquipo=$equipo;");
      $obj = $result->fetch_object();

      $result2 = $connection->query("SELECT e.idEquipo FROM EQUIPO e,Colabora c
        WHERE e.idEquipo=c.idEquipo and e.idEquipo=$equipo;");
      $obj2=$result2->fetch_object();

      if ($entrenador=='entrenador') {
        if ($obj==NULL) {
          $connection->query("INSERT INTO ENTRENADOR VALUES
            (NULL,'$nombre','$apellidos','$email','$usuario',md5('$pass'),'$entrenador');");
          $result3=$connection->query("SELECT idEntrenador FROM ENTRENADOR WHERE nombreUsu='$usuario';" );
          $obj3=$result3->fetch_object();
          $connection->query("INSERT INTO Entrena VALUES ($obj3->idEntrenador,$equipo);");

        }else {
          echo "<p>YA EXISTE ENTRENADOR DE ESE EQUIPO<p>";
        }
      }else {
        if ($obj2==NULL) {
          $connection->query("INSERT INTO ENTRENADOR VALUES
            (NULL,'$nombre','$apellidos','$email','$usuario',md5('$pass'),'$entrenador');");
            $result4=$connection->query("SELECT idEntrenador FROM ENTRENADOR WHERE nombreUsu='$usuario';" );
            $obj4=$result4->fetch_object();
            $connection->query("INSERT INTO Colabora VALUES ($obj4->idEntrenador,$equipo);");

        }else {
          echo "<p>YA EXISTE Colaborador DE ESE EQUIPO<p>";
          echo $connection->error;
        }
      }

      $result->close();
      $result2->close();
      $result3->close();
      $result4->close();
      unset($obj);
      unset($obj2);
      unset($obj3);
      unset($obj4);
      unset($connection);

     ?>
  <?php endif ?>
</body>

</html>
