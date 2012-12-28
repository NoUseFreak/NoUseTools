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

class SelectionHandler implements HandlerInterface
{
    public function sort(array &$array)
    {
        for ($dummy1 = (count($array) - 1); $dummy1 > 0; $dummy1--) {
            $large = $array[0];
            $index = 0;
            for ($dummy2 = 0; $dummy2 < ($dummy1 + 1); $dummy2++) {
                if ($array[$dummy2] > $large) {
                    $large = $array[$dummy2];
                    $index = $dummy2;
                }
            }
            $array[$index] = $array[$dummy1];
            $array[$dummy1] = $large;
        }
    }
}
