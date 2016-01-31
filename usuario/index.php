<!DOCTYPE html>
<html>
<head>
  <?php include 'cabecera.php' ?>
  <link rel="stylesheet" type="text/css" href="./css/index.css">
</head>
<body>
  <?php

  include 'include.php';

  $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
  //$conection->set_charset("utf8");
  mysqli_set_charset($connection, "utf8");

    if($result = $connection->query("SELECT nombre, idEquipo FROM EQUIPO;")){
      echo"<div class='container text-center'><h3>Elige tu equipo</h3></div>
      <div class='central'>";

      while($obj = $result->fetch_object()) {
        echo"<div class='bloque'>
          <a href='equipo.php?id=$obj->idEquipo'>
          <h4>$obj->nombre</h4>
          <div>
          <img src='../imagenes/$obj->idEquipo.png' class='img-responsive' alt='Image'></a></div>
          </div>";
      }
        echo "</div>";
  ?>



  <?php
    $result->close();
    unset($obj);
    unset($connection);
  } ?>
<footer class="container-fluid text-center">
  <p>Esta página está basada en la colaboración voluntaria,
    por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
</footer>

</body>
</html>
