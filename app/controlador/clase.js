var App = angular.module('app', ['ngSanitize']);

App.controller('claseCtrl', function($scope,$http, $sce){
	
	$scope.anuncio ={};
	$scope.anuncios ={};
	$scope.nuevoAnuncio = '';
	$scope.documento = null;
	$scope.archivo ={};
	$scope.archivos ={};
	$scope.enlace ={};
	$scope.enlaces ={};
	$scope.buscar ={};

	setTimeout(function() {
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [['bold', 'italic', 'underline'], [{ 'list': 'ordered' }, { 'list': 'bullet' }]]
            }
        });

		$scope.guardarAnuncio = function(){
			var contenido = quill.root.innerHTML;
			$scope.anuncio.id_clase  = getParameterByName('id_clase');
			$scope.anuncio.mensaje= contenido;
			$scope.anuncio.id_usuario=$scope.usuario.id_usuario;	
			
		//alert($scope.anuncio.mensaje+ " "+ $scope.anuncio.id_clase);
			if($scope.anuncio.id == null){		
				$http.post('../api/guardarAnuncio.php',$scope.anuncio)
				.success(function(data,status,headers,config){
					quill.setText('');
					$scope.anuncio = {};
					$scope.consultarAnuncios();
					$scope.consultarArchivos();	
					$scope.consultarEnlaces();
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
			}else{
				$http.post('../api/modificarAnuncio.php',$scope.anuncio)
				.success(function(data,status,headers,config){
					quill.setText('');
					$scope.anuncio = {};	
					$scope.consultarAnuncios();
					$scope.consultarArchivos();	
					$scope.consultarEnlaces();					
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
			}		
		}

		$scope.subirArchivo = function(){
			var contenido = quill.root.innerHTML;
			$scope.anuncio.id_clase  = getParameterByName('id_clase');
			$scope.anuncio.mensaje= contenido;
			$scope.anuncio.id_usuario=$scope.usuario.id_usuario;
			if($scope.anuncio.id == null){		
				$http.post('../api/guardarAnuncio.php',$scope.anuncio)
				.success(function(data,status,headers,config){
					$scope.anuncio.id = data;	
					$('#ModalArchivo').modal('show');
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
		  }	else{
			$http.post('../api/modificarAnuncio.php',$scope.anuncio)
				.success(function(data,status,headers,config){
					$('#ModalArchivo').modal('show');
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
		  }
		}

		$scope.agregarEnlace = function(){
			var contenido = quill.root.innerHTML;
			$scope.anuncio.id_clase  = getParameterByName('id_clase');
			$scope.anuncio.mensaje= contenido;
			$scope.anuncio.id_usuario=$scope.usuario.id_usuario;
			if($scope.anuncio.id == null){		
				$http.post('../api/guardarAnuncio.php',$scope.anuncio)
				.success(function(data,status,headers,config){
					$scope.anuncio.id = data;	
					$('#ModalEnlace').modal('show');
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
		  }	else{
			$http.post('../api/modificarAnuncio.php',$scope.anuncio)
				.success(function(data,status,headers,config){
					$('#ModalEnlace').modal('show');
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
		  }
		}

		$scope.guardarArchivo = function(){
			$scope.archivo.id_anuncios = $scope.anuncio.id;
			var formData = new FormData();
			formData.append("json", JSON.stringify($scope.archivo)); // Enviar JSON con los parámetros
			formData.append("archivo", $scope.documento); // Enviar archivo

			$http.post('../api/guardarArchivoAnuncio.php', formData, {
				headers: { "Content-Type": undefined },
				transformRequest: angular.identity
			}).then(function (response) {
				$scope.archivo={};
				$scope.documento = null;
				$scope.consultarArchivos();
				$('#ModalArchivoClose').click();
			}, function (error) {
				$scope.mensaje = "Error al subir archivo";
				alert("Error BD" + data);
			});
		}

		$scope.guardarEnlace = function(){			
			$scope.enlace.id_anuncios = $scope.anuncio.id;
				$http.post('../api/guardarEnlacesAnuncios.php',$scope.enlace)
				.success(function(data,status,headers,config){	
					$scope.enlace={};
					$scope.consultarEnlaces();				
					$('#ModalEnlaceClose').click();
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
		}

		$scope.consultarArchivos = function(){
			$scope.buscar.id_anuncio = $scope.anuncio.id;
			//$scope.buscar.id_anuncio = 22;
			$http.post('../api/consultarArchivoAnunciosPorAnuncio.php',$scope.buscar)
			.success(function(data,status,headers,config){
				$scope.archivos = data;					
			}).error(function(data,status,headers,config){
				alert("Error BD" + data);
			});
		}

		$scope.consultarEnlaces = function(){
			$scope.buscar.id_anuncios = $scope.anuncio.id;
		   // $scope.buscar.id_anuncios = 19;
			$http.post('../api/consultarEnlacesAnuncioIdAnuncios.php',$scope.buscar)
			.success(function(data,status,headers,config){
				$scope.enlaces = data;					
			}).error(function(data,status,headers,config){
				alert("Error BD" + data);
			});
		}

		$scope.eliminarArchivo = function (id){
			if (confirm("¿Estás seguro de eliminar este archivo?")) {
				$scope.buscar.id = id;
				$http.post('../api/eliminarArchivoAnuncio.php',$scope.buscar)
				.success(function(data,status,headers,config){
					$scope.consultarArchivos();
					$scope.consultarAnuncios();
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
			}
		}

		$scope.eliminarEnlace = function (id){
			if (confirm("¿Estás seguro de eliminar este enlace?")) {
				$scope.buscar.id = id;
				$http.post('../api/eliminarEnlacesAnuncios.php',$scope.buscar)
				.success(function(data,status,headers,config){
					$scope.consultarEnlaces();
					$scope.consultarAnuncios();
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
			}
		}

		$scope.consultarAnuncios = function(){
			$scope.buscar.id_clase =getParameterByName('id_clase');		
			$http.post('../api/consultarAnunciosArchivosEnlaces.php',$scope.buscar)
			.success(function(data,status,headers,config){
				$scope.anuncios = data;					
			}).error(function(data,status,headers,config){
				alert("Error BD" + data);
			});
		}

		$scope.tiempoTranscurrido = function(fechaString) {
			var fecha = new Date(fechaString);
			var ahora = new Date();
			var diffMs = ahora - fecha;
		
			var segundos = Math.floor(diffMs / 1000);
			var minutos = Math.floor(segundos / 60);
			var horas = Math.floor(minutos / 60);
			var dias = Math.floor(horas / 24);
		
			if (dias > 0) return "Publicado hace " + dias + " día(s)";
			if (horas > 0) return "Publicado hace " + horas + " hora(s)";
			if (minutos > 0) return "Publicado hace " + minutos + " minuto(s)";
			return "Publicado hace unos segundos";
		};

		$scope.eliminarAnuncio = function (id){
			if (confirm("¿Estás seguro de eliminar este anuncio?")) {
				$scope.buscar.id = id;
				$http.post('../api/eliminarAnuncio.php',$scope.buscar)
				.success(function(data,status,headers,config){
					$scope.consultarAnuncios();
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
			}
		}

		$scope.consultarAnuncios();

	}, 500);

// codigo generico para la navegacion 

	
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
	$scope.usuario.id_usuario = document.getElementById("idUsuario").value;
	
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

App.directive('uploaderModel', ["$parse", function ($parse) {
	return {
		restrict: 'A',
		link: function (scope, iElement, iAttrs) {
			iElement.on("change", function (e) {
				$parse(iAttrs.uploaderModel).assign(scope, iElement[0].files[0]);
			});
		}
	};
}]);