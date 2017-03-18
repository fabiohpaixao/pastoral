<?php

	$this->Html->addCrumb('Materiais');

?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading clearfix">
                <span class="pull-left"><?php echo __('Materiais'); ?></span>
                
                <?php echo $this->Html->link(__('<i class="icon-plus"></i> Nova Material'), array('controller' => 'materiais', 'action' => 'adicionar'),array('class' => 'btn btn-success btn-shadow pull-right', 'escape' => false)); ?>
            </header>

            <table class="table table-striped border-top table-hover" id="table">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>URL</th>
                        <th>Arquivo</th>
                        <th>Disciplina</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($materiais as $key => $material): ?>
                    <tr class="<?php echo ($key % 2 == 0) ? 'odd' : ''; ?> gradeX">
                        <td><?php echo h($material['Material']['titulo']); ?></td>
                        <td><?php echo $this->Html->link(substr($material['Material']['url'], 0, 30),$material['Material']['url'], array('target' => '_blank')); ?></td>
                        <td><?php echo h($material['Material']['arquivo']); ?></td>

                        <td>
                            <?php
                                echo h($material['Disciplina']['nome']);
                                //echo $this->Html->link($material['Disciplina']['nome'], array('controller' => 'disciplinas', 'action' => 'visualizar', $material['Disciplina']['id']), array('class' => 'btn btn-primary', 'target' => '_blank', 'style' => 'border:none; background: #' . substr(dechex(crc32($material['Disciplina']['nome'])), 0, 6)));
                            ?>
                        </td>
                       
                        <td class="actions">
                            <?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar'), array('action' => 'editar', $material['Material']['id']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>
                            <?php echo $this->Form->postLink(__('<i class="icon-trash"></i> Excluir'), array('action' => 'excluir', $material['Material']['id']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', $material['Material']['titulo'])); ?>
    					</td>
                    </tr>
				<?php endforeach; ?>
                </tbody>
			</table>
	   </section>
	</div>
</div>