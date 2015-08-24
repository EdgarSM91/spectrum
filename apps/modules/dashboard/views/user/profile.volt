<span class="hide" id="key-security" data-key="<?php echo $this->security->getToken(); ?>"></span>
<span class="hide" id="value-security" data-value="<?php echo $this->security->getTokenKey(); ?>"></span>
<span class="hide" id="uid" data-uid="{{user.getUid()}}"></span>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{url('dashboard')}}">Inicio</a></li>
    <li><a href="#">Usuarios</a></li>
    <li class="active">Perfil</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

<div class="row">
    <div class="col-md-3">

        <div class="panel panel-default">
            <div class="panel-body profile" style="background: url('{{url('dash/assets/images/gallery/music-4.jpg')}}') center center no-repeat;">
                <div class="profile-image">
                    <img src="/dash/assets/images/users/thumbnail/{{user.getPhoto()}}" alt="Nadia Ali"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name" style="color: #000;">{{user.getUsername()}}</div>
                </div>
                <div class="profile-controls">
                    <a href="#" class="profile-control-left twitter"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="profile-control-right facebook"><span class="fa fa-facebook"></span></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-info btn-rounded btn-block"><span class="fa fa-check"></span> Seguir</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-rounded btn-block"><span class="fa fa-comments"></span> Conversar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-9">
        <!-- START TABS -->
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab-second" role="tab" data-toggle="tab" aria-expanded="false">Datos personales</a></li>
                <li class=""><a href="#tab-third" role="tab" data-toggle="tab" aria-expanded="false">Imagen de perfil</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="tab-second">
                    <h4 class="text-title">Actualizar datos personales</h4>
                    <div class="col-md-12 col-xs-12 panel-body form-group-separated">
                        <form action="#" method="post" id="updateProfile" role="form" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Nombre</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{user.getName()}}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Apellido paterno</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Apellido Paterno" name="last_name" value="{{user.getLastName()}}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Apellido Materno</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Apellido Materno" name="second_name" value="{{user.getSecondName()}}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Sexo</label>
                                <div class="col-md-6 col-xs-12">
                                    <select id="sex" name="sex" class="form-control" required>
                                        <option <?php echo $user->getSex()=="M"?"selected":""; ?> value="M">Masculino</option>
                                        <option <?php echo $user->getSex()=="F"?"selected":""; ?> value="F">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Teléfono</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="phone" pattern="[789][0-9]{9}" class="form-control" placeholder="Teléfonono" name="phone" value="{{user.getPhone()}}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Username</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Nombre de usuario" name="username" value="{{user.getUsername()}}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Cuenta de correo</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="email" class="form-control" placeholder="Correo Eelectrónico" name="email" value="{{user.getEmail()}}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
                                    <input type="submit" class="btn btn-success" value="Actualizar"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="tab-third">
                    <label class="col-md-3 col-xs-12 control-label">Imagen de perfil</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3><span class="fa fa-download"></span> Imagen perfil</h3>
                                <p>Actualizar imagen de perfil</p>
                                <form action="#" class="dropzone dropzone-mini" id="dropzone-user-edit" name="dropzone-user-edit" rol="form">
                                    <input type="hidden" value="{{user.getPhoto()}}" id="user-image" name="photo"/>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success" id="save-image">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TABS -->
    </div>
</div>

</div>
<!-- END PAGE CONTENT WRAPPER -->
<!--MODALS-->
<div class="modal" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="defModalHead">Cambiar contraseña</h4>
            </div>
            <form id="updatePassword" action="#" method="post" rol="form" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" class="form-control" placeholder="Nueva contraseña" name="password" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" class="form-control" placeholder="Repetir contraseña" name="confirmPassword" required/>
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
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-info">Cambiar</button>
                    <!--Messages-->
                    <i id="session-loading" class="fa fa-spinner fa-spin fade hide" style="font-size: 22px;"></i>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODALS-->

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
<div class="message-box message-box-danger animated fadeIn" id="message-box-danger">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> Cuidado</div>
            <div class="mb-content">
                <p>Usted no puede actualizar su imagen.</p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close">Cerrar</button>
            </div>
        </div>
    </div>
</div>