<?php
require_once('ui/gui.php');
$ui = new gui();

$ui->check_access("changes.php");
$ui->action_controller();
$ui->get_header();
?>

<body id="login">

  <div class="row mt-4">
    <div class="col-2 col-sm-2 col-md-4 col-lg-4"></div>
    <div class="col-8 col-sm-8 col-md-4 col-lg-4">
      <div class="card shadow">
        <div class="card-header">
         Cambiar Contraseña
        </div>
        <div class="card-body cuadro">
          <form method="post" id="form_login" action="security.php?action=changes_password" onkeyup="escritura()">
          <?php if (isset($_GET['msg'])) { ?>
              <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> Datos Incorrectos
                .
              </div>
            <?php } ?>
            <input type="hidden" name="cedula" value="<?=$_GET['user']?>">
            <div class="form-group">
              <label>Contraseña</label>
              <input type="password" class="form-control" name="seguridad" required>
            </div>
            <div class="form-group">
              <label>Nueva</label>
              <input type="password" class="form-control" name="nueva" required>
            </div>
          
           
            <hr>
            <button type="submit" class="btn btn-success">Enviar</button>
            <a href='index.php'class="btn btn-primary">Iniciar Seccion</a>
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
          <form action="index.php?action=changes" method="post">
        <div class="form-group">
            <label>CEDULA DE IDENTIDAD</label>
            <input class="form-control" placeholder="Ingrese numero de cedula" type="text" name="cedula">
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