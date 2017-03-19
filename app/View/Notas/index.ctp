<?php

	$this->Html->addCrumb('Notas');

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
                <span class="pull-left"><?php echo __('Disciplinas'); ?></span>
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
                                        Notas de <?= $disciplina['Disciplina']['nome'] ?>
                                    </header>
                                    <div class="panel-body">
                                        
                                      <table class="table table-striped table-advance table-hover">
                                          <thead>
                                          <tr>
                                              <th class="col-md-1"><i class="icon-barcode"></i> RA</th>
                                              <th><i class="icon-group"></i> Nome</th>
                                              <?php foreach ($disciplina['Atividade'] as $atividade): ?>
                                                <th class="col-md-2"><i class="icon-book"></i> <?php echo $atividade['descricao'] ?></th>
                                              <?php endforeach; ?>
                                              <th class="col-md-1"></th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php foreach ($alunos as $aluno): ?>
                                              <?php if($aluno['Aluno']['turma_id'] != $disciplina['Disciplina']['turma_id']) continue; ?>
                                              <tr>
                                                  <td><?php echo $aluno['Aluno']['ra'] ?></td>
                                                  <td><?php echo $aluno['Usuario']['nome'] ?></td>
                                                  <?php foreach ($disciplina['Atividade'] as $atividade): ?>
                                                    <td><input type="number" class="form-control" width="10px" name=""></td>
                                                  <?php endforeach; ?>
                                                  <th>
                                                    <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                                    <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                                  </th>
                                              </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>
                                              
                                      <!-- page end-->
                                  </section>
                                  </div>
                                </section>
                                <!-- page end-->
                            </div>
                            <?php $active = ''; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
		</section>
	</div>
</div>

<!--script for this page only-->
<?php echo $this->Html->script('/js/page.notas', array('inline' => false)); ?> 
<!-- END JAVASCRIPTS -->