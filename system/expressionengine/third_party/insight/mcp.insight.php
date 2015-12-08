<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Insight control panel
 *
 * @package insight
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2015, BuzzingPixel, LLC
 */

// Include configuration
include(PATH_THIRD . 'insight/addon.setup.php');

use BuzzingPixel\Insight\Controller;

class Insight_mcp
{
	/**
	 * Control panel index
	 *
	 * @return string
	 */
	public function index()
	{
		$displayPage = new Controller\DisplayPage();
		return $displayPage->display();
	}
}
