<?php require_once 'encabezadoClase.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<link rel="stylesheet" href="./css/sidebar-tarea.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>
<style>
    .tarea-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .tarea-card:hover {
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
        color: #fbbc05;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.9rem;
        font-weight: 600;
    }

    .card-body {
        margin-bottom: 15px;
        font-size: 1.4rem;
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

    .card-footer {
        text-align: right;
    }

    .btn-abrir {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        padding: 10px 18px;
        border-radius: 50px;
        font-weight: 500;
        color: white;
        background: linear-gradient(135deg, #fbbc05, #f28b00);
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .btn-abrir i {
        font-size: 1.2rem;
    }

    .btn-abrir:hover {
        transform: translateY(-2px) scale(1.05);
        background: linear-gradient(135deg, #f2a500, #d97c00);
    }
</style>

<!-- Reemplaza el container por este div personalizado -->
<div id="content" class="content-wrapper mt-5 pt-4">

    <h2>Descripción de Tarea</h2>

    <div class="main-layout">
        <!-- Columna principal (contenido) -->
        <div class="content-column">
            <div ng-repeat="tema in temas" class="">
                <!-- TAREAS -->
                <div ng-repeat="tarea in tema.tareas" class="contenido-preview" ng-show="tarea.id==id_buscartarea">
                    <div class="media">

                        <div class="tarea-card">
                            <div class="card-header">
                                <i class="glyphicon glyphicon-edit icono-grande text-warning"></i>
                                <h3>{{ tarea.titulo }}</h3>
                            </div>
                            <div class="card-body">
                                <p style="display: flex; justify-content: space-between;">
                                    <span><strong>Valor:</strong> {{ tarea.valor }} puntos </span>
                                    <span><strong>Fecha Límite:</strong> {{ tarea.fecha_entrega | date:'mediumDate' }}</span>
                                </p>
                                <p style="display: flex; justify-content: space-between;">
                                    <span><strong>Publicado:</strong> {{ tarea.fecha | date:'mediumDate' }}</span>

                                </p>

                                <p></p>
                                <div ng-bind-html="tarea.descripcion"></div>
                                <!-- Archivos (tarea o material) -->
                                <div ng-if="tarea.archivos.length > 0">
                                    <strong>Archivos:</strong>
                                    <ul>
                                        <li ng-repeat="a in tarea.archivos">
                                            <a ng-href="../api/descargarArchivoTarea.php?id={{a.id}}" target="_blank" ng-click="$event.stopPropagation()">
                                                <i class="glyphicon glyphicon-file"></i> {{a.nombre}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Enlaces (tarea o material) -->
                                <div ng-if="tarea.enlaces.length > 0">
                                    <strong>Enlaces:</strong>
                                    <ul>
                                        <li ng-repeat="e in tarea.enlaces">
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
            <!-- Columna COMENTARIOS DE LA CLASE -->
            <!-- Panel de publicar comentario -->
            <div class="panel panel-success mb-3">
                <div class="panel-heading"><b>Comentario de la clase</b></div>
                <div class="panel-body">
                    <div id="editore"></div><br>
                    <button class="btn btn-success btn-md" ng-click="guardarTareaComentario()"><span class="glyphicon glyphicon-bullhorn"></span> Publicar Anuncio</button>
                </div>
            </div>

            <br>
            <!-- Lista de comentarios -->
            <div ng-repeat='c in tareacomentarios'>
                <div class="panel panel-success mb-3">
                    <div class="panel-heading">
                        <span class="pull-left"><b>{{c.nombre}} dijo:</b></span>
                        <span class="pull-right text-muted">
                            <button class="btn btn-danger btn-xs pull-center" ng-show={{c.id_usuario==usuario.id_usuario}} ng-click="eliminarTareaComentarios(c.id)">
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
        <!-- Columna derecha (Tu trabajo) -->
        <div class="sidebar-column">
            <div class="panel panel-success mb-5">
                <div class="panel-heading">
                    <b>Tu trabajo</b>
                </div>
                <div class="panel-body">
                    <!-- Sección de archivos -->
                    <div class="panel panel-default">
                        <div class="panel-heading bg-primary text-white">
                            <span class="glyphicon glyphicon-file"></span> Archivos
                        </div>
                        <div class="panel-body" ng-show="archivos.length > 0">
                            <ul class="list-group">
                                <li class="list-group-item" ng-repeat="a in archivos">
                                    <span class="glyphicon glyphicon-file"></span>
                                    <a href="{{a.url}}" target="_blank"> {{a.nombre}}</a>
                                    <button class="btn btn-danger btn-xs pull-right"
                                        ng-show="estadoEntrega !== 'entregada'"
                                        ng-click="eliminarArchivosM(a.id)">
                                        <span class="glyphicon glyphicon-trash"></span> Eliminar
                                    </button>


                                </li>
                            </ul>
                        </div>
                        <div class="panel-body text-center" ng-show="archivos.length == 0">
                            <em>No has subido ningún archivo aún.</em>
                        </div>
                    </div>

                    <!-- Botón de agregar o entregar -->
                    <div class="text-center mt-3">
                        <button type="button"
                            ng-click="accionBotonTarea()"
                            class="btn btn-primary btn-block">
                            <span class="glyphicon glyphicon-edit"></span>
                            {{ textoBotonTarea() }}
                        </button>
                    </div>


                </div>
            </div>
        </div>


    </div>


</div>


<!-- Modal archivoM-->
<div id="ModalArchivoM" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Subir Archivo</h4>
            </div>
            <div class="modal-body">
                <form ng-submit="guardarArchivoHistorial()" enctype="multipart/form-data">
                    <label>Seleccionar Archivo:</label>
                    <input type="file" uploader-model="documento" required> <br><br>
                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-cloud"></span> Subir archivo</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="ModalArchivoMClose" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- Termina Modal -->
</div>
</body>

</div>

<?php require_once 'pie.php'; ?>