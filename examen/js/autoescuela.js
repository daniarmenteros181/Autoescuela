window.addEventListener("load",function(){
    var btnComenzar=document.getElementById("comenzar");
    var divExamen=document.getElementById("examen");

    btnComenzar.addEventListener("click", comenzar);

    function comenzar(){
        fetch("plantilla/pregunta.html")
        .then(x=>x.text())
        .then(y=>{
            var contenedor=document.createElement("div");
            contenedor.innerHTML=y;
            var pregunta=contenedor.firstChild;
            fetch("servidor/pregunta.json")
                .then(x=>x.json())
                .then(y=>{
                    for(let i=0;i<y.examen[0].pregunta.length;i++)
                    {
                        var pregAux=pregunta.cloneNode(true);
                        pregAux.getElementsByClassName("categoria")[0].innerHTML=y.examen[0].pregunta[i].categoria;
                        pregAux.getElementsByClassName("dificultad")[0].innerHTML=y.examen[0].pregunta[i].dificultad;
                        pregAux.getElementsByClassName("id")[0].innerHTML=y.examen[0].pregunta[i].id;

                        pregAux.getElementsByClassName("res1")[0].innerHTML=y.examen[0].pregunta[i].respuesta[i].res1;
                        pregAux.getElementsByClassName("res2")[0].innerHTML=y.examen[0].pregunta[i].respuesta[i].res2;
                        pregAux.getElementsByClassName("res3")[0].innerHTML=y.examen[0].pregunta[i].respuesta[i].res3;




                      
/*

                         // Agregar respuestas
                         var respuestaHTML = "<ul>";
                         var respuestas = y.examen[0].pregunta[i].respuesta[0];
                         for (var key in respuestas) {
                             respuestaHTML += "<li>" + key + ": " + respuestas[key] + "</li>";
                         }
                         respuestaHTML += "</ul>";
                         pregAux.innerHTML += respuestaHTML;
*/


                        divExamen.appendChild(pregAux);


                    }

                })

        })
    }

})

         
