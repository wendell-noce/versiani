/*
 * This is a prototype class that should be used by all components in the project
 * Just override the onPageLoaded() and onPageScrolled() functions in the component
 */
export class Component {

	constructor() { }

    /**
	 * Should run on load the JS script
	*/
	scriptLoaded() {
		return;
	}

    /**
	 * Should run after load the page $(window).ready()
	 */
	pageLoaded() {
		return;
	}

    /**
	 * Should run on scroll the page $(window).scroll()
	 * @param {number} scrollPos Position of the page scroll
	 */
	pageScrolled(scrollPos) {
		return;
	}

    /**
	 * Should run on scroll the page $(window).scroll()
	 * @param {number} winWidth Inner width of the window
	 * @param {number} winHeight Inner height of the window
	 */
	windowResized(winWidth, winHeight) {
		return;
	}
}
