/* Session */
if($("#session").length>=1){
    $('#session').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Es necesaria la dirección de correo electrónico y esta no puede estar vacía'
                    },
                    emailAddress: {
                        message: 'Este campo no contiene una dirección de correo electrónico válida.'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña es necesaria y no puede estar vacía.'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        $("#session-loading").removeClass("hide").addClass("in");
        $("#btn-submit").attr("disabled","disabled").val("Iniciando");
        $("#container-messages").removeClass("hide").addClass("in");
        $.ajax({
            type : "POST",
            url : "/dashboard/login/session",
            data : $(this).serialize(),
            dataType : "json",
            success : function(response){
                if(response.message=="SUCCESS" && response.code==200){
                    window.location = response.url;
                }else if(response.code==300){
                    $("#password-incorrect").removeClass("hide").addClass("in");
                }else if(response.code==400){
                    $("#email-incorrect").removeClass("hide").addClass("in");
                }
                else if(response.code==404){
                    $("#all-incorrect").removeClass("hide").addClass("in");
                }
                $("#session-loading").removeClass("in").addClass("hide");
                $("#btn-submit").removeAttr("disabled","disabled").val("Iniciar");
            },
            error : function(){

            },
            complete : function(){
                setTimeout(function(){
                    $("#password-incorrect").removeClass("in").addClass("hide");
                    $("#email-incorrect").removeClass("in").addClass("hide");
                    $("#all-incorrect").removeClass("in").addClass("hide");
                    $("#container-messages").removeClass("in").addClass("hide");
                },3000);
            }
        });
    });
}

