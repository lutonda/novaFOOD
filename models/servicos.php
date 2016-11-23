<?php


header('Content-type:text/html');
header('Acess-Control-Allow-Origin:*');

include_once('database.conf.php');
include_once('stock.php');
class servico extends database{
    
    public function cadastrar($query){		
        $db=new database();	
		$sr=new servico();
        	try{
				extract($query);
       print_r($query);
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT INTO
                        servicos
                    VALUES (
                        :d0,:d1,:d2,:d3,:d4,:d5,:d6,:d7,:d8,:d9)
                        ");
                    $query->bindValue(':d0', $d0);
                    $query->bindValue(':d1', $_COOKIE['_SRPR'].''.$sr::nextId());
                    $query->bindValue(':d2', $d2);
                    $query->bindValue(':d3', $d3);
                    $query->bindValue(':d4', $d4);
                    $query->bindValue(':d5', $d5);
                    $query->bindValue(':d6', $d6);
                    $query->bindValue(':d7', $d7);
                    $query->bindValue(':d8', $d8);
                    $query->bindValue(':d9', $d9);
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
    public function venda_actual(){


        $PDO = new database();
        $pdo = $PDO->getDB();
        $query = $pdo->prepare("SELECT max(id) as id FROM vendas where tutor=".$_COOKIE['id_usr']." order by data DESC");
        $executa = $query->execute();
        if ($executa) {
            while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                return $dado->id;//,36000,'/');

                return true;
            }
        }
        return (isset($_COOKIE['vend_actual']))?$_COOKIE['vend_actual']:0;}
    public function listar_painel($d0=""){
        //setcookie('vend_actual', 2, time()*36, "/");
        $venda_actual = $this->venda_actual();
        $db=new database();
        //$us=new usuario();
        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT 
								s.id as id,
								s.codigo as codigo,
								s.nome as nome,
								t.tipo as tipo,
								c.categoria as categoria,
								s.preco as preco,
								s.obs as obs,
								s.text_factura as text_factura,
								s.estado as estado
							  FROM
								servicos s,
								servico_tipo t,
								servico_categoria c
							  WHERE
								t.id = s.tipo AND
								c.id = s.categoria and ?
                            order by s.nome");
            $query->bindParam(1, $d0 );
            $executa = $query->execute();
            $i=1;
            if($executa){
                $executa='';
                while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                    if ($dado->estado==1) {
                        $executa .='
                    <div class="btn-group col-md-12" role="group" aria-label="Default button group">
                        <button type="button" class="btn btn-default col-md-1">'.$i++.'</button>
                        <button type="button" class="btn btn-default col-md-8" style="text-align: left">'.$dado->nome.'</button>
                        <button type="button" class="btn btn-default col-md-2 " style="text-align: right">'.money_format('%!n', $dado->preco).'</button>
                        <button type="button" class="btn btn-primary col-md-1 add" pr="'.$dado->id.'">  +</button>
                    </div>';
                    }
                    else{
                        $executa .='
                    <div class="btn-group col-md-12" role="group" aria-label="Default button group">
                        <button type="button" class="btn btn-default col-md-1">'.$i++.'</button>
                        <button type="button" class="btn btn-default col-md-8" style="text-align: left">'.$dado->nome.'</button>
                        <button type="button" class="btn btn-default col-md-2 " style="text-align: right">'.money_format('%!n', $dado->preco).'</button>
                        <button type="button" class="btn btn-default col-md-1 " >x</button>
                    </div>';
                    }

                }
                return $executa;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
        return 0;
    }
    public function listar($d0=""){
        $db=new database();
        //$us=new usuario();
        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT 
																s.id as id,
																s.codigo as codigo,
																s.nome as nome,
																t.tipo as tipo,
																c.categoria as categoria,
																s.preco as preco,
																s.obs as obs,
																s.text_factura as text_factura,
																s.estado as estado,
																s.data as data
														FROM
																servicos s,
																servico_tipo t,
																servico_categoria c
														WHERE
																t.id = s.tipo AND
																c.id = s.categoria
                            ".$d0);
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
																servico_categoria
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
																servico_tipo
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
	public function nextId(){
        $db=new database();	
			$id=1;
        try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT id FROM servicos order by id ASC
                            ");
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
								 $id=$dado->id;
							 }
               return $id+1;
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
}
