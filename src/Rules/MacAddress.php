<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_string;
use function preg_match;

/*
* Class MacAddress

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */
class MacAddress
{

    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $input) > 0;
    }
}
