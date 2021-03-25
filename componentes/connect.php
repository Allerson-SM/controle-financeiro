<?php
//Conectando ao banco de dados
$server_name = "localhost";
$username = "root";
$senha = "";
$db_name = "controle-financeiro";

$connect = mysqli_connect($server_name, $username, $senha, $db_name);

if(mysqli_connect_error()):
    echo "Falha na conexão: ". mysqli_connect_error();
    endif

    ?>