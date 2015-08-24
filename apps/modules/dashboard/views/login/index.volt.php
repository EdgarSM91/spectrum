<div class="login-container">
    <div class="login-box animated fadeInDown">
        <div class="login-logo"></div>
        <div class="login-body">
            <div class="login-title text-center"><strong>Iniciar Sesión</strong> Ingresar a su cuenta</div>
            <form id="session" action="" class="form-horizontal" method="post">
                <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>" value="<?php echo $this->security->getToken() ?>"/>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="email" class="form-control" placeholder="E-mail" name="email" required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" class="form-control" placeholder="Contraseña" name="password" required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button class="btn btn-success btn-block">Iniciar Sesión</button>
                    </div>
                    <!--Messages-->
                    <i id="session-loading" class="fa fa-spinner fa-spin fade hide" style="font-size: 22px;"></i>
                </div>
                <div class="form-group fade hide" id="container-messages">
                    <div class="alert alert-warning fade hide" role="alert" id="email-incorrect">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                        <strong>Email incorrecto.</strong>
                    </div>
                    <div class="alert alert-warning fade hide" role="alert" id="password-incorrect">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <strong>Contraseña incorrecta.</strong>
                    </div>
                    <div class="alert alert-warning fade hide" role="alert" id="all-incorrect">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <strong>Email o contraseña incorrecto</strong>
                    </div>
                    <!--End Mesages-->
                </div>
            </form>
        </div>
        <div class="login-footer">
            <div class="pull-left">
                &copy; 2015 <a href="http://www.c-developers.com">Chontal Developers</a>
            </div>
            <div class="pull-right">
                <a href="#">Privacidad</a> |
                <a href="#">Contactanos</a>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="background" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="content-fa">
            <h5 id="new_account" class="account">Creando su cuenta, por favor espere....</h5>
            <h5 id="success_account" class="hide account">Se ha registrado correctamente,se le redireccionara a su ue.</h5>
            <h5 id="fail_account" class="hide account">Ha ocurrio un error, intente nuevamente o mas tarde.</h5>
            <h1><i class="fa fa-circle-o-notch fa-spin style-fa"></i></h1>
        </div>
    </div>
</div>