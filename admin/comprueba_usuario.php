
    <?php

    //para llamada ajax
    if (isset($_POST['usuario'])) {
      $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
      //$conection->set_charset("utf8");
      mysqli_set_charset($connection, "utf8");

      if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $mysqli->connect_error);
        exit();
      }
      $usuario=$_POST['usuario'];
      $result = $connection->query("SELECT nombreUsu FROM ENTRENADOR WHERE nombreUsu='$usuario';");
      if ($result->num_rows===0) {
        echo 1;
      }else {
        echo 0;
      }
    }else {
      header("Location: ../usuario/index.php");
    }


     ?>
