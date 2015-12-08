<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

// Include configuration
include(PATH_THIRD . 'insight/addon.setup.php');

$lang = array(
	// Global
	'insight_module_name' => INSIGHT_NAME,
	'insight_module_description' => INSIGHT_DESC,

	// Page display
	'insight_sidebar_heading' => 'Pages',

	// Notices
	'insight_no_doc_path' => 'No document path has been defined. You will need to define a document path in your config file.',
	'insight_no_content' => 'No content was found in your defined path.'
);
