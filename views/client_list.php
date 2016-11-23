<?php
include_once("../models/clientes.php");
$cl=new cliente();
?>

<cliente>
          <div class="row page-header">
              
              <div  class="col-sm-3 col-md-3">
              <h1>Clientes</h1>
              </div>
          </div>
					<div  class="col-sm-3 col-md-12">
          <div  class="btn-group navbar-right">
                  <form method="post" action="javascript:;">
                  										<div class="input-group col col-md-12 serch_box ">
																			<span class="input-group-addon btn btn-primary" style="padding:0 !important;">
																				<span type="button" class="btn btn-primary novo" value="client_new" style="width:100%">
                         								<span class="fa fa-plus-square"></span> </span></span>
																				<span class="input-group-addon btn btn-primary print" title="Imprimir">
																				<span class="fa fa-file-pdf-o"></span> /
																				<span class="fa fa-print"></span></span>
																				<input type="email" class="form-control btn search cliente" id="searchid" name="nome" placeholder="E-mail" aria-describedby="basic-addon1" style="display:none !important">
																			<span class="input-group-addon btn btn-primary mail" id="basic-addon1"><span class="fa fa-envelope-o"></span></span><span class="input-group-addon btn btn-primary link" value="vendas_list">Voltar</span>
																</div>
																</form>
              </div>
				<br><br>
      </div>
          <div class="col-sm-3 col-md-12">
<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Num</th>
                  <th>Contribuinte</th>
                  <th>Nome</th>
                  <th>Tipo</th>
                  <th>Saldo</th>
                  <th>Estado</th>
                  <th>Data</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
								
$query=$cl::listar();
 while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   echo '
                <tr>
                  <td>'.$i++.'</td>
                  <td>'.$dado->id.'</td>
                  <td>'.$dado->contribuinte.'</td>
                  <td>'.$dado->nome.'</td>
                  <td>'.$dado->tipo.'</td>
                  <td>'.$dado->saldo.'</td>
                  <td><span class="label es-'.$cl::estado($dado->estado).'">'.$cl::estado($dado->estado).'</span></td>
                  <td>'.$dado->data.'</td>
                  <td><div class="btn-group" role="group" aria-label="...">
                      <button type="submit" class="btn btn-default btn-ls invoice_view" value="client_view?'.$dado->id.'">
                         <span class="fa fa-edit"></span></button>
                        </div></td>
                </tr>';
     
 }   ?>
            </tbody>
            </table>
          </div>
</div>
</cliente>