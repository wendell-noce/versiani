import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class
import { Swiper, Navigation, Autoplay } from 'swiper/js/swiper.esm.js';
Swiper.use([Autoplay, Navigation,]);

export const PostsHome = new Component();

// Get the DOM elements of this component
const postsHome = $('._posts-home');

// On Load
PostsHome.pageLoaded = () => {
    if(postsHome.length) {
		// Code here...
		let swiper = new Swiper('.slider-posts', {
			spaceBetween: 50,
			slidesPerView: 'auto',
			navigation: {
				nextEl: '.home-blog .swiper-button-next',
				prevEl: '.home-blog .swiper-button-prev',
			  }
		  });
	}
}