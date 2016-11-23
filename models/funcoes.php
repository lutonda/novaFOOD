<?php
include_once('listar.php');
function nacionalidade($d){
	$ls=new listar;
	$res=$ls->pais('where id = '.$d);
	while($linha=mysql_fetch_array($res)){

	return $linha['Pais'];
	break;
	}
}
function genero($d){
	$genero=Array('Feminino','Masculino');
	return $genero[$d];
}
function titulo($d){
	$genero=Array('Sra','Sr');
	return $genero[$d];
}
function funcao($d){
	$funcao=Array('Encarregado','Secretario','Professor','Gestor');
	return $funcao[$d-1];
}
function data($d){
	$d=explode('-',$d);
	return $d[2].'/'.$d[1].'/'.$d[0];
	}

	function senha($forca){
		$lower="a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,x,w,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,X,W,Y,Z,1,2,3,4,5,6,7,8,9,0,#,@,%,&";
		$lower=split(',',$lower);
		$senha='';
		for($k=0;$k<$forca;$k++){
			$senha.=$lower[rand(0,sizeof($lower)-1)];	
			}
			return $senha;
		}
	
?>