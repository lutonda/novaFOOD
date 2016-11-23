<?php
include_once('database.conf.php');
class views extends database{
    
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
            else{
                $res=0;
                }
        
        return $res;
	   }
    
    public function idioma(){
        $db=new database();	
        
       	try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM idioma
                            ");
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                  
					   echo '
										<div>
										<img src="imagens/tema/lang/'.$dado->_abr.'.gif">
										<input type="radio" name="lang" value="'.$dado->id_id.'" checked>
										<div>'.$dado->_idioma.'</div>
									</div><br>
					   ';
                    }
               
           }
           else{
               echo 'e';
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    
    }
	  public function tema(){
        $db=new database();	
        $i=0;
       	try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM tema 
                            ");
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                  
					   echo '<button value="'.$dado->id.'" style="font-size:12px; width:25px; padding:0">'.$dado->id.'</button>';
                    }
               
           }
           else{
               echo 'e';
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    
    }
     public function ver_agente($q){
        $db=new database();	
        $us=new usuario();
       	try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM agente
                            WHERE 
                            id != ?");
           $query->bindParam(1, $q , PDO::PARAM_STR);
           $executa = $query->execute();
            
          if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                   return $dado->id;
                   //return $dado->usuario_Id;
                   }
           }
           else{
               echo 'Erro ao inserir os dados';
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    
    }
     public function dados($user){
       $db=new database();	
        $us=new usuario();
        //$query=$us->toString($query);
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM agente
                            WHERE 
                            id = :d0 OR
                            username like :d1
                            ");
           $query->bindParam(':d0', $user);
           $query->bindParam(':d1', $user);
           
           $executa = $query->execute();
            
          if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                  // return $dado;
                $query=array(
                    $dado->id,
                    $dado->primeiro_nome,
                    $dado->segundo_nome,
                    $dado->e_mail,
                    $dado->telefone,
                    $dado->palavra_passe,
                    $dado->tipo,
                    $dado->username,
                    $dado->cidade,
                    $dado->data_cadastro);
                   return $query;
                    
                   //return $dado->usuario_Id;
                   }
           }
       
    
    }
	
   public function update($tipo,$s,$d){				
	    $conexao=new database;
		$executar="UPDATE $tipo set $s where $d";
		mysql_query($executar,$conexao->connect()); 
		return $executar;
   }
   function toString($vetor){
		$novo=null;
		for($i=0;$i<sizeof($vetor)-1;$i++){
		  $novo.="'".$vetor[$i]."',";
		}
		$novo.="'".$vetor[sizeof($vetor)-1]."'";
		var_dump($novo);
		return $novo;
   }
   
}
/*$data=new data;
$data->query('ola');*/