'use strict';

var colors = require('colors'); // Enable the use of colors for logs in console
console.log(colors.gray('Reading gulpfile.js...'));

// Required modules
var gulp = require('gulp'), 						// Gulp tasks
	pump = require('pump'), 						// Replace pipe() with pump for a better error handling
	path = require('path'), 						// Node.js module for handling paths
	ora = require('ora'),   						// Updated log messages (loading spinners)
	fs = require('fs');     						// Node.js module for managing files and directories (used to get package.json)

// Modules imported on demand for specific tasks
var prompt			= null, // Enable input prompt inside Gulp tasks
	replace			= null, // Replace string on files
	gulpSass		= null, // Compile SCSS files to CSS
	nodeSass		= null, // Node SASS compiler
	sourcemaps		= null, // Generate SASS sourcemaps
	prefix			= null, // Add prefix to CSS rules
	mmq				= null, // Merge all equivalent CSS media queries
	cleanCss		= null, // Optimize/Minify CSS
	webpack			= null, // Bundles all JS files included
	consolidate		= null, // Used to read the variables template as lodash
	iconfont		= null, // Generate icon font based on SVG files
	ttf2woff		= null, // Generate WOFF versions of font files
	ttf2woff2		= null, // Generate WOFF2 versions of font files
	favicons		= null, // Generate favicons for multiple browsers and devices
	wpPot			= null, // Create .pot file for translation
	po2mo			= null, // Compiles .po files into binary .mo files
	ora				= null, // Add spinner to console logging
	remoteSrc		= null, // Download external files
	zip				= null, // Unzip files
	del				= null, // Delete files and folders
	rename			= null, // Rename files
	plumber			= null, // Prevent pipe breaking caused by errors from gulp plugins
	gutil			= null; // Gulp utilities	

// Content of the theme.json file
// Where is defined the project info, directories, files and more
const theme = JSON.parse(fs.readFileSync('./theme.json'));

// Webpack configuration for JS compilation (jQuery)
var webpackConfig = null;

// Spinner used for loading messages
var spinner = null;

// ----------------------------------- UTILS ----------------------------------- //
// ----------------------------------------------------------------------------- //

/** Error handler to be used on error events */
function errorLog(err) {
	if (spinner) {
		spinner.fail(colors.red(spinner.text));
		clearSpinner();
	}
	console.log.bind(err);
}

/** Create and starts a new spinner with the given text */
function startSpinner(message) {
	if (!ora) {
		ora = require('ora');
	}
	spinner = ora({
		text: message,
		color: 'green'
	});
	spinner.start();
}

/** Reset the spinner class */
function clearSpinner() {
	spinner = null;
}

/** Return slug version of a string */
function slugify(str) {
	let slug = str.replace(/^\s+|\s+$/g, '').toLowerCase()
  
    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        slug = slug.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    slug = slug.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return slug;
}

/** Fetch command line arguments */
const arg = (argList => {
	let arg = {},
		a, opt, thisOpt, curOpt;
	for (a = 0; a < argList.length; a++) {

		thisOpt = argList[a].trim();
		opt = thisOpt.replace(/^\-+/, '');

		if (opt === thisOpt) {
			// argument value
			if (curOpt) arg[curOpt] = opt;
			curOpt = null;
		} else {
			// argument name
			curOpt = opt;
			arg[curOpt] = true;
		}
	}
	return arg;
})(process.argv);



// -------------------------------- DEVELOPMENT -------------------------------- //
// ----------------------------------------------------------------------------- //

/**
 * STYLES TASK
 * Compile the SCSS files (including Bootstrap, if imported) into the theme style.css
 */
var watchingStyles = false;

