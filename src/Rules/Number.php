<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_numeric;

/*
* Class Number

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation
 */

class Number
{
    public function validate($input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        $input = (float) $input;

        return $input === $input;
    }
}
