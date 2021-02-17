import $ from 'jquery';
import { Component } from '../util/component'; // Import to inherit from the Component class

export const TitleColor = new Component();

// Get the DOM elements of this component
const content = $('._the-content');
const color = content.data('title-color');

// On Load
TitleColor.pageLoaded = () => {
    if(color != "") {
		for( let i = 1; i <=6; i ++){
			content.find('h'+i).css({'color': color});
		}
		content.find('a').css({'color': color});
		content.find('.content-tooltip').css({'border-color': color});
	}
}