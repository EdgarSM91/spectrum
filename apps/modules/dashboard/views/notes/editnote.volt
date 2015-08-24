<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{url('dashboard')}}">Inicio</a></li>
    <li><a href="{{url('dashboard/notes')}}">Notas</a></li>
    <li class="active"><a href="#">Editar nota</a></li>
</ul>
<!-- PAGE TITLE -->
<div class="page-title">
    <h2><a href="{{url('dashboard/notes')}}"><span class="fa fa-arrow-circle-o-left"></span></a>  Salir</h2>
</div>
<!-- END PAGE TITLE -->
<!-- END BREADCRUMB -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-title">Editando nota</h4>
            <div class="col-md-12 col-xs-12 panel-body form-group-separated">
                <form action="#" method="post" id="updateNote" name="updateNote" role="form" class="form-horizontal">
                    <span class="hide" id="key-security" data-key="<?php echo $this->security->getToken(); ?>"></span>
                    <span class="hide" id="value-security" data-value="<?php echo $this->security->getTokenKey(); ?>"></span>
                    <input type="hidden" value="{{note.getPid()}}" name="pid"/>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Titulo</label>
                        <div class="col-md-8 col-xs-12">
                            <?php $new_title = str_replace('\'', '"', $note->getTitle());?>
                            <input id="note-title" type="text" class="form-control" placeholder="Titulo" name="title" value='{{new_title}}' required/>
                            <i id="input-loader" class="fa fa-spinner fa-spin fade in hide"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Enlace o Permalink</label>
                        <div class="col-md-8 col-xs-12">
                            <input id="note-permalink" type="text" class="form-control" placeholder="Enlace o Permalink" name="permalink" value="{{note.getPermalink()}}" required readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Imagen</label>
                        <div class="col-md-8 col-xs-12">
                            <div id="dropzone-note-edit" class="dropzone dz-default dz-message">
                                <div class="dz-default dz-message">
                                    <h2>
                                        <i class="fa fa-cloud-upload" style="font-size: 62px;"></i><br/>
                                        Arrastra una imagen <br><i style="font-size: 14px;">o haz clic para seleccionar manualmente</i>
                                        <input type="hidden" value="{{note.getImage()}}" name="image" id="input-image-principal" >
                                    </h2>
                                </div>
                            </div>
                            <br/>
                            <p>Dimensiones de la imagen <strong>1024x576</strong>px</p>
                            <br/>
                            <input type="text" class="form-control" value="{{note.getDescriptionImage()}}" id="descriptionI" name="descriptionI" placeholder="Descripción de la imagen"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Sumario</label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control" name="summary" id="" cols="10" rows="5">{{note.getSummary()}}</textarea>
                            <p>Introduzca un texto de introducción para la nota.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Contenido</label>
                        <div class="col-md-8 col-xs-12">
                            <div class="block">
                                <textarea class="form-control" class="summernote" name="summernote" id="summernote" rows="10" cols="80">
                                    {{note.getContent()}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tags</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <select id="tid" name="tag[]" class="form-control selectM" data-placeholder="Agregar Tags" required multiple="multiple">
                                <?php foreach ($tags as $key=>$value):?>
                                    <option <?php echo !empty($activeTags[$key+1])==$value->getTid()?"selected":""?> value="{{value.getTid()}}">{{value.getNameTag()}}</option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a class="btn btn-info" id="newTagB" href="#tags">Nuevo Tag</a>
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
                        <label class="col-md-2 col-xs-12 control-label">Subcategoria</label>
                        <div class="col-md-4 col-sm-6 col-xs-12" id="select-scid">
                            <select id="scid" name="subcategory" class="form-control" required multiple>
                                <?php foreach ($subcategory as $key => $sub):?>
                                        <?php foreach($subcategory[$key] as $k => $newValue): ?>
                                            <?php if($k==$categoryVal):?>
                                                <option class='options' value="<?php echo $key ?>" <?php echo $note->getScid()==$key?"selected":""?>><?php echo $newValue;?></option>
                                            <?php endif?>
                                        <?php endforeach;?>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tipo de Nota</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <select id="typeNote" name="type" class="form-control" required>
                                <option <?php echo $note->getType()=="OWN"?"selected":""; ?> value="OWN">Propia</option>
                                <option <?php echo $note->getType()=="DRAFTING"?"selected":""; ?> value="DRAFTING">Redacción</option>
                                <option <?php echo $note->getType()=="AGENCY"?"selected":""; ?> value="AGENCY">Agencia</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="clearfix"></div>
                        <label class="col-md-2 col-xs-12 control-label">Estatus</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <select id="status" name="status" class="form-control" required>
                                <option <?php echo $note->getStatus()=="ERASER"?"selected":""; ?> value="ERASER">Borrador</option>
                                <option <?php echo $note->getStatus()=="PUBLIC"?"selected":""; ?> value="PUBLIC">Publico</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="clearfix"></div>
                        <label class="col-md-2 col-xs-12 control-label">Fecha de publicación</label>
                        <div class="col-md-4 col-sm-6 col-xs-12 date" id="dateTop">
                            <?php
                            $dateC= $note->getDatePublic();
                            $newDate = date("d/m/Y", strtotime($dateC));
                            ?>
                            <input type="text" class="form-control" id="datepicker" name="dateP" value="{{newDate}}">
                            <div id="element"></div>
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
                <p>Sus cambios han sido guardados correctamente</p>
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
<div class="modal fade" id="myTag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="alert alert-success fade in success hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <strong>Tag agregado exitosamente</strong>
                </div>
                <div class="alert alert-error fade in error hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <strong>Error, intenta nuevamente</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="myModalLabel">Nuevo Tag</h4>
            </div>
            <form method="post" action="" name="form-tag" id="form-tag">
                <div class="modal-body">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <input required class="form-control" name="newTag" id="newTag" placeholder="Nombre Tag">
                        </div>
                        <div class="form-group">
                            <input required class="form-control" name="rTag" id="rTag" placeholder="Repetir Tag">
                        </div>
                        {% if auth['ncgid']=="All"%}
                        <div class="form-group">
                            <select style="width: 100%" id="cgid" name="cgid" class="form-control selectU" data-placeholder="Agregar Categoría" required multiple="multiple">
                                <?php foreach ($category as $key => $sub):?>
                                    <?php if($key!=5):?>
                                        <option value="{{key}}">{{sub}}</option>
                                    <?php endif ?>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <br>
                        {% else %}
                        <input type="hidden" name="cgid" value="{{autg['cgid']}}"/>
                        {% endif %}
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input  type="submit" class="btn btn-primary" value="Guardar cambios">
                </div>
            </form>
        </div>
    </div>
</div>