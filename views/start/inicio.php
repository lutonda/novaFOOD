<?php
include_once("../../models/estatistica.php");
//include_once("../../models/adon.php");
include_once("../../models/system.php");
$sy=new system();
$es=new estatistica();
//$ad=new adon();
$em=$sy::verEmpresa();
$si=$sy::verSistema();
$total=0;
?>
<br>
<br>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Avenxo Admin Theme - shared on themelock.com</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="KaijuThemes">

    <link type='text/css' href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet'>

    <link type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        <!-- Font Awesome -->
    <link type="text/css" href="assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              <!-- Themify Icons -->
    <link type="text/css" href="assets/css/styles.css" rel="stylesheet">                                     <!-- Core CSS with all styles -->

    <link type="text/css" href="assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">   
		<link type="text/css" href="assets/css/clock.css" rel="stylesheet">
	<!-- iCheck -->

    <!--[if lt IE 10]>
        <script type="text/javascript" src="assets/js/media.match.min.js"></script>
        <script type="text/javascript" src="assets/js/respond.min.js"></script>
        <script type="text/javascript" src="assets/js/placeholder.min.js"></script>
    <![endif]-->
    <!-- The following CSS are included as plugins and can be removed if unused-->

<link type="text/css" href="assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet"> 						<!-- FullCalendar -->
<link type="text/css" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"> 			<!-- jVectorMap -->
<link type="text/css" href="assets/plugins/switchery/switchery.css" rel="stylesheet">   							<!-- Switchery -->

    </head>

    <body class="animated-content">
        <div id="wrapper">
            <div id="layout-static">

                <div class="static-content-wrapper">
                    <div class="static-content">
                        <div class="page-content">
                            <br>
                            <div class="container-fluid">

<div class="row">
	<div class="col-md-6" id="clock">
		<div class="panel panel-info" data-widget='{"id" : "wiget9", "draggable": "true"}'>
				
				<div class="container panel-body">
					<div class="clock">
					<div id="Date">Tuesday 5 April 2016</div>

					<ul>
						<li id="hours">23</li>
							<li id="point">:</li>
							<li id="min">24</li>
							<li id="point">:</li>
							<li id="sec">54</li>
					</ul>

					</div></div>
		</div></div></div>
<div class="row">
	<div class="col-md-3">
		<div class="info-tile tile-orange">
			<div class="tile-icon"><i class="ti ti-shopping-cart-full"></i></div>
			<div class="tile-heading"><span>VENDAS</span></div>
			<div class="tile-body"><span>
      <?=$es::contar("vendas")?></span></div>
			<div class="tile-footer"><span class="text-success"><?=$es::contar("vendas")*100/700000?>% <i class="fa fa-level-up"></i></span></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="info-tile tile-success">
			<div class="tile-icon"><i class="ti ti-bar-chart"></i></div>
			<div class="tile-heading"><span>COMPRAS</span></div>
			<div class="tile-body"><span>
      <?=$es::contar("stock")?></span></div>
			<div class="tile-footer"><span class="text-danger"><?=$es::contar("stock")*100/700000?>% <i class="fa fa-level-down"></i></span></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="info-tile tile-info">
			<div class="tile-icon"><i class="ti ti-stats-up"></i></div>
			<div class="tile-heading"><span>serviços</span></div>
			<div class="tile-body"><span>
      <?=$es::contar("servicos")?></span></div>
			<div class="tile-footer"><span class="text-success"><?=$es::contar("servicos")*100/700000?>% <i class="fa fa-level-up"></i></span></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="info-tile tile-danger">
			<div class="tile-icon"><i class="ti ti-bar-chart-alt"></i></div>
			<div class="tile-heading"><span>ARTIGOS</span></div>
			<div class="tile-body"><span>
      <?=$es::contar("artigos")?></span></div>
			<div class="tile-footer"><span class="text-danger"><?=$es::contar("artigos")*100/7000000?>% <i class="fa fa-level-down"></i></span></div>
		</div>
	</div>
</div>

