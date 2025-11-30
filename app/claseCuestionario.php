<?php require_once 'encabezadoClase.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<link rel="stylesheet" href="./css/sidebar-tarea.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>
<style>
    .cuestionario-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .cuestionario-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }

    .card-header i {
        font-size: 28px;
        color: #4285f4;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 600;
    }

    .card-body {
        margin-bottom: 15px;
        font-size: 1.5rem;
        color: #202124;
    }

    .card-body .fecha {
        margin-top: 10px;
        font-size: 1.5rem;
        color: #5f6368;
    }

    .card-footer {
        text-align: right;
    }

    .btn-abrir {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        padding: 10px 18px;
        border-radius: 50px;
        font-weight: 500;
        color: white;
        background: linear-gradient(135deg, #4285f4, #34a853);
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .btn-abrir i {
        font-size: 1.2rem;
    }

    .btn-abrir:hover {
        transform: translateY(-2px) scale(1.05);
        background: linear-gradient(135deg, #3367d6, #0f9d58);
    }

    /* Estilos para el botón bloqueado */
    .btn-bloqueado {
        background: #6c757d !important;
        cursor: not-allowed !important;
        opacity: 0.7;
    }
    .btn-bloqueado:hover {
        transform: none !important;
        background: #6c757d !important;
    }
</style>
<!-- Reemplaza el container por este div personalizado -->
<div id="content" class="container">

    <h2>Descripción del Cuestionario</h2>
    <br>
    <div class="main-layout">
        <!-- Columna principal (contenido) -->
        <div class="content-column">
            <div ng-repeat="tema in temas" class="">
                <!-- TAREAS -->
                <div ng-repeat="cues in tema.cuestionarios" class="contenido-preview" ng-show="cues.id==id_buscarcuestionario">
                    <div class="media">
                        <div class="cuestionario-card">
                            <div class="card-header">
                                <i class="glyphicon glyphicon-certificate"></i>
                                <h3>{{ cues.titulo }}</h3>
                            </div>
                            <div class="card-body">
                                <p><strong>Publicado:</strong> {{ cues.fecha_creacion | date:'mediumDate' }}</p>
                                <div  ng-bind-html="cues.descripcion"></div>
                                <!-- Mostrar calificación obtenida -->
                                <div>
                                    <strong>Tu calificación:</strong>
                                    {{ calificacionRecibida != null ? calificacionRecibida : 'No disponible' }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <!-- Botón BLOQUEADO si ya tiene calificación -->
                                <a ng-if="!calificacionRecibida" 
                                   href="./claseCuestionarioContenido.php?id_clase={{clase.id}}&id_cuestionario={{cues.id}}" 
                                   target="_blank" class="btn-abrir">
                                    <i class="glyphicon glyphicon-link"></i> Abrir cuestionario
                                </a>
                                
                                <!-- Mensaje cuando ya lo contestó -->
                                <span ng-if="calificacionRecibida" class="btn-abrir btn-bloqueado">
                                    <i class="glyphicon glyphicon-ok"></i> ⚡¡Misión Cumplida! - ¡Completado al 100%!⚡
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>

</div>
<?php require_once 'pie.php'; ?>