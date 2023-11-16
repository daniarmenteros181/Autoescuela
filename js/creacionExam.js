function marcarTodas() {
    var checkboxes = document.querySelectorAll('.checkbox-pregunta');
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = true;
    });
}

function desmarcarTodas() {
    var checkboxes = document.querySelectorAll('.checkbox-pregunta');
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = false;
    });
}


// Obtén la referencia al elemento del mensaje
var mensajeCreacion = document.getElementById('mensajeCreacion');

// Establece un temporizador para ocultar el mensaje después de 5 segundos
setTimeout(function() {
    // Oculta el mensaje (puedes cambiar 'display' a 'none' si prefieres eliminarlo completamente del DOM)
    mensajeCreacion.style.display = 'none';
}, 5000); // 5000 milisegundos = 5 segundos