import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class

export const SidebarHome = new Component();

// Get the DOM elements of this component
const sidebarHome = $('._sidebar-home');

// On Load
SidebarHome.pageLoaded = () => {
    if(sidebarHome.length) {
		// Code here...
	}
}