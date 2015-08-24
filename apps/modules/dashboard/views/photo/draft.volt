<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{url('')}}">Inicio</a></li>
    <li class="active">Foto Notas Borrador</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE TITLE -->
<div class="page-title">
    <h2><a href="{{url('dashboard')}}"><span class="fa fa-arrow-circle-o-left"></span></a> Menú principal</h2>
</div>
<!-- END PAGE TITLE -->
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Foto Notas Borrador</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-actions generalDT" data-order="4" data-filter="asc">
                            <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Autor</th>
                                <th>Categoría</th>
                                <th>Tipo</th>
                                <th>Fecha creación</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            {% for values in allPhotoNotes %}
                            <?php
                            $dateC= $values->getDateCreation();
                            $newDate = date("d-m-Y H:i:s", strtotime($dateC));
                            ?>
                            <tr id="{{values.getPnid()}}">
                                <td>{{values.getTitle()}}</td>
                                <td>{{values.getUsername()}}</td>
                                <td>{{values.getNameCategory()}}</td>
                                <td><?=$values->getTypePn()=="NOTE"?"NOTA":"MEME"?></td>
                                <td>{{newDate}}</td>
                                <td>
                                    <a href="{{url('dashboard/photo/edit?pnid=')}}{{values.getPnid()}}" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                    <button class="btn btn-danger btn-rounded btn-sm" onclick="delete_row('{{values.getPnid()}}');"><span class="fa fa-times"></span></button>
                                </td>
                            </tr>
                            {% endfor %}
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
<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> Eliminar <strong>Datos</strong> ?</div>
            <div class="mb-content">
                <p>¿Estas seguro de eliminar esta fila?</p>
                <p>Presione "Si" si esta seguro.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <button class="btn btn-success btn-lg mb-control-yes">Si</button>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->