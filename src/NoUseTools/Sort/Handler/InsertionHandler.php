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

class InsertionHandler implements HandlerInterface
{
    public function sort(array &$array)
    {
        for ($comparison = 0; $comparison < (count($array) - 1); $comparison++) {
            $address = $comparison;
            $dummy = $array[$address + 1];
            while ($address >= 0 && $dummy < $array[$address]) {
                $array[$address + 1] = $array[$address];
                $address--;
            }
            $array[$address + 1] = $dummy;
        }
    }
}
