var App = angular.module('app', []);

App.controller('joinClaseCtrl', function($scope, $http) {
    $scope.usuario={};
    $scope.clase = {};

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

    $scope.unirseClase = function() {
        $scope.clase.id_estudiante = $scope.clase.id_usuario;

        $http.post('../api/guardarClasesEstudiantes.php', $scope.clase)
            .then(function(response) {
                alert("Ya estás registrado en la clase");
                $scope.clase = {};
            }, function(error) {
                alert("Error al unirse a la clase: " + error.data);
            });
    };

    $scope.consultarClases();

});
