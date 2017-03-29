<?php

    $this->Html->addCrumb('Disciplinas', '/disciplinas');
    $this->Html->addCrumb('Adicionar');

?>
<div class="row">
    <?php echo $this->Form->create('Disciplina'); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-plus"></i> <?php echo __('Adicionar Disciplina'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
              <div class="panel-body">
                <?php
                    echo $this->Form->input('Disciplina.nome');
                    echo $this->Form->input('Disciplina.turma_id', array('options' => $turmas, 'multiple' => false));
                    echo $this->Form->input('Disciplina.professor_id', array('options' => $professores, 'multiple' => false));
                    //echo $this->Form->input('data_inicio',$this->CustomInputs->getInput('date'));
                    //echo $this->Form->input('data_fim',$this->CustomInputs->getInput('date'));
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
                <?php echo $this->Form->button('<i class="icon-save"></i> Adicionar', array('type' => 'submit', 'class' => 'btn btn-success btn-shadow', 'escape' => false)); ?>

                <?php echo $this->Form->button('<i class="icon-refresh"></i> Limpar', array('type' => 'reset', 'class' => 'btn btn-default btn-shadow', 'escape' => false)); ?>
            </div>
        </section>

    </div>
     <?php echo $this->Form->end(); ?>
</div>