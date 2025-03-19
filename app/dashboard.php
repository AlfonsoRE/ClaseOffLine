<!DOCTYPE html>
<html lang="en"  ng-app="app">
<head>
 <meta http-equiv="Content-type" content="text/html; charset=utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>ClaseOffLine</title>
 <!-- Bootstrap -->
 <link rel="icon" type="image/png" href="./img/ITSAV.png" />
 <link rel="stylesheet" href="./css/bootstrap.min.css" > 
 <link rel="stylesheet" href="./css/sidebar.css">

 <script src="./controlador/jquery.min.js"></script>
 <script src="./controlador/bootstrap.min.js"></script>
 <script src="./controlador/angular.min.js"></script>
</head>

<header>
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>                        
     </button>  
     <IMG class="navbar-brand" SRC="./img/itsavblaent40.png"> </IMG>
     <a class="navbar-brand" href="./dashboard.php"> ClaseOffLine</a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
     
    <ul class="nav navbar-nav">
       <li><a href="">Agregar una clase</a></li>
       <li><a href="">Unirse a una clase</a></li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
       <li><a href=""><?php echo 'Alfonso Rosas Escobedo'; ?></a></li>
       <li><a href="../api/salir.php">Salir</a></li>
      </ul>
     
   </div>
   </div>
  </nav>
</header>
<script src="./controlador/dashboard.js"></script>
<body ng-controller="dashboardCtrl">

<div id="lateral">
    <img src="./img/Escudo.png" />
    <div id="menu">
        <!-- Recuadro de "Clases impartidas" -->
        <div class="menu-container">
            <ul>
                <li class="menu-item">Clases impartidas</li>
                <div class="submenu">
                    <li class="submenu-item"><a href="#">Programacion avanzada de tecnologias moviles</a></li>
                    <li class="submenu-item"><a href="#">Clase 2</a></li>
                </div>
            </ul>
        </div>

        <hr>

        <!-- Recuadro de "Clases inscritas" -->
        <div class="menu-container">
            <ul>
                <li class="menu-item">Clases inscritas</li>
                <div class="submenu">
                    <li class="submenu-item"><a href="#">Clase 3</a></li>
                    <li class="submenu-item"><a href="#">Clase 4</a></li>
                </div>
            </ul>
        </div>
    </div>
</div>

 <div id="content" class="container">
 
 <div class ="row">
  <div class="col-md-12">
    <h2>¡Bienvenido!</h2>
    </div>
  </div>
<br>
  <div class ="row">

    <div class="panel-group col-md-4">
    <div class="panel panel-success">
        <div class="panel-heading">Panel with panel-primary class</div>
        <div class="panel-body">Panel Content</div>
      </div>
    </div>

    <div class="panel-group col-md-4">
    <div class="panel panel-success">
        <div class="panel-heading">Panel with panel-primary class</div>
        <div class="panel-body">Panel Content</div>
      </div>
    </div>

    <div class="panel-group col-md-4">
    <div class="panel panel-success">
        <div class="panel-heading">Panel with panel-primary class</div>
        <div class="panel-body">Panel Content</div>
      </div>
    </div>

    <div class="panel-group col-md-4">
    <div class="panel panel-success">
        <div class="panel-heading">Panel with panel-primary class</div>
        <div class="panel-body">Panel Content</div>
      </div>
    </div>

  </div>

 </div>
</body>

<?php require_once 'pie.php'; ?>