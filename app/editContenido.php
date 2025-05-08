<?php require_once 'encabezadoEdit.php'; ?>
<script src="./controlador/angular-sanitize.min.js"></script>

<div id="content" class="container mt-5 pt-4">
  <h2>Contenido</h2>

  <div class="dropdown my-3">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalAgregarTema">
      Tema
    </button>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalAgregarTarea">
      Tarea
    </button>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalAgregarCuestionario">
      Cuestionario
    </button>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalAgregarMaterial">
      Material
    </button>
  </div>
</div>


<!-- Modal Agregar Tema-->
<div id="modalAgregarTema" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Agregar Tema</h4>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Agregar Tarea</h4>
      </div>
      <div class="modal-body">
        <form ng-submit="guardarTarea()">
          <label for="titulo">ID Tema</label>
          <input type="number" class="form-control" ng-model="nuevaTarea.id_tema" placeholder="ID Tema" />
          <br>
          <label for="titulo">Título</label>
          <input type="text" class="form-control" ng-model="nuevaTarea.titulo" placeholder="Título" />
          <br>
          <label for="titulo">Descripción</label>
          <textarea class="form-control" ng-model="nuevaTarea.descripcion" placeholder="Descripción"></textarea>
          <br>
          <label for="titulo">Valor</label>
          <input type="number" class="form-control" ng-model="nuevaTarea.valor" placeholder="Valor" />
          <br>
          <label for="titulo">Fecha de Entrega</label>
          <input type="date" class="form-control" ng-model="nuevaTarea.fecha_entrega" />
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" ng-click="guardarTarea()">Guardar</button>
        <button class="btn btn-secondary" data-dismiss="modal" id="ModalTareaClose">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Agregar Cuestionarios-->
<div id="modalAgregarCuestionario" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Agregar Cuestionario</h4>
      </div>
      <div class="modal-body">
        <form ng-submit="guardarCuestionario()">
          <label for="titulo">ID Tema</label>
          <input type="number" class="form-control" ng-model="nuevoCuestionario.id_tema" placeholder="ID Tema" />
          <br>
          <label for="titulo">Título</label>
          <input type="text" class="form-control" ng-model="nuevoCuestionario.titulo" placeholder="Título" required />
          <br>
          <label for="titulo">Descripción</label>
          <textarea class="form-control" ng-model="nuevoCuestionario.descripcion" placeholder="Descripción"></textarea>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" ng-click="guardarCuestionario()">Guardar</button>
        <button class="btn btn-secondary" data-dismiss="modal" id="ModalCuestionarioClose">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Agregar Material-->
<div id="modalAgregarMaterial" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Agregar Material</h4>
      </div>
      <div class="modal-body">
        <form>
          <label for="titulo">Título</label>
          <input type="text" class="form-control" ng-model="nuevoMaterial.titulo" placeholder="Título" />
          <br>
          <label for="titulo">Descripción</label>
          <textarea class="form-control" ng-model="nuevoMaterial.descripcion" placeholder="Descripción"></textarea>
          <br>
          <label for="titulo">ID Tema</label>
          <input type="number" class="form-control" ng-model="nuevoMaterial.id_tema" placeholder="ID Tema" />
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" ng-click="guardarMaterial()">Guardar</button>
        <button class="btn btn-secondary" data-dismiss="modal" id="ModalMaterialClose">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<!-- Temas -->
<div id="content" ng-controller="editCtrl" class="container mt-5 pt-4">

  <!-- Iterar sobre los temas -->
  <div class="card mb-4" ng-repeat="tema in temas">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">{{ tema.titulo }} <button ng-click="eliminarTema(tema)" class="btn btn-danger">
            <span class="glyphicon glyphicon-trash"></span>
          </button>
          <button type="button" class="btn btn-success" ng-click="abrirModalEditarTema(tema)" data-toggle="modal" data-target="#modalEditarTema">
            <span class="glyphicon glyphicon-pencil"></span> Modificar
          </button>
        </h4>
        </td>
        <td>
      <td>
        </td>
    </div>
    <div class="card-body">

      <!-- Botón para desplegar/ocultar Materiales -->
      <div class="accordion" id="accordion{{tema.id}}">
        <td>
        </td>
      </tr>
    </tbody>
  </table>

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
</div>

<!-- Materiales -->
<div class="card">
          <div class="card-header" id="headingMaterial{{tema.id}}">
            <h5 class="mb-0">
              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseMaterial{{tema.id}}" aria-expanded="true" aria-controls="collapseMaterial{{tema.id}}">
                <span class="glyphicon glyphicon-book"></span> Materiales
              </button>
            </h5>
          </div>
          <div id="collapseMaterial{{tema.id}}" class="collapse" aria-labelledby="headingMaterial{{tema.id}}" data-parent="#accordion{{tema.id}}">
            <div class="card-body">
              <ul class="list-group">
                <li class="list-group-item" ng-repeat="material in materiales | filter:{id_tema: tema.id}">
                  <strong>{{ material.titulo }}</strong>: {{ material.descripcion }}
                  <div class="float-right">
                    <button ng-click="abrirModalEditarMaterial(material)" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEditarMaterial">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button ng-click="eliminarMaterial(material)" class="btn btn-danger btn-sm">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    <button ng-click="irAEditarMaterial(material.id)" class="btn btn-primary btn-sm">
                      <span class="glyphicon glyphicon-plus"></span> Ver
                    </button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>


        <!-- Modal para editar material -->
