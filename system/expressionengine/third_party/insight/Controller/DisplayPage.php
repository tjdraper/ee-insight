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
		$page = ee()->input->get('insightPage') ?: 'readme';

		// Get the path
		$config = ee()->config->item('insight_doc_paths');
		$path = null;

		// Check if a specific path has been defined for this user group
		if (isset($config[$groupId])) {
			$path = $config[$groupId];
		} elseif (isset($config['default'])) {
			$path = $config['default'];
		}

		// If no path has been defined at all display notice
		if (! $path) {
			return ee()->load->view(
				'Notice',
				array('message' => lang('insight_no_doc_path')),
				true
			);
		}

		// Normalize path
		$path = rtrim($path, '/') . '/';

		// Get content
		$content = new Service\Content();
		$content = $content->get($path . $page);

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

		// Get page list
		$pageList = new Service\PageList();
		$list = $pageList->get($path);

		return ee()->load->view(
			'Page',
			array(
				'list' => $list,
				'content' => $content->getContent(),
				'baseUrl' => BASE . AMP . 'C=addons_modules' . AMP . 'M=show_module_cp' . AMP . 'module=insight',
				'currentPage' => $page
			),
			true
		);
	}
}
