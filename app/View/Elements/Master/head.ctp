<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='robots' content='noindex,nofollow' />
    <title>CURSOS - <?php echo $title_for_layout; ?></title>
    <?php
        //meta
        echo $this->Html->meta('icon');

        //Bootstrap core CSS
        echo $this->Html->css('/css/bootstrap.min');
        echo $this->Html->css('/css/bootstrap-reset');

        //External css
        echo $this->Html->css('/css/../assets/font-awesome/css/font-awesome');

        //Data picker
        echo $this->Html->css('/css/../assets/bootstrap-datepicker/css/datepicker');
        echo $this->Html->css('/css/../assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min');

        // Mult select
        echo $this->Html->css('/css/../assets/jquery-multi-select/css/multi-select');

        //Autocomplete
        echo $this->Html->css('/css/jquery.autocomplete');
       
        //toastr
        echo $this->Html->css('/css/../assets/toastr/css/toastr.min');

        //DataTable
        echo $this->Html->css('/css/../assets/data-tables/DataTables-1.10.13/css/dataTables.bootstrap.min');
        echo $this->Html->css('/css/../assets/data-tables/FixedColumns-3.2.2/css/fixedColumns.bootstrap.min');
        //echo $this->Html->css('/css/../assets/data-tables/Responsive-2.1.1/css/responsive.bootstrap.min.css');
        /*
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.13/css/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="FixedColumns-3.2.2/css/fixedColumns.bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="Responsive-2.1.1/css/responsive.bootstrap.min.css"/>
        
        
        <link rel="stylesheet" type="text/css" href="AutoFill-2.1.3/css/autoFill.bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="Buttons-1.2.4/css/buttons.bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="ColReorder-1.3.2/css/colReorder.bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="FixedHeader-3.1.2/css/fixedHeader.bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="KeyTable-2.2.0/css/keyTable.bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="RowReorder-1.2.0/css/rowReorder.bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="Scroller-1.4.2/css/scroller.bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="Select-1.2.0/css/select.bootstrap.min.css"/>
        */
       

        //Custom styles for this template (index)
        echo $this->Html->css('/css/style.css');
        echo $this->Html->css('/css/style-responsive.css');

        //render
        echo $this->fetch('meta');
        echo $this->fetch('css');

    ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
