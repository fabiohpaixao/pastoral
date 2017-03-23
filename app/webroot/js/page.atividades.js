jQuery(document).ready(function() {

 	$(".tables-atividade").each(function(){
 		var table=Object.create(EditableTable);
		table.init('#' + $(this).attr('id'));
 	});

});

function callbackAtividadeSave(obj, del) {
	var nRow = $(obj).parents('tr');
	var nTable = $(obj).parents('table.tables-atividade');
	var dataAjax = '';
	var type = 'POST';
	
	var disc = nTable.attr('disciplina-id');
	var id = nRow.attr('atividade-id');
	if(!del){
		var inputs = $('input', nRow[0]);
		var descricao = inputs[0].value;
		var peso = inputs[1].value;
		dataAjax = {"Atividade" : {"descricao":descricao, "peso":peso, "disciplina_id":disc}};
	}

	if(del){
		var action = 'atividades/delete/' + id +'.json';
		type = 'DELETE';
	}else{
		if(id === undefined)
			var action = 'atividades/add.json';
		else{

			var action = 'atividades/edit/' + id +'.json';
			type = 'POST';
		}
	}

	var responseFunction = $.parseJSON($.ajax({
		type: type,
		url: action,
		data: dataAjax,
		async: false,
		success: function(data,textStatus,xhr){

			if(data.status == '200')
				toastr["success"](data.message);
			else
				toastr["error"](data.message);
		},
		error: function(xhr,textStatus,error){
			toastr["error"](xhr.message);
		}
	}).responseText);
	
	return (responseFunction.status == '200') ? responseFunction.id : '-1';
};
