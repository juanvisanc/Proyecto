<!DOCTYPE html>
<html lang="en">
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
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Inicio</a></li>
        <li><a href="#">Clasificación</a></li>
        <li><a href="#">Calendario</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Fútbol-7</h1>
    <h4>Liga Provincial Sevillana</h4>
  </div>
</div>
<?php

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
