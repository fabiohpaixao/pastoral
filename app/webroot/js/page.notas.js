jQuery(document).ready(function() {
	$('.edit-notas button').on('click', function(event){
		$(this).parent('td').find('button').toggleClass('hide');
		var tableTr = $(this).parent('td').parent('tr');
		if($(this).attr('data-original-title') =="Editar"){
			tableTr.find('span.nota-aluno').addClass('hide');
			tableTr.find('input.nota-aluno').removeClass('hide');
		}else if($(this).attr('data-original-title') =="Cancelar"){
			tableTr.find('span.nota-aluno').removeClass('hide');
			tableTr.find('input.nota-aluno').addClass('hide');
		}else{
			var notas = '{"Nota":[';

			var aluno_id = tableTr.attr('aluno-id');
			tableTr.find('td.notas-atividades').each(function( index ) {
				var atividade_id = $(this).attr('atividade-id');
				var nota = $(this).find('input').val();
				var nota_id = $(this).find('input').attr('nota-id');
				notas += '{"id":"' + nota_id + '", "atividade_id":"' + atividade_id + '", "valor":"' + nota + '", "aluno_id":"' + aluno_id + '"},';
			});

			notas = notas.substr(0, (notas.length -1));
			notas += ']}';
			
			var responseFunction = $.parseJSON($.ajax({
				type: 'POST',
				url: 'notas/add.json',
				data: $.parseJSON(notas),
				success: function(data,textStatus,xhr){

					if(data.status == '200'){
						toastr["success"](data.message);
					}
					else
						toastr["error"](data.message);
				},
				error: function(data,textStatus,error){
					toastr["error"](data.message);
				}
			}).responseText);

			if(responseFunction.status == '200'){
				tableTr.find('td.notas-atividades').each(function( index ) {
					$(this).find('span').html($(this).find('input').val());
				});
			}

			tableTr.find('span.nota-aluno').removeClass('hide');
			tableTr.find('input.nota-aluno').addClass('hide');

		}
	});
});