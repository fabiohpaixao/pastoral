<?php echo $this->Form->create('Usuario', array( 'class' => 'form-signin validate')) ?>

<h2 class="form-signin-heading">Painel de administração</h2>

<div class="login-wrap">
    
    <?php echo $this->Session->flash() ?>
    <?php echo $this->Session->flash('auth') ?>

    <?php echo $this->Form->input('usuario', array('autofocus' => 'autofocus', 'placeholder' => 'Usuário', 'div' => null,
        //'value' =>  $usuario,
        'label' => false,
        'between' => null,
        'after' => null,
        'class' => 'form-control')) ?>
    <?php echo $this->Form->input('senha', array('placeholder' => 'Senha', 'type' => 'password','div' => null,
        'label' => false,
        'between' => null,
        'after' => null,
        'class' => 'form-control')) ?>

    <label class="checkbox">
        <?php echo $this->Form->checkbox('lembrar', array('checked' => 1)); ?> Manter logado
        <span class="pull-right">
         <?php echo $this->Html->link(__('Esqueceu sua senha?'), array('action' => 'esqueci')); ?>
          <a href="#">
        </span>
    </label>


    <?php echo $this->Form->button('Entrar', array('type' => 'submit', 'class' => 'btn btn-shadow btn-lg btn-login btn-block', 'escape' => false)); ?>
 </div>

<?php echo $this->Form->end() ?>
