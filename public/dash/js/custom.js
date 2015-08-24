$(document).ready(function(){


/* Update Profile */

/* Change Password */
    if($("#updatePassword").length>=1){
        $('#updatePassword').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                confirmPassword: {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'Las contraseñas no coinciden'
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
                url : "/dashboard/user/updatepassword",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#key-security").attr("data-key",response.token.key);
                        $("#value-security").attr("data-value",response.token.value);
                        setTimeout(function(){
                            $("#message-box-info").removeClass("open");
                            $("#message-box-success").toggleClass("open");
                        },1500);
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                            $("#modal_basic").modal('hide');
                        },4000);
                    }else if(response.code==404){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-warning").toggleClass("open");
                    }
                },
                error : function(){
                }
            });
        });
    }
/* Change User Upload Image*/
    if($("#dropzone-user-edit").length>=1){
        $("#save-image").click(function(e){
            $("#btn-submit").attr("disabled","disabled").val("Iniciando");
            $("#message-box-info").toggleClass("open");
            var values = {
                uid:$('#uid').attr('data-uid')
            };
            var data = $("form[name=dropzone-user-edit]").serialize()+"&"+jQuery.param(values);
            $.ajax({
                type : "POST",
                url : "/dashboard/user/updateuserimage",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        setTimeout(function(){
                            $("#message-box-info").removeClass("open");
                            $("#message-box-success").toggleClass("open");
                        },1500);
                        setTimeout(function(){
                            window.location = "profile";
                        },4000);
                    }else if(response.message=="warning" && response.code==303){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-danger").toggleClass("open");
                    }else if(response.code==404){
                        $("#message-box-warning").toggleClass("open");
                    }
                },
                error : function(){
                }
            });
        })
    }
/* Change updateSocialMedia */
    if($("#updateSocialMedia").length>=1){
        $('#updateSocialMedia').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                facebook: {
                    validators: {
                        notEmpty: {
                            message: 'Su nombre de usuario en facebook es necesario y no puede estar vacío.'
                        },
                        stringLength: {
                            min: 3,
                            max: 100,
                            message: 'Su nombre de usuario en facebook debe ser mayor de 3 caracteres de longitud.'
                        }
                    }
                },
                twitter: {
                    validators: {
                        notEmpty: {
                            message: 'Su nombre de usuario en facebook es necesario y no puede estar vacío.'
                        },
                        stringLength: {
                            min: 3,
                            max: 45,
                            message: 'Su nombre de usuario en facebook debe ser mayor de 3 caracteres de longitud.'
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
                url : "/dashboard/user/socialmedia",
                data : data,
                dataType : "json",
                success : function(response){
                    $("#key-security").attr("data-key",response.token.key);
                    $("#value-security").attr("data-value",response.token.value);
                    if(response.message=="SUCCESS" && response.code==200){
                        setTimeout(function(){
                            $("#message-box-info").removeClass("open");
                            $("#message-box-success").toggleClass("open");
                        },1500);
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                        },4000);
                    }else if(response.code==404){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-warning").toggleClass("open");
                    }
                },
                error : function(){
                }
            });
        });
    }
/* Personal Information */

