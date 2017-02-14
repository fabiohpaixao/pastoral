<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
            <b>Olá <?php echo $nome ?>!</b>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 0 10px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
            Você foi cadastrado(a) como <strong><?php echo $grupo ?></strong> no sistema de gerenciamento de conteúdo KADMIN do site <strong><?php echo $site ?></strong> pelo usuário <strong><?php echo $nome_admin ?>.</strong>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
            Nós geramos uma senha <strong>segura</strong> para você entrar em nosso sistema:
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 0 10px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
           <strong>Usuário:</strong> <?php echo $usuario ?><br>
           <strong>Senha:</strong> <?php echo $senha ?>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 0 10px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
            Após entrar, você poderá trocá-la para uma senha de seu gosto.
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 0 20px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px;text-align: center; line-height: 20px;">

            <a href="<?php echo $url ?>" title="Entrar no sistema" style="text-decoration:none; background: #ff7800; padding: 10px 20px; color: #fff; border-radius:3px; font-weight: bold">Ir para o sistema</a>

        </td>
    </tr>
    <tr>
        <td style="padding: 10px 0 0 0; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 20px;">
            (Caso não conheça o remetente, por favor, desconsidere este aviso e exclua esta mensagem).
        </td>
    </tr>
</table>
