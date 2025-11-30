<?php require_once 'encabezadoClase.php'; ?>
<div id="content" class="container">

  <style>
    .section-title {
      font-size: 24px;
      margin-top: 30px;
      margin-bottom: 15px;
      font-weight: bold;
    }

    .user-name {
      padding: 10px 0;
      border-bottom: 1px solid #ccc;
      font-weight: bold;
    }
  </style>

  <!-- Profesores -->
  <div class="section-title">Profesor</div>
  <div  class=" user-name ">
    {{ buscarMaestroPorIdClase(clase.id) }}
  </div>

  <!-- Alumnos -->
  <div class="section-title">Compañeros de clase ({{ alumnos.length }} alumnos)</div>
  <div class="user-name" ng-repeat="alumno in alumnos">
    {{ alumno.nombre }}
  </div>

</div>
</body>

</div>
<?php require_once 'pie.php'; ?>