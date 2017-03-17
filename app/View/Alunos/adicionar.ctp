<?php

    $this->Html->addCrumb('Alunos', '/alunos');
    $this->Html->addCrumb('Adicionar');

?>
<div class="row">
    <?php echo $this->Form->create('Aluno', array('type' => 'file')); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-plus"></i> <?php echo __('Adicionar Aluno'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
              <div class="panel-body">
                <?php
                    
                    echo $this->Form->input('ra', array('value' => $ra));
                    echo $this->Form->input('nome');
                    echo $this->Form->input('email');
                    echo $this->Form->input('confirmar_email', array('autocomplete' => 'false', 'type' => 'email'));
                    echo $this->Form->input('telefone', array('class' => 'tel form-control'));
                    //echo $this->Form->input('avatar', array('type' => 'file'));
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
                <?php echo $this->Form->button('<i class="icon-plus"></i> Adicionar', array('type' => 'submit', 'class' => 'btn btn-success btn-shadow', 'escape' => false)); ?>

                <?php echo $this->Form->button('<i class="icon-refresh"></i> Limpar', array('type' => 'reset', 'class' => 'btn btn-default btn-shadow', 'escape' => false)); ?>
            </div>
        </section>

        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-th-large"></i> Opçoes</span>
            </header>
            <div class="panel-body">
                <?php 
                    echo $this->Form->input('ativo', array(
                        'checked' => 'checked',
                        'between' => '<div class="col-sm-9"><div class="switch switch-square">', 
                        'after' => '</div></div>'));
                    echo $this->Form->input('turma_id'); ?>
            </div>
        </section>

    </div>
     <?php echo $this->Form->end(); ?>
</div>