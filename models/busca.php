<?php
	$i=1;
	$resultado="";
	
	include_once('../models/listar.php');
	
	$text=$_POST['src'];
	$ls=new listar;
	$data='where idEncarregado='.$_COOKIE['id'];
	$data.=' and
			(nome like "'.$text.'" or
			id like "'.$text.'" or
			sobrenome like "'.$text.'" or 
			apelido like "'.$text.'" or 
			nomePai like "'.$text.'" or	
			nomeMae  like "'.$text.'" or
			dataNasc like "'.$text.'" or
			naturalidade like "'.$text.'" or
			nacionalidade like "'.$text.'" or
			genero like "'.$text.'" or
			endereco like "'.$text.'" or
			numIdentificacao like "'.$text.'")';
		
	
	$res=$ls->buscar($data);
	while($linha=mysql_fetch_array($res)){
		extract($linha);
		$resultado.='
			<a href="aluno-'.$id.'"><div>'.$id.' - '.$nome.' '.$nome.'</div></a>
			<hr size=1 color="fff">
			';	
			$i++;
		}
		if($i==1){$resultado.='<h3>Nem um resultado encontrado para '.$text.'</h3>';}
	echo $resultado;	