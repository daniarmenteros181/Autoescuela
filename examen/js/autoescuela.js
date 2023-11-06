window.addEventListener("load", function () {
    var btnComenzar = document.getElementById("comenzar");
    var divExamen = document.getElementById("examen");
    var preguntas = [];
    var indicePreguntaActual = 0;
    var respuestas = {}; // Objeto para almacenar las respuestas

    btnComenzar.addEventListener("click", comenzar);

    // Almacena los botones de pregunta
    var botonesPregunta = [];

    function comenzar() {
        btnComenzar.style.display = "none";

        fetch("plantilla/pregunta.html").then(x => x.text()).then(y => {
            var contenedor = document.createElement("div");
            contenedor.innerHTML = y;
            var pregunta = contenedor.querySelector(".pregunta");
    

            fetch("servidor/pregunta.json").then(x => x.json()).then(y => {

                preguntas = y.examen[0].pregunta;
                

                // Crear preguntas ocultas excepto la primera
                for (var i = 1; i < preguntas.length; i++) {
                    var preguntaClone = pregunta.cloneNode(true);
                    preguntaClone.style.display = 'none';
                    divExamen.appendChild(preguntaClone);
                }

                var btnSiguiente = contenedor.querySelector(".siguiente");
                var btnAtras = contenedor.querySelector(".atras");
             

            // Agregar eventos a los botones
            btnSiguiente.addEventListener("click", function () {
                if (indicePreguntaActual < preguntas.length - 1) {
                    indicePreguntaActual++;
                    mostrarPregunta(indicePreguntaActual);
                }
            });

            btnAtras.addEventListener("click", function () {
                if (indicePreguntaActual > 0) {
                    indicePreguntaActual--;
                    mostrarPregunta(indicePreguntaActual);
                }
            });

            divExamen.appendChild(btnSiguiente);
            divExamen.appendChild(btnAtras);


                mostrarPregunta(indicePreguntaActual);
                crearBotones(); // Llama a mostrarPreguntas después de cargar las preguntas

            });
        });
    }


    //Funcion para mostrar las preguntas
    function mostrarPregunta(indice) {
    
        // Oculta todas las preguntas
        var preguntasDivs = divExamen.querySelectorAll('.pregunta');
        preguntasDivs.forEach(function (pregDiv, index) {
            pregDiv.style.display = (indice === index) ? 'block' : 'none';
        });
    
        var pregActual = preguntas[indice];
        var pregDiv = preguntasDivs[indice];
    
        pregDiv.getElementsByClassName("id")[0].innerHTML = (indice + 1) + "- ";
        pregDiv.getElementsByClassName("enunciado")[0].innerHTML = pregActual.enunciado;
        pregDiv.getElementsByClassName("url")[0].setAttribute("src", pregActual.url);
        pregDiv.getElementsByClassName("res1")[0].innerHTML = pregActual.respuesta[0].res1;
        pregDiv.getElementsByClassName("res2")[0].innerHTML = pregActual.respuesta[0].res2;
        pregDiv.getElementsByClassName("res3")[0].innerHTML = pregActual.respuesta[0].res3;

        // Agregar evento para marcar una respuesta
        pregDiv.querySelectorAll('input[type="radio"]').forEach(function (radio, index) {
            radio.addEventListener("change", function () {
                // Almacena la respuesta seleccionada en el objeto de respuestas
                respuestas[indice] = index;
            });
        });

        // Verificar si hay una respuesta previamente seleccionada y marcarla
        if (respuestas.hasOwnProperty(indice)) {
            pregDiv.querySelectorAll('input[type="radio"]')[respuestas[indice]].checked = true;
        }
                
    }



    //Funcion para Crear un botón por cada pregunta que haya 
    function crearBotones() {
        for (var i = 0; i < preguntas.length; i++) {
            var btnPregunta = document.createElement("button");
            btnPregunta.innerHTML = i + 1;
            btnPregunta.addEventListener("click", function () {
                var preguntaIndex = parseInt(this.innerHTML) - 1;
                mostrarPregunta(preguntaIndex);
            });
            divExamen.appendChild(btnPregunta);
            botonesPregunta.push(btnPregunta);


            
        }
    }

});