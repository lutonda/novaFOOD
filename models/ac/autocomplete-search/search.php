<?php
include('db.php');
if($_POST)
{
$q=$_POST['search'];
$sql_res=mysql_query("select
				*
				from
					agente
				where
					username like '%".$q."%' or
					e_mail like '%".$q."%
					order by 
					'
					");
while($row=mysql_fetch_array($sql_res))
{
$username=$row['username'];
$email=$row['e_mail'];
$b_username='<strong>'.$q.'</strong>';
$b_email='<strong>'.$q.'</strong>';
$final_username = str_ireplace($q, $b_username, $username);
$final_email = str_ireplace($q, $b_email, $email);
?>
<a href="./<?=$username?>"><div class="show" align="left">
<img src="imagens/users/thumbs/thumb_<?=$username?>.jpg" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name"><?php echo $final_username; ?></span>&nbsp;<br/><?php echo $final_email; ?><br/>
	</div></a>
<?php
}
}
?>
