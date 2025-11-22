    <?php require_once 'encabezadoClase.php'; ?>
    <link rel="stylesheet" href="./css/quill.snow.css">
    <script src="./controlador/quill.min.js"></script>
    <script src="./controlador/angular-sanitize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script>

    <header>
        <style>
            body {
                background-color: #f5f5f5;
                font-family: 'Poppins', 'DM Sans', 'Segoe UI', sans-serif;
                letter-spacing: 0.3px;
            }

            .google-form {
                max-width: 850px;
                margin: auto;
            }

            /*Encabezado*/
            .form-header {
                background: linear-gradient(135deg, #4285f4, #34a853, #fbbc05, #ea4335);
                background-size: 300% 300%;
                animation: gradientMove 6s ease infinite;
                color: white;
                border-radius: 20px;
                padding: 60px 40px;
                text-align: center;
                position: relative;
                overflow: hidden;
                box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
            }

            @keyframes gradientMove {
                0% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }

                100% {
                    background-position: 0% 50%;
                }
            }

            .form-header::before {
                content: "";
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.1);
                z-index: 0;
            }

            .form-header-content {
                position: relative;
                z-index: 1;
            }

            .icon-circle {
                background: rgba(255, 255, 255, 0.25);
                width: 90px;
                height: 90px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 45px;
                color: white;
                margin: 0 auto 20px auto;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }

            .form-header h2 {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                margin-bottom: 10px;
                font-size: 3.4rem;
                letter-spacing: 0.5px;
                animation: fadeInUp 0.8s ease;
            }

            .form-header p {
                font-family: 'DM Sans', sans-serif;
                font-size: 1.5rem;
                opacity: 0.9;
                animation: fadeInUp 1s ease;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Cuerpo del formulario */
            .question-card {
                background: #ffffff;
                border-radius: 16px;
                padding: 35px;
                margin-bottom: 25px;
                border: 1px solid #e0e0e0;
                box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
                transition: all 0.35s ease;
                cursor: pointer;
                position: relative;
            }

            .question-card:hover {
                transform: translateY(-6px) scale(1.02);
                box-shadow: 0px 10px 25px rgba(66, 133, 244, 0.2);
                border-color: #c8dafc;
                background: linear-gradient(180deg, #ffffff, #f8faff);
            }

            .question-number {
                background-color: #4285f4;
                color: white;
                border-radius: 50%;
                width: 36px;
                height: 36px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                margin-right: 10px;
                font-size: 1.4rem;
            }

            h5 {
                font-family: 'DM Sans', sans-serif;
                color: #202124;
                font-weight: 600;
                font-size: 2.0rem;
                margin-bottom: 25px;
                display: flex;
                align-items: center;
                transition: color 0.3s ease;
            }

            .question-card:hover h5 {
                color: #4285f4;
            }

            .form-check {
                position: relative;
                margin-bottom: 14px;
            }

            /* 🔹 Ocultamos el input nativo */
            .form-check-input {
                position: absolute;
                opacity: 0;
            }

            /* 🔹 Círculo visual del radio */
            .custom-radio {
                display: inline-block;
                width: 20px;
                height: 20px;
                border: 2px solid #5f6368;
                border-radius: 50%;
                margin-right: 12px;
                vertical-align: middle;
                transition: all 0.25s ease;
                position: relative;
            }

            /* 🔹 Punto interno del radio */
            .custom-radio::after {
                content: "";
                position: absolute;
                top: 50%;
                left: 50%;
                width: 10px;
                height: 10px;
                background-color: white;
                border-radius: 50%;
                transform: translate(-50%, -50%) scale(0);
                transition: transform 0.2s ease;
            }

            /* ✅ Estado seleccionado con animación “pop” */
            .form-check-input:checked+label .custom-radio {
                border-color: #4285f4;
                background-color: #4285f4;
                box-shadow: 0 0 0 4px rgba(66, 133, 244, 0.25);
                animation: popSelect 0.25s ease;
            }

            .form-check-input:checked+label .custom-radio::after {
                transform: translate(-50%, -50%) scale(1);
            }

            /* 🎬 Animación del "pop" */
            @keyframes popSelect {
                0% {
                    transform: scale(0.7);
                }

                50% {
                    transform: scale(1.2);
                }

                100% {
                    transform: scale(1);
                }
            }

            /* ✅ Estilo del label */
            .form-check-label {
                display: flex;
                align-items: center;
                gap: 10px;
                cursor: pointer;
                padding: 10px 15px;
                border-radius: 10px;
                background-color: #fafafa;
                border: 1px solid transparent;
                transition: all 0.3s ease;
            }

            .form-check-label:hover {
                background-color: #f1f3f4;
                transform: translateX(4px);
            }

            /* ✅ Label seleccionado */
            .form-check-input:checked+label {
                background-color: #e8f0fe;
                font-weight: 500;
                border-color: #d2e3fc;
                color: #202124;
            }


            /* Botón */
            .btn-primary {
                background-color: #4285f4;
                border: none;
                font-weight: 600;
                font-family: 'Poppins', sans-serif;
                font-size: 1.4rem;
                padding: 14px 45px;
                border-radius: 50px;
                transition: all 0.3s ease;
                box-shadow: 0 6px 14px rgba(66, 133, 244, 0.4);
            }

            .btn-primary:hover {
                background-color: #3367d6;
                transform: translateY(-3px) scale(1.05);
                box-shadow: 0 8px 20px rgba(66, 133, 244, 0.5);
            }

            .correcta {
                border: 2px solid #34a853 !important;
                background-color: #e6f4ea;
            }

            .incorrecta {
                border: 2px solid #ea4335 !important;
                background-color: #fce8e6;
            }

            .resultado-correcto {
                color: #188038;
                font-weight: bold;
                margin-top: 8px;
            }

            .resultado-incorrecto {
                color: #d93025;
                font-weight: bold;
                margin-top: 8px;
            }
        </style>
    </header>

    <div id="content" class="container">

        <!-- 🏫 Encabezado del formulario -->
        <div class="form-header mt-4 mb-5" ng-if="cuestionario">
            <div class="form-header-content">
                <div class="icon-circle">
                    <i class="bi bi-journal-check"></i>
                </div>
                <h2 ng-bind-html="cuestionario.titulo"></h2>
                <p ng-bind-html="cuestionario.descripcion"></p>
            </div>
        </div>
        <br>
        <!-- 📝 Cuerpo del formulario -->
        <form id="formCuestionario" class="google-form">
            <div ng-repeat="pregunta in preguntas"
                class="question-card"
                ng-class="{
        'correcta': respuestas[pregunta.id] === pregunta.respuesta && cuestionarioEnviado,
        'incorrecta': respuestas[pregunta.id] !== pregunta.respuesta && cuestionarioEnviado
     }">

                <h5>
                    <span class="question-number">{{$index + 1}}</span>
                    <span ng-bind-html="pregunta.pregunta"></span>
                </h5>

                <div class="form-check"
                    ng-repeat="opcion in [pregunta.opcion1, pregunta.opcion2, pregunta.opcion3, pregunta.opcion4]"
                    ng-if="opcion">

                    <input class="form-check-input"
                        type="radio"
                        name="pregunta{{pregunta.id}}"
                        id="opcion{{$index}}-{{pregunta.id}}"
                        ng-value="opcion"
                        ng-model="respuestas[pregunta.id]"
                        ng-disabled="cuestionarioEnviado">

                    <label class="form-check-label" for="opcion{{$index}}-{{pregunta.id}}">
                        <span class="custom-radio"></span>
                        {{ opcion }}
                    </label>
                </div>

                <!-- Mensaje de resultado -->
                <div ng-if="cuestionarioEnviado">
                    <p ng-if="respuestas[pregunta.id] === pregunta.respuesta" class="resultado-correcto">✅ Correcta</p>
                    <p ng-if="respuestas[pregunta.id] !== pregunta.respuesta" class="resultado-incorrecto">
                        ❌ Incorrecta — Respuesta correcta: <b>{{ pregunta.respuesta }}</b>
                    </p>
                </div>
            </div>

        </form>

        <div class="text-center mb-5">
            <button type="button" class="btn btn-primary" ng-click="guardarCuestionarioHistorial()">
                Enviar respuestas
            </button>

        </div>


    </div>
    <br>
    <?php require_once 'pie.php'; ?>