<?php
/**
 * CraftyAlgolia module for Craft CMS 3.x
 *
 * A Crafty Algolia module
 *
 * @link      http://www.delaneymethod.com
 * @copyright Copyright (c) 2021 DelaneyMethod
 */

namespace modules\delaneymethod\craftyalgolia\services;

use craft\base\Component;
use craft\elements\Entry;

/**
 * CraftyAlgoliaService Service
 *
 * All your business logic should go in here, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other modules can interact with.
 *
 * @author    DelaneyMethod
 * @package   CraftyAlgolia
 * @since     1.0.0
 */
class CraftyAlgoliaService extends Component {
	/**
	 * @param Entry $entry
	 * @return array
	 */
	public function transformVideoData(Entry $entry): array {
		return [
			'title' => $entry->title,
			'description' => $entry->description,
			'youtubeUrl' => $entry->youtubeUrl,
		];
	}
}
