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
            <li class="active"><a href="registro.php">Registro</a></li>
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
    <div class="col-md-6 col-md-offset-3">
      <form id="registerForm" method="POST" >
<!---form--->           <div class="form-group">
<!---input width--->    <div class="col-xs-6">
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
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                    </div>
<!----------------------------break-------------------------------------------------------------> <br>
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
<!----------------------------break-------------------------------------------------------------> <br>
                    </div>
                </div>

                        <div class="form-group">
                        <div class="col-xs-12">
                        <label for="InputCity">Equipo</label>
                        <?php
                          $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
                          //$conection->set_charset("utf8");
                          mysqli_set_charset($connection, "utf8");

                          if ($connection->connect_errno) {
                            printf("Connection failed: %s\n", $mysqli->connect_error);
                            exit();
                          }
                          $result = $connection->query("SELECT nombre,idEquipo FROM EQUIPO;");

                        ?>

                        <div class="input-group">
                          <select name="equipo" class="form-control">
                            <?php
                              while($obj = $result->fetch_object()) {
                                  echo"<option value='$obj->idEquipo'>$obj->nombre</option>";
                              } ?>
                          </select>
                        <span class="input-group-addon"><span class="glyphicon  glyphicon-menu-down"></span></span>
                    </div>
<!----------------------------break-------------------------------------------------------------> <br>
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
      <p>Esta página está basada en la colaboración voluntaria,
        por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
    </footer>
  </body>
</html>