function sass(done) {
	// Import modules
	if (!gulpSass) { gulpSass = require('gulp-sass'); }
	if (!nodeSass) { nodeSass = require('node-sass'); }
	gulpSass.compiler = nodeSass;
	if (!replace) { replace = require('gulp-replace'); }
	if (!rename) { rename = require('gulp-rename'); }
	if (!prefix) { prefix = require('gulp-autoprefixer'); }
	if (!sourcemaps) { sourcemaps = require('gulp-sourcemaps'); }
	//if (!mmq) { mmq = require('gulp-merge-media-queries'); }
	//if (!cleanCss) { cleanCss = require('gulp-clean-css'); }

	// Check if a specific page was specified
	if(arg.page || arg.p) {
		let page = arg.page || arg.p;
		theme.tasks.scss.entry = Array.isArray(theme.tasks.scss.entry) ? theme.tasks.scss.entry[0].replace('*.scss', page + '.scss') : theme.tasks.scss.entry.replace('*.scss', page + '.scss');

		// Check for entry file existence
		if (!fs.existsSync(path.resolve(__dirname, theme.tasks.scss.entry))) {
			console.log(colors.red('Problem: The entry file (' + theme.tasks.scss.entry + ') wasn\'t found.'));
			done();
			return;
		}
	}

	// Check for the watch flag
	if (arg.watch || arg.w) {
		console.log(colors.cyan('Watching ' + (watchingScripts ? 'js and ' : '') + 'scss files for changes...'));
		if (!watchingStyles) {
			gulp.watch(theme.tasks.scss.files, gulp.series(sass));
			watchingStyles = true;
		}
	}

	// Check for development flag
	let devMode = false;
	if (arg.dev || arg.development || arg.d) {
		devMode = true;
	}

	// Complile the SASS files
	if (devMode) {
		return pump([
			gulp.src(theme.tasks.scss.entry).on('data', () => {
				if (!spinner) {
					startSpinner('Compiling Sass');
				}
			}),
			sourcemaps.init(),
			gulpSass({
				outputStyle: 'extended'
			}).on('error', errorLog),
			prefix('last 4 versions'),
			rename({
				suffix: '.dist'
			}),
			sourcemaps.write('./').on('end', () => {
				spinner.succeed(colors.green(spinner.text));
				clearSpinner();
			}),
			gulp.dest(theme.tasks.scss.dist).on('end', sassCompleted),
		], done);
	} else {
		return pump([
			gulp.src(theme.tasks.scss.entry).on('data', () => {
				if (!spinner) {
					startSpinner('Compiling Sass');
				}
			}),
			gulpSass({
				outputStyle: 'compressed'
			}).on('error', errorLog),
			prefix('last 4 versions').on('end', () => {
				spinner.succeed(colors.green(spinner.text));
				clearSpinner();
			}),
			//mmq(),
			//cleanCss(),
			rename({
				suffix: '.dist'
			}),
			gulp.dest(theme.tasks.scss.dist).on('end', sassCompleted),
		], done);
	}

	function sassCompleted() {
		console.log(colors.green('CSS files compiled successfully at ' + theme.tasks.scss.dist + '.') + (devMode ? colors.yellow(' [development mode]') : colors.gray(' [production mode]')));
		// Check for the watch flag
		if (watchingStyles) {
			console.log(colors.cyan('Watching ' + (watchingScripts ? 'js and ' : '') + 'scss files for changes...'));
		} else {
			done();
		}
	}
}

/**
 * JAVASCRIPT TASK
 * Compile and bundles all JS files
 */
var watchingScripts = false;

function js(done) {
	// Import modules
	if (!webpackConfig) { webpackConfig = require('./webpack.config'); }
	if (!webpack) { webpack = require('piped-webpack'); }
	if (!gutil) { gutil = require('gulp-util'); }

	// Check if a specific page was specified
	if(arg.page || arg.p) {
		let page = arg.page || arg.p;
		theme.tasks.js.entry = theme.tasks.js.entry.replace('*.js', page + '.js');
		theme.tasks.js.entry = Array.isArray(theme.tasks.js.entry) ? theme.tasks.js.entry[0].replace('*.js', page + '.js') : theme.tasks.js.entry.replace('*.js', page + '.js');

		// Check for entry file existence
		if (!fs.existsSync(path.resolve(__dirname, theme.tasks.js.entry))) {
			console.log(colors.red('Problem: The entry file (' + theme.tasks.js.entry + ') wasn\'t found.'));
			done();
			return;
		}
	}

	// Check for the watch flag to watch JS files
	if (arg.watch || arg.w) {
		if (!watchingScripts) {
			gulp.watch(theme.tasks.js.files, js).on('error', gutil.log);
			watchingScripts = true;
		}
	}

	// Check for development flag
	let devMode = false;
	if (arg.dev || arg.development || arg.d) {
		devMode = true;
		webpackConfig.devtool = 'cheap-eval-source-map';
		webpackConfig.mode = 'development';
	}

	// Compile the script files
	return pump([
		gulp.src(theme.tasks.js.entry).on('data', () => {
			if (!spinner) {
				//startSpinner('Compiling Scripts');
			}
		}),
		webpack(webpackConfig).on('error', errorLog).on('end', () => {
			//spinner.succeed(colors.green(spinner.text));
			//clearSpinner();
		}),
		gulp.dest(theme.tasks.js.dist).on('end', function (event) {
			console.log(colors.green('JS files compiled successfully at ' + theme.tasks.js.dist) + (devMode ? colors.yellow(' [development mode]') : colors.gray(' [production mode]')));
			// Check for the watch flag
			if (watchingScripts) {
				console.log(colors.cyan('Watching js ' + (watchingStyles ? 'and scss ' : '') + 'files for changes...'));
			} else {
				done();
			}
		}),
	], done);
}


