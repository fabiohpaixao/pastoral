
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
        echo $this->Html->script('/js/../assets/data-tables/jquery.dataTables');
        echo $this->Html->script('/js/../assets/data-tables/DT_bootstrap');
        echo $this->Html->script('/js/dynamic-table');

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
