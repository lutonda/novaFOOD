<?php 

				include_once("../models/stock.php");
				$st=new stock();
        include_once('database.conf.php');
        $db=new database();	
        
if($_POST)
{
$d0=$_POST['search'];
	$data=null;
       	try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
					$query = $pdo->prepare("
                            SELECT
																s.id as id,
																s.codigo as codigo,
																s.nome as nome,
																s.preco as preco,
																s.estado as estado
														FROM
																servicos s
														where 
																(s.nome like '%".$d0."%' or
																s.codigo like '%".$d0."%')
																ORDER by estado
                            ");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
            
          if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                $resultado= "<tr>";
								  $resultado.= "
															<td>".$dado->codigo."</td>
															<td>Serviço - ".$dado->nome."</td>
															<td>-</td>
															<td>-</td>
															<td>".$dado->preco."</td>";
								 	$resultado.="<td class='btn-group' role='group' aria-label='...'  style='width:150px'>";
								 
								  if($dado->estado==0){
										  $resultado.= '<button class="btn btn-danger btn-xs invoice_view" value="venda_new?'.$dado->id.'"> Indisponivel</button>';
									}else{
									    $resultado.='<form method="post" action="javascript:;" id="form'.$dado->id.'"><div class="input-group col col-md-12"><select class="form-control" name="qtd">';
									    for($h=1;$h<100;$h++){
										      $resultado.='<option value="'.$h.'">'.$h.'</option>';
									    }
										  $resultado.='<input type="text" name="idVenda" value="'.$_COOKIE['idVenda'].'" hidden>';
										  $resultado.='<input type="text" name="idItem" value="'.$dado->id.'" hidden>';
										  $resultado.='<input type="text" name="preco" value="'.$dado->preco.'" hidden>';
										  $resultado.='<input type="text" name="tipo" value="2" hidden>';
										  $resultado.='</select><span class="btn btn-primary input-group-addon" id="'.$dado->id.'"><span class="fa fa-shopping-cart"> </span></span>
                      </div></form>';
								  }
								 	$resultado.="</td></tr>";
								  $data[]=$resultado;
               }
           }
					//-----------------------------------------
            $query = $pdo->prepare("
                            SELECT
																a.id as id,
																a.codigo as codigo,
																a.nome as nome,
																a.qtd_unidade as qtd_unidade,
																u.unidade as unidade,
																a.preco as preco,
																a.estado as estado
														FROM
																artigos a,
																unidade u
														where 
																a.unidade=u.id and
																(a.nome like '%".$d0."%' or
																a.codigo like '%".$d0."%')
																ORDER by estado
                            ");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
            
          if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                $resultado= "<tr>";
							
								 $resultado.= "
															<td>".$dado->codigo."</td>
															<td>Artigo - ".$dado->nome."</td>
															<td>".$st::resto($dado->id)."</td>
															<td>".$dado->qtd_unidade."/".$dado->unidade."</td>
															<td>".$dado->preco."</td>";
								 	$resultado.="<td class='btn-group' role='group' aria-label='...'  style='width:150px'>";
								  if($st::resto($dado->id)>0 and $dado->estado==1){
										  $resultado.='<form method="post" action="javascript:;" id="form'.$dado->id.'">
											<div class="input-group col col-md-12"><select class="form-control" name="qtd">';
									    for($h=1;$h<$st::resto($dado->id)+1;$h++){
										      $resultado.='<option value="'.$h.'">'.$h.'</option>';
									    }
										  $resultado.='<input type="text" name="idVenda" value="'.$_COOKIE['idVenda'].'" hidden>';
										  $resultado.='<input type="text" name="idItem" value="'.$dado->id.'" hidden>';
										  $resultado.='<input type="text" name="preco" value="'.$dado->preco.'" hidden>';
										  $resultado.='<input type="text" name="tipo" value="1" hidden>';
										  $resultado.='</select><span class="btn btn-primary input-group-addon" id="'.$dado->id.'"><span class="fa fa-shopping-cart"> </span></span>
                      </div></form>';
									}
								  if($dado->estado!=1 or $st::resto($dado->id)<1){
										  $resultado.= '<button class="btn btn-danger btn-xs invoice_view" value="venda_new?'.$dado->id.'"> Indisponivel</button>';
									}
										 
								 	$resultado.="</td></tr>";
								 $data[]=$resultado;
               }
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }

		for($i=0;$i<sizeof($data);$i++){
			echo $data[$i];	
		}
}
?>