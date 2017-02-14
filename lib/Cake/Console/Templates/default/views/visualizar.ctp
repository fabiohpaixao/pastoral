<?php
      echo "<?php \$this->Html->addCrumb('{$pluralHumanName}', '/{$pluralVar}'); ?>";
      echo "<?php \$this->Html->addCrumb('Visualizar'); ?>";
?>
<div class="row">
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-eye-open"></i> Visualizar <?php echo $singularHumanName; ?></span>
            <?php
                    echo "\t\t<?php echo \$this->Html->link('<i class=\"icon-chevron-left\"></i> Voltar', array('action' => 'index'),array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>";
            ?>
            </header>
            <table class="table table-hover personal-task">
                  <tbody>
                  <?php
                    foreach ($fields as $field) {
                        $isKey = false;
                        if (!empty($associations['belongsTo'])) {
                            foreach ($associations['belongsTo'] as $alias => $details) {
                                if ($field === $details['foreignKey']) {
                                    $isKey = true;
                                    echo "\t\t<tr><td><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></td>\n";
                                    echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t&nbsp;\n\t\t</td></tr>\n";
                                    break;
                                }
                            }
                        }
                        if ($isKey !== true) {
                            echo "\t\t<tr><td><?php echo __('" . Inflector::humanize($field) . "'); ?></td>\n";
                            echo "\t\t<td>\n\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t&nbsp;\n\t\t</td></tr>\n";
                        }
                    }
                  ?>
                  
                  </tbody>
              </table>
          </section>
    </div>

     <div class="col-lg-3">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-reorder"></i> Detalhes</span>
            </header>
              <table class="table table-hover personal-task">
                  <tbody>
                 
                  </tbody>
              </table>
        </section>

        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-cog"></i> Açoes</span>
            </header>
            <div class="panel-body">

            <?php 

                echo "\t<?php echo \$this->Html->link('<i class=\"icon-pencil\"></i> Editar', array('action' => 'editar', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>\n";

                echo "\t<?php echo \$this->Form->postLink('<i class=\"icon-trash\"></i> Excluir', array('action' => 'excluir', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";

            ?>

            </div>
        </section>
    </div>

</div>