<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_string;
use function json_decode;
use function json_last_error;

use const JSON_ERROR_NONE;

/*
 * This file is part of Respect/Validation.
 * 
 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Json
{
    public function validate($input, $options = null, $depth = 512): bool
    {
        if (!is_string($input) || $input === '') {
            return false;
        }

        $decoded = json_decode($input, $options, $depth);

        return $decoded !== null && json_last_error() === JSON_ERROR_NONE;
    }

    public function validateSafe($input, $options = JSON_BIGINT_AS_STRING, $depth = 512): bool
    {
        return $this->validate($input, $options, $depth);
    }
}
