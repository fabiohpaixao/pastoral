<?php

    $this->Html->addCrumb('Feriados', '/feriados');
    $this->Html->addCrumb('Editar');

?>
<div class="row">
    <?php echo $this->Form->create('Feriado', array('action' => 'editar')); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-plus"></i> <?php echo __('Editar Feriado'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label for="FeriadoData" class="col-sm-3 control-label">Data</label>
                    <div class="col-md-3 col-xs-11">
                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="<?php echo date('d-m-Y', strtotime($feriado['Feriado']['data'])); ?>"  class="input-append date dpYears">
                            <input type="text" name="data[Feriado][data]" id="FeriadoData" readonly="" value="<?php echo date('d-m-Y', strtotime($feriado['Feriado']['data'])); ?>" size="16" class="form-control">
                            <span class="input-group-btn add-on">
                                <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <?php
                    // // echo $this->Form->input('data', array(
                    //     'type' => 'text', 
                    //     'class' => "form-control", 
                    //     'readonly' => true, 
                    //     'size' => 16,
                    //     'before' => '<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="12-02-2012"  class="input-append date dpYears">',
                    //     'after' => '<span class="input-group-btn add-on"><button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button></span></div>'
                    //     ));
                    echo $this->Form->input('descricao', array('type' => 'textarea'));
                    
                    // echo $this->Form->input('data',array('type' => , 'data'));
                    
                    // echo $this->Form->input('usuario');
                    // echo $this->Form->input('telefone', array('class' => 'tel form-control'));
                    // echo $this->Form->input('avatar', array('type' => 'file'));
                ?>    
              </div>
          </section>

    </div>
    <div class="col-lg-3">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-cog"></i> Açoes</span>
            </header>
            <div class="panel-body">
                <?php echo $this->Form->button('<i class="icon-save"></i> Salvar', array('type' => 'submit', 'class' => 'btn btn-success btn-shadow', 'escape' => false)); ?>

                <?php echo $this->Form->button('<i class="icon-refresh"></i> Limpar', array('type' => 'reset', 'class' => 'btn btn-default btn-shadow', 'escape' => false)); ?>
            </div>
        </section>

    </div>
     <?php echo $this->Form->end(); ?>
</div>
