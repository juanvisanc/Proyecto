<!DOCTYPE html>
<html>

<head>
  <?php include 'cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="./css/equipo.css">
</head>

<body>

  <!-- script dialog. Se pondra en include?? -->
  <script>
    $(function() {
      $("#dialog-message").dialog({
        modal: true,
        buttons: {
          Ok: function() {
            $(this).dialog("close");
          }
        },
        open: function(event, ui) {
          setTimeout("$('#dialog-message').dialog('close')", 5000);
        }
      });
    });
  </script>

  <?php
    //Para entrar en esta página hay que mandar id del equipo, si no para atras.
    if (!isset($_GET['id'])) {
      header('Location: index.php');
    }
     ?>
    <?php include 'include.php' ?>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <?php
        $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
        //$conection->set_charset("utf8");
        mysqli_set_charset($connection, "utf8");

        $id=$_GET['id'];

        if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
        }
        //Para poner en el titulo nombre del equipo
        if ($result = $connection->query("SELECT nombre FROM EQUIPO WHERE idEquipo=$id;")){
          $obj = $result->fetch_object();

          echo "<h1 class='plantilla'><img src='../imagenes/$id.png'>Plantilla del $obj->nombre</h1>";

          //Sacamos datos del entrenador.
          $result = $connection->query("SELECT en.nombre, en.apellidos FROM Entrena ent,
            ENTRENADOR en WHERE ent.idEntrenador=en.idEntrenador and ent.idEquipo=$id;");
          $filas=$result->num_rows;
          $obj=$result->fetch_object();

          //Si no hay datos significa que aun no hay entrenador registrado.
          if ($filas===0) {
            echo "<h4 class='plantilla'>Nombre del entrenador: No tenemos datos aún</h4>";
          }else {
            echo "<h4 class='plantilla'>Nombre del entrenador: $obj->nombre $obj->apellidos</h4>";
          }

        ?>
            <table class="table table-hover text-center">
              <thead>
                <tr>
                  <th>Apellidos</th>
                  <th>Nombre</th>
                  <th>Alias</th>
                  <th>Ficha</th>

                  <!-- En caso q este logueado y sea administrador o de ese equipo pueda editar -->
                  <?php if (isset($_SESSION["usuario"])){
                    if ($_SESSION["rol"]==='admin' or $_SESSION["equipo"]===$id) {
                    ?>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <?php
                  }
                }
              ?>
                </tr>
              </thead>

              <?php

              //Sacamos lo que nos interesa de los jugadores
              $result2 = $connection->query("select j.nombre,j.apellidos,j.alias,j.idJugador from
               JUGADOR j,EQUIPO e WHERE j.idEquipo=e.idEquipo and e.idEquipo=$id;");

              while($obj2 = $result2->fetch_object()) {

                  echo "<tr>";
                  echo "<td>".$obj2->apellidos."</td>";
                  echo "<td>".$obj2->nombre."</td>";
                  echo "<td>".$obj2->alias."</td>";
                  echo "<td><a href='jugador.php?id=$obj2->idJugador'>
                  <span class='glyphicon glyphicon-eye-open'/></a></td>";

                  //En caso q este logueado y sea administrador o de ese equipo pueda editar
                  if (isset($_SESSION["usuario"])){
                    if ($_SESSION["rol"]==='admin' or $_SESSION["equipo"]===$id) {
                    echo "<td><a href='../colaborador/edita.php?id=$obj2->idJugador&equipo=$id'>
                    <span class='glyphicon glyphicon-edit'/></a></td>";
                    echo "<td><a href='../colaborador/elimina.php?id=$obj2->idJugador&equipo=$id'>
                    <span class='glyphicon glyphicon-trash'/></a></td></tr>";

                  }else {
                    echo "</tr>";
                  }
                }
              }

              if (isset($_SESSION["usuario"])){
                if ($_SESSION["rol"]==='admin' or $_SESSION["equipo"]===$id) {
                  echo "<tr>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<th>Añadir</th>";
                  echo "<td><a href='../colaborador/crea.php?id=$id'>
                  <span class='glyphicon glyphicon-plus'/></a></td></tr>";
                }
              }
              echo "</table>";

              $result->close();
              unset($obj);
              $result2->close();
              unset($obj2);
              unset($connection);


            }

        ?>
        </div>
      </div>
      <footer class="container-fluid text-center">
        <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
      </footer>
</body>

</html>
