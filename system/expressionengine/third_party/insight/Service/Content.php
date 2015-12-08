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
		// Check paths for content files
		$content = $this->checkContent($path);

		// Parse the content into YAML and Markdown
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
		// Get an initial path
		$checkPath = $path;

		if (is_file($checkPath)) {
			return file_get_contents($checkPath);
		}

		// Check with .md extension
		$checkPath = $path . '.md';

		if (is_file($checkPath)) {
			return file_get_contents($checkPath);
		}

		// Check for index file
		$checkPath = explode('/', $path);
		array_pop($checkPath);
		$checkPath = implode('/', $checkPath);

		if (is_file($checkPath . '/index.md')) {
			return file_get_contents($checkPath . '/index.md');
		}

		return '';
	}
}
