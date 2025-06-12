<?php require_once 'encabezadoEdit.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>
<div id="content" class="container">

    <body ng-controller="editCtrl">
        <div class="tabla"></div>
        <h2>Tareas de la Clase</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Tarea</th>
                    <th>Descripción</th>
                    <th>Calificación</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="tarea in tareasAlumnos">
                    <td>{{ tarea.estudiante }}</td>
                    <td>{{ tarea.titulo_tarea }}</td>
                    <td>{{ tarea.descripcion_tarea }}</td>
                    <td>
                        <input type="text" ng-model="tarea.calificacion">
                    </td>
                    <td>
                        <button ng-click="actualizarCalificacion(tarea)">Actualizar</button>
                    </td>
                </tr>
            </tbody>
        </table>
</div>
</body>

</div>
<style>
    /* Estilos generales para la tabla */
    .tabla{
        padding: 4rem;
    }
    h2{
        padding-left: 2rem;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-family: 'Arial', sans-serif;
    }

    /* Estilo de las celdas y bordes */
    th,
    td {
        padding: 15px 20px;
        /* Aumentar el espacio dentro de las celdas */
        text-align: center;
        border: 1px solid #ddd;
    }

    /* Fondo de las cabeceras */
    th {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
    }

    /* Estilo para las filas pares */
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Estilo para las filas impares */
    tr:nth-child(odd) {
        background-color: #f1f1f1;
    }

    /* Efecto al pasar el ratón sobre una fila */
    tr:hover {
        background-color: #ddd;
    }

    /* Estilo del enlace (Ver archivo) */
    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Estilo del botón */
    button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        /* Aumentar el tamaño del botón */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Estilo del campo de calificación */
    input[type="text"] {
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
        text-align: center;
        font-weight: bold;
    }

    /* Estilo para el contenedor */
    #content {
        padding: 40px 20px;
        /* Aumentar el espacio alrededor del contenido */
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<?php require_once 'pie.php'; ?>