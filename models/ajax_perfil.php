<?php

	include_once('../models/def_agente.php');
	

//var_dump($_POST);
$funcoes_valida = array("cor","fundo","idioma","tema");

$funcao = $_REQUEST['funcao'];
$id=$_REQUEST['id'];

if(in_array($funcao,$funcoes_valida))
{
	 update($id,$funcao);
}else{
    echo "You don't have permission to call that function so back off! ".$funcao;
    exit();
}
function update($d0,$d1)
{
	$df=new def_agente();
	$query=array(
		'd1'=>$d0,
		'd2'=>$d1,
		'd3'=>$_COOKIE['id']
	);switch($d1){
	case 'cor':$d1="Esquema de cores";break;
	case 'fundo':$d1="Imagem do Fundo";break;}
	if($df::update($query)){
		echo $d1.' Alterado com sucesso!';
		};
}
function fundo($d0,$d1)
{
	$df=new def_agente();
	$query=array(
		'd1'=>$d0,
		'd2'=>$d1,
		'd3'=>$_COOKIE['id']
	);
	
}
function ver_login()
{
    if(isset($_COOKIE['id'])){
    echo 'dentro: '.$_COOKIE['id'];
    }else{
    
    echo 'fora';
    }
}

?>