<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{url('')}}">Inicio</a></li>
    <li class="active">Notas mas visitadas</li>
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
                    <h3 class="panel-title">Notas</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-actions visitsTable generalDT" data-order="5" data-filter="desc">
                            <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Autor</th>
                                <th>Categoría</th>
                                <th>Subcategoria</th>
                                <th>Fecha creación</th>
                                <th>Visitas</th>
                            </tr>
                            </thead>
                            <tbody>
                            {% for values in notes %}
                            <?php
                            $dateC= $values->getDateCreation();
                            $newDate = date("d-m-Y H:i:s", strtotime($dateC));
                            ?>
                            <tr id="{{values.getPid()}}">
                                <td>{{values.getTitle()}}</td>
                                <td>{{values.getUsername()}}</td>
                                <td>{{values.getNameCategory()}}</td>
                                <td>{{values.getSubcategoryname()}}</td>
                                <td>{{newDate}}</td>
                                <td>
                                    {{values.getVisits()}}
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
