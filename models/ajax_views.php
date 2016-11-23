<?php

	include_once('../models/views.php');
	include_once('../models/ligacao.php');
	

//var_dump($_POST);
$funcoes_valida = array("idioma",
                        "privacidade",
						"aterar_idioma",
                        "tema");

$funcao = $_REQUEST['funcao'];
$id=$_REQUEST['id'];

if(in_array($funcao,$funcoes_valida))
{
	 $funcao($id);
}else{
    echo "You don't have permission to call that function so back off!";
    exit();
}
function dados_user()
{
    echo "can't touch this!";
}
function idioma()
{
    $vw=new views();
	echo $vw::idioma();
}
function tema()
{
    
    $vw=new views();
	echo $vw::tema();

}
function privacidade()
{
    
    $lg=new views();
	echo $lg::privacidade();

}
function aterar_idioma($id){
	
	$lg=new views();
	echo $lg::aterar_idioma($id);
}

?>