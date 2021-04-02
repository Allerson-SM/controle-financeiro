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


    <style>
        body {
            background-image: url(imgs/background.png);
        }

        .cadastrar {
            width: fit-content;
            margin: auto;
            height: fit-content;
            margin-top: 10%;
            font-family: Verdana;
            background-color: whitesmoke;
            padding: 2%;
            border-radius: 5%;
            box-shadow: 5px 5px 10px rgb(56, 53, 53);
        }

        .checkbox {
            padding-top: 5%;
            padding-bottom: 5%;
        }

        .pos-login {
            padding-top: 5%;
            font-size: small;
        }

        input{
           background-color: transparent;
           border-radius: 5px;
           border-style: none;
           border-bottom-style: solid;
           border-bottom-color: black;
           outline: none;
        }
    </style>


<body>
    <div class="cadastrar">
        <center>
            <h3>Login</h3>
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
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail" style="width: 100%;"><br><br>
            </div>
            <div class="login">
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" style="width: 100%;"> <br>
            </div>
          <br>
            <div class="botao">
                <button type="submit" class="btn btn-primary" style="width: 100%;" name="btn-enviar">Login</button>
            </div>
           
            <div class="pos-login">
                <label for="novo-usuario"><b>Não está cadastrado? </b><a href="cadastro.php">Cadastrar agora</a></label>
            </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>