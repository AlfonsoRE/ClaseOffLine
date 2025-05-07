<?php require_once 'encabezadoEdit.php'; ?>
<script src="./controlador/angular-sanitize.min.js"></script>

<div id="content" class="container">

  <h2>Maestro</h2>
  <table class="table table-hover table-responsive table-striped">
    <thead>
      <tr>
        <th class="tabla-colum">ID</th>
        <th class="tabla-colum">Nombre</th>
        <th class="tabla-colum">Status</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-if="datosMaestro">
        <td>{{datosMaestro.id}}</td>
        <td>{{datosMaestro.nombre}}</td>
        <td>{{datosMaestro.status}}</td>
      </tr>
    </tbody>
  </table>

  <h2>Alumnos</h2>
  <table class="table table-hover table-responsive table-striped">
    <thead>
      <tr>
        <th class="tabla-colum">ID</th>
        <th class="tabla-colum">Nombre</th>
        <th class="tabla-colum">Status</th>
        <th class="tabla-colum">Eliminar <span class="glyphicon glyphicon-trash"></span></th>
      </tr>
    </thead>
    <tbody>
      <tr class="tabla" ng-repeat="u in usuarios">
        <td>{{u.id}}</td>
        <td>{{u.nombre}}</td>
        <td>{{u.status}}</td>
        <td>
          <button type="button" ng-click="eliminarAlumno(u)" class="btn btn-danger">
            <span class="glyphicon glyphicon-trash"></span>
          </button>
        </td>
      </tr>
    </tbody>
  </table>

</div>
<?php require_once 'pie.php'; ?>