<div data-widget-group="group1">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-info" data-widget='{"id" : "wiget9", "draggable": "true"}'>
				<div class="panel-heading">
					<h2>VENDAS</h2>
					<div class="panel-ctrls button-icon-bg"
						data-actions-container=""
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-editbox" data-widget-controls=""></div>
				<div class="panel-body">
					<div id="socialstats" style="height: 272px;" class="mt-sm mb-sm"></div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-bluegray" data-widget='{"draggable": "true"}'>
				<div class="panel-heading">
					<h2>Progresso</h2>
					<div class="panel-ctrls button-icon-bg"
						data-actions-container=""
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body">
					<div id="earnings" style="height: 272px;" class="mt-sm mb-sm"></div>
				</div>
			</div>
		</div>

	</div>


	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-midnightblue widget-progress" data-widget='{"draggable": "true"}'>
                <div class="panel-heading">
                    <h2>BASE de dados</h2>
                    <div class="panel-ctrls button-icon-bg"
						data-actions-container=""
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
                </div>
                <div class="panel-body">
					<div class="easypiechart mb-md" id="progress" data-percent="<?=($es::contar_full())*100/(700000000)?>">
						<span class="percent-non"></span>
					</div>
                </div>
                <div class="panel-footer">
					<div class="tabular">
						<div class="tabular-row">
							<div class="tabular-cell">
								<span class="status-total">Total</span>
								<span class="status-value">700.000k</span>
							</div>
							<div class="tabular-cell">
								<span class="status-pending">Usado</span>
								<span class="status-value"><?=($es::contar_full())?></span>
							</div>
						</div>
					</div>
				</div>
            </div>

			<div class="widget-weather">
				<div class="pull-left">
					<span class="weather-location">Luanda, AO</span>
					<span class="weather-desc"></span>
				</div>
				<div class="pull-right">
					<span class="weather-temp"><?=rand(19,25)?><span>ºC</span></span>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2>Storage</h2>
					<div class="panel-ctrls button-icon-bg"
						data-actions-container=""
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="spark-container mb-xl">
								<div class="pull-left">
									<h2 class="title" style="color: #cddc39">Pageviews</h2>
									<h3 class="number">19,600</h3>
								</div>
								<div class="pull-right">
									<h2 class="title" style="color: #ff5722; text-align: right;">Sessions</h2>
									<h3 class="number">1,200</h3>
								</div>

								<div class="spark-pageviews"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div id="newvsreturning" style="height: 144px" class="mt-md mb-md"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="spark-container">
								<h2 class="title">Users</h2>
								<h3 class="number">700</h3>
								<div class="spark-users"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="spark-container">
								<h2 class="title">Avg. Duration</h2>
								<h3 class="number">00:04:36</h3>
								<div class="spark-avgduration"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="spark-container">
								<h2 class="title">Page/Session</h2>
								<h3 class="number">4.20</h3>
								<div class="spark-pagesession"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="spark-container">
								<h2 class="title">Bounce Rate</h2>
								<h3 class="number">52.10%</h3>
								<div class="spark-bouncerate"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-teal" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2>DADOS</h2>
					<div class="panel-ctrls button-icon-bg"
						data-actions-container=""
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body no-padding">
					<table class="table browsers m-n">
						<tbody>
              <tr>
								<td>Vendas</td>
								<td class="text-right">43.7%</td>
								<td class="vam" style="width: 56px;">
									<div class="progress m-n">
	                                  <div class="progress-bar progress-bar-teal" style="width: 100%"></div>
	                                </div>
	                            </td>
							</tr>
              <tr>
								<td>Compras</td>
								<td class="text-right">43.7%</td>
								<td class="vam" style="width: 56px;">
									<div class="progress m-n">
	                                  <div class="progress-bar progress-bar-teal" style="width: 100%"></div>
	                                </div>
	                            </td>
							</tr>
							<tr>
								<td>Artigos</td>
								<td class="text-right">20.5%</td>
								<td class="vam">
									<div class="progress m-n">
	                                  <div class="progress-bar progress-bar-teal" style="width: 50%"></div>
	                                </div>
	                            </td>
							</tr>
							<tr>
								<td>Serviços</td>
								<td class="text-right">14.6%</td>
								<td class="vam">
									<div class="progress m-n">
	                                  <div class="progress-bar progress-bar-teal" style="width: 40%"></div>
	                                </div>
	                            </td>
							</tr>
							<tr>
								<td>Clientes</td>
								<td class="text-right">9.1%</td>
								<td class="vam">
									<div class="progress m-n">
	                                  <div class="progress-bar progress-bar-teal" style="width: 25%"></div>
	                                </div>
	                            </td>
							</tr>
							<tr>
								<td>Stock</td>
								<td class="text-right">5.3%</td>
								<td class="vam">
									<div class="progress m-n">
	                                  <div class="progress-bar progress-bar-teal" style="width: 12.5%"></div>
	                                </div>
	                            </td>
							</tr>
							<tr>
								<td>Usuarios</td>
								<td class="text-right">2.9%</td>
								<td class="vam">
									<div class="progress m-n">
	                                  <div class="progress-bar progress-bar-teal" style="width: 9%"></div>
	                                </div>
	                            </td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-realtime" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <h2>Servidor</h2>
                    <div class="panel-ctrls mr-n">
                    	<div class="mt-md mb-md">
                    		<input type="checkbox" class="js-switch-success switchery-xs" checked />
						</div>
                    </div>
                </div>
                <div class="panel-body">
                	<span class="rightnow">-</span>
					<span class="number"><?=$es::contar("utilizador")?></span>
					<span class="activeuser">Usuarios Activos</span>
                    <div id="realtime-updates" style="height: 112px" class="centered"></div>
                </div>
            </div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-white" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <h2>Mapa Mundo</h2>
                    <div class="panel-ctrls button-icon-bg"
						data-actions-container=""
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
                </div>
                <div class="panel-body">
					<div id="worldmap" style="height: 272px; width: 100%;" class="mt-sm mb-sm"></div>
                </div>
            </div>
		</div>

	</div>

