<?php require_once 'encabezadoClase.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>

<style>
/* ============================= */
/*    CLASSROOM - VISTA ALUMNO   */
/* ============================= */
.classroom-student-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: "Google Sans", "Roboto", Arial, sans-serif;
    background: #f8f9fa;
    min-height: 100vh;
}

.student-header {
    background: linear-gradient(135deg, #4285f4, #34a853);
    color: white;
    padding: 25px 30px;
    border-radius: 16px;
    margin-bottom: 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.student-title {
    font-size: 2.2rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 15px;
}

.student-subtitle {
    font-size: 1.5rem;
    opacity: 0.9;
    margin: 8px 0 0 0;
}

/* Tarjetas de contenido */
.student-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-left: 4px solid #4285f4;
    transition: transform 0.3s ease;
}

.student-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.card-header-student {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e8eaed;
}

.card-header-student i {
    font-size: 24px;
    color: #4285f4;
}

.card-header-student h3 {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 600;
    color: #202124;
}

/* Tablas estilo Classroom */
.table-classroom-student {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
    font-family: "Google Sans", "Roboto", sans-serif;
}

.table-classroom-student thead th {
    background: linear-gradient(135deg, #4285f4, #34a853);
    color: white;
    font-weight: 500;
    padding: 16px 12px;
    border: none;
    font-size: 14px;
    text-align: center;
    letter-spacing: 0.2px;
}

.table-classroom-student tbody tr {
    background: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
}

.table-classroom-student tbody td {
    padding: 16px 12px;
    border: none;
    font-size: 14px;
    text-align: center;
    color: #202124;
    font-weight: 500;
}

.table-classroom-student tbody tr:hover {
    background: #e8f0fe;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

/* Indicadores de calificación */
.grade-excellent {
    color: #34a853;
    font-weight: 600;
    background: #e6f4ea;
    padding: 4px 8px;
    border-radius: 6px;
}

.grade-good {
    color: #fbbc05;
    font-weight: 600;
    background: #fef7e0;
    padding: 4px 8px;
    border-radius: 6px;
}

.grade-poor {
    color: #ea4335;
    font-weight: 600;
    background: #fce8e6;
    padding: 4px 8px;
    border-radius: 6px;
}

.grade-pending {
    color: #5f6368;
    font-weight: 500;
    background: #f8f9fa;
    padding: 4px 8px;
    border-radius: 6px;
    font-style: italic;
}

/* Estadísticas personales */
.student-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 15px;
    margin-bottom: 25px;
}

.stat-item-student {
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    border-top: 4px solid #4285f4;
}

.stat-number-student {
    font-size: 2rem;
    font-weight: bold;
    color: #4285f4;
    display: block;
}

.stat-label-student {
    font-size: 1.3rem;
    color: #5f6368;
    margin-top: 5px;
}

/* Estado de actividades */
.activity-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 1.2rem;
    font-weight: 500;
}

.status-completed {
    background: #e6f4ea;
    color: #137333;
}

.status-pending {
    background: #fef7e0;
    color: #b06000;
}

.status-missing {
    background: #fce8e6;
    color: #c5221f;
}

/* Responsive */
@media (max-width: 768px) {
    .classroom-student-container {
        padding: 15px;
    }
    
    .student-stats {
        grid-template-columns: 1fr;
    }
    
    .table-classroom-student {
        font-size: 12px;
    }
    
    .student-title {
        font-size: 1.8rem;
    }
}
/* Evitar que el sidebar tape el contenido */
.classroom-student-container {
    margin-left: 260px; /* Ajusta al ancho REAL de tu sidebar */
    padding-top: 20px;
}

/* Evitar que la tabla se salga hacia los lados */
.student-card {
    padding-left: 20px !important;
    padding-right: 20px !important;
}

/* Centrar tablas */
.table-classroom-student {
    width: auto !important;
    margin-left: auto !important;
    margin-right: auto !important;
}

/* Evitar que el header verde/azul se estire mal */
.table-classroom-student thead th {
    white-space: nowrap;
}

</style>

<div class="classroom-student-container">
<body ng-controller="claseCtrl">

    <!-- Header del Alumno -->
    <div class="student-header">
                 <br>
        <h1 class="student-title">
            <i class="glyphicon glyphicon-user"></i>
             Mi Progreso Académico
        </h1>
        <p class="student-subtitle">{{ clase.materia }} </p>
    </div>

    <!-- ============================= -->
    <!--       MIS TAREAS              -->
    <!-- ============================= -->
    <div class="student-card">
        <div class="card-header-student">
            <i class="glyphicon glyphicon-edit"></i>
            <h3>Mis Calificaciones de Tareas</h3>
        </div>
        <div style="overflow-x: auto;">
            <table class="table-classroom-student">
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
                            <span ng-if="tarea.calificacion !== null && tarea.calificacion !== ''" 
                                  ng-class="{
                                      'grade-excellent': tarea.calificacion/tarea.valor >= 0.8,
                                      'grade-good': tarea.calificacion/tarea.valor >= 0.6 && tarea.calificacion/tarea.valor < 0.8,
                                      'grade-poor': tarea.calificacion/tarea.valor < 0.6
                                  }">
                                {{tarea.calificacion}}/{{tarea.valor}}
                            </span>
                            <span ng-if="tarea.calificacion === null || tarea.calificacion === ''" 
                                  class="grade-pending">
                                Pendiente
                            </span>
                        </td>                    
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ====================================== -->
    <!--       MIS CUESTIONARIOS                -->
    <!-- ====================================== -->
    <div class="student-card">
        <div class="card-header-student">
            <i class="glyphicon glyphicon-list-alt"></i>
            <h3>Mis Calificaciones de Cuestionarios</h3>
        </div>
        <div style="overflow-x: auto;">
            <table class="table-classroom-student">
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
                            <span ng-if="cuest.calificacion !== null && cuest.calificacion !== ''" 
                                  ng-class="{
                                      'grade-excellent': cuest.calificacion >= 80,
                                      'grade-good': cuest.calificacion >= 60 && cuest.calificacion < 80,
                                      'grade-poor': cuest.calificacion < 60
                                  }">
                                {{cuest.calificacion}}%
                            </span>
                            <span ng-if="cuest.calificacion === null || cuest.calificacion === ''" 
                                  class="grade-pending">
                                Pendiente
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


</body>
</div>


<?php require_once 'pie.php'; ?>