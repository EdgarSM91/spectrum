<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="<?php echo $this->url->get('dashboard'); ?>">Inicio</a></li>
    <li><a href="<?php echo $this->url->get('dashboard/users'); ?>">Usuarios</a></li>
    <li class="active"><a href="#">Nuevo Usuario</a></li>
</ul>
<!-- END BREADCRUMB -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-title">Nuevo Usuario</h4>
            <div class="col-md-12 col-xs-12 panel-body form-group-separated">
                <form action="#" method="post" id="newUser" role="form" class="form-horizontal">
                    <span class="hide" id="key-security" data-key="<?php echo $this->security->getToken(); ?>"></span>
                    <span class="hide" id="value-security" data-value="<?php echo $this->security->getTokenKey(); ?>"></span>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nombre</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" class="form-control" placeholder="Nombre" name="name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Apellido paterno</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" class="form-control" placeholder="Apellido Paterno" name="last_name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Apellido Materno</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" class="form-control" placeholder="Apellido Materno" name="second_name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Sexo</label>
                        <div class="col-md-6 col-xs-12">
                            <select id="sex" name="sex" class="form-control" required>
                                <option value="">Selecciona un sexo</option>
                                <option  value="M">Masculino</option>
                                <option  value="F">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Teléfono</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="phone" pattern="[789][0-9]{9}" class="form-control" placeholder="Teléfonono" name="phone"  required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Username</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" class="form-control" placeholder="Nombre de usuario" name="username"  required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Cuenta de correo</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="email" class="form-control" placeholder="Correo Eelectrónico" name="email" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Contraseña</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="password" class="form-control" placeholder="Nueva contraseña" name="password" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Repetir Contraseña</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="password" class="form-control" placeholder="Repetir contraseña" name="confirmPassword" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Rol</label>
                        <div class="col-md-6 col-xs-12">
                            <select id="sex" name="rol" class="form-control" required>
                                <option  value="ADMIN">ADMINISTRADOR</option>
                                <option  selected value="COORDINATOR">COORDINADOR</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Status</label>
                        <div class="col-md-6 col-xs-12">
                            <select id="sex" name="status" class="form-control" required>
                                <option  selected value="ACTIVE">ACTIVO</option>
                                <option  value="INACTIVE">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <input type="submit" class="btn btn-success" value="Guardar"/>
                        </div>
                    </div>
                </form>
            </div>
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