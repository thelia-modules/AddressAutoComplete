# AddressAutoComplete

This module add completion for address based on the 'address1' field

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is AddressAutoComplete.
* Activate it in your thelia administration panel

### Composer

Add it in your main thelia composer.json file

### Template tools

#### Installation

Go to the template folder of your theme and then run `npm install` in order to have all the tools for generating the 'dist' folder.

For every css and/or js changes, you will need to run `./node_modules/gulp/bin/gulp.js`.

```
composer require thelia/address-auto-complete-module:~1.0
```

## Usage

To use this module you need to disable the ZipCode module and have a Google Maps API key defined in the configuration module. 

## Hook

```main.javascript-initialization``` is used to add the javascript

```main.stylesheet``` is used to add the stylesheet

```main.after-javascript-include``` is used to add variable for javascript

