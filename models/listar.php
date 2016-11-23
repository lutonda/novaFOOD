<?php

include_once('database.conf.php');
class listar{
		public function _construct($query){
			$con=new database;
			$con->connect();
			return  mysql_query("select * from ".$query); 
			}
		public function buscar($query){
			$con=new database;
			$con->connect();
			return  mysql_query("select * from aluno ".$query); 
			}
		public function logar($query){
			$con=new database;
			$con->connect();
			return  mysql_query("select * from ".$query); 
			}
		public function aluno($query){
			$con=new database;
			$con->connect();
			return  mysql_query("select * from aluno ".$query." order by nome"); 
			}
		public function usuario($query){
			$con=new database;
			$con->connect();
			return  mysql_query("select * from usuario ".$query." order by nome"); 
			}
		public function pais($query){
			$con=new database;
			$con->connect();
			return  mysql_query("select * from pais ".$query." order by inicial"); 
			}
		public function query($k,$query){
			$con=new database;
			$con->connect();
			return  mysql_query("select * From ".$k." ".$query); 
			}
		public function turma($query){
			$con=new database;
			$con->connect();
			return  mysql_query("
						SELECT
							t.id as id,
							t.turma as codico,
							t.periodo as periodo,
							t.classe as classe,
							s.codico as sala,
							s.lotacao as lotacao,
							u.nome as coordenador_a,
							u.username as coordenador_b

						FROM
							turma t,
							sala s,
							usuario u
						WHERE
							t.idSala=s.id
							AND
							t.coordenador=u.id
							"); 
			}
		public function tarifa_voo2($voo){
			$con=new database;
			$con->connect();
			return  mysql_query("
						SELECT
							t.tipo as tipo,
							t.cod as cod
						FROM
							tarifa t
						WHERE
							t.tipo!=all(
									SELECT
										t.tipo
									FROM
										voo v,
										tarifa t,
										tarifa_voo tv
                  					WHERE
										v.cod=tv.cod_voo and
										tv.cod_tarifa=t.cod and
										v.cod=".$voo.")"
								); 
			}
		public function tarifa(){
			$con=new database;
			$con->connect();
			return  mysql_query("select * from tarifa"); 
			}
		public function admin(){
			$con=new database;
			$con->connect();
			return  mysql_query("select * from funcionario"); 
			}
		public function membro($cod){
			$con=new database;
			$con->connect();
			return  mysql_query("select * from membro where cod=".$cod); 
			}
		public function membro_c(){
			$con=new database;
			$con->connect();
			return  mysql_query("	SELECT
											c.nome as nome,
											c.sobre_nome as sobre_nome,
											c.email as email,
											c.genero as genero,
											c.telefone as telefone,
											c.data_nascimento as data_nascimento,
											c.data as data,
											m.idioma as idioma,
											m.morada as morada
											
									FROM 
											membro m,
											cliente c
									WHERE
											c.cod=m.cod and
											c.cod=".$_COOKIE['id']); 
			}
		public function voo($voo){
			$con=new database;
			$con->connect();
			
			return  mysql_query("
									
									SELECT
										v.cod as cod,
										v.data_partida as data_a,
										v.data_regreco as data_b,
										v.hora as hora,
										v.origem as origem,
										v.destino as destino,
										v.distancia as distancia,
										f.marca as marca,
										f.modelo as modelo,
										f.capacidade as cap,
										f.data as data
								 FROM
								 	voo v,
									frota f
							 	 WHERE
								 	v.cod_frota=f.cod and v.data_partida>='".date('Y-m-d')."' ".$voo." order by v.data_partida ASC " );
									 
			}
			public function preco($voo){
			$con=new database;
			$con->connect();
			$res=mysql_query("
					SELECT
						min(t.preco)*v.distancia as preco
					FROM
						tarifa t,
						tarifa_voo tv,
						voo v
					WHERE
						t.cod=tv.cod_tarifa and
						v.cod=tv.cod_voo and
						v.cod=".$voo); 
						while($linha=mysql_fetch_array($res)){
							return $linha['preco'];
						}
			}
			
			public function bilhetes($voo){
			if($voo==0){$voo="b.qtd=".$_COOKIE['id'];}
			else{$voo="v.cod=".$voo;}
			$con=new database;
			$con->connect();
			return  mysql_query("
									SELECT
											b.serie as serie,
											b.cod as cod,
											v.data_partida,
											v.hora as hora,
											v.origem,
											v.destino,
											b.estado as estado,
											c.nome as nome,
											c.sobre_nome as sobre_nome,
											c.genero as genero,
											b.data_compra as data,
											t.tipo as tarifa
									FROM 	
											voo v,
											bilhete b,
											cliente c,
											tarifa t
									WHERE	
											v.cod=b.cod_voo and
											c.cod=b.cod_cliente and
											t.cod=b.tarifa and
											b.estado !=3 and
											".$voo." order by b.data_compra desc"); 
			}
			
			public function bilhete($bi){
			$con=new database;
			$con->connect();
			return  mysql_query("
									SELECT
											b.serie as serie,
											b.cod as cod,
											v.data_partida,
											v.hora as hora,
											v.origem,
											v.destino,
											b.estado as estado,
											c.nome as nome,
											c.sobre_nome as sobre_nome,
											c.genero as genero,
											b.data_compra as data,
											t.tipo as tarifa
									FROM 
											voo v,
											bilhete b,
											cliente c,
											tarifa t
									WHERE	
											v.cod=b.cod_voo and
											c.cod=b.cod_cliente and
											t.cod=b.tarifa and
											b.cod=".$bi." order by b.data_compra desc"); 
			}
			public function bilhetes_info($bi){
			$con=new database;
			$con->connect();
			return  mysql_query("
									SELECT
											m.cod as cod_cliente,
											b.tarifa as tarifa,
											m.n_milhas as milhas
									FROM 
											membro m,
											bilhete b
									WHERE	
											m.cod=b.cod_cliente and
											b.serie=".$bi);
											
			}
			public function voo2(){
			$con=new database;
			$con->connect();
			return  mysql_query("SELECT
										v.cod as cod,
										v.data_partida as data_b,
										v.data_regreco as data_a,
										v.hora as hora,
										v.origem as destino,
										v.destino as origem,
										v.distancia as distancia,
										f.marca as marca,
										f.modelo as modelo,
										f.capacidade as cap
								 FROM
								 		voo v,
										frota f
							 	 WHERE
								 		v.cod_frota=f.cod and v.data_regreco>='".date('Y-m-d')."'
								 ORDER by v.data_regreco
								 "); 
			}
			function up($tipo,$vetor,$query){			
					$conexao=new database;
					$executar="UPDATE
									$tipo
									set
									$vetor
									where
									$query
									";	
					return mysql_query($executar,$conexao->connect()); 
				}
				
			function bilhetes_c($voo){
				$con=new database;
				$con->connect();
				$res=mysql_query("SELECT
										count(*) as conta
								 FROM
								 	bilhete
							 	 WHERE
								 	cod_voo=".$voo); 
					while($l=mysql_fetch_array($res)){
									return $l['conta'];
								}
						}
								
					}

?>