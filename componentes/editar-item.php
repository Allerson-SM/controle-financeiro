<?php
require_once 'connect.php';

$id = $_POST['id'];
$valor = str_replace('.', '', $_POST['valor']);
$valor = str_replace(',', '.', $valor);
$data = $_POST['data'];
$descricao = $_POST['descricao'];
$tipo = strtoupper($_POST['tipo']);

$valor1 = 0;
$valor2 = 0;

if ($tipo == "RECEITA") {
    $valor1 = $valor;
    $valor2 = 0;
} else {
    $valor2 = $valor;
    $valor1 = 0;
}


$sql = "UPDATE lancamentos SET DATA = '$data', DESCRICAO = '$descricao', RECEITA = '$valor1', DESPESA = $valor2 WHERE ID = $id";
if (mysqli_query($connect, $sql)) {
    header("location: \controle-financeiro/relatorio.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
}
