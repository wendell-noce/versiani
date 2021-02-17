import { Component } from '../utils/component'; // Import to inherit from the Component class
import { body } from '../utils/globals';

class IE extends Component {
	constructor() {
		super();
	}

	pageLoaded() {
		if (this.isIe) {
			// Add class to body to identify IE on CSS
			body.addClass('is-ie');

			// Fix for Skip Link
			if (document.getElementById && window.addEventListener) {
				window.addEventListener(
					'hashchange',
					function () {
						let id = location.hash.substring(1);

						if (!/^[A-z0-9_-]+$/.test(id)) {
							return;
						}

						let element = document.getElementById(id);

						if (element) {
							if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
								element.tabIndex = -1;
							}
							element.focus();
						}
					},
					false
				);
			}
		}
	}

	/**
	 * Returns whether the currently browser is Internet Explorer or not, using the navigator.userAgent property
	 * @returns {boolean}
	 */
	isInternetExplorer() {
		return /(trident|msie)/i.test(navigator.userAgent);
	}
}

export default new IE();
