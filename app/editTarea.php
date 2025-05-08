<?php require_once 'encabezadoEdit.php'; ?>
<script src="./controlador/angular-sanitize.min.js"></script>
<div id="content" class="container mt-5 pt-4" ng-init="tarea = { id_tareas: getParameterByName('id_tareas') }">

  <uib-tabset>
    <!-- TAB: Agregar Archivo -->
    <uib-tab heading="Agregar Archivo a la Tarea">
      <div class="container mt-3">
        <form ng-submit="guardarArchivo()" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nombre">Nombre del Archivo</label>
            <input type="text" class="form-control" ng-model="tarea.nombre" required>
          </div>
          <div class="form-group">
            <label for="archivo">Seleccionar Archivo</label>
            <input type="file" file-model="tarea.archivo" class="form-control" required>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-success">Guardar Archivo</button>
            <button type="button" class="btn btn-danger ml-2" ng-click="salir()">Salir</button>
          </div>
        </form>
      </div>
    </uib-tab>

    <!-- TAB: Agregar Enlace -->
    <uib-tab heading="Agregar Enlace a la Tarea">
      <div class="container mt-3">
        <form ng-submit="guardarEnlace()">
          <div class="form-group">
            <label for="enlace">Enlace</label>
            <input type="url" class="form-control" ng-model="tarea.enlace" placeholder="https://..." required>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-primary">Guardar Enlace</button>
            <button type="button" class="btn btn-danger ml-2" ng-click="salir()">Salir</button>
          </div>
        </form>
      </div>
    </uib-tab>
  </uib-tabset>

</div>
<?php require_once 'pie.php'; ?>