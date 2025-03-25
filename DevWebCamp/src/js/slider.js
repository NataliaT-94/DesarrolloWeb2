import Swiper from 'swiper';
import { Navigation } from 'swiper/modules'; // Importar módulos desde 'swiper/modules'

import 'swiper/css';
import 'swiper/css/navigation';

document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.swiper')) {
        const opciones = {
            modules: [Navigation], // Usar 'modules'
            slidesPerView: 1,
            spaceBetween: 15,
            freeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1200: { slidesPerView: 4 }
            }
        };
        new Swiper('.swiper', opciones);
    }
});
