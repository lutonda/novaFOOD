<?php
//if(date('Y-m-d')>"2016-07-01"){echo 'bug';}
if(!isset($_COOKIE['id_usr'])){
    header('location: ./');
}
if ($_COOKIE['tipo_usr']==2) {
    header('location: ./painel.php');
};
/*setcookie('tipo_usr','',0,'./');
setcookie('id_usr','',0,'./');
setcookie('nome_usr','',0,'./');
*/
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>novaFOOD</title>

    <link rel="stylesheet" href="css/autocomplete.css">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        <!-- Font Awesome -->
    <link type="text/css" href="assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              <!-- Themify Icons -->
    <link type="text/css" href="assets/css/styles.css" rel="stylesheet">                                     <!-- Core CSS with all styles -->
    <link type="text/css" href="assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
    <link type="text/css" href="assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet"> 						<!-- FullCalendar -->
    <link type="text/css" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"> 			<!-- jVectorMap -->
    <link type="text/css" href="assets/plugins/switchery/switchery.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/print/css/print-preview.css" type="text/css" media="screen">
	<link href="css/bootstrap.print.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/print/jquery.print-preview.js"></script>


		<script>

            jQuery(document).ready(function($){
              request('inicio');
            var corent_URI;
            var server_ADRS="localhost";
            var usr=<?=$_COOKIE['id_usr']?>;
            $.ajax({
    			    url: "models/ajax.php?funcao=usuario&id="+usr,
    			    type: "GET",
    			    success: function(data){

                        data=data.split("#");
                        if(data[1]<=0) {
                          $('.config').show();
                        }

                        if(data[1]<=1) {
                          $('.cliente').show();

                            $('.compra').show();
                        }
                        $t=Array('***', '**', '*')
                        $('.user').html('Ola! '+data[0]+' '+$t[data[1]]+'');

                    }
             });

            function request($data){
				debugger
                //alert(corent_URI);
					$('.main').append(
						'<div class="loading">' +
						'<div><img src="imgs/6.gif"></div>' +
						'</div>');
                    $.ajax({

                    url: "models/ajax.php?funcao=request&id="+$data,
                    type: "GET",
                    success: function(data){
                        $('.main').html(data);

                        $('.toggle[type=button]').click(function(){
                          $('.toggle').toggle(0);
                          $( "form input, form textarea, form select").prop("disabled", false);
                        })
                        $('venda_list form input, venda_list form select').change(function(){
                          $('venda_list form .txt').val($(this).val());
                          $.post('models/ajax.php?funcao=buscaP',$('venda_list form').serialize(),function(e){

							  e=$.trim(e.replace(/[\t\n]+/g,' '))
                            $('venda_list tbody').html(e)

                            $('.invoice_view').click(function(){
                              $data=$(this).attr("value");
                              $("#result_busca").hide();
                              corent_URI=$data;
                              request($data);

                              $('moeda').html(0);
                            })
                          })
                        })
                        $('venda_list form button').click(function(){
                          $('venda_list form .txt').val($(this).attr('value'));
                          $.post('models/ajax.php?funcao=buscaP',$('venda_list form').serialize(),function(e){
                            //alert(e);
                            $('venda_list tbody').html(e)
                              //alert(0);
                          })
                        })
                        $('.estado_venda').click(function(){

                            $data=$(this).attr("value");
							if($data.split('?')[0]==0){
								print();
								}
                            //alert($data);
                            $.ajax({
                                url: "models/ajax.php?funcao=estado_venda&id="+$data,
                                type: "GET",
                                success: function(data){

                                    request('vendas_list');
                                }
                            })
                        });
						 $('.proforma').click(function(){
							$data=$(this).attr("value");

                           // alert($data);
                            $.ajax({
                                url: "models/ajax.php?funcao=proforma&id="+$data,
                                type: "GET",
                                success: function(data){
                                   $('.estado').html("PROFORMA");
								   print();
								    request('vendas_list');
                                },erro:function(er){
									alert(er);
								}
                            })
                        });
                        $('.delete').click(function(){
                            $data=$(this).attr("value");
                            $.ajax({
                                url: "models/ajax.php?funcao=delete&id="+$data,
                                type: "GET",
                                success: function(data){
                                   // alert(data);
                                    request(corent_URI);
                                }
                            })
                        })
                        ////-------------------------------
                        ////Nova venda

                        $('venda .add').click(function(){
                          $value=$(this).attr("value");
                          $func=$(this).attr("att");
                          $.ajax({
                          url: "models/ajax.php?funcao=ver_artigo&id="+$value,
                          type: "GET",
                          success: function(data){
                            data=data.split("||");
                              $('.pop-up .idItem').val($value);
                              $('.pop-up .nome').append(data[0]);
                              $('.pop-up .stock').append(data[1]);
                              $('.pop-up .adon').html(data[2]+"s");
                              //alert(data);
                          }})
							$('.pop-up').fadeIn(1000);
                        })

                        $('.invoice_view').click(function(){
                          $data=$(this).attr("value");
                          corent_URI=$data;
                          request($data);


                            $('.editForm form input, .editForm  form textarea,  .editForm form select').prop("disabled", true);

                        })

                        ////Adicionar stock
                        $('.add').click(function(){
                          $value=$(this).attr("value");
                          $func=$(this).attr("att");
                          $.ajax({
                          url: "models/ajax.php?funcao=ver_artigo&id="+$value,
                          type: "GET",
                          success: function(data){
                            alert($value);
                            data=data.split("||");
                              $('.pop-up .idItem').val($value);
                              $('.pop-up .nome').append(data[0]);
                              $('.pop-up .stock').append(data[1]);
                              $('.pop-up .adon').html(data[2]+"s");
                              //alert(data);
                          }})
                          $('.pop-up').fadeIn(1000);
                        })
                        $('.pop-up .ban').click(function(){
                          $('.pop-up').fadeToggle(1000);
                        })
                      /*  $('.new_compra').submit(function(){
                          $funcao=$(this).attr("value");
                          $.post('models/ajax.php?funcao='+$funcao+'&id=0',$(this).serialize(),function(e){
                              alert(e);
                              if(e==1){
                                      //location.href="inicio.html";
                                  }else{}
                              })
                        })*/
                        ////-------------------------------

                                  ///// search clients for seling
                                  $(".search.cliente").keyup(function()
                                  {

                                  var searchid = $(this).val();
                                  var dataString = 'search='+ searchid;
                                  if(searchid!='')
                                  {
                                    $.ajax({
                                    type: "POST",
                                    url: "models/ajax.php?funcao=encontrar_client",
                                    data: dataString,
                                    cache: false,
                                    success: function(html)
                                    {
                                    $("#result_cliente").html(html).show();
                                    $('.show').click(function(){

                                      $('.estado_venda').show();
                                      $('.codigo').val($(this).attr("value"));
                                      $('.codigo').attr("title",$(this).attr("value"));
                                      $('.search.cliente').val($(this).html());
                                      $("#result_cliente").html("").hide();

                                      $('form.new').submit(function(){
                                              $funcao=$(this).attr("value");
                                              alert($funcao);
                                              $.post('models/ajax.php?funcao='+$funcao+'&id=0',$(this).serialize(),function(e){
                                                 // alert(e);
                                                  if(e!=0){
                                                        request(corent_URI);  //location.href="inicio.html";
                                                      }else{}
                                                  })
                                              })
                                    })
                                    }
                                    });
                                  }
                                    if(html==''){$("#result").html("").show();}
                                  return false;
                                  });
                                  /////search from item on seler
                                  $(".encontre input").keyup(function()
                                  {
                                  var searchid = $(this).val();
                                  var dataString = 'search='+ searchid;
                                  if(searchid==''){
                                    $("#result_busca").hide();}else
                                  {
                                    $.ajax({
                                    type: "POST",
                                    url: "models/encontre.php",
                                    data: dataString,
                                    cache: false,
                                    success: function(html)
                                    {
                                      $("#result_busca").html(html).show();
                                      $('#result_busca .label').click(function(){
                                        $("#result_busca").hide();
                                      })
                                      $('.invoice_view').click(function(){
                                        $data=$(this).attr("value");
                                        $("#result_busca").hide();
                                        corent_URI=$data;
                                        request($data);
                                        $('moeda').html(0);
                                      })

                                    },
                                    error:function(e){
                                      $("#result_busca").hide()
                                    }
                                    });
                                  }
                                    if(html==''){$("#result").html("").show();}
                                  return false;
                                  });

                                  $(".search.venda").keyup(function()
                                  {
                                  var searchid = $(this).val();
                                  var dataString = 'search='+ searchid;
                                  if(searchid!='')
                                  {
                                    $.ajax({
                                    type: "POST",
                                    url: "models/autocomplete.php",
                                    data: dataString,
                                    cache: false,
                                    success: function(html)
                                    {
                                    $("#result").html(html).show();
                                    $('form span.btn').click(function(){
                                      $('#form'+$(this).attr("id")).submit()
                                      $.post('models/ajax.php?funcao=addItem'+'&id=0',$('#form'+$(this).attr("id")).serialize(),function(e){

                                          if(e==1){request(corent_URI); }else{
                                            //alert(e)
                                          }

                                            $("#result").hide();
                                          })
                                      });
                                    }
                                    });
                                  }else{
                                    $("#result").hide();
                                  }
                                    if(html==''){$("#result").html("").show();}
                                  return false;
                                  });

                                  $('#searchid').click(function(){
                                    $("#result").fadeIn();
                                  });
                              ////--------------------------------
                        $('form.new').submit(function(){
                                $funcao=$(this).attr("value");
                                //alert($funcao);
                                $.post('models/ajax.php?funcao='+$funcao+'&id=0',$(this).serialize(),function(e){
                                    alert(e);
                                    if(e==1){
										alert('Utilizador cadastrado com SUcesso! ')
                                          request(corent_URI);  //location.href="inicio.html";
                                        }else if(e==2){alert('Verifique o E-mail ou username, Já existe um Utilizador com esses dados')}
                                    })
                                })
                        $(".novo, .link").click(function(){

                            $data=$(this).attr("value");
                            if($data=="venda_new"){
                                $.ajax({
                                    url: "models/ajax.php?funcao=addVenda&id=0",
                                    type: "GET",
                                    success: function(data){
                                        $data=$data+'?'+data;
                                        //alert($data);

                            corent_URI=$data;
                            request($data);
                                    }})
                            }
                            corent_URI=$data;
                            request(corent_URI);


                           })
                           $('.print').click(function(){
                               //$('.btn').hide();
                               $('.main').removeClass('col-md-10');
                               $('.main').addClass ('col-md-12');
                               $('.main').attr('Class','col-md-12');
                               window.print();
                               $('.main').attr('Class','col-md-10');
                             //  $('.btn').show();
                               location.href="inicio.php"
                           });
                           $('.mail').click(function(){
                               //$('.btn').hide();
                               $('input[type=email]').toggle(100);
                               if($(this).attr('value')=="send"){

                                 alert($(this).attr('value'));
                                 $(this).attr("value","quite");
                               }else{
                               $(this).attr('value','send');}

                             //  $('.btn').show();
                              // location.href="inicio.html"
                           });
                           $('.pdf').click(function(){
                             $html="html="+$('html').html();
                             //alert($html);
                             $.ajax({
                                 url: "models/ajax.php?funcao=toPDF&id=0",
                                 type: "POST",
                                 data:$html,
                                 success: function(data){
                                     alert(data);
                                     //corent_URI=$data;
                                     //request($data);
                                 }})
                           });
                        },
                    erro:function(erro){
                        $('.main-content').html(erro);
                    }

                });
                  $('.editForm form input, .editForm  form textarea,  .editForm form select').prop("disabled", true);


                }
            $(".sidebar li a, cliente .novo").click(function(){
                $data=$(this).attr("value");
                corent_URI=$data;
                request($data);
            })

            })


		</script>
  </head>

  <body>
