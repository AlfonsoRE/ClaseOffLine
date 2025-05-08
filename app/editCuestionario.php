<?php require_once 'encabezadoEdit.php'; ?>
<script src="./controlador/angular-sanitize.min.js"></script>
<div id="content" class="container mt-5 pt-4" ng-init="cuestionario = { id_cuestionario: getParameterByName('id_cuestionario') }">
  <uib-tab heading="Agregar Pregunta al Cuestionario">
    <div class="container mt-3">
      <form ng-submit="guardarPregunta()">
        <div class="form-group">
          <label for="pregunta">Pregunta</label>
          <input type="text" class="form-control" ng-model="cuestionario.pregunta" required>
        </div>
        <div class="form-group">
          <label>Opciones</label>
          <input type="text" class="form-control mb-2" ng-model="cuestionario.opcion1" placeholder="Opción 1" required>
          <input type="text" class="form-control mb-2" ng-model="cuestionario.opcion2" placeholder="Opción 2" required>
          <input type="text" class="form-control mb-2" ng-model="cuestionario.opcion3" placeholder="Opción 3" required>
          <input type="text" class="form-control mb-2" ng-model="cuestionario.opcion4" placeholder="Opción 4" required>
        </div>
        <div class="form-group">
          <label for="respuesta">Respuesta correcta (1-4)</label>
          <input type="number" class="form-control" ng-model="cuestionario.respuesta" min="1" max="4" required>
        </div>
        <div class="mt-4">
          <button type="submit" class="btn btn-success">Guardar Pregunta</button>
          <button type="button" class="btn btn-danger ml-2" ng-click="salir()">Salir</button>
        </div>
      </form>
    </div>
  </uib-tab>
</div>

<?php require_once 'pie.php'; ?>