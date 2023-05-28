<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_scalar;

/*
* Class Required

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Required
{
    public final function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return !empty($input);
    }
}
