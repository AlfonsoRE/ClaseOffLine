var App = angular.module("app", []);

App.controller("editCtrl", function ($scope, $http) {
  $scope.clase = {};
  $scope.usuario = {};
  $scope.clasesImpartidas = {};
  $scope.clasesInscritas = {};
  $scope.usuarios = [];
  $scope.datosMaestro = {};

  function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
  }

  $scope.consultarClases = function () {
    $scope.clase.id = getParameterByName("id_clase");
    $scope.usuario.id_usuario = document.getElementById("idUsuario").value;

    $http
      .post("../api/consultarClase.php", $scope.clase)
      .success(function (data) {
        $scope.clase = data[0];
      })
      .error(function (data) {
        alert("Error BD: " + data);
      });

    $http
      .post("../api/consultarClaseIdUsuario.php", $scope.usuario)
      .success(function (data) {
        $scope.clasesImpartidas = data;
      })
      .error(function (data) {
        alert("Error BD: " + data);
      });

    $http
      .post("../api/consultarClasesEstudianteIdEstudiante.php", $scope.usuario)
      .success(function (data) {
        $scope.clasesInscritas = data;
      })
      .error(function (data) {
        alert("Error BD: " + data);
      });

    $http
      .post("../api/consultarAlumnosPorClase.php", {
        id_clase: $scope.clase.id,
      })
      .success(function (data) {
        $scope.usuarios = data;
      })
      .error(function (data) {
        alert("Error BD al obtener usuarios: " + data);
      });
  };

  $scope.modificarClase = function () {
    $scope.clase.id_usuario = document.getElementById("idUsuario").value;

    $http
      .post("../api/modificarClases.php", $scope.clase)
      .success(function () {
        alert("Registrado");
      })
      .error(function (data) {
        alert("Error BD: " + data);
      });
  };

  $scope.consultarDatosMaestro = function () {
    let idUsuario = document.getElementById("idUsuario").value;

    $http
      .post("../api/consultarUsuario.php", { id: idUsuario })
      .success(function (data) {
        if (data.length > 0) {
          $scope.datosMaestro = data[0];
        }
      })
      .error(function (data) {
        alert("Error al consultar maestro: " + data);
      });
  };

  $scope.eliminarAlumno = function (alumno) {
    if (confirm("¿Estás seguro de eliminar al alumno de esta clase?")) {
      $http
        .post("../api/eliminarClasesEstudiantes.php", { id: alumno.id })
        .success(function () {
          alert("Alumno eliminado correctamente.");
          $scope.consultarClases(); // Recarga los datos de la clase y alumnos
        })
        .error(function (data) {
          alert("Error al eliminar alumno: " + data);
        });
    }
  };

  $scope.consultarClases();
  $scope.consultarDatosMaestro();
});
