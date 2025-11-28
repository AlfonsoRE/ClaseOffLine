<?php require_once 'encabezadoClase.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>
<div id="content" class="container">

<body ng-controller="claseCtrl">

    <!-- ============================= -->
    <!--       TABLA DE TAREAS         -->
    <!-- ============================= -->
    <h2>Tareas de la Clase</h2>
    <div style="overflow-x: auto;">
        <table class="table-colorful">
            <thead>
                <tr>
                    <th ng-repeat="nombre in tareasAlumnos[1]">
                        {{ nombre }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="(nombre, tareas) in tareasAlumnos[0]">
                    <td ng-repeat="tarea in tareas" style="text-align: center;">
                        {{tarea.calificacion}}/{{tarea.valor}}
                    </td>                    
                </tr>
            </tbody>
        </table>
    </div>

    <br><br>

    <!-- ====================================== -->
    <!--       TABLA DE CUESTIONARIOS           -->
    <!-- ====================================== -->
    <h2>Cuestionarios de la Clase</h2>
    <div style="overflow-x: auto;">
        <table class="table-colorful">
            <thead>
                <tr>
                    
                    <th ng-repeat="nombre in cuestionariosAlumnos[1]">
                        {{ nombre }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="(nombre, cuestionarios) in cuestionariosAlumnos[0]">
                    <td ng-repeat="cuest in cuestionarios" style="text-align: center;">
                        {{cuest.calificacion}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</div>

<style>
/* TABLA COLORIDA ESTILO CLASSROOM */
.table-colorful {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
    font-family: "Roboto", sans-serif;
}

/* Encabezados */
.table-colorful thead th {
    background: linear-gradient(90deg, #4a90e2, #357ab8);
    color: white;
    font-weight: 600;
    padding: 14px;
    border-bottom: 3px solid #2a5d9f;
    font-size: 15px;
    text-align: center;
}

/* Filas */
.table-colorful tbody tr {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.15);
}

/* Filas alternadas */
.table-colorful tbody tr:nth-child(even) {
    background: #f0f4ff;
}

/* Celdas */
.table-colorful tbody td {
    padding: 14px;
    border-top: 2px solid #d3d9f0;
    border-bottom: 2px solid #d3d9f0;
    font-size: 15px;
    text-align: center;
}

/* Sticky primera columna (si decides aplicarla después) */
.sticky-col {
    position: sticky;
    left: 0;
    z-index: 3;
    background: #ffffff;
    font-weight: 600;
    border-right: 2px solid #d3d9f0;
}

/* Hover filas */
.table-colorful tbody tr:hover {
    background: #dbe9ff;
    transition: 0.2s;
}
</style>

<?php require_once 'pie.php'; ?>
