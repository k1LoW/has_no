<?php
/**
 * All HasNo plugin tests
 */
class AllHasNoTest extends CakeTestCase {

/**
 * Suite define the tests for this plugin
 *
 * @return void
 */
    public static function suite() {
        $suite = new CakeTestSuite('All HasNo test');

        $path = CakePlugin::path('HasNo') . 'Test' . DS . 'Case' . DS;
        $suite->addTestDirectoryRecursive($path);

        return $suite;
    }

}
