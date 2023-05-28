<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

/*
* Class Odd

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Odd
{
    public function validate($input): bool
    {
        if (!is_int($input)) {
            return false;
        }

        return $input % 2 !== 0;
    }
}
