document.addEventListener('DOMContentLoaded', function() {
    const carrusel = document.querySelector('.carrusel');
    const noticias = [
        {
            titulo: "Nueva actualización de la página web",
            contenido: "Hemos lanzado una nueva actualización de nuestra página web con nuevas características y mejoras."
        },
        {
            titulo: "Evento de lanzamiento de producto",
            contenido: "Te invitamos a nuestro evento de lanzamiento de producto que se llevará a cabo el próximo sábado a las 10 a.m. en nuestro local principal."
        },
        {
            titulo: "Oferta especial de primavera",
            contenido: "¡Aprovecha nuestra oferta especial de primavera! Descuentos de hasta un 50% en una amplia gama de productos."
        },
        {
            titulo: "Nuevo artículo destacado",
            contenido: "Echa un vistazo a nuestro nuevo artículo destacado que ha estado recibiendo excelentes críticas de nuestros clientes."
        }
    ];

    // Función para agregar noticias al carrusel
    function agregarNoticias() {
        carrusel.innerHTML = ''; // Limpiamos el contenido existente del carrusel
        noticias.forEach(noticia => {
            const noticiaElemento = document.createElement('div');
            noticiaElemento.classList.add('noticia');

            const titulo = document.createElement('h2');
            titulo.textContent = noticia.titulo;

            const contenido = document.createElement('p');
            contenido.textContent = noticia.contenido;

            noticiaElemento.appendChild(titulo);
            noticiaElemento.appendChild(contenido);

            carrusel.appendChild(noticiaElemento);
        });
    }

    agregarNoticias(); // Agregamos las noticias al cargar la página

    let posicion = 0; // Posición inicial del carrusel

    // Función para avanzar al siguiente noticia
    function siguienteNoticia() {
        if (posicion < noticias.length - 1) {
            posicion++;
            actualizarCarrusel();
        }
    }

    // Función para retroceder al noticia anterior
    function noticiaAnterior() {
        if (posicion > 0) {
            posicion--;
            actualizarCarrusel();
        }
    }

    // Función para actualizar la posición del carrusel
    function actualizarCarrusel() {
        carrusel.style.transform = `translateX(-${posicion * 100}%)`;
    }

    // Eventos para avanzar y retroceder usando las flechas del teclado
    document.addEventListener('keydown', function(event) {
        if (event.key === 'ArrowLeft') {
            noticiaAnterior();
        } else if (event.key === 'ArrowRight') {
            siguienteNoticia();
        }
    });

    // Eventos para avanzar y retroceder usando botones
    const btnSiguiente = document.querySelector('.fecha-derecha');
    const btnAnterior = document.querySelector('.fecha-izquierda');

    btnSiguiente.addEventListener('click', siguienteNoticia);
    btnAnterior.addEventListener('click', noticiaAnterior);
});
