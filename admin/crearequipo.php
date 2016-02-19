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
            //comprovamos si este archivo existe para no volverlo a copiar.
            //pero si quieren pueden obviar esto si no es necesario.
            //o pueden darle otro nombre para que no sobreescriba el actual.
            if (!file_exists($ruta)){
              //aqui movemos el archivo desde la ruta temporal a nuestra ruta
              //usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
              //almacenara true o false
              $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

              if ($resultado){
                $result = $connection->query("INSERT INTO EQUIPO VALUES($idE,'$nombre','$localidad');");
                header('Location: ../admin/equipos.php');
              } else {
                echo "ocurrio un error al mover el archivo.";
              }
            } else {
              echo $_FILES['imagen']['name'] . ", este archivo existe";
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
