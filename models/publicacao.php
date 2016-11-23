<?php
include_once('database.conf.php');
include_once('../controler/_adon_data.php');
include_once('../controler/_privacidade.php');
include_once('../controler/_data_format.php');
class publicacao extends database{
    public function nova($query){
        $db=new database();
		    $pub_depois=(!isset($pub_depois))?0:$pub_depois;
        extract($query);
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT INTO
                        publicacao
                    VALUES (:d0,:d1,:d2,:d3,:d4,:d5)");
                    $query->bindValue(':d0', null);
                    $query->bindValue(':d1', $legenda);
                    $query->bindValue(':d2', $permicao);
                    $query->bindValue(':d3', $pub_depois);
                    $query->bindValue(':d4', $agente);
                    $query->bindValue(':d5', null);
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
	  public function novo_comentario($query){
      $db=new database();
		  $agente=$_COOKIE['id'];
        extract($query);
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT INTO
                        comentario
                    VALUES (:d0,:d1,:d2,:d3,:d4)");
                    $query->bindValue(':d0', null);
                    $query->bindValue(':d1', $legenda);
                    $query->bindValue(':d2', $pub);
                    $query->bindValue(':d3', $agente);
                    $query->bindValue(':d4', null);
                    $res=$query->execute();

           try{
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
    public function actualizar($query){
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

            if($res){$res=1;}
            else{$res=0;}
              return $res;
	  }

    public function mostrar_sigle($d0){
     $db=new database();
     $pb=new publicacao;
     $dt=new data;
     $pr=new privacidade();
         $di=new dados();
         //if()
         try{
             $PDO = new database();
             $pdo = $PDO->getDB();
             $query = $pdo->prepare("SELECT
                     a.id as idag,
                     a.username as username,
                     a.primeiro_nome as primeiro_nome,
                     a.segundo_nome as segundo_nome,
                     p.data as data,
                     p.legenda as legenda,
                     p.id as idpub,
                     p.permicao as perm
                   FROM
                     publicacao p,
                     agente a
                   WHERE
                     p.idagente=a.id
                     ".$d0."
                     order by p.data desc
                     ");

             $executa = $query->execute();
             if($executa){
                while($dado = $query->fetch(PDO::FETCH_OBJ)){

                   $x=$pr::validar($dado->idag,$_COOKIE['id']).','.$dado->perm;;


                  if($pr::validar($dado->idag,$_COOKIE['id'])<=$dado->perm){//}

            echo '<div class="side side_a">
                  <ul><li class="li"><div class="publicacao p'.$dado->idpub.'" numero='.$dado->idpub.'>
                  <div class="user">
                  <div><img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="usr user L"></div>
                  <div><nome>'.$dado->primeiro_nome.' '.$dado->segundo_nome.'</nome><br><data>
                  <time class="timeago" datetime="'.$dado->data.'" title="'.$dt::_data($dado->data).'"></time><br>
                  <b>'.$di::_permicao($dado->perm-1).'</b>
                  </data><br>
                  </div>
                  <div class="pub_comandos">
                  <img src="imagens/tema/global/more.png" class="ctr" id="pop_up" value="'.$dado->idpub.'">
                  <button><img src="imagens/tema/global/stock_cancel.png" title="Excluor"></button>
                  <button><img src="imagens/tema/global/stock_new.png" title="Editar"></button></div>
                  </div>
                  <div class="conteudo">
                       '.$dado->legenda.'
                  </div></div></li></ul>
                  </div>
                  <div class="side side_b">
                  <table>
                   <tr><td height=60px >
                   <button class="comentarios" idt='.$dado->idpub.'>'.$pb::cont_comentario($dado->idpub).' comentarios</button>
                   <button class="links" idt='.$dado->idpub.'>12 partilha</button>
                       <button class="txt" idt='.$dado->idpub.'>11 | Bom</button>
                       <button class="txt" idt='.$dado->idpub.'>Mau | 21</button>
                   <div class="pontos" idt='.$dado->idpub.'>

                                   </div>
                  </div>
                     </td></tr>
                  <tr><td><div class="comentar"><div class="comentarios">
                   <ul type="none"></ul>

                  </div></td></tr>
                  <tr><td class="user" bgcolor="#FFF">
                    <form method="post" action="javascript:;" class="nova_comentario">
                    <table><tr><td width=50px>
                     <img src="imagens/users/thumbs/thumb_'.$_COOKIE['username'].'.jpg" class="usr M">
                     </td>
                     <td>
                     <input name="legenda" placeholder="Comentar" type="text">
                     <input type="text" value="'.$dado->idpub.'" name="pub" hidden="">
                     <input type="submit" hidden="">
                     </td></tr></table>



                     </form>
                     </td></tr>
                   </table>

                   </div>
                   <div class="side side_c"></div>';

                }
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
    public function mostrar($d0){
        $db=new database();
		    $pb=new publicacao;
		    $dt=new data;
		    $pr=new privacidade();
        $di=new dados();
        //if()
        try{
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("SELECT
										a.id as idag,
										a.username as username,
										a.primeiro_nome as primeiro_nome,
										a.segundo_nome as segundo_nome,
										p.data as data,
										p.legenda as legenda,
										p.id as idpub,
										p.permicao as perm
									FROM
										publicacao p,
										agente a
									WHERE
										p.idagente=a.id
										".$d0."
										order by p.data desc
										");

           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){

              //    $x=$pr::validar($dado->idag,$_COOKIE['id']).','.$dado->perm;;


				   if($pr::validar($dado->idag,$_COOKIE['id'])<=$dado->perm){//}

				   echo '<li class="li"><div class="publicacao p'.$dado->idpub.'" numero='.$dado->idpub.'>
							<div class="user">
							<a href="'.$dado->username.'"><div><img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="usr user L"></div>
							<div><nome>'.$dado->primeiro_nome.' '.$dado->segundo_nome.'</nome></a><br><data>
							<time class="timeago" datetime="'.$dado->data.'" title="'.$dt::_data($dado->data).'"></time><br>
                            <b>'.$di::_permicao($dado->perm-1).'</b>
							</data><br>
							</div>
								<div class="pub_comandos">
								<img src="imagens/tema/global/more.png" class="ctr" id="pop_up" value="'.$dado->idpub.'">
									<button><img src="imagens/tema/global/stock_cancel.png" title="Excluor"></button>
									<button><img src="imagens/tema/global/stock_new.png" title="Editar"></button></div>
						</div>
						<div class="conteudo">
							'.$dado->legenda.'
						</div>
						<div class="infos">
								<button class="comentarios" idt='.$dado->idpub.'>'.$pb::cont_comentario($dado->idpub).' comentarios</button>
								<button class="links" idt='.$dado->idpub.'>12 partilha</button>

                                      <button class="bom" idt='.$dado->idpub.'><span></span> | Bom</button>
                                      <button class="mau" idt='.$dado->idpub.'>Mau | <span></span> </button>
                <div class="pontos" idt='.$dado->idpub.'></div>
							</div>
						<div class="comentar">

							<div class="comentarios">
								<ul type="none"></ul>

							</div>
							<div class="user">
							<form method="post" action="javascript:;" class="nova_comentario">
								<img src="imagens/users/thumbs/thumb_'.$_COOKIE['username'].'.jpg" class="usr user M">
								<input type="text" placeholder="Comentar" name="legenda" autocomplete="none">
								<input type="text" value="'.$dado->idpub.'" name="pub" hidden="">
								<input type="submit" hidden="">
							</form>
						</div></div>

					</div></li>';
                   }}
           }
           else{
               echo 'e';
           }
         }
         catch(PDOException $e){
          echo $e->getMessage();
         }

    }

    public function carregar_comentario($d0,$d1){
        $db=new database();
		    $dt=new data;
        $cm='';
       	try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("SELECT
										c.id as id,
										a.username as username,
										a.primeiro_nome as primeiro_nome,
										a.segundo_nome as segundo_nome,
										c.data as data,
										c.legenda as legenda
									FROM
										comentario c,
										agente a
									WHERE
										c.idagente=a.id and
										c.idpublicacao= ?
										".$d1."
										order by c.data ASC

										");

           $query->bindValue(1, $d0);
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */

				   $cm.= '<li><div class="cmt'.$dado->id.'" id="'.$dado->id.'">
									<img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="usr user S">
									<nome>'.$dado->primeiro_nome.' '.$dado->segundo_nome.'</nome>
									<data> , <time class="timeago" datetime="'.$dado->data.'" title="'.$dt::_data($dado->data).'"></data>
									<div class="conteudo">'.$dado->legenda.'</div>
								</div></li>';
                   }
           }
           else{
           }
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
		    if($cm==""){$cm="Sem comentarios...";}
    	      return $cm;
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

   public function cont_pontos($d0,$d1){
         $db=new database();
         //$us=new usuario();
        	try{

             $PDO = new database();
             $pdo = $PDO->getDB();
             $query = $pdo->prepare("
                             SELECT count(*) as conta FROM
                                pontos
 							              WHERE
                                 idpublicacao = ? AND
                                 ponto = ?
                             ");
            $query->bindParam(1, $d0);
            $query->bindParam(2, $d1);
            $executa = $query->execute();
               $i=0;
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){return $dado->conta;}
 			         }
        }
        catch(PDOException $e){
           echo $e->getMessage();
        }
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
   //contadores
	public function cont_comentario($d0){
        $db=new database();
		$dt=new data;
        $cm=0;
       	try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("SELECT
										count(*) as conta
									FROM
										comentario c
									WHERE
										c.idpublicacao= ?
										");

           $query->bindValue(1, $d0);
           $executa = $query->execute();
           if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   return $dado->conta;
                   }
           }
           else{
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
		return $cm;
    }

}
/*$data=new data;
$data->query('ola');*/
