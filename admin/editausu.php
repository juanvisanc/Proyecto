<!DOCTYPE html>
<html>
<head>
  <?php include '../colaborador/cabecera.php'; ?>
    <link rel="stylesheet" type="text/css" href="../admin/css/usuarios.css">
</head>
  <body>
    <?php

    include '../colaborador/include.php';

    //solo entramos si somos admin y hemos pasado id del entrenador a editar
    if (isset($_GET['id']) and isset($_SESSION["usuario"]) and $_SESSION['rol']==='admin' ) {
      $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
      //$conection->set_charset("utf8");
      mysqli_set_charset($connection, "utf8");

      if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $mysqli->connect_error);
        exit();
      }
      $entrenador=$_GET['id'];

      //sacamos los datos del entrenador para ponerlos en los value
      $result = $connection->query("SELECT * from ENTRENADOR WHERE idEntrenador=$entrenador;");
      $obj = $result->fetch_object();
      ?>

      <!--si es admin o entrenador va a estar checked y mostrara uno u otros equipo-->
      <?php if ($obj->rol==='admin' or $obj->rol==='entrenador'): ?>
      <script>
      $(document).ready(function(){
        $('#uno').attr("disabled", true);
        $('#dos').attr("disabled", false);
      	$("#admin").click(function(){
      		$('#entrena').show();
          $('#dos').attr("disabled", false);
          $('#colabora').hide();
          $('#uno').attr("disabled", true);
      		});

        $("#entre").click(function(){
          $('#entrena').show();
          $('#dos').attr("disabled", false);
          $('#colabora').hide();
          $('#uno').attr("disabled", true);
      		});

        $("#cola").click(function(){
          $('#entrena').hide();
          $('#dos').attr("disabled", true);
          $('#colabora').show();
          $('#uno').attr("disabled", false);
      		});
       	});

      </script>

      <!--si es colaborador-->
    <?php else: ?>
      <script>
      $(document).ready(function(){
        $('#uno').attr("disabled", false);
        $('#dos').attr("disabled", true);
      	$("#admin").click(function(){
      		$('#entrena').show();
          $('#dos').attr("disabled", false);
          $('#colabora').hide();
          $('#uno').attr("disabled", true);
      		});

        $("#entre").click(function(){
          $('#entrena').show();
          $('#dos').attr("disabled", false);
          $('#colabora').hide();
          $('#uno').attr("disabled", true);
      		});

        $("#cola").click(function(){
          $('#entrena').hide();
          $('#dos').attr("disabled", true);
          $('#colabora').show();
          $('#uno').attr("disabled", false);
      		});
       	});

      </script>

      <?php endif ?>

      <div class="row">
        <div class="col-sm-12 text-center">
          <h3>Editar usuario</h3>
          <hr>
        </div>
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
          <form id="registerForm" method="POST" action="editadousu.php">
            <input style="display:none" name="id" <?php echo "value='$obj->idEntrenador'"; ?>>
            <div class="form-group">
              <div class="col-xs-6">
                <label for="InputName">Nombre</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nombre" <?php echo "value='$obj->nombre'"; ?>
                  placeholder="Nombre" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
                <br>
                <label for="InputName">Apellidos</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="apellidos" <?php echo "value='$obj->apellidos'"; ?>
                  placeholder="Apellidos" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
                <hr>
              </div>
            </div>

            <div class="form-group">
              <div class="col-xs-6">
                <label for="InputName">Nombre de usuario</label>
                <div class="input-group">
                  <input type="text" disabled="true" class="form-control" name="nombreUsu" <?php echo "value='$obj->nombreUsu'"; ?>
                  placeholder="Usuario" >
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
                <input type="text" style='display:none' class="form-control" name="nombreUsu" <?php echo "value='$obj->nombreUsu'"; ?>
                placeholder="Usuario" required>
                <br>
                <label for="InputEmail">Email</label>
                <div class="input-group">
                  <input type="email" class="form-control" name="email" <?php echo "value='$obj->correo'"; ?>
                  placeholder="Email" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                </div>
                <hr>
              </div>
            </div>

            <div class="form-group">
              <div class="col-xs-12">
                <label for="InputStreetName">Rol</label>
                <div class="input-group">
                  <div class="form-inline required">
                    <div class="form-group has-feedback">
                      <label class="input-group">
                        <span class="input-group-addon">
                    <input type="radio" name="rol" value="admin" <?php if ($obj->rol==='admin') {
                      echo "checked='checked'";
                      } ?> required/>
                  </span>
                        <div class="form-control form-control-static" id='admin'>
                          Administrador
                        </div>
                        <span class="glyphicon form-control-feedback "></span>
                      </label>
                    </div>
                    <div class="form-group has-feedback">
                      <label class="input-group">
                        <span class="input-group-addon">
                    <input type="radio" name="rol" value="entrenador" <?php if ($obj->rol==='entrenador') {
                      echo "checked='checked'";
                      } ?>
                    required/>
                  </span>
                        <div class="form-control form-control-static" id='entre'>
                          Entrenador
                        </div>
                        <span class="glyphicon form-control-feedback "></span>
                      </label>
                    </div>
                    <div class="form-group has-feedback ">
                      <label class="input-group">
                        <span class="input-group-addon">
                                <input type="radio" name="rol" value="colaborador" <?php if ($obj->rol==='colaborador') {
                                  echo "checked='checked'";
                                  } ?>
                            required/>
                            </span>
                        <div class="form-control form-control-static" id='cola'>
                          Colaborador
                        </div>
                        <span class="glyphicon form-control-feedback"></span>
                      </label>
                    </div>
                  </div>
                </div>
                <br>
              </div>
            </div>
            <div class="form-group" id='colabora' style="display:none">
              <div class="col-xs-12">
                <label for="InputCity">Equipo</label>
                <?php

                //sacamos los equipos disponibles para colaborador
              $result2 = $connection->query("SELECT * FROM EQUIPO
                WHERE idEquipo NOT IN (SELECT idEquipo FROM Colabora);");
          ?>

                  <div class="input-group">
                    <select name="equipo" class="form-control" id='uno' required>
                      <?php

                      //si es colaborador
                      if ($obj->rol==='colaborador') {


                      $result3 = $connection->query("SELECT e.idEquipo,e.nombre FROM Colabora c, EQUIPO e
                        WHERE c.idEquipo=e.idEquipo and c.idEntrenador=$entrenador;");
                        $obj3=$result3->fetch_object();

                        //por defecto equipo que ya tenia
                        echo"<option value='$obj3->idEquipo' selected='selected'>$obj3->nombre</option>";
                      }

                      //aqui es donde ponemos los equipos disponibles
                while($obj2 = $result2->fetch_object()) {
                    echo"<option value='$obj2->idEquipo'>$obj2->nombre</option>";
                }
                ?>
                    </select>
                    <span class="input-group-addon"><span class="glyphicon  glyphicon-menu-down"></span></span>
                  </div>
                  <br>
              </div>
            </div>
            <div class="form-group" id='entrena' style="display:none">
              <div class="col-xs-12">
                <label for="InputCity">Equipo</label>
                <?php
                $result2->close();
                unset($obj2);

                //cogemos los equipos disponibles para entrenador
              $result3 = $connection->query("SELECT * FROM EQUIPO
                WHERE idEquipo NOT IN (SELECT idEquipo FROM Entrena);");
          ?>

                  <div class="input-group">
                    <select name="equipo" class="form-control" id='dos' required>
                      <?php
                      if ($obj->rol==='entrenador' or $obj->rol==='admin') {

                        //vemos el equuipo que tiene el usuario
                      $result4 = $connection->query("SELECT e.idEquipo,e.nombre FROM Entrena en, EQUIPO e
                        WHERE en.idEquipo=e.idEquipo and en.idEntrenador=$entrenador ");
                        $obj4=$result4->fetch_object();

                        //por defecto el equipo que tenia
                        echo"<option value='$obj4->idEquipo' selected='selected'>$obj4->nombre</option>";
                        $result4->close();
                        unset($obj4);
                      }
                while($obj3 = $result3->fetch_object()) {
                    echo"<option value='$obj3->idEquipo'>$obj3->nombre</option>";
                }
                $result3->close();
                unset($obj3);
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
          <?php
          $result->close();
          unset($obj);
          unset($connection);
        }else {
          header("Location: ../usuario/index.php");
        }
        ?>
        <footer class="container-fluid text-center">
          <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
        </footer>
  </body>
</html>
