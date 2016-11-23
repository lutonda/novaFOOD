<?php
$idvenda = $_POST['vA'];
include_once("../models/vendas.php");
include_once("../models/adon.php");
include_once("../models/system.php");
$sy = new system();
$vn = new vendas();
$ad = new adon();
$em = $sy::verEmpresa();
$si = $sy::verSistema();
$total = 0;
if ($_POST['cliente'] != null) {
    $query = array(
        'nome' => $_POST['cliente'],
        'id' => $idvenda,
    );
    $vn->up_venda($query);
}
$query = $vn::listar($idvenda, "v.id=".$idvenda);
while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
    $nomeCliente = $dado->cliente;
    $totalVenda = $vn::totalItem($dado->venda);
    $estado = $vn::venda_estado($dado->estado);
    $data = $dado->data;
    $tutor = $dado->tutor;
    $desconto = 0;
    break;
}
?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Finalizar - </title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box {
                margin: -100px !important;
                padding: -100px !important;
            }

            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        .print, .back {
            padding: 15px;
            margin: 15px;
            border: solid 1px #FFF;
            box-shadow: 0 0 5px rgba(0, 0, 0, .5);
            border-radius: 5px;
            font-size: 16px;
            transition: .5s;
            cursor: pointer;

        }

        .print:hover, .back:hover {

            background: #aaa;
            border: solid 1px #00b0ff;
            color: #00b0ff;
            box-shadow: 0 0 10px rgba(0, 0, 0, .8);
        }
    </style>
    <script src="../js/jquery-1.11.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.print').click(function () {

                    if ($('button').hide()) {
                        alert('factura Finalizada com sucesso')
                        print()
                        $.ajax({
                            url: "../models/ajax.php?funcao=venda_painel_new&id=0",
                            type: "GET",
                            success: function (data) {
                            }
                        })
                        var url = "../painel.php";
                        $(location).attr('href', url);

                    }
                }
            )
        })
    </script>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="http://nextstepwebs.com/images/logo.png" style="width:100%; max-width:300px;">
                        </td>

                        <td><h2><?= $em->nome_a ?></h2>
                            <?= $em->slogam ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>

                            <h1>#: <?= $idvenda ?></h1>
                            Data: <?= date('h:i:s, d/M/Y') ?>
                        </td>

                        <td>
                            <?= $dado->cliente ?><br>
                            999999<br>
                            Consumidor final
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>
                Payment Method
            </td>

            <td>
                Check #
            </td>
        </tr>

        <tr class="details">
            <td>
                Check
            </td>

            <td>
                1000
            </td>
        </tr>

        <tr class="heading">
            <td>
                Item
            </td>

            <td>
                Total a Pagar
            </td>
        </tr>

        <?= $vn->venda_painel_print($idvenda); ?>

        <tr>
            <td colspan="2">
                <hr>
                <center>
                    <?= $em->endereco ?><br>
                    <?= $em->telefone_a ?>,
                    <?= $em->email_a ?>
                    <?= $em->website ?>
                    <hr>

                    PROCESSADO POR COMPUTADOR | <?= $tutor ?>
                </center>
            </td>
        </tr>
    </table>
    <a href="../painel.php">
        <button class="back" style="background: #f00 ">
            < Voltar
        </button>
    </a>
    <button class="print">
        IMPRIMIR
    </button>
</div>
</body>
</html>