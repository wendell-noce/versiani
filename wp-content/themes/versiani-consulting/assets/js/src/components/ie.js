import { Component } from '../util/component'; // Import to inherit from the Component class
import { body } from '../util/globals';

// Exports the component to be used in other files
export const IE = new Component();

// Control Variables
const isIe = /(trident|msie)/i.test( navigator.userAgent );

// On Load
IE.pageLoaded = () => {

	// Add extra class
	if (isIe) {
		body.addClass('is-ie');

		// Fix for Skip Link
		if ( document.getElementById && window.addEventListener ) {
			window.addEventListener( 'hashchange', function() {
				let id = location.hash.substring( 1 )
	
				if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
					return;
				}
	
				let element = document.getElementById( id );
	
				if ( element ) {
					if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
						element.tabIndex = -1;
					}
					element.focus();
				}
			}, false );
		}
	}
}