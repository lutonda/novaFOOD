<?php

include_once('../models/publicacao.php');
$funcoes_valida = array("mostrar","mostrar_comentario","cont_pontos");

$funcao = $_REQUEST['funcao'];
$id=$_REQUEST['id'];

if(in_array($funcao,$funcoes_valida))
{
	 $funcao($id);
}else{
    echo "You don't have permission to call that function so back off! ".$funcao;
    exit();
}

function mostrar($id){
	$pb=new publicacao;
	$pb::mostrar($id);
}

function mostrar_comentario($query){
			$q=explode("*",$query);
			//print_r($query);
			$pb=new publicacao;
			echo $pb::carregar_comentario($q[0],$q[1]);
}

function cont_pontos($query){
			$q=explode("*",$query);
			$pb=new publicacao;
			echo $pb::cont_pontos($q[0],$q[1]);
}
