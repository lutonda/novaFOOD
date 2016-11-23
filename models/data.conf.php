<?php
include('database.conf.php');
class data{
    public function query($query){
        $db=new database();
        $db->conectar();
        
        return $query;
    }
    public function insert($target,$query){		
        $db=new database();	
        $query=$this->toString($query);
        $db->getDB();
		$executar="INSERT INTO $target VALUES($query)";
		//mysql_query($executar,$db->getDB()); 
     /////
     $PDO = new database();
     $pdo = $PDO->getDB();
     extract($query);
     var_dump($query);
     $query = $pdo->prepare("INSERT INTO $target VALUES (
            :d0,:d1,:d2,:d3,:d4,:d5,:d6,:d7)");
            $query->bindValue(':d0', $d0);
            $query->bindValue(':d1', $d1);
            $query->bindValue(':d2', $d2);
            $query->bindValue(':d3', $d3);
            $query->bindValue(':d4', $d4);
            $query->bindValue(':d5', $d5);
            $query->bindValue(':d6', $d6);
            $query->bindValue(':d7', $d7);
            // att  last id critico analisar
     $PDO->execute($query);
		return $executar;
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
		return $novo;
   }
   
}
$data=new data;
$data->query('ola');