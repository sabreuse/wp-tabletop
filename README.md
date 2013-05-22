# WP-Tabletop

Implements the excellent (https://github.com/jsoma/tabletop)[tabletop.js] for  WordPress. Tabletop is a javascript library that allows read-only access to published Google Spreadsheet records as JSON. This allows far more flexible uses of your spreadsheets than simply displaying them as an HTML table or iframed spreadsheet.

##

Usage:
On the simplest level, activating the plugin loads tabletop.js and Backbone.

A basic shortcode is provided as an example implementation: [tabletop key=n]

(todo: option for table display vs. individual record cards)

(todo: api-ish tools; docs on using as a base for other implementations)


### Changelog

0.1 (3/29/2013) Initial implementation. Enqueue the script and provide a shortcode for basic display of Google Spreadsheet content. Using Backbone.