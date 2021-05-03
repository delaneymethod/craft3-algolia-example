<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 */

use craft\helpers\App;
use modules\delaneymethod\craftyalgolia\CraftyAlgolia;
use modules\delaneymethod\craftyalgolia\services\CraftyAlgoliaService;

return [
	// Global settings
	'*' => [
		'id' => App::env('APP_ID') ?: 'CraftCMS',

		'modules' => [],

		'bootstrap' => [],
	],

	// Dev environment settings
	'dev' => [
		'modules' => [
			'craftyalgolia' => [
				'class' => CraftyAlgolia::class,
				'components' => [
					'craftyAlgoliaService' => [
						'class' => CraftyAlgoliaService::class,
					],
				],
			],
		],

		'bootstrap' => [
			'craftyalgolia',
		],
	],

	// Staging environment settings
	'staging' => [],

	// Production environment settings
	'production' => [],
];
