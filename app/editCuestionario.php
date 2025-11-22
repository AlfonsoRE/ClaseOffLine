<?php require_once 'encabezadoEdit.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>

<div id="content" class="container">
  <h2>Crear cuestionario</h2>
  <br>
  <div class="row">
    <form ng-submit="modificarCuestionario()">
      <div class="col-md-6">
        <label for="titulo">ID Tema</label>
        <select ng-model="nuevoCuestionario.id_tema" ng-options="tema.id as tema.titulo for tema in temas" class="form-control">
          <option value="">Seleccione un tema</option>
        </select>
        <br>
        <label for="titulo">Título</label>
        <input type="text" class="form-control" ng-model="nuevoCuestionario.titulo" placeholder="Título" required />
      </div>
      <div class="col-md-6">
        <label for="titulo">Descripción</label>
        <div id="editorCu"></div>
        <br>
        <button type="submit" class="btn btn-warning">Modificar</button>
      </div>
    </form>
  </div>
  <br>
  <div class="row">
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalPregunta">
      <span class="glyphicon glyphicon-plus"></span> Agregar Pregunta
    </button>

    <h2>Preguntas</h2>
    <table class="table table-hover table-responsive table-striped">
      <thead>
        <tr>
          <th class="tabla-colum">#</th>
          <th class="tabla-colum">Pregunta</th>
          <th class="tabla-colum">Respuesta</th>
          <th class="tabla-colum">Modificar <span class="glyphicon glyphicon-pencil"></span></th>
          <th class="tabla-colum">Eliminar <span class="glyphicon glyphicon-trash"></span></th>
        </tr>
      </thead>
      <tbody>
        <tr class="tabla" ng-repeat="p in preguntas">
          <td>{{$index+1}}</td>
          <td>{{formatQuill(p.pregunta)}}</td>
          <td>{{p.respuesta}}</td>
          <td>
            <button type="button" ng-click="modalModificarPregunta(p)" class="btn btn-warning">
              <span class="glyphicon glyphicon-pencil"></span>
            </button>
          </td>
          <td>
            <button type="button" ng-click="eliminarPregunta(p.id)" class="btn btn-danger">
              <span class="glyphicon glyphicon-trash"></span>
            </button>
          </td>
        </tr>
      </tbody>
    </table><br><br>

  </div>

</div>

<!-- Modal Agregar Pregunta-->
<div id="modalPregunta" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Agregar Pregunta</h4>
      </div>
      <div class="modal-body">

        <form>
          <div class="form-group">
            <label for="pregunta">Pregunta</label>
            <div id="editorC"></div>
          </div>
          <div class="form-group">
            <label>Opciones</label>
            <input type="text" class="form-control mb-2" ng-model="pregunta.opcion1" placeholder="Opción 1" required>
            <br><input type="text" class="form-control mb-2" ng-model="pregunta.opcion2" placeholder="Opción 2" required>
            <br><input type="text" class="form-control mb-2" ng-model="pregunta.opcion3" placeholder="Opción 3" required>
            <br><input type="text" class="form-control mb-2" ng-model="pregunta.opcion4" placeholder="Opción 4" required>
          </div>
          <div class="form-group">
            <label for="respuesta">Respuesta correcta(Debe ser textualmente igual a algunas de las opciones)</label>
            <input type="text" class="form-control" ng-model="pregunta.respuesta" required>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" ng-click="guardarPregunta()">Guardar</button>
        <button class="btn btn-secondary" data-dismiss="modal" id="ModalPreguntaClose">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Termina Modal Agregar Pregunta-->

<!-- Modal Modificar Pregunta-->
<div id="modalModPregunta" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Modificar Pregunta</h4>
      </div>
      <div class="modal-body">

        <form>
          <div class="form-group">
            <label for="pregunta">Pregunta</label>
            <div id="editorPe"></div>
          </div>
          <div class="form-group">
            <label>Opciones</label>
            <input type="text" class="form-control mb-2" ng-model="preguntaMod.opcion1" placeholder="Opción 1" required>
            <br><input type="text" class="form-control mb-2" ng-model="preguntaMod.opcion2" placeholder="Opción 2" required>
            <br><input type="text" class="form-control mb-2" ng-model="preguntaMod.opcion3" placeholder="Opción 3" required>
            <br><input type="text" class="form-control mb-2" ng-model="preguntaMod.opcion4" placeholder="Opción 4" required>
          </div>
          <div class="form-group">
            <label for="respuesta">Respuesta correcta(Debe ser textualmente igual a algunas de las opciones)</label>
            <input type="text" class="form-control" ng-model="preguntaMod.respuesta" required>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button class="btn btn-warning" ng-click="modificarPregunta()">Modificar</button>
        <button class="btn btn-secondary" data-dismiss="modal" id="ModalModPreguntaClose">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Termina Modal Modificar Pregunta-->


</body>

</div>
<?php require_once 'pie.php'; ?>