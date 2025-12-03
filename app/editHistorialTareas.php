<?php require_once 'encabezadoEdit.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<link rel="stylesheet" href="./css/sidebar-tarea.css">
<link rel="stylesheet" href="./css/editHistorialTarea.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>


<div id="content" class="content-wrapper mt-5 pt-4">

    <h2>Descripción de Tarea</h2>

    <div class="main-layout">
        <!-- Columna principal -->
        <div class="content-column">
            <div ng-repeat="tema in temas">
                <div ng-repeat="tarea in tema.tareas" class="contenido-preview" ng-show="tarea.id==id_buscartarea">
                    <div class="media">
                        <div class="tarea-card">
                            <div class="card-header">
                                <i class="glyphicon glyphicon-edit icono-grande text-warning"></i>
                                <h3>{{ tarea.titulo }}</h3>
                                <span>
                                    <button class="btn btn-xs btn-warning" ng-click="$event.stopPropagation(); abrirModalEditarTarea(tarea)">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </button>
                                    <button class="btn btn-xs btn-danger" ng-click="$event.stopPropagation(); eliminarTarea(tarea)">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="card-body">
                                <p style="display: flex; justify-content: space-between;">
                                    <span><strong>Valor:</strong> {{ tarea.valor }} puntos </span>
                                    <span><strong>Fecha Límite:</strong> {{ tarea.fecha_entrega | date:'mediumDate' }}</span>
                                </p>
                                <p style="display: flex; justify-content: space-between;">
                                    <span><strong>Publicado:</strong> {{ tarea.fecha | date:'mediumDate' }}</span>
                                </p>
                                <div ng-bind-html="tarea.descripcion"></div>

                                <!-- Archivos -->
                                <div ng-if="tarea.archivos.length > 0">
                                    <strong>Archivos:</strong>
                                    <ul>
                                        <li ng-repeat="a in tarea.archivos">
                                            <a ng-href="../api/descargarArchivoTarea.php?id={{a.id}}" target="_blank">
                                                <i class="glyphicon glyphicon-file"></i> {{a.nombre}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Enlaces -->
                                <div ng-if="tarea.enlaces.length > 0">
                                    <strong>Enlaces:</strong>
                                    <ul>
                                        <li ng-repeat="e in tarea.enlaces">
                                            <a ng-href="{{e.enlace}}" target="_blank">
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

            <!-- Comentarios -->
            <div class="panel panel-success mb-3">
                <div class="panel-heading"><b>Comentario de la clase</b></div>
                <div class="panel-body">
                    <div id="editore"></div><br>
                    <button class="btn btn-success btn-md" ng-click="guardarTareaComentario()"><span class="glyphicon glyphicon-bullhorn"></span> Publicar Anuncio</button>
                </div>
            </div>

            <div ng-repeat='c in tareacomentarios'>
                <div class="panel panel-success mb-3">
                    <div class="panel-heading">
                        <span class="pull-left"><b>{{c.nombre}} dijo:</b></span>
                        <span class="pull-right text-muted">
                            <button class="btn btn-danger btn-xs pull-center" ng-show={{c.id_usuario==usuario.id_usuario}} ng-click="eliminarAnuncioComentario(c.id)">
                                <span class="glyphicon glyphicon-trash"></span></button>
                            <div class="clearfix"></div>
                        </span>
                        <div style="flex-grow: 1; text-align: center;">
                            {{tiempoTranscurridoComentario(c.fecha_comentario)}}
                        </div>
                    </div>
                    <div class="panel-body">
                        <div ng-bind-html="c.comentario"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna derecha — Entregas -->
        <div class="sidebar-column classroom-sidebar">
            <div class="panel entregas-panel">
                <div class="panel-heading entregas-heading">
                    <b>📚 Entregas de los alumnos</b>
                </div>
                <div class="panel-body entregas-body">

                    <table class="table table-hover entregas-tabla" ng-show="historialTareas.length > 0">
                        <thead>
                            <tr>
                                <th style="width:35%;">Alumno</th>
                                <th style="width:45%;">Archivo</th>
                                <th style="width:20%;">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="h in historialTareas">
                                <td class="alumno-nombre">
                            
                                    {{h.nombre_usuario}}
                                </td>

                                <td>
                                    <a ng-href="{{h.url}}" target="_blank" class="archivo-link">
                                    
                                        {{h.nombre_archivo}}
                                    </a>
                                </td>

                                <td class="fecha-entrega">
                                    <i class="glyphicon glyphicon-time icon-time"></i>
                                    {{h.fecha | date:'dd/MM/yyyy HH:mm'}}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="sin-entregas" ng-show="historialTareas.length == 0">
                        Ningún alumno ha enviado entregas aún.
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'pie.php'; ?>
