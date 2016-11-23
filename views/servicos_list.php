<?php
include_once("../models/servicos.php");
include_once("../models/adon.php");
$ad = new adon();
$sr = new servico();
$query = $sr::listar(" order by s.nome");
?>

<servico>
    <div class="row page-header">
        <div class="col-sm-3 col-md-3">
            <h1>Produtos</h1>
        </div>
    </div>
    <div class="col-sm-3 col-md-12">
        <div class="col-sm-3 col-md-4">
            <div class="input-group">
                <input type="search" class="form-control" id="search-input">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default">Procurar</button>
                </span>
            </div>
        </div>
        <div class="col-sm-3 col-md-8">
            <div class="btn-group navbar-right" role="group" aria-label="...">

                <form method="post" action="javascript:;">
                    <div class="input-group col col-md-12 serch_box ">
																			<span
                                                                                class="input-group-addon btn btn-primary"
                                                                                style="padding:0 !important;">
																				<span type="button"
                                                                                      class="btn btn-primary novo"
                                                                                      value="servico_new"
                                                                                      style="width:100%">
                         								<span class="fa fa-plus-square"></span> </span></span>
                        <span class="input-group-addon btn btn-primary print" title="Imprimir">
																				<span class="fa fa-file-pdf-o"></span> /
																				<span class="fa fa-print"></span></span>
                        <input type="email" class="form-control btn search cliente" id="searchid" name="nome"
                               placeholder="E-mail" aria-describedby="basic-addon1" style="display:none !important">
                        <span class="input-group-addon btn btn-primary mail" id="basic-addon1"><span
                                class="fa fa-envelope-o"></span></span><span
                            class="input-group-addon btn btn-primary link" value="vendas_list">Voltar</span>
                    </div>
                </form>

            </div>
            <br><br></div>
    </div>
    <div class="col-sm-3 col-md-12">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th colspan="2">Codigo</th>
                    <th>Nome</th>
                    <th>preço</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Data</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                    echo '
                <tr>
                  <td>'.$i++.'</td>
                  <td>
                    <img src="img/foods/'.$dado->codigo.'.jpg"
                     
                     width="40px"></td>
                  <td>'.$dado->codigo.'</td>
                  <td>'.$dado->nome.'</td>
                  <td align="right">'.money_format('%!n', $dado->preco).'</td>
                  <td>'.$dado->tipo.'</td>
                  <td><span class="label es-'.$ad::estado($dado->estado).'">'.$ad::estado($dado->estado).'</span></td>
                  <td>'.$ad::data($dado->data).'</td>
                  <td><div class="btn-group" role="group" aria-label="...">
                      <button type="submit" class="btn btn-default btn-ls">
                         <span class="fa fa-edit"></span></button>
                        </div></td>
                </tr>';

                } ?>
                </tbody>
            </table>
        </div>
    </div>
</servico>