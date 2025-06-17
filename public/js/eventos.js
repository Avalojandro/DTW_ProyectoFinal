document.addEventListener('DOMContentLoaded', () => {
  const boton = document.getElementById('btn-prueba');

  if (boton) {
    boton.addEventListener('click', () => {
      alert('¡Hola! Este evento viene desde eventos.js');
    });
  }
});


