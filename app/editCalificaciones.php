<?php require_once 'encabezadoEdit.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<link rel="stylesheet" href="./css/calificacionesMaestro.css"> 
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>
<div class="classroom-container">
<body ng-controller="editCtrl">

    <!-- Header Classroom -->
    <div class="classroom-header">
          <br>
        <h1 class="classroom-title">
            <i class="glyphicon glyphicon-education"></i>
            Gestión de Calificaciones
        </h1>
        
    </div>



    <!-- ============================= -->
    <!--       TABLA DE TAREAS         -->
    <!-- ============================= -->
    <div class="card">
        <div class="card-header">
            <i class="glyphicon glyphicon-edit"></i>
            <h3>Tareas de la Clase</h3>
        </div>
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table class="table-colorful">
                    <thead>
                        <tr>
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
                                <input class="input-colorful" type="text" ng-model="tarea.calificacion">/{{tarea.valor}} 
                                <br>
                                <button class="btn-colorful" ng-click="actualizarCalificacion(tarea)">
                                    <i class="glyphicon glyphicon-refresh"></i> Actualizar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ====================================== -->
    <!--       TABLA DE CUESTIONARIOS           -->
    <!-- ====================================== -->
    <div class="card">
        <div class="card-header">
            <i class="glyphicon glyphicon-list-alt"></i>
            <h3>Cuestionarios de la Clase</h3>
        </div>
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table class="table-colorful">
                    <thead>
                        <tr>
                            <th class="sticky-col">Estudiante</th>
                            <th ng-repeat="nombre in cuestionariosAlumnos[1]">
                                {{ nombre }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="(nombre, cuestionarios) in cuestionariosAlumnos[0]">
                            <td class="sticky-col">{{nombre}}</td>
                            <td ng-repeat="cuest in cuestionarios" style="text-align: center;">
                                {{cuest.calificacion}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</div>

<?php require_once 'pie.php'; ?>