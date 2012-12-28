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

class ShellHandler implements HandlerInterface
{
    public function sort(array &$arr)
    {
        $len = count($arr);
        $gap = (int)floor($len/2);

        while ($gap > 0) {
            for ($i = $gap; $i < $len; $i++) {
                $temp = $arr[$i];
                $j = $i;

                while ($j >= $gap && $arr[$j - $gap] > $temp) {
                    $arr[$j] = $arr[$j - $gap];
                    $j -= $gap;
                }

                $arr[$j] = $temp;
            }

            $gap = (int)floor($gap/2);
        }
    }
}
