// document.addEventListener('DOMContentLoaded', function(){
//     iniciarApp();
// });

// function iniciarApp(){
//     buscarPorFecha();
// }

// function buscarPorFecha(){
//     const fechaInput = document.querySelector('#fechaAdmin');
//      if (!fechaInput) return; // ✅ evita error en páginas sin el campo
//     fechaInput.addEventListener('input', function(e){
//         const fechaSeleccionada = e.target.value;
//         const path = window.location.admin;// p.ej. /dev/nailsAppMVC/public/admin
//         window.location.href = `${path}?fecha=${encodeURIComponent(fechaSeleccionada)}`;
        
//     });
// }

document.addEventListener('DOMContentLoaded', () => {
  const fechaInput = document.querySelector('#fechaAdmin');
  if (!fechaInput) return;

  const BASE = window.APP_BASE || '/';  // ej: "/dev/nailsAppMVC/public/"

  fechaInput.addEventListener('change', (e) => {
    const fecha = e.target.value;
    if (!fecha) return;
    window.location.href = `${BASE}admin?fecha=${encodeURIComponent(fecha)}`;
  });
});
