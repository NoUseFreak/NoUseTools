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
    public static function sort(array &$array, $handler)
    {
        if (is_string($handler)) {
            $uri = 'NoUseTools\\Sort\\Handler\\' . ucfirst($handler) . 'Handler';
            if (!class_exists($uri)) {
                throw new Exception('Could not find handler. "' . $uri . '"');
            }
            $handler = new $uri();
        }
        if (!($handler instanceof HandlerInterface)) {
            throw new Exception('Invalid handler.');
        }
        $handler->sort($array);
    }
}
