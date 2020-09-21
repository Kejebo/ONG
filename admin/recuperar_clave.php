<?php
require_once('ui/gui.php');
$ui = new gui();

$ui->check_access("index.php");
$ui->action_controller();
$ui->get_header();
?>

<body id="login">

  <div class="row mt-5">
    <div class="col-2 col-sm-2 col-md-4 col-lg-4"></div>
    <div class="col-8 col-sm-8 col-md-4 col-lg-4">
      <div class="card shadow">
        <div class="card-header">
          <img src="" alt=""> Iniciar Seccion
        </div>
        <div class="card-body cuadro">
          <form method="post" action="security.php?action=changes" onkeyup="escritura()">
          <?php if (isset($_GET['msg'])) { ?>
              <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> Datos Incorrectos
                .
              </div>
            <?php } ?>

            <div class="form-group">
              <label>CEDULA IDENTIDAD</label>
              <input type="text" class="form-control" name="cedula" title="Ingrese el numero de Cedula" required>
            <hr>
            <button type="submit" class="btn btn-block btn-success">Ingresar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-2 col-sm-2 col-md-4 col-lg-4"></div>
  <div id="contra" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-orange text-white">
        <h5 class="modal-title" id="exampleModalLongTitle">Recibir Contraseña</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-content">
        <div class="modal-body">
          <form id='form-codigo'>
        <div class="form-group">
            <label>CEDULA DE IDENTIDAD</label>
            <input class="form-control" placeholder="Ingrese numero de cedula" type="text" id="cedula" name="cedula">
          </div>
          <button type="submit" class="btn btn-success btn-block" >Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<?php
$ui->get_scripts();

?>