<?php require_once 'encabezadoEdit.php'; ?>
<link rel="stylesheet" href="./css/quill.snow.css">
<script src="./controlador/quill.min.js"></script>
<script src="./controlador/angular-sanitize.min.js"></script>
<div id="content" class="container">

<div class ="row">
  <div class="col-md-12">
    <h2>Modificar Clase</h2>
    </div>
  </div>
<br>

<div class ="row">

<form class="form-horizontal" name="form">

<input type="hidden" id="idUsuario" value="<?php echo $_SESSION['id']; ?>">

 <div class="form-group">
     <label  class="col-sm-4 control-label"> Nombre: </label>
     <div class="col-sm-8">
     <input type="text" class="form-control" name ="nombre" 
     ng-model="clase.nombre" placeholder="Nombre" required>
  </div>
   </div>  
   <div class="form-group">
     <label  class="col-sm-4 control-label"> Materia: </label>
     <div class="col-sm-8">
     <input type="text" class="form-control" name ="materia" 
     ng-model="clase.materia" placeholder="Nombre de la Materia" required>
     </div>
   </div>  
   
   <div class="form-group">
     <label  class="col-sm-4 control-label"> Descripcion: </label>
     <div class="col-sm-8">
     <input type="text" class="form-control" name ="descripcion" 
     ng-model="clase.descripcion" placeholder="Descripcion" required>
     </div>
   </div> 
   
     
   <div class="form-group">
     <label  class="col-sm-4 control-label"> Codigo: </label>
     <div class="col-sm-8">
     <input type="text" class="form-control" name ="codigo" 
     ng-model="clase.codigo" placeholder="Codigo" required>
     </div>
   </div>
   
   
<div class="form-group">
  <div class="col-sm-offset-4 col-sm-8">
   <button type="submit" value ="enviar" ng-click ="form.$valid && modificarClase()"
    class="btn btn-warning btn-md"> Modificar clase</button>       
   </div>
  </div>
</form>

 

</div>

  

 </div>
</body>

</div>
<?php require_once 'pie.php'; ?>