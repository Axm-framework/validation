<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_numeric;

/*
* Class Positive

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation
 */

class Positive
{
    public function validate(int|float $input): bool
    {
        if (!is_int($input) && !filter_var($input, FILTER_VALIDATE_FLOAT)) {
            return false;
        }

        return $input > 0;
    }
}
