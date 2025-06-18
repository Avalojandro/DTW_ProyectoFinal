import './bootstrap';
// app.js
import './eventos';

//el codigo fue agregado en el archivo welcome blade
// evento click botton
document.addEventListener("DOMContentLoaded", function () {
    const boton = document.getElementById("miBoton");

    if (boton) {
        boton.addEventListener("click", function () {
            alert("¡Hiciste click en este botón!");
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById("miSelect");

    if (select) {
        select.addEventListener("change", function () {
            alert("Haz selecionado: " + select.value);
        });
    }
});

function mostrarAlerta(mensaje) {
    alert(mensaje);
}

document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("botonFuncional");

    if (btn) {
        btn.addEventListener("click", function () {
            mostrarAlerta("¡Función en ejecución desde botón!");
        });
    }
});