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

class HeapHandler implements HandlerInterface
{
    public function sort(array &$array)
    {
        //This will heapify the array
        $init = (int)floor((count($array) - 1) / 2);
        for ($i = $init; $i >= 0; $i--) {
            $size = count($array) - 1;
            $this->buildHeap($array, $i, $size);
        }

        //swaping of nodes
        for ($i = (count($array) - 1); $i >= 1; $i--) {
            $tmp_var = $array[0];
            $array [0] = $array [$i];
            $array [$i] = $tmp_var;
            $this->buildHeap($array, 0, $i - 1);
        }
    }

    private function buildHeap(&$array, $i, $t)
    {
        $tmp_var = $array[$i];
        $j = $i * 2 + 1;

        while ($j <= $t) {
            if ($j < $t) {
                if ($array[$j] < $array[$j + 1]) {
                    $j = $j + 1;
                }
            }
            if ($tmp_var < $array[$j]) {
                $array[$i] = $array[$j];
                $i = $j;
                $j = 2 * $i + 1;
            } else {
                $j = $t + 1;
            }
        }
        $array[$i] = $tmp_var;
    }
}