/* Update Note */
    if($("#updateNote").length>=1){
        (function($){
            $.fn.datepicker.dates['es'] = {
                days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
                daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
                daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                today: "Hoy",
                clear: "Borrar",
                weekStart: 1,
                format: "dd/mm/yyyy"
            };
        }(jQuery));
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language : "es",
            autoclose:true
        })
            .on('changeDate', function(e) {
                $('#newNote').formValidation('revalidateField', 'dateP');
            });
        $('#updateNote').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                title: {
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
                descriptionI: {
                    validators: {
                        stringLength: {
                            min: 10,
                            max: 50,
                            message: 'La descripción de la imagen  debe ser mayor de 10 y menor de 100 caracteres de longitud.'
                        }
                    }
                },
                dateP: {
                    validators: {
                        notEmpty: {
                            message: 'La fecha es necesaría'
                        },
                        date: {
                            format: 'DD/MM/YYYY',
                            message: 'El formato de fecha introducido no es valido'
                        }
                    }
                },
                image_principal: {
                    validators: {
                        notEmpty: {
                            message: 'La imagen principal es campo necesario y no puede estar vacío.'
                        }
                    }
                },
                summary: {
                    validators: {
                        notEmpty: {
                            message: 'El sumario es necesario y no puede estar vacío.'
                        },
                        stringLength: {
                            min: 10,
                            max: 100,
                            message: 'El sumario debe ser mayor de 10 y menor de 100 caracteres de longitud.'
                        }
                    }
                },
                content: {
                    validators: {
                        callback: {
                            message: 'The content is required and cannot be empty',
                            callback: function(value, validator, $field) {
                                var code = $('[name="content"]').code();
                                return (code !== '' && code !== '<p><br></p>');
                            }
                        }
                    }
                },
                status: {
                    validators: {
                        notEmpty: {
                            message: 'El status no puede estar vacio.'
                        }
                    }
                },
                category: {
                    validators: {
                        notEmpty: {
                            message: 'La categoria no puede estar vacio.'
                        }
                    }
                },
                subcategory: {
                    validators: {
                        notEmpty: {
                            message: 'La subcategory no puede estar vacio.'
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
                content:CKEDITOR.instances.summernote.getData()
            };
            var data = $(this).serialize()+"&"+jQuery.param(values);
            $.ajax({
                type : "POST",
                url : "updatenote",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                        $("#key-security").attr("data-key",response.key);
                        $("#value-security").attr("data-value",response.value);
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                        },3000);
                    }else if(response.code==404){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-warning").toggleClass("open");
                    }
                },
                error : function(){
                    $("#message-box-info").removeClass("open");
                }
            });
        });
        $("#cid").select2({
            maximumSelectionLength:1,
            placeholder: "Categoría"
        });
        $("#scid").select2({
            maximumSelectionLength:1,
            placeholder: "Selecciona la subcategoría"
        }).focus();
        $('#cid').on("select2:select", function(response) {
            var category = response.target.value;
            $.ajax({
                data : {category:category},
                url : "/dashboard/notes/category",
                type : "POST",
                dataType : "json",
                success:function(response){
                    if(response.code==200){
                        $("#select-scid").parent().removeClass("hide");
                        var sel = $("select[name='subcategory']");
                        for (value in response.result){
                            sel.append($("<option class='options'>").attr('value',value).text(response.result[value]));
                        }
                        $("#scid").select2({
                            maximumSelectionLength:1,
                            placeholder: "Selecciona la subcategoría"
                        }).focus();
                    }
                }
            });
        });
        $('#cid').on("select2:unselect",function(){
            $("#scid").select2('val',"");
            $('form[name="updateNote"]').formValidation('revalidateField','subcategory');
            $("#select-scid #scid").find(".options").remove();
        });
    }
