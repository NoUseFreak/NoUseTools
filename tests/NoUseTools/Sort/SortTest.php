<?php
/**
 * This file is part of the NoUseTools package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use NoUseTools\Sort\Sorter;

class SortTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider handlerProvider
     */
    public function testHandlerFactory($handler)
    {
        $this->assertInstanceOf('NoUseTools\Sort\Handler\HandlerInterface', Sorter::createHandler($handler));
    }

    /**
     * @expectedException \Exception
     */
    public function testHandlerFactoryInvalid()
    {
        Sorter::createHandler('abcdefg');
    }

    /**
     * @dataProvider sortContinuesDataProvider
     */
    public function testContinuesSorting($expected, $random, $handler)
    {
        Sorter::sort($random, Sorter::createHandler($handler));
        $this->assertEquals($expected, $random);
    }

    /**
     * @dataProvider sortRandomDataProvider
     */
    public function testRandomSorting($expected, $random, $handler)
    {
        Sorter::sort($random, Sorter::createHandler($handler));
        $this->assertEquals($expected, $random);
    }

    public function sortContinuesDataProvider()
    {
        $array = $random = range(-100, 100);
        $dataSets = array();
        foreach ($this->handlerProvider() as $handler) {
            for ($i = 0; $i < 10; $i++) {
                shuffle($random);
                $dataSets[] = array($array, $random, $handler[0]);
            }
        }
        return $dataSets;
    }

    public function sortRandomDataProvider()
    {
        $dataSets = array();
        foreach ($this->handlerProvider() as $handler) {
            for ($i = 0; $i < 10; $i++) {
                $array = $random = array_rand(range(-200, 200), 100);
                shuffle($random);
                $dataSets[] = array($array, $random, $handler[0]);
            }
        }
        return $dataSets;
    }

    public function handlerProvider()
    {
        return array(
            array('bubble'),
            array('heap'),
            array('insertion'),
            array('merge'),
            array('quick'),
            array('selection'),
            array('shell')
        );
    }
}
