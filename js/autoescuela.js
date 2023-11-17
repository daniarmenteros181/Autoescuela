window.addEventListener("load", function () {    
    var btnComenzar = document.getElementById("comenzar");
    var selc = document.getElementById("selc");
    var tit = document.getElementById("tit");
    var chec = document.getElementById("chec");
    var divExamen = document.getElementById("examen");
    var preguntas = [];
    var indicePreguntaActual = 0;
    var botonesPregunta = [];    // Almacena los botones de pregunta
    var respuestas = []; //Una array que alamacenara las respuestas de los usuarios 




    btnComenzar.addEventListener("click", comenzar);

    function comenzar(ev) {
        ev.preventDefault();
        btnComenzar.style.display = "none";
        selc.style.display = "none";
        tit.style.display = "none";
        chec.style.display = "none";
        var seleccion = document.getElementById("chec");
        var idExamen = seleccion.options[seleccion.selectedIndex].value;



        
        fetch("examen/plantilla/pregunta.html").then(x => x.text()).then(y => {
            var contenedor = document.createElement("div");
            contenedor.innerHTML = y;
            var pregunta = contenedor.querySelector(".pregunta");
    
            fetch("http://automenu.com/examenApi.php?id_examen="+idExamen).then(x => x.json()).then(y => {

/*                 preguntas = y.examen[0].pregunta;
 */                
                preguntas = y.preguntas;


                // Crear preguntas ocultas excepto la primera
                for (var i = 0; i < preguntas.length; i++) {
                    var preguntaClone = pregunta.cloneNode(true);
                    preguntaClone.style.display = 'none';
                    divExamen.appendChild(preguntaClone);
                }


                var btnAtras = contenedor.querySelector(".atras");
                var btnSiguiente = contenedor.querySelector(".siguiente");
                var btnFinalizar = contenedor.querySelector(".finalizar"); 


                

            
            // Agregar eventos a los botones
            btnAtras.addEventListener("click", function (ev) {
                ev.preventDefault();
                if (indicePreguntaActual > 0) {
                    indicePreguntaActual--;
                    mostrarPregunta(indicePreguntaActual);
                }
            });

            btnSiguiente.addEventListener("click", function (ev) {
                ev.preventDefault();
                if (indicePreguntaActual < preguntas.length - 1) {
                    indicePreguntaActual++;
                    mostrarPregunta(indicePreguntaActual);
                }
            });

            
            btnFinalizar.addEventListener("click", function (ev) {
                ev.preventDefault();
                crearJSONRespuestas();
            });


            divExamen.appendChild(btnAtras);
            divExamen.appendChild(btnSiguiente);
            divExamen.appendChild(btnFinalizar);



            mostrarPregunta(indicePreguntaActual);
            crearBotones(); // Llama a mostrarPreguntas después de cargar las preguntas

            });
        });

        
    }








    //Funcion para mostrar las preguntas
    function mostrarPregunta(indicePreguntaActual) {
    
        // Oculta todas las preguntas
        var preguntasDivs = divExamen.querySelectorAll('.pregunta');
        preguntasDivs.forEach(function (pregDiv, index) {
            pregDiv.style.display = (indicePreguntaActual === index) ? 'block' : 'none';
        });

        
        var pregActual = preguntas[indicePreguntaActual];
        var pregDiv = preguntasDivs[indicePreguntaActual];
    
        pregDiv.getElementsByClassName("id")[0].innerHTML = (indicePreguntaActual + 1) + "- ";
        pregDiv.getElementsByClassName("enunciado")[0].innerHTML = pregActual.enunciado;
        //Aqui habria que traer la img de la base de datos 
       /*pregDiv.getElementsByClassName("url")[0].setAttribute("src", pregActual.url);*/        
        pregDiv.getElementsByClassName("res1")[0].innerHTML = pregActual.respuesta.res1;
        pregDiv.getElementsByClassName("res2")[0].innerHTML = pregActual.respuesta.res2;
        pregDiv.getElementsByClassName("res3")[0].innerHTML = pregActual.respuesta.res3;


        pregDiv.getElementsByClassName("borrar")[0].onclick=function(ev)

        {
            ev.preventDefault();

            var auxPadre=this;
            while(!auxPadre.classList.contains("pregunta"))
                auxPadre=auxPadre.parentNode;

            auxPadre.getElementsByClassName("dudosa")[0].checked=false;
            agregarEventosRadioButtons(pregDiv, indicePreguntaActual);
            actualizarColorBotonPregunta(indicePreguntaActual);
            
        }


         agregarEventosRadioButtons(pregDiv, indicePreguntaActual);
        if (indicePreguntaActual < botonesPregunta.length) {
            actualizarColorBotonPregunta(indicePreguntaActual);
        } 

                
    }

    function crearBotones() {
        for (var i = 0; i < preguntas.length; i++) {
            var btnPregunta = document.createElement("button");
            btnPregunta.innerHTML = i + 1;
            btnPregunta.addEventListener("click", function (ev) {
                ev.preventDefault();
                indicePreguntaActual = parseInt(this.innerHTML) - 1;
                mostrarPregunta(indicePreguntaActual);

            });
            divExamen.appendChild(btnPregunta);
            botonesPregunta.push(btnPregunta);
        }
    
    }



  // Agregar eventos a los botones de radio
function agregarEventosRadioButtons(pregDiv, indicePreguntaActual) {
    var respuestasRadio = pregDiv.querySelectorAll('input[type="radio"]');
    var enunciadosRespuestas = pregDiv.querySelectorAll('.respuesta p');
    var dudosaCheckbox = pregDiv.querySelector('.dudosa');


    respuestasRadio.forEach(function (radio, index) {
        radio.addEventListener("change", function () {
            if (this.checked) {
                var enunciadoRespuesta = enunciadosRespuestas[index].textContent;
                respuestas[indicePreguntaActual] = {
                    id: indicePreguntaActual + 1,
                    respuesta: enunciadoRespuesta
                };
                console.log(`Respuesta seleccionada para la pregunta ${indicePreguntaActual + 1}: ${enunciadoRespuesta}`);
                    actualizarColorBotonPregunta(indicePreguntaActual);
                
            }
        });
    });
     // Agregar evento de cambio para la casilla "dudosa"
     dudosaCheckbox.addEventListener("change", function () {
        actualizarColorBotonPregunta(indicePreguntaActual);
    }); 

}


 function actualizarColorBotonPregunta(indicePregunta) {
    var btnPregunta = botonesPregunta[indicePregunta];
    if (respuestas[indicePregunta]) {
        // Pregunta respondida, poner en verde
        btnPregunta.style.backgroundColor = "green";
    } else {
        // Pregunta no respondida, revisar si está marcada como dudosa
        var pregDiv = divExamen.querySelectorAll('.pregunta')[indicePregunta];
        var dudosaCheckbox = pregDiv.querySelector('.dudosa');
        if (dudosaCheckbox.checked) {
            // Pregunta marcada como dudosa, poner en amarillo
            btnPregunta.style.backgroundColor = "yellow";
        } else {
            // Pregunta no respondida ni marcada como dudosa, dejar el color por defecto
            btnPregunta.style.backgroundColor = "";
        }
    }
} 

// Función para crear un JSON con las respuestas
function crearJSONRespuestas() {
    var respuestasJSON = JSON.stringify(respuestas);
    console.log("Respuestas JSON:", respuestasJSON);
}

});

