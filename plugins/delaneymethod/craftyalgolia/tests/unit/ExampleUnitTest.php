<?php
/**
 * CraftyAlgolia plugin for Craft CMS 3.x
 *
 * A Crafty Algolia plugin
 *
 * @link      http://www.delaneymethod.com
 * @copyright Copyright (c) 2021 DelaneyMethod
 */

namespace delaneymethod\craftyalgoliatests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use delaneymethod\craftyalgolia\Craftyalgolia;

/**
 * ExampleUnitTest
 *
 *
 * @author    delaneymethod
 * @package   Craftyalgolia
 * @since     1.0.0
 */
class ExampleUnitTest extends Unit
{
    // Properties
    // =========================================================================

    /**
     * @var UnitTester
     */
    protected $tester;

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testPluginInstance()
    {
        $this->assertInstanceOf(
            Craftyalgolia::class,
            Craftyalgolia::$plugin
        );
    }

    /**
     *
     */
    public function testCraftEdition()
    {
        Craft::$app->setEdition(Craft::Pro);

        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }
}
