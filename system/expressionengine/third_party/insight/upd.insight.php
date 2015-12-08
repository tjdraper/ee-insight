<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Insight Install/Update Class
 *
 * @package insight
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2015, BuzzingPixel, LLC
 */

// Include configuration
include(PATH_THIRD . 'insight/addon.setup.php');

class Insight_upd
{
	public $name = INSIGHT_NAME;
	public $version = INSIGHT_VER;

	/**
	 * Install method
	 *
	 * @return bool
	 */
	public function install()
	{
		ee()->db->insert('modules', array(
			'module_name' => 'Insight',
			'module_version' => $this->version,
			'has_cp_backend' => 'y',
			'has_publish_fields' => 'n'
		));

		return true;
	}

	/**
	 * Uninstall method
	 *
	 * @return bool
	 */
	public function uninstall()
	{
		ee()->db->delete('modules', array(
			'module_name' => 'Insight'
		));

		return true;
	}

	/**
	 * Update method
	 *
	 * @return bool
	 */
	public function update($current = '')
	{
		return true;
	}
}