/* Sections */
    if($("#principalNewForm").length>=1){
        getSection($("#ajax-post"),"Noticia importante",$("#category").data("value"),"principal","");
        $('form[name=principalNewForm]').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                principalNew: {
                    validators: {
                        notEmpty: {
                            message: 'Este campo es necesario y no puede estar vacío.'
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
                type : "principal",
                pidLast : $("#pidLast").val(),
                cgid : $("#cgid").val()
            };
            var data = $(this).serialize()+"&"+jQuery.param(values);
            $.ajax({
                type : "POST",
                url : "/dashboard/sections/updatesection",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#pidLast").val(response.pid);
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                        },3000);
                        $("#key-security").attr("data-key",response.token.key);
                        $("#value-security").attr("data-value",response.token.value);
                        $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                    }else if(response.code==404){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-warning").toggleClass("open");
                        $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                    }
                },
                error : function(){
                    $("#message-box-info").removeClass("open");
                }
            });
        });
    }

    if($(".SliderNewForm").length>=1){
        var category = $("#category").data("value");
        var pid = $("#ajax-post").val();
        getSection($("#ajax-post-slider-1"),"Nota principal Slider",category,"slider",pid);
        getSection($("#ajax-post-slider-2"),"Segunada nota Slider",category,"slider",pid);
        getSection($("#ajax-post-slider-3"),"Tercera nota Slider",category,"slider",pid);
        getSection($("#ajax-post-slider-4"),"Cuarta nota Slider",category,"slider",pid);
        $("#section-positions").tableDnD({
            onDragClass: "drag-drop",
            onDragStart: function(table, row) {
                start = row.id.split("/");
            },
            onDrop: function(table, row) {
                var idTr = row.id;
                orders = $.tableDnD.serialize();
                var rows = table.tBodies[0].rows;
                for (var i=0; i<rows.length; i++) {
                    result = i+1;
                    split = rows[i].id.split("/");
                    if(split[0]==start[0]){
                        SetOrderSections($("#"+idTr+"").data("post"),result,$("#cgid").val());
                        //SetOrder(split[0],$("#pnid").val(),result)
                    }
                }

            }
        });
    }
    if($("#homeNewForm").length>=1){
        getSection($("#ajax-post"),"Nota importante inicio","home","home","");
        $('form[name=principalNewForm]').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                principalNew: {
                    validators: {
                        notEmpty: {
                            message: 'Este campo es necesario y no puede estar vacío.'
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
                type : "home",
                pidLast : $("#pidLast").val(),
                cgid : $("#cgid").val()
            };
            var data = $(this).serialize()+"&"+jQuery.param(values);
            $.ajax({
                type : "POST",
                url : "/dashboard/sections/updatesection",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#pidLast").val(response.pid);
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                        },3000);
                        $("#key-security").attr("data-key",response.token.key);
                        $("#value-security").attr("data-value",response.token.value);
                        $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                    }else if(response.code==404){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-warning").toggleClass("open");
                        $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                    }
                },
                error : function(){
                    $("#message-box-info").removeClass("open");
                    $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                }
            });
        });
    }
/* Sections */

