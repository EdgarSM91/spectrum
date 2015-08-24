$(document).ready(function(){
    if($("#dropzone-user-edit").length>=1){
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('#dropzone-user-edit', {
            url: "/dashboard/user/uploadimage",
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 5, // MB
            maxFiles: 2,
            addRemoveLinks : true,
            dictResponseError: "No se puede subir esta imagen!",
            autoProcessQueue: true,
            thumbnailWidth: 138,
            thumbnailHeight: 120,
            previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name style:"font-weight: bold;"></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',

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
                $("#user-image").val(name_image.name);
            },
            removedfile: function(file) {
                $(file.previewElement).remove();
            }
        });
        var mockFile = { name: "Click en remove file", size: 12345};
        myDropzone.emit("addedfile", mockFile);
        $(".progress.progress-striped.active").addClass("hide");
        if($("#user-image").val()==""){
            image_load = "/dash/assets/images/users/thumbnail/no-image.jpg";
        }else{
            image_load = "/dash/assets/images/users/thumbnail/"+$("#user-image").val();
        }
        myDropzone.emit("thumbnail", mockFile,image_load);
        var existingFileCount = 1; // The number of files already uploaded
        myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
    }
    if($("#image-principal-dz").length>=1){
        Dropzone.autoDiscover = false;
        var minImageWidth =1024, minImageHeight = 576;
        var myDropzone = new Dropzone('#image-principal-dz', {
            url: "/dashboard/course/uploadimage",
            uploadMultiple : false,
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 5, // MB
            maxFiles: 1 ,
            parallelUploads : 1,
            addRemoveLinks : true,
            dictResponseError: "No se puede subir esta imagen!",
            autoProcessQueue: true,
            thumbnailWidth: 138,
            thumbnailHeight: 120,
            acceptedFiles:"image/*",
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
                formData.append("image-post",1);
                formData.append("name-image",$("#img-principal").val());
            },
            success: function(file, response){
                var name_image = jQuery.parseJSON(response);
                $(".dz-preview").addClass("dz-success");
                $("div.progress").remove();
                $("#image-1").val(name_image.name);
                $('#newCourse').formValidation('revalidateField', 'image-1');
            },
            removedfile: function(file) {
                $(file.previewElement).remove();
                $("#image-1").val('');
                $('#newCourse').formValidation('revalidateField', 'image-1');
            }
        });
    }
    if($("#image-principal-dz-2").length>=1){
        Dropzone.autoDiscover = false;
        var minImageWidth2 =300, minImageHeight2 = 300;
        var myDropzone = new Dropzone('#image-principal-dz-2', {
            url: "/dashboard/course/uploadimage",
            uploadMultiple : false,
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 5, // MB
            maxFiles: 1 ,
            parallelUploads : 1,
            addRemoveLinks : true,
            dictResponseError: "No se puede subir esta imagen!",
            autoProcessQueue: true,
            thumbnailWidth: 138,
            thumbnailHeight: 120,
            acceptedFiles:"image/*",
            previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name style:"font-weight: bold;"></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',
            init: function() {
                this.on("success", function(file, responseText) {
                    file.previewTemplate.setAttribute('id',responseText[0].id);
                });
                this.on("thumbnail", function(file) {
                    if (file.width < minImageWidth2 || file.height < minImageHeight2 && file.width > minImageWidth2 || file.height > minImageHeight2) {
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
                formData.append("image-post",2);
                formData.append("name-image",$("#img-principal").val());
            },
            success: function(file, response){
                var name_image = jQuery.parseJSON(response);
                $(".dz-preview").addClass("dz-success");
                $("div.progress").remove();
                $("#image-2").val(name_image.name);
                $('#newCourse').formValidation('revalidateField', 'image-2');
            },
            removedfile: function(file) {
                $(file.previewElement).remove();
                $("#image-2").val('');
                $('#newCourse').formValidation('revalidateField', 'image-2');
            }
        });
    }
    if($("#image-principal-edit-1").length>=1){
        Dropzone.autoDiscover = false;
        var minImageWidth =1024, minImageHeight = 576;
        var myDropzone = new Dropzone('#image-principal-edit-1', {
            url: "/dashboard/course/uploadimage",
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 5, // MB
            maxFiles: 2,
            addRemoveLinks : true,
            dictResponseError: "No se puede subir esta imagen!",
            autoProcessQueue: true,
            thumbnailWidth: 138,
            thumbnailHeight: 120,
            acceptedFiles:"image/*",
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
            sending : function(file, xhr, formData){
                formData.append("image-post",1);
                formData.append("name-image",$("#img-principal").val());
            },
            success: function(file, response){
                var name_image = jQuery.parseJSON(response);
                $(".dz-preview").addClass("dz-success");
                $("div.progress").remove();
                $("#image-1").val(name_image.name);
                $('#editCourse').formValidation('revalidateField', 'image-1');
            },
            removedfile: function(file) {
                $(file.previewElement).remove();
                $("#image-1").val('');
                $('#editCourse').formValidation('revalidateField', 'image-1');
            }
        });
        var mockFile = { name: "Click en 'Remover archivo'", size: 12345};
        myDropzone.emit("addedfile", mockFile);
        $(".progress.progress-striped.active").addClass("hide");
        var img_principal = $("#img-principal").val();
        var image_load="";
        if(img_principal==""){
            image_load = "/dash/assets/images/users/thumbnail/no-image.jpg";
        }else{
            image_load = "/dash/img/course/1024x576/"+img_principal;
        }
        myDropzone.emit("thumbnail", mockFile,image_load);
        var existingFileCount = 1; // The number of files already uploaded
        myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
    }
    if($("#image-principal-edit-2").length>=1){
        Dropzone.autoDiscover = false;
        var minImageWidth2 =300, minImageHeight2 = 300;
        var myDropzone = new Dropzone('#image-principal-edit-2', {
            url: "/dashboard/course/uploadimage",
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 5, // MB
            maxFiles: 2,
            addRemoveLinks : true,
            dictResponseError: "No se puede subir esta imagen!",
            autoProcessQueue: true,
            thumbnailWidth: 138,
            thumbnailHeight: 120,
            acceptedFiles:"image/*",
            previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name style:"font-weight: bold;"></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',
            init: function() {
                this.on("success", function(file, responseText) {
                    file.previewTemplate.setAttribute('id',responseText[0].id);
                });
                this.on("thumbnail", function(file) {
                    if (file.width < minImageWidth2 || file.height < minImageHeight2 && file.width > minImageWidth2 || file.height > minImageHeight2) {
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
                formData.append("image-post",2);
                formData.append("name-image",$("#img-principal").val());
            },
            success: function(file, response){
                var name_image = jQuery.parseJSON(response);
                $(".dz-preview").addClass("dz-success");
                $("div.progress").remove();
                $("#image-2").val(name_image.name);
                $('#editCourse').formValidation('revalidateField', 'image-2');
            },
            removedfile: function(file) {
                $(file.previewElement).remove();
                $("#image-2").val('');
                $('#editCourse').formValidation('revalidateField', 'image-2');
            }
        });
        var mockFile = { name: "Click en 'Remover archivo'", size: 12345};
        myDropzone.emit("addedfile", mockFile);
        $(".progress.progress-striped.active").addClass("hide");
        var img_principal = $("#img-principal").val();
        var image_load="";
        if(img_principal==""){
            image_load = "/dash/assets/images/users/thumbnail/no-image.jpg";
        }else{
            image_load = "/dash/img/course/300x300/"+img_principal;
        }
        myDropzone.emit("thumbnail", mockFile,image_load);
        var existingFileCount = 1; // The number of files already uploaded
        myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
    }

    /* Instructor */
    if($("#imgInstructor").length>=1){
        Dropzone.autoDiscover = false;
        var minImageWidth =300, minImageHeight = 300;
        var myDropzone = new Dropzone('#imgInstructor', {
            url: "/dashboard/instructor/uploadfile",
            uploadMultiple : false,
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 5, // MB
            maxFiles: 1 ,
            parallelUploads : 1,
            addRemoveLinks : true,
            dictResponseError: "No se puede subir esta imagen!",
            autoProcessQueue: true,
            thumbnailWidth: 138,
            thumbnailHeight: 120,
            acceptedFiles:"image/*",
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
                formData.append("file-post",1);
                formData.append("name-image",$("#name-image").val());
            },
            success: function(file, response){
                var name_image = jQuery.parseJSON(response);
                $(".dz-preview").addClass("dz-success");
                $("div.progress").remove();
                $("#imageI").val(name_image.name);
                $('#newInstructor').formValidation('revalidateField', 'imageI');
            },
            removedfile: function(file) {
                $(file.previewElement).remove();
                $("#imageI").val('');
                $('#newInstructor').formValidation('revalidateField', 'imageI');
            }
        });
    }
    if($("#pdfInstructor").length>=1){
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('#pdfInstructor', {
            url: "/dashboard/instructor/uploadfile",
            uploadMultiple : false,
            paramName: "file", // The name that will be used to transfer the file
            //maxFilesize: 5, // MB
            maxFiles: 1 ,
            parallelUploads : 1,
            addRemoveLinks : true,
            dictResponseError: "No se puede subir esta imagen!",
            autoProcessQueue: true,
            thumbnailWidth: 138,
            thumbnailHeight: 120,
            acceptedFiles:".pdf",
            previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name style:"font-weight: bold;"></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',
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
                formData.append("file-post",2);
                formData.append("curriculum",$("#name-curriculum").val());
            },
            success: function(file, response){
                var name_image = jQuery.parseJSON(response);
                $(".dz-preview").addClass("dz-success");
                $("div.progress").remove();
                $("#pdfI").val(name_image.name);
                $('#newInstructor').formValidation('revalidateField', 'pdfI');
            },
            removedfile: function(file) {
                $(file.previewElement).remove();
                $("#pdfI").val('');
                $('#newInstructor').formValidation('revalidateField', 'pdfI');
            }
        });
    }
})