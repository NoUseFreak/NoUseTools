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

class BubbleHandler implements HandlerInterface
{
    public function sort(array &$array)
    {
        $size = count($array);
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size - 1 - $i; $j++) {
                if ($array[$j + 1] < $array[$j]) {
                    $this->arraySwap($array, $j, $j + 1);
                }
            }
        }
    }

    public function arraySwap(&$array, $index1, $index2)
    {
        list($array[$index1], $array[$index2]) = array($array[$index2], $array[$index1]);
    }
}
