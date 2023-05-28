<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function ctype_space;

/*
 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Space
{

    public function validate(string $input): bool
    {
        return ctype_space($input);
    }
}
