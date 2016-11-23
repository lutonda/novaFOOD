<?php
if (!isset($_COOKIE['id_usr'])) {
    header('location: ./');
} ?>
<html>
<head>
    <link rel="stylesheet" href="css/autocomplete.css">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link type="text/css" href="assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">
    <!-- Themify Icons -->
    <link type="text/css" href="assets/css/styles.css" rel="stylesheet">
    <!-- Core CSS with all styles -->
    <link type="text/css" href="assets/plugins/codeprettifier/prettify.css" rel="stylesheet">
    <!-- Code Prettifier -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">
    <!-- iCheck -->
    <link type="text/css" href="assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <!-- FullCalendar -->
    <link type="text/css" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
    <!-- jVectorMap -->
    <link type="text/css" href="assets/plugins/switchery/switchery.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/print/css/print-preview.css" type="text/css" media="screen">
    <link href="css/bootstrap.print.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/print/jquery.print-preview.js"></script>
    <script type="text/javascript" src="js/moeda.js"></script>

    <style>
        .part {
            background: #dfdfdf;
            margin: 10px 0;
            padding: 5px;
        }

        .control {
            width: 150px;
            background: #aaa !important;
            margin: 5px !important;
        }

        .control button {
            text-align: center;
            transition: .2s;
            margin: 5px;
        }

        .control button:hover {

            width: 100%;
            box-shadow: 0 0 5px rgba(0, 0, 0, .5);
        }
        .container-fluid {
            margin-top: -50px !important;

        }
    </style>
    <script>
        $(document).ready(function () {
            $va=0;
            inicio();
            reload_venda();


            /************************************/


            /***************************************/
            $('.nomeCliente').change(function(){
                $('.cliente').attr('value',$(this).val());
            })
            $('.search').submit(function () {

                inicio($('#iV').val());
            })
            $('.new').click(function(){
                nova_venda(0);
            })

            function nova_venda($data) {
                $.ajax({
                    url: "models/ajax.php?funcao=venda_painel_new&id=0",
                    type: "GET",
                    success: function (data) {
                        alert(data);
                    }
                })
            }

            function inicio($data=0) {

                $.ajax({
                    url: "models/ajax.php?funcao=reload&id=" + $data,
                    type: "GET",
                    success: function (data) {
                        $('#stock').html(data);
                        $('.add').click(function () {
                            if (venda_add($(this).attr('pr')))
                                reload_venda()
                        })
                    }
                })
                $.ajax({
                    url: "models/ajax.php?funcao=vA&id=0",
                    type: "GET",
                    success: function (e) {
                        $("h1.vA").html('#' + e);
                        $va=e;
                        $('form .input').attr('value', e);

                    }
                })
            }

            function venda_add($iv) {

                $.ajax({
                    url: "models/ajax.php?funcao=venda_painel_add&id=" + $iv,
                    type: "GET",
                    success: function (data) {
                    }
                })
                return true
            }

            function venda_rem($iv) {

                $.ajax({
                    url: "models/ajax.php?funcao=venda_painel_rem&id=" + $iv,
                    type: "GET",
                    success: function (data) {
                    }
                })
                return true
            }

            function reload_venda($iv=0) {
                $.ajax({
                    url: "models/ajax.php?funcao=venda_painel_reload&id=" + $iv,
                    type: "GET",
                    success: function (data) {
                        if ($('#venda').html(data)) {
                            var total = 0;
                            $('.total_g').each(function () {
                                var valor = Number($(this).attr('value'));
                                if (!isNaN(valor)) total += valor;
                            });
                            $('.total').html(total);
                            $('.moeda').each(function () {
                                var num = $(this).html().split('.');
                                var d = ($(this).html().split('.').length == 2) ? $(this).html().split('.')[0] : $(this).html();
                                var a = d.split('').reverse();
                                var nova = '';
                                $j = 0;
                                for ($i = 0; $i < d.split('').length; $i++) {
                                    nova += a[$i];
                                    if ($j++ == 2 && $i != d.split('').length - 1) {
                                        nova = nova + '.';
                                        $j = 0;
                                    }
                                }
                                a = '';
                                d = nova.split('').reverse();
                                for ($i = 0; $i < nova.split('').length; $i++) {
                                    a += d[$i]
                                }
                                var diz = ($(this).html().split('.').length == 2) ? '' + $(this).html().split('.')[1] : ""
                                if (diz.split('').length == 0)diz = '00';
                                if (diz.split('').length == 1)diz = diz + '0';
                                if (diz.split('').length == 2)diz = diz;

                                a += ',' + diz;
                                $(this).html(a);
                            })
                        }
                        $('.rem').click(function () {
                            if (venda_rem($(this).attr('pr')))
                                reload_venda()
                        })
                    }
                })
            }
        })
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="col-lg-6">
        <div class="col-md-12 part">
            <form method="post" action="javascript:;" class="search">
                <div class="input-group"><input class="form-control" placeholder="Encontrar ... " name="iv" id="iV">
                    <span
                        class="input-group-btn"> <button class="btn btn-default" type="submit">Go!</button> </span>
                </div>
            </form>
        </div>
        <div class="col-md-12 part" style="height:600px " id="stock">

        </div>
        <div class="col-md-12 part"></div>
    </div>
    <div class="col-lg-6">
        <div class="col-md-12 part">
            <form>
                <div class="input-group"><span
                        class="input-group-btn"> <button class="btn btn-default" type="button">Cliente</button> </span>
                    <input class="form-control nomeCliente" placeholder="Nome do Cliente">
                </div>
            </form>
        </div>
        <div class="col-md-12 part" style="height: 500px ; overflow: auto" id="venda">

        </div>
        <div class="col-md-12 part">
            <table border="1" width="100%">
                <tr>
                    <td bgcolor="#ddd"><h1 class="total moeda">5000</h1></td>
                    <td  width="100px"><h1 class="vA">#</h1></td>
                    <td width="100px" class="control">
                        <form method="post" action="views/print.php">
                            <input hidden name="vA" class="input" value="0"/>
                            <input hidden name="cliente" class="cliente" value=""/>
                            <button type="submit" class="btn btn-default  col-md-11  fechar" style="text-align: left">
                                Terminar
                            </button>
                        </form>
                        <a href="painel.php">
                            <button type="submit" class="btn btn-danger  col-md-11 reset" style="text-align: left">
                                Reiniciar
                            </button>
                        </a>
                        <a href="painel.php">
                            <button type="submit" class="btn btn-primary col-md-11 new" style="text-align: left">
                                NOVA
                            </button>
                        </a>
                    </td>

                    <th width="100px" align="center">
                        <img src="imgs/logo/default.png" style="width: 100%; margin-bottom: -30px">
                        <center><?=$_COOKIE['nome_usr']?>

                        <a href="logout.php">
                        <button type="submit" class="btn btn-info btn-xs new" style="text-align: left">
                            sair
                        </button></a>
                        <button type="submit" class="btn btn-danger btn-xs  fechar" style="text-align: left">
                            Fechar Sessção
                        </button>
                        </center>
                    </th>
                </tr>

            </table>
        </div>
    </div>
</div>

</body>
</html>