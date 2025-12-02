<?php require_once 'encabezadoClase.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<link rel="stylesheet" href="./css/sidebar-tarea.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>
<style>
    .material-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .material-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }

    .card-header i {
        font-size: 28px;
        color: #34a853;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.9rem;
        font-weight: 600;
    }

    .card-body {
        margin-bottom: 15px;
        font-size: 1.5rem;
        color: #202124;
    }

    .card-body ul {
        margin: 5px 0 10px 20px;
        padding: 0;
    }

    .card-body li {
        margin-bottom: 5px;
    }

    .card-body a {
        text-decoration: none;
        color: #1a73e8;
        transition: color 0.2s;
    }

    .card-body a:hover {
        color: #0c5dc0;
    }
</style>
<!-- Reemplaza el container por este div personalizado -->
<div id="content" class="container">

    <h2>Descripción de Material</h2>
    <br>
    <div class="main-layout">
        <!-- Columna principal (contenido) -->
        <div class="content-column">
            <div ng-repeat="tema in temas" class="">
                <!-- TAREAS -->
                <div ng-repeat="mat in tema.material | filter:{id:id_buscarmaterial}" class="contenido-preview">
                    <div class="media">

                        <div class="material-card" >
                            <div class="card-header">
                                <i class="glyphicon glyphicon-book icono-grande text-success"></i>
                                <h3>{{ mat.titulo }}</h3>
                            </div>
                            <div class="card-body">
                                <div ng-bind-html="mat.descripcion"></div>
                                <!-- Archivos (tarea o material) -->
                                <div ng-if="mat.archivos.length > 0">
                                    <strong>Archivos:</strong>
                                    <ul>
                                        <li ng-repeat="a in mat.archivos">
                                            <a ng-href="../api/descargarArchivoMaterial.php?id={{a.id}}" target="_blank" ng-click="$event.stopPropagation()">
                                                <i class="glyphicon glyphicon-file"></i> {{a.nombre}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Enlaces (tarea o material) -->
                                <div ng-if="mat.enlaces.length > 0">
                                    <strong>Enlaces:</strong>
                                    <ul>
                                        <li ng-repeat="e in mat.enlaces">
                                            <a ng-href="{{e.enlace}}" target="_blank" ng-click="$event.stopPropagation()">
                                                <i class="glyphicon glyphicon-link"></i> {{e.enlace}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>