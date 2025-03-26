var App = angular.module('app',[]);

App.controller('dashboardCtrl', function($scope,$http){

$scope.usuario={};
$scope.clasesImpartidas={};
$scope.clasesInscritas={};
$scope.guardaClase  = function(){
	alert("si funciona");
}


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

$scope.entro = function(){
	$('#pass').removeAttr('type');
}

$scope.salio = function(){
	$('#pass').attr('type','password');
}

$scope.consultarClases();

});