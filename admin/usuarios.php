<!DOCTYPE html>
<html>
<head>
  <?php include '../colaborador/cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="../admin/css/usuarios.css">
</head>
  <body>
    <?php
        include '../colaborador/include.php';


        //solo puede acceder el admin
        if (isset($_SESSION['usuario']) and $_SESSION['rol']==='admin') {

            $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
            //$conection->set_charset("utf8");
            mysqli_set_charset($connection, "utf8");

            if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $mysqli->connect_error);
              exit();
            }

      ?>
      <div class="row">
        <div class="col-sm-12">
          <h3 class="colabora">Usuarios registrados</h3>
          <hr>
        </div>
          <div class="col-sm-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Equipo</th>
                <th class="text-center">Editar</th>
                <th class="text-center">Eliminar<th>
              </tr>
            </thead>

            <?php
                if($result = $connection->query("SELECT * FROM ENTRENADOR;")){
                  while($obj = $result->fetch_object()) {

                    echo "<tr>";
                    echo "<td>".$obj->nombre."</td>";
                    echo "<td>".$obj->apellidos."</td>";
                    echo "<td>".$obj->nombreUsu."</td>";
                    echo "<td>".$obj->correo."</td>";
                    echo "<td>".$obj->rol."</td>";

                    if ($obj->rol==='entrenador' or $obj->rol==='admin') {
                      $result2 = $connection->query("SELECT e.nombre FROM Entrena en,EQUIPO e
                         where en.idEquipo=e.idEquipo and en.idEntrenador=$obj->idEntrenador;");
                      $obj2=$result2->fetch_object();
                      echo "<td>".$obj2->nombre."</td>";
                    }else{
                      $result3 = $connection->query("SELECT e.nombre FROM Colabora c ,EQUIPO e
                         where c.idEquipo=e.idEquipo and c.idEntrenador=$obj->idEntrenador;");
                      $obj3=$result3->fetch_object();
                      echo "<td>".$obj3->nombre."</td>";

                    }
                    echo "<td class='text-center'><a href='../admin/editausu.php?id=$obj->idEntrenador'>
                    <span class='glyphicon glyphicon-edit'/></a></td>";
                    echo "<td class='text-center'><a href='../admin/eliminausu.php?id=$obj->idEntrenador'>
                    <span class='glyphicon glyphicon-trash'/></a></td></tr>";
                }
                echo "<tr>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<th class='text-center'>Añadir</th>";
                echo "<td class='text-center'><a href='creausu.php'>
                <span class='glyphicon glyphicon-plus'/></a></td></tr>";
                echo "</table>";

              }
             ?>

      <?php  }else{
          header("Location: ../usuario/index.php");
        }
    ?>
  </div>
</div>
    <footer class="container-fluid text-center">
      <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
    </footer>
  </body>
</html>
