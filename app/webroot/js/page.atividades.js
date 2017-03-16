jQuery(document).ready(function() {
  //EditableTable.init('ase');
 	$(".tables-atividade").each(function(){
 		var table=Object.create(EditableTable);
		table.init('#' + $(this).attr('id'));
 	});

 	$(".tables-atividade a.save").live('click', function (e) {
 		var nRow = $(this).parents('tr')[0];
 		var inputs = $('input', nRow);

 		$.ajax({
			method: "POST",
			url: "some.php",
			data: { name: "John", location: "Boston" }
		})
		.done(function( msg ) {
			alert( "Data Saved: " + msg );
		});
 	});
});