<header id="topnav" class="navbar navbar-bluegraylight navbar-fixed-top" role="banner">
	<div class="logo-area">
    <span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
			<a href="inicio.php" data-placement="right" title="Inicio">
				<span class="icon-bg">
					<i class="ti ti-home"></i>
				</span><span class="sr-only">(current)</span>
			</a>
		</span>
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar" aria-expanded="false">
        <i class="ti ti-menu"></i>
     </button>
    <a class="navbar-brand"  href="inicio.php"><span class="fa fa-home fa-2x"></span><span class="sr-only">(current)</span></a>

		<div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
      <form role="search" method="post" action="javascript:;" class="encontre">
        <div class="input-group">
          <span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-search"></i></button></span>
            <input type="text" class="form-control" placeholder="Encontre aqui...">
            <input type="submit" hidden="">
            <span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-close"></i></button></span>
          </div>
          <div id="result_busca" class="input-group col col-md-12 navbar-inverse" style="max-height:900px; width:100%; max-width:700px, margin-top:0"></div>
      </form>

        </div>

	</div><!-- logo-area -->

	<ul class="nav navbar-nav toolbar pull-right" style="margin-top:7px;">

		<li class="toolbar-icon-bg visible-xs-block" id="trigger-toolbar-search">
			<a href="#"><span class="icon-bg"><i class="ti ti-search"></i></span></a>
		</li>

		<li class="toolbar-icon-bg hidden-xs">
            <a href="#"><span class="icon-bg"><i class="ti ti-world"></i></span></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs">
            <a href="#"><span class="icon-bg"><i class="ti ti-view-grid"></i></span></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs" id="trigger-fullscreen">
            <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span></a>
        </li>
		<li class="dropdown toolbar-icon-bg">
			<a href="#" class="hasnotifications dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="icon-bg"><i class="ti ti-help"></i></span></a>
			<div class="dropdown-menu notifications arrow">
				<div class="topnav-dropdown-header">
					<span>Sobre</span>
				</div>
				<div class="scroll-pane has-scrollbar">
					<ul class="media-list scroll-content" tabindex="0" style="right: -15px;">
						<li class="media notification-success">
							<a href="http://www.nova.oreall.com/ajuda" target="_blank">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
								<h4 class="notification-heading">Ajuda</h4>
									<span class="notification-time">www.oreall.com/nova/ajuda</span>
								</div>
							</a>
						</li>
						<li class="media notification-info">
							<a href="http://www.nova.oreall.com/faqs" target="_blank">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>

								<div class="media-body">
									<h4 class="notification-heading">FAQs</h4>
									<span class="notification-time">www.oreall.com/nova/faqs</span>
								</div>
							</a>
						</li>
						<li class="media notification-teal">
							<a href="http://www.nova.oreall.com/ajuda">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Sobre</h4>
									<span class="notification-time">www.nova.oreall.com/sobre</span>
								</div>
							</a>
						</li>
						<li class="media notification-indigo">
							<a href="http://www.oreall.com">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Oreall</h4>
									<span class="notification-time">www.oreall.com</span>
								</div>
							</a>
						</li>
					</ul>
		</li>

		<li class="dropdown toolbar-icon-bg">
      <a href="#" class="hasnotifications dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="icon-bg"><i class="ti ti-user"></i></span></a>
			<ul class="dropdown-menu userinfo arrow">
        <li>
          <div class="topnav-dropdown-header">
            <span class="user">ola! </span>
          </div>
        </li>
				<li><a href="logout.php"><i class="ti ti-shift-right"></i><span>Sair</span></a></li>
			</ul>
		</li>

	</ul>

