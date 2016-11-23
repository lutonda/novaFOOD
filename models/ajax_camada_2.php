<?php

	include_once('../models/usuario.php');
	include_once('../models/ligacao.php');
	

//var_dump($_POST);
$funcoes_valida = array("dp",
                        "ct",
                        "remligacao",
                        "aceitarligacao",
                        "autenticar",
                        "cadastrar",
                        "ver_login",
                        "login",
						"ligacoes_ativas",
						"ligacoes_pendentes");

$funcao = $_REQUEST['funcao'];
$id=$_REQUEST['id'];

if(in_array($funcao,$funcoes_valida))
{
	 $funcao($id);
}else{
    echo "You don't have permission to call that function so back off!";
    exit();
}
function up()
{
	extract($_POST);
	$query=array(
		'd0'=>'',
		'd1'=>$nome_a,
		'd2'=>$nome_b,
		'd3'=>$email,
		'd4'=>$telefone,
		'd5'=>$password,
		'd6'=>$tipo,
		'd7'=>$username,
		'd8'=>'',
		'd9'=>date('Y-m-d h:i')
	);
    print_r($query);
	$us=new usuario();
	if($us::cadastrar($query)){;
        echo autenticar($query);
    }
}

function login()
{
	extract($_POST);
	$query=array(
		'd0'=>$username,
		'd1'=>$pw
	);
	$us=new usuario();
	if($query=$us::autenticar($query)){;
        echo autenticar($query);
    }
}
function autenticar($query)
{
        
        extract($query);
        setcookie('username',$query['d0'],0,'/');
        setcookie('id',$query['d1'],0,'/');
        return 1;
}

function ver_login()
{
    if(isset($_COOKIE['id'])){
    echo 'dentro: '.$_COOKIE['id'];
    }else{
    
    echo 'fora';
    }
}

function dados_user()
{
    echo "can't touch this!";
}
function ligacoes()
{
    
    $us=$_COOKIE['id'];
    
    $lg=new ligacao();
	//if($us=$us::cadastrar($query)){;
      echo $lg::sugestao($us);

}
function ligacoes_pendentes()
{
  	$us=$_COOKIE['id'];
    $lg=new ligacao();
	//if($us=$us::cadastrar($query)){;
    echo $lg::pendentes($us);
}
function ligacoes_ativas($id)
{
  	$us=$id;
    $lg=new ligacao();
	//if($us=$us::cadastrar($query)){;
    echo $lg::ativas($us);
}
function addligacao($id){
    $query=array (
        'd0'=>$_COOKIE['id'],
        'd1'=>$id
    );
    $lg=new ligacao();
	if($us=$lg::adicionar($query)){
      echo 9;
    }
}
function remligacao($id){
    $query=array (
        'd0'=>$_COOKIE['id'],
        'd1'=>$id
    );
    $lg=new ligacao();
	if($us=$lg::remover($query)){
      echo 9;
    }
}
function aceitarligacao($id){
    
    $query=array (
        'd0'=>$_COOKIE['id'],
        'd1'=>$id
    );
    $lg=new ligacao();
	if($us=$lg::aceitar($query)){
      echo true;
    }
}

?>