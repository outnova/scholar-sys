/*
const toggler = document.querySelector(".btn");
toggler.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});


document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener("resize", function() {
        const sidebar = document.querySelector("#sidebar");
        
        // Si el ancho de la ventana es menor a 768px, cierra el sidebar automáticamente
        if (window.innerWidth < 768) {
            sidebar.classList.add("collapsed");
        } else {
            // Si el ancho es mayor o igual a 768px, asegúrate de que el sidebar esté visible
            sidebar.classList.remove("collapsed");
        }
    });

    // Esto también asegura que al cargar la página con una pantalla pequeña, el sidebar se oculte.
    if (window.innerWidth < 768) {
        document.querySelector("#sidebar").classList.add("collapsed");
    }
});
*/

document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector("#sidebar");
    const toggler = document.querySelector(".btn");

    // Función para manejar la visibilidad del sidebar según el tamaño de la pantalla
    function handleSidebarState() {
        if (window.innerWidth >= 768) {
            // En pantallas grandes, mostramos el sidebar siempre
            sidebar.classList.remove("collapsed"); // Asegurarse de que esté visible
            sidebar.classList.add("open"); // El sidebar está "abierto"
            toggler.style.display = "none";  // Ocultamos el botón
        } else {
            // En pantallas pequeñas, el sidebar está oculto al inicio
            sidebar.classList.add("collapsed"); // Estará colapsado por defecto
            sidebar.classList.remove("open"); // No debe estar abierto inicialmente
            toggler.style.display = "block"; // Mostramos el botón
        }
    }

    // Detectar cambios de tamaño de la ventana
    window.addEventListener("resize", function () {
        handleSidebarState();
    });

    // Ejecutar al cargar la página
    handleSidebarState();

    // Evento del botón para alternar la visibilidad del sidebar en pantallas pequeñas
    toggler.addEventListener("click", function () {
        if (window.innerWidth < 768) {
            // Solo en pantallas pequeñas alternamos entre 'collapsed' y 'open'
            sidebar.classList.toggle("collapsed");
            sidebar.classList.toggle("open");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    function handleSidebarScroll() {
        const sidebar = document.getElementById('sidebar'); // Reemplaza 'sidebar' con el ID de tu sidebar
        if (!sidebar) {
          console.error('Sidebar element not found. Make sure the ID is correct.');
          return;
        }
      
        // Define un atributo personalizado para almacenar el estado original del overflow
        if (!sidebar.dataset.originalOverflowY) {
          sidebar.dataset.originalOverflowY = window.getComputedStyle(sidebar).overflowY;
        }
      
        const windowHeight = window.innerHeight;
        const sidebarHeight = sidebar.offsetHeight;
      
        if (sidebarHeight > windowHeight) {
          sidebar.style.overflowY = 'auto';
        } else {
          sidebar.style.overflowY = sidebar.dataset.originalOverflowY;
        }
      }
      
      // Llama a la función cuando se carga la página y cuando cambia el tamaño de la ventana
      window.addEventListener('load', handleSidebarScroll);
      window.addEventListener('resize', handleSidebarScroll);
});

