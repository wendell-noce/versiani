/* 
 * This is a prototype class that should be used by all page entry
 * Just pass the components to the page and initialize it
 */
import { win } from './globals';

export class Page {

	/* Should receive the components to be initialized in the page */
    constructor(components = []) {
		// Execute all components scriptLoaded() function immediately on read the script
		components.forEach(item => {
			item.scriptLoaded();
		});

		// Execute all components pageLoaded() function on load the DOM content
		win.ready(() => {
			components.forEach(item => {
				item.pageLoaded();
			});
		});

		// Execute all components pageScrolled() function on scroll the page
		win.scroll(() => {
			const winScroll = win.scrollTop();
			components.forEach(item => {
				item.pageScrolled( winScroll );
			});
		});

		// Execute all components windowResized() function on resize the window
		win.resize(() => {
			const winWidth = win.innerWidth();
			const winHeight = win.innerHeight();
			components.forEach(item => {
				item.windowResized( winWidth, winHeight );
			});
		});
	}
}