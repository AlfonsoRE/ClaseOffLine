<?php require_once 'encabezadoEdit.php'; ?>
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
                <div ng-repeat="mat in tema.material" class="contenido-preview" ng-click="mat.id==id_buscarmaterial">
                    <div class="media">

                        <div class="material-card" ng-repeat="mat in tema.material">
                            <div class="card-header">
                                <i class="glyphicon glyphicon-book icono-grande text-success"></i>
                                <h3>{{ mat.titulo }} <span>
                                        <button class="btn btn-xs btn-warning" ng-click="$event.stopPropagation(); abrirModalEditarMaterial(mat)">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                        <button class="btn btn-xs btn-danger" ng-click="$event.stopPropagation(); eliminarMaterial(mat)">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                    </span></h3>

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

</div>
<!-- Modal Agregar Material-->
<div id="modalAgregarMaterial" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"> <span class="glyphicon glyphicon-edit"></span> Modulo Material</h4>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <form class="form-horizontal">
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Tema: </label>
                                <div class="col-sm-10">
                                    <select ng-model="nuevoMaterial.id_tema" ng-options="tema.id as tema.titulo for tema in temas" class="form-control">
                                        <option value="">Seleccione un tema</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Título: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" ng-model="nuevoMaterial.titulo" placeholder="Título" required>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">
                                <div class="col-sm-12 "><b> Descripción del Material:</b> </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div id="editorM"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="btn-group col-sm-12">
                                    <button type="button" class="btn btn-primary" ng-click="subirArchivoM()"><span class="glyphicon glyphicon-cloud"></span> Subir archivo</button>
                                    <button type="button" class="btn btn-primary" ng-click="agregarEnlaceM()"><span class="glyphicon glyphicon-link"></span> Agregar enlace</button>
                                </div>
                            </div>
                </form>

                <div class="container-fluid">

                    <!-- Sección de Archivos -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading bg-primary text-white">
                                    <span class="glyphicon glyphicon-file"></span> Archivos
                                </div>
                                <div class="panel-body" ng-show='archivos.length>0'>
                                    <ul class="list-group">
                                        <div ng-repeat='a in archivos'>
                                            <li class="list-group-item">
                                                <span class="glyphicon glyphicon-file"></span>
                                                <a href="{{a.url}}" target="_blank"> {{a.nombre}}</a>
                                                <button class="btn btn-danger btn-xs pull-right" ng-click="eliminarArchivoM(a.id)">
                                                    <span class="glyphicon glyphicon-trash"></span> Eliminar
                                                </button>
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de URLs -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading bg-success text-white">
                                    <span class="glyphicon glyphicon-link"></span> Enlaces Externos
                                </div>
                                <div class="panel-body" ng-show='enlaces.length>0'>
                                    <ul class="list-group">
                                        <div ng-repeat='e in enlaces'>
                                            <li class="list-group-item">
                                                <span class="glyphicon glyphicon-link"></span>
                                                <a href="{{e.enlace}}" target="_blank"> Enlace {{$index+1}}</a>
                                                <button class="btn btn-danger btn-xs pull-right" ng-click="eliminarEnlaceM(e.id)">
                                                    <span class="glyphicon glyphicon-trash"></span> Eliminar
                                                </button>
                                            </li>
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
    <div class="modal-footer">
        <button class="btn btn-success" ng-click="guardarMaterial()"> <span class="glyphicon glyphicon-bullhorn"></span> Publicar Material</button>
        <button class="btn btn-secondary" data-dismiss="modal" id="ModalMaterialClose">Cerrar</button>
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
                <form ng-submit="guardarArchivoM()" enctype="multipart/form-data">

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

<!-- Modal enlaceM-->
<div id="ModalEnlaceM" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar enlace</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" name="formenlace">
                    <div class="form-group"> <label class="col-sm-4 control-label"> Enlace: </label>
                        <div class="col-sm-7"> <input type="text" class="form-control" name="enlace"
                                ng-model="enlace.enlace" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-7">
                            <button type="submit" value="enviar" ng-click="formenlace.$valid && guardarEnlaceM()"
                                class="btn btn-primary">
                                <span class="glyphicon glyphicon-link"></span> Agregar enlace</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="ModalEnlaceMClose" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
</div>
</body>

</div>
<!-- Termina Modal -->
<?php require_once 'pie.php'; ?>