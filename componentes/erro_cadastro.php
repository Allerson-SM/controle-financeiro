<?php
require_once 'componentes/connect.php';
//session_start();
if (isset($_POST['btn-enviar'])) :
    $erros = array();
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);
    $email = mysqli_escape_string($connect, $_POST['email']);
    $sexo = mysqli_escape_string($connect, $_POST['sexo']);

    if (empty($nome) or empty($senha) or empty($email) or empty($sexo)) :
        $erros[] = "<p style='color: red; font-size:small'>Favor prencher todos os campos!</p>";
    else :
        $senha1 = md5($senha);
        $sql = "INSERT INTO usuarios (NOME,EMAIL,SENHA,SEXO) VALUES ('$nome','$email', '$senha1','$sexo')";
        if (mysqli_query($connect, $sql)) {
            header("location: \controle-financeiro/index.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    endif;
endif;
