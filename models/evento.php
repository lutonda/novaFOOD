<?php
include_once('database.conf.php');
class evento extends database{

    public function adicionar($query){
        $db=new database();
        $us=new usuario();
        extract($query);
       	try{
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                          INSERT INTO log
                          VALUES
                          (:d0,:d1,:d2,:d3,:d4,:d5)");
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

     public function sugestao($query){
           $db=new database();
           $lg=new ligacao();
           extract($query);
    	     try{

               $PDO = new database();
               $pdo = $PDO->getDB();
               $query = $pdo->prepare("
                   					SELECT
                   						*
                   					FROM
                   						agente
                   					WHERE id!= ?");
              $query->bindParam(1, $d0);
              $executa = $query->execute();

              if($executa){
                  while($dado = $query->fetch(PDO::FETCH_OBJ)){
                      echo '';
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
}
