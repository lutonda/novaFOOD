<?php
include_once('database.conf.php');
include_once('evento.php');
class ligacao extends database{

    public function adicionar($query){
        $db=new database();
        $ev=new evento();
        extract($query);
       	try{
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                    INSERT
                        INTO ligacao
                    (agente_a, agente_b)
                        VALUES
                    (:d0,:d1)");
                    $query->bindValue(':d0', $d0);
                    $query->bindValue(':d1', $d1);
                    $res=$query->execute();

            if($res){
                  $query=array(
                        "d0"=>null,
                        "d1"=>$d0,
                        "d2"=>1,
                        "d3"=>1,
                        "d4"=>$d1,
                        "d5"=>null
                        );
                 if($ev::adicionar($query)) $res=1;
                 }
            else{ $res = 0; }
            }
        catch(PDOException $e){
            $res=$e->getMessage();
            }
        return $res;
	  }
    public function remover($query){
          $db=new database();
          extract($query);
       	  try{
                $PDO = new database();
                $pdo = $PDO->getDB();
                $query = $pdo->prepare("
                            DELETE
                                FROM ligacao
                            WHERE
                                agente_a = ? AND
        						            agente_b = ? OR
                                agente_b = ? AND
        						            agente_a = ?");
                 $query->bindValue(1, $d0);
                 $query->bindValue(2, $d1);
                 $query->bindValue(3, $d0);
                 $query->bindValue(4, $d1);
                 $res=$query->execute();

          			 if($res){
                        $query=array(
                            "d0"=>null,
                            "d1"=>$d0,
                            "d2"=>3,
                            "d3"=>1,
                            "d4"=>$d1,
                            "d5"=>null
                            );
                        if($ev::adicionar($query)) $res=1;
                        }
                else{	$res = 0 ;}
                }
            catch(PDOException $e){
                      $res=$e->getMessage();
                  }
            return $res;
          	}


	public function sugestao($d0){
        $db=new database();
        $lg=new ligacao();
		$s=explode('*',$d0);
		$s[1]=(empty($s[1])?2:$s[1]);
		$d0=$s[0];

       	try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
					SELECT
						*
					FROM
						agente
					WHERE id!= ? AND !(id IN (

                            SELECT a.id FROM
                               agente a,
                               ligacao l
							WHERE
                                (a.id= l.agente_b AND
								l.agente_a=?) OR
								(a.id= l.agente_a AND
								l.agente_b=?)

						))
					ORDER by id DESC
					LIMIT 0,4
                        ");
           $query->bindParam(1, $d0);
           $query->bindParam(2, $d0);
           $query->bindParam(3, $d0);
           /*$query->bindParam(2, $d1 , PDO::PARAM_STR);*/
           $executa = $query->execute();
            $comum=0;
          if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */

				   $comum=$lg::cont_comum($d0,$dado->id);
                   if($dado->primeiro_nome!="") { $nome=$dado->primeiro_nome.' '.$dado->segundo_nome;}
                   else{ $nome=$dado->username;}
                   if($s[1]==0){
						echo '
				   			<a href="./'.$dado->username.'" title="'.$nome.'">
								<img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="btn user">
							</a>';

				   }elseif($s[1]==1){
						echo '<div class="thumb">
                        <a href="./'.$dado->username.'"><user><img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="usr user ">
                        <div><nome>'.$nome.'</nome><br><data>'.$comum.' Ligações em comum</data></div>
                        </user></a>
	                    <button class="sbmt" usr="'.$dado->id.'"></button>
                        </div>';
				   }elseif($s[1]==2){
						echo '<div class="sug_ligacao">
                        <a href="./'.$dado->username.'"><user><img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="usr user M">
                        <div class="txt"><nome>'.$nome.'</nome><br><data>'.$comum.' Ligações em comum</data></div>
                        </user></a>
	                    <button class="sbmt" usr="'.$dado->id.'"></button>
                        </div>';
				   }
                   }
			  if(!isset($nome)){echo 'nao existe Sugestões de Amizade para Voce<br><br>';}

           }
           else{
               echo 'Erro ao inserir os dados';
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }

    }
	public function pendentes($d0){
        $db=new database();
        $lg=new ligacao();
		$s=explode('*',$d0);

		$s[1]=(empty($s[1])?0:$s[1]);

		$d0=$s[0];
       	try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT
                                l.agente_a as id,
                                a.username,
                                a.primeiro_nome,
                                a.segundo_nome

                            FROM
                                agente a, ligacao l
                            WHERE
                                a.id = l.agente_a AND
                                l.estado = 0 AND
                                l.agente_b = ?
                            Limit 0,4
                            ");
            $query->bindParam(1, $d0 , PDO::PARAM_STR);
            $executa = $query->execute();
            $comum=0;
          if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
				           $comum=$lg::cont_comum($d0,$dado->id);
                   if($dado->primeiro_nome!="") {
                       $nome=$dado->primeiro_nome.' '.$dado->segundo_nome;}
                   else{ $nome=$dado->username;}
                   if($s[1]==0){
            						echo '
            				   			<a href="./'.$dado->username.'" title="'.$nome.'">
            								<img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="btn user">
            							</a>';
                          }
                    elseif($s[1]==1){
						            echo '<div class="thumb">
                        <a href="./'.$dado->username.'"><user><img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="usr user ">
                        <div><nome>'.$nome.'</nome><br><data>'.$comum.' Ligações em comum</data></div>
                        </user></a>
	                       <button class="sbmt" usr="'.$dado->id.'"></button>
						<button class="sbmt" usr="'.$dado->id.'"></button>
                        </div>';
				   }elseif($s[1]==2){
						echo '<div class="sug_ligacao">
                        <a href="./'.$dado->username.'"><user><img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="usr user M">
                        <div class="txt"><nome>'.$nome.'</nome><br><data>'.$comum.' Ligações em comum</data></div>
                        </user></a>

	                    <button class="canselar" usr="'.$dado->id.'" val=2>x</button>
	                    <button class="sbmt addligacao" usr="'.$dado->id.'" val=2></button>
                        </div>';
				   }
                   }
			  if(!isset($nome)){echo 'nao existe Solicitações de Amizade Pendente para Voce<br><br>';}
           }
           else{
               echo 'Erro ao LISTAR os dados';
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }

    }
      	public function ativas($d0){
              $db=new database();
              $lg=new ligacao();
      		$s=explode('*',$d0);
      		$s[1]=(empty($s[1])?0:$s[1]);
      		$d0=$s[0];
             	try{

                  $PDO = new database();
                  $pdo = $PDO->getDB();
                  $query = $pdo->prepare("
                                  SELECT * FROM
                                     agente a,
                                     ligacao l
      							               WHERE
                                      (l.estado=1 AND
      								a.id= l.agente_b AND
      								l.agente_a=?) OR
      								(l.estado=1 AND
      								a.id= l.agente_a AND
      								l.agente_b=?)
                                  Limit 0,10
                                  ");
                 $query->bindParam(1, $d0 , PDO::PARAM_STR);
                 $query->bindParam(2, $d0 , PDO::PARAM_STR);
                 $executa = $query->execute();
                  $comum=0;
                if($executa){
                     while($dado = $query->fetch(PDO::FETCH_OBJ)){
                         /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                         $comum=$lg::cont_comum($d0,$dado->id);
                         if($dado->primeiro_nome!="") { $nome=$dado->primeiro_nome.' '.$dado->segundo_nome;}
                         else{ $nome=$dado->username;}
      				   if($s[1]==0){
      						echo '
      				   			<a href="./'.$dado->username.'" title="'.$nome.'">
      								<img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="btn user">
      							</a>';

      				   }elseif($s[1]==1){
      						echo '<div class="thumb">
                              <a href="./'.$dado->username.'"><user><img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="usr user ">
                              <div><nome>'.$nome.'</nome><br><data>'.$comum.' Ligações em comum</data></div>
                              </user></a>
                              </div>';
      				   }elseif($s[1]==2){
      						echo '<div class="sug_ligacao">
                              <a href="./'.$dado->username.'"><user><img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="usr user M">
                              <div class="txt"><nome>'.$nome.'</nome><br><data>'.$comum.' Ligações em comum</data></div>
                              </user></a>
                              </div>';
      				   }
                         }

      			  if(!isset($nome)){echo 'nao existe ligacoes de perfil para Voce<br><br>';}
                 }
                 else{
                     echo 'Erro ao inserir os dados';
                 }
             }
             catch(PDOException $e){
                echo $e->getMessage();
             }

          }
    public function inativas($d0){
        $db=new database();
        $lg=new ligacao();
       	try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT * FROM
                               agente a,
                               ligacao l
							WHERE
								l.estado=0 AND
								a.id= l.agente_b AND
								l.agente_a=?
                            Limit 0,10
                            ");
           $query->bindParam(1, $d0 , PDO::PARAM_STR);
           $query->bindParam(2, $d0 , PDO::PARAM_STR);
           $executa = $query->execute();
            $comum=0;
          if($executa){
               while($dado = $query->fetch(PDO::FETCH_OBJ)){
                   /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                   $comum=$lg::cont_comum($d0,$dado->id);
                   if($dado->primeiro_nome!="") { $nome=$dado->primeiro_nome.' '.$dado->segundo_nome;}
                   else{ $nome=$dado->username;}
                   echo '
				   			<a href="./'.$dado->username.'" title="'.$nome.'">
								<img src="imagens/users/thumbs/thumb_'.$dado->username.'.jpg" class="btn user">
							</a>';
                   }
			  if(!isset($nome)){echo 'nao existe ligacoes inativas de perfil para Voce<br><br>';}

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
                }
           }
           return $query;
           }
    public function ligado($agente_a,$agente_b){
            $db=new database();
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT *
                            FROM ligacao
                            WHERE
    							              (agente_a = ? AND agente_b = ?)
                                  OR
                                (agente_a = ? AND agente_b = ?)
                            ");
  		      $query->bindParam(1, $agente_a);
            $query->bindParam(2, $agente_b);
            $query->bindParam(3, $agente_b);
            $query->bindParam(4, $agente_a);
            $executa = $query->execute();
            $e=3;
            if($executa){
                while($dado = $query->fetch(PDO::FETCH_OBJ)){
				             if($dado->estado==0){
				   		              if($dado->agente_b==$agente_a or $dado->agente_a==$agente_a ){
							                       $e=2;
                            }else{$e=$dado->estado;}
				            }
			   	          else{$e=$dado->estado;}
			                     break;
		                }
              }
            return $e;
            }
    public function aceitar($query){
        $db=new database();
        $ev=new evento();
        extract($query);
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            UPDATE ligacao
                            SET estado=1
                            WHERE
                            agente_a = ? AND
                            agente_b = ?
                            ");
           $query->bindParam(1, $d1);
           $query->bindParam(2, $d0);
           $executa = $query->execute();
           if($executa){
                  $query=array(
                        "d0"=>null,
                        "d1"=>$d0,
                        "d2"=>2,
                        "d3"=>1,
                        "d4"=>$d1,
                        "d5"=>null
                        );
                  if($ev::adicionar($query)) $res=1;
          }else{ $res = 0;}
          return $res;
          }
  	public function cont_sugestao($d0){
        $db=new database();
        try{
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                					SELECT *
                					FROM agente
                					WHERE
                              id!= ? AND !(id IN (
                                  SELECT
                                        a.id
                                  FROM
                                        agente a,
                                        ligacao l
                							    WHERE
                                        (a.id= l.agente_b AND
                        								l.agente_a=?) OR
                        								(a.id= l.agente_a AND
                        								l.agente_b=?)
                                        )
                                    )
                        ");
            $query->bindParam(1, $d0);
            $query->bindParam(2, $d0);
            $query->bindParam(3, $d0);
            $executa = $query->execute();
            $i=0;
            if($executa){
                  while($dado = $query->fetch(PDO::FETCH_OBJ)){$i++;}
			            return $i;
                  }
            else{
                  echo 'Erro ao inserir os dados';
                }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
     }
	  public function cont_pendentes($d0){
        $db=new database();
        try{
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT
                                l.agente_a as id,
                                a.username,
                                a.primeiro_nome,
                                a.segundo_nome
                            FROM
                                agente a, ligacao l
                            WHERE
                                a.id = l.agente_a AND
                                l.estado = 0 AND
                                l.agente_b = ?
                            ");
            $query->bindParam(1, $d0 , PDO::PARAM_STR);
            $executa = $query->execute();
            $i=0;
            if($executa){
                  while($dado = $query->fetch(PDO::FETCH_OBJ)){$i++;}
			            }
           else{
               $i="Erro";
           }
       }
       catch(PDOException $e){
          echo $e->getMessage();
       }
       return $i;
      }
	  public function cont_ativas($d0){
        $db=new database();
        try{
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT *
                            FROM
                                agente a,
                                ligacao l
							              WHERE
                                (
                                    l.estado=1 AND
                    								a.id= l.agente_b AND
                    								l.agente_a=?)
                                OR
                								(
                                    l.estado=1 AND
                    								a.id= l.agente_a AND
                    								l.agente_b=?)
                            ");
            $query->bindParam(1, $d0 , PDO::PARAM_STR);
            $query->bindParam(2, $d0 , PDO::PARAM_STR);
            $executa = $query->execute();
            $i=0;
            if($executa){
                  while($dado = $query->fetch(PDO::FETCH_OBJ)){$i++;}
			            }
            else{
                  $i='Erro';
                  }
            }
        catch(PDOException $e){
            echo $e->getMessage();
            }
        return $i;
        }
    public function cont_inativas($d0){
        $db=new database();
        try{

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT *
                            FROM
                                 agente a,
                                 ligacao l
							              WHERE
                								l.estado=0 AND
                								a.id= l.agente_b AND
                								l.agente_a=?
                            ");
            $query->bindParam(1, $d0 , PDO::PARAM_STR);
            $query->bindParam(2, $d0 , PDO::PARAM_STR);
            $executa = $query->execute();
            $i=0;
            if($executa){
                  while($dado = $query->fetch(PDO::FETCH_OBJ)){$i++;}
			            }
            else{
                  $i='Erro';
                  }
            }
        catch(PDOException $e){
            echo $e->getMessage();
            }
        return $i;
        }
    public function cont_comum($d0,$d1){
        $db=new database();
       	try{
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("
                            SELECT
              								l.agente_b
              							FROM
              								agente a, ligacao l
              							WHERE
              								a.id=l.agente_a
              								AND
              								l.estado=1
              								AND
              								a.id=?
              								AND l.agente_b = ANY (SELECT l.agente_b
              														FROM
              															agente a, ligacao l
              														WHERE
              															a.id=l.agente_a
              															AND
              															l.estado=1
              															AND
              															a.id=?)
              								UNION

              						    SELECT
              								l.agente_a
              							FROM
              								agente a, ligacao l
              							WHERE
              								a.id=l.agente_b
              								AND
              								l.estado=1
              								AND
              								a.id=?
              								AND l.agente_a = ANY (SELECT l.agente_a
              														FROM
              															agente a, ligacao l
              														WHERE
              															a.id=l.agente_b
              															AND
              															l.estado=1
              															AND
              															a.id=?)"
								  );
            $query->bindParam(1, $d0 , PDO::PARAM_STR);
            $query->bindParam(2, $d1 , PDO::PARAM_STR);
            $query->bindParam(3, $d0 , PDO::PARAM_STR);
            $query->bindParam(4, $d1 , PDO::PARAM_STR);
            $executa = $query->execute();
            $i=0;
            if($executa){
                  while($dado = $query->fetch(PDO::FETCH_OBJ)){$i++;}
			            }
            else{
          			  $i='Erro';
                  }
            }
        catch(PDOException $e){
            echo $e->getMessage();
            }
        return $i;
        }

}
