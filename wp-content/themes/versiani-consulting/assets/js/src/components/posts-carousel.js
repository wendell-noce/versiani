
import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class
import { isDesktop, isTablet, isMobile, win } from '../util/globals'; // Import to inheirt from Globas class
/* 
 * Import external lib to use sliders
 */
import Swiper from 'swiper';
// Exports the component to be used in other files
export const PostCarousel = new Component();
// Get the DOM elements of this component
const postsCarousels = $('._posts-carousel .swiper-container');
const winHeight = win.innerHeight();
// Instances the sliders
let swiperInstances = {},
    nunSliders,
    showSliders,
    free_mode = true,
    posts_carousel = [];
let is_mobile,
   is_tablet,
   is_desktop;
// Called in the index.js on load the page
PostCarousel.pageLoaded = () => {
    postsCarousels.each( (index, element ) => {
        let carousel = $(element);
        carousel.addClass( 'carousel-post-'+index );
        carousel.parent().addClass( 'carousel-'+index );
        posts_carousel.push({ el: carousel, id: index, pos: Math.trunc(carousel.offset().top) });
    });
    // testa se o carousel já deve ser carregado
    let scrollLength = window.scrollY + ( winHeight + ( winHeight / 3) );
    if(posts_carousel.length) {
        checkScrollPercentage( scrollLength );
        win.trigger('resize');
    }
    // Detect load device
    detectDevice();
}
// Called function on Resize window
// PostCarousel.windowResized = () => {
//     setTimeout(() => {
//         if( (is_mobile && !isMobile()) || ( is_tablet && !isTablet() ) || ( is_desktop && !isDesktop() ) ){
//             // Detect load device
//             detectDevice();
//             const keys = Object.keys( swiperInstances );
//             for (const key of keys) {
//                 swiperInstances[key[0]].destroy( true, true);      
//                 swiperInstances[key[0]] = false;
//             }
//             setTimeout(() => {
//                 for (const key of keys) {
//                     createSlider(key[0]);        
//                 }
//              }, 300);
//         }
//      }, 300);
// }
// PostCarousel.pageScrolled = ( scrollPos ) => {
//     let scrollLength = scrollPos + ( winHeight + ( winHeight / 3 ) );
//     if(posts_carousel.length) {
//         checkScrollPercentage( scrollLength )   
//     }
// }
// function checkScrollPercentage( scrollPos ) {
//     posts_carousel.forEach(( scrollPoint, index) => {
//         if(scrollPos > Math.trunc(scrollPoint.el.offset().top)) {
//             createSlider( scrollPoint.id );
//             posts_carousel.splice(index, 1);
// 		}
//     });
// }
/**
 * Create the slider component
 */
export function createSlider( idSlider ) {
    nunSliders = $(".carousel-post-" + idSlider).parents('._posts-carousel').attr("data-nunSliders");
    if(isDesktop()){
        showSliders = parseInt(nunSliders) ? parseInt(nunSliders) : 4; 
        free_mode = false;
    }else if(isMobile()){
        showSliders = 'auto';
    }else{
        showSliders = 3;
    }
    if( !(swiperInstances[idSlider] instanceof Swiper) ){
        swiperInstances[idSlider] = new Swiper(
            ".carousel-post-" + idSlider, {
                slidesPerView: showSliders,
                preventClicksPropagation: false,
                spaceBetween: 20,
                threshold: 5,
                freeMode: free_mode,
                watchSlidesProgress: true,
                watchSlidesVisibility: true,
                navigation: {
                    nextEl: '.carousel-' + idSlider + ' .swiper-button-next',
                    prevEl: '.carousel-' + idSlider + ' .swiper-button-prev', 
                },
                scrollbar: {
                    el: '.carousel-' + idSlider + ' .swiper-scrollbar',
                    hide: false,
                    draggable: false
                },
                on: {
                    init: () => {
                        let this_carousel = $(".carousel-post-" + idSlider);
                        let slideH = 0;
                        this_carousel.find('.slide').each( (i,e)=>{
                            let elelementH = $(e).height();
                            if ( slideH < elelementH )
                                slideH = elelementH;
                        })
                        this_carousel.height( slideH );
                    }
                }
            }
        );
        let date = new Date();
        console.log("Slider-"+ idSlider + " created now: " + date.getHours() + ":" + date.getMinutes() + ":" + date.getMinutes());
    }
}

