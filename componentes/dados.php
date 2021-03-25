<?php
require_once 'componentes/connect.php';
session_start();
if (isset($_POST['btn-enviar'])) :
    $erros = array();
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    if (empty($nome) or empty($senha)) :
        $erros[] = "<p style='color: red; font-size:small'>Nome/senha não fornecidos</p>";
    else :
        $sql = "SELECT NOME FROM usuarios WHERE NOME = '$nome'";
        $resultado = mysqli_query($connect, $sql);

        if (mysqli_num_rows($resultado) > 0) :
            $senha = md5($senha);
            $sql = "SELECT * FROM usuarios WHERE NOME = '$nome' AND SENHA = '$senha'";
            $resultado = mysqli_query($connect, $sql);

            if (mysqli_num_rows($resultado) == 1) :
                $dados = mysqli_fetch_array($resultado);
                mysqli_close($connect);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['ID'];
                header('Location: home.php');
            else :
                $erros[] = "<p style='color: red; font-size:small'>Usuário e senha não conferem</p>";

            endif;
        else :
            $erros[] = "<p style='color: red; font-size:small'>Usuário inexistente</p>";
        endif;
    endif;
endif;
?>