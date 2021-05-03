<?php
/**
 * CraftyAlgolia module for Craft CMS 3.x
 *
 * A Crafty Algolia module
 *
 * @link      http://www.delaneymethod.com
 * @copyright Copyright (c) 2021 DelaneyMethod
 */

namespace modules\delaneymethod\craftyalgolia\assetbundles\craftyalgolia;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * CraftyAlgoliaAsset AssetBundle represents a collection of asset files, such as CSS, JS, images.
 *
 * @author    DelaneyMethod
 * @package   CraftyAlgolia
 * @since     1.0.0
 */
class CraftyAlgoliaAsset extends AssetBundle {
	/**
	 * Initializes the bundle.
	 */
	public function init() {
		$this->sourcePath = "@modules/delaneymethod/craftyalgolia/assetbundles/craftyalgolia/dist";

		$this->depends = [
			CpAsset::class,
		];

		$this->js = [
			'js/CraftyAlgolia.js',
		];

		$this->css = [
			'css/CraftyAlgolia.css',
		];

		parent::init();
	}
}
