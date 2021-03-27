<?php
require_once 'componentes/connect.php';
//session_start();
if (isset($_POST['btn-enviar'])) :
    $erros = array();
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $snome = mysqli_escape_string($connect, $_POST['snome']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);
    $email = mysqli_escape_string($connect, $_POST['email']);
    $telefone = mysqli_escape_string($connect, $_POST['telefone']);
    $sexo = mysqli_escape_string($connect, $_POST['sexo']);

    if (empty($nome) or empty($snome) or empty($senha) or empty($email) or empty($telefone) or empty($sexo)) :
        $erros[] = "<p style='color: red; font-size:small'>Favor prencher todos os campos!</p>";
    else :
        $senha1 = md5($senha);
        $sql = "INSERT INTO usuarios (NOME,SOBRENOME,EMAIL,TELEFONE,SENHA,SEXO) VALUES ('$nome','$snome','$email', '$telefone','$senha1','$sexo')";
        if (mysqli_query($connect, $sql)) {
            header("location: \controle-financeiro/index.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    endif;
endif;
