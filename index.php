<?php
//if(date('Y-m-d')>"2016-07-01"){echo 'bug';}
if(isset($_COOKIE['id_usr'])){
	header('location: inicio.php');
};
    /*setcookie('tipo_usr','',0,'./');
    setcookie('id_usr','',0,'./');
    setcookie('nome_usr','',0,'./');
*/
?>
<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title>Login Nova</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="author" content="KaijuThemes">

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet' type='text/css'>
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">
    <link type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">               <!-- Themify Icons -->
    <link type="text/css" href="assets/css/styles.css" rel="stylesheet">

    <link href="css/signin.css" rel="stylesheet">

    <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){

        var server_ADRS="localhost";
				function conn(){
                        var i=0;
                        $.ajax({
                              url: "models/connect.php",
                              type: "GET",
                              success: function(data){
                                $(".con").css("background-color","green");
                                $('div.srv').html("servidor: <b>localhost</b>")
                           },
                            error:function(erro){
                                $(".con").css("background-color","#F00");
                                $('div.srv').html("")
                            }
                        });
                    }
                setInterval(conn,1000);
                $('form').submit(function(){
                    $.post('models/ajax.php?funcao=login&id=0',$(this).serialize(),function(e){

                            if(e==1){
								alert('Usuario Autenticado com sucesso!')
                                location.href="inicio.php";
                            }else{alert("Não foi possivel autentificar os seus registos, certifica-se que Inserio os dados correctamente e volte a Tentar!")}
                        })
                    })
                $('#inputEmail').keyup(function(){
                  if($(this).val()!=""){
                    $('.foot').show(500);
                  }else{
                    $('.foot').hide();
                  }
                })
								$('.forgot').click(function(){
									$.ajax({
										url:"models/ajax.php?funcao=forgot&id="+$('#inputEmail').val(),
										typr:"GET",
										success:function(e){
											alert(e);
										}
								})
			})
    })
		</script>

    </head>

    <body class="focused-form animated-content">


<div class="container" id="login-form">
	<a href="index.html" class="login-logo"><img style="max-width: 300px" src="assets/img/logo-big.png"></a>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2>Autenticar-se</h2>
                                 <div class="con"></div><div class="srv pull-right"></div>
					</div>
          <form method="post" action="javascript:;" class="form-horizontal form-signin" id="validate-form">
          <div class="panel-body">

						<div class="form-group mb-md">
		            <div class="col-xs-12">
		                <div class="input-group">
    										<span class="input-group-addon">
    											<i class="ti ti-user"></i>
    										</span>
    										<input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Username ou E-mail" data-parsley-minlength="6" placeholder="At least 6 characters" required>
									 </div>
		            </div>
							</div>

							<div class="form-group mb-md">
		              <div class="col-xs-12">
		                  <div class="input-group">
    										<span class="input-group-addon">
    											<i class="ti ti-key"></i>
    										</span>
    										<input type="password" id="inputPassword" name="inputPassword" placeholder="Palavra passe" class="form-control" >
									    </div>
		              </div>
							</div>

							<div class="form-group mb-n">
								<div class="col-xs-12 foot" style="display:none">
									<a href="javascript:;" class="pull-left forgot">Esqueci-me a Senha</a>
									<div class="pull-right">
										<label>
										</label>
									</div>
								</div>
							</div>

					</div>
					<div class="panel-footer">
						<div class="clearfix">
							<button type="submit" class="btn btn-primary pull-right">Login</button>
						</div>
					</div></form>
				</div>


			</div>
		</div>
</div>



    <!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script type="text/javascript" src="assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->

<script type="text/javascript" src="assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="assets/plugins/velocityjs/velocity.ui.min.js"></script>

<script type="text/javascript" src="assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->

<script type="text/javascript" src="assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script type="text/javascript" src="assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->

<script type="text/javascript" src="assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script type="text/javascript" src="assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

<script type="text/javascript" src="assets/js/application.js"></script>
<script type="text/javascript" src="assets/demo/demo.js"></script>
<script type="text/javascript" src="assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
    <!-- Load page level scripts-->


    <!-- End loading page level scripts-->
    </body>
</html>
