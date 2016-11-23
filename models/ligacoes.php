<?php
include_once('database.conf.php');
class ligacoes extends database{
    
    public function nova($query){		
        $db=new database();	
        $us=new usuario();
        //$query=$us->toString($query);
        extract($query);
       	try{
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("INSERT INTO ligacao (agente_a, agente_b) VALUES (:d0,:d1)");
                    $query->bindValue(':d0', $d0);
                    $query->bindValue(':d1', $d1);
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
    
    public function sugestao($d0){
        $db=new database();	
        $us=new usuario();
        //$query=$us->toString($query);
        //extract($query);
        
       	try{
            
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM
                                agente a 
                            WHERE 
                                a.id!= ?
                            Limite 5
                            ");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           /*$query->bindParam(2, $d1 , PDO::PARAM_STR);*/
           $executa = $query->execute();
            
          if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                   if($dado->primeiro_nome==""):$nome=$dado->username ? $nome=$dado->primeiro_nome;
                   echo '<div class="sug_ligacao">
                        <user><img src="imagens/users/1.jpg" class="usr user L">
                        <div><a href="./'.$dado->username.'"><nome>'.$nome.'</nome></a><br><data>22 Ligações em comum</data></div>
                        </user>
	                    <button class="btn sbmt mini">+ Ligação</button>
                        </div>';
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
     public function dados($id){
        $db=new database();	
        $us=new usuario();
        //$query=$us->toString($query);
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM agente
                            WHERE 
                            id = ?
                            ");
           $query->bindParam(1, $id);
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
    public function ligado($agente_a,$agente_b){
        $db=new database();	
        $us=new usuario();
        //$query=$us->toString($query);
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM ligacao
                            WHERE 
                            agente_a = ? AND
                            agente_b = ? OR
                            agente_a = ? AND
                            agente_b = ?
                            
                            ");
           $query->bindParam(1, $agente_a);
           $query->bindParam(2, $agente_b);
           $query->bindParam(3, $agente_b);
           $query->bindParam(4, $agente_a);
           $executa = $query->execute();
            
          if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
               return true;    
               }
              return false;
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