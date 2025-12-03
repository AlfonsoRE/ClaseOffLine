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

    <!-- Modal Agregar Tarea -->
    <div id="modalAgregarTarea" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title"> <span class="glyphicon glyphicon-edit"></span> Modulo Tarea</h4>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"> <label class="col-sm-2 control-label"> Tema: </label>
                                    <div class="col-sm-10"> <select ng-model="nuevaTarea.id_tema" ng-options="tema.id as tema.titulo for tema in temas" class="form-control">
                                            <option value="">Seleccione un tema</option>
                                        </select> </div>
                                </div>
                                <div class="form-group"> <label class="col-sm-2 control-label"> Título: </label>
                                    <div class="col-sm-10"> <input type="text" class="form-control" ng-model="nuevaTarea.titulo" placeholder="Título" required> </div>
                                </div>
                                <div class="form-group"> <label class="col-sm-2 control-label"> Valor: </label>
                                    <div class="col-sm-10"> <input type="text" class="form-control" ng-model="nuevaTarea.valor" placeholder="Valor"> </div>
                                </div>
                                <div class="form-group"> <label class="col-sm-2 control-label"> Fecha de Entrega: </label>
                                    <div class="col-sm-10"> <input type="datetime-local" class="form-control" ng-model="nuevaTarea.fecha_entrega"> </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-12 "><b> Descripción de la tarea:</b> </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div id="editor"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="btn-group col-sm-12"> <button type="button" class="btn btn-primary" ng-click="subirArchivoT()"><span class="glyphicon glyphicon-cloud"></span> Subir archivo</button> <button type="button" class="btn btn-primary" ng-click="agregarEnlaceT()"><span class="glyphicon glyphicon-link"></span> Agregar enlace</button> </div>
                                </div>
                    </form>
                    <div class="container-fluid"> <!-- Sección de Archivos -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading bg-primary text-white"> <span class="glyphicon glyphicon-file"></span> Archivos </div>
                                    <div class="panel-body" ng-show='archivos.length>0'>
                                        <ul class="list-group">
                                            <div ng-repeat='a in archivos'>
                                                <li class="list-group-item"> <span class="glyphicon glyphicon-file"></span> <a href="{{a.url}}" target="_blank"> {{a.nombre}}</a> <button class="btn btn-danger btn-xs pull-right" ng-click="eliminarArchivoT(a.id)"> <span class="glyphicon glyphicon-trash"></span> Eliminar </button> </li>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Sección de URLs -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading bg-success text-white"> <span class="glyphicon glyphicon-link"></span> Enlaces Externos </div>
                                    <div class="panel-body" ng-show='enlaces.length>0'>
                                        <ul class="list-group">
                                            <div ng-repeat='e in enlaces'>
                                                <li class="list-group-item"> <span class="glyphicon glyphicon-link"></span> <a href="{{e.enlace}}" target="_blank"> Enlace {{$index+1}}</a> <button class="btn btn-danger btn-xs pull-right" ng-click="eliminarEnlaceT(e.id)"> <span class="glyphicon glyphicon-trash"></span> Eliminar </button> </li>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer"> <button class="btn btn-success" ng-click="guardarTarea()"> <span class="glyphicon glyphicon-bullhorn"></span> Publicar Tarea</button> <button class="btn btn-secondary" data-dismiss="modal" id="ModalTareaClose">Cerrar</button> </div>
    </div>
</div>
</div>
</div> <!-- Modal archivo-->
<div id="ModalArchivo" class="modal fade" role="dialog">
    <div class="modal-dialog"> <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary"> <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Subir Archivo</h4>
            </div>
            <div class="modal-body">
                <form ng-submit="guardarArchivoT()" enctype="multipart/form-data"> <label>Seleccionar Archivo:</label> <input type="file" uploader-model="documento" required> <br><br> <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-cloud"></span> Subir archivo</button> </form>
            </div>
            <div class="modal-footer"> <button type="button" id="ModalArchivoClose" class="btn btn-default" data-dismiss="modal">Close</button> </div>
        </div>
    </div>
</div> <!-- Termina Modal --> <!-- Modal enlace -->
<div id="ModalEnlace" class="modal fade" role="dialog">
    <div class="modal-dialog"> <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary"> <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar enlace</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="formenlace">
                    <div class="form-group"> <label class="col-sm-4 control-label"> Enlace: </label>
                        <div class="col-sm-7"> <input type="text" class="form-control" name="enlace" ng-model="enlace.enlace" required> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-7"> <button type="submit" value="enviar" ng-click="formenlace.$valid && guardarEnlaceT()" class="btn btn-primary"> <span class="glyphicon glyphicon-link"></span> Agregar enlace</button> </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"> <button type="button" id="ModalEnlaceClose" class="btn btn-default" data-dismiss="modal">Close</button> </div>
        </div>
    </div>
</div> <!-- Termina Modal --> </div>
</body>
</div> <?php require_once 'pie.php'; ?>