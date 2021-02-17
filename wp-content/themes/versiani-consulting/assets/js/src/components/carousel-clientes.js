import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class
import { Swiper, Navigation, Autoplay } from 'swiper/js/swiper.esm.js';
Swiper.use([Autoplay, Navigation]);

export const CarouselClientes = new Component();

// Get the DOM elements of this component
const carouselClientes = $('._carousel-clientes');

// On Load
CarouselClientes.pageLoaded = () => {
    if(carouselClientes.length) {
		// Code here...
		let swiper = new Swiper('.slider-clientes', {
			spaceBetween: 10,
			slidesPerView: 3,
			direction: 'vertical',
			navigation: {
				nextEl: '.clientes .swiper-button-next',
				prevEl: '.clientes .swiper-button-prev',
			  }
			  
		  });
	}
}