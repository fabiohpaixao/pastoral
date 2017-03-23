
    <div id="footer">
        <small>CURSOS <?php echo date("Y") ?></small>
    </div>

    <?php 

        //Global
        echo $this->Html->script('/js/jquery');
        echo $this->Html->script('/js/bootstrap.min');
        echo $this->Html->script('/js/jquery.scrollTo.min');
        echo $this->Html->script('/js/jquery.nicescroll');

        //Tables
        //echo $this->Html->script('/js/../assets/data-tables/jquery.dataTables');
        //echo $this->Html->script('/js/../assets/data-tables/DT_bootstrap');
        echo $this->Html->script('/js/../assets/data-tables/DataTables-1.10.13/js/jquery.dataTables.min');
        echo $this->Html->script('/js/../assets/data-tables/FixedColumns-3.2.2/js/dataTables.fixedColumns.min');
        echo $this->Html->script('/js/../assets/data-tables/DataTables-1.10.13/js/dataTables.bootstrap.min');
        //echo $this->Html->script('/js/../assets/data-tables/Responsive-2.1.1/js/responsive.bootstrap.min');
        echo $this->Html->script('/js/dynamic-table');
        /*
        <script type="text/javascript" src="DataTables-1.10.13/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="DataTables-1.10.13/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="FixedColumns-3.2.2/js/dataTables.fixedColumns.min.js"></script>
        <script type="text/javascript" src="Responsive-2.1.1/js/responsive.bootstrap.min.js"></script>
        
        <script type="text/javascript" src="JSZip-2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="pdfmake-0.1.18/build/pdfmake.min.js"></script>
        <script type="text/javascript" src="pdfmake-0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="AutoFill-2.1.3/js/dataTables.autoFill.min.js"></script>
        <script type="text/javascript" src="AutoFill-2.1.3/js/autoFill.bootstrap.min.js"></script>
        <script type="text/javascript" src="Buttons-1.2.4/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="Buttons-1.2.4/js/buttons.bootstrap.min.js"></script>
        <script type="text/javascript" src="Buttons-1.2.4/js/buttons.colVis.min.js"></script>
        <script type="text/javascript" src="Buttons-1.2.4/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="Buttons-1.2.4/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="Buttons-1.2.4/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="ColReorder-1.3.2/js/dataTables.colReorder.min.js"></script>
        <script type="text/javascript" src="FixedHeader-3.1.2/js/dataTables.fixedHeader.min.js"></script>
        <script type="text/javascript" src="KeyTable-2.2.0/js/dataTables.keyTable.min.js"></script>
        <script type="text/javascript" src="Responsive-2.1.1/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="RowReorder-1.2.0/js/dataTables.rowReorder.min.js"></script>
        <script type="text/javascript" src="Scroller-1.4.2/js/dataTables.scroller.min.js"></script>
        <script type="text/javascript" src="Select-1.2.0/js/dataTables.select.min.js"></script>
        */
        
        //Switchs
        echo $this->Html->script('/js/bootstrap-switch.js');

        //Validation
        echo $this->Html->script('/js/jquery.validate');

        //Masks
        echo $this->Html->script('/js/jquery.maskedinput.min');

        //CKeditor
        echo $this->Html->script('/js/../assets/ckeditor/ckeditor.js');

        // Multi Select
        echo $this->Html->script('/js/../assets/jquery-multi-select/js/jquery.multi-select');
  
        // Quick Search
        echo $this->Html->script('/js/../assets/jquery-multi-select/js/jquery.quicksearch');

        //Datapicker
        echo $this->Html->script('/js/../assets/bootstrap-datepicker/js/bootstrap-datepicker.pt-br');

        echo $this->Html->script('/js/../assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min');
        echo $this->Html->script('/js/../assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.pt-br');

        //Tags input
        echo $this->Html->script('/js/jquery.tagsinput');
        echo $this->Html->script('/js/jquery.autocomplete.min');

        // custom inputs
        echo $this->Html->script('/js/advanced-form-components');

        //Mask Money
        echo $this->Html->script('/js/mask-money');
        
        //toastr
        echo $this->Html->script('/js/../assets/toastr/js/toastr.min');

        //Render
        echo $this->Html->script('/js/common-scripts');
        echo $this->fetch('script');


    ?>

    <?php //echo $this->element('sql_dump'); ?>
</body>
</html>
