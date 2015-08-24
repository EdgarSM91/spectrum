<!DOCTYPE html>
<html lang="es-MX">
<head>
    <!-- META SECTION -->
    <?php $auth = $this->session->get("auth");?>
    <title>SPECTRUM | Iniciar sesión</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--Meta Google-->
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="nofollow">
    <meta name="googlebot" content="nofollow">
    <meta name="google" content="notranslate" />
    <meta name="author" content="Chontal Developers" />
    <meta name="copyright" content="2014 c-develpers.com Todos los derechos reservados." />
    <meta name="application-name" content="CMS Retos" />
    <link rel="author" href="https://plus.google.com/u/0/101316577346995540804/posts"/>
    <!-- CSS INCLUDE -->
    
        <?php echo $this->assets->outputCss('CssIndex'); ?>
    
    <link rel="stylesheet" href="<?php echo $this->url->get('dash/css/bootstrap/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" id="theme" href="/dash/css/theme-default.css"/>
    <link rel="stylesheet" type="text/css" id="theme" href="/dash/css/fontawesome/font-awesome.min.css"/>

    <!-- EOF CSS INCLUDE -->
</head>
<body>
<!-- PAGE LOADING FRAME -->
<div class="page-loading-frame">
    <div class="page-loading-loader">
        <img src="<?php echo $this->url->get('dash/img/loaders/page-loader.gif'); ?>"/>
    </div>
