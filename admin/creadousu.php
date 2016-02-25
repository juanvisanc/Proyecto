<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
        session_start();

        if (isset($_POST['nombre']) and isset($_SESSION["usuario"])) {
          if($_SESSION['rol']==='admin'){
            $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
            //$conection->set_charset("utf8");
            mysqli_set_charset($connection, "utf8");

            if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $mysqli->connect_error);
              exit();
            }

            $nombre=$_POST['nombre'];
            $apellidos=$_POST['apellidos'];
            $pass=$_POST['password'];
            $correo=$_POST['email'];
            $nombreUsu=$_POST['nombreUsu'];
            $rol=$_POST['rol'];
            $equipo=$_POST['equipo'];

            //hay que insertar en dos tablas, entrenador y entrena o colabora

            $connection->query("INSERT INTO ENTRENADOR VALUES
                  (NULL,'$nombre','$apellidos','$correo','$nombreUsu',md5('$pass'),'$rol');");
                  $result3=$connection->query("SELECT idEntrenador FROM ENTRENADOR WHERE nombreUsu='$nombreUsu';" );
                  $obj3=$result3->fetch_object();
              if ($rol==='admin' or $rol==='entrenador') {
                $connection->query("INSERT INTO Entrena VALUES ($obj3->idEntrenador,$equipo);");
                $result3->close();
                unset($obj3);
              }else {
                $connection->query("INSERT INTO Colabora VALUES ($obj3->idEntrenador,$equipo);");
                $result3->close();
                unset($obj3);
              }
              header("Location: ../admin/usuarios.php");
        }else {
          header("Location: ../usuario/index.php");
        }
      }else {
          header("Location: ../usuario/index.php");
      }
        ?>
    </body>
  </html>
