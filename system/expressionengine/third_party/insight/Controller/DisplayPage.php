<?php

/**
 * Insight DisplayPage controller
 *
 * @package insight
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2015, BuzzingPixel, LLC
 */

namespace BuzzingPixel\Insight\Controller;

use BuzzingPixel\Insight\Service;

class DisplayPage
{
	/**
	 * Display page
	 *
	 * @return string
	 */
	public function display()
	{
		// Set page title
		ee()->view->cp_page_title = lang('insight_module_name');

		// Load CSS
		ee()->cp->load_package_css('insight.min');

		$groupId = (int) ee()->session->userdata('group_id');
		$page = ee()->input->get('insightPage') ?: 'index';

		// Get the path
		$path = ee()->config->item("insight_doc_path_usergroup_{$groupId}");

		if (! $path) {
			$path = ee()->config->item('insight_doc_path');
		}

		// If no path has been defined display notice
		if (! $path) {
			return ee()->load->view(
				'Notice',
				array('message' => lang('insight_no_doc_path')),
				true
			);
		}

		// Get content
		$content = new Service\Content();
		$content = $content->get($path . '/' . $page);

		// Check for content
		if (! $content->getContent()) {
			return ee()->load->view(
				'Notice',
				array('message' => lang('insight_no_content')),
				true
			);
		}

		// Check for a title in the current page
		$frontMatter = $content->getYAML();

		if (isset($frontMatter['Title'])) {
			ee()->view->cp_page_title = $frontMatter['Title'];
		}

		return $content->getContent();
	}
}
