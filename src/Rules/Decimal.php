<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_numeric;
use function is_float;

/*
* Class Decimal

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Decimal
{

    public function validate($input, $min = null, $max = null): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        $floatVal = (float)$input;

        if (!is_float($floatVal)) {
            return false;
        }

        if ($min !== null && $floatVal < $min) {
            return false;
        }

        if ($max !== null && $floatVal > $max) {
            return false;
        }

        return true;
    }
}
