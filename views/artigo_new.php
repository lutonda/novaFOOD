<?php
include_once("../models/clientes.php");
include_once("../models/adon.php");
include_once("../models/artigos.php");
$ar=new artigo();
$cl=new cliente();
$ad=new adon();
$query=$cl::listar();
?>
          <div class="row page-header">

              <div  class="col-sm-3 col-md-12">
              <h1>Cadastrar Artigo</h1>
              </div>

          </div>

          <div class="col-md-12">
                <!-- Checkout-Form -->
                <form action="javascript:;" class="new" value="new_artigo" method="post">
                    <div  class="col-sm-3 col-md-12">
                 <div class="btn-group navbar-right" role="group" aria-label="...">
                      <button type="submit" class="btn btn-primary">
                         <span class="fa fa-save"></span></button>
                      <button type="reset" class="btn btn-default">
                         <span class="fa fa-refresh"></span></button>
                      <button type="button" class="btn btn-default link" value="artigos_list">
                         <span class="fa fa-ban"></span></button>
                        </div></div>
                    <header>Checkout form</header>

						<fieldset class="panel panel-default">
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
                          <input type="text" class="form-control" placeholder="Codigo de Barras" name="codigo" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group col col-md-4" style="display:none">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-caret-square-o-up"></span>Estado</span>
                            <select class="form-control" name="estado" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Estado</option>
                                        <option value="1" selected="">Ativo</option>
                                        <option value="2">Desativo</option>
                            </select>
                        </div>
                        <br>
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input type="text" class="form-control" name="nome" placeholder="Nome" aria-describedby="basic-addon1">
                        </div>
                             <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <select class="form-control" name="tipo" aria-describedby="basic-addon1">
                                        <option value="-1" selected="" disabled="">Tipo</option>
                                        <?php
                                        $p=$ar::artigocl("artigo_tipo");
                                        while($dado = $p->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$dado->id.'">'.$dado->tipo.'</option>';
                                           }
                                        ?>
                                    </select>
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <select class="form-control" name="categoria" aria-describedby="basic-addon1">
                                        <option value="-1" selected="" disabled="">Categoria</option>
                                        <?php
                                        $p=$ar::artigocl("artigo_categoria");
                                        while($dado = $p->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$dado->id.'">'.$dado->categoria.'</option>';
                                           }
                                        ?>
                                    </select>
                        </div>
                        </fieldset>

                        <fieldset class="panel panel-default">

                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-bar-chart"></span></span>
                          <select class="form-control" name="unidade" placeholder="Unidade" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Unidade</option>
                                        <?php
                                        $p=$ar::artigocl("unidade");
                                        while($dado = $p->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$dado->id.'">'.$dado->unidade.'</option>';
                                           }
                                        ?>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                          <input type="text" class="form-control" name="qtd_unidade" placeholder="qtd/unidade" aria-describedby="basic-addon1">
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                          <input type="text" class="form-control" name="stock_notificacao" placeholder="notificação do stock ate" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">Artigos</span>
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-money"></span></span>
                          <input type="text" class="form-control" name="preco" placeholder="Preço" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">,00 kzs</span>
                        </div>


						</fieldset>

                        <fieldset class="panel panel-default" style="display:none">

                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                          <input type="text" hidden="" name="fornecedor" value=" ">
                          <input type="text" class="form-control" name="fornecedor" placeholder="Fornecedor" aria-describedby="basic-addon1">
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                          <input type="text" class="form-control" name="quantidade" placeholder="Quantidade" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">Artigos</span>
                        </div>
													<div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                          <input type="text" class="form-control" name="cod_compra" placeholder="Codico da factura" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">Artigos</span>
                        </div>

						</fieldset>

                    <fieldset class="panel panel-default">
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Detalhes</span>
                          <textarea class="form-control" name="text_factura" placeholder="Detalhes" aria-describedby="basic-addon1">Padrão</textarea>
                        </div>
						</fieldset>

                    <fieldset class="panel panel-default">
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span>Observação</span>
                          <textarea class="form-control" name="obs" placeholder="Observações" aria-describedby="basic-addon1">padrão</textarea>
                        </div>
						</fieldset>

                    <footer>
                        <div  class="col-sm-3 col-md-12">
                  <div class="btn-group navbar-right" role="group" aria-label="...">
                      <button type="button" class="btn btn-default">
                         <span class="fa fa-save"></span> Salvar</button>
                      <button type="button" class="btn btn-default" >
                         <span class="fa fa-ban"></span> Canselar</button>
                    </div>

              </div>
                    </footer>
                </form>

            </div>
