<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use DateTime;

/*
* Class Min

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Min
{
    public function validate($value, $arguments): bool
    {

        if (is_file($value)) {
            $value = filesize($value);
        }

        if (is_string($value) || $value instanceof DateTime) {
            $value = strlen((string) $value);
        }

        // dd(
        //     $value, $arguments
        // );
        return $value <= $arguments;
    }
}
