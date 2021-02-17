import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class

export const Form = new Component();

// Get the DOM elements of this component
const form = $('._form');

// On Load
Form.pageLoaded = () => {
    if(form.length) {
		// Code here...
	}
}