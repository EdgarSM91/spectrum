<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{url('dashboard')}}">Inicio</a></li>
    <li><a href="{{url('dashboard/instructors')}}">Instructor</a></li>
    <li class="active"><a href="#">Nuevo Instructor</a></li>
</ul>
<!-- PAGE TITLE -->
<div class="page-title">
    <h2><a href="{{url('dashboard/instructors')}}"><span class="fa fa-arrow-circle-o-left"></span></a> Salir</h2>
</div>
<!-- END BREADCRUMB -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-title">Crear Nuevo Instructor</h4>
            <div class="col-md-12 col-xs-12 panel-body form-group-separated">
                <form action="#" method="post" id="newInstructor" name="newInstructor"role="form" class="form-horizontal">
                    <span class="hide" id="key-security" data-key="<?php echo $this->security->getToken(); ?>"></span>
                    <span class="hide" id="value-security" data-value="<?php echo $this->security->getTokenKey(); ?>"></span>
                    <input type="hidden" name="image" value="{{image}}" id="name-image"/>
                    <input type="hidden" name="curriculum" value="{{curriculum}}" id="name-curriculum"/>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nombre completo</label>
                        <div class="col-md-3 col-xs-12">
                            <input id="name-instructor" type="text" class="form-control" placeholder="Nombre" name="name" required/>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <input id="last_name" type="text" class="form-control" placeholder="Apellido Paterno" name="last_name" required/>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <input id="second_name" type="text" class="form-control" placeholder="Apellido Materno" name="second_name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Sexo</label>
                        <div class="col-md-4 col-xs-12">
                            <select id="sex" name="sex" class="form-control select" required>
                                <option value="">SELECCIONA TIPO DE SEXO</option>
                                <option  value="M">MASCULINO</option>
                                <option  value="F">FEMENINO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nivel educativo</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" placeholder="Título" name="title" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Imagen</label>
                        <div class="col-md-8 col-xs-12">
                            <div id="imgInstructor" class="dropzone dz-default dz-message">
                                <div class="dz-default dz-message">
                                    <h2>
                                        <i class="fa fa-cloud-upload" style="font-size: 108px;"></i>
                                        Arrastra una imagen <br><i style="font-size: 14px;">o haz click para seleccionar manualmente</i>
                                        <input type="hidden" value="" name="imageI" id="imageI" >
                                    </h2>
                                </div>
                            </div>
                            <br/>
                            <p>Dimensiones de la imagen <strong>300x300</strong>px</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Descripción</label>
                        <div class="col-md-8 col-xs-12">
                            <div class="block">
                                <textarea class="form-control ckeditor" name="description" id="description" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div class="clearfix"></div>
                        <label class="col-md-2 col-xs-12 control-label">Fecha de contratación</label>
                        <div class="col-md-4 col-sm-6 col-xs-12 date" id="dateTop">
                            <input type="text" class="form-control" id="datepicker" name="beginning" value="">
                            <div id="element"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Jurisdicción</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <select id="jurisdiction" name="jurisdiction" class="form-control select" required>
                                <option value="NATIONAL" selected>NACIONAL</option>
                                <option value="INTERNATIONAL">INTERNACIONAL</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Currículum vítae</label>
                        <div class="col-md-8 col-xs-12">
                            <div id="pdfInstructor" class="dropzone dz-default dz-message">
                                <div class="dz-default dz-message">
                                    <h2>
                                        <i class="fa fa-cloud-upload" style="font-size: 108px;"></i>
                                        Arrastra el PDF <br><i style="font-size: 14px;">o haz click para seleccionar manualmente</i>
                                        <input type="hidden" value="" name="pdfI" id="pdfI" >
                                    </h2>
                                </div>
                            </div>
                            <br/>
                            <p id="link-pdf" class="hidden"></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Estatus</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <select id="status" name="status" class="form-control select" required>
                                <option selected value="ACTIVE">ACTIVO</option>
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