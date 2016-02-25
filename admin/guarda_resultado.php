<?php
    session_start();

    //Si se pasa id de partido y usuario es admin
    if (isset($_POST['id']) and isset($_SESSION["usuario"])) {
      if($_SESSION['rol']==='admin'){
        $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
        //$conection->set_charset("utf8");
        mysqli_set_charset($connection, "utf8");

        if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
        }

        $id=$_POST['id'];
        $jornada=$_POST['jornada'];
        $golesL=$_POST['golesL'];
        $golesV=$_POST['golesV'];

        $result = $connection->query("UPDATE PARTIDO SET golesL=$golesL,golesV=$golesV WHERE idPartido=$id;");


        unset($connection);

          header("Location: ../usuario/calendario.php?id=$jornada");


      }else {
        header("Location: ../usuario/index.php");
      }

    }else {
      header("Location: ../usuario/index.php");
    }
    ?>