/**
 * CREATE TASK
 * Create boilerplate files to a new component or page
 */
async function create(done) {
	if (!prompt) { prompt = require('inquirer'); }

	let typeToCreate	= undefined;
	let itemName		= null; // kebab-case
	let capitalizedName	= null;	// Capital Case
	let camelCaseName	= null; // camelCase
	let pascalCaseName	= null; // PascalCase
	let itemDescription	= undefined;

	// Ask what should be created, a component or a page
	async function askTypeToCreate() {
		return prompt.prompt({
			type: 'list',
			message: `What do you want to create?`,
			choices: [ 'Component', 'Page' ],
			name: 'type'
		})
	}

	// Ask for the name of the new item
	async function askName(type) {
		return prompt.prompt({
			type: 'input',
			message: `What's the name of the ${type}? ${colors.gray('(separate words with dash or space)')}`,
			name: 'name',
			validate: input => {
				return input ? true : `Please enter a name for the ${type}`
			}
		});
	}

	// Confirm if provided name is correct
	async function confirmName(name, type) {
		return prompt.prompt({
			type: 'confirm',
			message: `Is ${colors.cyan(name)} the correct name for your ${type}?`,
			name: 'isNameCorrect'
		});
	}

	// Ask description text
	async function askDescription(type) {
		return prompt.prompt({
			type: 'input',
			message: `Write a short description of the ${type}: ${colors.gray('(It will be added in the template file heading)')}`,
			name: 'description'
		});
	}

	// Check if name was passed as arg of the command
	if(arg.type || arg.t) {
		typeToCreate = (arg.type || arg.t).toLowerCase();
	}

	if(typeToCreate == undefined) {
		const { type } = await askTypeToCreate();
		typeToCreate = type.toLowerCase();
	}

	if(['component', 'page'].includes(typeToCreate)) {

		// If not passed as arg, ask user
		if(typeToCreate == undefined) {
			const { type } = await askTypeToCreate();
			typeToCreate = type.toLowerCase();
		}

		// Check if name was passed as arg of the command
		if(arg.name || arg.n) {
			itemName = slugify(arg.name || arg.n);
		}

		// If arg name wasn't found, ask name to user
		if(!itemName) {
			const { name } = await askName(typeToCreate);
			itemName = slugify(name);
		}

		// Set name variations
		capitalizedName	= itemName.split('-').map(word => word = word[0].toUpperCase() + word.substring(1)).join(' ');
		pascalCaseName	= capitalizedName.replace(/\s/g, '');
		camelCaseName	= capitalizedName[0].toLowerCase() + capitalizedName.substring(1).replace(/\s/g, '');

		// Confirm component name
		const { isNameCorrect } = await confirmName(capitalizedName, typeToCreate);

		// Check if description was passed as arg of the command
		if(arg.description || arg.d) {
			itemDescription = arg.description || arg.d;
		}

		// If arg description wasn't found, ask description text to user
		if(!itemDescription && typeToCreate === 'component') {
			const { description } = await askDescription(typeToCreate);
			itemDescription = description ? description : `Add the ${typeToCreate} description here...`;
		}

		if(isNameCorrect) {
			try {
				if(typeToCreate === 'component') {
					// Run component creation process
					await createComponent(itemName, capitalizedName, camelCaseName, pascalCaseName, itemDescription);
				}
				else if(typeToCreate === 'page') {
					// Run page creation process
					await createPage(itemName, capitalizedName, camelCaseName, pascalCaseName, itemDescription);
				}
			} catch(err) {
				console.log(err);
				console.log(colors.red(`Error: It wasn\'t possible to create the ${typeToCreate} files. See the logs above for more details.`));
			}
		} else {
			console.log(colors.gray(`Ok, you can run the task again defining the right name for the ${typeToCreate}`));
		}
	} else {
		console.log(colors.red(`Sorry, but ${colors.bold(typeToCreate)} is not a valid type. It can be a ${colors.gray('component')} or a ${colors.gray('page')}`));
	}

	console.log(); // New line on console
	done();
}

