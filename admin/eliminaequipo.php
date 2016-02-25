<?php
  session_start();


  //si se ha pasado el id del equipo que se va a eliminar y si es admin
  if (isset($_GET['id']) and isset($_SESSION['usuario']) and $_SESSION['rol']==='admin') {
    $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
    //$conection->set_charset("utf8");
    mysqli_set_charset($connection, "utf8");

    if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $mysqli->connect_error);
      exit();
    }

    $result = $connection->query("DELETE FROM EQUIPO WHERE idEquipo=$_GET[id];");
    header("Location: equipos.php");
  }else {
    header("Location: ../usuario/index.php");
  }
?>
