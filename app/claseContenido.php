<?php require_once 'encabezadoClase.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>
<div id="content" class="container  mt-5 pt-4">

  <h2>Contenido</h2>

  <div class="row">
    <div ng-repeat="tema in temas  | orderBy:'id':false" class="tema-block">
      <h4 style="display: flex; justify-content: space-between; align-items: center;">
        <strong><span class="glyphicon glyphicon-list"></span> {{tema.titulo }}</strong>
      </h4>

      <!-- TAREAS -->
      <div ng-repeat="tarea in tema.tareas" class="contenido-preview" ng-click="tarea.abierto = !tarea.abierto">
        <div class="media">
          <div class="media-left">
            <i class="glyphicon glyphicon-edit icono-grande text-warning"></i>
          </div>
          <div class="media-body" ng-if="datosMaestro">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <strong>{{ buscarMaestroPorIdClase(clase.id) }} publicó una nueva tarea: {{ tarea.titulo }}</strong>
              <p><strong>Fecha Límite:</strong> {{ tarea.fecha_entrega | date:'mediumDate' }}</p>

            </div>
            <div ng-show="tarea.abierto" class="contenido-detalle">
              <p><strong>Publicado:</strong> {{ tarea.fecha | date:'mediumDate' }}</p>
              <p>
              <div ng-bind-html="tarea.descripcion"></div>
              </p>
              <!-- Archivos (tarea o material) -->
              <div ng-if="tarea.archivos.length > 0">
                <strong>Archivos:</strong>
                <ul>
                  <li ng-repeat="a in tarea.archivos">
                    <a ng-href="../api/descargarArchivoTarea.php?id={{a.id}}" target="_blank" ng-click="$event.stopPropagation()">
                      <i class="glyphicon glyphicon-file"></i> {{a.nombre}}
                    </a>
                  </li>
                </ul>
              </div>
              <!-- Enlaces (tarea o material) -->
              <div ng-if="tarea.enlaces.length > 0">
                <strong>Enlaces:</strong>
                <ul>
                  <li ng-repeat="e in tarea.enlaces">
                    <a ng-href="{{e.enlace}}" target="_blank" ng-click="$event.stopPropagation()">
                      <i class="glyphicon glyphicon-link"></i> {{e.enlace}}

                    </a>
                  </li>
                </ul>
              </div>
              <a href="./claseHistorialTareas.php?id_clase={{clase.id}}&id_tarea={{tarea.id}}"> Ver instrucciones </a>
            </div>
          </div>
        </div>
      </div>

      <!-- MATERIALES -->
      <div ng-repeat="mat in tema.material  | orderBy:'id':false" class="contenido-preview" ng-click="mat.abierto = !mat.abierto">
        <div class="media">
          <div class="media-left">
            <i class="glyphicon glyphicon-book icono-grande text-success"></i>
          </div>
          <div class="media-body">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <strong>{{ buscarMaestroPorIdClase(clase.id) }} publicó un nuevo material: {{ mat.titulo }}</strong>

            </div>
            <div ng-show="mat.abierto" class="contenido-detalle">
              <p>
              <div ng-bind-html="mat.descripcion"></div>
              </p>
              <!-- Archivos (tarea o material) -->
              <div ng-if="mat.archivos.length > 0">
                <strong>Archivos:</strong>
                <ul>
                  <li ng-repeat="a in mat.archivos">
                    <a ng-href="../api/descargarArchivoMaterial.php?id={{a.id}}" target="_blank" ng-click="$event.stopPropagation()">
                      <i class="glyphicon glyphicon-file"></i> {{a.nombre}}
                    </a>
                  </li>
                </ul>
              </div>
              <!-- Enlaces (tarea o material) -->
              <div ng-if="mat.enlaces.length > 0">
                <strong>Enlaces:</strong>
                <ul>
                  <li ng-repeat="e in mat.enlaces">
                    <a ng-href="{{e.enlace}}" target="_blank" ng-click="$event.stopPropagation()">
                      <i class="glyphicon glyphicon-link"></i> {{e.enlace}}
                    </a>
                  </li>
                </ul>
              </div>
              <a href="./claseMaterial.php?id_clase={{clase.id}}&id_material={{mat.id}}"> Ver instrucciones </a>
            </div>
          </div>
        </div>
      </div>

      <!-- CUESTIONARIOS -->
      <div ng-repeat="cues in tema.cuestionarios  | orderBy:'id':false" class="contenido-preview" ng-click="cues.abierto = !cues.abierto">
        <div class="media">
          <div class="media-left">
            <i class="glyphicon glyphicon-list-alt icono-grande text-primary"></i>
          </div>
          <div class="media-body">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <strong>{{ buscarMaestroPorIdClase(clase.id) }} publicó una nueva tarea: {{ cues.titulo }}</strong>
            </div>
            <div ng-show="cues.abierto" class="contenido-detalle">
              <p><strong>Fecha creación:</strong> {{ cues.fecha_creacion | date:'mediumDate' }}</p>
              <div ng-bind-html="cues.descripcion"></div>
              <a href="./claseCuestionario.php?id_clase={{clase.id}}&id_cuestionario={{cues.id}}"> Ver instrucciones </a>
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