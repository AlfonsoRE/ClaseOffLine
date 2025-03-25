var App = angular.module('app', []);

App.controller('joinClaseCtrl', function($scope, $http) {

    $scope.clase = {};

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

});