/** Create files for a new component with basic structure */
async function createComponent(componentName, capitalizedName, camelCaseName, pascalCaseName, description) {
	// Import modules
	if (!consolidate) { consolidate = require('gulp-consolidate'); }
	if (!rename) { rename = require('gulp-rename'); }
	
	// Add other util info about files in the data objects
	for(const property in theme.tasks.create.component) {
		const fileData = theme.tasks.create.component[property];
		switch (fileData.name) {
			case '%PAGE_NAME_KEBAB%':
				theme.tasks.create.component[property].name = componentName;
				break;
			case '%PAGE_NAME_PASCAL%':
				theme.tasks.create.component[property].name = pascalCaseName;
				break;
			default:
				break;
		}
		theme.tasks.create.component[property].extension	= '.' + property.split('-')[0];
		theme.tasks.create.component[property].filename		= fileData.prefix + theme.tasks.create.component[property].name + fileData.suffix;
		theme.tasks.create.component[property].filepath		= `${fileData.dist}${theme.tasks.create.component[property].filename}${theme.tasks.create.component[property].extension}`;
	}

	// Asks which component files should be created
	async function askWhichFilesShouldBeCreated() {
		return prompt.prompt({
			type: 'checkbox',
			message: `Which files should be created?`,
			choices: [ 'php', 'scss', 'js' ],
			default: [ 'php', 'scss' ],
			name: 'chosenFiles'
		});
	}

	// Asks user if the existing files should be overriden
	async function askIfShouldOverride(existing) {
		return prompt.prompt({
			type: 'confirm',
			message: `${existing.length > 1 ? 'Files' : 'A file'} with this name already exists at ${existing.map(ext => ext = colors.cyan(`${theme.tasks.create.component[ext].filepath}`)).join(' and ')} Do you want to ${colors.yellow('override')} ${existing.length > 1 ? 'them' : 'it'}?`,
			name: 'shouldOverride'
		});
	}

	// Create a component file with the providen info
	async function createFile(vars, property) {
		return new Promise((resolve, reject) => {
			gulp.src(theme.tasks.create.component[property].template)
				.pipe(consolidate('lodash', vars))
				.pipe(rename({ basename: theme.tasks.create.component[property].filename, extname: theme.tasks.create.component[property].extension }))
				.pipe(gulp.dest(theme.tasks.create.component[property].dist)
					.on('end', () => {
						resolve();
					}));
		});
	}

	// Check if any of the files already exist
	async function isNameAvailable(extentions) {
		return new Promise((resolve, reject) => {
			const existing = [];
			extentions.forEach((ext => {
				if( fs.existsSync(path.resolve(__dirname, theme.tasks.create.component[ext].filepath)) ) {
					existing.push(ext);
				}
			}))
			resolve({
				isAvailable: !existing.length,
				existing: existing
			});
		});
	}

	// Ask which files should be created
	const { chosenFiles } = await askWhichFilesShouldBeCreated();
	
	// Check if name was passed as arg of the command
	let overrideExisting = false;
	if(arg.override || arg.o) {
		overrideExisting = arg.override || arg.o;
	}

	// Check if name can be used
	const { isAvailable, existing } = await isNameAvailable(chosenFiles);

	if(!isAvailable && !overrideExisting) {
		// Ask if should override existing files
		const { shouldOverride } = await askIfShouldOverride(existing);
		overrideExisting = shouldOverride;
	}

	if(overrideExisting || isAvailable) {
		const nameVars = {
			name: componentName,
			capitalizedName,
			camelCaseName,
			pascalCaseName,
			packageName: theme.project.package,
			description,
		};

		const filesIds = ['php', 'scss', 'js'];
		
		// Create PHP component file
		filesIds.forEach(async ext => {
			if(chosenFiles.includes(ext)) {
				await createFile(nameVars, ext);
			}
		})

		// Success message
		console.log(colors.green( colors.bold(`✓ ${capitalizedName} component successfully created at:`) ));
		chosenFiles.forEach(ext => console.log( colors.cyan(`  ${theme.tasks.create.component[ext].filepath}`) ));
	} else {
		console.log(colors.gray('Ok, nothing has changed'));
	}
}

