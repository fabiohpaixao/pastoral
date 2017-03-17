<?php

	$this->Html->addCrumb('Turmas');

?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading clearfix">
                <span class="pull-left"><?php echo __('Turmas'); ?></span>
                
                <?php echo $this->Html->link(__('<i class="icon-plus"></i> Nova Turma'), array('controller' => 'turma', 'action' => 'adicionar'),array('class' => 'btn btn-success btn-shadow pull-right', 'escape' => false)); ?>
            </header>

            <table class="table table-striped border-top table-hover" id="table">
                <thead>
                    <tr>
                        <th>Ativo</th>
                        <th>Nome</th>
                        <th>Data de Inicio</th>
                        <th>Data de Termino</th>
                       
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($turmas as $key => $turma): ?>
                    <tr class="<?php echo ($key % 2 == 0) ? 'odd' : ''; ?> gradeX">
                        <td>
                            <?php $class =  $turma['Turma']['ativo'] ? 'success' : 'danger'; ?>
                            <?php $txt =  $turma['Turma']['ativo'] ? 'Sim' : 'Não'; ?>
                            <?php echo $this->Html->tag('span', $txt, array('class' => 'label label-' . $class)); ?>
                        </td>
                        <td><?php echo h($turma['Turma']['nome']); ?></td>
                        <td><?php echo h($turma['Turma']['data_inicio']); ?></td>
                        <td><?php echo h($turma['Turma']['data_fim']); ?></td>
                       
                        <td class="actions">
                            <?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar'), array('action' => 'editar', $turma['Turma']['id']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>
                            <?php echo $this->Form->postLink(__('<i class="icon-trash"></i> Excluir'), array('action' => 'excluir', $turma['Turma']['id']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', $turma['Turma']['codigo'])); ?>
    					</td>
                    </tr>
				<?php endforeach; ?>
                </tbody>
			</table>
	   </section>
	</div>
</div>