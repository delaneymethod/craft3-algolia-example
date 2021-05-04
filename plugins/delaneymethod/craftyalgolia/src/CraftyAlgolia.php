<?php
/**
 * CraftyAlgolia plugin for Craft CMS 3.x
 *
 * A Crafty Algolia plugin
 *
 * @link      http://www.delaneymethod.com
 * @copyright Copyright (c) 2021 DelaneyMethod
 */

namespace delaneymethod\craftyalgolia;

use Craft;
use craft\base\Plugin;
use craft\events\PluginEvent;
use craft\services\Plugins;
use delaneymethod\craftyalgolia\models\CraftyAlgoliaSettingsModel;
use delaneymethod\craftyalgolia\services\CraftyAlgoliaService;
use yii\base\Event;

/**
 * @author    DelaneyMthod
 * @package   CraftyAlgolia
 * @since     1.0.0
 *
 * @property  CraftyAlgoliaService $craftyAlgoliaService
 */
class CraftyAlgolia extends Plugin {
	/**
	 * Static property that is an instance of this module class so that it can be accessed via
	 * CraftyAlgolia::$plugin
	 *
	 * @var CraftyAlgolia
	 */
	public static CraftyAlgolia $plugin;

	/**
	 * To execute your plugin’s migrations, you’ll need to increase its schema version.
	 *
	 * @var string
	 */
	public $schemaVersion = '1.0.0';

	/**
	 * Set to `true` if the plugin should have a settings view in the control panel.
	 *
	 * @var bool
	 */
	public $hasCpSettings = true;

	/**
	 * Set to `true` if the plugin should have its own section (main nav item) in the control panel.
	 *
	 * @var bool
	 */
	public $hasCpSection = true;

	/**
	 * Set our $plugin static property to this class so that it can be accessed via
	 * CraftyAlgolia::$plugin
	 */
	public function init() {
		parent::init();

		self::$plugin = $this;

		/**
		 * @var CraftyAlgoliaSettingsModel $settings
		 */
		$settings = $this->getSettings();

		$this->hasCpSection = $settings->enabled;

		// Do something after we're installed
		Event::on(
			Plugins::class,
			Plugins::EVENT_AFTER_INSTALL_PLUGIN,
			function(PluginEvent $event) {
				if ($event->plugin === $this) {
					// We were just installed
				}
			}
		);

		Craft::info(
			Craft::t(
				'craftyalgolia',
				'{name} module loaded',
				['name' => $this->name]
			),
			__METHOD__
		);
	}

	/**
	 * @return CraftyAlgoliaSettingsModel
	 */
	protected function createSettingsModel(): CraftyAlgoliaSettingsModel {
		return new CraftyAlgoliaSettingsModel();
	}

	/**
	 * @return string|null
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 * @throws \yii\base\Exception
	 */
	protected function settingsHtml(): string {
		return Craft::$app->getView()->renderTemplate('craftyalgolia/_settings', [
			'settings' => $this->getSettings()
		]);
	}
}
