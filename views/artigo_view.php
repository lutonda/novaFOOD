<?php
include_once("../models/artigos.php");
include_once("../models/stock.php");
include_once('adon.php');
$ar=new artigo();
$st=new stock();
$ad=new adon();
?>
<artigo>
	<div class="input-group col col-md-12">
							<div class="panel panel-primary pop-up ">
									<div class="panel-heading">
										<h3 class="panel-title">
												<span class="fa fa-suitcase"></span>
												Adicionar compra</h3>
							   		</div>


										<div class="panel-body panel-collapse collapse in">
										<fieldset class="panel panel-default">
											<div class="col col-md-4"><h3 class="nome">Nome: </h3></div>
												<div class="col col-md-4"></div>
											<div class="col col-md-4"><h3 class="stock">Stock actual: </h3></div>
										</fieldset>

                    <form action="javascript:;" class="new" value="new_stock" method="post">
											<input type="text" name="idItem" class="idItem" hidden="">
										 <fieldset class="panel panel-default">
                        <div class="input-group col col-md-12">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
                          <input type="text" class="form-control" placeholder="Fornecedor" name="idFornecedor" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group col col-md-5">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <input type="text" class="form-control" name="qtd" placeholder="Quantidade" aria-describedby="basic-addon1">
													<span class="input-group-addon adon" id="basic-addon1"></span>
                        </div>
												<div class="input-group col col-md-6">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input type="text" class="form-control" name="cod_compra" placeholder="Referencia" aria-describedby="basic-addon1">
                        </div>
											</fieldset>
											<div  class="col-sm-3 col-md-12">
												 <div class="btn-group navbar-right" role="group" aria-label="...">
															<button type="submit" class="btn btn-primary">
																 <span class="fa fa-save"></span> Salvar</button>
															<button type="reset" class="btn btn-default">
																 <span class="fa fa-save"></span> Reiniciar</button>
															<button type="button" class="btn btn-default link ban" value="artigo_view?<?=$idvenda?>">
																 <span class="fa fa-ban"></span> Canselar</button>
																</div></div>			</form>
															</div>
														</div>
													</div>

          <div class="row page-header">

              <div  class="col-sm-3 col-md-3">
              <h1>Artigo #<?=$idvenda?></h1>
              </div>
          </div>
				<div  class="col-sm-3 col-md-12">
          <div  class="col-sm-3 col-md-12">
                  <div class="btn-group navbar-right" role="group" aria-label="...">
										<div class="btn-group navbar-right" role="group" aria-label="...">
																<form method="post" action="javascript:;">
                  										<div class="input-group col col-md-12 serch_box ">
																			<span class="input-group-addon btn btn-primary" style="padding:0 !important;">
																				<span type="button" class="btn btn-primary add" att="addstock" value="<?=$idvenda?>" style="width:100%">
                         								<span class="fa fa-plus-square"></span> </span></span>
																				<span class="input-group-addon btn btn-primary print" title="Imprimir">
																				<span class="fa fa-file-pdf-o"></span> /
																				<span class="fa fa-print"></span></span>
																				<input type="email" class="form-control btn search cliente" id="searchid" name="nome" placeholder="E-mail" aria-describedby="basic-addon1" style="display:none !important">
																			<span class="input-group-addon btn btn-primary mail" id="basic-addon1"><span class="fa fa-envelope-o"></span></span><span class="input-group-addon btn btn-primary link" value="artigos_list">Voltar</span>
																</div>
																</form>

            				</div>
              </div>
				<br><br>
      </div>
