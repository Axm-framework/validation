<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_finite;
use function is_numeric;

/*
 * Class Finite
 * 
 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Finite
{

    public function validate($input): bool
    {
        return is_numeric($input) && is_finite((float) $input);
    }
}
