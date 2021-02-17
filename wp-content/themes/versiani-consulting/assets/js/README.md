Javascript Guide
===

> Make sure you read the [General README.md](../../../../../README.md) file that contains some information about the javascript structure.

This file includes some basic information about developing **Javascript** components in this theme.

Summary
---

* [Coding](#user-content-coding)
* [Globals](#user-content-globals)
* [Components](#user-content-components)
* [Pages](#user-content-pages)
* [Libraries](#user-content-libraries)

Entry files
---

We use _webpack_ to bundle and minify all scripts into one compiled file for each page template. The files at the `src` folder are the entry points to these bundles, it execute all imported components and call its inherited functions based on the `Component` class.


Coding
---

The scripts are mainly written using [ES6 features](http://es6-features.org/#Constants) and [jQuery](https://api.jquery.com/).

Components
---

The JS components are placed in the `./assets/js/src/components/` folder. They are used to add interactivity to specific parts of the website, like mobile menu toggling, parallax effect, animations and more.

Usually, a JS component would have a respective PHP and SCSS component file.

They are called in the entry file to be initialized and to trigger their inherited events, like, `scriptLoaded()`, `pageLoaded()`, `pageScrolled()`, `windowResized()`.

### Creating a new component

1. Duplicate the `_example.js` file or use a snippet that contains the basic structure for a JS component.
2. Rename the file and its instance accordingly to the component. This name should be the same used in the PHP and SCSS files.
3. Import it in the entry file for the pages that this component will be added, and add its instance to the `components` array.
4. Start coding! 😃

Globals
---

In the `globals.js` from the `./assets/js/src/utils/` folder, you can add global variables that can be used on any component, like jQuery references for the `body` and `window` objects. 

Libraries
---

Most libraries are imported as `npm` modules. To install a new module follow these steps:

1. Install the library `npm` module via:
```shell
$ npm install library-name
```
2. Add the library in the `webpack.config.js`, in the `plugins` array (if the library should be embeded in the bundle) or in the `externals` array (if you need to reference to the library on your code, but will import it externally, like from CDN or single file). To add the library properly you should reference it using its **symbol identifier** (name of the variable used in code) and npm **module name** (name of installed module). Like: `$`: '`jquery`' or `Swiper`: '`swiper`'.

3. Import the library in the entry file of the pages that will need it.

If the library you need does't exist in the `npm` repository, you can import it via URL in the `includes/enqueues.php` (from theme's root).