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
          <label for="InputName">Apellidos</label>
          <div class="input-group">
            <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required>
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
          </div>
          <hr>
        </div>
      </div>

      <div class="form-group">
        <div class="col-xs-6">
          <label for="InputName">Nombre de usuario</label>
          <div class="input-group">
            <input type="text" class="form-control" name="nombreUsu" placeholder="Usuario" required>
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
                  <span class="glyphicon form-control-feedback"></span>
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
