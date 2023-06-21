<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function ctype_digit;

/*
* Class Digit

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Digit
{

    public function validate(string $input): bool
    {
        return preg_match('/^-?\d+(\.\d+)?$/', $input) === 1;
    }
}
