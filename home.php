<?php
require_once 'componentes/connect.php';

session_start();
if (!isset($_SESSION['logado'])) :
  header('Location: index.php');
endif;

/*Usuário no cabeçalho da página*/
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE ID = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <style>
    .usuario {
      color: white;
      width: 20%;
      margin: auto;
    }

    #form-lancamento {
      max-width: 70%;
    }

    * {
      margin: 0;
      padding: 0;
    }


    .nav_tabs {
      width: 1035px;
      height: 600px;
      background-color: white;
      position: relative;
    }

    .nav_tabs ul {
      list-style: none;
    }

    .nav_tabs ul li {
      float: left;
    }

    .nav_tabs label {
      width: 250px;
      padding: 25px;
      background-color: #363b48;
      display: block;
      color: #fff;
      cursor: pointer;
      text-align: center;
    }

    .rd_tabs:checked~label {
      background-color: #e54e43;
    }

    .rd_tabs {
      display: none;
    }

    .content {
      border-top: 5px solid #e54e43;
      background-color: white;
      display: none;
      position: absolute;
      height: 400px;
      width: 1000px;
      left: 0;
      margin-left: 3.1%;
    }

    .rd_tabs:checked~.content {
      display: block;
    }

    #totais {
      list-style: none;
    }

    #totais li {
      display: inline-block;
      padding-left: 10%;
    }
  </style>
