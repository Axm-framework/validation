<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_string;
use function mb_strstr;
use function preg_match;

/*
* Class Infinite

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation
 */

class Slug
{
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return preg_match('/^([a-z0-9]+-)*[a-z0-9]+$/', $input) === 1;
    }
}
