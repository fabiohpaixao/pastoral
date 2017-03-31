<?php

	$this->Html->addCrumb('Periodos');

?>
<div class="row">
      <div class="col-lg-12">

          <section class="panel">
              <header class="panel-heading clearfix">
                  <span class="pull-left"><?php echo __('Usuários'); ?></span>

                   <?php echo $this->Html->link(__('<i class="icon-plus"></i> Novo Usuário'), array('controller' => 'periodos', 'action' => 'adicionar'),array('class' => 'btn btn-success btn-shadow pull-right', 'escape' => false)); ?>
              </header>

          		<table class="table table-striped border-top table-hover" id="table">
                      <thead>
                      <tr>
                          <th>Ativo</th>
                          <th>Titulo</th>
                          <th>Data Inicial</th>
                          <th>Data Final</th>
                          <th>Ações</th>
                      </tr>
                      </thead>
                      <tbody>
						<?php foreach ($periodos as $key => $periodo): ?>

    						<tr class="<?php echo ($key % 2 == 0) ? 'odd' : ''; ?> gradeX">
    							<td>
    								<?php $class =  $periodo['Periodo']['ativo'] ? 'success' : 'danger'; ?>
    								<?php $txt =  $periodo['Periodo']['ativo'] ? 'Sim' : 'Não'; ?>
                                	<?php echo $this->Html->tag('span', $txt, array('class' => 'label label-' . $class)); ?></td>
    							<td><?php echo __($periodo['Periodo']['titulo']) ;?></td>
                  <td class="hidden-phone"><?php echo date('d/m/Y', strtotime($periodo['Periodo']['data_inicio'])); ?>&nbsp;</td>
                  <td class="hidden-phone"><?php echo date('d/m/Y', strtotime($periodo['Periodo']['data_fim'])); ?>&nbsp;</td>
    							<td class="actions">

    								<?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar'), array('action' => 'editar', $periodo['Periodo']['id']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>

    								<?php echo $this->Form->postLink(__('<i class="icon-trash"></i> Excluir'), array('action' => 'excluir', $periodo['Periodo']['id']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', $periodo['Periodo']['titulo'])); ?>
    							</td>
    						</tr>
					<?php endforeach; ?>

					</tbody>
				</table>
		</section>
	</div>
</div>