<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_object;

/*
 *Class Object

 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

class IsObject
{
    public function validate($input): bool
    {
        return is_object($input);
    }
}
