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
                                                <th class="col-md-1"><i class="icon-book"></i> <?php echo $atividade['descricao'] ?></th>
                                              <?php endforeach; ?>
                                              <th class="col-md-2"></th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php foreach ($alunos as $aluno): ?>
                                              <?php if($aluno['Aluno']['turma_id'] != $disciplina['Disciplina']['turma_id']) continue; ?>
                                              <tr aluno-id="<?php echo $aluno['Aluno']['id']  ?>">
                                                  <td><?php echo $aluno['Aluno']['ra'] ?></td>
                                                  <td><?php echo $aluno['Usuario']['nome'] ?></td>
                                                  <?php foreach ($disciplina['Atividade'] as $atividade): ?>
                                                    <td class="notas-atividades" atividade-id="<?php echo $atividade['id'] ?>">
                                                      <?php 
                                                        $notaAluno='';
                                                        foreach ($aluno['Nota'] as $nota) {
                                                          if($nota['atividade_id'] == $atividade['id']){
                                                            $notaAluno = $nota;
                                                            break;
                                                          }
                                                        }

                                                        if($notaAluno): ?>
                                                          <span class="nota-aluno"><?php echo $notaAluno['valor'] ?></span>
                                                          <input type="number" nota-id="<?php echo $notaAluno['id'] ?>" class="form-control hide nota-aluno width="10px" name="">
                                                        <?php else: ?>
                                                          <span></span>
                                                        <?php endif; ?>
                                                    </td>
                                                  <?php endforeach; ?>
                                                  <td class="edit-notas">
                                                    <button class="btn btn-success btn-ms hide tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Salvar" ><i class="icon-ok"></i></button>
                                                    <button class="btn btn-danger btn-ms hide tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Cancelar" ><i class="icon-times"></i></button>
                                                    <button class="btn btn-primary btn-ms tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Editar" ><i class="icon-pencil"></i></button>
                                                  </td>
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