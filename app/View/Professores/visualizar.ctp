<?php

    $this->Html->addCrumb('Usuários', '/kadmin/usuarios');
    $this->Html->addCrumb('Visualizar');

?>
<div class="row">
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-eye-open"></i> <?php echo __('Visualizar Usuário'); ?></span>

              <?php echo $this->Html->link(__('<i class="icon-chevron-left"></i> Voltar'), array('action' => 'index'), array('class' => 'btn btn-default btn-shadow pull-right', 'escape' => false)); ?>

            </header>
              <div class="panel-body">
                  <a href="#" class="task-thumb">
                    <?php 

                        if($usuario['Usuario']['avatar'])
                            echo $this->Html->image($usuario['Usuario']['avatar']);
                        else
                            echo $this->Html->image('../Kadmin/img/avatar-default.jpg');
                    ?>
                  </a>
                  <div class="task-thumb-details">
                      <h1><a href="#"><?php echo h($usuario['Usuario']['nome']); ?></a></h1>
                      <p><?php echo $this->Html->link($usuario['Grupo']['nome'], array('controller' => 'grupos', 'action' => 'visualizar', $usuario['Grupo']['id'])); ?></p>
                  </div>
              </div>
              <table class="table table-hover personal-task">
                  <tbody>
                    <tr>
                        <td><?php echo __('ID'); ?></td>
                        <td><?php echo h($usuario['Usuario']['id']); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo __('Email'); ?></td>
                        <td>
                            <?php echo $this->Html->link(__($usuario['Usuario']['email']), 'mailto:'. $usuario['Usuario']['email']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo __('Usuario'); ?></td>
                        <td><?php echo h($usuario['Usuario']['usuario']); ?></td>
                    </tr>
                    <?php  if($usuario['Usuario']['usuario'] == $usuarioLogado['usuario'] || $usuarioLogado['usuario'] == 'kaynak'){ ?>
                    <tr>
                        <td><?php echo __('Senha'); ?></td>
                        <td><?php echo $this->Html->link(__('<i class="icon-lock"></i> Alterar senha'), array('action' => 'senha', $usuario['Usuario']['id']), array('class' => 'btn btn-warning btn-shadow btn-xs', 'escape' => false)); ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td><?php echo __('Telefone'); ?></td>
                        <td><?php echo h($usuario['Usuario']['telefone']); ?></td>
                    </tr>
                  </tbody>
              </table>
          </section>
 
    </div>
    <div class="col-lg-3">
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-cog"></i> Açoes</span>
            </header>
            <div class="panel-body">
               
               <?php echo $this->Html->link(__('<i class="icon-pencil"></i> Editar'), array('action' => 'editar', $usuario['Usuario']['id']), array('class' => 'btn btn-info btn-shadow', 'escape' => false)); ?>

                <?php echo $this->Form->postLink(__('<i class="icon-trash"></i> Excluir'), array('action' => 'excluir', $usuario['Usuario']['id']), array('class' => 'btn btn-danger btn-shadow', 'escape' => false), __('Tem certeza que deseja excluir o registro %s?', $usuario['Usuario']['nome'])); ?>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading clearfix">
              <span class="pull-left"><i class="icon-reorder"></i> Detalhes</span>
            </header>
              <table class="table table-hover personal-task">
                  <tbody>
                    <tr>
                        <td><?php echo __('Ativo'); ?></td>
                        <td>
                            <?php $class =  $usuario['Usuario']['ativo'] ? 'success' : 'danger'; ?>
                            <?php $txt =  $usuario['Usuario']['ativo'] ? 'Sim' : 'Não'; ?>
                            <?php echo $this->Html->tag('span', $txt, array('class' => 'label label-' . $class)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo __('Criado'); ?></td>
                        <td><?php echo $this->Time->format('d/m/Y \à\s h:i:s', $usuario['Usuario']['criado']); ?>
                    </tr>

                    <tr>
                        <td><?php echo __('Modificado'); ?></td>
                        <td><?php echo $this->Time->format('d/m/Y \à\s h:i:s', $usuario['Usuario']['modificado']); ?></td>
                    </tr>

                    <tr>
                        <td><?php echo __('Último login'); ?></td>
                        <td><?php echo $this->Time->format('d/m/Y \à\s h:i:s', $usuario['Usuario']['acesso']); ?></td>
                    </tr>
                  </tbody>
              </table>
        </section>
    </div>

     
</div>