var App = angular.module('app',[]);

App.controller('editCtrl', function($scope,$http){

$scope.clase ={};
$scope.usuario={};
$scope.clasesImpartidas={};
$scope.clasesInscritas={};

function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


$scope.consultarClases = function(){
	$scope.clase.id  = getParameterByName('id_clase');
	$scope.usuario.id_usuario= document.getElementById("idUsuario").value;
	
	$http.post('../api/consultarClase.php',$scope.clase)
	.success(function(data,status,headers,config){
		$scope.clase = data[0];		
        // setTimeout(function () {$scope.creaU = false;}, 1000);
	}).error(function(data,status,headers,config){
		alert("Error BD" + data);
	});
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

$scope.modificarClase  = function(){
	$scope.clase.id_usuario= document.getElementById("idUsuario").value;
	$http.post('../api/modificarClases.php',$scope.clase)
	.success(function(data,status,headers,config){
		alert("Registrado");
        // setTimeout(function () {$scope.creaU = false;}, 1000);
	}).error(function(data,status,headers,config){
		alert("Error BD" + data);
	});
}


$scope.consultarClases();

});