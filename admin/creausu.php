<!DOCTYPE html>
<html>
<head>
  <?php include '../colaborador/cabecera.php'; ?>
    <link rel="stylesheet" type="text/css" href="../admin/css/usuarios.css">
</head>
<style media="screen">
  #error{
    font-size: 0.8em;
    margin-bottom: 0.4em;
  }
</style>
<!--script para mostrar equipos segun sea entrenador o colaborador-->
<script>
$(document).ready(function(){
	$("#admin").click(function(){
		$('#entrena').show();
    $('#dos').attr("disabled", false)
    $('#colabora').hide();
    $('#uno').attr("disabled", true);
		});

  $("#entre").click(function(){
    $('#entrena').show();
    $('#dos').attr("disabled", false)
    $('#colabora').hide();
    $('#uno').attr("disabled", true);
		});

  $("#cola").click(function(){
    $('#entrena').hide();
    $('#dos').attr("disabled", true)
    $('#colabora').show();
    $('#uno').attr("disabled", false);
		});

    $('#user').change(function(){
      var usuario=$(this).val();
      $.ajax({
        url: '../admin/comprueba_usuario.php',
        type: 'POST',
        data: {usuario: usuario}
      })
      .done(function(data) {
        if (data==1) {
          $('#validar').removeClass('has-error').addClass('has-success');
          $('#submit').attr('disabled', false);
          $('#error').text("Usuario válido");
        }else {
          $('#submit').attr('disabled', true);
          $('#validar').removeClass('has-success').addClass('has-error');
          $('#error').text("Usuario no válido");
        };
      });
    });
 	});

</script>
  <body>
    <?php

    include '../colaborador/include.php';
    if (isset($_SESSION["usuario"]) and $_SESSION['rol']==='admin' ) {
      $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
      //$conection->set_charset("utf8");
      mysqli_set_charset($connection, "utf8");

      if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $mysqli->connect_error);
        exit();
      }

      ?>
      <div class="row">
        <div class="col-sm-12 text-center">
          <h3>Crear usuario</h3>
          <hr>
        </div>
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
          <form id="registerForm" method="POST" action="creadousu.php">
            <div class="form-group">
              <div class="col-xs-6">
                <label for="InputName">Nombre</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nombre"
                  placeholder="Nombre" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
                <br>
                <label for="InputName">Apellidos</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="apellidos"
                  placeholder="Apellidos" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                </div>
                <hr>
              </div>
            </div>

            <div class="form-group">
              <div class="col-xs-6">
                <label for="InputName">Nombre de usuario</label>
                <div class="input-group" id='validar'>
                  <input type="text" class="form-control" name="nombreUsu" id='user'
                  placeholder="Usuario" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
                <div id='error'>Usuario</div>
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
                <label for="InputStreetName">Rol</label>
                <div class="input-group">
                  <div class="form-inline required">
                    <div class="form-group has-feedback">
                      <label class="input-group">
                        <span class="input-group-addon">
                    <input type="radio" name="rol" value="admin"  required/>
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
                    <input type="radio" name="rol" value="entrenador"
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
                                <input type="radio" name="rol" value="colaborador"
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
              $result2 = $connection->query("SELECT * FROM EQUIPO
                WHERE idEquipo NOT IN (SELECT idEquipo FROM Colabora);");
          ?>

                  <div class="input-group">
                    <select name="equipo" class="form-control" id='uno' required>
                      <?php
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
              $result3 = $connection->query("SELECT * FROM EQUIPO
                WHERE idEquipo NOT IN (SELECT idEquipo FROM Entrena);");
          ?>

                  <div class="input-group">
                    <select name="equipo" class="form-control" id='dos' required>
                      <?php
                while($obj3 = $result3->fetch_object()) {
                    echo"<option value='$obj3->idEquipo'>$obj3->nombre</option>";
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
          <?php

          unset($obj);
          $result2->close();
          unset($obj2);
          $result3->close();
          unset($obj3);
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
