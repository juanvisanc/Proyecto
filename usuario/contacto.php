<!DOCTYPE html>
<html>
<head>
  <?php include 'cabecera.php'; ?>
    <link rel="stylesheet" type="text/css" href="../usuario/css/contacto.css">
</head>
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
  <body>
    <?php
        include 'include.php';

        $connection = new mysqli("localhost", "usufutbol", "usufutbol", "futbol2");
        //$conection->set_charset("utf8");
        mysqli_set_charset($connection, "utf8");

        if($result = $connection->query("SELECT correo FROM ENTRENADOR WHERE rol='admin' limit 1;")){
          $obj=$result->fetch_object();
        ?>

        <div class="row">
          <div class="col-sm-12">
            <h3 class="colabora">Contacta con nosotros<h3>
            <hr>
          </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
            <p class="lead">Si tienes alguna duda, sugerencia, proposición o simplemente quieres
              mostrar tu opinión, no dudes en mandar un correo a nuestro administrador.<p>
            <?php echo "<p class='lead'><span class='glyphicon glyphicon-envelope'></span>
            Correo electrónico: $obj->correo<p>"; ?>
          </div>
      </div>

     <?php } ?>
     <footer class="container-fluid text-center">
       <p>Esta página está basada en la colaboración voluntaria, por lo que no se hace responsable de la veracidad de los contenidos publicados.</p>
     </footer>
  </body>
</html>
