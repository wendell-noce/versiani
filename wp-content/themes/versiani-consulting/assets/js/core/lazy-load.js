import $ from 'jquery';
import lozad from 'lozad';
import { Component } from '../utils/component';

class LazyLoad extends Component {
	constructor() {
		super();
	}

	pageLoaded() {
		this.initLazyLoad();
	}

	/**
	 * Initialize images lazy loading, creating an observer for the images to load when displayed in the viewport
	 * For more info, check the Lozad docs: https://apoorv.pro/lozad.js/
	 */
	initLazyLoad() {
		// Creat images observer
		const observer = lozad('.lozad', {
			loaded: (img) => {
				/* const image = $(img);
				if (img.complete) {
					image.addClass('lazy-loaded');
				} else {
					image.on('load', (event) => {
						image.addClass('lazy-loaded');
					});
				} */
			},
		});
		observer.observe();
	}
}

export default new LazyLoad();
