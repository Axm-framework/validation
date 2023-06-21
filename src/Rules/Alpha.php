<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function ctype_alpha;

/*
* Class Alpha

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Alpha
{

    function validate($input): bool
    {
        $input = str_replace(' ', '', $input);
        return ctype_alpha($input);    //[A-Za-z]
    }
}
