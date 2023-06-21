<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_string;

/*
* Class Lower

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation
 */

class Lower
{
    public function validate($input, $allow_chars = ''): bool
    {
        if (!is_string($input)) {
            return false;
        }

        // Si se permiten caracteres adicionales, construir una expresión regular
        if (!empty($allow_chars)) {
            $regex = '/^[a-z' . preg_quote($allow_chars, '/') . ']+$/';
            return (bool) preg_match($regex, $input);
        }

        return ctype_lower($input);
    }
}
