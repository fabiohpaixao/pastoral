var EditableTable = function () {

    return {

        //main function to initiate the module
        init: function (idTable) {
            this.idTable=idTable;
            var adding = false;

            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i);
                }

                oTable.fnDraw();
            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var total = jqTds.length - 2;
                for (i = 0; i < total; i++) {
                    jqTds[i].innerHTML = '<input type="text" class="form-control small" value="' + aData[i] + '">';
                }
                $('a.save',jqTds).removeClass('hide');// = '<a class="save" href="">Salvar</a>';
                $('a.edit',jqTds).addClass('hide');// = '<a class="save" href="">Salvar</a>';
                jqTds[(total + 1)].innerHTML = '<a class="cancel" href="">Cancelar</a>';
            }

            function addRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var total = jqTds.length - 2;
                for (i = 0; i < total; i++) {
                    jqTds[i].innerHTML = '<input type="text" class="form-control small" value="' + aData[i] + '">';
                }
                jqTds[total].innerHTML ='<a class="save" href="">Salvar</a><a class="edit hide" href="">Editar</a>';
                jqTds[(total + 1)].innerHTML = '<a class="cancel" data-mode="new" href="">Cancelar</a>';
                jqTds = aData;
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                var jqTds = $('>td', nRow);

                var total = jqInputs.length;
                for (i = 0; i < total; i++) {
                    oTable.fnUpdate(jqInputs[i].value, nRow, i, false);
                }
                //oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, total, false);
                $('a.save',jqTds).addClass('hide');// = '<a class="save" href="">Salvar</a>';
                $('a.edit',jqTds).removeClass('hide');// = '<a class="save" href="">Salvar</a>';
                oTable.fnUpdate('<a class="delete" href="">Excluir</a>', nRow, (total + 1), false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);

                var total = jqInputs.length;
                for (i = 0; i < total; i++) {
                    oTable.fnUpdate(jqInputs[i].value, nRow, i, false);
                }
                oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow,  (total + 1), false);
               // oTable.fnUpdate('<a class="delete" href="">Excluir</a>', nRow, (total + 1), false);
                oTable.fnDraw();
            }

            var oTable = $(idTable).dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "Todas"] // change per page values here
                ],
                // set the initial value
                "fixedColumns": true,
                "scrollY": "300px",
                "scrollX": true,
                "scrollCollapse": true,

                "iDisplayLength": 5,
                "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ linhas por pagina",
                    "oPaginate": {
                        "sPrevious": "Anterior",
                        "sNext": "Proxima",
                        "sFirst": "Primeiro",
                        "sLast": "Ultimo"
                    },
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sSearch": "Procurar:",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSortAscending": ": ativar para ordenar a coluna",
                    "sSortDescending": ": ativar para ordenar a coluna",
                    "sEmptyTable": "Nenhum registro para listar",
                    "sInfo": "Exibindo de _START_ a _END_ de um total de _TOTAL_ registros",
                    "sInfoEmpty": "Exibindo 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros no total)"
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });

            jQuery(idTable + '_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery(idTable + '_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

            var nEditing = null;

            $(idTable + '_new').click(function (e) {
               if(!adding){
                    e.preventDefault();
                    var funcCallback = $(this).attr('callback');
                    var newRowArray = [];
                    var aiNew = oTable.fnAddData(['', '', '', '',
                            '<a class="edit" href="">Editar</a>', '<a class="cancel" data-mode="new" href="">Cancelar</a>'
                    ]);
                    var nRow = oTable.fnGetNodes(aiNew[0]);
                    addRow(oTable, nRow);

                    $(nRow).attr('callback', funcCallback);

                    nEditing = nRow;
                    adding = true;
                }
            });

            $(idTable + ' a.delete').live('click', function (e) {
                e.preventDefault();
                adding = false;
                if (confirm("Deseja realmente excluir essa linha ?") == false) {
                    return;
                }

                 var nRow = $(this).parents('tr');

                var resp = window[nRow.attr("callback")]($(this)[0], true);

                if(resp == '-1')
                    restoreRow(oTable, nEditing);
                else
                    oTable.fnDeleteRow(nRow[0]);
                
                //var nRow = $(this).parents('tr')[0];

            });

            $(idTable + ' a.cancel').live('click', function (e) {
                e.preventDefault();
                adding = false;

                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });

            $(idTable + ' a.edit').live('click', function (e) {
                e.preventDefault();
                adding = true;
                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    //restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
            });

            $(idTable + ' a.save').live('click', function (e) {
                e.preventDefault();
                adding = false;
                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr');
                var resp = window[nRow.attr("callback")]($(this)[0], false);

                if(resp == '-1')
                    restoreRow(oTable, nEditing);
                else{
                    nRow.attr("atividade-id", resp);
                    saveRow(oTable, nEditing);
                }

                nEditing = null;
            });
        }

    };

}();