import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class

export const DataBg = new Component();

// Get the DOM elements of this component
const dataBg = $('[data-style]');

// On Load
DataBg.pageLoaded = () => {
    if(dataBg.length) {
		dataBg.each( ( index, el ) => {
			let element = $(el); 
			let data   = element.data();
			element.css( data );
		});
	}
}