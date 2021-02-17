import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class

export const Newsletter = new Component();

// Get the DOM elements of this component
const newsletter = $('._newsletter');

// On Load
Newsletter.pageLoaded = () => {
    if(newsletter.length) {
		// Code here...
	}
}