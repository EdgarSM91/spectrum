<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{url('dashboard')}}">Inicio</a></li>
    <li class="active">Instructores</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE TITLE -->
<div class="page-title">
    <div class="col-sm-6 text-left">
        <h2><a href="{{url('dashboard')}}"><span class="fa fa-arrow-circle-o-left"></span></a> Menú principal</h2>
    </div>
    <div class="col-sm-6 text-right">
        <a href="{{url('dashboard/instructor/new')}}" class="btn btn-success btn-lg">Nuevo Instructor</a>
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
                    <h3 class="panel-title">Instructores</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-actions generalDT" data-order="4" data-filter="asc">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Jurisdicción</th>
                                <th>Contratación</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            {% for values in instructors %}
                            <?php $dateC= $values->getBeginning(); $newDate = date("d-m-Y", strtotime($dateC));?>
                            <tr id="{{values.getInid()}}">
                                <td>{{values.getName()}}</td>
                                <td>{{values.getLastName()}}</td>
                                <td>{{values.getSecondName()}}</td>
                                <td>{{values.getJurisdiction()}}</td>
                                <td>{{newDate}}</td>
                                <td>
                                    <a title="Editar Instructor" href="{{url('dashboard/instructor/edit/')}}{{values.getInid()}}" class="btn btn-success btn-rounded btn-sm"><span class="fa fa-edit btn-options"></span></a>
                                    <a title="Ver perfil Instructor" href="{{url('dashboard/instructor/view/')}}{{values.getInid()}}" class="btn btn-info btn-rounded btn-sm"><span class="fa fa-eye btn-options"></span></a>
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