<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ClaseOffLine</title>
    <!-- Bootstrap -->
    <link rel="icon" type="image/png" href="./img/ITSAV.png" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/sidebar.css">

    <script src="./controlador/jquery.min.js"></script>
    <script src="./controlador/bootstrap.min.js"></script>
    <script src="./controlador/angular.min.js"></script>
    <script src="./controlador/angular-sanitize.min.js"></script>
    <script src="./controlador/clase.js"></script>

</head>

<div ng-controller="claseCtrl">

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
                        <li> <a href="./claseAnuncio.php?id_clase={{clase.id}}">{{ clase.materia.length > 40 ? (clase.materia | limitTo:40) + '...' : clase.materia }}</a></li>
                        <li><a href="./claseAnuncio.php?id_clase={{clase.id}}">Anuncios</a></li>
                        <li><a href="./claseContenido.php?id_clase={{clase.id}}">Contenido</a></li>
                        <li><a href="./claseAlumnos.php?id_clase={{clase.id}}">Alumnos</a></li>
                        <li><a href="./claseCalificaciones.php?id_clase={{clase.id}}">Calificaciones</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href=""><?php session_start();
                                        echo  $_SESSION['usuario']; ?></a></li>
                        <li><a href="../api/salir.php">Salir</a></li>
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <body>
        <div id="lateral">
            <img src="./img/Escudo.png" />
            <div id="menu">

                <!-- Recuadro de "Clases inscritas" -->
                <div class="menu-container">
                    <ul>
                        <li class="menu-item">Clases inscritas</li>
                        <div class="submenu" ng-repeat='c in clasesInscritas'>
                            <li class="submenu-item"><a href="./claseAnuncio.php?id_clase={{c.id}}">{{c.materia}}</a></li>
                        </div>
                    </ul>
                </div>
                <hr>
                <!-- Recuadro de "Clases impartidas" -->
                <div class="menu-container">
                    <ul>
                        <li class="menu-item">Clases impartidas</li>
                        <div class="submenu" ng-repeat='c in clasesImpartidas'>
                            <li class="submenu-item"><a href="./editAnuncio.php?id_clase={{c.id}}">{{c.materia}}</a></li>
                        </div>
                    </ul>
                </div>

            </div>
        </div>
    </body>

    <input type="hidden" id="idUsuario" value="<?php echo $_SESSION['id']; ?>">