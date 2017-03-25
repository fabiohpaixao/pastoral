<?php
	$this->Html->addCrumb('Frequências');
?>
<div class="row">
    <?php if (count($turmas)>1): ?>
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading clearfix">
                <span class="pull-left"><?php echo __('Selecione a turma'); ?></span>
            </header>
            <div class="panel-body">
                <div class="btn-row">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-success active">
                            <input type="radio" name="options" id="option1"> Option 1
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="options" id="option2"> Option 2
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="options" id="option3"> Option 3
                        </label>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php endif; ?>
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading clearfix">
                <span class="pull-left"><?php echo __('Frequências'); ?></span>
            </header>
            <!--tab nav start-->
            <section class="panel">
                <header class="panel-heading tab-bg-dark-navy-blue ">
                    <ul class="nav nav-tabs">
                    <?php $active = 'active'; ?>
                    <?php foreach ($disciplinas as $disciplina): ?>
                        <li class="<?= $active ?>">
                            <a data-toggle="tab" href="#<?= $disciplina['Disciplina']['id'] ?>"><?= $disciplina['Disciplina']['nome'] ?></a>
                        </li>
                        <?php $active = ''; ?>
                    <?php endforeach; ?>
                    </ul>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <?php $active = 'active'; ?>
                        <?php foreach ($disciplinas as $disciplina): ?>
                            <div id="<?= $disciplina['Disciplina']['id'] ?>" class="tab-pane <?= $active ?>">
                                <!-- page start-->
                                <section class="panel">
                                    <header class="panel-heading">
                                        Frequencias de <?= $disciplina['Disciplina']['nome'] ?>
                                    </header>
                                    <div class="panel-body">
                                      <a type="button" class="btn btn-success pull-right" data-toggle="modal" href="#modal-frequencia"><i class="icon-plus"></i> Adicionar Frequência </a>
                                      <table class="table table-striped table-advance table-hover">
                                          <thead>
                                          <tr>
                                              <th width="100px"><i class="icon-barcode"></i> RA</th>
                                              <th width="150px"><i class="icon-group"></i> Nome</th>
                                              <?php foreach ($disciplina['Frequencia'] as $frequencia): ?>
                                                <th  width="10px"><i class="icon-book"></i> <?php echo date ( 'd/m', $frequencia['data']) ?></th>
                                              <?php endforeach; ?>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php foreach ($alunos as $aluno): ?>
                                              <?php if($aluno['Aluno']['turma_id'] != $disciplina['Disciplina']['turma_id']) continue; ?>
                                              <tr aluno-id="<?php echo $aluno['Aluno']['id']  ?>">
                                                  <td><?php echo $aluno['Aluno']['ra'] ?></td>
                                                  <td><?php echo $aluno['Usuario']['nome'] ?></td>
                                                  <?php foreach ($aluno['Frequencia'] as $frequencia): ?>
                                                    <td>
                                                          <span> <?php echo $frequencia['presenca'] ? 'x' : '-'; ?> </span>
                                                    </td>
                                                  <?php endforeach; ?>
                                              </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>
                                              
                                      <!-- page end-->
                                </section>
                            </div>
                            <!-- page end-->
                            <?php $active = ''; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
		</section>
	</div>
</div>

<!-- Modal -->
<div class="modal fade " id="modal-frequencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Adicionar Frequencia</h4>
            </div>
            <?php echo $this->Form->create('Frequencia', array('action' => 'add')); ?>
                <div class="modal-body">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="form-group required">
                                <label for="FrequenciaData" class="col-sm-3 control-label">Data</label>
                                <div class="col-sm-5">
                                    <input name="data[Frequencia][data]" class="form-control" type="date" id="FrequenciaData" required="required">
                                </div>
                            </div>
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
                    </section>
                </div>
                <div class="modal-footer">
                    <?php echo $this->Form->button('<i class="icon-close"></i> Cancelar', array('type' => 'reset', 'data-dismiss' => "modal", 'class' => 'btn btn-default btn-shadow', 'escape' => false)); ?>
                    <?php echo $this->Form->button('<i class="icon-save"></i> Salvar', array('type' => 'submit', 'class' => 'btn btn-success btn-shadow', 'escape' => false)); ?>
                </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<!-- modal -->
<!--script for this page only-->
<?php echo $this->Html->script('/js/page.frequencias', array('inline' => false)); ?> 
<!-- END JAVASCRIPTS -->