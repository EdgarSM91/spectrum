<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="<?php echo $this->url->get('dashboard'); ?>">Inicio</a></li>
    <li><a href="#">Instructor</a></li>
    <li class="active">Perfil</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo $this->url->get('dash/img/instructor/img/' . $instructor->getImage()); ?>" alt="<?php echo $instructor->getName(); ?>" class="img-circle"/>
            <h4>edgar</h4>
        </div>
    </div>

</div>
