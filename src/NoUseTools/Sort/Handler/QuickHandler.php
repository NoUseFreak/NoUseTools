<?php
/**
 * This file is part of the NoUseTools package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NoUseTools\Sort\Handler;

class QuickHandler implements HandlerInterface
{
    public function sort(array &$array)
    {
        if (count($array) < 2) {
            return $array;
        }

        $left = $right = array();

        reset($array);
        $pivot_key = key($array);
        $pivot = array_shift($array);

        foreach ($array as $k => $v) {
            if ($v < $pivot) {
                $left[$k] = $v;
            } else {
                $right[$k] = $v;
            }
        }

        $this->sort($left);
        $this->sort($right);

        $array = array_merge($left, array($pivot_key => $pivot), $right);
    }
}
