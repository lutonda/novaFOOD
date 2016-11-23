<?php

	include_once('../models/def_agente.php');
	include_once('../models/publicacao.php');


//var_dump($_POST);
$funcoes_valida = array("capa_uploader","fundo","pub");

$funcao = $_REQUEST['funcao'];
$id=$_REQUEST['id'];

if(in_array($funcao,$funcoes_valida))
{
	 $funcao($id);
}else{
    echo "You don't have permission to call that function so back off!";
		echo $funcao;
    exit();
}
function capa_uploader($id)
{
	include_once('../jscripts/uploader/capa_uploader.php');
}
function fundo($d0,$d1)
{
	$df=new def_agente();
	$query=array(
		'd1'=>$d0,
		'd2'=>$d1,
		'd3'=>$_COOKIE['id']
	);
	echo $df::update($query);
}
function ver_login()
{
    if(isset($_COOKIE['id'])){
    echo 'dentro: '.$_COOKIE['id'];
    }else{

    echo 'fora';
    }
}
function pub($id){
	$pb=new publicacao();
	$pb::mostrar_sigle('AND p.id='.$id);
}

?>
