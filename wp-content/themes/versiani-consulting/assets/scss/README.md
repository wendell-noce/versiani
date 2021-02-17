Styles Guide
===

> Make sure you read the [General README.md](../../../../../README.md) file that contains some information about the styles structure.

This file includes some basic information of the organization and best practices used in the **SCSS** development for this theme.

Summary
---

* [Pages](#user-content-pages)
* [Componets](#user-content-components)
* [Media Queries](#user-content-media-queries)
* [Core](#user-content-core)
* [Fonts](#user-content-fonts)

Entry files
---

Each SCSS file at the root of the `scss/` folder represents a page template and we use the `gulp sass` task to compile each entry file into its respective `[page].dist.css` file ath the `assets/css/dist/` folder.

The entry files are where we import the core modules and the styles for the components that will be needed on each page. As some components are needed on all (or almost all) pages in the website, these are imported in the `assets/scss/core/_essentials.scss` file, that contains all essential modules and components.

Bootstrap modules are imported in the `assets/scss/core/_bootstrap.scss` file, but if you need to import a new module in a page, you can import ir directly in the respective entry file of the page.

Pages
---

Whenever you need to add styles to a specific page template (and not to a component of the page), like _Home_, _Article_ and _404_, you should add it to it's respective page `_[page].scss` file from the `./assets/scss/pages/` folder. Each file of this folder represents a page template from the `{theme_root}/pages/`, and they should be imported on their respective entry files.

Each page template should have a unique ID based on its name, using the pattern `#{page_name}-page`, for example: `#home-page` and `#article-page`.

An exemplo of a page structure is:

```html
<div id="home-page" class="page-content">
	...
</div>
```

```scss
#home-page {
	...
}
```

Components
---

The styles for all components are added in the `assets/scss/components/` folder. Each file component should have a respective PHP and JS file with same naming.

The class name for all components should start with `_` (_underscore_), like `._header`, `._posts-listing`, `.article-card`, etc, while its subitems can have simpler names, like `.title`, `.image`, `.description`, this shouldn't cause conflicts if all CSS and JS code reference the root component element before referencing the subitems, like `._header .logo {...}` or `$('._header .logo')`.

An example of HTML structure would be of a component would be:

```html
<div class="_hero">
	<h2 class="title">Hero title</h2>
	<p class="description">This is an awesome description.</p>
	<div class="img-wrapper">
		<img class="image" scr="image.jpg">
	</div>
</div>
```

```scss
._hero {
	.title {
		...
	}
	.description {
		...
	}
}
```

Media Queries
---

All media rules are placed in each component and page styles using the Bootstrap available Sass mixins for media (i.e. `media-breakpint-up(lg)`) or a CSS `@media` rule when there is no mixin available that fit your needs.

See an example below:

```scss

._hero {
	.title {
		width: 100%;

		@include media-breakpoint-up(md) {
			width: 800px;
		}

		@media (orientation: portrait) {
			height: auto;
		}
	}
}
```

See the [Bootstrap docs](https://getbootstrap.com/docs/4.0/layout/overview/#responsive-breakpoints) for more information about the available media mixins.

Core
---

The `./assets/scss/core/` folder includes a lot of styles that does not belong to a specific page or component. So it can be styles that would be applied to the whole website or rules that can be shared for multiple files.

* `aminations` - The declaration of all CSS animations used in the website.
* `bootstrap` - Contain all Bootstrap imports that the project will need. If you need a module that is not being imported, just copy the commented module import that you need and add it to the respective page entry file.
* `global` - Generic styles applied to the whole website.
* `logged` - Adjustments to logged in users, when the admin bar is visible, for example.
* `helpers` - Classes that can be used on multiple places. You can add your helpers here.
* `mixins` - A collection of mixins (like _functions_) that can be used to add some reusable rules to various selectors, like the `rem()` function that we use to add the font-size rule in _rem_ value, informing the desired value in pixels.
* `print` - Specific rules for printing styles, if relevant for the project.
* `typography` - Global rules for font styles.
* `variables` - A customised version of the Bootstrap _variables_ file, including only the values that we want to modify and more variables that we may need to use on other files.

Fonts
---

If the website needs fonts that are not available on **Google Fonts** (or somewhere similar) you may want to use `@font-face` rules to add the files from your theme directory, these fonts can be easily added using the the rules generator in the `assets/scss/fonts/` folder.

You just need to:
1. Create a new `.scss` file in the `assets/scss/fonts/` folder
2. Copy the content from another file in the folder (except from `_icons.scss` that use rules specific for the icons font).
3. Update the values matching the naming of your font files. They should follow a naming pattern and be separated by extension folder (`ttf`, `woff`, `woff2`).
4. Add the `.scss` file import in the `assets/scss/core/._essentials.scss` file, or in the page entry file if it will be used on only one or more pages.