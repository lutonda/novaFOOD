<?php

header('Content-type:text/html');
header('Acess-Control-Allow-Origin:*');

include_once('database.conf.php');
class stock extends database{
    
    public function cadastrar($query){		
        $db=new database();	
        	try{
				extract($query);
       
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT INTO
                        stock
                    VALUES (
                        :d0,:d1,:d2,:d3,:d4,:d5)
                        ");
                    $query->bindValue(':d0', $d0);
                    $query->bindValue(':d1', $d1);
                    $query->bindValue(':d2', $d2);
                    $query->bindValue(':d3', $d3);
                    $query->bindValue(':d4', $d4);
                    $query->bindValue(':d5', $d5);
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
    public function resto($d0){
        $db=new database();
			$actual=0;
			$comprado=0;
            $PDO = new database();
            $pdo = $PDO->getDB();
            
						$query = $pdo->prepare("SELECT sum(qtd) qtd FROM stock WHERE idItem=?
                            ");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
               		$actual= $dado->qtd;
							 }
           }
			$query = $pdo->prepare("SELECT sum(qtd) as qtd FROM itemVenda WHERE	iditem=? and tipo=1
                            ");
           $query->bindParam(1, $d0 );
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
               		$comprado= $dado->qtd;
							 }
           }
			return ($actual-$comprado);
    
    }
    public function listar($d0="data"){
        $db=new database();	
        //$us=new usuario();
        try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM stock
                            order by ?");
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
    public function soma_stock($d0){
        $db=new database();	
        //$us=new usuario();
        //return $d0;
        try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT sum(qtd) as stock FROM stock
                            where idItem = ?");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
               
            while($dado = $query->fetch(PDO::FETCH_OBJ)){
							if($dado->stock==null){return 0;}
              return $dado->stock;
            }
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
}
