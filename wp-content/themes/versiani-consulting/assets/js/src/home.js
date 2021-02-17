import { Page } from './util/page';

// Import all components
import { Essentials } from './core/essentials';
import { Hero } from './components/hero';
import { PostsHome } from './components/posts-home';
import { CarouselClientes } from './components/carousel-clientes';
import { NossosServicos } from './components/nossos-servicos';

// Initialize all components
new Page(
	Essentials.concat([
	// components..	
	Hero,
	PostsHome,
	CarouselClientes,
	NossosServicos
	])
);