var App = angular.module("app",['ngSanitize']);

App.controller("editCtrl",  function($scope,$http, $sce) {
  	
	// Anuncios
	$scope.anuncio ={};
	$scope.anuncios ={};
	$scope.nuevoAnuncio = '';
	$scope.documento = null;
	$scope.archivo ={};
	$scope.archivos ={};
	$scope.enlace ={};
	$scope.enlaces ={};
	$scope.buscar ={};
	$scope.id_clase = getParameterByName("id_clase");
	$scope.contenidos = [];
	$scope.temas = [];
	$scope.nuevoTema = {};
	$scope.temaEditar = {};
	$scope.tareas = [];
	$scope.nuevaTarea = {};
	$scope.tarea = {};
	$scope.cuestionarios = [];
	$scope.nuevoCuestionario = {};
	$scope.cuestionario = {}; // ✅ Agregada
	$scope.materiales = [];
	$scope.nuevoMaterial = {};
	$scope.material = {};
  var quill;

	setTimeout(function() {
         quill = new Quill('#editor', {
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

//Cierra anuncios
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

  // ------------------------------------
  // Temas
  // ------------------------------------
  $scope.consultarTemas = function () {
    $http.post("../api/consultarTemas.php", { id_clase: $scope.id_clase }).then(
      function (response) {
        $scope.temas = response.data;
      },
      function (error) {
        alert("Error al consultar temas: " + error);
      }
    );
  };

  $scope.guardarTema = function () {
    if (!$scope.nuevoTema.titulo) {
      alert("El título del tema es obligatorio.");
      return;
    }

    $scope.nuevoTema.id_clase = getParameterByName("id_clase");
    $http.post("../api/guardarTema.php", $scope.nuevoTema).then(
      function () {
       // alert("Tema guardado");
        $scope.consultarTemas();
        $scope.nuevoTema = {};
        $("#ModalTemaClose").click();
      },
      function (error) {
        alert("Error al guardar tema: " + error);
      }
    );
  };

  $scope.eliminarTema = function (tema) {
    if (confirm("¿Estás seguro de eliminar el tema?")) {
      $http.post("../api/eliminarTema.php", { id: tema.id }).then(
        function () {
          alert("Tema eliminado");
          console.log("Tema eliminado:", tema);
          $scope.consultarTemas();
        },
        function (error) {
          alert("Error al eliminar tema: " + error);
        }
      );
    }
  };

  $scope.abrirModalEditarTema = function (tema) {
    $scope.temaEditar = angular.copy(tema);
    $("#modalEditarTema").modal();
  };

  $scope.guardarEdicionTema = function () {
    if (confirm("¿Estás seguro de guardar los cambios del tema?")) {
      $http.post("../api/modificarTema.php", $scope.temaEditar).then(
        function () {
          alert("Tema modificado");
          console.log("Tema modificado:", $scope.temaEditar);
          $scope.consultarTemas();
          $("#modalEditarTema").modal("hide");
        },
        function (error) {
          alert("Error al modificar tema: " + error.statusText);
        }
      );
    }
  };

  
  // -----------------------------------
  // TAREAS
  // -----------------------------------
  $scope.consultarTareas = function () {
    $http
      .post("../api/consultarTareas.php", { id_clase: $scope.id_clase })
      .success(function (data) {
        $scope.tareas = data;
      })
      .error(function (err) {
        alert("Error al consultar tareas: " + err);
      });
  };

  $scope.guardarTarea = function () {
    if (!$scope.nuevaTarea.titulo) {
          alert("El título de la tarea es obligatorio.");
          return;
        }
         if (!$scope.nuevaTarea.id_tema) {
          alert("El tema de la tarea es obligatorio.");
          return;
        }
        $scope.nuevaTarea.id_clase = getParameterByName("id_clase");
			  var contenido = quill.root.innerHTML;
        $scope.nuevaTarea.descripcion= contenido;
        if($scope.nuevaTarea.id == null){	
          $http.post("../api/guardarTarea.php", $scope.nuevaTarea)
          .success(function(data,status,headers,config) {  
             $scope.consultarTareas();
             $scope.nuevaTarea = {};
             quill.setText('');		
					   $scope.consultarArchivosT();	
					   $scope.consultarEnlacesT();
             $("#ModalTareaClose").click();             
            }).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});          
      }else{
        $http.post("../api/modificarTarea.php", $scope.nuevaTarea)
        .success(function(data,status,headers,config) {          
              $scope.consultarTareas();
             $scope.nuevaTarea = {};
             quill.setText('');		
					   $scope.consultarArchivosT();	
					   $scope.consultarEnlacesT();
             $("#ModalTareaClose").click(); 
           }).error(function(data,status,headers,config){
              alert("Error al guardar tarea: " + error);
            });
          }
  }

  $scope.eliminarTarea = function (tarea) {
    if (confirm("¿Eliminar esta tarea?")) {
      $http
        .post("../api/eliminarTarea.php", { id: tarea.id })
        .success(function () {
          alert("Tarea eliminada");
          $scope.consultarTareas();
        })
        .error(function (err) {
          alert("Error al eliminar tarea: " + err);
        });
    }
  };

  $scope.abrirModalEditarTarea = function (tarea) {
    $scope.tareaEditar = angular.copy(tarea);
    $("#modalEditarTarea").modal();
  };

  $scope.guardarEdicionTarea = function () {
    if (confirm("¿Estás seguro de guardar los cambios de la tarea?")) {
      $http.post("../api/modificarTarea.php", $scope.tareaEditar).then(
        function () {
          alert("Tarea modificada");
          console.log("Tarea modificada:", $scope.tareaEditar);
          $scope.consultarTareas();
          $("#modalEditarTarea").modal("hide");
        },
        function (error) {
          alert("Error al modificar tarea: " + error.statusText);
        }
      );
    }
  };

  $scope.irAEditarTarea = function (id) {
    window.location.href = "editTarea.php?id_tarea=" + id;
  };
  $scope.salir = function () {
    window.history.back();
  };

  $scope.subirArchivoT = function(){
        if (!$scope.nuevaTarea.titulo) {
          alert("El título de la tarea es obligatorio.");
          return;
        }
         if (!$scope.nuevaTarea.id_tema) {
          alert("El tema de la tarea es obligatorio.");
          return;
        }
        $scope.nuevaTarea.id_clase = getParameterByName("id_clase");
			  var contenido = quill.root.innerHTML;
        $scope.nuevaTarea.descripcion= contenido;
        if($scope.nuevaTarea.id == null){	
          $http.post("../api/guardarTarea.php", $scope.nuevaTarea)
          .success(function(data,status,headers,config) {          
              $scope.nuevaTarea.id = data;
              $('#ModalArchivo').modal('show');
            }).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});          
      }else{
        $http.post("../api/modificarTarea.php", $scope.nuevaTarea)
        .success(function(data,status,headers,config) {          
              $('#ModalArchivo').modal('show');
           }).error(function(data,status,headers,config){
              alert("Error al guardar tarea: " + error);
            });
          }
  }

  $scope.guardarArchivoT = function(){
			$scope.archivo.id_tareas =  $scope.nuevaTarea.id;
			var formData = new FormData();
			formData.append("json", JSON.stringify($scope.archivo)); // Enviar JSON con los parámetros
			formData.append("archivo", $scope.documento); // Enviar archivo

			$http.post('../api/guardarArchivoTarea.php', formData, {
				headers: { "Content-Type": undefined },
				transformRequest: angular.identity
			}).then(function (response) {
				$scope.archivo={};
				$scope.documento = null;
				$scope.consultarArchivosT();
				$('#ModalArchivoClose').click();
			}, function (error) {
				$scope.mensaje = "Error al subir archivo";
				alert("Error BD" + data);
			});
		}

    $scope.consultarArchivosT = function(){
			$scope.buscar.id_tareas = $scope.nuevaTarea.id;
			//$scope.buscar.id_anuncio = 22;
			$http.post('../api/consultarArchivoTareasporTarea.php',$scope.buscar)
			.success(function(data,status,headers,config){
				$scope.archivos = data;					
			}).error(function(data,status,headers,config){
				alert("Error BD" + data);
			});
		}

    $scope.agregarEnlaceT = function(){
       if (!$scope.nuevaTarea.titulo) {
          alert("El título de la tarea es obligatorio.");
          return;
        }
         if (!$scope.nuevaTarea.id_tema) {
          alert("El tema de la tarea es obligatorio.");
          return;
        }
        $scope.nuevaTarea.id_clase = getParameterByName("id_clase");
			  var contenido = quill.root.innerHTML;
        $scope.nuevaTarea.descripcion= contenido;
        if($scope.nuevaTarea.id == null){	
          $http.post("../api/guardarTarea.php", $scope.nuevaTarea)
          .success(function(data,status,headers,config) {          
              $scope.nuevaTarea.id = data;
              $('#ModalEnlace').modal('show');
            }).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});          
      }else{
        $http.post("../api/modificarTarea.php", $scope.nuevaTarea)
        .success(function(data,status,headers,config) {          
              $('#ModalEnlace').modal('show');
           }).error(function(data,status,headers,config){
              alert("Error al guardar tarea: " + error);
            });
          }
			}

      $scope.guardarEnlaceT = function(){			
			$scope.enlace.id_tareas = $scope.nuevaTarea.id;
				$http.post('../api/guardarEnlaceTarea.php',$scope.enlace)
				.success(function(data,status,headers,config){	
					$scope.enlace={};
					$scope.consultarEnlacesT();				
					$('#ModalEnlaceClose').click();
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
		}

    $scope.consultarEnlacesT = function(){
			$scope.buscar.id_tareas = $scope.nuevaTarea.id;
		   // $scope.buscar.id_anuncios = 19;
			$http.post('../api/consultarEnlaceTareaPorTarea.php',$scope.buscar)
			.success(function(data,status,headers,config){
				$scope.enlaces = data;					
			}).error(function(data,status,headers,config){
				alert("Error BD" + data);
			});
		}

    $scope.eliminarArchivoT = function (id){
			if (confirm("¿Estás seguro de eliminar este archivo?")) {
				$scope.buscar.id = id;
				$http.post('../api/eliminarArchivoTareas.php',$scope.buscar)
				.success(function(data,status,headers,config){
					$scope.consultarArchivosT();
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
			}
		}

    	$scope.eliminarEnlaceT = function (id){
			if (confirm("¿Estás seguro de eliminar este enlace?")) {
				$scope.buscar.id = id;
				$http.post('../api/eliminarEnlaceTarea.php',$scope.buscar)
				.success(function(data,status,headers,config){
					$scope.consultarEnlacesT();
				}).error(function(data,status,headers,config){
					alert("Error BD" + data);
				});
			}
		}





  // -----------------------------------
  // CUESTIONARIOS
  // -----------------------------------
  $scope.consultarCuestionarios = function () {
    $http
      .post("../api/consultarCuestionarios.php", { id_clase: $scope.id_clase })
      .success(function (data) {
        $scope.cuestionarios = data;
      })
      .error(function (err) {
        alert("Error al consultar cuestionarios: " + err);
      });
  };
  $scope.guardarCuestionario = function () {
    if (!$scope.nuevoCuestionario.titulo) {
      alert("El título del cuestionario es obligatorio.");
      return;
    }
    $scope.nuevoCuestionario.id_clase = getParameterByName("id_clase");
    $http.post("../api/guardarCuestionario.php", $scope.nuevoCuestionario).then(
      function (response) {
        console.log("Respuesta del servidor:", response.data);
        const nuevoId = response.data.id;
        if (!nuevoId) {
          alert("No se pudo obtener el ID del cuestionario creado.");
          return;
        }
        console.log("Cuestionario insertado:", $scope.nuevoCuestionario);
        const cuestionarioContenidoVacio = {
          id_cuestionario: nuevoId,
          pregunta: " ",
          opcion1: " ",
          opcion2: " ",
          opcion3: " ",
          opcion4: " ",
          respuesta: 1,
        };

        $http
          .post(
            "../api/guardarCuestionariosContenido.php",
            cuestionarioContenidoVacio
          )
          .then(
            function () {
              console.log("Registro vacío en cuestionarios_contenido creado");
              window.location.href = `editCuestionario.php?id_cuestionario=${nuevoId}`;
            },
            function (error) {
              alert(
                "Error al guardar contenido vacío del cuestionario: " +
                  error.data
              );
            }
          );
        $scope.consultarCuestionarios();
        $scope.nuevoCuestionario = {};
        $("#ModalCuestionarioClose").click();
      },
      function (error) {
        alert("Error al guardar cuestionario: " + error.data);
      }
    );
  };
  $scope.guardarPregunta = function () {
    if (
      !$scope.cuestionario.pregunta ||
      !$scope.cuestionario.opcion1 ||
      !$scope.cuestionario.opcion2 ||
      !$scope.cuestionario.opcion3 ||
      !$scope.cuestionario.opcion4 ||
      !$scope.cuestionario.respuesta
    ) {
      alert("Por favor, completa todos los campos antes de guardar.");
      return;
    }
    $http
      .post("../api/modificarCuestionariosContenido.php", $scope.cuestionario)
      .then(
        function () {
          alert("Pregunta guardada correctamente");
          console.log("Pregunta actualizada:", $scope.cuestionario);
        },
        function (error) {
          alert("Error al guardar pregunta: " + error.data);
        }
      );
  };
  $scope.obtenerPreguntaInicial = function () {
    const idCuestionario = getParameterByName("id_cuestionario");
    $http
      .get(
        `../api/consultarCuestionarioContenidoIdCuestionario.php?id_cuestionario=${idCuestionario}`
      )
      .then(
        function (response) {
          $scope.cuestionario = response.data; // debe tener el ID de la fila creada vacía
        },
        function (error) {
          alert("Error al cargar contenido del cuestionario: " + error.data);
        }
      );
  };
  $scope.obtenerPreguntaInicial();
  $scope.eliminarCuestionario = function (cuestionario) {
    if (confirm("¿Eliminar este cuestionario?")) {
      $http
        .post("../api/eliminarCuestionario.php", { id: cuestionario.id })
        .success(function () {
          alert("Cuestionario eliminado");
          $scope.consultarCuestionarios();
        })
        .error(function (err) {
          alert("Error al eliminar cuestionario: " + err);
        });
    }
  };
  $scope.abrirModalEditarCuestionario = function (cuestionario) {
    $scope.cuestionarioEditar = angular.copy(cuestionario);
    $("#modalEditarCuestionario").modal();
  };
  $scope.guardarEdicionCuestionario = function () {
    if (confirm("¿Estás seguro de guardar los cambios del cuestionario?")) {
      $http
        .post("../api/modificarCuestionario.php", $scope.cuestionarioEditar)
        .then(
          function () {
            alert("Cuestionario modificado");
            console.log("Cuestionario modificado:", $scope.cuestionarioEditar);
            $scope.consultarCuestionarios();
            $("#modalEditarCuestionario").modal("hide");
          },
          function (error) {
            alert("Error al modificar cuestionario: " + error.statusText);
          }
        );
    }
  };
  $scope.irAEditarCuestionario = function (id) {
    window.location.href = "editCuestionario.php?id_cuestionario=" + id;
  };
  $scope.salir = function () {
    window.history.back();
  };
  // -----------------------------------
  // MATERIALES
  // -----------------------------------
  $scope.consultarMateriales = function () {
    $http
      .post("../api/consultarMaterial.php", { id_clase: $scope.id_clase })
      .success(function (data) {
        $scope.materiales = data;
      })
      .error(function (err) {
        alert("Error al consultar materiales: " + err);
      });
  };

  // Función para guardar un material
  $scope.guardarMaterial = function () {
    if (!$scope.nuevoMaterial.titulo || !$scope.nuevoMaterial.descripcion) {
      alert("El título y la descripción del material son obligatorios.");
      return;
    }

    $scope.nuevoMaterial.id_clase = getParameterByName("id_clase");
    $http.post("../api/guardarMaterial.php", $scope.nuevoMaterial).then(
      function () {
        alert("Material guardado");
        console.log("Material insertado:", $scope.nuevoMaterial);
        $scope.consultarTemas(); // Vuelve a cargar los temas con sus contenidos
        $scope.nuevoMaterial = {}; // Limpiar el formulario
        $("#ModalMaterialClose").click(); // Cerrar el modal
      },
      function (error) {
        alert("Error al guardar material: " + error.statusText);
      }
    );
  };

  $scope.eliminarMaterial = function (material) {
    if (confirm("¿Eliminar este material?")) {
      $http
        .post("../api/eliminarMaterial.php", { id: material.id })
        .success(function () {
          alert("Material eliminado");
          $scope.consultarMateriales();
        })
        .error(function (err) {
          alert("Error al eliminar material: " + err);
        });
    }
  };

  $scope.abrirModalEditarMaterial = function (material) {
    $scope.materialEditar = angular.copy(material);
    $("#modalEditarMaterial").modal();
  };

  $scope.guardarEdicionMaterial = function () {
    if (confirm("¿Estás seguro de guardar los cambios del material?")) {
      $http.post("../api/modificarMaterial.php", $scope.materialEditar).then(
        function () {
          alert("Material modificado");
          console.log("Material modificado:", $scope.materialEditar);
          $scope.consultarMateriales();
          $("#modalEditarMaterial").modal("hide");
        },
        function (error) {
          alert("Error al modificar material: " + error.statusText);
        }
      );
    }
  };

  $scope.irAEditarMaterial = function (id) {
    window.location.href = "editMaterial.php?id_material=" + id;
  };
  $scope.salir = function () {
    window.history.back();
  };

  $scope.consultarTemas();
  $scope.consultarTareas();
  $scope.consultarClases();
  $scope.consultarDatosMaestro();
  $scope.consultarCuestionarios();
  $scope.consultarMateriales();
  $scope.obtenerPreguntaInicial(); // ✅ solo una vez
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