</div>
<!-- END PAGE LOADING FRAME -->
  <!-- START PAGE CONTAINER -->
    <div class="page-container">

        <!-- START PAGE SIDEBAR -->
        <div class="page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide page-sidebar-fixed scroll">
            <!-- START X-NAVIGATION -->
            <ul class="x-navigation">
                <li class="xn-logo">
                    <a href="<?php echo $this->url->get('dashboard'); ?>">SPECTRUM</a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile">
                    <a href="<?php echo $this->url->get('dashboard/user/profile'); ?>" class="profile-mini">
                        <img src="/dash/assets/images/users/thumbnail/<?php echo $auth['photo']; ?>" alt="Alexander"/>
                    </a>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="/dash/assets/images/users/thumbnail/<?php echo $auth['photo']; ?>" alt="Alexander"/>
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name"><?php echo $auth['username']; ?></div>
                        </div>
                        <div class="profile-controls">
                            <a href="<?php echo $this->url->get('dashboard/user/profile'); ?>" class="profile-control-left" title="Editar perfil"><span class="fa fa-info"></span></a>
                            <a href="<?php echo $this->url->get('dashboard'); ?>" class="profile-control-right" title="Mensajes de post"><span class="fa fa-envelope"></span></a>
                        </div>
                    </div>
                </li>
                <li class="xn-title">Navegación</li>
                <li class="<?php echo $this->router->getControllerName()=='index'?"active":""?>">
                    <a href="<?php echo $this->url->get('dashboard'); ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Menú principal</span></a>
                </li>
                <li class="xn-openable <?php echo $this->router->getControllerName()=='course'?"active":""?>">
                    <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Cursos</span></a>
                    <ul>
                        <li class="<?php echo $this->router->getControllerName()=='course' && $this->router->getActionName()=='new'?"active":""?>"><a href="<?php echo $this->url->get('dashboard/course/new'); ?>"><span class="fa fa-pencil"></span> Nuevo curso</a></li>
                        <li class="<?php echo $this->router->getControllerName()=='course' && $this->router->getActionName()=='index'?"active":""?>"><a href="<?php echo $this->url->get('dashboard/courses'); ?>"><span class="fa fa-file"></span> Cursos activos</a></li>
                        <li class="<?php echo $this->router->getControllerName()=='course' && $this->router->getActionName()=='inactive'?"active":""?>"><a href="<?php echo $this->url->get('dashboard/courses/inactive'); ?>"><span class="fa fa-file-text-o"></span> Cursos inactivos</a></li>
                    </ul>
                </li>
                <li class="xn-openable <?php echo $this->router->getControllerName()=='photo'?"active":""?>">
                    <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Instructores</span></a>
                    <ul>
                        <li class="<?php echo $this->router->getControllerName()=='trainer' && $this->router->getActionName()=='new'?"active":""?>"><a href="<?php echo $this->url->get('dashboard/instructor/new'); ?>"><span class="fa fa-user-plus"></span> Nuevo Instrutor</a></li>
                        <li class="<?php echo $this->router->getControllerName()=='trainer' &&  $this->router->getActionName()=='index'?"active":""?>"><a href="<?php echo $this->url->get('dashboard/instructors'); ?>"><span class="fa fa-user"></span> Instrutores activos</a></li>
                        <li class="<?php echo $this->router->getControllerName()=='trainer' &&  $this->router->getActionName()=='inactive'?"active":""?>"><a href="<?php echo $this->url->get('dashboard/instructors/inactive'); ?>"><span class="fa fa-user-times"></span> Instrutores inactivos</a></li>
                    </ul>
                </li>
                <li class="xn-openable <?php echo $this->router->getControllerName()=='category'?"active":""?>">
                    <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Configuraciones</span></a>
                    <ul>
                        <li class="<?php echo $this->router->getActionName()=='index' && $this->router->getControllerName()=='category'?"active":""?>"><a href="<?php echo $this->url->get('dashboard/category'); ?>"><span class="fa fa-list-ul"></span>Especialidades</a></li>
                    </ul>
                </li>
                <?php if ($auth['rol'] == 'ADMIN') { ?>
                <li class="xn-openable <?php echo $this->router->getControllerName()=='user'?"active":""?>">
                    <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Usuarios</span></a>
                    <ul>
                        <li class="<?php echo $this->router->getControllerName()=='user' && $this->router->getActionName()=='newuser'?"active":""?>">
                            <a href="<?php echo $this->url->get('dashboard/user/new-user'); ?>"><span class="fa fa-user-plus"></span> Nuevo usuario</a>
                        </li>
                        <li class="<?php echo $this->router->getActionName()=='index' && $this->router->getControllerName()=='user'?"active":""?>">
                            <a href="<?php echo $this->url->get('dashboard/users'); ?>"><span class="fa fa-user"></span> Usuarios Activos</a>
                        </li>
                        <li class="<?php echo $this->router->getActionName()=='inactive' && $this->router->getControllerName()=='user'?"active":""?>">
                            <a href="<?php echo $this->url->get('dashboard/user/inactive'); ?>"><span class="fa fa-user-secret"></span> Usiarios Inactivos</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
            <!-- END X-NAVIGATION -->
        </div>
        <!-- END PAGE SIDEBAR -->


        <!-- PAGE CONTENT -->
        <div class="page-content">

            <!-- START X-NAVIGATION VERTICAL -->
            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                <!-- TOGGLE NAVIGATION -->
                <li class="xn-icon-button">
                    <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                </li>
                <!-- END TOGGLE NAVIGATION -->
                <!-- SEARCH -->
                <li class="xn-search">
                    <form role="form">
                        <input type="text" name="search" placeholder="Buscar"/>
                    </form>
                </li>
                <!-- END SEARCH -->
                <!-- POWER OFF -->
                <li class="xn-icon-button pull-right last">
                    <a href="#"><span class="fa fa-power-off"></span></a>
                    <ul class="xn-drop-left animated zoomIn">
                        <li><a href="<?php echo $this->url->get(''); ?>"><span class="fa fa-lock"></span>Bloquear</a></li>
                        <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span>Cerrar sesión</a></li>
                    </ul>
                </li>
                <!-- END POWER OFF -->
            </ul>
            <!-- END X-NAVIGATION VERTICAL -->
            <?php echo $this->getContent(); ?>
        </div>
        <!-- END PAGE CONTENT -->

    </div>
    <!-- END PAGE CONTAINER -->

    <!-- MESSAGE BOX-->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span> Cerrar <strong>Sesión</strong> ?</div>
                <div class="mb-content">
                    <p>¿Estas seguro de cerrar esta sesión?</p>
                    <p>Pulse No si desea continuar con el trabajo. Pulse Sí para cerrar la sesión del usuario actual.</p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a href="<?php echo $this->url->get('logout'); ?>" class="btn btn-success btn-lg">Yes</a>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MESSAGE BOX-->
    
        <?php echo $this->assets->outputJs('JsIndex'); ?>
    
    <?php $jsPhotoNotes = $this->assets->collection('jsPhotoNotes'); ?>
    <?php if (!empty($jsPhotoNotes)) { ?>
        <?php echo $this->assets->outputJs('jsPhotoNotes'); ?>
    <?php } ?>
    <?php $jsMasonry = $this->assets->collection('jsMasonry'); ?>
    <?php if (!empty($jsMasonry)) { ?>
        <?php echo $this->assets->outputJs('jsMasonry'); ?>
    <?php } ?>
    <script type="text/javascript" src="/dash/js/plugins.js"></script>
    <script type="text/javascript" src="/dash/js/actions.js"></script>
    <script type="text/javascript">
        $(function(){
            setTimeout(function(){
                pageLoadingFrame();
            },1000);
        });
        function delete_row(row){

            var box = $("#mb-remove-row");
            box.addClass("open");

            box.find(".mb-control-yes").on("click",function(){
                box.removeClass("open");
                $("#"+row).hide("slow",function(){
                    $(this).remove();
                });
            });
        }
    </script>
</body
</html>