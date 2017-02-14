<?php

	$this->Html->addCrumb('Usuários');

?>
<div class="row">
      <div class="col-lg-12">

          <section class="panel">
              <header class="panel-heading clearfix">
                  <span class="pull-left"><?php echo __('Usuários'); ?></span>

                   <?php echo $this->Html->link(__('<i class="icon-plus"></i> Novo Usuário'), array('controller' => 'usuarios', 'action' => 'adicionar'),array('class' => 'btn btn-success btn-shadow pull-right', 'escape' => false)); ?>
              </header>

          		<table class="table table-striped border-top table-hover" id="table">
                      <thead>
                      <tr>
                          <th>Ativo</th>
                          <th>Nome</th>
                          <th class="hidden-phone">Email</th>
                          <th class="hidden-phone">Usuário</th>
                          <th>Grupo</th>
                          <th>Ações</th>
                      </tr>
                      </thead>
                      <tbody>
						<?php foreach ($usuarios as $key => $usuario): ?>

    						<tr class="<?php echo ($key % 2 == 0) ? 'odd' : ''; ?> gradeX">
    							<td>
    								<?php $class =  $usuario['Usuario']['ativo'] ? 'success' : 'danger'; ?>
    								<?php $txt =  $usuario['Usuario']['ativo'] ? 'Sim' : 'Não'; ?>
                                	<?php echo $this->Html->tag('span', $txt, array('class' => 'label label-' . $class)); ?></td>
    							<td><?php echo $this->Html->link($usuario['Usuario']['nome'], array('action' => 'visualizar', $usuario['Usuario']['id'])) ;?></td>
    							<td class="hidden-phone"><?php echo $this->Html->link(__($usuario['Usuario']['email']), 'mailto:'. $usuario['Usuario']['email']); ?>&nbsp;</td>
    							<td class="hidden-phone"><?php echo h($usuario['Usuario']['usuario']); ?>&nbsp;</td>
    							<td>
    								<?php echo $this->Html->link($usuario['Grupo']['nome'], array('controller' => 'grupos', 'action' => 'visualizar', $usuario['Grupo']['id'])); ?>
    							</td>
    							<td class="actions">

    								<?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar'), array('action' => 'editar', $usuario['Usuario']['id']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>

    								<?php echo $this->Form->postLink(__('<i class="icon-trash"></i> Excluir'), array('action' => 'excluir', $usuario['Usuario']['id']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', $usuario['Usuario']['nome'])); ?>
    							</td>
    						</tr>
					<?php endforeach; ?>

					</tbody>
				</table>
		</section>
	</div>
</div>