/** Create files for a new page with basic structure */
async function createPage(pageName, capitalizedName, camelCaseName, pascalCaseName, description) {
	// Import modules
	if (!consolidate) { consolidate = require('gulp-consolidate'); }
	if (!rename) { rename = require('gulp-rename'); }

	const availablePageTypes = [
		'Page Template',
		'Custom Post Type',
		'Custom Taxonomy',
		'Tag (Default)',
		'Author',
		'Blog (Index)',
	];

	// Check if any of the files already exist
	async function isNameAvailable() {
		return new Promise((resolve, reject) => {
			const existing = [];
			for(const property in theme.tasks.create.page) {
				if( fs.existsSync(path.resolve(__dirname, `${theme.tasks.create.page[property].filepath}`)) ) {
					existing.push(property);
				}
			}
			resolve({
				isAvailable: !existing.length,
				existing: existing
			});
		});
	}

	// Ask for type of page
	async function askPageType() {
		return prompt.prompt({
			type: 'list',
			message: `What is the type of the page?`,
			choices: availablePageTypes,
			name: 'pageType'
		})
	}

	// Ask for [Custom Post Type or Custom Taxonomy] name
	async function askContextName(pageType) {
		const context = pageType === availablePageTypes[1] ? 'post type' : 'taxonomy';
		return prompt.prompt({
			type: 'input',
			message: `What is the name/key for the custom ${context}? ${colors.gray(`(same as declared on registering the ${context})`)}`,
			choices: availablePageTypes,
			name: 'contextKey',
			validate: (input) => {
				return new RegExp(/[a-z0-9_-]+/g).test(input) ? true : `This doesn\'t seem to be a valid ${context} key. Please try again.`
			}
		})
	}

	// Asks user if the existing files should be overriden
	async function askIfShouldOverride(existing) {
		const existingPaths = existing.map(property => property = colors.cyan(`${theme.tasks.create.page[property].filepath}`));
		return prompt.prompt({
			type: 'confirm',
			message: `${existingPaths.length > 1 ? 'Files' : 'A file'} with this name already exists at ${existingPaths.join(' and ')} Do you want to ${colors.yellow('override')} ${existing.length > 1 ? 'them' : 'it'}?`,
			name: 'shouldOverride'
		});
	}

	// Create a page file given the details
	async function createPageFile(vars, property) {
		return new Promise((resolve, reject) => {
			gulp.src(theme.tasks.create.page[property].template)
				.pipe(consolidate('lodash', vars))
				.pipe(rename({ basename: theme.tasks.create.page[property].filename, extname: theme.tasks.create.page[property].extension }))
				.pipe(gulp.dest(theme.tasks.create.page[property].dist)
					.on('end', () => {
						resolve();
					}));
		});
	}

	// Ask for page type
	const { pageType } = await askPageType();
	
	// Set proper name for PHP entry file
	switch (pageType) {
		case availablePageTypes[0]: // Page Template
			theme.tasks.create.page['php-entry'].prefix = 'template-';
			break;
		case availablePageTypes[1]: // Custom Post Type
			theme.tasks.create.page['php-entry'].prefix = 'single-';
			break;
		case availablePageTypes[2]: // Custom Taxonomy
			theme.tasks.create.page['php-entry'].prefix = 'taxonomy-';
			break;
		case availablePageTypes[3]: // Tag (Default)
			theme.tasks.create.page['php-entry'].name = 'tag';
			break;
		case availablePageTypes[4]: // Author
			theme.tasks.create.page['php-entry'].name = 'author';
			break;
		case availablePageTypes[5]: // Blog (Index)
			theme.tasks.create.page['php-entry'].name = 'home';
			break;
	
		default:
			break;
	}
	
	// Check if is of type [Custom Post Type] or [Custom Taxonomy] to ask context name
	let contextName = '';
	if(pageType === availablePageTypes[1] || pageType === availablePageTypes[2]) {
		const { contextKey } = await askContextName(pageType);
		contextName = contextKey;
	} else {
		contextName = pageName;
	}

	// Add other util info about files in the data objects
	for(const property in theme.tasks.create.page) {
		const fileData = theme.tasks.create.page[property];
		switch (fileData.name) {
			case '%PAGE_NAME_KEBAB%':
				theme.tasks.create.page[property].name = pageName;
				break;
			case '%PAGE_NAME_PASCAL%':
				theme.tasks.create.page[property].name = pascalCaseName;
				break;
			case '%CONTEXT_NAME%':
				theme.tasks.create.page[property].name = contextName;
				break;
			default:
				break;
		}
		theme.tasks.create.page[property].extension	= '.' + property.split('-')[0];
		theme.tasks.create.page[property].filename	= fileData.prefix + theme.tasks.create.page[property].name + fileData.suffix;
		theme.tasks.create.page[property].filepath	= `${fileData.dist}${theme.tasks.create.page[property].filename}${theme.tasks.create.page[property].extension}`;
	}

	// Define the PHP Entry title text
	let entryTitle;
	if(pageType === availablePageTypes[0]) {
		entryTitle = 'Template name: ' + capitalizedName;
	} else {
		entryTitle = capitalizedName + ' template';
	}

	// Check if name was passed as arg of the command
	let overrideExisting = false;
	if(arg.override || arg.o) {
		overrideExisting = arg.override || arg.o;
	}

	// Check if name can be used
	const { isAvailable, existing } = await isNameAvailable();

	if(!isAvailable && !overrideExisting) {
		// Ask if should override existing files
		const { shouldOverride } = await askIfShouldOverride(existing);
		overrideExisting = shouldOverride;
	}

	if(overrideExisting || isAvailable) {
		const nameVars = {
			name: pageName,
			capitalizedName,
			camelCaseName,
			pascalCaseName,
			packageName: theme.project.package,
			description,
			entryTitle,
		};

		const filesIds		= ['php-entry',			'php-content',		'php-class',	'scss-entry',		'scss-styles',				'js'];
		const filesLabels	= ['PHP Entry file',	'PHP Template',		'PHP Class',	'SCSS Entry file',	'Specific page styles',		'Scripts'];
		
		// Create all page files
		await Promise.all([
			createPageFile(nameVars, filesIds[0]),
			createPageFile(nameVars, filesIds[1]),
			createPageFile(nameVars, filesIds[2]),
			createPageFile(nameVars, filesIds[3]),
			createPageFile(nameVars, filesIds[4]),
			createPageFile(nameVars, filesIds[5]),
		]);

		// Success message
		console.log(colors.green( colors.bold(`✓ ${capitalizedName} page successfully created at:`) ));
		filesIds.forEach((property, i) => console.log(`  ${colors.cyan(theme.tasks.create.page[property].filepath)} ${colors.gray(`- ${filesLabels[i]}`)}`));
	} else {
		console.log(colors.gray('Ok, nothing has changed'));
	}
}

