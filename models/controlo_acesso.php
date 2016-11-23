<?php

class controlo_acesso{
		public function sujeito($sujeito){
			
			switch ($sujeito){
				case 1:
					$sujeito="Encarregado";
					break;
				case 2:
					$sujeito="Professor";
					break;
				case 3:
					$sujeito="Secretaia";
					break;
				case 4:
					$sujeito="gestor";
					break;
				}
			
			return  $sujeito; 
		}
			
		public function objecto($objecto){
			
			return  $objecto.'';
		}
		function redir_url($sujeito){
			
			switch ($sujeito){
				case 0:
					$url="/sge";
					break;
				case 1:
					$url="encarregado";
					break;
				case 2:
					$url="professor";
					break;
				case 3:
					$url="secretaria";
					break;
				case 4:
					$url="gestor";
					break;
				}
			
			return  $url; 
			}
		function redirecionar($sujeito,$objecto){
			$url_b = $this->redir_url($sujeito).'/';
			$url_a = str_replace('index.php','',$_SERVER["PHP_SELF"]);
				if($url_a!=$url_b){
					header('location: '.$this->redir_url($sujeito).'/');
				}}
	}
	$ca=new controlo_acesso;
	if(isset($_COOKIE['tipo'])){
			$sujeito=$_COOKIE['tipo'];	
		}
		else{
			$sujeito=0;	
		}
		$ca->redirecionar($sujeito,$sujeito);
		
?>