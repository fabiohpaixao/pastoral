jQuery(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 2
        }
    } );
    /*
 	$(".tables-frequencia").each(function(){
 		var table=Object.create(EditableTable);
		table.init('#' + $(this).attr('id'));
 	});
*/
});