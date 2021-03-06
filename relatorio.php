<?php
require_once 'componentes/dados-home.php';
require 'componentes/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        .usuario {
            color: white;
            margin-left: 2%;
        }

        #form-lancamento {
            max-width: 70%;
        }
    </style>

</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <div class="usuario"> Olá <b><?php echo $dados['NOME']; ?></b></div>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" onclick="confirmacao()">Sair</a>
            </li>
        </ul>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastro-ordem.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16" stroke-width="0" stroke="currentColor" stroke-linejoin="round" class="feather feather-file">
                                    <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z" />
                                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                </svg>
                                Lançamento
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="relatorio.php" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <polyline points="13 2 13 9 20 9"></polyline>
                                </svg>
                                Relatório
                            </a>
                        </li>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Relatório</h1>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Descrição
                            </th>
                            <th>
                                Tipo
                            </th>
                            <th>
                                Valor
                            </th>
                            <th>
                                Data
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                    <tbody>

                        <?php $consulta_01 = "SELECT * FROM lancamentos WHERE IDU = $id";
                        $con_01 = $connect->query($consulta_01) or die($connect->error);
                        while ($dado_01 = $con_01->fetch_array()) {
                            $tipo = 0; ?>
                            <tr>
                            <input type="hidden" name="<?php echo ($dado_01['ID']); ?>" id="ID" value="<?php echo ($dado_01['ID']); ?>">
                                <td>
                                    <?php echo ($dado_01['ID']); ?>
                                </td>
                                <td>
                                    <?php echo ($dado_01['DESCRICAO']); ?>
                                </td>
                                <td>
                                    <?php if ($dado_01['RECEITA'] == 0) {
                                        $tipo = "<b><span style='color:rgba(255, 0, 0, 1.0);'>Despesa</span></b>";
                                    } else $tipo = "<b><span style='color:rgba(63, 191, 76, 0.85);'>Receita</span></b>";
                                    echo $tipo;
                                    ?>
                                </td>
                                <td>R$
                                    <?php if ($dado_01['RECEITA'] == 0) {
                                        echo number_format($dado_01['DESPESA'], 2, ',', '.');
                                    } else echo number_format($dado_01['RECEITA'], 2, ',', '.'); ?>
                                </td>
                                <td>
                                    <?php echo date('d/m/Y', strtotime(($dado_01['DATA']))); ?>
                                </td>
                                <td style="width: 2%;">
                                    <a href="componentes\excluir-item.php?id=<?php echo $dado_01['ID'];?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x" viewBox="0 0 16 16">
                                            <path d="M6.854 7.146a.5.5 0 1 0-.708.708L7.293 9l-1.147 1.146a.5.5 0 0 0 .708.708L8 9.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 9l1.147-1.146a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146z" />
                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                        </svg>
                                    </a>
                                </td>
                                <td style="width: 2%;">
                                    <a href="edita.php?id=<?php echo $dado_01['ID'];?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr><?php   } ?>
                    </tbody>
                    </thead>
                </table>
                <script>
                    function confirmacao() {
                        var confirma = confirm('Deseja sair?');
                        if (confirma == true) {
                            window.location = "http://localhost/controle-financeiro/componentes/logout.php";
                        } else {
                            window.location = "#";
                        }
                    }; 
                </script>


</body>

</html>