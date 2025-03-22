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

    function handleSidebarState() {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove("collapsed");
            sidebar.classList.add("open");
            toggler.style.display = "none";
        } else {
            sidebar.classList.add("collapsed");
            sidebar.classList.remove("open");
            toggler.style.display = "block";
        }
        handleSidebarScroll(); // Asegurar que el scroll se gestione correctamente
    }

    function handleSidebarScroll() {
        if (!sidebar) {
            console.error('Sidebar element not found.');
            return;
        }

        // Obtener la altura de la ventana y del sidebar
        const windowHeight = window.innerHeight;
        const sidebarHeight = sidebar.scrollHeight;

        // Habilitar o deshabilitar el scroll
        if (sidebarHeight > windowHeight) {
            sidebar.style.overflowY = 'auto';
        } else {
            sidebar.style.overflowY = 'hidden';
        }
    }

    // Eventos
    window.addEventListener("resize", function () {
        handleSidebarState();
    });

    toggler.addEventListener("click", function () {
        if (window.innerWidth < 768) {
            sidebar.classList.toggle("collapsed");
            sidebar.classList.toggle("open");
        }
    });

    // Ejecutar al cargar la página
    handleSidebarState();
    handleSidebarScroll(); // Llamarlo también al inicio para asegurar el scroll correcto
});
