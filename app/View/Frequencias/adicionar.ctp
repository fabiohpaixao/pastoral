<?php

    $this->Html->addCrumb('Frequências', '/frequencias');
    $this->Html->addCrumb('Adicionar');

?>
<div class="row">
    <?php echo $this->Form->create('Feriado'); ?>
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-plus"></i> <?php echo __('Adicionar Feriado'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>

            <?php echo $this->Form->create('Frequencia', array('action' => 'add')); ?>
                <div class="panel-body">

                    <section class="panel">
                        <div class="panel-body">
                            <div class="form-group required">
                                <label for="FrequenciaData" class="col-sm-3 control-label">Data</label>
                                <div class="col-sm-5">
                                    <input name="data[Frequencia][data]" class="form-control" type="date" id="FrequenciaData" required="required">
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="accordion">
                                    <h3>Primeira Aula</h3>
                                    <div>
                                        <?php
                                            //echo $this->Form->input('Frequencia.data', $this->CustomInputs->getInput('date'));
                                            echo $this->Form->input('Frequencia.disciplina_id', array('type' => 'hidden', 'value' => $disciplinas[0]['Disciplina']['id']));
                                            foreach ($alunos as $aluno):
                                                echo $this->Form->input('Frequencia.presenca', array(
                                                    'name' => 'data[Frequencia][presenca][]',
                                                    'label' => $aluno['Usuario']['nome'],
                                                    'value' => $aluno['Aluno']['id'],
                                                    'checked' => 'checked',
                                                    'multiple' => 'checkbox',
                                                    'between' => '<div class="col-sm-9"><div class="switch switch-square">', 
                                                    'after' => '</div></div>')
                                                );
                                            endforeach; 
                                        ?>
                                    </div>
                                     <h3>Segunda Aula</h3>
                                    <div>
                                        <?php
                                            //echo $this->Form->input('Frequencia.data', $this->CustomInputs->getInput('date'));
                                            echo $this->Form->input('Frequencia.disciplina_id', array('type' => 'hidden', 'value' => $disciplinas[0]['Disciplina']['id']));
                                            foreach ($alunos as $aluno):
                                                echo $this->Form->input('Frequencia.presenca', array(
                                                    'name' => 'data[Frequencia][presenca][]',
                                                    'label' => $aluno['Usuario']['nome'],
                                                    'value' => $aluno['Aluno']['id'],
                                                    'checked' => 'checked',
                                                    'multiple' => 'checkbox',
                                                    'between' => '<div class="col-sm-9"><div class="switch switch-square">', 
                                                    'after' => '</div></div>')
                                                );
                                            endforeach; 
                                        ?>
                                    </div>
                                    <h3>Terceira Aula</h3>
                                    <div>
                                        <?php
                                            //echo $this->Form->input('Frequencia.data', $this->CustomInputs->getInput('date'));
                                            echo $this->Form->input('Frequencia.disciplina_id', array('type' => 'hidden', 'value' => $disciplinas[0]['Disciplina']['id']));
                                            foreach ($alunos as $aluno):
                                                echo $this->Form->input('Frequencia.presenca', array(
                                                    'name' => 'data[Frequencia][presenca][]',
                                                    'label' => $aluno['Usuario']['nome'],
                                                    'value' => $aluno['Aluno']['id'],
                                                    'checked' => 'checked',
                                                    'multiple' => 'checkbox',
                                                    'between' => '<div class="col-sm-9"><div class="switch switch-square">', 
                                                    'after' => '</div></div>')
                                                );
                                            endforeach; 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            <?php echo $this->Form->end(); ?>

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

    </div>
     <?php echo $this->Form->end(); ?>
</div>
<!--script for this page only-->
<?php echo $this->Html->script('/js/page.frequencias', array('inline' => false)); ?> 
<!-- END JAVASCRIPTS -->
