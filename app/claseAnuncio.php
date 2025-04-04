<?php require_once 'encabezadoClase.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>
<div id="content" class="container">
    <br>
  <div class="row">
  <div class="jumbotron">
    <h2>{{clase.materia}}</h2>      
    <p>{{clase.descripcion}}</p>
    <h3>Codigo: {{clase.codigo}}</h3>
  </div>
  </div>

  <div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">Agregar Anuncio</div>
    <div class="panel-body">
    <div id="editor"></div><br>
    <button  class="btn btn-success btn-md" ng-click="guardarAnuncio()"><span class="glyphicon glyphicon-bullhorn"></span> Publicar Anuncio</button>
    <div class="btn-group">
    <button type="button" class="btn btn-primary" ng-click="subirArchivo()"><span class="glyphicon glyphicon-cloud"></span> Subir archivo</button>
    <button type="button" class="btn btn-primary" ng-click="agregarEnlace()"><span class="glyphicon glyphicon-link"></span> Agregar enlace</button>
  </div>
    </div>
   
    <div class="container-fluid">
  
  <!-- Sección de Archivos -->
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading bg-primary text-white">
          <span class="glyphicon glyphicon-file"></span> Archivos
        </div>
        <div class="panel-body" ng-show='archivos.length>0'>
          <ul class="list-group">
            <div ng-repeat = 'a in archivos'>
            <li class="list-group-item">
              <span class="glyphicon glyphicon-file"></span>
              <a href="{{a.url}}" target="_blank"> {{a.nombre}}</a>
              <button class="btn btn-danger btn-xs pull-right" ng-click="eliminarArchivo(a.id)">
              <span class="glyphicon glyphicon-trash"></span> Eliminar
            </button>
            </li>
            </div>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Sección de URLs -->
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading bg-success text-white">
          <span class="glyphicon glyphicon-link"></span> Enlaces Externos
        </div>
        <div class="panel-body" ng-show='enlaces.length>0'>
          <ul class="list-group">
          <div ng-repeat = 'e in enlaces'>
            <li class="list-group-item">
              <span class="glyphicon glyphicon-link"></span>
              <a href="{{e.enlace}}" target="_blank"> Enlace {{$index+1}}</a>
              <button class="btn btn-danger btn-xs pull-right" ng-click="eliminarEnlace(e.id)">
              <span class="glyphicon glyphicon-trash"></span> Eliminar
            </button>
            </li>    
          </div>       
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
</div>

 <!-- Sección de Anuncios -->
<div ng-repeat = 'an in anuncios'>
  <div class="row">
    <div class="panel panel-success">
      <div class="panel-heading">
      <span class="pull-left"><b>{{an.nombre}} dijo:</b></span>
      <span class="pull-right text-muted"><button class="btn btn-danger btn-xs pull-center" ng-show={{an.id_usuario==usuario.id_usuario}} ng-click="eliminarAnuncio(an.id)">
      <span class="glyphicon glyphicon-trash"></span></button>
      <div class="clearfix"></div></span>
      <div style="flex-grow: 1; text-align: center;">
      {{tiempoTranscurrido(an.fecha)}}
      </div>
    </div>
      <div class="panel-body">
         <div ng-bind-html="an.mensaje"></div>
      </div>    
    <div class="container-fluid">
    <!-- Sección de Archivos -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading bg-primary text-white">
            <span class="glyphicon glyphicon-file"></span> Archivos
          </div>
          <div class="panel-body" ng-show='an.archivos.length>0'>
            <ul class="list-group">
              <div ng-repeat = 'ar in an.archivos'>
              <li class="list-group-item">
                <span class="glyphicon glyphicon-file"></span>
                <a href="../api/descargarArchivoAnuncio.php?id={{ar.id}}" target="_blank"> {{ar.nombre}}</a>
                <button class="btn btn-danger btn-xs pull-right" ng-show={{an.id_usuario==usuario.id_usuario}} ng-click="eliminarArchivo(ar.id)">
                <span class="glyphicon glyphicon-trash"></span> Eliminar
              </button>
              </li>
              </div>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Sección de URLs -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading bg-success text-white">
            <span class="glyphicon glyphicon-link"></span> Enlaces Externos
          </div>
          <div class="panel-body" ng-show='an.enlaces.length>0'>
            <ul class="list-group">
            <div ng-repeat = 'en in an.enlaces'>
              <li class="list-group-item">
                <span class="glyphicon glyphicon-link"></span>
                <a href="{{en.enlace}}" target="_blank"> Enlace {{$index+1}}</a>
                <button class="btn btn-danger btn-xs pull-right" ng-show={{an.id_usuario==usuario.id_usuario}} ng-click="eliminarEnlace(en.id)">
                <span class="glyphicon glyphicon-trash"></span> Eliminar
              </button>
              </li>    
            </div>       
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
  </div>
  </div>
</div>


</div>
<!-- Modal archivo-->
<div id="ModalArchivo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Subir Archivo</h4>
      </div>

      <div class="modal-body">  
        <form ng-submit="guardarArchivo()" enctype="multipart/form-data">
         
          <label>Seleccionar Archivo:</label>
          <input type="file" uploader-model="documento" required> <br><br>

          <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-cloud"></span> Subir archivo</button>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" id ="ModalArchivoClose" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

 </div>
 </div>
<!-- Termina Modal -->

<!-- Modal enlace-->
<div id="ModalEnlace" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar enlace</h4>
      </div>

      <div class="modal-body">  
        <form class="form-horizontal" name="formenlace">
          <div class="form-group"> <label  class="col-sm-4 control-label"> Enlace: </label>
          <div class="col-sm-7"> <input type="text" class="form-control" name ="enlace" 
            ng-model="enlace.enlace"  required>
          </div>
          </div>   

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-7">
          <button type="submit" value ="enviar" ng-click ="formenlace.$valid && guardarEnlace()"
            class="btn btn-primary"> 
            <span class="glyphicon glyphicon-link"></span> Agregar enlace</button>
          </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" id ="ModalEnlaceClose" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

 </div>
 </div>
<!-- Termina Modal -->

 </div>
</body>

</div>
<?php require_once 'pie.php'; ?>