/* New User */
if($("#newUser").length>=1){
    $('#newUser').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'El Nombre es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 4,
                        max: 45,
                        message: 'El nombre debe ser mayor de 4 y menor de 45 caracteres de longitud.'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'El Apellido Paterno es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 4,
                        max: 45,
                        message: 'El Apellido Paterno debe ser mayor de 4 y menor de 45 caracteres de longitud.'
                    }
                }
            },
            sex: {
                validators: {
                    notEmpty: {
                        message: 'El Sexo es un campo necesario y no puede estar vacío.'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Su numero de telefono es necesario y no puede estar vacío.'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Es necesaria la dirección de correo electrónico y esta no puede estar vacía'
                    },
                    emailAddress: {
                        message: 'Este campo no contiene una dirección de correo electrónico válida.'
                    },
                    remote: {
                        message: 'Esta cuenta de correo electrónico ya existe, pruebe con otra',
                        url: '/dashboard/user/validateemail',
                        data: {
                            type: 'email'
                        },
                        type: 'POST'
                    }
                }
            },
            username: {
                message: 'El nombre de usuario no es válido.',
                validators: {
                    notEmpty: {
                        message: 'Se requiere el nombre de usuario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'El nombre de usuario debe ser mayor de 6 y menos de 30 caracteres de longitud.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'El nombre de usuario sólo puede consistir en alfabético, número, puntos o subrayados.'
                    },
                    remote: {
                        message: 'Estae nombre de usuario ya existe, pruebe con otro',
                        url: '/dashboard/user/validateusername',
                        data: {
                            type: 'username'
                        },
                        type: 'POST'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'El campo de contraseña no puede estar vacio'
                    },
                    stringLength: {
                        min: 8,
                        max: 30,
                        message: 'La contraseña debe tener como mínimo 8 caracteres.'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'Las contraseñas no coinciden'
                    }
                }
            },
            cargo: {
                validators: {
                    notEmpty: {
                        message: 'El campo de Cargo es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 4,
                        max: 45,
                        message: 'El campo de Cargo debe ser mayor de 4 y menor de 45 caracteres de longitud.'
                    }
                }
            },
            rol: {
                validators: {
                    notEmpty: {
                        message: 'El usuario necesita tener un rol.'
                    }
                }
            },
            status: {
                validators: {
                    notEmpty: {
                        message: 'El usuario necesita tener un status.'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        $("#btn-submit").attr("disabled","disabled").val("Iniciando");
        $("#message-box-info").toggleClass("open");
        var values = {
            key: $('#key-security').attr('data-key'),
            value: $('#value-security').attr('data-value'),
            uid:$('#uid').attr('data-uid')
        };
        var data = $(this).serialize()+"&"+jQuery.param(values);
        $.ajax({
            type : "POST",
            url : "/dashboard/user/saveuser",
            data : data,
            dataType : "json",
            success : function(response){
                if(response.message=="SUCCESS" && response.code==200){
                    $("#message-box-info").removeClass("open");
                    $("#message-box-success").toggleClass("open");
                    setTimeout(function(){
                        window.location = "/dashboard/users";
                    },3000);
                }else if(response.code==404){
                    $("#message-box-info").removeClass("open");
                    $("#message-box-warning").toggleClass("open");
                    setTimeout(function(){
                        $("#message-box-warning").removeClass("open");
                    },1200);
                    $("#key-security").attr("data-key",response.token.key);
                    $("#value-security").attr("data-value",response.token.value);
                }
            },
            error : function(){
            }
        });
    });
}
if($("#updateProfile").length>=1){
    $('#updateProfile').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'El Nombre es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 4,
                        max: 45,
                        message: 'El nombre debe ser mayor de 4 y menor de 45 caracteres de longitud.'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'El Apellido Paterno es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 4,
                        max: 45,
                        message: 'El Apellido Paterno debe ser mayor de 4 y menor de 45 caracteres de longitud.'
                    }
                }
            },
            sex: {
                validators: {
                    notEmpty: {
                        message: 'El Sexo es un campo necesario y no puede estar vacío.'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Su numero de telefono es necesario y no puede estar vacío.'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Es necesaria la dirección de correo electrónico y esta no puede estar vacía'
                    },
                    emailAddress: {
                        message: 'Este campo no contiene una dirección de correo electrónico válida.'
                    },
                    remote: {
                        message: 'Esta cuenta de correo electrónico ya existe, pruebe con otra',
                        url: '/dashboard/user/validateemail',
                        data: {
                            type: 'email'
                        },
                        type: 'POST'
                    }
                }
            },
            username: {
                message: 'El nombre de usuario no es válido.',
                validators: {
                    notEmpty: {
                        message: 'Se requiere el nombre de usuario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'El nombre de usuario debe ser mayor de 6 y menos de 30 caracteres de longitud.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'El nombre de usuario sólo puede consistir en alfabético, número, puntos o subrayados.'
                    },
                    remote: {
                        message: 'Estae nombre de usuario ya existe, pruebe con otro',
                        url: '/dashboard/user/validateusername',
                        data: {
                            type: 'username'
                        },
                        type: 'POST'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'El campo de contraseña no puede estar vacio'
                    },
                    stringLength: {
                        min: 8,
                        max: 30,
                        message: 'La contraseña debe tener como mínimo 8 caracteres.'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'Las contraseñas no coinciden'
                    }
                }
            },
            cargo: {
                validators: {
                    notEmpty: {
                        message: 'El campo de Cargo es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 4,
                        max: 45,
                        message: 'El campo de Cargo debe ser mayor de 4 y menor de 45 caracteres de longitud.'
                    }
                }
            },
            rol: {
                validators: {
                    notEmpty: {
                        message: 'El usuario necesita tener un rol.'
                    }
                }
            },
            status: {
                validators: {
                    notEmpty: {
                        message: 'El usuario necesita tener un status.'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        $("#message-box-info").toggleClass("open");
        var values = {
            key: $('#key-security').attr('data-key'),
            value: $('#value-security').attr('data-value'),
            uid:$('#uid').attr('data-uid')
        };
        var data = $(this).serialize()+"&"+jQuery.param(values);
        $.ajax({
            type : "POST",
            url : "/dashboard/user/updateuser",
            data : data,
            dataType : "json",
            success : function(response){
                if(response.message=="SUCCESS" && response.code==200){
                    $("#message-box-info").removeClass("open");
                    $("#message-box-success").toggleClass("open");
                    if(response.redirect!="no"){
                        setTimeout(function(){
                            window.location = "profile";
                        },2000);
                    }else{
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                        },2000);
                    }
                    $("#key-security").attr("data-key",response.token.key);
                    $("#value-security").attr("data-value",response.token.value);
                }else if(response.code==404){
                    $("#message-box-warning").toggleClass("open");
                    setTimeout(function(){
                        $("#message-box-warning").removeClass("open");
                    },2000);
                    $("#key-security").attr("data-key",response.token.key);
                    $("#value-security").attr("data-value",response.token.value);
                }
            },
            error : function(){
                alert("Ha ocurrido un problema");
            }
        });
    });
}
/*Courses*/
if($("#newCourse").length>=1){
    $('#newCourse').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'El Titulo es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 10,
                        max: 100,
                        message: 'El titulo debe ser mayor de 10 y menor de 100 caracteres de longitud.'
                    }
                }
            },
            permalink: {
                validators: {
                    notEmpty: {
                        message: 'El Permalink o Url es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 10,
                        max: 100,
                        message: 'El Permalink o Url  debe ser mayor de 10 y menor de 100 caracteres de longitud.'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'El sumario es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 10,
                        max: 100,
                        message: 'La descripción debe ser mayor de 10 y menor de 100 caracteres de longitud.'
                    }
                }
            },
            image: {
                validators: {
                    notEmpty: {
                        message: 'La imagen principal es campo necesario y no puede estar vacío.'
                    }
                }
            },
            "image-1": {
                validators: {
                    notEmpty: {
                        message: 'La imagen principal es campo necesario y no puede estar vacío.'
                    }
                }
            },
            "image-2": {
                validators: {
                    notEmpty: {
                        message: 'La imagen principal es campo necesario y no puede estar vacío.'
                    }
                }
            },
            objective: {
                validators: {
                    notEmpty: {
                        message: 'El objetivo es requerida y no puede estar vacía.'
                    },
                    callback: {
                        message: 'El objetivo debe de tener mas de 100 caracteres.',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            var div  = $('<div/>').html(value).get(0),
                                text = div.textContent || div.innerText;
                            return text.length >= 100;
                        }
                    }
                }
            },
            directed: {
                validators: {
                    notEmpty: {
                        message: 'El campo "Dirigido a" es requerido y no puede estar vacío.'
                    },
                    callback: {
                        message: 'El campo "Dirigido a" debe de tener mas de 100 caracteres.',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            var div  = $('<div/>').html(value).get(0),
                                text = div.textContent || div.innerText;
                            return text.length >= 100;
                        }
                    }
                }
            },
            content: {
                validators: {
                    notEmpty: {
                        message: 'El contenido es requerido y no puede estar vacío.'
                    },
                    callback: {
                        message: 'El contenido debe de tener mas de 200 caracteres.',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            var div  = $('<div/>').html(value).get(0),
                                text = div.textContent || div.innerText;
                            return text.length >= 200;
                        }
                    }
                }
            },
            status: {
                validators: {
                    notEmpty: {
                        message: 'El status es requerida y no puede estar vacio.'
                    }
                }
            },
            category: {
                validators: {
                    notEmpty: {
                        message: 'La categoria es requerida y no puede estar vacía.'
                    }
                }
            },
            duration: {
                validators: {
                    notEmpty: {
                        message: 'La duración es requerida y no puede estar vacía.'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        $("#message-box-info").toggleClass("open");
        var values = {
            key: $('#key-security').attr('data-key'),
            value: $('#value-security').attr('data-value')
        };
        var data = $(this).serialize()+"&"+jQuery.param(values);
        $.ajax({
            type : "POST",
            url : "/dashboard/course/save",
            data : data,
            dataType : "json",
            success : function(response){
                if(response.message=="SUCCESS" && response.code==200){
                    $("#key-security").attr("data-key",response.token.key);
                    $("#value-security").attr("data-value",response.token.value);
                    setTimeout(function(){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                    },1000);
                    setTimeout(function(){
                        window.location = "/dashboard/courses";
                    },3000);
                }else if(response.code==404){
                    $("#message-box-info").removeClass("open");
                    $("#message-box-warning").toggleClass("open");
                    setTimeout(function(){
                        $("#message-box-warning").removeClass("open");
                    },1500);

                }
            },
            error : function(){
                $("#message-box-info").removeClass("open");
                $("#message-box-warning").toggleClass("open");
                setTimeout(function(){
                    $("#message-box-warning").removeClass("open");
                },1500);
            }
        });
    })
    $("#objective").ckeditor().editor.on('change', function(e) {
        $('#newCourse').formValidation('revalidateField', 'objective');
    });
    $("#directed").ckeditor().editor.on('change', function(e) {
        $('#newCourse').formValidation('revalidateField', 'directed');
    });
    $("#content").ckeditor().editor.on('change', function(e) {
        $('#newCourse').formValidation('revalidateField', 'content');
    });
    $("#cid").select2({
        maximumSelectionLength:1,
        placeholder: "Categoría"
    });
}
if($("#editCourse").length>=1){
    $('#editCourse').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'El Titulo es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 10,
                        max: 100,
                        message: 'El titulo debe ser mayor de 10 y menor de 100 caracteres de longitud.'
                    }
                }
            },
            permalink: {
                validators: {
                    notEmpty: {
                        message: 'El Permalink o Url es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 10,
                        max: 100,
                        message: 'El Permalink o Url  debe ser mayor de 10 y menor de 100 caracteres de longitud.'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'El sumario es necesario y no puede estar vacío.'
                    },
                    stringLength: {
                        min: 10,
                        max: 100,
                        message: 'La descripción debe ser mayor de 10 y menor de 100 caracteres de longitud.'
                    }
                }
            },
            image: {
                validators: {
                    notEmpty: {
                        message: 'La imagen principal es campo necesario y no puede estar vacío.'
                    }
                }
            },
            "image-1": {
                validators: {
                    notEmpty: {
                        message: 'La imagen principal es campo necesario y no puede estar vacío.'
                    }
                }
            },
            "image-2": {
                validators: {
                    notEmpty: {
                        message: 'La imagen principal es campo necesario y no puede estar vacío.'
                    }
                }
            },
            objective: {
                validators: {
                    notEmpty: {
                        message: 'El objetivo es requerida y no puede estar vacía.'
                    },
                    callback: {
                        message: 'El objetivo debe de tener mas de 100 caracteres.',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            var div  = $('<div/>').html(value).get(0),
                                text = div.textContent || div.innerText;
                            return text.length >= 100;
                        }
                    }
                }
            },
            directed: {
                validators: {
                    notEmpty: {
                        message: 'El campo "Dirigido a" es requerido y no puede estar vacío.'
                    },
                    callback: {
                        message: 'El campo "Dirigido a" debe de tener mas de 100 caracteres.',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            var div  = $('<div/>').html(value).get(0),
                                text = div.textContent || div.innerText;
                            return text.length >= 100;
                        }
                    }
                }
            },
            content: {
                validators: {
                    notEmpty: {
                        message: 'El contenido es requerido y no puede estar vacío.'
                    },
                    callback: {
                        message: 'El contenido debe de tener mas de 200 caracteres.',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            var div  = $('<div/>').html(value).get(0),
                                text = div.textContent || div.innerText;
                            return text.length >= 200;
                        }
                    }
                }
            },
            status: {
                validators: {
                    notEmpty: {
                        message: 'El status es requerida y no puede estar vacio.'
                    }
                }
            },
            category: {
                validators: {
                    notEmpty: {
                        message: 'La categoria es requerida y no puede estar vacía.'
                    }
                }
            },
            duration: {
                validators: {
                    notEmpty: {
                        message: 'La duración es requerida y no puede estar vacía.'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        $("#message-box-info").toggleClass("open");
        var values = {
            key: $('#key-security').attr('data-key'),
            value: $('#value-security').attr('data-value')
        };
        var data = $(this).serialize()+"&"+jQuery.param(values);
        $.ajax({
            type : "POST",
            url : "/dashboard/course/update",
            data : data,
            dataType : "json",
            success : function(response){
                if(response.message=="SUCCESS" && response.code==200){
                    $("#key-security").attr("data-key",response.token.key);
                    $("#value-security").attr("data-value",response.token.value);
                    setTimeout(function(){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                    },1000);
                    setTimeout(function(){
                        $("#message-box-success").removeClass("open");
                    },3000);
                }else if(response.code==404){
                    $("#message-box-info").removeClass("open");
                    $("#message-box-warning").toggleClass("open");
                    setTimeout(function(){
                        $("#message-box-warning").removeClass("open");
                    },1500);

                }
            },
            error : function(){
                $("#message-box-info").removeClass("open");
                $("#message-box-warning").toggleClass("open");
                setTimeout(function(){
                    $("#message-box-warning").removeClass("open");
                },1500);
            }
        });
    })
    $("#objective").ckeditor().editor.on('change', function(e) {
        $('#newCourse').formValidation('revalidateField', 'objective');
    });
    $("#directed").ckeditor().editor.on('change', function(e) {
        $('#newCourse').formValidation('revalidateField', 'directed');
    });
    $("#content").ckeditor().editor.on('change', function(e) {
        $('#newCourse').formValidation('revalidateField', 'content');
    });
    $("#cid").select2({
        maximumSelectionLength:1,
        placeholder: "Categoría"
    });
}
if($("#url-title").length>=1){
    $("#url-title").change(function(){
        var $input_loader = $("#input-loader");
        $input_loader.removeClass("hide fade");
        var title_note = $(this).val();
        $.ajax({
            url : "/dashboard/course/validateurl",
            type : "POST",
            data : {name:title_note,key: $('#key-security').attr('data-key'),value: $('#value-security').attr('data-value')},
            dataType : "json",
            success : function(response){
                if(response.message=="SUCCESS" && response.code==200){
                    $("#note-permalink").val(response.new_url);
                    $('#newCourse').formValidation('revalidateField', 'permalink');
                    $("#key-security").attr("data-key",response.token.key);
                    $("#value-security").attr("data-value",response.token.value);
                    $input_loader.addClass("hide fade");
                }else{
                    $input_loader.addClass("hide fade");
                    alert("Ha ocurrido un error intente nuevamente.");
                }
            },
            complete: function(){
                $input_loader.addClass("hide fade");
            },error : function(){
                $input_loader.addClass("hide fade");
                alert("Ha ocurrido un error intente nuevamente.");
            }
        });
    });
}

