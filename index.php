<?php
require_once 'componentes/dados.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


    <link rel="stylesheet" href="style.css">


<body>
    <div class="cadastrar">
        <center>
            <h4>Login</h4>
        </center>
        <?php
        if (!empty($erros)) :
            foreach ($erros as $erro) :
                echo $erro;
            endforeach;
        endif;
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="login">
                <input type="text" name="nome" id="nome" placeholder="Digite seu nome" style="width: 100%;"><br><br>
            </div>
            <div class="login">
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" style="width: 100%;"> <br>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="conectado" class="col"> Continuar conectado</input>
            </div>
            <div class="botao">
                <button type="submit" class="btn btn-primary" style="width: 100%;" name="btn-enviar">Login</button>
            </div>
            <div class="pos-login">
                <label for="esqueci-minha-senha"><a href="#"> Esqueci minha senha</a></label>
            </div>
            <div class="pos-login">
                <label for="novo-usuario">Não está cadastrado? <a href="cadastro.php">Cadastrar agora</a></label>
            </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>