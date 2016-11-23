<?php


header('Content-type:text/html');
header('Acess-Control-Allow-Origin:*');

include_once('database.conf.php');
include_once('stock.php');
class artigo extends database{

    public function cadastrar($query){
        $db=new database();
        //$query=$us->toString($query);
        	try{
				extract($query);

        if($d13==""){$d13=$_COOKIE['_ARPR'].''.$d1;}
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT INTO
                        artigos
                    VALUES (
                        :d0,:d1,:d2,:d3,:d4,:d5,:d6,:d7,:d8,:d9,:d10,:d11,:d12)
                        ");
                    $query->bindValue(':d0', $d0);
                    $query->bindValue(':d1', $d13);
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
    public function nextId(){
        $db=new database();
			$id=1;
        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT id FROM artigos order by id ASC
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
    public function listar($d0="data"){
        $db=new database();
        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT
															a.id as id,
															a.codigo as codigo,
															a.nome as nome,
															t.tipo as tipo,
															c.categoria as categoria,
															u.unidade as unidade,
															a.qtd_unidade as qtd_unidade,
															a.preco as preco,
															a.obs as obs,
															a.text_factura as text_factura,
															a.stock_notificacao as stock_notificacao,
															a.estado as estado,
															a.data as data
														FROM
														    artigos a,
														    artigo_tipo t,
														    unidade u,
														    categoria as c
														where
                                t.id=a.tipo and
														    u.id=a.unidade and
															  a.categoria=c.id
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

    public function stock($d0="data"){
        $db=new database();
        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT
															*
														FROM stock
														WHERE idItem=? order by id DESC");
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
    public function vendas($d0="data"){
        $db=new database();
        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT
															i.id as id,
																c.nome as cliente,
																i.preco as preco,
																i.qtd as qtd,
																i.idVenda as venda,
																i.tipo as tipo,
																v.data as data
														FROM
															itemVenda i,
															clientes c,
															vendas v
														WHERE
															i.idVenda=v.id and
															c.id=v.idCliente and
															i.idItem=? and
															i.tipo=1 order by id DESC");
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
    public function selecionar($d0=1){
        $db=new database();
        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT
															a.id as id,
															a.codigo as codigo,
															a.nome as nome,
															t.tipo as tipo,
															c.categoria as categoria,
															u.unidade as unidade,
															a.qtd_unidade as qtd_unidade,
															a.preco as preco,
															a.obs as obs,
															a.text_factura as text_factura,
															a.stock_notificacao as stock_notificacao,
															a.estado as estado,
															a.data as data
														FROM
														    artigos a,
														    artigo_tipo t,
														    unidade u,
														    categoria as c
														where
                                t.id=a.tipo and
														    u.id=a.unidade and
															  a.categoria=c.id and
																a.id = ?");
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
		public function select($d0){
       $db=new database();
			$st=new stock();
        try{

           $PDO = new database();
           $pdo = $PDO->getDB();
           $query = $pdo->prepare("SELECT
					 												a.id as id,
																	u.unidade as unidade,
																	a.nome as nome,
																	a.qtd_unidade as qtd_unidade
																	FROM artigos a,
																	unidade u
																	where u.id=a.unidade and a.id=?");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
           if($executa){
						 	while($dado = $query->fetch(PDO::FETCH_OBJ)){
              		 $dado=$dado->nome."||".$st::resto($dado->id)."||".$dado->unidade;
									return $dado;
							}
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
    return 0;
    }
	  public function artigocl($d0){
        $db=new database();

        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("SELECT * FROM ".$d0);
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
}