/*Categories*/
if($("#newCategory").length>=1){
    $('#newCategory').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name_category: {
                validators: {
                    notEmpty: {
                        message: 'Este campo es necesario y no puede estar vacío.'
                    },
                    remote: {
                        message: 'Esta categoría ya existe, pruebe con otra',
                        url: '/dashboard/category/validatecategory',
                        type: 'POST'
                    }
                }
            },
            confirmCategory: {
                validators: {
                    identical: {
                        field: 'name_category',
                        message: 'La categoría no coincide.'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        $("#message-box-info").toggleClass("open");
        var values = {
            key: $('#key-security').attr('data-key'),
            value: $('#value-security').attr('data-value')
        };
        var data = $(this).serialize()+"&"+jQuery.param(values);
        $.ajax({
            type : "POST",
            url : "/dashboard/category/new",
            data : data,
            dataType : "json",
            success : function(response){
                if(response.message=="SUCCESS" && response.code==200){
                    $("#key-security").attr("data-key",response.token.key);
                    $("#value-security").attr("data-value",response.token.value);
                    setTimeout(function(){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                        $("#modal_basic").modal('hide');
                    },1500);
                    setTimeout(function(){
                        $("#message-box-success").removeClass("open");
                    },4000);
                    $("#tableCategory tbody").append("<tr id='"+response.result.id+"'><td class='nameCategory'>"+response.result.name+"</td><td class='optionsCtg'><a href='#' data-namec='"+response.result.name+"' data-cgid='"+response.result.id+"' class='btn btn-default btn-rounded btn-sm btn-edit'><span class='fa fa-pencil'></span></a><button class='btn btn-danger btn-rounded btn-sm deleteCg' data-namec='"+response.result.name+"' data-cgid='"+response.result.id+"'><span class='fa fa-times'></span></button></td>").fadeIn(1000);
                    resetForm($("#newCategory"));
                }else if(response.code==404){
                    $("#message-box-info").removeClass("open");
                    $("#message-box-warning").toggleClass("open");
                    setTimeout(function(){
                        $("#message-box-warning").removeClass("open");
                    },1500);
                }
            },
            error : function(){
                alert("Ha ocurrido un error");
                $("#message-box-info").removeClass("open");
            }
        });
    });
    $('#modal_basic').on('shown.bs.modal', function() {
        $('#newCategory').formValidation('resetForm', true);
    });
}
if($("#edit_category").length>=1){
    var $this = null;
    var cgid,nameCg;
    $(document.body).on("click","#tableCategory tbody a.btn-edit",function(e){
        e.preventDefault();
        $this = $(this);
        cgid = $this.attr("data-cgid");
        nameCg = $this.attr("data-namec");
        $('#edit_category').modal();
        $("#nameCtg").val(nameCg);
    });
    $('#editCategory').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name_category: {
                validators: {
                    notEmpty: {
                        message: 'Este campo es necesario y no puede estar vacío.'
                    },
                    remote: {
                        message: 'Esta categoría ya existe, pruebe con otra',
                        url: '/dashboard/category/validatecategory',
                        type: 'POST'
                    }
                }
            },
            confirmCategory: {
                validators: {
                    identical: {
                        field: 'name_category',
                        message: 'La categoría no coincide.'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        $("#message-box-info").toggleClass("open");
        var values = {
            key: $('#key-security').attr('data-key'),
            value: $('#value-security').attr('data-value'),
            id :cgid
        };
        var data = $(this).serialize()+"&"+jQuery.param(values);
        $.ajax({
            type : "POST",
            url : "/dashboard/category/edit",
            data : data,
            dataType : "json",
            success : function(response){
                if(response.message=="SUCCESS" && response.code==200){
                    $("#key-security").attr("data-key",response.token.key);
                    $("#value-security").attr("data-value",response.token.value);
                    setTimeout(function(){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                        $("#edit_category").modal("hide");
                    },1500);
                    setTimeout(function(){
                        $("#message-box-success").removeClass("open");
                    },4000);
                    $("#tableCategory tbody tr#"+cgid+" .nameCategory").text(response.result.name);
                    $("#tableCategory tbody tr#"+cgid+" .optionsCtg a").attr('data-namec',response.result.name);
                    resetForm($("#editCategory"));
                }else if(response.code==404){
                    $("#message-box-info").removeClass("open");
                    $("#message-box-warning").toggleClass("open");
                    setTimeout(function(){
                        $("#message-box-warning").removeClass("open");
                    },1500);
                }
            },
            error : function(){
                $("#message-box-warning").toggleClass("open");
                setTimeout(function(){
                    $("#message-box-warning").removeClass("open");
                },1500);
            }
        });
    });
    $('#edit_category').on('shown.bs.modal', function() {
        $('#editCategory').formValidation('resetForm', true);
    });
}
if($(".deleteCg").length>=1){
    var nameCg,cid;
    $(document.body).on("click","#tableCategory tbody button.deleteCg",function(e){
        e.preventDefault();
        $this = $(this);
        cid = $this.attr("data-cgid");
        nameCg = $this.attr("data-namec");
        $("#cgValue").text(nameCg);
        $("#deleteCg").modal("show");
    })
    $("#deleteCg").submit(function(){
        $("#message-box-info").toggleClass("open");
        $.ajax({
            type : "POST",
            url : "/dashboard/category/delete",
            data : {id:cid,key: $('#key-security').attr('data-key'),value: $('#value-security').attr('data-value')},
            dataType : "json",
            success : function(response){
                if(response.message=="SUCCESS" && response.code==200){
                    $("#message-box-info").removeClass("open");
                    $("#message-box-success").toggleClass("open");
                    setTimeout(function(){
                        $("#message-box-success").removeClass("open");
                        $("#deleteCg").modal('hide');
                    },3000);
                    $("#"+cid).hide("slow",function(){
                        $(this).remove();
                    });
                    $("#key-security").attr("data-key",response.token.key);
                    $("#value-security").attr("data-value",response.token.value);
                }else if(response.code==404){
                    $("#message-box-info").removeClass("open");
                    $("#message-box-warning").toggleClass("open");
                    setTimeout(function(){
                        $("#message-box-warning").removeClass("open");
                    },3000);
                }
            },
            error : function(){
                $("#message-box-info").removeClass("open");
                $("#message-box-warning").toggleClass("open");
                setTimeout(function(){
                    $("#message-box-warning").removeClass("open");
                },3000);
            }
        });
        return false;
    })
}

/*Ckeditor*/
if($("#objective").length>=1){
    $( 'textarea.ckeditor' ).ckeditor();
}

/* Functions */
function resetForm($form) {
    $form.find('input:text, input:password, input:file, input[type=email], select, textarea').val('');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}