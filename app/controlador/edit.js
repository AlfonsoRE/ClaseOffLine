var App = angular.module("app", ["ngSanitize"]);

App.controller("editCtrl", function ($scope, $http, $sce) {
  // Anuncios
  $scope.clase = {};
  $scope.tareasAlumnos = [];
  $scope.anuncio = {}; //
  $scope.anuncios = {}; //
  $scope.nuevoAnuncio = ""; //
  $scope.documento = null; //
  $scope.archivo = {}; //
  $scope.archivos = {}; //
  $scope.enlace = {}; //
  $scope.enlaces = {}; //
  $scope.buscar = {}; //
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
  $scope.pregunta = {};
  $scope.preguntaMod = {};
  $scope.preguntas = {};
  var quill;
  var quillM;
  var quillC;
  var quillCu;
  var quillPe;

  quillCu = new Quill("#editorCu", {
    theme: "snow",
    modules: {
      toolbar: [
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
      ],
    },
  });

  quillPe = new Quill("#editorPe", {
    theme: "snow",
    modules: {
      toolbar: [
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
      ],
    },
  });

  quillC = new Quill("#editorC", {
    theme: "snow",
    modules: {
      toolbar: [
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
      ],
    },
  });

  setTimeout(function () {
    quillM = new Quill("#editorM", {
      theme: "snow",
      modules: {
        toolbar: [
          ["bold", "italic", "underline"],
          [{ list: "ordered" }, { list: "bullet" }],
        ],
      },
    });
  }, 500);

  setTimeout(function () {
    quill = new Quill("#editor", {
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

    $scope.TiempoTranscurrido = function (fechaString) {
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

    $scope.eliminarAnuncio = function (id) {
      if (confirm("¿Estás seguro de eliminar este anuncio?")) {
        $scope.buscar.id = id;
        $http
          .post("../api/eliminarAnuncio.php", $scope.buscar)
          .success(function (data, status, headers, config) {
            $scope.consultarAnuncios();
          })
          .error(function (data, status, headers, config) {
            alert("Error BD" + data);
          });
      }
    };

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

  // -----------------------------------
  // TAREAS
  // -----------------------------------
  $scope.anuncio = {};
  $scope.tareacomentarios = {};
  $scope.buscarcomentario = {};

  $scope.abrirModalTarea = function () {
    $scope.consultarTemas();
    $scope.nuevaTarea = {};
    quill.setText("");
    $scope.consultarArchivosT();
    $scope.consultarEnlacesT();
    $("#modalAgregarTarea").modal("show");
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
    $scope.nuevaTarea.descripcion = contenido;
    if ($scope.nuevaTarea.id == null) {
      $http
        .post("../api/guardarTarea.php", $scope.nuevaTarea)
        .success(function (data, status, headers, config) {
          //$scope.consultarTareas();
          $scope.consultarTemas();
          $scope.nuevaTarea = {};
          quill.setText("");
          $scope.consultarArchivosT();
          $scope.consultarEnlacesT();
          $("#ModalTareaClose").click();
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    } else {
      $http
        .post("../api/modificarTarea.php", $scope.nuevaTarea)
        .success(function (data, status, headers, config) {
          //$scope.consultarTareas();
          $scope.consultarTemas();
          $scope.nuevaTarea = {};
          quill.setText("");
          $scope.consultarArchivosT();
          $scope.consultarEnlacesT();
          $("#ModalTareaClose").click();
        })
        .error(function (data, status, headers, config) {
          alert("Error al guardar tarea: " + error);
        });
    }
  };

  $scope.eliminarTarea = function (tarea) {
    if (confirm("¿Eliminar esta tarea?")) {
      $http
        .post("../api/eliminarTarea.php", { id: tarea.id })
        .success(function () {
          $scope.consultarTemas();
        })
        .error(function (err) {
          alert("Error al eliminar tarea: " + err);
        });
    }
  };

  $scope.abrirModalEditarTarea = function (tarea) {
    $scope.nuevaTarea = angular.copy(tarea);
    $scope.archivo = {};
    $scope.documento = null;
    $scope.consultarArchivosT();
    $scope.enlace = {};
    $scope.consultarEnlacesT();
    quill.clipboard.dangerouslyPasteHTML($scope.nuevaTarea.descripcion);
    $("#modalAgregarTarea").modal();
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

  $scope.subirArchivoT = function () {
    if (!$scope.nuevaTarea.id_tema) {
      alert("El tema de la tarea es obligatorio.");
      return;
    }
    if (!$scope.nuevaTarea.titulo) {
      alert("El título de la tarea es obligatorio.");
      return;
    }

    $scope.nuevaTarea.id_clase = getParameterByName("id_clase");
    var contenido = quill.root.innerHTML;
    $scope.nuevaTarea.descripcion = contenido;
    if ($scope.nuevaTarea.id == null) {
      $http
        .post("../api/guardarTarea.php", $scope.nuevaTarea)
        .success(function (data, status, headers, config) {
          $scope.nuevaTarea.id = data;
          $("#ModalArchivo").modal("show");
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    } else {
      $http
        .post("../api/modificarTarea.php", $scope.nuevaTarea)
        .success(function (data, status, headers, config) {
          $("#ModalArchivo").modal("show");
        })
        .error(function (data, status, headers, config) {
          alert("Error al guardar tarea: " + error);
        });
    }
  };

  $scope.guardarArchivoT = function () {
    $scope.archivo.id_tareas = $scope.nuevaTarea.id;
    var formData = new FormData();
    formData.append("json", JSON.stringify($scope.archivo)); // Enviar JSON con los parámetros
    formData.append("archivo", $scope.documento); // Enviar archivo

    $http
      .post("../api/guardarArchivoTarea.php", formData, {
        headers: { "Content-Type": undefined },
        transformRequest: angular.identity,
      })
      .then(
        function (response) {
          $scope.archivo = {};
          $scope.documento = null;
          $scope.consultarArchivosT();
          $("#ModalArchivoClose").click();
        },
        function (error) {
          $scope.mensaje = "Error al subir archivo";
          alert("Error BD" + data);
        }
      );
  };

  $scope.consultarArchivosT = function () {
    $scope.buscar.id_tareas = $scope.nuevaTarea.id;
    //$scope.buscar.id_anuncio = 22;
    $http
      .post("../api/consultarArchivoTareasporTarea.php", $scope.buscar)
      .success(function (data, status, headers, config) {
        $scope.archivos = data;
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  $scope.agregarEnlaceT = function () {
    if (!$scope.nuevaTarea.id_tema) {
      alert("El tema de la tarea es obligatorio.");
      return;
    }
    if (!$scope.nuevaTarea.titulo) {
      alert("El título de la tarea es obligatorio.");
      return;
    }
    $scope.nuevaTarea.id_clase = getParameterByName("id_clase");
    var contenido = quill.root.innerHTML;
    $scope.nuevaTarea.descripcion = contenido;
    if ($scope.nuevaTarea.id == null) {
      $http
        .post("../api/guardarTarea.php", $scope.nuevaTarea)
        .success(function (data, status, headers, config) {
          $scope.nuevaTarea.id = data;
          $("#ModalEnlace").modal("show");
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    } else {
      $http
        .post("../api/modificarTarea.php", $scope.nuevaTarea)
        .success(function (data, status, headers, config) {
          $("#ModalEnlace").modal("show");
        })
        .error(function (data, status, headers, config) {
          alert("Error al guardar tarea: " + error);
        });
    }
  };

  $scope.guardarEnlaceT = function () {
    $scope.enlace.id_tareas = $scope.nuevaTarea.id;
    $http
      .post("../api/guardarEnlaceTarea.php", $scope.enlace)
      .success(function (data, status, headers, config) {
        $scope.enlace = {};
        $scope.consultarEnlacesT();
        $("#ModalEnlaceClose").click();
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  $scope.consultarEnlacesT = function () {
    $scope.buscar.id_tareas = $scope.nuevaTarea.id;
    // $scope.buscar.id_anuncios = 19;
    $http
      .post("../api/consultarEnlaceTareaPorTarea.php", $scope.buscar)
      .success(function (data, status, headers, config) {
        $scope.enlaces = data;
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  $scope.eliminarArchivoT = function (id) {
    if (confirm("¿Estás seguro de eliminar este archivo?")) {
      $scope.buscar.id = id;
      $http
        .post("../api/eliminarArchivoTareas.php", $scope.buscar)
        .success(function (data, status, headers, config) {
          $scope.consultarArchivosT();
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    }
  };

  $scope.eliminarEnlaceT = function (id) {
    if (confirm("¿Estás seguro de eliminar este enlace?")) {
      $scope.buscar.id = id;
      $http
        .post("../api/eliminarEnlaceTarea.php", $scope.buscar)
        .success(function (data, status, headers, config) {
          $scope.consultarEnlacesT();
        })
        .error(function (data, status, headers, config) {
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
      } else {
        $http
          .post("../api/modificarAnuncio.php", $scope.anuncio)
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
        "" + fechaLocal + " " + horaLocal + " — " + textoTiempo
      );
    };
    $scope.eliminarAnuncioComentarios = function (id) {
      if (confirm("¿Estás seguro de eliminar este anuncio?")) {
        $scope.buscar.id = id;
        $http
          .post("../api/eliminarAnuncio.php", $scope.buscar)
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
  $scope.consultarTareaComentarios();
  // -----------------------------------
  // MATERIALES
  // -----------------------------------

  $scope.abrirModalMaterial = function () {
    $scope.consultarTemas();
    $scope.nuevoMaterial = {};
    quillM.setText("");
    $scope.consultarArchivosM();
    $scope.consultarEnlacesM();
    $("#modalAgregarMaterial").modal("show");
  };

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
  $scope.consultarMateriales = function () {
    $http
      .post("../api/consultarMaterialId.php", { id_clase: $scope.id_clase })
      .success(function (data) {
        $scope.materiales = data;
      })
      .error(function (err) {
        alert("Error al consultar materiales: " + err);
      });
  };

  // Función para guardar un material
  $scope.guardarMaterial = function () {
    if (!$scope.nuevoMaterial.titulo || !$scope.nuevoMaterial.id_tema) {
      alert("El título y la descripción del material son obligatorios.");
      return;
    }

    $scope.nuevoMaterial.id_clase = getParameterByName("id_clase");
    var contenido = quillM.root.innerHTML;
    $scope.nuevoMaterial.descripcion = contenido;
    if ($scope.nuevoMaterial.id == null) {
      $http
        .post("../api/guardarMaterial.php", $scope.nuevoMaterial)
        .success(function (data, status, headers, config) {
          $scope.nuevoMaterial = {};
          quillM.setText("");
          $scope.consultarArchivosM();
          $scope.consultarEnlacesM();
          $scope.consultarTemas();
          $("#ModalMaterialClose").click();
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    } else {
      $http
        .post("../api/modificarMaterial.php", $scope.nuevoMaterial)
        .success(function (data, status, headers, config) {
          $scope.nuevoMaterial = {};
          quillM.setText("");
          $scope.consultarTemas();
          $scope.consultarArchivosM();
          $scope.consultarEnlacesM();
          $("#ModalMaterialClose").click();
        })
        .error(function (data, status, headers, config) {
          alert("Error al guardar tarea: " + error);
        });
    }
  };

  $scope.eliminarMaterial = function (material) {
    if (confirm("¿Eliminar este material?")) {
      $http
        .post("../api/eliminarMaterial.php", { id: material.id })
        .success(function () {
          $scope.consultarTemas();
        })
        .error(function (err) {
          alert("Error al eliminar material: " + err);
        });
    }
  };

  $scope.subirArchivoM = function () {
    if (!$scope.nuevoMaterial.id_tema) {
      alert("El tema de la tarea es obligatorio.");
      return;
    }
    if (!$scope.nuevoMaterial.titulo) {
      alert("El título de la tarea es obligatorio.");
      return;
    }

    $scope.nuevoMaterial.id_clase = getParameterByName("id_clase");
    var contenido = quillM.root.innerHTML;
    $scope.nuevoMaterial.descripcion = contenido;
    if ($scope.nuevoMaterial.id == null) {
      $http
        .post("../api/guardarMaterial.php", $scope.nuevoMaterial)
        .success(function (data, status, headers, config) {
          $scope.nuevoMaterial.id = data;
          $("#ModalArchivoM").modal("show");
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    } else {
      $http
        .post("../api/modificarMaterial.php", $scope.nuevoMaterial)
        .success(function (data, status, headers, config) {
          $("#ModalArchivoM").modal("show");
        })
        .error(function (data, status, headers, config) {
          alert("Error al guardar tarea: " + error);
        });
    }
  };

  $scope.guardarArchivoM = function () {
    $scope.archivo.id_material = $scope.nuevoMaterial.id;
    var formData = new FormData();
    formData.append("json", JSON.stringify($scope.archivo)); // Enviar JSON con los parámetros
    formData.append("archivo", $scope.documento); // Enviar archivo

    $http
      .post("../api/guardarArchivosMaterial.php", formData, {
        headers: { "Content-Type": undefined },
        transformRequest: angular.identity,
      })
      .then(
        function (response) {
          $scope.archivo = {};
          $scope.documento = null;
          $scope.consultarArchivosM();
          $("#ModalArchivoMClose").click();
        },
        function (error) {
          $scope.mensaje = "Error al subir archivo";
          alert("Error BD" + data);
        }
      );
  };

  $scope.consultarArchivosM = function () {
    $scope.buscar.id_material = $scope.nuevoMaterial.id;
    //$scope.buscar.id_anuncio = 22;
    $http
      .post("../api/consultarArchivosMaterialIdMaterial.php", $scope.buscar)
      .success(function (data, status, headers, config) {
        $scope.archivos = data;
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  $scope.agregarEnlaceM = function () {
    if (!$scope.nuevoMaterial.titulo) {
      alert("El título de la tarea es obligatorio.");
      return;
    }
    if (!$scope.nuevoMaterial.id_tema) {
      alert("El tema de la tarea es obligatorio.");
      return;
    }

    $scope.nuevoMaterial.id_clase = getParameterByName("id_clase");
    var contenido = quillM.root.innerHTML;
    $scope.nuevoMaterial.descripcion = contenido;
    if ($scope.nuevoMaterial.id == null) {
      $http
        .post("../api/guardarMaterial.php", $scope.nuevoMaterial)
        .success(function (data, status, headers, config) {
          $scope.nuevoMaterial.id = data;
          $("#ModalEnlaceM").modal("show");
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    } else {
      $http
        .post("../api/modificarMaterial.php", $scope.nuevoMaterial)
        .success(function (data, status, headers, config) {
          $("#ModalEnlaceM").modal("show");
        })
        .error(function (data, status, headers, config) {
          alert("Error al guardar tarea: " + error);
        });
    }
  };

  $scope.guardarEnlaceM = function () {
    $scope.enlace.id_material = $scope.nuevoMaterial.id;
    $http
      .post("../api/guardarEnlaceMaterial.php", $scope.enlace)
      .success(function (data, status, headers, config) {
        $scope.enlace = {};
        $scope.consultarEnlacesM();
        $("#ModalEnlaceMClose").click();
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  $scope.consultarEnlacesM = function () {
    $scope.buscar.id_material = $scope.nuevoMaterial.id;
    // $scope.buscar.id_anuncios = 19;
    $http
      .post("../api/consultarEnlaceMaterialPorMaterial.php", $scope.buscar)
      .success(function (data, status, headers, config) {
        $scope.enlaces = data;
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  $scope.eliminarArchivoM = function (id) {
    if (confirm("¿Estás seguro de eliminar este archivo?")) {
      $scope.buscar.id = id;
      $http
        .post("../api/eliminarArchivosMaterial.php", $scope.buscar)
        .success(function (data, status, headers, config) {
          $scope.consultarArchivosM();
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    }
  };

  $scope.eliminarEnlaceM = function (id) {
    if (confirm("¿Estás seguro de eliminar este enlace?")) {
      $scope.buscar.id = id;
      $http
        .post("../api/eliminarEnlaceMaterial.php", $scope.buscar)
        .success(function (data, status, headers, config) {
          $scope.consultarEnlacesT();
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    }
  };

  $scope.abrirModalEditarMaterial = function (material) {
    $scope.nuevoMaterial = angular.copy(material);
    $scope.archivo = {};
    $scope.documento = null;
    $scope.consultarArchivosM();
    $scope.enlace = {};
    $scope.consultarEnlacesM();
    quillM.clipboard.dangerouslyPasteHTML($scope.nuevoMaterial.descripcion);
    $("#modalAgregarMaterial").modal();
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

  // -----------------------------------
  // CUESTIONARIOS
  // -----------------------------------
  $scope.consultarCuestionario = function () {
    if (getParameterByName("id_cuestionario") !== "") {
      $http
        .post("../api/consultarCuestionario.php", {
          id: getParameterByName("id_cuestionario"),
        })
        .success(function (data) {
          $scope.nuevoCuestionario = data;
          quillCu.clipboard.dangerouslyPasteHTML(
            $scope.nuevoCuestionario.descripcion
          );
        })
        .error(function (err) {
          alert("Error al consultar cuestionarios: " + err);
        });
    }
  };
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
    if (!$scope.nuevoCuestionario.id_tema) {
      alert("El título del cuestionario es obligatorio.");
      return;
    }
    if (!$scope.nuevoCuestionario.titulo) {
      alert("El tema del cuestionario es obligatorio.");
      return;
    }

    $scope.nuevoCuestionario.id_clase = getParameterByName("id_clase");
    var contenido = quillC.root.innerHTML;
    $scope.nuevoCuestionario.descripcion = contenido;

    $http
      .post("../api/guardarCuestionario.php", $scope.nuevoCuestionario)
      .success(function (data, status, headers, config) {
        const nuevoId = data.id;
        if (!nuevoId) {
          alert("No se pudo obtener el ID del cuestionario creado.");
          return;
        }
        window.location.href = `editCuestionario.php?id_clase=${$scope.nuevoCuestionario.id_clase}&id_cuestionario=${nuevoId}`;
      })
      .error(function (data, status, headers, config) {
        alert("Error BD" + data);
      });
  };

  $scope.editarCuestionario = function (cues) {
    window.location.href = `editCuestionario.php?id_clase=${cues.id_clase}&id_cuestionario=${cues.id}`;
  };

  $scope.modificarCuestionario = function () {
    if (!$scope.nuevoCuestionario.id_tema) {
      alert("El título del cuestionario es obligatorio.");
      return;
    }
    if (!$scope.nuevoCuestionario.titulo) {
      alert("El tema del cuestionario es obligatorio.");
      return;
    }
    $scope.nuevoCuestionario.id_clase = getParameterByName("id_clase");
    var contenido = quillCu.root.innerHTML;
    $scope.nuevoCuestionario.descripcion = contenido;
    $http
      .post("../api/modificarCuestionario.php", $scope.nuevoCuestionario)
      .then(
        function (response) {
          alert("Cuestionario modificado");
        },
        function (error) {
          alert("Error al guardar cuestionario: " + error.data);
        }
      );
  };

  $scope.guardarPregunta = function () {
    var contenido = quillC.root.innerHTML;
    var valid = quillC.getText().trim();
    $scope.pregunta.pregunta = contenido;
    $scope.pregunta.id_cuestionario = $scope.nuevoCuestionario.id;
    if (
      valid === "" ||
      !$scope.pregunta.opcion1 ||
      !$scope.pregunta.opcion2 ||
      !$scope.pregunta.opcion3 ||
      !$scope.pregunta.opcion4 ||
      !$scope.pregunta.respuesta
    ) {
      alert("Por favor, completa todos los campos antes de guardar.");
      return;
    }

    if (
      $scope.pregunta.opcion1 !== $scope.pregunta.respuesta &&
      $scope.pregunta.opcion2 !== $scope.pregunta.respuesta &&
      $scope.pregunta.opcion3 !== $scope.pregunta.respuesta &&
      $scope.pregunta.opcion4 !== $scope.pregunta.respuesta
    ) {
      alert(
        "Por favor, una opcion debe ser textualmente igual a la respuesta."
      );
      return;
    }

    $http
      .post("../api/guardarCuestionariosContenido.php", $scope.pregunta)
      .success(function (data) {
        $scope.pregunta = {};
        quillC.setText("");
        $scope.consultarPreguntas();
        $("#ModalPreguntaClose").click();
      })
      .error(function (err) {
        alert("Error al consultar cuestionarios: " + err);
      });
  };

  $scope.consultarPreguntas = function () {
    $http
      .post("../api/consultarCuestionarioContenidoIdCuestionario.php", {
        id_cuestionario: getParameterByName("id_cuestionario"),
      })
      .success(function (data) {
        $scope.preguntas = data;
      })
      .error(function (err) {
        alert("Error al consultar cuestionarios: " + err);
      });
  };

  $scope.formatQuill = function (pregunta) {
    let textoPlano = pregunta.replace(/<[^>]+>/g, "").trim(); // Elimina etiquetas
    let resumen =
      textoPlano.length > 60 ? textoPlano.slice(0, 60) + "..." : textoPlano;
    return resumen;
  };

  $scope.modalModificarPregunta = function (pregunta) {
    $scope.preguntaMod = pregunta;
    quillPe.clipboard.dangerouslyPasteHTML($scope.preguntaMod.pregunta);
    $("#modalModPregunta").modal();
  };

  $scope.modificarPregunta = function () {
    var contenido = quillPe.root.innerHTML;
    var valid = quillPe.getText().trim();
    $scope.preguntaMod.pregunta = contenido;
    if (
      valid === "" ||
      !$scope.preguntaMod.opcion1 ||
      !$scope.preguntaMod.opcion2 ||
      !$scope.preguntaMod.opcion3 ||
      !$scope.preguntaMod.opcion4 ||
      !$scope.preguntaMod.respuesta
    ) {
      alert("Por favor, completa todos los campos antes de modificar.");
      return;
    }

    if (
      $scope.preguntaMod.opcion1 !== $scope.preguntaMod.respuesta &&
      $scope.preguntaMod.opcion2 !== $scope.preguntaMod.respuesta &&
      $scope.preguntaMod.opcion3 !== $scope.preguntaMod.respuesta &&
      $scope.preguntaMod.opcion4 !== $scope.preguntaMod.respuesta
    ) {
      alert(
        "Por favor, una opcion debe ser textualmente igual a la respuesta."
      );
      return;
    }

    $http
      .post("../api/modificarCuestionariosContenido.php", $scope.preguntaMod)
      .success(function (data) {
        $scope.preguntaMod = {};
        quillPe.setText("");
        $scope.consultarPreguntas();
        $("#ModalModPreguntaClose").click();
      })
      .error(function (err) {
        alert("Error al consultar cuestionarios: " + err);
      });
  };

  $scope.eliminarPregunta = function (id) {
    if (confirm("¿Estás seguro de eliminar la pregunta?")) {
      $scope.buscar.id = id;
      $http
        .post("../api/eliminarCuestionariosContenido.php", $scope.buscar)
        .success(function (data, status, headers, config) {
          $scope.consultarPreguntas();
        })
        .error(function (data, status, headers, config) {
          alert("Error BD" + data);
        });
    }
  };

  $scope.eliminarCuestionario = function (cuestionario) {
    if (confirm("¿Eliminar este cuestionario?")) {
      $http
        .post("../api/eliminarCuestionario.php", { id: cuestionario.id })
        .success(function () {
          $scope.consultarTemas();
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
  // CALIFICACIONES
  // -----------------------------------

  // Consultar alumnos con sus tareas asignadas
  $scope.consultarTareasAlumnos = function () {
    $scope.clase.id = getParameterByName("id_clase");
    // Hacer la petición HTTP
    $http
      .post("../api/consultarHistorial_tareas.php", $scope.clase)
      .success(function (data) {
        $scope.tareasAlumnos = data;
      })
      .error(function (data) {
        alert("Error BD: " + data);
      });
  };
   // Consultar alumnos con sus tareas asignadas
  $scope.consultarCuestionariosAlumnos = function () {
    $scope.clase.id = getParameterByName("id_clase");
    // Hacer la petición HTTP
    $http
      .post("../api/consultarHistorial_Cuestionarios.php", $scope.clase)
      .success(function (data) {
        $scope.cuestionariosAlumnos = data;
      })
      .error(function (data) {
        alert("Error BD: " + data);
      });
  };

  // Modificar calificación
  $scope.actualizarCalificacion = function (tarea) {
    $http
      .post("../api/modificarHistorialTareas.php", tarea)
      .success(function (data) {
        $scope.consultarTareasAlumnos();
      })
      .error(function (data) {
        alert("Error BD: " + data);
      });
  };

  $scope.consultarTareasAlumnos();
  $scope.consultarCuestionariosAlumnos();
  $scope.consultarTemas();
  //$scope.consultarTareas();

  $scope.consultarTarea();
  $scope.consultarClases();
  $scope.consultarDatosMaestro();
  $scope.consultarCuestionario();
  $scope.consultarMateriales();
  $scope.consultarPreguntas();
  $scope.consultarMaterialId();
  //$scope.obtenerPreguntaInicial(); // ✅ solo una vez
});

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
