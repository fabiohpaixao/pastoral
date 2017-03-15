<?php
session_start();
$token = "d41d8cd98f00b204e9800998ecf8427e";
$senhaAcesso = 'rumoaos1000';

if($_REQUEST['token'] == $token)
    $tokenValido = true;

if($_REQUEST['senhaAcesso'] == $senhaAcesso && empty($_SESSION['usuarioValido']))
    $_SESSION['usuarioValido'] = true;

if($_REQUEST['sair'])
    unset($_SESSION['usuarioValido']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
    .form-login {max-width: 330px; padding: 15px; margin: 0 auto;}
</style>
<title>Usando GIT para atualizar arquivos no servidor de hospedagem</title>
</head>
<body>
    
<div class="container">
    <h2 class="text-center">Deploy com GIT</h2>
    <hr />
    <?php
        if($tokenValido) {
            $exec = executaPull();
            echo "<pre>".$exec."</pre>";
            gravaLog($exec);
    ?>
            <p class="text-center"><a href="index.php" class="btn btn-primary">Visualizar log completo</a></p>
    <?php
        } else if($_SESSION['usuarioValido']) {
    ?>
    <form action="index.php" method="post" class="text-center">
        <div class="form-group">
            <input type="hidden" name="token" value="<?=$token?>">
            <input type="submit" value="Atualizar arquivos" class="btn btn-primary">
        </div>
    </form>
    <?php
        if($_SESSION['usuarioValido']) {
            ?>
            <p class="text-center"><a href="index.php?sair=true" class="btn btn-primary">Sair</a></p>
            <?php
        }
    ?>
    <pre>
    <?php
        exibeLog();
    ?>
    </pre>
    <?php
        } else {
    ?>
    <form action="index.php" method="post" class="form-login text-center">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Senha" name="senhaAcesso">      
            </div>
            <input type="submit" value="Acessar Sistema" class="btn btn-primary">
    </form>
    <?php
        }
    ?>
</div>
</body>
</html>
<?php
function executaPull() {
    $exec = shell_exec("git pull origin master 2>&1");
    return $exec;
}
function gravaLog($exec) {
    $textoLog = PHP_EOL."Data: ".date(d."/".m."/".Y." - ".H.":".i.":".s);
    $textoLog .= PHP_EOL.$exec;

    $arquivoLog = fopen('log.txt', 'a+');
    fwrite($arquivoLog, $textoLog);
    fclose($arquivoLog);
}
function exibeLog() {
    $texto = file('log.txt');
    foreach ($texto as $linha) {
        echo $linha;
    }
}