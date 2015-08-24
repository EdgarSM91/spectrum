<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{url('dashboard')}}">Inicio</a></li>
    <li><a href="#">Usuarios</a></li>
</ul>
<!-- END BREADCRUMB -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-title">Usuarios Inactivos</h4>
        </div>
    </div>
</div>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row" id="manzory">
        {% for user in users%}
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body profile" style="background: url('{{url('dash/assets/images/gallery/music-4.jpg')}}') center center no-repeat;">
                    <div class="profile-image">
                        <img src="/dash/assets/images/users/thumbnail/{{user.getPhoto()}}" alt="Imagen Perfil"/>
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
                        <div class="col-md-12">
                            <a href="#" class="list-group-item text-center">{{user.getName()~" "~user.getLastName()~" "~user.getSecondName()}}</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body list-group border-bottom">
                    <a href="#" class="list-group-item active"><span class="fa fa-bar-chart-o"></span> Actividad</a>
                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> Estatus
                        <?php switch($user->getStatus()){
                            case "ACTIVE": echo '<span class="badge badge-info">ACTIVO</span>';break;
                            case "INACTIVE": echo '<span class="badge badge-warning">INACTIVO</span>';break;
                            case "LOCKED": echo '<span class="badge badge-danger">BLOQUEADO</span>';break;
                        }?>
                    </a>
                    <a href="{{url('dashboard/user/edit/'~user.getUid())}}" class="list-group-item"><span class="fa fa-cog"></span> Administración editar</a>
                </div>
            </div>
        </div>
        {%endfor%}
    </div>

</div>