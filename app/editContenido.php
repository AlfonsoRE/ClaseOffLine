<?php require_once 'encabezadoEdit.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>

<div id="content" class="container mt-5 pt-4">
  <h2>Contenido</h2>

  <div class="dropdown my-3">
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAgregarTema">
      <span class="glyphicon glyphicon-list"></span> Tema
    </button>
    <button type="button" class="btn btn-primary btn-lg" ng-click="abrirModalTarea()">
      <span class="glyphicon glyphicon-edit"></span> Tarea
    </button>
    <button type="button" class="btn btn-primary btn-lg" ng-click="abrirModalMaterial()">
      <span class="glyphicon glyphicon-book"></span> Material
    </button>
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAgregarCuestionario">
      <span class="glyphicon glyphicon-certificate"></span> Cuestionario
    </button>
  </div>
  <br><br>

  <div class="row">
    <div ng-repeat="tema in temas | orderBy:'id':false" class="tema-block">

      <h4 style="display: flex; justify-content: space-between; align-items: center;">
        <strong><span class="glyphicon glyphicon-list"></span> {{tema.titulo }}</strong>
        <span>
          <button class="btn btn-xs btn-warning" ng-click="abrirModalEditarTema(tema)">
            <i class="glyphicon glyphicon-pencil"></i>
          </button>
          <button class="btn btn-xs btn-danger" ng-click="eliminarTema(tema)">
            <i class="glyphicon glyphicon-trash"></i>
          </button>
        </span>
      </h4>

      <!-- TAREAS -->
      <div ng-repeat="tarea in tema.tareas | orderBy:'id':false" class="contenido-preview" ng-click="tarea.abierto = !tarea.abierto">
        <div class="media">
          <div class="media-left">
            <i class="glyphicon glyphicon-edit icono-grande text-warning"></i>
          </div>
          <div class="media-body">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <strong>{{ tarea.titulo }}</strong>
              <span>
                <button class="btn btn-xs btn-warning" ng-click="$event.stopPropagation(); abrirModalEditarTarea(tarea)">
                  <i class="glyphicon glyphicon-pencil"></i>
                </button>
                <button class="btn btn-xs btn-danger" ng-click="$event.stopPropagation(); eliminarTarea(tarea)">
                  <i class="glyphicon glyphicon-trash"></i>
                </button>
              </span>
            </div>
            <div ng-show="tarea.abierto" class="contenido-detalle">
              <p>
              <div ng-bind-html="tarea.descripcion"></div>
              </p>
              <p><strong>Valor:</strong> {{ tarea.valor }}</p>
              <p><strong>Fecha de entrega:</strong> {{ tarea.fecha_entrega | date:'mediumDate' }}</p>
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
              <a href="./editHistorialTareas.php?id_clase={{clase.id}}&id_tarea={{tarea.id}}"> Ver instrucciones </a>
            </div>
          </div>
        </div>
      </div>

      <!-- MATERIALES -->
      <div ng-repeat="mat in tema.material | orderBy:'id':false" class="contenido-preview" ng-click="mat.abierto = !mat.abierto">
        <div class="media">
          <div class="media-left">
            <i class="glyphicon glyphicon-book icono-grande text-success"></i>
          </div>
          <div class="media-body">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <strong>{{ mat.titulo }}</strong>
              <span>
                <button class="btn btn-xs btn-warning" ng-click="$event.stopPropagation(); abrirModalEditarMaterial(mat)">
                  <i class="glyphicon glyphicon-pencil"></i>
                </button>
                <button class="btn btn-xs btn-danger" ng-click="$event.stopPropagation(); eliminarMaterial(mat)">
                  <i class="glyphicon glyphicon-trash"></i>
                </button>
              </span>
            </div>

            <div ng-show="mat.abierto" class="contenido-detalle">
              <p>
              <div ng-bind-html="mat.descripcion"></div>
              </p>
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
              <a href="./editMaterialContenido.php?id_clase={{clase.id}}&id_material={{mat.id}}"> Ver instrucciones </a>
            </div>
          </div>
        </div>
      </div>

      <!-- CUESTIONARIOS -->
      <div ng-repeat="cues in tema.cuestionarios | orderBy:'id':false" class="contenido-preview" ng-click="cues.abierto = !cues.abierto">
        <div class="media">
          <div class="media-left">
            <i class="glyphicon glyphicon-certificate icono-grande text-primary"></i>
          </div>
          <div class="media-body">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <strong>{{ cues.titulo }}</strong>
              <span>
                <button class="btn btn-xs btn-warning" ng-click="$event.stopPropagation(); editarCuestionario(cues)">
                  <i class="glyphicon glyphicon-pencil"></i>
                </button>
                <button class="btn btn-xs btn-danger" ng-click="$event.stopPropagation(); eliminarCuestionario(cues)">
                  <i class="glyphicon glyphicon-trash"></i>
                </button>
              </span>
            </div>

            <div ng-show="cues.abierto" class="contenido-detalle">
              <p>
              <div ng-bind-html="cues.descripcion"></div>
              </p>
              <p><strong>Fecha creación:</strong> {{ cues.fecha_creacion | date:'mediumDate' }}</p>
            </div>
          </div>
        </div>
      </div>

      <hr>
    </div>

  </div>


  <!-- Modal para editar tema -->
  <div class="modal fade" id="modalEditarTema" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Tema</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form name="formEditarTema">
            <div class="form-group">
              <label for="titulo">Título</label>
              <input id="titulo" type="text" class="form-control" ng-model="temaEditar.titulo" required>
              <input type="hidden" name="id" ng-model="temaEditar.id">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="guardarEdicionTema()">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para editar material -->

  <!-- Modal para editar tarea -->

  <!-- Modal para editar cuestionario -->


  <!-- Modal Agregar Tema-->
  <div id="modalAgregarTema" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title"> <span class="glyphicon glyphicon-list"></span> Agregar Tema</h4>
        </div>
        <div class="modal-body">
          <form ng-submit="guardarTema()">
            <label for="titulo">Título del Tema</label>
            <input type="text" class="form-control" ng-model="nuevoTema.titulo" placeholder="Título del Tema" required />
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" ng-click="guardarTema()">Guardar</button>
          <button class="btn btn-secondary" data-dismiss="modal" id="ModalTemaClose">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Agregar Tarea-->
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

                <div class="form-group">
                  <label class="col-sm-2 control-label"> Tema: </label>
                  <div class="col-sm-10">
                    <select ng-model="nuevaTarea.id_tema" ng-options="tema.id as tema.titulo for tema in temas" class="form-control">
                      <option value="">Seleccione un tema</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"> Título: </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" ng-model="nuevaTarea.titulo" placeholder="Título" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"> Valor: </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" ng-model="nuevaTarea.valor" placeholder="Valor">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"> Fecha de Entrega: </label>
                  <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" ng-model="nuevaTarea.fecha_entrega">
                  </div>
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
                  <div class="btn-group col-sm-12">
                    <button type="button" class="btn btn-primary" ng-click="subirArchivoT()"><span class="glyphicon glyphicon-cloud"></span> Subir archivo</button>
                    <button type="button" class="btn btn-primary" ng-click="agregarEnlaceT()"><span class="glyphicon glyphicon-link"></span> Agregar enlace</button>
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
                          <button class="btn btn-danger btn-xs pull-right" ng-click="eliminarArchivoT(a.id)">
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
                          <button class="btn btn-danger btn-xs pull-right" ng-click="eliminarEnlaceT(e.id)">
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
      <button class="btn btn-success" ng-click="guardarTarea()"> <span class="glyphicon glyphicon-bullhorn"></span> Publicar Tarea</button>
      <button class="btn btn-secondary" data-dismiss="modal" id="ModalTareaClose">Cerrar</button>
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

