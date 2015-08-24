<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="<?php echo $this->url->get('dashboard'); ?>">Inicio</a></li>
    <li class="active">Especialidades</li>
</ul>
<span class="hide" id="key-security" data-key="<?php echo $this->security->getToken(); ?>"></span>
<span class="hide" id="value-security" data-value="<?php echo $this->security->getTokenKey(); ?>"></span>
<!-- END BREADCRUMB -->
<!-- PAGE TITLE -->
<div class="page-title">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <h2><a href="<?php echo $this->url->get('dashboard'); ?>"><span class="fa fa-arrow-circle-o-left"></span></a> Menú principal</h2>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <h2 style="float: none" class="text-right"><a data-toggle="modal" data-target="#modal_basic" href="#"><span class="fa fa-plus"></span> Nueva Especialidad</a></h2>
    </div>
</div>
<!-- END PAGE TITLE -->
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Especialidades</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="tableCategory" class="table table-bordered table-striped table-actions">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($categories as $values) { ?>
                            <tr id="<?php echo $values->getCgid(); ?>">
                                <td class="nameCategory"><?php echo $values->getName(); ?></td>
                                <td class="optionsCtg">
                                    <a href="#" data-cgid="<?php echo $values->getCgid(); ?>" data-namec="<?php echo $values->getName(); ?>" class="btn btn-default btn-rounded btn-sm btn-edit"><span class="fa fa-pencil"></span></a>
                                    <button class="btn btn-danger btn-rounded btn-sm deleteCg" data-cgid="<?php echo $values->getCgid(); ?>" data-namec="<?php echo $values->getName(); ?>"><span class="fa fa-times"></span></button>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div>
</div>
<!-- PAGE CONTENT WRAPPER -->

<!--MODALS-->
<div class="modal" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="defModalHead">Nueva Especialidad</h4>
            </div>
            <form id="newCategory" action="#" method="post" rol="form" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-play-circle"></span></span>
                                <input type="text" class="form-control cPL" placeholder="Nombre Especialidad" name="name_category" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-plus-circle"></span></span>
                                <input type="text" class="form-control cPL" placeholder="Repetir Especialidad" name="confirmCategory" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group fade hide" id="container-messages">
                        <div class="alert alert-warning fade hide" role="alert" id="email-incorrect">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                            <strong>Email incorrecto.</strong>
                        </div>
                        <div class="alert alert-warning fade hide" role="alert" id="password-incorrect">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <strong>Contraseña incorrecta.</strong>
                        </div>
                        <div class="alert alert-warning fade hide" role="alert" id="all-incorrect">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <strong>Email o contraseña incorrecto</strong>
                        </div>
                        <!--End Mesages-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-submit" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-info btn-submit">Guardar</button>
                    <!--Messages-->
                    <i id="session-loading" class="fa fa-spinner fa-spin fade hide" style="font-size: 22px;"></i>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODALS-->

<!--MODALS-->
<div class="modal" id="edit_category" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="defModalHead">Editar Especialidad</h4>
            </div>
            <form id="editCategory" action="#" method="post" rol="form" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-play-circle"></span></span>
                                <input id="nameCtg" type="text" class="form-control cPL" placeholder="Nombre Especialidad" name="name_category" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-plus-circle"></span></span>
                                <input type="text" class="form-control cPL" placeholder="Repetir Especialidad" name="confirmCategory" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group fade hide" id="container-messages">
                        <div class="alert alert-warning fade hide" role="alert" id="email-incorrect">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                            <strong>Email incorrecto.</strong>
                        </div>
                        <div class="alert alert-warning fade hide" role="alert" id="password-incorrect">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <strong>Contraseña incorrecta.</strong>
                        </div>
                        <div class="alert alert-warning fade hide" role="alert" id="all-incorrect">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <strong>Email o contraseña incorrecto</strong>
                        </div>
                        <!--End Mesages-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-submit" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-info btn-submit" value="Guardar">
                    <!--Messages-->
                    <i id="session-loading" class="fa fa-spinner fa-spin fade hide" style="font-size: 22px;"></i>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODALS-->
<!-- Delete Category -->
<div class="modal fade" id="deleteCg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="alert alert-success fade in success hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <strong>Especialidad eliminado exitosamente</strong>
                </div>
                <div class="alert alert-error fade in error hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <strong>Error, intenta nuevamente</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="myModalLabel">Eliminar Tag</h4>
            </div>
            <form method="post" action="" name="delete-tag" id="delete-tag">
                <div class="modal-body">
                    <div class="col-lg-8">
                        <p>Esta seguro de eliminar la Especialidad <strong><span id="cgValue"></span></strong></p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input  type="submit" class="btn btn-primary btn-submit" value="Eliminar">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- info -->
<div class="message-box message-box-info animated fadeIn" id="message-box-info">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"> Actualizando &nbsp; <i class="fa fa-circle-o-notch fa-spin style-fa"></i></div>
            <div class="mb-content">
                <p>Guardando y Actualizando su información, espere un momento por favor.</p>
            </div>
        </div>
    </div>
</div>
<!-- end info -->
<!-- success -->
<div class="message-box message-box-success animated fadeIn" id="message-box-success">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-check"></span> Información actualizada</div>
            <div class="mb-content">
                <p>Sus cambios han sido guardados correctamente, actualizaremos el sitio para reflejar los cambios.</p>
            </div>
        </div>
    </div>
</div>
<!-- end success -->
<!-- warning -->
<div class="message-box message-box-warning animated fadeIn" id="message-box-warning">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-warning"></span> Error</div>
            <div class="mb-content">
                <p>Ha ocurrido un error al guardar su información, inténtelo nuevamente o regrese mas tarde.</p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- end danger -->