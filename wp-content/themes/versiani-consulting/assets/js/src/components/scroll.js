import { Component } from "../util/component"; // Import to inherit from the Component class
import smoothscroll from "smoothscroll-polyfill";

export const Scroll = new Component();

/**
 * Get DOM element top position relative to body
 *
 * @param {selector} Javascript query selector
 */
Scroll.getOffset = (selector) => {
	const bodyRect = document.body.getBoundingClientRect();
	const elemRect = document.querySelector(selector).getBoundingClientRect();
	return elemRect.top - bodyRect.top;
};

/**
 * Scroll window to selected element
 *
 * @param {string} Javascript query selector
 * @param {offset: string, behavior: string} Options object
 */
Scroll.windowToElement = (selector, options = {}) => {
	const { offset = 0, behavior = "smooth" } = options;

	let top = Scroll.getOffset(selector);

	if (offset !== 0) {
		top += offset;
	}

	window.scroll({ top, behavior });
};

Scroll.pageLoaded = () => {
	// detect if the spec is natively supported and take action only when necessary.
	smoothscroll.polyfill();
};
