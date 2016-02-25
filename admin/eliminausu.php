<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      session_start();

      //si usuario es admin y se ha pasado el id de entrenador que vamos a eliminar
      if (isset($_GET['id']) and isset($_SESSION['usuario']) and $_SESSION['rol']==='admin') {
        $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
        //$conection->set_charset("utf8");
        mysqli_set_charset($connection, "utf8");

        if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
        }

        $result = $connection->query("DELETE FROM ENTRENADOR WHERE idEntrenador=$_GET[id];");
        header("Location: usuarios.php");
      }else {
        header("Location: ../usuario/index.php");
      }
    ?>
  </body>
</html>
