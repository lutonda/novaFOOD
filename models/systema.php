<?php


header('Content-type:text/html');
header('Acess-Control-Allow-Origin:*');

include_once('database.conf.php');
class sisteam extends database{
    
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
  public function listar($d0="data",$d1="1=1"){
        $db=new database();	
        try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT
															v.id as venda,
															v.data as data,
															v.estado as estado,
															c.id as idCliente,
															c.nome as cliente,
															c.endereco as endereco,
															c.desconto as desconto,
															p.paises as pais
														FROM
															pais p,
															vendas v,
															clientes c
														WHERE
															c.pais=p.id and
															v.idCliente=c.id and ".$d1."
                            order by ?");
           $query->bindParam(1, $d1 );
           $query->bindParam(2, $d0 , PDO::PARAM_STR);
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
	
	public function listar_itemVenda($d0,$d1){
        $db=new database();	
        try{
            
			  
            $PDO = new database();
            $pdo = $PDO->getDB();
					if($d1==1){
						$busca="
                            SELECT
															a.codigo as codigo,
																a.nome as descricao,
																a.unidade as unidade,
																a.preco as preco,
																a.text_factura as texto,
																a.qtd_unidade as qtdUni,
																v.tipo as tipo,
																v.qtd as qtd,
																(v.qtd*a.preco) as total
														FROM
															itemVenda v,
																artigos a
														WHERE
															v.tipo=1 and
															v.idItem=a.id and
															v.idVenda=?
															";
					}else{
						$busca="	SELECT
															  s.codigo as codigo,
																s.nome as descricao,
																s.preco as preco,
																s.text_factura as texto,
																v.tipo as tipo,
																v.qtd as qtd,
																(v.qtd*s.preco) as total
														FROM
															itemVenda v,
																servicos s
														WHERE
															v.tipo=2 and
															v.idItem=s.id and
															v.idVenda=?";
					}
            $query = $pdo->prepare($busca);
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
  public function totalItem($d0="data"){
        $db=new database();	
        //$us=new usuario();
        try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT sum(a.preco) as preco
														FROM
															itemVenda i,
															artigos a
														WHERE 
															i.iditem=a.id and a.id=?");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
              return $dado->preco;
           }
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
  public function valor_venda($d0){
        $db=new database();	
        //$us=new usuario();
        try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM vendas
                            where idVenda = ?");
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
                            SELECT sum(quantidade) as stock FROM stock
                            where idItem = ?");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
               
            while($dado = $query->fetch(PDO::FETCH_OBJ)){
              return $dado->stock;
            }
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
	public function venda_estado($d0){
        $db=new database();	
        try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM venda_estado
                            where id= ?");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
               
            while($dado = $query->fetch(PDO::FETCH_OBJ)){
              return $dado->estado;
            }
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
}
