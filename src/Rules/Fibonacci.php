<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_numeric;

/*
* Class False

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

final class Fibonacci
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_numeric($input) || $input < 0) {
            return false;
        }

        $a = 0;
        $b = 1;

        while ($b < $input) {
            $temp = $a + $b;
            $a = $b;
            $b = $temp;
        }

        return $b === $input || $input === 0;
    }
}
