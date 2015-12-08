<?php

// Set up autoloading for EE 2
spl_autoload_register(function ($class) {
	$ns = explode('\\', $class);

	// Make sure a Insight class is being requested
	if ($ns[0] !== 'BuzzingPixel' or $ns[1] !== 'Insight') {
		return;
	}

	// Remove BuzzingPixel and Insight from the path
	unset($ns[0]);
	unset($ns[1]);

	// Put the file path together
	$ns = implode('/', $ns);

	// Load the file
	$file = PATH_THIRD . 'insight/' . $ns . '.php';

	if (file_exists($file)) {
		include_once $file;
	}
});

// Set addon info
$plugin_info = array (
	'pi_author' => 'TJ Draper',
	'pi_author_url' => 'https://buzzingpixel.com',
	'pi_description' => 'Generate user documentation or other pages in the ExpressionEngine CP from Markdown files',
	'pi_name' => 'Insight',
	'pi_version' => '0.0.1',
);

// Define constants
if (! defined('INSIGHT_AUTHOR')) {
	define('INSIGHT_AUTHOR', $plugin_info['pi_author']);
	define('INSIGHT_AUTHOR_URL', $plugin_info['pi_author_url']);
	define('INSIGHT_DESC', $plugin_info['pi_description']);
	define('INSIGHT_NAME', $plugin_info['pi_name']);
	define('INSIGHT_VER', $plugin_info['pi_version']);
}
