<?php

    $this->Html->addCrumb('Clientes', '/clientes');
    $this->Html->addCrumb('Editar');

?>
<div class="row">
    <?php echo $this->Form->create('Cliente', array('action' => 'editar')); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-plus"></i> <?php echo __('Editar Clientes'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
              <div class="panel-body">
                <?php
                    echo $this->Form->input('nome');
                    echo $this->Form->input('fator',$this->CustomInputs->getInput('decimal'));
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