import './eventos';

// Este es el frómulario
document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.getElementById('miFormulario');
    const resultado = document.getElementById('resultado');

    if (formulario) {
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();

            const nombre = document.getElementById('nombre').value.trim();
            const correo = document.getElementById('correo').value.trim();
            const mensaje = document.getElementById('mensaje').value.trim();

            if (!nombre || !correo || !mensaje) {
                resultado.innerHTML = '⚠️ Todos los campos son obligatorios.';
                resultado.classList.remove('text-success');
                resultado.classList.add('text-danger');
                return;
            }

            // Validación del correo
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(correo)) {
                resultado.innerHTML = '⚠️ Correo electrónico no válido.';
                resultado.classList.remove('text-success');
                resultado.classList.add('text-danger');
                return;
            }

            resultado.innerHTML = `✅ Gracias, <strong>${nombre}</strong>. Tu mensaje fue enviado con éxito.`;
            resultado.classList.remove('text-danger');
            resultado.classList.add('text-success');

            // Limpia el formulario después de ser enviado
            formulario.reset();
        });
    }
});


// Este es el JS para mouseover / mouseout
const tarjetas = document.querySelectorAll('.tarjeta-interactiva');

tarjetas.forEach(tarjeta => {
    tarjeta.addEventListener('mouseover', () => {
        tarjeta.style.backgroundColor = '#D3D3D3'; // gris claro
    });

    tarjeta.addEventListener('mouseout', () => {
        tarjeta.style.backgroundColor = ''; // restaurar fondo
    });
});


// Este es el codmit para el 
const genero = document.getElementById('genero');
const mensajeGenero = document.getElementById('mensajeGenero');

if (genero) {
    genero.addEventListener('change', function () {
        if (genero.value !== "") {
            mensajeGenero.innerHTML = `🎬 Has elegido: <strong>${genero.value}</strong>`;
        } else {
            mensajeGenero.innerHTML = '';
        }
    });
}

