
var App = angular.module('app',[]);

App.controller('addClaseCtrl', function($scope,$http){

$scope.clase={};

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


});