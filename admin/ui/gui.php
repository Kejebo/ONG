<?php
require_once('ln/ln_security.php');
require_once('ln/ln_usuario.php');

class gui extends ln_security
{


    function get_header()
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" type="image/png" sizes="16x16" href="assets/861Logo Dale Una Mano.png">
            <title>Dale una mano</title>

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <link href="assets/dist/css/style.min.css" rel="stylesheet">
            <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
            <link rel="stylesheet" href="assets/css/style.css">
        </head>

    <?php
    }

    function get_status()
    {
        return array(
            "activo" => "Activo",
            "inactivo" => "Inactivo",
            "prospecto" => "Prospecto"

        );
    }

    function get_ocupacion()
    {
        return array(
            "Asalariado con el Estado" => "Asalariado con el Estado",
            "Asalariado sector privado" => "Asalariado sector privado",
            "Trabajador independendiente" => "Trabajador independendiente",
            "Trabajador del sector informal" => "Trabajador del sector informal",
            "Propia empresa" => "Propia empresa",
            "Pensionado" => "Pensionado"
        );
    }
    function get_ocupacion_joven()
    {
        return array(
            "1" => "Estudia",
            "2" => "Trabaja",
            "3" => "No estudia",
            "4" => "No trabaja"
        );
    }

    function get_acceso()
    {
        return array(
            "habilitado" => "habilitado",
            "inhabilitado" => "inhabilitado"
        );
    }

    function get_Tipo()
    {
        return array(
            "Facilitador" => "Facilitador",
            "Junta Directiva" => "Junta Directiva",
            "Comite" => "Comite",
            "Desarrollador" => "Desarrollador",
            "Joven" => "Joven"

        );
    }

    function get_Estudios()
    {
        return array(
            "Primaria Completa" => "Primaria Completa",
            "Primaria Incompleta" => "Primaria Incompleta",
            "Secundaria Completa" => "Secundaria Completa",
            "Secundaria Incompleta" => "Secundaria Incompleta",
            "Parauniversitario" => "Parauniversitario",
            "Bachiller Universitario" => "Bachiller Universitario",
            "Bachiller Universitario Incompleto" => "Bachiller Universitario Incompleto",
            "Grado Superior" => "Grado Superior"
        );
    }
    function get_genero()
    {
        return array(
            "Hombre" => "Hombre",
            "Mujer" => "Mujer"
        );
    }

    function get_familiar()
    {
        return array(
            "Abuelo(a)" => "Abuelo(a)",
            "Madre" => "Madre",
            "Padre" => "Padre",
            "Primo(a)" => "Primo(a)",
            "Hemarno(a)" => "Hermano(a)",
            "Amigo(a)" => "Amigo(a)",
            "Pareja" => "Pareja",
            "Otros" => "Otros"
        );
    }

    function get_civil()
    {
        return array(
            "Casado(a)" => "Casado(a)",
            "Soltero(a)" => "Soltero(a)",
            "Union libre" => "Union libre"

        );
    }

    function get_barra()
    {
    ?>

        <body>
            <div class="preloader">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
            <div id="main-wrapper">
                <header class="topbar" data-navbarbg="skin5">
                    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                        <div class="navbar-header" data-logobg="skin5">
                            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                            <a class="navbar-brand" href="index.php">
                                <span class="logo-text text-center ml-5">
                                    <img src="assets/images/Logo Dale Una Mano.png" style="max-width: 70px" class="light-logo" />
                                </span> </a>


                            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                        </div>
                        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                            <ul class="navbar-nav float-left mr-auto">
                                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                            </ul>
                            <?php

                            ?>
                            <ul class="navbar-nav float-right">

                                <li class="nav-item dropdown">
                                    <?php $ln = new ln_usuario() ?>
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= $ln->db->get_usuario(json_decode($_COOKIE['ONG'], true)['id'])[0]['foto'] ?>" alt="user" class="rounded-circle" width="70"></a>
                                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                        <a class="dropdown-item" href="usuario.php?action=update_usuario&id=<?= json_decode($_COOKIE['ONG'], true)['id']; ?>"><i class="ti-user m-r-5 m-l-5"></i> Perfil</a>
                                        <a class="dropdown-item" href="security.php?action=logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Cerrar Seccion</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <?php
                switch (json_decode($_COOKIE['ONG'], true)['puesto']) {
                    case 'Facilitador': ?>
                        <aside class="left-sidebar" data-sidebarbg="skin5">
                            <!-- Sidebar scroll-->
                            <div class="scroll-sidebar">
                                <!-- Sidebar navigation-->
                                <nav class="sidebar-nav">
                                    <ul id="sidebarnav" class="p-t-30">
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Expedientes</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="eventos.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Eventos</span></a></li>
                                    </ul>
                                </nav>
                                <!-- End Sidebar navigation -->
                            </div>
                            <!-- End Sidebar scroll-->
                        </aside>
                    <?php break;
                    case 'Comite': ?>
                        <aside class="left-sidebar" data-sidebarbg="skin5">
                            <!-- Sidebar scroll-->
                            <div class="scroll-sidebar">
                                <!-- Sidebar navigation-->
                                <nav class="sidebar-nav">
                                    <ul id="sidebarnav" class="p-t-30">
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Expedientes</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="usuarios.php" aria-expanded="false"><i class="fas fa-users"></i><span class="hide-menu"> Usuarios</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="eventos.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Eventos</span></a></li>
                                    </ul>
                                </nav>
                                <!-- End Sidebar navigation -->
                            </div>
                            <!-- End Sidebar scroll-->
                        </aside>

                    <?php break;
                    case 'Desarrollador': ?>
                        <aside class="left-sidebar" data-sidebarbg="skin5">
                            <!-- Sidebar scroll-->
                            <div class="scroll-sidebar">
                                <!-- Sidebar navigation-->
                                <nav class="sidebar-nav">
                                    <ul id="sidebarnav" class="p-t-30">
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Expedientes</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="usuarios.php" aria-expanded="false"><i class="fas fa-users"></i><span class="hide-menu"> Usuarios</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="eventos.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Eventos</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="patrocinios.php" aria-expanded="false"><i class="fas fa-hands-helping"></i><span class="hide-menu"> Patrocinadores</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="junta.php" aria-expanded="false"><i class="fas fa-sitemap"></i><span class="hide-menu"> Junta Directiva</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="reuniones.php" aria-expanded="false"><i class="far fa-handshake"></i><span class="hide-menu"> Reuniones</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sedes.php" aria-expanded="false"><i class="far fa-handshake"></i><span class="hide-menu"> Sedes</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin.php" aria-expanded="false"><i class="far fa-handshake"></i><span class="hide-menu"> Admin</span></a></li>

                                    </ul>
                                </nav>
                                <!-- End Sidebar navigation -->
                            </div>
                            <!-- End Sidebar scroll-->
                        </aside>
                    <?php break;
                    case 'Junta Directiva': ?>
                        <aside class="left-sidebar" data-sidebarbg="skin5">
                            <!-- Sidebar scroll-->
                            <div class="scroll-sidebar">
                                <!-- Sidebar navigation-->
                                <nav class="sidebar-nav">
                                    <ul id="sidebarnav" class="p-t-30">
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Expedientes</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="usuarios.php" aria-expanded="false"><i class="fas fa-users"></i><span class="hide-menu"> Usuarios</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="eventos.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Eventos</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="patrocinios.php" aria-expanded="false"><i class="fas fa-hands-helping"></i><span class="hide-menu"> Patrocinadores</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="junta.php" aria-expanded="false"><i class="fas fa-sitemap"></i><span class="hide-menu"> Junta Directiva</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="reuniones.php" aria-expanded="false"><i class="far fa-handshake"></i><span class="hide-menu"> Reuniones</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sedes.php" aria-expanded="false"><i class="far fa-handshake"></i><span class="hide-menu"> Sedes</span></a></li>
                                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin.php" aria-expanded="false"><i class="far fa-handshake"></i><span class="hide-menu"> Admin</span></a></li>

                                    </ul>
                                </nav>
                                <!-- End Sidebar navigation -->
                            </div>
                            <!-- End Sidebar scroll-->
                        </aside>

                    <?php break;

                    default: ?>
                <?php break;
                }
                ?>

                <div class="page-wrapper">
                <?php
            }
            function get_scripts()
            {
                ?>
                </div>
            </div>
            <!-- All Jquery -->
            <!-- ============================================================== -->
            <script src="assets/libs/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap tether Core JavaScript -->
            <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
            <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- slimscrollbar scrollbar JavaScript -->
            <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
            <script src="assets/extra-libs/sparkline/sparkline.js"></script>
            <!--Wave Effects -->
            <script src="assets/dist/js/waves.js"></script>
            <!--Menu sidebar -->
            <script src="assets/dist/js/sidebarmenu.js"></script>
            <!--Custom JavaScript -->
            <script src="assets/dist/js/custom.min.js"></script>
            <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
            <script src="assets/js/main.js"></script>
            <script>
                $('#zero_config').DataTable({
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    }
                });
                $('.zero_config').DataTable({
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    }
                });
            </script>
        </body>

        </html>
<?php
            }
        }


?>