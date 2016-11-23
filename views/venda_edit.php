<?php
include_once("../models/clientes.php");
include_once("../models/stock.php");
$st=new stock();
$cl=new cliente();
include_once("../models/vendas.php");
include_once("../models/adon.php");
include_once("../models/system.php");
$sy=new system();
$vn=new vendas();
$ad=new adon();
$em=$sy::verEmpresa();
 
$query=$vn::listar($idvenda,"v.id=".$idvenda);
 while($dado = $query->fetch(PDO::FETCH_OBJ)){
                  
                  
                  $idCliente=$dado->idCliente;
	 								$nomeCliente=$dado->cliente;
									$totalVenda=$vn::totalItem($dado->venda);
	 								$estado=$vn::venda_estado($dado->estado);
									$data=$dado->data;
								  $endereco=$dado->endereco;
									$pais=$dado->pais;
									$desconto=$dado->desconto;
	 								break;
									}?>
?>
					<venda>
          <div class="row page-header">
              
              <div  class="col-sm-3 col-md-12">
              <h1>Nova Venda</h1>
              </div>
              
          </div>
<div class="row">
          <div class="col-md-12">
                <!-- Checkout-Form -->
                <form action="javascript:;" class="new" value="new_artigo" method="post">
                <div  class="col-sm-3 col-md-12">
                  <div class="btn-group navbar-right" role="group" aria-label="...">
                      <button type="submit" class="btn label-default">
                         <span class="fa fa-save"></span> Salvar</button>
                      <button type="reset" class="btn btn-default">
                         <span class="fa fa-save"></span> Reiniciar</button>
											<button type="reset" class="btn btn-default">
														 <span class="fa fa-save"></span> Pre-visualizar</button>
											<button type="reset" class="btn btn-default">
														 <span class="fa fa-save"></span>Finalizar</button>
                      <button type="button" class="btn btn-default link" value="vendas_list">
                         <span class="fa fa-ban"></span> Canselar</button>
                  </div>
								</div> 
                    
						    <fieldset class="panel panel-default">
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
                          <input type="text" class="form-control" placeholder="Cliente" name="codigo" aria-describedby="basic-addon1">
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
                          <input type="text" class="form-control" name="nome" placeholder="Nome" aria-describedby="basic-addon1">
                        </div>
                             <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <select class="form-control" name="tipo" aria-describedby="basic-addon1">
                                        <option value="-1" selected="" disabled="">Country</option>
                                        <?php
                                        $p=$ad::pais("");
                                        while($dado = $p->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$dado->id.'">'.$dado->paises.'</option>';
                                           }
                                        ?>
                                        <option value="239">Zimbabwe</option>
                                    </select>
                        </div>
                            
                </fieldset>
                    
                <fieldset class="panel panel-default">
                        <div class="input-group col col-md-12">
															<button type="button" class="btn label-default add">
                         				<span class="fa fa-save"></span>Novo Item</button>
													<div class="panel panel-primary pop-up" >
														<div class="panel-heading">
															<h3 class="panel-title">
																<span class="fa fa-suitcase"></span>
																Novo Item</h3>
															<button type="button" class="btn label-default right add">
                         				<span class="fa fa-save"></span>Novo Item</button>
														</div>
														<div class="panel-body panel-collapse collapse in">
																	<form class="">
																		<div class="ui-widget">
																			
																			<div class="serch_box ">
																			<div class="input-group col col-md-8">
																			<span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
																				<input type="text" class="form-control search" id="searchid" placeholder="Codico ou Descrição" name="codigo" aria-describedby="basic-addon1">
																			
																		 </div>
																</div>
																</form>
															</div>
															
															<div class="col col-md-12">
																		<table class="table">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>Codigo</th>
																		<th>Descrição</th>
																		<th>Stock</th>
																		<th>Unidade</th>
																		<th>Preço</th>
																		<th>Desconto</th>
																		<th></th>
																	</tr>
																</thead>
																<tbody id="result">
																	<td></td>
																</tbody></table>
															</div>
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
																	
																		$total=0;
																	
																		$i=1;
																		$query=$vn::listar_itemVenda("1","2");
									 								while($dado = $query->fetch(PDO::FETCH_OBJ)){
																		 echo '
																			<tr>
																				<td>'.$i++.'</td>
																				<td>'.$dado->codigo.'</td>
																				<td>'.$dado->descricao.' | '.$ad::tipo($dado->tipo).' - '.$dado->texto.'</td>
																				<td class="text-right">'.$dado->qtd.'</td>
																				<td class="text-right">-</td>
																				<td class="text-right">'.$dado->preco.'</td>
																				<td class="text-right">0</td>
																				<td class="text-right">'.$dado->total.'</td>
																				<td><button class="btn btn-default btn-xs">Ver</button></td>
																			</tr>';
																		$total=$total+$dado->total;
									 								} 
																	$query=$vn::listar_itemVenda("1","1");
									 								while($dado = $query->fetch(PDO::FETCH_OBJ)){
																		 echo '
																			<tr>
																				<td>'.$i++.'</td>
																				<td>'.$dado->codigo.'</td>
																				<td>'.$dado->descricao.' | '.$ad::tipo($dado->tipo).' - '.$dado->texto.'</td>
																				<td class="text-right">'.$dado->qtd.'</td>
																				<td class="text-right">'.$dado->unidade.'</td>
																				<td class="text-right">'.$dado->preco.'</td>
																				<td class="text-right">0</td>
																				<td class="text-right">'.$dado->total.'</td>
																				<td><button class="btn btn-default btn-xs">Ver</button></td>
																			</tr>';
																		$total=$total+$dado->total;
									 								} 
																	?>
															</tbody>
															</table>
														</div>

														</cliente>
                        </div>
                        
                            
						</fieldset>
                <div  class="col-sm-3 col-md-4 navbar-right">
											
								<fieldset class="panel panel-default">
									       <table class="table table-striped">
										
																<tbody>
																	<tr>
																		<th>Valor Liquido</th>
																		<th class="text-right"><?=$total?></th>
																	</tr>
																	
																	<tr>
																		<th>Desconto</th>
																		<th class="text-right">0</th>
																	</tr>
																	
																	<tr>
																		<th>Valor Retenção</th>
																		<th class="text-right">0</th>
																	</tr>
																	<tr>
																		<th><h4>Valor Total</h4></th>
																		<th class="text-right"><h4><?=$total?></h4></th>
																	</tr>
																</tbody>
													</table>
											</fieldset>
              			</div>
            
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
          </venda>

