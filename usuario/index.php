<!DOCTYPE html>
<html>
<head>
  <title>Fútbol-7 Sevilla</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
