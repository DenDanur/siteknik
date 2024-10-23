import './bootstrap';
import 'flowbite';

import Alpine from 'alpinejs';

import 'slick-carousel/slick/slick.css';
import 'slick-carousel';

import $ from 'jquery';
window.$ = $;

// Inisialisasi saat dokumen siap
document.addEventListener('DOMContentLoaded', function () {
    const slickSliders = document.querySelectorAll('.slick-slider');
    if (slickSliders.length > 0) {
        $('.slick-slider').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            prevArrow: '<button type="button" class="slick-prev text-black bg-gray-300 p-2 rounded-full">&#9664;</button>',
            nextArrow: '<button type="button" class="slick-next text-black bg-gray-300 p-2 rounded-full">&#9654;</button>',
            dots: true,
        });
    }
});

function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}


window.Alpine = Alpine;

Alpine.start();
