<?php
ob_start();
require '../php_util/parametros.php';
require '../php_util/sesion.php';

session_start();
mValidarSesion();
mValidarTimeOut();

$fechaConsulta=date("Y-m-d");
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registro de Pedidos</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="../../css/custom.css">
<link rel="stylesheet" href="../../css/main.css">

</head>
<body> 
    <div class="wrapper" >
        <!-- menu --> 
        <?php include ("menu.php"); ?>   
    
    	<!-- Page Content  -->
        <div id="content">
            <!-- barra menu   -->
            <?php include ("menu_navbar.php"); ?>
            
            <!-- pagina  -->            
            <div class="container">        
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 ">
        						<h2>Administrar <b>Pedidos</b></h2>
        					</div>
        					<div hidden class="col-sm-6 ">
        						<a href="#addClienteModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Agregar nuevo pedido</span></a>
        					</div>
                        </div>
                    </div>
        			<div class='col-sm-4 pull-right'>
        				<div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="date" class="form-control" id="qfd" title="fecha consulta" onchange="consultar(1);" value="<?php echo $fechaConsulta;?>"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button" onclick="consultar(1);">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
        			</div>
        			<div class='clearfix'></div>
        			<hr>
        			<div id="loader"></div><!-- Carga de datos ajax aqui -->
        			<div id="resultados"></div><!-- Carga de datos ajax aqui -->
        			<div class='outer_div'></div><!-- Carga de datos ajax aqui -->		
                </div>
            </div> 
        </div>        
    </div>       
    
    <!-- Notificacion  -->
    <?php include ("menu_notificacion.php"); ?>
    
    <!-- Font Awesome JS -->
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script> -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
	<!-- jQuery CDN -->	
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<!-- jQuery personales -->    
    <script src="../../js/script_edit_pedidos.js"></script>
	<script src="../../js/script_pedidos.js"></script>
	<script src="../../js/main.js"></script>
</body>
</html>