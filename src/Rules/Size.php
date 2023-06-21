<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_string;
use function is_array;
use SplFileInfo;

/*
* Class Size

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Size
{
    public function validate($value, $parameters): bool
    {
        $expectedSize = $parameters;

        if ($value instanceof SplFileInfo) {
            return $value->getSize() == $expectedSize;
        }

        if (is_array($value)) {
            return count($value) == $expectedSize;
        }

        if (is_string($value)) {
            return strlen($value) == $expectedSize;
        }

        return $value == $expectedSize;
    }
}