<?php $query=$ar::selecionar($idvenda);
 while($dado = $query->fetch(PDO::FETCH_OBJ)){?>
					<div class="col col-md-12">
							<form action="javascript:;" class="new" value="new_artigo" method="post">
                    <div  class="col-sm-3 col-md-12">
									 		<div class="btn-group navbar-right  toggle" role="group" aria-label="...">
												<button type="button" class="btn btn-primary toggle">
												<span class="fa fa-edit"></span></button></div>
                 <div class="btn-group navbar-right  toggle" style="display:none" role="group" aria-label="...">
                      <button type="submit" class="btn btn-primary" >
                         <span class="fa fa-save"></span></button>
                      <button type="button" class="btn btn-default link toggle" style="display:none" value="artigo_view?<?=$idvenda?>">
                         <span class="fa fa-ban"></span></button>
                        </div></div>
                    <header>Checkout form</header>

						<fieldset class="panel panel-default">
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
                          <input type="text" class="form-control" placeholder="Codigo de Barras" name="codigo" value="<?=$dado->codigo?>" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-caret-square-o-up"></span></span>
                            <select class="form-control" name="estado" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Estado</option>
                                        <option value="1">Ativo</option>
                                        <option value="2">Desativo</option>
                            </select>
                        </div>
                        <br>
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input value="<?=$dado->nome?>" type="text" class="form-control" name="nome" placeholder="Nome" aria-describedby="basic-addon1">
                        </div>
                             <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <select class="form-control" name="tipo" aria-describedby="basic-addon1">
                                        <option value="-1" disabled="">Tipo</option>
                                        <?php
                                        $p=$ar::artigocl("artigo_tipo");
                                        while($d = $p->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$d->id.'" '.(($dado->tipo==$d->id)?"selected=\"\"":"").'>'.$d->tipo.'</option>';
                                           }
                                        ?>
                                    </select>
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <select class="form-control" name="categoria" aria-describedby="basic-addon1">
                                        <option value="-1" disabled="">Categoria</option>
                                        <?php
                                        $p=$ar::artigocl("artigo_categoria");
                                        while($d = $p->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$d->id.'"'.(($dado->categoria==$d->id)?'selected=""':'').'>'.$d->categoria.'</option>';
                                           }
                                        ?>
                                    </select>
                        </div>
                        </fieldset>

                        <fieldset class="panel panel-default">

                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-bar-chart"></span></span>
                          <select class="form-control" name="unidade" placeholder="Unidade" aria-describedby="basic-addon1">
                                        <option value="0" disabled="">Unidade</option>
                                        <?php
                                        $p=$ar::artigocl("unidade");
                                        while($d = $p->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$d->id.'" '.(($dado->unidade==$d->id)?'selected=""':'').'>'.$d->unidade.'</option>';
                                           }
                                        ?>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                          <input value="<?=$dado->qtd_unidade?>" type="text" class="form-control" name="qtd_unidade" placeholder="qtd/unidade" aria-describedby="basic-addon1">
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                          <input  value="<?=$dado->stock_notificacao?>" type="text" class="form-control" name="stock_notificacao" placeholder="notificação do stock ate" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">Artigos</span>
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-money"></span></span>
                          <input value="<?=$dado->preco?>"  type="text" class="form-control" name="preco" placeholder="Preço" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">,00 kzs</span>
                        </div>


						</fieldset>


                    <fieldset class="panel panel-default">
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <textarea class="form-control" name="text_factura" placeholder="Detalhes" aria-describedby="basic-addon1"><?=$dado->text_factura?></textarea>
                        </div>
						</fieldset>

                    <fieldset class="panel panel-default">
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <textarea class="form-control" name="obs" placeholder="Observações" aria-describedby="basic-addon1"><?=$dado->obs?> </textarea>
                        </div>
						</fieldset>

                </form>
					</div><?php }?>
        <div class="col-sm-3 col-md-12">

              <h1>Vendas</h1>/Saidas
<div class="table-responsive">

            <table class="table table-striped artigo_list">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Codigo</th>
                  <th>Cliente</th>
                  <th>Preço</th>
                  <th>Quantidade</th>
                  <th>Referencia</th>
                  <th>Data</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;

						$query=$ar::vendas($idvenda);
						 while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   echo '
                <tr>
                  <td>'.$i++.'</td>
                  <td>'.$dado->id.'</td>
                  <td>'.$dado->cliente.'</td>
                  <td>'.$dado->preco.'</td>
                  <td>'.$dado->qtd.'</td>
                  <td>'.$dado->venda.'</td>
                  <td>'.$ad::data($dado->data).'</td>
                </tr>';

 }   ?>
            </tbody>
            </table>
          </div>

              <h1>Compras</h1>/Entradas
<div class="table-responsive">

            <table class="table table-striped artigo_list">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Codigo</th>
                  <th>Fornecedor</th>
                  <th>Quantidade</th>
                  <th>Referencia</th>
                  <th>Data</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;

						$query=$ar::stock($idvenda);
						 while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   echo '
                <tr>
                  <td>'.$i++.'</td>
                  <td>'.$dado->id.'</td>
                  <td>'.$dado->idFornecedor.'</td>
                  <td>'.$dado->qtd.'</td>
                  <td>'.$dado->cod_compra.'</td>
                  <td>'.$ad::data($dado->data).'</td>
                </tr>';

 }   ?>
            </tbody>
            </table>
          </div>
</div></artigo>
