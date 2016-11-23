<?php
		include_once("database.conf.php");
		/*include_once("listar.php");
		include_once("verificar.php");
		*/
		class inserir{
			
				public function add($tipo,$vetor){				
					$conexao=new database;
					$vetor=$this->toString($vetor);
					$executar="INSERT INTO $tipo
									VALUES
									(
									$vetor)";
					mysql_query($executar,$conexao->connect()); 
					return $executar;
				}
				public function update($tipo,$s,$d){				
					$conexao=new database;
					$executar="UPDATE $tipo
									set
									$s
									where
									$d";
					mysql_query($executar,$conexao->connect()); 
					
					//return $executar;
				}
				
				function toString($vetor){
					$novo=null;
					for($i=0;$i<sizeof($vetor)-1;$i++){
						$novo.="'".$vetor[$i]."',";
						}
						$novo.="'".$vetor[sizeof($vetor)-1]."'";
					return $novo;
				}
				public function usuario($id,$nome,$nascionalidade,$genero,$username,$password,$email,$telefone,$endereco,$data,$funcao)
				{
					$vetor=array($id,$nome,$nascionalidade,$genero,$username,$password,$email,$telefone,$endereco,$data,$funcao);
					$in=new inserir;
					$in->add('usuario',$vetor);
							
				}
				public function aluno($id,$nome,$sobreNome,$apelido,$nomePai,$nomeMae,$dataNasc,$naturalidade,$nascionalidade,$genero,$endereco,$numId,$data){
					/*$verificar=new verificar;
					if($verificar->v('cliente',"email",$emai) or $verificar->v('cliente',"telefone",$telefone)){
						return null;
						}
					$id=$this->cliente($id,$nome,$sobreNome,$apelido,$nomePai,$nomeMae,$dataNasc,$nascionalidade,$genero,$endereco,$password,$data);
					*/
					$vetor=array($id,$nome,$sobreNome,$apelido,$nomePai,$nomeMae,$dataNasc,$naturalidade,$nascionalidade,$genero,$endereco,$numId,$data,$_COOKIE['id']);
					$in=new inserir;
					return $in->add('aluno',$vetor);
				}
				public function normal($nome_a,$nome_b,$emai,$genero,$telefone,$data,$tipo,$categoria){
					$this->cliente($nome_a,$nome_b,$emai,$genero,$telefone,$data,$tipo);
					$vetor=array($categoria);
					return $this->add('normal',$vetor);
				}
				public function funcionario($nome,$emai,$pin){
					$vetor=array($nome,$emai,$pin);
					return $this->add('funcionario',$vetor);
				}
				public function tarifa_voo($tarifa,$voo){
					$vetor=array($tarifa,$voo);
					return $this->add('tarifa_voo',$vetor);
				}
				public function bilhete($t_pagamento,$n_banco,$qtd,$tarifa,$cod_cliente,$cod_voo,$estado,$serie){
					$vetor=array(null,$t_pagamento,$n_banco,$qtd,$tarifa,$cod_cliente,$cod_voo,$estado,$serie,date('Y-m-d h:i'));
					return $this->add('bilhete',$vetor);
				}
				public function frota($marca,$modelo,$capacidade,$d){
					$vetor=array(null,$marca,$modelo,$capacidade,$d);
					return $this->add('frota',$vetor);
				}
				public function admin($nome,$email,$pin){
					$vetor=array(null,$nome,$email,$pin,3,date('Y-m-d h:i'));
					return $this->add('funcionario',$vetor);
				}
				public function voo($d_partida,$d_regreco,$hora,$origem,$destino,$distancia,$cod_frota,$cod_funcionario){
					$vetor=array(null,$d_partida,$d_regreco,$hora,$origem,$destino,$distancia,$cod_frota,$cod_funcionario);
					return $this->add('voo',$vetor);
				}
				public function log($d_partida,$d_regreco,$hora,$origem,$destino,$distancia,$cod_frota,$cod_funcionario){
					$vetor=array(null,$d_partida,$d_regreco,$hora,$origem,$destino,$distancia,$cod_frota,$cod_funcionario);
					return $this->add('voo',$vetor);
				}
				/*public function tarifa_voo($cod_tarifa,$disponibilidade,$cod_voo){
					$vetor=array($cod_tarifa,$disponibilidade,$cod_voo);
					$this->add('tarifa_voo',$vetor);
				}*/
				public function tarifa($Discount,$Basic,$Classic,$Plus,$Executive){
					$s='preco='.$Discount;
					$d='cod=1';
					 $this->update('tarifa',$s,$d);
					$s='preco='.$Basic;
					$d='cod=2';
					 $this->update('tarifa',$s,$d);
					$s='preco='.$Classic;
					$d='cod=3';
					 $this->update('tarifa',$s,$d);
					$s='preco='.$Plus;
					$d='cod=4';
					 $this->update('tarifa',$s,$d);
					$s='preco='.$Executive;
					$d='cod=5';
					 $this->update('tarifa',$s,$d);
				}
				public function regalias($tarifa,$regalia){
					$s='cod_tarifa='.$regalia;
					$d='cod='.$tarifa;
					 $this->update('regalias',$s,$d);
				}
				
				
			}
?>