<?php
/**
 * This file is part of the NoUseTools package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NoUseTools\Sort;

use NoUseTools\Sort\Handler\HandlerInterface;
use Exception;

class Sorter
{
    protected static $handlers = array();

    public static function sort(array &$array, $handler)
    {
        if (!($handler instanceof HandlerInterface)) {
            throw new Exception('Invalid handler.');
        }
        $handler->sort($array);
    }

    public static function createHandler($name)
    {
        $uri = 'NoUseTools\\Sort\\Handler\\' . ucfirst($name) . 'Handler';
        if (!isset(self::$handlers[$uri])) {
            if (!class_exists($uri)) {
                throw new Exception('Could not find handler. "' . $uri . '"');
            }
            self::$handlers[$uri] = new $uri();
        }
        return self::$handlers[$uri];
    }
}
