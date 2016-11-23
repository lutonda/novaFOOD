<?php
include_once("../models/system.php");
include_once("../models/adon.php");
$sy=new system();
$ad=new adon();
$si=$sy::verSistema();
?>
<empresa></empresa>
          <div class="row page-header">
              
              <div  class="col-sm-3 col-md-12">
              <h1>Sistema</h1>
              </div>
              
          </div>

          <div class="col-md-12">
                <!-- Checkout-Form -->
                <form action="javascript:;" class="new" value="up_sistema" method="post">
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
                    <header>Area reservada para o Fornecedor do Sistema</header>
                    
						<fieldset class="panel panel-default">
                        
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-key"></span> LICENÇA</span>
                          <input type="text" class="form-control" name="nome" placeholder="Nome da Empresa" aria-describedby="basic-addon1" value="9OLD-987Y-K334-QAS1-2WSD" disabled>
                        </div>
												<div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span> URL Server</span>
                          <input type="text" class="form-control" name="url" placeholder="Endereço do Servidor" aria-describedby="basic-addon1" value="<?=$si->url?>" disabled>
                        </div>
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-themeisle"></span> Titulo</span>
                          <input type="text" class="form-control" name="titulo" placeholder="Titulo" aria-describedby="basic-addon1" value="<?=$si->titulo?>" disabled>
                        </div>
                             
                        </fieldset>
                    
                        <fieldset class="panel panel-default">
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-money"></span> Imposto de Venda</span>
                          <input type="text" class="form-control" name="iV" placeholder="Imposto de venda" aria-describedby="basic-addon1" value="<?=$si->iV?>" disabled>
                        </div>
													<div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-money"></span> Imposto de Consumo</span>
                          <input type="text" class="form-control" name="iC" placeholder="Imposto de consumo" aria-describedby="basic-addon1"  value="<?=$si->iC?>" disabled>
													</div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar-check-o"></span> Taxa de Reembolso</span>
                          <input type="text" class="form-control" name="tR" placeholder="Taxa de reembolso" aria-describedby="basic-addon1" value="<?=$si->tR?>" disabled>
                        </div>
													<div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar-check-o"></span> Taxa de Atrazo</span>
                          <input type="text" class="form-control" name="tA" placeholder="Taxa de Atrazo" aria-describedby="basic-addon1" value="<?=$si->tA?>" disabled>
                        </div>
													 <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-fax"></span> MOEDA</span>
                          <input type="text" class="form-control" name="moeda" placeholder="Moeda" aria-describedby="basic-addon1" value="<?=$si->moeda?>" disabled>
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-usd"></span> Contra valor (USD)</span>
                          <input type="text" class="form-control" name="cambioUSD" placeholder="Contravalor" aria-describedby="basic-addon1"  value="<?=$si->cambioUSD?>" disabled>
                        </div>
													
													<div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-envelope"></span></span>
                          <input type="text" class="form-control" name="website" placeholder="pront command" aria-describedby="basic-addon1" value="" disabled>
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