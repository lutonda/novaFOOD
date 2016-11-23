<?php

include_once('../models/usuario.php');
include_once('../models/clientes.php');
include_once('../models/vendas.php');
include_once('../models/artigos.php');
include_once('../models/servicos.php');
include_once('../models/ligacao.php');
include_once('../models/stock.php');
include_once("../models/system.php");
include_once("../models/adon.php");


//var_dump($_POST);
$funcoes_valida = array(
    "usuario",
    "request",
    "new_cliente",
    "new_artigo",
    "new_servico",
    "ver_artigo",
    "new_stock",
    "ver_login",
    "login",
    "up_empresa",
    "addItem",
    "encontrar_client",
    "save_venda",
    "delete",
    "addVenda",
    "estado_venda",
    "up_sistema",
    "new_usuario",
    "buscaP",
    "toPDF",
    "forgot",
    "proforma",
    "reload",
    "venda_painel_new",
    "venda_painel_add",
    "venda_painel_rem",
    "venda_painel_reload",
    "vA",
    "venda_numero"
);
$funcao = $_REQUEST['funcao'];
$id = ($_POST) ? $_POST : $_REQUEST['id'];
if (in_array($funcao, $funcoes_valida)) {
    $funcao($id, 0);
} else {
    echo "You don't have permission to call that function so back off!".$funcao;
    exit();
}
function new_artigo($POST)
{

    $ar = new artigo();
    $id = $ar::nextId();
    $idFornecedor = 234;
    $nome = "";
    $tipo = "1";
    $categoria = "1";
    $unidade = "1";
    $qtd_unidade = "1";
    $preco = "1";
    $obs = "";
    $text_factura = "";
    $stock_notificacao = "0";
    $estado = "0";
    extract($POST);
    $query = array(
        'd0' => null,
        'd1' => $id,
        'd2' => $nome,
        'd3' => $tipo,
        'd4' => $categoria,
        'd5' => $unidade,
        'd6' => $qtd_unidade,
        'd7' => $preco,
        'd8' => $obs,
        'd9' => $text_factura,
        'd10' => $stock_notificacao,
        'd11' => $estado,
        'd12' => date('Y-m-d h:i'),
        'd13' => $codigo,
    );
    $ar::cadastrar($query);
    $query = array(
        "idItem" => $id,
        "idFornecedor" => $idFornecedor,
        "qtd" => $quantidade,
        "cod_compra" => $cod_compra,
    );
    new_stock($query);
}

function new_stock($POST)
{

    extract($POST);
    $query = array(
        'd0' => null,
        'd1' => $idItem,
        'd2' => $idFornecedor,
        'd3' => $qtd,
        'd4' => $cod_compra,
        'd5' => date('Y-m-d h:i'),
    );
    $st = new stock();
    echo $st::cadastrar($query);
}

function new_servico($POST)
{
    $tipo = 1;
    $categoria = 1;
    $preco = "";
    $obs = "";
    $text_factura = "";
    $estado = 1;
    extract($POST);

    $query = array(
        'd0' => null,
        'd1' => 0,
        'd2' => $nome,
        'd3' => $tipo,
        'd4' => $categoria,
        'd5' => $preco,
        'd6' => $obs,
        'd7' => $text_factura,
        'd8' => $estado,
        'd9' => date('Y-m-d h:i'),

    );
    $sr = new servico();
    echo $sr::cadastrar($query);
    /*if($us::verificar_dados('username',$username)){$m=6;}
    else if($us::verificar_dados('email',$email)){$m=5;}
    if($username==''){$m=7;}else if($email==''){$m=8;}else if($password==''){$m=9;}
    else if($us::cadastrar($query)){
        copy("../imagens/users/unknow.jpg","../imagens/users/thumbs/thumb_".$query['d7'].".jpg");
        $m=login($email,$password);
    }*/
    //echo 0;
}

function up_empresa($POST, $o)
{
    extract($POST);
    $sy = new system();
    //print_r($POST);
    echo $sy::upEmpresa($_POST);
}

function up_sistema($POST, $o)
{
    extract($POST);
    $sy = new system();
    echo $sy::upSistema($_POST);
}

function new_cliente($POST)
{
    $contribuinte = "";
    $nome = "";
    $telefone_1 = "";
    $telefone_2 = "";
    $fax = "";
    $email = "";
    $endereco = "";
    $pais = 6;
    $tipo = 1;
    $desconto = "";
    $saldo = "";
    $prazo_pagamento = "";
    $tipo_conta = 1;
    $estado = 1;
    extract($POST);
    $query = array(
        'd0' => null,
        'd1' => $contribuinte,
        'd2' => $nome,
        'd3' => $telefone_1,
        'd4' => $telefone_2,
        'd5' => $fax,
        'd6' => $email,
        'd7' => $endereco,
        'd8' => $pais,
        'd9' => $tipo,
        'd10' => $desconto,
        'd11' => $saldo,
        'd12' => $prazo_pagamento,
        'd13' => $tipo_conta,
        'd14' => $estado,
        'd15' => date('Y-m-d h:i'),
    );
    $cl = new cliente();
    echo $cl::cadastrar($query);
    /*if($us::verificar_dados('username',$username)){$m=6;}
    else if($us::verificar_dados('email',$email)){$m=5;}
    if($username==''){$m=7;}else if($email==''){$m=8;}else if($password==''){$m=9;}
    else if($us::cadastrar($query)){
        copy("../imagens/users/unknow.jpg","../imagens/users/thumbs/thumb_".$query['d7'].".jpg");
        $m=login($email,$password);
    }*/
    //echo 0;
}

