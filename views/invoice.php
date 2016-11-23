<?php

include_once("../models/vendas.php");
include_once("../models/adon.php");
include_once("../models/system.php");
$sy=new system();
$vn=new vendas();
$ad=new adon();
$em=$sy::verEmpresa();
$si=$sy::verSistema();
$total=0;
$query=$vn::listar($idvenda,"v.id=".$idvenda);
 while($dado = $query->fetch(PDO::FETCH_OBJ)){

	 								$nomeCliente=$dado->cliente;
									$totalVenda=$vn::totalItem($dado->venda);
	 								$estado=$vn::venda_estado($dado->estado);
									$data=$dado->data;
	 								$tutor=$dado->tutor;
									$desconto=0;
	 								break;
									}
?>
<invoice>
<div class="container-fluid" style="width:700px; box-shadow:0 0 5px #999">
                 <div class="col-md-12">
                        <div class="pull-right">
												<form method="post" action="javascript:;">
                  										<div class="input-group col col-md-12 serch_box ">
																			<span class="input-group-addon btn btn-primary print" title="Imprimir">
																				<span class="fa fa-file-pdf-o"></span> /
																				<span class="fa fa-print"></span></span>
																				<input type="email" class="form-control btn search cliente" id="searchid" name="nome" placeholder="E-mail" aria-describedby="basic-addon1" style="display:none !important">
																			<span class="input-group-addon btn btn-primary mail" id="basic-addon1"><span class="fa fa-envelope-o"></span></span>
																			<?php if($estado=='Aberto'){ ?><span class="btn btn-danger proforma" value="<?=$idvenda?>">
																			<span class="fa fa-star"></span> PROFORMA</span><?php }?>
																			<span class="input-group-addon btn btn-primary link" value="vendas_list">Voltar</span>


																</div>
																</form>

													<?php if($estado=='0'){ ?>
                            <button class="btn btn-default print" title="Imprimir" hidden=""><span class="fa fa-print"></span></button>

                            <button class="btn btn-danger reembolso" title="Reembolso"><span class="fa fa-reply-all"></span></button> <?php }?>

                        </div>
                    </div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-transparent">
            <div class="panel-body">
			<div class="col col-md-12"><img src="imgs/logo/nova.png" class="mt-md mb-md" style="height:60px" title="<?=$em->nome?>"></div>
			<div class="col col-md-12" style="margin:-15px 0 !important">
							<address class="mt-md mb-md">
							Endereço: <?=$em->endereco?> |
							<?=$em->cidade?> - <?=$em->paises?><br>
							Telefone: <?=$em->telefone_a?>,
							E-mail: <?=$em->email_b?> |
							NIF: <?=$em->numContribuinte	?><br>
							</address>
				</div>
			</div>

          <div class="row mb-xl"  style="border-top:solid 4px #006;">
                <div class="col-md-12" style="border-top:solid 1px #06c; margin:0">
          					<div class="col-md-12" style="font-size:16px">Cliente :  <strong><?=$nomeCliente?></strong><br></div><br>
                    <div class="col-md-12" style="border:solid 1px #006; padding:5px;">
                        <strong>FACTURA Nº:</strong> #<?=$idvenda?><br><strong>Data:</strong> <?=$ad::data($data)?>
                        <?php /* <li hidden=""><strong>Taxa de Atrazo:</strong> <?=$si->tA?> %</li> */?>
          					</div>
                </div>
              </div>
                <div class="row mb-xl">
                    <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover m-n">
                                        <thead>
                                            <tr>
                                                <th style="max-width:100px !important"><center>DECRIÇÃO</center></th>
                                                <th class="text-right">QTD</th>
                                                <th class="text-right">PREÇO UNIT</th>
                                                <th class="text-right">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
																					<?php


																								$i=1;
																								$query=$vn::listar_itemVenda($idvenda,"2");
																								while($dado = $query->fetch(PDO::FETCH_OBJ)){
																									$total+=$dado->preco*$dado->qtd;
																									 echo '
																										<tr>
																											<td>'.$dado->descricao.' | '.$dado->texto.'</td>
																											<td  class="text-right">'.$dado->qtd.'</td>
																											<td  class="text-right">'.$dado->preco.'</td>
																											<td  class="text-right">'.$dado->qtd*$dado->preco.'</td>
																										</tr>';
																								}
																								$query=$vn::listar_itemVenda($idvenda,"1");
																								while($dado = $query->fetch(PDO::FETCH_OBJ)){
																									$total+=$dado->preco*$dado->qtd;
																									 echo '
																										<tr>
																											<td>'.$dado->codigo.'</td>
																											<td>'.$dado->descricao.' | - '.$dado->texto.', '.$dado->unidade.'</td>
																											<td  class="text-right">'.$dado->qtd.'</td>
																											<td  class="text-right">'.$dado->preco.'</td>
																											<td  class="text-right">'.$dado->total.'</td>
																										</tr>';
																								}
																					?>
                                        </tbody>
                                    </table>

                        </div>
                    </div>
									<div class="col-sm-3 col-md-12" style="border:solid 1px #000; font-size:14px">
									       <b>TOTAL: <?=$total?>,00 KZs</b>
                    </div>
										<div class="row">
                      <div class="col-md-12">
                      <center>PROCESSADO PELO COMPUTADOR <b>POR: <?= ucwords($tutor)?><br>
                        <b>Obrigado Volte Sempre</b></center>
                        <?php
                            if(!file_exists('../imgs/qr/tmp/QR_'.$idvenda.'.png')){$vn::qr($idvenda,'http://oreall/nova/pex/invoice/'.$idvenda.'.png');}
                            echo '<img src="imgs/qr/tmp/QR_'.$idvenda.'.png" width="60px;" style="float:right; margin-top:-43px">';
                        ?>
                      </div>
									  </div>
                  </div>
                </div>
              </div>
            </div>
            </div> <!-- .container-fluid -->


	</invoice>
