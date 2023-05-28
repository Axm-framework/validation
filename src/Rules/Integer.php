<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_int;
use function is_numeric;
use function intval;

/*
* Class Integer

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Integer
{

    public function validate($input, $arguments = null, bool $allow_negative = false)
    {
        if (!is_numeric($input)) {
            return false;
        }

        if (!is_int($input)) {
            return false;
        }

        if ($allow_negative && $input < 0) {
            return false;
        }
        if (intval($input) !== $input) {
            return false;
        }

        return true;
    }
}
