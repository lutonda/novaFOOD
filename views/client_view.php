<?php
include_once("../models/clientes.php");
include_once("../models/adon.php");
$cl=new cliente();
$ad=new adon();
$query=$cl::listar("AND c.id=".$idvenda);
$i=1;
								
 while($dado = $query->fetch(PDO::FETCH_OBJ)){
	 $x=$dado;
 }

?>

<cliente class="editForm">
          <div class="row page-header">
              
              <div  class="col-sm-3 col-md-12">
              <h1>Cliente #<?=$x->id?></h1>
              </div>
              
          </div>

          <div class="col-md-12">
                <!-- Checkout-Form -->
						<button  class="btn btn-danger" title="Cliente desde"><span class="fa fa-calendar"></span> <?=$ad::data($x->data)?></button>
						<button  class="btn btn-default spend" title="Total gasto"><span class="fa fa-money"></span> </button>
                <form action="javascript:;" class="new" value="new_cliente" method="post">
									
                     <div  class="col-sm-3 col-md-12">
											 
                 <div class="btn-group navbar-right" role="group" aria-label="...">
									 
                      <button type="submit" class="btn btn-primary">
                         <span class="fa fa-save"></span></button>
                      <button type="reset" class="btn btn-default">
                         <span class="fa fa-refresh"></span></button>
                      <button type="button" class="btn btn-default link" value="client_list">
                         <span class="fa fa-ban"></span></button>
                        </div></div>
                    
						<fieldset class="panel panel-default">
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
                          <input type="text" class="form-control" value="<?=$x->contribuinte?>" placeholder="Nº Contribuite" name="contribuinte" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group col col-md-2">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-caret-square-o-up"></span></span>
                            <select class="form-control" name="estado" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Estado</option>
                                        <option <?=($x->estado==1)?"selected=":""?> value="1">Ativo</option>
                                        <option <?=($x->estado==2)?"selected=":""?> value="2">Desativo</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-2">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-users"></span></span>
                         
													<select class="form-control" name="tipo" placeholder="Nº Contribuite" aria-describedby="basic-addon1">
															
                                        <option value="0" disabled="" selected=""><?=$x->tipo?></option>
                                        <?php
																				$query=$cl::tipo();
                                        while($dado = $query->fetch(PDO::FETCH_OBJ)){
                                           echo '<option '.(($x->tipo==$dado->tipo)?'selected=""':'').' value="'.$dado->id.'">'.$dado->tipo.'</option>';
                                           }
                                        ?>
                            </select>
                        </div>
                        <br>
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input type="text" class="form-control" name="nome" placeholder="Nome" aria-describedby="basic-addon1" value="<?=$x->nome?>">
                        </div>
                             <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-map-markeR"></span></span>
                          <input type="text" class="form-control" name="endereco" placeholder="Endereço" aria-describedby="basic-addon1" value="<?=$x->endereco?>">
                        </div>
                             <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <select class="form-control" name="pais" aria-describedby="basic-addon1">
                                        <option value="-1" selected="" disabled="">Pais</option>
                                        <?php
                                        $p=$ad::pais("");
                                        while($dado = $p->fetch(PDO::FETCH_OBJ)){
                                           echo '<option '.(($x->pais==$dado->id)?'selected=""':'').' value="'.$dado->id.'">'.$dado->paises.'</option>';
                                           }
                                        ?>
                                    </select>
                        </div>
                        </fieldset>
                    
                        <fieldset class="panel panel-default">
                        
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-phone"></span></span>
                          <input type="text" class="form-control" value="<?=$x->telefone_1?>" name="telefone_1" placeholder="Telefone principal" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-phone"></span></span>
                          <input type="telephone" class="form-control"  value="<?=$x->telefone_2?>"   name="telefone_2" placeholder="Telefone (opcional)" aria-describedby="basic-addon1">
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-envelope"></span></span>
                          <input type="text" class="form-control" value="<?=$x->email?>"  name="email" placeholder="E-mail" aria-describedby="basic-addon1">
                        </div>
                               <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-fax"></span></span>
                          <input type="text" class="form-control" name="fax" value="<?=$x->fax?>"  placeholder="Fax" aria-describedby="basic-addon1">
                        </div>
                            
						</fieldset>
                        
                    
                        <fieldset class="panel panel-default">
                        
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-bar-chart"></span></span>
                          <select class="form-control" name="tipo_pagamento" hidden="" placeholder="Nº Contribuite" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Tipo de pagamento</option>
                                        <option value="1">Pre-pago</option>
                                        <option value="2">Pos-Pago</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                          <input type="number" value="<?=$x->prazo_pagamento?>"  class="form-control" name="prazo_pagamento" placeholder="Prazo de Pagamento" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">Dias</span>
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-archive"></span></span>
                          <input type="text" class="form-control"  value="<?=$x->saldo?>"  name="saldo" placeholder="Saldo Inical" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">,00 Kzs</span>
                        </div>
                               <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-money"></span></span>
                          <input type="text" class="form-control"  value="<?=$x->desconto?>"  name="desconto" placeholder="Desconto" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">%</span>
                        </div>
                        <div class="input-group col col-md-4" style="display:none">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-bank">
                              </span></span>
                          <input type="text" class="form-control"  value="<?=$x->prazo_pagamento?>"  name="num_conta" placeholder="Numero de Conta" aria-describedby="basic-addon1">
													
                          </div>
													<div class="input-group col col-md-4"  style="display:none">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-bank">
                              </span></span>
                            <select name="tipo_conta" class="form-control" id="basic-addon1" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Banco</option>
                                        <option value="1">BFA</option>
                                        <option value="2">BIC</option>
                            </select>
                        </div>
                            
						</fieldset>
                    
                    <fieldset class="panel panel-default"  style="display:none">
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <textarea class="form-control" name="detalhes" placeholder="Telefone principal" aria-describedby="basic-addon1">
                            </textarea>
                        </div>
						</fieldset>
            
                    
                </form>
                
            </div>
          

