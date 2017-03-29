<?php

    $this->Html->addCrumb('Usuários', '/usuarios');
    $this->Html->addCrumb('Alterar senha');

?>
<div class="row">
    <?php echo $this->Form->create('Usuario'); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-lock"></i> <?php echo __('Alterar senha'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
              <div class="panel-body">
                  <div class="panel-body">
                    <?php
                        echo $this->Form->input('senha_atual', array('type' => 'password', 'required'));
                        echo $this->Form->input('nova_senha', array('type' => 'password', 'required'));
                        echo $this->Form->input('confirmar_senha', array('type' => 'password', 'required'));
                    ?>
                  </div>
              </div>
          </section>
          <!--user info table end-->
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