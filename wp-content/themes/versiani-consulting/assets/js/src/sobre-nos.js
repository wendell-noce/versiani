import { Page } from './util/page';

// Import all components
import { Essentials } from './core/essentials';
import { CarouselClientes } from './components/carousel-clientes';

// Initialize all components
new Page(
	Essentials.concat([
		// Add needed components here...
		CarouselClientes
	])
);