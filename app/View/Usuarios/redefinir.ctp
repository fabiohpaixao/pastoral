<?php echo $this->Form->create('Usuario', array( 'class' => 'form-signin validate')) ?>

<h2 class="form-signin-heading">
    Redefinir senha
</h2>

<div class="login-wrap">
    
    <?php echo $this->Session->flash() ?>

    <?php echo $this->Form->input('senha', array('autofocus' => 'autofocus', 'placeholder' => 'Nova senha', 'div' => null,
        'label' => false,
        'between' => null,
        'after' => null,
        'type' => 'password',

        'class' => 'form-control')) ?>

     <?php echo $this->Form->input('confirmar senha', array( 'placeholder' => 'Confirmar senha',
        'div' => null,
        'label' => false,
        'between' => null,
        'after' => null,
        'type' => 'password',
        'equalsTo' => '#UsuarioSenha',
        'class' => 'form-control')) ?>

    <br>

    <?php echo $this->Form->button('Redefinir <i class="icon-chevron-right"></i>', array('type' => 'submit', 'class' => 'btn  btn-shadow btn-lg btn-login btn-block', 'escape' => false)); ?>
 </div>

<?php echo $this->Form->end() ?>
