<?php

//iniciamos sesion
session_start();

if (isset($_SESSION['usuario'])) {
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
            <li><a href='#'>Clasificación</a></li>
            <li><a href='#'>Calendario</a></li>
            <li><a href='../usuario/contacto.php'>Contacto</a></li>
          </ul>
          <ul class='nav navbar-nav navbar-right'>
            <li><a href='#'><span class='glyphicon glyphicon-user' style='padding-right:5px'>
            </span>".$_SESSION['usuario']."</a></li>
            <li><a href='../usuario/logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>
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
      }else{
        header("Location: ../usuario/index.php");
      }

  ?>
