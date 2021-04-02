<?php 
require_once 'connect.php';

$id = $_GET['id'];


$sql = "DELETE FROM lancamentos WHERE ID = $id";
if (mysqli_query($connect, $sql)) {
    header("location: \controle-financeiro/relatorio.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
}

?>