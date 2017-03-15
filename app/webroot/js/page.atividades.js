jQuery(document).ready(function() {
  //EditableTable.init('ase');
 	$(".tables-atividade").each(function(){
 		var table=Object.create(EditableTable);
		table.init('#' + $(this).attr('id'));
		console.log($(this).attr('id'));
 	});
});
