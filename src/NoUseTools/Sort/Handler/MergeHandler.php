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

class MergeHandler implements HandlerInterface
{
    public function sort(array &$array)
    {
        if (count($array) <= 1) {
            return $array;
        }

        $left = array_splice($array, floor(count($array) / 2));
        $this->sort($left);

        $right = $array;
        $this->sort($right);

        $array = array();

        while (count($left) > 0 && count($right) > 0) {
            if ($left[0] <= $right[0]) {
                array_push($array, array_shift($left));
            }
            else {
                array_push($array, array_shift($right));
            }
        }

        while (count($left) > 0) {
            array_push($array, array_shift($left));
        }

        while (count($right) > 0) {
            array_push($array, array_shift($right));
        }
    }
}
