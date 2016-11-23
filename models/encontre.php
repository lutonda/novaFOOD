<?php

				include_once("../models/stock.php");
				include_once("../models/vendas.php");
				include_once("../models/system.php");
				include_once('database.conf.php');
				include_once("../models/adon.php");
				$vn=new vendas();
				$ad=new adon();
				$sy=new system();
				$si=$sy::verSistema();
        $st=new stock();
        $db=new database();
				$vn=new vendas();

if($_POST)
{
$d0=$_POST['search'];
	$data=null;

		$d2="";
		if($_COOKIE['tipo_usr']==2){$d2=" u.id=".$_COOKIE['user']." and ";}
       	try{
          $resultado="";
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT
															v.id as venda,
															v.data as data,
															v.estado as estado,
															v.total as total,
															v.idCliente as cliente,
															u.nome as tutor
														FROM
															vendas v,
															utilizador u
														WHERE
															u.id=v.tutor and ".$d2."
															(v.id='".$d0."' or v.idCliente like '%".$d0."%')
                            order by v.id DESC");
           $query->bindParam(1, $d0 );
           $i=1;
           $executa = $query->execute();
           if($executa){
              while($dado = $query->fetch(PDO::FETCH_OBJ)){

								  $total=$vn::totalItem($dado->venda)/100+($vn::totalItem($dado->venda)*$si->iV/100);
                   $resultado.= '<table style="width:100%; max-width:800px; box-shadow: 0 0 1px #ddd; margin:2px" border="1" class="table">
											<tr>
												<td width="20">'.$i++.'</td>
												<td width="40">'.$dado->venda.'</td>
												<td width="200">'.$dado->cliente.'</td>
												<td width="100" class="text-right">'.$total.'</td>
												<td width="120"><span class="label es-'.$vn::venda_estado($dado->estado).'">'.$vn::venda_estado($dado->estado).'</span></td>
												<td>'.$ad::data($dado->data).'</td>
												<td class="btn-group pull-right" role="group" aria-label="..." width="100">';
												if($dado->estado==1){
													$resultado.= '<button class="btn btn-default btn invoice_view" value="venda_new?'.$dado->venda.'"><span class="fa fa-edit "></span></button>';
												}
													$resultado.= '<button class="btn btn-default btn invoice_view" value="invoice?'.$dado->venda.'"><span class="fa fa-file-text-o "></span></button></td>
											</tr></table>';
														}
								  $data[]=$resultado;
               }
           }

       catch(PDOException $e){
          echo $e->getMessage();
       }

		for($i=0;$i<sizeof($data);$i++){
			echo $data[$i];
			if($data[$i]==""){echo "Nem um registo encontrado";}
		}
}
?>
