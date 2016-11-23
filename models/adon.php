<?php


header('Content-type:text/html');
header('Acess-Control-Allow-Origin:*');

/*include_once("../dones/MPDF57/mpdf.php");*/
include_once('database.conf.php');
class adon extends database{
	
    public function adon(){
        if(!isset($_COOKIE['_FAPR'])){
		$db=new database();	
       
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("SELECT * FROM util");
            $executa = $query->execute();
			
            if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   setcookie('FASU',$dado->FASU,0,'/');
				   setcookie('_FAPR',$dado->FAPR);
				   setcookie('_ARSU',$dado->ARSU);
				   setcookie('_ARPR',$dado->ARPR);
				   setcookie('_SRSU',$dado->SRSU);
				   setcookie('_SRPR',$dado->SRPR);
				   setcookie('_CLSU',$dado->CLSU);
				   setcookie('_CLPR',$dado->CLPR);
				   break;
                   }
           }
       
		}
    }
  public function pais($query=""){		
            $db=new database();	
            //$query=$us->toString($query);
        	try{
       
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("SELECT * FROM pais");
           //$query->bindParam(1, $query, PDO::PARAM_STR);
                $query->execute();
           return $query;
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    
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
  public function estado($d0){
	 	 $tipo=array("Canselado","Disponivel","Indisponivel");
    return $tipo[$d0];
    }
	public function tipo($d0){
			$tipo=array("Artigo","Serviço");
    return $tipo[$d0-1];
    }
	public function servico_tipo($d0){
			$tipo=array("Artigo","Serviço");
    return $tipo[$d0-1];
    }
	public function data($data){
			$data=explode(" ",$data);
			$data[0]=explode("-",$data[0]);
    return $data[1].' '.$data[0][2].'/'.$data[0][1].'/'.$data[0][0];
    }
	public function toPDF($html){

			/*$mpdf=new mPDF('c'); 

			$mpdf->SetDisplayMode('fullpage');

			$mpdf->WriteHTML("html");

			$mpdf->Output("m.pdf","I"); 
		//echo $html;
		exit;
	*/}
}
/**
var fans = [<?php
					for($i=1;$i<13;$i++){
                        echo '['.$i.', ['.$es::contar_venda(5).']';               
                        if($i!=12){echo ','}
                    }];
				 	
	echo $es::contar_venda(5);
				?>
        var followers = [[1, 54], [2, 40], [3, 10], [4, 25], [5, 42], [6, 14], [7, 36], [8, 86]];
*/