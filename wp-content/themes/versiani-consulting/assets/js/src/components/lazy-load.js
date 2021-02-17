import $ from 'jquery';
import lozad from 'lozad';
import { Component } from '../util/component'; // Import to inherit from the Component class

// Exports the component to be used in other files
export const LazyLoad = new Component();

// on Load
LazyLoad.pageLoaded = () => {
	// lazy loads elements with default selector as '.lozad'
	initLazyLoad();
}

export function initLazyLoad() {
	// Create an observer for the images to load when displayed in the viewport
	// For more info, check the Lozad docs: https://apoorv.pro/lozad.js/
    const observer = lozad('.lozad', {
        loaded: img => {
			const image = $(img);
			if(img.complete) {
				image.addClass('lazy-loaded');
			} else {
				image.on('load', event => {
					image.addClass('lazy-loaded');
				});
			}
        }
    });
    observer.observe();
}