/**
 * FAVICONS TASK
 * Create favicons for multiple platforms/devices based in a single image
 */
function generateFavicons(done) {
	// Import modules
	if (!prompt) { prompt = require('gulp-prompt'); }
	if (!favicons) { favicons = require('gulp-favicons'); }

	// Check for entry file existence
	if (!fs.existsSync(path.resolve(__dirname, theme.tasks.favicons.entry))) {
		console.log(colors.red('Problem: The entry favicon file (' + theme.tasks.favicons.entry + ') wasn\'t found.'));
		return;
	}

	let confirmMsg = 'The project name is set as ' + colors.cyan(theme.project.name) + '. You can change this in the ' + colors.cyan('package.json') + ' file, in projectName property.\n  Is this name correct for this project?';
	return pump([
		gulp.src(theme.tasks.favicons.entry),
		prompt.confirm({
			message: confirmMsg,
			default: true
		}),
		favicons({
			appName: theme.project.name,
			background: 'transparent',
			path: './',
			display: "browser",
			version: 1.0,
			logging: false,
			online: false,
			html: "favicons.html",
			pipeHTML: true,
			replace: true,
			icons: {
				android: false, // Create Android homescreen icon. `boolean` or `{ offset, background, shadow }`
				appleIcon: true, // Create Apple touch icons. `boolean` or `{ offset, background }`
				appleStartup: false, // Create Apple startup images. `boolean` or `{ offset, background }`
				coast: {
					offset: 25
				}, // Create Opera Coast icon with offset 25%. `boolean` or `{ offset, background }`
				favicons: true, // Create regular favicons. `boolean`
				firefox: false, // Create Firefox OS icons. `boolean` or `{ offset, background }`
				windows: true, // Create Windows 8 tile icons. `boolean` or `{ background }`
				yandex: true // Create Yandex browser icon. `boolean` or `{ background }`
			}
		})
		.on('error', errorLog)
		.on('end', function () {
			console.log(colors.green('Favicons created successfully in the favicons folder.'));
		}),
		gulp.dest(theme.tasks.favicons.dist)
	], done);
}