function ver_artigo($id)
{
    $ar = new artigo();
    print_r($ar::select($id));
}

function forgot($d0, $x)
{
    $us = new usuario();
    echo $us::forgot($d0);

}

function login($email, $pw)
{
    extract($_POST);
    $query = array(
        'd0' => $inputEmail,
        'd1' => $inputPassword,
    );
    $us = new usuario();
    setcookie('user', $us::verificar($query));
    echo $us::verificar($query);
}

function usuario($id)
{
    $us = new usuario();
    echo $us::ver($id);
}

function request($id)
{
    $id = explode("?", $id);
    $idvenda = (sizeof($id) > 1) ? $id[1] : 0;
    $id = $id[0];
    include("../views/".$id.".php");
}

function dados_user()
{
    echo "can't touch this!";
}

function save_venda($id)
{
    $vn = new vendas();
    $vn::up_venda($id);
}

function ligacoes_pendentes($id)
{
    $us = $_COOKIE['id'].'*'.$id;
    $lg = new ligacao();
    //if($us=$us::cadastrar($query)){;
    echo $lg::pendentes($us);
}

function ligacoes_ativas($id)
{
    $us = $id;
    $lg = new ligacao();
    echo $lg::ativas($us);
}

function encontrar_client($id)
{
    $cl = new cliente();
    echo $cl::autocoplete($id['search']);
}

function addItem($id)
{
    //print_r($id);
    $vn = new vendas();
    echo $vn::addItemVenda($id);
}

function delete($id)
{
    $vn = new vendas();
    echo $vn::delete($id);
}

function addVenda()
{
    $vn = new vendas();
    echo $vn::addVenda();
}

function proforma($id)
{
    echo $id;
    $vn = new vendas();
    echo $vn::proforma($id);
}

function estado_venda($id)
{
    $vn = new vendas();
    echo $vn::estado_venda($id);
}

function new_usuario($POST)
{
    $us = new usuario();
    echo $us::cadastrar($POST);
}

function buscaP($query)
{

    include_once("adon.php");

    include_once("../models/system.php");
    $sy = new system();
    $si = $sy::verSistema();
    $ad = new adon();
    $echo='';
    $soma=0;
    $i = 1;
    $vn = new vendas();
    $do= (($query['data'] == "") ? '' : date('Y-m-d',strtotime($query['data'])));
    $query['usuario']=(($query['usuario'] == 0) ? '1=1' : 'u.id='.$query['usuario']);
    $query = $vn::listar(null, $query);
       while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
           $di=date('Y-m-d', strtotime($dado->data));
           if ($di==$do or $do=="") {


           $total = $vn::totalItem($dado->venda) - $vn::totalItem($dado->venda) + ($vn::totalItem($dado->venda) * $si->iV / 100);
               $soma += $total;
               $echo .='
                <tr>
                  <td>'.$i++.'</td>
                  <td>'.$dado->venda.'</td>
                  <td>'.$dado->cliente.'</td>
                  <td class="text-right">'.$total.'</td>
                  <td><span class="label es-'.$vn::venda_estado($dado->estado).'">'.$vn::venda_estado($dado->estado).'</span></td>
                  <td>'.$ad::data($dado->data).'</td>
                  <td><b>'.$dado->tutor.'</b></td>
                  <td class="btn-group pull-right" role="group" aria-label="...">';
                      if ($dado->estado == 1) {
                           $echo.='<button class="btn btn-default btn invoice_view" value="venda_new?'.$dado->venda.'"><span class="fa fa-edit "></span></button>';
                      }
           $echo.= '<button class="btn btn-default invoice_view" value="invoice?'.$dado->venda.'"><span class="fa fa-file-text-o "></span></button></td>
                </tr>';
       }
       }
    $echo .= '<tr><td colspan="8" align="right"><h1>'.$soma.' kzs</h1></center></td></tr>';
       echo $echo;
}

function toPDF($html)
{
    /*$html="RSRSRSRS";
    $ad=new adon();

    /$mpdf->WriteHTML($html);

    $mpdf->Output();
    exit;*-/
    echo $ad::toPDF($html);*/
}

function reload($id){
    $data=($id==0)?' 1=1 ':' s.id = '.$id;
    $sr = new servico();

    $sr=$sr->listar_painel($data);
    echo $sr;
}
function venda_painel_new(){
    $vn = new vendas();
    $id=$vn->venda_painel_new();
    echo $id;
}
function venda_painel_reload($iv){


    $vn = new vendas();

    $vn=$vn->venda_painel_reload($iv);
    echo $vn;
}

function venda_painel_add($iv){
    //print_r($id);
    $vn = new vendas();
    $vn::venda_painel_add($iv);
}

function venda_painel_rem($iv){
    //print_r($id);
    $vn = new vendas();
    $vn::venda_painel_rem($iv);
}

function vA(){
    $sr = new servico();

    echo $sr->venda_actual();
}
?>
