<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      session_start();

      if (isset($_POST['equipo']) and isset($_SESSION["usuario"])){

        $equipo=$_POST['equipo'];
        $equipoUsu=$_SESSION['equipo'];

        if ($equipo===$equipoUsu or $_SESSION['rol']==='admin'){
          $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
          //$conection->set_charset("utf8");
          mysqli_set_charset($connection, "utf8");

          if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $mysqli->connect_error);
            exit();
          }

          $nombre=$_POST['nombre'];
          $apellidos=$_POST['apellidos'];
          $alias=$_POST['alias'];
          $peso=$_POST['peso'];
          $altura=$_POST['altura'];
          $posicion=$_POST['posicion'];
          $numero=$_POST['numero'];
          $edad=$_POST['edad'];

          $result = $connection->query("INSERT INTO JUGADOR VALUES (null,'$nombre','$apellidos','$alias',
            '$posicion',$altura,$peso,$numero,$edad,$equipo);");

          header("Location: ../usuario/equipo.php?id=$equipo");
        }else {
          header("Location: ../usuario/index.php");
        }
      }else {
        header("Location: ../usuario/index.php");
      }
    ?>
  </body>
</html>