/**
 * FONT ICONS TASK
 * Generate a icons font based on SVG files
 */
function generateIconsFont(done) {
	// Import modules
	if (!iconfont) { iconfont = require('gulp-iconfont'); }
	if (!consolidate) { consolidate = require('gulp-consolidate'); }
	if (!rename) { rename = require('gulp-rename'); }
	if (!replace) { replace = require('gulp-replace'); }

	return pump([
		gulp.src(theme.tasks.iconfont.entry),
		iconfont({
			fontName: theme.tasks.iconfont.name,
			prependUnicode: true,
			formats: ['ttf', 'woff', 'woff2', 'svg'],
			fontHeight: 1001,
			normalize: true
		}).on('glyphs', (glyphs) => {
			var vars = {
				className: 'class-name',
				glyphs: glyphs.map(mapGlyphs)
			}
			gulp.src(theme.tasks.iconfont.template)
				.pipe(consolidate('lodash', vars))
				.pipe(replace(',)', '\n)'))
				.pipe(replace('\\E', '\\e'))
				.pipe(rename({ basename: 'variables', extname: '.scss' }))
				.pipe(gulp.dest(theme.tasks.iconfont.dist));
		}),
		gulp.dest(theme.tasks.iconfont.dist)
		.on('error', errorLog)
		.on('end', function() {
			console.log(colors.green(`Font files successfully created in ${theme.tasks.iconfont.dist} folder.`));
			console.log(colors.green(`Now update the ` + colors.cyan('$icons') + ` variables in your ` + colors.cyan(theme.tasks.iconfont.target) + ` file with the content of the ` + colors.cyan(theme.tasks.iconfont.dist + 'variables.scss')));
			console.log(colors.gray('Tip: If you are using VS Code, just hold Cmd (MacOS) or Ctrl (Windows) and click in the file references above.'));
		})
	], done);
}

function mapGlyphs (glyph) {
	return { name: glyph.name, codepoint: glyph.unicode[0].charCodeAt(0) }
}


/**
 * WEB FONTS TASK (WIP)
 * Convert font files in different extensions
 */
function generateWebFonts(done) {
	// Import modules
	if (!ttf2woff2) { ttf2woff2 = require('gulp-ttf2woff2'); }
	if (!ttf2woff) { ttf2woff = require('gulp-ttf2woff'); }

	return pump([
		gulp.src('./assets/fonts/helvetica-neue/ttf/*.ttf'),
		ttf2woff2(),
		gulp.dest('./assets/fonts')
		.on('error', errorLog)
		.on('end', function() {
			console.log(colors.green(`Font files successfully created in the folder.`));
		}),
		gulp.src('./assets/fonts/helvetica-neue/ttf/*.ttf'),
		ttf2woff(),
		gulp.dest('./assets/fonts')
		.on('error', errorLog)
		.on('end', function() {
			console.log(colors.green(`Font files successfully created in the folder.`));
		})
	], done);
}


/**
 * TRANSLATIONS TASK
 * Analyze the PHP files and create the .pot file for translations
 */
function generatePotFiles(done) {
	// Import modules
	if (!wpPot) {
		wpPot = require('gulp-wp-pot');
	}

	let potDomain = theme.project.id;
	let potPackage = theme.project.package;
	if (arg.domain) {
		potDomain = arg.domain;
	}
	if (arg.package) {
		potPackage = arg.package;
	}
	return pump([
		gulp.src(theme.tasks.pot.files),
		wpPot({
			domain: potDomain,
			package: potPackage
		}).on('error', errorLog),
		gulp.dest(theme.tasks.pot.dist + potDomain + '.pot').on('end', function () {
			console.log(colors.green('POT file successfully created in ' + theme.tasks.pot.dist + potDomain + '.pot'));
		})
	], done);
}

/**
 * PO2MO CONVERSION TASK
 * Creates a binary version of each .po file in the translations directory
 */
function compilePoToMo(done) {
	// Import modules
	if (!po2mo) {
		po2mo = require('gulp-po2mo')
	};

	return pump([
		gulp.src(theme.tasks.mo.files),
		po2mo().on('error', errorLog),
		gulp.dest(theme.tasks.mo.dist).on('end', function () {
			console.log(colors.green('.mo files successfully created.'));
		})
	], done);
}

