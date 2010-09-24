<?php defined('SYSPATH') or die('No direct script access.');

//-- Environment setup --------------------------------------------------------

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('America/Chicago');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

//-- Configuration and initialization -----------------------------------------

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
        'index_file' => FALSE,
        'errors' => FALSE,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'auth'       => MODPATH.'auth',       // Basic authentication
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	'database'   => MODPATH.'database',   // Database access
	'image'      => MODPATH.'image',      // Image manipulation
	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'oauth'      => MODPATH.'oauth',      // OAuth authentication
	'pagination' => MODPATH.'pagination', // Paging of results
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	//'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */


Route::set('admin', 'admin(/<action>(/<param>))')
	->defaults(array(
		'controller' => 'admin_main',
		'action'     => 'start',
	));

Route::set('rss', 'rss(/<action>)')
	->defaults(array(
		'controller' => 'rss',
		'action'     => 'show',
	));

// Catch-all route for Captcha classes to run
Route::set('captcha', 'captcha(/<group>)')
	->defaults(array(
		'controller' => 'captcha',
		'action' => 'index',
		'group' => NULL));

Route::set('add', 'add(/<post>)', array(
        'post' => '[0-9]+',
        ))
	->defaults(array(
		'controller' => 'site',
		'action'     => 'add_comment',
	));

Route::set('show_post', 'post(/<post>)', array(
        'post' => '[0-9a-z\-]+',
        ))
	->defaults(array(
		'controller' => 'site',
		'action'     => 'show_post',
	));

Route::set('nocategory', '(<page>)', array(
        'page' => '[0-9]+',
        ))
	->defaults(array(
		'controller' => 'site',
		'action'     => 'show_all',
	));

Route::set('nocategory2', 'category(/<page>)', array(
        'page' => '[0-9]+',
        ))
	->defaults(array(
		'controller' => 'site',
		'action'     => 'show_all',
	));

Route::set('category', 'category(/<category>(/<page>))', array(
        'category' => '[a-z0-9\-]+',
        'page' => '[0-9]+',
        ))
	->defaults(array(
		'controller' => 'site',
		'action'     => 'show_all',
	));

Route::set('search', 'search(/<page>)')
	->defaults(array(
		'controller' => 'site',
		'action'     => 'search',
	));

Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'site',
		'action'     => 'show_all',
	));

if ( ! defined('SUPPRESS_REQUEST'))
{
	/**
	 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
	 * If no source is specified, the URI will be automatically detected.
	 */
	echo Request::instance()
		->execute()
		->send_headers()
		->response;
}
