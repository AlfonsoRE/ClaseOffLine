var App = angular.module("app", ["ngSanitize"]);

App.controller("claseCtrl", function ($scope, $http, $sce) {
  // ------------------------------------
  //  ANUNCIOS
  // ------------------------------------
  $scope.anuncio = {};
  $scope.anuncios = {};
  $scope.nuevoAnuncio = "";
  $scope.documento = null;
  $scope.archivo = {};
  $scope.archivos = {};
  $scope.enlace = {};
  $scope.enlaces = {};
  $scope.buscar = {};
  $scope.tarea = {};
  $scope.material = {};

  $scope.id_clase = getParameterByName("id_clase");

  function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
  }

  setTimeout(function () {
    var quill = new Quill("#editor", {
      theme: "snow",
      modules: {
        toolbar: [
          ["bold", "italic", "underline"],
          [{ list: "ordered" }, { list: "bullet" }],
        ],
      },
    });

    $scope.guardarAnuncio = function () {
      var contenido = quill.root.innerHTML;
      $scope.anuncio.id_clase = getParameterByName("id_clase");
      $scope.anuncio.mensaje = contenido;
      $scope.anuncio.id_usuario = $scope.usuario.id_usuario;

      //alert($scope.anuncio.mensaje+ " "+ $scope.anuncio.id_clase);
      if ($scope.anuncio.id == null) {
        $http
          .post("../api/guardarAnuncio.php", $scope.anuncio)
          .success(function (data, status, headers, config) {
            quill.setText("");
            $scope.anuncio = {};
            $scope.consultarAnuncios();
            $scope.consultarArchivos();
            $scope.consultarEnlaces();
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      } else {
        $http
          .post("../api/modificarAnuncio.php", $scope.anuncio)
          .success(function (data, status, headers, config) {
            quill.setText("");
            $scope.anuncio = {};
            $scope.consultarAnuncios();
            $scope.consultarArchivos();
            $scope.consultarEnlaces();
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      }
    };

    $scope.subirArchivo = function () {
      var contenido = quill.root.innerHTML;
      $scope.anuncio.id_clase = getParameterByName("id_clase");
      $scope.anuncio.mensaje = contenido;
      $scope.anuncio.id_usuario = $scope.usuario.id_usuario;
      if ($scope.anuncio.id == null) {
        $http
          .post("../api/guardarAnuncio.php", $scope.anuncio)
          .success(function (data, status, headers, config) {
            $scope.anuncio.id = data;
            $("#ModalArchivo").modal("show");
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      } else {
        $http
          .post("../api/modificarAnuncio.php", $scope.anuncio)
          .success(function (data, status, headers, config) {
            $("#ModalArchivo").modal("show");
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      }
    };

    $scope.agregarEnlace = function () {
      var contenido = quill.root.innerHTML;
      $scope.anuncio.id_clase = getParameterByName("id_clase");
      $scope.anuncio.mensaje = contenido;
      $scope.anuncio.id_usuario = $scope.usuario.id_usuario;
      if ($scope.anuncio.id == null) {
        $http
          .post("../api/guardarAnuncio.php", $scope.anuncio)
          .success(function (data, status, headers, config) {
            $scope.anuncio.id = data;
            $("#ModalEnlace").modal("show");
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      } else {
        $http
          .post("../api/modificarAnuncio.php", $scope.anuncio)
          .success(function (data, status, headers, config) {
            $("#ModalEnlace").modal("show");
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      }
    };

    $scope.guardarArchivo = function () {
      $scope.archivo.id_anuncios = $scope.anuncio.id;
      var formData = new FormData();
      formData.append("json", JSON.stringify($scope.archivo)); // Enviar JSON con los parámetros
      formData.append("archivo", $scope.documento); // Enviar archivo

      $http
        .post("../api/guardarArchivoAnuncio.php", formData, {
          headers: { "Content-Type": undefined },
          transformRequest: angular.identity,
        })
        .then(
          function (response) {
            $scope.archivo = {};
            $scope.documento = null;
            $scope.consultarArchivos();
            $("#ModalArchivoClose").click();
          },
          function (error) {
            $scope.mensaje = "Error al subir archivo";
            alert("Error BD" + data);
          }
        );
    };

    $scope.guardarEnlace = function () {
      $scope.enlace.id_anuncios = $scope.anuncio.id;
      $http
        .post("../api/guardarEnlacesAnuncios.php", $scope.enlace)
        .success(function (data, status, headers, config) {
          $scope.enlace = {};
          $scope.consultarEnlaces();
          $("#ModalEnlaceClose").click();
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    };

    $scope.consultarArchivos = function () {
      $scope.buscar.id_anuncio = $scope.anuncio.id;
      //$scope.buscar.id_anuncio = 22;
      $http
        .post("../api/consultarArchivoAnunciosPorAnuncio.php", $scope.buscar)
        .success(function (data, status, headers, config) {
          $scope.archivos = data;
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    };

    $scope.consultarEnlaces = function () {
      $scope.buscar.id_anuncios = $scope.anuncio.id;
      // $scope.buscar.id_anuncios = 19;
      $http
        .post("../api/consultarEnlacesAnuncioIdAnuncios.php", $scope.buscar)
        .success(function (data, status, headers, config) {
          $scope.enlaces = data;
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    };

    $scope.eliminarArchivo = function (id) {
      if (confirm("¿Estás seguro de eliminar este archivo?")) {
        $scope.buscar.id = id;
        $http
          .post("../api/eliminarArchivoAnuncio.php", $scope.buscar)
          .success(function (data, status, headers, config) {
            $scope.consultarArchivos();
            $scope.consultarAnuncios();
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      }
    };

    $scope.eliminarEnlace = function (id) {
      if (confirm("¿Estás seguro de eliminar este enlace?")) {
        $scope.buscar.id = id;
        $http
          .post("../api/eliminarEnlacesAnuncios.php", $scope.buscar)
          .success(function (data, status, headers, config) {
            $scope.consultarEnlaces();
            $scope.consultarAnuncios();
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      }
    };

    $scope.consultarAnuncios = function () {
      $scope.buscar.id_clase = getParameterByName("id_clase");
      $http
        .post("../api/consultarAnunciosArchivosEnlaces.php", $scope.buscar)
        .success(function (data, status, headers, config) {
          $scope.anuncios = data;
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    };

    $scope.tiempoTranscurrido = function (fechaString) {
      var fecha = new Date(fechaString);
      var ahora = new Date();
      var diffMs = ahora - fecha;

      var segundos = Math.floor(diffMs / 1000);
      var minutos = Math.floor(segundos / 60);
      var horas = Math.floor(minutos / 60);
      var dias = Math.floor(horas / 24);

      // Formato de hora exacta
      var fechaLocal = fecha.toLocaleDateString("es-MX", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
      });
      var horaLocal = fecha.toLocaleTimeString("es-MX", {
        hour: "2-digit",
        minute: "2-digit",
      });

      // Texto del tiempo transcurrido
      var textoTiempo;
      if (dias > 0) textoTiempo = "hace " + dias + " día(s)";
      else if (horas > 0) textoTiempo = "hace " + horas + " hora(s)";
      else if (minutos > 0) textoTiempo = "hace " + minutos + " minuto(s)";
      else if (segundos > 0) textoTiempo = "hace " + segundos + " segundo(s)";
      else textoTiempo = "hace unos segundos";

      return (
        "Publicado el " + fechaLocal + " " + horaLocal + " — " + textoTiempo
      );
    };

    $scope.consultarAnuncios();
  }, 500);

  // ------------------------------------
  //  Cierre de ANUNCIOS
  // ------------------------------------

  // ------------------------------------
  //  Clases y Usuarios
  // ------------------------------------
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
  // Cierre Clases y Usuarios
  // ------------------------------------

  // ------------------------------------
  // Temas
  // ------------------------------------
  $scope.consultarTemas = function () {
    $http
      .post("../api/obtenerContenidoClase.php", { id_clase: $scope.id_clase })
      .then(
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
    $http.post("../api/modificarTema.php", $scope.temaEditar).then(
      function () {
        $scope.consultarTemas();
        $("#modalEditarTema").modal("hide");
      },
      function (error) {
        alert("Error al modificar tema: " + error.statusText);
      }
    );
  };
  // ------------------------------------
  // Cierre de Temas
  // ------------------------------------
  // -----------------------------------
  // TAREAS
  // -----------------------------------
  $scope.anuncio = {};
  $scope.tareacomentarios = {};
  $scope.entregarTarea = {};
  $scope.estadoEntrega = {}; // puede ser 'sinArchivo', 'conArchivo', 'entregada', 'anulada'
  $scope.buscarcomentario = {};

  $scope.abrirModalTarea = function () {
    $("#ModalArchivoM").modal("show");
  };

  $scope.consultarTarea = function () {
    $scope.id_buscartarea = getParameterByName("id_tarea");
    $http
      .post("../api/consultarTarea.php", { id: $scope.id_buscartarea })
      .success(function (data) {
        $scope.tarea = data;
        // Verificamos si hay archivos
        $scope.tarea.tieneArchivo =
          $scope.tarea.archivos && $scope.tarea.archivos.length > 0;
      })
      .error(function (err) {
        alert("Error al consultar tareas: " + err);
      });
  };

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

  $scope.guardarArchivoHistorial = function () {
    $scope.archivo.id_tareas = getParameterByName("id_tarea");
    $scope.archivo.id_usuario = document.getElementById("idUsuario").value; // Asegúrate de tener esta variable
    var formData = new FormData();
    formData.append("json", JSON.stringify($scope.archivo)); // Enviar JSON con los parámetros
    formData.append("archivo", $scope.documento); // Enviar archivo

    $http
      .post("../api/guardarArchivoHistorialTarea.php", formData, {
        headers: { "Content-Type": undefined },
        transformRequest: angular.identity,
      })
      .then(
        function (response) {
          $scope.archivo = {};
          $scope.documento = null;
          $scope.consultarArchivosM();
          $scope.estadoEntrega =
            $scope.archivos && $scope.archivos.length > 0
              ? "entregada"
              : "sinArchivo";

          $("#ModalArchivoMClose").click();
          // ✅ Cambiar el estado a “conArchivo”
          $scope.estadoEntrega = "conArchivo";
        },
        function (error) {
          $scope.mensaje = "Error al subir archivo";
          alert("Error BD" + data);
        }
      );
  };
  // 🔹 Determina qué texto mostrar en el botón
  $scope.textoBotonTarea = function () {
    switch ($scope.estadoEntrega) {
      case "sinArchivo":
        return "Agregar archivo";
      case "conArchivo":
        return "Agregar archivo";
      case "entregada":
        return "Anular entrega";
      default:
        return "Agregar archivo";
    }
  };

  // 🔹 Lógica de acción según el estado
  $scope.accionBotonTarea = function () {
    switch ($scope.estadoEntrega) {
      case "sinArchivo":
        // Abre modal para agregar archivo
        $scope.abrirModalTarea();
        break;

      case "conArchivo":
        // Marcar como entregada
        $scope.abrirModalTarea();
        break;

      case "entregada":
        // Anular entrega (volver al estado anterior)
        $scope.anularEntrega();
        break;
    }
  };
  // 🔹 Entregar tarea (cambia estado)
  $scope.entregarTarea = function () {
    // Aquí podrías hacer un $http.post a tu backend para registrar la entrega
    alert("Tarea entregada ✅");
    $scope.estadoEntrega = "entregada";
  };
  // 🔹 Anular entrega (volver a subir otro archivo)
  $scope.anularEntrega = function () {
    if (confirm("¿Deseas anular la entrega y subir un nuevo archivo?")) {
      // Podrías eliminar el registro o permitir sobreescribir
      $scope.estadoEntrega = "conArchivo";
    }
  };

  $scope.consultarArchivosM = function () {
    $scope.buscar.id_tareas = getParameterByName("id_tarea");
    $scope.buscar.id_usuario = document.getElementById("idUsuario").value;

    $http
      .post("../api/consultarArchivoHistorialTareaPorTarea.php", $scope.buscar)
      .success(function (data) {
        $scope.archivos = data;

        // Actualiza el estado según los archivos
        if ($scope.archivos && $scope.archivos.length > 0) {
          // Si hay archivos, mostrar “Entregar tarea”
          $scope.estadoEntrega = "entregada";
        } else {
          // Si no hay archivos, mostrar “Agregar archivo”
          $scope.estadoEntrega = "sinArchivo";
        }
      })
      .error(function (data) {
        alert("Error BD" + data);
      });
  };

  $scope.eliminarArchivosM = function (id) {
    if (confirm("¿Estás seguro de eliminar este archivo?")) {
      $scope.buscar.id_tareas = getParameterByName("id_tarea");
      $scope.buscar.id_usuario = document.getElementById("idUsuario").value;

      $http
        .post("../api/eliminarArchivoHistorialTarea.php", $scope.buscar)
        .success(function () {
          $scope.consultarArchivosM();
        })
        .error(function (data) {
          alert("Error BD" + data);
        });
    }
  };

  setTimeout(function () {
    var quill = new Quill("#editore", {
      theme: "snow",
      modules: {
        toolbar: [
          ["bold", "italic", "underline"],
          [{ list: "ordered" }, { list: "bullet" }],
        ],
      },
    });
    $scope.guardarTareaComentario = function () {
      var contenido = quill.root.innerHTML;
      $scope.anuncio.id_tarea = getParameterByName("id_tarea");
      $scope.anuncio.id_usuario = document.getElementById("idUsuario").value; // As
      $scope.anuncio.comentario = contenido;

      //alert($scope.anuncio.mensaje+ " "+ $scope.anuncio.id_clase);
      if ($scope.anuncio.id == null) {
        $http
          .post("../api/guardarComentario.php", $scope.anuncio)
          .success(function (data, status, headers, config) {
            quill.setText("");
            $scope.anuncio = {};
            $scope.consultarTareaComentarios();
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      } 
    };
 $scope.tiempoTranscurridoComentario = function (fechaString) {
      var fecha = new Date(fechaString);
      var ahora = new Date();
      var diffMs = ahora - fecha;

      var segundos = Math.floor(diffMs / 1000);
      var minutos = Math.floor(segundos / 60);
      var horas = Math.floor(minutos / 60);
      var dias = Math.floor(horas / 24);

      // Formato de hora exacta
      var fechaLocal = fecha.toLocaleDateString("es-MX", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
      });
      var horaLocal = fecha.toLocaleTimeString("es-MX", {
        hour: "2-digit",
        minute: "2-digit",
      });

      // Texto del tiempo transcurrido
      var textoTiempo;
      if (dias > 0) textoTiempo = "hace " + dias + " día(s)";
      else if (horas > 0) textoTiempo = "hace " + horas + " hora(s)";
      else if (minutos > 0) textoTiempo = "hace " + minutos + " minuto(s)";
      else if (segundos > 0) textoTiempo = "hace " + segundos + " segundo(s)";
      else textoTiempo = "hace unos segundos";

      return (
        "Publicado el " + fechaLocal + " " + horaLocal + " — " + textoTiempo
      );
    };
    $scope.eliminarTareaComentarios = function (id) {
      if (confirm("¿Estás seguro de eliminar este anuncio?")) {
        $scope.buscar.id = id;
        $http
          .post("../api/eliminarComentario.php", $scope.buscar)
          .success(function (data, status, headers, config) {
            $scope.consultarAnuncios();
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      }
    };
  }, 500);
  $scope.consultarTareaComentarios = function () {
    $scope.buscarcomentario.id_tarea = getParameterByName("id_tarea");
    $scope.buscarcomentario.id_usuario =
      document.getElementById("idUsuario").value;

    $http
      .post(
        "../api/consultarComentariosPorUsuarioYTarea.php",
        $scope.buscarcomentario
      )
      .success(function (data, status, headers, config) {
        $scope.tareacomentarios = data;
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  // -----------------------------------
  // Cierre de TAREAS
  // -----------------------------------

  // -----------------------------------
  // MATERIALES
  // -----------------------------------
  $scope.consultarMaterialId = function () {
    $scope.id_buscarmaterial = getParameterByName("id_material");
    $http
      .post("../api/consultarMaterialId.php", { id: $scope.id_buscarmaterial })
      .success(function (data) {
        $scope.material = data;
      })
      .error(function (err) {
        alert("Error al consultar tareas: " + err);
      });
  };

  // -----------------------------------
  // Cierre de MATERIALES
  // -----------------------------------

  // -----------------------------------
  // CUESTIONARIOS
  // -----------------------------------
  $scope.cuestionario = {};
  $scope.preguntas = {};
  $scope.respuestas = {};
  $scope.temas ={};

  $scope.consultarCuestionarioId = function () {
    $scope.id_buscarcuestionario = getParameterByName("id_cuestionario");
    $http
      .post("../api/consultarCuestionarioContenidoIdCuestionarioClase.php", {
        id_cuestionario: $scope.id_buscarcuestionario,
      })
      .success(function (data) {
        $scope.cuestionario = data.cuestionario;
        $scope.preguntas = data.preguntas;
      })
      .error(function (err) {
        alert("Error al consultar tareas: " + err);
      });
  };

  $scope.guardarCuestionarioHistorial = function () {
    if (!$scope.preguntas || $scope.preguntas.length === 0) {
      alert("No hay preguntas cargadas.");
      return;
    }

    let correctas = 0;

    $scope.preguntas.forEach((p) => {
      if ($scope.respuestas && $scope.respuestas[p.id] === p.respuesta) {
        correctas++;
      }
    });

    const total = $scope.preguntas.length;
    const calificacion = ((correctas / total) * 100).toFixed(2);

    // Marca el cuestionario como enviado (para bloquear y mostrar colores)
    $scope.cuestionarioEnviado = true;

    // Guarda en la base de datos
    $http
      .post("../api/guardarHistorialCuestionario.php", {
        id_cuestionario: $scope.cuestionario.id,
        id_usuario: document.getElementById("idUsuario").value,
        calificacion: calificacion,
      })
      .then((response) => {
        const data = response.data;
        if (data.success) {
          alert(
            "✅ Cuestionario enviado.\nTu calificación: " + calificacion + "%"
          );
          $scope.cuestionarioEnviado = true;
        } else {
          alert("⚠️ " + data.message);
          if (data.message.includes("Ya has contestado")) {
            $scope.cuestionarioEnviado = true;
          }
        }
      })
      .catch((error) => {
        console.error(error);
        alert("❌ Error al guardar el historial.");
      });
  };

$scope.consultarCuestionarioHistorial = function() {
    $scope.clase.id = getParameterByName("id_clase");
    $scope.usuario.id_usuario = document.getElementById("idUsuario").value;
    $scope.id_buscarcuestionario = getParameterByName("id_cuestionario"); // Cuestionario actual

    $http.post("../api/consultarHistorialCuestionarioUsuario.php", {
        id_usuario: $scope.usuario.id_usuario,
        id_cuestionario: $scope.id_buscarcuestionario
    })
    .success(function(data){
        $scope.temas = [{ cuestionarios: [data] }]; // Solo un cuestionario
    })
    .error(function(err){
        console.error(err);
    });
};

$scope.consultarCuestionarioHistorial();


  // --- Función para enviar respuestas ---
  $scope.enviarRespuestas = function () {
    console.log("Respuestas del usuario:", $scope.respuestas);
    alert("Respuestas guardada.");
  };  
  // -----------------------------------
  // Cierre de CUESTIONARIOS
  // -----------------------------------

  // -----------------------------------
  // CALIFICACIONES
  // -----------------------------------

 // Consultar alumno logueado con sus tareas asignadas
$scope.consultarTareasCalificacion = function () {
    $scope.clase.id = getParameterByName("id_clase");
    $scope.id_buscartarea = getParameterByName("id_tarea");
    
    $scope.usuario.id_usuario = document.getElementById("idUsuario").value;

    // Mandamos ambos valores al PHP
    let datos = {
        id: $scope.clase.id,              // id_clase
        id_usuario: $scope.usuario.id_usuario
    };

    $http
      .post("../api/consultarHistorial_tareasAlumnos.php", datos)
      .success(function (data) {
        $scope.tareasAlumnos = data;
      })
      .error(function (data) {
        alert("Error BD: " + data);
      });
};
// Consultar cuestionarios del usuario logueado
$scope.consultarCuestionariosCalificacion = function () {
    $scope.clase.id = getParameterByName("id_clase");
    $scope.usuario.id_usuario = document.getElementById("idUsuario").value;

    // Lo que enviamos al PHP
    let datos = {
        id: $scope.clase.id,               // id_clase
        id_usuario: $scope.usuario.id_usuario
    };

    $http
      .post("../api/consultarHistorial_CuestionariosAlumnos.php", datos)
      .success(function (data) {
        $scope.cuestionariosAlumnos = data;
      })
      .error(function (data) {
        alert("Error BD: " + data);
      });
};

  
 
  // -----------------------------------
  // CALIFICACIONES
  // -----------------------------------

  // -----------------------------------
  // Alumnos
  // -----------------------------------
  $scope.alumnos = {};
  

  $scope.buscarMaestroPorIdClase = function (id) {
    var resultado = $scope.clasesInscritas.filter(function (item) {
      return item.id === id;
    });
    return resultado.length > 0 ? resultado[0].maestro : null;
  };

  $scope.consultarAlumnos = function () {
    $scope.buscar.id_clase = getParameterByName("id_clase");
    $http
      .post("../api/consultarClaseEstudianteIdClase.php", $scope.buscar)
      .success(function (data, status, headers, config) {
        $scope.alumnos = data;
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  $scope.consultarAlumnos();

  // -----------------------------------
  // Cierre de ALUMNOS
  // -----------------------------------

  // -----------------------------------
  // codigo generico para la navegacion
  // -----------------------------------

  $scope.clase = {};
  $scope.usuario = {};
  $scope.clasesImpartidas = {};
  $scope.clasesInscritas = {};

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
      .success(function (data, status, headers, config) {
        $scope.clase = data[0];
        // setTimeout(function () {$scope.creaU = false;}, 1000);
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
    $http
      .post("../api/consultarClaseIdUsuario.php", $scope.usuario)
      .success(function (data, status, headers, config) {
        $scope.clasesImpartidas = data;
        // setTimeout(function () {$scope.creaU = false;}, 1000);
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });

    $http
      .post("../api/consultarClasesEstudianteIdEstudiante.php", $scope.usuario)
      .success(function (data, status, headers, config) {
        $scope.clasesInscritas = data;
        // setTimeout(function () {$scope.creaU = false;}, 1000);
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  $scope.modificarClase = function () {
    $scope.clase.id_usuario = document.getElementById("idUsuario").value;
    $http
      .post("../api/modificarClases.php", $scope.clase)
      .success(function (data, status, headers, config) {
        alert("Registrado");
        // setTimeout(function () {$scope.creaU = false;}, 1000);
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  $scope.consultarClases();
  $scope.consultarTemas();
  $scope.consultarTarea();
  $scope.consultarArchivosM();
  $scope.consultarMaterialId();
  $scope.consultarCuestionarioId();
  $scope.consultarTareaComentarios();
   $scope.consultarTareasCalificacion();
   $scope.consultarCuestionariosCalificacion();
}); // Cierre APP.Controller

App.directive("uploaderModel", [
  "$parse",
  function ($parse) {
    return {
      restrict: "A",
      link: function (scope, iElement, iAttrs) {
        iElement.on("change", function (e) {
          $parse(iAttrs.uploaderModel).assign(scope, iElement[0].files[0]);
        });
      },
    };
  },
]);
