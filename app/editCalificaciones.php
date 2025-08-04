<?php require_once 'encabezadoEdit.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>
<div id="content" class="container">

    <body ng-controller="editCtrl">
        <h2>Tareas de la Clase</h2>
        <div style="overflow-x: auto;">
        <table class="table  table-striped table-bordered table-hover  " >
            <thead>
                <tr  class="success">
                    <th class="sticky-col">Estudiante</th>
                    <th ng-repeat="nombre in tareasAlumnos[1]">
                        {{ nombre }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="(nombre, tareas) in tareasAlumnos[0]">
                    <td class="sticky-col">{{nombre}}</td>
                    <td ng-repeat="tarea in tareas" style="text-align: center;">
                        <input class="form-control" type="text" ng-model="tarea.calificacion">/{{tarea.valor}} <br><button class="btn btn-success" ng-click="actualizarCalificacion(tarea)">Actualizar</button>
                    </td>                    
                </tr>
            </tbody>
        </table></div>
        <br><br>
</div>
</body>
<style>
/* Fija la primera columna */
.sticky-col {
  position: sticky;
  left: 0;
  z-index: 1;
  background-color: white; /* Ajusta al color de fondo que uses */
  box-shadow: 2px 0 5px rgba(0,0,0,0.1); /* Opcional para distinguir */
  min-width: 150px; /* Asegúrate de dar espacio suficiente */
  max-width: 150px;
  word-break: break-word;
  white-space: normal;
  vertical-align: middle;
}

/* Para encabezados fijos en la primera columna */
thead .sticky-col {
  z-index: 2;
  top: 0;
}

</style>

</div>
<?php require_once 'pie.php'; ?>