<?php
require_once 'componentes/connect.php';
session_start();
if (isset($_POST['btn-enviar'])) :
    $erros = array();
    $email = mysqli_escape_string($connect, $_POST['email']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    if (empty($email) or empty($senha)) :
        $erros[] = "<p style='color: red; font-size:small'>E-mail/senha não fornecidos</p>";
    else :
        $sql = "SELECT EMAIL FROM usuarios WHERE EMAIL = '$email'";
        $resultado = mysqli_query($connect, $sql);

        if (mysqli_num_rows($resultado) > 0) :
            $senha = md5($senha);
            $sql = "SELECT * FROM usuarios WHERE EMAIL = '$email' AND SENHA = '$senha'";
            $resultado = mysqli_query($connect, $sql);

            if (mysqli_num_rows($resultado) == 1) :
                $dados = mysqli_fetch_array($resultado);
                mysqli_close($connect);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['ID'];
                header('Location: home.php');
            else :
                $erros[] = "<p style='color: red; font-size:small'>E-mail e senha não conferem</p>";

            endif;
        else :
            $erros[] = "<p style='color: red; font-size:small'>E-mail inexistente</p>";
        endif;
    endif;
endif;
?>