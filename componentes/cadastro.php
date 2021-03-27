<?php
require_once 'connect.php';


$nome = $_POST['nome'];
$snome = $_POST['snome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$senha1 = md5($senha);
$sexo = $_POST['sexo'];


$sql = "INSERT INTO usuarios (NOME,SOBRENOME,EMAIL,TELEFONE,SENHA,SEXO) VALUES ('$nome','$snome','$email', '$telefone','$senha1','$sexo')";
if (mysqli_query($connect, $sql)) {
    header("location: \controle-financeiro/index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
}

?>