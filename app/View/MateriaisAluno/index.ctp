<?php

	$this->Html->addCrumb('Materiais');

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
                                        Materiais de <?= $disciplina['Disciplina']['nome'] ?>
                                    </header>
                                    <div class="panel-body">
                                        <div>
                                          <table class="table table-striped table-hover table-bordered" >
                                              <thead>
                                                  <tr>
                                                      <th>Nome</th>
                                                      <th>Arquivo</th>
                                                      <th>URL</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                <?php foreach ($materiais as $material): ?>
                                                    <?php if($material['Material']['disciplina_id'] != $disciplina['Disciplina']['id']) continue; ?>
                                                  <tr>
                                                    <td><?= $material['Material']['titulo'] ?></td>
                                                      <td class="right">
                                                        <?php echo (strlen($material['Material']['arquivo']) > 2) ? $this->Html->link(basename($material['Material']['arquivo']), $material['Material']['arquivo'], array('target' => '_blank')) : '' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo (strlen($material['Material']['url']) > 2) ? $this->Html->link('Acessar', $material['Material']['url'], array('target' => '_blank')) : '' ?>
                                                    </td>
                                                  </tr>
                                                <?php endforeach; ?>
                                              </tbody>
                                          </table>
                                      </div>
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
<?php //echo $this->Html->script('/js/editable-table', array('inline' => false)); ?> 
<?php //echo $this->Html->script('/js/page.atividades', array('inline' => false)); ?> 
<!-- END JAVASCRIPTS -->