/* Category */
    if($("#newSubCategory").length>=1){
        $('#newSubCategory').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                subcategoryname: {
                    validators: {
                        notEmpty: {
                            message: 'Este campo es necesario y no puede estar vacío.'
                        },
                        remote: {
                            message: 'Esta categoría ya existe, pruebe con otra',
                            url: '/dashboard/category/validatesubcategory',
                            data : {
                                id:$("#cgid").val()
                            },
                            type: 'POST'
                        }
                    }
                },
                confirmCategory: {
                    validators: {
                        identical: {
                            field: 'subcategoryname',
                            message: 'La categoría no coincide.'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            $(".btn-submit").attr("disabled","disabled").val("Iniciando");
            $("#message-box-info").toggleClass("open");
            var values = {
                key: $('#key-security').attr('data-key'),
                value: $('#value-security').attr('data-value'),
            };
            var data = $(this).serialize()+"&"+jQuery.param(values);
            $.ajax({
                type : "POST",
                url : "/dashboard/category/newsubcategory",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#key-security").attr("data-key",response.token.key);
                        $("#value-security").attr("data-value",response.token.value);
                        setTimeout(function(){
                            $("#message-box-info").removeClass("open");
                            $("#message-box-success").toggleClass("open");
                        },1500);
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                            $("#modal_basic").modal('hide');
                        },4000);
                        $("#tableSubCategory tbody").append("<tr id='"+response.result.id+"'><td>"+response.result.name+"</td><td><a href='#' data-namec='"+response.result.name+"' data-cgid='"+response.result.id+"' class='btn btn-default btn-rounded btn-sm btn-edit'><span class='fa fa-pencil'></span></a><button class='btn btn-danger btn-rounded btn-sm' onclick='delete_subcategory("+response.result.id+")'><span class='fa fa-times'></span></button></td></tr>").fadeIn(1000);;
                        $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                        resetForm($("#newSubCategory"));
                    }else if(response.code==404){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-warning").toggleClass("open");
                        $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                    }
                },
                error : function(){
                    $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                }
            });
        });
        $('#modal_basic').on('shown.bs.modal', function() {
            $('#newSubCategory').formValidation('resetForm', true);
        });
    }
    if($("#edit_subcategory").length>=1){
        $("table#tableSubCategory tbody").on("click","tr td a.btn-edit",function(){
            $this = $(this);
            $('#edit_subcategory').modal();
            $("#edit_subcategory #nameCtg").val($this.data("namec"));
        });
        var $this = null;
        $('#editSubCategory').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                subcategoryname: {
                    validators: {
                        notEmpty: {
                            message: 'Este campo es necesario y no puede estar vacío.'
                        },
                        remote: {
                            message: 'Esta categoría ya existe, pruebe con otra',
                            url: '/dashboard/category/validatesubcategory',
                            data : {
                                id:$("#cgid").val()
                            },
                            type: 'POST'
                        }
                    }
                },
                confirmCategory: {
                    validators: {
                        identical: {
                            field: 'subcategoryname',
                            message: 'La categoría no coincide.'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            $(".btn-submit").attr("disabled","disabled").val("Iniciando");
            $("#message-box-info").toggleClass("open");
            var values = {
                key: $('#key-security').attr('data-key'),
                value: $('#value-security').attr('data-value'),
                id :$this.data("cgid")
            };
            var data = $(this).serialize()+"&"+jQuery.param(values);
            $.ajax({
                type : "POST",
                url : "/dashboard/category/editsubcategory",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#key-security").attr("data-key",response.token.key);
                        $("#value-security").attr("data-value",response.token.value);
                        $("#edit_subcategory").modal("hide");
                        setTimeout(function(){
                            $("#message-box-info").removeClass("open");
                            $("#message-box-success").toggleClass("open");
                        },1500);
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                        },4000);
                        $("#tableSubCategory tbody tr#"+$this.data("cgid")+" .nameCategory").text(response.result.name);
                        $("#tableSubCategory tbody tr#"+$this.data("cgid")+" td a.btn-edit").data("namec",response.result.name);
                        $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                        resetForm($("#editSubCategory"));
                    }else if(response.code==404){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-warning").toggleClass("open");
                        $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                    }
                },
                error : function(){
                    $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                }
            });
        });
        $('#edit_subcategory').on('shown.bs.modal', function() {
            $('#editSubCategory').formValidation('resetForm', true);
        });
    }
    function getSection($selector,$placeholder,$category,$type,$pid){
        var result ;
        $selector.select2({
            ajax: {
                url: "/dashboard/sections/feedPost",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q:params.term,
                        category:$category,
                        type : $type,
                        pid : $pid
                    };
                },
                processResults: function (data, page) {
                    return {
                        results: $.map(data, function (item,key) {
                            result = {"value":item,"pid":key}
                            return {
                                text: item,
                                id: key
                            }

                        })
                    };
                }
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            placeholder: $placeholder
        });
        $selector.on("change",function(e){
            console.log($selector.selector);
            console.log($selector.val());
            if($selector.selector!="#ajax-post"){
                var theID = $selector.val();
                save_sections(theID,$selector.data("order"),$selector.data("last"),$selector.data("cgid"));
            }

        });
    }
