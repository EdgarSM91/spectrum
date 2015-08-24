<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{url('dashboard')}}">Inicio</a></li>
    <li><a href="{{url('dashboard/photo')}}">Foto Notas</a></li>
    <li class="active"><a href="#">Editar Foto Nota</a></li>
</ul>
<!-- PAGE TITLE -->
<div class="page-title">
    <h2><a href="{{url('dashboard/photo')}}"><span class="fa fa-arrow-circle-o-left"></span></a> Salir</h2>
</div>
<!-- END BREADCRUMB -->
<div class="page-content-wrap photo_notes_gallery">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-title">Editar Foto Nota</h4>
            <div class="col-md-12 col-xs-12 panel-body form-group-separated">
                <form action="#" method="post" id="newPhotoNote" name="newNote"role="form" class="form-horizontal">
                    <span class="hide" id="key-security" data-key="<?php echo $this->security->getToken(); ?>"></span>
                    <span class="hide" id="value-security" data-value="<?php echo $this->security->getTokenKey(); ?>"></span>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Titulo</label>
                        <div class="col-md-8 col-xs-12">
                            <input id="photo-note-title" type="text" class="form-control" placeholder="Titulo" name="title" value="{{pn.getTitle()}}" required/>
                            <i id="input-loader" class="fa fa-spinner fa-spin fade in hide"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Enlace o Permalink</label>
                        <div class="col-md-8 col-xs-12">
                            <input id="note-permalink" type="text" class="form-control" value="{{pn.getPermalink()}}" placeholder="Enlace o Permalink" name="permalink" required readonly style="color: #000;"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Imagen</label>
                        <div class="col-md-8 col-xs-12">
                            <div id="ip-edit-principal-dz" class="dropzone dz-default dz-message">
                                <div class="dz-default dz-message">
                                    <h2 class="text-center">
                                        <i class="fa fa-cloud-upload" style="font-size: 62px;"></i><br/>
                                        Arrastra una imagen <br><i style="font-size: 14px;">o haz clic para seleccionar manualmente</i>
                                        <input type="hidden" value="{{pn.getImage()}}" name="image" id="img-photo-principal-dz" >
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Contenido</label>
                        <div class="col-md-8 col-xs-12">
                            <div class="block">
                                <textarea id="summernote" class="summernote" name="summernote" cols="30" rows="10">{{pn.getContent()}}</textarea>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tipo Foto Nota</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <select id="type_pn" name="type_pn" class="form-control selectU" data-placeholder="Agregar Tipo Foto Nota" required multiple="multiple">
                                <option <?= $pn->getTypePn()=="NOTE"?"selected":"";?> value="NOTE">Nota</option>
                                {% if auth['ncgid']=="Entretenimiento" or auth['ncgid']=="All" %}
                                    <option <?= $pn->getTypePn()=="MEME"?"selected":"";?> value="MEME">Meme</option>
                                {%endif%}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Categoría</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <select id="cid" name="category" class="form-control" required multiple>
                                <?php foreach ($category as $key => $sub):?>
                                    <?php if(($sub!="Revista") && ($sub!="All")):?>
                                        <?php if($auth['ncgid']=='All'):?>
                                            <option <?php echo $categoryVal==$key?"selected":""?> value="<?php echo $key?>">{{sub}}</option>
                                        <?php elseif($auth['ncgid']==$sub):?>
                                            <option <?php echo $categoryVal==$key?"selected":""?> value="<?php echo $key?>">{{sub}}</option>
                                        <?php endif?>
                                    <?php endif ?>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Estatus</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <select id="status" name="status" class="form-control" required>
                                <option <?php echo $pn->getStatus()=="ERASER"?"selected":""; ?> value="ERASER">Borrador</option>
                                <option <?php echo $pn->getStatus()=="PUBLIC"?"selected":""; ?> value="PUBLIC">Publico</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <input type="submit" class="btn btn-success btn-submit" value="Actualizar"/>
                            <input type="hidden" name="pnid" id="pnid" value="{{pn.getPnid()}}"/>
                        </div>
                    </div>
                </form>
                <div class="form-group  fade in" id="EditGalleryPhotoNote">
                    <label class="col-md-2 col-xs-12 control-label">Imagen</label>
                    <div class="col-md-8 col-xs-12">
                        <h2>Carga las imágenes de la galería y asigne una descripción.</h2>
                        <div id="gallery-photo-principal-dz" class="dropzone dz-default dz-message">
                            <div class="dz-default dz-message">
                                <h2 class="text-center">
                                    <i class="fa fa-cloud-upload" style="font-size: 62px;"></i><br/>
                                    Arrastra una imagen <br><i style="font-size: 14px;">o haz clic para seleccionar manualmente</i>
                                </h2>
                            </div>
                            {% for values in gpn %}
                                <input type="hidden" name="photo_note[]" id="gry-photo-principal-dz" value="{{values.getName()~'|'~values.getImgid()}}">
                            {% endfor %}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                </div>
                <div class="file-two-upload">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <div class="alert alert-warning fade hide warning" role="alert" id="warning-pn">
                                        <strong>Ha ocurrido un error intente nuevamente!</strong>
                                    </div>
                                    <div class="alert alert-success fade hide success" role="alert" id="success-pn">
                                        <strong>Foto nota guardada correctamente!</strong>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <i class="fa fa-spinner fa-spin loading hide" style="float:right;"></i>
                                </div>
                            </div>
                            <table class="table" id="ddt-gallery-positions">
                                <tbody>
                                {% for values in gpn %}
                                    <tr  data-id="{{values.getImgid()}}" data-name="{{values.getName()}}" class="images_gallery {{values.getImgid()}}"  id="{{values.getName()~'|'~values.getImgid()}}" >
                                        <td>
                                            <img src="{{url('/dash/img/photo_notes/256x144/'~values.getName())}}" alt="" />
                                        </td>
                                        <td class="title_image">{{values.getName()}}</td>
                                        <td>
                                            <textarea name="sumary" class="form-control summary description_images" placeholder="Agregar una descripción" readonly autofocus>{{values.getDescription()}}</textarea><br>
                                            <div class="hide alert alert-success fade " role="alert"><strong>Descripción agregada correctamente</strong></div>
                                            <div class="hide alert alert-danger fade" role="alert"><strong>Ha ocurrido un error, y no se ha podido guardar.</strong></div>
                                        </td>
                                    </tr>
                                {% endfor %}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- info -->
<div class="message-box message-box-info animated fadeIn" id="message-box-info">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title">Creando Foto Notas &nbsp; <i class="fa fa-circle-o-notch fa-spin style-fa"></i></div>
            <div class="mb-content">
                <p>Actualizando Foto Nota, espere un momento por favor.</p>
            </div>
        </div>
    </div>
</div>
<!-- end info -->
<!-- success -->
<div class="message-box message-box-success animated fadeIn" id="message-box-success">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-check"></span>Foto Nota Actualizada Correctamente</div>
            <div class="mb-content">
                <p>Sus cambios han sido actualizados correctamente, ahora agregue las fotos que deseé.</p>
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