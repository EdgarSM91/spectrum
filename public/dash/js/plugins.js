$(function() {
    var formElements = function(){
       //Bootstrap select
        var feSelect = function(){
            if($(".select").length > 0){
                $(".select").selectpicker();

                $(".select").on("change", function(){
                    if($(this).val() == "" || null === $(this).val()){
                        if(!$(this).attr("multiple"))
                            $(this).val("").find("option").removeAttr("selected").prop("selected",false);
                    }else{
                        $(this).find("option[value="+$(this).val()+"]").attr("selected",true);
                    }
                });
            }
        }//END Bootstrap select
        //Bootstrap tooltip
        var feTooltips = function(){
            $("body").tooltip({selector:'[data-toggle="tooltip"]',container:"body"});
        }//END Bootstrap tooltip

        //Bootstrap Popover
        var fePopover = function(){
            $("[data-toggle=popover]").popover();
            $(".popover-dismiss").popover({trigger: 'focus'});
        }//END Bootstrap Popover

        //Tagsinput
        var feTagsinput = function(){
            if($(".tagsinput").length > 0){

                $(".tagsinput").each(function(){

                    if($(this).data("placeholder") != ''){
                        var dt = $(this).data("placeholder");
                    }else
                        var dt = 'add a tag';

                    $(this).tagsInput({width: '100%',height:'auto',defaultText: dt});
                });

            }
        }// END Tagsinput

        //iCheckbox and iRadion - custom elements
        var feiCheckbox = function(){
            if($(".icheckbox").length > 0){
                 $(".icheckbox,.iradio").iCheck({checkboxClass: 'icheckbox_minimal-grey',radioClass: 'iradio_minimal-grey'});
            }
        }
        // END iCheckbox

        //Bootstrap file input
        var feBsFileInput = function(){

            if($("input.fileinput").length > 0)
                $("input.fileinput").bootstrapFileInput();

        }
        //END Bootstrap file input

        return {// Init all form element features
		init: function(){
                    feSelect();
                    feTooltips();
                    fePopover();
                    feTagsinput();
                    feiCheckbox();
                    feBsFileInput();
                }
        }
    }();

    var uiElements = function(){

        //Datatables
        var uiDatatable = function(){
            if($(".datatable").length > 0){
                $(".datatable").dataTable({
                    iDisplayLength: 25,
                    order: [[ 5, "asc" ]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "Nada por el momento -Lo lamento",
                        "info": "Mostrando de _PAGE_ a _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(Filtrado de _MAX_ registros en total)"
                    },
                    fnPreDrawCallback: function(oSettings, json) {
                        $('.dataTables_filter input').attr('placeholder', 'Buscar.');
                    }
                });
                $(".datatable").on('page.dt',function () {
                    onresize(100);
                });
            }
            if($(".photoNoteTable").length > 0){
                $(".photoNoteTable").dataTable({
                    iDisplayLength: 25,
                    order: [[ 2, "asc" ]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "Nada por el momento -Lo lamento",
                        "info": "Mostrando de _PAGE_ a _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(Filtrado de _MAX_ registros en total)"
                    },
                    fnPreDrawCallback: function(oSettings, json) {
                        $('.dataTables_filter input').attr('placeholder', 'Buscar.');
                    }
                });
                $(".photoNoteTable").on('page.dt',function () {
                    onresize(100);
                });
            }
            if($(".datatableTag").length > 0){
                $(".datatableTag").dataTable({
                    iDisplayLength: 25,
                    order: [[ 0, "asc" ]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "Nada por el momento -Lo lamento",
                        "info": "Mostrando de _PAGE_ a _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(Filtrado de _MAX_ registros en total)"
                    },
                    fnPreDrawCallback: function(oSettings, json) {
                        $('.dataTables_filter input').attr('placeholder', 'Buscar.');
                    }
                });
                $(".datatableTag").on('page.dt',function () {
                    onresize(100);
                });
            }
            if($(".generalDT").length > 0){
                var order = $(".generalDT").attr("data-order");
                var filter = $(".generalDT").attr("data-filter");
                $(".generalDT").dataTable({
                    iDisplayLength: 25,
                    order: [[ order, filter ]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "Nada por el momento -Lo lamento",
                        "info": "Mostrando de _PAGE_ a _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(Filtrado de _MAX_ registros en total)"
                    },
                    fnPreDrawCallback: function(oSettings, json) {
                        $('.dataTables_filter input').attr('placeholder', 'Buscar.');
                    }
                });
                $(".generalDT").on('page.dt',function () {
                    onresize(100);
                });
            }

            if($(".datatable_simple").length > 0){
                $(".datatable_simple").dataTable({"ordering": false, "info": false, "lengthChange": false,"searching": false});
                $(".datatable_simple").on('page.dt',function () {
                    onresize(100);
                });
            }
        }//END Datatable

        //RangeSlider // This function can be removed or cleared.
        var uiRangeSlider = function(){

            //Default Slider with start value
            if($(".defaultSlider").length > 0){
                $(".defaultSlider").each(function(){
                    var rsMin = $(this).data("min");
                    var rsMax = $(this).data("max");

                    $(this).rangeSlider({
                        bounds: {min: 1, max: 200},
                        defaultValues: {min: rsMin, max: rsMax}
                    });
                });
            }//End Default

            //Date range slider
            if($(".dateSlider").length > 0){
                $(".dateSlider").each(function(){
                    $(this).dateRangeSlider({
                        bounds: {min: new Date(2012, 1, 1), max: new Date(2015, 12, 31)},
                        defaultValues:{min: new Date(2012, 10, 15),max: new Date(2014, 12, 15)}
                    });
                });
            }//End date range slider

            //Range slider with predefinde range
            if($(".rangeSlider").length > 0){
                $(".rangeSlider").each(function(){
                    var rsMin = $(this).data("min");
                    var rsMax = $(this).data("max");

                    $(this).rangeSlider({
                        bounds: {min: 1, max: 200},
                        range: {min: 20, max: 40},
                        defaultValues: {min: rsMin, max: rsMax}
                    });
                });
            }//End

            //Range Slider with custom step
            if($(".stepSlider").length > 0){
                $(".stepSlider").each(function(){
                    var rsMin = $(this).data("min");
                    var rsMax = $(this).data("max");

                    $(this).rangeSlider({
                        bounds: {min: 1, max: 200},
                        defaultValues: {min: rsMin, max: rsMax},
                        step: 10
                    });
                });
            }//End

        }//END RangeSlider

        //Start Knob Plugin
        var uiKnob = function(){

            if($(".knob").length > 0){
                $(".knob").knob();
            }

        }//End Knob

        // Start Smart Wizard
        var uiSmartWizard = function(){

            if($(".wizard").length > 0){

                //Check count of steps in each wizard
                $(".wizard > ul").each(function(){
                    $(this).addClass("steps_"+$(this).children("li").length);
                });//end

                // This par of code used for example
                if($("#wizard-validation").length > 0){

                    var validator = $("#wizard-validation").validate({
                            rules: {
                                login: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 8
                                },
                                password: {
                                    required: true,
                                    minlength: 5,
                                    maxlength: 10
                                },
                                repassword: {
                                    required: true,
                                    minlength: 5,
                                    maxlength: 10,
                                    equalTo: "#password"
                                },
                                email: {
                                    required: true,
                                    email: true
                                },
                                name: {
                                    required: true,
                                    maxlength: 10
                                },
                                adress: {
                                    required: true
                                }
                            }
                        });

                }// End of example

                $(".wizard").smartWizard({
                    // This part of code can be removed FROM
                    onLeaveStep: function(obj){
                        var wizard = obj.parents(".wizard");

                        if(wizard.hasClass("wizard-validation")){

                            var valid = true;

                            $('input,textarea',$(obj.attr("href"))).each(function(i,v){
                                valid = validator.element(v) && valid;
                            });

                            if(!valid){
                                wizard.find(".stepContainer").removeAttr("style");
                                validator.focusInvalid();
                                return false;
                            }

                        }

                        return true;
                    },// <-- TO

                    //This is important part of wizard init
                    onShowStep: function(obj){
                        var wizard = obj.parents(".wizard");

                        if(wizard.hasClass("show-submit")){

                            var step_num = obj.attr('rel');
                            var step_max = obj.parents(".anchor").find("li").length;

                            if(step_num == step_max){
                                obj.parents(".wizard").find(".actionBar .btn-primary").css("display","block");
                            }
                        }
                        return true;
                    }//End
                });
            }

        }// End Smart Wizard
       // Custom Content Scroller
        var uiScroller = function(){

            if($(".scroll").length > 0){
                $(".scroll").mCustomScrollbar({axis:"y", autoHideScrollbar: true, scrollInertia: 20, advanced: {autoScrollOnFocus: false}});
            }

        }// END Custom Content Scroller

        // Sparkline
        var uiSparkline = function(){

            if($(".sparkline").length > 0)
               $(".sparkline").sparkline('html', { enableTagOptions: true,disableHiddenCheck: true});

       }// End sparkline

        return {
            init: function(){
                uiDatatable();
                uiRangeSlider();
                uiKnob();
                uiSmartWizard();
                uiScroller();
                uiSparkline();
            }
        }

    }();

    var templatePlugins = function(){

        var tp_clock = function(){

            function tp_clock_time(){
                var now     = new Date();
                var hour    = now.getHours();
                var minutes = now.getMinutes();

                hour = hour < 10 ? '0'+hour : hour;
                minutes = minutes < 10 ? '0'+minutes : minutes;

                $(".plugin-clock").html(hour+"<span>:</span>"+minutes);
            }
            if($(".plugin-clock").length > 0){

                tp_clock_time();

                window.setInterval(function(){
                    tp_clock_time();
                },10000);

            }
        }

        var tp_date = function(){

            if($(".plugin-date").length > 0){

                var days = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sábado'];
                var months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

                var now     = new Date();
                var day     = days[now.getDay()];
                var date    = now.getDate();
                var month   = months[now.getMonth()];
                var year    = now.getFullYear();

                $(".plugin-date").html(day+", "+month+" "+date+", "+year);
            }

        }

        return {
            init: function(){
                tp_clock();
                tp_date();
            }
        }
    }();

    formElements.init();
    uiElements.init();
    templatePlugins.init();


    /* My Custom Progressbar */
    $.mpb = function(action,options){

        var settings = $.extend({
            state: '',
            value: [0,0],
            position: '',
            speed: 20,
            complete: null
        },options);

        if(action == 'show' || action == 'update'){

            if(action == 'show'){
                $(".mpb").remove();
                var mpb = '<div class="mpb '+settings.position+'">\n\
                               <div class="mpb-progress'+(settings.state != '' ? ' mpb-'+settings.state: '')+'" style="width:'+settings.value[0]+'%;"></div>\n\
                           </div>';
                $('body').append(mpb);
            }

            var i  = $.isArray(settings.value) ? settings.value[0] : $(".mpb .mpb-progress").width();
            var to = $.isArray(settings.value) ? settings.value[1] : settings.value;

            var timer = setInterval(function(){
                $(".mpb .mpb-progress").css('width',i+'%'); i++;

                if(i > to){
                    clearInterval(timer);
                    if($.isFunction(settings.complete)){
                        settings.complete.call(this);
                    }
                }
            }, settings.speed);

        }

        if(action == 'destroy'){
            $(".mpb").remove();
        }

    }
    /* Eof My Custom Progressbar */


    // New selector case insensivity
     $.expr[':'].containsi = function(a, i, m) {
         return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
     };
});

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
if($("#manzory").length>=1){
    $('#manzory').masonry({
        itemSelector: '.col-md-3'
    });
}
