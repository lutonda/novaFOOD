<?php
include_once('database.conf.php');
class def_agente extends database{
    
    public function cadastrar($query){		
        $db=new database();	
        $us=new usuario();
        //$query=$us->toString($query);
        extract($query);
       
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT INTO
                        agente
                    VALUES (
                        :d0,:d1,:d2,:d3,:d4,:d5,:d6,:d7,:d8,:d9)
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
                    $res=$query->execute();
                    
           try{  if($res){
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
	public function definicoes($user){
        $db=new database();	
        $us=new usuario();
        
        $PDO = new database();
        $pdo = $PDO->getDB();
        $query = $pdo->prepare("
                            SELECT *
							FROM conf_agente
                            WHERE 
                            idAgente = :d0
                            ");
        $query->bindParam(':d0', $user);
        $executa = $query->execute();
        if($executa){
              while($dado = $query->fetch(PDO::FETCH_OBJ)){
                $query=array(
                    'df_tema'=>$dado->tema,
                    'df_cor'=>$dado->cor,
                    'df_fundo'=>$dado->fundo,
                    'df_idioma'=>$dado->idioma,
                    'df_perfil'=>$dado->perfil,
                    'df_publicacoes'=>$dado->publicacoes,
                    'df_larga_cx'=>$dado->larga_cx,
                    'df_paga_amigo'=>$dado->paga_amigo);
                   return $query;
                   }
           }
       }
	public function idioma($d0){
        $db=new database();	
        $us=new usuario();
        
        $PDO = new database();
        $pdo = $PDO->getDB();
        $query = $pdo->prepare("
                            SELECT *
							FROM
							idioma
                            WHERE 
                            id_id = :d0
                            ");
        $query->bindParam(':d0', $d0);
        $executa = $query->execute();
        if($executa){
              while($dado = $query->fetch(PDO::FETCH_OBJ)){
                	return $dado;
              		$query=array(
						'_id'=>$dado->id,
						'_idioma'=>$dado->idioma
						
					)     ;
			  }
           }
       }
    public function update($query){		
        $db=new database();	
        extract($query);
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    UPDATE
                        conf_agente
                    SET 
                         ".$d2."= ?
                    WHERE
                        idAgente = ?
                        ");
                    $query->bindValue(1, $d1);
                    $query->bindValue(2, $d3);
                    $res=$query->execute();
                    
            if($res){
                $res=1;
                }
            else{
                $res=0;
                }
        
        return $res;
	   }
    
}
/*$data=new data;
$data->query('ola');*/