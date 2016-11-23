<?php


header('Content-type:text/html');
header('Acess-Control-Allow-Origin:*');

include_once('database.conf.php');
class cliente extends database{
    
    public function cadastrar($query){		
        $db=new database();
        //$query=$us->toString($query);
        	try{
				extract($query);
       
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT INTO
                        clientes
                    VALUES (
                        :d0,:d1,:d2,:d3,:d4,:d5,:d6,:d7,:d8,:d9,:d10,:d11,:d12,:d13,:d14,:d15)
                        ");
                    $query->bindValue(':d0', $d0);
                    $query->bindValue(':d1', $d1);
                    $query->bindValue(':d2', $d2);
                    $query->bindValue(':d3', $d3);
                    $query->bindValue(':d4', $d4);
                    $query->bindValue(':d5', $d5);
                    $query->bindValue(':d6', $d6);
                    $query->bindValue(':d7', $d7);
                    $query->bindValue(':d8', $d8);
                    $query->bindValue(':d9', $d9);
                    $query->bindValue(':d10', $d10);
                    $query->bindValue(':d11', $d11);
                    $query->bindValue(':d12', $d12);
                    $query->bindValue(':d13', $d13);
                    $query->bindValue(':d14', $d14);
                    $query->bindValue(':d15', $d15);
                    $res=$query->execute();
             if($res){
			   $res=1;
                 echo 0;

                }
            else{
                $res=0;
                echo 2;
                }
        }
        catch(PDOException $e){
            $res=$e->getMessage();
        }
        return $res;
	   }
	public function cadastrar_def($d0){		
        $db=new database();	
        $us=new usuario();
       try{ 
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT INTO conf_agente (idAgente) VALUES (:d0)");
                    $query->bindValue(':d0', $d0);
                    $res=$query->execute();
                    
            if($res){
                $res=1;
                }
            else{
                $res=0;
                }
        }
        catch(PDOException $e){
            $res=$e->getMessage();
        }
        return $res;
	   }
    
    public function up_cadastrar($query){		
        $db=new database();	
        $us=new usuario();
        //$query=$us->toString($query);
        extract($query);
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    UPDATE
                        agente
                    SET 
                        primeiro_nome = ?,
                        segundo_nome = ?,
                        e_mail = ?,
                        telefone = ?,
                        palavra_passe = ?,
                        tipo = ?,
                        username = ?,
                        cidade = ?
                    WHERE
                        id=?
                        ");
                    $query->bindValue(1, $d1);
                    $query->bindValue(2, $d2);
                    $query->bindValue(3, $d3);
                    $query->bindValue(4, $d4);
                    $query->bindValue(5, $d5);
                    $query->bindValue(6, $d6);
                    $query->bindValue(7, $d7);
                    $query->bindValue(8, $d8);
                    $query->bindValue(9, $d0);
                    $res=$query->execute();
                    
            if($res){
                $res=1;
                }
    }
    public function verificar($query){
        $db=new database();	
        $us=new usuario();
        //$query=$us->toString($query);
        extract($query);
        
       	try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM utilizador
                            WHERE 
                            email like ? AND
                        	senha like ?
                            ");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $query->bindParam(2, $d1 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   break;
                   }
               return $dado->id;
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    
    }
    public function listar($d0=""){
        $db=new database();	
        //$us=new usuario();
        try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT 
															c.id as id,
															c.contribuinte as contribuinte,
															c.nome as nome,
															c.telefone_1 as telefone_1,
															c.telefone_2 as telefone_2,
															c.fax as fax,
															c.email as email,
															c.endereco as endereco,
															c.pais as pais,
															t.tipo as tipo,
															c.desconto as desconto,
															c.saldo as saldo,
															c.prazo_pagamento as prazo_pagamento,
															c.tipo_pagamento as tipo_pagamento,
															c.estado as estado,
															c.data as data
														FROM 
															clientes c,
															cliente_tipo t
														WHERE
															c.tipo=t.id
															".$d0."
                            order by nome");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
              return $query;
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
		public function autocoplete($d0){
			    $data=null;
       	  try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
					  $query = $pdo->prepare("
                            SELECT
																*
														FROM
																clientes
														where
																id = ? or
																nome like '%".$d0."%' or
																contribuinte = ? or
																telefone_1 = ? or
																email like '%".$d0."%'
                            ");
            $query->bindParam(1, $d0 , PDO::PARAM_STR);
            $query->bindParam(2, $d0 , PDO::PARAM_STR);
            $query->bindParam(3, $d0 , PDO::PARAM_STR);
            $executa = $query->execute();
					  if($executa){
								 while($dado = $query->fetch(PDO::FETCH_OBJ)){
									$data[]= '<div class="show" value="'.$dado->id.'">'.$dado->nome.' - '.$dado->id.'</div>';
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
	  public function categoria($d0=""){
        $db=new database();	
        //$us=new usuario();
        try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT 
																*
														FROM
																cliente_categoria
														".$d0."
                            order by categoria");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
              return $query;
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
	  public function tipo($d0=""){
        $db=new database();	
        //$us=new usuario();
        try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT 
																*
														FROM
																cliente_tipo
														".$d0."
                            order by tipo");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
              return $query;
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
		public function estado($d0){
			return array("Desativo","Ativo")[$d0];
		}
	}

