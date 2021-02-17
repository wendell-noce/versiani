import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class
import { body } from '../util/globals';

// Exports the component to be used in other files
export const Header = new Component();

// Get the DOM elements of this component
const header     = $('._header');


// Logic variables
// let isActive			= false;
// const offsetToActivate	= 46; //px

// On load
Header.pageLoaded = () => {
    
   
}