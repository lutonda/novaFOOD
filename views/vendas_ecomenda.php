<?php
include_once("../models/vendas.php");
include_once("../models/system.php");
include_once("../models/adon.php");
include_once("../models/usuario.php");

$us = new usuario();
$vn = new vendas();
$ad = new adon();
$sy = new system();
$si = $sy::verSistema();
$query = $vn::listar("id");
?>
<div style="display:none">
    cabeçalho
    <hr>
</div>
<venda_list>
    <div class="row page-header">

        <div class="col-sm-3 col-md-3">
            <h1>Encomendas</h1>
            <form>
                <div class="form-group">

                </div>
            </form>
        </div>


    </div>


    <div class="row">
        <div class="col-sm-3 col-md-12">
            <div class="col-sm-3 col-md-12">
                <div class="col-md-6 navbar-left" role="group" aria-label="..." style="">
                    <div class="widget-body">
                        <form role="form" class="ng-pristine ng-valid" method="post" action="javascript:;" >
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <div class="input-group">

                                                <input type="date" name="data" datepicker="date" class="form-control" id="dropdown-appended">
                                                <div class="input-group-btn dropdown" data-dropdown="">
                                                    <input name="usuario" type="text" value="0" hidden="hidden">

                                                </div><button class="form-control btn btn-primary" style="width: 40px"><span class="fa fa-refresh"></span></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>


                </div>
                <div class="col-md-6 navbar-left" role="group" aria-label="..." style="">
                    <div class="widget-body">
                        <form role="form" class="ng-pristine ng-valid" method="post" action="javascript:;" >
                            <fieldset>
                                <div class="row pull-right">
                                    <div class=" pull-right" style="background: #F00">
                                        <div class="form-group">
                                            <div class="input-group pull-right" >
                                                <div class="input-group-btn dropdown" data-dropdown="" style="width: 50px">
                                                <button type="button" name="data" class="form-control" id="dropdown-appended" value="venda_new" style="width:100%">
                                                    <span class="fa fa-plus-square"></span> Nova Venda </button>
                                                    </div>
                                                <div class="input-group-btn dropdown" data-dropdown="" style="width: 50px">

                                                    <button type="button" name="data" class="form-control" id="dropdown-appended" value="venda_new" style="width:100%">
                                                        <span class="fa fa-envelope-o"></span> </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>


                </div>

            </div>
            <div class="col-sm-3 col-md-12"><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Cliente</th>
                            <th class="text-right">Valor</th>
                            <th>Estado</th>
                            <th>Data</th>
                            <th colspan="2">Tutor</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        $soma=0;
                        $query = $vn::listar("id",'v.estado>3');
                        while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                                $total = $vn::totalItem($dado->venda);
                                if ($total != 0){
                                    $soma += $total;
                            echo '
                <tr>
                  <td>'.$i++.'</td>
                  <td>'.$dado->venda.'</td>
                  <td>'.$dado->cliente.'</td>
                  <td class="text-right">'.money_format('%!n', $total).'</td>
                  <td><span class="label es-'.$vn::venda_estado($dado->estado).'">'.$vn::venda_estado($dado->estado).'</span></td>
                  <td>'.$ad::data($dado->data).'</td>
                  <td><b>'.$dado->tutor.'</b></td>
                  <td class="btn-group pull-right" role="group" aria-label="...">';
                            if ($dado->estado == 1) {
                                echo '<button class="btn btn-default btn invoice_view" value="venda_new?'.$dado->venda.'"><span class="fa fa-edit "></span></button>';
                            }
                            echo '<button class="btn btn-default invoice_view" value="invoice?'.$dado->venda.'"><span class="fa fa-file-text-o "></span></button></td>
                </tr>';

                        } }?>
                        <tr>
                            <td colspan="10" align="right"><h1><?= money_format('%!n',$soma);?> KZ</h1></td>
                        </tr>
                        <?php

                        $query = $vn::listar_pn("id");
                        while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                            $total = $vn::totalItem($dado->venda) - $vn::totalItem(
                                    $dado->venda
                                ) * 1 / 100 + ($vn::totalItem($dado->venda) * $si->iV / 100);
                            if ($total != 0) {
                                $echo ='
                <tr>
                  <td>'.$i++.'</td>
                  <td>'.$dado->venda.'</td>
                  <td> UNKNOW </td>
                  <td class="text-right">'.$total.'</td>
                  <td><span class="label es-canselado">pendente</span></td>
                  <td>'.$ad::data($dado->data).'</td>
                  <td><b>'.$dado->tutor.'</b></td>
                  <td class="btn-group pull-right" role="group" aria-label="...">';
                                if ($dado->estado == 1) {
                                    $echo= '<button class="btn btn-default btn invoice_view" value="venda_new?'.$dado->venda.'"><span class="fa fa-edit "></span></button>';
                                }
                            }

                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</venda_list>