<?php
include_once("../models/vendas.php");
include_once("../models/system.php");
include_once("../models/adon.php");
$vn=new vendas();
$ad=new adon();
$sy=new system();
$si=$sy::verSistema();
$query=$vn::listar($idvenda,"c.id=".$idvenda);
?>

<venda_list>
          <div class="row page-header">
              <div  class="col-sm-3 col-md-3">
              <h1>Vendas</h1>
							</div>
              </div>

          
          <div class="row">
						<div class="col-sm-3 col-md-12">
						
						<div class="col-sm-3 col-md-12"><br>
<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Codigo</th>
                  <th class="text-right">Valor</th>
                  <th>Estado</th>
                  <th colspan="2">Data</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
								$y=0;
 								while($dado = $query->fetch(PDO::FETCH_OBJ)){
								$total=$vn::totalItem($dado->venda)-$vn::totalItem($dado->venda)*($dado->desconto+$dado->desconto2)/100+($vn::totalItem($dado->venda)*$si->iV/100);
                   echo '
                <tr>
                  <td>'.$i++.'</td>
                  <td>'.$dado->venda.'</td>
                  <td class="text-right">'.$total.' ,00</td>
                  <td><span class="label es-'.$vn::venda_estado($dado->estado).'">'.$vn::venda_estado($dado->estado).'</span></td>
                  <td>'.$ad::data($dado->data).'</td>
                  <td class="btn-group pull-right" role="group" aria-label="...">';
									if($dado->estado==1){
										echo '<button class="btn btn-default btn invoice_view" value="venda_new?'.$dado->venda.'"><span class="fa fa-edit "></span></button>';
									}
									  echo '<button class="btn btn-default invoice_view" value="invoice?'.$dado->venda.'"><span class="fa fa-file-text-o "></span></button></td>
                </tr>';
     						$y+=$total;	
								}   ?>
            </tbody>
            </table>
          </div>
								</div>
						</div>
						<script>
						
							$('.spend').append(' <?=$y?>,00 <?=$si->moeda?>')
						</script>
					</div>
</venda_list>