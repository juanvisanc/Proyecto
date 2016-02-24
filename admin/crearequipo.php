<?php

session_start();

  if (isset($_POST['nombre']) and isset($_SESSION["usuario"])) {
  if($_SESSION['rol']==='admin'){
  $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
  //$conection­>set_charset("utf8");
  mysqli_set_charset($connection, "utf8");
  if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $mysqli­->connect_error);
    exit();
  }
  $nombre=$_POST['nombre'];
  $localidad=$_POST['localidad'];
  //$imagen=$_POST['imagen'];
  $result= $connection->query("SELECT idEquipo FROM EQUIPO order by idEquipo desc limit 1;");
  //var_dump($imagen);

  $obj=$result->fetch_object();
  $idE = $obj->idEquipo + 1;


if ($_FILES["imagen"]["error"] > 0){
  echo "ha ocurrido un error";
} else {
          //ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
          //y que el tamano del archivo no exceda los 100kb
          $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
          $limite_kb = 1000;

          if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
            //esta es la ruta donde copiaremos la imagen
            //recuerden que deben crear un directorio con este mismo nombre
            //en el mismo lugar donde se encuentra el archivo subir.php
            $ruta = "../imagenes/" . $idE.".png";
            var_dump($ruta);

              $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

              if ($resultado){
                $result = $connection->query("INSERT INTO EQUIPO VALUES($idE,'$nombre','$localidad');");
                header('Location: ../admin/equipos.php');
              } else {
                echo "ocurrio un error al mover el archivo.";
              }
          } else {
            echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
          }
  }
}else{
  header('Location: ../usuario/index.php');
}
}else {
  header('Location: ../usuario/index.php');
}
?>
