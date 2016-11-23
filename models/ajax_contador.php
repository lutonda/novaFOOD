<?php

	include_once('../models/usuario.php');
	include_once('../models/ligacao.php');
	include_once('../models/publicacao.php');
	

$funcoes_valida = array(
						"ligacoes_ativas",
						"ligacoes_inativas",
						"ligacoes_pendentes");

$funcao = $_REQUEST['funcao'];
$id=$_REQUEST['id'];

if(in_array($funcao,$funcoes_valida)){$funcao($id);
}else{
    echo "You don't have permission to call that function so back off!";
    exit();
}

function ligacoes_pendentes()
{
  	$us=$_COOKIE['id'];
    $lg=new ligacao();
	echo $lg::cont_pendentes($us);
}
function ligacoes_ativas($id)
{
  	$us=$id;
    $lg=new ligacao();
	echo $lg::cont_ativas($us);
}
function ligacoes_inativas($id)
{
  	$us=$id;
    $lg=new ligacao();
	echo $lg::cont_inativas($us);
}
function ligacoes_comum($id)
{
	$query=array(
		'd0'=>$id,
		'd1'=>$_COOKIE['id']
	);
    $lg=new ligacao();
	echo $lg::cont_comum($query);
}
function publicacao($id)
{
    $pb=new publicacao();
	echo $pb::cont_publicacao($id);
}
function comentario($id)
{
    $pb=new publicacao();
	echo $pb::cont_comentario($id);
}
?>