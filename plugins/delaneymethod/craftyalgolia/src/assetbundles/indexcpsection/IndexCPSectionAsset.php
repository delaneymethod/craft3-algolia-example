<?php
/**
 * CraftyAlgolia plugin for Craft CMS 3.x
 *
 * A Crafty Algolia plugin
 *
 * @link      http://www.delaneymethod.com
 * @copyright Copyright (c) 2021 DelaneyMethod
 */

namespace delaneymethod\craftyalgolia\assetbundles\indexcpsection;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * IndexCPSectionAsset AssetBundle represents a collection of asset files, such as CSS, JS, images.
 *
 * @author    DelaneyMethod
 * @package   CraftyAlgolia
 * @since     1.0.0
 */
class IndexCPSectionAsset extends AssetBundle {
	/**
	 * Initializes the bundle.
	 */
	public function init() {
		$this->sourcePath = "@delaneymethod/craftyalgolia/assetbundles/indexcpsection/dist";

		// define the dependencies
		$this->depends = [
			CpAsset::class,
		];

		$this->js = [
			'js/Index.js',
		];

		$this->css = [
			'css/Index.css',
		];

		parent::init();
	}
}
