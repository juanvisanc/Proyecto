<?php

  //iniciamos sesion
    session_start();

    //si introducimos datos en el login
    if (isset($_POST["usuario"])) {
      $usuario=$_POST['usuario'];
      $pass=$_POST['password'];
      //CREATING THE CONNECTION
      $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      //MAKING A SELECT QUERY
      //Consulta con el usuario y contraseña que hemos pasado
      $consulta="select * from ENTRENADOR where
      nombreUsu='$usuario' and password=md5('$pass');";

      //Comprovamos el logueo
      if ($result = $connection->query($consulta)) {
          $obj = $result->fetch_object();

          //No nos hemos logueado bien
          if ($result->num_rows===0) {

            //salta el dialog modal
            echo "<div id='dialog-message' title='Error.'>
              <p>
                El nombre de usuario o contraseña que has introducido es incorrecto.
              </p>
              </div>";
          } else {

            //en caso de loguearnos bien iniciamos sesion
            $_SESSION["rol"]=$obj->rol;
            $_SESSION["usuario"]=$_POST["usuario"];
            $_SESSION["language"]="es";

            //Vemos si usuario es entrenador o colaborador y metemos su equipo en la sesion
            if ($_SESSION["rol"]==='colaborador') {
              $result2 = $connection->query("SELECT idEquipo from Colabora where idEntrenador=$obj->idEntrenador;");
              $obj2=$result2->fetch_object();
              $_SESSION["equipo"]=$obj2->idEquipo;

            }elseif ($_SESSION["rol"]==='entrenador') {
              $result3 = $connection->query("SELECT idEquipo from Entrena where idEntrenador=$obj->idEntrenador;");
              $obj3=$result3->fetch_object();
              $_SESSION["equipo"]=$obj3->idEquipo;
            }

            //Una vez bien logueados, nos manda al index.
            header("Location: index.php");
          }

      } else {
        echo "Wrong Query";
      }
  }
  //Si la sesion esta abierta:
    if (isset($_SESSION["usuario"])) {
      echo "  <nav class='navbar navbar-inverse'>
          <div class='container-fluid'>
            <div class='navbar-header'>
              <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
              </button>
            </div>
            <div class='collapse navbar-collapse' id='myNavbar'>
              <ul class='nav navbar-nav'>
                <li><a href='index.php'>Inicio</a></li>
                <li><a href='#'>Clasificación</a></li>
                <li><a href='#'>Calendario</a></li>
              </ul>
              <ul class='nav navbar-nav navbar-right'>
                <li><a href='#'><span class='glyphicon glyphicon-user' style='padding-right:5px'></span>".$_SESSION['usuario']."</a></li>
                <li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>";
    }else {

      //si la sesion no esta abierta:
      echo "<nav class='navbar navbar-inverse'>
          <div class='container-fluid'>
            <div class='navbar-header'>
              <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
              </button>
            </div>
            <div class='collapse navbar-collapse' id='myNavbar'>
              <ul class='nav navbar-nav'>
                <li><a href='index.php'>Inicio</a></li>
                <li><a href='#'>Clasificación</a></li>
                <li><a href='#'>Calendario</a></li>
                <li><a href='registro.php'>Registro</a></li>
              </ul>
              <form class='navbar-form navbar-right' role='search' action='' method='post'>
                      <div class='form-group'>
                          <input type='text' class='form-control' name='usuario' placeholder='Usuario'>
                      </div>
                      <div class='form-group'>
                          <input type='password' class='form-control' name='password' placeholder='Contraseña'>
                      </div>
                      <button type='submit' class='btn btn-default'>Login</button>
                  </form>
            </div>
          </div>
        </nav>";

    }
    ?>
  <div class="jumbotron">
    <div class="container text-center">
      <h1>Fútbol-7</h1>
      <h4>Liga Provincial Sevillana</h4>
    </div>
  </div>
