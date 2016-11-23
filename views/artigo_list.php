<?php
include_once("../models/artigos.php");
include_once("../models/stock.php");
include_once('adon.php');
$ar=new artigo();
$st=new stock();
$ad=new adon();
$query=$ar::listar("nome");
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
															<button type="button" class="btn btn-default link ban" value="artigos_list">
																 <span class="fa fa-ban"></span> Canselar</button>
																</div></div>			</form>	
															</div>
														</div>
													</div>

          <div class="row page-header">
              
              <div  class="col-sm-3 col-md-3">
              <h1>Artigos</h1>
              </div>
          </div>
				<div  class="col-sm-3 col-md-12">
          <div  class="col-sm-3 col-md-12">
                  <div class="btn-group navbar-right" role="group" aria-label="...">
										<div class="btn-group navbar-right" role="group" aria-label="...">
																<form method="post" action="javascript:;">
                  										<div class="input-group col col-md-12 serch_box ">
																			<span class="input-group-addon btn btn-primary" style="padding:0 !important;">
																				<span type="button" class="btn btn-primary add" att="addstock" value="'.$dado->codigo.'" style="width:100%">
                         								<span class="fa fa-plus-square"></span> </span></span>
																				<span class="input-group-addon btn btn-primary print" title="Imprimir">
																				<span class="fa fa-file-pdf-o"></span> /
																				<span class="fa fa-print"></span></span>
																				<input type="email" class="form-control btn search cliente" id="searchid" name="nome" placeholder="E-mail" aria-describedby="basic-addon1" style="display:none !important">
																			<span class="input-group-addon btn btn-primary mail" id="basic-addon1"><span class="fa fa-envelope-o"></span></span><span class="input-group-addon btn btn-primary link" value="vendas_list">Voltar</span>
																</div>
																</form>
                      
            				</div>
              </div>
				<br><br>
      </div>
        <div class="col-sm-3 col-md-12">
<div class="table-responsive">
	
            <table class="table table-striped artigo_list">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Codigo</th>
                  <th>Nome</th>
                  <th>preço</th>
                  <th>Unidade</th>
                  <th>Stock</th>
                  <th>Estado</th>
                  <th>Data</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
 while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   echo '
                <tr>
                  <td>'.$i++.'</td>
                  <td>'.$dado->codigo.' asasasas '.$dado->id.'</td>
                  <td>'.$dado->nome.'</td>
                  <td>'.$dado->preco.'</td>
                  <td>'.$dado->qtd_unidade.'/'.$dado->unidade.'</td>
                  <td>'.$st::resto($dado->id).'</td>
                  <td>'; 
	 								if($st::resto($dado->id)<1){
									echo '<span class="label es-'.$ad::estado(2).'">'.$ad::estado(2).'</span>';
									}else{
									echo '<span class="label es-'.$ad::estado($dado->estado).'">'.$ad::estado($dado->estado).'</span>';
									}
									echo '</td>
                  <td>'.$ad::data($dado->data).'</td>
                  <td>
									<div class="btn-group" role="group" aria-label="...">
                      <button type="submit" class="btn btn-default invoice_view" value="venda_new?'.$dado->venda.'"><span class="fa fa-edit "></span></span></button>
											<button type="submit" class="btn btn-default btn-ls add" att="addstock" value="'.$dado->id.'2">
                         <span class="fa fa-plus"></span></button>
                        </div></td>
                </tr>';
     
 }   ?>
            </tbody>
            </table>
          </div>
</div></artigo>