// -------------------------------- INSTALLATION -------------------------------- //
// ------------------------------------------------------------------------------ //

// Execute all tasks for the WordPress installation
function wp(done) {
	return new Promise((resolve, reject) => {
		downloadWordPress().then(() => {
			unzipWordPress().then(() => {
				removeUnnecessaryFiles().then(() => {
					copyWordPress().then(() => {
						cleanWordPressFiles().then(() => {
							resolve();
						}).catch(ops);
					}).catch(ops);
				}).catch(ops);
			}).catch(ops);
		}).catch(ops);

		// In case a problem happens
		function ops(err) {
			console.log(err);
			console.log(colors.red('Unable to finish installation. Check the logs above to identify the problem.'));
			resolve();
		};
	});
}

/** Download latest WordPress */
function downloadWordPress(done) {
	// Try download
	return new Promise((resolve, reject) => {
		if (!remoteSrc) { remoteSrc = require('gulp-remote-src'); }

		// Start spinner message
		startSpinner('Downloading WordPress');

		pump([
			remoteSrc(['latest.zip'], {
				base: 'https://wordpress.org/',
			}).on('error', err => {
				spinner.fail();
				clearSpinner();
				reject(err);
			}),
			gulp.dest('./').on('end', () => {
				spinner.succeed(colors.green(spinner.text));
				spinner.clear();
				resolve();
			})
		], done);
	});
}

/** Unzip WordPress folder */
function unzipWordPress(done) {
	return new Promise((resolve, reject) => {
		if (!ora) { ora = require('ora'); }
		if (!zip) { zip = require('gulp-vinyl-zip'); }

		// Add spinner message
		const spinner = ora({
			text: 'Unzipping WordPress',
			color: 'green'
		});
		spinner.start();

		pump([
			zip.src('./latest.zip').on('error', err => {
				spinner.fail();
				reject(err);
			}),
			gulp.dest('./').on('end', () => {
				spinner.succeed(colors.green('Unzipping WordPress'));
				spinner.clear();
				resolve();
			})
		], done);
	});
}

/** Remove unnecessary files from WordPress, since the repository already have them */
function removeUnnecessaryFiles() {
	return new Promise((resolve, reject) => {
		if (!del) {
			del = require('del');
		}

		del([
			'./wordpress/wp-content',
			'./wordpress/readme.html',
			'./wordpress/license.txt'
		]).then(() => {
			resolve();
		}).catch(reject);
	});
}

/** Copy WordPress files to the repository root */
function copyWordPress(done) {
	return new Promise((resolve, reject) => {
		if (!ora) {
			ora = require('ora');
		}

		// Add spinner message
		const spinner = ora({
			text: 'Moving files',
			color: 'green'
		});
		spinner.start();

		pump([
			gulp.src('./wordpress/**/*').on('error', err => {
				spinner.fail();
				spinner.clear();
				reject(err);
			}),
			gulp.dest('../../../').on('end', () => {
				spinner.succeed(colors.green('Moving files'));
				spinner.clear();
				resolve();
			})
		], done);
	});
}

/** Remove unnecessary and temporary files */
function cleanWordPressFiles(done) {
	return new Promise((resolve, reject) => {
		if (!del) {
			del = require('del');
		}
		if (!ora) {
			ora = require('ora');
		}
		if (!replace) {
			replace = require('gulp-replace');
		}

		// Add spinner message
		const spinner = ora({
			text: 'Cleaning files',
			color: 'green'
		});
		spinner.start();

		// /(((\n*)\/\/ INSTALLATIO TASKS(\n*.*)*))/g
		del(['./wordpress', './latest.zip'])
			.then(() => {
				spinner.succeed(colors.green('Cleaning files'));
				spinner.clear();
				resolve();
			}).catch(err => {
				spinner.fail();
				spinner.clear();
				reject(err);
			});
	});
}

// ------------------------------ AVAILABLE TASKS ----------------------------- //
// ---------------------------------------------------------------------------- //

exports.wp = wp;
exports.js = js;
exports.sass = sass;
exports.create = create;
exports.favicons = generateFavicons;
exports.iconfont = generateIconsFont;
exports.webfonts = generateWebFonts;
exports.pot = generatePotFiles;
exports.mo = compilePoToMo;

/** Default task - Compiles styles and scripts files */
if (arg.b || arg.browsersync) {
	gulp.task('default', gulp.series(sass, js, browserSync));
} else {
	gulp.task('default', gulp.series(sass, js));
}