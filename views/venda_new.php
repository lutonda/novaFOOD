<?php
include_once("../models/clientes.php");
include_once("../models/stock.php");
include_once("../models/vendas.php");
include_once("../models/adon.php");
include_once("../models/system.php");
$sy = new system();
$vn = new vendas();
$ad = new adon();
$st = new stock();
$cl = new cliente();
$em = $sy::verEmpresa();
$si = $sy::verSistema();

setcookie("idVenda", $idvenda, 0, '/');

$em = $sy::verEmpresa();
$idCliente = "";
$nomeCliente = "";
$totalVenda = "";
$estado = "";
$data = "";
$endereco = "";
$pais = "";
$desconto = "";
$query = $vn::listar($idvenda, "v.id=" . $idvenda);
while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
    $nomeCliente = $dado->cliente;
    $totalVenda = $vn::totalItem($dado->venda);
    $estado = $vn::venda_estado($dado->estado);
    $data = $dado->data;
    $desconto = 0;
    break;
} ?>

<venda>
    <div class="row page-header">

        <div class="col-sm-3 col-md-12">
            <h1>Nova Venda #<?= $idvenda ?></h1>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Checkout-Form -->
            <form action="javascript:;" class="new" value="save_venda" method="post">
                <div class="col-sm-3 col-md-12">
                    <div class="btn-group navbar-right" role="group" aria-label="...">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-save"></span> |
                        </button>
                        <button class="btn btn-success estado_venda" value="2?<?= $idvenda ?>">
                            <span class="fa fa-plug"></span> Finalizar
                        </button>

                        <button type="button" class="btn btn-default link" value="vendas_list">
                            | <span class="fa fa-backward"></span></button>
                    </div>
                    <br>
                </div>

                <fieldset class="panel panel-default">
                    <form method="post" action="javascript:;">

                        <input type="text" class="codigo" title="x" name="idCliente" value="<?= $idCliente ?>"
                               hidden="">
                        <input type="text" name="id" value="<?= $idvenda ?>" hidden>
                        <div class="input-group col col-md-12 serch_box ">
                            <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span>Cliente :</span>
                            <input type="text" class="form-control cliente" name="nome" placeholder="Nome"
                                   value="<?= $nomeCliente ?>" aria-describedby="basic-addon1">
                            <div id="result_cliente" class="input-group col col-md-12 serch_box "></div>
                            <span class="input-group-addon btn-primary novo" value="client_new" id="basic-addon1"><span
                                    class="fa fa-plus"></span></span>
                        </div>
                    </form>
                </fieldset>

                <fieldset class="panel panel-default">
                    <div class="input-group col col-md-12">

                        <div class="panel panel-primary">
                            <div class="panel-heading col col-md-12" data-toggle="collapse" data-target="#pop">
                                <h3 class="panel-title">
                                    <span class="fa fa-suitcase"></span>
                                    Novo Item

                                </h3>
                            </div>
                            <table class="panel-body panel-collapse collapse in table col col-md-12" border="1"
                                   id="pop">
                                <thead>
                                <tr>
                                    <td colspan="6">
                                        <form class="">
                                            <div class="serch_box ">
                                                <div class="input-group col col-md-12">
                                                    <span class="input-group-addon" id="basic-addon1"><span
                                                            class="fa fa-balance-scale"></span></span>
                                                    <input type="text" class="form-control search venda" id="searchid"
                                                           placeholder="Codico ou Descrição" name="codigo"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Descrição</th>
                                    <th>Stock</th>
                                    <th>Unidade</th>
                                    <th>Preço</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="result">
                                <td></td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Codigo</th>
                                <th>Descrição</th>
                                <th class="text-right">Quantidade</th>
                                <th class="text-right">Unidade</th>
                                <th class="text-right">Preço</th>
                                <th class="text-right">Desconto</th>
                                <th class="text-right">Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $total = 0;

                            $i = 1;
                            $query = $vn::listar_itemVenda($idvenda, "2");
                            while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                                echo '
																			<tr>
																				<td>' . $i++ . '</td>
																				<td>' . $dado->codigo . '</td>
																				<td>' . $dado->descricao . '  - ' . $dado->texto . '</td>
																				<td class="text-right">' . $dado->qtd . '</td>
																				<td class="text-right">-</td>
																				<td class="text-right">' . money_format('%!n', $dado->preco) . '</td>
																				<td class="text-right">0</td>
																				<td class="text-right">' . money_format('%!n', $dado->preco * $dado->qtd) . '</td>
																				<td><button class="btn btn-danger btn-xs delete" value="itemVenda?' . $dado->id . '"><span class="fa fa-close"></span></button></td>
																			</tr>';
                                $total += +$dado->preco * $dado->qtd;
                            }
                            $query = $vn::listar_itemVenda($idvenda, "1");
                            while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                                echo '
																			<tr>
																				<td>' . $i++ . '</td>
																				<td>' . $dado->codigo . '</td>
																				<td>' . $dado->descricao . ' | ' . $ad::tipo($dado->tipo) . ' - ' . $dado->texto . '</td>
																				<td class="text-right">' . $dado->qtd . '</td>
																				<td class="text-right">' . $dado->qtdUni . '/' . $dado->unidade . '</td>
																				<td class="text-right">' . money_format('%!n', $dado->preco) . '</td>
																				<td class="text-right">0</td>
																				<td class="text-right">' . money_format('%!n', $dado->total) . '</td>
																				<td><button class="btn btn-danger btn-xs delete" value="itemVenda?' . $dado->id . '"><span class="fa fa-close"></span></button></td>
																			</tr>';
                                $total = $total + $dado->total;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                    </cliente>
        </div>


        </fieldset>
        <div class="col-sm-3 col-md-12">
            <div class="col-sm-3 col-md-4 navbar-right">

                <fieldset class="panel panel-default">
                    <table class="table table-striped">

                        <tbody>
                        <tr>
                            <th>SUB TOTAL</th>
                            <th class="text-right"><?= money_format('%!n', $total) ?></th>
                        </tr>

                        <tr>
                            <th>MOEDA</th>
                            <th class="text-right"
                                title="<?= $si->cambioUSD ?> USD = 100,00<?= $si->moeda ?>"><?= $si->moeda ?></th>
                        </tr>

                        <tr>
                            <th>DESCONTO</th>
                            <th class="text-right"
                                title="<?= $desconto ?> %"><?= money_format('%!n', $total * $desconto / 100) ?></th>
                        </tr>

                        <tr>
                            <th>IMPOSTO DE VENDA</th>
                            <th class="text-right"
                                title="<?= $si->iV ?> %"><?= money_format('%!n', $total * $si->iV / 100) ?></th>
                        </tr>
                        <tr>
                            <th><h4>TOTAL </h4></th>
                            <th class="text-right moeda"><h4>
                                    <?= money_format('%!n', $total - $total * $desconto / 100 + $total * $si->iV / 100) ?></h4>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>

            <footer>
                <div class="col-sm-3 col-md-12">
                    <div class="btn-group navbar-right" role="group" aria-label="...">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-save"></span> |
                        </button>
                        <button type="reset" class="btn btn-success estado_venda" value="2?<?= $idvenda ?>">
                            <span class="fa fa-plug"></span> Finalizar
                        </button>
                        <button type="button" class="btn btn-default link" value="vendas_list">
                            | <span class="fa fa-backward"></span></button>
                    </div>

                </div>
            </footer>
        </div>
        </form>

    </div>
</venda>
