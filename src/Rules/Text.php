<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_string;

/*
* Class Text

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Text
{
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        $allowedChars = '/^[a-zA-Z0-9\s.,;:!?()\[\]\-\'\"]+$/';
        if (!preg_match($allowedChars, $input)) {
            return false;
        }

        return is_string($input);
    }
}
