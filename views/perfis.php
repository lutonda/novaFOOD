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
              <h1>Personalizar</h1>
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
                      <button type="button" class="btn btn-default link toggle" style="display:none"  value="perfis">
                         <span class="fa fa-ban"></span></button>
                        </div></div>
									<header><h3>Facturas</h3></header>
										<fieldset class="panel panel-default">
                        <div class="input-group col col-md-3">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-users"></span> Numeração</span>
                            <select class="form-control" name="tipo" placeholder="Tipo" aria-describedby="basic-addon1" disabled>
                              <option value="0">Randômico</option>
                              <option value="1" selected="">Continuo</option>
                              <option value="2">Personalizado</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Prefixo</span>
                          <input type="text" class="form-control" name="pr_factura" placeholder="3 caracteres" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Sufixo</span>
                          <input type="text" class="form-control" name="su_factura" placeholder="3 caracteres" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
                        </div>
											
											</fieldset>
									
									<header><h3>Cliente</h3></header>
										<fieldset class="panel panel-default">
                        <div class="input-group col col-md-3">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-users"></span> Numeração</span>
                            <select class="form-control" name="tipo" placeholder="Tipo" aria-describedby="basic-addon1" disabled>
                              <option value="0">Randômico</option>
                              <option value="1" selected="">Continuo</option>
                              <option value="2">Personalizado</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Prefixo</span>
                          <input type="text" class="form-control" name="pr_factura" placeholder="3 caracteres" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Sufixo</span>
                          <input type="text" class="form-control" name="su_factura" placeholder="3 caracteres" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
                        </div>
											</fieldset>
									
									
                    <header><h3>Arigos</h3></header>
										<fieldset class="panel panel-default">
                        <div class="input-group col col-md-3">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-users"></span> Numeração</span>
                            <select class="form-control" name="tipo" placeholder="Tipo" aria-describedby="basic-addon1" disabled>
                              <option value="0">Randômico</option>
                              <option value="1" selected="">Continuo</option>
                              <option value="2">Personalizado</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Prefixo</span>
                          <input type="text" class="form-control" name="pr_factura" placeholder="3 caracteres" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Sufixo</span>
                          <input type="text" class="form-control" name="su_factura" placeholder="3 caracteres" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
                        </div>
											</fieldset>
									
									<header><h3>Serviço</h3></header>
										<fieldset class="panel panel-default">
                        <div class="input-group col col-md-3">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-users"></span> Numeração</span>
                            <select class="form-control" name="tipo" placeholder="Tipo" aria-describedby="basic-addon1" disabled>
                              <option value="0">Randômico</option>
                              <option value="1" selected="">Continuo</option>
                              <option value="2">Personalizado</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Prefixo</span>
                          <input type="text" class="form-control" name="pr_factura" placeholder="3 caracteres" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Sufixo</span>
                          <input type="text" class="form-control" name="su_factura" placeholder="3 caracteres" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
                        </div>
											</fieldset>
									
									<header><h3>Outros</h3></header>
										<fieldset class="panel panel-default">
                        <div class="input-group col col-md-3">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-users"></span> Numeração</span>
                            <select class="form-control" name="tipo" placeholder="Tipo" aria-describedby="basic-addon1" disabled>
                              <option value="0">Randômico</option>
                              <option value="1" selected="">Continuo</option>
                              <option value="2">Personalizado</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Prefixo</span>
                          <input type="text" class="form-control" name="pr_factura" placeholder="3 caracteres" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span> Sufixo</span>
                          <input type="text" class="form-control" name="su_factura" placeholder="3 caracteres" aria-describedby="basic-addon1" value="<?=$em->nome?>" disabled>
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