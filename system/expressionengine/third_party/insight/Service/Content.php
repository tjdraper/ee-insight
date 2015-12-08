<?php

/**
 * Insight Content service
 *
 * @package insight
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2015, BuzzingPixel, LLC
 */

namespace BuzzingPixel\Insight\Service;

require_once PATH_THIRD . 'insight/Vendor/FrontYAML/vendor/autoload.php';

use Mni\FrontYAML;

class Content
{
	/**
	 * Get content
	 *
	 * @param string $path
	 * @return object FrontYAML parsed content instnace
	 */
	public function get($path)
	{
		$content = $this->checkContent($path);

		$frontYamlParser = new FrontYAML\Parser();

		$content = $frontYamlParser->parse($content);

		return $content;
	}

	/**
	 * Check paths for content
	 *
	 * @param string $path
	 * @return string Contents of file
	 */
	private function checkContent($path)
	{
		$checkPath = $path;

		if (is_file($checkPath)) {
			return file_get_contents($checkPath);
		}

		$checkPath = $path . '.md';

		if (is_file($checkPath)) {
			return file_get_contents($checkPath);
		}

		return '';
	}
}
