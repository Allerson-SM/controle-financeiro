<?php
require_once 'componentes/dados-home.php';

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
                    <h1 class="h2">Lançamento</h1>
                </div>

                <form class="row g-3" id="form-lancamento" action="componentes\cadastrar-item.php" method="POST">
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Valor</label>
                        <input name="valor" type="text" class="form-control" id="inputValor" onKeyPress="return(moeda(this,'.',',',event))">
                    </div>
                    <div class="col-md-4">
                        <label for="inputDate" class="form-label">Data</label>
                        <input name="data" type="date" class="form-control" id="inputCity">
                    </div>
                    <div class="col-md-5">
                        <label for="inputPassword4" class="form-label">Descrição</label>
                        <input name="descricao" type="text" class="form-control" id="inputPassword4">
                    </div>
                    <div class="col-md-3">
                        <label for="inputState" class="form-label">Tipo</label>
                        <select name="tipo" id="inputState" class="form-select">
                            <option selected>Receita</option>
                            <option>Despesa</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>





                <!-- scripts -->

                <script>
                    function confirmacao() {
                        var confirma = confirm('Deseja sair?');
                        if (confirma == true) {
                            window.location = "http://localhost/controle-financeiro/index.php";
                        } else {
                            window.location = "#";
                        }
                    };


                    //fonte: https://gist.github.com/antoniopassos/203181
                    function moeda(a, e, r, t) {
                        let n = "",
                            h = j = 0,
                            u = tamanho2 = 0,
                            l = ajd2 = "",
                            o = window.Event ? t.which : t.keyCode;
                        if (13 == o || 8 == o)
                            return !0;
                        if (n = String.fromCharCode(o),
                            -1 == "0123456789".indexOf(n))
                            return !1;
                        for (u = a.value.length,
                            h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
                        ;
                        for (l = ""; h < u; h++)
                            -
                            1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
                        if (l += n,
                            0 == (u = l.length) && (a.value = ""),
                            1 == u && (a.value = "0" + r + "0" + l),
                            2 == u && (a.value = "0" + r + l),
                            u > 2) {
                            for (ajd2 = "",
                                j = 0,
                                h = u - 3; h >= 0; h--)
                                3 == j && (ajd2 += e,
                                    j = 0),
                                ajd2 += l.charAt(h),
                                j++;
                            for (a.value = "",
                                tamanho2 = ajd2.length,
                                h = tamanho2 - 1; h >= 0; h--)
                                a.value += ajd2.charAt(h);
                            a.value += r + l.substr(u - 2, u)
                        }
                        return !1
                    }
                </script>



</body>

</html>