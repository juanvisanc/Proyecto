<!DOCTYPE html>
<html>

<head>
  <?php include 'cabecera.php' ?>
    <link rel="stylesheet" type="text/css" href="./css/registro.css">
</head>
<style media="screen">
  img{
    width: 4%;
  }
</style>

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
    include 'include.php';

    $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
    //$conection->set_charset("utf8");
    mysqli_set_charset($connection, "utf8");

    if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $mysqli->connect_error);
      exit();
    }


  ?>

  <div class="row">
    <div class="col-md-12">
      <h3 class="colabora">Clasificación</h3>
      <hr>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-8">

      <table class="table table-hover text-center">
        <thead>
          <tr>
            <th class="text-center">Posición</th>
            <th class="text-center">Equipo</th>
            <th class="text-center">P. Ganados</th>
            <th class="text-center">P. Empatados</th>
            <th class="text-center">P. Perdidos</th>
            <th class="text-center">Puntos</th>
          </tr>
        </thead>


      <?php
      $consulta="SELECT equipo, e.nombre, SUM(G) as Ganados, SUM(E) as Empatados, SUM(P) as Perdidos,
      SUM(puntos) as puntos
        FROM
        (
        -- PARA CUANDO EL EQUIPO ES LOCAL
        SELECT
          idEquipoL Equipo,
          IF(golesL > golesV,1,0) G,
          IF(golesL = golesV,1,0) E,
          IF(golesL < golesV,1,0) P,
          golesL GL,
          golesV GV,
          CASE
              WHEN golesL > golesV THEN 3
              WHEN golesL = golesV THEN 1
              ELSE 0
          END puntos
        FROM PARTIDO

        UNION ALL
        -- PARA CUANDO EL EQUIPO ES VISITANTE
        SELECT
          idEquipoV,
          IF(golesL < golesV,1,0),
          IF(golesL = golesV,1,0),
          IF(golesL > golesV,1,0),
          golesL,
          golesV,
          CASE
              WHEN golesL < golesV THEN 3
              WHEN golesL = golesV THEN 1
              ELSE 0
          END puntos
        FROM PARTIDO) as totales
        JOIN EQUIPO e ON totales.equipo = e.idEquipo
        group by equipo order by puntos desc;";

        $result = $connection->query($consulta);
        $cont=1;

        while($obj = $result->fetch_object()) {
          echo "<tr><td>$cont</td>";
          echo "<td><img src='../imagenes/$obj->equipo.png'> $obj->nombre</td>";
          echo "<td>$obj->Ganados</td>";
          echo "<td>$obj->Empatados</td>";
          echo "<td>$obj->Perdidos</td>";
          echo "<td>$obj->puntos</td></tr>";
          $cont=$cont+1;
        }
        ?>
     </table>
    </div>
  </div>


      <footer class="container-fluid text-center">
        <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
      </footer>
</body>

</html>
