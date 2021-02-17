import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class
import { Swiper, Navigation, Autoplay } from 'swiper/js/swiper.esm.js';
Swiper.use([Autoplay, Navigation,]);

export const NossosServicos = new Component();

// Get the DOM elements of this component
const nossosServicos = $('._nossos-servicos');
const servicosList   = nossosServicos.find('.servicos');
const boxDesc = nossosServicos.find('.desc');
const boxCarousel = nossosServicos.find('.box-carousel');
const services = nossosServicos.find('.servicos li');

const btn_next = $('.buttons .next');
const btn_prev = $('.buttons .prev');

let swiperInstances = {},
	posts_carousel = [];

// On Load
NossosServicos.pageLoaded = () => {
    if(nossosServicos.length) {
			
		servicosList.find('li a').on('click', (clicked) => {
			clicked.preventDefault();
			const element = $(clicked.currentTarget);
			const id = element.attr('href').split("#")[1];
			
			showHideService(id, element);

			btn_prev.attr('data-prev', parseInt(boxCarousel.find('.'+id).attr('data-index')));
	btn_next.attr('data-next', parseInt(boxCarousel.find('.'+id).attr('data-index'))+1);
			
		});

		btn_next.on('click', clicked => {
			clicked.preventDefault();
			let el = $(clicked.currentTarget);
			let index = el.attr('data-next');


			console.log(index, services.length);

			let next_carousel = boxCarousel.find('[data-index="'+ index +'"]');
			let li_active     = $('.servicos [data-service="'+ next_carousel.data('service') +'"]');

			if( index >= services.length  ){
				
			}else {
				showHideService(next_carousel.data('service'), li_active);
				el.attr('data-next', parseInt(index)+1);
				btn_prev.attr('data-prev', parseInt(btn_prev.attr('data-prev'))+1);
			}	
		});

		btn_prev.on('click', clicked => {
			clicked.preventDefault();
			let el = $(clicked.currentTarget);
			let index = el.attr('data-prev');
			console.log(index);
			console.log(index, services.length);

			let next_carousel = boxCarousel.find('[data-index="'+ parseInt(index - 1) +'"]');
			let li_active     = $('.servicos [data-service="'+ next_carousel.data('service') +'"]');

			if( index == 0  ){
				
			}else {
				showHideService(next_carousel.data('service'), li_active);
				el.attr('data-prev', parseInt(index)-1);
				btn_next.attr('data-next', parseInt(btn_next.attr('data-next'))-1);
			}	
		});
		
	}
}

function showHideService (id, element) {
	servicosList.find('li').removeClass('active');
	element.parent().addClass('active');

	boxDesc.find('.content').removeClass('active');
	boxDesc.find('.content').hide();
	boxCarousel.find('.carousel').removeClass('active');
	
	boxDesc.find('#'+id).fadeIn();
	boxCarousel.find('.'+id).addClass('active');	
}

// function createSlider( idSlider ) {
//     if( !(swiperInstances[idSlider] instanceof Swiper) ){
//         swiperInstances[idSlider] = new Swiper(
//             ".carousel-" + idSlider, {
//                 spaceBetween: 10,
// 				slidesPerView: 1,
// 				slidesPerView: 'auto',
//                 navigation: {
//                     nextEl: '.carousel-' + idSlider + ' .swiper-button-next',
//                     prevEl: '.carousel-' + idSlider + ' .swiper-button-prev', 
//                 },                
//             }
//         );
//         let date = new Date();
//         console.log("Slider-"+ idSlider + " created now: " + date.getHours() + ":" + date.getMinutes() + ":" + date.getMinutes());
//     }
// }
