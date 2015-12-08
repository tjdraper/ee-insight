<?php

/**
 * Insight PageList service
 *
 * @package insight
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2015, BuzzingPixel, LLC
 */

namespace BuzzingPixel\Insight\Service;

require_once PATH_THIRD . 'insight/Vendor/FrontYAML/vendor/autoload.php';

use Mni\FrontYAML;

class PageList
{
	/**
	 * Get list of pages
	 *
	 * @param string $path
	 */
	public function get($path)
	{
		// Get the directory contents
		$pathFiles = scandir($path);

		// Unset the first two useless items
		unset($pathFiles[0]);
		unset($pathFiles[1]);

		// Start a list array
		$list = array();

		foreach ($pathFiles as $file) {
			// If the item is not a file, move on
			if (! is_file($path . $file)) {
				continue;
			}

			// Get the vars for this file
			$vars = $this->getFileVars($path, $file);

			// If this is a readme or index, send to top of array
			if ($vars['fileName'] === 'index' or $vars['fileName'] === 'readme') {
				array_unshift($list, $vars);

				continue;
			}

			// At the vars to the list array
			$list[] = $vars;
		}

		return $list;
	}

	/**
	 * Get vars for file
	 *
	 * @param string $path
	 * @param string $file
	 * @return array
	 */
	private function getFileVars($path, $file)
	{
		// Parse the content of the file to get the YAML
		$frontYamlParser = new FrontYAML\Parser();
		$content = $frontYamlParser->parse(
			file_get_contents($path . $file)
		);

		// Get the YAML
		$frontMatter = $content->getYAML();

		// Get the filename without extension
		$pathInfo = pathinfo($file);
		$title = $fileName = $pathInfo['filename'];

		// Set the title from the YAML if it exists
		if (isset($frontMatter['MenuTitle'])) {
			$title = $frontMatter['MenuTitle'];
		} elseif (isset($frontMatter['Title'])) {
			$title = $frontMatter['Title'];
		}

		return compact('title', 'fileName');
	}
}
