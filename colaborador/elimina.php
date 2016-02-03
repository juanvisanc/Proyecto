<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      session_start();
      if (!isset($_GET['id']) or !isset($_SESSION["usuario"])) {
        header('Location: ../usuario/index.php.php');
      }elseif($_SESSION["rol"]==='admin' or $_SESSION["equipo"]==$_GET["equipo"]){
        $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        $result = $connection->query("DELETE FROM JUGADOR WHERE idJugador=$_GET[id];");
          header("Location: ../usuario/equipo.php?id=$_GET[equipo]");
      }
    ?>
  </body>
</html>