/* Tags */
    if($("#newTagB").length>=1){
        $("#newTagB").click(function(e){
            e.preventDefault();
            $("#myTag").modal("show");
        });
        $('#form-tag').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                newTag: {
                    validators: {
                        notEmpty: {
                            message: 'El campo del Tag no puede estar vacio'
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: 'El Tag debe tener como mínimo 3 caracteres.'
                        },
                        remote: {
                            message: 'Esta tag ya existe, pruebe con otro',
                            url: '/dashboard/tags/validatetag',
                            data: {
                                type: 'tag'
                            },
                            type: 'POST'
                        }
                    }
                },
                rTag: {
                    validators: {
                        identical: {
                            field: 'newTag',
                            message: 'Los nombre de los Tags no coinciden'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            $("#btn-submit").attr("disabled","disabled").val("Guardando");
            $("#message-box-info").toggleClass("open");
            var values = {
                key: $('#key-security').attr('data-key'),
                value: $('#value-security').attr('data-value')
            };
            var data = $(this).serialize()+"&"+jQuery.param(values);
            $.ajax({
                type : "POST",
                url : "/dashboard/tags/save",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                        $("#key-security").attr("data-key",response.key);
                        $("#value-security").attr("data-value",response.value);
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                            $("#myTag").modal('hide');
                        },3000);
                        var sel = $("select[name='tag[]']");
                        sel.append($("<option class='options'>").attr('value',response.tag['id']).text(response.tag['name']));
                        $("#tid.selectM").select2({
                            placeholder:$("#tid.selectM").data('placeholder')
                        }).focus();
                        resetForm($("#form-tag"));
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
                }
            });
        });
    }
    if($("#newTagCategory").length>=1){
        $("#newTagCategory").click(function(e){
            e.preventDefault();
            $("#myTag").modal("show");
        });
        $('#form-tag').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                newTag: {
                    validators: {
                        notEmpty: {
                            message: 'El campo del Tag no puede estar vacio'
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: 'El Tag debe tener como mínimo 3 caracteres.'
                        },
                        remote: {
                            message: 'Esta tag ya existe, pruebe con otro',
                            url: '/dashboard/tags/validatetag',
                            data: {
                                type: 'tag'
                            },
                            type: 'POST'
                        }
                    }
                },
                rTag: {
                    validators: {
                        identical: {
                            field: 'newTag',
                            message: 'Los nombre de los Tags no coinciden'
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
                url : "/dashboard/tags/save",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                        $("#key-security").attr("data-key",response.key);
                        $("#value-security").attr("data-value",response.value);
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                            $("#myTag").modal('hide');
                        },3000);
                        $("#tableTag tbody").append("<tr id='"+response.tag.id+"'><td class='nameTag'>"+response.tag.name+"</td><td class='nameCategory'>"+response.tag.category+"</td><td class='optionsTag'><a href='#' data-namet='"+response.tag.name+"' data-tid='"+response.tag.id+"' class='btn btn-default btn-rounded btn-sm btn-edit'><span class='fa fa-pencil'></span></a><button class='btn btn-danger btn-rounded btn-sm deleteTag' data-namet='"+response.tag.name+"' data-id='"+response.tag.id+"'><span class='fa fa-times'></span></button></td></tr>").fadeIn(1000);;
                        resetForm($("#form-tag"));
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
                }
            });
        });
    }
    if($(".deleteTag").length>=1){
        var nameTag,Tid;
        $(document.body).on("click","#tableTag tbody button.deleteTag",function(e){
            e.preventDefault();
            $this = $(this);
            Tid = $this.attr("data-id");
            nameTag = $this.attr("data-namet");
            $("#tagValue").text(nameTag);
            $("#deletedTag").modal("show");
        })
        $("#delete-tag").submit(function(){
            $("#message-box-info").toggleClass("open");
            $.ajax({
                type : "POST",
                url : "/dashboard/tags/delete",
                data : {id:Tid,key: $('#key-security').attr('data-key'),value: $('#value-security').attr('data-value')},
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                            $("#deletedTag").modal('hide');
                        },3000);
                        $("#"+Tid).hide("slow",function(){
                            $(this).remove();
                        });
                        $("#key-security").attr("data-key",response.key);
                        $("#value-security").attr("data-value",response.value);
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
                }
            });
            return false;
        })
    }
    if($(".btn-edit").length>=1){
        var $this = null;
        var nameTag,Tid;
        $(document.body).on("click","#tableTag tbody a.btn-edit",function(e){
            e.preventDefault();
            $this = $(this);
            Tid = $this.attr("data-tid");
            nameTag = $this.attr("data-namet");
            $('#edit_tag').modal();
            $("#nameTag").val(nameTag);
        });
        $('#editTag').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nameTag: {
                    validators: {
                        notEmpty: {
                            message: 'El campo del Tag no puede estar vacio'
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: 'El Tag debe tener como mínimo 3 caracteres.'
                        },
                        remote: {
                            message: 'Esta tag ya existe, pruebe con otro',
                            url: '/dashboard/tags/validatetag',
                            data: {
                                type: 'tag'
                            },
                            type: 'POST'
                        }
                    }
                },
                rTag: {
                    validators: {
                        identical: {
                            field: 'nameTag',
                            message: 'Los nombre de los Tags no coinciden'
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
                id :Tid
            };
            var data = $(this).serialize()+"&"+jQuery.param(values);
            $.ajax({
                type : "POST",
                url : "/dashboard/tags/edit",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                            $("#edit_tag").modal('hide');
                        },3000);

                        $("#tableTag tbody tr#"+Tid+" .nameTag").text(response.tag.name);
                        $("#tableTag tbody tr#"+Tid+" .optionsTag a").attr('data-namet',response.tag.name);

                        $("#key-security").attr("data-key",response.key);
                        $("#value-security").attr("data-value",response.value);
                        resetForm($("#editTag"));
                    }else if(response.code==404){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-warning").toggleClass("open");
                        setTimeout(function(){
                            $("#message-box-warning").removeClass("open");
                        },3000);
                    }
                },
                error : function(){
                    $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Guardar");
                }
            });
        });
        $('#edit_category').on('shown.bs.modal', function() {
            $('#editCategory').formValidation('resetForm', true);
        });
    }
