<!DOCTYPE html>
<html>

<head>
  <?php include 'cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="css/registro.css">
</head>
<style media="screen">
  #error{
    font-size: 0.8em;
    margin-bottom: 0.4em;
  }
</style>

<!--script para el dialog y para mostrar los equipos dependiendo del rol
Tambien para comprobar si el nombre de usuario es válido-->
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

      $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
      //$conection->set_charset("utf8");
      mysqli_set_charset($connection, "utf8");

      if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $mysqli->connect_error);
        exit();
      }
      ?>
      <!--Si no se han madado los datos del formulario lo mostramos-->
      <?php if (!isset($_POST['nombre'])): ?>
        <?php include 'include.php';
      if (isset($_SESSION["usuario"])) {
        header('Location: index.php');
      }
      ?>
        <div class="row">
          <div class="col-md-12">
            <h3 class="colabora">Colabora con nosotros</h3>
            <hr>
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
                  <label for="InputName">Apellidos</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                  </div>
                  <hr>
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-6">
                  <label for="InputName">Nombre de usuario</label>
                  <div class="input-group" id='validar'>
                    <input type="text" id='user' class="form-control" name="nombreUsu" placeholder="Usuario" required>
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
                          <div class="form-control form-control-static" id='entre'>
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
        <footer class="container-fluid text-center">
          <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
        </footer>

        <!--si se han mandado los datos del formulario-->
        <?php else: ?>
          <?php
              $nombre=$_POST['nombre'];
              $apellidos=$_POST['apellidos'];
              $usuario=$_POST['nombreUsu'];
              $pass=$_POST['password'];
              $email=$_POST['email'];
              $entrenador=$_POST['entrenador'];
              $equipo=$_POST['equipo'];

              //si es entrenador
                if ($entrenador=='entrenador') {

                  //insertamos en las tabla entrenador y entrena
                    $connection->query("INSERT INTO ENTRENADOR VALUES
                      (NULL,'$nombre','$apellidos','$email','$usuario',md5('$pass'),'$entrenador');");
                    $result3=$connection->query("SELECT idEntrenador FROM ENTRENADOR WHERE nombreUsu='$usuario';" );
                    $obj3=$result3->fetch_object();
                    $connection->query("INSERT INTO Entrena VALUES ($obj3->idEntrenador,$equipo);");
                    $result3->close();
                    unset($obj3);

                    //iniciamos la sesion
                    session_start();

                    //metemos en sesion las variables
                    $_SESSION["rol"]=$entrenador;
                    $_SESSION["usuario"]=$usuario;
                    $_SESSION["language"]="es";
                    $_SESSION["equipo"]=$equipo;

                    //con la sesion iniciada vamos al inicio
                    header('Location: index.php');

                    //en caso de que sea colaborador igual que con entrenador
                  }else {
                  $result2 = $connection->query("SELECT c.idEquipo FROM Colabora c
                    WHERE c.idEquipo=$equipo;");
                    $obj2=$result2->fetch_object();
                    $connection->query("INSERT INTO ENTRENADOR VALUES
                    (NULL,'$nombre','$apellidos','$email','$usuario',md5('$pass'),'$entrenador');");
                    $result2->close();
                    unset($obj2);
                    $result4=$connection->query("SELECT idEntrenador FROM ENTRENADOR WHERE nombreUsu='$usuario';" );
                    $obj4=$result4->fetch_object();
                    $connection->query("INSERT INTO Colabora VALUES ($obj4->idEntrenador,$equipo);");
                    $result4->close();
                    unset($obj4);
                    session_start();
                    $_SESSION["rol"]=$entrenador;
                    $_SESSION["usuario"]=$usuario;
                    $_SESSION["language"]="es";
                    $_SESSION["equipo"]=$equipo;

                    header('Location: index.php');
                  }

          ?>
      <?php endif ?>
</body>

</html>
