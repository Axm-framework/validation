<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_array;

/*
* Class Array

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class IsArray
{
    public function validate($input): bool
    {
        return is_array($input) && !empty($input);
    }
}
