window.addEventListener("load", function () {
    var btnComenzar = document.getElementById("comenzar");
    var divExamen = document.getElementById("examen");
    var preguntas = [];
    var indicePreguntaActual = 0;


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



                mostrarPregunta(indicePreguntaActual);
                crearBotones(); // Llama a mostrarPreguntas después de cargar las preguntas
                crearBotonesSiguienteYAtras();

            });
        });
    }



    // Función para crear botones "Siguiente" y "Atrás"
    function crearBotonesSiguienteYAtras() {
        var btnSiguiente = document.createElement("button");
        btnSiguiente.id = "siguiente";
        btnSiguiente.textContent = "Siguiente";

        var btnAtras = document.createElement("button");
        btnAtras.id = "atras";
        btnAtras.textContent = "Atrás";

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

        // Agregar botones al DOM
        divExamen.appendChild(btnSiguiente);
        divExamen.appendChild(btnAtras);
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



    //Funcion para mostrar las preguntas
    function mostrarPregunta(indice) {
        // Obtén la cantidad de preguntas
        var numPreguntas = preguntas.length;
    
        if (numPreguntas === 0) {
            // No hay preguntas, no hagas nada
            return;
        }
    
        // Asegúrate de que el índice esté en el rango válido
        if (indice < 0) {
            indice = 0;
        } else if (indice >= numPreguntas) {
            indice = numPreguntas - 1;
        }
    
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
                
    }




   
    
});