</header>

      <div class="container-fluid">
      <div class="row">

        <div  class="col-sm-3 col-md-2 sidebar" id="sidebar" >
<br>
					<div class="panel panel-primary">
						<div class="panel-heading" data-toggle="collapse" data-target="#vendas">
							<h3 class="panel-title">
								<span class="fa fa-suitcase"></span>
								Venda</h3>
						</div>
						<div class="panel-body panel-collapse collapse in" id="vendas">
							<ul class="nav list-group">
                                <li class="active"><a href="#" value="vendas_list">Facturas<span class="sr-only">(current)</span></a></li>
                                <li class="active"><a href="painel.php" >Painel de Venda<span class="sr-only">(current)</span></a></li>
								<li><a href="#" value="vendas_ecomenda">Encomendas<span class="sr-only">(current)</span></a></li>
								</ul>
						</div>
					</div>
					<div class="panel panel-primary compra" style="display:none">
						<div class="panel-heading" data-toggle="collapse" data-target="#compras">
							<h3 class="panel-title">
								<i class="fa fa-shopping-cart fa-1x"></i>
								Compras</h3>
						</div>
						<div class="panel-body collapse in collapsed" id="compras">
							<ul class="nav list-group">
								<li><a href="#" value="servicos_list">Produtos</a></li>
								<li class="active"><a href="#"  value="artigos_list">Clientes<span class="sr-only">(current)</span></a></li>
								</ul>
						</div>
					</div>

          <div class="panel panel-primary config" style="display:none">
						<div class="panel-heading" data-toggle="collapse" data-target="#config">
							<h3 class="panel-title">
								<span class="fa fa-user"></span>
								Configurações</h3>
						</div>
						<div class="panel-body collapse in" id="config">
							<ul class="nav list-group">
								<li><a href="#" value="empresa">Empresa</a></li>
								<li><a href="#" value="usuarios">Usuarios</a></li>
								<li><a href="#" value="perfis">Personalizar</a></li>
								<li><a href="#" value="sistema">Sistema</a></li>
								</ul>
						</div>
					</div>
        </div>
        <div class="col-md-10 main main-content" >

        </div>


      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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

    <!-- Charts -->
    <script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.min.js"></script>             	<!-- Flot Main File -->
    <script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.pie.min.js"></script>             <!-- Flot Pie Chart Plugin -->
    <script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.stack.min.js"></script>       	<!-- Flot Stacked Charts Plugin -->
    <script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.orderBars.min.js"></script>   	<!-- Flot Ordered Bars Plugin-->
    <script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.resize.min.js"></script>          <!-- Flot Responsive -->
    <script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.tooltip.min.js"></script> 		<!-- Flot Tooltips -->
    <script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.spline.js"></script> 				<!-- Flot Curved Lines -->

    <script type="text/javascript" src="assets/plugins/sparklines/jquery.sparklines.min.js"></script> 			 <!-- Sparkline -->

    <script type="text/javascript" src="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>       <!-- jVectorMap -->
    <script type="text/javascript" src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>   <!-- jVectorMap -->

    <script type="text/javascript" src="assets/plugins/switchery/switchery.js"></script>     					<!-- Switchery -->
    <script type="text/javascript" src="assets/plugins/easypiechart/jquery.easypiechart.js"></script>
    <script type="text/javascript" src="assets/plugins/fullcalendar/moment.min.js"></script> 		 			<!-- Moment.js Dependency -->
    <script type="text/javascript" src="assets/plugins/fullcalendar/fullcalendar.min.js"></script>   			<!-- Calendar Plugin -->

    <script type="text/javascript" src="assets/demo/demo-index.js"></script>

  </body>
</html>
