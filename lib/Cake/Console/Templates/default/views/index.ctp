<?php 
    echo "<?php \$this->Html->addCrumb('{$pluralHumanName}'); ?>";
?>
<div class="row">
  <div class="col-lg-12">

      <section class="panel">
          <header class="panel-heading clearfix">
              <span class="pull-left"><?php echo $pluralHumanName; ?></span>

              <?php 

                    echo "\t\t<?php echo \$this->Html->link('<i class=\"icon-plus\"></i> Adicionar " . $singularHumanName . "', array('action' => 'adicionar'),array('class' => 'btn btn-success btn-shadow pull-right', 'escape' => false)); ?>";
                ?>
          </header>

          <table class="table table-striped border-top table-hover" id="table">
            <thead>
                <tr>
                   <?php foreach ($fields as $field): ?>
                      <th><?php echo ucfirst($field) ?></th>
                  <?php endforeach; ?>
                  <th class="actions">Ações</th>
                </tr>
            </thead>
            <tbody>
          <?php
              echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
              echo "\t<tr>\n";
              foreach ($fields as $field) {
                 $isKey = false;
                 if (!empty($associations['belongsTo'])) {
                    foreach ($associations['belongsTo'] as $alias => $details) {
                       if ($field === $details['foreignKey']) {
                          $isKey = true;
                          echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
                          break;
                      }
                  }
              }
              if ($isKey !== true) {
                echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
              }
           }

            echo "\t\t<td class=\"actions\">\n";
            echo "\t\t\t<?php echo \$this->Html->link('<i class=\"icon-eye-open\"></i> Ver', array('action' => 'visualizar', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-primary btn-shadow', 'escape' => false)); ?>\n";

            echo "\t\t\t<?php echo \$this->Html->link('<i class=\"icon-pencil\"></i> Editar', array('action' => 'editar', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>\n";

            echo "\t\t\t<?php echo \$this->Form->postLink('<i class=\"icon-trash\"></i> Excluir', array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";

            echo "\t\t</td>\n";
            echo "\t</tr>\n";

            echo "<?php endforeach; ?>\n";

        ?>
            </tbody>
        </table>

    </section>
  </div>
</div>