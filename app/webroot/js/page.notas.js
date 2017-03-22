jQuery(document).ready(function() {
	$('.edit-notas button').on('click', function(event){
		$(this).parent('td').find('button').toggleClass('hide');
		if($(this).attr('data-original-title') =="Editar"){
			$(this).parent('td').parent('tr').find('span.nota-aluno').addClass('hide');
			$(this).parent('td').parent('tr').find('input.nota-aluno').removeClass('hide');
		}else{
			var notas = '{"Nota":[';
			var aluno_id = $(this).parent('td').parent('tr').attr('aluno-id');
			$(this).parent('td').parent('tr').find('td.notas-atividades').each(function( index ) {
				var atividade_id = $(this).attr('atividade-id');
				var nota = $(this).find('input').val();
				var nota_id = $(this).find('input').attr('nota-id');
				notas += '{"id":"' + nota_id + '", "atividade_id":"' + atividade_id + '", "valor":"' + nota + '", "aluno_id":"' + aluno_id + '"},';
			});

			notas = notas.substr(0, (notas.length -1));
			notas += ']}';
			console.log(notas);
			$.ajax({
				type: 'POST',
				url: 'notas/add.json',
				data: $.parseJSON(notas),
				success: function(data,textStatus,xhr){

					if(data.status == '200')
						toastr["success"](data.message);
					else
						toastr["error"](data.message);
				},
				error: function(data,textStatus,error){
					toastr["error"](data.message);
				}
			})
		}
	});
});