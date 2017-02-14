var Script = function () {

        // begin first table
        $('#table').dataTable({
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ registro por p&aacute;gina",
                "oPaginate": {
                    "sPrevious": "Anterior",
                    "sNext": "Pr&oacute;xima"
                },
                "sSearch": "Procurar:",
                "sInfo": "_TOTAL_ resultado(s) encontrado(s) (_START_ de _END_)",
                "sEmptyTable": "Nenhum registro encontrado para essa tabela",
                "sInfoEmpty": "Nenhum resultado encontrado",
                "sInfoFiltered": "(filtrado de _MAX_ registros)",
                "sZeroRecords": "Por favor, tente outra vez com uma palavra diferente!"
            },
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }]
        });

        jQuery('#table .group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });

        jQuery('#table_wrapper .dataTables_filter input').addClass("form-control"); // modify table search input
        jQuery('#table_wrapper .dataTables_length select').addClass("form-control"); // modify table per page dropdown

}();