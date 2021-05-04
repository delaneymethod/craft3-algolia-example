<?php
/**
 * CraftyAlgolia plugin for Craft CMS 3.x
 *
 * A Crafty Algolia plugin
 *
 * @link      http://www.delaneymethod.com
 * @copyright Copyright (c) 2021 DelaneyMethod
 */

namespace delaneymethod\craftyalgolia\models;

use craft\base\Model;

/**
 * CraftyAlgoliaSettingsModel Model
 *
 * @author    DelaneyMethod
 * @package   CraftyAlgolia
 * @since     1.0.0
 */
class CraftyAlgoliaSettingsModel extends Model {
	/**
	 * @var bool
	 */
	public bool $enabled = true;

	/**
	 * @var string
	 */
	public string $markdownText = '';

	/**
	 * @var string
	 */
	public string $notificationEmail = '';
}
