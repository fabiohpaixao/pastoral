jQuery(document).ready(function() {
	$('.edit-notas button').on('click', function(event){
		$(this).parent('td').find('button').toggleClass('hide');
		if($(this).attr('data-original-title') =="Editar"){
			$(this).parent('td').parent('tr').find('span.nota-aluno').addClass('hide');
			$(this).parent('td').parent('tr').find('input.nota-aluno').removeClass('hide');
		}else{
			var notas =[];
			var aluno_id = $(this).parent('td').parent('tr').attr('aluno-id');
			$(this).parent('td').parent('tr').find('td.notas-atividades').each(function( index ) {
				var atividade_id = $(this).attr('atividade-id');
				var nota = $(this).find('input').val();
				var nota_id = $(this).find('input').attr('nota-id');
				notas.push([nota_id, atividade_id, nota]);
			});

		}
	});
});