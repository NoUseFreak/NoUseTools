<?php
/**
 * This file is part of the NoUseTools package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class HandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider handlerProvider
     */
    public function testInstances($name)
    {
        $uri = 'NoUseTools\\Sort\\Handler\\' . ucfirst($name) . 'Handler';
        $this->assertInstanceOf('NoUseTools\Sort\Handler\HandlerInterface', new $uri());
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
