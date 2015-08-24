$(document).ready(function(){
    /* New Photo Note */
    if($("#newPhotoNote").length>=1){
        $('#newPhotoNote').formValidation({
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
                image_principal: {
                    validators: {
                        notEmpty: {
                            message: 'La imagen principal es campo necesario y no puede estar vacío.'
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
                type_pn: {
                    validators: {
                        notEmpty: {
                            message: 'El tipo de foto nota no puede estar vacio.'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            $(".btn-submit").attr("disabled","disabled").val("Creando...");
            $("#message-box-info").toggleClass("open");
            var values = {
                key: $('#key-security').attr('data-key'),
                value: $('#value-security').attr('data-value'),
                content:CKEDITOR.instances.summernote.getData()
            };
            var data = $(this).serialize()+"&"+jQuery.param(values);
            $.ajax({
                type : "POST",
                url : "/dashboard/photo/save",
                data : data,
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#message-box-info").removeClass("open");
                        $("#message-box-success").toggleClass("open");
                        $(".btn-submit").removeAttr("disabled").removeClass("disabled").val("Actulizar");
                        $("#key-security").attr("data-key",response.token.key);
                        $("#value-security").attr("data-value",response.token.value);
                        setTimeout(function(){
                            $("#message-box-success").removeClass("open");
                            $("#galleryPhotoNote").removeClass("hide").addClass("in");
                            $("#pnid").val(response.pnid);
                            if(response.active==2){
                                getDropzone();
                                $('html, body').animate({scrollTop :  $("#galleryPhotoNote").offset().top},2000)
                            }
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
        /* Validate title */
        $("#photo-note-title").change(function(){
            var $input_loader = $("#input-loader");
            $input_loader.removeClass("fade");
            var title_note = $(this).val();
            $.ajax({
                url : "/dashboard/photo/validateurl",
                type : "POST",
                data : {title:title_note,key: $('#key-security').attr('data-key'),value: $('#value-security').attr('data-value')},
                dataType : "json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $("#note-permalink").val(response.new_url);
                        $('#newPhotoNote').formValidation('revalidateField', 'permalink');
                        $("#key-security").attr("data-key",response.token.key);
                        $("#value-security").attr("data-value",response.token.value);
                    }else{
                        $input_loader.addClass("hide");
                        alert("Ha ocurrido un error intente nuevamente.");
                    }
                },
                complete: function(){
                    $input_loader.addClass("hide");
                }
            });
        });
    }
    if($(".photo_notes_gallery").length>=1){
        $("table#ddt-gallery-positions tbody").on("dblclick","tr td textarea.description_images",function(){
            $(this).attr("readonly", false);
        });
        $("table#ddt-gallery-positions tbody").on("keyup","tr td textarea.description_images",function(e){
            var $id = $(this).parent().parent().data("id");
            $this = $(this);
            if(e.which == 13 && (e.ctrlKey || e.shiftKey)){
                var dataPhoto = {
                    id : $id,
                    description : $(this).val(),
                    key: $('#key-security').attr('data-key'),
                    value: $('#value-security').attr('data-value')
                }
                $.ajax({
                    url : "/dashboard/photo/savedescription",
                    data : dataPhoto,
                    type : "POST",
                    dataType : "json",
                    success :  function(response){
                        if(response.message=="SUCCESS" && response.code==200){
                            $("#key-security").attr("data-key",response.token.key);
                            $("#value-security").attr("data-value",response.token.value);
                            $this.attr("readonly", true);
                            $this.parent().find("div.alert-success").removeClass("hide").addClass("in");
                            setTimeout(function(){
                                $this.parent().find("div.alert-success").removeClass("in").addClass("hide");
                            },1500);                    }else{
                            $this.parent().find("div.alert-danger").removeClass("hide").addClass("in");
                            setTimeout(function(){
                                $this.parent().find("div.alert-danger").removeClass("in").addClass("hide");
                            },1500);
                        }
                    },
                    error :function(){
                        $this.parent().find("div.alert-danger").removeClass("hide").addClass("in");
                        setTimeout(function(){
                            $this.parent().find("div.alert-danger").removeClass("in").addClass("hide");
                        },1500);
                    }
                });
            }
        }).focus();
    }
    if($("#EditGalleryPhotoNote").length>=1){
        getDropzoneEdit();
    }
    $("#cid").select2({
        maximumSelectionLength:1,
        placeholder: "Categoría"
    });
    if($("#image-photo-principal-dz").length>=1){
        Dropzone.autoDiscover = false;
        var minImageWidth =1024, minImageHeight = 576;
        var myDropzone = new Dropzone('#image-photo-principal-dz', {
            url: "/dashboard/photo/uploadimage",
            acceptedFiles: ".jpg, .jpeg, .gif, .png, .JPG, .JPEG",
            uploadMultiple : false,
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            maxFiles: 1 ,
            parallelUploads : 1,
            addRemoveLinks : true,
            dictResponseError: "No se puede subir esta imagen!",
            autoProcessQueue: true,
            thumbnailWidth: 138,
            thumbnailHeight: 120,
            previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name style:"font-weight: bold;"></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',
            init: function() {
                this.on("success", function(file, responseText) {
                    file.previewTemplate.setAttribute('id',responseText[0].id);
                });
                this.on("thumbnail", function(file) {
                    if (file.width < minImageWidth || file.height < minImageHeight && file.width > minImageWidth || file.height > minImageHeight) {
                        file.rejectDimensions()
                    }
                    else {
                        file.acceptDimensions();
                    }
                });
            },
            accept: function(file, done) {
                file.acceptDimensions = done;
                file.rejectDimensions = function() { done("Imagen muy pequeña."); };
            },
            resize: function(file) {
                var info = { srcX: 0, srcY: 0, srcWidth: file.width, srcHeight: file.height },
                    srcRatio = file.width / file.height;
                if (file.height > this.options.thumbnailHeight || file.width > this.options.thumbnailWidth) {
                    info.trgHeight = this.options.thumbnailHeight;
                    info.trgWidth = info.trgHeight * srcRatio;
                    if (info.trgWidth > this.options.thumbnailWidth) {
                        info.trgWidth = this.options.thumbnailWidth;
                        info.trgHeight = info.trgWidth / srcRatio;
                    }
                } else {
                    info.trgHeight = file.height;
                    info.trgWidth = file.width;
                }
                return info;
            },
            sending : function(file, xhr, formData){
                formData.append("position_image",2);
                formData.append("image_post",1);
                formData.append("post_id",$("#post_id").val());
                formData.append("uniqid-id-image",$("#uniqid-id-image").val());
            },
            success: function(file, response){
                var name_image = jQuery.parseJSON(response);
                $(".dz-preview").addClass("dz-success");
                $("div.progress").remove();
                $("#img-photo-principal-dz").val(name_image.name);
            },
            removedfile: function(file) {
                $(file.previewElement).remove();
            }
        });
    }
    if($("#ip-edit-principal-dz").length>=1){
        Dropzone.autoDiscover = false;
        var minImageWidth =1024, minImageHeight = 576;
        var myDropzone = new Dropzone('#ip-edit-principal-dz', {
            url: "/dashboard/photo/uploadimage",
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 6, // MB
            maxFiles: 2,
            addRemoveLinks : true,
            dictResponseError: "No se puede subir esta imagen!",
            autoProcessQueue: true,
            thumbnailWidth: 138,
            thumbnailHeight: 120,
            previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name style:"font-weight: bold;"></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',
            init: function() {
                this.on("success", function(file, responseText) {
                    file.previewTemplate.setAttribute('id',responseText[0].id);
                });
                this.on("thumbnail", function(file) {
                    if (file.width < minImageWidth || file.height < minImageHeight && file.width > minImageWidth || file.height > minImageHeight) {
                        file.rejectDimensions()
                    }
                    else {
                        if(typeof file !== 'undefined' && file.acceptDimensions===undefined){
                        }else{
                            file.acceptDimensions();
                        }
                    }
                });
            },
            accept: function(file, done) {
                file.acceptDimensions = done;
                file.rejectDimensions = function() { done("La imagen no coincide con las dimenciones"); };
            },
            resize: function(file) {
                var info = { srcX: 0, srcY: 0, srcWidth: file.width, srcHeight: file.height },
                    srcRatio = file.width / file.height;
                if (file.height > this.options.thumbnailHeight || file.width > this.options.thumbnailWidth) {
                    info.trgHeight = this.options.thumbnailHeight;
                    info.trgWidth = info.trgHeight * srcRatio;
                    if (info.trgWidth > this.options.thumbnailWidth) {
                        info.trgWidth = this.options.thumbnailWidth;
                        info.trgHeight = info.trgWidth / srcRatio;
                    }
                } else {
                    info.trgHeight = file.height;
                    info.trgWidth = file.width;
                }
                return info;
            },
            success: function(file, response){
                var name_image = jQuery.parseJSON(response);
                $(".dz-preview").addClass("dz-success");
                $("div.progress").remove();
                $("#img-photo-principal-dz").val(name_image.name);
            },
            removedfile: function(file) {
                $(file.previewElement).remove();
            }
        });
        var mockFile = { name: "Clic en remove file", size: 12345};
        myDropzone.emit("addedfile", mockFile);
        $(".progress.progress-striped.active").addClass("hide");
        if($("#img-photo-principal-dz").val()==""){
            image_load = "/dash/assets/images/users/thumbnail/no-image.jpg";
        }else{
            image_load = "/dash/img/photo_notes/100x75/"+$("#img-photo-principal-dz").val();
        }
        myDropzone.emit("thumbnail", mockFile,image_load);
        var existingFileCount = 1; // The number of files already uploaded
        myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
    }
});
function getDropzoneEdit(){
    Dropzone.autoDiscover = false;
    var start;
    var split;
    var order=1;
    var orders;
    var images = $('input[name="photo_note[]"]').val();
    var minImageWidth =1024, minImageHeight = 576;
    var myDropzone2 = new Dropzone('#gallery-photo-principal-dz', {
        url: "/dashboard/photo/savemultipleimages",
        acceptedFiles: ".jpg, .jpeg, .gif, .png",
        uploadMultiple : false,
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        maxFiles: 100,
        addRemoveLinks : true,
        dictResponseError: "No se puede subir esta imagen!",
        autoProcessQueue: true,
        thumbnailWidth: 138,
        thumbnailHeight: 120,
        previewTemplate: '<div class="dz-preview dz-file-preview" id="0"><div class="dz-details"><div class="dz-filename"><span data-dz-name style:"font-weight: bold;"></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',
        init: function() {
            this.on("success", function(file, responseText) {
                file.previewTemplate.setAttribute('id',responseText[0].id);
            });
            this.on("thumbnail", function(file) {
                if (file.width < minImageWidth || file.height < minImageHeight && file.width > minImageWidth || file.height > minImageHeight) {
                    file.rejectDimensions()
                }
                else {
                    if(typeof file !== 'undefined' && file.acceptDimensions===undefined){
                    }else{
                        file.acceptDimensions();
                    }
                }
            });
        },
        accept: function(file, done) {
            file.acceptDimensions = done;
            file.rejectDimensions = function() { done("La imagen no coincide con las dimenciones"); };
        },
        resize: function(file) {
            var info = { srcX: 0, srcY: 0, srcWidth: file.width, srcHeight: file.height },
                srcRatio = file.width / file.height;
            if (file.height > this.options.thumbnailHeight || file.width > this.options.thumbnailWidth) {
                info.trgHeight = this.options.thumbnailHeight;
                info.trgWidth = info.trgHeight * srcRatio;
                if (info.trgWidth > this.options.thumbnailWidth) {
                    info.trgWidth = this.options.thumbnailWidth;
                    info.trgHeight = info.trgWidth / srcRatio;
                }
            } else {
                info.trgHeight = file.height;
                info.trgWidth = file.width;
            }
            return info;
        },
        sending : function(file, xhr, formData){
            formData.append("order",order++);
            formData.append("pnid",$("#pnid").val());
        },
        success: function(file, response){
            var name_image = jQuery.parseJSON(response);
            $(".dz-preview").addClass("dz-success");
            $("div.progress").remove();
            $("#gry-photo-principal-dz").val(name_image.name);
            file.previewElement.id = name_image.photo_id;
            file.previewElement.accessKey = name_image.name;
            split = name_image.name.split("_");
            $(".table tbody").append('<tr  data-id="'+name_image.photo_id+'" data-name="'+name_image.name+'" class="images_gallery '+name_image.photo_id+'"  id="'+name_image.name+'|'+name_image.photo_id+'" ><td><img src="/dash/img/photo_notes/256x144/'+name_image.name+'" alt="" /></td><td class="title_image">'+name_image.original_name+'</td><td><textarea name="sumary" class="form-control summary description_images" placeholder="Agregar una descripción" readonly autofocus></textarea><br><div class="hide alert alert-success fade " role="alert"><strong>Descripción agregada correctamente</strong></div><div class="hide alert alert-danger fade" role="alert"><strong>Ha ocurrido un error, y no se ha podido guardar.</strong></div></td></tr>');
            $("#ddt-gallery-positions").tableDnD({
                onDragClass: "drag-drop",
                onDragStart: function(table, row) {
                    start = row.id.split("/");
                },
                onDrop: function(table, row) {
                    orders = $.tableDnD.serialize();
                    var rows = table.tBodies[0].rows;
                    for (var i=0; i<rows.length; i++) {
                        result = i+1;
                        split = rows[i].id.split("/");
                        if(split[0]==start[0]){
                            SetOrder(split[0],$("#pnid").val(),result)
                        }
                    }

                }
            });
        },
        removedfile: function(file) {
            id = file.previewElement.id;
            $.ajax({
                url: "/dashboard/photo/deleteimage",
                type: "post",
                data: { "imgid":file.previewElement.id,"name_image":$(".table tbody tr."+file.previewElement.id+"").data("name"),"pnid":$("#pnid").val(),key: $('#key-security').attr('data-key'),value: $('#value-security').attr('data-value')},
                dataType:"json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $(file.previewElement).remove();
                        $(".table tbody tr."+id+"").remove();
                        //$(".table ."+id+"").remove();
                    }else{
                        alert("No se ha podido eliminar");
                    }
                },
                error : function(){
                    alert("Ha ocurrido un error");
                }
            });
        }
    });
    if($("#gry-photo-principal-dz").val()){
        $('input[name="photo_note[]"]').each(function() {
            var value = $(this).val(); // get values
            var split = value.split("|"); // split value

            var mockFile = { name: "Click para remover la imagen", size: 12345};
            myDropzone2.emit("addedfile",mockFile);
            myDropzone2.element.lastChild.id=split[1]

            image_load = "/dash/img/photo_notes/100x75/"+split[0];
            myDropzone2.emit("thumbnail", mockFile,image_load);
            var existingFileCount = 1; // The number of files already uploaded
            myDropzone2.options.maxFiles = myDropzone2.options.maxFiles - existingFileCount;
        });
    }
    $("div.progress").remove();
    $("#ddt-gallery-positions").tableDnD({
        onDragClass: "drag-drop",
        onDragStart: function(table, row) {
            start = row.id.split("/");
        },
        onDrop: function(table, row) {
            orders = $.tableDnD.serialize();
            var rows = table.tBodies[0].rows;
            for (var i=0; i<rows.length; i++) {
                result = i+1;
                split = rows[i].id.split("/");
                if(split[0]==start[0]){
                    SetOrder(split[0],$("#pnid").val(),result)
                }
            }

        }
    });
}
function getDropzone(){
    Dropzone.autoDiscover = true;
    var start;
    var split;
    var order=1;
    var orders;
    var minImageWidth =1024, minImageHeight = 576;
    var myDropzone = new Dropzone('#gallery-photo-principal-dz', {
        url: "/dashboard/photo/savemultipleimages",
        acceptedFiles: ".jpg, .jpeg, .gif, .png",
        uploadMultiple : false,
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        addRemoveLinks : true,
        dictResponseError: "No se puede subir esta imagen!",
        autoProcessQueue: true,
        thumbnailWidth: 138,
        thumbnailHeight: 120,
        previewTemplate: '<div class="dz-preview dz-file-preview" id="0"><div class="dz-details"><div class="dz-filename"><span data-dz-name style:"font-weight: bold;"></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',
        init: function() {
            this.on("success", function(file, responseText) {
                file.previewTemplate.setAttribute('id',responseText[0].id);
            });
            this.on("thumbnail", function(file) {
                if (file.width < minImageWidth || file.height < minImageHeight && file.width > minImageWidth || file.height > minImageHeight) {
                    file.rejectDimensions()
                }
                else {
                    file.acceptDimensions();
                }
            });
        },
        accept: function(file, done) {
            file.acceptDimensions = done;
            file.rejectDimensions = function() { done("La imagen no coincide con las dimenciones"); };
        },
        resize: function(file) {
            var info = { srcX: 0, srcY: 0, srcWidth: file.width, srcHeight: file.height },
                srcRatio = file.width / file.height;
            if (file.height > this.options.thumbnailHeight || file.width > this.options.thumbnailWidth) {
                info.trgHeight = this.options.thumbnailHeight;
                info.trgWidth = info.trgHeight * srcRatio;
                if (info.trgWidth > this.options.thumbnailWidth) {
                    info.trgWidth = this.options.thumbnailWidth;
                    info.trgHeight = info.trgWidth / srcRatio;
                }
            } else {
                info.trgHeight = file.height;
                info.trgWidth = file.width;
            }
            return info;
        },
        sending : function(file, xhr, formData){
            formData.append("order",order++);
            formData.append("pnid",$("#pnid").val());
        },
        success: function(file, response){
            var name_image = jQuery.parseJSON(response);
            $(".dz-preview").addClass("dz-success");
            $("div.progress").remove();
            $("#gry-photo-principal-dz").val(name_image.name);
            file.previewElement.id = name_image.photo_id;
            file.previewElement.accessKey = name_image.name;
            split = name_image.name.split("_");
            $(".table tbody").append('<tr  data-id="'+name_image.photo_id+'" data-name="'+name_image.name+'" class="images_gallery '+name_image.photo_id+'"  id="'+name_image.name+'|'+name_image.photo_id+'" ><td><img src="/dash/img/photo_notes/256x144/'+name_image.name+'" alt="" /></td><td class="title_image">'+name_image.original_name+'</td><td><textarea name="sumary" class="form-control summary description_images" placeholder="Agregar una descripción" readonly autofocus></textarea><br><div class="hide alert alert-success fade " role="alert"><strong>Descripción agregada correctamente</strong></div><div class="hide alert alert-danger fade" role="alert"><strong>Ha ocurrido un error, y no se ha podido guardar.</strong></div></td></tr>');
            $("#ddt-gallery-positions").tableDnD({
                onDragClass: "drag-drop",
                onDragStart: function(table, row) {
                    start = row.id.split("/");
                },
                onDrop: function(table, row) {
                    orders = $.tableDnD.serialize();
                    var rows = table.tBodies[0].rows;
                    for (var i=0; i<rows.length; i++) {
                        result = i+1;
                        split = rows[i].id.split("/");
                        if(split[0]==start[0]){
                            SetOrder(split[0],$("#pnid").val(),result)
                        }
                    }

                }
            });
        },
        removedfile: function(file) {
            id = file.previewElement.id;
            $.ajax({
                url: "/dashboard/photo/deleteimage",
                type: "post",
                data: { "imgid":file.previewElement.id,"name_image":file.previewElement.accessKey,"pnid":$("#pnid").val(),key: $('#key-security').attr('data-key'),value: $('#value-security').attr('data-value')},
                dataType:"json",
                success : function(response){
                    if(response.message=="SUCCESS" && response.code==200){
                        $(file.previewElement).remove();
                        $(".table ."+id+"").remove();
                    }else{
                        alert("No se ha podido eliminar");
                    }
                },
                error : function(){
                    alert("Ha ocurrido un error");
                }
            });
        }
    });
}
function SetOrder(imgid,pnid,order){
    $.ajax({
        url : "/dashboard/photo/orderimage",
        data : {"imgid":imgid,"pnid":pnid,"order":order, key: $('#key-security').attr('data-key'),value: $('#value-security').attr('data-value')},
        type : "POST",
        dataType : "json",
        success :  function(response){
            if(response.message=="SUCCESS" && response.code==200){
                $("#success-pn").removeClass("hide").addClass("in");
                setTimeout(function(){
                    $("#success-pn").removeClass("in").addClass("hide");
                },1500);
            }else{
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