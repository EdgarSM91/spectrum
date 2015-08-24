<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="<?php echo $this->url->get('dashboard'); ?>">Inicio</a></li>
    <li class="active">Cursos</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE TITLE -->
<div class="page-title">
    <div class="col-sm-6 text-left">
        <h2><a href="<?php echo $this->url->get('dashboard'); ?>"><span class="fa fa-arrow-circle-o-left"></span></a> Menú principal</h2>
    </div>
    <div class="col-sm-6 text-right">
        <a href="<?php echo $this->url->get('dashboard/course/new'); ?>" class="btn btn-success btn-lg">Nuevo curso</a>
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
                    <h3 class="panel-title">Cursos</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-actions generalDT" data-order="4" data-filter="asc">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Permalink</th>
                                <th>Categoría</th>
                                <th>Autor</th>
                                <th>Fecha creación</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($courses as $values) { ?>
                            <?php $dateC= $values->getDateCreation(); $newDate = date("d-m-Y H:i:s", strtotime($dateC));?>
                            <?php $permalink = preg_replace(array_keys($expressions),array_values($expressions),str_replace(" ","-",strtolower($values->getNameCategory())))."/".$values->getPermalink();?>
                            <tr id="<?php echo $values->getCid(); ?>">
                                <td><?php echo $values->getName(); ?></td>
                                <td><a target="_blank" href="<?php echo $this->url->get($permalink); ?>"><?php echo $values->getPermalink(); ?></a></td>
                                <td><?php echo $values->getNameCategory(); ?></td>
                                <td><?php echo $values->getNameUser(); ?></td>
                                <td><?php echo $newDate; ?></td>
                                <td>
                                    <a href="<?php echo $this->url->get('dashboard/course/edit/'); ?><?php echo $values->getCid(); ?>" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                    <!--button class="btn btn-danger btn-rounded btn-sm" onclick="delete_row('values.getCid()');"><span class="fa fa-times"></span></button!-->
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