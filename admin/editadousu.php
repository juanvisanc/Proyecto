
    <?php
        session_start();


        //solo si eres admin y se han pasado por post
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
            $nombre=$_POST['nombre'];
            $apellidos=$_POST['apellidos'];
            $correo=$_POST['email'];
            $nombreUsu=$_POST['nombreUsu'];
            $rol=$_POST['rol'];
            $equipo=$_POST['equipo'];


            //Hay que averiguar si se ha cambiado de rol para borrar, insertar o actualizar
            if ($rol==='admin' or $rol==='entrenador') {
              $result = $connection->query("SELECT * FROM Colabora WHERE idEntrenador=$id;");
              if ($result->num_rows===1) {
                $result = $connection->query("DELETE FROM Colabora WHERE idEntrenador=$id;");
                $result = $connection->query("INSERT INTO Entrena VALUES ($id,$equipo);");
              }else {
                $result = $connection->query("UPDATE Entrena SET idEquipo=$equipo where idEntrenador=$id;");
              }

            }else {
              $result = $connection->query("SELECT * FROM Entrena WHERE idEntrenador=$id;");
              if ($result->num_rows===1) {
                $result = $connection->query("DELETE FROM Entrena WHERE idEntrenador=$id;");
                $result = $connection->query("INSERT INTO Colabora VALUES ($id,$equipo);");
              }else {
                $result = $connection->query("UPDATE Colabora SET idEquipo=$equipo where idEntrenador=$id;");
              }

            }

            $result = $connection->query("UPDATE ENTRENADOR SET
              nombre='$nombre',apellidos='$apellidos',correo='$correo', nombreUsu='$nombreUsu', rol='$rol'
              WHERE idEntrenador=$id;");

              header("Location: usuarios.php");


          }else {
            header("Location: ../usuario/index.php");
          }

        }else {
          header("Location: ../usuario/index.php");
        }
        ?>