<!-- Modal Agregar Cuestionario-->
<div id="modalAgregarCuestionario" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Agregar Cuestionario</h4>
      </div>
      <div class="modal-body">
        <form ng-submit="guardarCuestionario()">
          <label for="titulo">ID Tema</label>
          <select ng-model="nuevoCuestionario.id_tema"
            ng-options="tema.id as tema.titulo for tema in temas"
            class="form-control">
            <option value="">Seleccione un tema</option>
          </select>
          <br>
          <label for="titulo">Título</label>
          <input type="text" class="form-control" ng-model="nuevoCuestionario.titulo" placeholder="Título" required />
          <br>
          <label for="titulo">Descripción</label>
          <div id="editorC"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" ng-click="guardarCuestionario()">Guardar</button>
        <button class="btn btn-secondary" data-dismiss="modal" id="ModalCuestionarioClose">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal archivo-->
<div id="ModalArchivo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Subir Archivo</h4>
      </div>

      <div class="modal-body">
        <form ng-submit="guardarArchivoT()" enctype="multipart/form-data">

          <label>Seleccionar Archivo:</label>
          <input type="file" uploader-model="documento" required> <br><br>

          <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-cloud"></span> Subir archivo</button>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" id="ModalArchivoClose" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Termina Modal -->

<!-- Modal enlace-->
<div id="ModalEnlace" class="modal fade" role="dialog">
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
              <button type="submit" value="enviar" ng-click="formenlace.$valid && guardarEnlaceT()"
                class="btn btn-primary">
                <span class="glyphicon glyphicon-link"></span> Agregar enlace</button>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" id="ModalEnlaceClose" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Termina Modal -->

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
<!-- Termina Modal -->
</div>
</body>

</div>
<?php require_once 'pie.php'; ?>