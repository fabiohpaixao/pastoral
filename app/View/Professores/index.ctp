<?php

	$this->Html->addCrumb('Professores');

?>
<div class="row">
      <div class="col-lg-12">

          <section class="panel">
              <header class="panel-heading clearfix">
                  <span class="pull-left"><?php echo __('Professores'); ?></span>

                   <?php echo $this->Html->link(__('<i class="icon-plus"></i> Novo Professor'), array('controller' => 'professores', 'action' => 'adicionar'),array('class' => 'btn btn-success btn-shadow pull-right', 'escape' => false)); ?>
              </header>

          		<table class="table table-striped border-top table-hover" id="table">
                      <thead>
                      <tr>
                          <th>Ativo</th>
                          <th class="hidden-phone">RP</th>
                          <th>Nome</th>
                          <th class="hidden-phone">Email</th>
                          <th>Ações</th>
                      </tr>
                      </thead>
                      <tbody>
						<?php foreach ($professores as $key => $aluno): ?>

    						<tr class="<?php echo ($key % 2 == 0) ? 'odd' : ''; ?> gradeX">
    							<td>
    								<?php $class =  $aluno['Usuario']['ativo'] ? 'success' : 'danger'; ?>
    								<?php $txt =  $aluno['Usuario']['ativo'] ? 'Sim' : 'Não'; ?>
                                	<?php echo $this->Html->tag('span', $txt, array('class' => 'label label-' . $class)); ?></td>
    							<td class="hidden-phone"><?php echo h($aluno['Professor']['rp']); ?>&nbsp;</td>
                  <td><?php echo $this->Html->link($aluno['Usuario']['nome'], array('action' => 'visualizar', $aluno['Professor']['id'])) ;?></td>
                  <td class="hidden-phone"><?php echo $this->Html->link(__($aluno['Usuario']['email']), 'mailto:'. $aluno['Usuario']['email']); ?>&nbsp;</td>
    							<td class="actions">

    								<?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar'), array('action' => 'editar', $aluno['Professor']['id']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>

    								<?php echo $this->Form->postLink(__('<i class="icon-trash"></i> Excluir'), array('action' => 'excluir', $aluno['Professor']['id']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', $aluno['Usuario']['nome'])); ?>
    							</td>
    						</tr>
					<?php endforeach; ?>

					</tbody>
				</table>
		</section>
	</div>
</div>