<?php


header('Content-type:text/html');
header('Acess-Control-Allow-Origin:*');

include_once('database.conf.php');
class usuario extends database{
    
    public function cadastrar($query){		
        $db=new database();	
        $us=new usuario();
        //$query=$us->toString($query);
        	try{
				extract($query);
       
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT INTO
                        utilizador
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
                    $res=$query->execute();
             if($res and $us::cadastrar_def($us::ver_agente($d7))){
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
                            e_mail like ? AND
                        	palavra_passe like ?
                            ");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $query->bindParam(2, $d1 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                   $query=array(
                        'username'=>$dado->username,
                        'id'=>$dado->id
                    );
                   return $query;
                   }
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    
    }
}
