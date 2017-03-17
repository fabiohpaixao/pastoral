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
