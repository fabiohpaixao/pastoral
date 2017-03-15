<?php

	$this->Html->addCrumb('Disciplinas');

?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading clearfix">
                <span class="pull-left"><?php echo __('Disciplinas'); ?></span>
                
                <?php echo $this->Html->link(__('<i class="icon-plus"></i> Nova Disciplina'), array('controller' => 'disciplina', 'action' => 'adicionar'),array('class' => 'btn btn-success btn-shadow pull-right', 'escape' => false)); ?>
            </header>

            <table class="table table-striped border-top table-hover" id="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Turma</th>
                        <th>Professor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($disciplinas as $key => $disciplina): ?>
                    <tr class="<?php echo ($key % 2 == 0) ? 'odd' : ''; ?> gradeX">
                        <td><?php echo h($disciplina['Disciplina']['nome']); ?></td>
                        <td><?php echo h($disciplina['Turma']['nome']); ?></td>
                        <?php if(isset($disciplina['Professor']['Usuario'])): ?>
                            <td><?php echo h($disciplina['Professor']['Usuario']['nome']); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                       
                        <td class="actions">
                            <?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar'), array('action' => 'editar', $disciplina['Disciplina']['id']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>
                            <?php echo $this->Form->postLink(__('<i class="icon-trash"></i> Excluir'), array('action' => 'excluir', $disciplina['Disciplina']['id']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', $disciplina['Disciplina']['nome'])); ?>
    					</td>
                    </tr>
				<?php endforeach; ?>
                </tbody>
			</table>
	   </section>
	</div>
</div>