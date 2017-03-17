var Script = function () {

//    sidebar active
    var active = jQuery('#sidebar .sub-menu').find('li.active');
    active.closest('#sidebar .sub-menu').addClass('active');

//    sidebar dropdown menu

    jQuery('#sidebar .sub-menu > a').click(function () {
        var last = jQuery('.sub-menu.open', $('#sidebar'));
        last.removeClass("open");
        jQuery('.arrow', last).removeClass("open");
        jQuery('.sub', last).slideUp(200);
        var sub = jQuery(this).next();
        if (sub.is(":visible")) {
            jQuery('.arrow', jQuery(this)).removeClass("open");
            jQuery(this).parent().removeClass("open");
            sub.slideUp(200);
        } else {
            jQuery('.arrow', jQuery(this)).addClass("open");
            jQuery(this).parent().addClass("open");
            sub.slideDown(200);
        }
        var o = ($(this).offset());
        diff = 200 - o.top;
        if(diff>0)
            $("#sidebar").scrollTo("-="+Math.abs(diff),500);
        else
            $("#sidebar").scrollTo("+="+Math.abs(diff),500);
    });

//    sidebar toggle


    $(function() {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });

    $('.icon-reorder').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-180px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '180px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

// custom scrollbar
    $("#sidebar").niceScroll({styler:"fb",cursorcolor:"#e8403f", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', cursorborder: ''});

    $("html").niceScroll({styler:"fb",cursorcolor:"#e8403f", cursorwidth: '6', cursorborderradius: '10px', background: '#404040', cursorborder: '', zindex: '1000'});

// widget tools

    jQuery('.widget .tools .icon-chevron-down').click(function () {
        var el = jQuery(this).parents(".widget").children(".widget-body");
        if (jQuery(this).hasClass("icon-chevron-down")) {
            jQuery(this).removeClass("icon-chevron-down").addClass("icon-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("icon-chevron-up").addClass("icon-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.widget .tools .icon-remove').click(function () {
        jQuery(this).parents(".widget").parent().remove();
    });

//    tool tips

    $('.tooltips').tooltip();

//    popovers

    $('.popovers').popover();


// custom bar chart

    if ($(".custom-bar-chart")) {
        $(".bar").each(function () {
            var i = $(this).find(".value").html();
            $(this).find(".value").html("");
            $(this).find(".value").animate({
                height: i
            }, 2000)
        })
    }


// form validation

    $('.validate').validate();


// masks

    $('.tel').mask('(99)99999-9999');


// datepicker

    $('.datetimepicker').datetimepicker({
      language: 'pt-BR'
    });

// tags input

    var width = $('input.tagsinput').width(),
        tagsJson  = $('#categoriasDisponiveis').val();
       // tagsJson = jQuery.parseJSON(tagsJson),

        if(typeof(tagsJson) != 'undefined')
            var count = Object.keys(tagsJson).length;
        else
            var count = 0;
        
        var tags  = [];

    for (var i = 1; i <= count; i++) {
        tags.push(tagsJson[i]);
    };

    $(".tagsinput").tagsInput({
        width: 'auto',
        autocomplete_url: tags,
        autocomplete: {
            'width' : width
        }
    });


// post status
    // var postStatus = $('.poststatus'),
    //     postVal    = postStatus.val(),
    //     agenda     = $('.postagenda');

    // if(postVal === 'Agendado') 
    //     agenda.slideDown();

    // $('.poststatus').on('change',function(){
    //     if($(this).val() === 'Agendado')
    //         agenda.slideDown();
    //     else
    //         agenda.slideUp();
    // });

//Add distribuidor em materiais

    $("section.distribuidores").on('click', '#add-dist', function(){
        var d_id = $("#MaterialDistribuidores").val();
        var d_val = $("#MaterialDistribuidores").text();
        var v = $("#MaterialValor").val();
        var table = $('.table-ditribuidores');
        var cont = table.find("tbody tr").length + 1;
        var txt = '<tr><td>'+cont+'</td><td>'+d_val+'<input name="data[Distribuidor][id]" value="' + d_id + '" class="form-control " type="hidden" id="DistribuidorId" ></td> <td>'+v+'<input name="data[Distribuidor][valor]" value="'+v+'" class="form-control" type="hidden" id="DistribuidorValor"></td><td><button class="btn btn-danger btn-shadow del" type="button" >Excluir</button></td></tr>';
        // console.log(txt);
        table.find('tbody').append(txt);
    });
    
    $("table.table-ditribuidores").on('click', 'button.del', function(){
        $(this).parent().parent().remove();
    });

//Add distribuidor em materiais

    $('form#OrcamentoAdicionarForm').on('click', 'button#add-especialidade' , function(){
        var table = $('#table-especialidades');

        var espec_val = $('#EspecialidadeEspecialidade option:selected').val();
        var espec_text = $('#EspecialidadeEspecialidade option:selected').text();
        var h_ext = document.getElementById('OrcamentoQtdHorasExtra').value;
        var h_not =  document.getElementById('OrcamentoQtdHorasNoturna').value;
        var h_nor =  document.getElementById('OrcamentoQtdHorasNormais').value;

        var txt = '<tr><td>'+espec_text+'<input name="data[Especialidade][Especialidade]" value="' + espec_val + '" class="form-control " type="hidden" ></td><td>'+h_nor+'<input name="data[Especialidade][QtdHorasNomais]" value="'+h_nor+'" class="form-control" type="hidden" ></td><td>'+h_ext+'<input name="data[Especialidade][QtdHorasExtra]" value="'+h_ext+'" class="form-control" type="hidden" ></td><td>'+h_not+'<input name="data[Especialidade][QtdHorasNoturna]" value="'+h_not+'" class="form-control" type="hidden" ></td><td><button class="btn btn-danger btn-xs del" type="button" >Excluir</button></td></tr>';

        table.find('tbody').append(txt);
    });
    
    $("table#table-especialidades").on('click', 'button.del', function(){
        $(this).parent().parent().remove();
    });

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "rtl": false,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": 300,
      "hideDuration": 1000,
      "timeOut": 5000,
      "extendedTimeOut": 1000,
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
}();