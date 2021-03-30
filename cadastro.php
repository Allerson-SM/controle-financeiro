<?php
require_once('componentes/erro_cadastro.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


    <style>
        body {
            background-image: url(imgs/background2.png);
        }

        .cadastrar {
            width: 55%;
            margin: auto;
            height: fit-content;
            margin-top: 2%;
            font-family: Verdana;
            background-color: whitesmoke;
            padding: 2%;
            padding-bottom: 0;
            border-radius: 5%;
            box-shadow: 5px 5px 10px rgb(56, 53, 53);
        }

        .login-1 {
            padding-bottom: 5%;
        }

        #row-1 {
            padding-bottom: 5%;
        }

        .sexo {
            color: rgb(117, 117, 117);
        }

        #btn-voltar {
            padding: 1%;
        }

        #senha-1 {
            padding-bottom: 5%;
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
</head>

<body>

    <body>
        <form action="index.php" method="$_POST">
            <div id="btn-voltar" class="btn-group" role="group" aria-label="Basic outlined example">
                <button type="submit" class="btn btn-dark">Login</button>
            </div>
        </form>
        <div class="cadastrar">
            <center>
                <h4>Cadastro</h4>
            </center>
            <?php
            if (!empty($erros)) :
                foreach ($erros as $erro) :
                    echo $erro;
                endforeach;
            endif;
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="login-1">
                    <input type="text" name="nome" id="nome" placeholder="Nome" style="width: 100%;">
                </div>
                <div class="login-1">
                    <input type="text" name="email" id="email" placeholder="E-mail" style="width: 100%;">
                </div>
                <div class="row">
                    <div class="col" id="senha-1">
                        <input type="password" name="senha" id="senha" placeholder="Crie uma senha" style="width: 100%;">
                    </div>
                    <div class="col" id="senha-1">
                        <input type="password" name="senha-2" id="senha-2" placeholder="Digite a senha novamente" style="width: 100%;">
                    </div>
                    <div class="row" id="row-1">
                        <div class="col-sm-3">
                            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1" value="Masculino">
                                Masculino
                            </label>
                        </div>
                        <div class="col">
                            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2" value="Feminino">
                                Feminino
                            </label>
                        </div>
                        <br>
                        <br>
                        <div class="botao">
                            <button type="submit" class="btn btn-primary" style="width: 100%;" name="btn-enviar">Registrar</button>
                        </div>
                    </div>
            </form>
        </div>
    </body>

</html>