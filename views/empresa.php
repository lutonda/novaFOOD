<?php
include_once("../models/system.php");
include_once("../models/adon.php");
$sy=new system();
$ad=new adon();
$em=$sy::verEmpresa("id");
?>
<empresa></empresa>
          <div class="row page-header">
              
              <div  class="col-sm-3 col-md-12">
              <h1>Dados da Empresa</h1>
              </div>
              
          </div>

          <div class="col-md-12">
                <!-- Checkout-Form -->
                <form action="javascript:;" class="new" value="up_empresa" method="post">
                    <div  class="col-sm-3 col-md-12">
									 		<div class="btn-group navbar-right  toggle" role="group" aria-label="...">
												<button type="button" class="btn btn-primary toggle">
												<span class="fa fa-edit"></span></button></div>
                 <div class="btn-group navbar-right  toggle" style="display:none" role="group" aria-label="...">
                      <button type="submit" class="btn btn-primary" >
                         <span class="fa fa-save"></span></button>
                      <button type="button" class="btn btn-default link toggle" style="display:none"  value="empresa">
                         <span class="fa fa-ban"></span></button>
                        </div></div>
                    <header>Checkout form</header>
                    
						<fieldset class="panel panel-default">
                        
                        <div class="input-group col col-md-2" style="display:none">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-caret-square-o-up"></span></span>
                            <select class="form-control" name="estado" aria-describedby="basic-addon1">
                                        <option value="0" selected="" disabled="">Estado</option>
                                        <option value="1">Ativo</option>
                                        <option value="2">Desativo</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-users"></span></span>
                            <select class="form-control" name="tipo" placeholder="Tipo" aria-describedby="basic-addon1" disabled>
                                        <option value="0" disabled="">Tipo</option>
                                        <option value="1" selected="" >Particular</option>
                                        <option value="2">Empresa</option>
                            </select>
                        </div>
                        <br>
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input type="text" class="form-control" name="nome" placeholder="Nome da Empresa" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
                        </div>
												<div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input type="text" class="form-control" name="nome_a" placeholder="Outro Nome(opcional)" aria-describedby="basic-addon1" value="<?=$em->nome_a?>" disabled>
                        </div>
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input type="text" class="form-control" name="slogam" placeholder="Nome da Fantasia" aria-describedby="basic-addon1" value="<?=$em->slogam?>" disabled>
                        </div>
                             
                        </fieldset>
                    
                        <fieldset class="panel panel-default">
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-map-markeR"></span></span>
                          <input type="text" class="form-control" name="endereco" placeholder="Endereço" aria-describedby="basic-addon1" value="<?=$em->endereco?>" disabled>
                        </div>
													<div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-map-markeR"></span></span>
                          <input type="text" class="form-control" name="cidade" placeholder="Cidade" aria-describedby="basic-addon1"  value="<?=$em->cidade?>" disabled>
                        </div>
                             <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <select class="form-control" name="pais" aria-describedby="basic-addon1" disabled>
                                        <option value="-1" disabled="">Pais</option>
														
                                        <option value="6" selected="">Angola</option>
                                        <?php
                                        $p=$ad::pais("");
                                        while($dado = $p->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$dado->id.'">'.$dado->paises.'</option>';
                                           }
                                        ?>
                                        <option value="239">Zimbabwe</option>
                                    </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-phone"></span></span>
                          <input type="text" class="form-control" name="telefone_a" placeholder="Telefone principal" aria-describedby="basic-addon1" value="<?=$em->telefone_a?>" disabled>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-phone"></span></span>
                          <input type="text" class="form-control" name="telefone_b" placeholder="Telefone (opcional)" aria-describedby="basic-addon1" value="<?=$em->telefone_b?>" disabled>
                        </div>
													 <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-fax"></span></span>
                          <input type="text" class="form-control" name="fax" placeholder="Fax" aria-describedby="basic-addon1" value="<?=$em->fax?>" disabled>
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-envelope"></span></span>
                          <input type="text" class="form-control" name="email_a" placeholder="E-mail principal" aria-describedby="basic-addon1"  value="<?=$em->email_a?>" disabled>
                        </div>
													<div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-envelope"></span></span>
                          <input type="text" class="form-control" name="email_b" placeholder="E-mail (opcional)" aria-describedby="basic-addon1" value="<?=$em->email_b?>" disabled>
                        </div>
													<div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-envelope"></span></span>
                          <input type="text" class="form-control" name="website" placeholder="pagina Web" aria-describedby="basic-addon1" value="<?=$em->website?>" disabled>
                        </div>
                              
                            
						</fieldset>
                        
                    
                        <fieldset class="panel panel-default">
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
                          <input type="text" class="form-control" placeholder="Nº Contribuite" name="numContribuinte" aria-describedby="basic-addon1" value="<?=$em->numContribuinte?>" disabled>
                        </div>
													<div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
                          <input type="text" class="form-control" placeholder="Matricula" name="matricula" aria-describedby="basic-addon1" value="<?=$em->matricula?>" disabled>
                        </div>
													<div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
                          <input type="text" class="form-control" placeholder="Capital Social" name="capital_social" aria-describedby="basic-addon1" value="<?=$em->capital_social?>" disabled>
                        </div>
                            
						</fieldset>
                    <fieldset class="panel panel-default">
                        <div class="input-group col col-md-6">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
													<span class="input-group-addon" id="basic-addon1">Conta 1</span>
                          <input type="text" class="form-control" placeholder="Número" name="numbanco_1" aria-describedby="basic-addon1" value="<?=$em->numbanco_1?>" disabled>
                        </div>
													<div class="input-group col col-md-2">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-caret-square-o-up"></span></span>
                            <select class="form-control" name="banco_1" aria-describedby="basic-addon1" disabled>
                                        <option value="0" disabled="">BANCO</option>
                                        <option value="1" selected="">BFA</option>
                                        <option value="2">BIC</option>
                                        <option value="2">BAI</option>
                            </select>
                        </div>
											<div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
													<span class="input-group-addon" id="basic-addon1">IBAN</span>
                          <input type="text" class="form-control" placeholder="Número" name="ibanbanco_1" aria-describedby="basic-addon1" value="<?=$em->ibanbanco_1?>" disabled>
                        </div>
						</fieldset>
									 <fieldset class="panel panel-default">
                        <div class="input-group col col-md-6">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
													<span class="input-group-addon" id="basic-addon1">Conta 2</span>
                          <input type="text" class="form-control" placeholder="Número" name="numbanco_2" aria-describedby="basic-addon1" value="<?=$em->numbanco_2?>" disabled>
                        </div>
													<div class="input-group col col-md-2">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-caret-square-o-up"></span></span>
                            <select class="form-control" name="banco_2" aria-describedby="basic-addon1" disabled>
                                         <option value="0" disabled="">BANCO</option>
                                        <option value="1" selected="">BFA</option>
                                        <option value="2">BIC</option>
                                        <option value="2">BAI</option>
                            </select>
                        </div>
										 <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-balance-scale"></span></span>
													<span class="input-group-addon" id="basic-addon1">IBAN</span>
                          <input type="text" class="form-control" placeholder="Número" name="ibanbanco_2" aria-describedby="basic-addon1" value="<?=$em->ibanbanco_2?>" disabled>
                        </div>
						</fieldset>
                    <fieldset class="panel panel-default">
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <textarea class="form-control" name="detalhes" placeholder="Telefone principal" aria-describedby="basic-addon1" disabled><?=$em->detalhes?>
                            </textarea>
                        </div>
						</fieldset>
									
									
            
                    <footer>
                        <div  class="col-sm-3 col-md-12">
									 		<div class="btn-group navbar-right  toggle" role="group" aria-label="...">
												<button type="button" class="btn btn-primary toggle">
												<span class="fa fa-edit"></span></button></div>
                 <div class="btn-group navbar-right  toggle" style="display:none" role="group" aria-label="...">
                      <button type="submit" class="btn btn-primary" >
                         <span class="fa fa-save"></span></button>
                      <button type="button" class="btn btn-default link toggle" style="display:none"  value="empresa">
                         <span class="fa fa-ban"></span></button>
                        </div></div>
                    </footer>
                </form>
                
            </div>
          
</empresa>

<script>
	//$('input').click(alert(0))
</script>