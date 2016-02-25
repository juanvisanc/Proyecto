<!DOCTYPE html>
<html>
<head>
  <?php include 'cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="../usuario/css/equipo.css">
</head>
  <body>
    <?php
      include 'include.php';

      //si hemos pasado id y ademas estamos logueados
      if (isset($_GET['id']) and isset($_SESSION["usuario"])){

        $equipo=$_GET['id'];

        //le hemos pasado el equipo del jugador para poder comprobar si es del usuario
        $equipoUsu=$_SESSION['equipo'];

        //si el equipo es del usuario o es admin
        if ($equipo===$equipoUsu or $_SESSION['rol']==='admin'){
          ?>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <?php
              echo "<h3 class='jugador'>
              <img src='../imagenes/$equipo.png'>Creación de jugador</h3>";
              ?>
                <form id="registerForm" method="POST" action="creado.php">
                  <input style='display:none' type='text' name='equipo' <?php echo "value='$equipo'" ?>>
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
                      <label for="InputName">Alias</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="alias"
                        placeholder="Alias" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                      </div>
                      <br>
                      <label for="InputCity">Posición</label>
                      <div class="input-group">
                        <select name="posicion" class="form-control" required>
                          <option checked='checked'>---Elige posición---</option>
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
                      <label for="InputEmail">Número</label>
                      <div class="input-group">
                        <input type="number" class="form-control" name="numero"
                        placeholder="Numero" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                      </div>
                    </div>
                    <div class="col-xs-3">
                      <label for="InputEmail">Edad</label>
                      <div class="input-group">
                        <input type="number" class="form-control" name="edad"
                        placeholder="Edad" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                      </div>
                    </div>
                    <div class="col-xs-3">
                      <label for="InputEmail">Altura</label>
                      <div class="input-group">
                        <input type="number" class="form-control" name="altura"
                        placeholder="Altura" step="0.01" min="0" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                      </div>
                    </div>
                    <div class="col-xs-3">
                      <label for="InputEmail">Peso</label>
                      <div class="input-group">
                        <input type="number" class="form-control" name="peso"
                        placeholder="Peso" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <div class="input-group-addon">
                      <input type="submit" name="enviar" id="submit" value="Crear" class="btn btn-success pull-right">
                    </div>
                  </div>
            </div>
          </div>
          </div>
          <br>
          </form>
          <?php
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
