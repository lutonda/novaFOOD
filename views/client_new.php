<?php
include_once("../models/clientes.php");
include_once("../models/adon.php");
$cl=new cliente();
$ad=new adon();
$query=$cl::listar();
?>


          <div class="row page-header">
              
              <div  class="col-sm-3 col-md-12">
              <h1>Cadastrar Cliente</h1>
              </div>
              
          </div>

          <div class="col-md-12">
                <!-- Checkout-Form -->
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
                    <header>Checkout form</header>
                    
						<fieldset class="panel panel-default">
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
                          <input type="text" class="form-control" placeholder="Nº Contribuite" name="contribuinte" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group col col-md-2">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-caret-square-o-up"></span></span>
                            <select class="form-control" name="estado" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Estado</option>
                                        <option value="1">Ativo</option>
                                        <option value="2">Desativo</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-2">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-users"></span></span>
                            <select class="form-control" name="tipo" placeholder="Nº Contribuite" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Tipo</option>
                                        <?php
																				$query=$cl::tipo();
                                        while($dado = $query->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$dado->id.'">'.$dado->tipo.'</option>';
                                           }
                                        ?>
                            </select>
                        </div>
                        <br>
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input type="text" class="form-control" name="nome" placeholder="Nome" aria-describedby="basic-addon1">
                        </div>
                             <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-map-markeR"></span></span>
                          <input type="text" class="form-control" name="endereco" placeholder="Endereço" aria-describedby="basic-addon1">
                        </div>
                             <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <select class="form-control" name="pais" aria-describedby="basic-addon1">
                                        <option value="-1" selected="" disabled="">Pais</option>
                                        <?php
                                        $p=$ad::pais("");
                                        while($dado = $p->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$dado->id.'">'.$dado->paises.'</option>';
                                           }
                                        ?>
                                    </select>
                        </div>
                        </fieldset>
                    
                        <fieldset class="panel panel-default">
                        
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-phone"></span></span>
                          <input type="text" class="form-control" name="telefone_1" placeholder="Telefone principal" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-phone"></span></span>
                          <input type="text" class="form-control" name="telefone_2" placeholder="Telefone (opcional)" aria-describedby="basic-addon1">
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-envelope"></span></span>
                          <input type="text" class="form-control" name="email" placeholder="E-mail" aria-describedby="basic-addon1">
                        </div>
                               <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-fax"></span></span>
                          <input type="text" class="form-control" name="fax" placeholder="Fax" aria-describedby="basic-addon1">
                        </div>
                            
						</fieldset>
                        
                    
                        <fieldset class="panel panel-default">
                        
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-bar-chart"></span></span>
                          <select class="form-control" name="tipo_pagamento" placeholder="Nº Contribuite" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Tipo de pagamento</option>
                                        <option value="1">Pre-pago</option>
                                        <option value="2">Pos-Pago</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                          <input type="text" class="form-control" name="prazo_pagamento" placeholder="Prazo de Pagamento" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">Dias</span>
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-archive"></span></span>
                          <input type="text" class="form-control" name="saldo" placeholder="Saldo Inical" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">,00 Kzs</span>
                        </div>
                               <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-money"></span></span>
                          <input type="text" class="form-control" name="desconto" placeholder="Desconto" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">%</span>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-bank">
                              </span></span>
                          <input type="text" class="form-control" name="num_conta" placeholder="Numero de Conta" aria-describedby="basic-addon1">
													
                          </div>
													<div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-bank">
                              </span></span>
                            <select name="tipo_conta" class="form-control" id="basic-addon1" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Banco</option>
                                        <option value="1">BFA</option>
                                        <option value="2">BIC</option>
                            </select>
                        </div>
                            
						</fieldset>
                    
                    <fieldset class="panel panel-default">
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <textarea class="form-control" name="detalhes" placeholder="Telefone principal" aria-describedby="basic-addon1">
                            </textarea>
                        </div>
						</fieldset>
            
                    <footer>
                        <div  class="col-sm-3 col-md-12">
                 <div class="btn-group navbar-right" role="group" aria-label="...">
                      <button type="submit" class="btn btn-primary">
                         <span class="fa fa-save"></span></button>
                      <button type="reset" class="btn btn-default">
                         <span class="fa fa-refresh"></span></button>
                      <button type="button" class="btn btn-default link" value="client_list">
                         <span class="fa fa-ban"></span></button>
                        </div></div>
                    </footer>
                </form>
                
            </div>
          

