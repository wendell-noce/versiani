import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class
import { Swiper, Pagination, Autoplay } from 'swiper/js/swiper.esm.js';
Swiper.use([Autoplay, Pagination,]);

export const Hero = new Component();

// Get the DOM elements of this component
const hero	= $('._hero');

// On Load
Hero.pageLoaded = () => {
    if(hero.length) {

		let swiper = new Swiper('.hero-container', {
			spaceBetween: 10,
			slidesPerView: 1,
			loop: false,
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true,
			},
			autoplay: {
				delay: 6000,
			},			
		});
		const slides = hero.find('.swiper-slide'); 
		if( hero.find('.swiper-pagination span').length < 2 ){
			hero.find('.swiper-pagination span').hide();
		}
		setTimeout(() => {
			slides.find('.anime').removeClass('fadeInLeft');
		}, 1500);

		swiper.on('transitionStart', (swiper) =>{
			slides.find('.anime').addClass('fadeInLeft');
			setTimeout(() => {
				slides.find('.anime').removeClass('fadeInLeft');
			}, 1500);
		})  
	}
}