/* General select2 */
    if($(".selectM").length>=1){
        $(".selectM").select2({
            placeholder: $(".selectM").data("placehorder")
        });
    }
    if($(".selectU").length>=1){
        $(".selectU").select2({
            maximumSelectionLength:1,
            placeholder: $(".selectU").data("placehorder")
        });
    }
});
function save_sections(pid,order,last,cgid){
    var values = {
        key: $('#key-security').attr('data-key'),
        value: $('#value-security').attr('data-value'),
        type : "slider",
        pid : parseInt(pid),
        order : order,
        last : last,
        cgi :cgid
    };
    $.ajax({
        type : "POST",
        url : "/dashboard/sections/updatesection",
        data : values,
        dataType : "json",
        success : function(response){
            if(response.message=="SUCCESS" && response.code==200){
                $("#"+response.order+"").attr("data-post",response.pid);
                $("#message-box-success").toggleClass("open");
                setTimeout(function(){
                    $("#message-box-success").removeClass("open");
                },500);
                $("#key-security").attr("data-key",response.token.key);
                $("#value-security").attr("data-value",response.token.value);
            }else if(response.code==404){
                $("#message-box-info").removeClass("open");
                $("#message-box-warning").toggleClass("open");
            }
        },
        error : function(){
            $("#message-box-info").removeClass("open");
        }
    });
}
function resetForm($form) {
    $form.find('input:text, input:password, input:file, input[type=email], select, textarea').val('');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}
function SetOrderSections(pid,order,cgid){
    $.ajax({
        url : "/dashboard/sections/orderpostsections",
        data : {"pid":pid,"cgid":cgid,"order":order},
        type : "POST",
        dataType : "json",
        success :  function(response){
            if(response.message=="SUCCESS" && response.code==200){
                $("#success-pn").removeClass("hide").addClass("in");
                setTimeout(function(){
                    $("#success-pn").removeClass("in").addClass("hide");
                },1500);
            }else if(response.message=="SUCCESS" && response.code==300){
                $("#danger-pn").removeClass("hide").addClass("in");
                setTimeout(function(){
                    $("#danger-pn").removeClass("in").addClass("hide");
                },1500);
            }
            else{
                $("#warning-pn").removeClass("hide").addClass("in");
                setTimeout(function(){
                    $("#warning-pn").removeClass("in").addClass("hide");
                },1500);
            }
        },
        error :function(){
            $("#warning-pn").removeClass("hide").addClass("in");
            setTimeout(function(){
                $("#warning-pn").removeClass("in").addClass("hide");
            },1500);
        }
    });
}

