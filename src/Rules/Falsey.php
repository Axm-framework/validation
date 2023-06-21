<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use const FILTER_VALIDATE_BOOLEAN;
use const FILTER_NULL_ON_FAILURE;

/*
* Class False

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Falsey
{
    /**
     * Validates if the input value matches the specified boolean value.
     *
     * @param mixed $input The input value to validate.
     * @param bool $expected The expected boolean value to match.
     * @return bool True if the input value matches the expected boolean value, false otherwise.
     */
    function validate($input): bool
    {
        return filter_var($input, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === false;
    }
}
