
var App = angular.module('app',[]);

App.controller('addClaseCtrl', function($scope,$http){

$scope.usuario={};
$scope.clase={};
$scope.clasesImpartidas={};
$scope.clasesInscritas={};

$scope.consultarClases = function(){
	$scope.usuario.id_usuario= document.getElementById("idUsuario").value;
	$http.post('../api/consultarClaseIdUsuario.php',$scope.usuario)
	.success(function(data,status,headers,config){
		$scope.clasesImpartidas = data;		
        // setTimeout(function () {$scope.creaU = false;}, 1000);
	}).error(function(data,status,headers,config){
		alert("Error BD" + data);
	});

	$http.post('../api/consultarClasesEstudianteIdEstudiante.php',$scope.usuario)
	.success(function(data,status,headers,config){
		$scope.clasesInscritas = data;		
        // setTimeout(function () {$scope.creaU = false;}, 1000);
	}).error(function(data,status,headers,config){
		alert("Error BD" + data);
	});
}

$scope.guardaClase  = function(){
	$scope.clase.id_usuario= document.getElementById("idUsuario").value;
	$http.post('../api/guardarClases.php',$scope.clase)
	.success(function(data,status,headers,config){
		$scope.clase={};
		alert("Registrado");
        // setTimeout(function () {$scope.creaU = false;}, 1000);
	}).error(function(data,status,headers,config){
		alert("Error BD" + data);
	});
}

$scope.consultarClases();

});