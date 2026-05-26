document.addEventListener("DOMContentLoaded", function() {
    particlesJS('fireworks-1', {
        "particles": {
            "number": {
                "value": 120, // Aumentar el número de partículas
                "density": {
                    "enable": true,
                    "value_area": 800
                }
            },
            "color": {
                "value": ["#ffdd00", "#ff4d00", "#ff00d4", "#00ff5f"] // Variar colores para mayor visibilidad
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#fff"
                },
                "polygon": {
                    "nb_sides": 5
                }
            },
            "opacity": {
                "value": 0.8, // Hacer las partículas más opacas
                "random": false,
                "anim": {
                    "enable": true,
                    "speed": 0.6, // Hacer que la opacidad varíe un poco
                    "opacity_min": 0.3,
                    "sync": false
                }
            },
            "size": {
                "value": 8, // Hacer las partículas más grandes
                "random": true,
                "anim": {
                    "enable": true,
                    "speed": 5, // Hacer que el tamaño varíe dinámicamente
                    "size_min": 2,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": false
            },
            "move": {
                "enable": true,
                "speed": 10, // Aumentar la velocidad de movimiento
                "direction": "none",
                "random": true,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": false,
                    "mode": "repulse"
                },
                "onclick": {
                    "enable": false
                },
                "resize": true
            },
            "modes": {
                "repulse": {
                    "distance": 200,
                    "duration": 0.4
                }
            }
        },
        "retina_detect": true
    });
});