<div class="modal fade" id="modalEditarMaterial" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Material</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form name="formEditarMaterial">
            <div class="form-group">
              <label for="tituloMaterial">Título</label>
              <input id="tituloMaterial" type="text" class="form-control" ng-model="materialEditar.titulo" required>
              <label for="descripcionMaterial">Descripción</label>
              <textarea id="descripcionMaterial" class="form-control" ng-model="materialEditar.descripcion" required></textarea>
              <input type="hidden" name="id" ng-model="materialEditar.id">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="guardarEdicionMaterial()">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>


<!-- Tareas -->
<div class="card">
          <div class="card-header" id="headingTareas{{tema.id}}">
            <h5 class="mb-0">
              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTareas{{tema.id}}" aria-expanded="false" aria-controls="collapseTareas{{tema.id}}">
                <span class="glyphicon glyphicon-tasks"></span> Tareas
              </button>
            </h5>
          </div>
          <div id="collapseTareas{{tema.id}}" class="collapse" aria-labelledby="headingTareas{{tema.id}}" data-parent="#accordion{{tema.id}}">
            <div class="card-body">
              <ul class="list-group">
                <li class="list-group-item" ng-repeat="tarea in tareas | filter:{id_tema: tema.id}">
                  <strong>{{ tarea.titulo }}</strong>: {{ tarea.descripcion }} <strong>{{ tarea.valor }}</strong>: {{ tarea.fecha_entrega }}
                  <div class="float-right">
                    <button ng-click="abrirModalEditarTarea(tarea)" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEditarTarea">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button ng-click="eliminarTarea(tarea)" class="btn btn-danger btn-sm">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    <button ng-click="irAEditarTarea(tarea.id)" class="btn btn-primary btn-sm">
                      <span class="glyphicon glyphicon-plus"></span> Ver
                    </button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

  <!-- Modal para editar tarea -->
  <div class="modal fade" id="modalEditarTarea" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Tarea</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form name="formEditarTarea">
            <div class="form-group">
              <label for="titulo">Título</label>
              <input id="titulo" type="text" class="form-control" ng-model="tareaEditar.titulo" required>
              <label for="descripcion">Descripción</label>
              <textarea id="descripcion" class="form-control" ng-model="tareaEditar.descripcion" required></textarea>
              <label for="valor">Valor</label>
              <input id="valor" type="number" class="form-control" ng-model="tareaEditar.valor" required>
              <label for="fecha_entrega">Fecha de Entrega</label>
              <input id="fecha_entrega" type="date" class="form-control" ng-model="tareaEditar.fecha_entrega" required>
              <input type="hidden" name="id" ng-model="tareaEditar.id">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="guardarEdicionTarea()">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Cuestionarios -->
<div class="card">
          <div class="card-header" id="headingCuestionarios{{tema.id}}">
            <h5 class="mb-0">
              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseCuestionarios{{tema.id}}" aria-expanded="false" aria-controls="collapseCuestionarios{{tema.id}}">
                <span class="glyphicon glyphicon-list-alt"></span> Cuestionarios
              </button>
            </h5>
          </div>
          <div id="collapseCuestionarios{{tema.id}}" class="collapse" aria-labelledby="headingCuestionarios{{tema.id}}" data-parent="#accordion{{tema.id}}">
            <div class="card-body">
              <ul class="list-group">
                <li class="list-group-item" ng-repeat="cuestionario in cuestionarios | filter:{id_tema: tema.id}">
                  <strong>{{ cuestionario.titulo }}</strong>: {{ cuestionario.descripcion }}
                  <div class="float-right">
                    <button ng-click="abrirModalEditarCuestionario(cuestionario)" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEditarCuestionario">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button ng-click="eliminarCuestionario(cuestionario)" class="btn btn-danger btn-sm">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    <button ng-click="irAEditarCuestionario(cuestionario.id)" class="btn btn-primary btn-sm">
                      <span class="glyphicon glyphicon-plus"></span> Ver
                    </button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div> <!-- Fin de la Accordion -->

  <!-- Modal para editar cuestionario -->
  <div class="modal fade" id="modalEditarCuestionario" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Cuestionario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form name="formEditarCuestionario">
            <div class="form-group">
              <label for="titulo">Título</label>
              <input id="titulo" type="text" class="form-control" ng-model="cuestionarioEditar.titulo" required>
              <label for="descripcion">Descripción</label>
              <textarea id="descripcion" class="form-control" ng-model="cuestionarioEditar.descripcion" required></textarea>
              <input type="hidden" name="id" ng-model="cuestionarioEditar.id">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="guardarEdicionCuestionario()">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>

</div>



<?php require_once 'pie.php'; ?>