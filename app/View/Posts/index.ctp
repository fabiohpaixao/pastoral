<?php

	$this->Html->addCrumb('Posts');

?>
<div class="row">
      <div class="col-lg-12">

          <section class="panel">
              <header class="panel-heading clearfix">
                  <span class="pull-left"><?php echo __('Posts'); ?></span>

                   <?php echo $this->Html->link(__('<i class="icon-plus"></i> Novo Post'), array('controller' => 'posts', 'action' => 'adicionar'),array('class' => 'btn btn-success btn-shadow pull-right', 'escape' => false)); ?>
              </header>

          		<table class="table table-striped border-top table-hover" id="table">
                      <thead>
                      <tr>
                          <th>Titulo</th>
                          <th class="hidden-phone">Postado por</th>
                          <th class="hidden-phone">Comentários</th>
                          <th>Status</th>
                          <th>Ações</th>
                      </tr>
                      </thead>
                      <tbody>
						<?php foreach ($posts as $key => $post): ?>

    						<tr class="<?php echo ($key % 2 == 0) ? 'odd' : ''; ?> gradeX">
    							<td><?php echo $this->Html->link($post['Post']['titulo'], array('action' => 'visualizar', $post['Post']['id'])) ;?></td>
    							<td class="hidden-phone">
    								<?php echo $this->Html->link($post['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'visualizar', $post['Usuario']['id'])); ?>
    							</td>
                                <td class="hidden-phone">0</td>
                                <td ><?php echo h($post['Post']['status']); ?>&nbsp;</td>
    							<td class="actions">

    								<?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar'), array('action' => 'editar', $post['Post']['id']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>

    								<?php echo $this->Form->postLink(__('<i class="icon-trash"></i> Excluir'), array('action' => 'excluir', $post['Post']['id']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', $post['Post']['titulo'])); ?>
    							</td>
    						</tr>
 
					<?php endforeach; ?>

					</tbody>
				</table>
		</section>
	</div>
</div>