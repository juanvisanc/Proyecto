<?php

//iniciamos sesion
session_start();

if (isset($_SESSION['usuario'])) {
  $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
  //$conection->set_charset("utf8");
  mysqli_set_charset($connection, "utf8");

  $usu=$_SESSION['usuario'];
  $result = $connection->query("SELECT idEntrenador from ENTRENADOR where nombreUsu='$usu';");
  $obj = $result->fetch_object();
  echo "  <nav class='navbar navbar-inverse'>
      <div class='container-fluid'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
        </div>
        <div class='collapse navbar-collapse' id='myNavbar'>
          <ul class='nav navbar-nav'>
            <li><a href='../usuario/index.php'>Inicio</a></li>
            <li><a href='../usuario/clasificacion.php'>Clasificación</a></li>
            <li><a href='../usuario/calendario.php?id=1'>Calendario</a></li>";
            if ($_SESSION['rol']==='admin') {
              echo "
              <li class='dropdown'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Administración <span class='glyphicon  glyphicon-menu-down'></span></a>
              <ul class='dropdown-menu'>
                <li><a href='../admin/usuarios.php'>Usuarios</a></li>
                <li><a href='../admin/equipos.php'>Equipos</a></li>
                <li><a href='../admin/partidos.php'>Partidos</a></li>
              </ul>
            </li>";
            }else {
              echo"<li><a href='../usuario/contacto.php'>Contacto</a></li>";
            }
          echo "</ul>
          <ul class='nav navbar-nav navbar-right'>
            <li><a href='../colaborador/usuario.php?id=$obj->idEntrenador'><span class='glyphicon glyphicon-user' style='padding-right:5px'>
            </span>".$_SESSION['usuario']."</a></li>
            <li><a href='../usuario/logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>";
?>
  <div class="jumbotron">
    <div class="container text-center">
      <h1>Fútbol-7</h1>
      <h4>Liga Provincial Sevillana</h4>
    </div>
  </div>
  <?php
  $result->close();
  unset($obj);
  unset($connection);
      }else{
        header("Location: ../usuario/index.php");
      }

  ?>
