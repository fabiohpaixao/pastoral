jQuery(document).ready(function() {
    $('.change-disciplina').on('click', function(event){
        $('#FrequenciaDisciplinaId').val($(this).attr('href').replace("#", ""));
    });

    $('.accordion').accordion({
      heightStyle: "content"
    });
});