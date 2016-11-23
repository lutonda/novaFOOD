<?php


header('Content-type:text/html');
header('Acess-Control-Allow-Origin:*');

include_once('database.conf.php');
include_once('../dones/emailsender/index.php');
class usuario extends database{

    public function cadastrar($query){
        $db=new database();
			$us=new usuario();
        $tipo=2;
        $estado=1;
				extract($query);

			if($us::verif($username,$email)!=0){return 2;}
        	try{
       print_r($query);
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT INTO
                        utilizador
                    VALUES (
                        :d0,:d1,:d2,:d3,:d4,:d5,:d6,:d7)
                        ");
                    $query->bindValue(':d0', null);
                    $query->bindValue(':d1', $username);
                    $query->bindValue(':d2', $nome);
                    $query->bindValue(':d3', $email);
                    $query->bindValue(':d4', $password);
                    $query->bindValue(':d5', $tipo);
                    $query->bindValue(':d6', $estado);
                    $query->bindValue(':d7', date('Y-m-d h:i:s'));
                    $res=$query->execute();
             if($res){
			   					$res=1;//echo 'ok';
                }
            else{
                $res=0; //echo 'bad';
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
    public function listar($d0=""){
        $db=new database();
        $us=new usuario();
        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM utilizador
                            WHERE
                            1=1 order by estado DESC, tipo, nome");
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
    public function verificar($d0){
        $db=new database();
				extract($d0);
       	try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM utilizador
                            WHERE
                            email like ? OR
                            username like ? AND
                        		senha like ?
                            ");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $query->bindParam(2, $d0 , PDO::PARAM_STR);
           $query->bindParam(3, $d1 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
								 	 setcookie('tipo_usr',$dado->tipo,0,'/');
								 	 setcookie('id_usr',$dado->id,0,'/');
								 	 setcookie('nome_usr',$dado->nome,0,'/');
                   return 1;
                   }
           }
           return 0;
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
	public function forgot($d0){

        $db=new database();

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM utilizador
                            WHERE
                            email like ? OR
                            username like ?");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $query->bindParam(2, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
								 $msg="Caro(a) ".$dado->nome."!<br> Atraves do NOVA - ERP<br>, Em seguida vai a sua Password :<b>".$dado->senha."</b><br>";
                  if(1!=mailel($dado->email,"NOVA - Recuperação de Email",$msg,null)){return "Não foi possivel enviar a sua senha, Por favor contacte o Fornecedor do Sistema";}
								 	return "A sua senha foi enviado pelo seu E-mail ".$dado->email.", Acesse para confirmar!";
                   }
           }else{

					 }

    return "Não Esta registado um usuario com esses dados no nossos Sistema!";
    }
		public function verif($d0,$d1){
        $db=new database();
       	try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM utilizador
                            WHERE
                            username like ? OR
                        		email like ?
                            ");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $query->bindParam(2, $d1 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   return $dado->id;
                   }
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
    public function ver($d0=""){
        $db=new database();
        $us=new usuario();
        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM utilizador
                            WHERE
                            id=?");

           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
						 while($dado = $query->fetch(PDO::FETCH_OBJ)){

                   return $dado->nome."#".$dado->tipo."#".$dado->id;
                   }

           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
	  public function tipo($d0){
		 return array('Administrador','Colaborador','Operador')[$d0];
	 }
}
