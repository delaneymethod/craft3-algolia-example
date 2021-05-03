<?php
/**
 * CraftyAlgolia module for Craft CMS 3.x
 *
 * A Crafty Algolia module
 *
 * @link      http://www.delaneymethod.com
 * @copyright Copyright (c) 2021 DelaneyMethod
 */

namespace modules\delaneymethod\craftyalgolia;

use Craft;
use craft\events\RegisterTemplateRootsEvent;
use craft\i18n\PhpMessageSource;
use craft\web\View;
use modules\delaneymethod\craftyalgolia\assetbundles\craftyalgolia\CraftyAlgoliaAsset;
use modules\delaneymethod\craftyalgolia\services\CraftyAlgoliaService;
use yii\base\Event;
use yii\base\InvalidConfigException;
use yii\base\Module;

/**
 * @author    DelaneyMethod
 * @package   CraftyAlgolia
 * @since     1.0.0
 *
 * @property  CraftyAlgoliaService $craftyAlgoliaService
 */
class CraftyAlgolia extends Module {
	/**
	 * @var string
	 */
	public string $name = 'CraftyAlgolia';

	/**
	 * @var string
	 */
	public string $version = '1.0.0';

	/**
	 * Static property that is an instance of this module class so that it can be accessed via
	 * CraftyAlgolia::$instance
	 *
	 * @var CraftyAlgolia
	 */
	public static CraftyAlgolia $instance;

	/**
	 * @inheritdoc
	 */
	public function __construct($id, $parent = null, array $config = []) {
		// Set a @modules alias pointed to the modules/ directory
		Craft::setAlias('@modules/delaneymethod/craftyalgolia', $this->getBasePath());

		// Set the controllerNamespace based on whether this is a console or web request
		if (Craft::$app->getRequest()->getIsConsoleRequest()) {
			$this->controllerNamespace = 'modules\\delaneymethod\\craftyalgolia\\console\\controllers';
		} else {
			$this->controllerNamespace = 'modules\\delaneymethod\\craftyalgolia';
		}

		// Translation category
		$i18n = Craft::$app->getI18n();

		/** @noinspection UnSafeIsSetOverArrayInspection */
		if (!isset($i18n->translations[$id]) && !isset($i18n->translations[$id.'*'])) {
			$i18n->translations[$id] = [
				'class' => PhpMessageSource::class,
				'sourceLanguage' => 'en',
				'basePath' => '@modules/delaneymethod/craftyalgolia/translations',
				'forceTranslation' => true,
				'allowOverrides' => true,
			];
		}

		// Base template directory
		Event::on(
			View::class,
			View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
			function(RegisterTemplateRootsEvent $e) {
				if (is_dir($baseDir = $this->getBasePath().DIRECTORY_SEPARATOR.'templates')) {
					$e->roots[$this->id] = $baseDir;
				}
			}
		);

		// Set this as the global instance of this module class
		static::setInstance($this);

		parent::__construct($id, $parent, $config);
	}

	/**
	 * Set our $instance static property to this class so that it can be accessed via
	 * CraftyAlgolia::$instance
	 *
	 * Called after the module class is instantiated; do any one-time initialization
	 * here such as hooks and events.
	 *
	 * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
	 * you do not need to load it in your init() method.
	 */
	public function init() {
		parent::init();

		self::$instance = $this;

		// Load our AssetBundle
		if (Craft::$app->getRequest()->getIsCpRequest()) {
			Event::on(
				View::class,
				View::EVENT_BEFORE_RENDER_TEMPLATE,
				function() {
					try {
						Craft::$app->getView()->registerAssetBundle(CraftyAlgoliaAsset::class);
					} catch (InvalidConfigException $e) {
						Craft::error(
							'Error registering AssetBundle - '.$e->getMessage(),
							__METHOD__
						);
					}
				}
			);
		}

		Craft::info(
			Craft::t(
				'craftyalgolia',
				'{name} module loaded',
				['name' => $this->name]
			),
			__METHOD__
		);
	}
}
