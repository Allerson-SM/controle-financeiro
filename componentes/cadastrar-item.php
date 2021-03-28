<?php
    require_once 'connect.php';


    $valor = str_replace('.', '', $_POST['valor']);
    $valor = str_replace(',', '.', $valor);  
    $data = $_POST['data'];
    $descricao = $_POST['descricao'];
    $tipo = strtoupper($_POST['tipo']);
    $IDU = $_POST['IDU'];


    $sql = "INSERT INTO lancamentos (DATA,DESCRICAO,$tipo,IDU) VALUES ('$data','$descricao', '$valor', '$IDU')";
    if (mysqli_query($connect, $sql)) {
        header("location: \controle-financeiro/home.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }

?>