</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <div class="usuario"> Olá <b><?php echo $dados['NOME']; ?></b></div>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cadastro-ordem.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                  <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                  <polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                Cadastrar
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
          <h1 class="h2">Dashboard</h1>
        </div>

        <nav class="nav_tabs">
          <ul>
            <li>
              <input type="radio" name="tabs" class="rd_tabs" id="2019" checked>
              <label for="2019">2019</label>
              <div class="content">
                <canvas class="line-chart" id="myChart" width="1000" height="500" style="display: block; width: 1000px; height: 500px;"></canvas>
              </div>
            </li>
            <li>
              <input type="radio" name="tabs" class="rd_tabs" id="2020">
              <label for="2020">2020</label>
              <div class="content">
                <canvas class="line-chart-2" id="myChart2" width="1000" height="500" style="display: block; width: 1000px; height: 500px;"></canvas>
              </div>
            </li>
            <li>
              <input type="radio" name="tabs" class="rd_tabs" id="2021">
              <label for="2021">2021</label>
              <div class="content">
                <canvas class="line-chart-3" id="myChart3" width="1000" height="500" style="display: block; width: 1000px; height: 500px;"></canvas>
              </div>
            </li>
            <li>
              <input type="radio" name="tabs" class="rd_tabs" id="2022">
              <label for="2022">2022</label>
              <div class="content">
                <canvas class="line-chart-4" id="myChart4" width="1000" height="500" style="display: block; width: 1000px; height: 500px;"></canvas>
              </div>
            </li>
          </ul>
        </nav>

        <nav>
          <ul id="totais">
            <li>
              <div class="table-responsive">
                <table class="table table-bordered border-dark">
                  <thead>
                    <tr>
                      <td class="table-dark" style="width: 100px; background-color: rgba(63, 191, 76, 0.85)"><b>Receitas</b></td>
                      <td id='receitaT' style="width: 100px;"></td>
                    </tr>
                  </thead>
                </table>
              </div>
            </li>
            <li>
              <div class="table-responsive">
                <table class="table table-bordered border-dark">
                  <thead>
                    <tr>
                      <td class="table-dark" style="width: 100px; background-color: rgba(255, 0, 0, 1.0)"><b>Despesas</b></td>
                      <td id='despesaT' style="width: 100px;"></td>
                    </tr>
                  </thead>
                </table>
              </div>
            </li>
            <li>
              <div class="table-responsive">
                <table class="table table-bordered border-dark">
                  <thead>
                    <tr>
                      <td class="table-dark" style="width: 100px;"><b>Subtotal</b></td>
                      <td id='subtotal' style="width: 100px;"></td>
                    </tr>
                  </thead>
                </table>
              </div>
            </li>
          </ul>
        </nav>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-dark">
              <tr>
                <td style="text-align:center;">Ano</td>
                <td>Janeiro</td>
                <td>Fevereiro</td>
                <td>Março</td>
                <td>Abril</td>
                <td>Maio</td>
                <td>Junho</td>
                <td>Julho</td>
                <td>Agosto</td>
                <td>Setembro</td>
                <td>Outubro</td>
                <td>Novembro</td>
                <td>Dezembro</td>
              </tr>
            </thead>
            <tbody>
              <!-- TABELA 2019 -->
              <tr>
                <td style="font-size:medium;">2019</td>
                <?php
                /*Query para selecionar os valores de Janeiro*/
                $consulta_01_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 1 AND YEAR(DATA) = 2019;";
                $con_01_19 = $connect->query($consulta_01_19) or die($connect->error);
                while ($dado_01_19 = $con_01_19->fetch_array()) {
                  $valor1_01_19 = $dado_01_19[0];
                  $valor2_01_19 = $dado_01_19[1];
                  $dif_01_19 = $valor1_01_19 - $valor2_01_19;


                ?>
                  <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_01_19, 2, ',', '.'); ?></td>
                  <input id="2019_01_R" type="hidden" value="<?php echo $valor1_01_19; ?>">
                  <input id="2019_01_D" type="hidden" value="<?php echo $valor2_01_19;
                                                            } ?>">
                  <?php
                  /*Query para selecionar os valores de Fevereiro*/
                  $consulta_02_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 2 AND YEAR(DATA) = 2019;";
                  $con_02_19 = $connect->query($consulta_02_19) or die($connect->error);
                  while ($dado_02_19 = $con_02_19->fetch_array()) {
                    $valor1_02_19 = $dado_02_19[0];
                    $valor2_02_19 = $dado_02_19[1];
                    $dif_02_19 = $valor1_02_19 - $valor2_02_19;
                    $sub_02_19 = $dif_01_19 + $dif_02_19;
                  ?>
                    <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_02_19, 2, ',', '.'); ?></td>
                    <input id="2019_02_R" type="hidden" value="<?php echo $valor1_02_19; ?>">
                    <input id="2019_02_D" type="hidden" value="<?php echo $valor2_02_19; ?>">
                    <input id="2019_02_S" type="hidden" value="<?php echo $sub_02_19;
                                                              } ?>">
                    <?php
                    /*Query para selecionar os valores de Março*/
                    $consulta_03_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 3 AND YEAR(DATA) = 2019;";
                    $con_03_19 = $connect->query($consulta_03_19) or die($connect->error);
                    while ($dado_03_19 = $con_03_19->fetch_array()) {
                      $valor1_03_19 = $dado_03_19[0];
                      $valor2_03_19 = $dado_03_19[1];
                      $dif_03_19 = $valor1_03_19 - $valor2_03_19;
                      $sub_03_19 = $sub_02_19 + $dif_03_19;

                    ?>
                      <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_03_19, 2, ',', '.'); ?></td>
                      <input id="2019_03_R" type="hidden" value="<?php echo $valor1_03_19; ?>">
                      <input id="2019_03_D" type="hidden" value="<?php echo $valor2_03_19; ?>">
                      <input id="2019_03_S" type="hidden" value="<?php echo $sub_03_19;
                                                                } ?>">
                      <?php
                      /*Query para selecionar os valores de Abril*/
                      $consulta_04_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 4 AND YEAR(DATA) = 2019;";
                      $con_04_19 = $connect->query($consulta_04_19) or die($connect->error);
                      while ($dado_04_19 = $con_04_19->fetch_array()) {
                        $valor1_04_19 = $dado_04_19[0];
                        $valor2_04_19 = $dado_04_19[1];
                        $dif_04_19 = $valor1_04_19 - $valor2_04_19;
                        $sub_04_19 = $sub_03_19 + $dif_04_19;

                      ?>
                        <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_04_19, 2, ',', '.'); ?></td>
                        <input id="2019_04_R" type="hidden" value="<?php echo $valor1_04_19; ?>">
                        <input id="2019_04_D" type="hidden" value="<?php echo $valor2_04_19; ?>">
                        <input id="2019_04_S" type="hidden" value="<?php echo $sub_04_19;
                                                                  } ?>">
                        <?php
                        /*Query para selecionar os valores de Maio*/
                        $consulta_05_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 5 AND YEAR(DATA) = 2019;";
                        $con_05_19 = $connect->query($consulta_05_19) or die($connect->error);
                        while ($dado_05_19 = $con_05_19->fetch_array()) {
                          $valor1_05_19 = $dado_05_19[0];
                          $valor2_05_19 = $dado_05_19[1];
                          $dif_05_19 = $valor1_05_19 - $valor2_05_19;
                          $sub_05_19 = $sub_04_19 + $dif_05_19;
                        ?>
                          <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_05_19, 2, ',', '.'); ?></td>
                          <input id="2019_05_R" type="hidden" value="<?php echo $valor1_05_19; ?>">
                          <input id="2019_05_D" type="hidden" value="<?php echo $valor2_05_19; ?>">
                          <input id="2019_05_S" type="hidden" value="<?php echo $sub_05_19;
                                                                    } ?>">
                          <?php
                          /*Query para selecionar os valores de Junho*/
                          $consulta_06_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 6 AND YEAR(DATA) = 2019;";
                          $con_06_19 = $connect->query($consulta_06_19) or die($connect->error);
                          while ($dado_06_19 = $con_06_19->fetch_array()) {
                            $valor1_06_19 = $dado_06_19[0];
                            $valor2_06_19 = $dado_06_19[1];
                            $dif_06_19 = $valor1_06_19 - $valor2_06_19;
                            $sub_06_19 = $sub_05_19 + $dif_06_19;
                          ?>
                            <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_06_19, 2, ',', '.'); ?></td>
                            <input id="2019_06_R" type="hidden" value="<?php echo $valor1_06_19; ?>">
                            <input id="2019_06_D" type="hidden" value="<?php echo $valor2_06_19; ?>">
                            <input id="2019_06_S" type="hidden" value="<?php echo $sub_06_19;
                                                                      } ?>">
                            <?php
                            /*Query para selecionar os valores de Julho*/
                            $consulta_07_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 7 AND YEAR(DATA) = 2019;";
                            $con_07_19 = $connect->query($consulta_07_19) or die($connect->error);
                            while ($dado_07_19 = $con_07_19->fetch_array()) {
                              $valor1_07_19 = $dado_07_19[0];
                              $valor2_07_19 = $dado_07_19[1];
                              $dif_07_19 = $valor1_07_19 - $valor2_07_19;
                              $sub_07_19 = $sub_06_19 + $dif_07_19;
                            ?>
                              <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_07_19, 2, ',', '.'); ?></td>
                              <input id="2019_07_R" type="hidden" value="<?php echo $valor1_07_19; ?>">
                              <input id="2019_07_D" type="hidden" value="<?php echo $valor2_07_19; ?>">
                              <input id="2019_07_S" type="hidden" value="<?php echo $sub_07_19;
                                                                        } ?>">
                              <?php
                              /*Query para selecionar os valores de Agosto*/
                              $consulta_08_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 8 AND YEAR(DATA) = 2019;";
                              $con_08_19 = $connect->query($consulta_08_19) or die($connect->error);
                              while ($dado_08_19 = $con_08_19->fetch_array()) {
                                $valor1_08_19 = $dado_08_19[0];
                                $valor2_08_19 = $dado_08_19[1];
                                $dif_08_19 = $valor1_08_19 - $valor2_08_19;
                                $sub_08_19 = $sub_07_19 + $dif_08_19;
                              ?>
                                <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_08_19, 2, ',', '.'); ?></td>
                                <input id="2019_08_R" type="hidden" value="<?php echo $valor1_08_19; ?>">
                                <input id="2019_08_D" type="hidden" value="<?php echo $valor2_08_19; ?>">
                                <input id="2019_08_S" type="hidden" value="<?php echo $sub_08_19;
                                                                          } ?>">
                                <?php
                                /*Query para selecionar os valores de Setembro*/
                                $consulta_09_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 9 AND YEAR(DATA) = 2019;";
                                $con_09_19 = $connect->query($consulta_09_19) or die($connect->error);
                                while ($dado_09_19 = $con_09_19->fetch_array()) {
                                  $valor1_09_19 = $dado_09_19[0];
                                  $valor2_09_19 = $dado_09_19[1];
                                  $dif_09_19 = $valor1_09_19 - $valor2_09_19;
                                  $sub_09_19 = $sub_08_19 + $dif_09_19;
                                ?>
                                  <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_09_19, 2, ',', '.'); ?></td>
                                  <input id="2019_09_R" type="hidden" value="<?php echo $valor1_09_19; ?>">
                                  <input id="2019_09_D" type="hidden" value="<?php echo $valor2_09_19; ?>">
                                  <input id="2019_09_S" type="hidden" value="<?php echo $sub_09_19;
                                                                            } ?>">
                                  <?php
                                  /*Query para selecionar os valores de Outubro*/
                                  $consulta_10_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 10 AND YEAR(DATA) = 2019;";
                                  $con_10_19 = $connect->query($consulta_10_19) or die($connect->error);
                                  while ($dado_10_19 = $con_10_19->fetch_array()) {
                                    $valor1_10_19 = $dado_10_19[0];
                                    $valor2_10_19 = $dado_10_19[1];
                                    $dif_10_19 = $valor1_10_19 - $valor2_10_19;
                                    $sub_10_19 = $sub_09_19 + $dif_10_19;
                                  ?>
                                    <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_10_19, 2, ',', '.'); ?></td>
                                    <input id="2019_10_R" type="hidden" value="<?php echo $valor1_10_19; ?>">
                                    <input id="2019_10_D" type="hidden" value="<?php echo $valor2_10_19; ?>">
                                    <input id="2019_10_S" type="hidden" value="<?php echo $sub_10_19;
                                                                              } ?>">
                                    <?php
                                    /*Query para selecionar os valores de Novembro*/
                                    $consulta_11_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 11 AND YEAR(DATA) = 2019;";
                                    $con_11_19 = $connect->query($consulta_11_19) or die($connect->error);
                                    while ($dado_11_19 = $con_11_19->fetch_array()) {
                                      $valor1_11_19 = $dado_11_19[0];
                                      $valor2_11_19 = $dado_11_19[1];
                                      $dif_11_19 = $valor1_11_19 - $valor2_11_19;
                                      $sub_11_19 = $sub_10_19 + $dif_11_19;
                                    ?>
                                      <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_11_19, 2, ',', '.'); ?></td>
                                      <input id="2019_11_R" type="hidden" value="<?php echo $valor1_11_19; ?>">
                                      <input id="2019_11_D" type="hidden" value="<?php echo $valor2_11_19; ?>">
                                      <input id="2019_11_S" type="hidden" value="<?php echo $sub_11_19;
                                                                                } ?>">
                                      <?php
                                      /*Query para selecionar os valores de Dezembro*/
                                      $consulta_12_19 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 12 AND YEAR(DATA) = 2019;";
                                      $con_12_19 = $connect->query($consulta_12_19) or die($connect->error);
                                      while ($dado_12_19 = $con_12_19->fetch_array()) {
                                        $valor1_12_19 = $dado_12_19[0];
                                        $valor2_12_19 = $dado_12_19[1];
                                        $dif_12_19 = $valor1_12_19 - $valor2_12_19;
                                        $sub_12_19 = $sub_11_19 + $dif_12_19;
                                      ?>
                                        <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_12_19, 2, ',', '.'); ?></td>
                                        <input id="2019_12_R" type="hidden" value="<?php echo $valor1_12_19; ?>">
                                        <input id="2019_12_D" type="hidden" value="<?php echo $valor2_12_19; ?>">
                                        <input id="2019_12_S" type="hidden" value="<?php echo $sub_12_19;
                                                                                  } ?>">
              </tr>
              <!-- TABELA 2020 -->
              <tr>
                <td>2020</td>
                <?php
                /*Query para selecionar os valores de Janeiro*/
                $consulta_01_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 1 AND YEAR(DATA) = 2020;";
                $con_01_20 = $connect->query($consulta_01_20) or die($connect->error);
                while ($dado_01_20 = $con_01_20->fetch_array()) {
                  $valor1_01_20 = $dado_01_20[0];
                  $valor2_01_20 = $dado_01_20[1];
                  $dif_01_20 = $valor1_01_20 - $valor2_01_20;
                  $sub_01_20 = $sub_12_19 + $dif_01_20;
                ?>
                  <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_01_20, 2, ',', '.'); ?></td>
                  <input id="2020_01_R" type="hidden" value="<?php echo $valor1_01_20; ?>">
                  <input id="2020_01_D" type="hidden" value="<?php echo $valor2_01_20; ?>">
                  <input id="2020_01_S" type="hidden" value="<?php echo $sub_01_20;
                                                            } ?>">
                  <?php
                  /*Query para selecionar os valores de Fevereiro*/
                  $consulta_02_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 2 AND YEAR(DATA) = 2020;";
                  $con_02_20 = $connect->query($consulta_02_20) or die($connect->error);
                  while ($dado_02_20 = $con_02_20->fetch_array()) {
                    $valor1_02_20 = $dado_02_20[0];
                    $valor2_02_20 = $dado_02_20[1];
                    $dif_02_20 = $valor2_01_20 - $valor2_02_20;
                    $sub_02_20 = $sub_01_20 + $dif_02_20;
                  ?>
                    <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_02_20, 2, ',', '.'); ?></td>
                    <input id="2020_02_R" type="hidden" value="<?php echo $valor1_02_20; ?>">
                    <input id="2020_02_D" type="hidden" value="<?php echo $valor2_02_20; ?>">
                    <input id="2020_02_S" type="hidden" value="<?php echo $sub_02_20;
                                                              } ?>">
                    <?php
                    /*Query para selecionar os valores de Março*/
                    $consulta_03_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 3 AND YEAR(DATA) = 2020;";
                    $con_03_20 = $connect->query($consulta_03_20) or die($connect->error);
                    while ($dado_03_20 = $con_03_20->fetch_array()) {
                      $valor1_03_20 = $dado_03_20[0];
                      $valor2_03_20 = $dado_03_20[1];
                      $dif_03_20 = $valor1_03_20 - $valor2_03_20;
                      $sub_03_20 = $sub_02_20 + $dif_03_20;
                    ?>
                      <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_03_20, 2, ',', '.'); ?></td>
                      <input id="2020_03_R" type="hidden" value="<?php echo $valor1_03_20; ?>">
                      <input id="2020_03_D" type="hidden" value="<?php echo $valor2_03_20; ?>">
                      <input id="2020_03_S" type="hidden" value="<?php echo $sub_03_20;
                                                                } ?>">
                      <?php
                      /*Query para selecionar os valores de Abril*/
                      $consulta_04_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 4 AND YEAR(DATA) = 2020;";
                      $con_04_20 = $connect->query($consulta_04_20) or die($connect->error);
                      while ($dado_04_20 = $con_04_20->fetch_array()) {
                        $valor1_04_20 = $dado_04_20[0];
                        $valor2_04_20 = $dado_04_20[1];
                        $dif_04_20 = $valor1_04_20 - $valor2_04_20;
                        $sub_04_20 = $sub_03_20 + $dif_04_20;
                      ?>
                        <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_04_20, 2, ',', '.'); ?></td>
                        <input id="2020_04_R" type="hidden" value="<?php echo $valor1_04_20; ?>">
                        <input id="2020_04_D" type="hidden" value="<?php echo $valor2_04_20; ?>">
                        <input id="2020_04_S" type="hidden" value="<?php echo $sub_04_20;
                                                                  } ?>">
                        <?php
                        /*Query para selecionar os valores de Maio*/
                        $consulta_05_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 5 AND YEAR(DATA) = 2020;";
                        $con_05_20 = $connect->query($consulta_05_20) or die($connect->error);
                        while ($dado_05_20 = $con_05_20->fetch_array()) {
                          $valor1_05_20 = $dado_05_20[0];
                          $valor2_05_20 = $dado_05_20[1];
                          $dif_05_20 = $valor1_05_20 - $valor2_05_20;
                          $sub_05_20 = $sub_04_20 + $dif_05_20;
                        ?>
                          <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_05_20, 2, ',', '.'); ?></td>
                          <input id="2020_05_R" type="hidden" value="<?php echo $valor1_05_20; ?>">
                          <input id="2020_05_D" type="hidden" value="<?php echo $valor2_05_20; ?>">
                          <input id="2020_05_S" type="hidden" value="<?php echo $sub_05_20;
                                                                    } ?>">
                          <?php
                          /*Query para selecionar os valores de Junho*/
                          $consulta_06_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 6 AND YEAR(DATA) = 2020;";
                          $con_06_20 = $connect->query($consulta_06_20) or die($connect->error);
                          while ($dado_06_20 = $con_06_20->fetch_array()) {
                            $valor1_06_20 = $dado_06_20[0];
                            $valor2_06_20 = $dado_06_20[1];
                            $dif_06_20 = $valor1_06_20 - $valor2_06_20;
                            $sub_06_20 = $sub_05_20 + $dif_06_20;
                          ?>
                            <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_06_20, 2, ',', '.'); ?></td>
                            <input id="2020_06_R" type="hidden" value="<?php echo $valor1_06_20; ?>">
                            <input id="2020_06_D" type="hidden" value="<?php echo $valor2_06_20; ?>">
                            <input id="2020_06_S" type="hidden" value="<?php echo $sub_06_20;
                                                                      } ?>">
                            <?php
                            /*Query para selecionar os valores de Julho*/
                            $consulta_07_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 7 AND YEAR(DATA) = 2020;";
                            $con_07_20 = $connect->query($consulta_07_20) or die($connect->error);
                            while ($dado_07_20 = $con_07_20->fetch_array()) {
                              $valor1_07_20 = $dado_07_20[0];
                              $valor2_07_20 = $dado_07_20[1];
                              $dif_07_20 = $valor1_07_20 - $valor2_07_20;
                              $sub_07_20 = $sub_06_20 + $dif_07_20;
                            ?>
                              <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_07_20, 2, ',', '.'); ?></td>
                              <input id="2020_07_R" type="hidden" value="<?php echo $valor1_07_20; ?>">
                              <input id="2020_07_D" type="hidden" value="<?php echo $valor2_07_20; ?>">
                              <input id="2020_07_S" type="hidden" value="<?php echo $sub_07_20;
                                                                        } ?>">
                              <?php
                              /*Query para selecionar os valores de Agosto*/
                              $consulta_08_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 8 AND YEAR(DATA) = 2020;";
                              $con_08_20 = $connect->query($consulta_08_20) or die($connect->error);
                              while ($dado_08_20 = $con_08_20->fetch_array()) {
                                $valor1_08_20 = $dado_08_20[0];
                                $valor2_08_20 = $dado_08_20[1];
                                $dif_08_20 = $valor1_08_20 - $valor2_08_20;
                                $sub_08_20 = $sub_07_20 + $dif_08_20;
                              ?>
                                <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_08_20, 2, ',', '.'); ?></td>
                                <input id="2020_08_R" type="hidden" value="<?php echo $valor1_08_20; ?>">
                                <input id="2020_08_D" type="hidden" value="<?php echo $valor2_08_20; ?>">
                                <input id="2020_08_S" type="hidden" value="<?php echo $sub_08_20;
                                                                          } ?>">
                                <?php
                                /*Query para selecionar os valores de Setembro*/
                                $consulta_09_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 9 AND YEAR(DATA) = 2020;";
                                $con_09_20 = $connect->query($consulta_09_20) or die($connect->error);
                                while ($dado_09_20 = $con_09_20->fetch_array()) {
                                  $valor1_09_20 = $dado_09_20[0];
                                  $valor2_09_20 = $dado_09_20[1];
                                  $dif_09_20 = $valor1_09_20 - $valor2_09_20;
                                  $sub_09_20 = $sub_08_20 + $dif_09_20;
                                ?>
                                  <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_09_20, 2, ',', '.'); ?></td>
                                  <input id="2020_09_R" type="hidden" value="<?php echo $valor1_09_20; ?>">
                                  <input id="2020_09_D" type="hidden" value="<?php echo $valor2_09_20; ?>">
                                  <input id="2020_09_S" type="hidden" value="<?php echo $sub_09_20;
                                                                            } ?>">
                                  <?php
                                  /*Query para selecionar os valores de Outubro*/
                                  $consulta_10_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 10 AND YEAR(DATA) = 2020;";
                                  $con_10_20 = $connect->query($consulta_10_20) or die($connect->error);
                                  while ($dado_10_20 = $con_10_20->fetch_array()) {
                                    $valor1_10_20 = $dado_10_20[0];
                                    $valor2_10_20 = $dado_10_20[1];
                                    $dif_10_20 = $valor1_10_20 - $valor2_10_20;
                                    $sub_10_20 = $sub_09_20 + $dif_10_20;
                                  ?>
                                    <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_10_20, 2, ',', '.'); ?></td>
                                    <input id="2020_10_R" type="hidden" value="<?php echo $valor1_10_20; ?>">
                                    <input id="2020_10_D" type="hidden" value="<?php echo $valor2_10_20; ?>">
                                    <input id="2020_10_S" type="hidden" value="<?php echo $sub_10_20;
                                                                              } ?>">
                                    <?php
                                    /*Query para selecionar os valores de Novembro*/
                                    $consulta_11_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 11 AND YEAR(DATA) = 2020;";
                                    $con_11_20 = $connect->query($consulta_11_20) or die($connect->error);
                                    while ($dado_11_20 = $con_11_20->fetch_array()) {
                                      $valor1_11_20 = $dado_11_20[0];
                                      $valor2_11_20 = $dado_11_20[1];
                                      $dif_11_20 = $valor1_11_20 - $valor2_11_20;
                                      $sub_11_20 = $sub_10_20 + $dif_11_20;
                                    ?>
                                      <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_11_20, 2, ',', '.'); ?></td>
                                      <input id="2020_11_R" type="hidden" value="<?php echo $valor1_11_20; ?>">
                                      <input id="2020_11_D" type="hidden" value="<?php echo $valor2_11_20; ?>">
                                      <input id="2020_11_S" type="hidden" value="<?php echo $sub_11_20;
                                                                                } ?>">
                                      <?php
                                      /*Query para selecionar os valores de Dezembro*/
                                      $consulta_12_20 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 12 AND YEAR(DATA) = 2020;";
                                      $con_12_20 = $connect->query($consulta_12_20) or die($connect->error);
                                      while ($dado_12_20 = $con_12_20->fetch_array()) {
                                        $valor1_12_20 = $dado_12_20[0];
                                        $valor2_12_20 = $dado_12_20[1];
                                        $dif_12_20 = $valor1_12_20 - $valor2_12_20;
                                        $sub_12_20 = $sub_11_20 + $dif_12_20;
                                      ?>
                                        <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_12_20, 2, ',', '.'); ?></td>
                                        <input id="2020_12_R" type="hidden" value="<?php echo $valor1_12_20; ?>">
                                        <input id="2020_12_D" type="hidden" value="<?php echo $valor2_12_20; ?>">
                                        <input id="2020_12_S" type="hidden" value="<?php echo $sub_12_20;
                                                                                  } ?>">
              </tr>
              <!-- TABELA 2021 -->
              <tr>
                <td>2021</td>
                <?php
                /*Query para selecionar os valores de Janeiro*/
                $consulta_01_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 1 AND YEAR(DATA) = 2021;";
                $con_01_21 = $connect->query($consulta_01_21) or die($connect->error);
                while ($dado_01_21 = $con_01_21->fetch_array()) {
                  $valor1_01_21 = $dado_01_21[0];
                  $valor2_01_21 = $dado_01_21[1];
                  $dif_01_21 = $valor1_01_21 - $valor2_01_21;
                  $sub_01_21 = $sub_12_20 + $dif_01_21;
                ?>
                  <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_01_21, 2, ',', '.'); ?></td>
                  <input id="2021_01_R" type="hidden" value="<?php echo $valor1_01_21; ?>">
                  <input id="2021_01_D" type="hidden" value="<?php echo $valor2_01_21; ?>">
                  <input id="2021_01_S" type="hidden" value="<?php echo $sub_01_21;
                                                            } ?>">
                  <?php
                  /*Query para selecionar os valores de Fevereiro*/
                  $consulta_02_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 2 AND YEAR(DATA) = 2021;";
                  $con_02_21 = $connect->query($consulta_02_21) or die($connect->error);
                  while ($dado_02_21 = $con_02_21->fetch_array()) {
                    $valor1_02_21 = $dado_02_21[0];
                    $valor2_02_21 = $dado_02_21[1];
                    $dif_02_21 = $valor2_01_21 - $valor2_02_21;
                    $sub_02_21 = $sub_01_21 + $dif_02_21;
                  ?>
                    <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_02_21, 2, ',', '.'); ?></td>
                    <input id="2021_02_R" type="hidden" value="<?php echo $valor1_02_21; ?>">
                    <input id="2021_02_D" type="hidden" value="<?php echo $valor2_02_21; ?>">
                    <input id="2021_02_S" type="hidden" value="<?php echo $sub_02_21;
                                                              } ?>">
                    <?php
                    /*Query para selecionar os valores de Março*/
                    $consulta_03_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 3 AND YEAR(DATA) = 2021;";
                    $con_03_21 = $connect->query($consulta_03_21) or die($connect->error);
                    while ($dado_03_21 = $con_03_21->fetch_array()) {
                      $valor1_03_21 = $dado_03_21[0];
                      $valor2_03_21 = $dado_03_21[1];
                      $dif_03_21 = $valor1_03_21 - $valor2_03_21;
                      $sub_03_21 = $sub_02_21 + $dif_03_21;
                    ?>
                      <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_03_21, 2, ',', '.'); ?></td>
                      <input id="2021_03_R" type="hidden" value="<?php echo $valor1_03_21; ?>">
                      <input id="2021_03_D" type="hidden" value="<?php echo $valor2_03_21; ?>">
                      <input id="2021_03_S" type="hidden" value="<?php echo $sub_03_21;
                                                                } ?>">
                      <?php
                      /*Query para selecionar os valores de Abril*/
                      $consulta_04_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 4 AND YEAR(DATA) = 2021;";
                      $con_04_21 = $connect->query($consulta_04_21) or die($connect->error);
                      while ($dado_04_21 = $con_04_21->fetch_array()) {
                        $valor1_04_21 = $dado_04_21[0];
                        $valor2_04_21 = $dado_04_21[1];
                        $dif_04_21 = $valor1_04_21 - $valor2_04_21;
                        $sub_04_21 = $sub_03_21 + $dif_04_21;
                      ?>
                        <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_04_21, 2, ',', '.'); ?></td>
                        <input id="2021_04_R" type="hidden" value="<?php echo $valor1_04_21; ?>">
                        <input id="2021_04_D" type="hidden" value="<?php echo $valor2_04_21; ?>">
                        <input id="2021_04_S" type="hidden" value="<?php echo $sub_04_21;
                                                                  } ?>">
                        <?php
                        /*Query para selecionar os valores de Maio*/
                        $consulta_05_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 5 AND YEAR(DATA) = 2021;";
                        $con_05_21 = $connect->query($consulta_05_21) or die($connect->error);
                        while ($dado_05_21 = $con_05_21->fetch_array()) {
                          $valor1_05_21 = $dado_05_21[0];
                          $valor2_05_21 = $dado_05_21[1];
                          $dif_05_21 = $valor1_05_21 - $valor2_05_21;
                          $sub_05_21 = $sub_04_21 + $dif_05_21;
                        ?>
                          <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_05_21, 2, ',', '.'); ?></td>
                          <input id="2021_05_R" type="hidden" value="<?php echo $valor1_05_21; ?>">
                          <input id="2021_05_D" type="hidden" value="<?php echo $valor2_05_21; ?>">
                          <input id="2021_05_S" type="hidden" value="<?php echo $sub_05_21;
                                                                    } ?>">
                          <?php
                          /*Query para selecionar os valores de Junho*/
                          $consulta_06_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 6 AND YEAR(DATA) = 2021;";
                          $con_06_21 = $connect->query($consulta_06_21) or die($connect->error);
                          while ($dado_06_21 = $con_06_21->fetch_array()) {
                            $valor1_06_21 = $dado_06_21[0];
                            $valor2_06_21 = $dado_06_21[1];
                            $dif_06_21 = $valor1_06_21 - $valor2_06_21;
                            $sub_06_21 = $sub_05_21 + $dif_06_21;
                          ?>
                            <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_06_21, 2, ',', '.'); ?></td>
                            <input id="2021_06_R" type="hidden" value="<?php echo $valor1_06_21; ?>">
                            <input id="2021_06_D" type="hidden" value="<?php echo $valor2_06_21; ?>">
                            <input id="2021_06_S" type="hidden" value="<?php echo $sub_06_21;
                                                                      } ?>">
                            <?php
                            /*Query para selecionar os valores de Julho*/
                            $consulta_07_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 7 AND YEAR(DATA) = 2021;";
                            $con_07_21 = $connect->query($consulta_07_21) or die($connect->error);
                            while ($dado_07_21 = $con_07_21->fetch_array()) {
                              $valor1_07_21 = $dado_07_21[0];
                              $valor2_07_21 = $dado_07_21[1];
                              $dif_07_21 = $valor1_07_21 - $valor2_07_21;
                              $sub_07_21 = $sub_06_21 + $dif_07_21;
                            ?>
                              <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_07_21, 2, ',', '.'); ?></td>
                              <input id="2021_07_R" type="hidden" value="<?php echo $valor1_07_21; ?>">
                              <input id="2021_07_D" type="hidden" value="<?php echo $valor2_07_21; ?>">
                              <input id="2021_07_S" type="hidden" value="<?php echo $sub_07_21;
                                                                        } ?>">
                              <?php
                              /*Query para selecionar os valores de Agosto*/
                              $consulta_08_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 8 AND YEAR(DATA) = 2021;";
                              $con_08_21 = $connect->query($consulta_08_21) or die($connect->error);
                              while ($dado_08_21 = $con_08_21->fetch_array()) {
                                $valor1_08_21 = $dado_08_21[0];
                                $valor2_08_21 = $dado_08_21[1];
                                $dif_08_21 = $valor1_08_21 - $valor2_08_21;
                                $sub_08_21 = $sub_07_21 + $dif_08_21;
                              ?>
                                <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_08_21, 2, ',', '.'); ?></td>
                                <input id="2021_08_R" type="hidden" value="<?php echo $valor1_08_21; ?>">
                                <input id="2021_08_D" type="hidden" value="<?php echo $valor2_08_21; ?>">
                                <input id="2021_08_S" type="hidden" value="<?php echo $sub_08_21;
                                                                          } ?>">
                                <?php
                                /*Query para selecionar os valores de Setembro*/
                                $consulta_09_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 9 AND YEAR(DATA) = 2021;";
                                $con_09_21 = $connect->query($consulta_09_21) or die($connect->error);
                                while ($dado_09_21 = $con_09_21->fetch_array()) {
                                  $valor1_09_21 = $dado_09_21[0];
                                  $valor2_09_21 = $dado_09_21[1];
                                  $dif_09_21 = $valor1_09_21 - $valor2_09_21;
                                  $sub_09_21 = $sub_08_21 + $dif_09_21;
                                ?>
                                  <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_09_21, 2, ',', '.'); ?></td>
                                  <input id="2021_09_R" type="hidden" value="<?php echo $valor1_09_21; ?>">
                                  <input id="2021_09_D" type="hidden" value="<?php echo $valor2_09_21; ?>">
                                  <input id="2021_09_S" type="hidden" value="<?php echo $sub_09_21;
                                                                            } ?>">
                                  <?php
                                  /*Query para selecionar os valores de Outubro*/
                                  $consulta_10_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 10 AND YEAR(DATA) = 2021;";
                                  $con_10_21 = $connect->query($consulta_10_21) or die($connect->error);
                                  while ($dado_10_21 = $con_10_21->fetch_array()) {
                                    $valor1_10_21 = $dado_10_21[0];
                                    $valor2_10_21 = $dado_10_21[1];
                                    $dif_10_21 = $valor1_10_21 - $valor2_10_21;
                                    $sub_10_21 = $sub_09_21 + $dif_10_21;
                                  ?>
                                    <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_10_21, 2, ',', '.'); ?></td>
                                    <input id="2021_10_R" type="hidden" value="<?php echo $valor1_10_21; ?>">
                                    <input id="2021_10_D" type="hidden" value="<?php echo $valor2_10_21; ?>">
                                    <input id="2021_10_S" type="hidden" value="<?php echo $sub_10_21;
                                                                              } ?>">
                                    <?php
                                    /*Query para selecionar os valores de Novembro*/
                                    $consulta_11_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 11 AND YEAR(DATA) = 2021;";
                                    $con_11_21 = $connect->query($consulta_11_21) or die($connect->error);
                                    while ($dado_11_21 = $con_11_21->fetch_array()) {
                                      $valor1_11_21 = $dado_11_21[0];
                                      $valor2_11_21 = $dado_11_21[1];
                                      $dif_11_21 = $valor1_11_21 - $valor2_11_21;
                                      $sub_11_21 = $sub_10_21 + $dif_11_21;
                                    ?>
                                      <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_11_21, 2, ',', '.'); ?></td>
                                      <input id="2021_11_R" type="hidden" value="<?php echo $valor1_11_21; ?>">
                                      <input id="2021_11_D" type="hidden" value="<?php echo $valor2_11_21; ?>">
                                      <input id="2021_11_S" type="hidden" value="<?php echo $sub_11_21;
                                                                                } ?>">
                                      <?php
                                      /*Query para selecionar os valores de Dezembro*/
                                      $consulta_12_21 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 12 AND YEAR(DATA) = 2021;";
                                      $con_12_21 = $connect->query($consulta_12_21) or die($connect->error);
                                      while ($dado_12_21 = $con_12_21->fetch_array()) {
                                        $valor1_12_21 = $dado_12_21[0];
                                        $valor2_12_21 = $dado_12_21[1];
                                        $dif_12_21 = $valor1_12_21 - $valor2_12_21;
                                        $sub_12_21 = $sub_11_21 + $dif_12_21;
                                      ?>
                                        <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_12_21, 2, ',', '.'); ?></td>
                                        <input id="2021_12_R" type="hidden" value="<?php echo $valor1_12_21; ?>">
                                        <input id="2021_12_D" type="hidden" value="<?php echo $valor2_12_21; ?>">
                                        <input id="2021_12_S" type="hidden" value="<?php echo $sub_12_21;
                                                                                  } ?>">
              </tr>
              <!-- TABELA 2022 -->
              <tr>
                <td>2022</td>
                <?php
                /*Query para selecionar os valores de Janeiro*/
                $consulta_01_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 1 AND YEAR(DATA) = 2022;";
                $con_01_22 = $connect->query($consulta_01_22) or die($connect->error);
                while ($dado_01_22 = $con_01_22->fetch_array()) {
                  $valor1_01_22 = $dado_01_22[0];
                  $valor2_01_22 = $dado_01_22[1];
                  $dif_01_22 = $valor1_01_22 - $valor2_01_22;
                  $sub_01_22 = $sub_12_21 + $dif_01_22;
                ?>
                  <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_01_22, 2, ',', '.'); ?></td>
                  <input id="2022_01_R" type="hidden" value="<?php echo $valor1_01_22; ?>">
                  <input id="2022_01_D" type="hidden" value="<?php echo $valor2_01_22; ?>">
                  <input id="2022_01_S" type="hidden" value="<?php echo $sub_01_22;
                                                            } ?>">
                  <?php
                  /*Query para selecionar os valores de Fevereiro*/
                  $consulta_02_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 2 AND YEAR(DATA) = 2022;";
                  $con_02_22 = $connect->query($consulta_02_22) or die($connect->error);
                  while ($dado_02_22 = $con_02_22->fetch_array()) {
                    $valor1_02_22 = $dado_02_22[0];
                    $valor2_02_22 = $dado_02_22[1];
                    $dif_02_22 = $valor2_01_22 - $valor2_02_22;
                    $sub_02_22 = $sub_01_22 + $dif_02_22;
                  ?>
                    <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_02_22, 2, ',', '.'); ?></td>
                    <input id="2022_02_R" type="hidden" value="<?php echo $valor1_02_22; ?>">
                    <input id="2022_02_D" type="hidden" value="<?php echo $valor2_02_22; ?>">
                    <input id="2022_02_S" type="hidden" value="<?php echo $sub_02_22;
                                                              } ?>">
                    <?php
                    /*Query para selecionar os valores de Março*/
                    $consulta_03_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 3 AND YEAR(DATA) = 2022;";
                    $con_03_22 = $connect->query($consulta_03_22) or die($connect->error);
                    while ($dado_03_22 = $con_03_22->fetch_array()) {
                      $valor1_03_22 = $dado_03_22[0];
                      $valor2_03_22 = $dado_03_22[1];
                      $dif_03_22 = $valor1_03_22 - $valor2_03_22;
                      $sub_03_22 = $sub_02_22 + $dif_03_22;
                    ?>
                      <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_03_22, 2, ',', '.'); ?></td>
                      <input id="2022_03_R" type="hidden" value="<?php echo $valor1_03_22; ?>">
                      <input id="2022_03_D" type="hidden" value="<?php echo $valor2_03_22; ?>">
                      <input id="2022_03_S" type="hidden" value="<?php echo $sub_03_22;
                                                                } ?>">
                      <?php
                      /*Query para selecionar os valores de Abril*/
                      $consulta_04_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 4 AND YEAR(DATA) = 2022;";
                      $con_04_22 = $connect->query($consulta_04_22) or die($connect->error);
                      while ($dado_04_22 = $con_04_22->fetch_array()) {
                        $valor1_04_22 = $dado_04_22[0];
                        $valor2_04_22 = $dado_04_22[1];
                        $dif_04_22 = $valor1_04_22 - $valor2_04_22;
                        $sub_04_22 = $sub_03_22 + $dif_04_22;
                      ?>
                        <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_04_22, 2, ',', '.'); ?></td>
                        <input id="2022_04_R" type="hidden" value="<?php echo $valor1_04_22; ?>">
                        <input id="2022_04_D" type="hidden" value="<?php echo $valor2_04_22; ?>">
                        <input id="2022_04_S" type="hidden" value="<?php echo $sub_04_22;
                                                                  } ?>">
                        <?php
                        /*Query para selecionar os valores de Maio*/
                        $consulta_05_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 5 AND YEAR(DATA) = 2022;";
                        $con_05_22 = $connect->query($consulta_05_22) or die($connect->error);
                        while ($dado_05_22 = $con_05_22->fetch_array()) {
                          $valor1_05_22 = $dado_05_22[0];
                          $valor2_05_22 = $dado_05_22[1];
                          $dif_05_22 = $valor1_05_22 - $valor2_05_22;
                          $sub_05_22 = $sub_04_22 + $dif_05_22;
                        ?>
                          <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_05_22, 2, ',', '.'); ?></td>
                          <input id="2022_05_R" type="hidden" value="<?php echo $valor1_05_22; ?>">
                          <input id="2022_05_D" type="hidden" value="<?php echo $valor2_05_22; ?>">
                          <input id="2022_05_S" type="hidden" value="<?php echo $sub_05_22;
                                                                    } ?>">
                          <?php
                          /*Query para selecionar os valores de Junho*/
                          $consulta_06_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 6 AND YEAR(DATA) = 2022;";
                          $con_06_22 = $connect->query($consulta_06_22) or die($connect->error);
                          while ($dado_06_22 = $con_06_22->fetch_array()) {
                            $valor1_06_22 = $dado_06_22[0];
                            $valor2_06_22 = $dado_06_22[1];
                            $dif_06_22 = $valor1_06_22 - $valor2_06_22;
                            $sub_06_22 = $sub_05_22 + $dif_06_22;
                          ?>
                            <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_06_22, 2, ',', '.'); ?></td>
                            <input id="2022_06_R" type="hidden" value="<?php echo $valor1_06_22; ?>">
                            <input id="2022_06_D" type="hidden" value="<?php echo $valor2_06_22; ?>">
                            <input id="2022_06_S" type="hidden" value="<?php echo $sub_06_22;
                                                                      } ?>">
                            <?php
                            /*Query para selecionar os valores de Julho*/
                            $consulta_07_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 7 AND YEAR(DATA) = 2022;";
                            $con_07_22 = $connect->query($consulta_07_22) or die($connect->error);
                            while ($dado_07_22 = $con_07_22->fetch_array()) {
                              $valor1_07_22 = $dado_07_22[0];
                              $valor2_07_22 = $dado_07_22[1];
                              $dif_07_22 = $valor1_07_22 - $valor2_07_22;
                              $sub_07_22 = $sub_06_22 + $dif_07_22;
                            ?>
                              <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_07_22, 2, ',', '.'); ?></td>
                              <input id="2022_07_R" type="hidden" value="<?php echo $valor1_07_22; ?>">
                              <input id="2022_07_D" type="hidden" value="<?php echo $valor2_07_22; ?>">
                              <input id="2022_07_S" type="hidden" value="<?php echo $sub_07_22;
                                                                        } ?>">
                              <?php
                              /*Query para selecionar os valores de Agosto*/
                              $consulta_08_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 8 AND YEAR(DATA) = 2022;";
                              $con_08_22 = $connect->query($consulta_08_22) or die($connect->error);
                              while ($dado_08_22 = $con_08_22->fetch_array()) {
                                $valor1_08_22 = $dado_08_22[0];
                                $valor2_08_22 = $dado_08_22[1];
                                $dif_08_22 = $valor1_08_22 - $valor2_08_22;
                                $sub_08_22 = $sub_07_22 + $dif_08_22;
                              ?>
                                <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_08_22, 2, ',', '.'); ?></td>
                                <input id="2022_08_R" type="hidden" value="<?php echo $valor1_08_22; ?>">
                                <input id="2022_08_D" type="hidden" value="<?php echo $valor2_08_22; ?>">
                                <input id="2022_08_S" type="hidden" value="<?php echo $sub_08_22;
                                                                          } ?>">
                                <?php
                                /*Query para selecionar os valores de Setembro*/
                                $consulta_09_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 9 AND YEAR(DATA) = 2022;";
                                $con_09_22 = $connect->query($consulta_09_22) or die($connect->error);
                                while ($dado_09_22 = $con_09_22->fetch_array()) {
                                  $valor1_09_22 = $dado_09_22[0];
                                  $valor2_09_22 = $dado_09_22[1];
                                  $dif_09_22 = $valor1_09_22 - $valor2_09_22;
                                  $sub_09_22 = $sub_08_22 + $dif_09_22;
                                ?>
                                  <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_09_22, 2, ',', '.'); ?></td>
                                  <input id="2022_09_R" type="hidden" value="<?php echo $valor1_09_22; ?>">
                                  <input id="2022_09_D" type="hidden" value="<?php echo $valor2_09_22; ?>">
                                  <input id="2022_09_S" type="hidden" value="<?php echo $sub_09_22;
                                                                            } ?>">
                                  <?php
                                  /*Query para selecionar os valores de Outubro*/
                                  $consulta_10_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 10 AND YEAR(DATA) = 2022;";
                                  $con_10_22 = $connect->query($consulta_10_22) or die($connect->error);
                                  while ($dado_10_22 = $con_10_22->fetch_array()) {
                                    $valor1_10_22 = $dado_10_22[0];
                                    $valor2_10_22 = $dado_10_22[1];
                                    $dif_10_22 = $valor1_10_22 - $valor2_10_22;
                                    $sub_10_22 = $sub_09_22 + $dif_10_22;
                                  ?>
                                    <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_10_22, 2, ',', '.'); ?></td>
                                    <input id="2022_10_R" type="hidden" value="<?php echo $valor1_10_22; ?>">
                                    <input id="2022_10_D" type="hidden" value="<?php echo $valor2_10_22; ?>">
                                    <input id="2022_10_S" type="hidden" value="<?php echo $sub_10_22;
                                                                              } ?>">
                                    <?php
                                    /*Query para selecionar os valores de Novembro*/
                                    $consulta_11_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 11 AND YEAR(DATA) = 2022;";
                                    $con_11_22 = $connect->query($consulta_11_22) or die($connect->error);
                                    while ($dado_11_22 = $con_11_22->fetch_array()) {
                                      $valor1_11_22 = $dado_11_22[0];
                                      $valor2_11_22 = $dado_11_22[1];
                                      $dif_11_22 = $valor1_11_22 - $valor2_11_22;
                                      $sub_11_22 = $sub_10_22 + $dif_11_22;
                                    ?>
                                      <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_11_22, 2, ',', '.'); ?></td>
                                      <input id="2022_11_R" type="hidden" value="<?php echo $valor1_11_22; ?>">
                                      <input id="2022_11_D" type="hidden" value="<?php echo $valor2_11_22; ?>">
                                      <input id="2022_11_S" type="hidden" value="<?php echo $sub_11_22;
                                                                                } ?>">
                                      <?php
                                      /*Query para selecionar os valores de Dezembro*/
                                      $consulta_12_22 = "SELECT SUM(RECEITA) AS RECEITA, SUM(DESPESA) AS DESPESA FROM lancamentos WHERE MONTH(DATA) = 12 AND YEAR(DATA) = 2022;";
                                      $con_12_22 = $connect->query($consulta_12_22) or die($connect->error);
                                      while ($dado_12_22 = $con_12_22->fetch_array()) {
                                        $valor1_12_22 = $dado_12_22[0];
                                        $valor2_12_22 = $dado_12_22[1];
                                        $dif_12_22 = $valor1_12_22 - $valor2_12_22;
                                        $sub_12_22 = $sub_11_22 + $dif_12_22;
                                      ?>
                                        <td style="width: auto; text-align: center; font-size:small;"> R$ <?php echo number_format($dif_12_22, 2, ',', '.'); ?></td>
                                        <input id="2022_12_R" type="hidden" value="<?php echo $valor1_12_22; ?>">
                                        <input id="2022_12_D" type="hidden" value="<?php echo $valor2_12_22; ?>">
                                        <input id="2022_12_S" type="hidden" value="<?php echo $sub_12_22;
                                                                                  } ?>">
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

  <script>
    //Confirmação saída
    function confirmacao() {
      var confirma = confirm('Deseja sair?');
      if (confirma == true) {
        window.location = "http://localhost/controle-financeiro/index.php";
      } else {
        window.location = "#";
      }
    };



    // Gráficos
    //Gráficos
    var ctx = document.getElementsByClassName("line-chart");
    var ctx2 = document.getElementsByClassName("line-chart-2");
    var ctx3 = document.getElementsByClassName("line-chart-3");
    var ctx4 = document.getElementsByClassName("line-chart-4");


    //Receitas 2019
    var jan_19_R = document.getElementById('2019_01_R').value;
    var fev_19_R = document.getElementById('2019_02_R').value;
    var mar_19_R = document.getElementById('2019_03_R').value;
    var abr_19_R = document.getElementById('2019_04_R').value;
    var mai_19_R = document.getElementById('2019_05_R').value;
    var jun_19_R = document.getElementById('2019_06_R').value;
    var jul_19_R = document.getElementById('2019_07_R').value;
    var ago_19_R = document.getElementById('2019_08_R').value;
    var set_19_R = document.getElementById('2019_09_R').value;
    var out_19_R = document.getElementById('2019_10_R').value;
    var nov_19_R = document.getElementById('2019_11_R').value;
    var dez_19_R = document.getElementById('2019_11_R').value;
    //Despesas 2019
    var jan_19_D = document.getElementById('2019_01_D').value;
    var fev_19_D = document.getElementById('2019_02_D').value;
    var mar_19_D = document.getElementById('2019_03_D').value;
    var abr_19_D = document.getElementById('2019_04_D').value;
    var mai_19_D = document.getElementById('2019_05_D').value;
    var jun_19_D = document.getElementById('2019_06_D').value;
    var jul_19_D = document.getElementById('2019_07_D').value;
    var ago_19_D = document.getElementById('2019_08_D').value;
    var set_19_D = document.getElementById('2019_09_D').value;
    var out_19_D = document.getElementById('2019_10_D').value;
    var nov_19_D = document.getElementById('2019_11_D').value;
    var dez_19_D = document.getElementById('2019_11_D').value;
    //Subtotal 2019
    var fev_19_S = document.getElementById('2019_02_S').value;
    var mar_19_S = document.getElementById('2019_03_S').value;
    var abr_19_S = document.getElementById('2019_04_S').value;
    var mai_19_S = document.getElementById('2019_05_S').value;
    var jun_19_S = document.getElementById('2019_06_S').value;
    var jul_19_S = document.getElementById('2019_07_S').value;
    var ago_19_S = document.getElementById('2019_08_S').value;
    var set_19_S = document.getElementById('2019_09_S').value;
    var out_19_S = document.getElementById('2019_10_S').value;
    var nov_19_S = document.getElementById('2019_11_S').value;
    var dez_19_S = document.getElementById('2019_12_S').value;


    //Receitas 2020
    var jan_20_R = document.getElementById('2020_01_R').value;
    var fev_20_R = document.getElementById('2020_02_R').value;
    var mar_20_R = document.getElementById('2020_03_R').value;
    var abr_20_R = document.getElementById('2020_04_R').value;
    var mai_20_R = document.getElementById('2020_05_R').value;
    var jun_20_R = document.getElementById('2020_06_R').value;
    var jul_20_R = document.getElementById('2020_07_R').value;
    var ago_20_R = document.getElementById('2020_08_R').value;
    var set_20_R = document.getElementById('2020_09_R').value;
    var out_20_R = document.getElementById('2020_10_R').value;
    var nov_20_R = document.getElementById('2020_11_R').value;
    var dez_20_R = document.getElementById('2020_11_R').value;
    //Despesas 2020
    var jan_20_D = document.getElementById('2020_01_D').value;
    var fev_20_D = document.getElementById('2020_02_D').value;
    var mar_20_D = document.getElementById('2020_03_D').value;
    var abr_20_D = document.getElementById('2020_04_D').value;
    var mai_20_D = document.getElementById('2020_05_D').value;
    var jun_20_D = document.getElementById('2020_06_D').value;
    var jul_20_D = document.getElementById('2020_07_D').value;
    var ago_20_D = document.getElementById('2020_08_D').value;
    var set_20_D = document.getElementById('2020_09_D').value;
    var out_20_D = document.getElementById('2020_10_D').value;
    var nov_20_D = document.getElementById('2020_11_D').value;
    var dez_20_D = document.getElementById('2020_11_D').value;
    //Subtotal 2020
    var jan_20_S = document.getElementById('2020_01_S').value;
    var fev_20_S = document.getElementById('2020_02_S').value;
    var mar_20_S = document.getElementById('2020_03_S').value;
    var abr_20_S = document.getElementById('2020_04_S').value;
    var mai_20_S = document.getElementById('2020_05_S').value;
    var jun_20_S = document.getElementById('2020_06_S').value;
    var jul_20_S = document.getElementById('2020_07_S').value;
    var ago_20_S = document.getElementById('2020_08_S').value;
    var set_20_S = document.getElementById('2020_09_S').value;
    var out_20_S = document.getElementById('2020_10_S').value;
    var nov_20_S = document.getElementById('2020_11_S').value;
    var dez_20_S = document.getElementById('2020_12_S').value;


    //Receitas 2021
    var jan_21_R = document.getElementById('2021_01_R').value;
    var fev_21_R = document.getElementById('2021_02_R').value;
    var mar_21_R = document.getElementById('2021_03_R').value;
    var abr_21_R = document.getElementById('2021_04_R').value;
    var mai_21_R = document.getElementById('2021_05_R').value;
    var jun_21_R = document.getElementById('2021_06_R').value;
    var jul_21_R = document.getElementById('2021_07_R').value;
    var ago_21_R = document.getElementById('2021_08_R').value;
    var set_21_R = document.getElementById('2021_09_R').value;
    var out_21_R = document.getElementById('2021_10_R').value;
    var nov_21_R = document.getElementById('2021_11_R').value;
    var dez_21_R = document.getElementById('2021_11_R').value;
    //Despesas 2021
    var jan_21_D = document.getElementById('2021_01_D').value;
    var fev_21_D = document.getElementById('2021_02_D').value;
    var mar_21_D = document.getElementById('2021_03_D').value;
    var abr_21_D = document.getElementById('2021_04_D').value;
    var mai_21_D = document.getElementById('2021_05_D').value;
    var jun_21_D = document.getElementById('2021_06_D').value;
    var jul_21_D = document.getElementById('2021_07_D').value;
    var ago_21_D = document.getElementById('2021_08_D').value;
    var set_21_D = document.getElementById('2021_09_D').value;
    var out_21_D = document.getElementById('2021_10_D').value;
    var nov_21_D = document.getElementById('2021_11_D').value;
    var dez_21_D = document.getElementById('2021_11_D').value;
    //Subtotal 2021
    var jan_21_S = document.getElementById('2021_01_S').value;
    var fev_21_S = document.getElementById('2021_02_S').value;
    var mar_21_S = document.getElementById('2021_03_S').value;
    var abr_21_S = document.getElementById('2021_04_S').value;
    var mai_21_S = document.getElementById('2021_05_S').value;
    var jun_21_S = document.getElementById('2021_06_S').value;
    var jul_21_S = document.getElementById('2021_07_S').value;
    var ago_21_S = document.getElementById('2021_08_S').value;
    var set_21_S = document.getElementById('2021_09_S').value;
    var out_21_S = document.getElementById('2021_10_S').value;
    var nov_21_S = document.getElementById('2021_11_S').value;
    var dez_21_S = document.getElementById('2021_12_S').value;


    //Receitas 2022
    var jan_22_R = document.getElementById('2022_01_R').value;
    var fev_22_R = document.getElementById('2022_02_R').value;
    var mar_22_R = document.getElementById('2022_03_R').value;
    var abr_22_R = document.getElementById('2022_04_R').value;
    var mai_22_R = document.getElementById('2022_05_R').value;
    var jun_22_R = document.getElementById('2022_06_R').value;
    var jul_22_R = document.getElementById('2022_07_R').value;
    var ago_22_R = document.getElementById('2022_08_R').value;
    var set_22_R = document.getElementById('2022_09_R').value;
    var out_22_R = document.getElementById('2022_10_R').value;
    var nov_22_R = document.getElementById('2022_11_R').value;
    var dez_22_R = document.getElementById('2022_11_R').value;
    //Despesas 2022
    var jan_22_D = document.getElementById('2022_01_D').value;
    var fev_22_D = document.getElementById('2022_02_D').value;
    var mar_22_D = document.getElementById('2022_03_D').value;
    var abr_22_D = document.getElementById('2022_04_D').value;
    var mai_22_D = document.getElementById('2022_05_D').value;
    var jun_22_D = document.getElementById('2022_06_D').value;
    var jul_22_D = document.getElementById('2022_07_D').value;
    var ago_22_D = document.getElementById('2022_08_D').value;
    var set_22_D = document.getElementById('2022_09_D').value;
    var out_22_D = document.getElementById('2022_10_D').value;
    var nov_22_D = document.getElementById('2022_11_D').value;
    var dez_22_D = document.getElementById('2022_11_D').value;
    //Subtotal 2022
    var jan_22_S = document.getElementById('2022_01_S').value;
    var fev_22_S = document.getElementById('2022_02_S').value;
    var mar_22_S = document.getElementById('2022_03_S').value;
    var abr_22_S = document.getElementById('2022_04_S').value;
    var mai_22_S = document.getElementById('2022_05_S').value;
    var jun_22_S = document.getElementById('2022_06_S').value;
    var jul_22_S = document.getElementById('2022_07_S').value;
    var ago_22_S = document.getElementById('2022_08_S').value;
    var set_22_S = document.getElementById('2022_09_S').value;
    var out_22_S = document.getElementById('2022_10_S').value;
    var nov_22_S = document.getElementById('2022_11_S').value;
    var dez_22_S = document.getElementById('2022_12_S').value;


    // 2019
    var chartGraph = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        datasets: [{
            label: "Receitas",
            data: [
              jan_19_R,
              fev_19_R,
              mar_19_R,
              abr_19_R,
              mai_19_R,
              jun_19_R,
              jul_19_R,
              ago_19_R,
              set_19_R,
              out_19_R,
              nov_19_R,
              dez_19_R
            ],
            borderWidth: 2,
            borderColor: 'rgba(63, 191, 76, 0.85)',
            backgroundColor: 'rgba(63, 191, 76, 0.85)',
          },
          {
            label: "Despesas",
            data: [
              jan_19_D,
              fev_19_D,
              mar_19_D,
              abr_19_D,
              mai_19_D,
              jun_19_D,
              jul_19_D,
              ago_19_D,
              set_19_D,
              out_19_D,
              nov_19_D,
              dez_19_D
            ],
            borderWidth: 2,
            borderColor: 'rgba(255, 0, 0, 1.0)',
            backgroundColor: 'rgba(255, 0, 0, 1.0)',
          }

        ]
      },
      options: {
        title: {
          display: true,
          fontSize: 20,
          text: "Balanço financeiro mensal - 2019",
          fontColor: 'black'
        },
        labels: {
          fontStyle: "bold"
        },
        scales: {
          yAxes: [{
            ticks: {
              callback: function(value, index, values) {
                return 'R$ ' + value;
              }
            }
          }]
        }
      }
    });


    //2020
    var chartGraph = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        datasets: [{
            label: "Receitas",
            data: [
              jan_20_R,
              fev_20_R,
              mar_20_R,
              abr_20_R,
              mai_20_R,
              jun_20_R,
              jul_20_R,
              ago_20_R,
              set_20_R,
              out_20_R,
              nov_20_R,
              dez_20_R
            ],
            borderWidth: 2,
            borderColor: 'rgba(63, 191, 76, 0.85)',
            backgroundColor: 'rgba(63, 191, 76, 0.85)',
          },
          {
            label: "Despesas",
            data: [
              jan_20_D,
              fev_20_D,
              mar_20_D,
              abr_20_D,
              mai_20_D,
              jun_20_D,
              jul_20_D,
              ago_20_D,
              set_20_D,
              out_20_D,
              nov_20_D,
              dez_20_D
            ],
            borderWidth: 2,
            borderColor: 'rgba(255, 0, 0, 1.0)',
            backgroundColor: 'rgba(255, 0, 0, 1.0)',
          }
        ]
      },
      options: {
        title: {
          display: true,
          fontSize: 20,
          text: "Balanço financeiro mensal - 2020",
          fontColor: 'black'
        },
        labels: {
          fontStyle: "bold"
        },
        scales: {
          yAxes: [{
            ticks: {
              callback: function(value, index, values) {
                return 'R$ ' + value;
              }
            }
          }]
        }
      }
    });


    //2021
    var chartGraph = new Chart(ctx3, {
      type: 'bar',
      data: {
        labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        datasets: [{
            label: "Receitas",
            data: [
              jan_21_R,
              fev_21_R,
              mar_21_R,
              abr_21_R,
              mai_21_R,
              jun_21_R,
              jul_21_R,
              ago_21_R,
              set_21_R,
              out_21_R,
              nov_21_R,
              dez_21_R
            ],
            borderWidth: 2,
            borderColor: 'rgba(63, 191, 76, 0.85)',
            backgroundColor: 'rgba(63, 191, 76, 0.85)',
          },
          {
            label: "Despesas",
            data: [
              jan_21_D,
              fev_21_D,
              mar_21_D,
              abr_21_D,
              mai_21_D,
              jun_21_D,
              jul_21_D,
              ago_21_D,
              set_21_D,
              out_21_D,
              nov_21_D,
              dez_21_D
            ],
            borderWidth: 2,
            borderColor: 'rgba(255, 0, 0, 1.0)',
            backgroundColor: 'rgba(255, 0, 0, 1.0)',
          }
        ]
      },
      options: {
        title: {
          display: true,
          fontSize: 20,
          text: "Balanço financeiro mensal - 2021",
          fontColor: 'black'
        },
        labels: {
          fontStyle: "bold"
        },
        scales: {
          yAxes: [{
            ticks: {
              callback: function(value, index, values) {
                return 'R$ ' + value;
              }
            }
          }]
        }
      }
    });


    //2022
    var chartGraph = new Chart(ctx4, {
      type: 'bar',
      data: {
        labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        datasets: [{
            label: "Receitas",
            data: [
              jan_22_R,
              fev_22_R,
              mar_22_R,
              abr_22_R,
              mai_22_R,
              jun_22_R,
              jul_22_R,
              ago_22_R,
              set_22_R,
              out_22_R,
              nov_22_R,
              dez_22_R
            ],
            borderWidth: 2,
            borderColor: 'rgba(63, 191, 76, 0.85)',
            backgroundColor: 'rgba(63, 191, 76, 0.85)',
          },
          {
            label: "Despesas",
            data: [
              jan_22_D,
              fev_22_D,
              mar_22_D,
              abr_22_D,
              mai_22_D,
              jun_22_D,
              jul_22_D,
              ago_22_D,
              set_22_D,
              out_22_D,
              nov_22_D,
              dez_22_D
            ],
            borderWidth: 2,
            borderColor: 'rgba(255, 0, 0, 1.0)',
            backgroundColor: 'rgba(255, 0, 0, 1.0)',
          }
        ]
      },
      options: {
        title: {
          display: true,
          fontSize: 20,
          text: "Balanço financeiro mensal - 2022",
          fontColor: 'black'
        },
        labels: {
          fontStyle: "bold"
        },
        scales: {
          yAxes: [{
            ticks: {
              callback: function(value, index, values) {
                return 'R$ ' + value;
              }
            }
          }]
        }
      }
    });








    var a = parseFloat(dez_22_S);
    var sub = a.toLocaleString('pt-br', {
      style: 'currency',
      currency: 'BRL'
    });
    var element = document.getElementById('subtotal');
    element.innerHTML = '<b>' + sub + '</b>';
  </script>

</body>

</html>