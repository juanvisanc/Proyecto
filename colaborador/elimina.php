<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      session_start();

      //para eliminar tiene que haberse iniciado sesion y mandado jugador y equipo
      if (isset($_GET['id']) and isset($_GET['equipo']) and isset($_SESSION["usuario"])) {
        $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
        //$conection->set_charset("utf8");
        mysqli_set_charset($connection, "utf8");

        if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
        }

        //si es el admin se borra siempre
        if ($_SESSION["rol"]==='admin') {
          $result = $connection->query("DELETE FROM JUGADOR WHERE idJugador=$_GET[id];");
          header("Location: ../usuario/equipo.php?id=$_GET[equipo]");

        //si no es el admin se tiene que comprobar previamente que el jugador sea de su equipo
        }elseif($_SESSION["equipo"]==$_GET["equipo"]){
          $result = $connection->query("SELECT idJugador FROM JUGADOR WHERE
            idEquipo=$_SESSION[equipo] and idJugador=$_GET[id];");
            //si jugador del equipo del usuario:
          if ($result->num_rows===1) {
            $result = $connection->query("DELETE FROM JUGADOR WHERE idJugador=$_GET[id];");
            header("Location: ../usuario/equipo.php?id=$_GET[equipo]");

            //si jugador no es del equipo del usuario se manda atras
          }else{
            header("Location: ../usuario/index.php");
          }
        }

        //si no se ha iniciado sesion o no se ha pasado idequipo y jugador.
      }else{
        header("Location: ../usuario/index.php");
      }
    ?>
  </body>
</html>
