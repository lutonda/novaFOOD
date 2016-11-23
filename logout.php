<?php
/**
 * Created by PhpStorm.
 * User: luthonda
 * Date: 18-11-2016
 * Time: 5:31
 */
setcookie('tipo_usr',null,-1,'/');
setcookie('id_usr',null,-1,'/');
setcookie('nome_usr',null,-1,'/');
//unset($_COOKIE['id_usr']);
echo $_COOKIE['id_usr'];
header('location: ./');