</div>

                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>
                </div>
            </div>
        </div>


    <!-- Switcher -->

<!-- /Switcher -->
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
<script src="assets/js/jquery.clock.js" type="text/javascript"></script>
							
							<!-- Initialize scripts for this page-->
<script type="text/javascript">
  $(document).ready(function(){
          //compras e vendas
          // Visitor Stats
        function randValue() {
            return (Math.floor(Math.random() * (2)));
        }
        var fans = [<?php
					$max=100;
					for($i=1;$i<13;$i++){
                        echo '['.$i.', '.$es::contar_venda($i).']';               
                        if($i!=12){echo ',';}
												if($max<$es::contar_venda($i)){$max=$es::contar_venda($i);}
                    }?>];
				
        var followers = [<?php
					for($i=1;$i<13;$i++){
                        echo '['.$i.', '.$es::contar_compra($i).']';               
                        if($i!=12){echo ',';}
												if($max<$es::contar_compra($i)){$max=$es::contar_compra($i);}
                    }?>];

        var plot = $.plot($("#socialstats"),
            [{ data: fans, label: "Vendas" },
             { data: followers, label: "Compras" }], {
                series: {

                    shadowSize: 1,
                    lines: {
                        show: false,
                        lineWidth: 0
                    },
                    points: { show: true },
                    splines: {
                        show: true,
                        fill: 0.08,
                        tension: 0.3, // float between 0 and 1, defaults to 0.5
                        lineWidth: 2 // number, defaults to 2
                    },
                },
                grid: {
                    labelMargin: 8,
                    hoverable: true,
                    clickable: true,
                    borderWidth: 0,
                    borderColor: '#fafafa'
                },
                legend: {
                    backgroundColor: '#fff',
                    margin: 8
                },
                yaxis: {
                    min: 0,
                    max: <?=$max+10?>,
                    tickColor: '#fafafa',
                    font: {color: '#bdbdbd', size: 12},
                    // tickFormatter: function (val, axis) {
                    //     if (val>999) {return (val/1000) + "K";} else {return val;}
                    // }
                },
                xaxis: {
                    tickColor: 'transparent',
                    tickDecimals: 0,
                    font: {color: '#bdbdbd', size: 12}
                },
                colors: ['#9fa8da', '#80deea'],
                tooltip: true,
                tooltipOpts: {
                    content: "Mes: %x, QTD: %y"
                }
            });
		
		
    // Earnings Stats


        var d1 = [
					<?php
					for($i=1;$i<12;$i++){
                        echo '['.$i.', '.($es::contar_venda($i)/20).']';               
                        if($i!=12){echo ',';}
												if($max<$es::contar_venda($i)){$max=$es::contar_venda($i);}
                    }?>
            
        ];
        var d2 = [
					<?php
					for($i=1;$i<12;$i++){
                        echo '['.$i.', '.($es::contar_compra($i)/20).']';               
                        if($i!=12){echo ',';}
												if($max<$es::contar_compra($i)){$max=$es::contar_compra($i);}
                    }?>
            
        ];
        var d3 = [
            [1, 0.35],
            [2, 1.75],
            [3, 0.15],
            [4, 0.75],
            [5, 0.15],
            [6, 0.7],
            [7, 1.5]
        ];

        var ds = new Array();

        ds.push({
        data:d1,
        label: "Vendas",
        bars: {
            show: true,
            barWidth: 0.12,
            order: 1
        }
        });
        ds.push({
            data:d2,
            label: "Compras",
            bars: {
                show: true,
                barWidth: 0.12,
                order: 2
            }
        });
        ds.push({
            data:d3,
            label: "Referrals",
            bars: {
                show: true,
                barWidth: 0.12,
                order: 3
            }
        });

        var variance = $.plot($("#earnings"), ds, {
            series: {
                bars: {
                    show: true,
                    fill: 0.5,
                    lineWidth: 2
                }
            },
            grid: {
                labelMargin: 8,
                hoverable: true,
                clickable: true,
                tickColor: "#fafafa",
                borderWidth: 0
            },
            colors: ["#cfd8dc", "#78909c", "#ff5722"],
            xaxis: {
                autoscaleMargin: 0.08,
                tickColor: "transparent",
                ticks: [[1, "1"], [2, "2"], [3, "3"], [4, "4"],[5, "5"],[6, "6"],[7, "7"],[8, "8"],[9, "9"], [10, "10"],[11,"11"],[12, "12"]],
                tickDecimals: 0,
                font: {
                    color: '#bdbdbd',
                    size: 12
                }
            },
            yaxis: {
                ticks: [0, 1, 2, 3, 4, 5, , 6, 7, 8],
                font: {
                    color: '#bdbdbd',
                    size: 12
                },
                tickFormatter: function (val, axis) {
                    return "$" + val + "K";
                }
            },
            legend : {
                backgroundColor: '#fff',
                margin: 8
            },
            tooltip: true,
            tooltipOpts: {
                content: "x: %x, y: %y"
            }
        });

  })
</script>
    <!-- End loading page level scripts-->

    </body>
</html>


