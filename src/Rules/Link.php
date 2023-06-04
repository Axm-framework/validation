<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_string;

/*
* Class LeapYear

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Link
{
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return filter_var($input, FILTER_VALIDATE_URL) !== false;
    }
}
